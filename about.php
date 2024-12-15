<?php
session_start();

    $pageTitle = "Plantopia | About Us";
    include('includes/header.php');
    include('includes/navbar.php');
?>

<body>
    <div class="container">
        <header>
            <h1>About Us!</h1>
            <p class="font-16">We are three <strong>AI students</strong> who wanted to jump into the plant business!</p>
        </header>

        <section class="about-section">
            <h2>Meet the Team!</h2>
            <div class="about-wrapper">
                <div class="about-card">
                    <img src="./img/ari.jpeg" alt="Photo of Ari" class="team-photo">
                    <p class="about-description"><strong>Ari!</strong> With a bubbly personality and a lot of motivation in finishing her studies, she is the sunshine in our group!</p>
                </div>
        
                <div class="about-card">
                    <img src="./img/hussain.jpeg" alt="Photo of Hussain" class="team-photo">
                    <p class="about-description"><strong>Hussain!</strong> Known for his friendly demeanor and positive attitude, Hussain adds a welcoming vibe to our team.</p>
                </div>
        
                <div class="about-card">
                    <img src="./img/liz.jpeg" alt="Photo of Lizzy" class="team-photo">
                    <p class="about-description"><strong>Lizzy!</strong> Plant lover and caretaker, Lizzy brings her passion and knowledge to help everyone feel the joy of growing plants.</p>
                </div>
            </div>
        </section>

        <section class="contact-section">
            <h2>Contact</h2>
            <p class="center-text">Get in touch with us:</p>
            <ul>
                <li><strong>Phone:</strong> 0800 4555500</li>
                <li><strong>Address:</strong> Schloßlände 26, 85049 Ingolstadt</li>
                <li><a href="mailto:info@plantopia.com">info@plantopia.com</a></li>
            </ul>
        </section>

        <p class="return-home"><a href="index.php">Return to Homepage</a></p>
    </div>
    <?php include('includes/footer.php')?>
</body>
</html>