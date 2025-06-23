<?php
session_start();
require_once '../../db.php'; // Adjust as needed
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

header('Content-Type: application/json');

// Log incoming POST
error_log("RAW POST: " . json_encode($_POST));

// Check login
if (!isset($_SESSION['User_ID'])) {
    echo json_encode(['success' => false, 'message' => 'Please log in first.']);
    exit;
}

$userId = $_SESSION['User_ID'];
$productId = $_POST['product_id'] ?? null;
$quantity = $_POST['quantity'] ?? 1;

error_log("Product ID: $productId");
error_log("Quantity: $quantity");

// Validate inputs
if (!$productId || !is_numeric($quantity) || $quantity < 1) {
    echo json_encode(['success' => false, 'message' => 'Invalid product or quantity']);
    exit;
}

// Fetch product info
$stmt = $pdo->prepare("SELECT Price FROM product_tbl WHERE Product_ID = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo json_encode(['success' => false, 'message' => 'Product not found']);
    exit;
}

$unitPrice = (float)$product['Price'];

// ✅ FUNCTION TO UPDATE CART TOTAL
function updateCartTotal($pdo, $cartId) {
    $stmt = $pdo->prepare("SELECT SUM(Qty * Unit_Price) AS total FROM cart_items_tbl WHERE Cart_ID = ?");
    $stmt->execute([$cartId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total = $result['total'] ?? 0;

    $stmt = $pdo->prepare("UPDATE cart_tbl SET Total_price = ? WHERE Cart_ID = ?");
    $stmt->execute([$total, $cartId]);

    error_log("🔁 Cart $cartId total updated to $total");
}

// ✅ GET OR CREATE CART
if (isset($_SESSION['Cart_ID'])) {
    $cartId = $_SESSION['Cart_ID'];

    // Verify cart still exists (in case of manual DB change)
    $stmt = $pdo->prepare("SELECT * FROM cart_tbl WHERE Cart_ID = ? AND User_ID = ?");
    $stmt->execute([$cartId, $userId]);
    $existingCart = $stmt->fetch();

    if (!$existingCart) {
        unset($_SESSION['Cart_ID']); // Reset if not found
        $cartId = null;
    }
}

if (empty($cartId)) {
    // Check if user already has a cart
    $stmt = $pdo->prepare("SELECT Cart_ID FROM cart_tbl WHERE User_ID = ? ORDER BY Cart_ID DESC LIMIT 1");
    $stmt->execute([$userId]);
    $cart = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cart) {
        $cartId = $cart['Cart_ID'];
    } else {
        // Create new cart
        $stmt = $pdo->prepare("INSERT INTO cart_tbl (User_ID, Total_price, Added_At) VALUES (?, ?, NOW())");
        $stmt->execute([$userId, 0]); // Initial total is 0
        $cartId = $pdo->lastInsertId();
    }

    $_SESSION['Cart_ID'] = $cartId;
}

error_log("🛒 Using Cart_ID: $cartId");

// ✅ INSERT OR UPDATE ITEM
$stmt = $pdo->prepare("SELECT * FROM cart_items_tbl WHERE Cart_ID = ? AND Product_ID = ?");
$stmt->execute([$cartId, $productId]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if ($item) {
    // Update quantity
    $stmt = $pdo->prepare("UPDATE cart_items_tbl SET Qty = Qty + ? WHERE Cart_ID = ? AND Product_ID = ?");
    $stmt->execute([$quantity, $cartId, $productId]);
} else {
    // Insert new item
    $stmt = $pdo->prepare("INSERT INTO cart_items_tbl (Cart_ID, Product_ID, Qty, Unit_Price) VALUES (?, ?, ?, ?)");
    $stmt->execute([$cartId, $productId, $quantity, $unitPrice]);
}

// ✅ UPDATE TOTAL PRICE
updateCartTotal($pdo, $cartId);

echo json_encode(['success' => true, 'message' => 'Item added to cart']);
