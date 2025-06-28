<?php

require_once __DIR__ . "../../../../database.php";
header('Content-Type: application/json');

if (!isset($_POST['user_ids']) || !is_array($_POST['user_ids'])) {
    echo json_encode(['success' => false, 'message' => 'No users selected.']);
    exit;
}

$userIds = array_map('intval', $_POST['user_ids']);
if (empty($userIds)) {
    echo json_encode(['success' => false, 'message' => 'No valid users selected.']);
    exit;
}

$in = str_repeat('?,', count($userIds) - 1) . '?';
$stmt = $pdo->prepare("DELETE FROM user_accounts WHERE User_ID IN ($in)");
$success = $stmt->execute($userIds);

echo json_encode(['success' => $success]);