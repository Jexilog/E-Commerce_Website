<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Returns & Exchanges | SoundStage</title>
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
        .return-hero {
            background: #003366;
            color: #fff;
            border-radius: 1.5rem;
            padding: 2.5rem 1.5rem 2rem 1.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 32px 0 rgba(0,51,102,0.10);
            text-align: center;
        }
        .return-hero h1 {
            font-weight: 700;
            font-size: 2.3rem;
            margin-bottom: 0.7rem;
        }
        .return-hero p {
            font-size: 1.15rem;
            margin-bottom: 0.2rem;
        }
        .policy-section {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 2px 16px 0 rgba(0,51,102,0.08);
            padding: 2rem 1.5rem;
            margin: 0 auto 2.5rem auto;
            max-width: 900px;
        }
        .policy-section h3 {
            color: #003366;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .policy-section ul {
            margin-bottom: 0;
        }
        .policy-section li {
            margin-bottom: 0.7rem;
            color: #222;
        }
        .steps-section {
            margin: 0 auto 3rem auto;
            max-width: 900px;
        }
        .step-card {
            background: #e3eaf3;
            border-radius: 1.2rem;
            box-shadow: 0 2px 8px 0 rgba(0,51,102,0.07);
            padding: 1.5rem 1.2rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1.2rem;
        }
        .step-icon {
            background: #003366;
            color: #fff;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 2px 8px 0 rgba(0,51,102,0.10);
        }
        .step-content h4 {
            color: #003366;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        .step-content p {
            color: #222;
            font-size: 1rem;
            margin-bottom: 0;
        }
        .faq-section {
            margin: 0 auto 3rem auto;
            max-width: 900px;
        }
        .faq-title {
            font-size: 1.25rem;
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
            .return-hero {
                padding: 1.5rem 1rem 1rem 1rem;
            }
            .policy-section, .steps-section, .faq-section, .contact-support {
                padding: 1.2rem 0.7rem;
            }
            .step-card {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>
    <?php include '../header/header.php'; ?>

    <div class="container py-4">
        <!-- Hero Section -->
        <div class="return-hero mt-4">
            <h1><i class="bi bi-arrow-repeat me-2"></i>Returns & Exchanges</h1>
            <p>We want you to love your purchase. If you need to return or exchange an item, our process is simple and hassle-free.</p>
        </div>

        <!-- Policy Section -->
        <div class="policy-section shadow-sm mb-4">
            <h3><i class="bi bi-info-circle"></i> Return Policy Overview</h3>
            <ul>
                <li>Returns and exchanges are accepted within <b>30 days</b> of delivery.</li>
                <li>Items must be unused, in original packaging, and with all accessories/manuals.</li>
                <li>Defective or incorrect items are eligible for free return shipping.</li>
                <li>Some items (e.g., custom IEMs, opened ear tips) may not be eligible for return due to hygiene reasons.</li>
                <li>Refunds are processed within 5-7 business days after we receive your return.</li>
            </ul>
        </div>

        <!-- Steps Section -->
        <div class="steps-section">
            <div class="step-card">
                <div class="step-icon" style="background:#00509e;"><i class="bi bi-clipboard-check"></i></div>
                <div class="step-content">
                    <h4>1. Request a Return</h4>
                    <p>Go to <a href="../../components/orders.php" style="color:#00509e;">Order Tracking</a> and select the item you wish to return. Click "Request Return" and fill out the form.</p>
                </div>
            </div>
            <div class="step-card">
                <div class="step-icon" style="background:#f9b233;"><i class="bi bi-box"></i></div>
                <div class="step-content">
                    <h4>2. Prepare Your Item</h4>
                    <p>Pack the item securely in its original packaging, including all accessories and manuals.</p>
                </div>
            </div>
            <div class="step-card">
                <div class="step-icon" style="background:#00b894;"><i class="bi bi-truck"></i></div>
                <div class="step-content">
                    <h4>3. Ship It Back</h4>
                    <p>Use the provided return label (if eligible) or ship to the address given in your return confirmation email.</p>
                </div>
            </div>
            <div class="step-card">
                <div class="step-icon" style="background:#e17055;"><i class="bi bi-cash-stack"></i></div>
                <div class="step-content">
                    <h4>4. Get Your Refund or Exchange</h4>
                    <p>Once we receive and inspect your item, we’ll process your refund or send your replacement.</p>
                </div>
            </div>
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
                            How long does it take to process a return?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" aria-labelledby="faq1-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Returns are processed within 5-7 business days after we receive your item.
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
                            Can I return opened items?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faq2-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Items must be unused and in original packaging. Some items, like ear tips, cannot be returned if opened for hygiene reasons.
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
                            Who pays for return shipping?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faq3-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            If your item is defective or incorrect, we cover return shipping. For other reasons, shipping costs may apply.
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
                            How do I exchange an item?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faq4-heading" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Follow the same steps as a return and indicate you want an exchange. We’ll ship your replacement once we receive your item.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Support Section -->
        <div class="contact-support shadow-sm mb-4">
            <h4><i class="bi bi-envelope"></i> Need more help?</h4>
            <p>Our support team is here to assist you with returns and exchanges.</p>
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