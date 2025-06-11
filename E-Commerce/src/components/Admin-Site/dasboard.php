<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoundStage Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-fluid d-flex">
        <aside class="sidebar bg-primary text-white p-3" style="width: 250px;">
            <center>
                <p>Admin</p>
                <img class="admin-pfp rounded-circle" src="../images/admin-rep.jpg" alt="admin-pfp" style="width: 120px; height: 120px;">
                <p class="admin-name">Admin Name</p>
            </center>
            <div class="aside-btn">
                <a href="#" class="btn btn-light w-100 mb-2"><i class="bi bi-speedometer2"></i>&nbsp;Dashboard</a>
                <a href="#" class="btn btn-light w-100 mb-2"><i class="bi bi-file-earmark-text"></i>&nbsp;Reports</a>
                <a href="#" class="btn btn-light w-100 mb-2"><i class="bi bi-box-seam"></i>&nbsp;Products</a>
                <a href="#" class="btn btn-light w-100 mb-2"><i class="bi bi-people"></i>&nbsp;Users</a>
            </div>
            <div class="logout">
                <a href="#" class="btn btn-outline-light w-200"><i class="bi bi-box-arrow-right"></i>&nbsp;Logout</a>
            </div>
        </aside>

        <div class="flex-grow-1">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">SoundStage</a>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi-bell"></i>&nbsp;Notification</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi-envelope"></i>&nbsp;Email</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi-gear"></i>&nbsp;Settings
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Profile Settings</a></li>
                                        <li><a class="dropdown-item" href="#">Product Management Settings</a></li>
                                        <li><a class="dropdown-item" href="#">User Management Settings</a></li>
                                        <li><a class="dropdown-item" href="#">Security & Policy</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">Log Out</a></li>
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
            
            <main class="p-4">
                <h5 class="dashboard-title">Overview</h5>
                <div class="row mb-4" class="products-row">
                    <div class="col-md-3">
                        <div class="card text-dark bg-light mb-3" class="product-card">
                            <img src="../images/iem.webp" class="card-img-top" alt="In-Ear Monitor">
                            <div class="card-body text-center">
                                <p class="card-title">In-Ear Monitor</p>
                                <p class="card-text">16 Products</p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-dark bg-light mb-3" class="product-card">
                            <img src="../images/headphones.png" class="card-img-top" alt="Headphones">
                            <div class="card-body text-center">
                                <p class="card-title">Headphones</p>
                                <p class="card-text">12 Products</p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-dark bg-light mb-3" class="product-card">
                            <img src="../images/tws-earbuds.png" class="card-img-top" alt="True-Wireless Stereo">
                            <div class="card-body text-center">
                                <p class="card-title">Earbuds (TWS)</p>
                                <p class="card-text">16 Products</p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-dark bg-light mb-3" class="product-card">
                            <img src="../images/audio-access.webp" class="card-img-top" alt="Audio Accessories">
                            <div class="card-body text-center">
                                <p class="card-title">Audio Access.</p>
                                <p class="card-text">12 Products</p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-dark bg-light mb-3" class="product-card">
                            <img src="../images/dap-new.png" class="card-img-top" alt="Digital Audio Player">
                            <div class="card-body text-center">
                                <p class="card-title">D-Audio Player</p>
                                <p class="card-text">5 Products</p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-dark bg-light mb-3" class="product-card">
                            <img src="../images/speaker.png" class="card-img-top" alt="Speaker">
                            <div class="card-body text-center">
                                <p class="card-title">Speaker</p>
                                <p class="card-text">8 Products</p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <h5>Total Sales</h5>
                        <canvas id="myChart" width="600" height="400"></canvas>
                    </div>
                    <div class="col-md-6">
                        <h5>User Activity</h5><br>
                        <ul class="list-group">
                            <li class="list-group-item">User 1 - Active (4 minutes ago)</li>
                            <li class="list-group-item">User 2 - Inactive</li>
                            <li class="list-group-item">User 3 - Active (2 minutes ago)</li>
                            <li class="list-group-item">User 4 - Inactive</li>
                            <li class="list-group-item">User 5 - Active (1 minute ago)</li>
                            <li class="list-group-item">User 6 - Inactive</li>
                        </ul>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../script/dashboard.js"></script>
</body>
</html>
