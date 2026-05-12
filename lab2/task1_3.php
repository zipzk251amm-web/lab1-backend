<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Ім’я файлу</title>
</head>
<body>
    <h2>Виділення імені файлу без розширення</h2>
    <form method="post">
        <input type="text" name="filepath" size="60" placeholder="D:\WebServers\home\testsite\www\myfile.txt">
        <input type="submit" value="Виділити">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['filepath'])) {
        $path = $_POST['filepath'];
        $filename = basename($path);
        $nameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
        echo "<h3>Ім’я файлу без розширення:</h3> $nameWithoutExt";
    }
    ?>
</body>
</html>