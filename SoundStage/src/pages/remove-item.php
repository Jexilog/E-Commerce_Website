<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: /System/SoundStage/src/pages/cart/cart.php");
    exit;
}

$cartItemId = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM cart_items_tbl WHERE CartItem_ID = ?");
$stmt->execute([$cartItemId]);

header("Location: /System/SoundStage/src/pages/cart.php");
exit;
