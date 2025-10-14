<?php
session_start();
$nama = 'Pak, Zulkarnain';
$email = 'afiifadwi@gmail.com';
$password = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nama = $_POST['nama'] ?? $nama;
	$email = $_POST['email'] ?? $email;
	$password = $_POST['password'] ?? '';
	$_SESSION['admin_profile'] = [
		'nama' => $nama,
		'email' => $email,
		'password' => $password
	];
}
if (isset($_SESSION['admin_profile'])) {
	$nama = $_SESSION['admin_profile']['nama'];
	$email = $_SESSION['admin_profile']['email'];
	$password = $_SESSION['admin_profile']['password'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profil Admin</title>

	<link rel="stylesheet" href="style_profile_admin.css">

	<body>
		<div class="sidebar">
			<div class="avatar">
				<span style="font-size:70px; color:#4b2e83;">
					&#128100;
				</span>
			</div>
			<div class="admin-name">
				Hallo Admin<br><?php echo htmlspecialchars($nama); ?>
			</div>
			<div class="menu">
				<a href="#" class="menu-item">
					<span style="font-size:24px; color:#6c4bb6;">&#128100;</span>
					Set Profile
				</a>
				<a href="admin_dashboard.php" class="menu-item">
					<span style="font-size:22px; color:#6c4bb6;">&#8592;</span>
					Kembali
				</a>
				<a href="logout.php" class="menu-item">
					<span style="font-size:22px; color:#6c4bb6;">&#128465;</span>
					Log Out
				</a>
			</div>
		</div>
		<div class="main-content">
			<div class="profile-card">
				<h2>Profil Saya</h2>
				<form method="post">
					<label for="nama">Nama Lengkap</label>
					<input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
					<label for="email">Email</label>
					<input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
					<label for="password">Password</label>
					<input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
					<button type="submit">Edit Profile</button>
				</form>
			</div>
		</div>
	</body>
</html>
