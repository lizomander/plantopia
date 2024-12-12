<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outdoor Plants</title>
    <link rel="stylesheet" href="./css/design.css">
    <link rel="stylesheet" href="./css/interactive.css">
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/pages.css">
</head>
<body>
    <div>
        <div class="header-links">
            <div class="header-links-wrapper">
                
                <div>
                    <a href="customer.php">Profile & Logout</a>
                    <a href="shoppingCart.php">Shopping Cart</a>
                </div>
                
                <div>
                    <a href="login.php">Login</a>
                    <a href="registration.php">Register</a>
                </div>

            </div>
        </div>

        <div class="container">
            <h1>Outdoor Plants</h1>
            <p class="card-description">Select a category to explore our outdoor plants:</p>
            

            <div class="card-wrapper">

                <div class="card">
                    <h2 class="card-heading"><a href="treesAndShrubsList.php">Trees and Shrubs</a></h2>
                    <p class="card-description">Explore our selection of trees and shrubs to add structure and natural beauty to any landscape.</p>
                </div>
                

                <div class="card">
                    <h2 class="card-heading"><a href="climbersAndVinesList.php">Climbers and Vines</a></h2>
                    <p class="card-description">Enhance your garden with our climbers and vines, perfect for adding height and vibrant greenery to vertical spaces.</p>
                </div>
            </div>

            <p><a href="index.php">Return to Homepage</a></p>
        </div>
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
    <script src="./javascript/darkmode.js"></script>
    <script src="./javascript/topButton.js"></script>
</body>
</html>
