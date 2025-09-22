<?php
// register.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $errors = [];

    // Validasi field kosong
    if (empty($nama) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors['general'] = "Semua field wajib diisi!";
    }

    // Validasi password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $symbol    = preg_match('@[^\w]@', $password);

    if (strlen($password) < 8 || !$uppercase || !$lowercase || !$number || !$symbol) {
        $errors['password'] = "Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol.";
    }

    // Validasi konfirmasi password
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Konfirmasi kata sandi tidak sesuai!";
    }

    // Kalau tidak ada error → simpan dan redirect
    if (empty($errors)) {
        $_SESSION['registered_user'] = [
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        header("Location: login.php?registered=success");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar - SIMAGANG BPS Lhokseumawe</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    .password-field { position: relative; }
    .password-toggle-btn {
      position: absolute;
      right: 0.5rem;
      top: 50%;
      transform: translateY(-50%);
      border: none;
      background: transparent;
      color: #333;
      cursor: pointer;
    }
    .strength-meter {
      font-size: 0.9rem;
      margin-top: 0.25rem;
      font-weight: 600;
    }
    .weak { color: red; }
    .medium { color: orange; }
    .strong { color: green; }
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
              class="form-control <?= !empty($errors['general']) && empty($_POST['nama']) ? 'is-invalid' : '' ?>"
              id="nama" name="nama" placeholder="Nama Lengkap"
              value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email/Username</label>
        <input type="text"
              class="form-control <?= !empty($errors['general']) && empty($_POST['email']) ? 'is-invalid' : '' ?>"
              id="email" name="email" placeholder="Username / Email"
              value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
      </div>

      <div class="mb-3 password-field">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password"
               class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?>"
               id="password" name="password" placeholder="••••••••••" required aria-describedby="passwordHelp">
        <button type="button" class="password-toggle-btn" aria-label="Tampilkan/Sembunyikan password" data-target="password">
          <i class="bi bi-eye" id="icon-password"></i>
        </button>
        <div id="passwordHelp" class="form-text">Password minimal 8 karakter, kombinasi huruf besar, kecil, angka & simbol.</div>
        <div id="passwordStrength" class="strength-meter"></div>
        <?php if (!empty($errors['password'])): ?>
          <div class="invalid-feedback"><?= htmlspecialchars($errors['password']) ?></div>
        <?php endif; ?>
      </div>

      <div class="mb-3 password-field">
        <label for="confirm_password" class="form-label">Konfirmasi Kata Sandi</label>
        <input type="password"
              class="form-control <?= !empty($errors['confirm_password']) ? 'is-invalid' : '' ?>"
              id="confirm_password" name="confirm_password" placeholder="••••••••••" required>
        <button type="button" class="password-toggle-btn" aria-label="Tampilkan/Sembunyikan konfirmasi password" data-target="confirm_password">
          <i class="bi bi-eye" id="icon-confirm"></i>
        </button>
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
    document.querySelectorAll('.password-toggle-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const targetId = btn.getAttribute('data-target');
        const input = document.getElementById(targetId);
        if (!input) return;

        if (input.type === 'password') {
          input.type = 'text';
          btn.querySelector('i').classList.replace('bi-eye', 'bi-eye-slash');
        } else {
          input.type = 'password';
          btn.querySelector('i').classList.replace('bi-eye-slash', 'bi-eye');
        }
      });
    });

    // Password strength meter
    const passwordInput = document.getElementById('password');
    const strengthText = document.getElementById('passwordStrength');

    passwordInput.addEventListener('input', () => {
      const val = passwordInput.value;
      let strength = 0;

      if (val.length >= 8) strength++;
      if (/[A-Z]/.test(val)) strength++;
      if (/[a-z]/.test(val)) strength++;
      if (/[0-9]/.test(val)) strength++;
      if (/[^A-Za-z0-9]/.test(val)) strength++;

      if (val.length === 0) {
        strengthText.textContent = "";
      } else if (strength <= 2) {
        strengthText.textContent = "Lemah";
        strengthText.className = "strength-meter weak";
      } else if (strength === 3 || strength === 4) {
        strengthText.textContent = "Sedang";
        strengthText.className = "strength-meter medium";
      } else {
        strengthText.textContent = "Kuat";
        strengthText.className = "strength-meter strong";
      }
    });
  </script>
</body>
</html>
