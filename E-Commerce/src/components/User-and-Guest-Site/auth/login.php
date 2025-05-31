<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_signup");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM admin_users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = mysqli_fetch_assoc($result);


    if ($user && password_verify($password,$user['password'])) { 
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: dashboard.php"); 
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/loginstyle.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="image-side">    
            <img src="../images/login.png" alt="User Login">
        </div>
        <div class="form-side">
            <form id="forms" action="login.php" method="POST">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
            <center>
            <h1><b>Welcome Back</b></h1>
            <p>Please login to your account.</p>
            </center>
                <input type="email" id="email" name ="email" placeholder="Email address">
                <div class="password-wrapper">
                    <input type="password" id="Password" name ="password" placeholder="Password">
                        <span class="show-password-label" id="togglePassword" style="cursor:pointer;">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </span>
                </div>
                <center>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="checkbox-container">
                        <input type="checkbox" id="rememberMe">
                        <label for="rememberMe">Remember me</label>
                    </div>
                    <p><a href="../components/forgotpass.php"><b>Forgot password?</b></a></p>
                </div>
                <button type="submit">Login</button>
                <p>Don't have an account? <b><a href="../components/signup.php">Sign Up</a></b></p>
                </center>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
    crossorigin="anonymous"></script>
    <script src="../script/test.js"></script>
</body>
</html>