<?php
require_once 'config.php';

// Якщо користувач вже авторизований, показуємо вітання
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? '';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота №5 - Головна</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; min-height: 100vh; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; text-align: center; }
        .card { background: white; border-radius: 10px; padding: 25px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .btn { display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin: 5px; border: none; cursor: pointer; }
        .btn-danger { background: #e74c3c; }
        .btn-success { background: #27ae60; }
        .btn-warning { background: #f39c12; }
        .btn:hover { opacity: 0.9; }
        input, select { width: 100%; padding: 10px; margin: 8px 0 15px; border: 1px solid #ddd; border-radius: 5px; }
        label { font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #667eea; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
        .menu { display: flex; gap: 15px; flex-wrap: wrap; justify-content: center; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛒 Лабораторна робота №5</h1>
            <p>Робота з базою даних MySQL та бібліотекою PDO</p>
        </div>

        <?php if ($isLoggedIn): ?>
            <!-- Вітання для авторизованого користувача -->
            <div class="card">
                <h2>👋 Вітаємо, <?php echo htmlspecialchars($userName); ?>!</h2>
                <p>Ви успішно увійшли в систему.</p>
                <div class="menu">
                    <a href="profile.php" class="btn">✏️ Редагувати профіль</a>
                    <a href="tov_index.php" class="btn btn-success">📦 Товари</a>
                    <a href="logout.php" class="btn btn-danger">🚪 Вийти</a>
                </div>
            </div>
        <?php else: ?>
            <!-- Форма входу для неавторизованих користувачів -->
            <div class="card">
                <h2>🔐 Вхід на сайт</h2>
                <form action="index.php" method="post">
                    <label>Логін:</label>
                    <input type="text" name="login" required>
                    <label>Пароль:</label>
                    <input type="password" name="password" required>
                    <button type="submit" name="login_submit" class="btn">Увійти</button>
                    <a href="register.php" class="btn btn-success">Зареєструватися</a>
                </form>
            </div>
        <?php endif; ?>

        <!-- Посилання на таблицю товарів -->
        <div class="card">
            <h2>📊 Робота з таблицею товарів</h2>
            <p>Перегляд, додавання та видалення товарів</p>
            <a href="tov_index.php" class="btn">Перейти до товарів →</a>
        </div>
    </div>
</body>
</html>

<?php
// Обробка форми входу
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    
    // Пошук користувача в БД
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        // Успішний вхід
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_login'] = $user['login'];
        
        // Оновлюємо час останнього входу
        $updateStmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $updateStmt->execute([$user['id']]);
        
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('❌ Невірний логін або пароль!');</script>";
    }
}
?>