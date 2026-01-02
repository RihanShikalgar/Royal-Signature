<?php
// pages/home.php - Dynamic homepage for logged in users
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: /Royal-Signature/index.php');
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/backend/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Signature - Home</title>

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

<!-- Hero Section -->
<section class="hero-section py-5 text-center text-white" style="background: linear-gradient(135deg, #1a1a1a 0%, #333 100%); padding: 80px 0;">
    <div class="container">
        <h1 style="font-family: 'Dancing Script', cursive; font-size: 48px; margin-bottom: 20px;">Welcome to Royal Signature</h1>
        <p class="lead">Discover the finest luxury perfumes from around the world</p>
        <a href="/Royal-Signature/pages/products.php" class="btn btn-gold mt-3">Shop Now</a>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Featured Products</h2>
        
        <div class="row">
            <?php
            $result = $conn->query("SELECT * FROM products LIMIT 6");
            if ($result && $result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) {
                    echo '
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 product-card" style="cursor: pointer;" onclick="window.location.href=\'/Royal-Signature/pages/product-detail.php?id=' . $product['id'] . '\'">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($product['name']) . '</h5>
                                <p class="card-text text-muted">' . htmlspecialchars($product['brand']) . '</p>
                                <p class="card-text">' . substr(htmlspecialchars($product['description']), 0, 100) . '...</p>
                                <p class="card-text"><strong style="color: #d4af37;">₹' . number_format($product['price'], 2) . '</strong></p>
                                <span class="badge bg-success">' . ($product['stock'] > 0 ? 'In Stock' : 'Out of Stock') . '</span>
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

<!-- Why Choose Us Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Why Choose Royal Signature?</h2>
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-gem fa-3x mb-3" style="color: #d4af37;"></i>
                <h5>Premium Quality</h5>
                <p>Authentic luxury fragrances sourced from the finest suppliers worldwide.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-shipping-fast fa-3x mb-3" style="color: #d4af37;"></i>
                <h5>Fast Delivery</h5>
                <p>Quick and secure shipping to your doorstep within 3-5 business days.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-shield-alt fa-3x mb-3" style="color: #d4af37;"></i>
                <h5>Secure Checkout</h5>
                <p>Your personal and payment information is always protected and secure.</p>
            </div>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/includes/footer.php'; ?>

</body>
</html>
