<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> My Dashboard | TikTrakPH</title>

        <link rel="stylesheet" href="views/assets/css/main.css">
        <link rel="stylesheet" href="views/assets/css/user-nav.css">
        <link rel="stylesheet" href="views/assets/css/user-dashboard.css">
        <link rel="stylesheet" href="views/assets/css/footer.css">
    </head>
    <body>
        <header>
            <?php require("views/partials/user-nav.php"); ?>
        </header>

        <main>
            <div class="dashboard-hero">
                <div class="dashboard-hero-inner">
                    <div class="dashboard-welcome">
                        <p class="dashboard-greeting">Welcome Back,</p>
                        <h1><?php echo "{$user['first_name']}"; ?></h1>
                        <p class="dashboard-license">License No: <span><?php echo $user['license_number']?> </span></p>
                    </div>
                </div>
            </div>

            <!-- ── MAIN CONTENT ── -->
            <div class="dashboard-container">
                <div class="dashboard-grid">

                    <!-- ── LEFT: VEHICLES ── -->
                    <div class="dashboard-section">
                        <div class="section-header">
                            <div class="section-label">Registered</div>
                            <h2 class="section-title">Your Vehicles</h2>
                        </div>

                        <div class="vehicles-list">

                            <?php
                                if (count($vehicles) == 0){
                                    echo"
                                        <div class=\"empty-state\">
                                            <div class=\"empty-icon\">🚗</div>
                                            <h3>No vehicles registered</h3>
                                            <p>You have no vehicles linked to your account.</p>
                                        </div>
                                    ";
                                } else {
                                    foreach($vehicles as $vehicle) {
                                        echo "
                                            <div class='vehicle-card'>
                                                <div class='vehicle-icon'>🚗</div>
                                                <div class='vehicle-info'>
                                                    <span class='vehicle-plate'>{$vehicle['plate_number']}</span>
                                                    <span class='vehicle-brand'>{$vehicle['brand']}</span>
                                                    <span class='vehicle-model'>{$vehicle['year']} {$vehicle['model']}</span>
                                                    <span class='vehicle-color'>{$vehicle['color']}</span>
                                                </div>
                                            </div>
                                        ";
                                    }
                                }
                            ?>
                        </div>
                    </div>

                    <!-- ── RIGHT: TICKET RECORDS ── -->
                    <div class="dashboard-section">
                        <div class="section-header">
                            <div class="left-side">
                                <div class="section-label">Overview</div>
                                <h2 class="section-title">Active Tickets</h2>
                            </div>
                            <div class="right-side">
                                <a href="/test/user-dashboard/manage-tickets" class="btn-manage">Manage →</a>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="dashboard-card">
                            <div class="table-wrap">
                                <?php
                                    if (count($tickets) == 0){
                                        echo "
                                            <div class='empty-state'>
                                                <div class='empty-icon'>🎉</div>
                                                <h3>No violations found</h3>
                                                <p>You have no traffic violations on record.</p>
                                            </div>
                                        ";
                                    } else {
                                        echo "
                                            <table class='dashboard-table'>
                                                <thead>
                                                    <tr>
                                                        <th>Reference</th>
                                                        <th>Violation</th>
                                                        <th>Date</th>
                                                        <th>Fine</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                        ";

                                        foreach ($tickets as $ticket) {
                                            $ref       = htmlspecialchars($ticket['ref_number']);
                                            $violation = htmlspecialchars($ticket['violation_name']);
                                            $date      = date('M d, Y', strtotime($ticket['issued_at']));
                                            $fine      = number_format($ticket['current_fine_amount'], 2);
                                            $status = 'Unpaid';
                                            $badgeClass = 'badge-unpaid';

                                            if (!empty($ticket['dispute_status'])) {
                                                if ($ticket['dispute_status'] === 'pending') {
                                                    $status = 'Pending';
                                                    $badgeClass = 'badge-pending';
                                                } elseif ($ticket['dispute_status'] === 'rejected') {
                                                    $status = 'Rejected';
                                                    $badgeClass = 'badge-rejected';
                                                }
                                            }

                                            echo "
                                                <tr>
                                                    <td><span class='ticket-ref'>$ref</span></td>
                                                    <td><span class='violation-name'>$violation</span></td>
                                                    <td class='ticket-date'>$date</td>
                                                    <td class='ticket-fine'>₱$fine</td>
                                                    <td><span class='badge $badgeClass'>$status</span></td>
                                                </tr>
                                            ";
                                        }

                                        echo "
                                                </tbody>
                                            </table>
                                        ";
                                    }
                                ?>                                
                            </div>
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