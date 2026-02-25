<?php
header('Content-Type: application/json');
include '../config.php';

// Sesuaikan nama tabel menjadi 'peminjamans' sesuai isi database kamu
$query = mysqli_query($koneksi, "SELECT * FROM peminjamans ORDER BY id DESC");

$result = array();
if ($query) {
    while($row = mysqli_fetch_assoc($query)){
        $result[] = $row;
    }
    echo json_encode(array('status' => 'success', 'data' => $result));
} else {
    echo json_encode(array('status' => 'error', 'message' => mysqli_error($koneksi)));
}
?>