// Demo accounts (replace with your backend logic)
const accounts = [
    { email: "carlos@gmail.com", password: "123" },
    { email: "justinejeckhoavio@gmail.com", password: "123" }
];

// Toggle password visibility
window.togglePassword = function(inputId, iconSpan) {
    const input = document.getElementById(inputId);
    const icon = iconSpan.querySelector('i');
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        input.type = "password";
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
}

// Show forgot password modal
window.showForgotPasswordModal = function(e) {
    e.preventDefault();
    var forgotModal = new bootstrap.Modal(document.getElementById('forgotPasswordModal'));
    forgotModal.show();
}

// Sign-in logic
document.getElementById('signinForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.getElementById('signin-email').value.trim();
    const password = document.getElementById('signin-password').value;
    const found = accounts.find(acc => acc.email === email && acc.password === password);
    if (found) {
        // Simulate session (for demo)
        localStorage.setItem('user', JSON.stringify(found));
        // Redirect to dashboard
        window.location.href = "/System/SoundStage/src/components/admin/dashboard.php";
    } else {
        alert("Invalid email or password.");
    }
});

// Forgot password logic (demo)
document.getElementById('forgotForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert("If this email exists, a reset link will be sent. (Demo only)");
    bootstrap.Modal.getInstance(document.getElementById('forgotPasswordModal')).hide();
});