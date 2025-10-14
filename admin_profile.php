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
	<link rel="stylesheet" href="style_admin_profile.css">
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
