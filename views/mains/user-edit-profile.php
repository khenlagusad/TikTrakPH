<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Profile | TikTrakPH</title>

        <link rel="stylesheet" href="/test/views/assets/css/main.css">
        <link rel="stylesheet" href="/test/views/assets/css/user-nav.css">
        <link rel="stylesheet" href="/test/views/assets/css/user-profile.css">
        <link rel="stylesheet" href="/test/views/assets/css/footer.css">

        <script src="/test/views/assets/js/edit-profile.js" defer></script>
    </head>
    <body>
        <header>
            <?php require("views/partials/user-nav.php"); ?>
        </header>

        <main>
            <div class="profile-hero">
                <div class="profile-hero-inner">
                    <p class="profile-greeting">Account Settings</p>
                    <h1>Edit Profile</h1>
                    <p class="profile-username">@<?= $user['username'] ?></p>
                </div>
            </div>

            <div class="profile-container">
                <div class="profile-card">
                    <div class="profile-card-header">
                        <div>
                            <div class="section-label">Account</div>
                            <h2 class="section-title">Edit Personal Information</h2>
                        </div>
                    </div>

                    <?php if ($error): ?>
                        <div class="profile-error"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="/test/user-dashboard/edit-profile" method="POST" id="edit-form">
                        <div class="profile-form-wrap">

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>">
                                <p class="error-msg" id="error-username"></p>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
                                <p class="error-msg" id="error-phone"></p>
                            </div>

                            <div class="form-group">
                                <label for="password">New Password <span class="optional">(leave blank to keep current)</span></label>
                                <input type="text" id="password" name="password" placeholder="Enter new password">
                                <p class="error-msg" id="error-password"></p>
                            </div>

                            <div class="form-actions">
                                <a href="/test/user-dashboard/user-profile" class="btn-cancel">Cancel</a>
                                <button type="submit" class="btn-save">Save Changes</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </main>

        <footer>
            <?php require('views/partials/footer.php'); ?>
        </footer>
    </body>
</html>