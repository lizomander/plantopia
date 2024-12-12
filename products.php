<?php
include 'includes/header.php';
include 'includes/navbar.php';

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

// Check for product ID(s) from the query string
$pid = $_GET['pid'] ?? null;
$pid1 = $_GET['pid1'] ?? null;
$pid2 = $_GET['pid2'] ?? null;

$productsToShow = [];

// Single product
if ($pid && isset($products[$pid])) {
    $productsToShow[] = $products[$pid];
}

// Multiple products
if ($pid1 && isset($products[$pid1])) {
    $productsToShow[] = $products[$pid1];
}
if ($pid2 && isset($products[$pid2])) {
    $productsToShow[] = $products[$pid2];
}

if (empty($productsToShow)) {
    echo "<h1>No products found!</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

?>

<main>
    <?php foreach ($productsToShow as $product): ?>
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <div class="card">
            <img src="<?php echo htmlspecialchars($product['imagepath']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="200" height="200">
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <p><strong>Price:</strong> <?php echo htmlspecialchars($product['price']); ?>€</p>
            <p><strong>Watering:</strong> <?php echo htmlspecialchars($product['watering']); ?></p>
            <p><strong>Light:</strong> <?php echo htmlspecialchars($product['light']); ?></p>
            <p><strong>Humidity:</strong> <?php echo htmlspecialchars($product['humidity'] ?? 'N/A'); ?></p>
        </div>
    <?php endforeach; ?>
</main>

<script src="./javascript/cart/addToList.js"></script>
<script src="./javascript/cart/shoppingCart.js"></script>
<?php include 'includes/footer.php'; ?>