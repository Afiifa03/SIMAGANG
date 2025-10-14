<?php
header('Content-Type: application/json');
require_once 'koneksi.php';

// Helper: kirim response JSON
function send_response($status, $message, $data = null) {
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

// Ambil method dan endpoint
$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['endpoint'] ?? '';

// Register Peserta
if ($method === 'POST' && $endpoint === 'register_peserta') {
    $input = json_decode(file_get_contents('php://input'), true);
    $nama = trim($input['nama'] ?? '');
    $nim_nis = trim($input['nim_nis'] ?? '');
    $email = trim($input['email'] ?? '');
    $password = $input['password'] ?? '';
    $password2 = $input['password2'] ?? '';

    if ($password !== $password2) send_response('error', 'Password tidak sama');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) send_response('error', 'Email tidak valid');

    $stmt = $conn->prepare('SELECT id_peserta FROM peserta WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) send_response('error', 'Email sudah terdaftar');
    $stmt->close();

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare('INSERT INTO peserta (nama, nim_nis, email, password) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $nama, $nim_nis, $email, $hash);
    if ($stmt->execute()) {
        send_response('success', 'Register berhasil', ['id_peserta' => $stmt->insert_id]);
    } else {
        send_response('error', 'Gagal register');
    }
}

// Login Peserta
if ($method === 'POST' && $endpoint === 'login_peserta') {
    $input = json_decode(file_get_contents('php://input'), true);
    $email = trim($input['email'] ?? '');
    $password = $input['password'] ?? '';

    $stmt = $conn->prepare('SELECT id_peserta, password FROM peserta WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            send_response('success', 'Login berhasil', ['id_peserta' => $id]);
        } else {
            send_response('error', 'Password salah');
        }
    } else {
        send_response('error', 'Email tidak ditemukan');
    }
    $stmt->close();
}

// Login Admin
if ($method === 'POST' && $endpoint === 'login_admin') {
    $input = json_decode(file_get_contents('php://input'), true);
    $username = trim($input['username'] ?? '');
    $password = $input['password'] ?? '';

    $stmt = $conn->prepare('SELECT id_admin, password FROM admin WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            send_response('success', 'Login berhasil', ['id_admin' => $id]);
        } else {
            send_response('error', 'Password salah');
        }
    } else {
        send_response('error', 'Username tidak ditemukan');
    }
    $stmt->close();
}

// Pendaftaran Magang
if ($method === 'POST' && $endpoint === 'pendaftaran') {
    $input = json_decode(file_get_contents('php://input'), true);
    $id_peserta = intval($input['id_peserta'] ?? 0);
    $tanggal_daftar = $input['tanggal_daftar'] ?? date('Y-m-d');
    $proposal_magang = $input['proposal_magang'] ?? '';
    $cv = $input['cv'] ?? '';
    $transkip_nilai = $input['transkip_nilai'] ?? '';
    $tanggal_mulai = $input['tanggal_mulai'] ?? null;
    $tanggal_selesai = $input['tanggal_selesai'] ?? null;
    $status = $input['status'] ?? 'verifikasi berkas';
    $keterangan = $input['keterangan'] ?? '';

    // Validasi id_peserta
    $cek = $conn->prepare('SELECT id_peserta FROM peserta WHERE id_peserta = ?');
    $cek->bind_param('i', $id_peserta);
    $cek->execute();
    $cek->store_result();
    if ($cek->num_rows === 0) send_response('error', 'Peserta tidak ditemukan');
    $cek->close();

    $stmt = $conn->prepare('INSERT INTO pendaftaran (id_peserta, tanggal_daftar, proposal_magang, cv, transkip_nilai, tanggal_mulai, tanggal_selesai, status, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('issssssss', $id_peserta, $tanggal_daftar, $proposal_magang, $cv, $transkip_nilai, $tanggal_mulai, $tanggal_selesai, $status, $keterangan);
    if ($stmt->execute()) {
        send_response('success', 'Pendaftaran berhasil', ['id_pendaftaran' => $stmt->insert_id]);
    } else {
        send_response('error', 'Gagal mendaftar');
    }
}
?>
