<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/styles/sign-in-style.css">
</head>
    <style>
        /* Add this to give space above the text-muted slogan */
        .text-muted {
            margin-top: 24px; /* Adjust as needed */
        }
    </style>
<body>

    <div class="signin-bg d-flex align-items-center justify-content-center min-vh-100">
        <div class="signin-card p-4 shadow rounded-4 bg-white">
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1" style="color:#003366;">Hello Admin!<br><span style="letter-spacing:4px;">WELCOME</span></h2>
                <div class="position-relative d-inline-block" style="width: 150px;">
                    <img src="../assets/images/rep.jpg" alt="" class="img-fluid mt-1 mb-1" style="max-width: 150px; border-radius: 50%;">
                    <span class="position-absolute start-50 translate-middle-x" style="bottom: -10px; z-index: 2; background: white; padding: 2px 12px; border-radius: 12px; font-weight: bold; color: #003366; font-size: 1.1rem; letter-spacing: 0.2em; border: 1px solid #003366;">
                        CEO
                    </span>
                </div>
                <div class="text-muted" style="font-size:1rem;">"SoundStage: Where Every Beat Comes to Life!"</div>
            </div>
            <form id="signinForm" autocomplete="off">
                <div class="mb-3">
                    <label for="signin-email" class="form-label visually-hidden">Email address</label>
                    <input type="email" class="form-control form-control-lg" id="signin-email" placeholder="Email address" required>
                </div>
                <div class="mb-3 position-relative">
                    <label for="signin-password" class="form-label visually-hidden">Password</label>
                    <input type="password" class="form-control form-control-lg" id="signin-password" placeholder="Password" required>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword('signin-password', this)">
                        <i class="bi bi-eye-slash" id="signin-eye"></i>
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
                    <button type="submit" class="btn btn-primary flex-fill" style="background:#003366; height: 50px;">LOGIN</button>
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
                    <label for="forgot-email" class="form-label">Enter your email address</label>
                    <input type="email" class="form-control" id="forgot-email" placeholder="Email address" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/sign-in.js"></script>

</body>
</html>