<?php
error_reporting(0);
include("./dbcon.php");
include("../function/random.php");
include("../function/validate.php");
include("../function/sendEmail.php");
session_start();
// SIGNIN

if (isset($_POST["systemConfig"])) {
    $faculty = mysqli_real_escape_string($con, validate($_POST["faculty"]));
    $department = (mysqli_real_escape_string($con, validate($_POST["department"])));
    $amount = (mysqli_real_escape_string($con, validate($_POST["amount"])));
    $deadline = (mysqli_real_escape_string($con, validate($_POST["deadline"])));
    $bank = (mysqli_real_escape_string($con, validate($_POST["bank"])));
    $accountno = (mysqli_real_escape_string($con, validate($_POST["accountno"])));

    $sql = "INSERT INTO `system_configuration`(`faculty`, `department`, `fees_amount`, `application_deadline`, `bank_name`, `account_number`) VALUES ('$faculty','$department','$amount','$deadline','$bank','$accountno')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = 'System Configured';
        header("location: ../config.php");
    } else {
        $_SESSION["msg"] = 'Ooops Something went wrong';
        header("location: ../config.php");
    }
}

// Update

if (isset($_POST["systemConfigSave"])) {
    $id = $_POST["id"];
    $faculty = mysqli_real_escape_string($con, validate($_POST["faculty"]));
    $department = (mysqli_real_escape_string($con, validate($_POST["department"])));
    $amount = (mysqli_real_escape_string($con, validate($_POST["amount"])));
    $deadline = (mysqli_real_escape_string($con, validate($_POST["deadline"])));
    $bank = (mysqli_real_escape_string($con, validate($_POST["bank"])));
    $accountno = (mysqli_real_escape_string($con, validate($_POST["accountno"])));

    $sql = "UPDATE `system_configuration` SET `faculty`='$faculty',`department`='$department',`fees_amount`='$amount',`application_deadline`='$deadline',`bank_name`='$bank',`account_number`='$accountno' WHERE id = '$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = 'System Configuration Updated';
        header("location: ../config.php");
    } else {
        $_SESSION["msg"] = 'Ooops Something went wrong';
        header("location: ../config.php");
    }
}
