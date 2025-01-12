<?php
require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
				alert('Berhasil mendaftar!');
                window.location.href = 'login.php';
				</script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <script>
        // Fungsi untuk berpindah ke halaman dashboard
        function goToDashboard(event) {
            event.preventDefault//(); // Mencegah pengiriman form default
            window.location.href = "index.php"; // Redirect ke halaman dashboard
        }
    </script> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar</title>
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
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
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

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .form-group .btn-kirim {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }

        .form-group.flex {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .form-group.flex input {
            flex: 1;
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
        <div class="header">
            <h1>Daftar</h1>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="text" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="password2" placeholder="Masukan Ulang Password" required>
            </div>
            <button type="submit" name="register" class="btn">Daftar</button>
        </form>
        <div class="additional-links">


            <p>Sudah Punya Akun? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>

</html>