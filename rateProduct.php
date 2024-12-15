<?php
session_start();

$pid = $_POST['pid'] ?? null;
$rating = intval($_POST['rating'] ?? 0);

if ($pid && $rating >= 1 && $rating <= 5) {
    $dataFile = './json/data.json';
    $data = json_decode(file_get_contents($dataFile), true);

    foreach ($data['products'] as &$product) {
        if ($product['pid'] == $pid) {
            $product['ratings']['count']++;
            $product['ratings']['total'] += $rating;
        }
    }

    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
    header('Location: product.php?pid=' . $pid);
    exit;
}
header('Location: index.php');
?>