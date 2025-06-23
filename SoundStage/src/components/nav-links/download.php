<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Download Center | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/AudioHub/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            color: #000000;
        }
        .download-hero {
            background: linear-gradient(90deg, #003366 70%, #00509e 100%);
            color: #fff;
            border-radius: 1.5rem;
            padding: 2.5rem 1.5rem 2rem 1.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 32px 0 rgba(0,51,102,0.10);
            text-align: center;
        }
        .download-hero h1 {
            font-weight: 700;
            font-size: 2.3rem;
            margin-bottom: 0.7rem;
        }
        .download-hero p {
            font-size: 1.15rem;
            margin-bottom: 0.2rem;
        }
        .download-section {
            background: #003366;
            border-radius: 1.2rem;
            box-shadow: 0 2px 16px 0 rgba(0,51,102,0.08);
            padding: 2rem 1.5rem;
            margin: 1.5rem auto 1.5rem auto !important;
            max-width: 900px;
        }
        .download-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }
        .download-list li {
            margin-bottom: 1.2rem;
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            background: #e3eaf3;
            border-radius: 1rem;
            padding: 1.2rem 1rem 1.2rem 1rem;
            transition: box-shadow 0.2s;
        }
        .download-list li:last-child {
            margin-bottom: 0;
        }
        .download-list i {
            font-size: 2rem;
            color: #00509e;
            flex-shrink: 0;
            margin-top: 0.2rem;
        }
        .download-info h5 {
            color: #003366;
            font-weight: 600;
            margin-bottom: 0.2rem;
        }
        .download-info p {
            color: #222;
            margin-bottom: 0.3rem;
            font-size: 1rem;
        }
        .download-btn {
            background: #003366;
            color: #fff;
            border-radius: 2rem;
            padding: 0.45rem 1.4rem;
            font-weight: 600;
            border: none;
            transition: background 0.2s;
            font-size: 1rem;
            text-decoration: none !important;
            box-shadow: 0 2px 8px 0 rgba(0,51,102,0.10);
        }
        .download-btn:hover, .download-btn:focus {
            background: #00509e;
            color: #fff;
            text-decoration: none !important;
        }
        .download-btn i {
            font-size: 1.2rem;
            vertical-align: middle;
        }
        .download-info a {
            text-decoration: none !important;
        }
        @media (max-width: 767px) {
            .download-hero {
                padding: 1.5rem 1rem 1rem 1rem;
            }
            .download-section {
                padding: 1.2rem 0.7rem;
            }
            .download-list li {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="container py-4">
        <!-- Hero Section -->
        <div class="download-hero mt-4">
            <h1><i class="bi bi-download me-2"></i>Download Center</h1>
            <p>
                Access the latest manuals, drivers, software, and resources for your SoundStage products.
            </p>
        </div>

        <!-- Download Section -->
        <div class="download-section shadow-sm mb-4">
            <ul class="download-list mb-0">
                <li>
                    <i class="bi bi-book"></i>
                    <div class="download-info flex-grow-1">
                        <h5>User Manuals</h5>
                        <p>Comprehensive guides for setup, troubleshooting, and product features.</p>
                        <a href="/AudioHub/downloads/SoundStage-Manuals.zip" class="download-btn d-inline-flex align-items-center mt-2" download>
                            <span class="me-2"><i class="bi bi-download"></i></span> Download Manuals
                        </a>
                    </div>
                </li>
                <li>
                    <i class="bi bi-cpu"></i>
                    <div class="download-info flex-grow-1">
                        <h5>Device Drivers</h5>
                        <p>Latest drivers for Windows and Mac to ensure optimal device performance.</p>
                        <a href="/AudioHub/downloads/SoundStage-Drivers.zip" class="download-btn d-inline-flex align-items-center mt-2" download>
                            <span class="me-2"><i class="bi bi-download"></i></span> Download Drivers
                        </a>
                    </div>
                </li>
                <li>
                    <i class="bi bi-tools"></i>
                    <div class="download-info flex-grow-1">
                        <h5>Firmware Updates</h5>
                        <p>Keep your devices up-to-date with the newest firmware releases.</p>
                        <a href="/AudioHub/downloads/SoundStage-Firmware.zip" class="download-btn d-inline-flex align-items-center mt-2" download>
                            <span class="me-2"><i class="bi bi-download"></i></span> Download Firmware
                        </a>
                    </div>
                </li>
                <li class="mb-0">
                    <i class="bi bi-file-earmark-text"></i>
                    <div class="download-info flex-grow-1">
                        <h5>Product Catalog</h5>
                        <p>Browse our full product lineup and specifications in one PDF.</p>
                        <a href="/AudioHub/downloads/SoundStage-Catalog.pdf" class="download-btn d-inline-flex align-items-center mt-2" target="_blank">
                            <span class="me-2"><i class="bi bi-download"></i></span> View Catalog
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <?php include '../header/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>