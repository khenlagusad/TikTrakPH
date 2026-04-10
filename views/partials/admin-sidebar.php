<nav class="side-bar">
  <?php require("views/partials/admin-brand.php") ?>

  <div class="sb-user">
    <div class="sb-avatar">
      <?php echo strtoupper(substr($admin['first_name'], 0, 1)) ?>
    </div>
    <div>
      <div class="sb-uname"><?php echo $admin['first_name'] ?></div>
      <div class="sb-handle">@<?php echo $admin['username'] ?></div>
    </div>
  </div>

  <div class="sb-issue">
    <a href="/test/admin/issue-ticket">+ Issue a Ticket</a>
  </div>

  <hr class="sb-sep">
  <div class="sb-label">Overview</div>
  <div class="sb-links">
    <a class="nav-links" href="/test/admin/view-payments">View Payments</a>
    <a class="nav-links" href="/test/admin/view-tickets">View Tickets</a>
  </div>

  <hr class="sb-sep">
  <div class="sb-label">Manage</div>
  <div class="sb-links">
    <a class="nav-links" href="/test/admin/manage-admins">Admins</a>
    <a class="nav-links" href="/test/admin/manage-disputes">Disputes</a>
    <a class="nav-links" href="/test/admin/manage-enforcers">Enforcers</a>
    <a class="nav-links" href="/test/admin/manage-users">Users</a>
    <a class="nav-links" href="/test/admin/manage-vehicles">Vehicles</a>
    <a class="nav-links" href="/test/admin/manage-violations">Violations</a>
  </div>

  <div class="sb-footer">
    <a id="logout-btn" href="/test/admin/admin-dashboard/logout">Logout</a>
  </div>
</nav>