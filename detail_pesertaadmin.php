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
    <link rel="stylesheet" href="style_detail_pesertaadmin.css">
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
            <a href="admin_peserta.php">
                <button style="background:#2c3e50; color:#fff; border:none; border-radius:8px; padding:12px 36px; font-size:18px; font-weight:bold; cursor:pointer;">Kembali</button>
            </a>
        </div>
    </div>
</body>
</html>
