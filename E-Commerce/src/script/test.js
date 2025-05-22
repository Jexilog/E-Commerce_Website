const form = document.getElementById("forms");
const fname_input = document.getElementById("fname-input");
const lname_input = document.getElementById("lname-input");
const email_input = document.getElementById("email");
const password_input = document.getElementById("Password");
const cpassword_input = document.getElementById("ConPass");
const error_message = document.getElementById("error-message");
const checkbox = document.getElementById("checkbox");
const otpField = document.getElementById("otp");

if (otpField) {
    otpField.value = otp();
}

const passwordInput = document.getElementById("Password");
const togglePassword = document.getElementById("togglePassword");
const eyeIcon = document.getElementById("eyeIcon");

const conPasswordInput = document.getElementById("ConPass");
const toggleConPassword = document.getElementById("toggleConPassword");
const eyeConIcon = document.getElementById("eyeConIcon");

if (togglePassword && passwordInput && eyeIcon) {
    togglePassword.addEventListener("click", function () {
        const isPassword = passwordInput.type === "password";
        passwordInput.type = isPassword ? "text" : "password";
        eyeIcon.className = isPassword ? "bi bi-eye-slash" : "bi bi-eye";
    });
}

if (toggleConPassword && conPasswordInput && eyeConIcon) {
    toggleConPassword.addEventListener("click", function () {
        const isPassword = conPasswordInput.type === "password";
        conPasswordInput.type = isPassword ? "text" : "password";
        eyeConIcon.className = isPassword ? "bi bi-eye-slash" : "bi bi-eye";
    });
}

form.addEventListener('submit', function (event) {

    [fname_input, lname_input, email_input, password_input, cpassword_input].forEach(input => {
        if (input) input.classList.remove("error");
    });
    if (checkbox) checkbox.classList.remove("error");
    

    error_message.innerText = "";

    let errors = [];

    if (
    fname_input && lname_input && cpassword_input && 
    !fname_input.value.trim() &&
    !lname_input.value.trim() &&
    !email_input.value.trim() &&
    !password_input.value.trim() &&
    !cpassword_input.value.trim()
    ) {
        event.preventDefault();
        errors.push("Please fill in all fields");
        [fname_input, lname_input, email_input, password_input, cpassword_input].forEach(input => {
            if (input) input.classList.add("error");
        });
        alert(errors.join(", "));
        return;
    }

    if (
        fname_input && lname_input && cpassword_input && 
        fname_input.value.trim() &&
        lname_input.value.trim() &&
        email_input.value.trim() &&
        password_input.value.trim() &&
        cpassword_input.value.trim()
    ) {
       if (checkbox && !checkbox.checked) {
        event.preventDefault();
        errors.push("You must agree to the Terms and Conditions");
        checkbox.classList.add("error");
        alert(errors.join(", "));
        return;
    }
    }

    if (
        !fname_input && !lname_input && !cpassword_input && 
        !email_input.value.trim() &&
        !password_input.value.trim()
    ) {
        event.preventDefault();
        errors.push("Please fill in all fields");
        [email_input, password_input].forEach(input => {
            if (input) input.classList.add("error");
        });
        alert(errors.join(", "));
        return;
    }
    if (checkbox) {
    checkbox.addEventListener("change", function () {
        if (checkbox.classList.contains("error") && checkbox.checked) {
            checkbox.classList.remove("error");
            error_message.innerText = "";
        }
    });
}

    if (fname_input) {
        errors = getSignupFormErrors(
            fname_input.value,
            lname_input.value,
            email_input.value,
            password_input.value,
            cpassword_input.value
        );
    } else {
        errors = getLoginFormErrors(email_input.value, password_input.value);
    }

    if (errors.length > 0) {
        event.preventDefault();
        alert(errors.join(", "));
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const email = document.getElementById('email');
    const password = document.getElementById('Password');
    const alertBox = document.querySelector('.alert-danger');
    if (alertBox) {
        if (email) email.addEventListener('input', () => alertBox.style.display = 'none');
        if (password) password.addEventListener('input', () => alertBox.style.display = 'none');
    }
});

function getSignupFormErrors(fname, lname, email, password, cpassword) {
    let errors = [];

    if (fname === "" || fname === null) {
        errors.push("First name is required");
        fname_input.classList.add("error");
    }
    if (lname === "" || lname === null) {
        errors.push("Last name is required");
        lname_input.classList.add("error");
    }
    if (email === "" || email === null) {
        errors.push("Email is required");
        email_input.classList.add("error");
    }
    if (password === "" || password === null) {
        errors.push("Password is required");
        password_input.classList.add("error");
    }
    if (cpassword === "" || cpassword === null) {
        cpassword_input.classList.add("error");
    }
    if (
        password !== "" && password !== null &&
        cpassword !== "" && cpassword !== null &&
        password.length < 8
    ) {
        errors.push("Password must be at least 8 characters long");
        password_input.classList.add("error");
    }
    if (password !== cpassword && password !== "" && cpassword !== "") {
        errors.push("Passwords do not match");
        password_input.classList.add("error");
        cpassword_input.classList.add("error");
    }

    return errors;
   
}

function getLoginFormErrors(email, password) {
    let errors = [];

    if (email === "" || email === null) {
        errors.push("Email is required");
        email_input.classList.add("error");
    }
    
    if (password === "" || password === null) {
        errors.push("Password is required");
        password_input.classList.add("error");
    }

    return errors;
}

function otp() {
    let min = 100000;
    let max = 999999;
    let lastgenerated = localStorage.getItem("randomgenerated");
    let random;
    do {
        random = Math.floor(Math.random() * (max - min + 1)) + min;
    } while (random == lastgenerated);
    localStorage.setItem("randomgenerated", random);
    return random;
}


const allInputs = [fname_input, lname_input, email_input, password_input, cpassword_input].filter(input => input !== null);

allInputs.forEach((input) => {
  input.addEventListener("input", function () {
    if (input.classList.contains("error")) {
      input.classList.remove("error");
      error_message.innerText = "";
    }
  });
});