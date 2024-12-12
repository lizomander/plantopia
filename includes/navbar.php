<body>
    <header class="hero-banner">
        <img src="./img/small-Title.png" alt="Welcome to Plantopia">
    </header>
    <div>
        <div class="header-links">
            <div class="header-links-wrapper">
                <!-- Left Links: Profile, Logout -->
                <div class="left-links">
                    <a href="customer.php" class="header-link">Profile</a>
                    <a href="logout.php" class="header-link">Logout</a>
                </div>

                <!-- Right Links: Login, Register, and Shopping Cart -->
                <div class="right-links">
                    <a href="login.php" class="header-link">Login</a>
                    <a href="registration.php" class="header-link">Register</a>

                    <!-- Shopping Cart Icon -->
                    <div class="cart-icon">
                        <a href="shoppingCart.php">
                            <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation: Categories and Subcategories -->
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
</body>