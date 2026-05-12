<?php
// Встановлюємо розмір шрифту з Cookie, якщо він є, інакше - середній за замовчуванням
$fontSize = $_COOKIE['fontSize'] ?? 'medium';

// Якщо натиснуто одне з посилань
if (isset($_GET['size'])) {
    $fontSize = $_GET['size'];
    // Встановлюємо Cookie на 30 днів (шлях '/' означає, що буде доступне на всьому сайті)
    setcookie('fontSize', $fontSize, time() + (86400 * 30), "/");
    // Перезавантажуємо сторінку, щоб побачити зміни одразу
    header("Location: task1_cookie_font.php");
    exit();
}

// Визначаємо CSS клас в залежності від розміру
$fontClass = '';
switch ($fontSize) {
    case 'large':
        $fontClass = 'font-large';
        break;
    case 'small':
        $fontClass = 'font-small';
        break;
    default:
        $fontClass = 'font-medium';
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 1: Робота з Cookie</title>
    <style>
        body { font-family: Arial, sans-serif; transition: all 0.3s ease; }
        .font-large { font-size: 24px; }
        .font-medium { font-size: 18px; }
        .font-small { font-size: 12px; }
        a { margin-right: 15px; text-decoration: none; background: #3498db; color: white; padding: 8px 15px; border-radius: 5px; }
        a:hover { background: #2980b9; }
        .content { margin-top: 30px; line-height: 1.6; }
    </style>
</head>
<body class="<?php echo $fontClass; ?>">
    <h1>Налаштування розміру шрифту (Cookie)</h1>
    <div>
        <a href="?size=large">🔠 Великий шрифт</a>
        <a href="?size=medium">🔡 Середній шрифт</a>
        <a href="?size=small">🔣 Маленький шрифт</a>
    </div>
    <div class="content">
        <h2>Приклад тексту</h2>
        <p>Цей текст змінює свій розмір залежно від вашого вибору.</p>
        <p>Розмір шрифту зберігається за допомогою Cookie.</p>
        <p>Спробуйте обрати інший розмір та оновіть сторінку – розмір залишиться!</p>
    </div>
    <p><a href="../index.php">← Повернутися до меню лабораторних</a></p>
</body>
</html>