<?php 
    $conn = mysqli_connect("localhost", "root", "", "db_signup");

    $email = "";
    $stored_otp = "";
    $message = "";

    $ip_add = $_SERVER['REMOTE_ADDR'];

    $sql = "SELECT email, otp FROM admin_users WHERE ip_add = '$ip_add' AND status = 'pending' ORDER BY otp_send_time DESC LIMIT 1";

    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0) {
        $email = $rows['email'];
        $stored_otp = $rows['otp'];

        if (isset($_POST['verify'])) {
            $input_otp = $_POST['otp'];

            if ($input_otp === $stored_otp) {
                $update_sql = "UPDATE admin_users SET status = 'active' WHERE email = '$email' AND ip_add = '$ip_add'";
                mysqli_query($conn, $update_sql);

                $message = "OTP verified successfully! You can now log in.";
                echo "<script>
                alert('OTP verified successfully!');
                </script>";
                header("Location: /E-Commerce-Website-System/E-Commerce/src/components/User-and-Guest-Site/auth/login.php");
            } else {
                echo "<script>
                alert('Invalid OTP. Please try again.');
                </script>";
            }
        }
} else {
    $message = "No pending OTP with this Email address.";
}
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" 
    crossorigin="anonymous">
    <style>
        @font-face { 
            font-family: "Inter";
            src: url(../fonts/static/Inter_18pt-Regular.ttf) format("truetype");
            }

        *{
            font-family: "Inter", sans-serif;     ;
        }

        body {
            font-family: "Inter", sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #e1e1e1;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .mb3-input-group {
            gap: 15px;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #003366;
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            /*top: -8px;
            position: relative;*/  
        }

        button:hover {
            background-color: #00509E;
        }

        .alert {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

    </style>
</head>
<body align="center">
    <div class="form-container">
        <h2 align="center">OTP Verification</h2>
            <?php if($email): ?>
        <div class="alert alert-info" role="alert">
            <p>We have sent an OTP to your email address: <strong><?php echo $email; ?></strong></p>
            <p>Please enter the OTP below:</p>
        </div>
            <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <p><?php echo $message; ?></p>
        </div>
            <?php endif; ?>
        <form action="" method="POST">
            <div class="mb-3 input group"> 
                <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP" required>
            </div>
            <button type="submit" name="verify" class="btn btn-primary">Verify OTP</button>
        </form>
           <!-- <--?php if($message && !$email): ?>
                <div class="alert alert-danger" role="alert">
                    <p><--?php echo $message; ?></p>
                </div
            <--?php endif; ?> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
        crossorigin="anonymous"></script>
    </div>
</body>
</html>