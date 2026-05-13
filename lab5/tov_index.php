<?php
require_once 'config.php';

// Отримуємо всі товари
$sql = "SELECT * FROM tov ORDER BY id";
$result = $pdo->query($sql);
$tovars = $result->fetchAll();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Товари - Лабораторна робота №5</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .card { background: white; border-radius: 10px; padding: 25px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #667eea; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #667eea; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
        .btn { display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin: 5px; border: none; cursor: pointer; }
        .btn-danger { background: #e74c3c; }
        .btn-success { background: #27ae60; }
        .form-inline { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin-top: 20px; }
        .form-inline input { padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>📦 Таблиця товарів</h1>
            
            <table>
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Назва товару</th>
                        <th>Вартість (грн)</th>
                        <th>Кількість</th>
                        <th>Дата</th>
                        <th>Опис</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tovars as $row): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo $row['cost']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['date_added']; ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="form-inline">
                <form action="delete.php" method="post" style="display: flex; gap: 10px; align-items: center;">
                    <input type="number" name="id" placeholder="Введіть № запису" required>
                    <button type="submit" class="btn btn-danger">🗑️ Вилучити запис</button>
                </form>
                <a href="insert.php" class="btn btn-success">➕ Додати запис</a>
                <a href="index.php" class="btn">🏠 На головну</a>
            </div>
        </div>
    </div>
</body>
</html>