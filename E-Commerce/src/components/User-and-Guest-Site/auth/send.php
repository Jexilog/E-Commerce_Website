<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '/xampp/htdocs/E-Commerce-Website-System/E-Commerce/src/components/Composer/vendor/phpmailer/phpmailer/src/Exception.php';
require '/xampp/htdocs/E-Commerce-Website-System/E-Commerce/src/components/Composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '/xampp/htdocs/E-Commerce-Website-System/E-Commerce/src/components/Composer/vendor/phpmailer/phpmailer/src/SMTP.php';
require '/xampp/htdocs/E-Commerce-Website-System/E-Commerce/src/components/Composer/vendor/autoload.php';


$conn = mysqli_connect("localhost", "root", "", "db_signup");

if (isset($_POST['send'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $otp = $_POST['otp'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

   $stmt = $conn->prepare("INSERT INTO admin_users (firstname, lastname, email, password, otp, status, otp_send_time, ip_add) 
        VALUES (?, ?, ?, ?, ?, 'pending', NOW(), ?)");
    $stmt->bind_param("ssssss", $firstname, $lastname, $email, $password, $otp, $ip_address);

    if ($stmt->execute()) {
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
            $mail->Subject = 'SoundStage OTP Verification';
            $mail->Body = "Your OTP Verification is: $otp
            <br><br>
            This is a one-time password (OTP) for verification purposes. Please do not share it with anyone.
            <br><br>";

            $mail->send();
            echo "
            <script>
            alert('OTP has been sent to your email address');
            document.location.href = '/E-Commerce-Website-System/E-Commerce/src/components/User-and-Guest-Site/auth/verify.php';
            </script>
            ";
        } catch (Exception $e) {
            echo "
            
            <script>
            alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
            document.location.href = '../components/signup.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
        alert('Error inserting data:  {$conn->error}'); 
        document.location.href = '../components/signup.php';
        </script>
        ";
    }
    $stmt->close();
} 
?>