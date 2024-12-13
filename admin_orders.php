
<?php
// Load orders.json
$ordersFile = 'json/orders.json';
$ordersData = json_decode(file_get_contents($ordersFile), true);

// Default to showing new orders
$filterState = $_GET['state'] ?? 'ordered';
$filteredOrders = array_filter($ordersData, function ($order) use ($filterState) {
    return $order['status'] === $filterState;
});

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $orderId = (int)$_POST['order_id'];
    $newStatus = $_POST['status'];

    if (isset($ordersData[$orderId])) {
        $ordersData[$orderId]['status'] = $newStatus; // Update order status

        // If rejecting, add a rejection reason
        if ($newStatus === 'canceled' && isset($_POST['rejection_reason'])) {
            $ordersData[$orderId]['rejection_reason'] = $_POST['rejection_reason'];
        }

        // Save changes
        file_put_contents($ordersFile, json_encode($ordersData, JSON_PRETTY_PRINT));
    }
}
?>
<h2>Admin Dashboard: New Orders</h2>
<table class="table">
    <thead>
    <tr>
        <th>Order ID</th>
        <th>User</th>
        <th>Products</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($filteredOrders as $index => $order): ?>
        <tr>
            <td><?= htmlspecialchars($order['order_id']) ?></td>
            <td><?= htmlspecialchars($order['user']) ?></td>
            <td>
                <?php foreach ($order['cart'] as $productId => $quantity): ?>
                    <p>Product ID <?= $productId ?>: <?= $quantity ?> pcs</p>
                <?php endforeach; ?>
            </td>
            <td>€<?= number_format($order['total'], 2) ?></td>
            <td><?= htmlspecialchars($order['status']) ?></td>
            <td><?= htmlspecialchars($order['timestamp']) ?></td>
            <td>
                <!-- Update Status -->
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="order_id" value="<?= $index ?>">
                    <select name="status" class="form-select" onchange="toggleRejectionReason(this, 'rejection-reason-<?= $index ?>')">
                        <option value="shipped">Mark as Shipped</option>
                        <option value="finished">Mark as Finished</option>
                        <option value="canceled">Reject</option>
                    </select>
                    <div id="rejection-reason-<?= $index ?>" style="display:none; margin-top:10px;">
                        <textarea name="rejection_reason" class="form-control" placeholder="Enter rejection reason"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" style="width: 40px; height: 40px; padding: 0; text-align: center;">✔</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
function toggleRejectionReason(select, reasonFieldId) {
    const reasonField = document.getElementById(reasonFieldId);
    if (select.value === 'canceled') {
        reasonField.style.display = 'block';
    } else {
        reasonField.style.display = 'none';
    }
}
</script>
    