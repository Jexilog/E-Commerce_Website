89% of storage used … If you run out of space, you can't save to Drive or back up Google Photos. Get 30 GB of storage for ₱49.00 ₱10.00/month for 2 months.
<?php
session_start();
require_once __DIR__ . '../../db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_POST['product_id'])) {
    echo json_encode(['status' => 'error']);
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['product_id']);

// Check if already in wishlist
$stmt = $pdo->prepare("SELECT Wishlist_ID FROM wishlist WHERE User_ID = ? AND Product_ID = ?");
$stmt->execute([$user_id, $product_id]);
$row = $stmt->fetch();

if ($row) {
    // Remove from wishlist
    $stmt = $pdo->prepare("DELETE FROM wishlist WHERE Wishlist_ID = ?");
    $stmt->execute([$row['Wishlist_ID']]);
    echo json_encode(['status' => 'removed']);
} else {
    // Add to wishlist
    $stmt = $pdo->prepare("INSERT INTO wishlist (User_ID, Product_ID) VALUES (?, ?)");
    $stmt->execute([$user_id, $product_id]);
    echo json_encode(['status' => 'added']);
}