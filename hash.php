<?php
$password = 'Elsya123@';
$hash = 'ac51c281a4f4bac43d2a8161c7d82731';

if (password_verify($password, $hash)) {
    echo "Cocok!";
} else {
    echo "Tidak cocok!";
}

