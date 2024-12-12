<?php
    $pageTitle = "Plantopia | Indoor Plants";
    include('includes/header.php'); 
    include('includes/navbar.php');
?>
<body>
    <div>
        <div class="container">
            <h1>Indoor Plants</h1>
            <p class="card-description">Select a category to explore our indoor plants:</p>
            <div class="card-wrapper">
                <div class="card">
                    <h2 class="card-heading"><a href="tropicalPlantsList.php">Tropical Plants</a></h2>
                    <p class="card-description">Discover a wide variety of tropical plants to bring a lush feel to your indoor space.</p>
                </div>
                <div class="card">
                    <h2 class="card-heading"><a href="succulentsList.php">Succulents</a></h2>
                    <p class="card-description">Find the perfect succulents to add greenery with minimal care.</p>
                </div>
            </div>
            <p><a href="index.php">Return to Homepage</a></p>
        </div>
    </div>

</body>
<?php include('includes/footer.php')?>
</html>
