<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Izinkan akses dari semua origin
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

// Include database connection
require '../config/database.php';

if (isset($_GET['user_id'])) {
    $userId = intval($_GET['user_id']);

    $stmt = $pdo->prepare("SELECT latitude, longitude FROM locations WHERE child_id = ? ORDER BY timestamp DESC LIMIT 1");
    $stmt->execute([$userId]);
    $location = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($location) {
        echo json_encode(['status' => 'success', 'location' => $location]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Location not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'User ID not provided']);
}
?>
