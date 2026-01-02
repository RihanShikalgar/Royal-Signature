<?php
// backend/submit-contact.php - Handle contact form submissions
session_start();

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /Royal-Signature/pages/contact.php');
    exit;
}

$name = sanitize($_POST['name'] ?? '');
$email = sanitize($_POST['email'] ?? '');
$subject = sanitize($_POST['subject'] ?? '');
$message = sanitize($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    header('Location: /Royal-Signature/pages/contact.php?error=All fields are required');
    exit;
}

if (!isValidEmail($email)) {
    header('Location: /Royal-Signature/pages/contact.php?error=Invalid email format');
    exit;
}

$insert = $conn->query("
    INSERT INTO contact_messages (name, email, message, created_at)
    VALUES ('$name', '$email', '$message', NOW())
");

if (!$insert) {
    header('Location: /Royal-Signature/pages/contact.php?error=Failed to send message');
    exit;
}

header('Location: /Royal-Signature/pages/contact.php?success=1');
exit;
?>
