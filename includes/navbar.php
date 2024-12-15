<body>
    <header class="hero-banner">
        <img src="/img/Title.png" alt="Welcome to Plantopia">
    </header>
    <div>
        <div class="header-links">
            <div class="header-links-wrapper">
                <div class="left-links">
                    <a href="user.php" class="header-link">Profile</a>
                    <a href="wishlist.php" class="header-link">Wishlist</a>
                    <a href="logout.php" class="header-link">Logout</a>
                </div>

                <div class="right-links">
                    <a href="login.php" class="header-link">Login</a>
                    <a href="registration.php" class="header-link">Register</a>
                    <div class="cart-icon">
                        <a href="shoppingCart.php">
                            <img id="cart-icon" src="./img/ShoppingCartIcon.png" alt="Shopping Cart" width="40">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <nav>
                <ul>
                    <li><a href="indoorPlantsList.php">Indoor Plants</a>
                        <ul>
                            <li><a href="tropicalPlantsList.php">Tropical Plants</a></li>
                            <li><a href="succulentsList.php">Succulents</a></li>
                        </ul>
                    </li>
                    <li><a href="outdoorPlantsList.php">Outdoor Plants</a>
                        <ul>
                            <li><a href="treesAndShrubsList.php">Trees and Shrubs</a></li>
                            <li><a href="climbersAndVinesList.php">Climbers and Vines</a></li>
                        </ul>
                    </li>
                    <li><a href="specialityPlantsList.php">Speciality Plants</a></li>
                    <li><a href="about.php">About Us</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <script>
        function updateCartIcon() {
            fetch('cartStatus.php?status=json')
                .then(response => response.json())
                .then(data => {
                    const cartIcon = document.getElementById('cart-icon');
                    const cartCountElement = document.getElementById('cart-count');

                    if (data.hasItems) {
                        // Change to filled icon and show the total count
                        cartIcon.src = './img/ShoppingCartIconFilled.png';
                        if (cartCountElement) {
                            cartCountElement.textContent = data.totalItems; // Update the cart count
                        }
                    } else {
                        // Change to empty icon and reset the count
                        cartIcon.src = './img/ShoppingCartIcon.png';
                        if (cartCountElement) {
                            cartCountElement.textContent = '';
                        }
                    }
                })
                .catch(error => console.error('Error updating cart icon:', error));
        }

        // Call this function on page load
        updateCartIcon();
    </script>

</body>