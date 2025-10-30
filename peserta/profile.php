<?php
// PHP untuk Halaman Profil Peserta dan Modal Edit Profil

// Data dummy
$nama_peserta_header = "Afiffa L.D.P";
$is_profile_edit_mode = isset($_GET['edit']) && $_GET['edit'] == 'true'; // Cek jika modal harus muncul

// Data Profil
$data_profil = [
    'nama' => 'Budi Santoso',
    'nim' => '2021110010',
    'prodi' => 'Informatika',
    'email' => 'budi.santoso@gmail.com',
    'telepon' => '081234567890',
    'alamat' => 'Jl. Pendidikan No.40, Lhokseumawe',
    'universitas' => 'Universitas Syiah Kuala',
    'fakultas' => 'Fakultas Teknik',
    'semester' => '7',
    'ipk' => '3.75'
];

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

// Helper untuk item detail profil
function detail_item($icon, $label, $value) {
    return "
        <div style='display: flex; margin-bottom: 10px;'>
            <div style='width: 30px; font-size: 18px; color: #0d1a3b;'>{$icon}</div>
            <div>
                <div style='font-size: 14px; color: #777;'>{$label}</div>
                <div style='font-weight: bold;'>{$value}</div>
            </div>
        </div>
    ";
}

// Modal/Popup untuk Edit Profile
function edit_profile_modal($data) {
    // Catatan: Ini hanyalah representasi tampilan modal. 
    // Untuk fungsionalitas popup yang sebenarnya, diperlukan JavaScript.
    $display_style = 'flex'; // Agar terlihat seperti modal terbuka

    return "
        <div style='
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
            background-color: rgba(0,0,0,0.5); 
            display: {$display_style}; justify-content: center; align-items: center; 
            z-index: 1000;
        '>
            <div style='background-color: white; padding: 30px; border-radius: 10px; max-width: 500px; width: 90%; box-shadow: 0 5px 15px rgba(0,0,0,0.3);'>
                <h3 style='margin-top: 0; color: #0d1a3b; border-bottom: 1px solid #eee; padding-bottom: 10px;'>Edit Profile</h3>
                <p style='color: #555;'>Perbarui informasi profile Anda</p>

                <form action='profile.php' method='POST'>
                    <div style='display: flex; flex-wrap: wrap; margin: 0 -10px;'>
                        <div style='width: 50%; padding: 10px;'>
                            <label style='display: block; font-weight: bold; margin-bottom: 5px;'>Nama Lengkap</label>
                            <input type='text' name='nama' value='{$data['nama']}' style='width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;'>
                        </div>
                        <div style='width: 50%; padding: 10px;'>
                            <label style='display: block; font-weight: bold; margin-bottom: 5px;'>Email</label>
                            <input type='email' name='email' value='{$data['email']}' style='width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;'>
                        </div>
                        <div style='width: 50%; padding: 10px;'>
                            <label style='display: block; font-weight: bold; margin-bottom: 5px;'>Telepon</label>
                            <input type='text' name='telepon' value='{$data['telepon']}' style='width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;'>
                        </div>
                        <div style='width: 50%; padding: 10px;'>
                            <label style='display: block; font-weight: bold; margin-bottom: 5px;'>NIM / NIS</label>
                            <input type='text' name='nim' value='{$data['nim']}' style='width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;'>
                        </div>
                        <div style='width: 100%; padding: 10px;'>
                            <label style='display: block; font-weight: bold; margin-bottom: 5px;'>Alamat</label>
                            <textarea name='alamat' rows='2' style='width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;'>{$data['alamat']}</textarea>
                        </div>
                    </div>
                    
                    <div style='text-align: right; margin-top: 20px;'>
                        <a href='profile.php' style='color: #555; text-decoration: none; padding: 10px 20px; margin-right: 10px;'>Batal</a>
                        <button type='submit' style='background-color: #0d1a3b; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;'>Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    ";
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Peserta - Budi Santoso</title>
</head>
<body style='font-family: Arial, sans-serif; margin: 0; background-color: #f4f7f6;'>

    <?= generate_header_nav($nama_peserta_header) ?>

    <main style='padding: 30px 40px;'>
        
        <div style='background-color: white; padding: 30px; border-radius: 10px; margin-bottom: 30px; display: flex; align-items: center; box-shadow: 0 4px 8px rgba(0,0,0,0.05);'>
            <div style='width: 80px; height: 80px; background-color: #0d1a3b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 30px; font-weight: bold; margin-right: 20px;'>
                BS
            </div>
            <div style='flex-grow: 1;'>
                <h2 style='margin: 0; color: #0d1a3b;'><?= $data_profil['nama'] ?></h2>
                <p style='margin: 5px 0; color: #555;'><?= $data_profil['nim'] ?> - <?= $data_profil['prodi'] ?></p>
                <div style='background-color: #4CAF50; color: white; padding: 3px 10px; border-radius: 15px; display: inline-block; font-size: 12px; font-weight: bold;'>Aktif</div>
            </div>
            <div>
                <a href='profile.php?edit=true' style='background-color: #f0f0f0; color: #0d1a3b; padding: 8px 15px; border-radius: 20px; text-decoration: none; border: 1px solid #ccc; font-weight: bold; font-size: 14px;'>
                    ✏️ Edit Profile
                </a>
            </div>
        </div>

        <div style='display: flex; gap: 30px;'>
            
            <div style='flex: 1; background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);'>
                <h3 style='margin-top: 0; color: #0d1a3b; border-bottom: 1px solid #eee; padding-bottom: 10px;'>Data Pribadi</h3>
                <?= detail_item("👤", "Nama Lengkap", $data_profil['nama']) ?>
                <?= detail_item("📧", "Email", $data_profil['email']) ?>
                <?= detail_item("📞", "Telepon", $data_profil['telepon']) ?>
                <?= detail_item("📍", "Alamat", $data_profil['alamat']) ?>
            </div>

            <div style='flex: 1; background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);'>
                <h3 style='margin-top: 0; color: #0d1a3b; border-bottom: 1px solid #eee; padding-bottom: 10px;'>Data Akademik</h3>
                <?= detail_item("🎓", "Universitas", $data_profil['universitas']) ?>
                <?= detail_item("🏢", "Fakultas", $data_profil['fakultas']) ?>
                <?= detail_item("📚", "Program Studi", $data_profil['prodi']) ?>
                <?= detail_item("🗓️", "Semester", $data_profil['semester']) ?>
                <?= detail_item("⭐", "IPK", $data_profil['ipk']) ?>
            </div>
        </div>

    </main>

    <?php if ($is_profile_edit_mode): ?>
        <?= edit_profile_modal($data_profil) ?>
    <?php endif; ?>

</body>
</html>