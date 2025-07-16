<?php
$conn = new mysqli("localhost", "root", "", "db_system");

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

$userId = $_POST['user_id'] ?? null;

if ($userId === null) {
    die(json_encode(['success' => false, 'message' => 'Missing user_id']));
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