<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil nama admin dari database
$adminName = 'Admin';
if (isset($_SESSION['admin_id'])) {
    require_once 'koneksi.php';
    $stmt = $conn->prepare('SELECT username FROM admin WHERE id_admin = ?');
    $stmt->bind_param('i', $_SESSION['admin_id']);
    $stmt->execute();
    $stmt->bind_result($adminName);
    $stmt->fetch();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Admin</title>
    <link rel="stylesheet" href="style_admin_dashboard.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <div style="font-size: 24px; font-weight: bold; letter-spacing: 1px;">SIMAGANG BPS</div>
        <div class="nav-menu">
            <a href="admin_dashboard.php"><button class="nav-btn<?php echo basename($_SERVER['PHP_SELF'])=='admin_dashboard.php'?' active':''; ?>">Dashboard</button></a>
            <a href="admin_peserta.php"><button class="nav-btn<?php echo basename($_SERVER['PHP_SELF'])=='admin_peserta.php'?' active':''; ?>">Peserta</button></a>
            <a href="admin_progres.php"><button class="nav-btn<?php echo basename($_SERVER['PHP_SELF'])=='admin_progres.php'?' active':''; ?>">Progres Peserta</button></a>
        </div>
        <div style="position: relative; display: inline-block;">
            <button id="userDropdownBtn" style="background: none; border: none; color: white; font-size: 22px; cursor: pointer;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg" style="vertical-align:middle;">
                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                </svg>
                ▼
            </button>
            <div id="userDropdownMenu" style="display: none; position: absolute; right: 0; background: #fff; min-width: 150px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); border-radius: 6px; z-index: 100;">
                <a href="profile_admin.php" style="display: block; padding: 10px 20px; color: #2c3e50; text-decoration: none;">Profile</a>
                <a href="index.php" style="display: block; padding: 10px 20px; color: #e74c3c; text-decoration: none;">Logout</a>
            </div>
        </div>
    </nav>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var btn = document.getElementById('userDropdownBtn');
            var menu = document.getElementById('userDropdownMenu');
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            });
            document.addEventListener('click', function() {
                menu.style.display = 'none';
            });
        });
    </script>

    <!-- KONTEN -->
    <div class="container">
        <div style="margin-bottom: 10px;">
            <div style="font-size: 32px; font-weight: bold; color: #111;">Dasbor Admin</div>
            <div style="font-size: 18px; color: #6c7a89; margin-top: 2px;">Tinjauan sistem dan manajemen</div>
        </div>
        <div class="welcome">
            Selamat datang, Admin <b><?php echo $_SESSION['user']['email']; ?></b>
        </div>
        <div class="dashboard">
            <div class="card">
                <h2>5</h2>
                <p>Mahasiswa Terdaftar</p>
            </div>
            <div class="card">
                <h2>10</h2>
                <p>Total Pengajuan</p>
            </div>
            <div class="card">
                <h2>3</h2>
                <p>Sedang Magang</p>
            </div>
        </div>

        <div class="box-container">
            <div class="box">
                <h3>APLIKASI TERBARU</h3>
                <div style="margin-bottom: 12px;">
                    <div style="font-weight:bold; font-size:18px; margin-bottom:2px;">Pendaftaran 10</div>
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <span>Budi Santoso 1/8/2025</span>
                        <span class="status menunggu-verifikasi status-right">MENUNGGU VERIFIKASI</span>
                    </div>
                </div>
                <div style="margin-bottom: 12px;">
                    <div style="font-weight:bold; font-size:18px; margin-bottom:2px;">Pendaftaran 9</div>
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <span>Ahmad Wijaya 15/7/2025</span>
                        <span class="status sedang-magang status-right">SEDANG MAGANG</span>
                    </div>
                </div>
                <div style="margin-bottom: 12px;">
                    <div style="font-weight:bold; font-size:18px; margin-bottom:2px;">Pendaftaran 8</div>
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <span>Sari Melati 10/7/2025</span>
                        <span class="status sedang-magang status-right">SEDANG MAGANG</span>
                    </div>
                </div>
                <div style="margin-bottom: 12px;">
                    <div style="font-weight:bold; font-size:18px; margin-bottom:2px;">Pendaftaran 4</div>
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <span>Darsono 9/3/2025</span>
                        <span class="status selesai-magang status-right">SELESAI MAGANG</span>
                    </div>
                </div>
                <div style="margin-bottom: 0;">
                    <div style="font-weight:bold; font-size:18px; margin-bottom:2px;">Pendaftaran 7</div>
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <span>Desinta 15/1/2025</span>
                        <span class="status selesai-magang status-right">SELESA</span>
                    </div>
                </div>
            </div>

            <div class="box">
                <h3>STATISTIK SISTEM</h3>
                <p><span class="status menunggu-verifikasi">Menunggu Verifikasi</span> <span class="persen">10%</span></p>
                <p><span class="status verifikasi-berkas">Verifikasi Berkas</span> <span class="persen">10%</span></p>
                <p><span class="status wawancara">Wawancara</span> <span class="persen">10%</span></p>
                <p><span class="status diterima">Diterima</span> <span class="persen">10%</span></p>
                <p><span class="status ditolak">Ditolak</span> <span class="persen">10%</span></p>
                <p><span class="status sedang-magang">Sedang Magang</span> <span class="persen">20%</span></p>
                <p><span class="status selesai-magang">Selesai Magang</span> <span class="persen">30%</span></p>
            </div>
        </div>
    </div>

</body>
</html>
