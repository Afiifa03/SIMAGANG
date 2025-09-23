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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #e5e5e5;
            padding: 44px 44px 32px 44px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #222;
            font-size: 32px;
        }
        .nav-menu {
            display: flex;
            gap: 18px;
        }
        .nav-btn {
            padding: 16px 44px;
            border-radius: 16px;
            border: none;
            font-size: 28px;
            font-weight: bold;
            background: transparent;
            color: #222;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }
        .nav-btn.active {
            background: #222;
            color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .nav-btn:hover {
            background: #f4f4f4;
            color: #222;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background: #fff;
            min-width: 220px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            border-radius: 12px;
            z-index: 100;
            top: 60px;
            left: 0;
            font-size: 32px;
            font-weight: 500;
            padding: 12px 0;
        }
        .dropdown-content a {
            display: block;
            padding: 18px 32px;
            color: #222;
            text-decoration: none;
            border-radius: 8px;
            margin: 0 8px;
        }
        .dropdown-content a:hover {
            background: #f4f4f4;
        }
        .profile {
            font-size: 14px;
            font-weight: bold;
            display: flex;
            align-items: flex-start;
            gap: 24px;
            flex-wrap: wrap;
        }
        .profile-icon {
            font-size: 80px;
            margin-right: 0;
        }
        .container {
            padding: 30px;
            min-height: 100vh;
            background: #aee3e3;
        }
        .tab-menu {
            display: flex;
            gap: 32px;
            justify-content: center;
            margin-bottom: 32px;
        }
        .tab-btn {
            background: #fff;
            border: none;
            border-radius: 24px;
            font-size: 32px;
            font-weight: bold;
            padding: 18px 64px;
            color: #222;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            cursor: pointer;
            margin-bottom: 0;
        }
        .tab-btn.active {
            background: #222;
            color: #fff;
        }
        .summary-cards {
            display: flex;
            gap: 48px;
            justify-content: center;
            margin-bottom: 32px;
        }
        .summary-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid #e0e0e0;
            padding: 36px 64px;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color: #222;
        }
        .summary-label {
            font-size: 22px;
            font-weight: 500;
            color: #222;
            margin-top: 12px;
        }
        .info-box {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid #e0e0e0;
            padding: 36px 48px;
            margin-bottom: 32px;
        }
        .info-title {
            font-size: 32px;
            font-weight: bold;
            color: #222;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .info-title-icon {
            font-size: 48px;
        }
        .process-flow {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .flow-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }
        .flow-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
        }
        .flow-label {
            font-size: 18px;
            font-weight: bold;
            color: #222;
        }
        .flow-line {
            height: 6px;
            background: #4b3aff;
            flex: 1;
            margin: 0 8px;
            border-radius: 4px;
        }
        .flow-line.gray {
            background: #ccc;
        }
        .info-important {
            background: #f4f4f4;
            border-radius: 18px;
            padding: 18px 24px;
            font-size: 18px;
            color: #222;
            margin-top: 18px;
        }
        .activity-box {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid #e0e0e0;
            padding: 36px 48px;
            margin-bottom: 32px;
        }
        .activity-title {
            font-size: 28px;
            font-weight: bold;
            color: #222;
            margin-bottom: 24px;
        }
        .activity-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .activity-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 0;
            border-bottom: 1px solid #e0e0e0;
            font-size: 22px;
        }
        .activity-item:last-child {
            border-bottom: none;
        }
        .activity-status {
            padding: 8px 24px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: bold;
            margin-left: 18px;
        }
        .selesai-magang { background: #B9E7A3; color: #107705; }
        .menunggu-verifikasi { background: #FFD873; color: #F86C00; }
        .diterima { background: #B4F4AC; color: #107705; }
    </style>
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
