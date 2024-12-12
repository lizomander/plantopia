<?php
session_start();

$pid = $_POST['pid'] ?? null;
$action = $_POST['action'] ?? null;
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

<?php
if (isset($_POST['cancel_order'])) {
    $orderId = $_POST['order_id'];
    $order = getOrderById($orderId);
    if ($order['status'] == 'ordered') {
        cancelOrder($orderId);
        echo "<p>Order cancelled successfully.</p>";
    } else {
        echo "<p>Cannot cancel an order that is already shipped or completed.</p>";
    }
}
?>

<?php
if ($order['status'] === 'ordered') {
    cancelOrder($orderId);
    echo "<p>Order ID $orderId successfully cancelled.</p>";
} else {
    echo "<p>Cancellation failed: Order is already " . htmlspecialchars($order['status']) . ".</p>";
}
?>