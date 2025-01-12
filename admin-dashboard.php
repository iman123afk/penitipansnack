<?php
error_reporting(0);
require 'functions.php';
session_start();

if (!isset($_SESSION["Login"])) {
    header("Location: Login.php");
    exit;
}
$penitipan = query("SELECT * FROM snack");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $ID = $_POST['ID'];
    $namaSnack = $_POST['namaSnack'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    // Periksa apakah data telah diterima
    if (!empty($ID) && !empty($namaSnack) && !empty($kategori) && !empty($stok) && !empty($harga)) {
        // Query untuk memperbarui database
        $query = "UPDATE snack SET 
                    `nama_snack` = '$namaSnack', 
                    kategori = '$kategori', 
                    stok = '$stok', 
                    harga = '$harga'
                  WHERE ID = '$ID'";

        if (mysqli_query($conn, $query)) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin-styles.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="sidebar">
        <div class="logo">Admin</div>
        <div class="profile-pic"></div>
        <div class="username">Username</div>
        <ul class="menu">
            <li><a href="#" class="active">Dashboard</a></li>
            <li><a href="admin-snack.php">Snack</a></li>
            <li><a href="admin-setting.php">Setting</a></li>
            <li><a href="logout-admin.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Dashboard</h1>
        <div class="stats">
            <div class="card">
                <h2>24</h2>
                <p>Snack yang dititipkan</p>
            </div>
            <div class="card">
                <h2>15.750.000</h2>
                <p>Total pendapatan</p>
            </div>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Total terjual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penitipan as $row) : ?>
                        <tr data-ID="<?= $row['ID']; ?>">
                            <td data-column="namaSnack"><?= $row['nama_snack']; ?></td>
                            <td data-column="kategori"><?= $row['kategori']; ?></td>
                            <td data-column="stok"><?= $row['stok']; ?></td>
                            <td data-column="harga"><?= $row['harga']; ?></td>
                            <td>550</td>
                            <td>
                                <a href="#" class="edit-btn">Ubah</a>
                                <a class="delete-btn" href="hapus.php?ID=<?= $row["ID"]; ?>" onclick="return confirm('Tindakan ini akan menghapus data! Anda yakin ingin menghapusnya?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </div>
    <script src="js/scripts.js"></script>
</body>

</html>