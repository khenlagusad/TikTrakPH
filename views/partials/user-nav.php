<nav class="user-nav">
    <div class="left-nav">
        <a href="/test/user-dashboard" class="brand-logo">T</a>
        <a class="user-profile-btn" href="/test/user-dashboard/user-profile">
            <p class="username"><?= $user['username'] ?></p>
            <p class="license-no"><?= $user['license_number'] ?></p>
        </a>
    </div>
    <div class="right-nav">
        <a href="/test/user-dashboard/logout">Logout</a>
    </div>
</nav>