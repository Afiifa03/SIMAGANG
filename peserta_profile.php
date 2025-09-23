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
        .profile-section {
            background: #4ec3c3;
            border-radius: 18px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            border: 1px solid #e0e0e0;
            padding: 36px 64px;
            margin: 40px auto;
            max-width: 900px;
        }
        .profile-title {
            font-size: 32px;
            font-weight: bold;
            color: #222;
            margin-bottom: 28px;
        }
        .profile-form {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
        }
        .profile-group {
            flex: 1 1 350px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        label {
            font-size: 18px;
            font-weight: bold;
            color: #222;
        }
        input[type="text"], input[type="email"], select {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 18px;
            background: #f9f9f9;
        }
        .edit-btn {
            background: #222;
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            padding: 14px 38px;
            margin-top: 32px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .edit-btn:hover {
            background: #444;
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
