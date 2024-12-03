<?php
include 'includes/header.php';
include 'includes/navbar.php';

// Load and decode JSON data
$data = json_decode(file_get_contents('./json/data.json'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error parsing JSON file: " . json_last_error_msg());
}

// Get product ID from URL
$productID = $_GET['pid'] ?? null;
if (!$productID) {
    echo "<h1>Product not specified!</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

// Find product by ID
$product = array_filter($data['products'], function($prod) use ($productID) {
    return $prod['pid'] == $productID;
});

if (empty($product)) {
    echo "<h1>Product not found!</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

$product = reset($product);
?>

<main>
    <h1><?php echo htmlspecialchars($product['name']); ?></h1>
    <div class="card">
        <img src="<?php echo htmlspecialchars($product['imagepath']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="200" height="200">
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <p><strong>Price:</strong> <?php echo htmlspecialchars($product['price']); ?>€</p>
        <p><strong>Watering:</strong> <?php echo htmlspecialchars($product['watering']); ?></p>
        <p><strong>Light:</strong> <?php echo htmlspecialchars($product['light']); ?></p>
        <p><strong>Humidity:</strong> <?php echo htmlspecialchars($product['humidity'] ?? 'N/A'); ?></p>
    </div>
</main>
<?php include 'includes/footer.php'; ?>