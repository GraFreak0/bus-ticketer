<?php
// session_start();
include("conn.php");

// Prepare statement to fetch firstName and lastName from database
$stmt = $conn->prepare("SELECT firstName, lastName FROM users WHERE email = ?");
$stmt->bind_param("s", $_SESSION['email']); // Bind email from session

// Execute statement
$stmt->execute();

// Bind result variables
$stmt->bind_result($firstName, $lastName);

// Fetch values
$stmt->fetch();

// Close statement
$stmt->close();

// Close database connection
$conn->close();

// Store fetched values in session
$_SESSION['firstName'] = $firstName;
$_SESSION['lastName'] = $lastName;
?>