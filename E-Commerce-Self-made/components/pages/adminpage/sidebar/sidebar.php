<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Sidebar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            margin-left: 250px;
            transition: margin-left 0.3s;
        }
        
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #2c3e50;
            z-index: 1000;
            transition: width 0.3s;
        }
        
        .sidebar-nav .nav-link {
            color: white !important;
            font-size: 1.1rem;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.375rem;
        }
        
        .sidebar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        .sidebar-nav .nav-link i {
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }
        
        .logout-btn {
            width: 100%;
            font-size: 1.1rem;
        }
        
        @media (max-width: 768px) {
            body {
                margin-left: 0;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <!-- Sidebar Header -->
        <div class="text-center mb-4">
            <h5 class="text-white">Hello Admin!</h5>
        </div>
        
        <!-- Sidebar Navigation -->
        <nav class="sidebar-nav flex-grow-1">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        <i class="bi bi-speedometer"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reportspanel.php">
                        <i class="bi bi-clipboard-data-fill"></i> Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="productpanel.php">
                        <i class="bi bi-box"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userpanel.php">
                        <i class="bi bi-person"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- Sidebar Footer -->
        <div class="mt-auto">
            <button class="btn btn-danger logout-btn">
                <i class="bi bi-box-arrow-right"></i> Log Out
            </button>
        </div>
    </div>
    
    <!-- Main Content would go here -->
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
