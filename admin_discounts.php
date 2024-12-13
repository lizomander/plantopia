<?php
// Load discounts.json
$discountsFile = 'json/discounts.json';
$discountsData = json_decode(file_get_contents($discountsFile), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Clear existing discounts
    $discountsData['discounts'] = [];

    // Loop through submitted data and add discounts
    foreach ($_POST['threshold'] as $index => $threshold) {
        if (!empty($threshold) && !empty($_POST['percentage'][$index])) {
            $discountsData['discounts'][] = [
                'threshold' => (int)$threshold,
                'percentage' => (float)$_POST['percentage'][$index]
            ];
        }
    }

    // Save updates to discounts.json
    file_put_contents($discountsFile, json_encode($discountsData, JSON_PRETTY_PRINT));
    $feedback = "Discount settings updated successfully!";
}
?>

<h2>Manage Discount Settings</h2>
<?php if (!empty($feedback)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($feedback) ?></div>
<?php endif; ?>

<form action="" method="POST">
    <div id="discounts-section">
        <?php foreach ($discountsData['discounts'] as $index => $discount): ?>
            <div class="discount-row">
                <label>Threshold:</label>
                <input type="number" name="threshold[]" value="<?= $discount['threshold'] ?>" min="1" required>
                <label>Percentage:</label>
                <input type="number" name="percentage[]" value="<?= $discount['percentage'] ?>" min="1" max="100" required>% 
                <button type="button" onclick="removeRow(this)">Remove</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" onclick="addRow()">Add Discount</button>
    <button type="submit" class="btn btn-primary">Save Settings</button>
</form>

<script>
function addRow() {
    const section = document.getElementById('discounts-section');
    const newRow = document.createElement('div');
    newRow.className = 'discount-row';
    newRow.innerHTML = `
        <label>Threshold:</label>
        <input type="number" name="threshold[]" min="1" required>
        <label>Percentage:</label>
        <input type="number" name="percentage[]" min="1" max="100" required>% 
        <button type="button" onclick="removeRow(this)">Remove</button>
    `;
    section.appendChild(newRow);
}

function removeRow(button) {
    button.parentElement.remove();
}
</script>