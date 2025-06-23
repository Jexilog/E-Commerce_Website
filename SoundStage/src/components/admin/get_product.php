<?php

$conn = new mysqli("localhost", "root", "", "db_system");

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

$id = (int)$_GET['id'];

$sql = "SELECT * FROM product_tbl WHERE Product_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    echo json_encode($product);
} else {
    echo json_encode(['error' => 'Product not found']);
}

$stmt->close();
$conn->close();
?>