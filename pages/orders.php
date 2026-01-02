<?php
// pages/orders.php - View user orders
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: /Royal-Signature/index.php');
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/backend/config.php';

$user_id = $_SESSION['user_id'];

// Get orders
$orders_result = $conn->query("
    SELECT id, order_date, total_amount, status, shipping_address
    FROM orders
    WHERE user_id = " . $user_id . "
    ORDER BY order_date DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Royal Signature</title>

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

<!-- Orders Section -->
<section class="py-5">
    <div class="container">
        <h1 class="mb-5">My Orders</h1>

        <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo htmlspecialchars($_GET['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if ($orders_result && $orders_result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($order = $orders_result->fetch_assoc()) {
                        $status_badge = 'warning';
                        if ($order['status'] === 'completed') $status_badge = 'success';
                        if ($order['status'] === 'cancelled') $status_badge = 'danger';
                        
                        echo '
                        <tr>
                            <td>#' . str_pad($order['id'], 6, '0', STR_PAD_LEFT) . '</td>
                            <td>' . date('M d, Y', strtotime($order['order_date'])) . '</td>
                            <td>₹' . number_format($order['total_amount'], 2) . '</td>
                            <td><span class="badge bg-' . $status_badge . '">' . ucfirst($order['status']) . '</span></td>
                            <td>
                                <a href="/Royal-Signature/pages/order-detail.php?id=' . $order['id'] . '" class="btn btn-sm btn-primary">
                                    View Details
                                </a>
                            </td>
                        </tr>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php else: ?>
        <div class="alert alert-info text-center">
            <h5>No orders yet</h5>
            <p>Start shopping to place your first order!</p>
            <a href="/Royal-Signature/pages/products.php" class="btn btn-gold">Shop Now</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/includes/footer.php'; ?>

</body>
</html>
