<?php
$pageTitle = 'Register';
$pageStyle = 'registration.css';
include 'includes/header.php';
?>

<main>
    <h1>Register</h1>
    <form id="registrationForm" action="processRegistration.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <span id="usernameError" class="error"></span>

        <label for="registerPassword">Password:</label>
        <input type="password" id="registerPassword" name="password" required>
        <span id="passwordError" class="error"></span>

        <label for="registerConfirmPassword">Confirm Password:</label>
        <input type="password" id="registerConfirmPassword" name="confirmPassword" required>
        <span id="confirmPasswordError" class="error"></span>

        <button type="submit">Register</button>
    </form>
</main>

<script src="/javascript/validation/registrationValidation.js"></script>
<?php include 'includes/footer.php'; ?>