<?php
require_once '../backend/config.php';

setJsonHeader();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request method');
}

$action = sanitize($_POST['action'] ?? '');
$user_id = getCurrentUserId();

if (!$user_id) {
    sendResponse(false, 'User not logged in');
}

switch ($action) {
    case 'add':
        handleAddToCart($user_id);
        break;
    case 'remove':
        handleRemoveFromCart($user_id);
        break;
    case 'update':
        handleUpdateCart($user_id);
        break;
    case 'get':
        handleGetCart($user_id);
        break;
    case 'clear':
        handleClearCart($user_id);
        break;
    default:
        sendResponse(false, 'Invalid action');
}

function handleAddToCart($user_id) {
    global $conn;
    
    $product_id = intval($_POST['product_id'] ?? 0);
    $quantity = intval($_POST['quantity'] ?? 1);
    
    if ($product_id <= 0) {
        sendResponse(false, 'Invalid product ID');
    }
    
    // Check if product exists
    $productCheck = $conn->query("SELECT id FROM products WHERE id = $product_id");
    if ($productCheck->num_rows === 0) {
        sendResponse(false, 'Product not found');
    }
    
    // Check if product already in cart
    $cartCheck = $conn->query("SELECT id, quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id");
    
    if ($cartCheck->num_rows > 0) {
        // Update quantity
        $cartItem = $cartCheck->fetch_assoc();
        $newQuantity = $cartItem['quantity'] + $quantity;
        $conn->query("UPDATE cart SET quantity = $newQuantity WHERE user_id = $user_id AND product_id = $product_id");
    } else {
        // Add new item
        $conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)");
    }
    
    sendResponse(true, 'Product added to cart successfully');
}

function handleRemoveFromCart($user_id) {
    global $conn;
    
    $product_id = intval($_POST['product_id'] ?? 0);
    
    if ($product_id <= 0) {
        sendResponse(false, 'Invalid product ID');
    }
    
    $conn->query("DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id");
    
    sendResponse(true, 'Product removed from cart');
}

function handleUpdateCart($user_id) {
    global $conn;
    
    $product_id = intval($_POST['product_id'] ?? 0);
    $quantity = intval($_POST['quantity'] ?? 1);
    
    if ($product_id <= 0 || $quantity <= 0) {
        sendResponse(false, 'Invalid parameters');
    }
    
    $conn->query("UPDATE cart SET quantity = $quantity WHERE user_id = $user_id AND product_id = $product_id");
    
    sendResponse(true, 'Cart updated successfully');
}

function handleGetCart($user_id) {
    global $conn;
    
    $result = $conn->query("
        SELECT c.id, p.id as product_id, p.name, p.price, p.image_url, c.quantity 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = $user_id
    ");
    
    if (!$result) {
        sendResponse(false, 'Failed to fetch cart: ' . $conn->error);
    }
    
    $cartItems = [];
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }
    
    sendResponse(true, 'Cart retrieved successfully', $cartItems);
}

function handleClearCart($user_id) {
    global $conn;
    
    $conn->query("DELETE FROM cart WHERE user_id = $user_id");
    
    sendResponse(true, 'Cart cleared successfully');
}
?>
