<?php
session_start();

// Cek apakah user sudah login dan role-nya admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ambil nama admin dari session
$adminName = $_SESSION['user']['email'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; /* background halaman lebih soft */
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #2c3e50;
            padding: 32px 32px 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            font-size: 22px;
        }
        .nav-menu {
            display: flex;
            gap: 18px;
        }
        .nav-btn {
            padding: 10px 32px;
            border-radius: 12px;
            border: none;
            font-size: 20px;
            font-weight: bold;
            background: transparent;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }
        .nav-btn.active {
            background: #fff;
            color: #2c3e50;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .nav-btn:hover {
            background: #f4f4f4;
            color: #2c3e50;
        }
        .container {
            padding: 30px;
            min-height: 100vh;
        }
        .welcome {
            font-size: 18px;
            margin-bottom: 20px;
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
            font-size: 28px;
            margin: 10px 0;
        }
        .card p {
            font-size: 14px;
            color: #555;
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

        /* Gradient dan warna status */
        .menunggu-verifikasi { 
            background: linear-gradient(135deg, #D0D0D0, #BFBFBF); 
            color: #000000; 
        }
        .verifikasi-berkas { 
            background: linear-gradient(135deg, #FBE4A1, #FFD873); 
            color: #F86C00; 
        }
        .wawancara { 
            background: linear-gradient(135deg, #B3CFFF, #81AFFF); 
            color: #4721CF; 
        }
        .diterima { 
            background: linear-gradient(135deg, #B4F4AC, #8BE77D); 
            color: #107705; 
        }
        .ditolak { 
            background: linear-gradient(135deg, #FCB3B3, #F78C8C); 
            color: #F60000; 
        }
        .sedang-magang { 
            background: linear-gradient(135deg, #DCC6ED, #C39EE3); 
            color: #8C00E4; 
        }
        .selesai-magang { 
            background: linear-gradient(135deg, #B9E7A3, #90D675); 
            color: #107705; 
        }

        /* Persentase di kanan */
        .persen {
            float: right;
            color: #555;
            font-weight: normal;
        }
    </style>
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
                👤 ▼
            </button>
            <div id="userDropdownMenu" style="display: none; position: absolute; right: 0; background: #fff; min-width: 150px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); border-radius: 6px; z-index: 100;">
                <a href="profile_admin.php" style="display: block; padding: 10px 20px; color: #2c3e50; text-decoration: none;">Profile</a>
                <a href="proses/proses_logout.php" style="display: block; padding: 10px 20px; color: #e74c3c; text-decoration: none;">Logout</a>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->

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
            Selamat datang, Admin <b><?php echo $_SESSION['user']['nama']; ?></b>
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
                        <span class="status selesai-magang status-right">SELESAI MAGANG</span>
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
