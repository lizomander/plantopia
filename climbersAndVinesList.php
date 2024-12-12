<<<<<<< HEAD
<?php
    $pageTitle = "About Us"; // Dynamic page title
    include('includes/header.php'); // Include header
    include('includes/navbar.php'); // Include navbar
?>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Climbers and Vines</title>
    <link rel="stylesheet" href="./css/design.css">
    <link rel="stylesheet" href="./css/interactive.css">
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/pages.css">

</head>
>>>>>>> 0e640d769a017676a9225268fad7c72d71804808
<body>
    <div class="container">
        <h1>Climbers and Vines</h1>
        <ul>
            <li>
                <div class="card">
                    <a class="card-wrapper" href="product.php?pid=7">
                        <img src="./img/boston_ivy.jpg" alt="Boston Ivy" width="120" height="140">
                        <div>
                            <p class="card-heading">Boston Ivy - 8€</p>
                            <p class="card-description">Perfect for covering walls and trellises, Boston Ivy brings a lush green look to any space.</p>
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

<<<<<<< HEAD
<?php
    include('includes/footer.php'); 
?>
=======
    <footer>
        <p>&copy; 2024 Plantopia. All rights reserved.</p>
        <p>Contact us at <a href="mailto:info@plantopia.com">info@plantopia.com</a></p>
        <ul>
            <li><a href="privacy.php">Privacy Policy</a></li>
            <li><a href="terms.php">Terms of Service</a></li>
        </ul>
    </footer>
    <script src="./javascript/darkmode.js"></script>
    <script src="./javascript/topButton.js"></script>
>>>>>>> 0e640d769a017676a9225268fad7c72d71804808
</body>
</html>