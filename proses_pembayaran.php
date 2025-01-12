<?php
error_reporting(0);
require 'functions.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['keranjang_ids'])) {
    $keranjangIds = $_POST['keranjang_ids'];

    $conn->begin_transaction();
    try {
        foreach ($keranjangIds as $keranjangId) {
            // Ambil data item
            $stmt = $conn->prepare("SELECT snack_id, kuantitas FROM keranjang WHERE keranjang_id = ?");
            $stmt->bind_param('i', $keranjangId);
            $stmt->execute();
            $item = $stmt->get_result()->fetch_assoc();

            // Kurangi stok
            $stmt = $conn->prepare("UPDATE snack SET stok = stok - ? WHERE id = ? AND stok >= ?");
            $stmt->bind_param('iii', $item['kuantitas'], $item['snack_id'], $item['kuantitas']);
            $stmt->execute();
            if ($stmt->affected_rows === 0) {
                throw new Exception("Stok tidak mencukupi untuk item tertentu.");
            }

            // Hapus dari keranjang
            $stmt = $conn->prepare("DELETE FROM keranjang WHERE keranjang_id = ?");
            $stmt->bind_param('i', $keranjangId);
            $stmt->execute();
        }

        $conn->commit();
        echo "<script>alert('Pembayaran berhasil!'); window.location.href = 'keranjang.php';</script>";
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>alert('Pembayaran gagal: {$e->getMessage()}');</script>";
    }
} else {
    header("Location: keranjang.php");
}
