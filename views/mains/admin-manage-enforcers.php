<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Enforcers | TikTrakPH</title>

    <link rel="stylesheet" href="/test/views/assets/css/main.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-brand.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-sidebar.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-manage-enforcers.css">

    <script src="/test/views/assets/js/manage-enforcers.js" defer></script>
</head>
<body>
    <?php require("views/partials/admin-sidebar.php") ?>

    <main>
        <div class="page-header">
            <h3 class="page-title">Manage Enforcers</h3>
            <button id="add-btn">Add Enforcer</button>
        </div>

        <div class="table-wrap">
            <div class="table-scroll">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>City</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($enforcers)): ?>
                            <tr>
                                <td colspan="5" class="empty-row">No enforcers found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($enforcers as $enforcer): ?>
                                <tr>
                                    <td class="cell-id">#<?= $enforcer['id'] ?></td>
                                    <td class="cell-name"><?= htmlspecialchars($enforcer['first_name']) ?></td>
                                    <td class="cell-name"><?= htmlspecialchars($enforcer['last_name']) ?></td>
                                    <td class="cell-city"><?= htmlspecialchars($enforcer['city_name']) ?></td>
                                    <td class="cell-actions">
                                        <button class="btn-edit"
                                            data-id="<?= $enforcer['id'] ?>"
                                            data-first-name="<?= htmlspecialchars($enforcer['first_name']) ?>"
                                            data-last-name="<?= htmlspecialchars($enforcer['last_name']) ?>"
                                            data-city-id="<?= $enforcer['city_id'] ?>">
                                            Edit
                                        </button>
                                        <button class="btn-delete"
                                            data-id="<?= $enforcer['id'] ?>">
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
                <h3>Add Enforcer</h3>
                <button class="modal-close" id="close-add">✕</button>
            </div>
            <form action="/test/admin/manage-enforcers/add" method="POST" class="modal-form">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="Enter first name" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="Enter last name" required>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <select name="city_id" required>
                        <option value="">-- Select a city --</option>
                        <?php foreach ($cities as $city): ?>
                            <option value="<?= $city['id'] ?>"><?= htmlspecialchars($city['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="close-add">Cancel</button>
                    <button type="submit" class="btn-confirm">Add Enforcer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ── EDIT MODAL ── -->
    <div class="modal" id="edit-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Edit Enforcer</h3>
                <button class="modal-close" id="close-edit">✕</button>
            </div>
            <form action="/test/admin/manage-enforcers/edit" method="POST" class="modal-form">
                <input type="hidden" name="id" id="edit-id">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" id="edit-first-name" placeholder="First name" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" id="edit-last-name" placeholder="Last name" required>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <select name="city_id" id="edit-city-id" required>
                        <option value="">-- Select a city --</option>
                        <?php foreach ($cities as $city): ?>
                            <option value="<?= $city['id'] ?>"><?= htmlspecialchars($city['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
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
                <h3>Delete Enforcer</h3>
                <button class="modal-close" id="close-delete">✕</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this enforcer? This cannot be undone.</p>
            </div>
            <form action="/test/admin/manage-enforcers/delete" method="POST">
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