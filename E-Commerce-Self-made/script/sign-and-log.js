const form = document.getElementById('forms');
const fullname = document.getElementById('fullname-input');
const username = document.getElementById('username-input');
const birthdate = document.getElementById('birthday-input');
const email = document.getElementById('email-input');
const password = document.getElementById('password-input');
const cpassword = document.getElementById('confirm-pass-input');
const phonenumber = document.getElementById('phone-input');
const address = document.getElementById('address-input');
const checkbox = document.getElementById('checkterms');
const error_message = document.getElementById('error-message');

form.addEventListener('submit', function (event) {
    // Remove previous error styles
    [fullname, username, birthdate, email, password, cpassword, phonenumber, address].forEach(input => {
        if (input) input.classList.remove("error");
    });
    if (checkbox) checkbox.classList.remove("error");
    if (error_message) error_message.innerText = "";

    let errors = [];

    // Signup form validation
    if (fullname) {
        // Check if all required fields are present
         if (
            !fullname.value.trim() &&
            !username.value.trim() &&
            !birthdate.value.trim() &&
            !email.value.trim() &&
            !password.value.trim() &&
            !cpassword.value.trim() &&
            !phonenumber.value.trim() &&
            !address.value.trim()
        ) {
            event.preventDefault();
            alert("Danger: All fields are empty!");
            if (error_message) error_message.innerText = "Danger: All fields are empty!";
            [fullname, username, birthdate, email, password, cpassword, phonenumber, address].forEach(input => {
                if (input) input.classList.add("error");
            });
            if (checkbox) checkbox.classList.add("error");
            return;
        }
        // Check required fields
        const fields = [
            { input: fullname, name: "Full Name" },
            { input: username, name: "Username" },
            { input: birthdate, name: "Birthdate" },
            { input: email, name: "Email" },
            { input: password, name: "Password" },
            { input: cpassword, name: "Confirm Password" },
            { input: phonenumber, name: "Phone Number" },
            { input: address, name: "Address" }
        ];

        fields.forEach(field => {
            if (!field.input.value.trim()) {
                errors.push(`${field.name} is required`);
                field.input.classList.add("error");
            }
        });

        // Password checks
        if (password.value && password.value.length < 8) {
            errors.push("Password must be at least 8 characters long");
            password.classList.add("error");
        }
        if (password.value !== cpassword.value) {
            errors.push("Passwords do not match");
            password.classList.add("error");
            cpassword.classList.add("error");
        }

        // Terms checkbox
        if (checkbox && !checkbox.checked) {
            errors.push("You must agree to the Terms and Conditions");
            checkbox.classList.add("error");
        }
    } else {
        // Login form validation
        if ((!email.value.trim() && !username.value.trim()) || !password.value.trim()) {
            errors.push("Please enter your email/username and password");
            if (email) email.classList.add("error");
            if (username) username.classList.add("error");
            if (password) password.classList.add("error");
        }
    }

    // Show errors if any
    if (errors.length > 0) {
        event.preventDefault();
        alert(errors.join("\n"));
        if (error_message) error_message.innerText = errors.join("\n");
    }
});

// Optional: Remove error class on input
[fullname, username, birthdate, email, password, cpassword, phonenumber, address].forEach(input => {
    if (input) {
        input.addEventListener('input', function () {
            input.classList.remove("error");
        });
    }
});
if (checkbox) {
    checkbox.addEventListener("change", function () {
        if (checkbox.checked) {
            checkbox.classList.remove("error");
        } else {
            checkbox.classList.add("error");
        }
    });
}