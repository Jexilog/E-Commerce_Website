<?php
session_start(); // Required for session variables
require_once __DIR__ . '../../../db.php';

$history = [];
$cartProducts = [];
$subtotal = 0;
$discount = 0;
$total = 0;

// Use proper session key casing
if (isset($_SESSION['User_ID'])) {
    $user_id = $_SESSION['User_ID'];

    // Fetch user's checkout history
    $checkoutStmt = $pdo->prepare("SELECT * FROM checkout_tbl WHERE User_ID = ? ORDER BY CheckoutTstamp DESC");
    $checkoutStmt->execute([$user_id]);
    $history = $checkoutStmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch the latest cart (if any)
    $cartRes = $pdo->prepare("SELECT Cart_ID FROM cart_tbl WHERE User_ID = ? ORDER BY Cart_ID DESC LIMIT 1");
    $cartRes->execute([$user_id]);
    $cart = $cartRes->fetch(PDO::FETCH_ASSOC);

    if ($cart && isset($cart['Cart_ID'])) {
        $cartId = $cart['Cart_ID'];

        $itemsStmt = $pdo->prepare("
            SELECT ci.*, p.ProductName, p.Image_URL
            FROM cart_items_tbl ci
            JOIN product_tbl p ON p.Product_ID = ci.Product_ID
            WHERE ci.Cart_ID = ?
        ");
        $itemsStmt->execute([$cartId]);
        $items = $itemsStmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($items as $item) {
            $itemTotal = $item['Qty'] * $item['Unit_price'];
            $subtotal += $itemTotal;

            $cartProducts[] = [
                'product' => $item['ProductName'],
                'qty' => $item['Qty'],
                'unit_price' => number_format($item['Unit_price'], 2),
                'item_total' => number_format($itemTotal, 2),
                'image' => $item['Image_URL']
            ];
        }

        $total = $subtotal - $discount;
    }
} else {
    echo "<p style='color:red; text-align:center;'>Please log in to view your order history.</p>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/styles/users.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <?php include '../../components/admin/sidebar/sidebar.php'; ?>>
    <div class="main-content flex-grow-1" style="margin-left:250px; min-height:100vh; background:#fafbfc;">
        <!-- Header -->
        <header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 py-2 mb-4">
            <a class="navbar-brand fw-300" href="dashboard.php">SoundStage</a>
        </header>

        <!-- Back Button -->
        <div class="px-4 mb-3">
            <a href="users.php" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Back to Users
            </a>
        </div>

        <main class="px-4 py-1">
            <?php
            require_once __DIR__ . '../../../db.php';

            $userEmail = isset($_GET['email']) ? $_GET['email'] : '';
            $userName = isset($_GET['name']) ? $_GET['name'] : '';

            $history = [];

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

                // Fetch all past checkouts for the user
                $checkoutStmt = $pdo->prepare("SELECT * FROM checkout_tbl WHERE User_ID = ? ORDER BY CheckoutTstamp DESC");
                $checkoutStmt->execute([$user_id]);
                $history = $checkoutStmt->fetchAll(PDO::FETCH_ASSOC);
            }
            ?>

            <div class="mb-4">
                <h4 class="mb-1">Order History for <span class="text-primary" id="orderUserName"><?php echo htmlspecialchars($userName); ?></span></h4>
                <div class="text-muted small" id="orderUserEmail"><?php echo htmlspecialchars($userEmail); ?></div>
            </div>

            <div class="table-responsive rounded shadow-sm bg-white p-3">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Order #</th>
                            <th scope="col">Date</th>
                            <th scope="col">Items</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Shipping</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($history)): ?>
                            <?php foreach ($history as $order): ?>
                                <tr>
                                    <td>#<?= str_pad($order['Checkout_ID'], 4, '0', STR_PAD_LEFT) ?></td>
                                    <td><?= date("Y-m-d", strtotime($order['CheckoutTstamp'])) ?></td>
                                    <td>
                                        <ul class="mb-0 small">
                                            <?php
                                            // Fetch products per cart
                                            $cartId = $order['Cart_ID'];
                                            $itemStmt = $pdo->prepare("
                                                SELECT p.ProductName 
                                                FROM cart_items_tbl ci 
                                                JOIN product_tbl p ON p.Product_ID = ci.Product_ID 
                                                WHERE ci.Cart_ID = ?
                                            ");
                                            $itemStmt->execute([$cartId]);
                                            $products = $itemStmt->fetchAll(PDO::FETCH_COLUMN);
                                            foreach ($products as $product) {
                                                echo "<li>" . htmlspecialchars($product) . "</li>";
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                    <td>₱<?= number_format($order['Total_Amount'], 2) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $order['TransactionStat'] == 'Completed' ? 'success' : ($order['TransactionStat'] == 'Pending' ? 'warning text-dark' : 'danger') ?>">
                                            <?= htmlspecialchars($order['TransactionStat']) ?>
                                        </span>
                                    </td>
                                    <td><span class="badge bg-<?= $order['PaymentMet'] == 'COD' ? 'secondary' : 'primary' ?>"><?= htmlspecialchars($order['PaymentMet']) ?></span></td>
                                    <td><span class="badge bg-info text-dark"><?= htmlspecialchars($order['Shipping'] ?? 'N/A') ?></span></td>
                                    <td>
                                        <a href="view_receipt.php?receipt=<?= $order['Checkout_ID'] ?>" class="btn btn-sm btn-outline-secondary" title="View Details"><i class="bi bi-eye"></i></a>
                                        <a href="download_receipt.php?id=<?= $order['Checkout_ID'] ?>" class="btn btn-sm btn-outline-primary" title="Download Invoice"><i class="bi bi-download"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="8" class="text-center text-muted">No orders found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <nav aria-label="Order table pagination" class="mt-3">
                <ul class="pagination justify-content-end mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </main>
    </div>
</body>
</html>