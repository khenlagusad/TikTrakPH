<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register | TikTrakPH</title>

        <link rel="stylesheet" href="views/assets/css/main.css">
        <link rel="stylesheet" href="views/assets/css/home-nav.css">
        <link rel="stylesheet" href="views/assets/css/register.css">
        <link rel="stylesheet" href="views/assets/css/footer.css">

        <script src="views/assets/js/register.js" defer></script>
    </head>

    <body>
        <header>
            <?php require("views/partials/home-nav.php"); ?>
        </header>

        <main>
            <div class="register-hero">
                <div class="register-hero-inner">
                    <div class="register-badge">🪪 Create Your Account</div>
                    <h1>Join TikTrakPH</h1>
                    <p>Register to pay violations, file disputes, and track your tickets in one place.</p>
                </div>
            </div>

            <div class="register-container">
                <div class="register-card">
                    <div class="register-card-header">
                        <h2>Personal Information</h2>
                        <p>All fields are required unless stated otherwise.</p>
                    </div>

                    <form action="/test/register" method="POST" id="register-form" novalidate>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" placeholder="e.g. Juan" value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>">
                                <p class="error-msg" id="error-first_name"></p>
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" placeholder="e.g. dela Cruz" value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>">
                                <p class="error-msg" id="error-last_name"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="e.g. juan_delacruz" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                            <p class="error-msg" id="error-username"></p>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="At least 6 characters">
                            <p class="error-msg" id="error-password"></p>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" placeholder="e.g. 09171234567" maxlength="11" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                            <p class="error-msg" id="error-phone"></p>
                        </div>

                        <div class="form-group">
                            <label for="license_no">Driver's License Number</label>
                            <input type="text" id="license_no" name="license_no" placeholder="e.g. N01-23-456789" maxlength="15" value="<?= htmlspecialchars($_POST['license_no'] ?? '') ?>">
                            <p class="error-msg" id="error-license_no"></p>
                        </div>

                        <?php if ($error): ?>
                            <div class="register-error"><?= $error ?></div>
                        <?php endif; ?>

                        <?php if ($success): ?>
                            <div class="register-success"><?= $success ?></div>
                        <?php endif; ?>

                        <button type="submit" id="register-btn">Create Account</button>
                        <p class="login-link">Already have an account? <a href="/test/login">Log in here</a></p>

                    </form>
                </div>
            </div>
        </main>

        <footer>
            <?php require('views/partials/footer.php'); ?>
        </footer>
    </body>
</html>