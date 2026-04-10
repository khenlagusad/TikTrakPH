<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Issue a Ticket | TikTrakPH</title>
<link rel="stylesheet" href="/test/views/assets/css/main.css">
<link rel="stylesheet" href="/test/views/assets/css/admin-brand.css">
<link rel="stylesheet" href="/test/views/assets/css/admin-sidebar.css">
<link rel="stylesheet" href="/test/views/assets/css/issue-ticket.css">
<script src="/test/views/assets/js/issue-ticket.js" defer></script>
</head>
<body>

<div class="layout">

  <?php require("views/partials/admin-sidebar.php"); ?>

  <main class="main-content">

    <div class="it-hero">
      <div class="it-hero-inner">
        <div class="it-badge"><span>New Ticket</span></div>
        <h1>Issue a Ticket</h1>
        <p>Fill in the details below to issue a new violation ticket.</p>
      </div>
    </div>

    <div class="it-body">

      <div class="it-ref-banner">
        <div>
          <span class="it-ref-label">Reference Number</span>
          <span class="it-ref-val"><?= htmlspecialchars($nextRefNumber) ?></span>
        </div>
        <span class="it-ref-badge">Auto-generated</span>
      </div>

      <div class="it-card">
        <div class="it-card-header">
          <div class="it-card-icon">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
              <rect x="2" y="2" width="14" height="14" rx="3" stroke="#0038a8" stroke-width="1.5"/>
              <path d="M6 6h6M6 9h6M6 12h4" stroke="#0038a8" stroke-width="1.4" stroke-linecap="round"/>
            </svg>
          </div>
          <div>
            <div class="it-card-title">Ticket Details</div>
            <div class="it-card-sub">All fields are required to issue the ticket</div>
          </div>
        </div>

        <form action="/test/admin/issue-ticket/submit" method="POST" id="issue-form">
          <input type="hidden" name="ref_number" value="<?= htmlspecialchars($nextRefNumber) ?>">
          <div class="it-form-body">

            <!-- Row 1: Plate + License -->
            <div class="it-form-grid">
              <div class="form-group">
                <label for="plate_number">Plate Number</label>
                <select id="plate_number" name="plate_number">
                  <option value="" disabled selected>Select plate number</option>
                  <?php foreach ($vehicles as $v): ?>
                    <option value="<?= htmlspecialchars($v['plate_number']) ?>" data-license="<?= htmlspecialchars($v['license_number']) ?>">
                      <?= htmlspecialchars($v['plate_number']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <p class="it-error" id="error-plate"></p>
              </div>

              <div class="form-group">
                <label for="license_number">License Number</label>
                <input type="text" id="license_number" name="license_number"
                  placeholder="Auto-filled from plate" readonly>
                <span class="it-locked-note">
                  <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                    <rect x="2" y="5" width="8" height="6" rx="1.5" stroke="#b0bec5" stroke-width="1.2"/>
                    <path d="M4 5V4a2 2 0 014 0v1" stroke="#b0bec5" stroke-width="1.2"/>
                  </svg>
                  Auto-filled on plate select
                </span>
              </div>
            </div>

            <hr class="it-divider">

            <!-- Row 2: Violation + Enforcer -->
            <div class="it-form-grid">
              <div class="form-group">
                <label for="violation_type">Violation Type</label>
                <select id="violation_type" name="violation_id">
                  <option value="" disabled selected>Select violation</option>
                  <?php foreach ($violations as $v): ?>
                    <option value="<?= $v['id'] ?>"><?= htmlspecialchars($v['name']) ?></option>
                  <?php endforeach; ?>
                </select>
                <p class="it-error" id="error-violation"></p>
              </div>

              <div class="form-group">
                <label for="enforcer">Enforcer Name</label>
                <select id="enforcer" name="enforcer_id">
                  <option value="" disabled selected>Select enforcer</option>
                  <?php foreach ($enforcers as $e): ?>
                    <option value="<?= $e['id'] ?>">
                      <?= htmlspecialchars($e['first_name'] . ' ' . $e['last_name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <p class="it-error" id="error-enforcer"></p>
              </div>
            </div>

            <hr class="it-divider">

            <!-- Row 3: City full width -->
            <div class="form-group">
              <label for="city">City</label>
              <select id="city" name="city_id">
                <option value="" disabled selected>Select city</option>
                <?php foreach ($cities as $c): ?>
                  <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                <?php endforeach; ?>
              </select>
              <p class="it-error" id="error-city"></p>
            </div>

            <hr class="it-divider">

            <?php if (!empty($error)): ?>
              <div class="it-alert"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div class="it-actions">
              <a href="/test/admin/admin-dashboard" class="it-btn-cancel">Cancel</a>
              <button type="submit" class="it-btn-submit">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                  <path d="M2 7h10M8 3l4 4-4 4" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Issue Ticket
              </button>
            </div>

          </div>
        </form>
      </div>
    </div>

  </main>
</div>

</body>
</html>