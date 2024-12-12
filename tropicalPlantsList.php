<?php
    $pageTitle = "Plantopia | Tropical Plants";
    include('includes/header.php'); 
    include('includes/navbar.php');
?>
<body>
    <div class="container">
        <h1>Tropical Plants</h1>
        <ul>
            <li>
                <div class="card">

                    <a class="card-wrapper" href="product.php?pid=1">
                        <img src="./img/monstera.jpeg" alt="Monstera" width="120" height="140">
                        <div>
                            <p class="card-heading">Monstera - 15€ </p>
                            <p class="card-description">A beautiful tropical plant that adds lush greenery to your home.</p>
                        </div>
                    </a>

                </div>
            </li>
        </ul>
    
        <p><a href="indoorPlantsList.php">Back to Indoor Plants</a></p>
        <p><a href="index.php">Return to Homepage</a></p>
        <?php include('includes/footer.php'); ?>    
    </div>
</body>
</html>
