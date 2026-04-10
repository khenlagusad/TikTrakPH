const editModal   = document.querySelector('#edit-modal');
const deleteModal = document.querySelector('#delete-modal');
const errorPassword = document.querySelector('#error-password');

// ── OPEN EDIT ──
document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('#edit-id').value         = btn.dataset.id;
        document.querySelector('#edit-first-name').value = btn.dataset.firstName;
        document.querySelector('#edit-last-name').value  = btn.dataset.lastName;
        document.querySelector('#edit-username').value   = btn.dataset.username;
        document.querySelector('#edit-phone').value      = btn.dataset.phone;
        document.querySelector('#edit-license').value    = btn.dataset.license;
        document.querySelector('#edit-password').value   = '';
        errorPassword.style.visibility = 'hidden';
        errorPassword.textContent = '';
        editModal.classList.add('active');
    });
});

// ── CLOSE EDIT ──
document.querySelectorAll('#close-edit').forEach(btn => {
    btn.addEventListener('click', () => editModal.classList.remove('active'));
});

// ── VALIDATE PASSWORD ON SUBMIT ──
document.querySelector('#edit-modal form').addEventListener('submit', (e) => {
    const password = document.querySelector('#edit-password').value.trim();
    if (password !== '' && password.length < 6) {
        e.preventDefault();
        errorPassword.textContent      = 'Password must be at least 6 characters.';
        errorPassword.style.visibility = 'visible';
        document.querySelector('#edit-password').classList.add('input-error');
    } else {
        errorPassword.style.visibility = 'hidden';
        document.querySelector('#edit-password').classList.remove('input-error');
    }
});

// ── OPEN DELETE ──
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('#delete-id').value = btn.dataset.id;
        deleteModal.classList.add('active');
    });
});

// ── CLOSE DELETE ──
document.querySelectorAll('#close-delete').forEach(btn => {
    btn.addEventListener('click', () => deleteModal.classList.remove('active'));
});