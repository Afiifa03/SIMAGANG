<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_input = trim($_POST['email'] ?? ''); // bisa username atau email
    $password = $_POST['password'] ?? '';

    if (!empty($login_input) && !empty($password)) {
        $password_md5 = md5($password);

        // --- Cek admin
        $stmt = $conn->prepare("
            SELECT id_admin, username, password 
            FROM admin 
            WHERE username = ? AND password = ?
        ");
        $stmt->bind_param('ss', $login_input, $password_md5);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id_admin, $username_admin, $hash_admin);
            $stmt->fetch();

            $_SESSION['admin_id'] = $id_admin;
            $_SESSION['role'] = 'admin';
            header('Location: admin_dashboard.php');
            exit;
        }
        $stmt->close();

        // --- Cek user
        $stmt = $conn->prepare("
            SELECT id_user, username, password 
            FROM user 
            WHERE username = ? AND password = ?
        ");
        $stmt->bind_param('ss', $login_input, $password_md5);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id_user, $username_user, $hash_user);
            $stmt->fetch();

            $_SESSION['peserta_id'] = $id_user;
            $_SESSION['role'] = 'user';
            $_SESSION['user'] = [
                'id_user' => $id_user,
                'username' => $username_user,
                'type' => 'peserta'
            ];
            header('Location: peserta_dashboard.php');
            exit;
        }
        $stmt->close();

        $error = "Username atau password salah!";
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

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style_login.css">

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
<body class="bg-light">

  <div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card shadow p-4" style="width: 400px;">
      <h3 class="text-center mb-3 text-primary">Login SIMAGANG</h3>

      <?php if (isset($error)): ?>
        <div class="alert alert-danger">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="mb-3">
          <label for="email" class="form-label">Email / Username</label>
          <input type="text" class="form-control" id="email" name="email"
                 value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>

       <div class="mb-3 password-toggle">
         <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" class="form-control" id="password" name="password" required>
          <i class="bi bi-eye-slash" id="togglePassword"></i>
      </div>


        <button type="submit" class="btn btn-primary w-100">Masuk</button>
      </form>

      <div class="mt-3 text-center">
        <small>Belum punya akun? <a href="register.php">Daftar disini</a></small>
      </div>
    </div>
  </div>

  <script>
    // Fitur toggle eye password
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      this.classList.toggle("bi-eye");
      this.classList.toggle("bi-eye-slash");
    });
  </script>

</body>
</html>
