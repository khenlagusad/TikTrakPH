<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard | TikTrakPH</title>

        <link rel="stylesheet" href="/test/views/assets/css/main.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-brand.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-sidebar.css">
        <link rel="stylesheet" href="/test/views/assets/css/admin-dashboard.css">
    </head>
    <body>
        <?php require("views/partials/admin-sidebar.php")?>

        <main>
            <div class="content-container">
                <div class="dashboard-info" id="user-count-container">
                    <!-- User logo -->
                     <p id="user-label">Total User</p>
                     <p id="user-count"><?php echo $totalUsers ?></p>
                </div>

                <div class="dashboard-info" id="vehicle-count-container">
                    <!-- Vehicle logo -->
                     <p id="vehicle-label">Total Registered Vehicles</p>
                     <p id="vehicle-count"><?php echo $totalVehicles ?></p>
                </div>

                <div class="dashboard-info" id="ticket-count-container">
                    <!-- Ticket logo -->
                     <p id="ticket-label">Total Tickets</p>
                     <p id="ticket-count"><?php echo $totalTickets ?></p>
                </div>

                <div class="dashboard-info" id="payments-container">
                    <p id="payments-label">Total Payments Received</p>
                    <p id="payments-count"><?php echo $totalPayments ?></p>
                </div>

                <div class="dashboard-info" id="disputes-container">
                    <p id="disputes-label">Unsettled Disputes</p>
                    <p id="disputes-count"><?php echo $unsettledDisputes ?></p>
                </div>

                <div class="dashboard-info" id="enforcers-container">
                    <p id="enforcers-label">Total Enforcers</p>
                    <p id="enforcers-count"><?php echo $totalEnforcers ?></p>
                </div>
            </div>
        </main>
    </body>
</html>