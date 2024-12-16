<?php
$ordersFile = 'json/orders.json';
$ordersData = json_decode(file_get_contents($ordersFile), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $orderId = (int)$_POST['order_id'];
    $newStatus = $_POST['status'];

    if (isset($ordersData[$orderId])) {
        $ordersData[$orderId]['status'] = $newStatus;

        if ($newStatus === 'canceled' && isset($_POST['rejection_reason'])) {
            $ordersData[$orderId]['rejection_reason'] = $_POST['rejection_reason'];
        }

        file_put_contents($ordersFile, json_encode($ordersData, JSON_PRETTY_PRINT));
        $feedback = "Order ID $orderId updated successfully!";
    }
}

$filterState = $_GET['state'] ?? 'all';
$filteredOrders = $ordersData;

if ($filterState !== 'all') {
    $filteredOrders = array_filter($ordersData, function ($order) use ($filterState) {
        return $order['status'] === $filterState;
    });
}
?>

<h2>Manage Orders</h2>
<?php if (!empty($feedback)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($feedback) ?></div>
<?php endif; ?>

<div class="mb-3">
    <a href="?state=all" class="btn btn-secondary <?= $filterState === 'all' ? 'active' : '' ?>">All Orders</a>
    <a href="?state=pending_review" class="btn btn-secondary <?= $filterState === 'pending_review' ? 'active' : '' ?>">Pending Review</a>
    <a href="?state=ordered" class="btn btn-secondary <?= $filterState === 'ordered' ? 'active' : '' ?>">New Orders</a>
    <a href="?state=shipped" class="btn btn-secondary <?= $filterState === 'shipped' ? 'active' : '' ?>">Orders in Process</a>
    <a href="?state=finished" class="btn btn-secondary <?= $filterState === 'finished' ? 'active' : '' ?>">Finished Orders</a>
    <a href="?state=canceled" class="btn btn-secondary <?= $filterState === 'canceled' ? 'active' : '' ?>">Canceled Orders</a>
</div>

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
            <td><?= $index ?></td>
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
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="order_id" value="<?= $index ?>">
                    <select name="status" class="form-select" onchange="toggleRejectionReason(this, 'rejection-reason-<?= $index ?>')">
                        <option value="pending_review" <?= $order['status'] === 'pending_review' ? 'selected' : '' ?>>Pending Review</option>
                        <option value="ordered" <?= $order['status'] === 'ordered' ? 'selected' : '' ?>>Ordered</option>
                        <option value="shipped" <?= $order['status'] === 'shipped' ? 'selected' : '' ?>>Shipped</option>
                        <option value="finished" <?= $order['status'] === 'finished' ? 'selected' : '' ?>>Finished</option>
                        <option value="canceled" <?= $order['status'] === 'canceled' ? 'selected' : '' ?>>Canceled</option>
                    </select>

                    <div id="rejection-reason-<?= $index ?>" style="display:none; margin-top:10px;">
                        <textarea name="rejection_reason" class="form-control" placeholder="Enter rejection reason"><?= htmlspecialchars($order['rejection_reason'] ?? '') ?></textarea>
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