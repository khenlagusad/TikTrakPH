<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tickets | TikTrakPH</title>
    <link rel="stylesheet" href="/test/views/assets/css/main.css">
    <link rel="stylesheet" href="/test/views/assets/css/user-nav.css">
    <link rel="stylesheet" href="/test/views/assets/css/manage-tickets.css">
    <link rel="stylesheet" href="/test/views/assets/css/footer.css">

    <script src="/test/views/assets/js/manage-tickets.js" defer></script>
</head>
<body>
<header>
    <?php require("views/partials/user-nav.php"); ?>
</header>

<main>
    <div class="tickets-hero">
        <div class="tickets-hero-inner">
            <p class="tickets-greeting">My Tickets</p>
            <h1>Manage Tickets</h1>
            <p class="tickets-sub">Pay or dispute your outstanding violations.</p>
        </div>
    </div>

    <div class="tickets-container">

        <!-- ── ACTION CARD ── -->
        <div class="action-card">
            <div class="action-card-header">
                <div class="section-label">Quick Action</div>
                <h2 class="section-title">Select a Ticket</h2>
            </div>
            <div class="action-card-body">
                <form action="/test/user-dashboard/pay-ticket" method="POST" id="pay-form">
                    <div class="form-group">
                        <label for="ticket-select">Unpaid Tickets</label>
                        <select id="ticket-select" name="ticket_id">
                            <option value="">-- Select a ticket --</option>
                            <?php foreach($allTickets as $ticket): ?>
                                <?php
                                // Determine ticket status
                                if ($ticket['payment_id']) {
                                    $status = 'paid';
                                } elseif (!empty($ticket['dispute_status'])) {
                                    $status = $ticket['dispute_status']; // now works: pending, rejected, resolved
                                } else {
                                    $status = 'unpaid';
                                }

                                // Skip tickets that cannot be acted upon
                                if (in_array($status, ['paid','pending','resolved'])) continue;

                                // Determine if dispute button should be locked (true for rejected)
                                $lockDispute = $status === 'rejected' ? 'true' : 'false';
                                ?>
                                <option value="<?= $ticket['id'] ?>" 
                                        data-dispute="<?= $status ?>" 
                                        data-lock-dispute="<?= $lockDispute ?>">
                                    <?= htmlspecialchars($ticket['ref_number']) ?> — <?= htmlspecialchars($ticket['violation_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="action-buttons">
                        <button type="submit" class="btn-pay">💳 Pay Ticket</button>
                        <button type="button" class="btn-dispute" id="dispute-btn">📋 File Dispute</button>
                    </div>
                </form>

                <form action="/test/user-dashboard/file-dispute" method="POST" id="dispute-form">
                    <input type="hidden" name="ticket_id" id="dispute-ticket-id">
                </form>
            </div>
        </div>

        <!-- ── ALL TICKETS TABLE ── -->
        <div class="tickets-card">
            <div class="tickets-card-header">
                <div class="section-label">Overview</div>
                <h2 class="section-title">All Tickets</h2>
            </div>
            <div class="table-wrap">
                <?php if(count($allTickets) == 0): ?>
                    <div class="empty-state">
                        <div class="empty-icon">🎉</div>
                        <h3>No tickets found</h3>
                        <p>You have no traffic violations on record.</p>
                    </div>
                <?php else: ?>
                    <table class="tickets-table">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Violation</th>
                                <th>Plate Number</th>
                                <th>City</th>
                                <th>Issue Date</th>
                                <th>Amount Due</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($allTickets as $ticket):
                                $ref        = htmlspecialchars($ticket['ref_number']);
                                $violation  = htmlspecialchars($ticket['violation_name']);
                                $plate      = htmlspecialchars($ticket['plate_number']);
                                $city       = htmlspecialchars($ticket['city_name']);
                                $date       = date('M d, Y', strtotime($ticket['issued_at']));
                                $fine       = number_format($ticket['amount_due'], 2);

                                if ($ticket['payment_id']) {
                                    $status     = 'Paid';
                                    $badgeClass = 'badge-paid';
                                } elseif (!empty($ticket['dispute_status'])) {
                                    if ($ticket['dispute_status'] === 'pending') {
                                        $status     = 'Pending';
                                        $badgeClass = 'badge-pending';
                                    } elseif ($ticket['dispute_status'] === 'rejected') {
                                        $status     = 'Rejected';
                                        $badgeClass = 'badge-rejected';
                                    } elseif ($ticket['dispute_status'] === 'resolved') {
                                        $status     = 'Resolved';
                                        $badgeClass = 'badge-resolved';
                                    } else {
                                        $status     = 'Disputed';
                                        $badgeClass = 'badge-pending';
                                    }
                                } else {
                                    $status     = 'Unpaid';
                                    $badgeClass = 'badge-unpaid';
                                }

                                echo "
                                    <tr>
                                        <td><span class='ticket-ref'>$ref</span></td>
                                        <td><span class='violation-name'>$violation</span></td>
                                        <td>$plate</td>
                                        <td>$city</td>
                                        <td class='ticket-date'>$date</td>
                                        <td class='ticket-fine'>₱$fine</td>
                                        <td><span class='badge $badgeClass'>$status</span></td>
                                    </tr>
                                ";
                            endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

    </div>
</main>

<footer>
    <?php require('views/partials/footer.php'); ?>
</footer>
</body>
</html>
