<?php
header('Content-Type: application/json');
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kita gunakan variabel $email karena di database kolomnya bernama 'email'
    $email = $_POST['username'] ?? ''; 
    $password = $_POST['password'] ?? '';

    // Query mencari berdasarkan kolom 'email'
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($query);

    // Karena password kamu terenkripsi ($2y$12...), kita gunakan password_verify
    if ($user && password_verify($password, $user['password'])) {
        echo json_encode([
            "status" => "success",
            "message" => "Login Berhasil",
            "data" => [
                "id" => $user['id'],
                "name" => $user['name'],
                "email" => $user['email']
            ]
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Email atau Password salah"
        ]);
    }
}
?>