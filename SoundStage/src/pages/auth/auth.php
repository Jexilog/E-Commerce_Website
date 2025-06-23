<?php
session_start();
require_once '../../db.php'; // <-- adjust path to your DB connection
require_once __DIR__ . '/../../../composer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function loginUser($pdo, $email, $password) {
    $stmt = $pdo->prepare("SELECT * FROM user_accounts WHERE Email_Add = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['Password'])) {
        if ($user['Status'] !== 'active') {
            return "Please verify your email before logging in.";
        }
        $_SESSION['user_id'] = $user['User_ID'];
        $_SESSION['user_name'] = $user['FirstName'] . ' ' . $user['LastName'];

        $historyId = logLogin($pdo, $user['User_ID']);
        $_SESSION['history_ID'] = $historyId;

        return "success"; // <-- ito ang flag
    } else {
        return "Invalid email or password.";
    }
}

function logLogin($pdo, $userId) {
    date_default_timezone_set('Asia/Manila');
    $loginTime = date('Y-m-d H:i:s'); // Get current timestamp
    $stmt = $pdo->prepare("INSERT INTO user_history (User_ID, Last_Login) VALUES (?, ?)");
    $stmt->execute([$userId, $loginTime]);

    return $pdo->lastInsertId();
}

$error = null; // Add this to avoid undefined variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Registration
    if (isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
        $first = trim($_POST['first_name']);
        $last = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $pass = $_POST['password'];
        $confirm = $_POST['confirm_password'];
        $otp = rand(100000, 999999); //Generating OTP

        // Basic validation
        if ($pass !== $confirm) {
            $error = "Passwords do not match.";
        } 
        elseif(strlen($pass) < 8){
            $error = "The password must contain at least 8 characters";
        }else {
            // Check if email exists
            $stmt = $pdo->prepare("SELECT * FROM user_accounts WHERE Email_Add = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $error = "Email already registered.";
            } else {
                // Hash password
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                // Insert user
                $verification_code = bin2hex(random_bytes(16));
                $stmt = $pdo->prepare("INSERT INTO user_accounts (FirstName, LastName, Email_Add, Password, Status, Verification_Code, OTP) VALUES (?, ?, ?, ?, 'Pending', ?,?)");
                $stmt->execute([$first, $last, $email, $hash, $verification_code, $otp]);
            
                // Send verification email using PHPMailer
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'customerservicesoundstage@gmail.com'; 
                    $mail->Password   = 'uotdoblzaisbokky';   
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port       = 465 ;
                    $mail->setFrom('customerservicesoundstage@gmail.com', 'SoundStage');
                    $mail->addAddress($email, $first . ' ' . $last);
                    $mail->isHTML(true);
                    $mail->Subject = 'Verify your account';
                    $mail->Body    = "Your OTP Verification is: $otp
                    <br><br>
                    This is a one-time password (OTP) for verification purposes. Please do not share it with anyone.
                    Please do not reply in this email.
                    <br><br>
                    Thank you!";
                    $mail->send();
                    echo"<script>
                    alert('Verification email sent to your email address. Please check your email to verify your account.')
                    document.location.href = 'otpverify.php?verification_code=$verification_code';
                    </script>
                    ";

                } catch (Exception $e) {
                    die("Verification email could not be sent. Mailer Error: {$mail->ErrorInfo}");
                }

                

                // Get user ID
                $user_id = $pdo->lastInsertId();
                // Set session
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $first . ' ' . $last;
                // Wag muna mag-login, ipaalam sa user na mag-verify muna ng email
                echo "<script>
                    alert('Registration successful! Please check your email to verify your account.');
                    window.location.href = 'auth.php';
                </script>";
                exit;
            }
        }
    }
    
    // Login
    elseif (isset($_POST['email'], $_POST['password']) && !isset($_POST['first_name'])) {
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $error = loginUser($pdo, $email, $password);
        if ($error === "success") {
            echo "<script>window.location.href = '/System/SoundStage/src/dashboard.php';</script>";
            exit;
        }
    }
}
?>

<?php
    $showRegister = isset($_GET['action']) && $_GET['action'] === 'register';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login/Register | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/System/SoundStage/src/assets/icons/website-icon.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        input[type="password"]::-ms-reveal,  /* <-- to clear the default eye icon in browser */
        input[type="password"]::-ms-clear {
            display: none;
        }

        body {
            background: linear-gradient(135deg, #ffffff 0%, #003366 100%);
            color: #eaf6ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .flip-card {
            background: transparent;
            width: 400px;
            height: 480px;
            perspective: 1000px;
        }
        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.8s cubic-bezier(.4,2,.6,1);
            transform-style: preserve-3d;
        }
        .flip-card.flipped .flip-card-inner {
            transform: rotateY(180deg);
        }
        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            background: #ffffff;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
            padding: 1rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #000000;
        }
        .flip-card-back {
            height: 535px !important; 
            transform: rotateY(180deg);
        }
        .form-title {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #003366;
            text-align: center;
        }
        .form-icon {
            font-size: 2.5rem;
            color: #003366;
            margin-bottom: 1rem;
            text-align: center;
        }
        .form-switch-link {
            color: #003366;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-primary {
            background: #003366;
            border: none;
            color: #ffffff;
        }
        .btn-primary:hover {
            background: black;
            color: #ffffff;
        }
        .input-group .btn, .input-group-text {
            background: #003366;
            color: #ffffff;
            border: none;
        }
        .form-control {
            background: #181c24;
            color: #ffffff;
            border: 1px solid #2e3a4d;
        }
        .form-control:focus {
            background: #232b3e;
            color: #eaf6ff;
            border-color: #7ecbff;
            box-shadow: 0 0 0 0.2rem rgba(126,203,255,0.15);
        }
        .form-check-label {
            color: #000000;
        }
        .form-check-label a {
            text-decoration: none !important;
        }
        .form-check-label a:hover {
            text-decoration: underline; 
        }
        input[type="email"]::placeholder,
        input[type="password"]::placeholder,
        input[type="text"]::placeholder {
            color:rgba(255, 255, 255, 2 ); 
        }

        .form-check-input {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>
    <div class="flip-card<?php if ($showRegister) echo ' flipped'; ?>" id="flipCard">
        <div class="flip-card-inner">
            
            <!-- LOGIN FORM -->
            <div class="flip-card-front">
                <div class="form-icon">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div class="form-title">Login</div>
                <form method="post" action="auth.php" autocomplete="off">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control opacity-50" id="signin-email" name="email" required placeholder="Email address">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control opacity-50" id="signin-password" name="password" required placeholder="Password">
                            <span class="input-group-text" id="toggleSigninPassword"><i class ="bi bi-eye" id="signinPasswordIcon"></i></span>
                        </div>
                    </div>
                    <div class="mb-3 form-check d-flex justify-content-between align-items-center">
                        <div>
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" class="form-switch-link text-decoration: none;">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                    <div class="text-center">
                        <span>Don't have an account? </span>
                        <span class="form-switch-link" onclick="flipCard()">Register</span>
                    </div>
                    <?php if ($error && $error !== "success"): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                </form>
            </div>

            <!-- REGISTER FORM -->
            <div class="flip-card-back">
                <div class="form-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <div class="form-title">Register</div>
                <form method="post" action="auth.php">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control opacity-50" id="signup-firstname" name="first_name" required placeholder="First Name">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control opacity-50" id="signup-lastname" name="last_name" required placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control opacity-50" id="signup-email" name="email" required placeholder="Email address">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control opacity-50" id="signup-password" name="password" required placeholder="Password">
                            <span class="input-group-text" id="toggleSignupPassword"><i class="bi bi-eye" id="signupPasswordIcon"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control opacity-50" id="signup-confirm" name="confirm_password" required placeholder="Confirm Password">
                            <span class="input-group-text" id="toggleSignupConfirm"><i class="bi bi-eye" id="signupConfirmIcon"></i></span>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="agreeTerms" name="agree_terms" required>
                        <label class="form-check-label" for="agreeTerms" style="font-size: 14px;">
                            I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms & Conditions</a> and <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-person-plus"></i> Register
                    </button>
                    <div class="text-center">
                        <span>Already have an account? </span>
                        <span class="form-switch-link" onclick="flipCard()">Sign In</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="post" action="" class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Enter your email address and we'll send you a password reset link.</p>
                    <div class="mb-3">
                    <input type="email" class="form-control" name="forgot_email" placeholder="Email address" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="forgot_submit" class="btn btn-primary w-100">Send Reset Link</button>
                </div>
            </form>
        </div>
    </div>


<?php
    if (isset($_POST['forgot_submit'])) {
        $email = $_POST['forgot_email'];
        $stmt = $pdo->prepare("SELECT * FROM user_accounts WHERE Email_Add=?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $reset_token = bin2hex(random_bytes(32));
            date_default_timezone_set('Asia/Manila');
            $expiry = date("Y-m-d H:i:s", strtotime("+24 hours"));
            $update = $pdo->prepare("UPDATE user_accounts SET Reset_Token=?, Token_Expiry=? WHERE Email_Add=?");
            $update->execute([$reset_token, $expiry, $email]);

            $fullname = $user['FirstName'] . ' ' . $user['LastName'];
            $reset_link = "http://localhost/System/SoundStage/src/pages/auth/resetpass.php?token=$reset_token";

            $mail = new PHPMailer(true); 
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';  
                $mail->SMTPAuth   = true;
                $mail->Username   = 'customerservicesoundstage@gmail.com'; //<- Sender's Email
                $mail->Password   = 'uotdoblzaisbokky'; //<- App Password   
                $mail->SMTPSecure = 'ssl'; //<- SSL Encryption  
                $mail->Port       = 465;   //<- Port for SSL encryption

                //Email Composers
                $mail->setFrom('customerservicesoundstage@gmail.com', 'SoundStage');
                $mail->addAddress($email, $fullname); 
                $mail->isHTML(true);                           
                $mail->Subject = 'Password Reset Link';
                $mail->Body    = "Hello, $fullname,<br><br>Click the link to reset your password: <a href='$reset_link'>$reset_link</a>";
                $mail->AltBody = 'Please use an HTML compatible email client to view this message.';

                $mail->send();
                echo "<script>
                    setTimeout(function() {
                        var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('forgotPasswordModal'));
                        modal.hide();
                        alert('A password reset link has been sent to your email address.');
                    }, 500);
                </script>"; // <-Alert if email send successfully

            } catch (Exception $e) {
                echo "<script>
                    setTimeout(function() {
                        var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('forgotPasswordModal'));
                        modal.hide();
                        alert('Message could not be sent. Mailer Error: " . $mail->ErrorInfo . "');
                    }, 500);
                </script>"; //<-Alert if email send failed
            }
        } else {
            echo "<script>
                setTimeout(function() {
                    var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('forgotPasswordModal'));
                    modal.hide();
                    alert('No user found with that email address.');
                }, 500); 
            </script>"; //<- Alert if the reciver's email was not found in the database
        }
    }
?>

    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background: linear-gradient(135deg, #232b3e 0%, #2a3a4f 100%); border-radius: 1.5rem; box-shadow: 0 8px 32px 0 rgba(31,38,135,0.25);">
          <div class="modal-header border-0" style="border-radius: 1.5rem 1.5rem 0 0;">
            <div class="d-flex align-items-center">
              <i class="bi bi-file-earmark-text-fill me-2" style="font-size: 2rem; color: #7ecbff;"></i>
              <h5 class="modal-title" id="termsModalLabel" style="color: #7ecbff; font-weight: 700;">Terms &amp; Conditions</h5>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body" style="color: #eaf6ff; font-size: 1.08rem; line-height: 1.7;">
            <div class="mb-3">
              <h6 style="color: #4fa3e3; font-weight: 600;">1. Acceptance of Terms</h6>
              <p>By registering or using SoundStage, you agree to abide by these Terms &amp; Conditions. Please read them carefully before proceeding.</p>
            </div>
            <div class="mb-3">
              <h6 style="color: #4fa3e3; font-weight: 600;">2. User Responsibilities</h6>
              <ul style="padding-left: 1.2rem;">
                <li>Provide accurate and up-to-date information during registration.</li>
                <li>Keep your account credentials confidential.</li>
                <li>Do not use SoundStage for unlawful or prohibited activities.</li>
              </ul>
            </div>
            <div class="mb-3">
              <h6 style="color: #4fa3e3; font-weight: 600;">3. Intellectual Property</h6>
              <p>All content and trademarks on SoundStage are the property of their respective owners. Unauthorized use is strictly prohibited.</p>
            </div>
            <div class="mb-3">
              <h6 style="color: #4fa3e3; font-weight: 600;">4. Changes to Terms</h6>
              <p>We reserve the right to update these terms at any time. Continued use of the service constitutes acceptance of the new terms.</p>
            </div>
            <div class="text-end">
              <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal" style="background: #7ecbff; color: #181c24; border: none;">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Privacy Modal -->
    <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background: linear-gradient(135deg, #232b3e 0%, #2a3a4f 100%); border-radius: 1.5rem; box-shadow: 0 8px 32px 0 rgba(31,38,135,0.25);">
          <div class="modal-header border-0" style="border-radius: 1.5rem 1.5rem 0 0;">
            <div class="d-flex align-items-center">
              <i class="bi bi-shield-lock-fill me-2" style="font-size: 2rem; color: #7ecbff;"></i>
              <h5 class="modal-title" id="privacyModalLabel" style="color: #7ecbff; font-weight: 700;">Privacy Policy</h5>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body" style="color: #eaf6ff; font-size: 1.08rem; line-height: 1.7;">
            <div class="mb-3">
              <h6 style="color: #4fa3e3; font-weight: 600;">1. Data Collection</h6>
              <p>We collect only the necessary information to provide and improve our services. Your data is handled with strict confidentiality.</p>
            </div>
            <div class="mb-3">
              <h6 style="color: #4fa3e3; font-weight: 600;">2. Use of Information</h6>
              <ul style="padding-left: 1.2rem;">
                <li>To personalize your experience on SoundStage.</li>
                <li>To communicate important updates or notifications.</li>
                <li>To enhance security and prevent fraud.</li>
              </ul>
            </div>
            <div class="mb-3">
              <h6 style="color: #4fa3e3; font-weight: 600;">3. Data Protection</h6>
              <p>We implement industry-standard security measures to protect your data from unauthorized access or disclosure.</p>
            </div>
            <div class="mb-3">
              <h6 style="color: #4fa3e3; font-weight: 600;">4. Third-Party Services</h6>
              <p>We do not sell or share your personal information with third parties except as required by law or with your explicit consent.</p>
            </div>
            <div class="text-end">
              <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal" style="background: #7ecbff; color: #181c24; border: none;">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function flipCard() {
            document.getElementById('flipCard').classList.toggle('flipped');
        }
        // Password toggle logic
        document.addEventListener('DOMContentLoaded', function () {
            // Login password eye icon 
            const signinPassword = document.getElementById('signin-password');
            const toggleSigninPassword = document.getElementById('toggleSigninPassword');
            const signinPasswordIcon = document.getElementById('signinPasswordIcon');
             toggleSigninPassword.addEventListener('click', function () {
                 const type = signinPassword.type === 'password' ? 'text' : 'password';
                 signinPassword.type = type;
                 signinPasswordIcon.classList.toggle('bi-eye');
                 signinPasswordIcon.classList.toggle('bi-eye-slash');
            });

            // Register password eye icon
            const signupPassword = document.getElementById('signup-password');
            const toggleSignupPassword = document.getElementById('toggleSignupPassword');
            const signupPasswordIcon = document.getElementById('signupPasswordIcon');
            toggleSignupPassword.addEventListener('click', function () {
                const type = signupPassword.type === 'password' ? 'text' : 'password';
                 signupPassword.type = type;
                 signupPasswordIcon.classList.toggle('bi-eye');
                 signupPasswordIcon.classList.toggle('bi-eye-slash');
            });

            // Register confirm password eye icon
            const signupConfirm = document.getElementById('signup-confirm');
            const toggleSignupConfirm = document.getElementById('toggleSignupConfirm');
            const signupConfirmIcon = document.getElementById('signupConfirmIcon');
            toggleSignupConfirm.addEventListener('click', function () {
                const type = signupConfirm.type === 'password' ? 'text' : 'password';
                signupConfirm.type = type;
                signupConfirmIcon.classList.toggle('bi-eye');
                 signupConfirmIcon.classList.toggle('bi-eye-slash');
            });
        });
    </script>
</body>
</html>
