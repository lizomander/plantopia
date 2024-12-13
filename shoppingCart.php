<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Load product and discount data
$data = json_decode(file_get_contents('./json/data.json'), true);
$products = [];
foreach ($data['products'] as $product) {
    $products[$product['pid']] = $product;
}

$cart = $_SESSION['cart'] ?? [];

// Load discount settings
$discountSettingsFile = 'json/discounts.json';
$discountSettings = json_decode(file_get_contents($discountSettingsFile), true);

// Load orders to calculate customer order count
$ordersFile = 'json/orders.json';
$ordersData = json_decode(file_get_contents($ordersFile), true);

$currentUser = $_SESSION['user'];
$userOrdersCount = count(array_filter($ordersData, function ($order) use ($currentUser) {
    return $order['user'] === $currentUser && $order['status'] === 'finished';
}));

// Determine discount percentage
$discountPercentage = 0;
if ($userOrdersCount > 0) {
    if ($userOrdersCount % 20 === 0) {
        $discountPercentage = $discountSettings['discount_20'] ?? 20; // Default to 20%
    } elseif ($userOrdersCount % 10 === 0) {
        $discountPercentage = $discountSettings['discount_10'] ?? 10; // Default to 10%
    }
}

// Calculate totals
$totalPrice = 0;
$taxRate = 0.19;
foreach ($cart as $pid => $quantity) {
    if (isset($products[$pid])) {
        $totalPrice += $products[$pid]['price'] * $quantity;
    }
}

$discountAmount = $totalPrice * ($discountPercentage / 100);
$totalPriceAfterDiscount = $totalPrice - $discountAmount;
$totalWithTax = $totalPriceAfterDiscount * (1 + $taxRate);

$pageTitle = "Plantopia | Shopping Cart";
include('includes/header.php');
?>
<body>
<div class="container">
    <div class="cart-container">
        <div class="cart-header">Shopping Cart</div>
        <?php if (empty($cart)): ?>
            <div class="cart-item">
                <p>Your cart is empty! <a href="index.php">Continue Shopping</a></p>
            </div>
        <?php else: ?>
            <?php foreach ($cart as $pid => $quantity): 
                $product = $products[$pid];
                $itemTotal = $product['price'] * $quantity;
            ?>
            <div class="cart-item">
                <div class="cart-item-details">
                    <div class="cart-item-title"><?php echo htmlspecialchars($product['name']); ?></div>
                    <div class="cart-item-quantity">
                        <img src="<?php echo htmlspecialchars($product['imagepath']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <form method="post" action="modifyCart.php" style="display: inline;">
                            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                            <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1">
                            <button type="submit" name="action" value="update" class="green-btn">Update</button>
                        </form>
                        <form method="post" action="modifyCart.php" style="display: inline;">
                            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                            <button type="submit" name="action" value="remove" class="green-btn">Remove</button>
                        </form>
                    </div>
                </div>
                <div class="cart-item-actions">
                    <p>Price/Item: <b><?php echo htmlspecialchars($product['price']); ?>€</p></b>
                    <p>Total: <b><?php echo $itemTotal; ?>€</p></b>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="cart-summary">
                <p>Total Price: <?php echo number_format($totalPrice, 2); ?>€</p>
                <?php if ($discountPercentage > 0): ?>
                    <p>Discount (<?php echo $discountPercentage; ?>%): -<?php echo number_format($discountAmount, 2); ?>€</p>
                <?php endif; ?>
                <p>Tax (19%): <?php echo number_format($totalWithTax - $totalPriceAfterDiscount, 2); ?>€</p>
                <p>Grand Total: <?php echo number_format($totalWithTax, 2); ?>€</p>
            </div>
            <button class="btn-proceed" onclick="window.location.href='checkout.php';">Proceed to Checkout</button>
        <?php endif; ?>
    </div>
</div>
<?php include('footer.php') ?>
</body>
</html>