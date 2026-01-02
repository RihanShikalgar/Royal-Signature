<?php
// Setup and Diagnostics Page
error_reporting(E_ALL);
ini_set('display_errors', 1);

$status = array(
    'php' => phpversion(),
    'server' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
    'mysql' => extension_loaded('mysqli') ? 'Installed' : 'NOT INSTALLED',
    'pdo' => extension_loaded('pdo') ? 'Installed' : 'NOT INSTALLED',
);

$db_error = $_GET['error'] ?? null;

// Try to connect to database
$db_connected = false;
$db_message = '';

try {
    $conn = new mysqli('localhost', 'root', '', 'royal_signature');
    if ($conn->connect_error) {
        $db_message = "Connection Failed: " . $conn->connect_error;
    } else {
        $db_connected = true;
        $db_message = "✅ Database Connected Successfully!";
        $conn->close();
    }
} catch (Exception $e) {
    $db_message = "Exception: " . $e->getMessage();
}

// Check if all files exist
$required_files = array(
    'backend/config.php' => file_exists('backend/config.php'),
    'pages/home.php' => file_exists('pages/home.php'),
    'includes/header.php' => file_exists('includes/header.php'),
    'includes/footer.php' => file_exists('includes/footer.php'),
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Signature - Setup & Diagnostics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container-custom {
            max-width: 800px;
            margin-top: 30px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            margin-bottom: 20px;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
            font-weight: bold;
        }
        .status-row {
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .status-row:last-child {
            border-bottom: none;
        }
        .status-ok {
            color: #28a745;
            font-weight: bold;
        }
        .status-error {
            color: #dc3545;
            font-weight: bold;
        }
        .status-warning {
            color: #ffc107;
            font-weight: bold;
        }
        .btn-custom {
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: bold;
            margin-top: 20px;
        }
        h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .solution {
            background: #f0f8ff;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin-top: 15px;
            border-radius: 5px;
        }
        .solution h5 {
            color: #667eea;
            margin-bottom: 10px;
        }
        .success-box {
            background: #d4edda;
            border: 2px solid #28a745;
            color: #155724;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .error-box {
            background: #f8d7da;
            border: 2px solid #dc3545;
            color: #721c24;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container container-custom">
    <h2>🔧 Royal Signature - System Diagnostics</h2>

    <!-- Database Connection Status -->
    <?php if ($db_connected): ?>
        <div class="success-box">
            ✅ <?php echo $db_message; ?> <br>
            <small style="font-size: 14px; margin-top: 10px; display: block;">
                Redirecting to login page...
            </small>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = '/Royal-Signature/index.php';
            }, 2000);
        </script>
    <?php else: ?>
        <div class="error-box">
            ❌ Database Connection Failed<br>
            <strong><?php echo htmlspecialchars($db_message); ?></strong>
        </div>
    <?php endif; ?>

    <!-- System Information -->
    <div class="card">
        <div class="card-header">
            📊 System Information
        </div>
        <div class="card-body">
            <div class="status-row">
                <span>PHP Version:</span>
                <span class="status-ok"><?php echo $status['php']; ?></span>
            </div>
            <div class="status-row">
                <span>Web Server:</span>
                <span class="status-ok"><?php echo htmlspecialchars($status['server']); ?></span>
            </div>
            <div class="status-row">
                <span>MySQLi Extension:</span>
                <span class="<?php echo $status['mysql'] === 'Installed' ? 'status-ok' : 'status-error'; ?>">
                    <?php echo $status['mysql']; ?>
                </span>
            </div>
            <div class="status-row">
                <span>PDO Extension:</span>
                <span class="<?php echo $status['pdo'] === 'Installed' ? 'status-ok' : 'status-warning'; ?>">
                    <?php echo $status['pdo']; ?>
                </span>
            </div>
        </div>
    </div>

    <!-- File Status -->
    <div class="card">
        <div class="card-header">
            📁 Required Files
        </div>
        <div class="card-body">
            <?php foreach ($required_files as $file => $exists): ?>
                <div class="status-row">
                    <span><?php echo $file; ?></span>
                    <span class="<?php echo $exists ? 'status-ok' : 'status-error'; ?>">
                        <?php echo $exists ? '✅ Found' : '❌ Missing'; ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Database Connection Status -->
    <div class="card">
        <div class="card-header">
            🗄️ Database Connection
        </div>
        <div class="card-body">
            <div class="status-row">
                <span>Status:</span>
                <span class="<?php echo $db_connected ? 'status-ok' : 'status-error'; ?>">
                    <?php echo $db_connected ? '✅ Connected' : '❌ Failed'; ?>
                </span>
            </div>
            <div class="status-row">
                <span>Message:</span>
                <span><?php echo htmlspecialchars($db_message); ?></span>
            </div>
            
            <?php if (!$db_connected): ?>
                <div class="solution">
                    <h5>🔧 How to Fix:</h5>
                    <ol>
                        <li>Open XAMPP Control Panel (C:\xampp\xampp-control.exe)</li>
                        <li>Click "Start" next to MySQL service</li>
                        <li>Wait for it to show "Running" status</li>
                        <li>Refresh this page (F5)</li>
                    </ol>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Action Buttons -->
    <div style="text-align: center; margin-top: 30px;">
        <button class="btn btn-primary btn-custom" onclick="location.reload();">
            🔄 Refresh Status
        </button>
        <?php if ($db_connected): ?>
            <button class="btn btn-success btn-custom" onclick="window.location.href='/Royal-Signature/index.php';">
                ✅ Go to Login
            </button>
        <?php endif; ?>
    </div>

    <!-- Debug Info -->
    <div class="card" style="margin-top: 30px;">
        <div class="card-header">
            🐛 Debug Information
        </div>
        <div class="card-body">
            <pre style="background: #f5f5f5; padding: 15px; border-radius: 5px; overflow-x: auto;">
Current URL: <?php echo $_SERVER['REQUEST_URI']; ?>
Document Root: <?php echo $_SERVER['DOCUMENT_ROOT']; ?>
Server Name: <?php echo $_SERVER['SERVER_NAME']; ?>
Server Port: <?php echo $_SERVER['SERVER_PORT']; ?>
            </pre>
        </div>
    </div>

</div>

</body>
</html>
