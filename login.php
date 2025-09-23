<?php
session_start();
require 'config/koneksi.php'; // koneksi PDO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = trim($_POST['username_email'] ?? ''); // bisa email atau nama
    $katasandi = $_POST['katasandi'] ?? '';

    if ($identifier === '' || $katasandi === '') {
        $error = "Mohon isi semua field!";
    } else {
        // Ambil user berdasarkan email atau nama
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username_email = ? OR nama = ?");
        $stmt->execute([$identifier, $identifier]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($katasandi, $user['katasandi'])) {
            $_SESSION['user'] = [
                'id_user' => $user['id_user'],
                'nama' => $user['nama'], 
                'username_email' => $user['username_email'],
                'role' => $user['role'],
                'logged_in' => true
            ];

            // Redirect sesuai role
            if ($user['role'] == 'admin') {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: index.php');
            }
            exit;
        } else {
            $error = "Email/Nama atau password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SIMAGANG</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card shadow p-4" style="width: 400px;">
      <h3 class="text-center mb-3 text-primary">Login SIMAGANG</h3>

      <?php if (isset($error)): ?>
        <div class="alert alert-danger">
          <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">Email / Username</label>
          <input type="text" class="form-control" id="username_email" name="username_email" required value="<?php echo htmlspecialchars($_POST['username_email'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" class="form-control" id="katasandi" name="katasandi" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Masuk</button>
      </form>

      <div class="mt-3 text-center">
        <small>Belum punya akun? <a href="register.php">Daftar disini</a></small>
      </div>

      <!-- Demo info -->
      <div class="mt-3">
        <small class="text-muted">
          <strong>Demo Login:</strong><br>
          Admin → admin@bps.go.id / admin123 <br>
          Peserta → peserta@example.com / peserta123
        </small>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
