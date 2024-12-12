<?php
    $pageTitle = "Plantopia | Climbers and Vines";
    include('includes/header.php');
    include('includes/navbar.php');
?>
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
    <?php include('includes/footer.php')?>
</body>
</html>