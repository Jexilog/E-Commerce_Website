<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Security & Privacy Policy | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/System/SoundStage/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #181c24 0%, #2a3a4f 100%);
            color: #eaf6ff;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }
        .policy-hero {
            background: linear-gradient(120deg, #232b3e 60%, #1a2233 100%);
            border-radius: 1.5rem;
            box-shadow: 0 8px 40px 0 rgba(126,203,255,0.10);
            padding: 2.5rem 2rem 2rem 2rem;
            margin-bottom: 2.5rem;
            text-align: center;
        }
        .policy-hero .bi {
            font-size: 3rem;
            color: #7ecbff;
            margin-bottom: 1rem;
        }
        .policy-hero-title {
            font-size: 2.3rem;
            font-weight: bold;
            color: #7ecbff;
            margin-bottom: 1rem;
            letter-spacing: 1.5px;
        }
        .policy-hero-desc {
            color: #b3c7e6;
            font-size: 1.2rem;
            margin-bottom: 0;
        }
        .policy-main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 1rem 2rem 1rem;
        }
        .policy-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        @media (max-width: 991px) {
            .policy-grid { grid-template-columns: 1fr; }
        }
        .policy-section {
            background: rgba(34, 44, 66, 0.92);
            border-radius: 1.2rem;
            box-shadow: 0 4px 24px rgba(126,203,255,0.07);
            padding: 2rem 2rem 1.5rem 2rem;
            margin-bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            min-height: 260px;
        }
        .policy-section-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.2rem;
        }
        .policy-section-header .bi {
            font-size: 1.7rem;
            color: #7ecbff;
            margin-right: 0.7rem;
        }
        .policy-section-title {
            color: #eaf6ff;
            font-size: 1.3rem;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 0;
        }
        .policy-list {
            color: #b3c7e6;
            margin-bottom: 0;
            padding-left: 1.2rem;
        }
        .policy-list li {
            margin-bottom: 0.5rem;
        }
        .policy-subtitle {
            color: #7ecbff;
            font-size: 1.05rem;
            font-weight: 600;
        }
        .policy-highlight {
            color: #7ecbff;
            font-weight: 500;
        }
        .policy-contact {
            background: #232b3e;
            border-radius: 1.2rem;
            padding: 1.2rem 2rem;
            color: #eaf6ff;
            margin-top: 2.5rem;
            box-shadow: 0 4px 24px rgba(126,203,255,0.07);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .policy-contact .policy-section-header {
            margin-bottom: 0.7rem;
        }
        .policy-contact .bi {
            font-size: 1.3rem;
            color: #7ecbff;
            margin-right: 0.5rem;
        }
        a {
            color: #7ecbff;
            text-decoration: underline;
        }
        a:hover {
            color: #eaf6ff;
        }
        @media (max-width: 767px) {
            .policy-main { padding: 0 0.2rem 2rem 0.2rem; }
            .policy-section-title { font-size: 1.05rem; }
            .policy-section { padding: 1rem 0.5rem; min-height: unset; }
            .policy-contact { padding: 1rem 0.5rem; }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="container policy-main">
        <!-- Hero Section -->
        <div class="policy-hero mt-4 mb-4">
            <div><i class="bi bi-shield-lock"></i></div>
            <div class="policy-hero-title">Security & Privacy Policy</div>
            <div class="policy-hero-desc">
                At <span class="policy-highlight">SoundStage</span>, your privacy and security are our top priorities.<br>
                We are committed to protecting your personal information and ensuring a safe shopping experience.<br>
                This policy explains how we collect, use, store, and protect your data, as well as your rights and choices.
            </div>
        </div>

        <!-- Policy Sections Grid -->
        <div class="policy-grid mb-4">
            <div class="policy-section">
                <div class="policy-section-header">
                    <i class="bi bi-database-lock"></i>
                    <span class="policy-section-title">Information We Collect</span>
                </div>
                <ul class="policy-list">
                    <li><span class="policy-subtitle">Personal Information:</span> Name, email, address, phone, payment details.</li>
                    <li><span class="policy-subtitle">Account Data:</span> Username, encrypted password, order history, preferences.</li>
                    <li><span class="policy-subtitle">Usage Data:</span> Pages visited, products viewed, IP address, browser/device info, cookies.</li>
                </ul>
            </div>
            <div class="policy-section">
                <div class="policy-section-header">
                    <i class="bi bi-gear"></i>
                    <span class="policy-section-title">How We Use Your Information</span>
                </div>
                <ul class="policy-list">
                    <li>To process orders, payments, and deliveries.</li>
                    <li>To provide customer support and respond to inquiries.</li>
                    <li>To personalize your experience and recommend products.</li>
                    <li>To improve our website, services, and security.</li>
                    <li>To send updates, promotions, and newsletters (with your consent).</li>
                </ul>
            </div>
            <div class="policy-section">
                <div class="policy-section-header">
                    <i class="bi bi-shield-check"></i>
                    <span class="policy-section-title">How We Protect Your Data</span>
                </div>
                <ul class="policy-list">
                    <li>All sensitive data is encrypted using SSL/TLS protocols.</li>
                    <li>Passwords are hashed and never stored in plain text.</li>
                    <li>Access to your data is restricted to authorized personnel only.</li>
                    <li>Regular security audits and vulnerability assessments are conducted.</li>
                    <li>We do not sell or rent your personal information to third parties.</li>
                </ul>
            </div>
            <div class="policy-section">
                <div class="policy-section-header">
                    <i class="bi bi-cookie"></i>
                    <span class="policy-section-title">Cookies & Tracking Technologies</span>
                </div>
                <ul class="policy-list">
                    <li>We use cookies to enhance your browsing experience and remember your preferences.</li>
                    <li>Analytics tools help us understand site usage and improve performance.</li>
                    <li>You can manage cookie preferences in your browser settings.</li>
                </ul>
            </div>
            <div class="policy-section">
                <div class="policy-section-header">
                    <i class="bi bi-people"></i>
                    <span class="policy-section-title">Third-Party Services</span>
                </div>
                <ul class="policy-list">
                    <li>We may use trusted third-party providers for payment processing, shipping, and analytics.</li>
                    <li>These providers are contractually obligated to protect your data and comply with privacy laws.</li>
                    <li>Links to external sites are provided for your convenience; we are not responsible for their privacy practices.</li>
                </ul>
            </div>
            <div class="policy-section">
                <div class="policy-section-header">
                    <i class="bi bi-person-check"></i>
                    <span class="policy-section-title">Your Rights & Choices</span>
                </div>
                <ul class="policy-list">
                    <li>Access, update, or delete your personal information at any time via your account dashboard.</li>
                    <li>Opt out of marketing emails by clicking "unsubscribe" in any email or updating your preferences.</li>
                    <li>Request a copy of your data or ask us to erase it by contacting our support team.</li>
                </ul>
            </div>
            <div class="policy-section">
                <div class="policy-section-header">
                    <i class="bi bi-archive"></i>
                    <span class="policy-section-title">Data Retention</span>
                </div>
                <ul class="policy-list">
                    <li>We retain your information only as long as necessary for business, legal, or regulatory purposes.</li>
                    <li>Inactive accounts and associated data are deleted after 2 years of inactivity.</li>
                </ul>
            </div>
            <div class="policy-section">
                <div class="policy-section-header">
                    <i class="bi bi-arrow-repeat"></i>
                    <span class="policy-section-title">Policy Updates</span>
                </div>
                <ul class="policy-list">
                    <li>We may update this policy to reflect changes in our practices or legal requirements.</li>
                    <li>Significant changes will be communicated via email or website notice.</li>
                </ul>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="policy-contact mt-5 mb-2">
            <div class="policy-section-header mb-2">
                <i class="bi bi-envelope"></i>
                <span class="policy-section-title">Contact Us</span>
            </div>
            <p>
                If you have any questions, concerns, or requests regarding your privacy or our security practices, please contact us:
            </p>
            <ul class="policy-list">
                <li><i class="bi bi-envelope"></i>Email: <a href="mailto:support@soundstage.ph">support@soundstage.ph</a></li>
                <li><i class="bi bi-telephone"></i>Phone: <a href="tel:+639123456789">+63 912 345 6789</a></li>
                <li><i class="bi bi-geo-alt"></i>Address: 123 SoundStage Inc. St., Makati City, Philippines</li>
            </ul>
        </div>
    </div>

    <?php include '../header/footer.php'; ?>
</body>
</html>