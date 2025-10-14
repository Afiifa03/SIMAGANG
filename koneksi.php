<?php
$host     = "localhost";     // Nama host database (biasanya localhost)
$username = "root";          // Username database (default: root di XAMPP)
$password = " ";              // Password database (kosong di XAMPP)
$database = "db_simagang";     // Ganti dengan nama database kamu

// Membuat koneksi

$conn = new mysqli($host, $username, $password, $database);
$conn->set_charset('utf8mb4'); // Set charset untuk keamanan

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
