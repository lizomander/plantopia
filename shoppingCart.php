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

$totalPrice = 0;
$taxRate = 0.19;
foreach ($cart as $pid => $quantity) {
    if (isset($products[$pid])) {
        $totalPrice += $products[$pid]['price'] * $quantity;
    }
}
$totalWithTax = $totalPrice * (1 + $taxRate);
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
                        <p>Total Price: <?php echo $totalPrice; ?>€</p>
                        <p>Tax (19%): <?php echo number_format($totalPrice * $taxRate, 2); ?>€</p>
                        <p>Grand Total: <?php echo number_format($totalWithTax, 2); ?>€</p>
                </div>
                <button class="btn-proceed" onclick="window.location.href='checkout.php';">Proceed to Checkout</button>
            <?php endif; ?>
        </div>
    </div>
    <?php include('footer.php')?>
</body>
</html>
<?php
if ($user->isAdmin()) {
    echo "<h2>Order Management</h2>";
    $newOrders = getOrdersByStatus('new');
    echo "<h3>New Orders</h3>";
    foreach ($newOrders as $order) {
        echo "<div class='order'>";
        echo "<p>Order ID: " . $order['id'] . "</p>";
        echo "<form method='POST' action='updateOrder.php'>";
        echo "<input type='hidden' name='order_id' value='" . $order['id'] . "'>";
        echo "<button type='submit' name='action' value='ship'>Mark as Shipped</button>";
        echo "<button type='submit' name='action' value='reject'>Reject</button>";
        echo "<textarea name='reason' placeholder='Reason for rejection'></textarea>";
        echo "</form>";
        echo "</div>";
    }
}
?>
<?php
if ($_POST['action'] === 'reject' && !empty($_POST['reason'])) {
    if ($order['status'] === 'new') {
        rejectOrder($orderId, $_POST['reason']);
        echo "<p>Order ID $orderId rejected for reason: " . htmlspecialchars($_POST['reason']) . "</p>";
    } else {
        echo "<p>Cannot reject an order that is already processed.</p>";
    }
}
?>
<?php
if ($user->isAdmin()) {
    echo "<h2>Manage Discounts</h2>";
    echo "<form method='POST' action='updateDiscounts.php'>";
    echo "<label for='discount10'>Discount for every 10th order:</label>";
    echo "<input type='number' id='discount10' name='discount10' value='10'>%";
    echo "<label for='discount20'>Discount for every 20th order:</label>";
    echo "<input type='number' id='discount20' name='discount20' value='20'>%";
    echo "<button type='submit'>Update Discounts</button>";
    echo "</form>";
}
?>