<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speciality Plants</title>
    <link rel="stylesheet" href="./css/design.css">
    <link rel="stylesheet" href="./css/interactive.css">
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/pages.css">
</head>

<body>
    <div class="container">
        <h1>Speciality Plants</h1>
        <p>Explore our unique collection of speciality plants, perfect for those looking to add something special to their green spaces.</p>

        <ul>
            <li>
                <div class="card">

                    <a class="card-wrapper" href="product.php?pid=8">
                        <img src="./img/orchideen.jpg" alt="Orchid" width="120" height="140">
                        <div>
                            <p class="card-heading">Orchid (<em>Phalaenopsis</em>) - 20€</p>
                            <p class="card-description">Bring elegance to your home with this delicate, exotic orchid. Perfect for brightening up indoor spaces.</p>
                        </div>
                    </a>
                </div>
            </li>
            
            <li>
                <div class="card">
                    <a class="card-wrapper"  href="product.php?pid=9">
                        <img src="./img/lilys.jpg" alt="Lily" width="120" height="140">
                        <div>
                            <p class="card-heading">Lily (<em>Lilium</em>) - 15€ </p>
                            <p class="card-description">A classic beauty, the lily adds charm to any setting with its vibrant blooms and subtle fragrance.</p>
                        </div>
                    </a>
                </div>
            </li>

            <li>
                <div class="card">
                    <a class="card-wrapper" href="product.php?pid=10">
                        <img src="./img/cushionmossterrarium.jpg" alt="Cushion Moss" width="120" height="140">
                        <div>
                            <p class="card-heading">Cushion Moss (<em>Leucobryum glaucum</em>) - 10€ </p>
                            <p class="card-description">An excellent choice for terrariums, Cushion Moss is a dense, green moss that brings a natural touch indoors.</p>
                        </div>
                    </a>
                </div>
            </li>
        </ul>

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