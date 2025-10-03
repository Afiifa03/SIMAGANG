<?php
session_start();
// Jika user sudah login → arahkan ke dashboard sesuai role
if (isset($_SESSION['user']) && $_SESSION['user']['logged_in'] === true) {
    if ($_SESSION['user']['role'] === 'admin') {
        header("Location: admin_dashboard.php");
        exit;
    } elseif ($_SESSION['user']['role'] === 'peserta') {
        header("Location: dashboard_umum.php");
        exit;
    }
}

// Jika belum login → tampilkan dashboard umum
header("Location: dashboard_umum.php");
exit;