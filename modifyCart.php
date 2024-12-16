<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$cartFile = './json/cart.json';
$carts = file_exists($cartFile) ? json_decode(file_get_contents($cartFile), true) : [];
$currentUser = $_SESSION['user'];

if (!isset($carts[$currentUser])) {
    $carts[$currentUser] = [];
}

$pid = intval($_POST['pid'] ?? null);
$action = $_POST['action'] ?? null;
$quantity = intval($_POST['quantity'] ?? 1);

if ($pid) {
    if ($action === 'update') {
        if ($quantity > 0) {
            $carts[$currentUser][$pid] = $quantity;
        } else {
            unset($carts[$currentUser][$pid]);
        }
    } elseif ($action === 'remove') {
        unset($carts[$currentUser][$pid]);
    }
}

file_put_contents($cartFile, json_encode($carts, JSON_PRETTY_PRINT));

$_SESSION['cart'] = $carts[$currentUser];

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>