<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="container py-4">
        <h3 class="mb-4"><i class="bi-bell"></i> Notifications</h3>
        <div class="card">
            <div class="card-header bg-primary text-white">
                Recent Notifications
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-center">
                    <i class="bi bi-info-circle text-primary me-2"></i>
                    New user registered
                    <span class="badge bg-secondary ms-auto">Just now</span>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <i class="bi bi-box-arrow-in-down text-success me-2"></i>
                    New order received
                    <span class="badge bg-secondary ms-auto">5 mins ago</span>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                    Low stock alert
                    <span class="badge bg-secondary ms-auto">10 mins ago</span>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <i class="bi bi-person-x text-danger me-2"></i>
                    User account suspended
                    <span class="badge bg-secondary ms-auto">1 hour ago</span>
                </li>
            </ul>
        </div>
        <a href="../admin/dashboard.php" class="btn btn-outline-primary mt-4"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
    </div>
</body>
</html>