<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>How to Buy | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/AudioHub/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            color: #000000;
        }
        .how-hero {
            background: #003366;
            color: #fff;
            border-radius: 1.5rem;
            padding: 2.5rem 1.5rem 2rem 1.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 32px 0 rgba(0,51,102,0.10);
            text-align: center;
        }
        .how-hero h1 {
            font-weight: 700;
            font-size: 2.3rem;
            margin-bottom: 0.7rem;
        }
        .how-hero p {
            font-size: 1.15rem;
            margin-bottom: 0.2rem;
        }
        .steps-section {
            margin: 0 auto 3rem auto;
            max-width: 900px;
        }
        .step-card {
            background: #ffffff;
            border-radius: 1.2rem;
            box-shadow: 0 2px 16px 0 rgba(0,51,102,0.08);
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            transition: box-shadow 0.2s;
        }
        .step-card:hover {
            box-shadow: 0 6px 24px 0 rgba(0,51,102,0.13);
        }
        .step-icon {
            background: #003366;
            color: #fff;
            border-radius: 50%;
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
            box-shadow: 0 2px 8px 0 rgba(0,51,102,0.10);
        }
        .step-content h3 {
            color: #003366;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .step-content p {
            color: #222;
            font-size: 1.05rem;
            margin-bottom: 0;
        }
        .tips-section {
            background: #e3eaf3;
            border-radius: 1.2rem;
            padding: 2rem 1.5rem;
            margin: 0 auto 2.5rem auto;
            max-width: 900px;
            color: #003366;
        }
        .tips-section h4 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #003366;
        }
        .tips-section ul {
            margin-bottom: 0;
        }
        .tips-section li {
            margin-bottom: 0.5rem;
        }
        .cta-section {
            text-align: center;
            margin-top: 1.5rem;
            padding: 1.5rem;
        }
        .cta-btn {
            background: #003366;
            color: #fff;
            border: none;
            border-radius: 2rem;
            padding: 0.7rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s;
            box-shadow: 0 2px 8px 0 rgba(0,51,102,0.10);
        }
        .cta-btn:hover {
            background: #00509e;
            color: #fff;
        }
        @media (max-width: 767px) {
            .how-hero {
                padding: 1.5rem 1rem 1rem 1rem;
            }
            .step-card {
                flex-direction: column;
                align-items: stretch;
                padding: 1.2rem 0.7rem;
            }
            .tips-section {
                padding: 1.2rem 0.7rem;
            }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="container py-4">
        <!-- Hero Section -->
        <div class="how-hero mt-4">
            <h1><i class="bi bi-cart-check me-2"></i>How to Buy</h1>
            <p>Shopping at SoundStage is simple, secure, and fast. Follow these easy steps to get your favorite audio gear delivered to your door.</p>
        </div>

        <!-- Steps Section -->
        <div class="steps-section">
            <div class="step-card">
                <div class="step-icon"><i class="bi bi-search"></i></div>
                <div class="step-content">
                    <h3>1. Browse & Discover</h3>
                    <p>Explore our wide range of headphones, IEMs, and audio accessories. Use the search bar or browse by category to find what you need.</p>
                </div>
            </div>
            <div class="step-card">
                <div class="step-icon" style="background:#00509e;"><i class="bi bi-bag-plus"></i></div>
                <div class="step-content">
                    <h3>2. Add to Cart</h3>
                    <p>Click <b>Add to Cart</b> on your chosen product. Review your cart anytime by clicking the cart icon at the top right.</p>
                </div>
            </div>
            <div class="step-card">
                <div class="step-icon" style="background:#f9b233;"><i class="bi bi-person-check"></i></div>
                <div class="step-content">
                    <h3>3. Sign In or Register</h3>
                    <p>Log in to your account for a faster checkout. New here? <a href="/AudioHub/src/components/auth/register.php" style="color:#00509e;">Create an account</a> in seconds.</p>
                </div>
            </div>
            <div class="step-card">
                <div class="step-icon" style="background:#00b894;"><i class="bi bi-credit-card"></i></div>
                <div class="step-content">
                    <h3>4. Checkout & Payment</h3>
                    <p>Enter your shipping details and choose your preferred payment method. We support secure payments via card, GCash, and more.</p>
                </div>
            </div>
            <div class="step-card">
                <div class="step-icon" style="background:#e17055;"><i class="bi bi-truck"></i></div>
                <div class="step-content">
                    <h3>5. Order Confirmation & Delivery</h3>
                    <p>After payment, you’ll receive an order confirmation email. Track your order status in <a href="/AudioHub/src/components/orders.php" style="color:#00509e;">My Orders</a>. Sit back and wait for your delivery!</p>
                </div>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="tips-section shadow-sm mb-4">
            <h4><i class="bi bi-lightbulb"></i> Shopping Tips</h4>
            <ul>
                <li>Compare products and read reviews for the best choice.</li>
                <li>Check for ongoing promos and discounts on the homepage.</li>
                <li>Need help? <a href="question.php" style="color:#00509e;">Contact our support team</a> anytime.</li>
                <li>All transactions are secured with SSL encryption.</li>
            </ul>
        </div>

        <!-- Call to Action -->
        <div class="cta-section">
            <a href="/AudioHub/index.php" class="cta-btn">
                <i class="bi bi-shop"></i> Start Shopping Now
            </a>
        </div>
    </div>

    <?php include '../header/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>