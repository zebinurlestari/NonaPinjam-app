<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Sistem Peminjaman</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="dashboard-body">

<!-- NAVBAR -->
<div class="navbar">
    <h2>Sistem Peminjaman Perpustakaan</h2>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<!-- KONTEN -->
<div class="dashboard-container">
    <h1>Selamat Datang 👋</h1>
    <p>Halo, <b><?php echo $_SESSION['user']['username']; ?></b></p>

    <div class="menu-grid">
       <div class="card">
        <h3>📚 Data Barang</h3>
        <p>Lihat dan kelola barang</p>
        <a href="barang.php" class="btn">Lihat</a>
    </div>

      <div class="card">
        <h3>📝 Peminjaman</h3>
        <p>Ajukan peminjaman</p>
        <a href="peminjaman.php" class="btn">Pinjam</a>
    </div>


      <div class="card">
        <h3>🔁 Pengembalian</h3>
        <p>Pengembalian barang</p>
         <a href="pengembalian.php" class="btn">Kembalikan</a>
        </div>

        <div class="card">
            <h3>👤 Profil</h3>
             <p>Data akun kamu</p>
             <a href="profil.php" class="btn">Lihat</a>
            </div>

    </div>
</div>

</body>
</html>
