<?php
// pages/product-detail.php - Dynamic product detail page
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: /Royal-Signature/index.php');
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/backend/config.php';

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$product_id) {
    header('Location: /Royal-Signature/pages/products.php');
    exit;
}

// Fetch product details
$result = $conn->query("SELECT * FROM products WHERE id = " . $product_id);

if (!$result || $result->num_rows === 0) {
    header('Location: /Royal-Signature/pages/products.php');
    exit;
}

$product = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Royal Signature</title>

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

<!-- Product Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <?php
                    $image = !empty($product['image_url']) ? htmlspecialchars($product['image_url']) : '/Royal-Signature/img/placeholder.png';
                    echo '<img src="' . $image . '" class="card-img-top" alt="' . htmlspecialchars($product['name']) . '" style="height: 500px; object-fit: cover;">';
                    ?>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-md-6">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="text-muted mb-3">
                    Brand: <strong><?php echo htmlspecialchars($product['brand']); ?></strong>
                </p>
                <p class="text-muted mb-3">
                    Category: <span class="badge bg-secondary"><?php echo htmlspecialchars($product['category']); ?></span>
                </p>

                <h3 style="color: #d4af37; margin: 20px 0;">₹<?php echo number_format($product['price'], 2); ?></h3>

                <div class="mb-4">
                    <strong>Stock Status:</strong><br>
                    <?php
                    if ($product['stock'] > 0) {
                        echo '<span class="badge bg-success">In Stock (' . $product['stock'] . ' available)</span>';
                    } else {
                        echo '<span class="badge bg-danger">Out of Stock</span>';
                    }
                    ?>
                </div>

                <div class="mb-4">
                    <h5>Description</h5>
                    <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                </div>

                <div class="mb-4">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" id="quantity" class="form-control" style="width: 100px;" value="1" min="1" max="<?php echo $product['stock']; ?>">
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-gold btn-lg" onclick="addToCart(<?php echo $product['id']; ?>)" <?php echo $product['stock'] > 0 ? '' : 'disabled'; ?>>
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                    <a href="/Royal-Signature/pages/products.php" class="btn btn-outline-dark btn-lg">
                        <i class="fas fa-arrow-left"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="row mt-5">
            <h3 class="mb-4">Related Products</h3>
            <?php
            $related = $conn->query("SELECT * FROM products WHERE brand = '" . sanitize($product['brand']) . "' AND id != " . $product_id . " LIMIT 4");
            if ($related && $related->num_rows > 0) {
                while ($rel_product = $related->fetch_assoc()) {
                    echo '
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 product-card">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($rel_product['name']) . '</h5>
                                <p class="card-text"><strong style="color: #d4af37;">₹' . number_format($rel_product['price'], 2) . '</strong></p>
                                <a href="/Royal-Signature/pages/product-detail.php?id=' . $rel_product['id'] . '" class="btn btn-sm btn-gold">View</a>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }
            ?>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/includes/footer.php'; ?>

<script>
function addToCart(productId) {
    const quantity = document.getElementById('quantity').value;
    
    fetch('/Royal-Signature/backend/add-to-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'product_id=' + productId + '&quantity=' + quantity
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Product added to cart!');
            window.location.href = '/Royal-Signature/pages/cart.php';
        } else {
            alert('Error: ' + data.message);
        }
    });
}
</script>

</body>
</html>
