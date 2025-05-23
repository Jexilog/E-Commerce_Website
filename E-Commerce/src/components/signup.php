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
    <link rel="stylesheet" href="../styles/signupstyle.css">
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
                    <div class = checkbox-container> 
                        <label>
                            <input type="checkbox" id="checkbox" name="checkbox">
                            I agree to the&nbsp;<b><a href="#" id="OpenTerms">Terms and Conditions</a></b>&nbsp; and &nbsp; <b><a href="#" id="Privacy">Privacy Policies</a></b>
                        </label>
                    </div>
                    <div class="modal" id="modalTerms">
                        <div class="modal-inner">
                            <h2> Terms and Conditions</h2>
                            <h6>Effective Date: 04/10/2025</h6>
                            <h6>Company Name: SoundStage Inc.</h6>
                            <ol type="1" class= "list-wrapper">
                                <li>Introduction</li>
                                <li>Eligibility</li>
                                <li>Purchases</li>
                                <li>Pricing and Payment</li>
                                <li>Shipping and Delivery</li>
                                <li>Returns and Refunds</li>
                                <li>Intellectual Property</li>
                                <li>Probihited Activities</li>
                                <li>Limitation of Liability</li>
                                <li>Changes of these Terms</li>
                                <li>Governing Law</li>
                                <li>Contact Information</li>
                            </ol>
                            <button type="button" class="close-modal" id="closeTerms">Close</button>
                        </div>
                    </div>
                    <div class="modal" id="modalPrivacy">
                        <div class="modal-inner">
                            <h2> Privacy Policy</h2>
                            <h6>Effective Date: 04/10/2025</h6>
                            <h6>Company Name: SoundStage Inc.</h6>
                            <ol type="1" class= "list-wrapper">
                                <li>Introduction</li>
                                <li>Information We Collect</li>
                                <li>How we Use Your Information</li>
                                <li>Sharing your information</li>
                                <li>Cookies</li>
                                <li>Security</li>
                                <li>Your Rights</li>
                                <li>Third-Party Links</li>
                                <li>Changes to THis Privacy Policy</li>
                                <li>Contact Us</li>
                            </ol>
                            <button type="button" class="close-modal" id="closePrivacy">Close</button>
                        </div>
                    </div>
                    <button type="submit" name ="send"><b>Register</b></button>
                    <p id ="Notice" >Already have an account? <b><a href="../components/login.php">Login</a></b></p>
                    <p id="error-message" class="error-message"></p>
                    </div>
            </form>
                <div class="image-section">
                    <img src="../images/signup.png" alt="Registration Visual">
                </div>
        </div>
    </div>
</center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
    crossorigin="anonymous"></script>
    <script src="../script/test.js"></script>
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
