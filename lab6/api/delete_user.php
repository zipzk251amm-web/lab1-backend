<?php
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['id'])) {
    echo json_encode(['success' => false, 'message' => 'Немає даних']);
    exit();
}

$id = $data['id'];

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
if ($stmt->execute([$id])) {
    echo json_encode(['success' => true, 'message' => 'Користувача видалено!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Помилка видалення']);
}
?>