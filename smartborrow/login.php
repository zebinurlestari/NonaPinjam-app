<?php
include 'config.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['user'] = $data;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login | SmartBorrow</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="login-wrapper">

    <div class="decor decor-left">
    <img src="img/books.png">
</div>

<div class="login-box">
    ...
</div>

<<div class="login-wrapper">

    <div class="login-box">
        <div class="decor decor-left">
            <img src="img/books.png">
        </div>

        <div class="decor decor-right">
            <img src="img/books.png">
        </div>

        <div class="header">
            <h1>Sistem Peminjaman</h1>
            <p>Perpustakaan</p>
        </div>

        <div class="container">
            <h2>Login</h2>

            <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

            <form method="POST">
                <label>Username</label>
                <input type="text" name="username" required>

                <label>Password</label>
                <input type="password" name="password" required>

                <button name="login">Masuk</button>
            </form>
        </div>
    </div>

</div>

</body>
</html>

