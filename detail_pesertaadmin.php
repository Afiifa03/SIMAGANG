<?php
$nama = isset($_GET['nama']) ? $_GET['nama'] : 'Afiifa Lhokseum';
$peserta_id = 'Peserta Magang 10';
$tanggal_daftar = '1/8/2025';
$tanggal_mulai = '15/8/2025';
$tanggal_selesai = '15/12/2025';
$proposal = 'afiifa_magang.pdf';
$cv = 'cv.afiifa.pdf';
$transkrip = 'afiifa.transkrip.pdf';
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = ['email' => 'admin@bps.go.id', 'type' => 'admin'];
}
$keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : (isset($_SESSION['keterangan']) ? $_SESSION['keterangan'] : 'Magang mobile development, fokus pada aplikasi Android');
$status = isset($_POST['status']) ? $_POST['status'] : (isset($_SESSION['status']) ? $_SESSION['status'] : 'Menunggu Verifikasi');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['keterangan'])) {
        $_SESSION['keterangan'] = $_POST['keterangan'];
    }
    if (isset($_POST['status'])) {
        $_SESSION['status'] = $_POST['status'];
    }
}
$status_list = [
    'Menunggu Verifikasi',
    'Verifikasi Berkas',
    'Wawancara',
    'Diterima',
    'Ditolak',
    'Sedang Magang',
    'Selesai Magang'
];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    $status = $_POST['status'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #2ca6a6;
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
            padding: 40px 0;
            min-height: 100vh;
        }
        .magang-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid #e0e0e0;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 60px 32px 60px;
            position: relative;
        }
        .magang-header {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 6px;
        }
        .magang-sub {
            font-size: 18px;
            margin-bottom: 18px;
        }
        .magang-row {
            display: flex;
            gap: 60px;
            margin-bottom: 18px;
        }
        .magang-col {
            font-size: 16px;
        }
        .magang-label {
            font-weight: bold;
            min-width: 120px;
        }
        .magang-docs {
            display: flex;
            gap: 40px;
            margin-bottom: 12px;
        }
        .magang-doc {
            font-size: 16px;
        }
        .magang-doc a {
            color: #2c3e50;
            text-decoration: underline;
        }
        .magang-ket {
            font-size: 16px;
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }
        .magang-edit {
            margin-top:2px;
            font-size:16px;
            color:#222;
            cursor:pointer;
            font-weight:bold;
        }
        .magang-edit:hover {
            text-decoration: underline;
        }
        .magang-status-row {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 8px;
        }
        .magang-status-btn {
            border: none;
            border-radius: 12px;
            padding: 14px 36px;
            font-size: 20px;
            font-weight: bold;
            cursor: default;
            position: absolute;
            top: 24px;
            right: 32px;
            min-width: 200px;
            text-align: center;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            letter-spacing: 1px;
        }
        .magang-status-select {
            font-size: 15px;
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .magang-status-label {
            font-size: 15px;
            font-weight: bold;
            margin-right: 8px;
        }
        /* Status color classes from admin_dashboard.php */
        .status {
            display: inline-block;
            padding: 14px 36px;
            margin: 3px 0;
            border-radius: 12px;
            font-size: 20px;
            font-weight: bold;
            min-width: 200px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            letter-spacing: 1px;
        }
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
    </style>
</head>
<body>
    <nav>
        <div style="font-size: 24px; font-weight: bold; letter-spacing: 1px;">SIMAGANG BPS</div>
        <div class="nav-menu">
            <a href="admin_dashboard.php"><button class="nav-btn">Dashboard</button></a>
            <a href="admin_peserta.php"><button class="nav-btn active">Peserta</button></a>
            <a href="admin_progres.php"><button class="nav-btn">Progres Peserta</button></a>
        </div>
        <div style="position: relative; display: inline-block;">
            <button id="userDropdownBtn" style="background: none; border: none; color: white; font-size: 22px; cursor: pointer;">👤 ▼</button>
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
    <div class="container">
        <form method="post">
            <div class="magang-card">
                <?php
                // Mapping status ke class warna
                $status_class = '';
                switch (strtolower($status)) {
                    case 'menunggu verifikasi': $status_class = 'menunggu-verifikasi'; break;
                    case 'verifikasi berkas': $status_class = 'verifikasi-berkas'; break;
                    case 'wawancara': $status_class = 'wawancara'; break;
                    case 'diterima': $status_class = 'diterima'; break;
                    case 'ditolak': $status_class = 'ditolak'; break;
                    case 'sedang magang': $status_class = 'sedang-magang'; break;
                    case 'selesai magang': $status_class = 'selesai-magang'; break;
                }
                ?>
                <span class="magang-status-btn status <?php echo $status_class; ?>" disabled><?php echo htmlspecialchars($status); ?></span>
                <div class="magang-header"><?php echo $peserta_id; ?></div>
                <div class="magang-sub">Peserta : <?php echo htmlspecialchars($nama); ?></div>
                <div class="magang-row">
                    <div class="magang-col"><span class="magang-label">Tanggal Daftar:</span> <?php echo $tanggal_daftar; ?></div>
                    <div class="magang-col" style="margin-left:120px;"><span class="magang-label">Tanggal Mulai:</span> <?php echo $tanggal_mulai; ?></div>
                    <div class="magang-col" style="margin-left:120px;"><span class="magang-label">Tanggal Selesai:</span> <?php echo $tanggal_selesai; ?></div>
                </div>
                <div class="magang-docs">
                    <div class="magang-doc"><span class="magang-label">Proposal:</span> <a href="<?php echo $proposal; ?>" target="_blank"><?php echo $proposal; ?></a></div>
                    <div class="magang-doc" style="margin-left:120px;"><span class="magang-label">CV:</span> <a href="<?php echo $cv; ?>" target="_blank"><?php echo $cv; ?></a></div>
                    <div class="magang-doc" style="margin-left:213.6px;"><span class="magang-label">Transkrip:</span> <a href="<?php echo $transkrip; ?>" target="_blank"><?php echo $transkrip; ?></a></div>
                </div>
                <div class="magang-ket" id="keteranganContainer">
                    <div>
                        <div><span class="magang-label">Keterangan :</span></div>
                        <div style="margin-top:2px;" id="keteranganText"><?php echo htmlspecialchars($keterangan); ?></div>
                        <div id="keteranganEdit" style="display:none; margin-top:2px;">
                            <input type="text" name="keterangan" value="<?php echo htmlspecialchars($keterangan); ?>" style="width:400px; padding:6px 10px; font-size:15px; border-radius:6px; border:1px solid #ccc;">
                            <button type="submit" style="margin-left:8px; padding:6px 18px; border-radius:6px; border:none; background:#2ca6a6; color:#fff; font-weight:bold; cursor:pointer;">Simpan</button>
                            <button type="button" id="cancelEdit" style="margin-left:4px; padding:6px 18px; border-radius:6px; border:none; background:#eee; color:#222; font-weight:bold; cursor:pointer;">Batal</button>
                        </div>
                    </div>
                    <span class="magang-edit" id="editBtn">Edit</span>
                </div>
                <hr style="margin: 18px 0 12px 0; clear:both;">
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var editBtn = document.getElementById('editBtn');
                    var ketText = document.getElementById('keteranganText');
                    var ketEdit = document.getElementById('keteranganEdit');
                    var cancelEdit = document.getElementById('cancelEdit');
                    editBtn.addEventListener('click', function() {
                        ketText.style.display = 'none';
                        ketEdit.style.display = 'block';
                        editBtn.style.display = 'none';
                    });
                    cancelEdit.addEventListener('click', function() {
                        ketText.style.display = 'block';
                        ketEdit.style.display = 'none';
                        editBtn.style.display = 'inline-block';
                    });
                });
                </script>
                <div class="magang-status-row">
                    <span class="magang-status-label">Perbarui Status :</span>
                    <select name="status" class="magang-status-select">
                        <?php foreach ($status_list as $s): ?>
                            <option value="<?php echo $s; ?>" <?php if ($status == $s) echo 'selected'; ?>><?php echo $s; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" style="margin-left:12px; padding:6px 18px; border-radius:6px; border:none; background:#2ca6a6; color:#fff; font-weight:bold; cursor:pointer;">Simpan</button>
                </div>
            </div>
        </form>
        <div style="max-width:1200px; margin:24px auto 0 auto; text-align:left;">
            <a href="admin_peserta">
                <button style="background:#2c3e50; color:#fff; border:none; border-radius:8px; padding:12px 36px; font-size:18px; font-weight:bold; cursor:pointer;">Kembali</button>
            </a>
        </div>
    </div>
</body>
</html>
