<?php
session_start();
$lang = $_GET['lang'] ?? $_COOKIE['lang'] ?? 'ukr';
setcookie('lang', $lang, time() + 180*86400, '/');

$texts = [
    'ukr' => [
        'Вибрана мова: Українська', 'Логін', 'Пароль', 'Підтвердження', 'Стать', 
        'Чоловік', 'Жінка', 'Місто', 'Улюблені ігри', 'Про себе', 'Фотографія', 
        'Зареєструватися', 'Файл не вибрано', 'Лабораторна робота №2', 
        'Робота з рядками', 'Робота з масивами', 'Головна форма реєстрації',
        'Завдання 4: Математичні функції'
    ],
    'eng' => [
        'Language: English', 'Login', 'Password', 'Confirm', 'Gender', 
        'Male', 'Female', 'City', 'Favorite games', 'About', 'Photo', 
        'Register', 'No file chosen', 'Laboratory work #2',
        'Working with strings', 'Working with arrays', 'Main registration form',
        'Task 4: Mathematical functions'
    ]
];
$t = $texts[$lang];
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?php echo $t[13]; ?></title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 1200px; margin: 20px auto; padding: 20px; background: #f0f2f5; }
        .menu { background: white; border-radius: 10px; padding: 20px; margin-bottom: 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .menu h2 { color: #2c3e50; margin-top: 0; }
        .menu h3 { color: #3498db; margin-top: 0; }
        .menu-links { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px; }
        .menu-links a { background: #3498db; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; }
        .menu-links a:hover { background: #2980b9; }
        .lang-icons { text-align: right; margin-bottom: 20px; }
        .lang-icons a { margin-left: 10px; text-decoration: none; }
        form { max-width: 600px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        input, select, textarea { display: block; margin: 10px 0 20px 0; width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        input[type="radio"], input[type="checkbox"] { display: inline-block; width: auto; margin-right: 10px; }
        .radio-group, .checkbox-group { margin: 10px 0; }
        .radio-group label, .checkbox-group label { margin-right: 20px; }
        button { background: #3498db; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #2980b9; }
    </style>
</head>
<body>
    <div class="lang-icons">
        <a href="?lang=ukr"><img src="https://flagcdn.com/ua.svg" width="30" alt="UA"> 🇺🇦 УКР</a>
        <a href="?lang=eng"><img src="https://flagcdn.com/gb.svg" width="30" alt="EN"> 🇬🇧 ENG</a>
        <p><strong><?php echo $t[0]; ?></strong></p>
    </div>

    <!-- ========== МЕНЮ ЗАВДАНЬ ========== -->
    <div class="menu">
        <h2>📚 <?php echo $t[13]; ?></h2>
        
        <!-- Завдання 1: Рядки -->
        <h3>📝 <?php echo $t[14]; ?></h3>
        <div class="menu-links">
            <a href="task1_1.php">1.1 🔄 Заміна символів</a>
            <a href="task1_2.php">1.2 🏙️ Сортування міст</a>
            <a href="task1_3.php">1.3 📄 Ім'я файлу без розширення</a>
            <a href="task1_4.php">1.4 📅 Різниця між датами</a>
            <a href="task1_5.php">1.5 🔐 Генератор паролів</a>
        </div>
        
        <!-- Завдання 2: Масиви -->
        <h3>📊 <?php echo $t[15]; ?></h3>
        <div class="menu-links">
            <a href="task2_1.php">2.1 🔁 Повторювані елементи</a>
            <a href="task2_2.php">2.2 🐾 Генератор імен для тваринки</a>
            <a href="task2_3.php">2.3 🔢 Створення та обробка масивів</a>
            <a href="task2_4.php">2.4 📋 Сортування асоціативного масиву</a>
        </div>
        
        <!-- Завдання 4: Функції -->
        <h3>📐 <?php echo $t[17]; ?></h3>
        <div class="menu-links">
            <a href="task4/index.php" style="background: #6c5ce7;">🧮 Обчислення sin, cos, tg, факторіал</a>
        </div>
    </div>

    <!-- ========== ФОРМА РЕЄСТРАЦІЇ (Завдання 3) ========== -->
    <div class="menu">
        <h3>📋 <?php echo $t[16]; ?></h3>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <?php
            $data = $_SESSION['form_data'] ?? [];
            $gamesList = ['Футбол', 'Баскетбол', 'Волейбол', 'Шахи', 'World of Tanks'];
            ?>
            
            <label><?php echo $t[1]; ?>:</label>
            <input type="text" name="login" value="<?php echo htmlspecialchars($data['login'] ?? ''); ?>">
            
            <label><?php echo $t[2]; ?>:</label>
            <input type="password" name="password">
            
            <label><?php echo $t[3]; ?>:</label>
            <input type="password" name="confirm_password">
            
            <label><?php echo $t[4]; ?>:</label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="male" <?php echo ($data['gender'] ?? '') == 'male' ? 'checked' : ''; ?>> <?php echo $t[5]; ?></label>
                <label><input type="radio" name="gender" value="female" <?php echo ($data['gender'] ?? '') == 'female' ? 'checked' : ''; ?>> <?php echo $t[6]; ?></label>
            </div>
            
            <label><?php echo $t[7]; ?>:</label>
            <input type="text" name="city" value="<?php echo htmlspecialchars($data['city'] ?? ''); ?>">
            
            <label><?php echo $t[8]; ?>:</label>
            <div class="checkbox-group">
                <?php foreach ($gamesList as $game): ?>
                    <label><input type="checkbox" name="games[]" value="<?php echo $game; ?>" <?php echo (in_array($game, $data['games'] ?? []) ? 'checked' : ''); ?>> <?php echo $game; ?></label>
                <?php endforeach; ?>
            </div>
            
            <label><?php echo $t[9]; ?>:</label>
            <textarea name="about" rows="5"><?php echo htmlspecialchars($data['about'] ?? ''); ?></textarea>
            
            <label><?php echo $t[10]; ?>:</label>
            <input type="file" name="photo">
            
            <button type="submit"><?php echo $t[11]; ?></button>
        </form>
    </div>
</body>
</html>