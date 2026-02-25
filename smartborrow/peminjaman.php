<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $barang = $_POST['barang'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    $query = mysqli_query($koneksi, "INSERT INTO peminjaman 
        (nama_peminjam, nim, barang, tanggal_pinjam, tanggal_kembali) 
        VALUES ('$nama', '$nim', '$barang', '$tgl_pinjam', '$tgl_kembali')
    ");

    if ($query) {
        echo "<script>alert('Peminjaman berhasil disimpan!'); window.location='daftar_peminjaman.php';</script>";
    } else {
        echo "Gagal menyimpan!";
    }
}
?>

<h2>Form Peminjaman Barang</h2>

<form method="POST">
    <label>Nama Peminjam</label><br>
    <input type="text" name="nama" required><br><br>

    <label>NIM</label><br>
    <input type="text" name="nim" required><br><br>

    <label>Barang</label><br>
    <input type="text" name="barang" required><br><br>

    <label>Tanggal Pinjam</label><br>
    <input type="date" name="tgl_pinjam" required><br><br>

    <label>Tanggal Kembali</label><br>
    <input type="date" name="tgl_kembali" required><br><br>

    <button type="submit" name="submit">Simpan</button>
</form>
