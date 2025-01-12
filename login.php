<?php
session_start();
require 'functions.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            $_SESSION["login"] = true;

            if (isset($_POST['remember'])) {

                setcookie('id', $row['ID'], time() + 300);
                setcookie('key', $row['username'], time() + 300);
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- <script>
        // Fungsi untuk berpindah ke halaman dashboard
        function goToDashboard(event) {
            event.preventDefault//(); // Mencegah pengiriman form default
            window.location.href = "index.php"; // Redirect ke halaman dashboard
        }
    </script> -->
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">
            <img src="./img/Snack Logo - Original - 5000x5000 6.png" alt="Logo">
            <span>Snack</span>
        </div>
        <div class="menu">
            <a href="login-admin.php">Admin</a>
            <a href="#">Bantuan</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="left-section">
            <img src="./img/logologin.png" alt="Snack Logo">
        </div>
        <div class="right-section">
            <div class="login-box">
                <h2>Login</h2>
                <form action="" method="post">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="login">Log In</button>
                </form>
                <?php if (isset($error)) : ?>
                    <p style="color: red; font-style: italic;">username / password salah</p><?php endif; ?>
                <a href="#">Lupa Password</a>
                <a href="daftar-user.php">Belum Punya Akun? Daftar</a>
            </div>
        </div>
    </div>
</body>

</html>