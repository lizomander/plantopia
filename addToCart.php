<?php
session_start();

// Load existing cart or initialize
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get product ID and quantity from the request
$productID = $_POST['pid'] ?? null;
$quantity = $_POST['quantity'] ?? 1;

if ($productID) {
    // Add product to cart or update quantity
    if (isset($_SESSION['cart'][$productID])) {
        $_SESSION['cart'][$productID] += $quantity;
    } else {
        $_SESSION['cart'][$productID] = $quantity;
    }
    echo json_encode(["status" => "success", "message" => "Item added to cart"]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid product"]);
}
?>
