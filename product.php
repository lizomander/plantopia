<?php
session_start();
$data = json_decode(file_get_contents('./json/data.json'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error parsing JSON file: " . json_last_error_msg());
}

$products = [];
foreach ($data['products'] as $product) {
    $products[$product['pid']] = $product;
}

$pid1 = $_GET['pid1'] ?? null;
$pid2 = $_GET['pid2'] ?? null;

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

$pid = $_GET['pid'] ?? null;

if ($pid) {
    // Initialize recently viewed session array if not set
    if (!isset($_SESSION['recently_viewed'])) {
        $_SESSION['recently_viewed'] = [];
    }

    // Add the current product to the beginning of the array
    $_SESSION['recently_viewed'] = array_unique(array_merge([$pid], $_SESSION['recently_viewed']));

    // Limit to the last 5 viewed products
    $_SESSION['recently_viewed'] = array_slice($_SESSION['recently_viewed'], 0, 5);
}

// Load wishlist for the current user
$wishlistFile = './json/wishlists.json';
$wishlists = file_exists($wishlistFile) ? json_decode(file_get_contents($wishlistFile), true) : [];
$currentUser = $_SESSION['user'] ?? null;
$userWishlist = $wishlists[$currentUser] ?? [];

    $pageTitle = "Plantopia | Products";
    include('includes/header.php'); 
    include('includes/navbar.php');
?>

<body>
    <div class="container">
        <?php foreach ($productsToShow as $product): ?>
            <div class="product-header">
                <h2 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h2>
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

            <section id="price-calculation">
                <div class="flex-product-list-btn">
                    <button id="decrease-<?php echo $product['pid']; ?>" class="button">-</button>
                    <input type="number" id="quantity-<?php echo $product['pid']; ?>" value="1" min="1" class="quantity-input">
                    <button id="increase-<?php echo $product['pid']; ?>" class="button">+</button>
                    <button class="add-to-cart-btn green-btn" data-pid="<?php echo $product['pid']; ?>">Add to Cart</button>
                </div>
            </section>

            <!-- Wishlist Heart Icon -->
            <div class="wishlist-icon-container">
                <?php
                $isInWishlist = in_array($product['pid'], $userWishlist);
                ?>
                <button 
                    class="wishlist-btn" 
                    data-pid="<?php echo $product['pid']; ?>" 
                    data-action="<?php echo $isInWishlist ? 'remove' : 'add'; ?>"
                >
                    <img 
                        src="<?php echo $isInWishlist ? './img/heart-filled.png' : './img/heart-empty.png'; ?>" 
                        alt="Wishlist Icon"
                    >
                </button>
            </div>
            <?php
            $averageRating = $product['ratings']['count'] > 0 
                ? $product['ratings']['total'] / $product['ratings']['count'] 
                : 0;

            echo "<p>Average Rating: " . number_format($averageRating, 1) . " / 5</p>";
            ?>
            <form class="card-wrapper" method="post" action="rateProduct.php">
                <input type="hidden" name="pid" value="<?php echo htmlspecialchars($product['pid']); ?>">
                <label for="rating">Rate this product:</label>
                <select name="rating" id="rating" required>
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
                <button type="submit">Submit Rating</button>
            </form>
        <?php endforeach; ?>
    </div>
    <p><a href="index.php">Return to Homepage</a></p>
    <script>
        // Quantity adjustment for each product
        <?php foreach ($productsToShow as $product): ?>
        const pid = '<?php echo $product['pid']; ?>';
        const decreaseBtn = document.getElementById(`decrease-${pid}`);
        const increaseBtn = document.getElementById(`increase-${pid}`);
        const quantityInput = document.getElementById(`quantity-${pid}`);

        decreaseBtn.addEventListener('click', () => {
            if (quantityInput.value > 1) {
                quantityInput.value--;
            }
        });

        increaseBtn.addEventListener('click', () => {
            quantityInput.value++;
        });
        <?php endforeach; ?>

        // Handle Add to Cart functionality
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function () {
                const pid = this.getAttribute('data-pid');
                const quantityInput = document.getElementById(`quantity-${pid}`);
                const quantity = quantityInput.value;

                fetch('addToCart.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `pid=${pid}&quantity=${quantity}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Item added to cart!');
                    } else {
                        alert(`Failed to add item to cart: ${data.message}`);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while adding the item to the cart.');
                });
            });
        });

        // Handle Wishlist Heart Toggle
        document.querySelectorAll('.wishlist-btn').forEach(button => {
            button.addEventListener('click', function () {
                const pid = this.getAttribute('data-pid');
                const action = this.getAttribute('data-action');
                const icon = this.querySelector('img');

                fetch('wishlist.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `pid=${pid}&action=${action}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (action === 'add') {
                            icon.src = './img/heart-filled.png';
                            this.setAttribute('data-action', 'remove');
                        } else {
                            icon.src = './img/heart-empty.png';
                            this.setAttribute('data-action', 'add');
                        }
                    } else {
                        alert('Failed to update wishlist: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
    <?php include('includes/footer.php'); ?>
</body>
</html>