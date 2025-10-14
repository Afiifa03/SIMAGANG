<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = ['email' => 'admin@bps.go.id', 'type' => 'admin'];
}
$keterangan = isset($_SESSION['keterangan']) ? $_SESSION['keterangan'] : 'Magang Web development, fokus pada aplikasi Web Site';
$status = isset($_SESSION['status']) ? $_SESSION['status'] : 'Sedang Magang';
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Progres Peserta</title>
	<link rel="stylesheet" href="style_admin_progres.css">
</head>
<body>
	<nav>
		<div style="font-size: 24px; font-weight: bold; letter-spacing: 1px;">SIMAGANG BPS</div>
		<div class="nav-menu">
			<a href="admin_dashboard.php"><button class="nav-btn">Dasbor Admin</button></a>
			<a href="admin_peserta.php"><button class="nav-btn">Peserta</button></a>
			<a href="admin_progres.php"><button class="nav-btn active">Progres Peserta</button></a>
		</div>
		<div style="position: relative; display: inline-block;">
			<button id="userDropdownBtn" style="background: none; border: none; color: white; font-size: 22px; cursor: pointer;">👤 ▼</button>
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
		<div class="title" style="margin-left: 450px;">Progres Peserta</div>
		<div class="subtitle" style="margin-left: 450px; margin-bottom: 74px;">Progres semua peserta magang yang sedang berlangsung</div>
		<?php
		// Ambil data peserta dari session admin_peserta
		$peserta_list = [];
		if (isset($_SESSION['peserta']) && count($_SESSION['peserta']) > 0) {
			foreach ($_SESSION['peserta'] as $i => $row) {
				// Status, progres, dan keterangan unik per peserta
				$default_status = [
					'Menunggu Verifikasi',
					'Sedang Magang',
					'Ditolak',
					'Selesai Magang'
				];
				$default_ket = [
					'Baru daftar, menunggu verifikasi berkas',
					'Magang mobile development, fokus pada aplikasi Android',
					'Tidak lolos seleksi administrasi',
					'Magang selesai dengan hasil baik'
				];
				$default_progress = [0, 60, 0, 100];
				$peserta_list[] = [
					'nama' => $row[0],
					'periode' => '01/10/2025 - 31/12/2025',
					'status' => $default_status[$i % count($default_status)],
					'progress' => $default_progress[$i % count($default_progress)],
					'keterangan' => $default_ket[$i % count($default_ket)],
					'pembimbing' => 'Zulkarnaini, S.Si., MSi',
					'durasi' => '90 hari',
					'nomor' => $i+1 // Nomor urut peserta sesuai urutan tabel
				];
			}
		}
		foreach ($peserta_list as $i => $p):
		?>
		<div class="progres-card">
			<span class="progres-status <?php echo strtolower(str_replace(' ', '-', $p['status'])); ?>"><?php echo htmlspecialchars($p['status']); ?></span>
			<div class="progres-header">Peserta Magang <?php echo $i+1; ?> : <?php echo htmlspecialchars($p['nama']); ?></div>
			<div class="progres-periode">Periode : <?php echo $p['periode']; ?></div>
			<div style="font-weight:bold; margin-bottom:2px;">Progres Magang</div>
			<!-- Stacked draggable bar chart dengan bola -->
			<div style="width:100%; margin:18px 0 8px 0;">
				<div id="barLabel_<?php echo $i; ?>" style="width:100%; text-align:right; font-size:16px; font-weight:bold; color:#222; margin-bottom:2px;">
					<?php echo $p['progress']; ?>%
				</div>
				<div id="stackedBarContainer<?php echo $i; ?>" style="width:100%; background:#eee; border-radius:8px; height:32px; position:relative;">
					<div class="stacked-bar" id="bar1_<?php echo $i; ?>" style="background:#4b3aff; width:<?php echo $p['progress']; ?>%; height:100%; border-radius:8px 0 0 8px; position:absolute; left:0; top:0;"></div>
					<div class="stacked-bar" id="bar2_<?php echo $i; ?>" style="background:#81AFFF; width:<?php echo 100-$p['progress']; ?>%; height:100%; border-radius:0 8px 8px 0; position:absolute; left:<?php echo $p['progress']; ?>%; top:0;"></div>
					<div id="barHandle_<?php echo $i; ?>" style="position:absolute; left:calc(<?php echo $p['progress']; ?>% - 14px); top:2px; width:28px; height:28px; border-radius:50%; background:#fff; border:4px solid #4b3aff; box-shadow:0 2px 8px rgba(0,0,0,0.10); cursor:grab;"></div>
				</div>
			</div>
			<script>
			// Bola draggable untuk progress
			(function() {
				const bar1 = document.getElementById('bar1_<?php echo $idx; ?>');
				const bar2 = document.getElementById('bar2_<?php echo $idx; ?>');
				const barLabel = document.getElementById('barLabel_<?php echo $idx; ?>');
				const container = document.getElementById('stackedBarContainer<?php echo $idx; ?>');
				const handle = document.getElementById('barHandle_<?php echo $idx; ?>');
				let dragging = false;
				handle.addEventListener('mousedown', function(e) {
					dragging = true;
					document.body.style.userSelect = 'none';
				});
				document.addEventListener('mousemove', function(e) {
					if (dragging) {
						let mouseX = e.clientX - container.getBoundingClientRect().left;
						let percent = Math.max(0, Math.min(100, Math.round((mouseX/container.offsetWidth)*100)));
						bar1.style.width = percent + '%';
						bar2.style.width = (100-percent) + '%';
						bar2.style.left = percent + '%';
						handle.style.left = 'calc(' + percent + '% - 14px)';
						barLabel.textContent = percent + '%';
					}
				});
				document.addEventListener('mouseup', function(e) {
					if (dragging) {
						dragging = false;
						document.body.style.userSelect = '';
					}
				});
			})();
			</script>
			<!-- End stacked draggable bar chart dengan bola -->
			<div class="progres-info-row">
				<span class="progres-info-label">Pembimbing :<br><?php echo $p['pembimbing']; ?></span>
				<span class="progres-info-label">Durasi : <?php echo $p['durasi']; ?></span>
				<span class="progres-info-label">Status : Berlangsung</span>
			</div>
			<div class="progres-ket">
				<span class="progres-info-label">Keterangan :</span><br>
				<?php echo htmlspecialchars($p['keterangan']); ?>
			</div>
			<span class="progres-edit">Edit</span>
		</div>
		<?php endforeach; ?>
	</div>
</body>
</html>
