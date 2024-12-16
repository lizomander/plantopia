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

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $usersFile = './json/users.json';
    $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

    foreach ($users as $user) {
        if ($user['username'] === $username) {
            echo "Username already exists!";
            exit;
        }
    }

    $users[] = [
        'username' => $username,
        'password' => $hashedPassword,
        'role' => 'customer'
    ];

    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

    header('Location: login.php');
    exit;
}
?>


<?php
    $pageTitle = "Plantopia | Registration";
    include('includes/header.php'); 
    include('includes/navbar.php');
?>
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
        <?php include('includes/footer.php')?>
    </body>
</html>