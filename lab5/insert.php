<?php
require_once 'config.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $cost = floatval($_POST['cost']);
    $quantity = intval($_POST['quantity']);
    $date_added = $_POST['date_added'];
    $description = trim($_POST['description']);
    
    if (empty($name) || $cost <= 0 || $quantity <= 0) {
        $error = "Заповніть всі обов'язкові поля коректно!";
    } else {
        // Використання prepare з плейсхолдерами
        $stmt = $pdo->prepare("INSERT INTO tov (name, cost, quantity, date_added, description) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt->execute([$name, $cost, $quantity, $date_added, $description])) {
            $success = "Товар успішно додано! ID нового товару: " . $pdo->lastInsertId();
        } else {
            $error = "Помилка при додаванні товару.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Додати товар</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; }
        .card { background: white; border-radius: 10px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #667eea; }
        input, textarea { width: 100%; padding: 10px; margin: 8px 0 15px; border: 1px solid #ddd; border-radius: 5px; }
        label { font-weight: bold; }
        .btn { width: 100%; padding: 10px; background: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .btn:hover { opacity: 0.9; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .back-link { display: block; text-align: center; margin-top: 20px; color: #667eea; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>➕ Додати новий товар</h1>
            
            <?php if ($success): ?>
                <div class="success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="post">
                <label>* Назва товару:</label>
                <input type="text" name="name" required>
                
                <label>* Вартість (грн):</label>
                <input type="number" step="0.01" name="cost" required>
                
                <label>* Кількість:</label>
                <input type="number" name="quantity" required>
                
                <label>* Дата додавання:</label>
                <input type="date" name="date_added" value="<?php echo date('Y-m-d'); ?>" required>
                
                <label>Опис:</label>
                <textarea name="description" rows="4"></textarea>
                
                <button type="submit" class="btn">💾 Зберегти товар</button>
            </form>
            
            <a href="tov_index.php" class="back-link">← Назад до списку товарів</a>
        </div>
    </div>
</body>
</html>