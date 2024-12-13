<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<?php
    $pageTitle = "Plantopia | Logout";
    include('includes/header.php'); 
    include('includes/navbar.php');
?>
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
</body>
<?php include('footer.php') ?>
</html>