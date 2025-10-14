<?php
session_start();
require_once 'koneksi.php';

// Login Admin
if (isset($_POST['login_admin'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT id_admin, password FROM admin WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            $_SESSION['id_admin'] = $id;
            header('Location: admin_dashboard.php');
            exit;
        } else {
            die('Password salah');
        }
    } else {
        die('Username tidak ditemukan');
    }
    $stmt->close();
}
?>
