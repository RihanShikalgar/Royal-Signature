<?php
// index.php - Dynamic homepage with login or redirect
session_start();

// If user is already logged in, redirect to home page
if (isset($_SESSION['user_id'])) {
    header('Location: /Royal-Signature/pages/home.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Signature -> Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts (Cursive for Logo) -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Background Video -->
    <video autoplay muted loop class="bg-video">
        <source src="video/perfum blue.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Header -->
    <header class="d-flex align-items-center justify-content-between p-3">
        <div class="d-flex align-items-center">
            <img src="img/logo.png" alt="Royal Signature Logo" class="logo me-3">
            <h1 class="brand-title">Royal Signature</h1>
        </div>
        <a href="#signup-section" class="btn btn-outline-light">Sign Up</a>
    </header>

    <!-- Main Container -->
    <div class="container d-flex align-items-center justify-content-end min-vh-100">
    
        <!-- Login Form -->
        <div class="login-container p-4">
            <h3 class="logtitle text-center"><i class="fas fa-user-lock"></i> Login</h3>

            <div id="loginMessage"></div>

            <form id="loginForm" method="POST" action="backend/login.php">
                <div class="form-group mb-3">
                    <label for="username"><i class="fas fa-user"></i> Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                  <label for="password"><i class="fas fa-lock"></i> Password</label>
                  <div class="password-wrapper">
                      <input type="password" id="password" name="password" class="form-control" required>
                      <span class="toggle-password" onclick="togglePassword()">
                          <i class="fas fa-eye"></i>
                      </span>
                  </div>
              </div>

                <button type="submit" class="btn btn-gold w-100 mt-3">Log In</button>
                <button type="button" class="btn btn-outline-light w-100 mt-2" onclick="document.getElementById('signup-section').scrollIntoView({behavior: 'smooth'})">Sign Up</button>
            </form>
        </div>
    </div>

    <!-- Sign Up Section -->
    <div id="signup-section" class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container p-4">
                    <h3 class="logtitle text-center"><i class="fas fa-user-plus"></i> Sign Up</h3>

                    <div id="signupMessage"></div>

                    <form id="signupForm" method="POST" action="backend/signup.php">
                        <div class="form-group mb-3">
                            <label for="signup-username"><i class="fas fa-user"></i> Username</label>
                            <input type="text" id="signup-username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="signup-email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" id="signup-email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="signup-fullname"><i class="fas fa-id-card"></i> Full Name</label>
                            <input type="text" id="signup-fullname" name="full_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="signup-password"><i class="fas fa-lock"></i> Password</label>
                            <input type="password" id="signup-password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="signup-confirm-password"><i class="fas fa-lock"></i> Confirm Password</label>
                            <input type="password" id="signup-confirm-password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-gold w-100 mt-3">Create Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>
</html>
