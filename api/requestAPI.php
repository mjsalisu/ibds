<?php
error_reporting(0);
include("./dbcon.php");
include("../function/validate.php");
include("../function/sendEmail.php");
session_start();

// Status: NULL, Pending, Approved, Rejected, Cleared

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