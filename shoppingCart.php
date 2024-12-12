<?php
session_start();

// Ensure user is logged in
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

// Calculate totals
$totalPrice = 0;
$taxRate = 0.19;
foreach ($cart as $pid => $quantity) {
    if (isset($products[$pid])) {
        $totalPrice += $products[$pid]['price'] * $quantity;
    }
}
$totalWithTax = $totalPrice * (1 + $taxRate);

include('includes/header.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        .cart-container {
            margin: 20px auto;
            max-width: 900px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .cart-header {
            background-color: #f8f8f8;
            padding: 15px 20px;
            border-bottom: 1px solid #eaeaea;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .cart-item {
            display: flex;
            padding: 20px;
            border-bottom: 1px solid #eaeaea;
            align-items: center;
            gap: 20px;
        }

        .cart-item img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            align-items: center;
        }

        .cart-item-quantity {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cart-item-quantity input {
            width: 60px;
            text-align: center;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .cart-item-actions {
            text-align: right;
        }

        .cart-summary {
            padding: 20px;
            background-color: #f8f8f8;
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .cart-summary p {
            margin: 10px 0;
            font-size: 18px;
            font-weight: bold; 
            text-align: right;
            justify-content: space-between;
        }

        .btn-proceed {
            display: block;
            width: 100%;
            text-align: center;
            padding: 12px 0;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        .btn-proceed:hover {
            background-color: #45a049;
        }
    </style>
</head>

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
                            <form method="post" action="modifycart.php" style="display: inline;">
                                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                                <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1">
                                <button type="submit" name="action" value="update" class="green-btn">Update</button>
                            </form>
                            <form method="post" action="modifycart.php" style="display: inline;">
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

    <div style="height: 200px;"></div>
    <button id="back-to-top" style="display:none; position:fixed; bottom:20px; left:50%; transform:translateX(-50%); padding:10px; font-size:24px; cursor:pointer; background-color:#007BFF; color:white; border:none; border-radius:50%; height:50px; width:50px;">
        ↑
    </button>

    <footer>
        <div class="footer-logo">
            <img src="./img/1.png" alt="Plantopia Logo" class="footer-logo-img">
        </div>
        <p>&copy; 2024 Plantopia. All rights reserved.</p>
        <p>Contact us at <a href="mailto:info@plantopia.com">info@plantopia.com</a></p>
        <ul>
            <li><a href="privacy.php">Privacy Policy</a></li>
            <li><a href="terms.php">Terms of Service</a></li>
        </ul>
    </footer>
    <script src="./javascript/darkmode.js"></script>
    <script src="./javascript/topButton.js"></script>

</body>
</html>