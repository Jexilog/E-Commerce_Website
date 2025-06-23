<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Intellectual Property Protection | SoundStage</title>
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
        .ipp-hero {
            background: #003366;
            color: #fff;
            border-radius: 1.5rem;
            padding: 2.5rem 1.5rem 2rem 1.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 32px 0 rgba(0,51,102,0.10);
            text-align: center;
        }
        .ipp-hero h1 {
            font-weight: 700;
            font-size: 2.3rem;
            margin-bottom: 0.7rem;
        }
        .ipp-hero p {
            font-size: 1.15rem;
            margin-bottom: 0.2rem;
        }
        .ipp-section {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 2px 16px 0 rgba(0,51,102,0.08);
            padding: 2rem 1.5rem;
            margin: 0 auto 2.5rem auto;
            max-width: 900px;
        }
        .ipp-section h3 {
            color: #003366;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .ipp-section ul {
            margin-bottom: 0;
        }
        .ipp-section li {
            margin-bottom: 0.7rem;
            color: #222;
        }
        .report-section {
            background: #e3eaf3;
            border-radius: 1.2rem;
            padding: 2rem 1.5rem;
            margin: 0 auto 2.5rem auto;
            max-width: 900px;
            color: #003366;
            text-align: center;
        }
        .report-section h4 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #003366;
        }
        .report-section .btn {
            background: #003366;
            color: #fff;
            border-radius: 2rem;
            padding: 0.6rem 2.2rem;
            font-weight: 600;
            border: none;
            transition: background 0.2s;
        }
        .report-section .btn:hover {
            background: #00509e;
        }
        @media (max-width: 767px) {
            .ipp-hero {
                padding: 1.5rem 1rem 1rem 1rem;
            }
            .ipp-section, .report-section {
                padding: 1.2rem 0.7rem;
            }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="container py-4">
        <!-- Hero Section -->
        <div class="ipp-hero mt-4">
            <h1><i class="bi bi-shield-lock me-2"></i>Intellectual Property Protection</h1>
            <p>
                SoundStage is committed to protecting intellectual property rights and respecting the creativity and innovation of all brands, creators, and partners.
            </p>
        </div>

        <!-- IP Policy Section -->
        <div class="ipp-section shadow-sm mb-4">
            <h3><i class="bi bi-info-circle"></i> Our Commitment</h3>
            <ul>
                <li>
                    <b>Authenticity Guarantee:</b> All products sold on SoundStage are 100% authentic and sourced from authorized distributors and brands.
                </li>
                <li>
                    <b>Respect for IP:</b> We do not allow the sale of counterfeit, pirated, or unauthorized replicas of any product.
                </li>
                <li>
                    <b>Copyright & Trademarks:</b> All logos, images, product names, and content on this site are protected by copyright and trademark laws.
                </li>
                <li>
                    <b>Third-Party Content:</b> Any third-party trademarks or content are used with permission or under fair use.
                </li>
                <li>
                    <b>Reporting Violations:</b> We take IP violations seriously. If you believe your rights have been infringed, please contact us immediately.
                </li>
            </ul>
        </div>

        <!-- How to Report Section -->
        <div class="report-section shadow-sm mb-4">
            <h4><i class="bi bi-flag"></i> Report Intellectual Property Infringement</h4>
            <p>
                If you are a rights holder or authorized agent and believe that content or products on SoundStage infringe your intellectual property, please contact us with the following details:
            </p>
            <ul class="text-start mx-auto" style="max-width:600px;">
                <li>Your name and contact information</li>
                <li>Proof of ownership or authorization</li>
                <li>Details and links to the infringing content or product</li>
                <li>A statement of good faith regarding your claim</li>
            </ul>
            <a href="mailto:ip@soundstage.com" class="btn mt-3"><i class="bi bi-envelope"></i> ip@soundstage.com</a>
            <div class="mt-3">
                <span><i class="bi bi-telephone"></i> +63 912 345 6789</span>
            </div>
        </div>
    </div>

    <?php include '../header/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>