<?php
error_reporting(0);
include("./dbcon.php");
include("../function/random.php");
include("../function/validate.php");

session_start();

// Update profile
if (isset($_POST["updateProfile"])) {

    $id = mysqli_real_escape_string($con, validate($_POST["id"]));
    $regNumber = mysqli_real_escape_string($con, validate($_POST["regNumber"]));
    $faculty = (mysqli_real_escape_string($con, validate($_POST["faculty"])));
    $department = (mysqli_real_escape_string($con, validate($_POST["department"])));

    // return error if empty
    if (empty($regNumber) || empty($faculty) || empty($department)) {
        $_SESSION["msg"] = '
        All fields are required';
        header("location: ../student-view.php?studentID=$id");
        exit();
    }

    // check if regNo already exist
    $sql = "SELECT * FROM `user` WHERE regNo = '$regNumber' AND id != '$id';";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) > 0) {
        $_SESSION["msg"] = 'Someone already registered with this registration number';
        header("location: ../student-view.php?studentID=$id");
        exit();
    }

    $sql = "UPDATE `user` SET `regNo`='$regNumber',`faculty`='$faculty',`department`='$department' WHERE id = '$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = '
        Your account has been updated successfully';
        header("location: ../student-view.php?studentID=$id");
    } else {
        $_SESSION["msg"] = '
        Oooops, something went wrong';
        header("location: ../student-view.php?studentID=$id");
    }
}

// updating password
if (isset($_POST["changePass"])) {
    $id = mysqli_real_escape_string($con, validate($_POST["id"]));
    $newPassword = mysqli_real_escape_string($con, validate($_POST["newPassword"]));

    // if empty or less than 4 char, return error
    if (strlen($newPassword) < 4) {
        $_SESSION["msg"] = '
        Password must be at least 4 characters';
        header("location: ../profile.php");
        exit();
    }

    // update user password
    $sql = "UPDATE `user` SET `password`='$newPassword' WHERE id = '$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = '
        Your password has been updated successfully';
        header("location: ../profile.php");
    } else {
        $_SESSION["msg"] = '
        Oooops, something went wrong';
        header("location: ../profile.php");
    }
}
