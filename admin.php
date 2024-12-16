<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$pageTitle = "Plantopia | Admin Dashboard";
include('includes/header.php');
?>

<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?= ($section === 'orders') ? 'active' : '' ?>" href="?section=orders">Manage Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($section === 'users') ? 'active' : '' ?>" href="?section=users">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($section === 'admins') ? 'active' : '' ?>" href="?section=admins">Manage Admins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($section === 'discounts') ? 'active' : '' ?>" href="?section=discounts">Manage Discounts</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Dashboard</h1>
            </div>

            <?php
            $section = $_GET['section'] ?? 'orders';
            if ($section === 'orders') {
                include('admin_orders.php');
            } elseif ($section === 'users') {
                include('admin_users.php');
            } elseif ($section === 'admins') {
                include('admin_admins.php');
            } elseif ($section === 'discounts') {
                // Discount Management Section
                include('admin_discounts.php');
            } else {
                echo "<p>Section not found.</p>";
            }
            ?>
        </main>
    </div>
</div>
<?php include('includes/footer.php'); ?>
</body>