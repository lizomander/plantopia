<?php
$settingsFile = 'json/discounts.json';
$settings = json_decode(file_get_contents($settingsFile), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings['discount_10'] = (int)$_POST['discount_10'];
    $settings['discount_20'] = (int)$_POST['discount_20'];
    file_put_contents($settingsFile, json_encode($settings, JSON_PRETTY_PRINT));
    echo "<p>Discount settings updated successfully!</p>";
}
?>
<h2>Manage Discount Settings</h2>
<form action="" method="POST">
    <label for="discount_10">Discount for every 10th order:</label>
    <input type="number" id="discount_10" name="discount_10" value="<?= $settings['discount_10'] ?>" min="0" max="100">%
    <br><br>
    <label for="discount_20">Discount for every 20th order:</label>
    <input type="number" id="discount_20" name="discount_20" value="<?= $settings['discount_20'] ?>" min="0" max="100">%
    <br><br>
    <button type="submit" class="btn btn-primary">Save Settings</button>
</form>