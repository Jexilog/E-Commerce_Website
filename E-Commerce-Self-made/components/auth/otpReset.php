<?php

$connect = mysqli_connect("localhost", "root", "", "db_websystem");
$email = "";
$stored_otp = "";
$ip_add = $_SERVER['REMOTE_ADDR'];
$sql_query = "SELECT Email, otp FROM users_account WHERE ip_add = ? AND status = 'active' ORDER BY otp_send_time DESC LIMIT 1";
$stmt = $connect->prepare($sql_query);
$stmt->bind_param("s", $ip_add);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $rows = $result->fetch_assoc();
    $email = $rows['Email'];
    $stored_otp = (string)trim($rows['otp']);

    if (isset($_POST['verify'])) {
         $input_otp = $_POST['otp1'] . $_POST['otp2'] . $_POST['otp3'] . $_POST['otp4'] . $_POST['otp5'] . $_POST['otp6'];

        if ($input_otp === $stored_otp) {
            $token = bin2hex(random_bytes(16));
            $update_stmt = $connect->prepare("UPDATE users_account SET token = ?, otp_send_time = NOW() WHERE Email = ? AND ip_add = ?");
            $update_stmt->bind_param("sss", $token, $email, $ip_add);
            $update_stmt->execute();
            $update_stmt->close();

            echo "<script>
            alert('OTP verified successfully! You can now reset your password.');
            window.location.href = '../components/Resetpass-page.php?email=$email&token=$token';
            </script>";
            exit();
        } else {
            echo "<script>
            alert('Invalid OTP. Please try again.');
            </script>"; 
        }
    }
} else {
    echo "<script>
    alert('No pending OTP with this Email address.');
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <style>
     *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:"Poppins", sans-serif;
        }

        body{
            background:url('../../images/login_wallpaper.png') no-repeat;
            background-size:cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container{
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 400px;
            background-color: transparent;
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
            border: 2px solid rgba(255,255,255,0.2);
            color: #fff;
        }
        .container h1{
            font-size: 24px;
            margin-bottom: 20px;
        }

        .container p{
            font-size: 18px;
            margin-bottom: 20px;
        }
        .input-box {
            display: flex;
            justify-content: space-between; /* Space out the inputs evenly */
        }

        .input-box input {
            background: transparent;
            width: 50px; /* Adjust width for better spacing */
            height: 50px; /* Adjust height for better visibility */
            text-align: center;
            border: 2px solid #fff; /* Add border for visibility */
            outline: none;
            border-radius: 7px;
            caret-color: auto;
            color: #fff;
            font-size: 24px; /* Increase font size for better readability */
            font-weight: 600;
            transition: border-color 0.3s; /* Smooth transition for focus */
        }

        .input-box input:focus {
            border-color: #9b59b6; /* Change border color on focus */
        }

        .input-box input::placeholder {
            color: #fff;
            opacity: 0.8;
            font-size: 16px;
            font-weight: 500;
        }
        .container button{
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
    </style>
</head>
<body>
    <div class="container">
        <h1>OTP Reset Password</h1>
        <p>Please enter the OTP sent to your email address.</p>
        <form action="" method="post" id="otp-form">
            <div class="input-box">
                <input type="text" id="otp-input1" class="otp-inputs" maxlength = "1" name="otp1" required>
                <input type="text" id="otp-input2" class="otp-inputs" maxlength = "1" name="otp2" required>
                <input type="text" id="otp-input3" class="otp-inputs" maxlength = "1" name="otp3" required>
                <input type="text" id="otp-input4" class="otp-inputs" maxlength = "1" name="otp4" required>
                <input type="text" id="otp-input5" class="otp-inputs" maxlength = "1" name="otp5" required>
                <input type="text" id="otp-input6" class="otp-inputs" maxlength = "1" name="otp6" required>
            </div>
            <br>
            <button type="submit" id="verify-button" name="verify">Verify</button>
        </form>
    </div>
</body>
</html>