<?php
require_once '../backend/config.php';

setJsonHeader();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request method');
}

$name = sanitize($_POST['name'] ?? '');
$email = sanitize($_POST['email'] ?? '');
$feedback_type = sanitize($_POST['feedback_type'] ?? '');
$rating = intval($_POST['rating'] ?? 0);
$message = sanitize($_POST['message'] ?? '');
$user_id = getCurrentUserId();

// Validation
if (empty($name) || empty($email) || empty($message)) {
    sendResponse(false, 'Name, email, and message are required');
}

if (!isValidEmail($email)) {
    sendResponse(false, 'Invalid email format');
}

if ($rating < 1 || $rating > 5) {
    sendResponse(false, 'Rating must be between 1 and 5');
}

// Insert feedback
$insertResult = $conn->query("
    INSERT INTO feedback (user_id, name, email, rating, feedback_type, message) 
    VALUES (" . ($user_id ? $user_id : 'NULL') . ", '$name', '$email', $rating, '$feedback_type', '$message')
");

if (!$insertResult) {
    sendResponse(false, 'Failed to submit feedback: ' . $conn->error);
}

sendResponse(true, 'Feedback submitted successfully');
?>
