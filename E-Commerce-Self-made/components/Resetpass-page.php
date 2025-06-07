<?php
$conn = mysqli_connect("localhost", "root", "", "credentials");
$message = "";
$password_reset = false;

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT * FROM users_account WHERE token=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if ($new_password !== $confirm_password) {
                $message = "Passwords do not match.";
            } elseif (strlen($new_password) < 8) {
                $message = "Password must be at least 8 characters long.";
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update = $conn->prepare("UPDATE users_account SET password=?, token=NULL WHERE email=?");
                $update->bind_param("ss", $hashed_password, $user['email']);
                $update->execute();
                $message = "Password reset successful! <a href='Login-page.php'>Login</a>";
                $password_reset = true;
            }
        }
    } else {
        $message = "Invalid or expired token.";
    }
} else {
    $message = "No token provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

    <style>
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <form id="reset-form" action="" method="post">
            <h1>Reset Password</h1>
            <p>Please enter your new password.</p>
            <?php if ($message) echo "<p>$message</p>"; ?>
            <?php if (!$password_reset): ?>
                <input type="password" id="password-input" name="password" placeholder="New Password" required>
                <span class="show-password-label" id="togglePassword" style="cursor:pointer;">
                    <i class ='bx bx-eye' id="eyeIcon"></i>
                </span>
                <br>
                <input type="password" id="confirm-pass-input" name="confirm_password" placeholder="Confirm Password" required>
                <span class="show-password-label" id="toggleConPassword" style="cursor:pointer;">
                    <i class ='bx bx-eye' id="eyeConIcon"></i>
                </span>
                <br>
                <button type="submit" id="reset-button">Reset Password</button>
            <?php endif; ?>
        </form>
    </div>
    <script src="../script/sign-and-log.js"></script>
</body>
</html>