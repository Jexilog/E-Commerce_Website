<?php
$conn = new mysqli("localhost", "root", "", "db_system");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Map categories
$category_map = [
    'iem' => 1,
    'headphones' => 3,
    'earbuds' => 4,
    'accessories' => 2,
    'dap' => 5,
    'speaker' => 6
];

header('Content-Type: application/json');
$action = $_POST['action'] ?? 'fetch';

// Bulk Delete
if ($action === 'delete') {
    $ids = $_POST['ids'] ?? [];
    if (!empty($ids) && is_array($ids)) {
        $id_list = implode(',', array_map('intval', $ids));
        $conn->query("DELETE FROM product_tbl WHERE Product_ID IN ($id_list)");
        echo json_encode(['status' => 'success', 'message' => 'Products deleted.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No IDs provided.']);
    }
    exit;
}

// Bulk Edit
if ($action === 'edit') {
    $products = $_POST['products'] ?? [];
    foreach ($products as $p) {
        $id = (int)$p['Product_ID'];
        $name = $conn->real_escape_string($p['ProductName']);
        $desc = $conn->real_escape_string($p['Description']);
        $brand = $conn->real_escape_string($p['Brand']);
        $price = (float)$p['Price'];
        $stock = (int)$p['Stock_QTY'];
        $conn->query("UPDATE product_tbl SET ProductName='$name', Description='$desc', Brand='$brand', Price=$price, Stock_QTY=$stock WHERE Product_ID=$id");
    }
    echo json_encode(['status' => 'success', 'message' => 'Products updated.']);
    exit;
}

// Fetch with filters
$tab = $_POST['tab'] ?? 'iem';
$page = max(1, (int)($_POST['page'] ?? 1));
$search_term = $conn->real_escape_string($_POST['search'] ?? '');
$stock_status = $_POST['stock'] ?? 'all';
$sort_by = $_POST['sort'] ?? 'name';

$category_id = $category_map[$tab] ?? 1;
$offset = ($page - 1) * 5;
$limit = 5;

// WHERE conditions
$where = "WHERE p.Category_ID = $category_id";
if (!empty($search_term)) {
    $where .= " AND (p.ProductName LIKE '%$search_term%' OR p.Description LIKE '%$search_term%')";
}
if ($stock_status === 'in') {
    $where .= " AND p.Stock_QTY > 0";
} elseif ($stock_status === 'out') {
    $where .= " AND p.Stock_QTY = 0";
}

// Sorting
$order = match($sort_by) {
    'price_asc' => 'ORDER BY p.Price ASC',
    'price_desc' => 'ORDER BY p.Price DESC',
    'stock' => 'ORDER BY p.Stock_QTY DESC',
    default => 'ORDER BY p.ProductName ASC'
};

// Main query
$sql = "SELECT p.*, c.CategoryName FROM product_tbl p
        LEFT JOIN category_tbl c ON p.Category_ID = c.Category_ID
        $where $order LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Collect data
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Count for pagination
$countRes = $conn->query("SELECT COUNT(*) as total FROM product_tbl p $where");
$totalRows = $countRes->fetch_assoc()['total'];
$totalPages = max(1, ceil($totalRows / $limit));

// Return JSON
echo json_encode([
    'status' => 'success',
    'data' => $products,
    'totalPages' => $totalPages,
    'totalRows' => $totalRows,
    'currentPage' => $page
]);
