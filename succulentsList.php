<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Succulents</title>
    <link rel="stylesheet" href="./css/design.css">
    <link rel="stylesheet" href="./css/interactive.css">
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/pages.css">
</head>
<body>
    <div class="container">
        <h1>Succulents</h1>
        <ul>
            <li>
                <div class="card">
                    <a class="card-wrapper" href="product.php?pid=2">
                        <img src="./img/aloevera.jpeg" alt="Aloe Vera" width="120" height="140">
                        <div>
                            <p class="card-heading">Aloe Vera - 5€</p>
                            <p class="card-description"> Perfect for air purification and easy to care for, Aloe Vera is a great addition to any indoor space.</p>
                        </div>
                    </a>
                </div>
            </li>
            <li>
                <div class="card">
                    <a class="card-wrapper" href="product.php?pid=3">
                        <img src="./img/succulents.jpeg" alt="Succulents" width="120" height="140">
                        <div>
                            <p class="card-heading">Succulents - 3€ each </p>
                            <p class="card-description">A variety of low-maintenance succulents for any indoor space.</p>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
    
        <p><a href="indoorPlantsList.php">Back to Indoor Plants</a></p>
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