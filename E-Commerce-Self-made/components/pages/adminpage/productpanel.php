<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product | Admin Panel</title>
</head>
<body style="padding:10px;">
    <?php include "../adminpage/sidebar/sidebar.php"?>
     <header>
            <div class="d-flex justify-content-between align-items-center px-4 py-2" style="background: #ffffff; border-bottom: 1px solid #e5e5e5;">
                <a class="navbar-brand fw-300" href="#" style="font-size: 20px;">CyberHack</a>
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
            <ul class="nav nav-tabs category-tabs px-4 pt-2 gap-2" id="categoryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'pc_components' ? 'active' : '' ?>" href="?tab=pc_components&page=1">PC Components</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'peripherals' ? 'active' : '' ?>" href="?tab=peripherals&page=1">PC Peripherals</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'gaming' ? 'active' : '' ?>" href="?tab=gaming&page=1">Gaming Devices</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'desktop' ? 'active' : '' ?>" href="?tab=desktop&page=1">Desktop PCs</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'laptop' ? 'active' : '' ?>" href="?tab=laptop&page=1">Laptop</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'smartphones' ? 'active' : '' ?>" href="?tab=smartphones&page=1">Smartphone</a>
                </li>
            </ul>
    </header>

    <section class="px-4 pt-3">
            <form class="row g-2 align-items-center mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search products..." value="">
                </div>
                <div class="col-md-2">
                    <select class="form-select">
                        <option value="all" selected>All Categories</option>
                        <option value="pc_components">PC Components</option>
                        <option value="peripherals">PC Peripherals and Accessories</option>
                        <option value="gaming">Gaming Devices and Accessories</option>
                        <option value="desktop">Desktop PCs</option>
                        <option value="laptops">Laptops</option>
                        <option value="smartphones">Smartphones</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select">
                        <option value="all">All Stock Status</option>
                        <option value="in">In Stock</option>
                        <option value="out">Out of Stock</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select">
                        <option value="name">Sort by Name</option>
                        <option value="price_asc">Price: Low to High</option>
                        <option value="price_desc">Price: High to Low</option>
                        <option value="stock">Sort by Stock</option>
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

         <main class="p-4 pt-0">
            <div class="tab-content" id="categoryTabsContent">
                <div class="tab-pane fade show active" role="tabpanel" id="pc_components">
                    <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th><input type="checkbox" id="selectAllCheckbox"></th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Added</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" class="product-checkbox"></td>
                                    <td>1</td>
                                    <td>Example Product</td>
                                    <td>This is a sample product description.</td>
                                    <td>PC Components</td>
                                    <td>Brand Name</td>
                                    <td>$99.99</td>
                                    <td>In Stock</td>
                                    <td><img src="https://via.placeholder.com/50" alt="Product Image"></td>
                                    <td>2023-10-01</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical fs-5"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item edit-btn" href="#" data-id="1">
                                                <i class="bi bi-pencil me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-btn text-danger" href="#" data-id="1">
                                                <i class="bi bi-trash me-2"></i>Delete
                                                </a>
                                            </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                </div>
            </div>
           <div class="d-flex justify-content-end mt-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item">
                            <a class="page-link" href="?tab=<?= $tab ?>&page=<?= $page-1 ?>">Previous</a>
                        </li>
                            <li class="page-item">
                                <a class="page-link" href="">1</a>
                            </li>
                        <li class="page-item">
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
                        <li class="list-group-item">
                            <button class="btn btn-link btn-sm text-danger float-end delete-activity" data-id="<?= $act['id'] ?>"><i class="bi bi-x"></i></button>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6>Product Analytics</h6>
                    <div class="bg-white p-3 rounded shadow-sm">
                        <p class="mb-1">Total Products: <strong>12</strong></p>
                        <p class="mb-1">Low Stock: <strong>2</strong></p>
                        <p class="mb-1">Out of Stock: <strong>0</strong></p>
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

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    
</body>
</html>