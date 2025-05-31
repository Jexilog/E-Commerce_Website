<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['checkbox'])) {
    echo "<script>alert('You must agree to the Terms and Conditions.'); window.history.back();</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <link rel="stylesheet" href="/E-Commerce-Website-System/E-Commerce/src/styles/User-and-Guest-Site/auth/signupstyle.css">
</head>
<body>
    <center>
    <div class="container">
        <div class="form-section">
            <form id="forms" action="send.php" method="POST">
                <h2><b>Create an Account</b></h2>
                <p>Please create your account</p>
                    <div class="name-fields">
                        <input type="text" id="fname-input" name="firstname" placeholder="First name">
                        <input type="text" id="lname-input" name="lastname" placeholder="Last name">
                    </div>
                        <input type="email" id="email" name="email" placeholder="Enter your email">
                        <div class="password-wrapper">
                        <input type="password" id="Password" name="password" placeholder="Enter your password">
                            <span class="show-password-label" id="togglePassword" style="cursor:pointer;">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </span>
                        </div>
                        <div class="password-wrapper">
                            <input type="password" id="ConPass" placeholder="Confirm your password">
                                <span class="show-password-label" id="toggleConPassword" style="cursor:pointer;">
                                    <i class="bi bi-eye" id="eyeConIcon"></i>
                                </span>
                        </div>
                    <div class="otp-fields">
                        <input type="text" name="otp" id="otp" class="form-control" value = "" hidden>
                    </div>
                    <div class = "checkbox-container"> 
                        <label>
                            <input type="checkbox" id="checkbox" name="checkbox">
                            <p>I agree to the&nbsp;<b><a href="#" id="OpenTerms">Terms and Conditions</a></b> and <b><a href="#" id="Privacy">Privacy Policies</a></b></p>
                        </label>
                    </div>
                    <div class="modal" id="modalTerms">
                        <div class="modal-inner">
                            <h2> Terms and Conditions</h2>
                            <p>Effective Date: 04/10/2025<br>
                            Company Name: SoundStage Inc.</p>
                            <ol type="1" class= "list-wrapper">
                                <li><b>Introduction</b></li>
                                    <ul><li>Welcome to SoundStage.Inc. These Terms and Conditions govern your use of our website and services. By accessing or using our site, you agree to be bound by these Terms.</li></ul>
                                <li><b>Eligibility</b></li> 
                                    <ul><li>You must be at least 18 years old to use our website. By using our site, you confirm you meet this requirement.</li></ul>                                                               
                                <li><b>Purchases</b></li>
                                    <ul><li>All purchases made through our website are subject to product availability. We reserve the right to cancel or refuse any order.</li></ul>
                                <li><b>Pricing and Payment</b></li>
                                    <ul><li>Prices are listed in Philippine Peso. We reserve the right to change prices at any time. Payment must be completed at checkout through the available payment methods.</li></ul>
                                <li><b>Shipping and Delivery</b></li>
                                    <ul><li>Delivery times are estimates and may vary. Shipping policies, costs, and delivery options are outlined during checkout.</li></ul>
                                <li><b>Returns and Refunds</b></li>
                                    <ul><li>Please review our Return Policy for information about returns and refunds.</li></ul>
                                <li><b>Intellectual Property</b></li>
                                    <ul><li>All content on our website, including logos, images, and text, is owned by SoundStage Inc. and protected by intellectual property laws.</li></ul>
                                <li><b>Probihited Activities</b></li>
                                    <ul><li>You agree not to misuse our website, including unauthorized access, distributing viruses, spamming, or infringing on our intellectual property.</li></ul>
                                <li><b>Limitation of Liability</b></li>
                                    <ul><li>SoundStage.Inc is not responsible for any indirect, incidental, or consequential damages arising from your use of the site or products.</li></ul>
                                <li><b>Changes of these Terms</b></li>
                                    <ul><li>We reserve the right to update these Terms at any time. Changes will be posted on this page.</li></ul>
                                <li><b>Governing Law</b></li>
                                    <ul><li>These Terms are governed by the laws of Philippines.</li></ul>
                                <li><b>Contact Information</b></li>
                                    <ul><li>For any questions regarding these Terms, please contact us at helpcenter@soundstage.com</li></ul>
                            </ol>
                            <span class="close-modal" id="closeTerms"tabindex="0" role="button"><i class="bi bi-x-lg"></i></span>
                        </div>
                    </div>
                    <div class="modal" id="modalPrivacy">
                        <div class="modal-inner">
                            <h2> Privacy Policy</h2>
                            <p>Effective Date: 04/10/2025<br>
                            Company Name: SoundStage Inc.</p>
                            <ol type="1" class= "list-wrapper">
                                <li><b>Introduction</b></li>
                                    <ul>
                                        <li>We value your privacy. This Privacy Policy explains how we collect, use, and protect your personal information when you visit or make a purchase from our site.</li>
                                    </ul>
                                <li><b>Information We Collect</b></li>
                                <ul>
                                    <li>Personal Information: Name, Address, Email, Phone Number, Payment Details.</li>
                                    <li> Automatically Collected Information: IP address, browser type, device information, cookies.</li>
                                </ul>
                                <li><b>How we Use Your Information</b></li>
                                <ul>
                                    <li>We use your information to:</li>
                                    <ul>
                                        <li>Process orders and payments.</li>
                                        <li>Deliver products and services.</li>
                                        <li>Communicate with you (order updates, newsletters, promotions).</li>
                                        <li>Improve our website and services.</li>
                                    </ul>
                                </ul>
                                <li><b>Sharing your information</b></li>
                                <ul>
                                    <li>We do not sell or rent your personal information. We may share it with:</li>
                                    <li>Trusted third-party service providers (e.g., payment processors, delivery companies).</li>
                                    <li>Law enforcement if legally required.</li>
                                </ul>
                                <li><b>Cookies</b></li>
                                <ul><li>Our site uses cookies to improve your browsing experience. You can control cookie settings in your browser.</li></ul>
                                <li><b>Security</b></li>
                                <ul><li>We take reasonable measures to protect your personal data, but no system is 100% secure.</li></ul>
                                <li><b>Your Rights</b></li>
                                <ul>
                                    <li style="margin-bottom: 0; font-size:16px;">You have the right to:</li>
                                    <ul>
                                        <li>Access the personal information we hold about you.</li>
                                        <li>Request correction or deletion of your data.</li>
                                        <li>Opt out of marketing communications.</li>
                                    </ul>
                                </ul>
                                <li><b>Third-Party Links</b></li>
                                <ul><li>Our website may contain links to third-party websites. We are not responsible for their privacy practices.</li></ul>
                                <li><b>Changes to This Privacy Policy</b></li>
                                <ul><li>We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated effective date.</li></ul>
                                <li><b>Contact Us</b></li>
                                <ul><li>For any questions about this Privacy Policy, contact us at helpcenter@soundstage.com</li></ul>
                            </ol>
                            <span class="close-modal" id="closePrivacy" tabindex="0" role="button"><i class="bi bi-x-lg"></i></span>
                        </div>
                    </div>
                    <button type="submit" name ="send"><b>Register</b></button>
                    <p id ="Notice" >Already have an account? <b><a href="../auth/login.php">Login</a></b></p>
                    <p id="error-message" class="error-message"></p>
                    </div>
            </form>
                <div class="image-section">
                    <img src="/E-Commerce-Website-System/E-Commerce/src/images/signup.png" alt="Registration Visual">
                </div>
        </div>
    </div>
</center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
    crossorigin="anonymous"></script>
    <script src="/E-Commerce-Website-System/E-Commerce/src/script/User-and-Guest-Site/auth/test.js"></script>
    <script>
        const openterms = document.getElementById('OpenTerms');
        const modalTerms = document.getElementById('modalTerms');
        const closeterms  = document.getElementById('closeTerms');

        openterms.addEventListener('click', function(event) {
            event.preventDefault();
            modalTerms.classList.add('open');
        });
        closeterms.addEventListener('click', function(event) {
            modalTerms.classList.remove('open');
        });

        const openPrivacy = document.getElementById('Privacy');
        const modalPrivacy = document.getElementById('modalPrivacy');
        const closePrivacy = document.getElementById('closePrivacy');
        
        openPrivacy.addEventListener('click', function(event){
            event.preventDefault();
            modalPrivacy.classList.add('open');
        });
        closePrivacy.addEventListener('click', function(event){
            modalPrivacy.classList.remove('open');
        });

    </script>
</body>
</html>
