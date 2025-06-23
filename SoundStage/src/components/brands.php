<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands | SoundStage</title>
    <link rel="icon" href="../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            color: #000000;
            font-family: 'Segoe UI', sans-serif;
        }
        .main-content {
            background: #003366;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
            padding: 2.5rem 2rem 2.5rem 2rem !important;
            margin: 1rem;
        }
        .brand-row {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
        }
        .brand-card {
            flex: 1 1 320px;
            max-width: 350px;
            min-width: 260px;
            background: #f8fafc;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.15s, box-shadow 0.15s;
            border: 1px solid #e3e7ee;
        }
        .brand-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 24px rgba(0,0,0,0.10);
            border-color: #b6c6e3;
        }
        .brand-card img {
            height: 80px;
            object-fit: contain;
            margin-bottom: 1rem;
            filter: grayscale(0.2);
            transition: filter 0.2s;
        }
        .brand-card:hover img {
            filter: grayscale(0);
        }
        .brand-card h3 {
            margin-bottom: 0.2rem;
            font-weight: 600;
            color: #1a237e;
        }
        .brand-meta {
            font-size: 0.97em;
            color: #607d8b;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        .brand-card .tagline {
            font-style: italic;
            color: #1976d2;
            font-size: 0.98em;
            margin-bottom: 0.5rem;
        }
        .brand-card p {
            flex: 1 1 auto;
            text-align: center;
            color: #444;
            font-size: 1rem;
        }
        .brand-specialty {
            font-size: 0.97em;
            color: #333;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        .brand-social {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .brand-social a {
            color: #1976d2;
            margin: 0 0.3em;
            font-size: 1.2em;
            transition: color 0.2s;
        }
        .brand-social a:hover {
            color: #0d47a1;
        }
        .brand-card .personal-note {
            background: #e3f2fd;
            color: #1565c0;
            border-radius: 6px;
            padding: 0.4em 0.7em;
            font-size: 0.97em;
            margin-top: 0.7em;
            margin-bottom: 0.2em;
            text-align: center;
        }
        .brand-card a.visit-link {
            margin-top: 1rem;
            color: #fff;
            background: #1976d2;
            padding: 0.5rem 1.2rem;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.2s;
            font-weight: 500;
            letter-spacing: 0.5px;
            display: inline-block;
        }
        .brand-card a.visit-link:hover {
            background: #0d47a1;
        }
        .brand-card .external-link {
            margin-left: 0.3em;
            font-size: 1em;
            vertical-align: middle;
        }
        @media (max-width: 600px) {
            .main-content {
                padding: 1.2rem 0.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- Header/Navbar -->
    <?php include '../components/header/header.php'; ?>

    <div class="mt-4 mb-4">
        <h1 class="mb-3 text-center text-primary">Overview of Brands</h1>
        <p class="text-center mb-3 text-secondary">
            Discover the brands we trust and use for delivering the best audio experience.<br>
            Each brand brings unique strengths and innovations to our collection.
        </p>
        <?php
        $brands = [
            [
                'name' => 'Shure',
                'img' => '../assets/images/brand-img/shure.jpg',
                'desc' => 'Shure is a leading manufacturer of microphones and audio electronics, known for their reliability and sound quality.',
                'origin' => 'United States',
                'established' => 1925,
                'specialty' => 'SM7B Microphone, SE215 Earphones',
                'tagline' => 'Sound Extraordinary',
                'link' => 'https://www.shure.com/',
                'social' => [
                    'facebook' => 'https://facebook.com/shure',
                    'instagram' => 'https://instagram.com/shure',
                    'youtube' => 'https://www.youtube.com/user/shureinc'
                ],
                'note' => 'Trusted for vocals and studio work.'
            ],
            [
                'name' => 'Sennheiser',
                'img' => '../assets/images/brand-img/sennheiser.webp',
                'desc' => 'Sennheiser specializes in the design and production of a wide range of high-fidelity products, including microphones, headphones, and headsets.',
                'origin' => 'Germany',
                'established' => 1945,
                'specialty' => 'HD 600, Momentum Series',
                'tagline' => 'The Future of Audio',
                'link' => 'https://en-us.sennheiser.com/',
                'social' => [
                    'facebook' => 'https://facebook.com/Sennheiser',
                    'instagram' => 'https://instagram.com/sennheiser',
                    'youtube' => 'https://www.youtube.com/user/sennheiserofficial'
                ],
                'note' => 'My go-to for reference headphones.'
            ],
            [
                'name' => 'Audio-Technica',
                'img' => '../assets/images/brand-img/audio-tech.png',
                'desc' => 'Audio-Technica is renowned for its high-quality headphones, microphones, and audio equipment for both professionals and consumers.',
                'origin' => 'Japan',
                'established' => 1962,
                'specialty' => 'ATH-M50x, AT2020 Microphone',
                'tagline' => 'Always Listening',
                'link' => 'https://www.audio-technica.com/',
                'social' => [
                    'facebook' => 'https://facebook.com/AudioTechnicaUSA',
                    'instagram' => 'https://instagram.com/audiotechnicausa',
                    'youtube' => 'https://www.youtube.com/user/AudioTechnicaUSA'
                ],
                'note' => 'Great for monitoring and recording.'
            ],
            [
                'name' => 'FiiO',
                'img' => '../assets/images/brand-img/fiio.jpg',
                'desc' => 'FiiO designs and produces high-resolution audio players, amplifiers, and DACs for audiophiles.',
                'origin' => 'China',
                'established' => 2007,
                'specialty' => 'FiiO M11, K5 Pro',
                'tagline' => 'Born for Music and Happy',
                'link' => 'https://www.fiio.com/',
                'social' => [
                    'facebook' => 'https://facebook.com/FiiOAUDIO',
                    'instagram' => 'https://instagram.com/fiio_official',
                    'youtube' => 'https://www.youtube.com/user/FiiOaudio'
                ],
                'note' => 'Affordable and powerful audio gear.'
            ],
            [
                'name' => 'Moondrop',
                'img' => '../assets/images/brand-img/moondrop.jpg',
                'desc' => 'Moondrop is known for its innovative in-ear monitors and headphones, blending technology with artistic design.',
                'origin' => 'China',
                'established' => 2015,
                'specialty' => 'Blessing 2, Aria',
                'tagline' => 'Hear the Difference',
                'link' => 'https://www.moondroplab.com/',
                'social' => [
                    'facebook' => 'https://facebook.com/moondroplab',
                    'instagram' => 'https://instagram.com/moondroplab',
                ],
                'note' => 'Unique tuning and design.'
            ],
            [
                'name' => 'SpinFit',
                'img' => '../assets/images/brand-img/spinfit.webp',
                'desc' => 'SpinFit specializes in ear tips that enhance comfort and sound quality for a variety of earphones.',
                'origin' => 'Taiwan',
                'established' => 2015,
                'specialty' => 'CP100, CP145 Eartips',
                'tagline' => 'A New Level of Comfort',
                'link' => 'https://www.spinfit-eartip.com/',
                'social' => [
                    'facebook' => 'https://facebook.com/SpinFitEartip',
                    'instagram' => 'https://instagram.com/spinfit_eartip',
                ],
                'note' => 'Best for comfort and fit.'
            ],
            [
                'name' => 'DD HiFi',
                'img' => '../assets/images/brand-img/ddhifi.png',
                'desc' => 'DD HiFi creates innovative audio accessories, including adapters, cases, and cables for audiophiles.',
                'origin' => 'China',
                'established' => 2017,
                'specialty' => 'Adapters, Carrying Cases',
                'tagline' => 'Design & Detail',
                'link' => 'https://www.ddhifi.com/',
                'social' => [
                    'facebook' => 'https://facebook.com/ddhifi',
                    'instagram' => 'https://instagram.com/ddhifi_official',
                ],
                'note' => 'Smart solutions for audio setups.'
            ],
            [
                'name' => 'Tripowin',
                'img' => '../assets/images/brand-img/tripowin.png',
                'desc' => 'Tripowin offers a range of high-quality cables and earphones for audio enthusiasts.',
                'origin' => 'China',
                'established' => 2019,
                'specialty' => 'Cables, Mele IEM',
                'tagline' => 'Connect to Sound',
                'link' => 'https://www.linsoul.com/collections/tripowin',
                'social' => [
                    'facebook' => 'https://facebook.com/linsoul.audio',
                    'instagram' => 'https://instagram.com/linsoul.audio',
                ],
                'note' => 'Reliable upgrade cables.'
            ],
        ];
        ?>
        <div class="container main-content">
            <div class="brand-row">
                <?php foreach ($brands as $brand): ?>
                    <div class="brand-card">
                        <img src="<?php echo $brand['img']; ?>" alt="<?php echo $brand['name']; ?> Logo">
                        <h3><?php echo $brand['name']; ?></h3>
                        <div class="brand-meta">
                            <?php if (!empty($brand['origin'])): ?>
                                <span><i class="bi bi-geo-alt"></i> <?php echo $brand['origin']; ?></span>
                            <?php endif; ?>
                            <?php if (!empty($brand['established'])): ?>
                                <span> &middot; <i class="bi bi-calendar3"></i> Est. <?php echo $brand['established']; ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($brand['tagline'])): ?>
                            <div class="tagline">"<?php echo $brand['tagline']; ?>"</div>
                        <?php endif; ?>
                        <p><?php echo $brand['desc']; ?></p>
                        <?php if (!empty($brand['specialty'])): ?>
                            <div class="brand-specialty"><b>Famous for:</b> <?php echo $brand['specialty']; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($brand['social'])): ?>
                            <div class="brand-social">
                                <?php if (!empty($brand['social']['facebook'])): ?>
                                    <a href="<?php echo $brand['social']['facebook']; ?>" target="_blank" title="Facebook"><i class="bi bi-facebook"></i></a>
                                <?php endif; ?>
                                <?php if (!empty($brand['social']['instagram'])): ?>
                                    <a href="<?php echo $brand['social']['instagram']; ?>" target="_blank" title="Instagram"><i class="bi bi-instagram"></i></a>
                                <?php endif; ?>
                                <?php if (!empty($brand['social']['youtube'])): ?>
                                    <a href="<?php echo $brand['social']['youtube']; ?>" target="_blank" title="YouTube"><i class="bi bi-youtube"></i></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($brand['note'])): ?>
                            <div class="personal-note"><i class="bi bi-star-fill"></i> <?php echo $brand['note']; ?></div>
                        <?php endif; ?>
                        <a href="<?php echo $brand['link']; ?>" class="visit-link" target="_blank" rel="noopener">
                            Visit Website
                            <i class="bi bi-box-arrow-up-right external-link"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <?php include '../components/header/footer.php'; ?>
    
</body>
</html>