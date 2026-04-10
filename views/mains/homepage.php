<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home | TikTrakPH</title>

        <link rel="stylesheet" href="views/assets/css/main.css">
        <link rel="stylesheet" href="views/assets/css/home-nav.css">
        <link rel="stylesheet" href="views/assets/css/homepage.css">
        <link rel="stylesheet" href="views/assets/css/footer.css">
        
        <script src="views/assets/js/homepage.js" defer></script>
    </head>

    <body>

    <header>
       <?php require('views/partials/home-nav.php'); ?>
    </header>

    <main>
        <div class="hero">
            <div class="hero-badge">🏙️ Official Metro Manila Portal</div>
            <h1>Settle Your Traffic Violations<br><span>Without Leaving Home</span></h1>
            <p>Search, pay, or dispute traffic tickets from all 17 Metro Manila LGUs — in one place.</p>

            <div class="search-box">
                <h3>Search Your Tickets</h3>
                <div class="search-tabs">
                    <button class="tab active" id="plate-num">🚗 Plate Number</button>
                    <button class="tab" id="license-num">🪪 License Number</button>
                </div>
                <form action="/test/search-violations" method="POST" id="search-form">
                    <div class="search-input-wrap">
                        <input type="text" id="search-input" name="plate_no" placeholder="e.g. ABC-1234">
                        <button type="submit" id="search-btn">Search</button>
                    </div>
                    <p class="error-msg" id="error">Error Msg</p>
                </form>
            </div>
        </div>

        <div class="stats">
            <div class="stat">
                <div class="stat-number">17</div>
                <div class="stat-label">Metro Manila LGUs</div>
            </div>
            <div class="stat">
                <div class="stat-number">1</div>
                <div class="stat-label">Unified Portal</div>
            </div>
            <div class="stat">
                <div class="stat-number">3</div>
                <div class="stat-label">Steps to Settle</div>
            </div>
            <div class="stat">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Online Access</div>
            </div>
        </div>

        <!-- FEATURES -->
        <section>
            <div class="section-label">What You Can Do</div>
            <h2 class="section-title">Everything You Need<br>In One Portal</h2>
            <p class="section-sub">No more going from city to city. Handle everything online, anytime.</p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🔍</div>
                    <h3>Search Violations</h3>
                    <p>Look up tickets using your plate or license number. Works even without an account — no registration required.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💳</div>
                    <h3>Pay Online</h3>
                    <p>Settle your fines without visiting city hall. Submit your payment and get it verified by the issuing LGU.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚖️</div>
                    <h3>File a Dispute</h3>
                    <p>Think a ticket is unfair? Upload your evidence and submit a dispute directly to the city admin for review.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📋</div>
                    <h3>Track Everything</h3>
                    <p>Register for an account to track all your tickets, payment statuses, and dispute outcomes in one dashboard.</p>
                </div>
            </div>
        </section>

        <div class="how-section">
            <div>
                <div class="section-label">How It Works</div>
                <h2 class="section-title">Settle in 3 Simple Steps</h2>
                <p class="section-sub">The whole process takes less than 5 minutes from your phone or computer.</p>

                <div class="steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h3>Search Your Ticket</h3>
                        <p>Enter your plate or license number to find all your outstanding violations across Metro Manila.</p>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <h3>Review & Choose</h3>
                        <p>See the details of each ticket — violation type, fine amount, issuing city — then decide to pay or dispute.</p>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <h3>Submit & Wait</h3>
                        <p>Submit your payment or dispute. The city admin reviews and updates the status — you'll see it reflected here.</p>
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