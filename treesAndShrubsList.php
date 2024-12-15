<?php
    $pageTitle = "Plantopia | Trees and Shrubs";
    include('includes/header.php'); 
    include('includes/navbar.php');
?>
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
                            <p class="card-heading">Boxwood - 15€</p>
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
    <?php include('includes/footer.php')?>
</body>
</html>