<?php
    $pageTitle = "Plantopia | Outdoor Plants";
    include('includes/header.php'); 
    include('includes/navbar.php');
?>
<body>
    <div>
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
    <?php include('footer.php')?>
</body>
</html>
