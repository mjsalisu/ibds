<?php
    function getTotalDonated($id, $con) {
        $sqlUser = "SELECT SUM(amount) AS donated FROM donations WHERE donatedBy = '$id'";
        $resultUser = mysqli_query($con, $sqlUser);
        $totalDonated = mysqli_fetch_assoc($resultUser);

        if ($totalDonated["donated"] == null) {
             $totalDonated["donated"] = 0;
        }
        return $totalDonated;
    }

    function getTotalRaised($id, $con) {
        // $sqlUser = "SELECT SUM(amount) AS raised FROM donations WHERE donatedTo = '$id'";
        $sqlUser = "SELECT SUM(amount) AS raised, (SELECT COUNT(DISTINCT DonatedBy) FROM donations WHERE donatedTo ='$id') AS unique_donors FROM donations WHERE donatedTo ='$id';";
        $resultUser = mysqli_query($con, $sqlUser);
        $totalRaised = mysqli_fetch_assoc($resultUser);

        if ($totalRaised["donated"] == null) {
             $totalRaised["donated"] = 0;
        }
        return $totalRaised;
    }
    
    // $userId = 5;
    // $user = getUserById($userId, $con);

    // echo $user["email"];
?>
