<?php

$connect = mysqli_connect("localhost", "root", "", "testing");
$email = "";
$stored_otp = "";
$sql_query = "SELECT Email_Add, OTP FROM user_accounts where status = 'inactive' ORDER BY Created_AT DESC LIMIT 1";
$result = mysqli_query($connect, $sql_query);
if (mysqli_num_rows($result) > 0) {
    $rows = mysqli_fetch_assoc($result);
    $email = $rows['Email_Add'];
    $stored_otp = $rows['OTP'];

    if (isset($_POST['verify'])) {
        $input_otp = $_POST['otp1'] . $_POST['otp2'] . $_POST['otp3'] . $_POST['otp4'] . $_POST['otp5'] . $_POST['otp6'];

        if ($input_otp === $stored_otp) {
            $update_sql = "UPDATE user_accounts SET Status = 'active', OTP = NULL, Verification_Code = NULL WHERE Email_Add = '$email' AND OTP = ?;";
            mysqli_query($connect, $update_sql);

            echo "<script>
            alert('OTP verified successfully! You can now log in.');
            document.location.href = '/AudioHub/src/dashboard.php';
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
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:"Poppins", sans-serif;
        }

        body{
            background: linear-gradient(135deg, #ffffff 0%, #003366 100%);
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
            background-color: white;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
            border: 2px solid rgba(255,255,255,0.2);
            color: #000000;
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
            border: 3px solid black; /* Add border for visibility */
            outline: none;
            border-radius: 7px;
            caret-color: auto;
            color: #000000;
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
            background: #003366;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            color: #ffffff;
            cursor: pointer;
            font-weight: 600;
        }

    </style>
</head>
<body>
    <div class="container">
    <h1>OTP Verification</h1>
    <p>Please enter the OTP sent to your email address.</p>
        <form action="" method="post" id="otp-form" autocomplete="off">
            <div class="input-box">
                <input type="tel" id="otp-input1" class="otp-inputs" maxlength = "1" name="otp1" autocomplete="one-time-code" inputmode="numeric">
                <input type="tel" id="otp-input2" class="otp-inputs" maxlength = "1" name="otp2" autocomplete="one-time-code" inputmode="numeric">
                <input type="tel" id="otp-input3" class="otp-inputs" maxlength = "1" name="otp3" autocomplete="one-time-code" inputmode="numeric">
                <input type="tel" id="otp-input4" class="otp-inputs" maxlength = "1" name="otp4" autocomplete="one-time-code" inputmode="numeric">
                <input type="tel" id="otp-input5" class="otp-inputs" maxlength = "1" name="otp5" autocomplete="one-time-code" inputmode="numeric">
                <input type="tel" id="otp-input6" class="otp-inputs" maxlength = "1" name="otp6" autocomplete="one-time-code" inputmode="numeric">
            </div>
            <br>
            <button type="submit" id="verify-button" name="verify">Verify</button>
        </form>
    </div>
   <script>
    const inputs = document.querySelectorAll(".otp-inputs");

    inputs.forEach((input, index) => {
        input.addEventListener("keydown", (e) => {
            if (e.key >= "0" && e.key <= "9") {
                input.value = ""; 
            }

            if (e.key === "Enter") {
                e.preventDefault();
                if (index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            }

            if (e.key === "Backspace" && input.value === "" && index > 0) {
                inputs[index - 1].focus();
            }
        });

        input.addEventListener("input", () => {
            if (input.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });
    });
</script>

</body>
</html>