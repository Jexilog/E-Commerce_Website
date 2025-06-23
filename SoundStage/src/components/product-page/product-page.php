<?php
session_start();
require_once __DIR__ . '../../../db.php'; // Uses PDO

$categoryMap = [
    1 => 'In-Ear Monitor',
    2 => 'Accessories',
    3 => 'Headphones',
    4 => 'True-Wireless Stereo',
    5 => 'Digital Audio Player',
    6 => 'Speaker'
];

// --- PRODUCT FETCH ---
$id = $_GET['id'] ?? null;
if (!$id) {
    http_response_code(404);
    echo "<h2 style='color:#ff6b81;text-align:center;margin-top:5rem;'>Product not found.</h2>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM product_tbl WHERE Product_ID = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    http_response_code(404);
    echo "<h2 style='color:#ff6b81;text-align:center;margin-top:5rem;'>Product not found.</h2>";
    exit;
}

$imageFolder = match((int)$product['Category_ID']) {
    1 => 'iems', 2 => 'accessories', 3 => 'headphones',
    4 => 'earbuds', 5 => 'dap', 6 => 'speaker',
    default => 'iems',
};
$imageFullPath = "/System/SoundStage/src/assets/{$imageFolder}/" . ltrim($product['Image_URL'], '/');

// --- RECOMMENDATION ---
$alsoLikeStmt = $pdo->prepare("SELECT * FROM product_tbl WHERE Category_ID = ? AND Product_ID != ? LIMIT 4");
$alsoLikeStmt->execute([$product['Category_ID'], $id]);
$alsoLike = $alsoLikeStmt->fetchAll(PDO::FETCH_ASSOC);

// --- HELPER: Update total ---
function updateCartTotal($pdo, $cartId) {
    $stmt = $pdo->prepare("SELECT SUM(Qty * Unit_price) AS total FROM cart_items_tbl WHERE Cart_ID = ?");
    $stmt->execute([$cartId]);
    $total = $stmt->fetchColumn();
    
    $stmt = $pdo->prepare("UPDATE cart_tbl SET Total_price = ? WHERE Cart_ID = ?");
    $stmt->execute([$total, $cartId]);
}

// --- ADD OR UPDATE CART FUNCTION ---
function addOrUpdateCart($pdo, $userId, $productId, $quantity, $price) {
    // Find existing cart
    $stmt = $pdo->prepare("SELECT Cart_ID FROM cart_tbl WHERE User_ID = ? ORDER BY Cart_ID DESC LIMIT 1");
    $stmt->execute([$userId]);
    $cartId = $stmt->fetchColumn();

    // If no cart, create one
    if (!$cartId) {
        $stmt = $pdo->prepare("INSERT INTO cart_tbl (User_ID, Total_price, Added_At) VALUES (?, 0, NOW())");
        $stmt->execute([$userId]);
        $cartId = $pdo->lastInsertId();
    }

    // Check if item already exists
    $stmt = $pdo->prepare("SELECT Qty FROM cart_items_tbl WHERE Cart_ID = ? AND Product_ID = ?");
    $stmt->execute([$cartId, $productId]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        // Update quantity
        $newQty = $existing['Qty'] + $quantity;
        $stmt = $pdo->prepare("UPDATE cart_items_tbl SET Qty = ? WHERE Cart_ID = ? AND Product_ID = ?");
        $stmt->execute([$newQty, $cartId, $productId]);
    } else {
        // Insert new item
        $stmt = $pdo->prepare("INSERT INTO cart_items_tbl (Cart_ID, Product_ID, Qty, Unit_price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$cartId, $productId, $quantity, $price]);
    }

    // Update cart total
    updateCartTotal($pdo, $cartId);
    return true;
}

// --- HANDLE POST SUBMISSION ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = isset($_POST['quantity']) && is_numeric($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;

    if (!isset($_SESSION['user_id'])) {
        header("Location: /System/SoundStage/src/pages/auth/login.php");
        exit;
    }

    $userId = $_SESSION['user_id'];
    $productId = $product['Product_ID'];
    $price = $product['Price'];

    if (isset($_POST['add'])) {
        if (addOrUpdateCart($pdo, $userId, $productId, $quantity, $price)) {
            echo "<script>alert('Item has been added to your cart!')</script>";
            header("Location: product-page.php?id=$productId&success=1");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Failed to add to cart.</div>";
        }
    }

    if (isset($_POST['buy_now'])) {
        if (addOrUpdateCart($pdo, $userId, $productId, $quantity, $price)) {
            header("Location: /System/SoundStage/src/pages/cart/checkout.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Failed to process order.</div>";
        }
    }

    if (isset($_POST['wishlist'])) {
        echo "<div class='alert alert-info'>Feature coming soon.</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['ProductName']) ?> | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="System/SoundStage/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            color: #000000;
            font-family: 'Segoe UI', sans-serif;
        }
        .product-hero {
            background: #003366;
            border-radius: 2rem;
            box-shadow: 0 8px 40px 0 rgba(126,203,255,0.18);
            padding: 2.5rem 2rem 2rem 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 2rem;
        }
        .product-img {
            max-width: 400px;
            width: 100%;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px 0 rgba(126,203,255,0.18);
            background: #232b3e;
        }
        .product-info {
            flex: 1 1 350px;
        }
        .product-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #181c24;
            letter-spacing: 1px;
        }
        .product-brand {
            font-size: 1.1rem;
            color: #7ecbff;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .product-price {
            font-size: 2rem;
            color: #ff6b81;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .product-desc {
            color: #ffffff;
            font-size: 1.15rem;
            margin-bottom: 1.5rem;
        }
        .add-cart-btn {
            background: linear-gradient(90deg, #7ecbff 0%, #ff6b81 100%);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 1rem;
            padding: 0.8rem 2.5rem;
            font-size: 1.2rem;
            box-shadow: 0 2px 12px 0 rgba(126,203,255,0.18);
            transition: background 0.2s, color 0.2s;
        }
        .add-cart-btn:hover {
            background: linear-gradient(90deg, #ff6b81 0%, #7ecbff 100%);
            color: #181c24;
        }
        .section-title {
            color: #003366;
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 2.5rem;
            margin-bottom: 1.2rem;
            letter-spacing: 0.5px;
            border-left: 5px solid #003366;
            padding-left: 0.7rem;
        }
        .review-card {
            background: #232b3e;
            border-radius: 1rem;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            color: #eaf6ff;
            box-shadow: 0 2px 12px 0 rgba(126,203,255,0.08);
        }
        .review-author {
            font-weight: 600;
            color: #7ecbff;
        }
        .review-rating {
            color: #ffdf6b;
        }
        .also-like-card {
            background: #003366;
            border-radius: 1.3rem;
            border: 1px solid #2e3a4d;
            overflow: hidden;
            transition: 
                transform 0.18s cubic-bezier(.4,2,.6,1), 
                box-shadow 0.18s, 
                border-color 0.18s;
            box-shadow: 0 4px 24px 0 rgba(126,203,255,0.08);
            min-height: 250px;
            min-width: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }
        .also-like-card:hover, .iem-card:focus-within {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 12px 48px 0 rgba(126,203,255,0.22);
            border-color: #7ecbff;
            outline: none;
        }
        .also-like-img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-bottom: 1px solid #2e3a4d;
        }
        .also-like-title {
            color: #eaf6ff;
            font-weight: 600;
            font-size: 1rem;
            margin: 0.5rem 0;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            opacity: 1 !important;
            pointer-events: all !important;
        }
        input[type="number"] {
            -moz-appearance: textfield;
            appearance: textfield;
        }
        @media (max-width: 900px) {
            .product-hero { flex-direction: column; align-items: flex-start; }
            .product-img { max-width: 100%; }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="container">
    <div class="product-hero">
        <img src="<?= htmlspecialchars($imageFullPath) ?>" alt="<?= htmlspecialchars($product['ProductName']) ?>" class="product-img">
        <div class="product-info">
            <div class="product-brand"><?= htmlspecialchars($product['Brand']) ?></div>
            <div class="product-title"><?= htmlspecialchars($product['ProductName']) ?></div>
            <div class="product-price">₱<?= number_format($product['Price'], 2) ?></div>
            
            <!-- Stock badge -->
            <div class="mb-2">
                <span class="badge bg-success" style="font-size:1rem;">In Stock</span>
            </div>

            <!-- Quantity selector and Add to Cart -->
            <form method="POST" id="addToCartForm" class="d-flex align-items-center mb-3" style="gap:1rem;">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['Product_ID']) ?>">
                <label for="quantity" class="form-label mb-0" style="color:#eaf6ff;">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control" style="width:80px;">
                <button type="submit" class="add-cart-btn" name="add">
                    <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
            </form>


            <!-- Buy Now and Wishlist -->
            <div class="d-flex align-items-center mb-3" style="gap:1rem;">
                <a href="/System/SoundStage/src/pages/checkout.php?buy_now_id=<?= urlencode($product['Product_ID']) ?>" class="btn btn-warning" style="font-weight:600;">
                    <i class="bi bi-bag-check"></i> Buy Now
                </a>
                <button type="button" class="btn btn-outline-danger wishlist-btn" title="Add to Wishlist" style="font-weight:600;" data-product="<?= htmlspecialchars($id) ?>">
                    <i class="bi bi-heart"></i>
                </button>
            </div>

            <!-- Share Buttons -->
            <div class="d-flex align-items-center gap-2 mb-3">
                <span style="color:#eaf6ff;">Share:</span>
                <a href="#" class="text-primary"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-info"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-danger"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-light"><i class="bi bi-link-45deg"></i></a>
            </div>

            <div class="product-desc"><?= htmlspecialchars($product['Description']) ?></div>
        </div>
    </div>

    <!-- Description Section -->
    <div class="section-title text-center" style="border:none;color:#003366;"><i class="bi bi-info-circle"></i> Product Description</div>
    <div class="row mb-4">
        <div class="col-lg-10 mx-auto">
            <p class="lead text-center" style="color:#000000;">
                <?= htmlspecialchars($product['Description']) ?>
            </p>
        </div>
    </div>

    <!-- Product Info Section -->
    <div class="section-title text-center" style="border:none;color:#003366;"><i class="bi bi-list-ul"></i> Product Information</div>
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm border-0" style="background:#003366;">
                <div class="card-body">
                    <ul class="list-unstyled mb-0" style="color:#eaf6ff;">
                        <li><strong>Brand:</strong> <?= htmlspecialchars($product['Brand']) ?></li>
                        <li><strong>Price:</strong> ₱<?= number_format($product['Price'], 2) ?></li>
                        <li><strong>Stock:</strong> <?= htmlspecialchars($product['Stock_QTY']) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- You May Also Like -->
    <div class="section-title"><i class="bi bi-heart-fill"></i> You May Also Like</div>
    <div class="row g-4 mb-5">
        <?php if ($alsoLike): ?>
            <?php foreach ($alsoLike as $like): ?>
                <?php
                $altImagePath = "/System/SoundStage/src/assets/{$categoryMap[$like['Category_ID']]}/" . ltrim($like['Image_URL'], '/');
                ?>
                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                    <a href="/System/SoundStage/src/components/product-page.php?id=<?= urlencode($like['Product_ID']) ?>" class="iem-card-link" style="text-decoration:none; color:inherit;">
                        <div class="also-like-card shadow-sm position-relative">
                            <?php if (!empty($like['Brand'])): ?>
                                <span class="iem-brand badge bg-primary position-absolute top-0 start-0 m-2"><?= htmlspecialchars($like['Brand']) ?></span>
                            <?php endif; ?>
                            <img src="<?= $altImagePath ?>" alt="<?= htmlspecialchars($like['ProductName']) ?>" class="iem-img card-img-top">
                            <div class="iem-card-body p-3">
                                <h5 class="iem-name mb-1 text-light"><?= htmlspecialchars($like['ProductName']) ?></h5>
                                <div class="iem-price mb-2 text-light">₱<?= number_format($like['Price'], 2) ?></div>
                                <a href="product-page.php?id=<?= urlencode($like['Product_ID']) ?>" class="btn btn-outline-primary w-100"><i class="bi bi-cart-plus"></i> View Product</a>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-muted">No similar products to recommend.</div>
        <?php endif; ?>
    </div>
</div>
    
    <?php 
    include '../nav-links/review-section.php';
    include '../header/footer.php'; ?>

    <script>
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-product');
                fetch('/System/SoundStage/src/components/wishlist-toggle.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: 'product_id=' + productId
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'added') {
                        this.querySelector('i').className = 'bi bi-heart-fill text-danger';
                    } else if (data.status === 'removed') {
                        this.querySelector('i').className = 'bi bi-heart';
                    } else {
                        alert('Please login to use wishlist.');
                    }
                });
            });
        });
        function addToCart(event) {
                event.preventDefault();
                const form = event.target;
                const formData = new FormData(form);

                fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(err => {
                    console.error(err);
                    alert("Something went wrong.");
                });
            }


    </script>
</body>
</html>