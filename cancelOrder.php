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

// Debug form submission
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