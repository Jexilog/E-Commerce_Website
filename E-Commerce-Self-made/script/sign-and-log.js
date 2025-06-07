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
const togglePassword = document.getElementById("togglePassword");
const eyeIcon = document.getElementById("eyeIcon");
const toggleConPassword = document.getElementById("toggleConPassword");
const eyeConIcon = document.getElementById("eyeConIcon");
const openterms = document.getElementById('OpenTerms');
const modalTerms = document.getElementById('modalTerms');
const closeterms  = document.getElementById('closeTerms');

togglePassword.addEventListener('click', function (event){
    const isPassword = password.type === "password";
    password.type = isPassword ? "text" : "password";
    eyeIcon.classList.toggle("bx-eye-slash");
    eyeIcon.classList.toggle("bx-eye");
    });

toggleConPassword.addEventListener('click', function(event){
    const isConPassword = cpassword.type === "password";
    cpassword.type = isConPassword ? "text" : "password";
    eyeConIcon.classList.toggle("bx-eye-slash");
    eyeConIcon.classList.toggle("bx-eye");
    });


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

// Clear error message and styles on input
function clearErrorOnInput(input) {
    input.addEventListener('input', function () {
        input.classList.remove("error"); // Remove error class
    });
}

// Attach input event listeners to all relevant fields
[fullname, username, birthdate, email, password, cpassword, phonenumber, address].forEach(input => {
    if (input) {
        clearErrorOnInput(input);
    }
});

// Terms checkbox change event
if (checkbox) {
    checkbox.addEventListener("change", function () {
        if (checkbox.checked) {
            checkbox.classList.remove("error");
        } else {
            checkbox.classList.add("error");
        }
    });
}

// Form submission event
form.addEventListener('submit', function (event) {
    // Remove previous error styles
    [fullname, username, birthdate, email, password, cpassword, phonenumber, address].forEach(input => {
        if (input) input.classList.remove("error");
    });
    if (checkbox) checkbox.classList.remove("error");

    let errors = [];

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
        errors.push("Danger: All fields are empty!");
        alert(errors.join("\n")); // Use alert box for error messages
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

    // Show errors if any
    if (errors.length > 0) {
        event.preventDefault();
        alert(errors.join("\n")); // Use alert box for error messages
    }
});
