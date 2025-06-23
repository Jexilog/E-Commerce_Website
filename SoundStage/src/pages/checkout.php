<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require'../../Composer/vendor/phpmailer/phpmailer/src/Exception.php';
require '../../Composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../Composer/vendor/phpmailer/phpmailer/src/SMTP.php';
require '../../Composer/vendor/autoload.php';

require_once __DIR__ . '../../db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

// Gather form data
$name = $_POST['name'] ?? '';
$phoneno = $_POST['mobile'] ?? '';
$email = $_POST['email'] ?? '';
$city = $_POST['city'] ?? '';
$state = $_POST['state'] ?? '';
$zip = $_POST['zip'] ?? '';
$address = $_POST['address'] ?? '';
$pay = $_POST['payment'] ?? 'Not Specified';
$receipt_number = 'RCPT-' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
$status = 'pending';
$subtotal = 0;
$cartProducts = [];

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get cart ID
$cartRes = $pdo->prepare("SELECT Cart_ID FROM cart_tbl WHERE User_ID = ? ORDER BY Cart_ID DESC LIMIT 1");
$cartRes->execute([$_SESSION['user_id']]);
$cart = $cartRes->fetch(PDO::FETCH_ASSOC);

if ($cart) {
    $cartId = $cart['Cart_ID'];

    // Fetch cart items
    $itemsStmt = $pdo->prepare("
        SELECT ci.*, p.ProductName, p.Image_URL
        FROM cart_items_tbl ci
        JOIN product_tbl p ON p.Product_ID = ci.Product_ID
        WHERE ci.Cart_ID = ?
    ");
    $itemsStmt->execute([$cartId]);
    $items = $itemsStmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($items as $item) {
    $unitPrice = floatval(str_replace(',', '', $item['Unit_price']));
    $itemTotal = $item['Qty'] * $unitPrice;

    $cartProducts[] = [
        'cartitem' => $item['CartItem_ID'],
        'productId' => $item['Product_ID'],
        'id' => $item['Cart_ID'],
        'name' => $item['ProductName'],
        'image' => $item['Image_URL'], 
        'qty' => $item['Qty'],
        'unitPrice' => number_format($unitPrice, 2),
        'itemTotal' => number_format($itemTotal, 2)
    ];

    $subtotal += $itemTotal;
}

}

$discount = 0;
$total = $subtotal - $discount;

if (isset($_POST['confirmed'])) {
    // Save checkout
    $checkoutStmt = $pdo->prepare("INSERT INTO checkout_tbl (User_ID, Cart_ID, Total_Amount, PaymentMet, TransactionStat, CheckoutTstamp)
        VALUES (?, ?, ?, ?, ?, NOW())");
    
    if ($checkoutStmt->execute([$_SESSION['user_id'], $cartId, $total, $pay, $status])) {
        // Format cart products as HTML
        $itemList = "";
        foreach ($cartProducts as $prod) {
            $itemList .= "<li>{$prod['name']} — Qty: {$prod['qty']}, Unit: ₱{$prod['unitPrice']}, Total: ₱{$prod['itemTotal']}</li>";
        }

        // Send confirmation email
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'customerservicesoundstage@gmail.com';
            $mail->Password = 'uotdoblzaisbokky';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('customerservicesoundstage@gmail.com', 'SoundStage');
            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = 'Payment Confirmed!';
            $mail->Body = "
                <h2>SoundStage - Order Confirmation</h2>
                <p>Thank you, <strong>$name</strong>! Your order has been confirmed.</p>
                <p><strong>Receipt No:</strong> $receipt_number</p>
                <h3>Order Details</h3>
                <ul>$itemList</ul>
                <p><strong>Total Paid:</strong> ₱" . number_format($total, 2) . "</p>
                <h4>Delivery Info</h4>
                <p>
                    <strong>Phone:</strong> $phoneno<br>
                    <strong>Email:</strong> $email<br>
                    <strong>Address:</strong> $address, $city, $state, $zip
                </p>
            ";

            if($mail->send()){
                echo "<script>
                ('Payment Confirmed!');
                document.location.href = '../pages/cart.php'
                </script>
                ";
                $clear_items = $pdo->prepare("DELETE FROM cart_items_tbl WHERE Cart_ID = ?");
                $clear_items->execute([$cartId]);

                // Create a new cart for the user
                $new_cart = $pdo->prepare("INSERT INTO cart_tbl (User_ID) VALUES (?)");
                $new_cart->execute([$_SESSION['user_id']]);

            } else {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            exit;

        } catch (Exception $e) {
            echo "
                <script>
                    alert('Mailer Error: {$mail->ErrorInfo}');
                    window.location.href = '../cart.php';
                </script>
            ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Checkout | SoundStage</title>
    <link rel="icon" href="/System/SoundStage/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background: #ffffff;
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #000000;
        }
        .brand-header {
            background: #003366;
            border-bottom: 1px solid #2e3a4d;
            padding: 1rem 2rem;
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
        .checkout-wrapper {
            max-width: 1200px;
            margin: 40px auto;
            display: flex;
            gap: 2.5rem;
        }
        .checkout-left, .checkout-right {
            background: #003366;
            border-radius: 14px;
            padding: 2.2rem 2rem;
            box-shadow: 0 2px 16px rgba(126,203,255,0.07);
        }
        .checkout-left {
            flex: 1.2;
            min-width: 350px;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .checkout-right {
            flex: 1.4;
            min-width: 400px;
            max-width: 540px;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .section-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 1.5rem 1.2rem 1.2rem 1.2rem;
            margin-bottom: 0.5rem;
        }
        .section-title {
            font-size: 1.08rem;
            font-weight: 600;
            color: #003366;
            margin-bottom: 1.1rem;
        }
        .form-row {
            display: flex;
            gap: 1rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-control, .custom-select {
            border-radius: 6px;
            font-size: 1rem;
            background: #232b3e;
            color: #eaf6ff;
            border: 1px solid #7ecbff;
        }
        .form-control:focus, .custom-select:focus {
            border-color: #ff6b81;
            background: #232b3e;
            color: #eaf6ff;
        }
        label {
            color: #000000;
            font-weight: 500;
        }
        .toggle-switch {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            margin-bottom: 1rem;
        }
        .toggle-switch input[type="checkbox"] {
            width: 38px;
            height: 20px;
            accent-color: #7ecbff;
        }
        .toggle-switch label {
            color: #eaf6ff;
        }
        .payment-methods {
            display: flex;
            height: 60px;
            gap: 1.5rem;
            margin-top: 0.5rem;
        }
        .payment-radio-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            color: #eaf6ff;
            background: #003366;
            border-radius: 6px;
            padding: 0.6rem 1.1rem;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border 0.2s, background 0.2s;
        }
        .payment-radio:checked + .payment-radio-label {
            border: 2px solid rgb(44, 140, 204);
            background: #003366;
        }
        .payment-radio {
            display: none;
        }

        /* Order Summary */
        .order-summary-title {
            font-size: 1.15rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            color: #7ecbff;
        }
        .order-list {
            list-style: none;
            padding: 0;
            margin: 0 0 1.2rem 0;
        }
        .order-list li {
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid #2e3a4d;
            padding: 1rem 0;
        }
        .order-list li:last-child {
            border-bottom: none;
        }
        .order-list img {
            width: 54px;
            height: 54px;
            object-fit: cover;
            border-radius: 8px;
            background: #232b3e;
        }
        .order-info {
            flex: 1;
        }
        .order-title {
            font-size: 1.03rem;
            font-weight: 500;
            margin-bottom: 0.2rem;
            color: #eaf6ff;
        }
        .order-category {
            font-size: 0.97rem;
            color: #7ecbff;
        }
        .order-qty-controls {
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-left: 1.2rem;
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
        .order-price {
            font-size: 1.05rem;
            font-weight: 600;
            color: #ff6b81;
            margin-left: 1.2rem;
            min-width: 80px;
            text-align: right;
        }
        .summary-table {
            width: 100%;
            margin-bottom: 0.7rem;
        }
        .summary-table td {
            color: #eaf6ff;
            font-size: 1rem;
            padding: 6px 0;
        }
        .summary-table .label {
            color: #7ecbff;
        }
        .summary-table .total-row td {
            font-size: 1.13rem;
            font-weight: 700;
            border-top: 1px solid #2e3a4d;
            padding-top: 12px;
            color: #ff6b81;
        }
        .confirm-btn {
            width: 100%;
            background: linear-gradient(90deg, #7ecbff 0%, #ff6b81 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 1rem 0;
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 0.5rem;
            transition: background 0.2s, color 0.2s;
        }
        .confirm-btn:hover, .confirm-btn:focus {
            background: linear-gradient(90deg, #ff6b81 0%, #7ecbff 100%);
            color: #181c24;
        }
        @media (max-width: 991.98px) {
            .checkout-wrapper {
                flex-direction: column;
                gap: 1.5rem;
            }
            .checkout-left, .checkout-right {
                padding: 1.2rem 0.7rem;
            }
        }
        @media (max-width: 576px) {
            .modal-dialog {
                max-width: 95vw;
                margin: 1.75rem auto;
            }
            .modal-content {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- Brand Header -->
    <?php include '../components/header/header.php'; ?>

    <div class="checkout-wrapper">
        <!-- LEFT: Delivery Info, Schedule, Payment -->
        <div class="checkout-left">
            <!-- Delivery Information -->
            <div class="section-card">
                <div class="section-title">Delivery Information</div>
                <form method="post" id="checkoutForm">
                    <input type="hidden" name="cart_id" value="<?= htmlspecialchars($cartId) ?>">
                    <div class="form-row">
                        <div class="form-group flex-fill">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group flex-fill">
                            <label for="mobile">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group flex-fill">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group flex-fill">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group flex-fill">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" required>
                        </div>
                        <div class="form-group flex-fill">
                            <label for="zip">ZIP</label>
                            <input type="text" class="form-control" id="zip" name="zip" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <!-- Payment Method -->
                    <div class="section-card">
                        <div class="section-title">Payment Method</div>
                        <div class="payment-methods">
                            <input type="radio" class="payment-radio" id="pay-cod" name="payment" value="cod" checked>
                            <label for="pay-cod" class="payment-radio-label">
                                <i class="bi bi-cash-stack"></i> Cash on Delivery
                            </label>
                            <input type="radio" class="payment-radio" id="pay-paypal" name="payment" value="paypal">
                            <label for="pay-paypal" class="payment-radio-label">
                                <i class="bi bi-paypal"></i> PayPal
                            </label>
                            <input type="radio" class="payment-radio" id="pay-gcash" name="payment" value="gcash">
                            <label for="pay-gcash" class="payment-radio-label">
                                <img src="../assets/icons/gcash.jfif" alt="GCash" style="height:22px; vertical-align:middle;"> GCash
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="confirm-btn" name="confirmed">Confirm Order</button>
                </form>
            </div>
        </div>
        
        <!-- RIGHT: Order Summary -->
        <div class="checkout-right">
            <div class="order-summary-title">Order Summary</div>
            <ul class="order-list">
                <?php if (!empty($cartProducts)): foreach ($cartProducts as $item): ?>
                <li>
                    <?php $imagePath = '/System/SoundStage/src/assets/uploads/';
                    $image = !empty($item['image']) ? $imagePath . $item['image'] : $imagePath . '684a7e8b8fbb6_kadenz.avif';
                    ?>
                    <img src="<?= htmlspecialchars($image) ?>" class="product-image" alt="Product">
                    <div class="order-info">
                        <div class="order-title"><?= htmlspecialchars($item['name']) ?></div>
                    </div>
                    <div class="order-qty-controls">
                        <span><?= $item['qty'] ?></span>
                        <a href="remove-item.php?id=<?= urlencode($item['qty']) ?>"
                        style="font-size:1.7rem; color: #ff6b81; text-decoration: none;"
                            onclick="return confirm('Remove this item?');">
                            <i class= "bi bi-x"></i>
                        </a>
                    </div>
                    <div class="order-price">₱<?= $item['itemTotal'] ?></div>
                </li>
                <?php endforeach; else: ?>
                <li><div class="text-primary">Your cart is empty.</div></li>
                <?php endif; ?>
            </ul>
            <table class="summary-table">
                <tr>
                    <td class="label">Subtotal</td>
                    <td class="text-right">₱<?= number_format($subtotal, 2) ?></td>
                </tr>
                <tr>
                    <td class="label">Shipping</td>
                    <td class="text-right">₱<?= number_format($discount, 2) ?></td>
                </tr>
                <tr class="total-row">
                    <td>Total (PHP)</td>
                    <td class="text-right">₱<?= number_format($total, 2) ?></td>
                </tr>
            </table>

            <!-- Order Summary Controls -->
            <div class="d-flex justify-content-between mb-2">
                <a href="cart.php?action=clear" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear the cart?')">
                    <i class="bi bi-trash"></i> Clear Cart</a>
            </div>
        </div>
    </div>

    <!-- Success/Error Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background:#232b3e; color:#eaf6ff;">
          <div class="modal-header border-0">
            <h5 class="modal-title" id="checkoutModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="checkoutModalBody"></div>
          <div class="modal-footer border-0">
            <a href="order-success.php" id="successRedirect" class="btn btn-success d-none">Go to Order Success</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalBtn">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include '../components/header/footer.php'; ?>
    
</body>
</html>