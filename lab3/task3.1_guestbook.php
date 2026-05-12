<?php
$commentsFile = 'comments.txt';
$message = '';

// Якщо форма відправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['comment'])) {
    $name = trim($_POST['name']);
    $comment = trim($_POST['comment']);
    
    if (!empty($name) && !empty($comment)) {
        // Формат зберігання: Ім'я|Коментар|Час\n
        $data = $name . '|' . $comment . '|' . date('Y-m-d H:i:s') . PHP_EOL;
        // Записуємо в кінець файлу
        file_put_contents($commentsFile, $data, FILE_APPEND | LOCK_EX);
        $message = '<p style="color:green;">✅ Коментар додано!</p>';
    } else {
        $message = '<p style="color:red;">❌ Заповніть всі поля!</p>';
    }
}

// Читаємо всі коментарі з файлу
$allComments = [];
if (file_exists($commentsFile)) {
    $lines = file($commentsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $parts = explode('|', $line);
        if (count($parts) === 3) {
            $allComments[] = ['name' => htmlspecialchars($parts[0]), 'comment' => nl2br(htmlspecialchars($parts[1])), 'date' => $parts[2]];
        }
    }
    // Виводимо останні коментарі зверху
    $allComments = array_reverse($allComments);
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 3.1: Гостьова книга</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; }
        form { background: #f4f4f4; padding: 20px; border-radius: 8px; }
        input, textarea { width: 100%; padding: 8px; margin: 8px 0; box-sizing: border-box; }
        button { background: #3498db; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .comment { border-bottom: 1px solid #ddd; padding: 15px 0; }
        .comment strong { color: #2c3e50; }
        .date { color: #888; font-size: 12px; }
    </style>
</head>
<body>
    <h1>📝 Гостьова книга</h1>
    <?php echo $message; ?>
    <form method="post">
        <label>Ваше Ім'я:</label>
        <input type="text" name="name" required>
        <label>Коментар:</label>
        <textarea name="comment" rows="4" required></textarea>
        <button type="submit">📨 Додати коментар</button>
    </form>

    <h2>💬 Всі коментарі</h2>
    <?php if (empty($allComments)): ?>
        <p>Поки немає коментарів. Будьте першим!</p>
    <?php else: ?>
        <?php foreach ($allComments as $comment): ?>
            <div class="comment">
                <strong><?php echo $comment['name']; ?></strong>
                <span class="date">(<?php echo $comment['date']; ?>)</span>
                <p><?php echo $comment['comment']; ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <p><a href="../index.php">← Повернутися до меню лабораторних</a></p>
</body>
</html>