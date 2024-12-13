
<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$ordersFile = 'json/orders.json';
$ordersData = json_decode(file_get_contents($ordersFile), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $orderId = (int)$_POST['order_id'];
    $currentUser = $_SESSION['user'];

    // Check if the order belongs to the current user and is cancellable
    if (isset($ordersData[$orderId]) && $ordersData[$orderId]['user'] === $currentUser) {
        if ($ordersData[$orderId]['status'] === 'ordered') {
            $ordersData[$orderId]['status'] = 'canceled'; // Mark as canceled
            file_put_contents($ordersFile, json_encode($ordersData, JSON_PRETTY_PRINT));
            $_SESSION['message'] = "Order successfully canceled.";
            header('Location: user.php'); // Redirect back to user page
            exit;
        }
    }
}

// If anything fails, redirect back
$_SESSION['message'] = "Failed to cancel the order.";
header('Location: user.php');
?>
