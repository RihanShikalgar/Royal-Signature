<?php
// Navigation helper page for development
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Signature - Development Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1a1a1a 0%, #333 100%); color: #fff; }
        .dashboard { padding: 40px 20px; }
        .card { background: rgba(255,255,255,0.1); border: 1px solid #d4af37; }
        .card-header { background: #d4af37; color: #000; font-weight: bold; }
        .btn-gold { background: #d4af37; color: #000; }
        .btn-gold:hover { background: #b8941f; color: #000; }
        h1 { font-family: 'Dancing Script', cursive; color: #d4af37; }
        .feature-icon { font-size: 30px; }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<div class="dashboard">
    <div class="container">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 style="font-size: 48px;"><i class="fas fa-crown"></i> Royal Signature</h1>
            <p class="lead">Luxury Perfume E-Commerce Platform - Development Dashboard</p>
            <hr style="border-color: #d4af37;">
        </div>

        <!-- Quick Links -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-rocket"></i> Quick Start
                    </div>
                    <div class="card-body">
                        <a href="/Royal-Signature/index.php" class="btn btn-gold btn-block w-100 mb-2">
                            <i class="fas fa-sign-in-alt"></i> Go to Login
                        </a>
                        <a href="/Royal-Signature/status.php" class="btn btn-outline-light btn-block w-100 mb-2">
                            <i class="fas fa-heartbeat"></i> Check System Status
                        </a>
                        <p class="mt-3 mb-0">
                            <strong>Test Credentials:</strong><br>
                            Username: <code>testuser</code><br>
                            Password: <code>password123</code>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-book"></i> Documentation
                    </div>
                    <div class="card-body">
                        <a href="/Royal-Signature/QUICK_START.md" class="btn btn-outline-light btn-block w-100 mb-2">
                            ⚡ Quick Start Guide
                        </a>
                        <a href="/Royal-Signature/GETTING_STARTED.md" class="btn btn-outline-light btn-block w-100 mb-2">
                            📚 Getting Started
                        </a>
                        <a href="/Royal-Signature/CONVERSION_COMPLETE.md" class="btn btn-outline-light btn-block w-100">
                            ✅ Conversion Summary
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="row mb-4">
            <h2 class="mb-4"><i class="fas fa-star"></i> Available Features</h2>

            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3"><i class="fas fa-lock" style="color: #d4af37;"></i></div>
                        <h5>Authentication</h5>
                        <p class="small">Login • Signup • Password Change</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3"><i class="fas fa-shopping-bag" style="color: #d4af37;"></i></div>
                        <h5>Shopping</h5>
                        <p class="small">Cart • Checkout • Orders</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3"><i class="fas fa-user" style="color: #d4af37;"></i></div>
                        <h5>User Management</h5>
                        <p class="small">Profile • Orders • Feedback</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pages & Endpoints -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-file-code"></i> Frontend Pages (11)
                    </div>
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-file"></i> <code>index.php</code> - Login/Signup</li>
                            <li><i class="fas fa-file"></i> <code>pages/home.php</code> - Dashboard</li>
                            <li><i class="fas fa-file"></i> <code>pages/products.php</code> - Products</li>
                            <li><i class="fas fa-file"></i> <code>pages/product-detail.php</code> - Details</li>
                            <li><i class="fas fa-file"></i> <code>pages/cart.php</code> - Cart</li>
                            <li><i class="fas fa-file"></i> <code>pages/orders.php</code> - Orders</li>
                            <li><i class="fas fa-file"></i> <code>pages/profile.php</code> - Profile</li>
                            <li><i class="fas fa-file"></i> <code>pages/about.php</code> - About</li>
                            <li><i class="fas fa-file"></i> <code>pages/brands.php</code> - Brands</li>
                            <li><i class="fas fa-file"></i> <code>pages/contact.php</code> - Contact</li>
                            <li><i class="fas fa-file"></i> <code>pages/feedback.php</code> - Feedback</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-cogs"></i> Backend Handlers (12)
                    </div>
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-cog"></i> <code>login.php</code> - Login handler</li>
                            <li><i class="fas fa-cog"></i> <code>signup.php</code> - Registration</li>
                            <li><i class="fas fa-cog"></i> <code>logout.php</code> - Logout</li>
                            <li><i class="fas fa-cog"></i> <code>add-to-cart.php</code> - Add cart item</li>
                            <li><i class="fas fa-cog"></i> <code>update-cart.php</code> - Update quantity</li>
                            <li><i class="fas fa-cog"></i> <code>remove-from-cart.php</code> - Remove item</li>
                            <li><i class="fas fa-cog"></i> <code>place-order.php</code> - Create order</li>
                            <li><i class="fas fa-cog"></i> <code>submit-contact.php</code> - Contact form</li>
                            <li><i class="fas fa-cog"></i> <code>submit-feedback.php</code> - Feedback</li>
                            <li><i class="fas fa-cog"></i> <code>update-profile.php</code> - Profile update</li>
                            <li><i class="fas fa-cog"></i> <code>change-password.php</code> - Password</li>
                            <li><i class="fas fa-cog"></i> <code>config.php</code> - Database config</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Database Info -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-database"></i> Database Tables (7)
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-2"><strong>users</strong> - User accounts</div>
                            <div class="col-md-3 mb-2"><strong>products</strong> - Product catalog (6 items)</div>
                            <div class="col-md-3 mb-2"><strong>cart</strong> - Shopping carts</div>
                            <div class="col-md-3 mb-2"><strong>orders</strong> - Orders history</div>
                            <div class="col-md-3 mb-2"><strong>order_items</strong> - Order details</div>
                            <div class="col-md-3 mb-2"><strong>feedback</strong> - Feedback submissions</div>
                            <div class="col-md-3 mb-2"><strong>contact_messages</strong> - Contact form</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Final Action -->
        <div class="text-center mb-4">
            <div class="card bg-success border-0">
                <div class="card-body">
                    <h3 class="mb-3"><i class="fas fa-check-circle"></i> Everything is Ready!</h3>
                    <p class="mb-3">Your website has been successfully converted from static HTML to a fully dynamic e-commerce platform.</p>
                    <a href="/Royal-Signature/index.php" class="btn btn-light btn-lg">
                        <i class="fas fa-sign-in-alt"></i> Start Using the Platform
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="text-center mt-5 pt-5 border-top" style="border-color: #d4af37 !important;">
            <p class="text-muted">
                <small>
                    Royal Signature Luxury Perfume E-Commerce Platform<br>
                    Status: <strong style="color: #d4af37;">✅ Production Ready</strong><br>
                    Database: <strong style="color: #d4af37;">✅ Connected</strong><br>
                    Generated: January 2, 2026
                </small>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
