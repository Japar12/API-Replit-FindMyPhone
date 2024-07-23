<?php
// Konfigurasi database SQLite
// database.php
$databaseFile = __DIR__ . '/../db/database.sqlite'; // Pastikan path ini benar


try {
    // Membuat koneksi PDO ke database SQLite
    $pdo = new PDO("sqlite:$databaseFile");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mengatur mode error ke Exception
} catch (PDOException $e) {
    // Menampilkan pesan kesalahan jika koneksi gagal
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit();
}
?>
