<?php
require 'functions.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
    exit;
}

header('Content-Type: application/json');

// Cek metode permintaan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['id']) && isset($input['kuantitas'])) {
        $id = intval($input['id']);
        $kuantitas = max(1, intval($input['kuantitas'])); // Pastikan kuantitas minimal 1

        // Update database
        $query = "UPDATE keranjang SET kuantitas = $kuantitas WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Database error']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
