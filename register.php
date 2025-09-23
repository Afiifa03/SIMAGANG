<?php
// register.php
session_start();

require_once 'config/koneksi.php'; // Gunakan koneksi yang sudah ada

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nama = trim($_POST['nama'] ?? '');
  $username_email = trim($_POST['username_email'] ?? '');
  $katasandi = $_POST['katasandi'] ?? '';
  $konfirmasi_katasandi = $_POST['konfirmasi_katasandi'] ?? '';
  $role = 'user';

  if ($nama === '' || $username_email === '' || $katasandi === '' || $konfirmasi_katasandi === '') {
    $errors['general'] = "Semua field wajib diisi.";
  } elseif ($katasandi !== $konfirmasi_katasandi) {
    $errors['konfirmasi_katasandi'] = "Konfirmasi password tidak cocok.";
  } elseif (strlen($katasandi) < 8) {
    $errors['katasandi'] = "Password minimal 8 karakter.";
  }

  // Cek username_email unik
  if (empty($errors)) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username_email = ?");
    $stmt->execute([$username_email]);
    if ($stmt->fetchColumn() > 0) {
      $errors['general'] = "Username/email sudah terdaftar.";
    }
  }

  if (empty($errors)) {
    $hashedkatasandi = password_hash($katasandi, PASSWORD_DEFAULT);

    try {
      $role = 'user';
      $stmt = $pdo->prepare("INSERT INTO users (nama, username_email, katasandi, role) VALUES (?, ?, ?, ?)");
      $stmt->execute([$nama, $username_email, $hashedkatasandi, $role]);
      header("Location: login.php?success=1");
      exit;
    } catch (PDOException $e) {
      $errors['general'] = "Terjadi kesalahan: " . $e->getMessage();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar - SIMAGANG BPS Lhokseumawe</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    .password-wrapper {
  position: relative;
}

.password-toggle {
  cursor: pointer;
  background: transparent;
  color: #333;
}

.strength-meter { font-size: 0.9rem; font-weight: 600; margin-top: 5px; }
.strength-bar { height: 5px; border-radius: 3px; transition: width 0.3s, background-color 0.3s; width: 0; }
.strength-weak { width: 33%; background-color: red; }
.strength-medium { width: 66%; background-color: orange; }
.strength-strong { width: 100%; background-color: green; }

  </style>
</head>

<body class="bg-white d-flex justify-content-center align-items-center vh-100">

  <div class="card shadow-lg p-4" style="max-width: 520px; width: 100%;">
    <!-- Tombol kembali -->
    <a href="login.php" class="text-decoration-none mb-3 d-block">
      <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <h3 class="text-center mb-3">Daftar Akun</h3>

    <!-- Pesan error umum -->
    <?php if (!empty($errors['general'])): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($errors['general']) ?></div>
    <?php endif; ?>

    <form method="POST" novalidate>
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text"
          class="form-control <?= !empty($errors['general']) && empty($_POST['nama']) ? 'is-invalid' : '' ?>" id="nama"
          name="nama" placeholder="Nama Lengkap" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email/Username</label>
        <input type="text"
          class="form-control <?= !empty($errors['general']) && empty($_POST['username_email']) ? 'is-invalid' : '' ?>"
          id="email" name="username_email" placeholder="Masukkan Email atau Username"
          value="<?= htmlspecialchars($_POST['username_email'] ?? '') ?>" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <div class="password-wrapper position-relative">
          <input type="password" class="form-control <?= !empty($errors['katasandi']) ? 'is-invalid' : '' ?>"
            id="password" name="katasandi" placeholder="Masukkan Katasandi" required>
          <!-- Tombol show/hide di dalam wrapper -->
          <button type="button" class="btn btn-sm btn-outline-secondary password-toggle"
            style="position:absolute; right:0.5rem; top:50%; transform:translateY(-50%); border:none; padding:0 0.5rem;">
            <i class="bi bi-eye"></i>
          </button>
        </div>
        <div id="passwordHelp" class="form-text">Password minimal 8 karakter, kombinasi huruf besar, kecil, angka &
          simbol.</div>
        <div class="progress mt-1">
          <div id="passwordStrengthBar" class="progress-bar"></div>
        </div>
        <div id="passwordStrengthText" class="strength-meter"></div>
        <?php if (!empty($errors['katasandi'])): ?>
          <div class="invalid-feedback"><?= htmlspecialchars($errors['katasandi']) ?></div>
        <?php endif; ?>
      </div>


      <div class="mb-3">
        <label for="confirm_password" class="form-label">Konfirmasi Kata Sandi</label>
        <div class="password-wrapper position-relative">
          <input type="password" class="form-control <?= !empty($errors['konfirmasi_katasandi']) ? 'is-invalid' : '' ?>"
            id="confirm_password" name="konfirmasi_katasandi" placeholder="Konfirmasi Katasandi" required>
          <!-- Tombol show/hide di dalam wrapper -->
          <button type="button" class="btn btn-sm btn-outline-secondary password-toggle"
            style="position:absolute; right:0.5rem; top:50%; transform:translateY(-50%); border:none; padding:0 0.5rem;">
            <i class="bi bi-eye"></i>
          </button>
        </div>
        <?php if (!empty($errors['confirm_password'])): ?>
          <div class="invalid-feedback"><?= htmlspecialchars($errors['confirm_password']) ?></div>
        <?php endif; ?>
      </div>


      <button type="submit" class="btn btn-dark w-100">Daftar</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script toggle mata + strength meter -->
  <script>
    // Toggle show/hide password
    document.querySelectorAll('.password-toggle').forEach(btn => {
  btn.addEventListener('click', () => {
    const input = btn.parentElement.querySelector('input');
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
  });
});

// Password strength
const passwordInput = document.getElementById('password');
const strengthBar = document.getElementById('passwordStrengthBar');
const strengthText = document.getElementById('passwordStrengthText');

passwordInput.addEventListener('input', () => {
  const val = passwordInput.value;
  let strength = 0;
  if (val.length >= 8) strength++;
  if (/[A-Z]/.test(val)) strength++;
  if (/[a-z]/.test(val)) strength++;
  if (/[0-9]/.test(val)) strength++;
  if (/[^A-Za-z0-9]/.test(val)) strength++;

  strengthBar.className = 'progress-bar';
  if (strength <= 2) { strengthBar.classList.add('strength-weak'); strengthText.textContent = 'Lemah'; }
  else if (strength <= 4) { strengthBar.classList.add('strength-medium'); strengthText.textContent = 'Sedang'; }
  else { strengthBar.classList.add('strength-strong'); strengthText.textContent = 'Kuat'; }
});

  </script>
</body>

</html>