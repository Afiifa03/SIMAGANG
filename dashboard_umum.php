<?php
// Data untuk dashboard_umum
$stats = [
    'slot_magang' => 3,
    'pendaftar' => 10,
    'alumni' => 43,
    'pembimbing' => 1,
    'universitas_mitra' => 3
];

$universitas = [
    ['nama' => 'UIN Sumatera Utara Medan', 'status' => 'aktif'],
    ['nama' => 'Politeknik Negeri Lhokseumawe', 'status' => 'non-aktif'],
    ['nama' => 'Universitas Malikussaleh', 'status' => 'non-aktif']
];

$slots = [
    ['status' => 'Terisi'],
    ['status' => 'Terisi'],
    ['status' => 'Terisi'],
    ['status' => 'Kosong'],
    ['status' => 'Kosong']
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAGANG - BPS Lhokseumawe</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

    <div class="container py-4">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="fw-bold text-primary">SIMAGANG</h1>
            <p><small class="text-muted">Statistik untuk Negeri, data untuk semua</small></p>
            <hr class="w-25 mx-auto">
        </div>

        <!-- Hero Card -->
        <div class="card text-center shadow mb-4">
            <div class="card-body">
                <h2 class="card-title">BPS LHOKSEUMAWE</h2>
                <h5 class="card-subtitle mb-2 text-muted">Internship Information</h5>
                <p class="card-text">Platform terpadu untuk mengelola program pendaftaran magang</p>
                <a href="login.php" class="btn btn-primary">Masuk dan Daftar Sekarang</a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="row g-4">
            <!-- Slot Magang -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title">Slot Magang</h5>
                            <i class="fas fa-book-open text-primary"></i>
                        </div>
                        <h3><?php echo $stats['slot_magang']; ?></h3>
                        <small class="text-muted">tersedia</small>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pendaftar -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title">Pendaftar Periode Ini</h5>
                            <i class="fas fa-users text-success"></i>
                        </div>
                        <h3><?php echo $stats['pendaftar']; ?></h3>
                        <p class="text-muted mb-0">pendaftar pada periode 2025</p>
                    </div>
                </div>
            </div>

            <!-- Alumni -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title">Total Alumni Magang</h5>
                            <i class="fas fa-graduation-cap text-warning"></i>
                        </div>
                        <h3><?php echo $stats['alumni']; ?></h3>
                        <p class="text-muted mb-0">Alumni yang telah menyelesaikan program magang</p>
                    </div>
                </div>
            </div>

            <!-- Pembimbing -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title">Pembimbing Tersedia</h5>
                            <i class="fas fa-user-check text-info"></i>
                        </div>
                        <h3><?php echo $stats['pembimbing']; ?></h3>
                        <p class="text-muted mb-0">Supervisor Aktif</p>
                    </div>
                </div>
            </div>

            <!-- Universitas -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title">Universitas Mitra</h5>
                            <i class="fas fa-building text-danger"></i>
                        </div>
                        <h3><?php echo $stats['universitas_mitra']; ?></h3>
                        <p class="text-muted">Universitas yang berpartisipasi</p>
                        <ul class="list-group">
                            <?php foreach ($universitas as $univ): ?>
                                <li class="list-group-item d-flex align-items-center">
                                    <span class="badge rounded-circle me-2 
                                        <?php echo $univ['status'] === 'aktif' ? 'bg-success' : 'bg-secondary'; ?>">&nbsp;</span>
                                    <?php echo $univ['nama']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Slot Detail -->
            <div class="col-md-12">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title">Slot Magang Detail</h5>
                            <i class="fas fa-file-text text-dark"></i>
                        </div>
                        <div class="row">
                            <?php foreach ($slots as $slot): ?>
                            <div class="col-md-2 col-6 text-center mb-3">
                                <i class="fas fa-users"></i><br>
                                <span class="badge <?php echo $slot['status'] === 'Terisi' ? 'bg-success' : 'bg-danger'; ?>">
                                    <?php echo $slot['status']; ?>
                                </span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-5 p-4 bg-white shadow-sm rounded d-flex justify-content-between">
            <div>
                <h6><i class="fas fa-map-marker-alt text-danger"></i> Alamat Kantor</h6>
                <p class="mb-1">Badan Pusat Statistik Kota Lhokseumawe</p>
                <p class="mb-1">Jl. H. Ramli Ridwan, yang berada di kawasan Mon Geudong,<br> 
                Kecamatan Banda Sakti, Kota Lhokseumawe, Aceh.<br> 
                Kode posnya adalah 24351. <br>
                Badan Pusat Statistik Kota Lhokseumawe</p>
                <p class="mt-2"><i class="fas fa-envelope"></i> bpslhokseumawe@gmail.com</p>
            </div>
            <div>
                <h6>Sosial Media</h6>
                <a href="#" class="btn btn-outline-danger btn-sm me-2"><i class="fab fa-youtube"></i></a>
                <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="btn btn-outline-warning btn-sm me-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="btn btn-outline-success btn-sm"><i class="fab fa-whatsapp"></i></a>
            </div>
        </footer>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
