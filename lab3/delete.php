<?php
$baseDir = __DIR__ . '/user_folders/';
$message = '';

function deleteFolder($dir) {
    if (!is_dir($dir)) return false;
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        is_dir($path) ? deleteFolder($path) : unlink($path);
    }
    return rmdir($dir);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && isset($_POST['password'])) {
    $login = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['login']);
    $password = $_POST['password'];
    $folderToDelete = $baseDir . $login;
    
    if ($password !== 'password123') {
        $message = "❌ Невірний пароль.";
    } elseif (!is_dir($folderToDelete)) {
        $message = "❌ Папка з логіном '{$login}' не знайдена.";
    } else {
        if (deleteFolder($folderToDelete)) {
            $message = "✅ Папка '{$login}' з усім вмістом успішно видалена!";
        } else {
            $message = "❌ Помилка при видаленні папки.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Видалення каталогу користувача</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 50px auto; }
        input, button { width: 100%; padding: 10px; margin: 8px 0; }
        button { background: #e74c3c; color: white; border: none; cursor: pointer; }
        .message { padding: 15px; border-radius: 5px; margin: 15px 0; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <h1>🗑️ Видалення каталогу</h1>
    <?php if ($message): ?>
        <div class="message <?php echo strpos($message, '✅') !== false ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <form method="post">
        <label>Логін папки, яку потрібно видалити:</label>
        <input type="text" name="login" required>
        <label>Пароль:</label>
        <input type="password" name="password" required>
        <button type="submit">⚠️ Видалити папку з усім вмістом</button>
    </form>
    <p><a href="task5_folder_manager.php">⬅ Назад до створення папок</a></p>
    <p><a href="../index.php">← Повернутися до меню лабораторних</a></p>
</body>
</html>