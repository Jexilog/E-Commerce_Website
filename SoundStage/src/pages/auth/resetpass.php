<?php
$conn = mysqli_connect("localhost", "root", "", "testing");
$message = "";
$password_reset = false;

$token = $_POST['token'] ?? $_GET['token'] ?? '';

if (!empty($token)) {
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
                $update = $conn->prepare("UPDATE user_accounts SET Password=?, Reset_Token=NULL, Updated_AT=NOW(),Token_Expiry=NULL WHERE Email_Add=?");
                $update->bind_param("ss", $hashed_password, $user['Email_Add']);
                $update->execute();

                if ($update->affected_rows > 0) {
                    $message = "Password reset successful! <a href='auth.php'>Login</a>";
                    $password_reset = true;
                } else {
                    $message = "Password reset failed. Please try again.";
                }
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
            background: linear-gradient(135deg, #ffffff 0%, #003366 100%);
        }

        .container{
            display: flex;
            flex-direction: column;
            width: 420px;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .container h1{
            color: #000000;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em;
        }

        .container p{
            color: #000000;
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
            background: gray;
            border: none;
            outline: none;
            border-radius: 5px;
            font-size: 1em;
            color: #fff;
            transition: background 0.3s ease;
        }

        .input-box input:focus,
        .input-box input:valid{
            background: #003366;
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
            background: #003366;
            border: none;
            outline: none;
            border-radius: 5px;
            font-size: 1.1em;
            color: white;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .container .btn:hover{
            background: darkslategrey;
        }
    </style>
</head>
<body>
    <div class="container">
        <form id="reset-form" action="" method="post" autocomplete="off">
            <h1>Reset Password</h1>
            <p style="font-size:16px;">Please enter your new password.</p>

            <?php if ($message): ?>
                <p style="color: <?= $password_reset ? 'lightgreen' : 'red' ?>; text-align:center; font-size:16px;">
                    <?= $message ?>
                </p>
            <?php endif; ?>

            <?php if (!$password_reset): ?>
                <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">


                <div class="input-box">
                    <input type="password" id="password-input" name="password" placeholder="New Password" required>
                    <span id="togglePassword"><i class='bx bx-eye' id="eyeIcon"></i></span>
                </div>
                <br>
                <div class="input-box">
                    <input type="password" id="confirm-pass-input" name="confirm_password" placeholder="Confirm Password" required>
                    <span id="toggleConPassword"><i class='bx bx-eye' id="eyeConIcon"></i></span>
                </div>
                <br>
                <button type="submit" class="btn">Reset Password</button>
            <?php endif; ?>
        </form>
    </div>
    <script>
        const togglePassword = document.getElementById("togglePassword");
        const eyeIcon = document.getElementById("eyeIcon");
        const toggleConPassword = document.getElementById("toggleConPassword");
        const eyeConIcon = document.getElementById("eyeConIcon");
        const passwordInput = document.getElementById("password-input");
        const confirmPassInput = document.getElementById("confirm-pass-input");
        togglePassword.addEventListener('click', function (event){
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";
            eyeIcon.classList.toggle("bx-eye-slash");
            eyeIcon.classList.toggle("bx-eye");
            });

        toggleConPassword.addEventListener('click', function(event){
            const isConPassword = confirmPassInput.type === "password";
            confirmPassInput.type = isConPassword ? "text" : "password";
            eyeConIcon.classList.toggle("bx-eye-slash");
            eyeConIcon.classList.toggle("bx-eye");
    });

    </script>
</body>
</html>