<?php
require_once '../backend/config.php';

setJsonHeader();

requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request method');
}

$user_id = getCurrentUserId();
$total_amount = floatval($_POST['total_amount'] ?? 0);
$shipping_address = sanitize($_POST['shipping_address'] ?? '');

if ($total_amount <= 0) {
    sendResponse(false, 'Invalid order total');
}

if (empty($shipping_address)) {
    sendResponse(false, 'Shipping address is required');
}

// Start transaction
$conn->begin_transaction();

try {
    // Create order
    $insertOrder = $conn->query("
        INSERT INTO orders (user_id, total_amount, shipping_address) 
        VALUES ($user_id, $total_amount, '$shipping_address')
    ");
    
    if (!$insertOrder) {
        throw new Exception('Failed to create order: ' . $conn->error);
    }
    
    $order_id = $conn->insert_id;
    
    // Get cart items
    $cartResult = $conn->query("
        SELECT c.product_id, p.price, c.quantity 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = $user_id
    ");
    
    if (!$cartResult) {
        throw new Exception('Failed to fetch cart items: ' . $conn->error);
    }
    
    // Insert order items
    while ($item = $cartResult->fetch_assoc()) {
        $product_id = $item['product_id'];
        $price = $item['price'];
        $quantity = $item['quantity'];
        
        $insertItem = $conn->query("
            INSERT INTO order_items (order_id, product_id, quantity, price) 
            VALUES ($order_id, $product_id, $quantity, $price)
        ");
        
        if (!$insertItem) {
            throw new Exception('Failed to add order item: ' . $conn->error);
        }
    }
    
    // Clear cart
    $conn->query("DELETE FROM cart WHERE user_id = $user_id");
    
    // Commit transaction
    $conn->commit();
    
    sendResponse(true, 'Order placed successfully', ['order_id' => $order_id]);
    
} catch (Exception $e) {
    // Rollback transaction
    $conn->rollback();
    sendResponse(false, $e->getMessage());
}
?>
