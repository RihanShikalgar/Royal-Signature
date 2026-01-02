<?php
// backend/update-profile.php - Update user profile
session_start();

include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /Royal-Signature/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /Royal-Signature/pages/profile.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$email = sanitize($_POST['email'] ?? '');
$full_name = sanitize($_POST['full_name'] ?? '');
$phone = sanitize($_POST['phone'] ?? '');
$address = sanitize($_POST['address'] ?? '');

if (empty($email) || empty($full_name)) {
    header('Location: /Royal-Signature/pages/profile.php?error=Email and full name are required');
    exit;
}

if (!isValidEmail($email)) {
    header('Location: /Royal-Signature/pages/profile.php?error=Invalid email format');
    exit;
}

// Check if email already exists for another user
$check = $conn->query("SELECT id FROM users WHERE email = '$email' AND id != " . $user_id);
if ($check && $check->num_rows > 0) {
    header('Location: /Royal-Signature/pages/profile.php?error=This email is already in use');
    exit;
}

$update = $conn->query("
    UPDATE users SET
    email = '$email',
    full_name = '$full_name',
    phone = '$phone',
    address = '$address'
    WHERE id = " . $user_id
);

if (!$update) {
    header('Location: /Royal-Signature/pages/profile.php?error=Failed to update profile');
    exit;
}

header('Location: /Royal-Signature/pages/profile.php?success=Profile updated successfully');
exit;
?>
