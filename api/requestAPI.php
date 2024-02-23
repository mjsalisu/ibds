<?php
error_reporting(0);
include("./dbcon.php");
include("../function/validate.php");
include("../function/sendEmail.php");
session_start();

// Status: NULL, Pending, Approved, Rejected, Cleared

// Submit request
if (isset($_POST["submitRequest"])) {
    $studentID = mysqli_real_escape_string($con, validate($_POST["studentID"]));
    $requestID = mysqli_real_escape_string($con, validate($_POST["requestID"]));
    $remark = mysqli_real_escape_string($con, validate($_POST["remark"]));

    if (empty($studentID) || empty($requestID) || empty($remark)) {
        $_SESSION["msg"] = 'Please fill all fields';
        header("location: ../student/request.php?studentID=$studentID");
        exit();
    }

    mysqli_begin_transaction($con);

    // Attempt to execute the SQL queries
    $sql = "INSERT INTO `request`(`requestID`, `studentID`, `studentNote`) VALUES ('$requestID','$studentID','$remark')";
    $sql2 = "UPDATE `students` SET `status`='Pending' WHERE id='$studentID'";

    $res1 = mysqli_query($con, $sql);
    $res2 = mysqli_query($con, $sql2);

    if ($res1 && $res2) {
        mysqli_commit($con);
        $_SESSION["msg"] = 'Your request has been submitted successfully';
        header("location: ../student/status.php?studentID=$studentID");
    } else {
        mysqli_rollback($con);
        $_SESSION["msg"] = 'Oooops, something went wrong'. mysqli_error($con);
        header("location: ../student/request.php?studentID=$studentID");
    }
}

if (isset($_POST["SearchStudents"])) {
    $regNo = mysqli_real_escape_string($con, validate($_POST["regNo"]));
    $emailOrPhone = mysqli_real_escape_string($con, validate($_POST["emailOrPhone"]));
    $userChoice = mysqli_real_escape_string($con, validate($_POST["userChoice"]));

    if ($userChoice == 'submit request') {
        if (empty($regNo) || empty($emailOrPhone)) {
            $_SESSION["msg"] = 'Please fill all fields';
            header("location: ../student/index.php");
            exit();
        }

        $sql = "SELECT * FROM `students` WHERE regNo='$regNo' AND email='$emailOrPhone' OR phone='$emailOrPhone'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);

            if ($row["status"] == "Approved") {
                $_SESSION["msg"] = 'You have already submitted a request and it has been <b>APPROVED</b>. Please see details below';
                header("location: ../student/status.php?studentID=" . $row["id"]);
            } elseif ($row["status"] == "Pending") {
                $_SESSION["msg"] = 'You have already submitted a request and it is still <b>PENDING</b>. Please see details below';
                header("location: ../student/status.php?studentID=" . $row["id"]);
            } elseif ($row["status"] == "Rejected") {
                $_SESSION["msg"] = 'You have already submitted a request and it has been <b>REJECTED</b>. Please see details below';
                header("location: ../student/status.php?studentID=" . $row["id"]);
            } elseif ($row["status"] == "Cleared") {
                $_SESSION["msg"] = 'You have already submitted a request and it has been <b>cleared</b>. Please see details below';
                header("location: ../student/status.php?studentID=" . $row["id"]);
            } else {
                $_SESSION["msg"] = 'You have not yet submitted a request. Please <b>FILL</b> the form below to submit a request';
                header("location: ../student/request.php?studentID=" . $row["id"]);
            }

        } else {
            $_SESSION["msg"] = 'Student not found with Reg No: <b>' . $regNo . '</b> and Email/Phone: <b>' . $emailOrPhone . '</b>. <br> If you think this is an error, please contact your department for further assistance.';
            header("location: ../student/index.php");
        }
    } elseif ($userChoice == 'check request status') {

        $requestID = mysqli_real_escape_string($con, validate($_POST["requestID"]));
        if (empty($requestID)) {
            $_SESSION["msg"] = 'Please fill all fields';
            header("location: ../student/index.php");
            exit();
        }

        $sql = "SELECT * FROM `request` WHERE requestID='$requestID'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION["msg"] = 'Details of your request with ID: <b>' . $requestID . '</b> is shown below';
            header("location: ../student/status.php?studentID=" . $row["studentID"]);
        } else {
            $_SESSION["msg"] = 'Request with ID: <b>' . $requestID . '</b> is not found. If you think this is an error, please try submitting a new request or contact your department for further assistance.';
            header("location: ../student/index.php");
        }
    } else {
        $_SESSION["msg"] = 'Oooops, something went wrong';
        header("location: ../student/index.php");
    }
}

// Check-in or Reject item
if (isset($_POST["approveRequest"]) || isset($_POST["rejectRequest"])) {
    $studentID = mysqli_real_escape_string($con, validate($_POST["studentID"]));
    $studentEmail = mysqli_real_escape_string($con, validate($_POST["studentEmail"]));
    $studentName = mysqli_real_escape_string($con, validate($_POST["studentName"]));
    
    $requestID = mysqli_real_escape_string($con, validate($_POST["requestID"]));
    $remarkNote = mysqli_real_escape_string($con, validate($_POST["approveNote"]));
    $timestamp = date("Y-m-d H:i:s");

    if (isset($_POST["approveRequest"])) {
        $status = "Approved";
    } else {
        $status = "Rejected";
    }

    if (empty($studentID) || empty($requestID) || empty($remarkNote)) {
        $_SESSION["msg"] = 'Please fill all fields';
        header("location: ../request-view.php?studentID=$studentID");
        exit();
    }

    $sql = "UPDATE `request` SET `remarkNote`='$remarkNote',`updated_at`='$timestamp' WHERE requestID='$requestID'";
    $sql2 = "UPDATE `students` SET `status`='$status' WHERE id='$studentID'";
    $res = mysqli_query($con, $sql);
    $res2 = mysqli_query($con, $sql2);
    if ($res && $res2) {
        if ($status == "Approved") {
            sendItemApprovalEmail($studentEmail, $studentName, $requestID);
            $_SESSION["msg"] = 'Student request has been approved successfully';
        } else {
            sendItemRejectionEmail($studentEmail, $studentName, $requestID);
            $_SESSION["msg"] = 'Student request has been rejected successfully';
        }
        header("location: ../request-logs.php");
    } else {
        $_SESSION["msg"] = 'Oooops, something went wrong'. mysqli_error($con);
        header("location: ../request-view.php?studentID=$studentID");
    }
}