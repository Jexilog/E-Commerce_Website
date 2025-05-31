<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../Composer/vendor/phpmailer/phpmailer/src/Exception.php';
require '../../Composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../Composer/vendor/phpmailer/phpmailer/src/SMTP.php';
require '../../Composer/vendor/autoload.php';

$conn = mysqli_connect("localhost", "root", "", "db_signup");
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $sql = "SELECT * FROM admin_users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $token = bin2hex(random_bytes(32));
        date_default_timezone_set('Asia/Manila');
        $expires = date("Y-m-d H:i:s", strtotime("+24 hour"));
        $update = $conn->prepare("UPDATE admin_users SET reset_tokens=?, reset_expires=? WHERE email=?");
        $update->bind_param("sss", $token, $expires, $email);
        $update->execute();

        $ip_address = $_SERVER['REMOTE_ADDR'];
        $requested_at = date("Y-m-d H:i:s");
        $history = $conn->prepare("INSERT INTO password_resets (email, token, requested_at, ip_add) VALUES (?, ?, ?, ?)");
        $history->bind_param("ssss", $email, $token, $requested_at, $ip_address);
        $history->execute();

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
        $domain = $_SERVER['HTTP_HOST'];


        $reset_link = $protocol . $domain . "ITEC60/E-Commerce/src/components/resetpass.php?token=$token";
        $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'customerservicesoundstage@gmail.com'; 
        $mail->Password = 'uotdoblzaisbokky';    
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('customerservicesoundstage@gmail.com', 'SoundStage');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body = "Hello, Mr/Ms. $user[firstname] $user[lastname],
        <br><br>
        Click the link to reset your password: <a href='$reset_link'>$reset_link</a>";

        $mail->send();
        $message = "A password reset link has been sent to your email.";
    } catch (Exception $e) {
        $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    echo "<script>alert('{$message}');</script>";
    } else {
        $message = "No account found with that email.";
        echo "<script>alert('{$message}');</script>";
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
    crossorigin="anonymous">
    <style>
        @font-face { 
            font-family: "Inter";
            src: url(../fonts/static/Inter_18pt-Regular.ttf) format("truetype");
        }
        * {
            font-family: "Inter", sans-serif;
        }
        body {
            background-color: #e1e1e1;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            margin-top: 200px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>
    <script src="../script/test.js"></script>
</head>
<body>
    <form method="POST">
        <h2>Forgot Password</h2>
        <p class="text-center"> Enter your email address connected to your account
            and we will send an email confirmation to reset your password.
        </p>
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Send Reset Link</button>
    </form> 
</body>
</html>