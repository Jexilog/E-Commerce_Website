<?php
session_start();
require_once __DIR__ . '../../db.php'; // adjust path if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | HzOne</title>
    <link rel="icon" href="/AudioHub/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #181c24 0%, #2a3a4f 100%);
            color: #eaf6ff;
        }
        .brand-header {
            background: #232b3e;
            border-bottom: 1px solid #2e3a4d;
            padding: 1rem 2rem 1rem 2rem;
            display: flex;
            align-items: center;
        }
        .brand-header .navbar-brand {
            color: #7ecbff !important;
            font-weight: bold;
            font-size: 1.7rem;
            letter-spacing: 1px;
        }
        .brand-header .navbar-brand span {
            color: #ff6b81;
        }
        .cart-main {
            display: flex;
            gap: 2rem;
        }
        .cart-container {
            background: #232b3e;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(126,203,255,0.08);
            padding: 2rem;
            flex: 2;
            min-width: 400px;
        }
        .cart-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .cart-header-row h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            color: #7ecbff;
        }
        .clear-cart {
            color: #ff6b81;
            font-size: 1rem;
            text-decoration: none;
            cursor: pointer;
        }
        .cart-list {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }
        .cart-item-card {
            display: flex;
            align-items: center;
            background: #1a2233;
            border-radius: 12px;
            box-shadow: 0 1px 6px rgba(126,203,255,0.05);
            padding: 1rem 1.5rem;
            position: relative;
        }
        .cart-item-checkbox {
            margin-right: 1rem;
        }
        .product-image {
            width: 64px;
            height: 64px;
            border-radius: 8px;
            background-color: #2a3a4f;
            margin-right: 1.2rem;
            object-fit: cover;
        }
        .cart-item-info {
            flex: 1;
        }
        .cart-item-info h5 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: #eaf6ff;
        }
        .cart-item-info small {
            color: #7ecbff;
        }
        .cart-item-qty {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-right: 2rem;
        }
        .qty-btn {
            border: none;
            background: #7ecbff;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            font-size: 1.2rem;
            color: #181c24;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .qty-btn:hover {
            background: #ff6b81;
            color: #fff;
        }
        .cart-item-price {
            font-size: 1.1rem;
            font-weight: 500;
            margin-right: 2rem;
            min-width: 80px;
            text-align: right;
            color: #ff6b81;
        }
        .delete-row {
            background: none;
            border: none;
            color: #ff6b81;
            font-size: 1.3rem;
            cursor: pointer;
        }
        .select-all-row {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            color: #eaf6ff;
        }
        .select-all-row label {
            margin-left: 0.5rem;
            font-weight: 500;
        }
        /* Sidebar */
        .cart-sidebar {
            background: #1a2233;
            border-radius: 16px;
            padding: 2rem 1.5rem;
            min-width: 320px;
            max-width: 350px;
            height: fit-content;
            color: #eaf6ff;
            box-shadow: 0 2px 16px rgba(126,203,255,0.08);
        }
        .promo-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #7ecbff;
        }
        .promo-input-group {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .promo-input-group input {
            flex: 1;
            border-radius: 6px;
            border: 1px solid #7ecbff;
            padding: 0.5rem 0.75rem;
            background: #232b3e;
            color: #eaf6ff;
        }
        .promo-input-group button {
            border-radius: 6px;
            background: #7ecbff;
            color: #181c24;
            border: none;
            padding: 0.5rem 1.2rem;
            font-weight: 600;
        }
        .promo-input-group button:hover {
            background: #ff6b81;
            color: #fff;
        }
        .cart-summary {
            margin-bottom: 1.5rem;
        }
        .cart-summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }
        .cart-summary-row.total {
            font-weight: 700;
            font-size: 1.1rem;
            color: #ff6b81;
        }
        .checkout-btn {
            width: 100%;
            background: linear-gradient(90deg, #7ecbff 0%, #ff6b81 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.8rem 0;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
        }
        .checkout-btn:hover {
            background: linear-gradient(90deg, #ff6b81 0%, #7ecbff 100%);
            color: #181c24;
        }
        /* Banner */
        .cart-banner {
            background: #232b3e;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(126,203,255,0.08);
            margin-top: 2rem;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        .cart-banner-img {
            width: 200px;
            height: 120px;
            border-radius: 10px;
        }
        .cart-banner-content h5 {
            margin: 0 0 0.5rem 0;
            font-size: 1.2rem;
            font-weight: 600;
            color: #7ecbff;
        }
        .cart-banner-content p {
            margin: 0 0 1rem 0;
            color: #eaf6ff;
        }
        .cart-banner-content .btn {
            background: #7ecbff;
            color: #181c24;
            border-radius: 6px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            border: none;
            transition: background 0.2s, color 0.2s;
        }
        .cart-banner-content .btn:hover {
            background: #ff6b81;
            color: #fff;
        }
        @media (max-width: 991px) {
            .cart-main {
                flex-direction: column;
            }
            .cart-sidebar {
                max-width: 100%;
                margin-top: 2rem;
            }
        }
    </style>
</head>
<body>

    <!-- Brand Header -->
    <?php include '../components/header/header.php'; ?>

    <div class="container mt-5">
        <div class="cart-main">
            <!-- Cart Section -->
            <div class="cart-container">
                <div class="cart-header-row">
                    <h2>
                        Cart
                        <span style="color:#888; font-size:1rem;">
                            (
                            <?php
                                $cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                                echo $cartCount . ' product' . ($cartCount === 1 ? '' : 's');
                            ?>
                            )
                        </span>
                    </h2>
                    <a href="#" class="clear-cart">Clear cart</a>
                </div>
                <div class="select-all-row">
                    <input type="checkbox" id="selectAll">
                    <label for="selectAll">All</label>
                </div>
                <div class="cart-list">
                    <?php if (!empty($cartProducts)): foreach ($cartProducts as $item): ?>
                    <div class="cart-item-card" data-id="<?= htmlspecialchars($item['id']) ?>">
                        <input type="checkbox" class="cart-item-checkbox">
                        <img src="<?= htmlspecialchars($item['image']) ?>" class="product-image" alt="Product">
                        <div class="cart-item-info">
                            <h5><?= htmlspecialchars($item['name']) ?></h5>
                            <small><?= isset($item['color']) ? htmlspecialchars($item['color']) : '' ?></small>
                        </div>
                        <div class="cart-item-qty">
                            <button class="qty-btn minus"><i class="bi bi-dash"></i></button>
                            <span class="qty text-light"><?= $item['qty'] ?></span>
                            <button class="qty-btn plus"><i class="bi bi-plus"></i></button>
                        </div>
                        <div class="cart-item-price">₱<?= number_format($item['itemTotal'], 2) ?></div>
                        <button class="delete-row"><i class="bi bi-x"></i></button>
                    </div>
                    <?php endforeach; else: ?>
                    <div class="text-center text-primary">Your cart is empty.</div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Sidebar Section -->
            <div class="cart-sidebar">
                <div class="promo-title">Promo code</div>
                <div class="promo-input-group">
                    <input type="text" placeholder="Type here...">
                    <button>Apply</button>
                </div>
                <div class="cart-summary">
                    <div class="cart-summary-row">
                        <span>Subtotal</span>
                        <span>₱</span>
                    </div>
                    <div class="cart-summary-row">
                        <span>Discount</span>
                        <span>₱</span>
                    </div>
                    <div class="cart-summary-row total">
                        <span>Total</span>
                        <span>₱</span>
                    </div>
                </div>
                <form method="post" action="checkout.php" style="margin:0;">
                    <button type="submit" class="checkout-btn btn btn-primary<?= empty($cartProducts) ? ' disabled' : '' ?>">Continue to checkout</button>
                </form>
            </div>
        </div>
        <!-- Banner Section -->
        <div class="cart-banner mt-4 mb-4">
            <img src="../assets/iems/iem-banner.jpg" class="cart-banner-img" alt="Apple Watch">
            <div class="cart-banner-content">
                <h5>Check the Newest In-Ear Monitor Product</h5>
                <p>Official IEM retailer</p>
                <a href="#" class="btn">Shop Now</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../components/header/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>
