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
	<style>
		body {
			font-family: Arial, sans-serif;
			background: #ffffffff;
			margin: 0;
			padding: 0;
		}
		   nav {
			   background-color: #2c3e50;
			   padding: 48px 48px 36px 48px;
			   display: flex;
			   justify-content: space-between;
			   align-items: center;
			   color: white;
			   font-size: 32px;
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
		   .title {
			   font-size: 54px;
			   font-weight: bold;
			   color: #111;
			   margin-bottom: 8px;
		   }
		   .subtitle {
			   font-size: 32px;
			   color: #222;
			   margin-bottom: 32px;
		   }
		.progres-card {
			background: #fff;
			border-radius: 18px;
			box-shadow: 0 4px 12px rgba(0,0,0,0.08);
			border: 1px solid #e0e0e0;
			max-width: 1400px;
			margin: 0 auto 40px auto;
			padding: 48px 80px 36px 80px;
			position: relative;
		}
		.progres-header {
			font-size: 20px;
			font-weight: bold;
			margin-bottom: 2px;
		}
		.progres-periode {
			font-size: 16px;
			margin-bottom: 18px;
		}
		.progres-status {
			position: absolute;
			top: 24px;
			right: 32px;
			padding: 6px 18px;
			border-radius: 8px;
			font-size: 15px;
			font-weight: bold;
			min-width: 120px;
			text-align: center;
		}
		   .menunggu-verifikasi {
			   background: linear-gradient(135deg, #D0D0D0, #BFBFBF);
			   color: #000000;
		   }
		   .verifikasi-berkas {
			   background: linear-gradient(135deg, #FBE4A1, #FFD873);
			   color: #F86C00;
		   }
		   .wawancara {
			   background: linear-gradient(135deg, #B3CFFF, #81AFFF);
			   color: #4721CF;
		   }
		   .diterima {
			   background: linear-gradient(135deg, #B4F4AC, #8BE77D);
			   color: #107705;
		   }
		   .ditolak {
			   background: linear-gradient(135deg, #FCB3B3, #F78C8C);
			   color: #F60000;
		   }
		   .sedang-magang {
			   background: linear-gradient(135deg, #DCC6ED, #C39EE3);
			   color: #8C00E4;
		   }
		   .selesai-magang {
			   background: linear-gradient(135deg, #B9E7A3, #90D675);
			   color: #107705;
		   }
		.progres-bar-container {
			width: 100%;
			background: #000;
			border-radius: 8px;
			height: 12px;
			margin: 18px 0 8px 0;
			position: relative;
		}
		.progres-bar {
			position: absolute;
			left: 0;
			top: 0;
			height: 12px;
			border-radius: 8px;
			background: linear-gradient(90deg, #4b3aff 0%, #7b6cff 100%);
		}
		.progres-bar.selesai {
			background: linear-gradient(90deg, #6e5cff 0%, #a6a1ff 100%);
		}
		.progres-bar-dot {
			position: absolute;
			top: -4px;
			width: 20px;
			height: 20px;
			border-radius: 50%;
			background: #4b3aff;
			border: 3px solid #fff;
			box-shadow: 0 2px 8px rgba(0,0,0,0.10);
		}
		.progres-bar-dot.selesai {
			background: #6e5cff;
		}
		.progres-bar-label {
			position: absolute;
			right: 0;
			top: -28px;
			font-size: 16px;
			font-weight: bold;
			color: #222;
		}
		.progres-info-row {
			display: flex;
			justify-content: space-between;
			margin-top: 18px;
			margin-bottom: 8px;
		}
		.progres-info-label {
			font-weight: bold;
		}
		.progres-ket {
			font-size: 16px;
			margin-bottom: 18px;
		}
		.progres-edit {
			position: absolute;
			right: 40px;
			bottom: 18px;
			font-size: 16px;
			color: #222;
			cursor: pointer;
			font-weight: bold;
		}
		.progres-edit:hover {
			text-decoration: underline;
		}
	</style>
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
		// Dummy data seluruh peserta
		$peserta_list = [
			[
				'nama' => 'Ahmad Wijaya',
				'periode' => '21/8/2025 - 21/12/2025',
				'status' => $status,
				'progress' => ($status == 'Selesai Magang') ? 100 : 60,
				'keterangan' => $keterangan,
				'pembimbing' => 'Zulkarnaini, S.Si., MSi',
				'durasi' => '153 hari',
			],
			[
				'nama' => 'Budi Santoso',
				'periode' => '1/9/2025 - 1/1/2026',
				'status' => 'Menunggu Verifikasi',
				'progress' => 0,
				'keterangan' => 'Baru daftar, menunggu verifikasi berkas',
				'pembimbing' => '-',
				'durasi' => '-',
			],
			[
				'nama' => 'Sari Melati',
				'periode' => '10/7/2025 - 10/11/2025',
				'status' => 'Sedang Magang',
				'progress' => 40,
				'keterangan' => 'Magang Web development, progress awal',
				'pembimbing' => 'Zulkarnaini, S.Si., MSi',
				'durasi' => '120 hari',
			],
		];
		foreach ($peserta_list as $idx => $p):
		?>
		<div class="progres-card">
			<span class="progres-status <?php echo strtolower(str_replace(' ', '-', $p['status'])); ?>"><?php echo htmlspecialchars($p['status']); ?></span>
			<div class="progres-header">Peserta : <?php echo htmlspecialchars($p['nama']); ?></div>
			<div class="progres-periode">Periode : <?php echo $p['periode']; ?></div>
			<div style="font-weight:bold; margin-bottom:2px;">Progres Magang</div>
			<!-- Stacked draggable bar chart dengan bola -->
			<div style="width:100%; margin:18px 0 8px 0;">
				<div id="barLabel_<?php echo $idx; ?>" style="width:100%; text-align:right; font-size:16px; font-weight:bold; color:#222; margin-bottom:2px;">
					<?php echo $p['progress']; ?>%
				</div>
				<div id="stackedBarContainer<?php echo $idx; ?>" style="width:100%; background:#eee; border-radius:8px; height:32px; position:relative;">
					<div class="stacked-bar" id="bar1_<?php echo $idx; ?>" style="background:#4b3aff; width:<?php echo $p['progress']; ?>%; height:100%; border-radius:8px 0 0 8px; position:absolute; left:0; top:0;"></div>
					<div class="stacked-bar" id="bar2_<?php echo $idx; ?>" style="background:#81AFFF; width:<?php echo 100-$p['progress']; ?>%; height:100%; border-radius:0 8px 8px 0; position:absolute; left:<?php echo $p['progress']; ?>%; top:0;"></div>
					<div id="barHandle_<?php echo $idx; ?>" style="position:absolute; left:calc(<?php echo $p['progress']; ?>% - 14px); top:2px; width:28px; height:28px; border-radius:50%; background:#fff; border:4px solid #4b3aff; box-shadow:0 2px 8px rgba(0,0,0,0.10); cursor:grab;"></div>
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
