<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports | Admin Panel</title>
</head>
<body>
    <?php include "../adminpage/sidebar/sidebar.php" ?>

    <div class="main-content flex-grow-1">
        <header>
            <div class="d-flex align-items-center px-4 pb-2 p-2" style="background: #ffffff; border-bottom: 1px solid #e5e5e5;">
                <span class="reports-title me-4">SoundStage</span>
                <ul class="nav nav-tabs gap-2">
                    <li class="nav-item">
                        <a class="nav-link<?= basename($_SERVER['PHP_SELF'])=='reports.php'?' active':'' ?>" href="reports.php">Sales Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= basename($_SERVER['PHP_SELF'])=='financial-report.php'?' active':'' ?>" href="financial-report.php">Financial Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= basename($_SERVER['PHP_SELF'])=='order-report.php'?' active':'' ?>" href="order-report.php">Order Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= basename($_SERVER['PHP_SELF'])=='customer-report.php'?' active':'' ?>" href="customer-report.php">Customer Reports</a>
                    </li>
                </ul>
            </div>
        </header>
         <main class="p-4">

            <!-- Filter & Export Row -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <input type="text" class="form-control form-control-sm" style="width:220px;" placeholder="Search orders or products...">
                    <input type="date" class="form-control form-control-sm" id="dateFrom" style="width:140px;">
                    <span class="mx-1">to</span>
                    <input type="date" class="form-control form-control-sm" id="dateTo" style="width:140px;">
                </div>
                <div>
                    <button class="btn btn-outline-secondary btn-sm me-1"><i class="bi bi-file-earmark-excel"></i> Export CSV</button>
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-file-earmark-pdf"></i> Export PDF</button>
                </div>
            </div>

            <!-- Summary Cards with Trend Indicators -->
            <div class="row mb-2">
                <div class="col-md-3 col-6 mb-3">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-body">
                            <h6 class="card-title mb-1">Total Sales Today</h6>
                            <div class="fs-4 fw-bold">₱ 8,499.00</div>
                            <div class="small mt-1">
                                <span class="badge bg-light text-success fw-bold px-2 py-1" data-bs-toggle="tooltip" title="Compared to yesterday">
                                    <i class="bi bi-arrow-up"></i> 12%
                                </span>
                                <span class="text-light">vs. yesterday</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="card text-white bg-success h-100">
                        <div class="card-body">
                            <h6 class="card-title mb-1">Total Orders</h6>
                            <div class="fs-4 fw-bold">120</div>
                            <div class="small mt-1">
                                <span class="badge bg-light text-danger fw-bold px-2 py-1" data-bs-toggle="tooltip" title="Compared to last week">
                                    <i class="bi bi-arrow-down"></i> 5%
                                </span>
                                <span class="text-light">vs. last week</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body">
                            <h6 class="card-title mb-1">Avg. Order Value</h6>
                            <div class="fs-4 fw-bold">₱ 1,200.00</div>
                            <div class="small mt-1">
                                <span class="badge bg-success bg-opacity-10 text-success fw-bold px-2 py-1" data-bs-toggle="tooltip" title="Compared to last month">
                                    <i class="bi bi-arrow-up"></i> 3%
                                </span>
                                <span class="text-light">vs. last month</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="card text-white bg-warning h-100">
                        <div class="card-body">
                            <h6 class="card-title mb-1">Pending Payments</h6>
                            <div class="fs-4 fw-bold">₱ 1,060.00</div>
                            <div class="small mt-1">
                                <span class="badge bg-danger bg-opacity-10 text-danger fw-bold px-2 py-1" data-bs-toggle="tooltip" title="Compared to last week">
                                    <i class="bi bi-arrow-down"></i> 2%
                                </span>
                                <span class="text-light">vs. last week</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales Trends Chart -->
            <div class="card mb-4 position-relative">
                <div class="spinner-overlay" id="chartSpinner" style="display:flex;">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <span>
                        Sales Trends
                        <span class="badge bg-light text-dark ms-2" id="salesTrendsLabel">Showing: Monthly (January 2024)</span>
                    </span>
                    <div class="btn-group">
                        <!-- Monthly Dropdown -->
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="monthDropdownBtn">
                                January
                            </button>
                            <ul class="dropdown-menu" id="monthDropdown">
                                <li><a class="dropdown-item" href="#">January</a></li>
                                <li><a class="dropdown-item" href="#">February</a></li>
                                <li><a class="dropdown-item" href="#">March</a></li>
                                <li><a class="dropdown-item" href="#">April</a></li>
                                <li><a class="dropdown-item" href="#">May</a></li>
                                <li><a class="dropdown-item" href="#">June</a></li>
                                <li><a class="dropdown-item" href="#">July</a></li>
                                <li><a class="dropdown-item" href="#">August</a></li>
                                <li><a class="dropdown-item" href="#">September</a></li>
                                <li><a class="dropdown-item" href="#">October</a></li>
                                <li><a class="dropdown-item" href="#">November</a></li>
                                <li><a class="dropdown-item" href="#">December</a></li>
                            </ul>
                        </div>
                        <!-- Yearly Dropdown -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="yearDropdownBtn">
                                2024
                            </button>
                            <ul class="dropdown-menu" id="yearDropdown">
                                <?php for($year=2020;$year<=2030;$year++): ?>
                                    <li><a class="dropdown-item" href="#"><?= $year ?></a></li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="reportChart" height="300"></canvas>
                </div>
            </div>

            <div class="row">
                <!-- Best Sellers (expanded, with larger pie chart) -->
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                            <span>Best Sellers</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table mb-0 align-middle">
                                        <thead>
                                            <tr>
                                                <th class="sortable">Product <i class="bi bi-chevron-expand"></i></th>
                                                <th class="sortable">Sold <i class="bi bi-chevron-expand"></i></th>
                                                <th class="sortable">Revenue <i class="bi bi-chevron-expand"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody id="bestSellersTable">
                                            <!-- JS will populate rows -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <!-- Larger Pie/Donut Chart for Sales by Category -->
                                    <canvas id="categoryPieChart" width="260" height="260"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Tooltip init
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Sales Trends Chart Data
    const salesTrendsData = {
        '2024': {
            'January': [1200, 1900, 3000, 500, 2000, 3000, 4000, 3500, 4500, 3000, 2000, 2500],
            'February': [1500, 2100, 3200, 700, 2200, 3100, 4200, 3700, 4700, 3200, 2200, 2700],
            'March': [1200, 1900, 3000, 500, 2000, 3000, 4000, 3500, 4500, 3000, 2000, 2500],
            'April': [1500, 2100, 3200, 700, 2200, 3100, 4200, 3700, 4700, 3200, 2200, 2700],
            'May': [1200, 1900, 3000, 500, 2000, 3000, 4000, 3500, 4500, 3000, 2000, 2500],
            'June': [1500, 2100, 3200, 700, 2200, 3100, 4200, 3700, 4700, 3200, 2200, 2700],
            'July': [1200, 1900, 3000, 500, 2000, 3000, 4000, 3500, 4500, 3000, 2000, 2500],
            'August': [1500, 2100, 3200, 700, 2200, 3100, 4200, 3700, 4700, 3200, 2200, 2700],
            'September': [1200, 1900, 3000, 500, 2000, 3000, 4000, 3500, 4500, 3000, 2000, 2500],
            'October': [1500, 2100, 3200, 700, 2200, 3100, 4200, 3700, 4700, 3200, 2200, 2700],
            'November': [1200, 1900, 3000, 500, 2000, 3000, 4000, 3500, 4500, 3000, 2000, 2500],
            'December': [1500, 2100, 3200, 700, 2200, 3100, 4200, 3700, 4700, 3200, 2200, 5000],
            // ...add more months
        },
        // ...add more years
    };
    let selectedYear = '2024';
    let selectedMonth = 'January';

    // Show spinner while loading chart
    setTimeout(() => {
        const spinner = document.getElementById('chartSpinner');
        if (spinner) spinner.style.display = 'none';
        renderSalesTrendsChart();
    }, 600);

    function renderSalesTrendsChart() {
        const ctx = document.getElementById('reportChart').getContext('2d');
        if (window.salesTrendsChart) window.salesTrendsChart.destroy();
        window.salesTrendsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Sales',
                    data: [3000, 4000, 3500, 4500],
                    borderColor: '#1976d2',
                    backgroundColor: 'rgba(25, 118, 210, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10000, // Set your desired max
                        ticks: {
                            stepSize: 1000,
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
        document.getElementById('salesTrendsLabel').textContent = `Showing: Monthly (${selectedMonth} ${selectedYear})`;
        document.getElementById('monthDropdownBtn').textContent = selectedMonth;
        document.getElementById('yearDropdownBtn').textContent = selectedYear;
    }

    // Month/Year Dropdowns
    const monthDropdown = document.getElementById('monthDropdown');
    if (monthDropdown) {
        monthDropdown.addEventListener('click', function(e) {
            if (e.target.tagName === 'A') {
                selectedMonth = e.target.textContent;
                renderSalesTrendsChart();
            }
        });
    }
    const yearDropdown = document.getElementById('yearDropdown');
    if (yearDropdown) {
        yearDropdown.addEventListener('click', function(e) {
            if (e.target.tagName === 'A') {
                selectedYear = e.target.textContent;
                renderSalesTrendsChart();
            }
        });
    }

    // Best Sellers Data
    let bestSellers = [
        { product: "IE Monitor X1", img: "../assets/images/products/monitorx1.jpg", sold: 50, revenue: 25000 },
        { product: "Headphones Pro", img: "../assets/images/products/headphonespro.jpg", sold: 30, revenue: 18000 },
        { product: "Speaker Mini", img: "../assets/images/products/speakermini.jpg", sold: 20, revenue: 10000 }
    ];
    let bestSellersSort = { key: 'sold', dir: 'desc' };

    function renderBestSellers() {
        let sorted = [...bestSellers].sort((a, b) => {
            if (bestSellersSort.key === 'product') {
                return bestSellersSort.dir === 'asc'
                    ? a.product.localeCompare(b.product)
                    : b.product.localeCompare(a.product);
            } else {
                return bestSellersSort.dir === 'asc'
                    ? a[bestSellersSort.key] - b[bestSellersSort.key]
                    : b[bestSellersSort.key] - a[bestSellersSort.key];
            }
        });
        document.getElementById('bestSellersTable').innerHTML = sorted.map(item => `
            <tr>
                <td>
                    <img src="${item.img}" class="avatar-sm me-2" alt="${item.product}"> ${item.product}
                </td>
                <td>${item.sold}</td>
                <td>₱ ${item.revenue.toLocaleString()}</td>
            </tr>
        `).join('');
    }
    window.sortBestSellers = function(key) {
        if (bestSellersSort.key === key) {
            bestSellersSort.dir = bestSellersSort.dir === 'asc' ? 'desc' : 'asc';
        } else {
            bestSellersSort.key = key;
            bestSellersSort.dir = 'desc';
        }
        renderBestSellers();
    }
    renderBestSellers();

    // Pie/Donut Chart for Sales by Category
    setTimeout(() => {
        new Chart(document.getElementById('categoryPieChart'), {
            type: 'doughnut',
            data: {
                labels: ['IEMs', 'Earbuds', 'Headphones'],
                datasets: [{
                    data: [60, 30, 20],
                    backgroundColor: ['#1976d2', '#43a047', '#ffa000']
                }]
            },
            options: {
                plugins: {
                    legend: { display: true, position: 'bottom' }
                },
                responsive: false,
                maintainAspectRatio: false
            }
        });
    }, 700);

    // Delegate click event for dynamically generated buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('view-order-btn')) {
            const orderId = e.target.getAttribute('data-order-id');
            const modal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
            document.getElementById('orderDetailsModalBody').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>';
            modal.show();

            // Fetch order details via AJAX (replace with your endpoint)
            fetch(`order-details-content.php?id=${orderId}`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('orderDetailsModalBody').innerHTML = html;
                })
                .catch(() => {
                    document.getElementById('orderDetailsModalBody').innerHTML = '<div class="alert alert-danger">Failed to load order details.</div>';
                });
        }
    });
});
    </script>
</body>
</html>