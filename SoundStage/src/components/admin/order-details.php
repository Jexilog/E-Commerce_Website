<?php
    // Get the order ID from the URL
    $orderId = isset($_GET['id']) ? $_GET['id'] : null;

    // Sample static data: Each order ID may have multiple orders/transactions
    $orders = [
        1001 => [
            [
                'order_id' => '1',
                'customer' => 'Jane Doe',
                'email' => 'janedoe@email.com',
                'status' => 'Completed',
                'total' => 800.00,
                'date' => '2035-04-18',
                'items' => [
                    ['name' => 'IEM', 'qty' => 1, 'price' => 200.00],
                    ['name' => 'Headphones', 'qty' => 1, 'price' => 300.00],
                    ['name' => 'Earbuds', 'qty' => 1, 'price' => 300.00],
                ]
            ],
            [
                'order_id' => '2',
                'customer' => 'Jane Doe',
                'email' => 'janedoe@email.com',
                'status' => 'Pending',
                'total' => 500.00,
                'date' => '2035-04-19',
                'items' => [
                    ['name' => 'IEM', 'qty' => 2, 'price' => 250.00],
                ]
            ],
            [
                'order_id' => '3',
                'customer' => 'Jane Doe',
                'email' => 'janedoe@email.com',
                'status' => 'Completed',
                'total' => 1200.00,
                'date' => '2035-04-20',
                'items' => [
                    ['name' => 'Earbuds', 'qty' => 4, 'price' => 300.00],
                ]
            ],
        ],
        1002 => [
            [
                'order_id' => '1',
                'customer' => 'Maria Santos',
                'email' => 'maria@email.com',
                'status' => 'Pending',
                'total' => 1500,
                'date' => '2025-05-25',
                'items' => [
                    ['name' => 'IEM', 'qty' => 1, 'price' => 200.00],
                    ['name' => 'Headphones', 'qty' => 1, 'price' => 300.00],
                ]
            ],
            [
                'order_id' => '2',
                'customer' => 'Maria Santos',
                'email' => 'maria@email.com',
                'status' => 'Completed',
                'total' => 900,
                'date' => '2025-05-26',
                'items' => [
                    ['name' => 'Earbuds', 'qty' => 3, 'price' => 300.00],
                ]
            ],
            [
                'order_id' => '3',
                'customer' => 'Maria Santos',
                'email' => 'maria@email.com',
                'status' => 'Cancelled',
                'total' => 0,
                'date' => '2025-05-27',
                'items' => []
            ],
        ],
        1003 => [
            [
                'order_id' => '1',
                'customer' => 'Keven The Great',
                'email' => 'keventhegreat@email.com',
                'status' => 'Cancelled',
                'total' => 800,
                'date' => '2025-05-24',
                'items' => [
                    ['name' => 'Speaker Mini', 'qty' => 1, 'price' => 800],
                ]
            ],
            [
                'order_id' => '2',
                'customer' => 'Keven The Great',
                'email' => 'keventhegreat@email.com',
                'status' => 'Completed',
                'total' => 1600,
                'date' => '2025-05-25',
                'items' => [
                    ['name' => 'Speaker Mini', 'qty' => 2, 'price' => 800],
                ]
            ],
            [
                'order_id' => '3',
                'customer' => 'Keven the Great',
                'email' => 'keventhegreat@email.com',
                'status' => 'Pending',
                'total' => 400,
                'date' => '2025-05-26',
                'items' => [
                    ['name' => 'Earbuds', 'qty' => 1, 'price' => 400],
                ]
            ],
        ],
    ];

    // Defensive: check if order exists and is array
    $orderList = (isset($orders[$orderId]) && is_array($orders[$orderId])) ? $orders[$orderId] : [];

    $subtotal = 0;
    $customer = '';
    $email = '';
    $status = '';
    $date = '';
    if ($orderList) {
        // Use the first order for customer info
        $customer = $orderList[0]['customer'];
        $email = $orderList[0]['email'];
        $status = $orderList[0]['status'];
        $date = $orderList[0]['date'];
        foreach ($orderList as $order) {
            $subtotal += $order['total'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order #<?= htmlspecialchars($orderId) ?> Details | SoundStage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles/reports.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .order-summary-table th, .order-summary-table td { vertical-align: middle; }
        .order-summary-table thead { background: #0a2942; color: #fff; }
    </style>
</head>
<body>
    <?php include 'sidebar/sidebar.php'; ?>
    <div class="main-content flex-grow-1 p-4">
        <div class="mb-3">
            <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
        <div class="card">
            <div class="card-header bg-white fw-bold">
                Order Details - #<?= htmlspecialchars($orderId) ?>
            </div>
            <div class="card-body">
                <?php if ($orderList): ?>
                <!-- Summary Section -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="mb-1"><i class="bi bi-person-circle me-1"></i> Customer Info</h6>
                        <div>Name: <strong><?= htmlspecialchars($customer) ?></strong></div>
                        <div>Email: <span class="text-muted"><?= htmlspecialchars($email) ?></span></div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-1"><i class="bi bi-receipt me-1"></i> Order Info</h6>
                        <div>Status: 
                            <span class="badge 
                                <?= $status === 'Completed' ? 'bg-success' : ($status === 'Pending' ? 'bg-warning text-dark' : ($status === 'Cancelled' ? 'bg-danger' : 'bg-secondary')) ?>">
                                <?= htmlspecialchars($status) ?>
                            </span>
                        </div>
                        <div>Date: <strong><?= htmlspecialchars($date) ?></strong></div>
                        <div>SubTotal: <strong>₱ <?= number_format($subtotal, 2) ?></strong></div>
                    </div>
                </div>
                <!-- Items Table -->
                <h6 class="mb-2"><i class="bi bi-box-seam me-1"></i> Items</h6>
                <table class="table table-bordered order-summary-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>QTY</th>
                            <th>Order Date</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderList as $order): ?>
                            <?php
                                // Build product list string
                                $productList = '';
                                foreach ($order['items'] as $item) {
                                    $productList .= htmlspecialchars($item['name']) . ' x' . $item['qty'] . ' (₱' . number_format($item['price'], 2) . ')<br>';
                                }
                                $productCount = count($order['items']);
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($order['order_id']) ?></td>
                                <td><?= $productList ?></td>
                                <td><?= $productCount ?></td>
                                <td><?= htmlspecialchars($order['date']) ?></td>
                                <td>₱ <?= number_format($order['total'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <div class="alert alert-danger mb-0">Order not found.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/order-report.js"></script>
</body>
</html>