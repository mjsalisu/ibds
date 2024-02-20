<?php
error_reporting(0);
include("./dbcon.php");
include("../function/random.php");
include("../function/validate.php");

session_start();

if (isset($_POST["updateDonor"])) {
    $id = mysqli_real_escape_string($con, validate($_POST["id"]));
    $name = mysqli_real_escape_string($con, validate($_POST["name"]));
    $phone = mysqli_real_escape_string($con, validate($_POST["phone"]));
    $email = mysqli_real_escape_string($con, validate($_POST["email"]));
    $occupation = mysqli_real_escape_string($con, validate($_POST["occupation"]));
    $about = mysqli_real_escape_string($con, validate($_POST["about"]));

    // return error if empty
    if (empty($name) || empty($phone) || empty($email) || empty($occupation)) {
        $_SESSION["msg"] = 'All fields are required';
        header("location: ../donor-profile.php");
        exit();
    }

    $sql = "UPDATE `donors` SET `name`='$name',`phone`='$phone',`email`='$email', `occupation`='$occupation', `about`='$about' WHERE id = '$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = 'Your account has been updated successfully';
        header("location: ../donor-profile.php");
    } else {
        $_SESSION["msg"] = 'Oooops, something went wrong'. mysqli_error($con);
        header("location: ../donor-profile.php");
    }
}

// Update profile
if (isset($_POST["updateProfile"])) {

    $id = mysqli_real_escape_string($con, validate($_POST["id"]));
    $regNumber = mysqli_real_escape_string($con, validate($_POST["regNumber"]));
    $faculty = (mysqli_real_escape_string($con, validate($_POST["faculty"])));
    $department = (mysqli_real_escape_string($con, validate($_POST["department"])));

    // return error if empty
    if (empty($regNumber) || empty($faculty) || empty($department)) {
        $_SESSION["msg"] = 'All fields are required';
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
        $_SESSION["msg"] = 'Your account has been updated successfully';
        header("location: ../student-view.php?studentID=$id");
    } else {
        $_SESSION["msg"] = 'Oooops, something went wrong';
        header("location: ../student-view.php?studentID=$id");
    }
}

// updating password
if (isset($_POST["changePass"])) {
    $id = mysqli_real_escape_string($con, validate($_POST["id"]));
    $newPassword = mysqli_real_escape_string($con, validate($_POST["newPassword"]));
    $confirmPassword = mysqli_real_escape_string($con, validate($_POST["confirmPassword"]));

    // return error if password does not match
    if ($newPassword != $confirmPassword) {
        $_SESSION["msg"] = 'Sorry, your password does not match';
        header("location: ../donor-profile.php");
        exit();
    }

    // if empty or less than 4 char, return error
    if (strlen($newPassword) < 4) {
        $_SESSION["msg"] = 'Your password must be at least 4 characters long';
        header("location: ../donor-profile.php");
        exit();
    }

    // update user password
    $sql = "UPDATE `donors` SET `password`='$newPassword' WHERE id = '$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = 'Your password has been updated successfully';
        header("location: ../donor-profile.php");
    } else {
        $_SESSION["msg"] = 'Oooops, something went wrong';
        header("location: ../donor-profile.php");
    }
}
