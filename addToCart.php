<?php
session_start();

// Load existing cart or initialize
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get product ID and quantity from the request
$productID = $_POST['pid'] ?? null;
$quantity = $_POST['quantity'] ?? 1;

if ($productID) {
    // Add product to cart or update quantity
    if (isset($_SESSION['cart'][$productID])) {
        $_SESSION['cart'][$productID] += $quantity;
    } else {
        $_SESSION['cart'][$productID] = $quantity;
    }
    echo json_encode(["status" => "success", "message" => "Item added to cart"]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid product"]);
}
?>

<?php
// Apply discounts based on order count
$orderCount = getOrderCountByUser($user->id);
if ($orderCount % 20 == 0) {
    $discount = 0.2;
} elseif ($orderCount % 10 == 0) {
    $discount = 0.1;
} else {
    $discount = 0;
}
if ($discount > 0) {
    $totalPrice *= (1 - $discount);
    echo "<p>Discount applied: " . ($discount * 100) . "%</p>";
}
?>

<?php
// Refine discount logic to ensure proper application
$totalPriceBeforeDiscount = $totalPrice;
$discountMessage = "";
if ($discount > 0) {
    $discountAmount = $totalPrice * $discount;
    $totalPrice -= $discountAmount;
    $discountMessage = "<p>Discount of " . ($discount * 100) . "% applied: -" . number_format($discountAmount, 2) . "€</p>";
}
echo $discountMessage;
?>