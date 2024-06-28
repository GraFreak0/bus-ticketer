<?php
// session_start();
include("pages/generate-lak.php");
// include("pages/init.php");

// Check if the user is logged in
// checkLoggedIn();

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

// Initialize $user_list to an empty array to avoid undefined variable notice
$user_list = [];

if (isset($user_list_from_generate_php)) {
    $user_list = $user_list_from_generate_php;
}

// Check if it's past 7:00 PM to reset database and disable form until 5:00 PM the next day
$current_time = new DateTime();
$target_time_end = new DateTime();
$target_time_end->setTime(19, 0, 0); // Set target time to 7:00 PM

if ($current_time > $target_time_end) {
    // Run db_table.php to reset database
    include("pages/db_table.php");

    // Disable the form until 5:00 PM the next day
    $platform_accessible = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Lakowe Bus Ticketing App">
    <meta property="og:description" content="This web application is built for Lakowe Staff Bus Ticketing">
    <meta property="og:image" content="/images/title-icon.jpg">
    <meta property="og:url" content="https://bus-ticket.rf.gd/index.php">
    <link rel="icon" href="/images/logo.jpg" type="image/gif" />
    <title>Lakowe | BusApp</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-8K7ZVZPkhG2VJQ9s/Adk65l67xw8J9hchxTWaPCv9V0W+v7JrM7yA0ZJjAVQfNW6RNwV5V6QujwTnC0w06yMzA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="pages/local_ip.js"></script>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Lakowe Bus Ticketing</h1>
        </header>
        <h2>Ticket Generator</h2>
        <?php if (!$platform_accessible): ?>
            <p>The platform will be accessible after 5:00 PM. Please check back later.</p>
        <?php else: ?>
            <?php if (isset($_SESSION['code_generated_today']) && $_SESSION['code_generated_today'] == date("Y-m-d")): ?>
                <p>You have already generated a code today. Please try again tomorrow.</p>
            <?php else: ?>
                <form id="generateForm" action="pages/generate-lak.php" method="POST">
                    <button type="submit" class="button">Generate Code</button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
        <div id="countdown"></div>
        <div id="platform-access" style="display: none;">Platform is accessible now.</div>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Date Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_list as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['code']) ?></td>
                        <td><?= htmlspecialchars($user['date_time']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <footer>
            <p>&copy; <?php echo date("Y"); ?> GhostDev. All rights reserved.</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/GhostDev" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/GhostDev" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/GhostDev" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>
        </footer>
    </div>
    <script src="/pages/countdown.js"></script>
    <script>
        // Function to enable or disable form based on platform accessibility
        function toggleFormAccessibility(accessible) {
            var submitButton = document.querySelector('button[type="submit"]');
            if (accessible) {
                submitButton.removeAttribute('disabled');
            } else {
                submitButton.setAttribute('disabled', 'disabled');
            }
        }

        // Update form accessibility initially
        toggleFormAccessibility(<?= $platform_accessible ? 'true' : 'false' ?>);
    </script>
</body>
</html>