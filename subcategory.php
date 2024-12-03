<?php
include 'includes/header.php';
include 'includes/navbar.php';

// Load and decode JSON data
$data = json_decode(file_get_contents('./json/data.json'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error parsing JSON file: " . json_last_error_msg());
}

// Get category and subcategory from URL
$category = $_GET['category'] ?? null;
$subcategory = $_GET['subcategory'] ?? null;
if (!$category || !$subcategory) {
    echo "<h1>Category or Subcategory not specified!</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

// Filter products by category and subcategory
$filteredProducts = array_filter($data['products'], function($product) use ($category, $subcategory) {
    return $product['category'] === $category && $product['subcategory'] === $subcategory;
});

// Check if subcategory exists
if (empty($filteredProducts)) {
    echo "<h1>No products found in this subcategory!</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

$subcategoryName = ucfirst(str_replace('Plants', '', $subcategory));
?>

<main>
    <h1><?php echo htmlspecialchars($subcategoryName); ?> Plants</h1>
    <ul>
        <?php foreach ($filteredProducts as $product): ?>
            <li>
                <div class="card">
                    <a class="card-wrapper" href="products.php?pid=<?php echo urlencode($product['pid']); ?>">
                        <img src="<?php echo htmlspecialchars($product['imagepath']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="120" height="140">
                        <p class="card-heading"><?php echo htmlspecialchars($product['name']); ?> - <?php echo htmlspecialchars($product['price']); ?>€</p>
                        <p class="card-description"><?php echo htmlspecialchars($product['description']); ?></p>
                    </a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</main>
<?php include 'includes/footer.php'; ?>