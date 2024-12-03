<?php
$pageTitle = 'Home';
include 'includes/header.php';
include 'includes/navbar.php';
?>
<main>
    <div id="welcome-message" class="welcome-message"></div>
    <section class="slideshow">
        <div class="slides">
            <div class="slide">
                <a href="products.php" class="slide-link">
                    <p>Big Sale on Succulents! 20% Off</p>
                </a>
            </div>
            <div class="slide">
                <a href="products.php" class="slide-link">
                    <p>New Arrivals: Japanese Maple Trees</p>
                </a>
            </div>
            <div class="slide">
                <p>Free Shipping on Orders Over $50!</p>
            </div>
        </div>
    </section>
    <section class="bestsellers">
        <h2>Our Bestseller Plants</h2>
        <div class="plant-list">
            <div class="plant-item">
                <a href="products.php">
                    <img src="./img/monstera.jpeg" alt="Monstera">
                    <p>Monstera</p>
                </a>
            </div>
            <div class="plant-item">
                <a href="products.php">
                    <img src="./img/aloevera.jpeg" alt="Aloe Vera">
                    <p>Aloe Vera</p>
                </a>
            </div>
            <div class="plant-item">
                <a href="products.php">
                    <img src="./img/succulents.jpeg" alt="Succulent">
                    <p>Succulent</p>
                </a>
            </div>
        </div>
    </section>
</main>
<?php include 'includes/footer.php'; ?>