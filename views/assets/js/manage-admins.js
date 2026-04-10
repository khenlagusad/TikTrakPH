const addBtn      = document.querySelector("#add-btn");
const addModal    = document.querySelector("#add-modal");
const editModal   = document.querySelector("#edit-modal");
const deleteModal = document.querySelector("#delete-modal");

// ── OPEN MODALS ──
addBtn.addEventListener("click", () => addModal.classList.add("active"));

document.querySelectorAll(".btn-edit").forEach(btn => {
    btn.addEventListener("click", () => {
        const row = btn.closest("tr");
        document.querySelector("#edit-id").value         = btn.dataset.id;
        document.querySelector("#edit-first-name").value = row.cells[1].textContent.trim();
        document.querySelector("#edit-last-name").value  = row.cells[2].textContent.trim();
        document.querySelector("#edit-username").value   = row.cells[3].textContent.replace("@", "").trim();
        editModal.classList.add("active");
    });
});

document.querySelectorAll(".btn-delete").forEach(btn => {
    btn.addEventListener("click", () => {
        document.querySelector("#delete-id").value = btn.dataset.id;
        deleteModal.classList.add("active");
    });
});

// ── CLOSE MODALS ──
document.querySelectorAll(".modal-close, .btn-cancel").forEach(btn => {
    btn.addEventListener("click", () => {
        [addModal, editModal, deleteModal].forEach(m => m.classList.remove("active"));
    });
});

[addModal, editModal, deleteModal].forEach(modal => {
    modal.addEventListener("click", (e) => {
        if (e.target === modal) modal.classList.remove("active");
    });
});