<?php
session_start();

// Handle form submission
if ($_POST) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Demo credentials
    $valid_credentials = [
        'admin@bps.go.id' => ['password' => 'admin123', 'type' => 'admin'],
        'peserta@example.com' => ['password' => 'peserta123', 'type' => 'peserta'],
    ];

    if (!empty($email) && !empty($password)) {
        if (isset($valid_credentials[$email]) && $valid_credentials[$email]['password'] === $password) {
            $_SESSION['user'] = [
                'email' => $email,
                'type' => $valid_credentials[$email]['type'],
                'logged_in' => true
            ];

            // Redirect sesuai role
            if ($_SESSION['user']['type'] === 'admin') {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: peserta_dashboard.php');
            }
            exit;
        } else {
            $error = "Email atau password salah!";
        }
    } else {
        $error = "Mohon isi semua field!";
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
          <input type="text" class="form-control" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" class="form-control" id="password" name="password" required>
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
