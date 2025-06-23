<?php
session_start();
$checkoutId = isset($_GET['checkout_id']) ? intval($_GET['checkout_id']) : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Success | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/System/SoundStage/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #181c24 0%, #2a3a4f 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #eaf6ff;
            display: flex;
            flex-direction: column;
        }
        .success-container {
            max-width: 480px;
            margin: 60px auto 0 auto;
            background: #232b3e;
            border-radius: 14px;
            padding: 2.5rem 2rem 2rem 2rem;
            box-shadow: 0 2px 16px rgba(126,203,255,0.07);
            text-align: center;
        }
        .success-icon {
            font-size: 3.5rem;
            color: #7ecbff;
            margin-bottom: 1rem;
        }
        .success-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #7ecbff;
            margin-bottom: 0.7rem;
        }
        .success-msg {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        .order-id {
            font-size: 1.1rem;
            color: #ff6b81;
            margin-bottom: 1.5rem;
        }
        .btn-home {
            background: linear-gradient(90deg, #7ecbff 0%, #ff6b81 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.8rem 2.2rem;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
        }
        .btn-home:hover, .btn-home:focus {
            background: linear-gradient(90deg, #ff6b81 0%, #7ecbff 100%);
            color: #181c24;
        }
        @media (max-width: 576px) {
            .success-container {
                padding: 1.2rem 0.5rem;
                margin: 30px 8px 0 8px;
            }
        }
    </style>
</head>
<body>
    <?php include '../components/header/header.php'; ?>

    <div class="success-container">
        <div class="success-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="success-title">Thank you for your order!</div>
        <div class="success-msg">
            Your order has been placed successfully.<br>
            <?php if ($checkoutId): ?>
                <div class="order-id">Order Number: <strong>#<?= htmlspecialchars($checkoutId) ?></strong></div>
            <?php endif; ?>
            We appreciate your trust in SoundStage. You will receive a confirmation email soon.
        </div>
        <a href="/AudioHub/index.php" class="btn btn-home mt-2"><i class="bi bi-house"></i> Back to Home</a>
    </div>

    <?php include '../components/header/footer.php'; ?>
</body>
</html>