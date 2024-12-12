<?php
include 'includes/header.php';
include 'includes/navbar.php';

// Load and decode JSON data
$data = json_decode(file_get_contents('./json/data.json'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error parsing JSON file: " . json_last_error_msg());
}

$category = $_GET['category'] ?? null;
$subcategory = $_GET['subcategory'] ?? null;

if (!$category || !$subcategory) {
    echo "<h1>Category or Subcategory not specified!</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

// Filter products by category and subcategory
$filteredProducts = array_filter($data['products'], function ($product) use ($category, $subcategory) {
    return $product['category'] === $category && $product['subcategory'] === $subcategory;
});

if (empty($filteredProducts)) {
    echo "<h1>No products found in this subcategory!</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

?>

<main>
    <h1><?php echo htmlspecialchars(ucfirst($subcategory)); ?> Plants</h1>
    <ul>
        <?php foreach ($filteredProducts as $product): ?>
            <li>
                <a href="products.php?pid=<?php echo urlencode($product['pid']); ?>">
                    <?php echo htmlspecialchars($product['name']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</main>

<?php include 'includes/footer.php'; ?>