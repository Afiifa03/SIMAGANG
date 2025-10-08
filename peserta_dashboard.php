<?php
// session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'peserta') {
    header("Location: login");
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #e5e5e5;
            padding: 32px 32px 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #222;
            font-size: 22px;
        }
        .nav-menu {
            display: flex;
            gap: 18px;
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
        .nav-btn {
            padding: 10px 32px;
            border-radius: 12px;
            border: none;
            font-size: 20px;
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
        .welcome {
            font-size: 28px;
            margin-bottom: 28px;
        }
        .dashboard {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            flex: 1;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid #e0e0e0;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        }
        .card h2 {
            font-size: 44px;
            margin: 18px 0 10px 0;
            font-weight: bold;
        }
        .card p {
            font-size: 22px;
            color: #222;
            font-weight: 500;
        }
        .box-container {
            display: flex;
            gap: 20px;
        }
        .box {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            flex: 1;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid #e0e0e0;
        }
        .status {
            display: inline-block;
            padding: 5px 18px;
            margin: 3px 0;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            min-width: 150px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .status:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
        }
        .status-right {
            float: right;
            margin-left: 16px;
            margin-top: -8px;
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
        .menunggu-verifikasi { background: linear-gradient(135deg, #D0D0D0, #BFBFBF); color: #000000; }
        .verifikasi-berkas { background: linear-gradient(135deg, #FBE4A1, #FFD873); color: #F86C00; }
        .wawancara { background: linear-gradient(135deg, #B3CFFF, #81AFFF); color: #4721CF; }
        .diterima { background: linear-gradient(135deg, #B4F4AC, #8BE77D); color: #107705; }
        .ditolak { background: linear-gradient(135deg, #FCB3B3, #F78C8C); color: #F60000; }
        .sedang-magang { background: linear-gradient(135deg, #DCC6ED, #C39EE3); color: #8C00E4; }
        .selesai-magang { background: linear-gradient(135deg, #B9E7A3, #90D675); color: #107705; }
        .persen {
            float: right;
            color: #555;
            font-weight: normal;
        }
        .profile {
            font-size: 18px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .profile-icon {
            font-size: 32px;
            margin-right: 8px;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background: #fff;
            min-width: 180px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            border-radius: 6px;
            z-index: 100;
            top: 40px;
            left: 0;
        }
        .dropdown-content a {
            display: block;
            padding: 10px 20px;
            color: #222;
            text-decoration: none;
        }
        .dropdown-content a:hover {
            background: #f4f4f4;
        }
    </style>
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
            <button class="nav-btn">&#128276; Notifikasi</button>
            <a href="index.php" style="text-decoration:none;"><button class="nav-btn" style="color:#e74c3c;">Log Out</button></a>
        </div>
    </nav>
    <script>
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
