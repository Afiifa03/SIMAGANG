<nav>
    <div style="font-size: 24px; font-weight: bold; letter-spacing: 1px;">SIMAGANG BPS</div>
    <div class="nav-menu">
        <a href="dashboard_umum"><button
                class="nav-btn<?= (isset($_GET['page']) && $_GET['page'] == 'dashboard_umum') ? ' active' : ''; ?>">Dashboard</button></a>
        <a href="admin_dashboard"><button
                class="nav-btn<?= (isset($_GET['page']) && $_GET['page'] == 'admin_dashboard') ? ' active' : ''; ?>">Home</button></a>
        <a href="admin_peserta"><button
                class="nav-btn<?= (isset($_GET['page']) && $_GET['page'] == 'admin_peserta') ? ' active' : ''; ?>">Peserta</button></a>
        <a href="admin_progres"><button
                class="nav-btn<?= (isset($_GET['page']) && $_GET['page'] == 'admin_progres') ? ' active' : ''; ?>">Progres
                Peserta</button></a>
    </div>
    <div style="position: relative; display: inline-block;">
        <button id="userDropdownBtn"
            style="background: none; border: none; color: white; font-size: 22px; cursor: pointer;">
            👤 ▼
        </button>
        <div id="userDropdownMenu"
            style="display: none; position: absolute; right: 0; background: #fff; min-width: 150px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); border-radius: 6px; z-index: 100;">
            <a href="profile_admin.php"
                style="display: block; padding: 10px 20px; color: #2c3e50; text-decoration: none;">Profile</a>
            <a href="proses/proses_logout.php"
                style="display: block; padding: 10px 20px; color: #e74c3c; text-decoration: none;">Logout</a>
        </div>
    </div>
</nav>