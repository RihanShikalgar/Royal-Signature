<?php
// pages/brands.php - Brands page
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /Royal-Signature/index.php');
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/backend/config.php';

// Get all unique brands
$brands_result = $conn->query("SELECT DISTINCT brand FROM products ORDER BY brand ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands - Royal Signature</title>

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

<!-- Brands Section -->
<section class="py-5">
    <div class="container">
        <h1 class="mb-5 text-center">Our Brands</h1>

        <div class="row">
            <?php
            if ($brands_result && $brands_result->num_rows > 0) {
                while ($brand = $brands_result->fetch_assoc()) {
                    // Get products count for this brand
                    $count_result = $conn->query("SELECT COUNT(*) as count FROM products WHERE brand = '" . sanitize($brand['brand']) . "'");
                    $count = $count_result->fetch_assoc()['count'];
                    
                    echo '
                    <div class="col-md-4 mb-4">
                        <a href="/Royal-Signature/pages/products.php?search=' . urlencode($brand['brand']) . '" class="text-decoration-none">
                            <div class="card h-100 brand-card" style="cursor: pointer; transition: all 0.3s;">
                                <div class="card-body text-center">
                                    <h5 class="card-title" style="color: #d4af37;">' . htmlspecialchars($brand['brand']) . '</h5>
                                    <p class="card-text text-muted">' . $count . ' Products</p>
                                    <button class="btn btn-sm btn-gold">Browse</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    ';
                }
            }
            ?>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/includes/footer.php'; ?>

</body>
</html>
