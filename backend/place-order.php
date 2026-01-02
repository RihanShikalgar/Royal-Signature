<?php
// backend/place-order.php - Place an order
session_start();

include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /Royal-Signature/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /Royal-Signature/pages/cart.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$shipping_address = isset($_POST['shipping_address']) ? sanitize($_POST['shipping_address']) : '';

if (!$shipping_address) {
    header('Location: /Royal-Signature/pages/cart.php?error=Address required');
    exit;
}

// Get cart items
$cart_result = $conn->query("
    SELECT c.quantity, p.id as product_id, p.price
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = " . $user_id);

if (!$cart_result || $cart_result->num_rows === 0) {
    header('Location: /Royal-Signature/pages/cart.php?error=Cart is empty');
    exit;
}

// Calculate total
$total_amount = 0;
$items = [];
while ($item = $cart_result->fetch_assoc()) {
    $items[] = $item;
    $total_amount += $item['price'] * $item['quantity'];
}

// Add tax and shipping
$total_amount = ($total_amount * 1.1) + 100;

// Start transaction
$conn->begin_transaction();

try {
    // Create order
    $insert_order = $conn->query("
        INSERT INTO orders (user_id, total_amount, shipping_address)
        VALUES (" . $user_id . ", " . $total_amount . ", '" . $shipping_address . "')"
    );

    if (!$insert_order) {
        throw new Exception("Failed to create order");
    }

    $order_id = $conn->insert_id;

    // Add order items
    foreach ($items as $item) {
        $conn->query("
            INSERT INTO order_items (order_id, product_id, quantity, price)
            VALUES (" . $order_id . ", " . $item['product_id'] . ", " . $item['quantity'] . ", " . $item['price'] . ")"
        );
    }

    // Clear cart
    $conn->query("DELETE FROM cart WHERE user_id = " . $user_id);

    // Commit transaction
    $conn->commit();

    header('Location: /Royal-Signature/pages/orders.php?success=Order placed successfully');
    exit;

} catch (Exception $e) {
    $conn->rollback();
    header('Location: /Royal-Signature/pages/cart.php?error=' . urlencode($e->getMessage()));
    exit;
}
?>
