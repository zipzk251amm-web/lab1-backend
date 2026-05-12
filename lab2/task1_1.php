<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 1.1 – заміна символів</title>
</head>
<body>
    <h2>Заміна символів у рядку</h2>
    <form method="post">
        <label>Текст:</label><br>
        <input type="text" name="text" size="50" value="<?php echo $_POST['text'] ?? ''; ?>"><br><br>
        <label>Знайти:</label><br>
        <input type="text" name="find" value="<?php echo $_POST['find'] ?? ''; ?>"><br><br>
        <label>Замінити на:</label><br>
        <input type="text" name="replace" value="<?php echo $_POST['replace'] ?? ''; ?>"><br><br>
        <input type="submit" value="Виконати заміну">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'], $_POST['find'], $_POST['replace'])) {
        $text = $_POST['text'];
        $find = $_POST['find'];
        $replace = $_POST['replace'];
        $result = str_replace($find, $replace, $text);
        echo "<h3>Результат:</h3>";
        echo "<textarea rows='5' cols='50'>$result</textarea>";
    }
    ?>
</body>
</html>