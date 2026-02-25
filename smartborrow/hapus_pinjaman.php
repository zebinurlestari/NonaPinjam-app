<?php
include 'koneksi.php';

// Kita gunakan ID sebagai kunci untuk menghapus
$id = isset($_POST['id']) ? $_POST['id'] : '';

if ($id != "") {
    $sql = "DELETE FROM peminjamans WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error: " . mysqli_error($conn);
    }
} else {
    echo "id_kosong";
}

mysqli_close($conn);
?>