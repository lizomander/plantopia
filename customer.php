<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
    <link rel="stylesheet" href="./css/design.css">
    <link rel="stylesheet" href="./css/interactive.css">
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/pages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Customer Profile</h1>
        <form action="#" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username">            

        <label for="customerCurrentPassword">Current Password:</label>        
        <div class="password-container">
            <input type="password" id="customerCurrentPassword" placeholder="Enter current password">
            <button type="button" id="toggleCustomerCurrentPassword" class="toggle">
                <i class="fa-regular fa-eye" id="customerCurrentPasswordIcon"></i>
            </button>
        </div>
        <span id="currentPasswordError" class="error-message"></span>

        <label for="customerNewPassword">New Password:</label>   
        <div class="password-container">
            <input type="password" id="customerNewPassword" placeholder="Enter new password">
            <button type="button" id="toggleCustomerNewPassword" class="toggle">
                <i class="fa-regular fa-eye" id="customerNewPasswordIcon"></i>
            </button>
        </div>
        <span id="newPasswordError" class="error-message"></span>

        <label for="customerConfirmPassword">Confirm Password:</label>        <div class="password-container">
            <input type="password" id="customerConfirmPassword" placeholder="Confirm new password">
            <button type="button" id="toggleCustomerConfirmPassword" class="toggle">
                <i class="fa-regular fa-eye" id="customerConfirmPasswordIcon"></i>
            </button>
        </div> 
        <span id="confirmPasswordError" class="error-message"></span>
        
        <button type="submit">Save Changes</button>
        </form>
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
        <div style="height: 200px;"></div>
        <button id="back-to-top" style="display:none; position:fixed; bottom:20px; left:50%; transform:translateX(-50%); padding:10px; font-size:24px; cursor:pointer; background-color:#007BFF; color:white; border:none; border-radius:50%; height:50px; width:50px;">
            ↑
        </button>
    </footer>
    <script src="./javascript/darkmode.js"></script>
    <script src="./javascript/topButton.js"></script>
    <script src="./javascript/formValidation.js"></script>
</body>
</html>