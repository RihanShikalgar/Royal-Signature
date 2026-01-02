<?php
require_once '../backend/config.php';

setJsonHeader();

$result = $conn->query("SELECT id, name, brand, description, price, image_url, category, stock FROM products");

if (!$result) {
    sendResponse(false, 'Failed to fetch products: ' . $conn->error);
}

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

sendResponse(true, 'Products retrieved successfully', $products);
?>
