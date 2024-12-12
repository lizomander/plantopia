<?php
    $pageTitle = "Plantopia | Speciality Plants";
    include('includes/header.php'); 
    include('includes/navbar.php');
?>

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
    <?php include('footer.php')?>
</body>
</html>