<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Help Center | SoundStage</title>
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
        .help-hero {
            background: #003366;
            color: #fff;
            border-radius: 1.5rem;
            padding: 2.5rem 1.5rem 2rem 1.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 32px 0 rgba(0,51,102,0.10);
            text-align: center;
        }
        .help-hero h1 {
            font-weight: 700;
            font-size: 2.3rem;
            margin-bottom: 0.7rem;
        }
        .help-hero p {
            font-size: 1.15rem;
            margin-bottom: 0.2rem;
        }
        .quick-links {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 2.5rem;
        }
        .quick-link-card {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 2px 16px 0 rgba(0,51,102,0.08);
            padding: 1.5rem 1.2rem;
            min-width: 220px;
            flex: 1 1 220px;
            text-align: center;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .quick-link-card:hover {
            box-shadow: 0 6px 24px 0 rgba(0,51,102,0.13);
            transform: translateY(-4px) scale(1.03);
        }
        .quick-link-icon {
            font-size: 2.2rem;
            color: #00509e;
            margin-bottom: 0.5rem;
        }
        .quick-link-title {
            font-size: 1.08rem;
            font-weight: 600;
            color: #003366;
        }
        .quick-link-desc {
            font-size: 0.97rem;
            margin-top: 0.5rem;
            color: #444;
        }
        .faq-section {
            margin: 0 auto 3rem auto;
            max-width: 900px;
        }
        .faq-title {
            font-size: 1.35rem;
            font-weight: 600;
            color: #003366;
            margin-bottom: 1.2rem;
            text-align: center;
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
        .contact-support {
            background: #e3eaf3;
            border-radius: 1.2rem;
            padding: 2rem 1.5rem;
            margin: 0 auto 2.5rem auto;
            max-width: 900px;
            color: #003366;
            text-align: center;
        }
        .contact-support h4 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #003366;
        }
        .contact-support .btn {
            background: #003366;
            color: #fff;
            border-radius: 2rem;
            padding: 0.6rem 2.2rem;
            font-weight: 600;
            border: none;
            transition: background 0.2s;
        }
        .contact-support .btn:hover {
            background: #00509e;
        }
        @media (max-width: 767px) {
            .help-hero {
                padding: 1.5rem 1rem 1rem 1rem;
            }
            .quick-links {
                flex-direction: column;
                gap: 1rem;
            }
            .contact-support {
                padding: 1.2rem 0.7rem;
            }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="container py-4">
        <!-- Hero Section -->
        <div class="help-hero mt-4">
            <h1><i class="bi bi-question-circle me-2"></i>Help Center</h1>
            <p>Welcome to the SoundStage Help Center. Find answers, get support, and explore helpful resources for your best shopping experience.</p>
        </div>

        <!-- Quick Links Section -->
        <div class="quick-links mb-4">
            <a href="question.php" class="quick-link-card text-decoration-none">
                <div class="quick-link-icon"><i class="bi bi-chat-dots"></i></div>
                <div class="quick-link-title">Contact Support</div>
                <div class="quick-link-desc">Reach out to our team for any questions or concerns.</div>
            </a>
            <a href="how.php" class="quick-link-card text-decoration-none">
                <div class="quick-link-icon"><i class="bi bi-cart-check"></i></div>
                <div class="quick-link-title">How to Buy</div>
                <div class="quick-link-desc">Step-by-step guide to shopping at SoundStage.</div>
            </a>
            <a href="return.php" class="quick-link-card text-decoration-none">
                <div class="quick-link-icon"><i class="bi bi-arrow-repeat"></i></div>
                <div class="quick-link-title">Returns & Exchanges</div>
                <div class="quick-link-desc">Learn about our return policy and how to start a return.</div>
            </a>
            <a href="orders.php" class="quick-link-card text-decoration-none">
                <div class="quick-link-icon"><i class="bi bi-box-seam"></i></div>
                <div class="quick-link-title">Order Tracking</div>
                <div class="quick-link-desc">Track your orders and view order history.</div>
            </a>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section">
            <div class="faq-title">
                <i class="bi bi-stars"></i> Frequently Asked Questions
            </div>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq1-heading">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq1"
                            aria-expanded="false"
                            aria-controls="faq1">
                            How do I place an order?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" aria-labelledby="faq1-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Browse products, add items to your cart, and proceed to checkout. Follow the steps to enter your details and complete payment.
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
                            What payment methods do you accept?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faq2-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We accept credit/debit cards, GCash, and other secure payment options.
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
                            How do I return or exchange an item?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faq3-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Visit our <a href="return.php" style="color:#00509e;">Returns & Exchanges</a> page for instructions and eligibility.
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
                            How can I track my order?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faq4-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Go to <a href="orders.php" style="color:#00509e;">Order Tracking</a> to view your order status and history.
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
                            Are your products authentic?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" aria-labelledby="faq5-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes, all products are 100% authentic and sourced from authorized distributors and brands.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Support Section -->
        <div class="contact-support shadow-sm mb-4">
            <h4><i class="bi bi-envelope"></i> Still need help?</h4>
            <p>Our support team is ready to assist you with any questions or concerns.</p>
            <a href="question.php" class="btn mt-2"><i class="bi bi-chat-dots"></i> Contact Support</a>
            <div class="mt-3">
                <span><i class="bi bi-envelope"></i> support@soundstage.com</span> &nbsp; | &nbsp;
                <span><i class="bi bi-telephone"></i> +63 912 345 6789</span>
            </div>
        </div>
    </div>

    <?php include '../header/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>