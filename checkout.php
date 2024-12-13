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

// Load discounts.json and orders.json
$discountsFile = './json/discounts.json';
$discountsData = json_decode(file_get_contents($discountsFile), true);
$ordersFile = './json/orders.json';
$orders = file_exists($ordersFile) ? json_decode(file_get_contents($ordersFile), true) : [];

// Get current user and their order count
$currentUser = $_SESSION['user'];
$orderCount = count(array_filter($orders, function ($order) use ($currentUser) {
    return $order['user'] === $currentUser;
}));

// Determine the applicable discount
$discount = 0;
foreach ($discountsData['discounts'] as $rule) {
    if ($orderCount >= $rule['threshold']) {
        $discount = max($discount, $rule['percentage']);
    }
}

// Calculate discount and apply to the total price
$totalPriceBeforeDiscount = $totalPrice;
$discountAmount = 0;
if ($discount > 0) {
    $discountAmount = $totalPrice * ($discount / 100);
    $totalPrice -= $discountAmount;
}

// Calculate tax and final total
$taxAmount = $totalPrice * $taxRate;
$totalWithTax = $totalPrice + $taxAmount;

// Save the order
$order = [
    'user' => $currentUser,
    'cart' => $cart,
    'total' => $totalWithTax,
    'discount' => $discount / 100, // Save discount as a fraction
    'timestamp' => date('Y-m-d H:i:s'),
];
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
                        <td>-<?php echo number_format($discountAmount, 2); ?>€</td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td><strong>Total After Discount:</strong></td>
                        <td><?php echo number_format($totalPrice, 2); ?>€</td>
                    </tr>
                    <tr>
                        <td><strong>Tax (19%):</strong></td>
                        <td><?php echo number_format($taxAmount, 2); ?>€</td>
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
    <?php include('includes/footer.php'); ?>
</body>
</html>