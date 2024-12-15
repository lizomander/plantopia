<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = "Plantopia | Edit Profile";
include('includes/header.php');
include('includes/navbar.php');

// Load user data (from users.json)
$usersFile = 'json/users.json'; // Adjust the path if needed
if (!file_exists($usersFile)) {
    die("Error: Users file not found.");
}

$usersData = json_decode(file_get_contents($usersFile), true);
if ($usersData === null) {
    die("Error: Failed to decode users data.");
}

// Find the current user's data
$currentUser = $_SESSION['user'];
$currentUserData = null;

foreach ($usersData as &$user) {
    if ($user['username'] === $currentUser) {
        $currentUserData = &$user; // Reference the user data for editing
        break;
    }
}

if (!$currentUserData) {
    die("Error: User not found.");
}

// Handle form submission
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = trim($_POST['username']);
    $newPassword = trim($_POST['password']);
    $repeatPassword = trim($_POST['repeat_password']);

    // Validate username
    if (strlen($newUsername) < 5) {
        $error = "Username must be at least 5 characters long.";
    } elseif (!preg_match('/[A-Z]/', $newUsername)) {
        $error = "Username must contain at least one uppercase letter.";
    } elseif (!preg_match('/[a-z]/', $newUsername)) {
        $error = "Username must contain at least one lowercase letter.";
    }
    // Validate password
    elseif (strlen($newPassword) < 10) {
        $error = "Password must be at least 10 characters long.";
    } elseif ($newPassword !== $repeatPassword) {
        $error = "Passwords do not match.";
    } else {
        // Update the user data
        $currentUserData['username'] = $newUsername;
        $currentUserData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);

        // Save changes back to users.json
        if (file_put_contents($usersFile, json_encode($usersData, JSON_PRETTY_PRINT)) === false) {
            $error = "Error: Failed to save changes.";
        } else {
            // Update session username
            $_SESSION['user'] = $newUsername;

            // Redirect to customer page
            header('Location: user.php');
            exit;
        }
    }
}
?>

<body>
<div class="container">
    <h1>Edit Profile</h1>

    <!-- Display errors -->
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">New Username</label>
            <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars($currentUserData['username'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="repeat_password" class="form-label">Repeat Password</label>
            <input type="password" id="repeat_password" name="repeat_password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
        <a href="user.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>

<?php include('includes/footer.php'); ?>