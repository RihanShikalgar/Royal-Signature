<?php
// backend/remove-from-cart.php - Remove item from cart
session_start();
header('Content-Type: application/json');

include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

$user_id = $_SESSION['user_id'];
$cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;

if (!$cart_id) {
    echo json_encode(['success' => false, 'message' => 'Invalid cart ID']);
    exit;
}

// Verify cart item belongs to user
$verify = $conn->query("SELECT id FROM cart WHERE id = " . $cart_id . " AND user_id = " . $user_id);

if (!$verify || $verify->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Cart item not found']);
    exit;
}

$conn->query("DELETE FROM cart WHERE id = " . $cart_id);

echo json_encode(['success' => true]);
?>
