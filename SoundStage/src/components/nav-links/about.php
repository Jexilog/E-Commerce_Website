<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/System/SoundStage/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            color: #000000;
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
            color: #003366;
            margin-bottom: 1.5rem;
        }
        .about-intro {
            font-size: 1.15rem;
            color: #000000;
        }
        .about-img-wide {
            width: 100%;
            border-radius: 1.2rem;
            margin: 2rem 0;
            box-shadow: 0 8px 40px 0 rgba(126,203,255,0.10);
            object-fit: cover;
            max-height: 350px;
        }
        .about-quote {
            font-family: 'Georgia', serif;
            font-size: 1.4rem;
            font-style: italic;
            color: #003366;
            margin: 1.5rem 0 0 0 !important;
        }
        .about-quote-author {
            color: #000000;
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        .about-team-title {
            font-size: 2.2rem;
            font-weight: bold;
            color: #003366;
            margin-bottom: 1.2rem;
            letter-spacing: 1px;
        }
        .about-team-desc {
            color: #000000;
        }
        .team-card-bg {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 1rem;
            box-shadow: 0 4px 24px 0 rgba(0,51,102,0.07);
            width: 100%;
            aspect-ratio: 1/1;
            min-height: 120px;
            transition: box-shadow 0.2s, transform 0.2s;
            cursor: pointer;
        }
        .team-card-bg:hover {
            box-shadow: 0 8px 32px 0 rgba(0,51,102,0.18);
            transform: translateY(-6px) scale(1.04);
        }
        .team-info-bg {
            width: 100%;
            background: linear-gradient(0deg,rgba(0,0,0,0.75) 80%,rgba(0,0,0,0.15) 100%);
            color: #fff;
            padding: 1.2rem 1rem 1rem 1rem;
            border-radius: 0 0 1.5rem 1.5rem;
        }
        .team-info-text {
            margin-top: 0.5rem;
            min-height: 56px; /* adjust as needed for 2 lines */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }
        .team-name {
            font-weight: 600;
            font-size: 1rem;
            color: #003366;
            min-height: 28px; /* enough for 1 or 2 lines */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
            word-break: break-word;
        }
        .team-role {
            color: #666;
            font-size: 0.98rem;
            min-height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
        }
        .about-stats {
            margin-top: 2.5rem;
            margin-bottom: 1.5rem;
        }
        .about-stat {
            text-align: center;
        }
        .about-stat-number {
            font-size: 2.2rem;
            font-weight: bold;
            color: #003366;
        }
        .about-stat-label {
            color: #000000;
            font-size: 1rem;
        }
        @media (max-width: 767px) {
            .about-title { font-size: 2rem; }
            .about-team-img { max-width: 90px; height: 90px; }
            .team-card-bg { min-height: 220px; max-width: 100%; }
            .team-info-bg { padding: 0.8rem 0.7rem 0.7rem 0.7rem; }
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
                    SoundStage is a passionate team of audiophiles, engineers, and creators dedicated to bringing the world’s best in-ear monitors and audio gear to the Philippines. Since our founding, we’ve partnered with top brands and built a community where music lovers and professionals can find authentic products, expert advice, and inspiration.
                </div>
                <div class="about-intro">
                    Our journey began with a simple goal: make high-fidelity sound accessible to everyone. Today, SoundStage is trusted by thousands of musicians, producers, and listeners nationwide for our commitment to quality, transparency, and customer care.
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <ul class="list-unstyled mt-2" style="color:#003366;">
                    <li class="mb-2"><strong>About us.</strong></li>
                    <li class="mb-2">Our team.</li>
                    <li class="mb-2">Press.</li>
                </ul>
            </div>
        </div>

        <img src="/System/SoundStage/src/assets/images/team-building.jpg" alt="HzOne Team at Work" class="about-img-wide">

        <div class="about-quote text-center">
            “Our work makes sense only if it is a faithful witness of its time.”
        </div>
        <div class="about-quote-author text-center">
            — Jean-Philippe Nuel, Director
        </div>

        <style>
            /* Fix logo image height and prevent cropping */
            .about-img-wide.h-100 {
            height: 550px !important;
            object-fit: contain !important;
            background: #fff;
            }
        </style>

        <div class="row align-items-center">
            <div class="col-md-6 mb-md-0">
                <img src="/System/SoundStage/src/assets/icons/website-icon.png" alt="HzOne Work" class="about-img-wide h-100">
            </div>
            <div class="col-md-6">
                <div class="about-team-title">THE TEAM.</div>
                <div class="about-team-desc mb-4">
                    Our diverse team combines technical expertise, creative vision, and a shared love for music. We believe in collaboration, innovation, and always putting our customers first.
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex flex-column align-items-center mb-2">
                        <div class="team-card-bg mx-auto" style="background-image: url('/System/SoundStage/src/assets/images/klad.jpg');"></div>
                        <div class="team-info-text text-center w-100 mt-2">
                            <div class="team-name">Kenneth Ladines</div>
                            <div class="team-role">Team Leader</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex flex-column align-items-center mb-2">
                        <div class="team-card-bg mx-auto" style="background-image: url('/System/SoundStage/src/assets/images/carlos.png');"></div>
                        <div class="team-info-text text-center w-100 mt-2">
                            <div class="team-name">Carlos Reyes</div>
                            <div class="team-role">Member</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex flex-column align-items-center mb-2">
                        <div class="team-card-bg mx-auto" style="background-image: url('/System/SoundStage/src/assets/images/rep.jpg');"></div>
                        <div class="team-info-text text-center w-100 mt-2">
                            <div class="team-name">Justine Jeckho Avio</div>
                            <div class="team-role">Member</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex flex-column align-items-center mb-2">
                        <div class="team-card-bg mx-auto" style="background-image: url('/System/SoundStage/src/assets/images/kevin.webp');"></div>
                        <div class="team-info-text text-center w-100 mt-2">
                            <div class="team-name">Keven Lordan</div>
                            <div class="team-role">Member</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex flex-column align-items-center mb-2">
                        <div class="team-card-bg mx-auto" style="background-image: url('/System/SoundStage/src/assets/images/valdo.jpg');"></div>
                        <div class="team-info-text text-center w-100 mt-2">
                            <div class="team-name">Justine Valdez</div>
                            <div class="team-role">Member</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex flex-column align-items-center mb-2">
                        <div class="team-card-bg mx-auto" style="background-image: url('/System/SoundStage/src/assets/images/daddy.webp');"></div>
                        <div class="team-info-text text-center w-100 mt-2">
                            <div class="team-name">Mark David Sun</div>
                            <div class="team-role">Member</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex flex-column align-items-center mb-2">
                        <div class="team-card-bg mx-auto" style="background-image: url('/System/SoundStage/src/assets/images/dustin.webp');"></div>
                        <div class="team-info-text text-center w-100 mt-2">
                            <div class="team-name">Dustin Marquez</div>
                            <div class="team-role">Member</div>
                        </div>
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