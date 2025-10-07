<?php
// session_start(); // wajib
if (!empty($_SESSION['username_email'])) {
    header('Location: dashboard_umum'); // arahkan ke halaman home
    exit; // hentikan eksekusi script
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

      <form action="proses/proses_login.php" method="POST">
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
        <small>Belum punya akun? <a href="register">Daftar disini</a></small>
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
