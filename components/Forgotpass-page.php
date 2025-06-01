<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../Composer/vendor/phpmailer/phpmailer/src/Exception.php';
require '../Composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../Composer/vendor/phpmailer/phpmailer/src/SMTP.php';
require '../Composer/vendor/autoload.php';

$connect = mysqli_connect("localhost","root","","credentials");

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
                document.location.href = '../components/otpReset.php';
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
</head>
<body>
    <form method="POST">
        <h2>Forgot Password</h2>
        <p> Enter your email address connected to your account
            and we will send an OTP to reset your password.
        </p>
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit" name="send">Send OTP</button>
    </form> 
</body>
</html>