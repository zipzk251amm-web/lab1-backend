<?php
// Обробник видалення файлів
$resultDir = __DIR__ . '/ResultFiles/';
$backLink = '<br><p><a href="task3.2_file_processor.php">⬅ Назад до аналізатора файлів</a></p>';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filename'])) {
    $filename = basename($_POST['filename']); // Безпека: беремо тільки ім'я файлу
    $filePath = $resultDir . $filename;
    
    if (file_exists($filePath) && is_file($filePath)) {
        if (unlink($filePath)) {
            echo "<h2>✅ Файл '{$filename}' успішно видалено!</h2>";
        } else {
            echo "<h2>❌ Помилка: Не вдалося видалити файл '{$filename}'.</h2>";
        }
    } else {
        echo "<h2>❌ Файл '{$filename}' не знайдено.</h2>";
    }
    echo $backLink;
} else {
    // Якщо зайшли без POST-запиту
    header("Location: task3.2_file_processor.php");
    exit();
}
?>