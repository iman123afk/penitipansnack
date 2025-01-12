<?php
require 'functions.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
    exit;
}

// Cek jika ada form yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menghapus item dari keranjang
    if (isset($_POST['remove_item'])) {
        $id = intval($_POST['id']);
        $query = "DELETE FROM keranjang WHERE id = $id";
        mysqli_query($conn, $query);
    }

    // Update kuantitas item
    if (isset($_POST['update_quantity'])) {
        $id = intval($_POST['id']);
        $quantity = max(1, intval($_POST['quantity'])); // Minimal kuantitas = 1
        $query = "UPDATE keranjang SET kuantitas = $quantity WHERE id = $id";
        mysqli_query($conn, $query);
    }

    // Proses checkout
    if (isset($_POST['checkout'])) {
        if (isset($_POST['selected_ids'])) {
            $selected_ids = $_POST['selected_ids']; // Array ID item yang dicentang
            header("Location: pembayaran.php?ids=" . implode(',', $selected_ids));
            exit();
        } else {
            echo "<script>alert('Silakan pilih item untuk checkout!');</script>";
        }
    }
}

// Query untuk menampilkan isi keranjang
$query = "SELECT keranjang.id AS keranjang_id, snack.nama_snack, snack.gambar, snack.harga, keranjang.kuantitas 
          FROM keranjang 
          JOIN snack ON keranjang.snack_id = snack.ID";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header>
        <div class="logo">
            <img src="./img/Snack Logo - Original - 5000x5000 6.png" alt="Snack Logo">
        </div>
        <nav>
            <a href="index.php">
                <button>Home</button>
            </a>
            <button class="active">Keranjang</button>
            <a href="notifikasi.php">
                <button>Notifikasi</button>
            </a>
            <a href="profile-user.php">
                <button>Profil</button>
            </a>
        </nav>
    </header>
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Keranjang</h1>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <form method="post" action="pembayaran.php" id="checkout-form">
                <div class="text-right p-4">
                    <button type="submit" name="checkout" class="btn-checkout">Checkout</button>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Produk
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Produk
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga Satuan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kuantitas
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total Harga
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Checkout
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td>
                                    <img class="keranjang-img" src="uploads/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama_snack']); ?>" style="max-width: 80px;">
                                </td>
                                <td><?= htmlspecialchars($row['nama_snack']); ?></td>
                                <td class="harga-satuan">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <!-- Input Kuantitas -->
                                    <input type="number" id="my-input" name="quantities[<?= htmlspecialchars($row['keranjang_id']); ?>]"
                                        value="<?= htmlspecialchars($row['kuantitas']); ?>"
                                        min="1"
                                        class="kuantitas-input"
                                        data-id="<?= $row['keranjang_id']; ?>"
                                        data-harga="<?= $row['harga']; ?>">
                                </td>
                                <td class="total-harga">Rp <?= number_format($row['harga'] * $row['kuantitas'], 0, ',', '.'); ?></td>
                                <td>
                                    <!-- Checkbox untuk Checkout -->
                                    <input type="checkbox" name="selected_ids[]" value="<?= htmlspecialchars($row['keranjang_id']); ?>">
                                </td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['keranjang_id']); ?>">
                                        <button type="submit" name="remove_item" class="btn-remove" onclick="return confirm('Tindakan ini akan menghapus data! Anda yakin ingin menghapusnya?');">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </main>

    <script>
        // Fungsi untuk memperbarui tabel keranjang di server
        document.querySelectorAll('.kuantitas-input').forEach(input => {
            input.addEventListener('input', function() {
                const keranjangId = this.dataset.id;
                const hargaSatuan = parseInt(this.dataset.harga);
                const kuantitas = parseInt(this.value) || 1; // Kuantitas minimal 1
                const totalHargaElem = this.closest('tr').querySelector('.total-harga');

                // Hitung total harga dan perbarui tampilan
                const totalHarga = hargaSatuan * kuantitas;
                totalHargaElem.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(totalHarga)}`;

                // Kirim perubahan ke server
                fetch('update_keranjang.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id: keranjangId,
                            kuantitas: kuantitas
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            alert('Gagal memperbarui keranjang.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
</body>

</html>