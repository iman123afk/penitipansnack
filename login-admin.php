<?php
session_start();
require 'functions.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT Username FROM mimin WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    $_SESSION['Login'] = true;
}

if (isset($_POST["Login"])) {

    $username = $_POST["Username"];
    $password = $_POST["Password"];

    $result = mysqli_query($conn, "SELECT * FROM mimin WHERE Username = '$username'");
    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);
        $_SESSION["Login"] = true;

        if (isset($_POST['remember'])) {

            setcookie('id', $row['ID'], time() + 300);
            setcookie('key', $row['Username'], time() + 300);
        }

        header("Location: admin-dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        // Fungsi untuk berpindah ke halaman dashboard
        // function goToDashboard(event) {
        //     event.preventDefault(); // Mencegah pengiriman form default
        //     window.location.href = "admin-dashboard.php"; // Redirect ke halaman dashboard
        // }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .back-button {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 20px;
            color: #333;
            cursor: pointer;
            text-decoration: none;
        }

        .back-button:hover {
            color: #555;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
        }

        .header p {
            font-size: 14px;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #555;
        }

        .additional-links {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }

        .additional-links a {
            color: #333;
            text-decoration: none;
        }

        .additional-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="login.php" class="back-button">←</a>
        <div class="header">
            <h1>Login Admin</h1>
            <p>Silakan pilih role dan masukkan kredensial Anda</p>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label for="role">Pilih Role</label>
                <select id="role">
                    <option value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="superadmin">Superadmin</option>

                </select>
            </div>
            <div class="form-group">
                <input type="text" name="Username" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" name="Password" placeholder="Password">
            </div>
            <button type="submit" name="Login" class="btn">Log In</button>

        </form>
        <div class="additional-links">
            <p><a href="#">Lupa Password?</a></p>
        </div>
    </div>
</body>

</html>