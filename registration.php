<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    if (empty($username) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required!";
        exit;
    }

    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit;
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Save the user to a JSON file
    $usersFile = './json/users.json';
    $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            echo "Username already exists!";
            exit;
        }
    }

    $users[] = ['username' => $username, 'password' => $hashedPassword];
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

    // Redirect to login page
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        
        <link rel="stylesheet" href="./css/design.css">
        <link rel="stylesheet" href="./css/interactive.css">
        <link rel="stylesheet" href="./css/layout.css">
        <link rel="stylesheet" href="./css/pages.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <h1>Create a New Account</h1>
            <form id="registrationForm" method="POST" action="registration.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username">
                <span id="usernameError" class="error-message"></span> 

                <label for="registerPassword">Password:</label>
                <div class="password-container">
                    <input type="password" id="registerPassword" name="password" placeholder="Enter your password">
                    <button type="button" id="toggleRegisterPassword" class="toggle">
                        <i class="fa-regular fa-eye" id="registerPasswordIcon"></i>
                    </button>
                </div>
                <span id="passwordError" class="error-message"></span>
                
                <label for="registerConfirmPassword">Confirm Password:</label>
                <div class="password-container">
                    <input type="password" id="registerConfirmPassword" name="confirmPassword" placeholder="Re-enter your password to confirm">
                    <button type="button" id="toggleRegisterConfirmPassword" class="toggle">
                        <i class="fa-regular fa-eye" id="registerConfirmPasswordIcon"></i>
                    </button>
                </div>
                <span id="confirmPasswordError" class="error-message"></span>

                <div class="button-container">
                    <button type="submit" class="register-button">📝 Register</button>
                    <button type="reset" class="reset-button">♻️ Reset</button>
                    <button type="button" class="cancel-button" onclick="window.location.href='login.php'">❌ Cancel</button>
                </div>
            </form>

            
            <div style="height: 200px;"></div>
            <button id="back-to-top" style="display:none; position:fixed; bottom:20px; left:50%; transform:translateX(-50%); padding:10px; font-size:24px; cursor:pointer; background-color:#007BFF; color:white; border:none; border-radius:50%; height:50px; width:50px;">
                ↑
            </button>

            <p><a href="index.php">Return to Homepage</a></p>
        </div>
        
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
        <script src="./javascript/formValidation.js"></script>
        <script src="./javascript/registrationValidation.js"></script>
        <script src="./javascript/loginValidation.js"></script>
        <script src="./javascript/darkmode.js"></script>
        <script src="./javascript/topButton.js"></script>
    </body>
</html>