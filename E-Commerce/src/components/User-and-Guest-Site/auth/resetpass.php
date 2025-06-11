<?php
$conn = mysqli_connect("localhost", "root", "", "db_signup");
$message = "";
$password_reset = false;

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT * FROM admin_users WHERE reset_tokens=? AND reset_expires > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = mysqli_fetch_assoc($result);

   if ($user) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE admin_users SET password=?, reset_tokens=NULL, reset_expires=NULL WHERE email=?");
        $update->bind_param("ss", $new_password, $user['email']);
        $update->execute();
        $message = "Password reset successful! <a href='login.php'>Login</a>";
        $password_reset = true;
        }
    }else {
        $message = "Invalid or expired token.";
    }
} else {
    $message = "No token provided.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
    crossorigin="anonymous">
</head>
<style>
    @font-face { 
        font-family: "Inter";
        src: url(../fonts/static/Inter_18pt-Regular.ttf) format("truetype");
    }
    * {
        font-family: "Inter", sans-serif;
    }
    body {
        background-color: #e1e1e1;
        padding: 20px;
    }
    h3 {
        text-align: center;
        margin-bottom: 20px;
    }
    form {
        max-width: 400px;
        margin: auto;
        margin-top: 200px;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        align-self: center;
    }
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }
    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 15px;
        cursor: pointer;
    }
    button:hover {
        background-color: #0056b3;
    }
    .alert {
        margin-top: 10px;
        padding: 10px;
        background-color: #f8d7da;
        color: #721c24;
        border-radius: 5px;
    }
</style>
</head>
<body>
    <?php if (isset($user) && $user && !$password_reset): ?>
    <form method="POST">
        <h3>Reset Password</h3>
        <h6 class="text-center">Please set your new password</h6>
        <input type="password" name="password" placeholder="New password" required>
        <button type="submit">Reset Password</button>
    </form>
    <?php endif; ?>

    <?php if (isset($message) && trim($message) !== ""): ?>
        <div class="alert"><?php echo $message; ?></div>
        <script>
            window.onload = function() {
                alert('<?php echo addslashes(strip_tags($message)); ?>');
            };
        </script>
    <?php endif; ?> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>
</body>
</html>