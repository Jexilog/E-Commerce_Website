<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/System/SoundStage/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            color: #000;
            font-family: 'Segoe UI', sans-serif;
        }
        .contact-main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 3rem 1rem 2rem 1rem;
        }
        .contact-hero {
            background: #003366;
            border-radius: 1.5rem;
            box-shadow: 0 8px 40px 0 rgba(126,203,255,0.10);
            padding: 2.5rem 2rem 2rem 2rem;
            margin-bottom: 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .contact-hero-title {
            font-size: 2.7rem;
            font-weight: bold;
            color: #eaf6ff;
            letter-spacing: 1.5px;
        }
        .contact-hero-highlight {
            color: #7ecbff;
        }
        .contact-hero-desc {
            color: #b3c7e6;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .contact-section-title {
            color: #003366;
            font-size: 1.7rem;
            font-weight: bold;
            margin-bottom: 1.2rem;
            letter-spacing: 1px;
        }
        .contact-section-desc {
            color: #003366;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }
        .contact-info-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2.5rem;
        }
        .contact-info-card {
            background: #003366;
            border-radius: 1.2rem;
            padding: 1.5rem 1.2rem;
            color: #eaf6ff;
            box-shadow: 0 4px 24px rgba(126,203,255,0.07);
            flex: 1 1 250px;
            min-width: 220px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .contact-info-card:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 12px 36px 0 rgba(126,203,255,0.13);
        }
        .contact-info-icon {
            font-size: 2.5rem;
            color: #7ecbff;
            margin-bottom: 1rem;
        }
        .contact-info-title {
            font-weight: bold;
            font-size: 1.15rem;
            margin-bottom: 0.5rem;
            color: #eaf6ff;
        }
        .contact-info-desc {
            color: #b3c7e6;
            font-size: 1rem;
        }
        .contact-map-section {
            background: #003366;
            border-radius: 1.2rem;
            padding: 1.5rem 2rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 24px rgba(126,203,255,0.07);
        }
        .contact-map-title {
            color: #7ecbff;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .contact-form-section {
            background: #003366;
            border-radius: 1.2rem;
            padding: 2rem 2.5rem;
            color: #eaf6ff;
            margin-top: 2.5rem;
            box-shadow: 0 4px 24px rgba(126,203,255,0.07);
        }
        .form-label {
            color: #7ecbff;
            font-weight: 500;
        }
        .form-control, .form-select {
            background: #181c24;
            color: #eaf6ff;
            border: 1px solid #2a3a4f;
        }
        .form-control:focus, .form-select:focus {
            border-color: #7ecbff;
            box-shadow: 0 0 0 0.2rem rgba(126,203,255,0.15);
        }
        .contact-social {
            margin-top: 2.5rem;
            text-align: center;
        }
        .contact-social a {
            color: #003366;
            margin: 0 1rem;
            font-size: 2rem;
            transition: color 0.2s;
        }
        .contact-social a:hover {
            color: #eaf6ff;
        }
        @media (max-width: 991px) {
            .contact-hero-title { font-size: 2rem; }
            .contact-info-cards { flex-direction: column; gap: 1.2rem; }
        }
        @media (max-width: 767px) {
            .contact-main { padding: 1.2rem 0.2rem 2rem 0.2rem; }
            .contact-section-title { font-size: 1.2rem; }
            .contact-form-section { padding: 1rem 0.5rem; }
            .contact-map-section { padding: 1rem 0.5rem; }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="contact-main">
        <!-- Hero Section -->
        <div class="contact-hero mb-5">
            <div class="contact-hero-title">
                <span class="contact-hero-highlight">Contact</span> SoundStage
            </div>
            <div class="contact-hero-desc">
                We’d love to hear from you! Whether you have a question about our products, need support, want to partner, or just want to say hello—our team is ready to help.
            </div>
        </div>

        <!-- Contact Info Cards -->
        <div class="contact-section-title text-center"><i class="bi bi-info-circle"></i> Get in Touch</div>
        <div class="contact-section-desc text-center mb-4">
            Reach us through any of the channels below. We aim to respond within 24 hours on business days.
        </div>
        <div class="contact-info-cards">
            <div class="contact-info-card">
                <div class="contact-info-icon"><i class="bi bi-envelope"></i></div>
                <div class="contact-info-title">Email</div>
                <div class="contact-info-desc">
                    <a href="mailto:support@soundstage.ph" style="color:#7ecbff;">support@SoundStage.ph</a>
                </div>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon"><i class="bi bi-telephone"></i></div>
                <div class="contact-info-title">Phone</div>
                <div class="contact-info-desc">
                    <a href="tel:+639123456789" style="color:#7ecbff;">+63 912 345 6789</a>
                </div>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon"><i class="bi bi-geo-alt"></i></div>
                <div class="contact-info-title">Visit Us</div>
                <div class="contact-info-desc">
                    123 SoundStage Inc. St., Makati City, Philippines
                </div>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon"><i class="bi bi-clock"></i></div>
                <div class="contact-info-title">Hours</div>
                <div class="contact-info-desc">
                    Mon–Fri: 9:00am – 6:00pm<br>Sat: 10:00am – 4:00pm<br>Sun & Holidays: Closed
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="contact-map-section mb-5">
            <div class="contact-map-title"><i class="bi bi-map"></i> Find Us on the Map</div>
            <div class="ratio ratio-16x9 rounded-4 shadow" style="overflow:hidden;">
                <iframe src="https://www.google.com/maps?q=Makati+City,+Philippines&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-section-title text-center" id="contact-form"><i class="bi bi-chat-dots"></i> Send Us a Message</div>
        <div class="contact-form-section">
            <form method="post" action="#">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-md-6">
                        <label for="subject" class="form-label">Subject *</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="col-12">
                        <label for="message" class="form-label">Message *</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required placeholder="How can we help you?"></textarea>
                    </div>
                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn join-btn px-5" style="background:#7ecbff; color:#181c24; border:none;">Send Message</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Social Media -->
        <div class="contact-social mt-5">
            <span class="contact-section-title" style="font-size:1.2rem;"><i class="bi bi-share"></i> Connect with Us</span>
            <div class="mt-2">
                <a href="https://facebook.com/SoundStageph" target="_blank" title="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://instagram.com/SoundStageph" target="_blank" title="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="https://twitter.com/SoundStageph" target="_blank" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="https://youtube.com/@SoundStageph" target="_blank" title="YouTube"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div>

    <?php include '../header/footer.php'; ?>
</body>
</html>