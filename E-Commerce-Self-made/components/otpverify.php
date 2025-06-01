<?php

$connect = mysqli_connect("localhost", "root", "", "credentials");
$email = "";
$stored_otp = "";
$ip_add = $_SERVER['REMOTE_ADDR'];
$sql_query = "SELECT Email, otp FROM users_account WHERE ip_add = '$ip_add' AND status = 'pending' ORDER BY otp_send_time DESC LIMIT 1";
$result = mysqli_query($connect, $sql_query);
if (mysqli_num_rows($result) > 0) {
    $rows = mysqli_fetch_assoc($result);
    $email = $rows['Email'];
    $stored_otp = $rows['otp'];

    if (isset($_POST['verify'])) {
        $input_otp = $_POST['otp'];

        if ($input_otp === $stored_otp) {
            $update_sql = "UPDATE users_account SET status = 'active' WHERE Email = '$email' AND ip_add = '$ip_add'";
            mysqli_query($connect, $update_sql);

            echo "<script>
            alert('OTP verified successfully! You can now log in.');
            document.location.href = '../components/Login-page.php';
            </script>";
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
        <input type="text" id="otp-input" name="otp" placeholder="Enter OTP" required>
        <br>
        <button type="submit" id="verify-button" name="verify">Verify</button>
    </form>
</body>
</html>