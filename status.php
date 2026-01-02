<?php
// This file tests all critical database connections and displays status
session_start();

include 'backend/config.php';

$status = [
    'database' => false,
    'tables' => [],
    'sample_data' => false,
    'php_version' => false,
    'extensions' => []
];

// Check PHP Version
$status['php_version'] = phpversion();

// Check Database Connection
try {
    if ($conn->connect_error) {
        $status['database'] = 'Error: ' . $conn->connect_error;
    } else {
        $status['database'] = 'Connected';
    }
} catch (Exception $e) {
    $status['database'] = 'Error: ' . $e->getMessage();
}

// Check Tables
$tables = ['users', 'products', 'cart', 'orders', 'order_items', 'feedback', 'contact_messages'];
foreach ($tables as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    $status['tables'][$table] = ($result && $result->num_rows > 0) ? 'OK' : 'Missing';
}

// Check Sample Data
$products = $conn->query("SELECT COUNT(*) as count FROM products");
if ($products) {
    $row = $products->fetch_assoc();
    $status['sample_data'] = $row['count'] . ' products';
}

// Check PHP Extensions
$required_extensions = ['mysqli', 'session', 'json'];
foreach ($required_extensions as $ext) {
    $status['extensions'][$ext] = extension_loaded($ext) ? 'Loaded' : 'Missing';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Status - Royal Signature</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; background: #f8f9fa; }
        .status-badge { padding: 5px 10px; border-radius: 5px; }
        .status-ok { background: #d4edda; color: #155724; }
        .status-error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h4>🔍 Royal Signature - System Status</h4>
        </div>
        <div class="card-body">
            <!-- Database Status -->
            <h5 class="mt-3">Database Connection</h5>
            <p>
                <span class="status-badge <?php echo ($status['database'] === 'Connected') ? 'status-ok' : 'status-error'; ?>">
                    <?php echo htmlspecialchars($status['database']); ?>
                </span>
            </p>

            <!-- PHP Version -->
            <h5 class="mt-3">PHP Version</h5>
            <p>
                <span class="status-badge status-ok">
                    PHP <?php echo htmlspecialchars($status['php_version']); ?>
                </span>
            </p>

            <!-- Tables -->
            <h5 class="mt-3">Database Tables</h5>
            <ul class="list-group">
                <?php foreach ($status['tables'] as $table => $status_val): ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span><?php echo $table; ?></span>
                    <span class="status-badge <?php echo ($status_val === 'OK') ? 'status-ok' : 'status-error'; ?>">
                        <?php echo $status_val; ?>
                    </span>
                </li>
                <?php endforeach; ?>
            </ul>

            <!-- Sample Data -->
            <h5 class="mt-3">Sample Data</h5>
            <p>
                <span class="status-badge status-ok">
                    <?php echo htmlspecialchars($status['sample_data']); ?>
                </span>
            </p>

            <!-- Extensions -->
            <h5 class="mt-3">PHP Extensions</h5>
            <ul class="list-group">
                <?php foreach ($status['extensions'] as $ext => $status_val): ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span><?php echo $ext; ?></span>
                    <span class="status-badge <?php echo ($status_val === 'Loaded') ? 'status-ok' : 'status-error'; ?>">
                        <?php echo $status_val; ?>
                    </span>
                </li>
                <?php endforeach; ?>
            </ul>

            <!-- Action Buttons -->
            <div class="mt-4">
                <a href="/Royal-Signature/index.php" class="btn btn-primary">Go to Login</a>
                <a href="/Royal-Signature/QUICK_START.md" class="btn btn-info">View Quick Start Guide</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
