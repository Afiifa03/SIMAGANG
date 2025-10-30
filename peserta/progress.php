<?php
// PHP untuk Halaman Progress Peserta

$nama_peserta_header = "Afiffa L.D.P";
$nama_profil = "Budi Santoso";
$nim_prodi = "2021110010 - Informatika";
$progress_persentase = 80;

$tahapan_progress = [
    // Status: complete, active, pending
    ["Verifikasi Dokumen", "complete", "Dokumen telah diverifikasi", "Cek", "check"],
    ["Wawancara", "complete", "Wawancara telah diselesaikan", "Cek", "comment-alt"],
    ["Penerimaan", "active", "Menunggu surat keputusan penerimaan", "Detail", "file-alt"],
    ["Pelaksanaan Magang", "pending", "Magang akan dimulai pada 10 Okt 2025", "Detail", "tasks"],
    ["Sertifikasi", "pending", "Sertifikat akan diproses setelah magang selesai", "Detail", "certificate"],
];

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

    // Tambahkan dropdown "Progress Magang" di "Kegiatan"
    $dropdown = "
        <div class='dropdown'>
            <button class='dropdown-toggle'>Kegiatan <span style='font-size: 10px;'>▼</span></button>
            <div class='dropdown-menu'>
                <a href='progress_peserta.php'>Progress Magang</a>
                <a href='#'>Jadwal Kegiatan</a>
            </div>
        </div>
    ";

    return "
        <header>
            <div class='header-left'>
                <span class='profile-icon'>👤</span>
                <span class='welcome-text'>Selamat datang, Peserta</span>
                <span class='username'>{$nama}</span>
            </div>
            <nav>
                <a href='home_peserta.php' class='nav-link'>Home</a>
                <a href='form_pendaftaran.php' class='nav-link'>Pendaftaran</a>
                <div style='position: relative; display: inline-block;'>
                    <a href='#' class='nav-link' style='font-weight: bold;'>Kegiatan <span style='font-size: 10px;'>▼</span></a>
                    <div style='position: absolute; top: 100%; right: 0; background-color: white; border: 1px solid #ddd; border-radius: 5px; min-width: 150px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); z-index: 10;'>
                        <a href='progress_peserta.php' style='color: #333; padding: 10px; display: block; text-decoration: none;'>Progress Magang</a>
                        <a href='#' style='color: #333; padding: 10px; display: block; text-decoration: none;'>Jadwal</a>
                    </div>
                </div>
                <a href='profile.php' class='profile-btn'>Profile</a>
            </nav>
        </header>
    ";
}

// Fungsi untuk membuat item progres
function generate_progress_item($title, $status, $description, $button_text, $icon_name) {
    $class = "progress-item " . $status;
    $icon_bg = "#ccc"; // default pending
    $icon_text = "⚪";
    $btn_style = "background-color: #ccc;";

    if ($status === 'complete') {
        $icon_bg = "#4CAF50"; // green
        $icon_text = "✅";
        $btn_style = "background-color: #4CAF50;";
    } elseif ($status === 'active') {
        $icon_bg = "#6200EE"; // purple
        $icon_text = "📝";
        $btn_style = "background-color: #6200EE;";
    }

    return "
        <div class='{$class}'>
            <div class='progress-icon-wrapper'>
                <div class='progress-icon' style='background-color: {$icon_bg};'>{$icon_text}</div>
            </div>
            <div class='progress-content'>
                <div class='progress-title'>{$title}</div>
                <div class='progress-description'>{$description}</div>
            </div>
            <button class='progress-button' style='{$btn_style}'>{$button_text}</button>
        </div>
    ";
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Peserta - BPK Ketu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class='progress-page'>

    <?= generate_header_nav($nama_peserta_header, "progress") ?>

    <main>
        <div style='max-width: 800px; margin: 0 auto;'>

            <div class='profile-main-info card' style='margin-bottom: 20px; display: block; text-align: center;'>
                <div class='profile-avatar' style='margin: 0 auto 10px;'>BS</div>
                <h2 style='margin: 0; color: #0d1a3b;'><?= $nama_profil ?></h2>
                <p style='margin: 5px 0 15px;'><?= $nim_prodi ?></p>

                <div class='progress-bar-container' style='text-align: left;'>
                    <h3 style='margin-bottom: 10px; font-size: 16px;'>Status Pendaftaran: <?= $progress_persentase ?>%</h3>
                    <div class='progress-bar'>
                        <div class='progress-fill' style='width: <?= $progress_persentase ?>%;'></div>
                    </div>
                </div>
            </div>
            
            <div class='card' style='padding: 20px;'>
                <h3 style='color: #0d1a3b; border-bottom: 1px solid #ddd; padding-bottom: 10px;'>Status Progres Magang</h3>
                <div class='progress-list'>
                    <?php foreach ($tahapan_progress as $tahap): ?>
                        <?= generate_progress_item($tahap[0], $tahap[1], $tahap[2], $tahap[3], $tahap[4]) ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>

    </body>
</html>