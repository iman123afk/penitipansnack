<?php
require 'functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hapus item dari keranjang
    if (isset($_POST['remove_item'])) {
        $id = intval($_POST['id']);
        $query = "DELETE FROM keranjang WHERE id = $id";
        mysqli_query($conn, $query);
    }

    // Update kuantitas
    if (isset($_POST['update_quantity'])) {
        $id = intval($_POST['id']);
        $quantity = max(1, intval($_POST['quantity']));
        $query = "UPDATE keranjang SET kuantitas = $quantity WHERE id = $id";
        if (!mysqli_query($conn, $query)) {
            echo "<script>alert('Gagal mengupdate kuantitas!');</script>";
        }
    }

    // Checkout
    if (isset($_POST['checkout']) && isset($_POST['selected_ids'])) {
        $selected_ids = $_POST['selected_ids'];
        header("Location: pembayaran.php?ids=" . implode(',', $selected_ids));
        exit();
    }
}
header("Location: keranjang.php"); // Redirect setelah proses
exit();
