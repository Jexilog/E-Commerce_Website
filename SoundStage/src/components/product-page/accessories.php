<?php
session_start();
require_once __DIR__ . '/../../db.php';

// Fetch Accessories from product_tbl (palitan ang Category_ID depende sa iyong DB)
$stmt = $pdo->prepare("SELECT * FROM product_tbl WHERE Category_ID = ? ORDER BY Brand, ProductName");
$accessoriesCategoryId = 2; // Palitan ayon sa iyong Category_ID para sa Accessories
$stmt->execute([$accessoriesCategoryId]);
$accessories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group by brand
$brands = [];
foreach ($accessories as $acc) {
    $brands[$acc['Brand']][] = $acc;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accessories | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/System/SoundStage/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            color: #003366;
            font-family: 'Segoe UI', sans-serif;
        }
        .accessories-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #003366;
            letter-spacing: 1px;
        }
        .accessories-desc-main {
            color: #000000;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .accessories-main-img {
            display: block;
            margin: 0 auto 2rem auto;
            max-width: 1120px;
            width: 100%;
            border-radius: 1.2rem;
            box-shadow: 0 4px 24px 0 rgba(126,203,255,0.12);
        }
        .accessories-section-title {
            color: #003366;
            font-size: 1.6rem;
            font-weight: 600;
            margin-top: 2.5rem;
            margin-bottom: 1.2rem;
            letter-spacing: 0.5px;
            border-left: 5px solid #003366;
            padding-left: 0.7rem;
        }
        .iem-card {
            background: #003366;
            border-radius: 1.3rem;
            border: 1px solid #ffffff;
            overflow: hidden;
            transition: transform 0.18s cubic-bezier(.4,2,.6,1), box-shadow 0.18s;
            box-shadow: 0 4px 24px 0 rgba(126,203,255,0.08);
            min-height: 350px;
            min-width: 280px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }
        .iem-card:hover {
            transform: translateY(-3px) scale(1);
            box-shadow: 0 8px 40px 0 rgba(126,203,255,0.18);
            border-color: #003366;
        }
        .iem-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-bottom: 1px solid #2e3a4d;
            background: #181c24;
        }
        .iem-card-body {
            flex: 1 1 auto;
        }
        .iem-name {
            color: #eaf6ff;
            font-weight: 600;
            font-size: 1.10rem;
            margin-bottom: 0.5rem;
        }
        .iem-price {
            color: #7ecbff;
            font-weight: 500;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        .iem-brand {
            font-size: 0.95rem;
            border-radius: 0.7rem 0 0.7rem 0;
            padding: 0.4em 1em;
            letter-spacing: 0.5px;
            z-index: 2;
        }
        .btn-outline-primary {
            border-radius: 0.7rem;
            font-weight: 500;
            transition: background 0.15s, color 0.15s;
        }
        .btn-outline-primary:hover {
            background: #7ecbff;
            color: #1a2233;
            border-color: #7ecbff;
        }
        @media (max-width: 767px) {
            .accessories-title { font-size: 1.5rem; }
            .iem-img { height: 100px; }
            .iem-card { min-height: 220px; }
            .accessories-section-title { font-size: 1.15rem; }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="iem-main">
        <div class="container py-4">
            <h1 class="accessories-title mb-3 mt-3 text-center"><i class="bi bi-tools"></i> Accessories</h1>
            <div class="accessories-desc-main mb-4">
                Complete your audio setup with our selection of high-quality accessories.
            </div>
            <img src="/System/SoundStage/src/assets/accessories/accessories-banner.png" alt="Accessories Banner" class="accessories-main-img mb-5">

            <?php foreach ($brands as $brand => $products): ?>
                <div class="accessories-section-title"><?= htmlspecialchars($brand) ?></div>
                <div class="row g-4">
                    <?php foreach ($products as $acc): ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="product-page.php?id=<?= $acc['Product_ID'] ?>" class="iem-card-link" style="text-decoration:none; color:inherit;">
                                <div class="iem-card shadow-sm position-relative"
                                     data-id="<?= $acc['Product_ID'] ?>"
                                     data-name="<?= htmlspecialchars($acc['ProductName']) ?>"
                                     data-price="<?= $acc['Price'] ?>"
                                     data-image="/System/SoundStage/src/assets/accessories/<?= htmlspecialchars($acc['Image_URL']) ?>">
                                    <span class="iem-brand badge bg-primary position-absolute top-0 start-0 m-2"><?= htmlspecialchars($acc['Brand']) ?></span>
                                    <img src="<?= htmlspecialchars($acc['Image_URL']) ?>" alt="<?= htmlspecialchars($acc['ProductName']) ?>" class="iem-img card-img-top">
                                    <div class="iem-card-body p-3">
                                        <h5 class="iem-name mb-1"><?= htmlspecialchars($acc['ProductName']) ?></h5>
                                        <div class="iem-price mb-2">₱<?= number_format($acc['Price'], 0) ?></div>
                                        <a href="#" class="btn btn-outline-primary w-100 add-to-cart-btn"
                                            data-id="<?= $acc['Product_ID'] ?>"
                                            data-name="<?= htmlspecialchars($acc['ProductName']) ?>"
                                            data-price="<?= $acc['Price'] ?>"
                                            data-image="/System/SoundStage/src/assets/accessories/<?= htmlspecialchars($acc['Image_URL']) ?>">
                                            <i class="bi bi-cart-plus"></i> Add to Cart
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include '../banner/banner.php'; ?>
    <?php include '../header/footer.php'; ?>

</body>
</html>