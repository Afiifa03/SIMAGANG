<?php
// Script untuk generate hash password admin
$password = 'Admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Password hash untuk Admin123: ".$hash;
?>
