<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Violations | TikTrakPH</title>

    <link rel="stylesheet" href="/test/views/assets/css/main.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-brand.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-sidebar.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-manage-violations.css">

    <script src="/test/views/assets/js/manage-violations.js" defer></script>
</head>
<body>
    <?php require("views/partials/admin-sidebar.php") ?>

    <main>
        <div class="page-header">
            <h3 class="page-title">Manage Violations</h3>
            <button id="add-btn">Add Violation</button>
        </div>

        <div class="table-wrap">
            <div class="table-scroll">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Fine Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($violations)): ?>
                            <tr>
                                <td colspan="5" class="empty-row">No violations found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($violations as $violation): ?>
                                <tr>
                                    <td class="cell-id">#<?= $violation['id'] ?></td>
                                    <td class="cell-name"><?= htmlspecialchars($violation['name']) ?></td>
                                    <td class="cell-description"><?= htmlspecialchars($violation['description']) ?></td>
                                    <td class="cell-fine">₱<?= number_format($violation['current_fine_amount'], 2) ?></td>
                                    <td class="cell-actions">
                                        <button class="btn-edit"
                                            data-id="<?= $violation['id'] ?>"
                                            data-name="<?= htmlspecialchars($violation['name']) ?>"
                                            data-description="<?= htmlspecialchars($violation['description']) ?>"
                                            data-fine="<?= $violation['current_fine_amount'] ?>">
                                            Edit
                                        </button>
                                        <button class="btn-delete"
                                            data-id="<?= $violation['id'] ?>">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- ── ADD MODAL ── -->
    <div class="modal" id="add-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Add Violation</h3>
                <button class="modal-close" id="close-add">✕</button>
            </div>
            <form action="/test/admin/manage-violations/add" method="POST" class="modal-form">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="e.g. Illegal Parking" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3" placeholder="Describe the violation..."></textarea>
                </div>
                <div class="form-group">
                    <label>Fine Amount (₱)</label>
                    <input type="number" name="current_fine_amount" placeholder="e.g. 1000" min="0" step="0.01" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="close-add">Cancel</button>
                    <button type="submit" class="btn-confirm">Add Violation</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ── EDIT MODAL ── -->
    <div class="modal" id="edit-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Edit Violation</h3>
                <button class="modal-close" id="close-edit">✕</button>
            </div>
            <form action="/test/admin/manage-violations/edit" method="POST" class="modal-form">
                <input type="hidden" name="id" id="edit-id">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="edit-name" placeholder="Violation name" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="edit-description" rows="3" placeholder="Describe the violation..."></textarea>
                </div>
                <div class="form-group">
                    <label>Fine Amount (₱)</label>
                    <input type="number" name="current_fine_amount" id="edit-fine" placeholder="e.g. 1000" min="0" step="0.01" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="close-edit">Cancel</button>
                    <button type="submit" class="btn-confirm">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ── DELETE MODAL ── -->
    <div class="modal" id="delete-modal">
        <div class="modal-box modal-box-sm">
            <div class="modal-header">
                <h3>Delete Violation</h3>
                <button class="modal-close" id="close-delete">✕</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this violation? This cannot be undone.</p>
            </div>
            <form action="/test/admin/manage-violations/delete" method="POST">
                <input type="hidden" name="id" id="delete-id">
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="close-delete">Cancel</button>
                    <button type="submit" class="btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>