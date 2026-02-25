<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$query = mysqli_query($koneksi, "SELECT * FROM peminjaman");
?>

<h2>Daftar Peminjaman Barang</h2>

<a href="peminjaman.php">Tambah Peminjaman Baru</a>
<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Barang</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama_peminjam'] ?></td>
        <td><?= $row['nim'] ?></td>
        <td><?= $row['barang'] ?></td>
        <td><?= $row['tanggal_pinjam'] ?></td>
        <td><?= $row['tanggal_kembali'] ?></td>
        <td><?= $row['status'] ?></td>
    </tr>
    <?php } ?>
</table>
