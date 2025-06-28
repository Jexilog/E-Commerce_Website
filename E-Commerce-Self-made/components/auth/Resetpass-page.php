<?php
$conn = mysqli_connect("localhost", "root", "", "db_websystem");
$message = "";
$password_reset = false;

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT * FROM user_accounts WHERE Reset_Token=?";
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
                $update = $conn->prepare("UPDATE user_accounts   SET Password=?, Reset_token=NULL WHERE Email_Add=?");
                $update->bind_param("ss", $hashed_password, $user['email']);
                $update->execute();
                $message = "Password reset successful! <a href='dashboard.php'>Dashboard</a>";
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
        
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
        }

        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url("../../images/login_wallpaper.png");
            background-size: cover;
        }

        .container{
            display: flex;
            flex-direction: column;
            width: 420px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .container h1{
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em;
        }

        .container p{
            color: #eee;
            text-align: center;
            margin-bottom: 20px;
        }

        .input-box{
            position: relative;
            margin-bottom: 20px;
        }

        .input-box input{
            width: 100%;
            padding: 12px 40px 12px 20px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            outline: none;
            border-radius: 5px;
            font-size: 1em;
            color: #fff;
            transition: background 0.3s ease;
        }

        .input-box input:focus,
        .input-box input:valid{
            background: rgba(255, 255, 255, 0.3);
        }

        .input-box input::placeholder{
            color: #ddd;
        }

        .input-box i {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            font-size: 1.5em;
            color: #fff;
            cursor: pointer;
        }

        .container .btn{
            width: 100%;
            padding: 12px;
            background: white;
            border: none;
            outline: none;
            border-radius: 5px;
            font-size: 1.1em;
            color: black;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .container .btn:hover{
            background: #45a049;
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
                <div class="input-box">
                    <input type="password" id="password-input" name="password" placeholder="New Password" required>
                        <span class="show-password-label" id="togglePassword" style="cursor:pointer;">
                            <i class ='bx bx-eye' id="eyeIcon"></i>
                        </span>
                </div>
                <br>
                <div class="input-box">
                    <input type="password" id="confirm-pass-input" name="confirm_password" placeholder="Confirm Password" required>
                    <span class="show-password-label" id="toggleConPassword" style="cursor:pointer;">
                        <i class ='bx bx-eye' id="eyeConIcon"></i>
                    </span>
                </div>
                <br>
                <button type="submit" id="reset-button" class="btn">Reset Password</button>
            <?php endif; ?>
        </form>
    </div>
    <script src="../../script/sign-and-log.js"></script>
</body>
</html>