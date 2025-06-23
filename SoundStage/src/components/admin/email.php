<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Emails</title>
    <link rel="icon" href="../../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="container py-4">
        <h3 class="mb-4"><i class="bi-envelope"></i> Inbox</h3>
        <div class="card">
            <div class="card-header bg-primary text-white">
                Recent Emails
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-start">
                    <i class="bi bi-envelope-fill text-primary me-3 fs-4"></i>
                    <div class="flex-grow-1">
                        <a href="email-view.php?id=123" class="text-decoration-none text-dark">
                            <strong>Order Confirmation</strong>
                            <div class="small text-muted">From: sales@soundstage.com</div>
                            <div class="text-secondary">Your order #1234 has been shipped.</div>
                        </a>
                    </div>
                    <span class="badge bg-secondary ms-3">Just now</span>
                </li>
                <li class="list-group-item d-flex align-items-start">
                    <i class="bi bi-envelope-fill text-success me-3 fs-4"></i>
                    <div class="flex-grow-1">
                        <a href="email-view.php?id=12345" class="text-decoration-none text-dark">
                            <strong>Support Ticket</strong>
                            <div class="small text-muted">From: support@soundstage.com</div>
                            <div class="text-secondary">Your ticket has been updated.</div>
                        </a>
                    </div>
                    <span class="badge bg-secondary ms-3">5 mins ago</span>
                </li>
                <li class="list-group-item d-flex align-items-start">
                    <i class="bi bi-envelope-fill text-warning me-3 fs-4"></i>
                    <div class="flex-grow-1">
                        <a href="email-view.php?id=12346" class="text-decoration-none text-dark">
                            <strong>Promo Offer</strong>
                            <div class="small text-muted">From: promo@soundstage.com</div>
                            <div class="text-secondary">Get 20% off on your next purchase!</div>
                        </a>
                    </div>
                    <span class="badge bg-secondary ms-3">1 hour ago</span>
                </li>
            </ul>
        </div>
        <a href="../admin/dashboard.php" class="btn btn-outline-primary mt-4"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
    </div>
</body>
</html>