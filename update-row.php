<?php
require 'functions.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $ID = $_POST['ID'];
    $namaSnack = $_POST['namaSnack'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

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
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data']);
    }
    exit;
}
