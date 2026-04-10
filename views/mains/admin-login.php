<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login | TikTrakPH</title>

        <link rel="stylesheet" href="/test/views/assets/css/main.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-login.css">
        <link rel="stylesheet" href="/test/views/assets/css/footer.css">

        <script src="/test/views/assets/js/admin-login.js" defer></script>
    </head>
    <body>
        <header>
            <a href="/test/admin" class="admin-brand">
                <div class="brand-logo">T</div>
                <div class="brand-text">
                    <span>TikTrakPH</span>
                    <small>Admin System</small>
                </div>
            </a>
        </header>
        
        <main>
            <div class="content-container">
                <div class="login-form-container">
                    <form action="/test/admin/login" class="login-form" id="login-form" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username">
                            <p class="error-msg" id="username-error"></p>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password">
                            <p class="error-msg" id="password-error"></p>
                        </div>

                        <?php if ($error): ?>
                            <p class="login-error"><?= $error ?></p>
                        <?php endif; ?>

                        <button type="submit" id="login-btn">Login</button>
                    </form>
                </div>
            </div>
        </main>

        <footer>
            <?php require('views/partials/footer.php'); ?>
        </footer>
    </body>
</html>