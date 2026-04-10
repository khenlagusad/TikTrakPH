const editForm      = document.querySelector('#edit-form');
const usernameField = document.querySelector('#username');
const phoneField    = document.querySelector('#phone');
const passwordField = document.querySelector('#password');
const errorUsername = document.querySelector('#error-username');
const errorPhone    = document.querySelector('#error-phone');
const errorPassword = document.querySelector('#error-password');

function showError(input, errorEl, message) {
    input.classList.add('input-error');
    errorEl.textContent      = message;
    errorEl.style.visibility = 'visible';
}

function clearError(input, errorEl) {
    input.classList.remove('input-error');
    errorEl.textContent      = '';
    errorEl.style.visibility = 'hidden';
}

function checkErrors() {
    let hasError = false;

    if (!usernameField.value.trim()) {
        showError(usernameField, errorUsername, 'Username cannot be empty.');
        hasError = true;
    } else if (usernameField.value.trim().length < 3) {
        showError(usernameField, errorUsername, 'Username must be at least 3 characters.');
        hasError = true;
    } else if (!/^[a-zA-Z0-9_]+$/.test(usernameField.value.trim())) {
        showError(usernameField, errorUsername, 'Only letters, numbers, and underscores allowed.');
        hasError = true;
    } else {
        clearError(usernameField, errorUsername);
    }

    if (!phoneField.value.trim()) {
        showError(phoneField, errorPhone, 'Phone number cannot be empty.');
        hasError = true;
    } else if (!/^09\d{9}$/.test(phoneField.value.trim())) {
        showError(phoneField, errorPhone, 'Invalid phone number. e.g. 09171234567');
        hasError = true;
    } else {
        clearError(phoneField, errorPhone);
    }

    if (passwordField.value.trim() && passwordField.value.trim().length < 6) {
        showError(passwordField, errorPassword, 'Password must be at least 6 characters.');
        hasError = true;
    } else {
        clearError(passwordField, errorPassword);
    }

    return hasError;
}

editForm.addEventListener('submit', (e) => {
    e.preventDefault();
    if (!checkErrors()) editForm.submit();
});