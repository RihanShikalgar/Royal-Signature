<?php
// backend/submit-feedback.php - Handle feedback submissions
session_start();

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /Royal-Signature/pages/feedback.php');
    exit;
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$name = sanitize($_POST['name'] ?? '');
$email = sanitize($_POST['email'] ?? '');
$rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
$feedback_type = sanitize($_POST['feedback_type'] ?? '');
$message = sanitize($_POST['message'] ?? '');

if (empty($name) || empty($email) || $rating < 1 || empty($feedback_type) || empty($message)) {
    header('Location: /Royal-Signature/pages/feedback.php?error=All fields are required');
    exit;
}

if (!isValidEmail($email)) {
    header('Location: /Royal-Signature/pages/feedback.php?error=Invalid email format');
    exit;
}

if ($rating < 1 || $rating > 5) {
    header('Location: /Royal-Signature/pages/feedback.php?error=Invalid rating');
    exit;
}

$insert = $conn->query("
    INSERT INTO feedback (user_id, name, email, rating, feedback_type, message, created_at)
    VALUES (" . ($user_id ? $user_id : 'NULL') . ", '$name', '$email', $rating, '$feedback_type', '$message', NOW())
");

if (!$insert) {
    header('Location: /Royal-Signature/pages/feedback.php?error=Failed to submit feedback');
    exit;
}

header('Location: /Royal-Signature/pages/feedback.php?success=1');
exit;
?>
