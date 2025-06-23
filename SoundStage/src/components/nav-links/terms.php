<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Terms & Conditions | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/AudioHub/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f7faff;
            font-family: 'Segoe UI', sans-serif;
            color: #000000;
        }
        .terms-hero {
            background: linear-gradient(90deg, #003366 70%, #00509e 100%);
            color: #fff;
            border-radius: 1.5rem;
            padding: 2.5rem 1.5rem 2rem 1.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 32px 0 rgba(0,51,102,0.10);
            text-align: center;
        }
        .terms-hero h1 {
            font-weight: 700;
            font-size: 2.3rem;
            margin-bottom: 0.7rem;
        }
        .terms-hero p {
            font-size: 1.15rem;
            margin-bottom: 0.2rem;
        }
        .terms-section {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 2px 16px 0 rgba(0,51,102,0.08);
            padding: 2rem 1.5rem;
            margin: 0 auto 2.5rem auto;
            max-width: 900px;
        }
        .terms-section h3 {
            color: #003366;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .terms-section ul, .terms-section ol {
            margin-bottom: 0;
        }
        .terms-section li {
            margin-bottom: 0.7rem;
            color: #222;
        }
        .terms-section p {
            color: #222;
        }
        .contact-terms {
            background: #e3eaf3;
            border-radius: 1.2rem;
            padding: 2rem 1.5rem;
            margin: 0 auto 2.5rem auto;
            max-width: 900px;
            color: #003366;
            text-align: center;
        }
        .contact-terms .btn {
            background: #003366;
            color: #fff;
            border-radius: 2rem;
            padding: 0.6rem 2.2rem;
            font-weight: 600;
            border: none;
            transition: background 0.2s;
        }
        .contact-terms .btn:hover {
            background: #00509e;
        }
        @media (max-width: 767px) {
            .terms-hero {
                padding: 1.5rem 1rem 1rem 1rem;
            }
            .terms-section, .contact-terms {
                padding: 1.2rem 0.7rem;
            }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="container py-4">
        <!-- Hero Section -->
        <div class="terms-hero mt-4">
            <h1><i class="bi bi-file-earmark-text me-2"></i>Terms & Conditions</h1>
            <p>
                Please read these Terms & Conditions carefully before using SoundStage. By accessing or using our website, you agree to be bound by these terms.
            </p>
        </div>

        <!-- Terms Section -->
        <div class="terms-section shadow-sm mb-4">
            <h3>1. Acceptance of Terms</h3>
            <p>By accessing or using SoundStage, you agree to comply with and be bound by these Terms & Conditions and our Privacy Policy.</p>

            <h3>2. Use of the Website</h3>
            <ul>
                <li>You must be at least 18 years old or have parental consent to use this site.</li>
                <li>You agree not to misuse the website or engage in any unlawful activity.</li>
                <li>All content is for personal, non-commercial use unless otherwise stated.</li>
            </ul>

            <h3>3. Orders & Payments</h3>
            <ul>
                <li>All orders are subject to acceptance and availability.</li>
                <li>Prices and product details may change without notice.</li>
                <li>Payments must be made through our secure payment methods.</li>
            </ul>

            <h3>4. Returns & Exchanges</h3>
            <ul>
                <li>Returns are accepted within 30 days of delivery, subject to our <a href="return.php" style="color:#00509e;">Return Policy</a>.</li>
                <li>Items must be unused and in original packaging for a refund or exchange.</li>
            </ul>

            <h3>5. Intellectual Property</h3>
            <ul>
                <li>All content, logos, images, and trademarks are the property of SoundStage or its partners.</li>
                <li>You may not use, reproduce, or distribute any content without written permission.</li>
            </ul>

            <h3>6. Limitation of Liability</h3>
            <ul>
                <li>SoundStage is not liable for any indirect, incidental, or consequential damages arising from your use of the site.</li>
                <li>We do our best to ensure accuracy, but do not guarantee the completeness of information.</li>
            </ul>

            <h3>7. Changes to Terms</h3>
            <p>We reserve the right to update these Terms & Conditions at any time. Changes will be posted on this page.</p>

            <h3>8. Contact Us</h3>
            <p>If you have any questions about these Terms & Conditions, please contact us below.</p>
        </div>

        <!-- Contact Section -->
        <div class="contact-terms shadow-sm mb-4">
            <h4><i class="bi bi-envelope"></i> Need Assistance?</h4>
            <p>Our support team is here to help you with any questions regarding our terms and policies.</p>
            <a href="mailto:support@soundstage.com" class="btn mt-2"><i class="bi bi-envelope"></i> support@soundstage.com</a>
            <div class="mt-3">
                <span><i class="bi bi-telephone"></i> +63 912 345 6789</span>
            </div>
        </div>
    </div>

    <?php include '../header/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>