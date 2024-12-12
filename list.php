
<?php
    $pageTitle = "Plantopia | List";
    include('includes/header.php'); 
    include('includes/navbar.php');

$data = json_decode(file_get_contents('./json/data.json'), true);
if (!file_exists('./json/data.json')) {
    die('Error: data.json not found.');
}
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error parsing JSON file: " . json_last_error_msg());
}
$category = $_GET['category'] ?? null;
$subcategory = $_GET['subcategory'] ?? null;
if (!$category) {
    echo "<main><h1>Category not specified!</h1></main>";
    include 'includes/footer.php';
    exit;
}
$filteredProducts = array_filter($data['products'], function ($product) use ($category, $subcategory) {
    return $product['category'] === $category && (!$subcategory || $product['subcategory'] === $subcategory);
});
if (empty($filteredProducts)) {
    echo "<main><h1>No products found!</h1></main>";
    include 'includes/footer.php';
    exit;
}
?>
<main>
    <h1><?php echo htmlspecialchars(ucfirst($category)); ?><?php echo $subcategory ? ' - ' . htmlspecialchars(ucfirst($subcategory)) : ''; ?> Plants</h1>
    <ul>
        <?php foreach ($filteredProducts as $product): ?>
            <li>
                <a href="products.php?pid=<?php echo urlencode($product['pid']); ?>">
                    <img src="<?php echo htmlspecialchars($product['imagepath']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="120" height="140">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <strong>Price: €<?php echo htmlspecialchars($product['price']); ?></strong>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</main>
<?php include('includes/footer.php')?>