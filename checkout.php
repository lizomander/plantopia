<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Load product data
$data = json_decode(file_get_contents('./json/data.json'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error loading product data: " . json_last_error_msg());
}

$products = [];
foreach ($data['products'] as $product) {
    $products[$product['pid']] = $product;
}

// Load cart
$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    echo "Cart is empty!";
    exit;
}

// Calculate total server-side
$totalPrice = 0;
$taxRate = 0.19; // 19% tax
foreach ($cart as $pid => $quantity) {
    if (isset($products[$pid])) {
        $totalPrice += $products[$pid]['price'] * $quantity;
    }
}
$totalWithTax = $totalPrice * (1 + $taxRate);

// Save order to JSON
$order = [
    'user' => $_SESSION['user'],
    'cart' => $cart,
    'total' => $totalWithTax,
    'timestamp' => date('Y-m-d H:i:s'),
];

$ordersFile = './json/orders.json';
$orders = file_exists($ordersFile) ? json_decode(file_get_contents($ordersFile), true) : [];
$orders[] = $order;

file_put_contents($ordersFile, json_encode($orders, JSON_PRETTY_PRINT));

// Clear cart
unset($_SESSION['cart']);

echo "Order placed successfully!";
?>