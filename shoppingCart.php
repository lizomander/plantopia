<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Load products
$data = json_decode(file_get_contents('./json/data.json'), true);
$products = [];
foreach ($data['products'] as $product) {
    $products[$product['pid']] = $product;
}

// Load cart from cart.json
$cartFile = './json/cart.json';
$carts = file_exists($cartFile) ? json_decode(file_get_contents($cartFile), true) : [];
$currentUser = $_SESSION['user'];
$userCart = $carts[$currentUser] ?? [];

// Sync cart with session (optional but recommended for consistency)
$_SESSION['cart'] = $userCart;

// Calculate total price and other details
$totalPrice = 0;
$taxRate = 0.19;

foreach ($userCart as $pid => $quantity) {
    if (isset($products[$pid])) {
        $totalPrice += $products[$pid]['price'] * $quantity;
    }
}

$totalQuantity = array_sum($userCart);

// Load discounts.json
$discountsFile = './json/discounts.json';
$discountsData = json_decode(file_get_contents($discountsFile), true);

// Determine the applicable discount based on cart quantity
$discount = 0;
foreach ($discountsData['discounts'] as $rule) {
    if ($totalQuantity >= $rule['threshold']) {
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
$finalTotal = $totalPrice + $taxAmount;

// Page Title
$pageTitle = "Plantopia | Shopping Cart";
include('includes/header.php');
?>
<body>
    <div class="container">
        <div class="cart-container">
            <div class="cart-header">Shopping Cart</div>
            <?php if (empty($userCart)): ?>
                <div class="cart-item">
                    <p>Your cart is empty! <a href="index.php">Continue Shopping</a></p>
                </div>
            <?php else: ?>
                <?php foreach ($userCart as $pid => $quantity): 
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
                        <p>Price/Item: <b><?php echo htmlspecialchars($product['price']); ?>€</b></p>
                        <p>Total: <b><?php echo number_format($itemTotal, 2); ?>€</b></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="cart-summary">
                    <p><strong>Total Price Before Discount:</strong> <?php echo number_format($totalPriceBeforeDiscount, 2); ?>€</p>
                    <?php if ($discount > 0): ?>
                        <p><strong>Discount Applied (<?php echo $discount; ?>%):</strong> -<?php echo number_format($discountAmount, 2); ?>€</p>
                    <?php endif; ?>
                    <p><strong>Total After Discount:</strong> <?php echo number_format($totalPrice, 2); ?>€</p>
                    <p><strong>Tax (19%):</strong> <?php echo number_format($taxAmount, 2); ?>€</p>
                    <p><strong>Final Total:</strong> <?php echo number_format($finalTotal, 2); ?>€</p>
                </div>
                <button class="btn-proceed" onclick="window.location.href='checkout.php';">Proceed to Checkout</button>
            <?php endif; ?>
        </div>
    </div>
    <?php include('includes/footer.php')?>
</body>
</html>