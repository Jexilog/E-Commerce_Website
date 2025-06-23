<?php
session_start();
// Example orders array (replace with your actual DB logic)
$orders = [
    [
        'id' => 1,
        'created_at' => '2025-06-01 14:23:00',
        'status' => 'Delivered',
        'total' => 2999.00
    ],
    [
        'id' => 2,
        'created_at' => '2025-05-28 10:15:00',
        'status' => 'Shipped',
        'total' => 1599.00
    ],
    [
        'id' => 3,
        'created_at' => '2025-05-20 09:00:00',
        'status' => 'Cancelled',
        'total' => 899.00
    ],
    [
        'id' => 4,
        'created_at' => '2025-05-20 09:00:00',
        'status' => 'Pending',
        'total' => 1869.00
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            color: #000000;
        }
        .no-orders {
            max-width: 500px;
            margin: 0 auto;
            background: #f7fbff;
            border: 1px solid #e3eaf3;
        }
        .orders-table {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 2px 16px 0 rgba(0,51,102,0.07);
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
        }
        .return-btn {
            background: #003366;
            color: #fff;
            border-radius: 2rem;
            padding: 0.4rem 1.2rem;
            font-weight: 500;
            border: none;
            transition: background 0.2s;
        }
        .return-btn:hover {
            background: #00509e;
            color: #fff;
        }
        .badge-status {
            font-size: 0.95rem;
            border-radius: 1rem;
            padding: 0.3em 1em;
        }
        .badge-pending { background: #f9b233; color: #fff; }
        .badge-shipped { background: #00b894; color: #fff; }
        .badge-delivered { background: #003366; color: #fff; }
        .badge-cancelled { background: #e17055; color: #fff; }
    </style>
</head>
<body>
    <?php include '../components/header/header.php'; ?>

    <div class="container mt-5 mb-5">
        <h1 class="text-center mb-4 text-primary">My Orders</h1>
        <p class="text-center mb-2 mt-2 text-secondary">
            View all your recent purchases and their status below.
        </p>

        <?php if ($orders && count($orders) > 0): ?>
            <div class="orders-table shadow-sm mb-4">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td>#<?= htmlspecialchars($order['id']) ?></td>
                                <td><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                                <td>
                                    <?php
                                        $status = strtolower($order['status']);
                                        $badgeClass = 'badge-status ';
                                        if ($status === 'pending') $badgeClass .= 'badge-pending';
                                        elseif ($status === 'shipped') $badgeClass .= 'badge-shipped';
                                        elseif ($status === 'delivered') $badgeClass .= 'badge-delivered';
                                        elseif ($status === 'cancelled') $badgeClass .= 'badge-cancelled';
                                        else $badgeClass .= 'bg-secondary text-white';
                                    ?>
                                    <span class="<?= $badgeClass ?>">
                                        <?= ucfirst($status) ?>
                                    </span>
                                </td>
                                <td>₱<?= number_format($order['total'], 2) ?></td>
                                <td>
                                    <?php if ($status === 'delivered'): ?>
                                        <a href="return.php?order_id=<?= $order['id'] ?>" class="return-btn btn btn-sm">
                                            <i class="bi bi-arrow-repeat"></i> Return
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size:0.95rem;">Not eligible</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="no-orders bg-light rounded-4 shadow-sm p-5 text-center mt-5">
                <i class="bi bi-bag-x" style="font-size:3rem;color:#0d6efd;"></i>
                <h4 class="mt-3 mb-2 text-dark">You have no orders yet.</h4>
                <p class="mb-4 text-secondary">Ready to experience amazing audio? Start shopping now!</p>
                <a href="/SoundStage/" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-shop"></i> Shop Now
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php include '../components/header/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>