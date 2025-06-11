<?php
$conn = new mysqli("localhost", "root", "", "tangenamo-jeckho");
$id = (int)$_GET['id'];
$res = $conn->query("SELECT * FROM product_tbl WHERE Product_ID = $id");
echo json_encode($res->fetch_assoc());
?>