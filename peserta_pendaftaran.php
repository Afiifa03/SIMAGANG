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
    <title>Pendaftaran Magang Peserta</title>
    <link rel="stylesheet" href="style_peserta_pendaftaran.css">
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
                    <a href="peserta_pendaftaran.php" style="font-weight:bold;">Daftar Baru</a>
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
        });
    </script>
    <div class="container">
        <div class="tab-menu">
            <a href="peserta_ringkasankegiatan.php"><button class="tab-btn">Ringkasan</button></a>
            <a href="peserta_pendaftaran.php"><button class="tab-btn active">Daftar Baru</button></a>
            <a href="peserta_progres.php"><button class="tab-btn">Progres</button></a>
        </div>
        <form class="form-section" enctype="multipart/form-data">
            <div class="form-title">Biodata Mahasiswa</div>
            <div class="form-row">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" required>
                </div>
                <div class="form-group">
                    <label>NIM / NIS</label>
                    <input type="text" name="nim" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Universitas</label>
                    <input type="text" name="universitas" required>
                </div>
                <div class="form-group">
                    <label>Fakultas / Prodi</label>
                    <input type="text" name="fakultas" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Jurusan</label>
                    <input type="text" name="jurusan" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="telepon" required>
                </div>
            </div>
        </form>
        <form class="form-section" enctype="multipart/form-data">
            <div class="form-title">Form Pendaftaran Magang</div>
            <div class="form-row">
                <div class="form-group">
                    <label>Tanggal Mulai Magang</label>
                    <input type="date" name="tanggal_mulai" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Selesai Magang</label>
                    <input type="date" name="tanggal_selesai" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>File Proposal Magang</label>
                    <input type="file" name="proposal" accept=".pdf,.doc,.docx" required>
                    <span class="form-upload-note">Format yang diterima: PDF, DOC, DOCX (Maksimal 5MB)</span>
                </div>
                <div class="form-group">
                    <label>File Transkrip Nilai</label>
                    <input type="file" name="transkrip" accept=".pdf,.doc,.docx" required>
                    <span class="form-upload-note">Format yang diterima: PDF, DOC, DOCX (Maksimal 5MB)</span>
                </div>
                <div class="form-group">
                    <label>File CV / Resume</label>
                    <input type="file" name="cv" accept=".pdf" required>
                    <span class="form-upload-note">Format yang diterima: PDF (Maksimal 5MB)</span>
                </div>
            </div>
            <div class="form-requirements">
                <b>Persyaratan Dokumen:</b><br>
                • Proposal magang harus mencakup tujuan, rencana kegiatan, dan target pencapaian<br>
                • CV/Resume harus terbaru dan mencantumkan pengalaman serta keterampilan yang relevan<br>
                • Transkrip nilai resmi dari universitas dengan IPK minimal 3.0<br>
                • Semua dokumen harus jelas dan dapat terbaca dengan baik
            </div>
            <button type="submit" class="submit-btn">Kirim Pendaftaran Magang</button>
        </form>
    </div>
</body>
</html>
