<?php
// Turn on error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../../db.php'; // safer include path

if (!isset($_SESSION['history_ID'])) {
    session_unset();
    session_destroy();
    header("Location: /System/SoundStage/src/dashboard.php");
    exit;
}

$historyId = $_SESSION['history_ID'];

date_default_timezone_set('Asia/Manila');

try {
    $stmt = $pdo->prepare("UPDATE user_history SET Last_Logout = NOW() WHERE History_ID = ? AND Last_Logout IS NULL");
    $stmt->execute([$historyId]);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// Destroy session
session_unset();
session_destroy();

header("Location: /System/SoundStage/src/dashboard.php");
exit;
?>
