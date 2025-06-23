<?php
session_start();

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

$action = $_GET['action'] ?? '';
$data = json_decode(file_get_contents('php://input'), true);

if ($action === 'add') {
    $id = $data['id'];
    $qty = isset($data['qty']) ? max(1, intval($data['qty'])) : 1;
    $name = $data['name'];
    $price = $data['price'];
    $image = $data['image'];

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $id) { // <-- loose comparison
            $item['qty'] += $qty;
            $found = true;
            break;
        }
    }
    unset($item);
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'qty' => $qty
        ];
    }
    echo json_encode(['status' => 'ok', 'count' => count($_SESSION['cart'])]);
    exit;
}

if ($action === 'update_qty') {
    $id = $data['id'];
    $qty = max(1, intval($data['qty']));
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $id) {
            $item['qty'] = $qty;
            break;
        }
    }
    echo json_encode(['count' => array_sum(array_column($_SESSION['cart'], 'qty'))]);
    exit;
}
if ($action === 'remove') {
    $_SESSION['cart'] = array_filter($_SESSION['cart'], fn($item) => $item['id'] !== $data['id']);
    echo json_encode(['count' => array_sum(array_column($_SESSION['cart'], 'qty'))]);
    exit;
}
if ($action === 'clear') {
    $_SESSION['cart'] = [];
    echo json_encode(['count' => 0]);
    exit;
}
?>