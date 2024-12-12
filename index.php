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
                    <a href="product_monstera.php">
                        <img src="./img/monstera.jpeg" alt="Monstera">
                        <p>Monstera</p>
                    </a>
                </div>
                <div class="plant-item">
                    <a href="product_aloe_vera.php">
                        <img src="./img/aloevera.jpeg" alt="Aloe Vera">
                        <p>Aloe Vera</p>
                    </a>
                </div>
                <div class="plant-item">
                    <a href="product_succulents.php">
                        <img src="./img/succulents.jpeg" alt="Succulent">
                        <p>Succulent</p>
                    </a>
                </div>
            </div>
        </section>
    </div>
    <div style="height: 200px;"></div>
    <button id="back-to-top" style="display:none; position:fixed; bottom:20px; left:50%; transform:translateX(-50%); padding:10px; font-size:24px; cursor:pointer; background-color:#007BFF; color:white; border:none; border-radius:50%; height:50px; width:50px;">
        ↑
    </button>
    <footer>
        <div class="footer-logo">
            <img src="./img/1.png" alt="Plantopia Logo" class="footer-logo-img">
        </div>
        <p>&copy; 2024 Plantopia. All rights reserved.</p>
        <p>Contact us at <a href="mailto:info@plantopia.com">info@plantopia.com</a></p>
        <ul>
            <li><a href="privacy.php">Privacy Policy</a></li>
            <li><a href="terms.php">Terms of Service</a></li>
        </ul>
    </footer>
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
