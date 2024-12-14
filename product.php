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
                <div class="flex-product-list-btn" id="calculatePriceBtn">
                    <button id="decrease-<?php echo $product['pid']; ?>" class="button">-</button>
                    <input type="number" id="quantity-<?php echo $product['pid']; ?>" value="1" min="1" class="quantity-input">
                    <button id="increase-<?php echo $product['pid']; ?>" class="button">+</button>
                    <button id="add-to-cart-btn-<?php echo $product['pid']; ?>" class="green-btn" data-pid="<?php echo $product['pid']; ?>">Add to Cart</button>
                </div>
            </section>

            <!-- Wishlist Heart Icon -->
            <div class="wishlist-icon-container">
                <?php
                // Check if the product is in the user's wishlist
                $wishlistFile = './json/wishlists.json';
                $wishlists = file_exists($wishlistFile) ? json_decode(file_get_contents($wishlistFile), true) : [];
                $currentUser = $_SESSION['user'];
                $userWishlist = $wishlists[$currentUser] ?? [];

                // Determine whether this product is in the wishlist
                $isInWishlist = in_array($product['pid'], $userWishlist);
                ?>
                <button 
                    class="wishlist-btn" 
                    data-pid="<?php echo $product['pid']; ?>" 
                    data-in-wishlist="<?php echo $isInWishlist ? 'true' : 'false'; ?>"
                >
                    <img 
                        id="wishlist-icon-<?php echo $product['pid']; ?>" 
                        src="<?php echo $isInWishlist ? './img/heart-filled.png' : './img/heart-empty.png'; ?>" 
                        alt="Wishlist Icon" 
                    >
                </button>
            </div>

            <?php
                $mainCategory = $product['category'];
                $subCategory = $product['subcategory'] ?? null;

                $subcategoryPage = $subCategory 
                    ? strtolower($mainCategory) . "list.php?sub=" . urlencode($subCategory) 
                    : null;
                $mainCategoryPage = strtolower($mainCategory) . "list.php";
            ?>
            <nav>
                <?php if ($subCategory && $subcategoryPage): ?>

                    <p><a href="<?php echo htmlspecialchars($subcategoryPage); ?>">Back to <?php echo ucfirst(str_replace("_", " ", $subCategory)); ?> Plants</a></p>
                <?php endif; ?>

                <p><a href="<?php echo htmlspecialchars($mainCategoryPage); ?>">Back to <?php echo ucfirst($mainCategory); ?> Plants</a></p>

                <p><a href="index.php">Return to Homepage</a></p>
            </nav>
        <?php endforeach; ?>
    </div>

    <?php
        include('footer.php')
    ?>
    <script>
        document.getElementById('calculatePriceBtn').addEventListener('click', () => {
            const priceWithoutTax = parseFloat(document.getElementById('priceWithoutTax').value) || 0;
            document.getElementById('priceWOTaxDisplay').textContent = priceWithoutTax.toFixed(2);
            document.getElementById('priceWithTaxDisplay').textContent = (priceWithoutTax * 1.19).toFixed(2);
        });

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
        
        // Handle Wishlist Heart Toggle
        document.querySelectorAll('.wishlist-btn').forEach(button => {
            button.addEventListener('click', function () {
                const pid = this.getAttribute('data-pid');
                const isInWishlist = this.getAttribute('data-in-wishlist') === 'true';
                const icon = document.getElementById(`wishlist-icon-${pid}`);

                // Send the toggle request to wishlist.php
                fetch('wishlist.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `pid=${pid}&action=${isInWishlist ? 'remove' : 'add'}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Toggle the heart icon
                        if (isInWishlist) {
                            icon.src = './img/heart-empty.png';
                            this.setAttribute('data-in-wishlist', 'false');
                        } else {
                            icon.src = './img/heart-filled.png';
                            this.setAttribute('data-in-wishlist', 'true');
                        }
                    } else {
                        console.error('Failed to update wishlist:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error updating wishlist:', error);
                });
            });
        });
    </script>
</body>
</html>