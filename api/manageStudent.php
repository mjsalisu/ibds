<?php
error_reporting(0);
include("./dbcon.php");
include("../function/random.php");
include("../function/validate.php");
// include("../function/sendEmail.php");
session_start();

if (isset($_POST["addStudent"])) {
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
        $_SESSION["msg"] = 'Please fill all fields before submitting';
        header("location: ../student-add.php");
        exit();
    }

    if ($phone < 11) {
        $_SESSION["msg"] = 'Phone number must be 11 digits';
        header("location: ../student-add.php");
        exit();
    }

    $sql = "INSERT INTO `students`(`name`, `phone`, `email`, `gender`, `state`, `lga`, `regno`, `level`, `cgpa`, `disability`) VALUES ('$name','$phone','$email','$gender','$state','$lga','$regNumber','$level','$cgpa','$disability')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = 'Student registered successfully';
        header("location: ../student-add.php");
    } else {
        $_SESSION["msg"] = 'Ooops Something went wrong'. mysqli_error($con);
        header("location: ../student-add.php");
    }
}

if (isset($_POST["uploadStudents"])) {
    $_SESSION["msg"] = "Coming soon";
    header("location: ../student-add.php");
}
