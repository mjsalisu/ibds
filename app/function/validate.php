<?php
    function validate ($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        // $input = mysqli_real_escape_string($input);
        return $input;
    }
?>