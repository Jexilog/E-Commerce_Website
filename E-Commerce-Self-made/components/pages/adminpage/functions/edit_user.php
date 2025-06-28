<?php
// filepath: c:\xampp\htdocs\System\SoundStage\src\components\admin\update_user_info.php
$conn = new mysqli("localhost", "root", "", "db_websystem");

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// Use consistent, lowercase keys for POST data
$userId = $_POST['user_id'] ?? null;
$firstName = $_POST['first_name'] ?? null;
$lastName = $_POST['last_name'] ?? null;
$email = $_POST['email'] ?? null;
$status = $_POST['status'] ?? null;

if ($userId === null || $firstName === null || $lastName === null || $email === null || $status === null) {
    die(json_encode(['success' => false, 'message' => 'Missing required fields']));
}

// Sanitize inputs to prevent XSS and other issues
$userId = intval($userId); // Ensure User_ID is an integer
$firstName = htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8');
$lastName = htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8');
$email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitize email

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die(json_encode(['success' => false, 'message' => 'Invalid email format']));
}

$status = htmlspecialchars($status, ENT_QUOTES, 'UTF-8');

date_default_timezone_set('Asia/Manila');
$updatedAt = date('Y-m-d H:i:s');

$stmt = $conn->prepare("UPDATE user_accounts SET FirstName = ?, LastName = ?, Email_Add = ?, Status = ?, Updated_AT = ? WHERE User_ID = ?");
$stmt->bind_param("sssssi", $firstName, $lastName, $email, $status, $updatedAt, $userId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    error_log("Update user error: " . $stmt->error);
    echo json_encode(['success' => false, 'message' => "Failed to update user. See server logs."]);
}

$stmt->close();
$conn->close();