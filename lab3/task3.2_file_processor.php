<?php
$baseDir = __DIR__; // Поточна директорія
$file1 = $baseDir . '/file1.txt';
$file2 = $baseDir . '/file2.txt';
$resultDir = $baseDir . '/ResultFiles/';
$message = '';

// Функція для читання та нормалізації слів з файлу
function readWords($filename) {
    if (!file_exists($filename)) return [];
    $content = file_get_contents($filename);
    // Розділяємо за пробілами і переведенням рядка
    $words = preg_split('/\s+/', trim($content));
    return array_filter($words); // видаляємо порожні
}

// Функція для запису масиву в файл
function writeToFile($filepath, $data) {
    file_put_contents($filepath, implode(PHP_EOL, $data));
}

// Якщо ще не обробляли, створюємо результати
if (!file_exists($resultDir . 'only_in_first.txt')) {
    if (!is_dir($resultDir)) mkdir($resultDir, 0777, true);
    
    $words1 = readWords($file1);
    $words2 = readWords($file2);
    
    // Підрахунок входжень
    $count1 = array_count_values($words1);
    $count2 = array_count_values($words2);
    
    $uniqueToFirst = [];
    $common = [];
    $moreThanTwice = [];
    
    // Всі унікальні слова з обох файлів
    $allWords = array_unique(array_merge(array_keys($count1), array_keys($count2)));
    
    foreach ($allWords as $word) {
        $inFirst = isset($count1[$word]);
        $inSecond = isset($count2[$word]);
        
        // а) зустрічаються тільки в першому файлі
        if ($inFirst && !$inSecond) {
            $uniqueToFirst[] = $word;
        }
        // б) зустрічаються в обох файлах
        if ($inFirst && $inSecond) {
            $common[] = $word;
        }
        // в) зустрічаються в кожному файлі більше двох разів
        if (($count1[$word] ?? 0) > 2 && ($count2[$word] ?? 0) > 2) {
            $moreThanTwice[] = $word;
        }
    }
    
    writeToFile($resultDir . 'only_in_first.txt', $uniqueToFirst);
    writeToFile($resultDir . 'common_in_both.txt', $common);
    writeToFile($resultDir . 'more_than_twice_in_each.txt', $moreThanTwice);
    
    $message = '<p style="color:green;">✅ Файли результатів створено!</p>';
}

// Список доступних файлів для видалення
$availableFiles = [];
if (is_dir($resultDir)) {
    $availableFiles = array_diff(scandir($resultDir), ['..', '.']);
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 3.2: Обробка файлів</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; }
        .box { background: #f0f0f0; padding: 15px; margin: 15px 0; border-radius: 8px; }
        button { background: #e74c3c; color: white; padding: 5px 10px; border: none; cursor: pointer; border-radius: 4px; }
        .file-list { list-style: none; padding: 0; }
        .file-list li { background: #ecf0f1; margin: 5px 0; padding: 8px; display: flex; justify-content: space-between; }
        a { text-decoration: none; color: #3498db; }
    </style>
</head>
<body>
    <h1>📁 Аналіз файлів file1.txt та file2.txt</h1>
    <?php echo $message; ?>
    
    <div class="box">
        <h3>📄 Створені файли результатів:</h3>
        <ul class="file-list">
            <li><span>only_in_first.txt</span> <span>👉 слова, які є тільки в першому файлі</span></li>
            <li><span>common_in_both.txt</span> <span>👉 слова, які є в обох файлах</span></li>
            <li><span>more_than_twice_in_each.txt</span> <span>👉 слова, що зустрічаються >2 разів у кожному</span></li>
        </ul>
    </div>
    
    <div class="box">
        <h3>🗑️ Видалення файлу</h3>
        <form action="task3.2_delete_file.php" method="post">
            <label>Виберіть файл для видалення:</label>
            <select name="filename" required>
                <option value="">-- Оберіть файл --</option>
                <?php foreach ($availableFiles as $file): ?>
                    <option value="<?php echo htmlspecialchars($file); ?>"><?php echo htmlspecialchars($file); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">🗑️ Видалити файл</button>
        </form>
        <p style="font-size: 14px; color: #666;">* <strong>Примітка:</strong> Файли створюються один раз. Після видалення їх можна відновити, видаливши папку ResultFiles.</p>
    </div>
    
    <p><a href="../index.php">← Повернутися до меню лабораторних</a></p>
</body>
</html>