<?php
error_reporting(0);
include("./dbcon.php");
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
if (isset($_POST["updateStudent"])) {

    $id = mysqli_real_escape_string($con, validate($_POST["id"]));
    $name = mysqli_real_escape_string($con, validate($_POST["name"]));
    $phone = (mysqli_real_escape_string($con, validate($_POST["phone"])));
    $email = (mysqli_real_escape_string($con, validate($_POST["email"])));
    $gender = (mysqli_real_escape_string($con, validate($_POST["gender"])));
    $state = (mysqli_real_escape_string($con, validate($_POST["state"])));
    $lga = (mysqli_real_escape_string($con, validate($_POST["lga"])));
    $regNumber = (mysqli_real_escape_string($con, validate($_POST["regNumber"])));
    $level = (mysqli_real_escape_string($con, validate($_POST["level"])));
    $cgpa = (mysqli_real_escape_string($con, validate($_POST["cgpa"])));
    $disability = (mysqli_real_escape_string($con, validate($_POST["disability"])));

    if (empty($name) || empty($phone) || empty($email) || empty($gender) || empty($state) || empty($lga) || empty($regNumber) || empty($level) || empty($cgpa) || empty($disability)) {
        $_SESSION["msg"] = 'Please fill all fields before submitting'. $state . " ------ " . $lga;
        header("location: ../student-view.php?studentID=$id");
        exit();
    }

    if ($phone < 11) {
        $_SESSION["msg"] = 'Phone number must be 11 digits';
        header("location: ../student-view.php?studentID=$id");
        exit();
    }

    // check if regNo already exist
    $sql = "SELECT * FROM `students` WHERE regno = '$regNumber' AND id != '$id';";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) > 0) {
        $_SESSION["msg"] = 'Someone has been registered with this registration number';
        header("location: ../student-view.php?studentID=$id");
        exit();
    }

    $sql = "UPDATE `students` SET `name`='$name',`phone`='$phone',`email`='$email',`gender`='$gender',`state`='$state',`lga`='$lga',`regno`='$regNumber',`level`='$level',`cgpa`='$cgpa',`disability`='$disability' WHERE id = '$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = 'Student profile updated successfully';
        header("location: ../student-view.php?studentID=$id");
    } else {
        $_SESSION["msg"] = 'Oooops, something went wrong'. mysqli_error($con);
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
