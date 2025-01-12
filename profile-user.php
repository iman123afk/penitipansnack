<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            background-color: #4c5c76;
            color: #fff;
            width: 250px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar .logo img {
            width: 100px;
            margin-bottom: 20px;
        }

        .sidebar .profile-pic {
            background-color: #ccc;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .sidebar .username {
            margin-bottom: 20px;
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
            width: 100%;
        }

        .sidebar nav ul li {
            margin: 10px 0;
        }

        .sidebar nav ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .sidebar nav ul li a.active,
        .sidebar nav ul li a:hover {
            background-color: #3498db;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background-color: #333;
            padding: 10px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .topbar button {
            margin-left: 10px;
            background: #fff;
            border: none;
            border-radius: 20px;
            padding: 5px 15px;
            cursor: pointer;
        }

        .topbar button.active {
            background-color: #3498db;
            color: #fff;
        }

        .profile {
            padding: 20px;
        }

        .profile h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type="radio"] {
            width: auto;
        }

        .btn-submit {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #2c81ba;
        }
    </style>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="./img/Snack Logo - Original - 5000x5000 6.png" alt="Logo">
            </div>
            <div class="profile-pic"></div>
            <nav>
                <ul>

                    <li><a href="index.php">Home</a></li>

                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main>

            <section class="profile">
                <h2>Profil Saya</h2>
                <form action="#">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="radio" id="male" name="gender" value="male">
                        <label for="male">Laki-Laki</label>
                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female">Perempuan</label>
                    </div>
                    <div class="form-group">
                        <label for="dob">Tanggal Lahir</label>
                        <input type="date" id="dob" name="dob">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" id="address" name="address">
                    </div>
                    <button type="submit" class="btn-submit">Simpan</button>
                </form>
            </section>
        </main>
    </div>
</body>

</html>