<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$ordersFile = 'json/orders.json';
$ordersData = json_decode(file_get_contents($ordersFile), true);

$dataFile = 'json/data.json';
$data = json_decode(file_get_contents($dataFile), true);

$products = [];
if (!empty($data['products'])) {
    foreach ($data['products'] as $product) {
        $products[$product['pid']] = $product;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['order_id'])) {
        $orderId = (int)$_POST['order_id'];
        $currentUser = $_SESSION['user'];

        if (isset($ordersData[$orderId]) && $ordersData[$orderId]['user'] === $currentUser) {
            if (!in_array($ordersData[$orderId]['status'], ['shipped', 'finished', 'canceled'])) {
                // Update the order status
                $ordersData[$orderId]['status'] = 'canceled';
                $ordersData[$orderId]['rejection_reason'] = 'Canceled by user';

                $orderProducts = $ordersData[$orderId]['cart'];
                $productNames = [];
                foreach ($orderProducts as $productId => $quantity) {
                    if (isset($products[$productId])) {
                        $productNames[] = $products[$productId]['name'];
                    }
                }
                $ordersData[$orderId]['canceled_products'] = $productNames;

                file_put_contents($ordersFile, json_encode($ordersData, JSON_PRETTY_PRINT));

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