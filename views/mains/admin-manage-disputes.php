<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Disputes | TikTrakPH</title>

    <link rel="stylesheet" href="/test/views/assets/css/main.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-brand.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-sidebar.css">
    <link rel="stylesheet" href="/test/views/assets/css/admin-manage-disputes.css">

    <script src="/test/views/assets/js/manage-disputes.js" defer></script>
</head>
<body>
    <?php require("views/partials/admin-sidebar.php") ?>

    <main>
        <div class="page-header">
            <h3 class="page-title">Manage Disputes</h3>
        </div>

        <div class="table-wrap">
            <div class="table-scroll">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ticket ID</th>
                            <th>Motorist</th>
                            <th>Title</th>
                            <th>Explanation</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($disputes)): ?>
                            <tr>
                                <td colspan="8" class="empty-row">No disputes found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($disputes as $dispute): ?>
                                <tr>
                                    <td class="cell-id">#<?= $dispute['id'] ?></td>
                                    <td class="cell-id">#<?= $dispute['ticket_id'] ?></td>
                                    <td class="cell-name"><?= htmlspecialchars($dispute['first_name'] . ' ' . $dispute['last_name']) ?></td>
                                    <td class="cell-title"><?= htmlspecialchars($dispute['title']) ?></td>
                                    <td class="cell-explanation"><?= htmlspecialchars($dispute['explanation']) ?></td>
                                    <td class="cell-date"><?= date('M d, Y', strtotime($dispute['submitted_at'])) ?></td>
                                    <td><span class="badge badge-<?= $dispute['status'] ?>"><?= ucfirst(str_replace('_', ' ', $dispute['status'])) ?></span></td>
                                    <td class="cell-actions">
                                        <button class="btn-review"
                                            data-id="<?= $dispute['id'] ?>"
                                            data-ticket="<?= $dispute['ticket_id'] ?>"
                                            data-name="<?= htmlspecialchars($dispute['first_name'] . ' ' . $dispute['last_name']) ?>"
                                            data-title="<?= htmlspecialchars($dispute['title']) ?>"
                                            data-explanation="<?= htmlspecialchars($dispute['explanation']) ?>">
                                            Review
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- ── REVIEW MODAL ── -->
    <div class="modal" id="review-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Review Dispute</h3>
                <button class="modal-close" id="close-review">✕</button>
            </div>
            <div class="modal-body">
                <div class="dispute-info">
                    <div class="dispute-info-item">
                        <span class="dispute-info-label">Ticket ID</span>
                        <span class="dispute-info-value cell-id" id="review-ticket"></span>
                    </div>
                    <div class="dispute-info-item">
                        <span class="dispute-info-label">Motorist</span>
                        <span class="dispute-info-value cell-name" id="review-name"></span>
                    </div>
                    <div class="dispute-info-item">
                        <span class="dispute-info-label">Title</span>
                        <span class="dispute-info-value" id="review-title"></span>
                    </div>
                    <div class="dispute-info-item">
                        <span class="dispute-info-label">Explanation</span>
                        <span class="dispute-info-value" id="review-explanation"></span>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 16px;">
                    <label>Admin Notes <span class="optional">(optional)</span></label>
                    <textarea id="review-notes" name="admin_notes" rows="3" placeholder="Add notes for the motorist..."></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" id="close-review">Cancel</button>
                <form action="/test/admin/manage-disputes/reject" method="POST" style="display:inline;">
                    <input type="hidden" name="id" id="reject-id">
                    <input type="hidden" name="admin_notes" id="reject-notes">
                    <button type="submit" class="btn-danger">Reject</button>
                </form>
                <form action="/test/admin/manage-disputes/resolve" method="POST" style="display:inline;">
                    <input type="hidden" name="id" id="resolve-id">
                    <input type="hidden" name="admin_notes" id="resolve-notes">
                    <button type="submit" class="btn-resolve">Resolve</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>