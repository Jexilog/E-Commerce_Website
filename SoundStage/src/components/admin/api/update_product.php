<?php
$conn = new mysqli("localhost", "root", "", "db_system");

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

$id = (int)$_POST['Product_ID'];
$name = $conn->real_escape_string($_POST['ProductName']);
$desc = $conn->real_escape_string($_POST['Description']);
$brand = $conn->real_escape_string($_POST['Brand']);
$price = (float)$_POST['Price'];
$currentImg = $conn->real_escape_string($_POST['Current_Image_URL']);
$imageUrl = $currentImg;

// Handle image upload if new file is provided
if(isset($_FILES['Image_URL']) && $_FILES['Image_URL']['error'] == 0) {
    $ext = pathinfo($_FILES['Image_URL']['name'], PATHINFO_EXTENSION);
    $newName = 'uploads/product_' . $id . '_' . time() . '.' . $ext;
    $target = '../../assets/' . $newName;
    if(move_uploaded_file($_FILES['Image_URL']['tmp_name'], $target)) {
        $imageUrl = '../../assets/' . $newName;
    }
}

$sql = "UPDATE product_tbl SET 
    ProductName=?,
    Description=?,
    Brand=?,
    Price=?,
    Image_URL=?
    WHERE Product_ID=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdsi", $name, $desc, $brand, $price, $imageUrl, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>