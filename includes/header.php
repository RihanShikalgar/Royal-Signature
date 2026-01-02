<?php
// header.php - Navigation and header for all pages
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Header -->
<header class="d-flex align-items-center justify-content-between p-3 bg-dark text-white">
    <div class="d-flex align-items-center">
        <img src="/Royal-Signature/img/logo.png" alt="Royal Signature Logo" class="logo me-3" style="width: 50px; height: 50px;">
        <h1 class="brand-title mb-0" style="font-family: 'Dancing Script', cursive; font-size: 28px;">
            <a href="/Royal-Signature/" style="color: white; text-decoration: none;">Royal Signature</a>
        </h1>
    </div>
    
    <!-- Navigation -->
    <nav class="navbar-expand-lg">
        <ul class="navbar-nav d-flex gap-3">
            <li><a href="/Royal-Signature/" class="nav-link text-white">Home</a></li>
            <li><a href="/Royal-Signature/pages/products.php" class="nav-link text-white">Products</a></li>
            <li><a href="/Royal-Signature/pages/brands.php" class="nav-link text-white">Brands</a></li>
            <li><a href="/Royal-Signature/pages/about.php" class="nav-link text-white">About</a></li>
            <li><a href="/Royal-Signature/pages/contact.php" class="nav-link text-white">Contact</a></li>
            <li><a href="/Royal-Signature/pages/cart.php" class="nav-link text-white">
                <i class="fas fa-shopping-cart"></i> Cart
                <?php
                if (isset($_SESSION['user_id'])) {
                    $cart_count = 0;
                    include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/backend/config.php';
                    $result = $conn->query("SELECT SUM(quantity) as total FROM cart WHERE user_id = " . intval($_SESSION['user_id']));
                    if ($result) {
                        $row = $result->fetch_assoc();
                        $cart_count = $row['total'] ?? 0;
                    }
                    if ($cart_count > 0) {
                        echo "<span class='badge bg-danger'>$cart_count</span>";
                    }
                }
                ?>
            </a></li>
            <li>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<div class="dropdown d-inline">';
                    echo '<button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown">';
                    echo '<i class="fas fa-user"></i> ' . htmlspecialchars($_SESSION['username']) . '</button>';
                    echo '<ul class="dropdown-menu" aria-labelledby="userMenu">';
                    echo '<li><a class="dropdown-item" href="/Royal-Signature/pages/orders.php">My Orders</a></li>';
                    echo '<li><a class="dropdown-item" href="/Royal-Signature/pages/profile.php">Profile</a></li>';
                    echo '<li><hr class="dropdown-divider"></li>';
                    echo '<li><a class="dropdown-item" href="/Royal-Signature/backend/logout.php">Logout</a></li>';
                    echo '</ul>';
                    echo '</div>';
                } else {
                    echo '<a href="/Royal-Signature/" class="nav-link text-white">Login</a>';
                }
                ?>
            </li>
        </ul>
    </nav>
</header>
