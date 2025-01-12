<?php
error_reporting(0);
require 'functions.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $snack_id = intval($_POST['snack_id']);

    // Periksa apakah snack sudah ada di keranjang
    $query = "SELECT * FROM keranjang WHERE snack_id = $snack_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Jika sudah ada, tambahkan kuantitas
        $query = "UPDATE keranjang SET kuantitas = kuantitas + 1 WHERE snack_id = $snack_id";
    } else {
        // Jika belum ada, tambahkan produk baru
        $query = "INSERT INTO keranjang (snack_id, kuantitas) VALUES ($snack_id, 1)";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Produk berhasil ditambahkan ke keranjang!');</script>";
    } else {
        echo "<script>alert('Gagal menambahkan produk ke keranjang.');</script>";
    }
}

// Query untuk menampilkan snack
$query_snack = "SELECT * FROM snack";
$result_snack = mysqli_query($conn, $query_snack);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snack Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .category-title {
            text-align: center;
            font-size: 24px;
            /* Atur ukuran font sesuai keinginan */
            margin-top: 20px;
            /* Atur jarak margin atas sesuai keinginan */
        }
    </style>
    <title>Daftar Menu</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="./img/Snack Logo - Original - 5000x5000 6.png" alt="Snack Logo">
        </div>
        <nav>
            <button class="active">Home</button>
            <a href="keranjang.php">
                <button>Keranjang</button>
            </a>
            <a href="notifikasi.php">
                <button>Notifikasi</button>
            </a>
            <a href="profile-user.php">
                <button>Profil</button>
            </a>

        </nav>
    </header>

    <section class="hero">
        <h1>"Manis, Asin, Pedas? Semua Ada di Sini!"</h1>
        <p>"Ngemil Tanpa Khawatir, Rasa Heboh Bikin Happy!"</p>
        <div class="search">
            <input type="text" placeholder="Cari snack favoritmu...">
            <button>Search</button>
        </div>
    </section>
    <div class="category-title">Daftar menu</div>
    <div class="products">
        <?php while ($row = mysqli_fetch_assoc($result_snack)): ?>
            <div class="product">
                <img src="uploads/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama_snack']); ?>">
                <p><strong><?= htmlspecialchars($row['nama_snack']); ?></strong></p>
                <p>Stok: <?= htmlspecialchars($row['stok']); ?></p>
                <p>Harga: Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                <form method="post" style="display: inline-block;">
                    <input type="hidden" name="snack_id" value="<?= htmlspecialchars($row['ID']); ?>">
                    <button type="submit" name="add_to_cart" class="btn-keranjang">Keranjang</button>
                </form>
                <!-- <form method="get" action="pembayaran.php" style="display: inline-block;">
                    <input type="hidden" name="snack_id" value="<//?= htmlspecialchars($row['ID']); ?>">
                    <input type="hidden" name="nama_snack" value="<//?= htmlspecialchars($row['nama_snack']); ?>">
                    <input type="hidden" name="harga" value="<//?= htmlspecialchars($row['harga']); ?>">
                    <button type="submit" class="btn-beli">Beli</button>
                </form> -->
                <form method="get" action="pembayaran.php" style="display: inline-block;">
                    <input type="hidden" name="snack_id" value="<?= htmlspecialchars($row['ID']); ?>">
                    <input type="hidden" name="gambar" value="<?= htmlspecialchars($row['gambar']); ?>">
                    <input type="hidden" name="nama_snack" value="<?= htmlspecialchars($row['nama_snack']); ?>">
                    <input type="hidden" name="harga" value="<?= htmlspecialchars($row['harga']); ?>">
                    <input type="hidden" name="kuantitas" value="1"> <!-- Kuantitas default adalah 1 -->
                    <button type="submit" class="btn-beli">Beli</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>