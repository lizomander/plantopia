<?php
include 'includes/header.php';
include 'includes/navbar.php';

// Load and decode JSON data
$data = json_decode(file_get_contents('./json/data.json'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error parsing JSON file: " . json_last_error_msg());
}

$category = $_GET['category'] ?? null;

if (!$category) {
    echo "<h1>Category not specified!</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

// Filter products by category
$filteredProducts = array_filter($data['products'], function ($product) use ($category) {
    return $product['category'] === $category;
});

if (empty($filteredProducts)) {
    echo "<h1>No products found in this category!</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

// Group products by subcategory
$productsBySubcategory = [];
foreach ($filteredProducts as $product) {
    $subcategory = $product['subcategory'] ?? 'Uncategorized';
    $productsBySubcategory[$subcategory][] = $product;
}

?>

<main>
    <h1><?php echo htmlspecialchars(ucfirst($category)); ?> Plants</h1>
    <?php foreach ($productsBySubcategory as $subcategory => $productsInSub): ?>
        <h2>
            <a href="subcategory.php?category=<?php echo urlencode($category); ?>&subcategory=<?php echo urlencode($subcategory); ?>">
                <?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $subcategory))); ?>
            </a>
        </h2>
        <ul>
            <?php foreach ($productsInSub as $product): ?>
                <li>
                    <a href="products.php?pid=<?php echo urlencode($product['pid']); ?>">
                        <?php echo htmlspecialchars($product['name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
</main>

<?php include 'includes/footer.php'; ?>