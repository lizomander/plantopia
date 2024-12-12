<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Load product data
$data = json_decode(file_get_contents('./json/data.json'), true);
$products = [];
foreach ($data['products'] as $product) {
    $products[$product['pid']] = $product;
}

// Load cart
$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    echo "Cart is empty!";
    exit;
}

// Calculate total price
$totalPrice = 0;
$taxRate = 0.19; // 19% tax
foreach ($cart as $pid => $quantity) {
    if (isset($products[$pid])) {
        $totalPrice += $products[$pid]['price'] * $quantity;
    }
}

// Calculate total quantity in the cart
$totalQuantity = array_sum($cart);

// Apply discount based on the total quantity of items in the cart
$discount = 0;
if ($totalQuantity >= 20) {
    $discount = 0.2; // 20% discount for 20 or more items
} elseif ($totalQuantity >= 10) {
    $discount = 0.1; // 10% discount for 10 or more items
}

// Calculate discount and apply to the total price
$totalPriceBeforeDiscount = $totalPrice;
if ($discount > 0) {
    $discountAmount = $totalPrice * $discount;
    $totalPrice -= $discountAmount;
}

// Calculate tax and final total
$totalWithTax = $totalPrice * (1 + $taxRate);

// Prepare the order
$order = [
    'user' => $_SESSION['user'],
    'cart' => $cart,
    'total' => $totalWithTax,
    'discount' => $discount,
    'timestamp' => date('Y-m-d H:i:s'),
];

// Save the order to the orders file
$ordersFile = './json/orders.json';
$orders = file_exists($ordersFile) ? json_decode(file_get_contents($ordersFile), true) : [];
$orders[] = $order;

file_put_contents($ordersFile, json_encode($orders, JSON_PRETTY_PRINT));

// Clear the cart session
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="./css/design.css">
    <link rel="stylesheet" href="./css/layout.css">
</head>
<body>
    <header>
        <h1>Thank You for Your Order!</h1>
    </header>
    <main>
        <div class="container">
            <div class="confirmation-card">
                <h2>Order Summary</h2>
                <table>
                    <tr>
                        <td><strong>Total Before Discount:</strong></td>
                        <td><?php echo number_format($totalPriceBeforeDiscount, 2); ?>€</td>
                    </tr>
                    <?php if ($discount > 0): ?>
                    <tr>
                        <td><strong>Discount Applied:</strong></td>
                        <td>-<?php echo number_format($discountAmount, 2); ?>€ (<?php echo $discount * 100; ?>%)</td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td><strong>Total After Discount:</strong></td>
                        <td><?php echo number_format($totalPrice, 2); ?>€</td>
                    </tr>
                    <tr>
                        <td><strong>Tax (19%):</strong></td>
                        <td><?php echo number_format($totalPrice * $taxRate, 2); ?>€</td>
                    </tr>
                    <tr>
                        <td><strong>Final Total:</strong></td>
                        <td><?php echo number_format($totalWithTax, 2); ?>€</td>
                    </tr>
                </table>
                <p><strong>Order Date:</strong> <?php echo $order['timestamp']; ?></p>
                <a href="index.php" class="btn">Return to Homepage</a>
            </div>
        </div>
    </main>
    <?php
    include('includes/footer.php'); 
    ?>
</body>
</html>