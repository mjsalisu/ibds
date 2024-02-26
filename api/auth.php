<?php
error_reporting(0);
include("./dbcon.php");
include("../function/random.php");
include("../function/validate.php");
// include("../function/sendEmail.php");
session_start();

// Login
if (isset($_POST["login"])) {

    $username = mysqli_real_escape_string($con, validate($_POST["username"]));
    $password = (mysqli_real_escape_string($con, validate($_POST["password"])));

    $sql = "SELECT * FROM `donors` WHERE (email = '$username' OR phone = '$username') AND password = '$password';";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) > 0) {
        $userData = mysqli_fetch_assoc($res);
        $_SESSION["token"] = $userData["id"];
        $_SESSION["email"] = $userData["email"];
        $_SESSION["role"] = $userData["role"];
        $_SESSION["name"] = $userData["name"];
        header("location: ../index.php");
    } else {
        $_SESSION["msg"] = 'Invalid login details';
        header("location: ../login.php");
    }
}

// Register Donor
if (isset($_POST["register"])) {
    $fullname = mysqli_real_escape_string($con, validate($_POST["fullname"]));
    $emailAddress = (mysqli_real_escape_string($con, validate($_POST["emailAddress"])));
    $phoneNumber = (mysqli_real_escape_string($con, validate($_POST["phoneNumber"])));
    $occupation = (mysqli_real_escape_string($con, validate($_POST["occupation"])));
    $password = (mysqli_real_escape_string($con, validate($_POST["password"])));    

    // check if email or phone number already exist
    $sql = "SELECT * FROM `donors` WHERE email = '$emailAddress' OR phone = '$phoneNumber';";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) > 0) {
        $_SESSION["msg"] = 'Email or phone number already exist';
        header("location: ../register.php");
        exit();
    }

    $sql = "INSERT INTO `donors` (name, email, phone, occupation, password) VALUES ('$fullname', '$emailAddress', '$phoneNumber', '$occupation', '$password')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        // sendWelcomeEmail($emailAddress, $fullname, $password);
        $_SESSION["msg"] = 'Your account created successfull, proceed to login';
        header("location: ../login.php");
    } else {
        $_SESSION["msg"] = 'Oooops, something went wrong'. mysqli_error($con);
        header("location: ../register.php");
    }
}
