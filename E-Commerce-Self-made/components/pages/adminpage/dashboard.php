<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include "../adminpage/sidebar/sidebar.php"?>
    <header>
        <nav class="navbar navbar-expand-lg px-4 navbar-light bg-white shadow-sm border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"> CyberHack</a>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </header>

    <main style="margin-left: 25px; padding: 10px;">
        <h5 class="dashboard-title mt-3 mb-3">OVERVIEW</h5>

            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between px-3 py-2">
                    <span class="fw-bold"><i class="bi bi-box-seam me-2"></i>Product Categories Overview</span>
                    <form class="d-flex gap-2" id="product-filter-form">
                        <select class="form-select form-select-sm" id="categoryFilter">
                            <option value="all" selected>All Categories</option>
                            <option value="pc_components">PC Components</option>
                            <option value="peripherals">PC Peripherals and Accessories</option>
                            <option value="gaming">Gaming Devices and Accessories</option>
                            <option value="desktop">Desktop PCs</option>
                            <option value="laptops">Laptops</option>
                            <option value="smartphones">Smartphones</option>
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
                                <tr>
                                    <td><img src="" alt="Test"></td>
                                    <td>PC Components</td>
                                    <td>18</td>
                                    <td>In Stock</td>
                                    <td>View</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Product pagination" class="mt-3">
                        <ul class="pagination pagination-sm justify-content-end mb-0" id="product-pagination">
                            <!-- JS will render pagination here -->
                        </ul>
                    </nav>
                </div>
            </div>

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
        </div>

    </main>
</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Sales',
                data: [1200, 1900, 3000, 2500, 2200, 2700, 3500, 4000, 3800, 4500, 5000, 6000],
                backgroundColor: '#4f8cff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
</script>
</html>