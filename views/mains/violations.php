<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Violations | TikTrakPH</title>

         <link rel="stylesheet" href="views/assets/css/main.css">
        <link rel="stylesheet" href="views/assets/css/home-nav.css">
        <link rel="stylesheet" href="views/assets/css/violations.css">
        <link rel="stylesheet" href="views/assets/css/footer.css">
    </head>

    <body>

    <header>
        <?php require('views/partials/home-nav.php'); ?>
    </header>

    <main>
        <!-- Page Header -->
        <div class="violations-hero">
            <div class="violations-hero-inner">
                <div class="search-meta" id="search-meta">
                    <span class="search-meta-label">Results for 
                        <span class="info">
                            <?php
                                if ($plate != ''){
                                    echo $plate;
                                } else {
                                    echo $license;
                                }
                            ?>
                        </span>
                    </span>
                </div>
                <h1>Traffic Violations</h1>
                <p>All outstanding violations associated with this record.</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="violations-container">

            <!-- Settle Notice -->
            <div class="settle-notice">
                <div class="settle-notice-icon"></div>
                <div>
                    <strong>Want to settle or dispute a violation?</strong>
                    <span>You need an account to pay or file a dispute. <a href="register">Create one for free</a> or <a href="login">log in</a>.</span>
                </div>
            </div>
            <!-- Results Card -->
            <div class="violations-card">
                <div class="violations-card-header">
                    <div>
                        <h2>Violation Records</h2>
                        <p class="result-count" id="result-count"><?php echo count($tickets) . " tickets";?></p>
                    </div>
                    <a href="" class="btn-back">← New Search</a>
                </div>

                <!-- Scrollable Table -->
                <div class="table-wrap">
                    <table class="violations-table" id="violations-table">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Violation Type</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="violations-body">
                            <?php if(count($tickets) > 0): ?>
                                <?php foreach($tickets as $ticket): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($ticket['ref_number']); ?></td>
                                        <td><?php echo htmlspecialchars($ticket['violation_name']); ?></td>
                                        <td><?php echo htmlspecialchars($ticket['issued_at']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">
                                        <div class="empty-state">
                                            <h3>No Violations Found</h3>
                                            <p>There are no outstanding violations associated with this record.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </main>

    <footer>
        <?php require('views/partials/footer.php'); ?>
    </footer>

    </body>
</html>