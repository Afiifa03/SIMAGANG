<?php
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
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f5f5f5;
			margin: 0;
			padding: 0;
		}
		nav {
			background-color: #2c3e50;
			padding: 32px 32px 24px 32px;
			display: flex;
			justify-content: space-between;
			align-items: center;
			color: white;
			font-size: 22px;
		}
		.nav-menu {
			display: flex;
			gap: 18px;
		}
		.nav-btn {
			padding: 10px 32px;
			border-radius: 12px;
			border: none;
			font-size: 20px;
			font-weight: bold;
			background: transparent;
			color: #fff;
			cursor: pointer;
			transition: background 0.3s, color 0.3s;
		}
		.nav-btn.active {
			background: #fff;
			color: #2c3e50;
			box-shadow: 0 2px 8px rgba(0,0,0,0.08);
		}
		.nav-btn:hover {
			background: #f4f4f4;
			color: #2c3e50;
		}
		.container {
			padding: 30px;
			min-height: 100vh;
		}
		.peserta-title {
			font-size: 32px;
			font-weight: bold;
			margin-bottom: 28px;
			color: #111;
			margin-left: 32px;
		}
		.card {
			background: #fff;
			border-radius: 12px;
			padding: 25px;
			box-shadow: 0 4px 12px rgba(0,0,0,0.08);
			border: 1px solid #e0e0e0;
			margin-bottom: 30px;
		}
		.btn-tambah {
			background: #fff;
			color: #222;
			font-weight: bold;
			font-size: 18px;
			border: none;
			border-radius: 8px;
			padding: 10px 28px;
			margin-bottom: 18px;
			box-shadow: 0 2px 6px rgba(0,0,0,0.08);
			cursor: pointer;
			display: flex;
			align-items: center;
			gap: 8px;
		}
		.btn-tambah:hover {
			background: #e0e0e0;
		}
		table.peserta-table {
			width: 100%;
			border-collapse: collapse;
			background: #fff;
			font-size: 22px;
			border-radius: 12px;
			overflow: hidden;
		}
		table.peserta-table th, table.peserta-table td {
			border: 1.5px solid #e0e0e0;
			padding: 18px 14px;
			text-align: left;
		}
		table.peserta-table th {
			background: #f5f5f5;
			font-weight: bold;
		}
		.table-action {
			display: flex;
			gap: 12px;
			justify-content: center;
		}
		.icon-btn {
			background: none;
			border: none;
			cursor: pointer;
			font-size: 22px;
			padding: 0;
		}
		.icon-btn svg {
			vertical-align: middle;
		}
	</style>
</head>
<body>
	
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
