<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

ini_set('session.gc_maxlifetime', 300); // 300 seconds = 5 minutes

// Function to check if user is logged in (adjust as per your authentication mechanism)
function checkLoggedIn() {
    if (!isset($_SESSION['email'])) {
        header("Location: ../pages/logout.php");
        exit;
    }
}

// Function to check session timeout and redirect if inactive
function checkSessionTimeout() {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 300)) {
        header("Location: ../pages/logout.php");
        exit;
    }
    $_SESSION['last_activity'] = time(); // Update last activity time
}

// Call checkSessionTimeout on every page load
checkSessionTimeout();
