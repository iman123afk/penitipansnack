<?php
error_reporting(0);
require 'functions.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_ids'])) {
    $selected_ids = $_POST['selected_ids'];

    // Query untuk mengambil data keranjang berdasarkan ID yang dipilih
    $ids = implode(',', array_map('intval', $selected_ids)); // Sanitasi input
    $query = "
        SELECT 
            snack.gambar, snack.nama_snack, keranjang.kuantitas, 
            snack.harga, (keranjang.kuantitas * snack.harga) AS harga_total
        FROM keranjang
        JOIN snack ON keranjang.snack_id = snack.ID
        WHERE keranjang.id IN ($ids)";
    $result = mysqli_query($conn, $query);

    // Hitung subtotal
    $subtotal = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $subtotal += $row['harga_total'];
    }

    // Tampilkan data ke user
    mysqli_data_seek($result, 0); // Reset pointer untuk loop tampilan
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['snack_id'], $_GET['gambar'], $_GET['nama_snack'], $_GET['harga'], $_GET['kuantitas'])) {
        $snack_id = htmlspecialchars($_GET['snack_id']);
        $gambar = htmlspecialchars($_GET['gambar']);
        $nama_snack = htmlspecialchars($_GET['nama_snack']);
        $harga = htmlspecialchars($_GET['harga']);
        $kuantitas = htmlspecialchars($_GET['kuantitas']);

        // Proses data untuk checkout
        echo "<h1>Checkout Snack</h1>";
        echo "<img src='uploads/$gambar' alt='$nama_snack' style='max-width: 150px;'>";
        echo "<p>Nama: $nama_snack</p>";
        echo "<p>Harga: Rp " . number_format($harga, 0, ',', '.') . "</p>";
        echo "<p>Kuantitas: $kuantitas</p>";
        echo "<p>Total Harga: Rp " . number_format($harga * $kuantitas, 0, ',', '.') . "</p>";

        // Tambahkan logika tambahan sesuai kebutuhan (misalnya, menyimpan ke database atau memproses pembayaran)
    } else {
        echo "Data tidak lengkap untuk checkout!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembayaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://ai-public.creatie.ai/gen_page/tailwind-custom.css" rel="stylesheet">
    <script
        src="https://cdn.tailwindcss.com/3.4.5?plugins=forms@0.5.7,typography@0.5.13,aspect-ratio@0.4.2,container-queries@0.1.1"></script>
    <script src="https://ai-public.creatie.ai/gen_page/tailwind-config.min.js" data-color="#000000"
        data-border-radius="small"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="bg-gray-50 font-['Inter']">
    <div class="min-h-screen max-w-3xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold mb-8">Detail Pembayaran</h1>
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="space-y-6">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="uploads/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama_snack']); ?>"
                                alt="<?= htmlspecialchars($row['nama_snack']); ?>"
                                class="w-16 h-16 object-cover rounded-md">
                            <div>
                                <h3 class="font-medium"><?= htmlspecialchars($row['nama_snack']); ?></h3>
                                <p class="text-gray-500 text-sm">
                                    <?= htmlspecialchars($row['kuantitas']); ?> × Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                                </p>
                            </div>
                        </div>
                        <span class="font-medium">Rp <?= number_format($row['kuantitas'] * $row['harga'], 0, ',', '.'); ?></span>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="border-t pt-4 space-y-3">
                <div class="flex justify-between text-gray-600">
                    <span>Subtotal</span>
                    <span>
                        <?php
                        $subtotal = 0;
                        mysqli_data_seek($result, 0);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $subtotal += $row['kuantitas'] * $row['harga'];
                        }
                        echo 'Rp ' . number_format($subtotal, 0, ',', '.');
                        ?>
                    </span>
                </div>
                <div class="flex justify-between text-gray-600"> <span>Biaya Layanan</span> <span>Rp. 2.000</span> </div>
                <div class="flex justify-between font-semibold text-lg">
                    <span>Total</span>
                    <span>Rp <?= number_format($subtotal + 2000, 0, ',', '.'); ?></span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Metode Pembayaran</h2>
            <div class="space-y-4">
                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payment" class="form-radio text-custom" checked>
                    <div class="ml-3">
                        <div class="font-medium">Transfer bank</div>
                        <div class="text-sm text-gray-500">BCA, Mandiri, BNI, BRI</div>
                    </div>
                </label>
                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payment" class="form-radio text-custom">
                    <div class="ml-3">
                        <div class="font-medium">E-Wallet</div>
                        <div class="text-sm text-gray-500">GoPay, OVO, DANA, LinkAja</div>
                    </div>
                </label>
                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payment" class="form-radio text-custom">
                    <div class="ml-3">
                        <div class="font-medium">Kartu debit/kredit</div>
                        <div class="text-sm text-gray-500">Visa, Mastercard</div>
                    </div>
                </label>
            </div>
        </div>
        <form method="post" action="simpan_pembayaran.php">
            <?php foreach ($selected_ids as $id): ?>
                <input type="hidden" name="selected_ids[]" value="<?= htmlspecialchars($id); ?>">
            <?php endforeach; ?>
            <input type="hidden" name="subtotal" value="<?= htmlspecialchars($subtotal); ?>">
            <button class="w-full bg-custom text-white font-semibold py-4 rounded-lg !rounded-button hover:bg-custom/90 transition-colors"
                type="submit" name="confirm_payment">Konfirmasi Pembayaran</button>
        </form>
    </div>
</body>

</html>