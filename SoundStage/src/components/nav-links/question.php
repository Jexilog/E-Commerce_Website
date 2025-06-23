<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact & Support | SoundStage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/AudioHub/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            color: #000;
        }
        .support-hero {
            background: linear-gradient(90deg, #003366 60%, #00509e 100%);
            color: #fff;
            border-radius: 1.5rem;
            padding: 2.5rem 1.5rem 2rem 1.5rem;
            margin-bottom: 2rem !important;
            box-shadow: 0 4px 32px 0 rgba(0,51,102,0.08);
        }
        .support-hero h1 {
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
        }
        .support-hero p {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        .help-topics {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .help-topic {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 2px 16px 0 rgba(0,51,102,0.07);
            padding: 1.5rem 1.2rem;
            min-width: 220px;
            flex: 1 1 220px;
            text-align: center;
        }
        .help-topic .icon {
            font-size: 2.2rem;
            color: #00509e;
            margin-bottom: 0.5rem;
        }
        .help-topic-title {
            font-size: 1.08rem;
            font-weight: 600;
            color: #003366;
        }
        .help-topic-desc {
            font-size: 0.97rem;
            margin-top: 0.5rem;
            color: #444;
        }
        .contact-card {
            background: #e3eaf3;
            border-radius: 1.2rem;
            padding: 1.5rem 1.2rem;
            color: #003366;
            margin-bottom: 2rem;
        }
        .contact-card .bi {
            font-size: 1.3rem;
            color: #00509e;
            margin-right: 0.5rem;
        }
        .question-form {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 2px 16px 0 rgba(0,51,102,0.07);
            padding: 2rem 1.5rem;
            max-width: 600px;
            margin: 2.5rem auto 2.5rem auto !important;
        }
        .question-form label {
            font-weight: 500;
            color: #003366;
        }
        .question-form .form-control:focus {
            border-color: #003366;
            box-shadow: 0 0 0 2px #00336633;
        }
        .question-form .btn-primary {
            background: #003366;
            border: none;
            border-radius: 2rem;
            padding: 0.6rem 2.2rem;
            font-weight: 600;
            transition: background 0.2s;
        }
        .question-form .btn-primary:hover {
            background: #00509e;
        }
        .faq-section {
            margin-top: 3.5rem !important;
            margin-bottom: 2rem;
        }
        .faq-title {
            font-size: 1.35rem;
            font-weight: 600;
            color: #003366;
            margin-bottom: 1.2rem;
        }
        .accordion-button {
            background: #f7fbff;
            color: #003366;
            font-weight: 500;
            transition: background 0.2s, color 0.2s;
        }
        .accordion-button:focus {
            box-shadow: 0 0 0 2px #00336633;
        }
        .accordion-button:not(.collapsed) {
            background: #e3eaf3;
            color: #003366;
        }
        .accordion-body {
            background: #fff;
            color: #222;
        }
        @media (max-width: 767px) {
            .support-hero {
                padding: 1.5rem 1rem 1rem 1rem;
            }
            .help-topics {
                flex-direction: column;
                gap: 1rem;
            }
            .question-form {
                padding: 1.2rem 0.7rem;
            }
            .contact-card {
                padding: 1rem 0.7rem;
            }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="container py-4">
        <!-- Hero Section -->
        <div class="support-hero text-center mt-4">
            <h1><i class="bi bi-headset me-2"></i>Contact & Support</h1>
            <p>
                Need help with your order, product advice, or have a question? Our team is here for you.
            </p>
            <p class="mb-0">
                Reach out below or explore our quick help topics and FAQs.
            </p>
        </div>

        <!-- Help Topics -->
        <div class="help-topics mb-4">
            <div class="help-topic">
                <div class="icon"><i class="bi bi-bag-check"></i></div>
                <div class="help-topic-title">Order & Shipping</div>
                <div class="help-topic-desc">
                    Track orders, view shipping times, and get updates in <a href="/AudioHub/src/components/orders.php">My Orders</a>.
                </div>
            </div>
            <div class="help-topic">
                <div class="icon"><i class="bi bi-arrow-repeat"></i></div>
                <div class="help-topic-title">Returns & Exchanges</div>
                <div class="help-topic-desc">
                    See our return policy and start a return on the <a href="return.php">Returns</a> page.
                </div>
            </div>
            <div class="help-topic">
                <div class="icon"><i class="bi bi-shield-check"></i></div>
                <div class="help-topic-title">Authenticity Guarantee</div>
                <div class="help-topic-desc">
                    All products are 100% authentic, sourced from trusted brands and distributors.
                </div>
            </div>
        </div>

        <!-- Contact Card -->
        <div class="contact-card shadow-sm mb-4">
            <div class="row">
                <div class="col-md-6 mb-2 mb-md-0">
                    <span><i class="bi bi-envelope"></i> support@soundstage.com</span>
                </div>
                <div class="col-md-6">
                    <span><i class="bi bi-telephone"></i> +63 912 345 6789</span>
                </div>
            </div>
            <div class="mt-2">
                <span><i class="bi bi-clock"></i> Mon–Fri: 9:00am – 6:00pm</span>
            </div>
        </div>

        <!-- Ask a Question Form -->
        <div class="question-form shadow-sm mt-4 mb-4">
            <form action="#" method="post" autocomplete="off">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@email.com" required>
                </div>
                <div class="mb-3">
                    <label for="question" class="form-label">Your Question</label>
                    <textarea class="form-control" id="question" name="question" rows="4" placeholder="Type your question here..." required></textarea>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send"></i> Submit Question
                    </button>
                </div>
            </form>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section">
            <div class="faq-title text-center mb-4">
                <i class="bi bi-stars"></i> Frequently Asked Questions
            </div>
            <div class="accordion faq-list" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq1-heading">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq1"
                            aria-expanded="false"
                            aria-controls="faq1">
                            How do I track my order?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" aria-labelledby="faq1-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Track your order status in your account dashboard under "My Orders." Email updates are sent as your order progresses.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq2-heading">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq2"
                            aria-expanded="false"
                            aria-controls="faq2">
                            What is your return policy?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faq2-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We offer a 30-day hassle-free return policy. Visit our <a href="return.php">Returns</a> page for details.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq3-heading">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq3"
                            aria-expanded="false"
                            aria-controls="faq3">
                            Are your products authentic?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faq3-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes, all products are 100% authentic and sourced from authorized distributors.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq4-heading">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq4"
                            aria-expanded="false"
                            aria-controls="faq4">
                            How fast is shipping?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faq4-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Standard shipping: 3-5 business days. Express: 1-2 business days. Choose your method at checkout.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq5-heading">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq5"
                            aria-expanded="false"
                            aria-controls="faq5">
                            Can I get help choosing the right IEM?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" aria-labelledby="faq5-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Absolutely! Contact us using the form above or email support@soundstage.com for personalized advice.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../header/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>