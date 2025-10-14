<?php
session_start();
require_once 'koneksi.php';

// Register Peserta
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Validasi
    if ($password !== $password2) {
        die('Password tidak sama');
    }
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        die('Email tidak valid');
    }

    // Cek username/email sudah terdaftar
    $stmt = $conn->prepare('SELECT id_user FROM user WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die('Email sudah terdaftar');
    }
    $stmt->close();

    // Hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Simpan user peserta
    $stmt = $conn->prepare('INSERT INTO user (username, password) VALUES (?, ?)');
    $stmt->bind_param('ss', $username, $hash);
    if ($stmt->execute()) {
        $_SESSION['peserta_id'] = $stmt->insert_id;
        header('Location: peserta_dashboard.php');
        exit;
    } else {
        die('Gagal register');
    }
}

// Login Peserta
if (isset($_POST['login_peserta'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT id_user, password FROM user WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            $_SESSION['peserta_id'] = $id;
            header('Location: peserta_dashboard.php');
            exit;
        } else {
            die('Password salah');
        }
    } else {
        die('Email tidak ditemukan');
    }
    $stmt->close();
}
?>
