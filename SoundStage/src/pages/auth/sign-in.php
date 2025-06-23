<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/System/SoundStage/src/assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #181c24 0%, #2a3a4f 100%) !important;
            color: #eaf6ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .signin-card {
            width: 100%;
            max-width: 400px;
            background: #232b3e !important;
            border-radius: 24px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
            color: #eaf6ff;
        }
        .form-control {
            background: #181c24;
            border: 1.5px solid #232b3e;
            color: #eaf6ff;
            font-size: 0.92rem;
            height: 38px;
        }
        .form-control:focus {
            border-color: #4fc3f7;
            box-shadow: 0 0 0 0.15rem rgba(79,195,247,0.15);
            background: #181c24;
            color: #eaf6ff;
        }
        input::placeholder {
            font-size: 0.85rem;
            color: #7ecbff !important;
            opacity: 1;
        }
        .input-icon {
            color: #4fc3f7;
            font-size: 1.2rem;
        }
        .text-muted {
            color: #7ecbff !important;
        }

        /* Hide default password reveal icon in Edge/Chrome */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }
        input[type="password"]::-webkit-credentials-auto-fill-button,
        input[type="password"]::-webkit-input-decoration,
        input[type="password"]::-webkit-clear-button,
        input[type="password"]::-webkit-reveal-button {
            display: none !important;
        }
        .modal-content {
            background: #181c24 !important;
            color: #eaf6ff;
            border-radius: 16px;
            border: 1.5px solid #232b3e;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
        }
        .modal-header {
            border-bottom: 1px solid #232b3e;
            background: #232b3e;
        }
        .modal-title {
            color: #7ecbff;
            font-weight: bold;
        }
        .btn-close {
            filter: invert(1) grayscale(1) brightness(2);
        }
        .modal-body label,
        .modal-body .form-label {
            color: #7ecbff;
        }
        .modal-body .form-control {
            background: #232b3e;
            color: #eaf6ff;
            border: 1.5px solid #181c24;
            font-size: 0.95rem;
        }
        .modal-body .form-control:focus {
            border-color: #4fc3f7;
            background: #232b3e;
            color: #eaf6ff;
        }
        .modal-body .btn-primary {
            background: #4fc3f7;
            border: none;
            color: #181c24;
            font-weight: bold;
            font-size: 1rem;
            transition: background 0.2s;
        }
        .modal-body .btn-primary:hover,
        .modal-body .btn-primary:focus {
            background: #7ecbff;
            color: #232b3e;
        }
    </style>
</head>
<body>

    <div class="signin-bg d-flex align-items-center justify-content-center min-vh-100">
        <div class="signin-card p-4 shadow rounded-4 bg-white">
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1" style="color: #7ecbff;">Hello Admin!<br><span style="letter-spacing:6px;">WELCOME</span></h2>
                <div class="position-relative d-inline-block" style="width: 150px;">
                    <img src="../../assets/images/carlos.png" alt="SoundStage Admin" class="img-fluid mt-1 mb-1" style="max-width: 150px; border-radius: 50%;">
                    <span class="position-absolute start-50 translate-middle-x" style="bottom: -10px; z-index: 2; background: white; padding: 2px 12px; border-radius: 12px; font-weight: bold; color: #003366; font-size: 1.1rem; letter-spacing: 0.2em; border: 1px solid #003366;">
                        ADMIN
                    </span>
                </div>
                <div class="text-muted mt-3" style="font-size:1rem;">"SoundStage: Where Every Beat Finds Its Home!"</div>
            </div>
            <form id="signinForm" autocomplete="off">
                <div class="mb-3 position-relative">
                    <label for="signin-email" class="form-label visually-hidden">Email address</label>
                    <span class="position-absolute top-50 start-0 translate-middle-y ms-3 input-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </span>
                    <input type="email" class="form-control form-control-sm ps-5" id="signin-email" placeholder="Email address" required>
                </div>
                <div class="mb-3 position-relative">
                    <label for="signin-password" class="form-label visually-hidden">Password</label>
                    <span class="position-absolute top-50 start-0 translate-middle-y ms-3 input-icon">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input type="password" class="form-control form-control-sm ps-5" id="signin-password" placeholder="Password" required>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword('signin-password', this)">
                        <i class="bi bi-eye-slash" id="signin-eye" style="color:#7ecbff;"></i>
                    </span>
                </div>
                <div class="mb-3 d-flex justify-content-between align-items-center small">
                    <div class="form-check m-0">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <a href="#" class="link-primary text-decoration-none" onclick="showForgotPasswordModal(event)">Forgot Password?</a>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill" style="background:#003366; height: 40px; font-size: 1rem;">LOGIN</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="forgotForm">
                <div class="mb-3">
                    <p>Enter your email address and we'll send you a password reset link.</p>
                    <div class="mb-3"><hr>
                        <input type="email" class="form-control" id="forgot-email" placeholder="Enter your email address" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets//scripts//sign-in.js"></script>

</body>
</html>