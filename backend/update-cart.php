<?php
// backend/update-cart.php - Update cart item quantity
session_start();
header('Content-Type: application/json');

include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

$user_id = $_SESSION['user_id'];
$cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

if (!$cart_id || $quantity < 1) {
    echo json_encode(['success' => false, 'message' => 'Invalid cart ID or quantity']);
    exit;
}

// Verify cart item belongs to user
$verify = $conn->query("SELECT c.id, p.stock FROM cart c JOIN products p ON c.product_id = p.id WHERE c.id = " . $cart_id . " AND c.user_id = " . $user_id);

if (!$verify || $verify->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Cart item not found']);
    exit;
}

$cart = $verify->fetch_assoc();

if ($quantity > $cart['stock']) {
    echo json_encode(['success' => false, 'message' => 'Insufficient stock']);
    exit;
}

$conn->query("UPDATE cart SET quantity = " . $quantity . " WHERE id = " . $cart_id);

echo json_encode(['success' => true]);
?>
