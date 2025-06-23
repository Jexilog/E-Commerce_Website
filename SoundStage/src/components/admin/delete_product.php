<?php
// filepath: c:\xampp\htdocs\System\SoundStage\src\components\admin\delete_product.php

$conn = new mysqli("localhost", "root", "", "db_system");

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

$prodId = $_POST['product_id'] ?? null;

if ($prodId === null) {
    die(json_encode(['success' => false, 'message' => 'Missing product_id']));
}

$stmt = $conn->prepare("DELETE FROM product_tbl WHERE Product_ID = ?");
$stmt->bind_param("i", $prodId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>