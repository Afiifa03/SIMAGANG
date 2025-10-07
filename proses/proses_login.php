<?php
session_start();
require '../config/koneksi.php'; // koneksi PDO

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
            if ($user['role'] === 'admin') {
                header('Location: ../index.php');
            } else {
                header('Location: ../index.php');
            }
            exit;
        } else {
            $error = "Email/Nama atau password salah!";
        }
    }
}
?>