<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../src/assets/icons/website-icon.png" type="image/x-icon">
    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            color: #000000;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        body .text-muted {
            color: #ffffff !important;
        }
        .navbar {
            background: #1a2233 !important;
            border-bottom: 1px solid #2e3a4d;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            letter-spacing: 1.5px;
            color: #7ecbff !important;
        }
        .nav-link, .navbar-nav .nav-link.active {
            color: #eaf6ff !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #7ecbff !important;
        }
        .btn-primary, .btn-outline-primary {
            background: #7ecbff;
            border-color: #7ecbff;
            color: #181c24;
        }
        .btn-outline-primary:hover, .btn-primary:hover {
            background: #4fa3e3;
            border-color: #4fa3e3;
            color: #fff;
        }
        .hero-section {
            background: #ffffff;
            padding: 0;
            min-height: 520px;
        }
        .carousel-inner {
            min-height: 450px;
        }
        .carousel-item {
            min-height: 450px;
            background-size: cover;
            background-position: center;
            border-radius: 2rem;
            display: flex;
            align-items: center;
        }
        .carousel-overlay {
            background: rgba(0, 34, 66, 0.60);
            border-radius: 2rem;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0; left: 0;
            z-index: 1;
            pointer-events: none;
        }
        .carousel-control-prev,
        .carousel-control-next {
            z-index: 2 !important;
        }
        .carousel-content {
            position: relative;
            z-index: 2;
            width: 100%;
        }
        .hero-title {
            font-size: 2.7rem;
            font-weight: bold;
            color: #eaf6ff;
            letter-spacing: 1.5px;
        }
        .hero-highlight {
            color: #7ecbff;
        }
        .hero-desc {
            color: #b3c7e6;
            font-size: 1.2rem;
        }
        .hero-img {
            max-width: 420px;
            width: 90%;
            margin: 2rem auto 0 auto;
            display: block;
            border-radius: 1.5rem;
            box-shadow: 0 8px 40px 0 rgba(126,203,255,0.10);
        }
        .partners-bar {
            display: flex;
            justify-content: center;
            align-items: center; /* Center vertically */
            width: 100%;
            background: #ffffff;
            padding: 1.5rem 0;
            border-radius: 1rem;
            margin: 2rem auto;
            box-shadow: 0 2px 16px rgba(35, 37, 37, 0.08);
            color: #eaf6ff; /* Ensure text is readable */
        }
        .partners-bar img {
            max-height: 30px; /* Increased height */
            margin: 0 2rem;
            opacity: 0.92;
            filter: grayscale(0.2) brightness(1.2) drop-shadow(0 2px 8px #7ecbff33);
            transition: transform 0.2s, filter 0.2s;
            background: transparent;
        }
        .partners-bar img:hover {
            transform: scale(1.08);
            filter: grayscale(0) brightness(1.3) drop-shadow(0 4px 16px #7ecbff55);
        }
        .section-title {
            color: #000000;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
        }
        .feature-card {
            background: #003366;
            border-radius: 1.2rem;
            padding: 1rem 1.5rem;
            color: #ffffff;
            box-shadow: 0 4px 24px rgba(126,203,255,0.07);
            margin-bottom: 1rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .feature-card:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 12px 36px 0 rgba(126,203,255,0.13);
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #7ecbff;
            margin-bottom: 1rem;
        }
        .data-visual {
            background: #232b3e;
            border-radius: 1.2rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 24px rgba(126,203,255,0.07);
        }
        .footer {
            background: #181c24;
            color: #b3c7e6;
            padding: 2rem 0 1rem 0;
            border-top: 1px solid #232b3e;
        }
        .footer a {
            color: #7ecbff;
            text-decoration: none;
        }
        .footer a:hover {
            color: #eaf6ff;
            text-decoration: underline;
        }
        .footer .social a {
            color: #7ecbff;
            margin-right: 1rem;
            font-size: 1.5rem;
        }

        /* Featured IEMs Modern Card Style */
        .iem-card {
            background: #003366;
            border-radius: 2rem;
            padding: 2.2rem 1.5rem 1.5rem 1.5rem;
            position: relative;
            min-height: 220px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 8px 40px 0 rgba(126,203,255,0.10);
            transition: transform 0.18s, box-shadow 0.18s;
        }
        .iem-card:hover {
            transform: translateY(-8px) scale(1);
            box-shadow: 0 16px 48px 0 rgba(126,203,255,0.18);
        }
        .iem-img-wrap {
            width: 170px;
            height: 140px;
            margin: -60px auto 1.2rem auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            position: relative;
            z-index: 2;
        }
        .iem-img {
            width: 150px;
            height: 150px;
            object-fit: contain;
            border-radius: 1.2rem;
            box-shadow: 0 8px 32px 0 rgba(126,203,255,0.13);
            background: #232b3e;
            transition: transform 0.18s;
        }
        .iem-card:hover .iem-img {
            transform: scale(1) rotate(-3deg);
            box-shadow: 0 16px 48px 0 rgba(126,203,255,0.22);
        }
        .iem-card-body {
            padding-top: 0.5rem;
        }
        .iem-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #eaf6ff;
            margin-bottom: 0.2rem;
        }
        .iem-price {
            color: #7ecbff;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.7rem;
        }
        .iem-desc {
            color: #b3c7e6;
            font-size: 1rem;
            margin-bottom: auto;
        }
        .iem-btn {
            background: #7ecbff !important;
            color: #181c24 !important;
            font-weight: 600;
            border-radius: 1.2rem;
            padding: 0.5rem 2rem;
            box-shadow: 0 2px 12px 0 rgba(126,203,255,0.10);
            border: none;
            transition: background 0.18s, color 0.18s;
        }
        .iem-btn:hover {
            background: #4fa3e3 !important;
            color: #ffffff !important;
        }
        @media (max-width: 991px) {
            .hero-title { font-size: 2rem; }
            .hero-img { max-width: 300px; }
            .iem-card { min-height: 380px; padding: 1.5rem 0.7rem 1.2rem 0.7rem; }
            .iem-img-wrap { width: 120px; height: 80px; margin-top: -50px; }
            .iem-img { width: 120px; height: 80px; }
        }
        @media (max-width: 767px) {
            .iem-card { min-height: 340px; }
            .iem-img-wrap { width: 90px; height: 60px; margin-top: -35px; }
            .iem-img { width: 90px; height: 60px; }
        }
    </style>
</head>
<body>
    <!-- Header/Navbar -->
    <?php include 'components/header/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center" style="min-height: 520px;">
        <div class="container">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded-4 shadow-lg" style="background: #003366;">
                    <!-- Slide 1 -->
                    <div class="carousel-item active" style="background-image: url('../src/assets/images/iem.JPG');">
                        <div class="carousel-overlay"></div>
                        <div class="carousel-content">
                            <div class="row align-items-center py-5 px-5">
                                <div class="col-md-7 text-md-start text-center">
                                    <h1 class="hero-title mb-3 mt-4">
                                        <span class="hero-highlight">Unleash</span> Studio Sound<br>
                                        In Your Pocket
                                    </h1>
                                    <p class="hero-desc mb-4">
                                        Experience the clarity and detail of premium IEMs.<br>
                                        Perfect for audiophiles, musicians, and everyday listeners.
                                    </p>
                                    <a href="#" class="btn btn-primary btn-lg px-4 me-2 mb-2">Shop Now</a>
                                    <a href="#" class="btn btn-outline-primary btn-lg px-4 mb-2">Explore Brands</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item" style="background-image: url('../src/assets/images/carousel-slide2.webp');">
                        <div class="carousel-overlay"></div>
                        <div class="carousel-content">
                            <div class="row align-items-center py-5 px-5">
                                <div class="col-md-7 text-md-start text-center">
                                    <h1 class="hero-title mb-3 mt-4">
                                        <span class="hero-highlight">Compare</span> Frequency<br>
                                        Like a Pro
                                    </h1>
                                    <p class="hero-desc mb-4">
                                        Visualize and compare IEM frequency responses.<br>
                                        Find your perfect sound signature with HzOne.
                                    </p>
                                    <a href="#" class="btn btn-primary btn-lg px-4 me-2 mb-2">Try Visualizer</a>
                                    <a href="#" class="btn btn-outline-primary btn-lg px-4 mb-2">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-item" style="background-image: url('../src/assets/images/carousel-slide3.webp');">
                        <div class="carousel-overlay"></div>
                        <div class="carousel-content">
                            <div class="row align-items-center py-5 px-5">
                                <div class="col-md-7 text-md-start text-center">
                                    <h1 class="hero-title mb-3 mt-4">
                                        <span class="hero-highlight">Mobile</span> Shopping<br>
                                        For IEM Lovers
                                    </h1>
                                    <p class="hero-desc mb-4">
                                        Browse, compare, and buy IEMs on any device.<br>
                                        Your next upgrade is just a tap away.
                                    </p>
                                    <a href="#" class="btn btn-primary btn-lg px-4 me-2 mb-2">Get the App</a>
                                    <a href="#" class="btn btn-outline-primary btn-lg px-4 mb-2">Browse IEMs</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <!-- Carousel Indicators -->
                <div class="carousel-indicators mb-0">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners/Brands Bar -->
    <div class="container partners-bar text-center">
        <img src="../src/assets/icons/shure.avif" alt="Shure">
        <img src="../src/assets/icons/sennheiser.svg" alt="Sennheiser">
        <img src="../src/assets/icons/audio-technica.png" alt="Audio-Technica">
        <img src="../src/assets/icons/FiiO.png" alt="FiiO">
        <img src="../src/assets/icons/moon.png" alt="Moondrop">
    </div>

    <!-- What We Do Section (Replaced with "How It Works") -->
    <section class="container my-5">
        <h2 class="section-title"><i class="bi bi-lightning-charge"></i> How SoundStage Works</h2>
        <div class="divider mb-3"><hr></div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="feature-card text-center h-100">
                    <div class="feature-icon mb-2 mt-2"><i class="bi bi-search"></i></div>
                    <h5>1. Discover</h5>
                    <p class="text-muted">Browse our curated collection of IEMs and accessories. Use advanced filters to find the perfect match for your sound preference and budget.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center h-100">
                    <div class="feature-icon mb-2 mt-2"><i class="bi bi-cart-check"></i></div>
                    <h5>2. Shop Securely</h5>
                    <p class="text-muted">Add your favorite IEMs to cart and enjoy a seamless, secure checkout experience. Multiple payment options and fast shipping available.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center h-100">
                    <div class="feature-icon mb-2 mt-2"><i class="bi bi-headphones"></i></div>
                    <h5>3. Enjoy Your Music</h5>
                    <p class="text-muted">Receive your new gear at your doorstep and experience music like never before. Share your reviews and join our audiophile community!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured IEMs Section (Modern Card Style) -->
    <section class="container my-5">
        <h2 class="section-title"><i class="bi bi-stars"></i> Featured IEMs</h2>
        <div class="divider mb-5"><hr></div>
        <div class="row g-5 justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="iem-card shadow-lg position-relative mx-auto" style="max-width:340px;">
                    <div class="iem-img-wrap">
                        <img src="../src/assets/iems/moondrop/moondrop-blessing-3.jpg" alt="Moondrop Blessing 3" class="iem-img">
                    </div>
                    <div class="iem-card-body text-center">
                        <div class="iem-title">Moondrop Blessing 3</div>
                        <div class="iem-price">₱19,990</div>
                        <div class="iem-desc">Hybrid driver IEM with reference-grade tuning for audiophiles and musicians.</div>
                        <a href="#" class="btn iem-btn mt-3">Buy Now</a>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="iem-card shadow-lg position-relative mx-auto" style="max-width:340px;">
                    <div class="iem-img-wrap">
                        <img src="../src/assets/images/shure-se846.jpg" alt="Shure SE846" class="iem-img">
                    </div>
                    <div class="iem-card-body text-center">
                        <div class="iem-title">Shure SE846</div>
                        <div class="iem-price">₱44,990</div>
                        <div class="iem-desc">Quad-driver IEM for professional monitoring and stage performance.</div>
                        <a href="#" class="btn iem-btn mt-3">Buy Now</a>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="iem-card shadow-lg position-relative mx-auto" style="max-width:340px;">
                    <div class="iem-img-wrap">
                        <img src="../src/assets/images/sennheiser-ie900.webp" alt="Sennheiser IE 900" class="iem-img">
                    </div>
                    <div class="iem-card-body text-center">
                        <div class="iem-title">Sennheiser IE 900</div>
                        <div class="iem-price">₱69,990</div>
                        <div class="iem-desc">Flagship dynamic driver IEM with ultra-low distortion and premium build.</div>
                        <a href="#" class="btn iem-btn mt-3">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Replaced with "Why Shop With Us -->
    <section class="container my-5">
        <h2 class="section-title"><i class="bi bi-gem"></i> Why Shop With SoundStage?</h2>
        <div class="divider mb-3"><hr></div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <div class="feature-card text-center h-100">
                    <div class="feature-icon mb-2 p-2"><i class="bi bi-truck"></i></div>
                    <h6>Fast & Secure Shipping</h6>
                    <p class="text-muted">Get your IEMs delivered quickly and safely, wherever you are in the Philippines.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-card text-center h-100">
                    <div class="feature-icon mb-2 p-2"><i class="bi bi-shield-check"></i></div>
                    <h6>100% Authentic Products</h6>
                    <p class="text-muted">We guarantee all our products are original and sourced from trusted brands and distributors.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-card text-center h-100">
                    <div class="feature-icon mb-2 p-2"><i class="bi bi-chat-dots"></i></div>
                    <h6>Expert Support</h6>
                    <p class="text-muted">Our team is ready to help you choose, compare, and troubleshoot your IEMs—before and after your purchase.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-card text-center h-100">
                    <div class="feature-icon mb-2 p-2"><i class="bi bi-arrow-repeat"></i></div>
                    <h6>Easy Returns</h6>
                    <p class="text-muted">Not satisfied? Enjoy hassle-free returns and exchanges within 7 days of delivery.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Blogs Section -->
    <section class="container my-5">
        <h2 class="section-title"><i class="bi bi-journal"></i> Blogs</h2>
        <div class="divider mb-3"><hr></div>
        <div class="row g-4 justify-content-center">
            <!-- Blog Card 1 -->
            <div class="col-md-3">
                <div class="feature-card text-center h-100">
                    <img src="../src/assets/images/blog-img/1st.jpg" alt="The Best In-Ear Monitors for Working Out" class="img-fluid rounded mb-3">
                    <h6>The Best In-Ear Monitors for Working Out</h6>
                    <p class="text-muted blog-desc">
                        Secure, sweat-resistant IEMs with dynamic sound to boost your workouts.
                    </p>
                    <a href="../src/components/blogs/blog-page.php?id=1" class="text-info">Read More</a>
                </div>
            </div>
            <!-- Blog Card 2 -->
            <div class="col-md-3">
                <div class="feature-card text-center h-100">
                    <img src="../src/assets/images/blog-img/2nd.jpg" alt="Top 3 Budget In-Ear Monitor for you" class="img-fluid rounded mb-3">
                    <h6>Top 3 Budget In-Ear Monitor for you</h6>
                    <p class="text-muted blog-desc">
                        Affordable IEMs with balanced audio, perfect for everyday listening.
                    </p>
                    <a href="../src/components/blogs/blog-page.php?id=2" class="text-info">Read More</a>
                </div>
            </div>
            <!-- Blog Card 3 -->
            <div class="col-md-3">
                <div class="feature-card text-center h-100">
                    <img src="../src/assets/images/blog-img/3rd.1.jpg" alt="Good for Gaming In-Ear Monitors" class="img-fluid rounded mb-3">
                    <h6>Good for Gaming In-Ear Monitors</h6>
                    <p class="text-muted blog-desc">
                        Immersive IEMs with clear spatial sound for competitive gaming.
                    </p>
                    <a href="../src/components/blogs/blog-page.php?id=3" class="text-info">Read More</a>
                </div>
            </div>
            <!-- Blog Card 4 -->
            <div class="col-md-3">
                <div class="feature-card text-center h-100">
                    <img src="../src/assets/images/blog-img/4th.webp" alt="How to Clean you In-Ear Monitors" class="img-fluid rounded mb-3">
                    <h6>How to Clean you In-Ear Monitors</h6>
                    <p class="text-muted blog-desc">
                        Simple steps to keep your IEMs hygienic and sounding great.
                    </p>
                    <a href="../src/components/blogs/blog-page.php?id=4" class="text-info">Read More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'components/header/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>