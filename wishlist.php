<?php
session_start();

// Load wishlists.json
$wishlistFile = './json/wishlists.json';
$wishlists = file_exists($wishlistFile) ? json_decode(file_get_contents($wishlistFile), true) : [];

// Load products.json for product details (assuming a JSON file with product details)
$productFile = './json/products.json';
$products = file_exists($productFile) ? json_decode(file_get_contents($productFile), true) : [];

// Get the current user
$currentUser = $_SESSION['user'] ?? 'guest';

// Initialize the user's wishlist if not already set
if (!isset($wishlists[$currentUser])) {
    $wishlists[$currentUser] = [];
}

// Check the request method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = $_POST['pid'] ?? null;
    $action = $_POST['action'] ?? null;

    if (!$action || !in_array($action, ['add', 'remove'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action!']);
        exit;
    }

    // Handle add action
    if ($action === 'add') {
        if ($pid && !in_array($pid, $wishlists[$currentUser])) {
            $wishlists[$currentUser][] = $pid;
            file_put_contents($wishlistFile, json_encode($wishlists, JSON_PRETTY_PRINT));
            echo json_encode(['status' => 'success', 'message' => 'Added to wishlist!', 'pid' => $pid]);
            exit;
        }
    }

    // Handle remove action
    if ($action === 'remove') {
        if (($key = array_search($pid, $wishlists[$currentUser])) !== false) {
            unset($wishlists[$currentUser][$key]);
            $wishlists[$currentUser] = array_values($wishlists[$currentUser]); // Reindex array
            file_put_contents($wishlistFile, json_encode($wishlists, JSON_PRETTY_PRINT));
            echo json_encode(['status' => 'success', 'message' => 'Removed from wishlist!', 'pid' => $pid]);
            exit;
        }
    }
}

// Handle GET requests to fetch the wishlist
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userWishlist = $wishlists[$currentUser] ?? [];
    $detailedWishlist = array_map(function ($pid) use ($products) {
        return $products[$pid] ?? null;
    }, $userWishlist);

    echo json_encode(['status' => 'success', 'wishlist' => array_filter($detailedWishlist)]);
    exit;
}

// Render the wishlist page (GET request)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = json_decode(file_get_contents('./json/data.json'), true);
    $productsIndexed = [];
    foreach ($data['products'] as $product) {
        $productsIndexed[$product['pid']] = $product;
    }

    $userWishlist = $wishlists[$currentUser] ?? [];

    include('includes/header.php');
    ?>
    <body>
        <h1>Your Wishlist</h1>
        <?php if (empty($userWishlist)): ?>
            <p>Your wishlist is empty! <a href="index.php">Continue Shopping</a></p>
        <?php else: ?>
            <?php foreach ($userWishlist as $pid): ?>
                <?php 
                if (!isset($productsIndexed[$pid])) {
                    echo "<p>Product ID $pid not found!</p>";
                    continue;
                }
                $product = $productsIndexed[$pid];
                ?>
                <div class="wishlist-item">
                    <img src="<?php echo htmlspecialchars($product['imagepath']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <p><?php echo htmlspecialchars($product['name']); ?></p>
                    <p>Price: <?php echo htmlspecialchars($product['price']); ?>€</p>
                    <form method="post" action="wishlist.php">
                        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                        <button type="submit" name="action" value="remove">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
    <?php
    include('includes/footer.php');
    exit;
}