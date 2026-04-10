<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Admins | TikTrakPH</title>

        <link rel="stylesheet" href="/test/views/assets/css/main.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-brand.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-sidebar.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-manage-admins.css">

        <script src="/test/views/assets/js/manage-admins.js" defer></script>

    </head>
    <body>
        <?php require("views/partials/admin-sidebar.php")?>

        <main>
            <div class="page-header">
                <h3 class="page-title">Manage Admins</h3>
                <button id="add-btn">Add Admin</button>
            </div>

            <div class="table-wrap">
                <div class="table-scroll">
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>Admin ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($admins)): ?>
                                <tr>
                                    <td colspan="5" class="empty-row">No admins found.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($admins as $admin): ?>
                                    <tr>
                                        <td class="cell-id">#<?php echo $admin['id'] ?></td>
                                        <td class="cell-name"><?php echo $admin['first_name'] ?></td>
                                        <td class="cell-name"><?php echo $admin['last_name'] ?></td>
                                        <td class="cell-username">@<?php echo $admin['username'] ?></td>
                                        <td class="cell-actions">
                                            <button class="btn-edit" data-id="<?php echo $admin['id'] ?>">Edit</button>
                                            <button class="btn-delete" data-id="<?php echo $admin['id'] ?>">Delete</button>
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
                    <h3>Add Admin</h3>
                    <button class="modal-close" id="close-add">✕</button>
                </div>
                <form action="/test/admin/manage-admins/add" method="POST" class="modal-form">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" id="close-add">Cancel</button>
                        <button type="submit" class="btn-confirm">Add Admin</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ── EDIT MODAL ── -->
        <div class="modal" id="edit-modal">
            <div class="modal-box">
                <div class="modal-header">
                    <h3>Edit Admin</h3>
                    <button class="modal-close" id="close-edit">✕</button>
                </div>
                <form action="/test/admin/manage-admins/edit" method="POST" class="modal-form">
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
                        <label>Username</label>
                        <input type="text" name="username" id="edit-username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label>New Password <span class="optional">(leave blank to keep current)</span></label>
                        <input type="password" name="password" id="edit-password" placeholder="New password">
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
                    <h3>Delete Admin</h3>
                    <button class="modal-close" id="close-delete">✕</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this admin? This cannot be undone.</p>
                </div>
                <form action="/test/admin/manage-admins/delete" method="POST">
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