<?php
// PHP untuk Halaman Form Pendaftaran Peserta (Form yang lebih rinci)

$nama_peserta = "Afiffa L.D.P";

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

// Helper untuk field input
function generate_input_field($label, $name, $type='text', $required=true, $placeholder='') {
    $required_star = $required ? " <span class='required-star'>*</span>" : "";
    return "
        <div class='form-group'>
            <label for='{$name}'>{$label}{$required_star}</label>
            <input type='{$type}' id='{$name}' name='{$name}' " . ($required ? "required" : "") . " placeholder='{$placeholder}'>
        </div>
    ";
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran - BPK Ketu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class='form-page'>

    <?= generate_header_nav($nama_peserta, "pendaftaran") ?>

    <main>
        
        <div class='form-container' style='max-width: 1000px;'>
            <h2 style='border-bottom: 2px solid #eee; padding-bottom: 10px;'>Pendaftaran</h2>
            
            <form action="submit_registration.php" method="POST" enctype="multipart/form-data">
                
                <div class='card' style='margin-bottom: 20px;'>
                    <h3 style='color: #0d1a3b;'>Data Mahasiswa/Pelajar</h3>
                    <div class='form-row'>
                        <?= generate_input_field("Nama Lengkap", "nama_lengkap", 'text', true, "Nama sesuai KTP/Kartu Pelajar") ?>
                        <?= generate_input_field("NIM / NIS", "nim_nis", 'text', true, "Nomor Induk Mahasiswa/Siswa") ?>
                    </div>
                    <div class='form-row'>
                        <?= generate_input_field("Jurusan", "jurusan", 'text', true, "Contoh: Informatika") ?>
                        <?= generate_input_field("Email", "email", 'email', true, "Email aktif") ?>
                        <?= generate_input_field("Nomor Telepon", "no_telepon", 'text', true, "Contoh: 0812xxxxxx") ?>
                    </div>
                    <div class='form-group' style='padding: 0 10px;'>
                        <label for='alamat'>Alamat</label>
                        <textarea id='alamat' name='alamat' rows='2' placeholder='Alamat lengkap tempat tinggal saat ini'></textarea>
                    </div>
                </div>

                <div class='card' style='margin-bottom: 20px;'>
                    <h3 style='color: #0d1a3b;'>Form Pendaftaran Magang</h3>
                    <p style='color: #555;'>Lengkapi data dan unggah berkas yang diperlukan</p>
                    
                    <div class='form-row'>
                        <?= generate_input_field("Tanggal Mulai Magang", "tgl_mulai", 'date', true) ?>
                        <?= generate_input_field("Tanggal Selesai Magang", "tgl_selesai", 'date', true) ?>
                    </div>
                    
                    <div class='form-row'>
                        <?= generate_input_field("Pilihan Divisi Magang", "divisi", 'text', true, "Contoh: Statistik Sosial") ?>
                        <?= generate_input_field("Pilihan Lokasi Magang", "lokasi", 'text', true, "Contoh: BPS Kota Lhokseumawe") ?>
                    </div>

                    <div class='form-row'>
                        <?= generate_input_field("File Proposal Magang", "file_proposal", 'file', true, "Format file: PDF, DOC, DOCX") ?>
                        <?= generate_input_field("File Transkrip Nilai", "file_transkrip", 'file', true, "Format file: PDF") ?>
                    </div>
                    
                    <div class='form-row'>
                        <?= generate_input_field("File CV/Resume", "file_cv", 'file', true, "Format file: PDF") ?>
                        <?= generate_input_field("Surat Pengantar dari Kampus", "file_surat", 'file', true, "Format file: PDF") ?>
                    </div>

                    <div class='form-group' style='padding: 0 10px;'>
                        <h4 style='margin-top: 20px;'>Persyaratan Dokumen:</h4>
                        <ul style='list-style-type: disc; margin-left: 20px; color: #555; font-size: 14px;'>
                            <li>Proposal Magang (minimal 10 halaman)</li>
                            <li>Transkrip Nilai (IPK minimal 3.00)</li>
                            <li>CV/Resume, dan lain-lain.</li>
                        </ul>
                    </div>

                </div>

                <div style='text-align: right; margin-top: 30px;'>
                    <button type='submit' class='button'>Kirim Pendaftaran Magang</button>
                </div>
            </form>

        </div>

    </main>

</body>
</html>