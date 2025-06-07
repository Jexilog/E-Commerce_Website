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
        $gender = $_POST['gender'];
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
    if(isset($_POST['gender'])){
        $gender = $_POST['gender'];
    } else{
        $gender = "Not Specified";
    }

        $status = 'pending';
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $connect->prepare("INSERT INTO users_account (FullName, UserName, Birthdate, Email, Password, PhoneNo, Address, Gender, otp, otp_send_time, status, ip_add)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)");
        $stmt->bind_param("sssssssssss", $fullname, $username, $dob, $email, $password, $phone, $address, $gender, $otp, $status, $ip_add);
        
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
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <title>Sign-In</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }

        body{
            display:flex;
            justify-content: center;
            align-items: center;
            height: 120vh;
            padding: 10px;
            background: url('../images/login_wallpaper.png') no-repeat;
            background-size: cover;
            /* background:linear-gradient(135deg, #71b7e6, #9b59b6); */
        }

        .container{
            display: grid;
            max-width: 900px;
            width: 100%;
            background-color: transparent;
            padding:35px 40px 30px 40px;
            border-radius: 5px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
            border: 2px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            overflow: hidden;
        }

        .container .title{
            font-size: 2.2rem;
            font-weight: 600;
            position: relative;
            text-align: center;
            margin-bottom: 24px;
            letter-spacing: 1px;
        }

        .container .title::before{
            content: '';
            position: absolute;
            left: 50%;
            bottom: -8px;
            transform:translateX(-50%); ;
            width: 60px;
            height: 4px;
            border-radius: 2px;
            background: linear-gradient(135deg, #000);
        }

        .container form .user-details{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        form .user-details .input-box{
            width: calc(100% / 2 - 20px);
            margin: 20px 0 12px 0;
        }

        .user-details .input-box .details{
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .user-details .input-box input{
            width: 100%;
            height: 45px;
            padding-left: 15px;
            border-radius: 30px;
            border: 1px solid #ccc;
            background-color: transparent;
            outline: none;
            font-size: 16px;
        }

        .user-details .input-box input:focus
        .user-details .input-box input:valid{
            border-color: #fff;
        }

        form .gender-details .gender-title{
            font-size: 20px;
            font-weight: 500;
        }

        form .gender-details .category{
            display: flex;
            width: 80%;
            margin:14px 0;
            justify-content:space-between;
        }

        .gender-details .category label{
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .gender-details .category label .dot{
            height: 18px;
            width: 18px;
            border-radius: 50%;
            margin-right: 10px;
            border: 5px solid transparent;
            background:#d9d9d9;
        }

        #dot-1:checked ~ .category label .one,
        #dot-2:checked ~ .category label .two,
        #dot-3:checked ~ .category label .three{
            border-color:#fff;
            background:#000;
        }

        form input[type="radio"]{
            display: none;
        }

        form .button{
            height: 45px;
            margin: 18px 0 0 0;
        }

        form .button input{
            height: 100%;
            width: 100%;
            outline: none;
            color: #000;
            border: none;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
            border-radius: 30px;
            letter-spacing: 1px;
            background: #fff;
        }

        /* form .button input:hover{
            background: linear-gradient(135deg, #9b59b6, #71b7e6);
        } */

      .container .login-link {
            text-align: center;
            margin: 10px 0 0 0;
            font-size: 15px;
        }

        .login-link p {
            color: #fff;
        }

        .login-link a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: text-decoration 0.2s;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .container .checkbox {
            display: flex;
            align-items: center;
            font-size: 15px;
            margin: 10px 0 18px 0;
            color: #fff;
        }

        .checkbox label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .checkbox input[type="checkbox"] {
            accent-color: #000;
            width: 18px;
            height: 18px;
            margin-right: 8px;
            cursor: pointer;
        }

        .checkbox a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            margin: 0 2px;
            transition: text-decoration 0.2s;
        }

        .checkbox a:hover {
            text-decoration: underline;
        }

        .input-box {
            position: relative;
        }

        .show-password-label {
            position: absolute;
            right: 18px;
            top: 67%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 2;
            color: #fff;
            font-size: 22px;
            display: flex;
            align-items: center;
            height: 100%;
        }

        .input-box input[type="password"] {
            padding-right: 44px; 
        }

        .user-details .input-box input[type="date"] {
            width: 100%; 
            padding-right: 18px;
            color: #fff;
            box-sizing: border-box;
        }

        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 1;
            cursor: pointer;
        }

        .modal{
            display: none;
            background-color: rgba(0, 0, 0, 0.3);
            opacity: 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            transition: all 0.3s ease-in-out;
            z-index: 1;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .modal-inner{
            position: relative;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px 25px;
            width: 750px;
            height: 500px;
            overflow:auto;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
            text-align: left;
        }

        .modal-inner h2{
            margin-bottom: 0;
            font-size: 1.5rem;
            font-style: bold;
            text-align: center;
        }

        .modal-inner p{
            font-size: 0.9rem;
            font-weight: 500;
        }

        .modal-inner ol{
            padding-left: 20px;
        }

        .modal-inner {
            position: relative; 
        }

        .close-modal {
            position: absolute;
            top: 12px;
            right: 16px;
            cursor: pointer;
            font-size: 1.3rem;
            color: #888;
            z-index: 10;
            background: none;
            border: none;
            padding: 0;
        }

        .modal.open{
            display: flex;
            opacity: 1;
            z-index: 999;
        }

        .modal-inner,
        .modal-inner h2,
        .modal-inner p,
        .modal-inner b,
        .modal-inner ol,
        .modal-inner ul,
        .modal-inner li {
            color: #222 !important;
        }

        .modal-inner .close-modal i {
            color: #222 !important;
        }

        /* @media (max-width: 584px){

            .container{
                max-width: 100%;
            }

           form .user-details .input-box{
                margin-bottom: 15px;
                width: 100%;
            }

            form .user-details .category{
                width: 100%;
            }

            .container form .user-details{
                max-height: 300px;
                overflow-y: auto;
            }

            .container form .user-details::-webkit-scrollbar{
                width: 0;
            }
        } */
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Sign Up</div>
        <form action="Signup-page.php" method="post" id='forms' autocomplete="off">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Full Name</span>
                    <input type="text" id="fullname-input" name ="fullname" placeholder="Full Name">
                </div>
                 <div class="input-box">
                    <span class="details">Username</span>
                    <input type="text" id="username-input" name ="username" placeholder="Username">
                </div>
                 <div class="input-box">
                    <span class="details">Birthdate</span>
                    <input type="date" id="birthday-input" name ="dob" placeholder ="Date of Birth">
                </div>
                 <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" id="email-input" name ="email" placeholder="Email">
                </div>
                 <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" id="password-input" name ="password" placeholder="Password">
                    <span class="show-password-label" id="togglePassword" style="cursor:pointer;">
                        <i class = "bx bx-eye" id="eyeIcon"></i>
                    </span>
                </div>
                 <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" id="confirm-pass-input" name ="confirm_password" placeholder="Confirm Password">
                    <span class="show-password-label" id="toggleConPassword" style="cursor:pointer;">
                        <i class = "bx bx-eye" id="eyeConIcon"></i>
                    </span>
                </div>
                 <div class="input-box">
                    <span class="details">Phone Number</span>
                    <input type="text" id="phone-input" name ="phone" placeholder="Phone Number">
                </div>
                 <div class="input-box">
                    <span class="details">Address</span>
                    <input type="text" id="address-input" name ="address" placeholder="Address">
                </div>
            </div>
            <div class="gender-details">
                <input type="radio" name="gender" id="dot-1" value="Male" >
                <input type="radio" name="gender" id="dot-2" value="Female">
                <input type="radio" name="gender" id="dot-3" value="Prefer not to say">
                <span class="gender-title">Gender</span>
                <div class="category">
                    <label for="dot-1">
                        <span class="dot one"></span>
                        <span class="gender">Male</span>
                    </label>
                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span class="gender">Female</span>
                    </label>
                    <label for="dot-3">
                        <span class="dot three"></span>
                        <span class="gender">Prefer not to say</span>
                    </label>
                </div>
            </div> 
            <div class="modal" id="modalTerms">
                <div class="modal-inner">
                    <h2> Terms and Conditions</h2>
                    <p>Effective Date: 04/10/2025<br>
                    Company Name: SoundStage Inc.</p>
                        <ol type="1" class= "list-wrapper">
                            <li><b>Introduction</b></li>
                                <ul><li>Welcome to SoundStage.Inc. These Terms and Conditions govern your use of our website and services. By accessing or using our site, you agree to be bound by these Terms.</li></ul>
                            <li><b>Eligibility</b></li> 
                                <ul><li>You must be at least 18 years old to use our website. By using our site, you confirm you meet this requirement.</li></ul>                                                               
                            <li><b>Purchases</b></li>
                                <ul><li>All purchases made through our website are subject to product availability. We reserve the right to cancel or refuse any order.</li></ul>
                            <li><b>Pricing and Payment</b></li>
                                <ul><li>Prices are listed in Philippine Peso. We reserve the right to change prices at any time. Payment must be completed at checkout through the available payment methods.</li></ul>
                            <li><b>Shipping and Delivery</b></li>
                                <ul><li>Delivery times are estimates and may vary. Shipping policies, costs, and delivery options are outlined during checkout.</li></ul>
                            <li><b>Returns and Refunds</b></li>
                                <ul><li>Please review our Return Policy for information about returns and refunds.</li></ul>
                            <li><b>Intellectual Property</b></li>
                                <ul><li>All content on our website, including logos, images, and text, is owned by SoundStage Inc. and protected by intellectual property laws.</li></ul>
                            <li><b>Probihited Activities</b></li>
                                <ul><li>You agree not to misuse our website, including unauthorized access, distributing viruses, spamming, or infringing on our intellectual property.</li></ul>
                            <li><b>Limitation of Liability</b></li>
                                <ul><li>SoundStage.Inc is not responsible for any indirect, incidental, or consequential damages arising from your use of the site or products.</li></ul>
                            <li><b>Changes of these Terms</b></li>
                                <ul><li>We reserve the right to update these Terms at any time. Changes will be posted on this page.</li></ul>
                            <li><b>Governing Law</b></li>
                                <ul><li>These Terms are governed by the laws of Philippines.</li></ul>
                            <li><b>Contact Information</b></li>
                                <ul><li>For any questions regarding these Terms, please contact us at helpcenter@soundstage.com</li></ul>
                        </ol>
                        <span class="close-modal" id="closeTerms"tabindex="0" role="button"><i class="bx bx-x"></i></span>
                    </div>
                </div>
                <div class="modal" id="modalPrivacy">
                    <div class="modal-inner">
                        <h2> Privacy Policy</h2>
                        <p>Effective Date: 04/10/2025<br>
                        Company Name: SoundStage Inc.</p>
                        <ol type="1" class= "list-wrapper">
                            <li><b>Introduction</b></li>
                                <ul>
                                    <li>We value your privacy. This Privacy Policy explains how we collect, use, and protect your personal information when you visit or make a purchase from our site.</li>
                                </ul>
                            <li><b>Information We Collect</b></li>
                                <ul>
                                    <li>Personal Information: Name, Address, Email, Phone Number, Payment Details.</li>
                                    <li> Automatically Collected Information: IP address, browser type, device information, cookies.</li>
                                </ul>
                            <li><b>How we Use Your Information</b></li>
                            <ul>
                                <li>We use your information to:</li>
                                    <ul>
                                        <li>Process orders and payments.</li>
                                        <li>Deliver products and services.</li>
                                        <li>Communicate with you (order updates, newsletters, promotions).</li>
                                        <li>Improve our website and services.</li>
                                    </ul>
                            </ul>
                                <li><b>Sharing your information</b></li>
                                <ul>
                                    <li>We do not sell or rent your personal information. We may share it with:</li>
                                    <li>Trusted third-party service providers (e.g., payment processors, delivery companies).</li>
                                    <li>Law enforcement if legally required.</li>
                                </ul>
                                <li><b>Cookies</b></li>
                                    <ul><li>Our site uses cookies to improve your browsing experience. You can control cookie settings in your browser.</li></ul>
                                <li><b>Security</b></li>
                                    <ul><li>We take reasonable measures to protect your personal data, but no system is 100% secure.</li></ul>
                                <li><b>Your Rights</b></li>
                                <ul>
                                    <li style="margin-bottom: 0; font-size:16px;">You have the right to:</li>
                                    <ul>
                                        <li>Access the personal information we hold about you.</li>
                                        <li>Request correction or deletion of your data.</li>
                                        <li>Opt out of marketing communications.</li>
                                    </ul>
                                </ul>
                                <li><b>Third-Party Links</b></li>
                                    <ul><li>Our website may contain links to third-party websites. We are not responsible for their privacy practices.</li></ul>
                                <li><b>Changes to This Privacy Policy</b></li>
                                    <ul><li>We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated effective date.</li></ul>
                                <li><b>Contact Us</b></li>
                                    <ul><li>For any questions about this Privacy Policy, contact us at helpcenter@soundstage.com</li></ul>
                            </ol>
                            <span class="close-modal" id="closePrivacy" tabindex="0" role="button"><i class="bx bx-x"></i></span>
                        </div>
                    </div>
            <div class ="checkbox">
                <label>
                    <input type="checkbox" id="checkterms" name ="terms">
                    I agree to the <a href="#" id="OpenTerms"> Terms and Conditions </a>
                    and <a href="#" id="Privacy"> Privacy Policy </a>
                </label>
            </div>
            <div class="button">
                <input type="submit" name="send" value="Sign Up">
            </div>
            <div class="login-link">
                <p>Already have an account? <a href="../components/Login-page.php">Login</a></p>
            </div>
        </form>
    </div>
    <script src="../script/sign-and-log.js"></script>
</body>
</html>