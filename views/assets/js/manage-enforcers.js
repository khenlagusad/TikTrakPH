// ── MODALS ──
const addModal    = document.querySelector('#add-modal');
const editModal   = document.querySelector('#edit-modal');
const deleteModal = document.querySelector('#delete-modal');

// ── OPEN ADD ──
document.querySelector('#add-btn').addEventListener('click', () => {
    addModal.classList.add('active');
});

// ── CLOSE ADD ──
document.querySelectorAll('#close-add').forEach(btn => {
    btn.addEventListener('click', () => addModal.classList.remove('active'));
});

// ── OPEN EDIT ──
document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('#edit-id').value         = btn.dataset.id;
        document.querySelector('#edit-first-name').value = btn.dataset.firstName;
        document.querySelector('#edit-last-name').value  = btn.dataset.lastName;
        document.querySelector('#edit-city-id').value    = btn.dataset.cityId;
        editModal.classList.add('active');
    });
});

// ── CLOSE EDIT ──
document.querySelectorAll('#close-edit').forEach(btn => {
    btn.addEventListener('click', () => editModal.classList.remove('active'));
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