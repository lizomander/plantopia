<?php
    $pageTitle = "Main Page";
    include('includes/header.php'); 
    include('includes/navbar.php');
?>
<body>
    <div id="welcome-message" class="welcome-message"></div>
    <div>
        <section class="slideshow">
            <div class="slides">
                <div class="slide">
                    <a href="product_succulents.php" class="slide-link">
                        <p>Big Sale on Succulents! 20% Off</p>
                    </a>
                </div>
                <div class="slide">
                    <a href="product_japanese_maple.php" class="slide-link">
                        <p>New Arrivals: Japanese Maple Trees</p>
                    </a>
                </div>
                <div class="slide">
                    <p>Free Shipping on Orders Over $50!</p>
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


    <script>
        // Update cart icon based on session data
        fetch('cartStatus.php')
            .then(response => response.json())
            .then(data => {
                if (data.hasItems) {
                    document.getElementById('cart-icon').src = './img/ShoppingCartIconFilled.png';
                } else {
                    document.getElementById('cart-icon').src = './img/ShoppingCartIcon.png';
                }
            })
            .catch(error => console.error('Error fetching cart status:', error));
    </script>
</body>
<?php
    include('includes/footer.php'); 
?>
</html>
