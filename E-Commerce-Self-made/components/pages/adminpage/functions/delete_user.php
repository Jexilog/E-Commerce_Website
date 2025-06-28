<?php
header('Content-Type: application/json');
error_reporting(0); // prevent warnings from breaking JSON

$conn = new mysqli("localhost", "root", "", "db_websystem");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]);
    exit;
}

$userId = $_POST['user_id'] ?? null;

if ($userId === null) {
    echo json_encode(['success' => false, 'message' => 'Missing user_id']);
    exit;
}

// Optional: validate userId is a number
if (!is_numeric($userId)) {
    echo json_encode(['success' => false, 'message' => 'Invalid user_id']);
    exit;
}

$stmt = $conn->prepare("DELETE FROM user_accounts WHERE User_ID = ?");
$stmt->bind_param("i", $userId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>