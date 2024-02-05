<?php
error_reporting(0);
include("./dbcon.php");
include("../function/random.php");
include("../function/validate.php");
include("../function/sendEmail.php");
session_start();
// SIGNIN

if (isset($_POST["login"])) {

    $username = mysqli_real_escape_string($con, validate($_POST["username"]));
    $password = (mysqli_real_escape_string($con, validate($_POST["password"])));

    $sql = "SELECT * FROM `user` WHERE (email = '$username' OR phone = '$username') AND password = '$password';";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) > 0) {
        $userData = mysqli_fetch_assoc($res);
        $_SESSION["token"] = $userData["id"];
        $_SESSION["role"] = $userData["role"];
        $_SESSION["name"] = $userData["name"];
        $_SESSION["email"] = $userData["email"];
        header("location: ../index.php");
    } else {
        $_SESSION["msg"] = 'Invalid login details';
        header("location: ../login.php");
        // echo 'Error';
    }
}

// Register

if (isset($_POST["register"])) {
    $fullname = mysqli_real_escape_string($con, validate($_POST["fullname"]));
    $emailAddress = (mysqli_real_escape_string($con, validate($_POST["emailAddress"])));
    $phoneNumber = (mysqli_real_escape_string($con, validate($_POST["phoneNumber"])));
    $password = (mysqli_real_escape_string($con, validate($_POST["password"])));    

    // check if email or phone number already exist
    $sql = "SELECT * FROM `donors` WHERE email = '$emailAddress' OR phone = '$phoneNumber';";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) > 0) {
        $_SESSION["msg"] = 'Email or phone number already exist';
        header("location: ../register.php");
        exit();
    }

    $sql = "INSERT INTO `donors`(`name`, `email`, `phone`, `password`) VALUES ('$fullname','$emailAddress','$phoneNumber','$password')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        sendWelcomeEmail($emailAddress, $fullname, $password);
        $_SESSION["msg"] = 'Your account created successfull, proceed to login';
        header("location: ../login.php");
    } else {
        $_SESSION["msg"] = '
        Oooops, something went wrong';
        header("location: ../register.php");
    }
}
