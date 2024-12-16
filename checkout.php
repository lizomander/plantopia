<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$data = json_decode(file_get_contents('./json/data.json'), true);
$products = [];
foreach ($data['products'] as $product) {
    $products[$product['pid']] = $product;
}

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    $errorMessage = "Cart is empty!";
} else {
    // Calculate total price
    $totalPrice = 0;
    $taxRate = 0.19; // 19% tax
    foreach ($cart as $pid => $quantity) {
        if (isset($products[$pid])) {
            $totalPrice += $products[$pid]['price'] * $quantity;
        }
    }

    $settingsFile = './json/discounts.json';
    $discounts = json_decode(file_get_contents($settingsFile), true);

    if (!$discounts || !isset($discounts['discounts'])) {
        die("Error: Discounts not loaded or invalid format in discounts.json");
    }

    $ordersFile = './json/orders.json';
    $orders = file_exists($ordersFile) ? json_decode(file_get_contents($ordersFile), true) : [];
    $currentUser = $_SESSION['user'];
    $orderCount = count(array_filter($orders, function ($order) use ($currentUser) {
        return $order['user'] === $currentUser;
    }));

    $totalQuantity = array_sum($cart);

    $discount = 0;
    foreach ($discounts['discounts'] as $rule) {
        if ($totalQuantity >= $rule['threshold']) {
            $discount = max($discount, $rule['percentage']);
        }
    }

    $totalPriceBeforeDiscount = $totalPrice;
    $discountAmount = $totalPrice * ($discount / 100);
    $totalPrice -= $discountAmount;

    $taxAmount = $totalPrice * $taxRate;
    $totalWithTax = $totalPrice + $taxAmount;

    $order = [
        'user' => $currentUser,
        'cart' => $cart,
        'total' => $totalWithTax,
        'discount' => $discount / 100,
        'timestamp' => date('Y-m-d H:i:s'),
        'status' => 'ordered',
    ];
    $orders[] = $order;
    file_put_contents($ordersFile, json_encode($orders, JSON_PRETTY_PRINT));

    unset($_SESSION['cart']);

    $cartFile = './json/cart.json';
    $carts = file_exists($cartFile) ? json_decode(file_get_contents($cartFile), true) : [];
    $currentUser = $_SESSION['user'];
    if (isset($carts[$currentUser])) {
        unset($carts[$currentUser]); // Remove the user's cart from cart.json
        file_put_contents($cartFile, json_encode($carts, JSON_PRETTY_PRINT)); // Save updated carts
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('includes/header.php'); ?>
<body>
    <header>
        <h1>Thank You for Your Order!</h1>
    </header>
    <main>
        <div class="container">
            <div class="confirmation-card">
                <?php if (isset($errorMessage)): ?>
                    <p><?= htmlspecialchars($errorMessage); ?></p>
                <?php else: ?>
                    <h2>Order Summary</h2>
                    <table>
                        <tr>
                            <td><strong>Total Before Discount:</strong></td>
                            <td><?= number_format($totalPriceBeforeDiscount, 2); ?>€</td>
                        </tr>
                        <?php if ($discount > 0): ?>
                        <tr>
                            <td><strong>Discount Applied:</strong></td>
                            <td>-<?= number_format($discountAmount, 2); ?>€</td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td><strong>Total After Discount:</strong></td>
                            <td><?= number_format($totalPrice, 2); ?>€</td>
                        </tr>
                        <tr>
                            <td><strong>Tax (19%):</strong></td>
                            <td><?= number_format($taxAmount, 2); ?>€</td>
                        </tr>
                        <tr>
                            <td><strong>Final Total:</strong></td>
                            <td><?= number_format($totalWithTax, 2); ?>€</td>
                        </tr>
                    </table>
                    <p><strong>Order Date:</strong> <?= htmlspecialchars($order['timestamp']); ?></p>
                    <a href="index.php" class="btn">Return to Homepage</a>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php include('includes/footer.php'); ?>
</body>
</html>