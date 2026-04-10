<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Profile | TikTrakPH</title>
        <link rel="stylesheet" href="/test/views/assets/css/main.css">
        <link rel="stylesheet" href="/test/views/assets/css/user-nav.css">
        <link rel="stylesheet" href="/test/views/assets/css/user-profile.css">
        <link rel="stylesheet" href="/test/views/assets/css/footer.css">
    </head>

    <body>
        <header>
            <?php require("views/partials/user-nav.php"); ?>
        </header>

        <main>
            <div class="profile-hero">
                <div class="profile-hero-inner">
                    <p class="profile-greeting">Account Settings</p>
                    <h1><?= $user['first_name'] . ' ' . $user['last_name'] ?></h1>
                    <p class="profile-username">@<?= $user['username'] ?></p>
                </div>
            </div>

            <div class="profile-container">
                <div class="profile-card">
                    <div class="profile-card-header">
                        <div>
                            <div class="section-label">Account</div>
                            <h2 class="section-title">Personal Information</h2>
                        </div>
                        <a href="/test/user-dashboard/edit-profile" class="btn-edit">✏️ Edit</a>
                    </div>

                    <div class="profile-info-list">
                        <div class="profile-info-item">
                            <span class="profile-info-label">First Name</span>
                            <span class="profile-info-value"><?= htmlspecialchars($user['first_name']) ?></span>
                        </div>
                        <div class="profile-info-item">
                            <span class="profile-info-label">Last Name</span>
                            <span class="profile-info-value"><?= htmlspecialchars($user['last_name']) ?></span>
                        </div>
                        <div class="profile-info-item">
                            <span class="profile-info-label">Username</span>
                            <span class="profile-info-value">@<?= htmlspecialchars($user['username']) ?></span>
                        </div>
                        <div class="profile-info-item">
                            <span class="profile-info-label">Phone</span>
                            <span class="profile-info-value"><?= htmlspecialchars($user['phone']) ?></span>
                        </div>
                        <div class="profile-info-item">
                            <span class="profile-info-label">License Number</span>
                            <span class="profile-info-value license"><?= htmlspecialchars($user['license_number']) ?></span>
                        </div>
                        <div class="profile-info-item">
                            <span class="profile-info-label">Member Since</span>
                            <span class="profile-info-value"><?= date('M d, Y', strtotime($user['created_at'])) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer>
            <?php require('views/partials/footer.php'); ?>
        </footer>
    </body>
</html>