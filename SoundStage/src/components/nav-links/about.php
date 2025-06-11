<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us | HzOne</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/AudioHub/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #181c24 0%, #2a3a4f 100%);
            color: #eaf6ff;
            font-family: 'Segoe UI', sans-serif;
        }
        .about-main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 3rem 1rem 2rem 1rem;
        }
        .about-title {
            font-size: 3rem;
            font-weight: bold;
            letter-spacing: 1px;
            color: #7ecbff;
            margin-bottom: 1.5rem;
        }
        .about-intro {
            font-size: 1.15rem;
            color: #b3c7e6;
            margin-bottom: 2rem;
        }
        .about-img-wide {
            width: 100%;
            border-radius: 1.2rem;
            margin: 2.5rem 0;
            box-shadow: 0 8px 40px 0 rgba(126,203,255,0.10);
            object-fit: cover;
            max-height: 350px;
        }
        .about-quote {
            font-family: 'Georgia', serif;
            font-size: 1.4rem;
            font-style: italic;
            color: #7ecbff;
            margin: 2.5rem 0 1.5rem 0;
        }
        .about-quote-author {
            color: #b3c7e6;
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        .about-team-title {
            font-size: 2.2rem;
            font-weight: bold;
            color: #7ecbff;
            margin-bottom: 1.2rem;
            letter-spacing: 1px;
        }
        .about-team-desc {
            color: #b3c7e6;
            margin-bottom: 2rem;
        }
        .about-team-img {
            width: 100%;
            max-width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 1rem;
            margin-bottom: 0.7rem;
            border: 3px solid #2a3a4f;
            background: #232b3e;
        }
        .about-team-member {
            text-align: center;
            margin-bottom: 2rem;
        }
        .about-team-name {
            font-weight: 600;
            color: #eaf6ff;
            margin-bottom: 0.2rem;
        }
        .about-team-role {
            color: #7ecbff;
            font-size: 0.95rem;
        }
        .about-stats {
            margin-top: 2.5rem;
            margin-bottom: 1.5rem;
        }
        .about-stat {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .about-stat-number {
            font-size: 2.2rem;
            font-weight: bold;
            color: #7ecbff;
        }
        .about-stat-label {
            color: #b3c7e6;
            font-size: 1rem;
        }
        @media (max-width: 767px) {
            .about-title { font-size: 2rem; }
            .about-team-img { max-width: 90px; height: 90px; }
        }
    </style>
</head>
<body>
    
    <?php include '../header/header.php'; ?>

    <div class="about-main">
        <div class="row">
            <div class="col-lg-8">
                <div class="about-title">ABOUT US.</div>
                <div class="about-intro">
                    HzOne is a passionate team of audiophiles, engineers, and creators dedicated to bringing the world’s best in-ear monitors and audio gear to the Philippines. Since our founding, we’ve partnered with top brands and built a community where music lovers and professionals can find authentic products, expert advice, and inspiration.
                </div>
                <div class="about-intro">
                    Our journey began with a simple goal: make high-fidelity sound accessible to everyone. Today, HzOne is trusted by thousands of musicians, producers, and listeners nationwide for our commitment to quality, transparency, and customer care.
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <ul class="list-unstyled mt-2" style="color:#b3c7e6;">
                    <li class="mb-2"><strong>About us.</strong></li>
                    <li class="mb-2">Our team.</li>
                    <li class="mb-2">Press.</li>
                </ul>
            </div>
        </div>

        <img src="/AudioHub/src/assets/images/team-building.jpg" alt="HzOne Team at Work" class="about-img-wide">

        <div class="about-quote text-center">
            “Our work makes sense only if it is a faithful witness of its time.”
        </div>
        <div class="about-quote-author text-center">
            — Jean-Philippe Nuel, Director
        </div>

        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="/AudioHub/src/assets/images/iem-logo.jpg" alt="HzOne Work" class="about-img-wide">
            </div>
            <div class="col-md-6">
                <div class="about-team-title">THE TEAM.</div>
                <div class="about-team-desc">
                    Our diverse team combines technical expertise, creative vision, and a shared love for music. We believe in collaboration, innovation, and always putting our customers first.
                </div>
                <div class="row">
                    <div class="col-6 col-sm-4 about-team-member">
                        <img src="/AudioHub/src/assets/images/carlos.png" alt="Team Member" class="about-team-img">
                        <div class="about-team-name">Carlos Reyes</div>
                        <div class="about-team-role">Founder & CEO</div>
                    </div>
                    <div class="col-6 col-sm-4 about-team-member">
                        <img src="/AudioHub/src/assets/images/klad.jpg" alt="Team Member" class="about-team-img">
                        <div class="about-team-name">Kenneth Ladines</div>
                        <div class="about-team-role">Product Leader</div>
                    </div>
                    <div class="col-6 col-sm-4 about-team-member">
                        <img src="/AudioHub/src/assets/images/rep.jpg" alt="Team Member" class="about-team-img">
                        <div class="about-team-name">Justine Jeckho Avio</div>
                        <div class="about-team-role">Taga Lulu</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="about-stats row mt-4">
            <div class="col-6 col-md-3 about-stat">
                <div class="about-stat-number">5K+</div>
                <div class="about-stat-label">Happy Customers</div>
            </div>
            <div class="col-6 col-md-3 about-stat">
                <div class="about-stat-number">20+</div>
                <div class="about-stat-label">Top Audio Brands</div>
            </div>
            <div class="col-6 col-md-3 about-stat">
                <div class="about-stat-number">1.2M</div>
                <div class="about-stat-label">Products Shipped</div>
            </div>
            <div class="col-6 col-md-3 about-stat">
                <div class="about-stat-number">99%</div>
                <div class="about-stat-label">Customer Satisfaction</div>
            </div>
        </div>
    </div>

    <?php include '../header/footer.php'; ?>
</body>
</html>