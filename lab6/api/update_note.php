<?php
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['id'])) {
    echo json_encode(['success' => false, 'message' => 'Немає даних']);
    exit();
}

$id = $data['id'];
$title = trim($data['title'] ?? '');
$content = trim($data['content'] ?? '');

if (empty($title) || empty($content)) {
    echo json_encode(['success' => false, 'message' => 'Заповніть заголовок та текст']);
    exit();
}

$stmt = $pdo->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ?");
if ($stmt->execute([$title, $content, $id])) {
    echo json_encode(['success' => true, 'message' => 'Замітку оновлено!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Помилка оновлення']);
}
?>