<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "db_websystem");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useroremail = $_POST['useroremail'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM users_account WHERE Email = ? OR UserName = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param('ss', $useroremail, $useroremail);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = mysqli_fetch_assoc($result);

    if ($user && $user['Password'] === $password) { 
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: ../components/index.php"); 
        exit();
    } else {
        $error = "Invalid email or password.";
        echo "<script>alert('$error');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background:url('../../images/login_wallpaper.png') no-repeat;
            background-size: cover;
            background-position: center;
        }

        .wrapper{
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255,255,255,0.2);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px;
        }

        .wrapper h1 {
            text-align: center;
            margin-bottom: 36px;
        }

        .wrapper .input-box{
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .input-box input{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }

        .input-box input::placeholder{
            color: #fff;
            opacity: 0.8;
            font-size: 16px;
            font-weight: 500;
        }

        .input-box i {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            font-size: 20px;
            color: #fff;
        }

        .wrapper .remember-forgot{
            display:flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .remember-forgot label input{
            accent-color: #fff;
            margin-right: 3px;
        }

        .remember-forgot a{
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .remember-forgot a:hover{
            text-decoration: underline;
        }

        .wrapper .btn{
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            color: #333;
            cursor: pointer;
            font-weight: 600;
        }

        .wrapper .register-link{
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;
        }

        .register-link p a{
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link p a:hover{
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <form action="" method="post" autocomplete="off">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" id="useroremail" name="useroremail" placeholder="Email or Username" required>
                <i class='bx  bx-user'></i> 
            </div>
            <div class="input-box">
                <input type="password" id="password-input" name="password" placeholder="Password" required>
                <span class="show-password-label" id="togglePassword" style="cursor:pointer;">
                    <i class ='bx bx-eye' id="eyeIcon"></i>
                </span>
            </div>
            <div class="remember-forgot">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="../auth/Forgotpass-page.php">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="../auth/Signup-page.php">Register</a></p>
            </div>
        </form>
    </div>
    <script src="../../script/sign-and-log.js"></script>
</body>
</html>