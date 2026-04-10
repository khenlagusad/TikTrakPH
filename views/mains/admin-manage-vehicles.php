<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Vehicles | TikTrakPH</title>

    <link rel="stylesheet" href="/test/views/assets/css/main.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-brand.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-sidebar.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-manage-vehicles.css">

    <script src="/test/views/assets/js/manage-vehicles.js" defer></script>
</head>
<body>
    <?php require("views/partials/admin-sidebar.php") ?>

    <main>
        <div class="page-header">
            <h3 class="page-title">Manage Vehicles</h3>
            <button id="add-btn">Add Vehicle</button>
        </div>

        <div class="table-wrap">
            <div class="table-scroll">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Owner</th>
                            <th>Plate Number</th>
                            <th>Brand</th>
                            <th>Year</th>
                            <th>Model</th>
                            <th>Color</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($vehicles)): ?>
                            <tr>
                                <td colspan="8" class="empty-row">No vehicles found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($vehicles as $vehicle): ?>
                                <tr>
                                    <td class="cell-id">#<?= $vehicle['id'] ?></td>
                                    <td class="cell-name"><?= htmlspecialchars($vehicle['first_name'] . ' ' . $vehicle['last_name']) ?></td>
                                    <td class="cell-plate"><?= htmlspecialchars($vehicle['plate_number']) ?></td>
                                    <td class="cell-text"><?= htmlspecialchars($vehicle['brand']) ?></td>
                                    <td class="cell-text"><?= htmlspecialchars($vehicle['year']) ?></td>
                                    <td class="cell-text"><?= htmlspecialchars($vehicle['model']) ?></td>
                                    <td class="cell-text"><?= htmlspecialchars($vehicle['color']) ?></td>
                                    <td class="cell-actions">
                                        <button class="btn-edit"
                                            data-id="<?= $vehicle['id'] ?>"
                                            data-user-id="<?= $vehicle['user_id'] ?>"
                                            data-plate="<?= htmlspecialchars($vehicle['plate_number']) ?>"
                                            data-color="<?= htmlspecialchars($vehicle['color']) ?>">
                                            Edit
                                        </button>
                                        <button class="btn-delete"
                                            data-id="<?= $vehicle['id'] ?>">
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
                <h3>Add Vehicle</h3>
                <button class="modal-close" id="close-add">✕</button>
            </div>
            <form action="/test/admin/manage-vehicles/add" method="POST" class="modal-form">
                <div class="form-group">
                    <label>Owner</label>
                    <select name="user_id" required>
                        <option value="">-- Select a user --</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>">
                                <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?> (@<?= $user['username'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Plate Number</label>
                    <input type="text" name="plate_number" placeholder="e.g. ABC-1234" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Brand</label>
                        <input type="text" name="brand" placeholder="e.g. Toyota" required>
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <input type="number" name="year" placeholder="e.g. 2020" min="1990" max="2026" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Model</label>
                        <input type="text" name="model" placeholder="e.g. Vios" required>
                    </div>
                    <div class="form-group">
                        <label>Color</label>
                        <input type="text" name="color" placeholder="e.g. White" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="close-add">Cancel</button>
                    <button type="submit" class="btn-confirm">Add Vehicle</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ── EDIT MODAL ── -->
    <div class="modal" id="edit-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Edit Vehicle</h3>
                <button class="modal-close" id="close-edit">✕</button>
            </div>
            <form action="/test/admin/manage-vehicles/edit" method="POST" class="modal-form">
                <input type="hidden" name="id" id="edit-id">
                <div class="form-group">
                    <label>Owner</label>
                    <select name="user_id" id="edit-user-id" required>
                        <option value="">-- Select a user --</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>">
                                <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?> (@<?= $user['username'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Plate Number</label>
                    <input type="text" name="plate_number" id="edit-plate" placeholder="e.g. ABC-1234" required>
                </div>
                <div class="form-group">
                    <label>Color</label>
                    <input type="text" name="color" id="edit-color" placeholder="e.g. White" required>
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
                <h3>Delete Vehicle</h3>
                <button class="modal-close" id="close-delete">✕</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this vehicle? This cannot be undone.</p>
            </div>
            <form action="/test/admin/manage-vehicles/delete" method="POST">
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