<?php
// error_reporting(E_ALL); 
// ini_set('display_errors', 1);
include 'conn.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Fetch user details from database
        $sql = "SELECT email, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($dbEmail, $hashed_password);
        $stmt->fetch();
        $stmt->close();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $dbEmail; // Store email in session
            echo "<script>alert('Login Successful'); window.location.href = '../';</script>";
        } else {
            echo "<script>alert('Invalid email or password'); window.location.href = '../login.php';</script>";
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'signup') {
        // Check if all fields are set and not empty
        if (empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['email']) || empty($_POST['password'])) {
            echo "<script>alert('All fields are required.'); window.location.href = '../login.php';</script>";
            exit;
        }

        $firstName = $conn->real_escape_string($_POST['firstName']);
        $lastName = $conn->real_escape_string($_POST['lastName']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        // Password strength regex pattern
        $strongPasswordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

        // Validate password strength
        if (!preg_match($strongPasswordPattern, $password)) {
        echo "<script>alert('Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&).'); window.location.href = '../login.php';</script>";
        exit;
        }
        
        // Check if the email already exists
        $sql = "SELECT email FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Email already exists.'); window.location.href = '../login.php';</script>";
            $stmt->close();
            $conn->close();
            exit;
        }

        // Check if the email domain is allowed
        if (!endsWith($email, '@ecobank.com')) {
            echo "<script>alert('Only emails from @ecobank.com domain are allowed.'); window.location.href = '../login.php';</script>";
            exit;
        }

        $stmt->close();

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $currentDateTime = date('Y-m-d H:i:s');

        // Prepare the statement
        $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, createdDt, modifiedDt) VALUES (?, ?, ?, ?, ?, ?)");

        // Check if the preparation was successful
        if ($stmt === false) {
            die('Error preparing the statement: ' . htmlspecialchars($conn->error));
        }

        // Bind parameters: "ssssss" means 6 strings
        if (!$stmt->bind_param("ssssss", $firstName, $lastName, $email, $hashedPassword, $currentDateTime, $currentDateTime)) {
            die('Error binding parameters: ' . htmlspecialchars($stmt->error));
        }

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['email'] = $email;
            echo "<script>alert('New user record created successfully'); window.location.href = '../login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = '../login.php';</script>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}
?>