<?php

// File to store discount settings
$discountsFile = './json/discounts.json';

// Load existing discount settings or set defaults
$discountSettings = file_exists($discountsFile) ? json_decode(file_get_contents($discountsFile), true) : [
    'discounts' => [] // Example: [{ 'threshold': 10, 'percentage': 10 }]
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Reset discounts array
    $discountSettings['discounts'] = [];

    // Loop through submitted thresholds and percentages
    foreach ($_POST['threshold'] as $index => $threshold) {
        if (!empty($threshold) && !empty($_POST['percentage'][$index])) {
            $discountSettings['discounts'][] = [
                'threshold' => (int)$threshold,
                'percentage' => (float)$_POST['percentage'][$index]
            ];
        }
    }

    // Save updated settings
    file_put_contents($discountsFile, json_encode($discountSettings, JSON_PRETTY_PRINT));
    $feedback = "Discount settings updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Discounts</title>
    <script>
    function addRow() {
        const section = document.getElementById('discounts-section');
        const newRow = document.createElement('div');
        newRow.className = 'discount-row';
        newRow.innerHTML = `
            <label>Threshold (order count):</label>
            <input type="number" name="threshold[]" min="1" required>
            <label>Discount Percentage:</label>
            <input type="number" name="percentage[]" min="1" max="100" required>% 
            <button type="button" onclick="removeRow(this)">Remove</button>
        `;
        section.appendChild(newRow);
    }

    function removeRow(button) {
        button.parentElement.remove();
    }
    </script>
</head>
<body>
    <h2>Manage Discount Settings</h2>
    <?php if (!empty($feedback)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($feedback) ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div id="discounts-section">
            <?php foreach ($discountSettings['discounts'] as $index => $discount): ?>
                <div class="discount-row">
                    <label>Threshold (order count):</label>
                    <input type="number" name="threshold[]" value="<?= $discount['threshold'] ?>" min="1" required>
                    <label>Discount Percentage:</label>
                    <input type="number" name="percentage[]" value="<?= $discount['percentage'] ?>" min="1" max="100" required>% 
                    <button type="button" onclick="removeRow(this)">Remove</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" onclick="addRow()">Add Discount</button>
        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</body>
</html>