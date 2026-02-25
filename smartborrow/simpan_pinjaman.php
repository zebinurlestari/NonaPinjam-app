<?php
include 'koneksi.php';

// Ambil data yang dikirim Android
$nama    = isset($_POST['nama_peminjam']) ? $_POST['nama_peminjam'] : '';
$barang  = isset($_POST['nama_barang']) ? $_POST['nama_barang'] : '';
$tanggal = isset($_POST['tgl_pinjam']) ? $_POST['tgl_pinjam'] : '';

if ($nama != "" && $barang != "") {
    // Sesuaikan kolom dengan image_45e9d4: nama_peminjam, nama_barang, tanggal_pinjam
    $sql = "INSERT INTO peminjamans (nama_peminjam, nama_barang, tanggal_pinjam, created_at, updated_at) 
            VALUES ('$nama', '$barang', '$tanggal', NOW(), NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "data_kosong";
}

mysqli_close($conn);
?>