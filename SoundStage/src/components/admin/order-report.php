<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Report | SoundStage</title>
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
                        <a class="nav-link active" href="order-report.php">Order Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer-report.php">Customer Reports</a>
                    </li>
                </ul>
            </div>
        </header>
        <main class="p-4">
            <!-- Filter Row -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <input type="text" class="form-control form-control-sm" style="width:220px;" placeholder="Search orders...">
                    <input type="date" class="form-control form-control-sm" style="width:140px;">
                    <span class="mx-1">to</span>
                    <input type="date" class="form-control form-control-sm" style="width:140px;">
                    <select class="form-select form-select-sm" style="width:160px;">
                        <option>Status: All</option>
                        <option>Pending</option>
                        <option>Processing</option>
                        <option>Shipped</option>
                        <option>Delivered</option>
                        <option>Cancelled</option>
                    </select>
                </div>
                <div>
                    <button class="btn btn-outline-secondary btn-sm me-1"><i class="bi bi-file-earmark-excel"></i> Export CSV</button>
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-file-earmark-pdf"></i> Export PDF</button>
                </div>
            </div>
            <!-- Order Status Cards -->
            <div class="row mb-4">
                <div class="col-md-2 col-6 mb-3">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body text-center">
                            <div class="fs-5 fw-bold">120</div>
                            <div class="small">Total Orders</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="card bg-warning text-dark h-100">
                        <div class="card-body text-center">
                            <div class="fs-5 fw-bold">15</div>
                            <div class="small">Pending</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body text-center">
                            <div class="fs-5 fw-bold">30</div>
                            <div class="small">Processing</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="card bg-secondary text-white h-100">
                        <div class="card-body text-center">
                            <div class="fs-5 fw-bold">50</div>
                            <div class="small">Shipped</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body text-center">
                            <div class="fs-5 fw-bold">20</div>
                            <div class="small">Delivered</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="card bg-danger text-white h-100">
                        <div class="card-body text-center">
                            <div class="fs-5 fw-bold">5</div>
                            <div class="small">Cancelled</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Orders by Status Chart -->
            <div class="card mb-4">
                <div class="card-header bg-white fw-bold">Order Status Breakdown</div>
                <div class="card-body" style="height:350px;">
                    <canvas id="orderStatusChart" style="height:350px;max-height:350px;"></canvas>
                </div>
            </div>
            <!-- Orders Table -->
            <div class="card mb-4">
                <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                    <span>Order Details</span>
                    <div>
                        <label for="ordersPerPage" class="form-label mb-0 me-1 small">Rows per page:</label>
                        <select id="ordersPerPage" class="form-select form-select-sm d-inline-block" style="width: auto;">
                            <option>5</option>
                            <option>10</option>
                            <option>20</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="orderReportTable">
                            <!-- JS will populate rows here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../assets/scripts/order-report.js"></script>

</body>
</html>