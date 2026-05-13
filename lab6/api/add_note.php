<?php
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Немає даних']);
    exit();
}

$userId = $data['user_id'] ?? 0;
$title = trim($data['title'] ?? '');
$content = trim($data['content'] ?? '');

if (empty($title) || empty($content)) {
    echo json_encode(['success' => false, 'message' => 'Заповніть заголовок та текст']);
    exit();
}

$stmt = $pdo->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");
if ($stmt->execute([$userId, $title, $content])) {
    echo json_encode(['success' => true, 'message' => 'Замітку додано!', 'note_id' => $pdo->lastInsertId()]);
} else {
    echo json_encode(['success' => false, 'message' => 'Помилка додавання']);
}
?>