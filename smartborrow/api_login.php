<?php
include 'config.php'; 

$username = $_POST['username'];
$password = $_POST['password'];

// Kita cari berdasarkan email agar cocok dengan input di Android
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$username'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    // Mencocokkan password asli dengan Bcrypt di database
    if (password_verify($password, $data['password'])) {
        echo "success";
    } else {
        echo "failed";
    }
} else {
    echo "failed";
}
?>