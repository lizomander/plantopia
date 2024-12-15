<?php
session_start();

// Redirect to login if no user is logged in
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// File for storing cart data
$cartFile = './json/cart.json';
$carts = file_exists($cartFile) ? json_decode(file_get_contents($cartFile), true) : [];
$currentUser = $_SESSION['user'];

// Initialize the user's cart if it doesn't exist
if (!isset($carts[$currentUser])) {
    $carts[$currentUser] = [];
}

// Handle POST request to add items to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = intval($_POST['pid'] ?? null);
    $quantity = intval($_POST['quantity'] ?? 1);

    // Validate product ID and quantity
    if ($pid <= 0 || $quantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid product or quantity']);
        exit;
    }

    // Add to cart or update quantity
    if (!isset($carts[$currentUser][$pid])) {
        $carts[$currentUser][$pid] = 0;
    }
    $carts[$currentUser][$pid] += $quantity;

    // Save the updated cart to the file
    if (file_put_contents($cartFile, json_encode($carts, JSON_PRETTY_PRINT))) {
        echo json_encode(['success' => true, 'message' => 'Item added to cart']);
        } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save cart']);
    }
    exit;
}

// Default error response
echo json_encode(['success' => false, 'message' => 'Invalid request']);
?>