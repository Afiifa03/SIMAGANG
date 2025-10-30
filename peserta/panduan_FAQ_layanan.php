<?php
// PHP untuk Halaman Panduan, FAQ, dan Layanan Peserta

// Data dummy
$nama_peserta = "Afiffa L.D.P";
$program = "Program Magang di BPS Kota Lhokseumawe";
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'umum'; // Menentukan tab aktif dari URL

// Fungsi untuk membuat header navigasi yang konsisten
function generate_header_nav($nama) {
    $nav_items = [
        "Home" => "home.php",
        "Pendaftaran" => "pendaftaran.php",
        "Kegiatan" => "#", // Dropdown
    ];
    $nav_links = "";
    foreach ($nav_items as $text => $link) {
        $nav_links .= "<a href='{$link}' style='color: white; text-decoration: none; margin-left: 30px; font-weight: bold;'>{$text}" . ($text == "Kegiatan" ? " <span style='font-size: 10px;'>▼</span>" : "") . "</a>";
    }

    return "
        <header style='background-color: #0d1a3b; color: white; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center;'>
            <div style='display: flex; align-items: center;'>
                <span style='font-size: 24px; margin-right: 15px;'>👤</span>
                <span style='font-size: 16px;'>Selamat datang, Peserta</span>
                <span style='font-size: 18px; font-weight: bold; margin-left: 10px;'>{$nama}</span>
            </div>
            <nav style='display: flex; align-items: center;'>
                {$nav_links}
                <a href='profile.php' style='background-color: white; color: #0d1a3b; padding: 8px 15px; border-radius: 20px; text-decoration: none; margin-left: 30px; font-weight: bold;'>Profile</a>
            </nav>
        </header>
    ";
}

// Fungsi untuk membuat tab navigasi konten
function generate_tabs($active_tab) {
    $tabs = [
        'umum' => 'Panduan Umum',
        'faq' => 'FAQ',
        'layanan' => 'Layanan',
    ];
    $tab_links = "";
    foreach ($tabs as $key => $label) {
        $is_active = $active_tab == $key;
        $tab_links .= "
            <a href='?tab={$key}' style='
                text-decoration: none;
                color: " . ($is_active ? "#0d1a3b" : "#555") . ";
                padding: 10px 20px;
                border: 1px solid #ddd;
                border-bottom: " . ($is_active ? "2px solid white" : "1px solid #ddd") . ";
                background-color: " . ($is_active ? "white" : "#f4f4f4") . ";
                margin-right: 5px;
                border-radius: 5px 5px 0 0;
                font-weight: " . ($is_active ? "bold" : "normal") . ";
            '>{$label}</a>
        ";
    }
    return "<div style='display: flex; margin-top: 20px;'>{$tab_links}</div>";
}

// Konten Panduan Umum
function content_umum() {
    return "
        <div style='padding: 20px;'>
            <h3 style='color: #0d1a3b;'>Ketentuan Umum</h3>
            <ul style='list-style: none; padding: 0;'>
                <li style='margin-bottom: 15px; display: flex; align-items: flex-start;'>
                    <span style='font-size: 20px; margin-right: 10px;'>🕒</span>
                    <div>
                        <div style='font-weight: bold;'>Jam Kerja</div>
                        <div>Senin - Jumat, 08:00 - 16:00 WIB (Istirahat 12:00 - 13:00)</div>
                    </div>
                </li>
                <li style='margin-bottom: 15px; display: flex; align-items: flex-start;'>
                    <span style='font-size: 20px; margin-right: 10px; color: #4CAF50;'>✅</span>
                    <div>
                        <div style='font-weight: bold;'>Kehadiran</div>
                        <div>Minimal kehadiran 80%. Absensi dilakukan secara manual.</div>
                    </div>
                </li>
                <li style='margin-bottom: 15px; display: flex; align-items: flex-start;'>
                    <span style='font-size: 20px; margin-right: 10px; color: #f44336;'>⛔</span>
                    <div>
                        <div style='font-weight: bold;'>Kode Etik</div>
                        <div>Menjaga kerahasiaan data, berpakaian sopan, dan mematuhi peraturan BPS.</div>
                    </div>
                </li>
            </ul>
        </div>
    ";
}

// Konten FAQ
function content_faq() {
    $faqs = [
        "Berapa lama durasi program magang?" => "Durasi magang ditetapkan selama 3 bulan, dengan opsi perpanjangan tergantung kebutuhan instansi dan performa peserta.",
        "Apakah peserta magang mendapat sertifikat?" => "Ya, peserta yang menyelesaikan program magang dan memenuhi minimal kehadiran 80% akan menerima sertifikat resmi.",
        "Apakah ada dress code yang harus diikut?" => "Peserta diwajibkan mengenakan pakaian formal dan sopan (kemeja berkerah, celana/rok bahan) sesuai dengan standar BPS.",
        "Apakah peserta magang mendapatkan uang saku?" => "Tidak, BPS Lhokseumawe tidak menyediakan uang saku untuk program magang ini.",
        "Bagaimana jika tidak bisa hadir karena sakit?" => "Peserta wajib menginformasikan pembimbing dan melampirkan surat keterangan dokter jika berhalangan hadir lebih dari satu hari.",
    ];
    $faq_html = "";
    foreach ($faqs as $q => $a) {
        // Ini adalah accordion placeholder (diperlukan JS untuk fungsionalitas)
        $faq_html .= "
            <div style='border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px; cursor: pointer;'>
                <div style='padding: 15px; display: flex; justify-content: space-between; font-weight: bold; background-color: #f9f9f9;'>
                    {$q}
                    <span style='font-size: 14px;'>&#9662;</span> 
                </div>
                <div style='padding: 15px; border-top: 1px solid #eee; display: none;'> 
                    {$a}
                </div>
            </div>
        ";
    }

    return "
        <div style='padding: 20px;'>
            <h3 style='color: #0d1a3b;'>Frequently Asked Questions</h3>
            <p>Pertanyaan yang sering diajukan seputar program magang</p>
            <div style='margin-top: 20px;'>
                {$faq_html}
            </div>
        </div>
    ";
}

// Konten Layanan
function content_layanan() {
    // Helper untuk kartu kontak
    function contact_card($icon, $title, $detail) {
        return "
            <div style='flex: 1; margin: 10px; padding: 20px; border: 1px solid #eee; border-radius: 8px; text-align: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05);'>
                <div style='font-size: 30px; margin-bottom: 10px;'>{$icon}</div>
                <div style='font-weight: bold;'>{$title}</div>
                <div style='font-size: 14px; color: #555;'>{$detail}</div>
            </div>
        ";
    }

    return "
        <div style='padding: 20px;'>
            <h3 style='color: #0d1a3b;'>Hubungi Kami</h3>
            <p>Informasi kontak untuk bantuan dan pertanyaan</p>
            
            <div style='display: flex; justify-content: space-around; margin: 20px 0;'>
                " . contact_card("📞", "Telepon", "0811-123-4567") . "
                " . contact_card("📧", "Email", "bps1174@bps.go.id") . "
                " . contact_card("📍", "Alamat", "Jl. Pendidikan No.40, Lhokseumawe") . "
            </div>

            <h3 style='color: #0d1a3b; margin-top: 40px;'>Jam Operasional</h3>
            <div style='background-color: #e3f2fd; padding: 15px; border-radius: 8px; text-align: center; font-size: 18px; font-weight: bold; color: #0d1a3b;'>
                Senin - Jumat, 08.00 - 16.00 WIB
            </div>
        </div>
    ";
}

// Menentukan konten yang akan ditampilkan
$content = "";
switch ($active_tab) {
    case 'faq':
        $content = content_faq();
        break;
    case 'layanan':
        $content = content_layanan();
        break;
    case 'umum':
    default:
        $content = content_umum();
        break;
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Magang - BPS Lhokseumawe</title>
</head>
<body style='font-family: Arial, sans-serif; margin: 0; background-color: #f4f7f6;'>

    <?= generate_header_nav($nama_peserta) ?>

    <main style='padding: 20px 40px;'>
        
        <div style='background-color: #0d1a3b; color: white; padding: 25px; border-radius: 8px; margin-bottom: 20px;'>
            <h1 style='margin: 0;'>Panduan Magang</h1>
            <p style='margin: 5px 0 0;'>Informasi lengkap untuk menjalani program magang di BPS Kota Lhokseumawe</p>
        </div>

        <?= generate_tabs($active_tab) ?>

        <div style='background-color: white; border: 1px solid #ddd; border-top: none; border-radius: 0 0 8px 8px; min-height: 400px; padding: 0 20px;'>
            <?= $content ?>
        </div>

    </main>

</body>
</html>