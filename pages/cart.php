<?php
// pages/cart.php - Shopping cart page
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: /Royal-Signature/index.php');
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/backend/config.php';

$user_id = $_SESSION['user_id'];

// Fetch cart items
$cart_query = "
    SELECT c.id, c.quantity, p.id as product_id, p.name, p.price, p.stock
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = " . $user_id;

$result = $conn->query($cart_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Royal Signature</title>

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

<!-- Cart Section -->
<section class="py-5">
    <div class="container">
        <h1 class="mb-5">Shopping Cart</h1>

        <?php if ($result && $result->num_rows > 0): ?>
        <div class="row">
            <!-- Cart Items -->
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $subtotal = 0;
                            while ($item = $result->fetch_assoc()) {
                                $item_total = $item['price'] * $item['quantity'];
                                $subtotal += $item_total;
                                echo '
                                <tr>
                                    <td><a href="/Royal-Signature/pages/product-detail.php?id=' . $item['product_id'] . '">' . htmlspecialchars($item['name']) . '</a></td>
                                    <td>₹' . number_format($item['price'], 2) . '</td>
                                    <td>
                                        <input type="number" value="' . $item['quantity'] . '" min="1" max="' . $item['stock'] . '" class="form-control" style="width: 70px;" onchange="updateQuantity(' . $item['id'] . ', this.value)">
                                    </td>
                                    <td>₹' . number_format($item_total, 2) . '</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="removeFromCart(' . $item['id'] . ')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>₹<?php echo number_format($subtotal, 2); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax (10%):</span>
                                <span>₹<?php echo number_format($subtotal * 0.1, 2); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping:</span>
                                <span>₹100.00</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Total:</strong>
                                <strong style="color: #d4af37;">₹<?php echo number_format($subtotal + ($subtotal * 0.1) + 100, 2); ?></strong>
                            </div>
                        </div>
                        <form method="POST" action="/Royal-Signature/backend/place-order.php">
                            <div class="mb-3">
                                <label for="address" class="form-label">Shipping Address</label>
                                <textarea class="form-control" id="address" name="shipping_address" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-gold w-100" onclick="return confirm('Confirm order?')">
                                <i class="fas fa-check"></i> Place Order
                            </button>
                        </form>
                        <a href="/Royal-Signature/pages/products.php" class="btn btn-outline-dark w-100 mt-2">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php else: ?>
        <div class="alert alert-info text-center">
            <h5>Your cart is empty</h5>
            <p>Add some products to get started!</p>
            <a href="/Royal-Signature/pages/products.php" class="btn btn-gold">Browse Products</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/includes/footer.php'; ?>

<script>
function updateQuantity(cartId, quantity) {
    fetch('/Royal-Signature/backend/update-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'cart_id=' + cartId + '&quantity=' + quantity
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    });
}

function removeFromCart(cartId) {
    if (confirm('Remove this item from cart?')) {
        fetch('/Royal-Signature/backend/remove-from-cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'cart_id=' + cartId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        });
    }
}
</script>

</body>
</html>
