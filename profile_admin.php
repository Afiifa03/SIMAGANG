<?php
// Dummy data, ganti dengan data session/database jika sudah ada
$nama = 'Pak, Zulkarnain';
$email = 'afiifadwi@gmail.com';
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profil Admin</title>
	<style>
		body {
			background: #bfe9ea;
			min-height: 100vh;
			margin: 0;
			font-family: Arial, sans-serif;
		}
		.profile-card {
			background: #5bb6b9;
			border-radius: 20px;
			box-shadow: 2px 4px 8px rgba(0,0,0,0.13);
			width: 500px;
			max-width: 90vw;
			margin: 60px auto;
			padding: 40px 36px 32px 36px;
			display: flex;
			flex-direction: column;
		}
		.profile-card h2 {
			text-align: left;
			margin-bottom: 28px;
			font-size: 26px;
		}
		.profile-card label {
			font-weight: bold;
			margin-bottom: 6px;
			display: block;
		}
		.profile-card input[type="text"],
		.profile-card input[type="email"],
		.profile-card input[type="password"] {
			width: 100%;
			padding: 10px;
			border-radius: 8px;
			border: none;
			margin-bottom: 18px;
			font-size: 16px;
		}
		.profile-card button {
			background: #e0e0e0;
			color: #222;
			border: none;
			border-radius: 10px;
			padding: 10px 28px;
			font-size: 16px;
			font-weight: bold;
			margin: 18px auto 0 auto;
			cursor: pointer;
			box-shadow: 0 2px 6px rgba(0,0,0,0.08);
			display: block;
		}
		.profile-card button:hover {
			background: #d1d8e0;
		}
	</style>
</head>

<body>
	<div style="display: flex; min-height: 100vh;">
		<!-- SIDEBAR -->
		<div class="sidebar-admin">
			<div class="sidebar-content">
				<div class="admin-icon">
					<!-- SVG user icon -->
					<svg width="90" height="90" viewBox="0 0 24 24" fill="none" style="display:block;margin:0 auto 10px auto;">
						<circle cx="12" cy="8" r="5" stroke="#222" stroke-width="2" fill="none"/>
						<path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke="#222" stroke-width="2" fill="none"/>
					</svg>
				</div>
				<div style="text-align:center; color:#fff; font-size:20px; margin-bottom:30px;">
					Hallo Admin<br><?php echo $nama; ?>
				</div>
				<div class="sidebar-menu">
					<a href="admin_profile.php" class="sidebar-link">
						<span style="margin-right:10px;vertical-align:middle;">
							<!-- SVG profile icon -->
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="4" stroke="#222" stroke-width="2" fill="none"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke="#222" stroke-width="2" fill="none"/></svg>
						</span>
						Set Profile
					</a>
					<a href="index.php" class="sidebar-link">
						<span style="margin-right:10px;vertical-align:middle;">
							<!-- SVG logout icon -->
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M16 17l5-5-5-5" stroke="#222" stroke-width="2" fill="none"/><path d="M21 12H9" stroke="#222" stroke-width="2" fill="none"/><path d="M4 4v16" stroke="#222" stroke-width="2" fill="none"/></svg>
						</span>
						Log Out
					</a>
				</div>
			</div>
		</div>
		<!-- MAIN PROFILE CARD -->
		<div style="flex:1;display:flex;align-items:center;justify-content:center;">
			<div class="profile-card">
				<h2>Profil Saya</h2>
				<form method="post" action="">
					<label for="nama">Nama Lengkap</label>
					<input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required>

					<label for="email">Email</label>
					<input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

					<label for="password">Password</label>
					<input type="password" id="password" name="password" value="">

					<button type="submit">Edit Profile</button>
				</form>
			</div>
		</div>
	</div>
	<style>
		.sidebar-admin {
			background: #48a3a6;
			width: 320px;
			min-width: 260px;
			border-radius: 30px 30px 30px 30px;
			box-shadow: 2px 4px 8px rgba(0,0,0,0.13);
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
		.sidebar-content {
			padding: 40px 0 0 0;
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		.sidebar-menu {
			margin-top: 40px;
			width: 100%;
		}
		.sidebar-link {
			display: flex;
			align-items: center;
			font-size: 18px;
			color: #222;
			text-decoration: none;
			margin: 18px 0 0 40px;
			font-weight: 500;
			transition: color 0.2s;
		}
		.sidebar-link:hover {
			color: #0b7c7e;
		}
	</style>
</body>

</html>
