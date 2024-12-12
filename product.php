<?php
session_start();
// Load and decode JSON data
$data = json_decode(file_get_contents('./json/data.json'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error parsing JSON file: " . json_last_error_msg());
}

// Extract products into an associative array keyed by product ID
$products = [];
foreach ($data['products'] as $product) {
    $products[$product['pid']] = $product;
}

// Check for multiple `pid` parameters
$pid1 = $_GET['pid1'] ?? null;
$pid2 = $_GET['pid2'] ?? null;

// Handle single or multiple product IDs
$productsToShow = [];
if (isset($_GET['pid'])) {
    $productID = $_GET['pid'];
    if (empty($productID)) {
        die("No value for the parameter!");
    } elseif (isset($products[$productID])) {
        $productsToShow[] = $products[$productID];
    } else {
        die("Product not found!");
    }
} elseif ($pid1 || $pid2) {
    // Add products if their IDs are valid
    if ($pid1 && isset($products[$pid1])) {
        $productsToShow[] = $products[$pid1];
    }
    if ($pid2 && isset($products[$pid2])) {
        $productsToShow[] = $products[$pid2];
    }

    if (empty($productsToShow)) {
        die("No valid products found!");
    }
} else {
    die("Parameter is missing!");
}
include('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="./css/design.css">
    <link rel="stylesheet" href="./css/interactive.css">
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/pages.css">
</head>

<body>
    <div class="container">
        <?php foreach ($productsToShow as $product): ?>
            <div class="product-header">
                <h2 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h2>
                <div class="cart-icon">
                    <a href="shoppingCart.php">
                        <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-wrapper">
                    <img src="<?php echo htmlspecialchars($product['imagepath']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="200" height="200">
                    <section>
                        <h4 class="card-heading">Product Details</h4>
                        <p class="card-description"><?php echo htmlspecialchars($product['description']); ?></p>
                        <ul>
                            <li><strong>Price:</strong> <?php echo htmlspecialchars($product['price']); ?>€</li>
                            <li><strong>Watering:</strong> <?php echo htmlspecialchars($product['watering']); ?></li>
                            <li><strong>Light:</strong> <?php echo htmlspecialchars($product['light']); ?></li>
                            <li><strong>Humidity:</strong> <?php echo htmlspecialchars($product['humidity'] ?? 'N/A'); ?></li>
                        </ul>
                    </section>
                </div>
            </div>

            <!-- Price Calculation Section -->
            <section id="price-calculation">
                <h3><strong>Price Calculation</strong></h3>
                <label for="priceWithoutTax">Enter Price Without Tax (€):</label>
                <input type="number" id="priceWithoutTax" placeholder="Enter price" step="0.01">
                <button id="calculatePriceBtn">Calculate Price</button>

                <div id="priceResults">
                    <p><strong>Price Without Tax:</strong> <span id="priceWOTaxDisplay">0.00</span> €</p>
                    <p><strong>Price With Tax (19%):</strong> <span id="priceWithTaxDisplay">0.00</span> €</p>
                </div>
            </section>

            <!-- Add to Cart Section -->
            <div class="flex-product-list-btn">
                <button id="decrease-<?php echo $product['pid']; ?>" class="button">-</button>
                <input type="number" id="quantity-<?php echo $product['pid']; ?>" value="1" min="1" class="quantity-input">
                <button id="increase-<?php echo $product['pid']; ?>" class="button">+</button>
                <button id="add-to-cart-btn-<?php echo $product['pid']; ?>" class="green-btn" data-pid="<?php echo $product['pid']; ?>">Add to Cart</button>
            </div>

            <!-- Navigation Section -->
            <?php
                $mainCategory = $product['category'];
                $subCategory = $product['subcategory'] ?? null;

                $subcategoryPage = $subCategory 
                    ? strtolower($mainCategory) . "PlantsList.php?sub=" . urlencode($subCategory) 
                    : null;

                $mainCategoryPage = strtolower($mainCategory) . "PlantsList.php";
            ?>
            <nav>
                <?php if ($subCategory && $subcategoryPage): ?>
                    <!-- Back to Subcategory -->
                    <p><a href="<?php echo htmlspecialchars($subcategoryPage); ?>">Back to <?php echo ucfirst(str_replace("_", " ", $subCategory)); ?> Plants</a></p>
                <?php endif; ?>

                <!-- Back to Main Category -->
                <p><a href="<?php echo htmlspecialchars($mainCategoryPage); ?>">Back to <?php echo ucfirst($mainCategory); ?> Plants</a></p>

                <!-- Return to Homepage -->
                <p><a href="index.php">Return to Homepage</a></p>
            </nav>
        <?php endforeach; ?>
    </div>

    <!-- Back-to-top Button -->
    <button id="back-to-top" style="display:none; position:fixed; bottom:20px; left:50%; transform:translateX(-50%); padding:10px; font-size:24px; cursor:pointer; background-color:#007BFF; color:white; border:none; border-radius:50%; height:50px; width:50px;">
        ↑
    </button>

    <!-- Footer -->
    <footer>
        <div class="footer-logo">
            <img src="./img/1.png" alt="Plantopia Logo" class="footer-logo-img">
        </div>
        <p>&copy; 2024 Plantopia. All rights reserved.</p>
        <p>Contact us at <a href="mailto:info@plantopia.com">info@plantopia.com</a></p>
    </footer>

    <!-- Scripts -->
    <script src="./javascript/darkmode.js"></script>
    <script src="./javascript/topButton.js"></script>
    <script>
        // Price Calculation
        document.getElementById('calculatePriceBtn').addEventListener('click', () => {
            const priceWithoutTax = parseFloat(document.getElementById('priceWithoutTax').value) || 0;
            document.getElementById('priceWOTaxDisplay').textContent = priceWithoutTax.toFixed(2);
            document.getElementById('priceWithTaxDisplay').textContent = (priceWithoutTax * 1.19).toFixed(2);
        });

        // Cart Functionality
        <?php foreach ($productsToShow as $product): ?>
        const pid = '<?php echo $product['pid']; ?>';
        const decreaseBtn = document.getElementById(`decrease-${pid}`);
        const increaseBtn = document.getElementById(`increase-${pid}`);
        const quantityInput = document.getElementById(`quantity-${pid}`);
        const addToCartBtn = document.getElementById(`add-to-cart-btn-${pid}`);

        decreaseBtn.addEventListener('click', () => {
            if (quantityInput.value > 1) {
                quantityInput.value--;
            }
        });

        increaseBtn.addEventListener('click', () => {
            quantityInput.value++;
        });

        addToCartBtn.addEventListener('click', () => {
            const quantity = quantityInput.value;

            fetch('addToCart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `pid=${pid}&quantity=${quantity}`,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Item added to cart!');
                    } else {
                        alert('Failed to add item to cart.');
                    }
                });
        });
        <?php endforeach; ?>

        // Update cart icon based on session data
        fetch('cartStatus.php')
            .then(response => response.json())
            .then(data => {
                if (data.hasItems) {
                    document.getElementById('cart-icon').src = './img/ShoppingCartIconFilled.png';
                } else {
                    document.getElementById('cart-icon').src = './img/ShoppingCartIcon.png';
                }
            })
            .catch(error => console.error('Error fetching cart status:', error));
    </script>
    
</body>

</html>
