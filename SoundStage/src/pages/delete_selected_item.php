<?php
session_start();
require_once __DIR__ . '../../db.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['product_ids'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$userId = $_SESSION['user_id'];
$productIds = $_POST['product_ids']; // array of product IDs

// Get latest Cart_ID
$stmt = $pdo->prepare("SELECT Cart_ID FROM cart_tbl WHERE User_ID = ? ORDER BY Cart_ID DESC LIMIT 1");
$stmt->execute([$userId]);
$cart = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cart) {
    echo json_encode(['success' => false, 'message' => 'Cart not found']);
    exit;
}

$cartId = $cart['Cart_ID'];

$placeholders = implode(',', array_fill(0, count($productIds), '?'));
$query = "DELETE FROM cart_items_tbl WHERE Cart_ID = ? AND Product_ID IN ($placeholders)";
$stmt = $pdo->prepare($query);
$success = $stmt->execute(array_merge([$cartId], $productIds));

echo json_encode(['success' => $success]);
