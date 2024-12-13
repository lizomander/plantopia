<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = "Plantopia | Customer Page";
include('includes/header.php');
include('includes/navbar.php');

// Load orders.json
$ordersFile = 'json/orders.json';
$ordersData = [];
if (file_exists($ordersFile)) {
    $ordersData = json_decode(file_get_contents($ordersFile), true);
}

$currentUser = $_SESSION['user'];
$userOrders = array_filter($ordersData, function ($order) use ($currentUser) {
    return $order['user'] === $currentUser;
});

?>

<body>
<div class="container">
    <h1>Welcome, <?= htmlspecialchars($currentUser) ?>!</h1>

    <div class="profile-section">
        <h2>Your Profile</h2>
        <p><strong>Username:</strong> <?= htmlspecialchars($currentUser) ?></p>
        <p><strong>Account Type:</strong> Regular User</p>
        <p><strong>Account Status:</strong> Active</p>
        <a href="editProfile.php" class="btn btn-primary">Edit Profile</a>
    </div>

    <hr>

    <!-- Order History Section -->
    <div class="order-history">
        <h2>Your Order History</h2>

        <?php if (empty($userOrders)): ?>
            <p>You have not placed any orders yet.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Products</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($userOrders as $index => $order): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td>
                            <?php foreach ($order['cart'] as $productId => $quantity): ?>
                                <p>Product ID <?= $productId ?>: <?= $quantity ?> pcs</p>
                            <?php endforeach; ?>
                        </td>
                        <td>$<?= number_format($order['total'], 2) ?></td>
                        <td><?= htmlspecialchars($order['timestamp']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
</body>
<?php include('includes/footer.php'); ?>