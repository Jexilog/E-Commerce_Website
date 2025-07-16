<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "db_websystem");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$userId = $data['user_id'] ?? null;
$newPassword = $data['new_password'] ?? null;

if (!$userId || !$newPassword) {
    echo json_encode(['success' => false, 'message' => 'Missing user_id or new_password']);
    exit;
}

// Example: hash password before saving
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE user_accounts SET password = ? WHERE User_ID = ?");
$stmt->bind_param("si", $hashedPassword, $userId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
