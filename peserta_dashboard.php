<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'peserta') {
    header("Location: login.php");
    exit;
}
$namaPeserta = $_SESSION['user']['nama'] ?? 'Peserta';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Peserta</title>
    <link rel="stylesheet" href="style_peserta_dashboard.css">
</head>
<body>
    <nav>
        <div class="profile">
            <span class="profile-icon">&#128100;</span>
            <div style="display:flex; flex-direction:column; justify-content:center; align-items:flex-start; margin-left:18px;">
                <span style="font-size:22px; font-weight:bold; text-align:left;">
                    Selamat datang, Peserta
                </span>
                <span style="font-size:22px; font-weight:bold; text-align:left; word-break:break-word;">
                    <?php echo htmlspecialchars($namaPeserta); ?>
                </span>
            </div>
        </div>
        <div class="nav-menu">
            <a href="#"><button class="nav-btn active">Dasbor Peserta</button></a>
            <div class="dropdown">
                <button class="nav-btn">Kegiatan &#9662;</button>
                <div class="dropdown-content">
                    <a href="peserta_ringkasankegiatan.php">Ringkasan</a>
                    <a href="peserta_pendaftaran.php">Daftar Baru</a>
                    <a href="peserta_progres.php">Progres</a>
                </div>
            </div>
            <a href="peserta_profile.php"><button class="nav-btn">Profile</button></a>
        </div>
        <div>
            <button class="nav-btn" id="notifBtn">&#128276; Notifikasi</button>
            <div id="notifPopup" style="display:none; position:fixed; top:100px; right:60px; background:#fff; border-radius:18px; box-shadow:0 4px 16px rgba(0,0,0,0.18); border:1px solid #e0e0e0; padding:36px 48px; z-index:999; min-width:420px; max-width:90vw;">
                <div style="font-size:28px; font-weight:bold; margin-bottom:18px; color:#222;">Notifikasi Progres Akun</div>
                <div style="font-size:20px; color:#222; margin-bottom:18px;">Berikut adalah informasi terbaru dari admin mengenai progres akun Anda:</div>
                <ul style="font-size:18px; color:#222; margin-bottom:12px; padding-left:18px;">
                    <li><b>21/09/2025:</b> Status magang Anda telah <span style='color:#8C00E4;font-weight:bold;'>Berlangsung</span>. Silakan cek detail progres di halaman Progres.</li>
                    <li><b>18/09/2025:</b> Berkas pendaftaran Anda telah diverifikasi oleh admin.</li>
                    <li><b>15/09/2025:</b> Anda diterima setelah wawancara. Selamat bergabung!</li>
                </ul>
                <button id="closeNotif" style="background:#222; color:#fff; font-size:18px; font-weight:bold; border:none; border-radius:10px; padding:10px 32px; margin-top:12px; cursor:pointer;">Tutup</button>
            </div>
            <a href="index.php" style="text-decoration:none;"><button class="nav-btn" style="color:#e74c3c;">Log Out</button></a>
        </div>
    </nav>
    <script>
        var notifBtn = document.getElementById('notifBtn');
        var notifPopup = document.getElementById('notifPopup');
        var closeNotif = document.getElementById('closeNotif');
        notifBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notifPopup.style.display = 'block';
            notifBtn.classList.add('active');
        });
        closeNotif.addEventListener('click', function() {
            notifPopup.style.display = 'none';
            notifBtn.classList.remove('active');
        });
        document.addEventListener('click', function(e) {
            if (!notifPopup.contains(e.target) && e.target !== notifBtn) {
                notifPopup.style.display = 'none';
                notifBtn.classList.remove('active');
            }
        });
        document.querySelectorAll('.dropdown .nav-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                var content = btn.nextElementSibling;
                content.style.display = content.style.display === 'block' ? 'none' : 'block';
            });
        });
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-content').forEach(function(menu) {
                menu.style.display = 'none';
            });
        });

        var notifBtn = document.getElementById('notifBtn');
        var notifPopup = document.getElementById('notifPopup');
        var closeNotif = document.getElementById('closeNotif');
        notifBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notifPopup.style.display = 'block';
            notifBtn.classList.add('active');
        });
        closeNotif.addEventListener('click', function() {
            notifPopup.style.display = 'none';
            notifBtn.classList.remove('active');
        });
        document.addEventListener('click', function(e) {
            if (!notifPopup.contains(e.target) && e.target !== notifBtn) {
                notifPopup.style.display = 'none';
                notifBtn.classList.remove('active');
            }
        });
    </script>
    <div class="container">
        <div style="margin-bottom: 18px;">
            <div style="font-size: 48px; font-weight: bold; color: #111;">Dasbor Peserta</div>
            <div style="font-size: 28px; color: #6c7a89; margin-top: 6px;">Tinjauan sistem dan manajemen</div>
        </div>
        <div class="dashboard">
            <div class="card">
                <h2>5</h2>
                <p>Total Peserta</p>
            </div>
            <div class="card">
                <h2>10</h2>
                <p>Aplikasi</p>
            </div>
            <div class="card">
                <h2>3</h2>
                <p>Magang Aktif</p>
            </div>
        </div>
        <div class="box-container">
            <div class="box">
                <h3 style="font-size:32px; font-weight:bold; margin-bottom:18px;">APLIKASI TERBARU</h3>
                <div style="font-size:26px; color:#111; margin-bottom:28px; font-weight:bold;">Pengajuan Magang Terbaru</div>
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
                        <span class="status selesai-magang status-right">SELESAI MAGANG</span>
                    </div>
                </div>
            </div>
            <div class="box">
                <h3 style="font-size:32px; font-weight:bold; margin-bottom:18px;">STATISTIK SISTEM</h3>
                <div style="font-size:26px; color:#111; margin-bottom:28px; font-weight:bold;">Rincian Status Aplikasi</div>
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
