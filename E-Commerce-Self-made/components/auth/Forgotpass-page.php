<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../../Composer/vendor/phpmailer/phpmailer/src/Exception.php';
require '../../Composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../Composer/vendor/phpmailer/phpmailer/src/SMTP.php';
require '../../Composer/vendor/autoload.php';

$connect = mysqli_connect("localhost","root","","db_websystem");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['send'])){

        $email = $_POST["email"] ?? '';
        $username = $_POST["username"] ?? '';
        $sql = "SELECT * FROM users_account WHERE Email = ? OR UserName = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = mysqli_fetch_assoc($result);

        if($user){
            $otp = rand(100000, 999999);
            $ip_add = $_SERVER['REMOTE_ADDR'];
            $stmt = $connect->prepare("UPDATE users_account SET otp = ?, otp_send_time = NOW() WHERE Email = ? OR UserName = ?");
            $stmt->bind_param("sss", $otp, $email, $username);
            if(!$stmt->execute()){
                echo "
                <script>
                alert('Error updating OTP. Please try again.');
                document.location.href = '';
                </script>
                ";
                exit();
            }
             try{
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username ='cyberhackstoreinc@gmail.com';
                $mail->Password = 'rjlpomtweljoeoxz';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;
                $mail->setFrom('cyberhackstoreinc@gmail.com','CyberHack Store - Imus City Branch');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'OTP Verification';
                $mail->Body = "Your OTP Verification for Reset Password is: $otp
                <br><br>
                This is a one-time password (OTP) for verification purposes. PLease do not share it with anyone.
                <br><br>";
                $mail->send();
                echo "
                <script>
                alert('OTP has been sent to your email address');
                document.location.href = '../auth/otpReset.php';
                </script>
                ";
            } catch (Exception $e) {
                echo "
                <script>
                alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
                document.location.href = '';
                </script>
                ";
            }
            $stmt->close();
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    color: white;
}

body {
    background: url('../../images/login_wallpaper.png') no-repeat;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 400px;
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
    border: 2px solid rgba(255, 255, 255, 0.2);
    color: #fff;
}

.container h2 {
    font-size: 28px;
    margin-bottom: 20px;
}

.container p {
    font-size: 18px;
    margin-bottom: 30px;
}

.container input[type="email"] {
    width: 100%;
    height: 50px;
    border: 2px solid #fff;
    border-radius: 7px;
    padding: 0 15px;
    outline: none;
    color: #fff;
    background: transparent;
    font-size: 16px;
    margin-bottom: 20px;
    transition: border-color 0.3s;
}

.container input[type="email"]:focus {
    border-color: #9b59b6;
}

.container button {
    width: 100%;
    height: 45px;
    background: #9b59b6;
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-size: 16px;
    color: #fff;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s, transform 0.2s;
}

.container button:hover {
    background: #8e44ad;
    transform: translateY(-2px);
}

    </style>
</head>
<body>
    <div class="container">
    <form method="POST">
        <h2>Forgot Password</h2>
        <p> Enter your email address connected to your account
            and we will send an OTP to reset your password.
        </p>
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit" name="send">Send OTP</button>
    </form> 
    </div>
</body>
</html>