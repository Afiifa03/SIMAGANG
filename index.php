<?php
session_start();

// Ambil parameter page, default ke 'dashboard_umum'
$page = $_GET['page'] ?? 'dashboard_umum';

// Jika belum login → tampilkan dashboard umum, login, atau register
if (!isset($_SESSION['user']) || !$_SESSION['user']['logged_in']) {
    $allowed = ['login', 'register', 'dashboard_umum'];

    // Kalau tidak ada page (akses root), tampilkan dashboard_umum
    if ($page === '' || !in_array($page, $allowed)) {
        $page = 'dashboard_umum';
    }

    include "{$page}.php";
    exit;
}

$role = $_SESSION['user']['role'] ?? null;

// ===== ROUTING UNTUK ADMIN =====
if ($role === 'admin') {
    $file = "{$page}.php";
    if (file_exists($file)) {
        include "admin_navbar.php";
        include $file;
    } else {
        include "admin_navbar.php";
        echo "<h3 style='padding:20px;'>Halaman tidak ditemukan!</h3>";
    }
    exit;
}

// ===== ROUTING UNTUK PESERTA =====
elseif ($role === 'user') {
    $file = "{$page}.php";
    if (file_exists($file)) {
        include "peserta_navbar.php";
        include $file;
    } else {
        echo "<h3 style='padding:20px;'>Halaman tidak ditemukan!</h3>";
    }
    exit;
}

// ===== ROLE TIDAK DIKENAL =====
else {
    header("Location: dashboard_umum");
    exit;
}
