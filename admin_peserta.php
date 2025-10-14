<?php
session_start();
if (!isset($_SESSION['peserta'])) {
	$_SESSION['peserta'] = [
		["Afiifa Lhokseum", "20222573010002", "Teknik Informatika", "TIK", "Politeknik Negeri Lhokseumawe"],
		["Afiifa Lhokseum", "20222573010002", "Teknik Informatika", "TIK", "Politeknik Negeri Lhokseumawe"],
		["Afiifa Lhokseum", "20222573010002", "Teknik Informatika", "TIK", "Politeknik Negeri Lhokseumawe"],
		["Afiifa Lhokseum", "20222573010002", "Teknik Informatika", "TIK", "Politeknik Negeri Lhokseumawe"],
	];
}
$peserta = $_SESSION['peserta'];

// Tambah peserta
if (isset($_POST['tambah'])) {
	$nama = $_POST['nama'];
	$nim = $_POST['nim'];
	$jurusan = $_POST['jurusan'];
	$prodi = $_POST['prodi'];
	$kampus = $_POST['kampus'];
	$_SESSION['peserta'][] = [$nama, $nim, $jurusan, $prodi, $kampus];
	header('Location: admin_peserta.php'); exit;
}

// Hapus peserta
if (isset($_GET['hapus'])) {
	$id = intval($_GET['hapus']);
	if (isset($_SESSION['peserta'][$id])) {
		array_splice($_SESSION['peserta'], $id, 1);
		// Rapikan index agar urutan peserta tetap berurutan
		$_SESSION['peserta'] = array_values($_SESSION['peserta']);
	}
	header('Location: admin_peserta.php'); exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daftar Peserta</title>
	<link rel="stylesheet" href="style_admin_peserta.css">
</head>
<body>
	<nav>
		<div style="font-size: 24px; font-weight: bold; letter-spacing: 1px;">SIMAGANG BPS</div>
		<div class="nav-menu">
			<a href="admin_dashboard.php"><button class="nav-btn<?php echo basename($_SERVER['PHP_SELF'])=='admin_dashboard.php'?' active':''; ?>">Dashboard</button></a>
			<a href="admin_peserta.php"><button class="nav-btn<?php echo basename($_SERVER['PHP_SELF'])=='admin_peserta.php'?' active':''; ?>">Peserta</button></a>
			<a href="admin_progres.php"><button class="nav-btn<?php echo basename($_SERVER['PHP_SELF'])=='admin_progres.php'?' active':''; ?>">Progres Peserta</button></a>
		</div>
		<div style="position: relative; display: inline-block;">
			<button id="userDropdownBtn" style="background: none; border: none; color: white; font-size: 22px; cursor: pointer;">
				<svg width="22" height="22" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg" style="vertical-align:middle;">
					<path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
				</svg>
				▼
			</button>
			<div id="userDropdownMenu" style="display: none; position: absolute; right: 0; background: #fff; min-width: 150px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); border-radius: 6px; z-index: 100;">
				<a href="profile_admin.php" style="display: block; padding: 10px 20px; color: #2c3e50; text-decoration: none;">Profile</a>
				<a href="index.php" style="display: block; padding: 10px 20px; color: #e74c3c; text-decoration: none;">Logout</a>
			</div>
		</div>
	</nav>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			var btn = document.getElementById('userDropdownBtn');
			var menu = document.getElementById('userDropdownMenu');
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
		<div class="peserta-title">Daftar Peserta</div>
		<div class="card">
				<!-- Form tambah peserta -->
				<form method="post" style="margin-bottom:18px; display:<?php echo isset($_GET['form'])?'block':'none'; ?>;">
					<div style="display:flex; gap:12px; flex-wrap:wrap;">
						<input type="text" name="nama" placeholder="Nama" required style="padding:8px; border-radius:6px; border:1px solid #bdbdbd; font-size:16px;">
						<input type="text" name="nim" placeholder="NIM" required style="padding:8px; border-radius:6px; border:1px solid #bdbdbd; font-size:16px;">
						<input type="text" name="jurusan" placeholder="Jurusan" required style="padding:8px; border-radius:6px; border:1px solid #bdbdbd; font-size:16px;">
						<input type="text" name="prodi" placeholder="Program Studi" required style="padding:8px; border-radius:6px; border:1px solid #bdbdbd; font-size:16px;">
						<input type="text" name="kampus" placeholder="Asal Kampus" required style="padding:8px; border-radius:6px; border:1px solid #bdbdbd; font-size:16px;">
						<button type="submit" name="tambah" style="background:#21a1ad; color:#fff; border:none; border-radius:6px; padding:8px 18px; font-size:16px; font-weight:bold; cursor:pointer;">Simpan</button>
					</div>
				</form>
				<button class="btn-tambah" onclick="window.location.href='?form=1'" style="display:<?php echo isset($_GET['form'])?'none':'flex'; ?>;"><span>+</span>Tambah Data</button>
				<table class="peserta-table">
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>NIM/NIS</th>
					<th>Jurusan</th>
					<th>Program Studi</th>
					<th>Kampus/Sekolah</th>
					<th>Aksi</th>
				</tr>
				<!-- Semua baris isi tabel peserta diisi lengkap, tidak ada baris kosong -->
				<?php foreach($peserta as $i => $row): ?>
				<tr>
					<td><?php echo $i+1; ?></td>
					<td><?php echo $row[0]; ?></td>
					<td><?php echo $row[1]; ?></td>
					<td><?php echo $row[2]; ?></td>
					<td><?php echo $row[3]; ?></td>
					<td><?php echo $row[4]; ?></td>
					<td class="table-action">
						<a href="detail_pesertaadmin.php?nama=<?php echo urlencode($row[0]); ?>" class="icon-btn" title="Info">
							<!-- SVG info icon -->
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="#222" stroke-width="2" fill="none"/><circle cx="12" cy="8" r="1" fill="#222"/><rect x="11" y="11" width="2" height="6" rx="1" fill="#222"/></svg>
						</a>
						<button class="icon-btn" title="Delete" onclick="hapusPeserta(<?php echo $i; ?>)">
							<!-- SVG delete icon -->
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect x="5" y="7" width="14" height="12" rx="2" stroke="#222" stroke-width="2" fill="none"/><path d="M9 11v6M12 11v6M15 11v6" stroke="#222" stroke-width="2"/><rect x="9" y="4" width="6" height="3" rx="1.5" stroke="#222" stroke-width="2" fill="none"/></svg>
						</button>
					</td>
				</tr>
				<?php endforeach; ?>
				<!-- Baris kosong agar tabel tetap rapi -->
				<?php for($j=0;$j<3;$j++): ?>
				<tr>
					<td><?php echo count($peserta)+$j+1; ?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="table-action">
						<button class="icon-btn" title="Info" disabled>
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="#ccc" stroke-width="2" fill="none"/><circle cx="12" cy="8" r="1" fill="#ccc"/><rect x="11" y="11" width="2" height="6" rx="1" fill="#ccc"/></svg>
						</button>
						<button class="icon-btn" title="Delete" disabled>
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect x="5" y="7" width="14" height="12" rx="2" stroke="#ccc" stroke-width="2" fill="none"/><path d="M9 11v6M12 11v6M15 11v6" stroke="#ccc" stroke-width="2"/><rect x="9" y="4" width="6" height="3" rx="1.5" stroke="#ccc" stroke-width="2" fill="none"/></svg>
						</button>
					</td>
				</tr>
				<?php endfor; ?>
			</table>
		</div>
	</div>
<script>
function hapusPeserta(idx) {
	if (confirm('Apakah Anda yakin ingin menghapus data peserta ini?')) {
		window.location.href = '?hapus=' + idx;
	}
}
</script>
</body>
</html>
