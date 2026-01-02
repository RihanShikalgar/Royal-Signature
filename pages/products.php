<?php
// pages/products.php - Dynamic products listing page
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: /Royal-Signature/index.php');
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/backend/config.php';

// Get filter parameters
$category = isset($_GET['category']) ? sanitize($_GET['category']) : '';
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';

// Build query
$query = "SELECT * FROM products WHERE 1=1";

if ($category) {
    $query .= " AND category = '" . $category . "'";
}

if ($search) {
    $query .= " AND (name LIKE '%" . $search . "%' OR brand LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%')";
}

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Royal Signature</title>

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

<!-- Search and Filter Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <form method="GET" action="/Royal-Signature/pages/products.php" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="btn btn-gold">Search</button>
                </form>
            </div>
            <div class="col-md-6">
                <select class="form-select" onchange="window.location.href='/Royal-Signature/pages/products.php?category=' + this.value">
                    <option value="">All Categories</option>
                    <option value="Luxury" <?php echo $category === 'Luxury' ? 'selected' : ''; ?>>Luxury</option>
                    <option value="Premium" <?php echo $category === 'Premium' ? 'selected' : ''; ?>>Premium</option>
                    <option value="Classic" <?php echo $category === 'Classic' ? 'selected' : ''; ?>>Classic</option>
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid -->
<section class="py-5">
    <div class="container">
        <h1 class="mb-5">All Products</h1>

        <?php if ($result && $result->num_rows > 0): ?>
        <div class="row">
            <?php
            while ($product = $result->fetch_assoc()) {
                echo '
                <div class="col-md-4 mb-4">
                    <div class="card h-100 product-card">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($product['name']) . '</h5>
                            <p class="card-text text-muted">' . htmlspecialchars($product['brand']) . '</p>
                            <p class="card-text">' . substr(htmlspecialchars($product['description']), 0, 80) . '...</p>
                            <p class="card-text"><strong style="color: #d4af37;">₹' . number_format($product['price'], 2) . '</strong></p>
                            <span class="badge bg-success">' . ($product['stock'] > 0 ? 'In Stock' : 'Out of Stock') . '</span>
                            <br><br>
                            <a href="/Royal-Signature/pages/product-detail.php?id=' . $product['id'] . '" class="btn btn-sm btn-gold me-2">View Details</a>
                            <button class="btn btn-sm btn-outline-gold" onclick="addToCart(' . $product['id'] . ')" ' . ($product['stock'] > 0 ? '' : 'disabled') . '>
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
        <?php else: ?>
        <div class="alert alert-info text-center">
            <p>No products found. Try adjusting your search or filters.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/includes/footer.php'; ?>

<script>
function addToCart(productId) {
    fetch('/Royal-Signature/backend/add-to-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'product_id=' + productId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Product added to cart!');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    });
}
</script>

</body>
</html>
