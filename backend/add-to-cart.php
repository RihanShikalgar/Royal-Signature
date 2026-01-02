<?php
// backend/add-to-cart.php - Add product to cart
session_start();
header('Content-Type: application/json');

include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

if (!$product_id || $quantity < 1) {
    echo json_encode(['success' => false, 'message' => 'Invalid product or quantity']);
    exit;
}

// Check if product exists
$check = $conn->query("SELECT id, stock FROM products WHERE id = " . $product_id);
if (!$check || $check->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Product not found']);
    exit;
}

$product = $check->fetch_assoc();
if ($product['stock'] < $quantity) {
    echo json_encode(['success' => false, 'message' => 'Insufficient stock']);
    exit;
}

// Check if product already in cart
$cart_check = $conn->query("SELECT id, quantity FROM cart WHERE user_id = " . $user_id . " AND product_id = " . $product_id);

if ($cart_check && $cart_check->num_rows > 0) {
    // Update quantity
    $cart_item = $cart_check->fetch_assoc();
    $new_quantity = $cart_item['quantity'] + $quantity;
    
    if ($product['stock'] < $new_quantity) {
        echo json_encode(['success' => false, 'message' => 'Cannot add more, insufficient stock']);
        exit;
    }
    
    $conn->query("UPDATE cart SET quantity = " . $new_quantity . " WHERE id = " . $cart_item['id']);
} else {
    // Insert new cart item
    $conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES (" . $user_id . ", " . $product_id . ", " . $quantity . ")");
}

echo json_encode(['success' => true, 'message' => 'Product added to cart']);
?>
