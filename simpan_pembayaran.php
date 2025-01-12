<?php
require 'functions.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_payment'])) {
    $selected_ids = $_POST['selected_ids'];
    $subtotal = floatval($_POST['subtotal']);

    // Mulai transaksi
    mysqli_begin_transaction($conn);

    try {
        // Insert ke tabel pembayaran
        $query = "INSERT INTO pembayaran (user_id, tanggal_pembayaran, subtotal, status_pembayaran) VALUES (1, NOW(), $subtotal, 'Pending')";
        mysqli_query($conn, $query);
        $pembayaran_id = mysqli_insert_id($conn);

        // Insert ke tabel detail pembayaran dan kurangi stok
        foreach ($selected_ids as $id) {
            // Ambil data dari keranjang dan snack
            $query = "
                SELECT keranjang.snack_id, keranjang.kuantitas, snack.harga, snack.stok 
                FROM keranjang
                JOIN snack ON keranjang.snack_id = snack.ID
                WHERE keranjang.id = $id";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            if (!$row) {
                throw new Exception("Item dengan ID keranjang $id tidak ditemukan.");
            }

            // Cek stok cukup
            if ($row['stok'] < $row['kuantitas']) {
                throw new Exception("Stok tidak mencukupi untuk snack ID: {$row['snack_id']}");
            }

            // Kurangi stok di tabel snack
            $querySnack = "UPDATE snack SET stok = stok - ? WHERE ID = ?";
            $stmtSnack = mysqli_prepare($conn, $querySnack);
            mysqli_stmt_bind_param($stmtSnack, 'ii', $row['kuantitas'], $row['snack_id']);
            mysqli_stmt_execute($stmtSnack);

            if (mysqli_stmt_affected_rows($stmtSnack) === 0) {
                throw new Exception("Gagal mengurangi stok untuk snack ID: {$row['snack_id']}");
            }

            // Insert ke tabel detail pembayaran
            $harga_total = $row['kuantitas'] * $row['harga'];
            $queryDetail = "
                INSERT INTO detail_pembayaran (pembayaran_id, snack_id, kuantitas, harga_satuan, harga_total)
                VALUES ($pembayaran_id, {$row['snack_id']}, {$row['kuantitas']}, {$row['harga']}, $harga_total)";
            mysqli_query($conn, $queryDetail);
        }

        // Hapus data keranjang yang sudah dibayar
        $ids = implode(',', array_map('intval', $selected_ids));
        $query = "DELETE FROM keranjang WHERE id IN ($ids)";
        mysqli_query($conn, $query);

        // Commit transaksi
        mysqli_commit($conn);

        // Tampilkan pesan sukses di halaman ini
        $success = true;
    } catch (Exception $e) {
        // Rollback jika terjadi kesalahan
        mysqli_rollback($conn);
        $error_message = $e->getMessage();
        $success = false;
    }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembayaran Berhasil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://ai-public.creatie.ai/gen_page/tailwind-custom.css" rel="stylesheet" />
    <script
        src="https://cdn.tailwindcss.com/3.4.5?plugins=forms@0.5.7,typography@0.5.13,aspect-ratio@0.4.2,container-queries@0.1.1"></script>
    <script src="https://ai-public.creatie.ai/gen_page/tailwind-config.min.js" data-color="#000000"
        data-border-radius="small"></script>
</head>

<body class="bg-gray-50 font-['Inter']">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow p-8 max-w-lg text-center">
            <?php if (isset($success) && $success): ?>
                <h1 class="text-2xl font-bold text-green-600 mb-4">Pembayaran Berhasil!</h1>
                <p class="text-gray-600 mb-6">Terima kasih telah melakukan pembayaran. Transaksi Anda sedang diproses.</p>
                <a href="index.php"
                    class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700">
                    Kembali ke Dashboard
                </a>
            <?php else: ?>
                <h1 class="text-2xl font-bold text-red-600 mb-4">Terjadi Kesalahan!</h1>
                <p class="text-gray-600 mb-6"><?php echo htmlspecialchars($error_message); ?></p>
                <a href="index.php"
                    class="inline-block bg-gray-600 text-white font-semibold py-2 px-4 rounded hover:bg-gray-700">
                    Kembali ke Dashboard
                </a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>