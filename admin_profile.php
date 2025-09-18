<?php
// Dummy data, ganti dengan data session/database jika sudah ada
$nama = 'Afiifa Lhokseum Dwi Putri';
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
</body>
</html>
