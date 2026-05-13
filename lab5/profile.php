<?php
require_once 'config.php';

// Перевірка авторизації
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success = '';
$error = '';

// Отримуємо дані користувача
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $full_name = trim($_POST['full_name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    
    // Оновлення даних
    $updateStmt = $pdo->prepare("UPDATE users SET email=?, full_name=?, phone=?, address=?, city=?, birth_date=?, gender=? WHERE id=?");
    
    if ($updateStmt->execute([$email, $full_name, $phone, $address, $city, $birth_date, $gender, $user_id])) {
        $success = "Дані успішно оновлено!";
        $_SESSION['user_name'] = $full_name;
        // Оновлюємо дані
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();
    } else {
        $error = "Помилка при оновленні даних.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Редагування профілю</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        .card { background: white; border-radius: 10px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #667eea; }
        input, select, textarea { width: 100%; padding: 10px; margin: 8px 0 15px; border: 1px solid #ddd; border-radius: 5px; }
        label { font-weight: bold; }
        .btn { padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .btn-danger { background: #e74c3c; }
        .btn-warning { background: #f39c12; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .menu { margin-top: 20px; display: flex; gap: 10px; justify-content: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>✏️ Редагування профілю</h1>
            
            <?php if ($success): ?>
                <div class="success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="post">
                <label>Логін:</label>
                <input type="text" value="<?php echo htmlspecialchars($user['login']); ?>" disabled>
                
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                
                <label>ПІБ:</label>
                <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                
                <label>Телефон:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                
                <label>Адреса:</label>
                <textarea name="address" rows="3"><?php echo htmlspecialchars($user['address']); ?></textarea>
                
                <label>Місто:</label>
                <input type="text" name="city" value="<?php echo htmlspecialchars($user['city']); ?>">
                
                <label>Дата народження:</label>
                <input type="date" name="birth_date" value="<?php echo $user['birth_date']; ?>">
                
                <label>Стать:</label>
                <select name="gender">
                    <option value="other" <?php echo $user['gender'] == 'other' ? 'selected' : ''; ?>>Не вказано</option>
                    <option value="male" <?php echo $user['gender'] == 'male' ? 'selected' : ''; ?>>Чоловік</option>
                    <option value="female" <?php echo $user['gender'] == 'female' ? 'selected' : ''; ?>>Жінка</option>
                </select>
                
                <button type="submit" class="btn">💾 Зберегти зміни</button>
            </form>
            
            <div class="menu">
                <a href="delete_profile.php" class="btn btn-danger" onclick="return confirm('Видалити профіль? Цю дію не можна скасувати!')">🗑️ Видалити профіль</a>
                <a href="index.php" class="btn">🏠 На головну</a>
            </div>
        </div>
    </div>
</body>
</html>