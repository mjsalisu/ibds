<?php
    session_start();
    function checklogin() {
        if ($_SESSION["token"] == "") {
            $_SESSION["msg"] = 'Please login to access this page';
            header("location: ./login.php");
        }
    }

    function isAdmin() {
        if ($_SESSION["role"] != "0") {
            $_SESSION["msg"] = "You are not authorized to access this page";
            header("location: ./index.php");
        }
    }