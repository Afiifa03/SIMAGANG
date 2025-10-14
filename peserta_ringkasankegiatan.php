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
    <title>Ringkasan Kegiatan Peserta</title>
    <link rel="stylesheet" href="style_peserta_ringkasankegiatan.css">
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
                    <a href="peserta_ringkasankegiatan.php" style="font-weight:bold;">Ringkasan</a>
                    <a href="peserta_pendaftaran.php">Daftar Baru</a>
                    <a href="peserta_progres.php">Progres</a>
                </div>
            </div>
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
            <a href="peserta_profile.php"><button class="nav-btn">Profile</button></a>
        </div>
        <div>
            <button class="nav-btn">&#128276; Notifikasi</button>
            <a href="index.php" style="text-decoration:none;"><button class="nav-btn" style="color:#e74c3c;">Log Out</button></a>
        </div>
    </nav>
    <div class="container">
        <div class="tab-menu">
            <a href="peserta_ringkasankegiatan.php"><button class="tab-btn active">Ringkasan</button></a>
            <a href="peserta_pendaftaran.php"><button class="tab-btn">Daftar Baru</button></a>
            <a href="peserta_progres.php"><button class="tab-btn">Progres</button></a>
        </div>
        <div class="summary-cards">
            <div class="summary-card">
                5
                <div class="summary-label">Total Pendaftaran</div>
            </div>
            <div class="summary-card">
                2
                <div class="summary-label">Dalam Proses</div>
            </div>
            <div class="summary-card">
                3
                <div class="summary-label">Selesai</div>
            </div>
        </div>
        <div class="info-box">
            <div class="info-title"><span class="info-title-icon">&#128337;</span> Informasi Proses Magang</div>
            <div class="process-flow">
                <div class="flow-step">
                    <div class="flow-icon" style="background:#d1eaff;">&#128196;</div>
                    <div class="flow-label">Pendaftaran Diterima</div>
                </div>
                <div class="flow-line"></div>
                <div class="flow-step">
                    <div class="flow-icon" style="background:#ffe4b3;">&#128221;</div>
                    <div class="flow-label">Verifikasi Berkas</div>
                </div>
                <div class="flow-line"></div>
                <div class="flow-step">
                    <div class="flow-icon" style="background:#e6e6ff;">&#128483;</div>
                    <div class="flow-label">Sesi Wawancara</div>
                </div>
                <div class="flow-line"></div>
                <div class="flow-step">
                    <div class="flow-icon" style="background:#d1f7d1;">&#10004;</div>
                    <div class="flow-label">Diterima</div>
                </div>
                <div class="flow-line"></div>
                <div class="flow-step">
                    <div class="flow-icon" style="background:#e0e0e0;">&#128188;</div>
                    <div class="flow-label">Sedang Magang</div>
                </div>
                <div class="flow-line gray"></div>
                <div class="flow-step">
                    <div class="flow-icon" style="background:#ffe7b3;">&#127942;</div>
                    <div class="flow-label">Selesai Magang</div>
                </div>
            </div>
            <div class="info-important">
                <b>Informasi Penting :</b><br>
                - Proses verifikasi berkas biasanya memakan waktu 3-5 hari kerja<br>
                - Jadwal wawancara akan diberitahukan melalui email atau telepon<br>
                - Penugasan pembimbing dilakukan setelah peserta diterima<br>
                - Evaluasi magang dilakukan berkala selama periode magang
            </div>
        </div>
        <div class="activity-box">
            <div class="activity-title">Aktivitas Terbaru</div>
            <ul class="activity-list">
                <li class="activity-item">
                    <span>Pendaftaran 10<br>1/5/2025</span>
                    <span class="activity-status selesai-magang">SELESAI MAGANG</span>
                </li>
                <li class="activity-item">
                    <span>Pendaftaran 9<br>1/5/2025</span>
                    <span class="activity-status menunggu-verifikasi">MENUNGGU VERIFIKASI</span>
                </li>
                <li class="activity-item">
                    <span>Pendaftaran 8<br>1/5/2025</span>
                    <span class="activity-status diterima">DITERIMA</span>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>
