<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | TikTrakPH</title>

        <link rel="stylesheet" href="views/assets/css/main.css">
        <link rel="stylesheet" href="views/assets/css/home-nav.css">
        <link rel="stylesheet" href="views/assets/css/login.css">
        <link rel="stylesheet" href="views/assets/css/footer.css">

        <script src="views/assets/js/login.js" defer></script>
    </head>

    <body>
        <header>
            <?php require("views/partials/home-nav.php"); ?>
        </header>
        
        <main>
            <div class="login-hero">
                <div class="login-hero-inner">
                    <div class="login-badge">🔐 Secure Login</div>
                    <h1>Welcome Back</h1>
                    <p>Log in to manage your violations, payments, and disputes.</p>
                </div>
            </div>

            <div class="login-container">
                <div class="login-card">
                    <div class="login-card-header">
                        <h2>Sign In</h2>
                        <p>Enter your credentials to continue.</p>
                    </div>

                    <form action="/test/login" method="POST" id="login-form" novalidate>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" placeholder="e.g. juan_delacruz">
                            <p class="error-msg" id="error-username"></p>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Your password">
                            <p class="error-msg" id="error-password"></p>
                        </div>

                        <?php if ($error): ?>
                            <p class="login-error"><?= $error ?></p>
                        <?php endif; ?>

                        <button type="submit" id="login-btn">Login</button>

                        <p class="register-link">Don't have an account? <a href="register.php">Register here!</a></p>
                    </form>
                </div>
            </div>
        </main>

        <footer>
            <?php require('views/partials/footer.php'); ?>
        </footer>
    </body>
</html>