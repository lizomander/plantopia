<?php
$pageTitle = "Plantopia | Login";
include('includes/header.php'); 
include('includes/navbar.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "Both fields are required!";
        exit;
    }

    // Load users from JSON
    $usersFile = './json/users.json';
    $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $username;
            header('Location: shoppingCart.php');
            exit;
        }
    }

    echo "Invalid username or password!";
    exit;
}
?>
<body>
    <div class="container">
        <h1>Login to Your Account</h1>
        <form action="login.php" method="POST" id="loginForm">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username">
            </div>
            <br>
            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <button type="button" id="togglePassword" class="toggle">
                    <i class="fa-regular fa-eye" id="passwordIcon"></i>
                </button>
            </div>
            <br>
            <div class="button-container">
                <button type="submit" class="login-button">🔐 Login</button>
                <button type="button" class="register-button" onclick="window.location.href='registration.php'">📝 Register</button>
            </div>   
        </form>

        <p><a href="index.php">Return to Homepage</a></p>
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
<?php
    include('footer.php')
?>