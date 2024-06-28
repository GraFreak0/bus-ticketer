<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | BusApp</title>
    <link rel="stylesheet" href="css/login-styles.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        function validateForm() {
            var newPassword = document.getElementById("new-password").value;
            var confirmPassword = document.getElementById("confirm-password").value;
            
            // Password strength regex pattern
            var strongPasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            
            if (!strongPasswordPattern.test(newPassword)) {
                alert("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&).");
                return false;
            }
            
            if (newPassword !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="forms">
            <div class="form-content">
                <div class="reset-password-form">
                    <div class="title">Reset Password</div>
                    <form action="pages/reset_password.php" method="POST" onsubmit="return validateForm()">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input id="email" name="email" type="text" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input id="new-password" name="new_password" type="password" placeholder="Enter your new password" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input id="confirm-password" name="confirm_password" type="password" placeholder="Confirm your new password" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>