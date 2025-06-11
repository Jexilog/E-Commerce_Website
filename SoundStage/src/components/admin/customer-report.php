<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Report | SoundStage</title>
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
                        <a class="nav-link" href="financial-report.php">Financial Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order-report.php">Order Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="customer-report.php">Customer Reports</a>
                    </li>
                </ul>
            </div>
        </header>
        <main class="p-4">
            <!-- Customer Overview Cards -->
            <div class="row mb-4">
                <div class="col-md-3 col-6 mb-3">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body text-center">
                            <div class="fs-5 fw-bold">2,500</div>
                            <div class="small">Total Customers</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body text-center">
                            <div class="fs-5 fw-bold">1,800</div>
                            <div class="small">Active Customers</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body text-center">
                            <div class="fs-5 fw-bold">700</div>
                            <div class="small">Returning Customers</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="card bg-warning text-dark h-100">
                        <div class="card-body text-center">
                            <div class="fs-5 fw-bold">120</div>
                            <div class="small">New This Month</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Customer Segmentation Chart -->
            <div class="card mb-4">
                <div class="card-header bg-white fw-bold">Customer Segmentation</div>
                <div class="card-body" style="height:350px;">
                    <canvas id="customerSegmentationChart" style="height:350px;max-height:350px;"></canvas>
                </div>
            </div>
            <!-- Customer Table -->
            <div class="card mb-4">
                <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                    <span>Customer List</span>
                    <div>
                        <input type="text" class="form-control form-control-sm" placeholder="Search customers..." style="width:200px; display:inline-block;">
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0 align-middle table-responsive">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Segment</th>
                                <th>Orders</th>
                                <th>Total Spent</th>
                                <th>Last Purchase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jane Doe</td>
                                <td>jane@example.com</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>12</td>
                                <td>₱ 15,000.00</td>
                                <td>2025-05-20</td>
                            </tr>
                            <tr>
                                <td>John Smith</td>
                                <td>john@example.com</td>
                                <td><span class="badge bg-info">Returning</span></td>
                                <td>8</td>
                                <td>₱ 8,500.00</td>
                                <td>2025-05-18</td>
                            </tr>
                            <!-- More rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Example Chart.js for Customer Segmentation
        const ctx = document.getElementById('customerSegmentationChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Active', 'Returning', 'New', 'Inactive'],
                datasets: [{
                    data: [1800, 700, 120, 400],
                    backgroundColor: ['#198754', '#0dcaf0', '#ffc107', '#6c757d']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Important for custom height
                plugins: { legend: { position: 'top' } }
            }
        });
    </script>

</body>
</html>