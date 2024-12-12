<?php
session_start();
session_destroy();
header('Location: login.php');
exit;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>   
    <link rel="stylesheet" href="./css/design.css">
    <link rel="stylesheet" href="./css/interactive.css">
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/pages.css">
</head>
<body>
    <div class="container">
        <header class="logout-header">
            <h1>Oh no! You’ve left us!</h1>
        </header>

        <section class="logout-message">
            <figure>
                <img src="./img/Unknown-2.gif" alt="Goodbye" class="goodbye-img">
                <figcaption class="goodbye-caption">
                    We’ll miss you, plant parent! 🌱 But don’t worry, your leafy friends are in safe hands.  
                    Come back soon—we’ve got new sprouts and fresh deals waiting just for you! (And maybe a few plant puns too. 😉)
                </figcaption>
            </figure>
        </section>

        <section class="logout-links">
            <p>
                Feeling nostalgic already? <a href="login.php" class="green-link">Log back in</a>  
                or <a href="index.php" class="green-link">return to our homepage</a>. We promise not to water your plants too much while you're away!
            </p>
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
    <script src="./javascript/darkmode.js"></script>
    <script src="./javascript/topButton.js"></script>
</body>
</html>