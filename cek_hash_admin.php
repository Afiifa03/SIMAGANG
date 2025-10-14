<?php
// Cek kecocokan hash password admin
$password = 'Admin123';
$hash = '$2y$10$yuvSv45ssb0pyZNoNp80Re7d0bPLTJwtLwwhU2Lb5xK9q4T9cCmqS';
if (password_verify($password, $hash)) {
    echo 'Cocok: password Admin123 valid untuk hash ini.';
} else {
    echo 'Tidak cocok: password Admin123 TIDAK valid untuk hash ini.';
}
?>
