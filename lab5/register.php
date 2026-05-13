<?php
require_once 'config.php';

// Якщо користувач вже авторизований, перенаправляємо
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = trim($_POST['email']);
    $full_name = trim($_POST['full_name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    
    // Валідація
    if (empty($login) || empty($password) || empty($email) || empty($full_name)) {
        $error = "Заповніть всі обов'язкові поля!";
    } elseif ($password !== $confirm_password) {
        $error = "Паролі не співпадають!";
    } elseif (strlen($password) < 6) {
        $error = "Пароль повинен містити не менше 6 символів!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Невірний формат email!";
    } else {
        // Перевірка чи існує вже такий логін або email
        $checkStmt = $pdo->prepare("SELECT id FROM users WHERE login = ? OR email = ?");
        $checkStmt->execute([$login, $email]);
        
        if ($checkStmt->fetch()) {
            $error = "Користувач з таким логіном або email вже існує!";
        } else {
            // Хешування пароля
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Вставка нового користувача
            $stmt = $pdo->prepare("INSERT INTO users (login, password, email, full_name, phone, address, city, birth_date, gender) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            if ($stmt->execute([$login, $hashedPassword, $email, $full_name, $phone, $address, $city, $birth_date, $gender])) {
                $success = "Реєстрація успішна! Тепер ви можете увійти.";
            } else {
                $error = "Помилка при реєстрації. Спробуйте пізніше.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Реєстрація - Лабораторна робота №5</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; min-height: 100vh; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        .card { background: white; border-radius: 10px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #667eea; margin-bottom: 20px; }
        input, select { width: 100%; padding: 10px; margin: 8px 0 15px; border: 1px solid #ddd; border-radius: 5px; }
        label { font-weight: bold; }
        .btn { display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; border: none; cursor: pointer; width: 100%; }
        .btn:hover { opacity: 0.9; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .back-link { display: block; text-align: center; margin-top: 20px; color: #667eea; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>📝 Реєстрація користувача</h1>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form method="post">
                <label>* Логін:</label>
                <input type="text" name="login" required>
                
                <label>* Пароль (мін. 6 символів):</label>
                <input type="password" name="password" required>
                
                <label>* Підтвердження пароля:</label>
                <input type="password" name="confirm_password" required>
                
                <label>* Email:</label>
                <input type="email" name="email" required>
                
                <label>* ПІБ:</label>
                <input type="text" name="full_name" required>
                
                <label>Телефон:</label>
                <input type="text" name="phone">
                
                <label>Адреса:</label>
                <textarea name="address" rows="3" style="width:100%; padding:8px;"></textarea>
                
                <label>Місто:</label>
                <input type="text" name="city">
                
                <label>Дата народження:</label>
                <input type="date" name="birth_date">
                
                <label>Стать:</label>
                <select name="gender">
                    <option value="other">Не вказано</option>
                    <option value="male">Чоловік</option>
                    <option value="female">Жінка</option>
                </select>
                
                <button type="submit" class="btn">Зареєструватися</button>
            </form>
            
            <a href="index.php" class="back-link">← Вже маєте акаунт? Увійти</a>
        </div>
    </div>
</body>
</html>