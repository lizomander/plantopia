<?php
session_start();

// Redirect to login if no user is logged in
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Load wishlist and product data
$wishlistFile = './json/wishlists.json';
$productFile = './json/data.json';

$wishlists = file_exists($wishlistFile) ? json_decode(file_get_contents($wishlistFile), true) : [];
$data = file_exists($productFile) ? json_decode(file_get_contents($productFile), true) : [];
$products = array_column($data['products'], null, 'pid'); // Re-index by `pid`

// Get the current user
$currentUser = $_SESSION['user'];

// Initialize the user's wishlist if not already set
if (!isset($wishlists[$currentUser])) {
    $wishlists[$currentUser] = [];
}

// Handle POST Request for Add and Remove Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = intval($_POST['pid'] ?? null);
    $action = $_POST['action'] ?? null;

    if ($action === 'add') {
        if (!in_array($pid, $wishlists[$currentUser])) {
            $wishlists[$currentUser][] = $pid;
        }
    } elseif ($action === 'remove') {
        $key = array_search($pid, $wishlists[$currentUser]);
        if ($key !== false) {
            unset($wishlists[$currentUser][$key]);
            $wishlists[$currentUser] = array_values($wishlists[$currentUser]); // Reindex
        }
    }

    // Save updated wishlist
    file_put_contents($wishlistFile, json_encode($wishlists, JSON_PRETTY_PRINT));
    echo json_encode(['success' => true]);
    exit;
}

// Load the user's wishlist for display
$userWishlist = array_map('intval', $wishlists[$currentUser]);
include('includes/header.php');
?>
<body>
    <h1>Your Wishlist</h1>
    <div id="wishlist-container">
        <?php if (empty($userWishlist)): ?>
            <p>Your wishlist is empty! <a href="index.php">Continue shopping</a></p>
        <?php else: ?>
            <?php foreach ($userWishlist as $pid): ?>
                <?php if (!isset($products[$pid])) continue; ?>
                <?php $product = $products[$pid]; ?>
                <div class="wishlist-item" data-pid="<?php echo $pid; ?>" style="display: flex; align-items: center; margin-bottom: 15px;">
                    <img src="<?php echo htmlspecialchars($product['imagepath']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 100px; height: auto; margin-right: 20px;">
                    <div>
                        <p style="margin: 0;"><strong><?php echo htmlspecialchars($product['name']); ?></strong></p>
                        <p style="margin: 0;">Price: <?php echo htmlspecialchars($product['price']); ?>€</p>
                        <button class="remove-btn" data-pid="<?php echo $pid; ?>" style="background-color: #ff5555; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;">
                            Remove
                        </button>
                        <button class="add-to-cart-btn" data-pid="<?php echo $pid; ?>" style="background-color: #28a745; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;">
                            Add to Cart
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script>
        // Handle "Remove" button functionality
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function () {
                const pid = this.getAttribute('data-pid');
                const parentItem = this.closest('.wishlist-item');

                // Send the removal request to the server
                fetch('wishlist.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `pid=${pid}&action=remove`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the item from the DOM
                        parentItem.remove();
                        checkEmptyWishlist();
                    } else {
                        alert('Failed to remove item from wishlist.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });

        // Handle "Add to Cart" button functionality
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function () {
                const pid = this.getAttribute('data-pid');
                const parentItem = this.closest('.wishlist-item');

                // Send the add-to-cart request
                fetch('addToCart.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `pid=${pid}&quantity=1`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the item from the wishlist
                        parentItem.remove();
                        checkEmptyWishlist();
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

        // Check if the wishlist is empty and show "Continue Shopping" message
        function checkEmptyWishlist() {
            const wishlistContainer = document.getElementById('wishlist-container');
            if (!wishlistContainer.querySelector('.wishlist-item')) {
                wishlistContainer.innerHTML = '<p>Your wishlist is empty! <a href="index.php">Continue shopping</a></p>';
            }
        }
    </script>
</body>
<?php include('includes/footer.php'); ?>