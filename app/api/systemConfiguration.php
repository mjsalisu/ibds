<?php
error_reporting(0);
include("./dbcon.php");
include("../function/validate.php");
session_start();

if (isset($_POST["systemConfigSave"])) {
    $faculty = mysqli_real_escape_string($con, validate($_POST["faculty"]));
    $department = (mysqli_real_escape_string($con, validate($_POST["department"])));
    $amount = (mysqli_real_escape_string($con, validate($_POST["amount"])));
    $deadline = (mysqli_real_escape_string($con, validate($_POST["deadline"])));
    $bank = (mysqli_real_escape_string($con, validate($_POST["bank"])));
    $accountno = (mysqli_real_escape_string($con, validate($_POST["accountno"])));

    $sql = "INSERT INTO `system_config`(`faculty`, `department`, `fees_amount`, `application_deadline`, `bank_name`, `account_number`) VALUES ('$faculty','$department','$amount','$deadline','$bank','$accountno')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = 'Record has been saved successfully';
        header("location: ../config.php");
    } else {
        $_SESSION["msg"] = 'Ooops Something went wrong';
        header("location: ../config.php");
    }
}

// Update
if (isset($_POST["systemConfigUpdate"])) {
    $id = $_POST["id"];
    $faculty = mysqli_real_escape_string($con, validate($_POST["faculty"]));
    $department = (mysqli_real_escape_string($con, validate($_POST["department"])));
    $amount = (mysqli_real_escape_string($con, validate($_POST["amount"])));
    $deadline = (mysqli_real_escape_string($con, validate($_POST["deadline"])));
    $bank = (mysqli_real_escape_string($con, validate($_POST["bank"])));
    $accountno = (mysqli_real_escape_string($con, validate($_POST["accountno"])));

    $faculty = empty($faculty) ? 'Faculty of Computing' : $faculty;
    $department = empty($department) ? 'Software Engineering' : $department;

    $sql = "UPDATE `system_config` SET `faculty`='$faculty',`department`='$department',`fees_amount`='$amount',`application_deadline`='$deadline',`bank_name`='$bank',`account_number`='$accountno' WHERE id = '$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = 'Record has been updated successfully';
        header("location: ../config.php");
    } else {
        $_SESSION["msg"] = 'Ooops Something went wrong';
        header("location: ../config.php");
    }
}
