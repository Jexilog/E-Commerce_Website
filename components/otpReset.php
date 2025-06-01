<?php

$connect = mysqli_connect("localhost", "root", "", "credentials");
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
        $input_otp = (string)trim($_POST['otp']);

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
</head>
<body>
    <h1>OTP Verification</h1>
    <p>Please enter the OTP sent to your email address.</p>
    <form action="" method="post" id="otp-form">
        <input type="number" id="otp-input" name="otp" placeholder="Enter OTP" required>
        <br>
        <button type="submit" id="verify-button" name="verify">Verify</button>
    </form>
</body>
</html>