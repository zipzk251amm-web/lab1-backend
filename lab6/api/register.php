<?php
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Немає даних']);
    exit();
}

$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');
$password = $data['password'] ?? '';

// Валідація
if (empty($name) || empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Заповніть всі поля']);
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Невірний формат email']);
    exit();
}

if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => 'Пароль має бути не менше 6 символів']);
    exit();
}

// Перевірка унікальності email
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    echo json_encode(['success' => false, 'message' => 'Користувач з таким email вже існує']);
    exit();
}

// Збереження користувача
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

if ($stmt->execute([$name, $email, $hashedPassword])) {
    echo json_encode(['success' => true, 'message' => 'Реєстрація успішна!', 'user_id' => $pdo->lastInsertId()]);
} else {
    echo json_encode(['success' => false, 'message' => 'Помилка реєстрації']);
}
?>