const loginForm = document.querySelector("#login-form")
const usernameField = document.querySelector("#username")
const passwordField = document.querySelector("#password");
const errorUsername = document.querySelector("#error-username")
const errorPassword = document.querySelector("#error-password")

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

    if (usernameField.value.trim() === ''){
        showError(usernameField, errorUsername, "Username cannot be empty!")
        hasError = true;
    } else {
        clearError(usernameField, errorUsername);
    }
    
    if (passwordField.value.trim() === ''){
        showError(passwordField, errorPassword, "Password cannot be empty!");
        hasError = true;
    } else {
        clearError(passwordField, errorPassword);
    }

    return hasError;
}

loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    if (checkErrors()) return;
    loginForm.submit();
});

