<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'royal_signature');

// Create Database Connection with better error handling
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check Connection
    if ($conn->connect_error) {
        // Store error for debugging
        $_SESSION['db_error'] = "Connection Failed: " . $conn->connect_error;
        // Redirect to setup if database not available
        if (basename($_SERVER['PHP_SELF']) !== 'setup.php') {
            header('Location: /Royal-Signature/setup.php?error=db_connection');
            exit;
        }
        die("Connection Failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    $_SESSION['db_error'] = $e->getMessage();
    if (basename($_SERVER['PHP_SELF']) !== 'setup.php') {
        header('Location: /Royal-Signature/setup.php?error=exception');
        exit;
    }
    die("Exception: " . $e->getMessage());
}

// Set Charset
$conn->set_charset("utf8");

// Start Session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Function to sanitize input
function sanitize($input) {
    global $conn;
    return $conn->real_escape_string(trim($input));
}

// Function to validate email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to hash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// Function to verify password
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Function to set response header for JSON
function setJsonHeader() {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Content-Type');
}

// Function to send JSON response
function sendResponse($success, $message, $data = null) {
    setJsonHeader();
    $response = [
        'success' => $success,
        'message' => $message
    ];
    if ($data !== null) {
        $response['data'] = $data;
    }
    echo json_encode($response);
    exit;
}

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to get current user ID
function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

// Function to redirect to login if not authenticated
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /login.html');
        exit;
    }
}
?>
