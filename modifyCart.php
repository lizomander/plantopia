<?php
session_start();

$pid = $_POST['pid'] ?? null;
$action = $_POST['action'] ?? null; // 'update' or 'remove'
$quantity = $_POST['quantity'] ?? 1;

if ($pid && isset($_SESSION['cart'][$pid])) {
    if ($action === 'update') {
        if ($quantity > 0) {
            $_SESSION['cart'][$pid] = $quantity;
        } else {
            unset($_SESSION['cart'][$pid]);
        }
    } elseif ($action === 'remove') {
        unset($_SESSION['cart'][$pid]);
    }
}

header('Location: shoppingCart.php');
?>