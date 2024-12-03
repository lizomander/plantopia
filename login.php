<?php
$pageTitle = 'Login';
$pageStyle = 'login.css';
include 'includes/header.php';
?>
<main>
    <h1>Login</h1>
    <form id="loginForm" action="processLogin.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <span id="usernameError" class="error"></span>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <span id="passwordError" class="error"></span>

        <button type="submit">Login</button>
    </form>
</main>
<?php include 'includes/footer.php'; ?>