<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Load orders.json
$ordersFile = 'json/orders.json';
$ordersData = json_decode(file_get_contents($ordersFile), true);

// Load data.json to fetch product details
$dataFile = 'json/data.json';
$data = json_decode(file_get_contents($dataFile), true);

// Convert product data into an associative array with pid as the key
$products = [];
if (!empty($data['products'])) {
    foreach ($data['products'] as $product) {
        $products[$product['pid']] = $product;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['order_id'])) {
        $orderId = (int)$_POST['order_id'];
        $currentUser = $_SESSION['user'];

        // Check if the order exists and belongs to the user
        if (isset($ordersData[$orderId]) && $ordersData[$orderId]['user'] === $currentUser) {
            // Check if the order can be canceled
            if (!in_array($ordersData[$orderId]['status'], ['shipped', 'finished', 'canceled'])) {
                // Update the order status
                $ordersData[$orderId]['status'] = 'canceled';
                $ordersData[$orderId]['rejection_reason'] = 'Canceled by user';

                // Enrich order details with product names
                $orderProducts = $ordersData[$orderId]['cart']; // Example: ['1' => 2, '2' => 1]
                $productNames = [];
                foreach ($orderProducts as $productId => $quantity) {
                    if (isset($products[$productId])) {
                        $productNames[] = $products[$productId]['name'];
                    }
                }
                $ordersData[$orderId]['canceled_products'] = $productNames;

                // Save to file
                file_put_contents($ordersFile, json_encode($ordersData, JSON_PRETTY_PRINT));

                // Feedback
                $_SESSION['message'] = "Order successfully canceled.";
            } else {
                $_SESSION['message'] = "This order cannot be canceled.";
            }
        } else {
            $_SESSION['message'] = "Invalid order.";
        }
    } else {
        $_SESSION['message'] = "No order ID provided.";
    }

    header('Location: user.php');
    exit;
}
?>