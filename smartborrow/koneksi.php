<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_smartborrow"; // Sesuaikan dengan nama di screenshot

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>