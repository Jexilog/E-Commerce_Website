<?php
// filepath: c:\xampp\htdocs\System\SoundStage\src\components\admin\update_user_status.php
$conn = new mysqli("localhost", "root", "", "db_system");

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// Check if user_id and status are set
if (!isset($_POST['user_id']) || !isset($_POST['status'])) {
    die(json_encode(['success' => false, 'message' => 'Missing user_id or status']));
}

$userId = $_POST['user_id'];
$status = $_POST['status'];

// Prepare and execute the query
$stmt = $conn->prepare("UPDATE user_accounts SET Status = ? WHERE User_ID = ?");
$stmt->bind_param("si", $status, $userId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>