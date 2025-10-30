<?php
// Data dummy
$nama_peserta = "Afiffa L.D.P";
$total_peserta = 5;
$total_aplikasi = 10;
$magang_aktif = 3;

// PATH GAMBAR ILUSTRASI
$image_path = "C:/laragon/www/SIMAGANG/peserta/home_peserta.jpg";

// Fungsi untuk membuat header navigasi yang konsisten
function generate_header_nav($nama, $active_page) {
    $nav_items = [
        "Home" => "home_peserta.php",
        "Pendaftaran" => "form_pendaftaran.php",
        "Kegiatan" => "#", // Dropdown
    ];
    $nav_links = "";
    foreach ($nav_items as $text => $link) {
        // Menggunakan class CSS untuk styling aktif
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

// Fungsi untuk membuat kartu statistik
function generate_stat_card($value, $label, $sub_label) {
    return "
        <div class='stat-card'>
            <div class='stat-label'>{$label}</div>
            <div class='stat-value'>{$value}</div>
            <div class='stat-sub-label'>{$sub_label}</div>
        </div>
    ";
}

// Fungsi untuk membuat kartu info ikon
function generate_info_card($title, $icon_text) {
    return "
        <div class='info-icon-card'>
            <div class='icon-placeholder'>{$icon_text}</div> 
            <div class='info-title'>{$title}</div>
        </div>
    ";
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Peserta - BPK Ketu</title>
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

    <footer>
        <div class='footer-contact'>
            <div>Alamat Kantor: BPS Kota Lhokseumawe</div>
            <div>Email: bps1174@bps.go.id</div>
        </div>
        <div class='footer-social'>
            <a href="#">Fb</a> | <a href="#">Tw</a> | <a href="#">Ig</a>
        </div>
    </footer>

</body>
</html>