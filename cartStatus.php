<?php
session_start();

// Check if the cart exists and has items
$hasItems = isset($_SESSION['cart']) && count($_SESSION['cart']) > 0;

// Return the result as JSON
header('Content-Type: application/json');
echo json_encode(['hasItems' => $hasItems]);
?>

<?php
// Display discount information on the cart page
if ($discount > 0) {
    echo "<p>A discount of " . ($discount * 100) . "% has been applied to your total.</p>";
}

// Show current order state for customer orders
if ($user->isLoggedIn()) {
    $orders = getOrdersByUser($user->id);
    foreach ($orders as $order) {
        echo "<div class='order'>";
        echo "<p>Order ID: " . $order['id'] . "</p>";
        echo "<p>Status: " . $order['status'] . "</p>";
        echo "</div>";
    }
}
?>

<?php
// Refined discount display in cart summary
if ($discount > 0) {
    $discountAmount = $totalPriceBeforeDiscount * $discount;
    echo "<p>Discount Applied: -" . number_format($discountAmount, 2) . "€</p>";
    echo "<p>Total After Discount: " . number_format($totalPrice, 2) . "€</p>";
}
?>