<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join Us | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/System/SoundStage/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #181c24 0%, #2a3a4f 100%);
            color: #eaf6ff;
            font-family: 'Segoe UI', sans-serif;
        }
        .join-main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 3rem 1rem 2rem 1rem;
        }
        .join-hero {
            background: linear-gradient(120deg, #232b3e 60%, #1a2233 100%);
            border-radius: 1.5rem;
            box-shadow: 0 8px 40px 0 rgba(126,203,255,0.10);
            padding: 2.5rem 2rem 2rem 2rem;
            margin-bottom: 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .join-hero-title {
            font-size: 2.7rem;
            font-weight: bold;
            color: #eaf6ff;
            letter-spacing: 1.5px;
        }
        .join-hero-highlight {
            color: #7ecbff;
        }
        .join-hero-desc {
            color: #b3c7e6;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .join-btn {
            background: #7ecbff;
            border-color: #7ecbff;
            color: #181c24;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 0.7rem 2.2rem;
            border-radius: 2rem;
            transition: background 0.2s, color 0.2s;
        }
        .join-btn:hover {
            background: #4fa3e3;
            color: #fff;
        }
        .join-section-title {
            color: #7ecbff;
            font-size: 1.7rem;
            font-weight: bold;
            margin-bottom: 1.2rem;
            letter-spacing: 1px;
        }
        .join-section-desc {
            color: #b3c7e6;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }
        .join-benefits {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2.5rem;
        }
        .join-benefit-card {
            background: rgba(34, 44, 66, 0.85);
            border-radius: 1.2rem;
            padding: 1.5rem 1.2rem;
            color: #eaf6ff;
            box-shadow: 0 4px 24px rgba(126,203,255,0.07);
            flex: 1 1 250px;
            min-width: 220px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .join-benefit-card:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 12px 36px 0 rgba(126,203,255,0.13);
        }
        .join-benefit-icon {
            font-size: 2.5rem;
            color: #7ecbff;
            margin-bottom: 1rem;
        }
        .join-benefit-title {
            font-weight: bold;
            font-size: 1.15rem;
            margin-bottom: 0.5rem;
            color: #eaf6ff;
        }
        .join-benefit-desc {
            color: #b3c7e6;
            font-size: 1rem;
        }
        .join-positions {
            margin-bottom: 2.5rem;
        }
        .join-position-card {
            background: rgba(34, 44, 66, 0.92);
            border-radius: 1.2rem;
            padding: 1.5rem 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 24px rgba(126,203,255,0.07);
        }
        .join-position-title {
            color: #7ecbff;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .join-position-meta {
            color: #b3c7e6;
            font-size: 0.98rem;
            margin-bottom: 0.7rem;
        }
        .join-position-desc {
            color: #eaf6ff;
            font-size: 1.05rem;
            margin-bottom: 0.7rem;
        }
        .join-form-section {
            background: #232b3e;
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
        @media (max-width: 991px) {
            .join-hero-title { font-size: 2rem; }
            .join-benefits { flex-direction: column; gap: 1.2rem; }
        }
        @media (max-width: 767px) {
            .join-main { padding: 1.2rem 0.2rem 2rem 0.2rem; }
            .join-section-title { font-size: 1.2rem; }
            .join-form-section { padding: 1rem 0.5rem; }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="join-main">
        <!-- Hero Section -->
        <div class="join-hero mb-5">
            <div class="join-hero-title">
                <span class="join-hero-highlight">Join</span> Our Team & Community
            </div>
            <div class="join-hero-desc">
                Be part of SoundStage’s mission to bring world-class audio to the Philippines.<br>
                Whether you’re a creative, engineer, marketer, or music lover, we want you to help us shape the future of sound.
            </div>
            <a href="#apply" class="btn join-btn shadow text-light">Apply Now</a>
        </div>

        <!-- Why Join Us -->
        <div class="join-section-title text-center"><i class="bi bi-stars"></i> Why Join SoundStage?</div>
        <div class="join-section-desc text-center mb-4">
            We’re more than a company—we’re a passionate community. At SoundStage, you’ll find a culture of innovation, collaboration, and growth. Here’s what makes us special:
        </div>
        <div class="join-benefits">
            <div class="join-benefit-card">
                <div class="join-benefit-icon"><i class="bi bi-people-fill"></i></div>
                <div class="join-benefit-title">Collaborative Culture</div>
                <div class="join-benefit-desc">Work with talented, supportive teammates who share your passion for music and technology.</div>
            </div>
            <div class="join-benefit-card">
                <div class="join-benefit-icon"><i class="bi bi-lightbulb"></i></div>
                <div class="join-benefit-title">Room to Grow</div>
                <div class="join-benefit-desc">We invest in your learning and career development with mentorship, workshops, and real-world projects.</div>
            </div>
            <div class="join-benefit-card">
                <div class="join-benefit-icon"><i class="bi bi-music-note-beamed"></i></div>
                <div class="join-benefit-title">Audio Perks</div>
                <div class="join-benefit-desc">Enjoy exclusive access to the latest audio gear, events, and industry discounts.</div>
            </div>
            <div class="join-benefit-card">
                <div class="join-benefit-icon"><i class="bi bi-globe"></i></div>
                <div class="join-benefit-title">Impact</div>
                <div class="join-benefit-desc">Help shape the sound experience for thousands of Filipinos and make a difference in the audio community.</div>
            </div>
        </div>

        <!-- Open Positions -->
        <div class="join-section-title text-center"><i class="bi bi-briefcase"></i> Open Positions</div>
        <div class="join-section-desc text-center mb-4">
            We’re always looking for passionate people to join us. Explore our current openings below:
        </div>
        <div class="join-positions">
            <div class="join-position-card">
                <div class="join-position-title"><i class="bi bi-code-slash"></i> Frontend Web Developer</div>
                <div class="join-position-meta">Full-time · Remote/On-site · Makati</div>
                <div class="join-position-desc">
                    Build beautiful, responsive interfaces for our e-commerce and audio visualization tools. Experience with React or Vue is a plus.
                </div>
                <ul class="mb-2" style="color:#b3c7e6;">
                    <li>2+ years experience in web development</li>
                    <li>Strong HTML, CSS, JS skills</li>
                    <li>Passion for UI/UX</li>
                </ul>
            </div>
            <div class="join-position-card">
                <div class="join-position-title"><i class="bi bi-megaphone"></i> Digital Marketing Specialist</div>
                <div class="join-position-meta">Full-time · Hybrid · Makati</div>
                <div class="join-position-desc">
                    Lead campaigns, manage social media, and grow our online presence. Audio or tech industry experience is a bonus.
                </div>
                <ul class="mb-2" style="color:#b3c7e6;">
                    <li>1+ year experience in digital marketing</li>
                    <li>Creative content skills</li>
                    <li>Analytical mindset</li>
                </ul>
            </div>
            <div class="join-position-card">
                <div class="join-position-title"><i class="bi bi-headphones"></i> Audio Product Specialist</div>
                <div class="join-position-meta">Part-time · On-site · Makati</div>
                <div class="join-position-desc">
                    Advise customers, demo products, and share your audio expertise at our showroom and events.
                </div>
                <ul class="mb-2" style="color:#b3c7e6;">
                    <li>Strong communication skills</li>
                    <li>Audio gear knowledge</li>
                    <li>Customer-focused attitude</li>
                </ul>
            </div>
            <div class="join-position-card">
                <div class="join-position-title"><i class="bi bi-person-plus"></i> Internship Program</div>
                <div class="join-position-meta">Flexible · Students Welcome</div>
                <div class="join-position-desc">
                    Gain hands-on experience in tech, marketing, or operations. We welcome students and fresh grads!
                </div>
                <ul class="mb-2" style="color:#b3c7e6;">
                    <li>Willingness to learn</li>
                    <li>Team player</li>
                    <li>Love for music & tech</li>
                </ul>
            </div>
        </div>

        <!-- Application Form -->
        <div class="join-section-title text-center" id="apply"><i class="bi bi-envelope-paper"></i> Apply Now</div>
        <div class="join-form-section">
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
                        <label for="position" class="form-label">Position Interested In *</label>
                        <select class="form-select" id="position" name="position" required>
                            <option value="">Select a position</option>
                            <option>Frontend Web Developer</option>
                            <option>Digital Marketing Specialist</option>
                            <option>Audio Product Specialist</option>
                            <option>Internship Program</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="col-12">
                        <label for="message" class="form-label">Tell us about yourself</label>
                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Share your experience, passion, or why you want to join SoundStage!"></textarea>
                    </div>
                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn join-btn px-5">Submit Application</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include '../header/footer.php'; ?>
</body>
</html>