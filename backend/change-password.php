<?php
// backend/change-password.php - Change user password
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
$current_password = $_POST['current_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
    header('Location: /Royal-Signature/pages/profile.php?error=All password fields are required');
    exit;
}

if (strlen($new_password) < 6) {
    header('Location: /Royal-Signature/pages/profile.php?error=New password must be at least 6 characters');
    exit;
}

if ($new_password !== $confirm_password) {
    header('Location: /Royal-Signature/pages/profile.php?error=New passwords do not match');
    exit;
}

// Get user's current password hash
$user = $conn->query("SELECT password FROM users WHERE id = " . $user_id)->fetch_assoc();

// Verify current password
if (!verifyPassword($current_password, $user['password'])) {
    header('Location: /Royal-Signature/pages/profile.php?error=Current password is incorrect');
    exit;
}

// Hash new password
$hashed = hashPassword($new_password);

// Update password
$update = $conn->query("UPDATE users SET password = '$hashed' WHERE id = " . $user_id);

if (!$update) {
    header('Location: /Royal-Signature/pages/profile.php?error=Failed to change password');
    exit;
}

header('Location: /Royal-Signature/pages/profile.php?success=Password changed successfully');
exit;
?>
