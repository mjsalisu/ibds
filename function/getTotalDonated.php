<?php
    function getTotalDonated($id, $con) {
        $sqlUser = "SELECT SUM(amount) AS total_donated FROM donations WHERE id = '$id'";
        $resultUser = mysqli_query($con, $sqlUser);
        $totalDonated = mysqli_fetch_assoc($resultUser);

        return $totalDonated;
    }
    
    // $userId = 5;
    // $user = getUserById($userId, $con);

    // echo $user["email"];
?>
