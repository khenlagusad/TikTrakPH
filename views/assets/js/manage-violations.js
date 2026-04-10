const addModal    = document.querySelector('#add-modal');
const editModal   = document.querySelector('#edit-modal');
const deleteModal = document.querySelector('#delete-modal');

// ── OPEN ADD ──
document.querySelector('#add-btn').addEventListener('click', () => {
    addModal.classList.add('active');
});

document.querySelectorAll('#close-add').forEach(btn => {
    btn.addEventListener('click', () => addModal.classList.remove('active'));
});

// ── OPEN EDIT ──
document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('#edit-id').value          = btn.dataset.id;
        document.querySelector('#edit-name').value        = btn.dataset.name;
        document.querySelector('#edit-description').value = btn.dataset.description;
        document.querySelector('#edit-fine').value        = btn.dataset.fine;
        editModal.classList.add('active');
    });
});

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

document.querySelectorAll('#close-delete').forEach(btn => {
    btn.addEventListener('click', () => deleteModal.classList.remove('active'));
});