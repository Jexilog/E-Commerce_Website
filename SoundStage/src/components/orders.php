<?php
session_start();
require_once __DIR__ . '../../db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders | AudioHub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #181c24 0%, #2a3a4f 100%);
            font-family: 'Segoe UI', sans-serif;
            color: #f4f7fa;
        }
    </style>
</head>
<body>
    <?php include '../components/header/header.php'; ?>

    <div class="container mt-5 mb-5">
        <h1 class="text-center mb-4 text-primary">My Orders</h1>
        <p class="text-center mb-2 mt-2 text-secondary">Tangena mo Jeckho</p>
    </div>

    <?php include '../components/header/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>