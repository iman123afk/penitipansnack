<?php
error_reporting(0);
require 'functions.php';
session_start();

if (!isset($_SESSION["Login"])) {
    header("Location: Login.php");
    exit;
}

if (isset($_POST["submit"])) {

    if (tambah($_POST) > 0) {
        echo "
<script>
    alert('Data Berhasil ditambahkan!');
    document.location.href = 'admin-snack.php';
</script>
";
    } else {
        echo "
<script>
    alert('Data Gagal ditambahkan');
    document.location.href = 'admin-snack.php';
</script>
";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["tambahStok"])) {
    $namaSnack = $_POST['pilih-snack'];
    $jumlah = (int)$_POST['jumlah'];

    $result = tambahStok($namaSnack, $jumlah);

    if ($result > 0) {
        echo "
<script>
    alert('Stok berhasil ditambahkan!');
    document.location.href = 'admin-snack.php';
</script>
";
    } elseif ($result === -1) {
        echo "
<script>
    alert('Nama tidak ditemukan!');
    document.location.href = 'admin-snack.php';
</script>
";
    } else {
        echo "
<script>
    alert('Stok gagal ditambahkan');
    document.location.href = 'admin-snack.php';
</script>
";
    }
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Snack</title>
    <link rel="stylesheet" href="css/admin-styles.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="sidebar">
        <div class="logo">Admin</div>
        <div class="profile-pic"></div>
        <div class="username">Username</div>
        <ul class="menu">
            <li><a href="admin-dashboard.php">Dashboard</a></li>
            <li><a href="#" class="active">Snack</a></li>
            <li><a href="admin-setting.php">Setting</a></li>
            <li><a href="login-admin.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Snack</h1>
        <div class="form-section">
            <div class="form-card">
                <h2>Tambah Snack</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="nama_snack">Nama Snack</label>
                    <input type="text" id="nama_snack" name="nama_snack" placeholder="Masukkan nama snack" required>

                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="Masukkan kategori" required>

                    <label for="harga">Harga</label>
                    <input type="number" id="harga" name="harga" placeholder="Masukkan harga" required>

                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" placeholder="Masukkan stok" required>

                    <label for="gambar">Gambar</label>
                    <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg" required>

                    <button type="submit" name="submit">Tambah</button>
                </form>
            </div>
            <div class="form-card">
                <h2>Tambah Stok</h2>
                <form action="" method="post">
                    <label for="pilih-snack">Pilih Snack</label>
                    <input type="text" id="pilih-snack" name="pilih-snack" placeholder="Masukkan nama snack" required>
                    <label for="jumlah">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" placeholder="Masukkan jumlah" required>
                    <button type="submit" name="tambahStok">Tambah</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>