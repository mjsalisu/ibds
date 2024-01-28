<?php
    session_start();
    function checklogin() {
        if ($_SESSION["token"] == "") {
            $_SESSION["msg"] = 'Please login to access this page';
            header("location: ./login.php");
        }
    }