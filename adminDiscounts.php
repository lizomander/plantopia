<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settingsFile = './json/discountSettings.json';
    $discountSettings = [
        '10th_order_discount' => (float)$_POST['discount10'] / 100,
        '20th_order_discount' => (float)$_POST['discount20'] / 100
    ];
    file_put_contents($settingsFile, json_encode($discountSettings, JSON_PRETTY_PRINT));
    echo "<p>Discount settings updated successfully!</p>";
}

// Load existing settings
$settingsFile = './json/discountSettings.json';
$discountSettings = file_exists($settingsFile) ? json_decode(file_get_contents($settingsFile), true) : [
    '10th_order_discount' => 0.1,
    '20th_order_discount' => 0.2
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Discount Settings</title>
</head>
<body>
    <h1>Admin: Discount Settings</h1>
    <form method="POST">
        <label for="discount10">Discount for Every 10th Order (%):</label>
        <input type="number" id="discount10" name="discount10" value="<?php echo $discountSettings['10th_order_discount'] * 100; ?>">
        <br>
        <label for="discount20">Discount for Every 20th Order (%):</label>
        <input type="number" id="discount20" name="discount20" value="<?php echo $discountSettings['20th_order_discount'] * 100; ?>">
        <br>
        <button type="submit">Update Discounts</button>
    </form>
</body>
</html>