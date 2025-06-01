<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "credentials");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useroremail = $_POST['useroremail'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM users_account WHERE Email = ? OR UserName = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param('ss', $useroremail, $useroremail);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = mysqli_fetch_assoc($result);

    if ($user && $user['Password'] === $password) { 
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: ../components/index.php"); 
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
    <title>Login</title>
</head>
<body>
    <form action="" method="post" autocomplete="off">
        <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
        <h1>Login</h1>
        <label for="useroremail">Email or Username:</label>
        <input type="text" id="useroremail" name="useroremail" placeholder="Email or Username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <br>
        <button type="submit">Login</button>
        <p>Don't have an account? <a href="../components/Signup-page.php">Register</a></p>
    </form>
</body>
</html>