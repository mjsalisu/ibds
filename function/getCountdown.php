<?php

function getCountdown($targetDate) {
    // Target date
    $targetDate = strtotime($targetDate);

    // Current date and time
    $currentDate = time();

    // Calculate the difference in seconds
    $timeDiff = $targetDate - $currentDate;

    // Calculate remaining days, hours, minutes, and seconds
    $days = floor($timeDiff / (60 * 60 * 24));
    $hours = floor(($timeDiff % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($timeDiff % (60 * 60)) / 60);
    $seconds = $timeDiff % 60;

    // Return the countdown values as an array
    return array('days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $seconds);
}
?>