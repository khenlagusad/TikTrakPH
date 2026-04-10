<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Tickets | TikTrakPH</title>

        <link rel="stylesheet" href="/test/views/assets/css/main.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-brand.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-sidebar.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-view-tickets.css">
    </head>
    <body>
        <?php require("views/partials/admin-sidebar.php")?>
        
        <main>
            <h3 class="page-title">View Tickets</h3>
            <div class="table-wrap">
                <div class="table-scroll">
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>Ticket ID</th>
                                <th>Ref ID</th>
                                <th>User Ticketed</th>
                                <th>Violation</th>
                                <th>Enforcer</th>
                                <th>City</th>
                                <th>Issued At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($tickets)): ?>
                                <tr>
                                    <td colspan="7" class="empty-row">No tickets found.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($tickets as $ticket): ?>
                                    <tr>
                                        <td class="cell-id">#<?php echo $ticket['ticket_id'] ?></td>
                                        <td class="cell-ref"><?php echo $ticket['ref_number'] ?></td>
                                        <td class="cell-name"><?php echo $ticket['user_ticketed'] ?></td>
                                        <td class="cell-violation"><?php echo $ticket['violation_name'] ?></td>
                                        <td class="cell-enforcer"><?php echo $ticket['enforcer_name'] ?></td>
                                        <td class="cell-city"><?php echo $ticket['city_name'] ?></td>
                                        <td class="cell-date"><?php echo date('M d, Y', strtotime($ticket['issued_at'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </body>
</html>