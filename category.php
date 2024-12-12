<?php
// Load and decode JSON data
$data = json_decode(file_get_contents('./json/data.json'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error parsing JSON file: " . json_last_error_msg());
}

// Extract categories and products from the JSON data
$products = $data['products'] ?? [];
$mainCategory = $_GET['main'] ?? null;

// Validate main category
if (!$mainCategory) {
    echo "<h1>Category not specified!</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

// Filter products based on the main category
$filteredProducts = array_filter($products, function ($product) use ($mainCategory) {
    return $product['category'] === $mainCategory;
});

// Check if there are any products in the category
if (empty($filteredProducts)) {
    echo "<h1>No products found in this category.</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

echo "<h1>" . ucfirst($mainCategory) . " Plants</h1>";

// Group products by subcategory
$productsBySubcategory = [];
foreach ($filteredProducts as $product) {
    $subcategory = $product['subcategory'] ?? 'none';
    $productsBySubcategory[$subcategory][] = $product;
}

// Display subcategories and their products
foreach ($productsBySubcategory as $subcategory => $productsInSub) {
    if ($subcategory !== 'none') {
        echo "<h2><a href='subcategory.php?main=" . urlencode($mainCategory) . "&sub=" . urlencode($subcategory) . "'>" .
            ucfirst(str_replace("_", " ", $subcategory)) . "</a></h2>";
    } else {
        echo "<h2>Uncategorized Products</h2>";
    }

    foreach ($productsInSub as $product) {
        echo "<p><a href='product.php?pid=" . htmlspecialchars($product['pid']) . "'>" .
            htmlspecialchars($product['name']) .
            "</a></p>";
    }
}

// Navigation to Homepage
echo "<p><a href='index.php'>Return to Homepage</a></p>";
?>
