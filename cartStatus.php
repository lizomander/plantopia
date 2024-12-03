<?php
session_start();

// Check if the cart exists and has items
$hasItems = isset($_SESSION['cart']) && count($_SESSION['cart']) > 0;

// Return the result as JSON
header('Content-Type: application/json');
echo json_encode(['hasItems' => $hasItems]);
?>
