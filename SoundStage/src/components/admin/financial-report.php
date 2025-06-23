<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Financial Report | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/styles/reports.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>

    <?php include '../../components/admin/sidebar/sidebar.php'; ?>

    <div class="main-content flex-grow-1">
        <header>
            <div class="d-flex align-items-center px-4 pb-2 p-2" style="background: #fff; border-bottom: 1px solid #e5e5e5;">
                <span class="reports-title me-4">SoundStage</span>
                <ul class="nav nav-tabs gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="reports.php">Sales Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="financial-report.php">Financial Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order-report.php">Order Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer-report.php">Customer Reports</a>
                    </li>
                </ul>
            </div>
        </header>
        <main class="p-4">
            <!-- Financial Overview Cards -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <h6 class="card-title mb-1">Total Revenue</h6>
                            <div class="fs-4 fw-bold">₱ 1,200,000.00</div>
                            <div class="small mt-1">
                                <span class="badge bg-light text-success fw-bold px-2 py-1"><i class="bi bi-arrow-up"></i> 8%</span>
                                <span class="text-light">vs. last month</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card bg-danger text-white h-100">
                        <div class="card-body">
                            <h6 class="card-title mb-1">Total Expenses</h6>
                            <div class="fs-4 fw-bold">₱ 850,000.00</div>
                            <div class="small mt-1">
                                <span class="badge bg-light text-danger fw-bold px-2 py-1"><i class="bi bi-arrow-up"></i> 3%</span>
                                <span class="text-light">vs. last month</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <h6 class="card-title mb-1">Net Profit</h6>
                            <div class="fs-4 fw-bold">₱ 350,000.00</div>
                            <div class="small mt-1">
                                <span class="badge bg-light text-success fw-bold px-2 py-1"><i class="bi bi-arrow-up"></i> 12%</span>
                                <span class="text-light">vs. last month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Financial Trends Chart -->
            <div class="card mb-4">
                <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                    <span>Financial Trends</span>
                    <div>
                        <select class="form-select form-select-sm d-inline-block" style="width:auto;">
                            <option>Monthly</option>
                            <option>Quarterly</option>
                            <option>Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="financialTrendsChart" height="120"></canvas>
                </div>
            </div>
            <!-- Key Financial Data Table -->
            <div class="card mb-4">
                <div class="card-header bg-white fw-bold">Key Financial Data</div>
                <div class="card-body p-0">
                    <table class="table mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Metric</th>
                                <th>Amount</th>
                                <th>Change</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Gross Margin</td>
                                <td>₱ 400,000.00</td>
                                <td><span class="text-success"><i class="bi bi-arrow-up"></i> 5%</span></td>
                            </tr>
                            <tr>
                                <td>Operating Expenses</td>
                                <td>₱ 200,000.00</td>
                                <td><span class="text-danger"><i class="bi bi-arrow-down"></i> 2%</span></td>
                            </tr>
                            <tr>
                                <td>EBITDA</td>
                                <td>₱ 180,000.00</td>
                                <td><span class="text-success"><i class="bi bi-arrow-up"></i> 4%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Example Chart.js for Financial Trends
        const ctx = document.getElementById('financialTrendsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [
                    { label: 'Revenue', data: [200, 250, 300, 350, 400, 420], borderColor: '#198754', fill: false },
                    { label: 'Expenses', data: [150, 180, 210, 230, 250, 260], borderColor: '#dc3545', fill: false },
                    { label: 'Profit', data: [50, 70, 90, 120, 150, 160], borderColor: '#0d6efd', fill: false }
                ]
            },
            options: { responsive: true, plugins: { legend: { position: 'top' } } }
        });
    </script>

</body>
</html>