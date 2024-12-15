<?php
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Load cart data
$cartFile = './json/cart.json';
$carts = file_exists($cartFile) ? json_decode(file_get_contents($cartFile), true) : [];
$currentUser = $_SESSION['user'];

// Validate that the user's cart exists
if (!isset($carts[$currentUser])) {
    $carts[$currentUser] = [];
}

// Get POST data
$pid = intval($_POST['pid'] ?? null);
$action = $_POST['action'] ?? null;
$quantity = intval($_POST['quantity'] ?? 1);

// Perform the requested action
if ($pid) {
    if ($action === 'update') {
        if ($quantity > 0) {
            // Update the quantity
            $carts[$currentUser][$pid] = $quantity;
        } else {
            // Remove the item if quantity is 0 or less
            unset($carts[$currentUser][$pid]);
        }
    } elseif ($action === 'remove') {
        // Remove the item from the cart
        unset($carts[$currentUser][$pid]);
    }
}

// Save the updated cart back to the file
file_put_contents($cartFile, json_encode($carts, JSON_PRETTY_PRINT));

// Sync the updated cart with the session
$_SESSION['cart'] = $carts[$currentUser];

// Redirect back to the shopping cart page
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
