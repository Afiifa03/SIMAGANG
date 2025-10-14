<?php
// register.php
session_start();

// Tampilkan semua error biar gak blank
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // --- Bersihkan input dari spasi berlebih
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    $errors = [];

    // Validasi field kosong
    if (empty($nama) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors['general'] = "Semua field wajib diisi!";
    }

    // Validasi kekuatan password
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

    if (empty($errors)) {
        require_once 'koneksi.php';

        if (!$conn) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        // Cek apakah email sudah terdaftar
        $stmt = $conn->prepare("SELECT id_user FROM user WHERE username = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors['general'] = "Email/Username sudah terdaftar!";
        } else {
            // --- Enkripsi password dengan MD5 (harus sama dengan login.php)
            $hash = md5($password);

            // --- Simpan ke database
            $stmt = $conn->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
            if (!$stmt) {
                die("Query error: " . $conn->error);
            }
            $stmt->bind_param("ss", $email, $hash);
            $stmt->execute();
            $stmt->close();

            // --- Redirect ke login setelah berhasil
            header("Location: login.php?registered=success");
            exit;
        }
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style_register.css">
  
  <style>
    .password-toggle {
        position: relative;
    }
    .password-toggle i {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: gray;
    }
  </style>
</head>
<body class="bg-white d-flex justify-content-center align-items-center vh-100">

  <div class="card shadow-lg p-4" style="max-width: 520px; width: 100%;">
    <a href="login.php" class="text-decoration-none mb-3 d-block">
      <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <h3 class="text-center mb-3">Daftar Akun</h3>

    <?php if (!empty($errors['general'])): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($errors['general']) ?></div>
    <?php endif; ?>

    <form method="POST" novalidate>
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" name="nama"
               placeholder="Nama Lengkap"
               value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email / Username</label>
        <input type="text" class="form-control" id="email" name="email"
               placeholder="Username / Email"
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
      </div>

      <div class="mb-3 password-toggle">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <i class="bi bi-eye-slash" id="togglePassword"></i>
      </div>

      <div class="mb-3 password-toggle">
        <label for="confirm_password" class="form-label">Konfirmasi Kata Sandi</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        <i class="bi bi-eye-slash" id="toggleConfirm"></i>
      </div>

      <?php if (!empty($errors['password'])): ?>
        <div class="alert alert-warning"><?= htmlspecialchars($errors['password']) ?></div>
      <?php endif; ?>

      <?php if (!empty($errors['confirm_password'])): ?>
        <div class="alert alert-warning"><?= htmlspecialchars($errors['confirm_password']) ?></div>
      <?php endif; ?>

      <button type="submit" class="btn btn-dark w-100">Daftar</button>
    </form>
  </div>

  <script>
    // Toggle eye password
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");
    togglePassword.addEventListener("click", function () {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        this.classList.toggle("bi-eye");
        this.classList.toggle("bi-eye-slash");
    });

    const toggleConfirm = document.querySelector("#toggleConfirm");
    const confirm = document.querySelector("#confirm_password");
    toggleConfirm.addEventListener("click", function () {
        const type = confirm.getAttribute("type") === "password" ? "text" : "password";
        confirm.setAttribute("type", type);
        this.classList.toggle("bi-eye");
        this.classList.toggle("bi-eye-slash");
    });
  </script>

</body>
</html>
