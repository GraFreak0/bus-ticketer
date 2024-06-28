<?php
session_start();

// Redirect to login.php if the user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

include("pages/init.php");

// Check if the user is logged in
checkLoggedIn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/logo.jpg" type="image/gif" />
    <title> Homepage | BusApp</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-8K7ZVZPkhG2VJQ9s/Adk65l67xw8J9hchxTWaPCv9V0W+v7JrM7yA0ZJjAVQfNW6RNwV5V6QujwTnC0w06yMzA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>BusApp</h1>
            <nav>
                <a href="pages/logout.php" class="logout-btn">Logout</a>
            </nav>
        </header>
        
        <main>
            <div class="card-row">
                <div class="card" style="background-image: url('images/ijaiye.jpg');">
                    <div class="card-content">
                        <h2>Ijaiye</h2>
                        <a href="Ijaiye.php" class="card-link">Get a Ticket.</a>
                    </div>
                </div>
                <div class="card" style="background-image: url('images/lakowe.jpg');">
                    <div class="card-content">
                        <h2>Lakowe</h2>
                        <a href="Lakowe.php" class="card-link">Get a Ticket.</a>
                    </div>
                </div>
            </div>
        </main>

        <footer>
            <p>&copy; <?php echo date("Y"); ?> GhostDev. All rights reserved.</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/GhostDev" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/GhostDev" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/GhostDev" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>
        </footer>
    </div>
</body>
</html>
