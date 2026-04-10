const loginForm     = document.querySelector("#login-form");
const usernameField = document.querySelector("#username");
const passwordField = document.querySelector("#password");
const usernameError = document.querySelector("#username-error");
const passwordError = document.querySelector("#password-error");
const loginBtn      = document.querySelector("#login-btn");

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

    if (usernameField.value.trim() === '') {
        showError(usernameField, usernameError, "Username cannot be empty!");
        hasError = true;
    } else {
        clearError(usernameField, usernameError);
    }

    if (passwordField.value.trim() === '') {
        showError(passwordField, passwordError, "Password cannot be empty!");
        hasError = true;
    } else {
        clearError(passwordField, passwordError);
    }

    return hasError;
}

usernameField.addEventListener('input', () => clearError(usernameField, usernameError));
passwordField.addEventListener('input', () => clearError(passwordField, passwordError));

loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    if (checkErrors()) return;

    loginForm.submit();
});