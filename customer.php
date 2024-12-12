<?php
    $pageTitle = "Customer Page"; 
    include('includes/header.php');
    include('includes/navbar.php');
?>
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
</body>
</html>
<?php
// Order Management Section for Customers
if ($user->isLoggedIn()) {
    echo "<h2>Your Orders</h2>";
    $orders = getOrdersByUser($user->id);
    foreach ($orders as $order) {
        echo "<div class='order'>";
        echo "<p>Order ID: " . $order['id'] . "</p>";
        echo "<p>Status: " . $order['status'] . "</p>";
        if ($order['status'] == 'ordered') {
            echo "<form method='POST' action='cancelOrder.php'>";
            echo "<input type='hidden' name='order_id' value='" . $order['id'] . "'>";
            echo "<button type='submit'>Cancel Order</button>";
            echo "</form>";
        }
        echo "</div>";
    }
}
?>