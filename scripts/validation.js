// Get both error message elements
const feedback_error_message = document.getElementById('errormessage');
const auth_error_message = document.getElementById('error-message');

// Determine which error message element to use
function getErrorMessageElement(formId) {
    if (formId === 'FeedbackForm') return feedback_error_message;
    else if (formId === 'signinform') return auth_error_message;
    return null;
}

// Select forms and inputs
const form = document.getElementById('FeedbackForm') || document.getElementById('signinform');

// Signup & Login Inputs
const firstname_input = document.getElementById('firstname-input');
const email_input = document.getElementById('email-input');
const password_input = document.getElementById('password-input');
const repeat_password_input = document.getElementById('repeat-password-input');

// Feedback Form Inputs
const fullName_input = document.getElementById('FullName');
const feedback_email_input = document.getElementById('email');
const entertainment_input = document.getElementById('entertainment-value');
const experience_radios = document.querySelectorAll('input[name="experience"]');
const foodQuality_radios = document.querySelectorAll('input[name="food"]');
const enjoy_checkboxes = document.querySelectorAll('input[name="enjoy[]"]');
const foodSection_checkboxes = document.querySelectorAll('input[name="food_section[]"]');
const comments_input = document.getElementById('comments');

form.addEventListener('submit', (e) => {
    let errors = [];
    const formId = form.id;

    const errorMessageElement = getErrorMessageElement(formId);

    if (formId === 'signinform') {
        // Handle signup or login validation
        if (firstname_input) {
            errors = getSignupFormError(
                firstname_input.value,
                email_input.value,
                password_input.value,
                repeat_password_input.value
            );
        } else {
            errors = getLoginFormErrors(email_input.value, password_input.value);
        }
    } else if (formId === 'FeedbackForm') {
        // Handle feedback validation
        errors = getFeedbackFormErrors();
    }

    if (errors.length > 0) {
        e.preventDefault(); // Prevent form submission
        if (errorMessageElement) {
            errorMessageElement.innerText = errors.join(". ");
        }
        scrollToTop();
    }
});

function getFeedbackFormErrors() {
    let errors = [];

    const fullName = document.getElementById('FullName').value.trim();
    const email = document.getElementById('email').value.trim();
    const entertainment = document.getElementById('entertainment-value').value.trim();
    const experienceChecked = document.querySelector('input[name="experience"]:checked');
    const foodQualityChecked = document.querySelector('input[name="food"]:checked');
    const enjoyChecked = document.querySelectorAll('input[name="enjoy[]"]:checked');
    const foodSectionChecked = document.querySelectorAll('input[name="food_section[]"]:checked');
    const comments = document.getElementById('comments').value.trim();

    if (!fullName) {
        errors.push("Full name is required");
        document.getElementById('FullName').parentElement.classList.add('incorrect');
    }

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/i;
    if (!email) {
        errors.push("Email is required");
        document.getElementById('email').parentElement.classList.add('incorrect');
    } else if (!emailPattern.test(email)) {
        errors.push("Enter a valid email address");
        document.getElementById('email').parentElement.classList.add('incorrect');
    }

    if (!entertainment) {
        errors.push("Please select an entertainment type");
        document.getElementById('entertainment-value').parentElement.classList.add('incorrect');
    }

    if (!experienceChecked) {
        errors.push("Please select an overall experience rating");
        document.querySelectorAll('.blockLable')[2].classList.add('incorrect');
    }

    if (!foodQualityChecked) {
        errors.push("Please select a food quality rating");
        document.querySelectorAll('.blockLable')[3].classList.add('incorrect');
    }

    if (enjoyChecked.length === 0) {
        errors.push("Please select at least one 'Most Enjoy' option");
    }

    if (foodSectionChecked.length === 0) {
        errors.push("Please select at least one 'Best Food Section' option");
    }

    if (!comments) {
        errors.push("Please share your thoughts in the comments section");
        document.getElementById('comments').parentElement.classList.add('incorrect');
    }

    return errors;
}

function getSignupFormError(firstname, email, password, repeatPassword) {
    let errors = [];

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/i;

    if (!firstname.trim()) {
        errors.push('Firstname is required');
        firstname_input.parentElement.classList.add('incorrect');
    }

    if (!email.trim()) {
        errors.push('Email is required');
        email_input.parentElement.classList.add('incorrect');
    } else if (!emailPattern.test(email)) {
        errors.push('Enter a valid email address');
        email_input.parentElement.classList.add('incorrect');
    }

    if (!password.trim()) {
        errors.push('Password is required');
        password_input.parentElement.classList.add('incorrect');
    }

    if (password.length < 8) {
        errors.push('Password must have at least 8 characters');
        password_input.parentElement.classList.add('incorrect');
    }

    if (password !== repeatPassword) {
        errors.push('Passwords do not match');
        password_input.parentElement.classList.add('incorrect');
        repeat_password_input.parentElement.classList.add('incorrect');
    }

    return errors;
}

function getLoginFormErrors(email, password) {
    let errors = [];

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/i;

    if (!email.trim()) {
        errors.push('Email is required');
        email_input.parentElement.classList.add('incorrect');
    } else if (!emailPattern.test(email)) {
        errors.push('Enter a valid email address');
        email_input.parentElement.classList.add('incorrect');
    }

    if (!password.trim()) {
        errors.push('Password is required');
        password_input.parentElement.classList.add('incorrect');
    }

    return errors;
}

// Remove error class when user types again
const allInputs = [
    firstname_input, email_input, password_input, repeat_password_input,
    fullName_input, feedback_email_input, entertainment_input, comments_input
].filter(input => input != null);

allInputs.forEach(input => {
    input.addEventListener('input', () => {
        if (input.parentElement.classList.contains('incorrect')) {
            input.parentElement.classList.remove('incorrect');
            // Clear both messages depending on context
            if (feedback_error_message) feedback_error_message.innerText = '';
            if (auth_error_message) auth_error_message.innerText = '';
        }
    });
});

// Scroll to top after validation fails
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}