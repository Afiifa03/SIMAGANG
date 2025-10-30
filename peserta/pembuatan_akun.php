<?php
// PHP untuk Halaman Pembuatan Akun Peserta (Modal di atas Home)

$nama_peserta = "Afiffa L.D.P";

// PATH GAMBAR ILUSTRASI (untuk latar belakang home)
$image_path = "C:/laragon/www/SIMAGANG/peserta/home_peserta.jpg";


// Fungsi untuk membuat header navigasi yang konsisten
function generate_header_nav($nama, $active_page) {
    // ... (Fungsi yang sama dengan home_peserta.php) ...
    $nav_items = [
        "Home" => "home_peserta.php",
        "Pendaftaran" => "form_pendaftaran.php",
        "Kegiatan" => "#", // Dropdown
    ];
    $nav_links = "";
    foreach ($nav_items as $text => $link) {
        $active_class = (strtolower($text) == $active_page) ? 'style="font-weight: bold; text-decoration: underline;"' : '';
        $nav_links .= "<a href='{$link}' class='nav-link' {$active_class}>{$text}" . ($text == "Kegiatan" ? " <span style='font-size: 10px;'>▼</span>" : "") . "</a>";
    }

    return "
        <header>
            <div class='header-left'>
                <span class='profile-icon'>👤</span>
                <span class='welcome-text'>Selamat datang, Peserta</span>
                <span class='username'>{$nama}</span>
            </div>
            <nav>
                {$nav_links}
                <a href='profile.php' class='profile-btn'>Profile</a>
            </nav>
        </header>
    ";
}

// Fungsi untuk membuat kartu statistik (diperlukan untuk latar belakang home)
function generate_stat_card($value, $label, $sub_label) {
    return "
        <div class='stat-card'>
            <div class='stat-label'>{$label}</div>
            <div class='stat-value'>{$value}</div>
            <div class='stat-sub-label'>{$sub_label}</div>
        </div>
    ";
}

// Fungsi untuk membuat kartu info ikon (diperlukan untuk latar belakang home)
function generate_info_card($title, $icon_text) {
    return "
        <div class='info-icon-card'>
            <div class='icon-placeholder'>{$icon_text}</div> 
            <div class='info-title'>{$title}</div>
        </div>
    ";
}


// Data dummy untuk konten Home (sebagai latar belakang)
$total_peserta = 5;
$total_aplikasi = 10;
$magang_aktif = 3;

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Peserta - BPK Ketu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class='home-page'>

    <?= generate_header_nav($nama_peserta, "home") ?>

    <main>
        
        <div class='card welcome-section'>
            <div class='welcome-text'>
                <h1 style='margin-bottom: 5px;'>Bergabunglah dengan BPS Kota Lhokseumawe:</h1>
                <h1 style='color: #6200EE; margin-top: 5px; font-size: 28px;'>Bentuk Masa Depan Data Indonesia!</h1>
                <p>Jadilah bagian dari perubahan data yang akurat dan terpercaya.</p>
                <a href='form_pendaftaran.php' class='button'>Daftar Magang</a>
            </div>
            <div class='welcome-image-placeholder'>
                <img src="<?= $image_path ?>" alt="Tim BPS berdiskusi" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
            </div>
        </div>

        <div class='card-container'>
            <?= generate_stat_card($total_peserta, "Total Peserta", "Keseluruhan Terdaftar") ?>
            <?= generate_stat_card($total_aplikasi, "Aplikasi", "Telah Terkumpul") ?>
            <?= generate_stat_card($magang_aktif, "Magang Aktif", "Sedang Magang") ?>
        </div>

        <div class='card'>
            <h2 style='border-bottom: 2px solid #eee; padding-bottom: 10px;'>Tentang Magang di BPS</h2>
            <div class='card-container' style='gap: 0;'>
                <?= generate_info_card("Pengembangan Diri", "🧠") ?>
                <?= generate_info_card("Penerapan Teori", "💡") ?>
                <?= generate_info_card("Jaringan Sosial", "🤝") ?>
            </div>
        </div>
    </main>

    <div class='modal-overlay' id='akunModal' style='display: flex;'>
        <div class='modal-content' style='max-width: 400px;'>
            <h3 style='text-align: center;'>Buat Akun Peserta</h3>
            <p style='text-align: center; color: #555;'>Silakan isi informasi akun Anda</p>
            
            <form action="submit_akun.php" method="POST">
                <div class='form-group' style='padding: 0;'>
                    <label for='nama'>Nama Lengkap <span class='required-star'>*</span></label>
                    <input type='text' id='nama' name='nama' required placeholder='Masukkan nama lengkap'>
                </div>

                <div class='form-group' style='padding: 0;'>
                    <label for='email'>Email <span class='required-star'>*</span></label>
                    <input type='email' id='email' name='email' required placeholder='contoh@gmail.com'>
                </div>
                
                <div class='form-group' style='padding: 0;'>
                    <label for='nim'>NIM / NIS <span class='required-star'>*</span></label>
                    <input type='text' id='nim' name='nim' required placeholder='Nomor Induk Mahasiswa/Siswa'>
                </div>

                <div class='form-group' style='padding: 0;'>
                    <label for='password'>Password <span class='required-star'>*</span></label>
                    <input type='password' id='password' name='password' required placeholder='Minimal 6 karakter'>
                </div>

                <div class='form-group' style='padding: 0;'>
                    <label for='konfirmasi_password'>Konfirmasi Password <span class='required-star'>*</span></label>
                    <input type='password' id='konfirmasi_password' name='konfirmasi_password' required placeholder='Ulangi password'>
                </div>

                <div class='modal-actions' style='text-align: center;'>
                    <button type='submit' class='button' style='width: 100%; background-color: #0d1a3b;'>Buat Akun Sekarang</button>
                </div>
            </form>

        </div>
    </div>
    
</body>
</html>