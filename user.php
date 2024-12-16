<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = "Plantopia | User Page";
include('includes/header.php');
include('includes/navbar.php');

$productsFile = 'json/data.json';
$productsData = json_decode(file_get_contents($productsFile), true);

$currentUser = $_SESSION['user'];
$currentUserRole = $_SESSION['role'] ?? 'customer';

$ordersFile = 'json/orders.json';
$ordersData = [];
if (file_exists($ordersFile)) {
    $ordersData = json_decode(file_get_contents($ordersFile), true);
}

$userOrders = array_filter($ordersData, function ($order) use ($currentUser) {
    return isset($order['user']) && $order['user'] === $currentUser;
});
?>
<body>
<div class="container">
    <h1>Welcome, <?= htmlspecialchars($currentUser) ?>!</h1>
    <?php if ($currentUserRole === 'admin'): ?>
        <div class="admin-section">
            <h2>Admin Dashboard</h2>
            <p>You have administrative privileges. Use the options below:</p>
            <ul>
                <li><a href="admin.php?section=orders">Manage Orders</a></li>
                <li><a href="admin.php?section=users">Manage Users</a></li>
                <li><a href="admin.php?section=admins">Manage Admins</a></li>
            </ul>
        </div>
    <?php else: ?>
        <div class="profile-section">
            <h2>Your Profile</h2>
            <p><strong>Username:</strong> <?= htmlspecialchars($currentUser) ?></p>
            <p><strong>Account Type:</strong> Regular User</p>
            <p><strong>Account Status:</strong> Active</p>
            <a href="editProfile.php" class="btn btn-primary">Edit Profile</a>
        </div>
        <hr>
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
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($userOrders as $index => $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($index) ?></td>
                            <td>
                                <?php foreach ($order['cart'] as $productId => $quantity): ?>
                                    <?php 
                                    // Fetch product details from data.json
                                    $productDetails = null;
                                    foreach ($productsData['products'] as $product) {
                                        if ($product['pid'] == $productId) {
                                            $productDetails = $product;
                                            break;
                                        }
                                    }
                                    ?>
                                    <?php if ($productDetails): ?>
                                        <p><?= htmlspecialchars($productDetails['name']) ?>: <?= $quantity ?> pcs</p>
                                    <?php else: ?>
                                        <p>Unknown Product: <?= $quantity ?> pcs</p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>
                            <td>€<?= number_format($order['total'], 2) ?></td>
                            <td>
                                <?php if ($order['status'] === 'canceled'): ?>
                                    <span class="badge bg-danger">Canceled</span>
                                    <p><strong>Reason:</strong> <?= htmlspecialchars($order['rejection_reason'] ?? 'No reason provided') ?></p>
                                <?php else: ?>
                                    <span class="badge bg-info"><?= htmlspecialchars($order['status']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($order['timestamp']) ?></td>
                            <td style="text-align: center; vertical-align: middle;">
                                <?php if (!in_array($order['status'], ['shipped', 'finished', 'canceled'])): ?>
                                    <form action="cancelOrder.php" method="POST" style="margin: 0;">
                                        <input type="hidden" name="order_id" value="<?= $index ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" style="
                                            display: inline-block;
                                            padding: 6px 12px;
                                            background-color: #28a745; 
                                            color: white; 
                                            border: none; 
                                            border-radius: 5px;
                                        ">
                                            Cancel Order
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted">Not Cancellable</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
</body>
<?php include('includes/footer.php'); ?>