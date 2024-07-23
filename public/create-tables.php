<?php
// File: public/create-tables.php

header('Content-Type: application/json');

// Include the Db class file
require '../config/database.php';

try {
    // Buat tabel jika belum ada
    $sql = "CREATE TABLE IF NOT EXISTS locations (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                child_id INTEGER NOT NULL,
                latitude REAL NOT NULL,
                longitude REAL NOT NULL,
                timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
            )";
    $pdo->exec($sql);
    echo json_encode(['status' => 'success', 'message' => 'Table created or already exists']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
