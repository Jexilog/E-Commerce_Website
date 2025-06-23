<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Press & Media | SoundStage</title>
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
        .press-hero {
            background: #003366;
            color: #fff;
            border-radius: 1.5rem;
            padding: 2.5rem 1.5rem 2rem 1.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 32px 0 rgba(0,51,102,0.10);
            text-align: center;
        }
        .press-hero h1 {
            font-weight: 700;
            font-size: 2.3rem;
            margin-bottom: 0.7rem;
        }
        .press-hero p {
            font-size: 1.15rem;
            margin-bottom: 0.2rem;
        }
        .media-kit-section {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 2px 16px 0 rgba(0,51,102,0.08);
            padding: 2rem 1.5rem;
            margin: 0 auto 2.5rem auto;
            max-width: 900px;
        }
        .media-kit-section h3 {
            color: #003366;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .media-kit-list {
            list-style: none;
            padding-left: 0;
        }
        .media-kit-list li {
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .media-kit-list i {
            font-size: 1.5rem;
            color: #00509e;
        }
        .news-section {
            margin: 0 auto 3rem auto;
            max-width: 900px;
        }
        .news-title {
            font-size: 1.35rem;
            font-weight: 600;
            color: #003366;
            margin-bottom: 1.2rem;
            text-align: center;
        }
        .news-card {
            background: #e3eaf3;
            border-radius: 1.2rem;
            box-shadow: 0 2px 8px 0 rgba(0,51,102,0.07);
            padding: 1.5rem 1.2rem;
            margin-bottom: 1.5rem;
        }
        .news-card h5 {
            color: #003366;
            font-weight: 600;
        }
        .news-card .date {
            color: #00509e;
            font-size: 0.98rem;
            margin-bottom: 0.5rem;
        }
        .contact-press {
            background: #e3eaf3;
            border-radius: 1.2rem;
            padding: 2rem 1.5rem;
            margin: 0 auto 2.5rem auto;
            max-width: 900px;
            color: #003366;
            text-align: center;
        }
        .contact-press h4 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #003366;
        }
        .contact-press .btn {
            background: #003366;
            color: #fff;
            border-radius: 2rem;
            padding: 0.6rem 2.2rem;
            font-weight: 600;
            border: none;
            transition: background 0.2s;
        }
        .contact-press .btn:hover {
            background: #00509e;
        }
        @media (max-width: 767px) {
            .press-hero {
                padding: 1.5rem 1rem 1rem 1rem;
            }
            .media-kit-section, .news-section, .contact-press {
                padding: 1.2rem 0.7rem;
            }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="container py-4">
        <!-- Hero Section -->
        <div class="press-hero mt-4">
            <h1><i class="bi bi-megaphone me-2"></i>Press & Media</h1>
            <p>Welcome to the SoundStage Press & Media page. Access our latest news, official assets, and contact details for media inquiries.</p>
        </div>

        <!-- Media Kit Section -->
        <div class="media-kit-section shadow-sm mb-4">
            <h3><i class="bi bi-archive"></i> Media Kit & Brand Assets</h3>
            <ul class="media-kit-list">
                <li>
                    <i class="bi bi-image"></i>
                    <div>
                        <b>Logos & Brand Guide</b><br>
                        <a href="/AudioHub/media/SoundStage-Logo.zip" class="link-primary" download>Download Logos</a> &nbsp;|&nbsp;
                        <a href="/AudioHub/media/SoundStage-BrandGuide.pdf" class="link-primary" target="_blank">View Brand Guide</a>
                    </div>
                </li>
                <li>
                    <i class="bi bi-camera-video"></i>
                    <div>
                        <b>Product Photos</b><br>
                        <a href="/AudioHub/media/Product-Photos.zip" class="link-primary" download>Download Product Images</a>
                    </div>
                </li>
                <li>
                    <i class="bi bi-file-earmark-text"></i>
                    <div>
                        <b>Press Releases</b><br>
                        <a href="/AudioHub/media/PressRelease-June2025.pdf" class="link-primary" target="_blank">Latest Release (June 2025)</a>
                    </div>
                </li>
            </ul>
        </div>

        <!-- News Section -->
        <div class="news-section">
            <div class="news-title">
                <i class="bi bi-newspaper"></i> Latest News & Features
            </div>
            <div class="news-card">
                <div class="date"><i class="bi bi-calendar-event"></i> June 1, 2025</div>
                <h5>SoundStage Launches Flagship Store in Manila</h5>
                <p>
                    We’re excited to announce the grand opening of our flagship store in Manila, offering the latest in audio technology and exclusive in-store experiences.
                </p>
            </div>
            <div class="news-card">
                <div class="date"><i class="bi bi-calendar-event"></i> May 15, 2025</div>
                <h5>SoundStage Partners with Top Audio Brands</h5>
                <p>
                    Our new partnerships bring more authentic, high-quality audio products to the Philippines, all backed by our authenticity guarantee.
                </p>
            </div>
            <div class="news-card">
                <div class="date"><i class="bi bi-calendar-event"></i> April 10, 2025</div>
                <h5>Featured in TechPH Magazine</h5>
                <p>
                    SoundStage was featured in TechPH Magazine’s “Best Online Audio Stores 2025.” Read the full article <a href="https://techphmag.com/soundstage-feature" class="link-primary" target="_blank">here</a>.
                </p>
            </div>
        </div>

        <!-- Contact Press Section -->
        <div class="contact-press shadow-sm mb-4">
            <h4><i class="bi bi-envelope"></i> Media Inquiries</h4>
            <p>For interviews, press releases, or collaborations, please contact our media team.</p>
            <a href="mailto:media@soundstage.com" class="btn mt-2"><i class="bi bi-envelope"></i> media@soundstage.com</a>
            <div class="mt-3">
                <span><i class="bi bi-telephone"></i> +63 912 345 6789</span>
            </div>
        </div>
    </div>

    <?php include '../header/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>