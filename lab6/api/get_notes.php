<?php
session_start();
require_once 'config.php';

$userId = $_GET['user_id'] ?? 0;

if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'Не вказано користувача']);
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ? ORDER BY updated_at DESC");
$stmt->execute([$userId]);
$notes = $stmt->fetchAll();

echo json_encode(['success' => true, 'notes' => $notes]);
?>