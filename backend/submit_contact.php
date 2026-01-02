<?php
require_once '../backend/config.php';

setJsonHeader();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request method');
}

$name = sanitize($_POST['name'] ?? '');
$email = sanitize($_POST['email'] ?? '');
$message = sanitize($_POST['message'] ?? '');

// Validation
if (empty($name) || empty($email) || empty($message)) {
    sendResponse(false, 'Name, email, and message are required');
}

if (!isValidEmail($email)) {
    sendResponse(false, 'Invalid email format');
}

// Insert contact message
$insertResult = $conn->query("
    INSERT INTO contact_messages (name, email, message) 
    VALUES ('$name', '$email', '$message')
");

if (!$insertResult) {
    sendResponse(false, 'Failed to submit contact message: ' . $conn->error);
}

// Optional: Send email notification
// mail('contact@royalsignature.com', 'New Contact Message', "From: $name ($email)\n\nMessage: $message");

sendResponse(true, 'Contact message submitted successfully');
?>
