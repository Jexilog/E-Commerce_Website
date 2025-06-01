<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../Composer/vendor/phpmailer/phpmailer/src/Exception.php';
require '../Composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../Composer/vendor/phpmailer/phpmailer/src/SMTP.php';
require '../Composer/vendor/autoload.php';


$connect = mysqli_connect("localhost","root","","credentials");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['send'])){
        
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $otp = rand(100000, 999999);
        $ip_add = $_SERVER['REMOTE_ADDR'];

        $check_email = $connect->prepare("SELECT * FROM users_account WHERE Email = ? or UserName = ?");
        $check_email->bind_param("ss", $email, $username);
        $check_email->execute();
        $result = $check_email->get_result();
        if($result->num_rows > 0){
            echo "
            <script>
            alert('Email or Username already exists');
            document.location.href = '';
            </script>
            ";
            exit();
        }
        $status = 'pending';
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $connect->prepare("INSERT INTO users_account (FullName, UserName, Birthdate, Email, Password, PhoneNo, Address, otp, otp_send_time, status, ip_add)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)");
        $stmt->bind_param("ssssssssss", $fullname, $username, $dob, $email, $password, $phone, $address, $otp, $status, $ip_add);
        
        if($stmt->execute()){
            $mail = new PHPMailer(true);
            try{
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
                $mail->Body = "Your OTP Verification is: $otp
                <br><br>
                This is a one-time password (OTP) for verification purposes. PLease do not share it with anyone.
                <br><br>";
                $mail->send();
                echo "
                <script>
                alert('OTP has been sent to your email address');
                document.location.href = '../components/otpverify.php';
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
    <title>Sign-In</title>
</head>
<body>
    <form action="Signup-page.php" method="post" id='forms' autocomplete="off">
        <h1>Sign Up</h1>
        <input type="text" id="fullname-input" name ="fullname" placeholder="Full Name">
        <br>
        <input type="text" id="username-input" name ="username" placeholder="Username">
        <br>
        <input type="date" id="birthday-input" name ="dob" placeholder ="Date of Birth">
        <br>
        <input type="email" id="email-input" name ="email" placeholder="Email">
        <br>
        <input type="password" id="password-input" name ="password" placeholder="Password">
        <br>
        <input type="password" id="confirm-pass-input" name ="confirm_password" placeholder="Confirm Password">
        <br>
        <input type="text" id="phone-input" name ="phone" placeholder="Phone Number">
        <br>
        <input type="text" id="address-input" name ="address" placeholder="Address">
        <br>
        <label>
            <input type="checkbox" id="checkterms" name ="terms">
            I agree to the <a href="#">Terms and Conditions</a>
            and <a href="#">Privacy Policy</a>
        </label>
        <br>
        <button type="submit" name="send">Sign Up</button>
        <p>Already have an account? <a href="../components/Login-page.php">Login</a></p>
    </form>
    <script src="../script/sign-and-log.js"></script>
</body>
</html>