<?php
include 'config.php';

// Menangkap data dari Android
$name     = $_POST['name'];
$email    = $_POST['email'];
$password = $_POST['password'];

// Enkripsi password agar aman (Bcrypt) sesuai format database kamu
$passwordEnkripsi = password_hash($password, PASSWORD_BCRYPT);

// Masukkan ke tabel users
$query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$passwordEnkripsi')";

if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "failed";
}
?>