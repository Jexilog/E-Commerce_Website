<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History | AudioHub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/styles/users.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <?php include '../../components/admin/sidebar/sidebar.php'; ?>>
    <div class="main-content flex-grow-1" style="margin-left:250px; min-height:100vh; background:#fafbfc;">
        <!-- Header -->
        <header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 py-2 mb-4">
            <a class="navbar-brand fw-300" href="dashboard.php">AudioHub</a>
        </header>

        <!-- Back Button -->
        <div class="px-4 mb-3">
            <a href="users.php" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Back to Users
            </a>
        </div>

        <main class="px-4 py-1">
            <?php
            $userEmail = isset($_GET['email']) ? $_GET['email'] : '';
            $userName = isset($_GET['name']) ? $_GET['name'] : '';
            ?>
            <div class="mb-4">
                <h4 class="mb-1">Order History for <span class="text-primary" id="orderUserName"><?php echo htmlspecialchars($userName); ?></span></h4>
                <div class="text-muted small" id="orderUserEmail"><?php echo htmlspecialchars($userEmail); ?></div>
            </div>
            <div class="table-responsive rounded shadow-sm bg-white p-3">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Order #</th>
                            <th scope="col">Date</th>
                            <th scope="col">Items</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Shipping</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example static rows, replace with PHP loop or JS -->
                        <tr>
                            <td>#1001</td>
                            <td>2024-05-01</td>
                            <td>
                                <ul class="mb-0 small">
                                    <li>Wireless Headphones</li>
                                    <li>Bluetooth Speaker</li>
                                </ul>
                            </td>
                            <td>₱4,500.00</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td><span class="badge bg-primary">GCash</span></td>
                            <td><span class="badge bg-info text-dark">Delivered</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-secondary" title="View Details"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-primary" title="Download Invoice"><i class="bi bi-download"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>#1002</td>
                            <td>2024-05-10</td>
                            <td>
                                <ul class="mb-0 small">
                                    <li>USB Microphone</li>
                                </ul>
                            </td>
                            <td>₱1,200.00</td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                            <td><span class="badge bg-secondary">COD</span></td>
                            <td><span class="badge bg-secondary">Processing</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-secondary" title="View Details"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-primary" title="Download Invoice"><i class="bi bi-download"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>#1003</td>
                            <td>2024-05-15</td>
                            <td>
                                <ul class="mb-0 small">
                                    <li>Studio Monitor</li>
                                    <li>Audio Interface</li>
                                    <li>XLR Cable</li>
                                </ul>
                            </td>
                            <td>₱8,900.00</td>
                            <td><span class="badge bg-danger">Cancelled</span></td>
                            <td><span class="badge bg-primary">GCash</span></td>
                            <td><span class="badge bg-danger">Cancelled</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-secondary" title="View Details"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-primary" title="Download Invoice"><i class="bi bi-download"></i></a>
                            </td>
                        </tr>
                        <!-- End example rows -->
                    </tbody>
                </table>
            </div>
            <nav aria-label="Order table pagination" class="mt-3">
                <ul class="pagination justify-content-end mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </main>
    </div>
</body>
</html>