<?php
$baseDir = __DIR__ . '/user_folders/';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && isset($_POST['password'])) {
    $login = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['login']); // Безпечне ім'я
    $password = $_POST['password'];
    
    // Проста перевірка пароля (в реальному проекті пароль хешують)
    if (empty($login) || empty($password)) {
        $message = "❌ Логін та пароль не можуть бути порожніми.";
    } elseif ($password !== 'password123') { // Умовний пароль для завдання
        $message = "❌ Невірний пароль.";
    } else {
        $userFolder = $baseDir . $login;
        if (!is_dir($userFolder)) {
            mkdir($userFolder, 0777, true);
            mkdir($userFolder . '/video', 0777);
            mkdir($userFolder . '/music', 0777);
            mkdir($userFolder . '/photo', 0777);
            // Створюємо декілька прикладів файлів
            file_put_contents($userFolder . '/video/clip.mp4', 'Приклад відео');
            file_put_contents($userFolder . '/music/song.mp3', 'Приклад музики');
            file_put_contents($userFolder . '/photo/pic.jpg', 'Приклад фото');
            $message = "✅ Папку '{$login}' та підпапки успішно створено!";
        } else {
            $message = "❌ Помилка! Папка з логіном '{$login}' вже існує.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 5: Створення папок</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 50px auto; }
        input, button { width: 100%; padding: 10px; margin: 8px 0; }
        button { background: #3498db; color: white; border: none; cursor: pointer; }
        .message { padding: 15px; border-radius: 5px; margin: 15px 0; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <h1>📂 Створення каталогу користувача</h1>
    <?php if ($message): ?>
        <div class="message <?php echo strpos($message, '✅') !== false ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <form method="post">
        <label>Логін (тільки літери, цифри, _):</label>
        <input type="text" name="login" required>
        <label>Пароль (використайте password123):</label>
        <input type="password" name="password" required>
        <button type="submit">🏗️ Створити структуру папок</button>
    </form>
    <p><a href="delete.php">🗑️ Перейти до сторінки видалення папки</a></p>
    <p><a href="../index.php">← Повернутися до меню лабораторних</a></p>
</body>
</html>