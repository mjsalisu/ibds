<?php
error_reporting(0);
include("./dbcon.php");
include("../function/validate.php");
session_start();

// Donate to student
if (isset($_POST["makePayment"])) {
    $studentID = $_POST["studentID"];
    $studentName = mysqli_real_escape_string($con, validate($_POST["studentName"]));
    $studentEmail = (mysqli_real_escape_string($con, validate($_POST["studentEmail"])));
    
    $donorID = $_POST["donorID"];
    $remark = (mysqli_real_escape_string($con, validate($_POST["remark"])));
    $amount = (mysqli_real_escape_string($con, validate($_POST["amount"])));
    $leftAmount = (mysqli_real_escape_string($con, validate($_POST["leftAmount"])));
    $walletBalance = (mysqli_real_escape_string($con, validate($_POST["walletBalance"])));
    
    echo "Amount: $amount, Left Amount: $leftAmount <br>";
    var_dump($amount, $leftAmount);

    // if ($walletBalance != '' && $amount >= 1 && $amount <= $leftAmount) {
        // $walletBalance -= $amount;
    // } else if ($walletBalance == '' && $amount >= 500 && $amount <= $leftAmount) {
    // } else {}

    if ($amount >= 500 && $amount <= $leftAmount) {
        $sql = "INSERT INTO `donations`(`donatedBy`, `donatedTo`, `amount`, `remark`) VALUES ('$donorID','$studentID','$amount','$remark')";
        $res = mysqli_query($con, $sql);
        if ($res) {
            $_SESSION["msg"] = 'You have successfully donated '. amountFormat($amount) .' to ' . $studentName . ', thank you for your supporting our students.';
            header("location: ../payment.php?studentID=$studentID");
        } else {
            $_SESSION["msg"] = 'Ooops Something went wrong'. mysqli_error($con);
            header("location: ../payment.php?studentID=$studentID");
        }
    } else {
        $_SESSION["msg"] = 'Invalid deposit amount. Please enter an amount between 500.00 and '. amountFormat($leftAmount) .'.';
        header("location: ../payment.php?studentID=$studentID");
    }
    
}

// Donate to department
else if (isset($_POST["payDepartment"])) {
    
    $donorID = $_POST["donorID"];
    $remark = (mysqli_real_escape_string($con, validate($_POST["remark"])));
    $amount = (mysqli_real_escape_string($con, validate($_POST["amount"])));

    if ($amount >= 500) {
        $sql = "INSERT INTO `wallet`(`donatedBy`, `amount`, `remark`) VALUES ('$donorID','$amount','$remark')";
        $res = mysqli_query($con, $sql);
        if ($res) {
            $_SESSION["msg"] = 'Your donation of '. amountFormat($amount) .' to the department has been successfully made';
            header("location: ../wallet.php");
        } else {
            $_SESSION["msg"] = 'Ooops Something went wrong'. mysqli_error($con);
            header("location: ../wallet.php");
        }
    } else {
        $_SESSION["msg"] = 'Invalid deposit amount. Amount is below the minimum amount';
        header("location: ../wallet.php");
    }
} else {
    $_SESSION["msg"] = 'Invalid request';
    header("location: ../donation-options.php");
}