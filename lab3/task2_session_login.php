<?php
// Запускаємо сесію (має бути в самому початку файлу)
session_start();

// Якщо користувач натиснув "Вийти"
if (isset($_GET['logout'])) {
    // Знищуємо сесію
    session_destroy();
    // Перенаправляємо на цю ж сторінку, щоб оновити стан
    header("Location: task2_session_login.php");
    exit();
}

// Обробка форми логіну
$loginError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    // Перевіряємо облікові дані
    if ($login === 'Admin' && $password === 'password') {
        $_SESSION['is_logged_in'] = true;
        $_SESSION['username'] = 'Admin';
        // Оновлюємо сторінку, щоб прибрати POST-запит (запобігає повторній відправці форми при F5)
        header("Location: task2_session_login.php");
        exit();
    } else {
        $loginError = '❌ Невірний логін або пароль!';
    }
}

// Перевіряємо, чи користувач вже залогінений
$isLoggedIn = isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 2: Авторизація через Session</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; }
        input, button { width: 100%; padding: 10px; margin: 8px 0; }
        button { background: #27ae60; color: white; border: none; cursor: pointer; }
        .error { color: red; }
        .welcome { background: #d4edda; padding: 20px; border-radius: 8px; text-align: center; }
        .logout { background: #e74c3c; display: inline-block; text-decoration: none; color: white; padding: 10px 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <?php if ($isLoggedIn): ?>
        <!-- Вітання для залогіненого користувача -->
        <div class="welcome">
            <h2>👋 Добрий день, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>Ви успішно авторизувались.</p>
            <a href="?logout=true" class="logout">🚪 Вийти</a>
        </div>
    <?php else: ?>
        <!-- Форма логіну -->
        <h2>Форма авторизації</h2>
        <form method="post">
            <label>Логін (Admin):</label>
            <input type="text" name="login" placeholder="Введіть логін" required>
            <label>Пароль (password):</label>
            <input type="password" name="password" placeholder="Введіть пароль" required>
            <button type="submit">Увійти</button>
            <?php if ($loginError): ?>
                <p class="error"><?php echo $loginError; ?></p>
            <?php endif; ?>
        </form>
    <?php endif; ?>
    <p><a href="../index.php">← Повернутися до меню лабораторних</a></p>
</body>
</html>