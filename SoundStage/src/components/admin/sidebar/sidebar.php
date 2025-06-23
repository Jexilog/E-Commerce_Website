<aside class="sidebar bg-primary text-white p-3 d-flex flex-column align-items-stretch" style="min-height:100vh;position:fixed;left:0;top:0;width:250px;z-index:100;">
    <div class="mb-3 text-center">
        <h5>Admin</h5>
        <img class="admin-pfp rounded-circle mb-2" src="../../assets/images/rep.jpg" alt="admin-pfp" style="width: 100px; height: 100px;">
        <div class="fw-bold pt-1">Admin Jeckho</div>
    </div>
    <nav class="nav flex-column w-100">
        <a class="nav-link text-white<?= basename($_SERVER['PHP_SELF'])=='dashboard.php'?' active':'' ?>" href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a class="nav-link text-white<?= basename($_SERVER['PHP_SELF'])=='reports.php'?' active':'' ?>" href="reports.php"><i class="bi bi-file-earmark-text"></i> Reports</a>
        <a class="nav-link text-white<?= basename($_SERVER['PHP_SELF'])=='products.php'?' active':'' ?>" href="products.php"><i class="bi bi-box-seam"></i> Product</a>
        <a class="nav-link text-white<?= basename($_SERVER['PHP_SELF'])=='users.php'?' active':'' ?>" href="users.php"><i class="bi bi-people"></i> User</a>
    </nav>
    <div class="mt-auto text-start w-100 px-3">
        <a href="/System/SoundStage/src/pages/auth/sign-in.php" class="btn btn-outline-light logout-btn mt-3">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</aside>