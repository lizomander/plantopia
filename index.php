<?php
    session_start();
    $pageTitle = "Plantopia | Homepage";
    include('includes/header.php'); 
    include('includes/navbar.php');
    $data = json_decode(file_get_contents('./json/data.json'), true);
    $products = array_column($data['products'], null, 'pid'); // Index products by pid
?>
<body>
    <div id="welcome-message" class="welcome-message"></div>
    <div>
        <section class="slideshow">
            <div class="slides">
                <div class="slide">
                    <a href="product.php?pid=4" class="slide-link">
                        <p>New Arrivals: Japanese Maple Trees</p>
                    </a>
                </div>
                <div class="slide">
                    <p>Free Shipping on Orders Over 20€!</p>
                </div>
                <div class="slide">
                    <p>🌱 Gardening Tips: Water your plants early in the morning to reduce water loss due to evaporation!</p>
                </div>
                <div class="slide">
                    <p>🌟 Did You Know? Monstera plants can grow up to 20 metres tall indoors with proper care.</p>
                </div>
                <div class="slide">
                    <p>📢 Community Update: Join us for the Plant Lovers Meetup on January 15th at the City Garden Center!</p>
                </div>
            </div>
        </section>
    </div>
    <div>
    <section class="bestsellers">
        <h2>Our Bestseller Plants</h2>
        <div class="plant-list">
            <div class="plant-item">
                <a href="product.php?pid=1">
                    <img src="./img/monstera.jpeg" alt="Monstera">
                    <p>Monstera</p>
                </a>
            </div>
            <div class="plant-item">
                <a href="product.php?pid=2">
                    <img src="./img/aloevera.jpeg" alt="Aloe Vera">
                    <p>Aloe Vera</p>
                </a>
            </div>
            <div class="plant-item">
                <a href="product.php?pid=3">
                    <img src="./img/succulents.jpeg" alt="Succulents">
                    <p>Succulents</p>
                </a>
            </div>
        </div>
    </section>
    </div>
    
    <?php
    if (isset($_SESSION['recently_viewed']) && !empty($_SESSION['recently_viewed'])) {
        echo "<section class='recently-viewed'><h2>Recently Viewed Products</h2>";
        echo "<ul class='product-list'>";

        foreach ($_SESSION['recently_viewed'] as $pid) {
            $product = $products[$pid] ?? null; // Fetch product details
            if ($product) { // Validate the product exists
                echo "<li>";
                echo "<a href='product.php?pid=" . htmlspecialchars($pid) . "'>";
                echo "<img src='" . htmlspecialchars($product['imagepath']) . "' alt='" . htmlspecialchars($product['name']) . "'>";
                echo "<div class='product-info'>";
                echo "<p class='product-name'>" . htmlspecialchars($product['name']) . "</p>";
                echo "<p>" . htmlspecialchars($product['price']) . "€</p>";
                echo "</div>";
                echo "</a>";
                echo "</li>";
            }
        }

        echo "</ul></section>";
    }
    ?>
</body>
<?php
    include('includes/footer.php'); 
?>
</html>
