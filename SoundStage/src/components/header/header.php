<?php
    //session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HzOne</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
    <style>
        .navbar {
            background: #ffffff !important;
            border-bottom: 1px solid #2e3a4d;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            letter-spacing: 1.5px;
            color: #003366 !important;
        }
        .nav-link, .navbar-nav .nav-link.active {
            color: #000000 !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #003366 !important;
        }
        .mega-menu {
            min-width: 730px !important; /* Mas malapad */
            max-width: 1100px;
            width: 80vw;
            background: #ffffff;
            border-radius: 1.5rem;
            border: 1px solid #2e3a4d;
            box-shadow: 0 8px 40px 0 rgba(126,203,255,0.10);
            padding: 2rem 2.5rem !important;
            color: #003366;
            left: 50% !important;
            transform: translateX(-50%);
            position: absolute !important;
            top: 100% !important;
        }
        .mega-menu .dropdown-item {
            color: #000000;
            font-weight: 500;
            border-radius: 0.7rem;
            margin-bottom: 0.2rem;
            padding: 0.7rem 0.8rem;
            font-size: 0.98rem;
            transition: background 0.15s, color 0.15s;
            background: transparent;
            min-height: 110px;
        }
        .mega-menu .dropdown-item:hover {
            background: #ffffff;
            color: #000000;
            box-shadow: 0 2px 12px 0 rgba(53, 54, 54, 0.1);
        }
        .mega-menu .dropdown-item .fs-3 {
            font-size: 1.6rem !important;
        }
        .mega-menu .dropdown-item .fw-semibold {
            font-size: 1rem;
        }
        .mega-menu .dropdown-item small {
            font-size: 0.75rem;
        }
        .blur-bg {
            filter: blur(6px);
            pointer-events: none;
            user-select: none;
            transition: filter 0.2s;
            /* Make sure the blur doesn't affect the navbar itself */
        }
        .navbar {
            position: relative;
            z-index: 1051;
        }
        .dropdown-menu.mega-menu {
            z-index: 1060;
        }
        .dropdown-menu.profile-menu {
            min-width: 260px !important;
            max-width: 320px;
            width: 100%;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            background: #ffffff;
            box-shadow: 0 8px 40px 0 #ffffff;
        }
    </style>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/System/SoundStage/src/dashboard.php"><i class="bi bi-earbuds"></i> Soundstage</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/System/SoundStage/src/dashboard.php">Home</a></li>
                    <li class="nav-item dropdown position-static" id="categoryDropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoryMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>
                        <div class="dropdown-menu mega-menu shadow-lg p-4 mt-2" aria-labelledby="categoryMenu">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <a href="/System/SoundStage/src/components/product-page/all-devices.php" class="fw-bold text-dark text-decoration-none d-flex align-items-center mt-2" style="font-size:1.4rem;">
                                        View All Audio Devices <i class="bi bi-chevron-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row row-cols-2 row-cols-md-4 g-2">
                                <div class="col">
                                    <a class="dropdown-item d-flex flex-column align-items-start gap-1" href="/System/SoundStage/src/components/product-page/headphones.php">
                                        <span class="fs-3"><i class="bi bi-headphones"></i></span>
                                        <span class="fw-semibold small">Headphones</span>
                                        <small class="text-dark-50">Exquisite Timbre, Tremendous Uniqueness</small>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-item d-flex flex-column align-items-start gap-1" href="/System/SoundStage/src/components/product-page/iem.php">
                                        <span class="fs-3"><i class="bi bi-earbuds"></i></span>
                                        <span class="fw-semibold small">In-ear Monitors</span>
                                        <small class="text-dark-50">Reference Timbre, Benchmark In-ears</small>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-item d-flex flex-column align-items-start gap-1" href="/System/SoundStage/src/components/product-page/earbuds.php">
                                        <span class="fs-3"><i class="bi bi-earbuds"></i></span>
                                        <span class="fw-semibold small">True Wireless Stereo</span>
                                        <small class="text-dark-50">Accurate Performance, Wireless Experience</small>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-item d-flex flex-column align-items-start gap-1" href="/System/SoundStage/src/components/product-page/dap.php">
                                        <span class="fs-3"><i class="bi bi-disc"></i></span>
                                        <span class="fw-semibold small">Digital Audio Player</span>
                                        <small class="text-dark-50">Classics Tribute, Classics Transcendence</small>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-item d-flex flex-column align-items-start gap-1" href="/System/SoundStage/src/components/product-page/speaker.php">
                                        <span class="fs-3"><i class="bi bi-speaker"></i></span>
                                        <span class="fw-semibold small">Speakers</span>
                                        <small class="text-dark-50">Professional Serious, Design Quality</small>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-item d-flex flex-column align-items-start gap-1" href="/System/SoundStage/src/components/product-page/accessories.php">
                                        <span class="fs-3"><i class="bi bi-tools"></i></span>
                                        <span class="fw-semibold small">Audio Accessories</span>
                                        <small class="text-dark-50">Premium Design, Ultimate Performance</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/System/SOundStage/src/components/brands.php">Brands</a></li>
                    <li class="nav-item dropdown position-static" id="supportDropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="supportMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Support
                        </a>
                        <div class="dropdown-menu mega-menu shadow-lg p-4 mt-2" aria-labelledby="supportMenu">
                            <div class="row row-cols-1 row-cols-md-3 g-2">
                                <div class="col">
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="/System/SoundStage/src/components/nav-links/contact.php">
                                        <i class="bi bi-telephone"></i> Contact Us
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="/System/SoundStage/src/components/manual.php">
                                        <i class="bi bi-book"></i> Manual & Guide
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="/System/SoundStage/src/components/nav-links/download.php">
                                        <i class="bi bi-download"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <form class="d-flex me-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search IEMs..." aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <div class="d-flex gap-2 align-items-center">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- Profile dropdown -->
                        <div class="dropdown">
                            <a href="#" class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                                <span class="ms-2"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                            </a>
                            <ul class="dropdown-menu profile-menu shadow-lg p-4 mt-2" aria-labelledby="profileDropdown">
                                <li>
                                    <a class="dropdown-item text-primary" href="/System/SoundStage/src/components/profile.php">
                                        <i class="bi bi-person"></i> Profile Settings
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-primary" href="/System/SoundStage/src/components/wishlist.php">
                                        <i class="bi bi-heart"></i> My Wishlist
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-primary" href="/System/SoundStage/src/components/orders.php">
                                        <i class="bi bi-box-seam"></i> My Orders
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-primary" href="/System/SoundStage/src/components/nav-links/contact.php">
                                        <i class="bi bi-life-preserver"></i> Support
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="/System/SoundStage/src/pages/auth/logout.php">
                                        <i class="bi bi-box-arrow-right"></i> Log Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Cart icon -->
                        <a href="/System/SoundStage/src/pages/cart.php" class="btn btn-outline-primary position-relative">
                            <i class="bi bi-cart"></i> Cart
                        </a>
                    <?php else: ?>
                        <a href="/System/SoundStage/src/pages/auth/auth.php?action=login" class="btn btn-outline-primary"><i class="bi bi-box-arrow-in-right"></i> Sign In</a>
                        <a href="/System/SoundStage/src/pages/auth/auth.php?action=register" class="btn btn-primary"><i class="bi bi-person-plus"></i> Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Helper for each dropdown
            function setupMegaMenu(dropdownId) {
                const dropdown = document.getElementById(dropdownId);
                if (!dropdown) return;
                const megaMenu = dropdown.querySelector('.mega-menu');
                let menuTimeout = null;

                function showMenu() {
                    clearTimeout(menuTimeout);
                    megaMenu.classList.add('show');
                    document.querySelectorAll('body > *:not(.navbar)').forEach(el => {
                        el.classList.add('blur-bg');
                    });
                }

                function hideMenu() {
                    menuTimeout = setTimeout(() => {
                        megaMenu.classList.remove('show');
                        document.querySelectorAll('.blur-bg').forEach(el => {
                            el.classList.remove('blur-bg');
                        });
                    }, 120);
                }

                dropdown.addEventListener('mouseenter', showMenu);
                dropdown.addEventListener('mouseleave', hideMenu);
                megaMenu.addEventListener('mouseenter', showMenu);
                megaMenu.addEventListener('mouseleave', hideMenu);

                // Accessibility: focus/blur
                dropdown.querySelector('.nav-link').addEventListener('focus', showMenu);
                dropdown.querySelector('.nav-link').addEventListener('blur', hideMenu);
            }

            setupMegaMenu('categoryDropdown');
            setupMegaMenu('supportDropdown');

            // Profile dropdown hover
            const profileDropdown = document.getElementById('profileDropdown');
            if (profileDropdown) {
                const dropdownMenu = profileDropdown.nextElementSibling;
                let menuTimeout = null;

                function showMenu() {
                    clearTimeout(menuTimeout);
                    dropdownMenu.classList.add('show');
                }
                function hideMenu() {
                    menuTimeout = setTimeout(() => {
                        dropdownMenu.classList.remove('show');
                    }, 120);
                }

                profileDropdown.parentElement.addEventListener('mouseenter', showMenu);
                profileDropdown.parentElement.addEventListener('mouseleave', hideMenu);
                dropdownMenu.addEventListener('mouseenter', showMenu);
                dropdownMenu.addEventListener('mouseleave', hideMenu);
            }
        });
</script>

</body>
</html>