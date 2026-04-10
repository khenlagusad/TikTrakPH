<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Payments | TikTrakPH</title>

        <link rel="stylesheet" href="/test/views/assets/css/main.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-brand.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-sidebar.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-view-payments.css">
    </head>

    <body>
        <?php require("views/partials/admin-sidebar.php")?>

        <main>
            <h3 class="total-payments">View Payments</h3>

            <div class="table-wrap">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>Name of Payer</th>
                            <th>Amount Paid</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($payments)): ?>
                            <tr>
                                <td colspan="4" style="text-align:center; color:#8a9bb5;">No payments found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td>#<?php echo $payment['payment_id'] ?></td>
                                    <td><?php echo $payment['payer_name'] ?></td>
                                    <td>₱<?php echo number_format($payment['amount_paid'], 2) ?></td>
                                    <td><?php echo date('M d, Y', strtotime($payment['payment_date'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>