<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include_once '../config/database.php';

// Ambil data JSON dari request
$data = json_decode(file_get_contents("php://input"));

if (isset($data->user_id) && isset($data->latitude) && isset($data->longitude)) {
    $userId = intval($data->user_id);
    $latitude = floatval($data->latitude);
    $longitude = floatval($data->longitude);

    $stmt = $pdo->prepare("INSERT INTO locations (child_id, latitude, longitude, timestamp) VALUES (?, ?, ?, datetime('now'))");
    if ($stmt->execute([$userId, $latitude, $longitude])) {
        echo json_encode(['status' => 'success', 'message' => 'Location added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add location']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
?>
