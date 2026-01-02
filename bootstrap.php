<?php
/**
 * Royal Signature Platform
 * Bootstrap/Entry Point
 */

// Start output buffering for consistent headers
ob_start();

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0); // Hide errors from users, log instead
ini_set('log_errors', 1);

// Enable strict session handling
ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);

// Set default timezone
date_default_timezone_set('UTC');

// Define base path
define('BASE_PATH', dirname(__FILE__));
define('BASE_URL', 'http://' . ($_SERVER['HTTP_HOST'] ?? 'localhost:8888'));

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_samesite', 'Lax');

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection wrapper
class Database {
    private static $instance = null;
    public $conn;
    
    private function __construct() {
        // Connection parameters
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'royal_signature';
        
        try {
            $this->conn = new mysqli($host, $user, $pass, $db);
            
            if ($this->conn->connect_error) {
                throw new Exception("Database Connection Failed: " . $this->conn->connect_error);
            }
            
            $this->conn->set_charset("utf8mb4");
        } catch (Exception $e) {
            die("Fatal Error: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
}

// Get database connection
$GLOBALS['db_conn'] = Database::getInstance()->getConnection();

// Helper functions
function sanitize($input) {
    global $db_conn;
    if (is_array($input)) {
        return array_map(function($item) { return sanitize($item); }, $input);
    }
    return $db_conn->real_escape_string(trim($input));
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

function redirectTo($path) {
    header('Location: ' . BASE_URL . $path);
    exit;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

function json_response($success, $message, $data = null) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

// Auto-require common files
$common_files = [
    'includes/header.php',
    'includes/footer.php'
];

foreach ($common_files as $file) {
    if (file_exists(BASE_PATH . '/' . $file)) {
        require_once BASE_PATH . '/' . $file;
    }
}

// Set up error handler
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return false;
    }
    
    $error_message = "Error: $errstr (File: $errfile, Line: $errline)";
    error_log($error_message);
    
    // For development, show errors. For production, hide them
    if (defined('DEBUG_MODE') && DEBUG_MODE) {
        echo "<pre>$error_message</pre>";
    }
    
    return true;
});

// Prevent output buffering issues
ob_end_clean();
?>
