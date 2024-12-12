<?php
// Load and decode JSON data
$data = json_decode(file_get_contents('./json/data.json'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error parsing JSON file: " . json_last_error_msg());
}

// Extract categories and products from the JSON data
$products = $data['products'] ?? [];
$mainCategory = $_GET['main'] ?? null;
$subCategory = $_GET['sub'] ?? null;

// Validate main category and subcategory
if (!$mainCategory || !$subCategory) {
    echo "<h1>Category or Subcategory not specified!</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

// Filter products based on the main category and subcategory
$filteredProducts = array_filter($products, function ($product) use ($mainCategory, $subCategory) {
    return $product['category'] === $mainCategory && $product['subcategory'] === $subCategory;
});

// Check if there are any products in the subcategory
if (empty($filteredProducts)) {
    echo "<h1>No products found in this subcategory.</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    exit;
}

echo "<h1>" . ucfirst($mainCategory) . " - " . ucfirst(str_replace("_", " ", $subCategory)) . "</h1>";

// Display products in the subcategory
foreach ($filteredProducts as $product) {
    echo "<p><a href='product.php?pid=" . htmlspecialchars($product['pid']) . "'>" .
        htmlspecialchars($product['name']) .
        "</a></p>";
}

// Navigation links
$mainCategoryPage = strtolower($mainCategory) . "PlantsList.php";
echo "<p><a href='" . htmlspecialchars($mainCategoryPage) . "'>Back to " . ucfirst($mainCategory) . " Plants</a></p>";
echo "<p><a href='index.php'>Return to Homepage</a></p>";
?>
