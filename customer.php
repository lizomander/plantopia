<?php
$pageTitle = 'Customer Profile';
$pageStyle = 'customer.css';
include 'includes/header.php';
?>

<main>
    <h1>Your Profile</h1>
    <form action="updateProfile.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <span id="usernameError" class="error"></span>

        <label for="customerCurrentPassword">Current Password:</label>
        <input type="password" id="customerCurrentPassword" name="currentPassword" required>
        <span id="currentPasswordError" class="error"></span>

        <label for="customerNewPassword">New Password:</label>
        <input type="password" id="customerNewPassword" name="newPassword">
        <span id="newPasswordError" class="error"></span>

        <label for="customerConfirmPassword">Confirm New Password:</label>
        <input type="password" id="customerConfirmPassword" name="confirmPassword">
        <span id="confirmPasswordError" class="error"></span>

        <button type="submit">Update Profile</button>
    </form>
</main>

<script src="/javascript/validation/validation.js"></script>
<?php include 'includes/footer.php'; ?>