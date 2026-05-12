<?php
// Підключаємо файл з функціями (правильний шлях)
include __DIR__ . '/../Function/func.php';

// Отримуємо дані з форми
$x = isset($_POST['x']) ? (float)$_POST['x'] : 0;
$y = isset($_POST['y']) ? (float)$_POST['y'] : 0;
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Результати обчислень</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: #f0f2f5;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        .input-values {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th {
            background: #3498db;
            color: white;
            padding: 12px;
            text-align: center;
        }
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
            margin-right: 15px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        button {
            background: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 5px;
        }
        button:hover {
            background: #2980b9;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Результати обчислень</h1>
        
        <div class="input-values">
            <strong>Вхідні дані:</strong> x = <?php echo $x; ?> &nbsp;&nbsp;|&nbsp;&nbsp; y = <?php echo $y; ?>
        </div>
        
        <?php if (function_exists('factorial') && function_exists('my_tg') && function_exists('my_sin') && function_exists('my_cos')): ?>
        <table>
            <thead>
                <tr>
                    <th>x!</th>
                    <th>y!</th>
                    <th>my_tg(x)</th>
                    <th>sin(x)</th>
                    <th>cos(x)</th>
                    <th>tg(x)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo number_format(factorial($x), 4, '.', ''); ?></td>
                    <td><?php echo number_format(factorial($y), 4, '.', ''); ?></td>
                    <td><?php echo number_format(my_tg($x), 10, '.', ''); ?></td>
                    <td><?php echo number_format(my_sin($x), 10, '.', ''); ?></td>
                    <td><?php echo number_format(my_cos($x), 10, '.', ''); ?></td>
                    <td><?php echo number_format(my_tan($x), 10, '.', ''); ?></td>
                </tr>
            </tbody>
        </table>
        <?php else: ?>
            <div class="error">
                <strong>❌ Помилка:</strong> Файл з функціями не підключено.<br>
                Перевірте, що файл <strong>Function/func.php</strong> існує.
            </div>
        <?php endif; ?>
        
        <div class="buttons">
            <a href="index.php" class="back-link">← Повернутися до форми</a>
            <a href="../index.php" class="back-link">← На головну лабораторної</a>
            <button onclick="window.print()">🖨️ Роздрукувати</button>
        </div>
    </div>
</body>
</html>