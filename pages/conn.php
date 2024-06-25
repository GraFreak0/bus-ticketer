<?php

// session_start(); // Ensure the session is started

// // Check if the user ID is set in the session
// if (!isset($_SESSION['email'])) {
//     echo json_encode(["error" => "User not logged in"]);
//     exit;
// }

date_default_timezone_set('Africa/Lagos');


$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$database = "busapp";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>