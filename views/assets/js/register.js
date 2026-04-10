const firstnameError = document.querySelector("#error-first_name");
const lastnameError  = document.querySelector("#error-last_name");
const usernameError  = document.querySelector("#error-username");
const passwordError  = document.querySelector('#error-password');
const phoneError     = document.querySelector('#error-phone');
const licenseError   = document.querySelector('#error-license_no');

const firstnameInput = document.querySelector('#first_name');
const lastnameInput  = document.querySelector('#last_name');
const usernameInput  = document.querySelector('#username');
const passwordInput  = document.querySelector('#password');
const phoneInput     = document.querySelector('#phone');
const licenseInput   = document.querySelector('#license_no');

const registerForm = document.querySelector("#register-form");

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

    if (!firstnameInput.value.trim()) {
        showError(firstnameInput, firstnameError, 'First name is required.');
        hasError = true;
    } else clearError(firstnameInput, firstnameError);

    if (!lastnameInput.value.trim()) {
        showError(lastnameInput, lastnameError, 'Last name is required.');
        hasError = true;
    } else clearError(lastnameInput, lastnameError);

    if (!usernameInput.value.trim()) {
        showError(usernameInput, usernameError, 'Username is required.');
        hasError = true;
    } else if (usernameInput.value.trim().length < 3) {
        showError(usernameInput, usernameError, 'Username must be at least 3 characters.');
        hasError = true;
    } else if (!/^[a-zA-Z0-9_]+$/.test(usernameInput.value.trim())) {
        showError(usernameInput, usernameError, 'Only letters, numbers, and underscores allowed.');
        hasError = true;
    } else clearError(usernameInput, usernameError);

    if (!passwordInput.value.trim()) {
        showError(passwordInput, passwordError, 'Password is required.');
        hasError = true;
    } else if (passwordInput.value.trim().length < 6) {
        showError(passwordInput, passwordError, 'Password must be at least 6 characters.');
        hasError = true;
    } else clearError(passwordInput, passwordError);

    if (!phoneInput.value.trim()) {
        showError(phoneInput, phoneError, 'Phone number is required.');
        hasError = true;
    } else if (!/^09\d{9}$/.test(phoneInput.value.trim())) {
        showError(phoneInput, phoneError, 'Invalid phone number. e.g. 09171234567');
        hasError = true;
    } else clearError(phoneInput, phoneError);

    if (!licenseInput.value.trim()) {
        showError(licenseInput, licenseError, 'License number is required.');
        hasError = true;
    } else if (!/^[A-Z]\d{2}-\d{2}-\d{6}$/.test(licenseInput.value.trim().toUpperCase())) {
        showError(licenseInput, licenseError, 'Invalid format. e.g. N01-23-456789');
        hasError = true;
    } else clearError(licenseInput, licenseError);

    return hasError;
}

registerForm.addEventListener("submit", (e) => {
    e.preventDefault();
    if (checkErrors()) return;
    registerForm.submit();
});
