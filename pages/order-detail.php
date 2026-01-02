<?php
// pages/order-detail.php - View order details
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: /Royal-Signature/index.php');
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/backend/config.php';

$user_id = $_SESSION['user_id'];
$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Get order
$order_result = $conn->query("
    SELECT * FROM orders
    WHERE id = " . $order_id . " AND user_id = " . $user_id
);

if (!$order_result || $order_result->num_rows === 0) {
    header('Location: /Royal-Signature/pages/orders.php');
    exit;
}

$order = $order_result->fetch_assoc();

// Get order items
$items_result = $conn->query("
    SELECT oi.quantity, oi.price, p.name, p.brand
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = " . $order_id
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Royal Signature</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/Royal-Signature/css/style.css">
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/includes/header.php'; ?>

<!-- Order Details Section -->
<section class="py-5">
    <div class="container">
        <a href="/Royal-Signature/pages/orders.php" class="btn btn-outline-dark mb-4">
            <i class="fas fa-arrow-left"></i> Back to Orders
        </a>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Order #<?php echo str_pad($order['id'], 6, '0', STR_PAD_LEFT); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Order Date:</strong><br>
                                <?php echo date('M d, Y H:i', strtotime($order['order_date'])); ?>
                            </div>
                            <div class="col-md-6">
                                <strong>Status:</strong><br>
                                <?php
                                $status_badge = 'warning';
                                if ($order['status'] === 'completed') $status_badge = 'success';
                                if ($order['status'] === 'cancelled') $status_badge = 'danger';
                                echo '<span class="badge bg-' . $status_badge . '">' . ucfirst($order['status']) . '</span>';
                                ?>
                            </div>
                        </div>

                        <strong>Shipping Address:</strong><br>
                        <p><?php echo nl2br(htmlspecialchars($order['shipping_address'])); ?></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Order Items</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $items_total = 0;
                                    while ($item = $items_result->fetch_assoc()) {
                                        $item_total = $item['price'] * $item['quantity'];
                                        $items_total += $item_total;
                                        echo '
                                        <tr>
                                            <td>' . htmlspecialchars($item['name']) . '</td>
                                            <td>₹' . number_format($item['price'], 2) . '</td>
                                            <td>' . $item['quantity'] . '</td>
                                            <td>₹' . number_format($item_total, 2) . '</td>
                                        </tr>
                                        ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>₹<?php echo number_format($items_total, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax (10%):</span>
                            <span>₹<?php echo number_format($items_total * 0.1, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span>₹100.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Total:</strong>
                            <strong style="color: #d4af37;">₹<?php echo number_format($order['total_amount'], 2); ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/includes/footer.php'; ?>

</body>
</html>
