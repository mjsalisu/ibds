<?php
    function getUserById($id, $con) {
        $sqlUser = "SELECT * FROM `user` WHERE id = '$id'";
        $resultUser = mysqli_query($con, $sqlUser);
        $userDataById = mysqli_fetch_assoc($resultUser);

        return $userDataById;
    }
    
    // $userId = 5;
    // $user = getUserById($userId, $con);

    // echo $user["email"];
?>
