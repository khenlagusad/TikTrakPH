<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | TikTrakPH</title>

    <link rel="stylesheet" href="/test/views/assets/css/main.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-brand.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-sidebar.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-manage-users.css">

    <script src="/test/views/assets/js/manage-users.js" defer></script>
</head>
<body>
    <?php require("views/partials/admin-sidebar.php") ?>

    <main>
        <div class="page-header">
            <h3 class="page-title">Manage Users</h3>
        </div>

        <div class="table-wrap">
            <div class="table-scroll">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>License Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="7" class="empty-row">No users found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td class="cell-id">#<?= $user['id'] ?></td>
                                    <td class="cell-name"><?= htmlspecialchars($user['first_name']) ?></td>
                                    <td class="cell-name"><?= htmlspecialchars($user['last_name']) ?></td>
                                    <td class="cell-username">@<?= htmlspecialchars($user['username']) ?></td>
                                    <td class="cell-phone"><?= htmlspecialchars($user['phone']) ?></td>
                                    <td class="cell-license"><?= htmlspecialchars($user['license_number']) ?></td>
                                    <td class="cell-actions">
                                        <button class="btn-edit"
                                            data-id="<?= $user['id'] ?>"
                                            data-first-name="<?= htmlspecialchars($user['first_name']) ?>"
                                            data-last-name="<?= htmlspecialchars($user['last_name']) ?>"
                                            data-username="<?= htmlspecialchars($user['username']) ?>"
                                            data-phone="<?= htmlspecialchars($user['phone']) ?>"
                                            data-license="<?= htmlspecialchars($user['license_number']) ?>">
                                            Edit
                                        </button>
                                        <button class="btn-delete"
                                            data-id="<?= $user['id'] ?>">
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

    <!-- ── EDIT MODAL ── -->
    <div class="modal" id="edit-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Edit User</h3>
                <button class="modal-close" id="close-edit">✕</button>
            </div>
            <form action="/test/admin/manage-users/edit" method="POST" class="modal-form">
                <input type="hidden" name="id" id="edit-id">
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" id="edit-first-name" placeholder="First name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" id="edit-last-name" placeholder="Last name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="edit-username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" id="edit-phone" placeholder="Phone number" required>
                </div>
                <div class="form-group">
                    <label>License Number</label>
                    <input type="text" name="license_number" id="edit-license" placeholder="License number" required>
                </div>
                <div class="form-group">
                    <label>New Password <span class="optional">(leave blank to keep current)</span></label>
                    <input type="password" name="password" id="edit-password" placeholder="Min. 6 characters">
                    <p class="error-msg" id="error-password"></p>
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
                <h3>Delete User</h3>
                <button class="modal-close" id="close-delete">✕</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user? This cannot be undone.</p>
            </div>
            <form action="/test/admin/manage-users/delete" method="POST">
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