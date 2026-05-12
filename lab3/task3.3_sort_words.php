<?php
$inputFile = 'unsorted_words.txt';
$outputFile = 'sorted_words.txt';
$message = '';

// Створюємо приклад файлу, якщо його немає
if (!file_exists($inputFile)) {
    $exampleWords = "банан яблуко вишня апельсин груша лимон слива манго ківі ананас мандарин";
    file_put_contents($inputFile, $exampleWords);
    $message = '<p style="color:blue;">📝 Приклад файлу unsorted_words.txt створено!</p>';
}

// Обробка сортування
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sort'])) {
    if (file_exists($inputFile)) {
        $content = file_get_contents($inputFile);
        $words = preg_split('/\s+/', trim($content));
        sort($words, SORT_STRING | SORT_FLAG_CASE);
        $sortedContent = implode(' ', $words);
        file_put_contents($outputFile, $sortedContent);
        $message = '<p style="color:green;">✅ Слова відсортовано за алфавітом! Результат у файлі sorted_words.txt</p>';
    } else {
        $message = '<p style="color:red;">❌ Файл unsorted_words.txt не знайдено.</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 3.3: Сортування слів</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; }
        .box { background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0; }
        button { background: #3498db; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        pre { background: #eee; padding: 10px; border-radius: 5px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>📖 Сортування слів у файлі</h1>
    <?php echo $message; ?>
    
    <div class="box">
        <h3>📄 Вміст файлу unsorted_words.txt:</h3>
        <pre><?php echo file_exists($inputFile) ? htmlspecialchars(file_get_contents($inputFile)) : 'Файл не знайдено.'; ?></pre>
    </div>
    
    <form method="post">
        <button type="submit" name="sort">🔠 Відсортувати слова за алфавітом</button>
    </form>
    
    <?php if (file_exists($outputFile)): ?>
    <div class="box">
        <h3>✅ Відсортовані слова (sorted_words.txt):</h3>
        <pre><?php echo htmlspecialchars(file_get_contents($outputFile)); ?></pre>
    </div>
    <?php endif; ?>
    
    <p><a href="../index.php">← Повернутися до меню лабораторних</a></p>
</body>
</html>