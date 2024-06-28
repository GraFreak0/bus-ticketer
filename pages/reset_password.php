<?php
session_start();
include 'conn.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Password strength regex pattern
    $strongPasswordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    // Check if the passwords match
    if ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.location.href = '../reset.php';</script>";
        exit;
    }

    // Validate password strength
    if (!preg_match($strongPasswordPattern, $new_password)) {
        echo "<script>alert('Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&).'); window.location.href = '../reset.php';</script>";
        exit;
    }

    // Check if the email exists
    $sql = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo "<script>alert('Email does not exist.'); window.location.href = '../reset.php';</script>";
        $stmt->close();
        $conn->close();
        exit;
    }

    $stmt->close();

    // Hash the new password
    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
    $currentDateTime = date('Y-m-d H:i:s');

    // Update the user's password
    $stmt = $conn->prepare("UPDATE users SET password = ?, modifiedDt = ? WHERE email = ?");
    if ($stmt === false) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
    }

    if (!$stmt->bind_param("sss", $hashedPassword, $currentDateTime, $email)) {
        die('Error binding parameters: ' . htmlspecialchars($stmt->error));
    }

    if ($stmt->execute()) {
        echo "<script>alert('Password reset successfully'); window.location.href = '../login.php';</script>";
    } else {
        echo "<script>alert('Error updating password.'); window.location.href = '../reset.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
