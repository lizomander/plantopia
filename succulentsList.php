<?php
    $pageTitle = "Plantopia | Succulents";
    include('includes/header.php'); 
    include('includes/navbar.php');
?>
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
                            <p class="card-heading">Succulents - 5€</p>
                            <p class="card-description">A variety of low-maintenance succulents for any indoor space.</p>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
        <p><a href="indoorPlantsList.php">Back to Indoor Plants</a></p>
        <p><a href="index.php">Return to Homepage</a></p>
    </div>
    <?php
        include('footer.php')
    ?>
</body>
</html>