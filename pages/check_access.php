<?php
// Function to check if current time is between 5:00 PM and 7:00 PM
function isPlatformAccessible() {
    $current_time = new DateTime();
    $target_time_start = new DateTime();
    $target_time_start->setTime(17, 0, 0); // Set target time to 5:00 PM
    $target_time_end = new DateTime();
    $target_time_end->setTime(19, 0, 0); // Set target time to 7:00 PM

    return ($current_time >= $target_time_start && $current_time <= $target_time_end);
}

// Check if platform should be accessible
$platform_accessible = isPlatformAccessible();

// Check if it's past 7:00 PM to reset database and disable form until 5:00 PM the next day
$current_time = new DateTime();
$target_time_end = new DateTime();
$target_time_end->setTime(19, 0, 0); // Set target time to 7:00 PM

if ($current_time > $target_time_end) {
    // Run db_table.php to reset database
    include("db_table.php");

    // Platform is not accessible until 5:00 PM the next day
    $platform_accessible = false;
}

// Output JSON response
header('Content-Type: application/json');
echo json_encode(['platform_accessible' => $platform_accessible]);
?>