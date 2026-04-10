<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>File Dispute | TikTrakPH</title>
        <link rel="stylesheet" href="/test/views/assets/css/main.css">
        <link rel="stylesheet" href="/test/views/assets/css/user-nav.css">
        <link rel="stylesheet" href="/test/views/assets/css/file-dispute.css">
        <link rel="stylesheet" href="/test/views/assets/css/footer.css">

        <script src="/test/views/assets/js/file-dispute.js" defer></script>
    </head>
    <body>
        <header>
            <?php require("views/partials/user-nav.php"); ?>
        </header>

        <main>
            <div class="dispute-hero">
                <div class="dispute-hero-inner">
                    <p class="dispute-greeting">Dispute</p>
                    <h1>File a Dispute</h1>
                    <p class="dispute-sub">Submit a dispute for review by our team.</p>
                </div>
            </div>

            <div class="dispute-container">

                <!-- ── TICKET INFO ── -->
                <div class="ticket-info-card">
                    <div class="ticket-info-header">
                        <div class="section-label">Ticket Information</div>
                        <h2 class="section-title">You are disputing this ticket</h2>
                    </div>
                    <div class="ticket-info-body">
                        <div class="ticket-info-item">
                            <span class="ticket-info-label">Reference Number</span>
                            <span class="ticket-ref"><?= htmlspecialchars($ticket['ref_number']) ?></span>
                        </div>
                    </div>
                </div>

                <!-- ── DISPUTE FORM ── -->
                <div class="dispute-card">
                    <div class="dispute-card-header">
                        <div class="section-label">Your Dispute</div>
                        <h2 class="section-title">Dispute Details</h2>
                    </div>

                    <form action="/test/user-dashboard/submit-dispute" method="POST" id="dispute-form">
                        <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                        <div class="dispute-form-wrap">

                            <div class="form-group">
                                <label for="title">Dispute Title</label>
                                <input type="text" id="title" name="title" placeholder="e.g. Wrong plate number recorded">
                                <p class="error-msg" id="error-title"></p>
                            </div>

                            <div class="form-group">
                                <label for="explanation">Explanation</label>
                                <textarea id="explanation" name="explanation" rows="6" placeholder="Explain why you are disputing this violation..."></textarea>
                                <p class="error-msg" id="error-explanation"></p>
                            </div>

                            <div class="form-actions">
                                <a href="/test/user-dashboard/manage-tickets" class="btn-cancel">Cancel</a>
                                <button type="submit" class="btn-submit">Submit Dispute</button>
                            </div>

                            <div class="error-msg">
                                <?php if ($error): ?>
                                    <p class="login-error"><?= $error ?></p>
                                <?php endif; ?>
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