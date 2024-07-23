<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Izinkan akses dari semua origin
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Include database connection
require '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['user_id']) && isset($input['latitude']) && isset($input['longitude'])) {
        $userId = $input['user_id'];
        $latitude = $input['latitude'];
        $longitude = $input['longitude'];

        try {
            $sql = 'UPDATE locations SET latitude = ?, longitude = ?, timestamp = datetime("now") WHERE child_id = ?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$latitude, $longitude, $userId]);

            echo json_encode(['status' => 'success', 'message' => 'Location updated successfully']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
