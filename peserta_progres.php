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
    <title>Progres Magang Peserta</title>
    <link rel="stylesheet" href="style_peserta_progres.css">
</head>
<body>
    <nav>
        <div class="profile">
            <span class="profile-icon" style="font-size:32px;">&#128100;</span>
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
            <a href="peserta_dashboard.php"><button class="nav-btn">Dasbor Peserta</button></a>
            <div class="dropdown">
                <button class="nav-btn active" id="kegiatanBtn">Kegiatan &#9662;</button>
                <div class="dropdown-content" id="kegiatanMenu">
                    <a href="peserta_ringkasankegiatan.php">Ringkasan</a>
                    <a href="peserta_pendaftaran.php">Daftar Baru</a>
                    <a href="peserta_progres.php" style="font-weight:bold;">Progres</a>
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
        document.addEventListener('DOMContentLoaded', function() {
            var btn = document.getElementById('kegiatanBtn');
            var menu = document.getElementById('kegiatanMenu');
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            });
            document.addEventListener('click', function() {
                menu.style.display = 'none';
            });
        });
    </script>
    <div class="container">
        <div class="tab-menu">
            <a href="peserta_ringkasankegiatan.php"><button class="tab-btn">Ringkasan</button></a>
            <a href="peserta_pendaftaran.php"><button class="tab-btn">Daftar Baru</button></a>
            <a href="peserta_progres.php"><button class="tab-btn active">Progres</button></a>
        </div>
        <div class="progress-section">
            <div class="progress-title">Progres Magang Aktif</div>
            <div class="progress-desc">Progres magang yang sedang berlangsung</div>
            <!-- Card 1 -->
            <div class="card-progres">
                <span class="status-label">Diterima</span>
                <div class="card-title">Peserta 10</div>
                <div class="periode">Periode : 21/8/2025 - 21/12/2025</div>
                <div class="progress-bar-container">
                    <div class="progress-bar black" style="width:90%"></div>
                    <div class="progress-dot" style="right:10%"></div>
                </div>
                <div class="progress-info">
                    <span class="left">Sisa Hari : 125 hari</span>
                    <span class="right">Status : Menunggu</span>
                </div>
                <div class="progress-detail">
                    <b>Pembimbing :</b> Zulkarnaini, S.Si., MSi<br>
                    <b>Keterangan :</b> Diterima setelah wawancara
                </div>
            </div>
            <!-- Card 2 -->
            <div class="card-progres">
                <span class="status-label sedang">Sedang Magang</span>
                <div class="card-title">Peserta 9</div>
                <div class="periode">Periode : 21/8/2025 - 21/12/2025</div>
                <div class="progress-bar-container">
                    <div class="progress-bar purple" style="width:95%"></div>
                    <div class="progress-dot purple" style="right:5%"></div>
                </div>
                <div class="progress-info">
                    <span class="left">Durasi : 2 hari</span>
                    <span class="right">Status : Berlangsung</span>
                </div>
                <div style="position:absolute; right:36px; top:90px; font-size:18px; font-weight:bold; color:#8C00E4;">95%</div>
                <div class="progress-detail">
                    <b>Pembimbing :</b> Zulkarnaini, S.Si., MSi<br>
                    <b>Keterangan :</b> Magang sedang berlangsung
                </div>
            </div>
        </div>
    </div>
</body>
</html>
