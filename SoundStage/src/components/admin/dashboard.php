<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SoundStage</title>
    <link rel="icon" href="../../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/styles/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>

    <?php include '../../components/admin/sidebar/sidebar.php'; ?>

    <div class="main-content">

        <header>
            <nav class="navbar navbar-expand-lg px-4 navbar-light bg-white shadow-sm border-bottom">
                <div class="container-fluid">
                    <a class="navbar-brand">SoundStage</a>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto">
                            <!-- Notifications Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-bell"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                                    &nbsp;Notification
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="notificationDropdown" style="min-width: 300px;">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle text-primary"></i> New user registered</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-in-down text-success"></i> New order received</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-exclamation-triangle text-warning"></i> Low stock alert</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-center" href="notifications.php">View all notifications</a></li>
                                </ul>
                            </li>
                            <!-- Email Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link position-relative" href="#" id="emailDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-envelope"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2</span>
                                    &nbsp;Email
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="emailDropdown" style="min-width: 320px;">
                                    <li>
                                        <a class="dropdown-item" href="email-view.php?id=123">
                                            <strong>Order Confirmation</strong><br>
                                            <small class="text-muted">From: sales@soundstage.com</small><br>
                                            <span class="text-secondary">Your order #1234 has been shipped.</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="email-view.php?id=12345">
                                            <strong>Support Ticket</strong><br>
                                            <small class="text-muted">From: support@soundstage.com</small><br>
                                            <span class="text-secondary">Your ticket has been updated.</span>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-center" href="email.php">View all emails</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Settings Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link position-relative" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-gear"></i>&nbsp;Settings
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                                    <li><a class="dropdown-item" href="profile-settings.php">Profile Settings</a></li>
                                    <li><a class="dropdown-item" href="products.php">Product Management Settings</a></li>
                                    <li><a class="dropdown-item" href="users.php">User Management Settings</a></li>
                                    <li><a class="dropdown-item" href="security-policy.php">Security & Policy</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger logout-btn" href="../../components/admin/logout/logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <h5 class="dashboard-title mt-3 mb-3">Overview</h5>

            <!-- Product Categories Table Section -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between px-3 py-2">
                    <span class="fw-bold"><i class="bi bi-box-seam me-2"></i>Product Categories Overview</span>
                    <form class="d-flex gap-2" id="product-filter-form">
                        <select class="form-select form-select-sm" id="categoryFilter">
                            <option value="all">All Categories</option>
                            <option value="In-Ear Monitor">IEM's</option>
                            <option value="Headphones">Headphone</option>
                            <option value="Earbuds (TWS)">Earbuds (TWS)</option>
                            <option value="Audio Accessories">Audio Accessories</option>
                            <option value="Digital Audio Player">Digital Audio Player</option>
                            <option value="Speaker">Speaker</option>
                        </select>
                        <select class="form-select form-select-sm" id="stockFilter">
                            <option value="">All Stock Levels</option>
                            <option value="low">Low Stock</option>
                            <option value="in">In Stock</option>
                            <option value="out">Out of Stock</option>
                        </select>
                    </form>
                </div>
                <div class="card-body px-4 py-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0" id="product-categories-table">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Products</th>
                                    <th scope="col">Stock Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="product-categories-tbody">
                                <!-- JS will render rows here -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Controls -->
                    <nav aria-label="Product pagination" class="mt-3">
                        <ul class="pagination pagination-sm justify-content-end mb-0" id="product-pagination">
                            <!-- JS will render pagination here -->
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Sales Overview & User Activity -->
            <div class="row g-4">
                <!-- Total Sales Overview -->
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white d-flex align-items-center justify-content-between px-3 py-2">
                            <span class="fw-bold"><i class="bi bi-bar-chart-line me-2"></i>Total Sales Overview</span>
                            <form class="d-flex gap-2 align-items-center" id="sales-date-filter">
                                <input type="date" class="form-control form-control-sm" id="salesStartDate">
                                <span class="mx-1">to</span>
                                <input type="date" class="form-control form-control-sm" id="salesEndDate">
                                <button class="btn btn-sm btn-outline-primary" type="button" id="salesFilterBtn"><i class="bi bi-funnel"></i></button>
                            </form>
                        </div>
                        <div class="card-body px-4 py-3">
                            <div class="row text-center mb-3" id="sales-summary">
                                <div class="col">
                                    <div class="fw-bold fs-4" id="totalSalesAmount">$2,340</div>
                                    <div class="text-muted small">This Period</div>
                                </div>
                                <div class="col">
                                    <div class="fw-bold fs-5 text-success" id="totalOrders">34</div>
                                    <div class="text-muted small">Orders</div>
                                </div>
                                <div class="col">
                                    <div class="fw-bold fs-5 text-primary" id="totalCategories">6</div>
                                    <div class="text-muted small">Categories</div>
                                </div>
                            </div>
                            <!-- Sample Chart.js Bar Chart -->
                            <canvas id="salesChart" height="180" style="max-width:100%;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- User Activity Panel -->
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white d-flex align-items-center justify-content-between px-3 py-2">
                            <span class="fw-bold"><i class="bi bi-people me-2"></i>User Activity</span>
                            <button class="btn btn-sm btn-outline-secondary" id="refreshUserActivity" title="Refresh"><i class="bi bi-arrow-clockwise"></i></button>
                        </div>
                        <div class="card-body px-4 py-3">
                            <ul class="list-group list-group-flush" id="user-activity-list">
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-person-circle me-2 text-primary"></i>
                                    <span><strong>Jane Doe</strong> placed an order <span class="text-muted small">2 mins ago</span></span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-person-circle me-2 text-success"></i>
                                    <span><strong>John Smith</strong> registered <span class="text-muted small">10 mins ago</span></span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-person-circle me-2 text-warning"></i>
                                    <span><strong>Mary Lee</strong> left a review <span class="text-muted small">30 mins ago</span></span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-person-circle me-2 text-danger"></i>
                                    <span><strong>Admin</strong> updated stock <span class="text-muted small">1 hour ago</span></span>
                                </li>
                            </ul>
                            <div id="user-alerts" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../assets/scripts/dashboard.js"></script>

</body>
</html>
