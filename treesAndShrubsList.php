<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trees and Shrubs</title>
    <link rel="stylesheet" href="./css/design.css">
    <link rel="stylesheet" href="./css/interactive.css">
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/pages.css">
</head>
<body>
    <div class="container">
        <h1>Trees and Shrubs</h1>
        <ul>
            <li >
                <div class="card">                    
                    <a class="card-wrapper" href="product.php?pid=4">
                        <img src="./img/japanese_maple.jpg" alt="Japanese Maple" width="120" height="140">
                        <div>
                            <p class="card-heading">Japanese Maple - 30€</p>
                            <p class="card-description">Add elegance and color to your garden with this beautiful Japanese Maple tree.</p>
                        </div>
                    </a>
                </div>
            </li>
            <li>
                <div class="card">
                    <a class="card-wrapper" href="product.php?pid=5">
                        <img src="./img/boxwood.jpg" alt="Boxwood" width="120" height="140">
                        <div>
                            <p class="card-heading">Boxwood- 15€</p>
                            <p class="card-description">Perfect for natural borders, Boxwood hedges bring structure and privacy to any outdoor area.</p>
                        </div>
                    </a>

                </div>
            </li>
            <li>
                <div class="card">
                    <a class="card-wrapper" href="product.php?pid=6">
                        <img src="./img/golden_bamboo.jpg" alt="Golden Bamboo" width="120" height="140">
                        <div>
                            <p class="card-heading">Golden Bamboo - 25€</p>
                            <p class="card-description">Fast-growing and hardy, Golden Bamboo adds a tropical feel to your garden.</p>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
        <p><a href="outdoorPlantsList.php">Back to Outdoor Plants</a></p>
        <p><a href="index.php">Return to Homepage</a></p>
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