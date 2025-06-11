<?php
require_once '../../db.php';
session_start();

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $stmt = $pdo->prepare("SELECT * FROM user_accounts WHERE Verification_Code = ? AND Status = 'inactive'");
    $stmt->execute([$code]);
    $user = $stmt->fetch();

    if ($user) {
        // Activate account
        $stmt = $pdo->prepare("UPDATE user_accounts SET Status = 'active', Verification_Code = NULL WHERE User_ID = ?");
        $stmt->execute([$user['User_ID']]);
        // Set session for auto-login
        $_SESSION['user_id'] = $user['User_ID'];
        $_SESSION['user_name'] = $user['FirstName'] . ' ' . $user['LastName'];
        // Redirect to dashboard
        header("Location: /AudioHub/src/dashboard.php");
        exit;
    } else {
        echo "Invalid or expired verification link.";
    }
} else {
    echo "No verification code provided.";
}
?>