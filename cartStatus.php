<?php
session_start();

if (isset($_GET['status']) && $_GET['status'] === 'json') {
    // JSON response for cart status
    $hasItems = isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0;
    $totalItems = $hasItems ? array_sum($_SESSION['cart']) : 0; // Calculate total items in the cart

    // Return the JSON response
    header('Content-Type: application/json');
    echo json_encode([
        'hasItems' => $hasItems,
        'totalItems' => $totalItems, // Include total item count
    ]);
    exit;
}

// HTML PART: Display discount and orders (kept intact)
?>

<?php
// Display discount information on the cart page
if (isset($discount) && $discount > 0) {
    echo "<p>A discount of " . ($discount * 100) . "% has been applied to your total.</p>";
}

// Show current order state for customer orders
if (isset($user) && $user->isLoggedIn()) {
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
// Display additional discount information
if (isset($discount) && $discount > 0) {
    $discountAmount = $totalPriceBeforeDiscount * $discount;
    echo "<p>Discount Applied: -" . number_format($discountAmount, 2) . "€</p>";
    echo "<p>Total After Discount: " . number_format($totalPrice, 2) . "€</p>";
}
?>