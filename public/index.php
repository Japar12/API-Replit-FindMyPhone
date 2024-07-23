<?php
// File: index.php

header('Content-Type: application/json');

// Menambahkan header CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Include database configuration
include_once '../config/database.php';

// Fungsi untuk mengembalikan versi SQLite
function getDatabaseVersion($pdo) {
    try {
        $stmt = $pdo->query('SELECT sqlite_version() AS version');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['version'] : 'Unknown version';
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
}

// Memeriksa koneksi database
try {
    $databaseVersion = getDatabaseVersion($pdo);
    echo json_encode([
        'status' => 'success',
        'message' => 'API is connected',
        'database_version' => $databaseVersion
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database connection failed: ' . $e->getMessage()
    ]);
}
?>
