<?php
$data = json_decode(file_get_contents('./json/data.json'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error parsing JSON file: " . json_last_error_msg());
}

$products = $data['products'] ?? [];
$mainCategory = $_GET['main'] ?? null;
$subCategory = $_GET['sub'] ?? null;

if (!$mainCategory || !$subCategory) {
    echo "<h1>Category or Subcategory not specified!</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    include('footer.php');
    exit;
}

$filteredProducts = array_filter($products, function ($product) use ($mainCategory, $subCategory) {
    return $product['category'] === $mainCategory && $product['subcategory'] === $subCategory;
});

if (empty($filteredProducts)) {
    echo "<h1>No products found in this subcategory.</h1>";
    echo "<p><a href='index.php'>Return to Homepage</a></p>";
    include('footer.php');
    exit;
}

echo "<h1>" . ucfirst($mainCategory) . " - " . ucfirst(str_replace("_", " ", $subCategory)) . "</h1>";

foreach ($filteredProducts as $product) {
    echo "<p><a href='product.php?pid=" . htmlspecialchars($product['pid']) . "'>" .
        htmlspecialchars($product['name']) .
        "</a></p>";
}
echo "<p><a href='index.php'>Back to Categories</a></p>";
echo "<p><a href='index.php'>Return to Homepage</a></p>";

include('footer.php');
?>