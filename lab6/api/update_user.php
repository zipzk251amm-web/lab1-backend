<?php
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['id'])) {
    echo json_encode(['success' => false, 'message' => 'Немає даних']);
    exit();
}

$id = $data['id'];
$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');

if (empty($name) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Заповніть всі поля']);
    exit();
}

$stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
if ($stmt->execute([$name, $email, $id])) {
    echo json_encode(['success' => true, 'message' => 'Дані оновлено!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Помилка оновлення']);
}
?>