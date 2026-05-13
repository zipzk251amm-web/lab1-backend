<?php
/**
 * Файл підключення до бази даних
 * Використовує PDO з обробкою помилок try-catch
 */

// Налаштування підключення
$host = 'localhost';
$dbname = 'lab5';
$username = 'root';
$password = '';

try {
    // Створення PDO з'єднання
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Встановлення режиму помилок
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Для налагодження (можна закоментувати)
    // echo "✅ Підключення до БД успішне!<br>";
    
} catch(PDOException $e) {
    // Обробка помилки підключення
    die("❌ Помилка підключення до бази даних: " . $e->getMessage());
}

// Запуск сесії для роботи з авторизацією
session_start();
?>