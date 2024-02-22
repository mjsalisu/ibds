<?php

$localhost = "localhost";
$username ="idbs_db";
$password = "idbs_db"; // AWT5wL0ZPsx7xjxJ0Hayjymaf1ZFM99A
$db = "idbs_db";
$current_timestamp = strtotime("now");
$timestamp = date("Y-m-d H:i:s", $current_timestamp);
// echo $timestamp;

$con = mysqli_connect($localhost, $username, $password, $db);
if (mysqli_connect_errno()) {
    echo "Something went wrong, chech Database: ". mysqli_connect_error();
} else {
    //echo "Database connected successfully";
}

function amountFormat($amount) {
    return number_format((float)$amount, 2, '.', ',');
}

function numberFormat($amount) {
    return number_format((float)$amount, 0, '.', ',');
}

?>