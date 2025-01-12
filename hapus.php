<?php
require 'functions.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
    exit;
}

$ID = $_GET["ID"];

if (hapus($ID) > 0) {
    echo "
        <script>
            alert('Data Berhasil dihapus!');
            document.location.href = 'admin-dashboard.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data Gagal ditambahkan');
            document.location.href = 'admin-dashboard.php';
        </script>
        ";
}
