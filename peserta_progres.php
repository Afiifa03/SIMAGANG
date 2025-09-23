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
        .progress-section {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid #e0e0e0;
            padding: 36px 64px;
            margin-bottom: 32px;
        }
        .progress-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #222;
        }
        .progress-desc {
            font-size: 20px;
            color: #222;
            margin-bottom: 24px;
        }
        .card-progres {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid #e0e0e0;
            padding: 28px 36px;
            margin-bottom: 32px;
            position: relative;
        }
        .status-label {
            position: absolute;
            top: 24px;
            right: 36px;
            padding: 8px 24px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: bold;
            background: #B4F4AC;
            color: #107705;
        }
        .status-label.sedang {
            background: #DCC6ED;
            color: #8C00E4;
        }
        .card-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .periode {
            font-size: 16px;
            color: #222;
            margin-bottom: 18px;
        }
        .progress-bar-container {
            width: 100%;
            height: 16px;
            background: #eee;
            border-radius: 8px;
            margin-bottom: 18px;
            position: relative;
        }
        .progress-bar {
            height: 16px;
            border-radius: 8px;
            position: absolute;
            top: 0;
            left: 0;
        }
        .progress-bar.black {
            background: #222;
            width: 90%;
        }
        .progress-bar.purple {
            background: linear-gradient(90deg, #4b3aff 0%, #8C00E4 100%);
            width: 95%;
        }
        .progress-dot {
            position: absolute;
            right: 0;
            top: 0;
            width: 16px;
            height: 16px;
            background: #fff;
            border: 2px solid #222;
            border-radius: 50%;
        }
        .progress-dot.purple {
            border: 2px solid #8C00E4;
        }
        .progress-info {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            margin-bottom: 8px;
        }
        .progress-info .left {
            font-weight: bold;
        }
        .progress-info .right {
            font-weight: bold;
        }
        .progress-detail {
            font-size: 16px;
            color: #222;
            margin-bottom: 8px;
        }
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
                    <a href="peserta_ringkasankegiatan.php">Ringkasan</a>
                    <a href="peserta_pendaftaran.php">Daftar Baru</a>
                    <a href="peserta_progres.php" style="font-weight:bold;">Progres</a>
                </div>
            </div>
            <a href="peserta_profile.php"><button class="nav-btn">Profile</button></a>
        </div>
        <div>
            <button class="nav-btn">&#128276; Notifikasi</button>
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
