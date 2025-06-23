<?php
session_start();
require_once __DIR__ . '../../db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch wishlist items with product details
$stmt = $pdo->prepare("
    SELECT p.Product_ID, p.ProductName, p.Image_URL, p.Price, p.Category_ID, w.Added_At
    FROM wishlist w
    JOIN product_tbl p ON w.Product_ID = p.Product_ID
    WHERE w.User_ID = ?
    ORDER BY w.Added_At DESC
");
$stmt->execute([$user_id]);
$wishlist = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist | SoundStage</title>
    <link rel="icon" href="../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            color: #000000;
        }
        .wishlist-card {
            background: #003366;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px rgba(30, 41, 59, 0.15);
            padding: 2.5rem 2rem;
            margin-top: 2rem;
        }
        .wishlist-title {
            color: #fff;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .table thead th {
            background: #2563eb;
            color: #fff;
            border: none;
        }
        .table tbody tr {
            background: #27304a;
            color: #f4f7fa;
            transition: background 0.2s;
        }
        .table tbody tr:hover {
            background: #2d3a5a;
        }
        .product-img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 2px solid #2563eb;
            background: #fff;
        }
        .remove-btn {
            color: #e53935;
            cursor: pointer;
        }
        .no-wishlist {
            text-align: center;
            color: #b0b8c9;
            margin-top: 2rem;
        }
        .wishlist-table {
            border-radius: 1rem;
            overflow: hidden;
            background: #232b3e;
            box-shadow: 0 2px 16px rgba(30,41,59,0.10);
        }
        .wishlist-table thead tr {
            background: #2563eb;
        }
        .wishlist-table th {
            color: #fff;
            border: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 1.05rem;
        }
        .wishlist-row {
            background: #27304a;
            transition: background 0.2s;
        }
        .wishlist-row:hover {
            background: #2d3a5a;
        }
        .wishlist-img-wrap {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            overflow: hidden;
            border: 2px solid #2563eb;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .wishlist-product-name {
            color: #000000;
            font-size: 1.08rem;
            letter-spacing: 0.2px;
        }
        .wishlist-price {
            color: #7ecbff;
            font-weight: 600;
            font-size: 1.07rem;
        }
        .wishlist-date {
            color: #b0b8c9;
            font-size: 0.98rem;
        }
        .remove-btn {
            color: #e53935;
            cursor: pointer;
            transition: color 0.15s;
        }
        .remove-btn:hover {
            color: #ff6b81;
            transform: scale(1.15);
        }
        @media (max-width: 767px) {
            .wishlist-card { padding: 1rem 0.5rem; }
            .table-responsive { font-size: 0.95rem; }
            .wishlist-table th, .wishlist-table td { font-size: 0.97rem; }
            .wishlist-img-wrap { width: 38px; height: 38px; }
            .wishlist-product-name { font-size: 1rem; }
        }
    </style>
</head>
<body>
    <?php include '../components/header/header.php'; ?>

    <div class="container mt-5 mb-5">
        <div class="wishlist-card w-100 shadow-lg mx-auto" style="max-width: 900px;">
            <div class="d-flex align-items-center mb-4">
                <i class="bi bi-heart-fill fs-2 text-danger me-3"></i>
                <h2 class="wishlist-title mb-0">My Wishlist</h2>
            </div>
            <div class="table-responsive">
                <?php if (count($wishlist) > 0): ?>
                <table class="table align-middle table-borderless wishlist-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="w-50">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Added</th>
                            <th scope="col" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($wishlist as $item): ?>
                        <?php
                            $imageFolder = '';
                            switch ($item['Category_ID'] ?? 1) {
                                case 1: $imageFolder = 'iems'; break;
                                case 2: $imageFolder = 'accessories'; break;
                                default: $imageFolder = 'iems';
                            }
                            $imagePath = "/System/SoundStage/src/assets/{$imageFolder}/" . ltrim($item['Image_URL'], '/');
                        ?>
                        <tr class="wishlist-row">
                            <td class="d-flex align-items-center gap-3">
                                <div class="wishlist-img-wrap">
                                    <img src="<?= htmlspecialchars($imagePath) ?>" class="product-img" alt="Product">
                                </div>
                                <div>
                                    <span class="fw-bold wishlist-product-name"><?= htmlspecialchars($item['ProductName']) ?></span>
                                </div>
                            </td>
                            <td class="wishlist-price">₱<?= number_format($item['Price'], 2) ?></td>
                            <td class="wishlist-date"><?= date('M d, Y', strtotime($item['Added_At'])) ?></td>
                            <td class="text-center">
                                <span class="remove-btn" data-product="<?= $item['Product_ID'] ?>" title="Remove from wishlist" data-bs-toggle="tooltip">
                                    <i class="bi bi-x-circle-fill fs-5"></i>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <div class="no-wishlist">
                        <i class="bi bi-heart fs-1 mb-2"></i>
                        <h5>No items in your wishlist.</h5>
                        <p class="mb-0">Click the <i class="bi bi-heart"></i> icon on a product to add it here.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include '../components/header/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Remove from wishlist (AJAX)
    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.getAttribute('data-product');
            fetch('../components/wishlist-toggle.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'product_id=' + productId
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'removed') {
                    location.reload();
                }
            });
        });
    });

    // Enable Bootstrap tooltip for remove button
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    </script>
</body>
</html>