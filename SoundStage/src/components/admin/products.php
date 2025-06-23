<?php
session_start();
// DB connection
$conn = new mysqli("localhost", "root", "", "db_system");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Category mapping
$category_map = [
    'iem' => 1,
    'headphones' => 3,
    'earbuds' => 4,
    'accessories' => 2,
    'dap' => 5,
    'speaker' => 6
];

// Get active tab and page
$tab = isset($_GET['tab']) && isset($category_map[$_GET['tab']]) ? $_GET['tab'] : 'iem';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$category_id = $category_map[$tab];

// Pagination setup
$maxRows = 5;
$countRes = $conn->query("SELECT COUNT(*) as total FROM product_tbl WHERE Category_ID = $category_id");
$totalRows = $countRes->fetch_assoc()['total'];
$totalPages = max(1, ceil($totalRows / $maxRows));
$offset = ($page - 1) * $maxRows;

// Fetch paginated products for the active category
$sql = "SELECT p.*, c.CategoryName FROM product_tbl p
        LEFT JOIN category_tbl c ON p.Category_ID = c.Category_ID
        WHERE p.Category_ID = $category_id
        LIMIT $maxRows OFFSET $offset";
$result = $conn->query($sql);

// For tab UI
$tab_active = [
    'iem' => '',
    'headphones' => '',
    'earbuds' => '',
    'accessories' => '',
    'dap' => '',
    'speaker' => ''
];
$tab_active[$tab] = 'active show';

// Fetch recent activity (add this before your HTML)
$activityResult = $conn->query("SELECT * FROM recent_activity ORDER BY activity_time DESC LIMIT 10");

// Product analytics
$totalProducts = $conn->query("SELECT COUNT(*) as cnt FROM product_tbl")->fetch_assoc()['cnt'];
$lowStock = $conn->query("SELECT COUNT(*) as cnt FROM product_tbl WHERE Stock_QTY <= 5")->fetch_assoc()['cnt'];
$outOfStock = $conn->query("SELECT COUNT(*) as cnt FROM product_tbl WHERE Stock_QTY = 0")->fetch_assoc()['cnt'];

// Handle search, stock status, and sorting
$search_term = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$stock_status = isset($_GET['stock']) ? $_GET['stock'] : 'all';
$sort_by = isset($_GET['sort']) ? $_GET['sort'] : 'name';
// Build the WHERE clause based on search and stock status
$where_clause = "WHERE p.Category_ID = $category_id";

if (!empty($search_term)) {
    $where_clause .= " AND (p.ProductName LIKE '%$search_term%' OR p.Description LIKE '%$search_term%')";
}
if ($stock_status === 'in') {
    $where_clause .= " AND p.Stock_QTY > 0";
} elseif ($stock_status === 'out') {
    $where_clause .= " AND p.Stock_QTY = 0";
}

$order_by_clause = "ORDER BY p.ProductName ASC"; // Default sorting

if ($sort_by === 'price_asc') {
    $order_by_clause = "ORDER BY p.Price ASC";
} elseif ($sort_by === 'price_desc') {
    $order_by_clause = "ORDER BY p.Price DESC";
} elseif ($sort_by === 'stock') {
    $order_by_clause = "ORDER BY p.Stock_QTY DESC";
}

// Fetch products with the updated WHERE and ORDER BY clauses
$sql = "SELECT p.*, c.CategoryName FROM product_tbl p
        LEFT JOIN category_tbl c ON p.Category_ID = c.Category_ID
        $where_clause
        $order_by_clause
        LIMIT $maxRows OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | SoundStage</title>
    <link rel="icon" href="../../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/styles/products.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>

    <?php include '../../components/admin/sidebar/sidebar.php'; ?>

    <div class="main-content flex-grow-1" style="margin-left:250px; min-height:100vh; background:#fafbfc;">
        <!-- Header -->
        <header>
            <div class="d-flex justify-content-between align-items-center px-4 py-2" style="background: #ffffff; border-bottom: 1px solid #e5e5e5;">
                <span class="brand-title">SoundStage</span>
                <div>
                    <button class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="bi bi-upload"></i> Import
                    </button>
                    <button class="btn btn-outline-secondary me-2" id="exportBtn" data-bs-toggle="modal" data-bs-target="#exportModal">
                        <i class="bi bi-download"></i> Export
                    </button>
                    <a href="add_product.php" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Add Product
                    </a>
                </div>
            </div>
            <!-- Category Tabs -->
            <ul class="nav nav-tabs category-tabs px-4 pt-2 gap-2" id="categoryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'iem' ? 'active' : '' ?>" href="?tab=iem&page=1">In-Ear Monitor</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'headphones' ? 'active' : '' ?>" href="?tab=headphones&page=1">Headphones</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'earbuds' ? 'active' : '' ?>" href="?tab=earbuds&page=1">True-Wireless Stereo</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'accessories' ? 'active' : '' ?>" href="?tab=accessories&page=1">Accessories</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'dap' ? 'active' : '' ?>" href="?tab=dap&page=1">Digital Audio Player</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'speaker' ? 'active' : '' ?>" href="?tab=speaker&page=1">Speaker</a>
                </li>
            </ul>
        </header>

        <!-- Search, Filter, and Bulk Actions -->
        <section class="px-4 pt-3">
            <form class="row g-2 align-items-center mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search products..." value="<?php echo htmlspecialchars($search_term); ?>">
                </div>
                <div class="col-md-2">
                    <select class="form-select">
                        <option selected>All Categories</option>
                        <option>In-Ear Monitor</option>
                        <option>Headphones</option>
                        <option>True-Wireless Stereo</option>
                        <option>Accessories</option>
                        <option>Digital Audio Player</option>
                        <option>Speaker</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select">
                        <option value="all" <?php echo $stock_status === 'all' ? 'selected' : ''; ?>>All Stock Status</option>
                        <option value="in" <?php echo $stock_status === 'in' ? 'selected' : ''; ?>>In Stock</option>
                        <option value="out" <?php echo $stock_status === 'out' ? 'selected' : ''; ?>>Out of Stock</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select">
                        <option value="name" <?php echo $sort_by === 'name' ? 'selected' : ''; ?>>Sort by Name</option>
                        <option value="price_asc" <?php echo $sort_by === 'price_asc' ? 'selected' : ''; ?>>Price: Low to High</option>
                        <option value="price_desc" <?php echo $sort_by === 'price_desc' ? 'selected' : ''; ?>>Price: High to Low</option>
                        <option value="stock" <?php echo $sort_by === 'stock' ? 'selected' : ''; ?>>Sort by Stock</option>
                    </select>
                </div>
                <div class="col-md-2 text-end">
                    <button type="submit" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </form>
            <div class="mb-2">
                <button class="btn btn-danger btn-sm" id="bulkDeleteBtn" disabled>
                    <i class="bi bi-trash"></i> Delete Selected
                </button> 
                <button class="btn btn-secondary btn-sm" id="bulkEditBtn" disabled>
                    <i class="bi bi-pencil"></i> Edit Selected
                </button>
            </div>
            <!-- Columns Dropdown (New Feature) -->
            <div class="dropdown mb-2">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Columns
                </button>
                <ul class="dropdown-menu" id="columnToggleMenu">
                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 column-toggle" data-col="Product_ID" checked>ID</label></li>
                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 column-toggle" data-col="ProductName" checked>Name</label></li>
                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 column-toggle" data-col="Description" checked>Description</label></li>
                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 column-toggle" data-col="Category_ID" checked>Category</label></li>
                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 column-toggle" data-col="Brand" checked>Brand</label></li>
                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 column-toggle" data-col="Price" checked>Price</label></li>
                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 column-toggle" data-col="Stock_QTY" checked>Stock</label></li>
                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 column-toggle" data-col="Image_URL" checked>Image</label></li>
                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 column-toggle" data-col="Added_AT" checked>Added</label></li>
                </ul>
            </div>
        </section>

        <!-- Main Content: Only show the active tab's table -->
        <main class="p-4 pt-0">
            <div class="tab-content" id="categoryTabsContent">
                <?php
                $tab_labels = [
                    'iem' => 'In-Ear Monitor',
                    'headphones' => 'Headphones',
                    'earbuds' => 'True-Wireless Stereo',
                    'accessories' => 'Accessories',
                    'dap' => 'Digital Audio Player',
                    'speaker' => 'Speaker'
                ];
                foreach ($tab_labels as $key => $label):
                ?>
                <div class="tab-pane fade <?= $tab_active[$key] ?>" id="<?= $key ?>" role="tabpanel">
                    <?php if ($tab === $key): ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th><input type="checkbox" id="selectAll<?= strtoupper($key) ?>"></th>
                                    <th class="col-Product_ID">ID</th>
                                    <th class="col-ProductName">Name</th>
                                    <th class="col-Description">Description</th>
                                    <th class="col-Category_ID">Category</th>
                                    <th class="col-Brand">Brand</th>
                                    <th class="col-Price">Price</th>
                                    <th class="col-Stock_QTY">Stock</th>
                                    <th class="col-Image_URL">Image</th>
                                    <th class="col-Added_AT">Added</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result->data_seek(0);
                                while($row = $result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="row-checkbox" value="<?= $row['Product_ID'] ?>"></td>
                                    <td class="col-Product_ID"><?= $row['Product_ID'] ?></td>
                                    <td class="col-ProductName"><?= htmlspecialchars($row['ProductName']) ?></td>
                                    <td class="col-Description"><?= htmlspecialchars($row['Description']) ?></td>
                                    <td class="col-Category_ID"><?= htmlspecialchars($row['CategoryName']) ?></td>
                                    <td class="col-Brand"><?= htmlspecialchars($row['Brand']) ?></td>
                                    <td class="col-Price">₱<?= number_format($row['Price'], 2) ?></td>
                                    <td class="col-Stock_QTY"><?= $row['Stock_QTY'] ?></td>
                                    <td class="col-Image_URL">
                                        <?php if($row['Image_URL']): ?>
                                            <img src="<?= htmlspecialchars($row['Image_URL']) ?>"
                                                 alt="Product"
                                                 class="img-thumbnail product-img"
                                                 style="width:40px;height:40px;object-fit:cover;cursor:pointer;"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#imgModal"
                                                 data-img="<?= htmlspecialchars($row['Image_URL']) ?>">
                                        <?php endif; ?>
                                    </td>
                                    <td class="col-Added_AT"><?= $row['Added_AT'] ?></td>
                                    <td>
                                      <div class="dropdown">
                                        <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                          <i class="bi bi-three-dots-vertical fs-5"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li>
                                            <a class="dropdown-item edit-btn" href="#" data-id="<?= $row['Product_ID'] ?>">
                                              <i class="bi bi-pencil me-2"></i>Edit
                                            </a>
                                          </li>
                                          <li>
                                            <a class="dropdown-item delete-btn text-danger" href="#" data-id="<?= $row['Product_ID'] ?>">
                                              <i class="bi bi-trash me-2"></i>Delete
                                            </a>
                                          </li>
                                        </ul>
                                      </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?tab=<?= $tab ?>&page=<?= $page-1 ?>">Previous</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?tab=<?= $tab ?>&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?tab=<?= $tab ?>&page=<?= $page+1 ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </main>

        <!-- Quick Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form id="editProductForm" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="Product_ID" id="editProductID">
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="ProductName" id="editProductName" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" name="Description" id="editDescription">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" class="form-control" name="Brand" id="editBrand">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="Price" id="editPrice" step="0.01">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <div>
                                    <img id="editImgPreview" src="" alt="Product Image" style="width:80px;height:80px;object-fit:cover;border:1px solid #ddd;margin-bottom:8px;">
                                </div>
                                <input type="file" class="form-control" name="Image_URL" id="editImageInput" accept="image/*">
                                <input type="hidden" name="Current_Image_URL" id="editCurrentImg">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

         <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this product?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger"  id="confirmDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Import Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">Import Products</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="file" class="form-control" accept=".csv, .xlsx">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Export Modal -->
        <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <form id="exportForm" method="POST" action="export_products.php" target="_blank">
                <div class="modal-header">
                  <h5 class="modal-title" id="exportModalLabel">
                    <i class="bi bi-download me-2"></i>Export Products
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Export Format</label>
                    <div class="d-flex gap-3">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="format" id="exportCSV" value="csv" checked>
                        <label class="form-check-label" for="exportCSV">CSV</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="format" id="exportExcel" value="excel">
                        <label class="form-check-label" for="exportExcel">Excel (.xlsx)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="format" id="exportPDF" value="pdf">
                        <label class="form-check-label" for="exportPDF">PDF</label>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Columns to Export</label>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="columns[]" value="Product_ID" id="colID" checked><label class="form-check-label" for="colID">ID</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="columns[]" value="ProductName" id="colName" checked><label class="form-check-label" for="colName">Name</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="columns[]" value="Description" id="colDesc" checked><label class="form-check-label" for="colDesc">Description</label></div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="columns[]" value="CategoryName" id="colCat" checked><label class="form-check-label" for="colCat">Category</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="columns[]" value="Brand" id="colBrand" checked><label class="form-check-label" for="colBrand">Brand</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="columns[]" value="Price" id="colPrice" checked><label class="form-check-label" for="colPrice">Price</label></div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="columns[]" value="Stock_QTY" id="colStock" checked><label class="form-check-label" for="colStock">Stock</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="columns[]" value="Added_AT" id="colAdded" checked><label class="form-check-label" for="colAdded">Added</label></div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Export Scope</label>
                    <div class="d-flex gap-3">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="scope" id="exportAll" value="all" checked>
                        <label class="form-check-label" for="exportAll">All Products</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="scope" id="exportCurrent" value="current">
                        <label class="form-check-label" for="exportCurrent">Current Page Only</label>
                      </div>
                    </div>
                  </div>
                  <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Choose your export options and click <strong>Export</strong> to download your file.
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-success"><i class="bi bi-download me-1"></i>Export</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Activity Log & Analytics (Bonus) -->
        <section class="px-4 pb-4">
            <div class="row">
                <div class="col-md-6">
                    <h6>Recent Activity</h6>
                    <ul class="list-group small">
                    <?php while($act = $activityResult->fetch_assoc()): ?>
                        <li class="list-group-item">
                            [<?= date('M d, H:i', strtotime($act['activity_time'])) ?>] 
                            <?= htmlspecialchars($act['activity_desc']) ?>
                            <button class="btn btn-link btn-sm text-danger float-end delete-activity" data-id="<?= $act['id'] ?>"><i class="bi bi-x"></i></button>
                        </li>
                    <?php endwhile; ?>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6>Product Analytics</h6>
                    <div class="bg-white p-3 rounded shadow-sm">
                        <p class="mb-1">Total Products: <strong><?= $totalProducts ?></strong></p>
                        <p class="mb-1">Low Stock: <strong><?= $lowStock ?></strong></p>
                        <p class="mb-1">Out of Stock: <strong><?= $outOfStock ?></strong></p>
                        <!-- You can add charts here using Chart.js or similar -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imgModal" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
          <div class="modal-body text-center p-0">
            <img id="modalImg" src="" class="img-fluid rounded" style="max-width:400px;max-height:400px;" alt="Product Image">
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Add your JS for sorting, filtering, pagination, bulk actions, etc. -->
     <script>
  document.addEventListener('DOMContentLoaded', function() {
            // Image click to view
            document.querySelectorAll('.product-img').forEach(function(img) {
                img.addEventListener('click', function() {
                    document.getElementById('modalImg').src = this.dataset.img;
                });
            });

            // Edit button logic (fetch product data)
            document.querySelectorAll('.edit-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productId = this.dataset.id;
                    fetch('get_product.php?id=' + productId)
                        .then(res => res.json())
                        .then(data => {
                            populateEditModal(data);
                        })
                         .catch(error => {
                            console.error('Error fetching product data:', error);
                            alert('Failed to fetch product data. Please check the console.');
                        });
                });
            });

            function populateEditModal(data) {
                document.getElementById('editProductID').value = data.Product_ID;
                document.getElementById('editProductName').value = data.ProductName;
                document.getElementById('editDescription').value = data.Description;
                document.getElementById('editBrand').value = data.Brand;
                document.getElementById('editPrice').value = data.Price;
                document.getElementById('editImgPreview').src = data.Image_URL || '';
                document.getElementById('editCurrentImg').value = data.Image_URL || '';
                var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                editModal.show();
            }

            // Preview image on file select
            document.getElementById('editImageInput').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    document.getElementById('editImgPreview').src = URL.createObjectURL(file);
                }
            });

            // Save changes via AJAX
            document.getElementById('editProductForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch('update_product.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(resp => {
                    if(resp.success) {
                        alert('Product updated!');
                        location.reload(); // Or update the row dynamically
                    } else {
                        alert('Update failed: ' + resp.error);
                    }
                });
            });

            // Delete button logic
            document.querySelectorAll('.delete-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    productIdToDelete = this.dataset.id;
                    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                    deleteModal.show();
                });
            });

             document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                if (productIdToDelete) {
                    fetch('delete_product.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'Product_ID=' + productIdToDelete
                    })
                    .then(res => res.json())
                    .then(resp => {
                        if(resp.success) {
                            alert('Product deleted!');
                            location.reload(); // Or update the row dynamically
                        } else {
                            alert('Delete failed: ' + resp.error);
                        }
                    });
                }
                var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
                deleteModal.hide();
            });

            // Select All Checkbox for IEM
            document.getElementById('selectAllIEM')?.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('#iem .row-checkbox');
                checkboxes.forEach(cb => cb.checked = this.checked);
                updateBulkButtons();
            });

            // Select All Checkbox for Accessories
            document.getElementById('selectAllACC')?.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('#accessories .row-checkbox');
                checkboxes.forEach(cb => cb.checked = this.checked);
                updateBulkButtons();
            });

            // Enable/disable bulk buttons
            document.querySelectorAll('.row-checkbox').forEach(function(cb) {
                cb.addEventListener('change', updateBulkButtons);
            });

            function updateBulkButtons() {
                const checked = document.querySelectorAll('.row-checkbox:checked').length;
                document.getElementById('bulkDeleteBtn').disabled = checked === 0;
            }

            // Column toggle logic
            document.querySelectorAll('.column-toggle').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const colClass = 'col-' + this.dataset.col;
                    document.querySelectorAll('.' + colClass).forEach(function(cell) {
                        cell.style.display = checkbox.checked ? '' : 'none';
                    });
                });
            });

            // Bulk Delete Selected
            document.getElementById('bulkDeleteBtn').addEventListener('click', function() {
                const selected = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);
                if(selected.length && confirm('Delete selected products?')) {
                    fetch('delete_product.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: selected.map(id => `product_id=${id}`).join('&') 
                    })
                    .then(res => res.json())
                    .then(resp => {
                        if(resp.success) {
                            alert('Selected products deleted!');
                            location.reload(); // Or update the row dynamically
                        } else {
                            alert('Delete failed: ' + resp.error);
                        }
                    })
                     .catch(error => {
                            console.error('Error deleting products:', error);
                            alert('Failed to delete products. Please check the console.');
                    });
                }
            });

            // Bulk Edit Selected (example)
            document.getElementById('bulkEditBtn').addEventListener('click', function() {
                const selected = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);
                if(selected.length) {
                    // TODO: Open bulk edit modal and load selected products
                    alert('Edit IDs: ' + selected.join(', '));
                }
            });

            // Delete activity
            document.querySelectorAll('.delete-activity').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    // TODO: AJAX call to delete activity
                    alert('Deleted activity ID: ' + id);
                });
            });
        }); 

        document.addEventListener('DOMContentLoaded', function () {
            const stockFilter = document.getElementById('stockFilter');
            const sortFilter = document.getElementById('sortFilter');
            const searchInput = document.getElementById('searchInput');
            const filterBtn = document.getElementById('filterBtn');
            const tab = 'iem'; // default or get from active tab

            function loadProducts(page = 1) {
                const stock = stockFilter.value;
                const sort = sortFilter.value;
                const search = searchInput.value;

                fetch('handler.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        action: 'fetch',
                        tab: tab,
                        page: page,
                        stock: stock,
                        sort: sort,
                        search: search
                    })
                })
                .then(res => res.json())
                .then(data => {
                    const tbody = document.querySelector(`#${tab} tbody`);
                    tbody.innerHTML = '';

                    if (data.data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="11" class="text-center">No products found.</td></tr>';
                        return;
                    }

                    data.data.forEach(row => {
                        tbody.innerHTML += `
                            <tr>
                                <td><input type="checkbox" class="row-checkbox" value="${row.Product_ID}"></td>
                                <td class="col-Product_ID">${row.Product_ID}</td>
                                <td class="col-ProductName">${row.ProductName}</td>
                                <td class="col-Description">${row.Description}</td>
                                <td class="col-Category_ID">${row.CategoryName}</td>
                                <td class="col-Brand">${row.Brand}</td>
                                <td class="col-Price">₱${parseFloat(row.Price).toFixed(2)}</td>
                                <td class="col-Stock_QTY">${row.Stock_QTY}</td>
                                <td class="col-Image_URL">
                                ${row.Image_URL ? `<img src="${row.Image_URL}" style="width:40px;height:40px;" class="img-thumbnail">` : ''}
                                </td>
                                <td class="col-Added_AT">${row.Added_AT}</td>
                                <td>
                                <div class="dropdown">
                                    <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item edit-btn" href="#" data-id="${row.Product_ID}">Edit</a></li>
                                    <li><a class="dropdown-item delete-btn text-danger" href="#" data-id="${row.Product_ID}">Delete</a></li>
                                    </ul>
                                </div>
                                </td>
                            </tr>
                        `;
                    });
                });
            }

            filterBtn.addEventListener('click', () => loadProducts());
        });

$(document).ready(function() {
    let currentTab = 'iem';
    let currentPage = 1;
    let currentSearch = '';
    let currentStock = 'all';
    let currentSort = 'name';

    // Load products
    function loadProducts() {
        $.post('ajax_handler.php', {
            action: 'fetch',
            tab: currentTab,
            page: currentPage,
            search: currentSearch,
            stock: currentStock,
            sort: currentSort
        }, function(res) {
            if (res.status === 'success') {
                renderTable(res.data);
                renderPagination(res.totalPages);
            }
        }, 'json');
    }

    // Render product table
    function renderTable(data) {
        let tbody = '';
        if (data.length === 0) {
            tbody = '<tr><td colspan="11">No products found.</td></tr>';
        } else {
            data.forEach(row => {
                tbody += `
                <tr data-id="${row.Product_ID}">
                    <td><input type="checkbox" class="row-checkbox" value="${row.Product_ID}"></td>
                    <td>${row.Product_ID}</td>
                    <td><input type="text" class="form-control form-control-sm edit-name" value="${row.ProductName}"></td>
                    <td><input type="text" class="form-control form-control-sm edit-desc" value="${row.Description}"></td>
                    <td>${row.CategoryName}</td>
                    <td><input type="text" class="form-control form-control-sm edit-brand" value="${row.Brand}"></td>
                    <td><input type="number" class="form-control form-control-sm edit-price" value="${row.Price}"></td>
                    <td><input type="number" class="form-control form-control-sm edit-stock" value="${row.Stock_QTY}"></td>
                    <td><img src="${row.Image_URL}" width="40" height="40" class="img-thumbnail"></td>
                    <td>${row.Added_AT}</td>
                    <td><button class="btn btn-sm btn-danger delete-single" data-id="${row.Product_ID}">Delete</button></td>
                </tr>`;
            });
        }
        $('#product-table tbody').html(tbody);
    }

    // Render pagination
    function renderPagination(totalPages) {
        let html = '';
        for (let i = 1; i <= totalPages; i++) {
            html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link page-btn" href="#">${i}</a>
                    </li>`;
        }
        $('#pagination').html(html);
    }

    // Events
    $('#tabSelect').on('change', function() {
        currentTab = $(this).val();
        currentPage = 1;
        loadProducts();
    });

    $('#searchInput').on('input', function() {
        currentSearch = $(this).val();
        currentPage = 1;
        loadProducts();
    });

    $('#stockFilter').on('change', function() {
        currentStock = $(this).val();
        currentPage = 1;
        loadProducts();
    });

    $('#sortSelect').on('change', function() {
        currentSort = $(this).val();
        currentPage = 1;
        loadProducts();
    });

    $('#pagination').on('click', '.page-btn', function(e) {
        e.preventDefault();
        currentPage = parseInt($(this).text());
        loadProducts();
    });

    // Bulk delete
    $('#bulkDeleteBtn').click(function() {
        const ids = $('.row-checkbox:checked').map(function() {
            return $(this).val();
        }).get();
        if (ids.length === 0) return alert('Select at least one product.');
        if (!confirm('Are you sure you want to delete selected products?')) return;
        $.post('ajax_handler.php', { action: 'delete', ids }, function(res) {
            alert(res.message);
            loadProducts();
        }, 'json');
    });

    // Bulk edit
    $('#bulkEditBtn').click(function() {
        const products = [];
        $('#product-table tbody tr').each(function() {
            if ($(this).find('.row-checkbox').is(':checked')) {
                products.push({
                    Product_ID: $(this).data('id'),
                    ProductName: $(this).find('.edit-name').val(),
                    Description: $(this).find('.edit-desc').val(),
                    Brand: $(this).find('.edit-brand').val(),
                    Price: $(this).find('.edit-price').val(),
                    Stock_QTY: $(this).find('.edit-stock').val()
                });
            }
        });
        if (products.length === 0) return alert('Select products to edit.');
        $.post('ajax_handler.php', { action: 'edit', products }, function(res) {
            alert(res.message);
            loadProducts();
        }, 'json');
    });

    // Load initially
    loadProducts();
});

    </script>

</body>
</html>