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
    <title>Profil Peserta</title>
    <link rel="stylesheet" href="style_peserta_profile.css">
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
                <button class="nav-btn" id="kegiatanBtn">Kegiatan &#9662;</button>
                <div class="dropdown-content" id="kegiatanMenu">
                    <a href="peserta_ringkasankegiatan.php">Ringkasan</a>
                    <a href="peserta_pendaftaran.php">Daftar Baru</a>
                    <a href="peserta_progres.php">Progres</a>
                </div>
            </div>
            <a href="peserta_profile.php"><button class="nav-btn active">Profile</button></a>
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
        <div class="profile-section">
            <div class="profile-title">Profil Saya</div>
            <form class="profile-form">
                <div class="profile-group">
                    <label>Nama Lengkap</label>
                    <input type="text" id="nama" value="Afiifa Lhokseum Dwi Putri" readonly>
                </div>
                <div class="profile-group">
                    <label>Alamat</label>
                    <input type="text" id="alamat" value="Pardede" readonly>
                </div>
                <div class="profile-group">
                    <label>Universitas / Sekolah</label>
                    <select id="universitas" disabled>
                        <option selected>POLITEKNIK NEGERI LHOKSEUMAWE</option>
                    </select>
                </div>
                <div class="profile-group">
                    <label>NIM / NIS</label>
                    <input type="text" id="nim" value="2022573010002" readonly>
                </div>
                <div class="profile-group">
                    <label>Jurusan</label>
                    <input type="text" id="jurusan" value="Teknik Informasi dan Komputer" readonly>
                </div>
                <div class="profile-group">
                    <label>Fakultas / Prodi</label>
                    <input type="text" id="fakultas" value="Teknik Informatika" readonly>
                </div>
                <div class="profile-group">
                    <label>Email</label>
                    <input type="email" id="email" value="afiifadwi@gmail.com" readonly>
                </div>
                <div class="profile-group">
                    <label>No_Hp</label>
                    <input type="text" id="nohp" value="082276193741" readonly>
                </div>
                <button type="button" class="edit-btn" id="editBtn">Edit Profile</button>
            </form>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const editBtn = document.getElementById('editBtn');
        const nama = document.getElementById('nama');
        const alamat = document.getElementById('alamat');
        const universitas = document.getElementById('universitas');
        const nim = document.getElementById('nim');
        const jurusan = document.getElementById('jurusan');
        const fakultas = document.getElementById('fakultas');
        const email = document.getElementById('email');
        const nohp = document.getElementById('nohp');
        let editing = false;
        editBtn.addEventListener('click', function() {
            editing = !editing;
            if (editing) {
                nama.readOnly = false;
                alamat.readOnly = false;
                universitas.disabled = false;
                nim.readOnly = false;
                jurusan.readOnly = false;
                fakultas.readOnly = false;
                email.readOnly = false;
                nohp.readOnly = false;
                editBtn.textContent = 'Simpan';
            } else {
                nama.readOnly = true;
                alamat.readOnly = true;
                universitas.disabled = true;
                nim.readOnly = true;
                jurusan.readOnly = true;
                fakultas.readOnly = true;
                email.readOnly = true;
                nohp.readOnly = true;
                editBtn.textContent = 'Edit Profile';
                // Here you can add code to save the data if needed
            }
        });
    });
    </script>
</body>
</html>
