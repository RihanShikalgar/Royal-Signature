<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /Royal-Signature/index.php');
    exit;
}

$username = sanitize($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    header('Location: /Royal-Signature/index.php?error=Username and password are required');
    exit;
}

// Check if user exists
$result = $conn->query("SELECT id, username, password FROM users WHERE username = '$username'");

if ($result->num_rows === 0) {
    header('Location: /Royal-Signature/index.php?error=Invalid username or password');
    exit;
}

$user = $result->fetch_assoc();

// Verify password
if (!verifyPassword($password, $user['password'])) {
    header('Location: /Royal-Signature/index.php?error=Invalid username or password');
    exit;
}

// Set session variables
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];

header('Location: /Royal-Signature/pages/home.php');
exit;

?>
