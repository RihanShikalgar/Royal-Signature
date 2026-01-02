<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /Royal-Signature/index.php');
    exit;
}

$username = sanitize($_POST['username'] ?? '');
$email = sanitize($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$full_name = sanitize($_POST['full_name'] ?? '');

// Validation
if (empty($username) || empty($email) || empty($password) || empty($full_name)) {
    header('Location: /Royal-Signature/index.php?error=All fields are required');
    exit;
}

if (!isValidEmail($email)) {
    header('Location: /Royal-Signature/index.php?error=Invalid email format');
    exit;
}

if (strlen($password) < 6) {
    header('Location: /Royal-Signature/index.php?error=Password must be at least 6 characters long');
    exit;
}

if ($password !== $confirm_password) {
    header('Location: /Royal-Signature/index.php?error=Passwords do not match');
    exit;
}

// Check if username or email already exists
$checkResult = $conn->query("SELECT id FROM users WHERE username = '$username' OR email = '$email'");

if ($checkResult->num_rows > 0) {
    header('Location: /Royal-Signature/index.php?error=Username or email already exists');
    exit;
}

// Hash password
$hashedPassword = hashPassword($password);

// Insert new user
$insertResult = $conn->query("INSERT INTO users (username, email, password, full_name) VALUES ('$username', '$email', '$hashedPassword', '$full_name')");

if (!$insertResult) {
    header('Location: /Royal-Signature/index.php?error=Signup failed');
    exit;
}

$user_id = $conn->insert_id;

// Set session variables
$_SESSION['user_id'] = $user_id;
$_SESSION['username'] = $username;

header('Location: /Royal-Signature/pages/home.php');
exit;
?>
