<?php
// pages/about.php - About page
session_start();

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
    <title>About Us - Royal Signature</title>

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

<!-- About Section -->
<section class="py-5">
    <div class="container">
        <h1 class="mb-5 text-center" style="font-family: 'Dancing Script', cursive; font-size: 48px;">About Royal Signature</h1>

        <div class="row mb-5">
            <div class="col-md-6">
                <h3 class="mb-3">Our Story</h3>
                <p>Royal Signature was founded with a vision to bring the finest luxury perfumes from around the world to discerning customers. With over a decade of experience in the perfume industry, we pride ourselves on curating the most exclusive and authentic fragrances.</p>
                <p>Our mission is to provide not just fragrances, but an experience - a journey through the world of scents that tell stories of elegance, sophistication, and style.</p>
            </div>
            <div class="col-md-6">
                <div class="card" style="background: linear-gradient(135deg, #1a1a1a 0%, #333 100%); color: white;">
                    <div class="card-body text-center">
                        <h3 style="color: #d4af37; font-size: 36px;">10+</h3>
                        <p>Years of Experience</p>
                        <hr style="border-color: #d4af37;">
                        <h3 style="color: #d4af37; font-size: 36px;">1000+</h3>
                        <p>Happy Customers</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values Section -->
        <div class="row">
            <h3 class="mb-4 text-center">Our Values</h3>
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <i class="fas fa-gem fa-3x mb-3" style="color: #d4af37;"></i>
                    <h5>Quality</h5>
                    <p>We source only the finest and most authentic luxury perfumes to ensure the highest quality.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <i class="fas fa-handshake fa-3x mb-3" style="color: #d4af37;"></i>
                    <h5>Trust</h5>
                    <p>Our customers' trust is our most valuable asset, and we work hard to maintain it every single day.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <i class="fas fa-heart fa-3x mb-3" style="color: #d4af37;"></i>
                    <h5>Passion</h5>
                    <p>We are passionate about fragrances and about delivering exceptional service to our customers.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/includes/footer.php'; ?>

</body>
</html>
