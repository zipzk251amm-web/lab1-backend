<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Генератор паролів</title>
</head>
<body>
    <h2>Генератор паролів</h2>
    <form method="post">
        Довжина пароля: <input type="number" name="length" min="1" max="50" value="8"><br><br>
        <input type="submit" name="generate" value="Згенерувати пароль">
    </form>

    <?php
    function generatePassword($length) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+';
        return substr(str_shuffle($chars), 0, $length);
    }

    function isStrongPassword($password) {
        return strlen($password) >= 8 &&
               preg_match('/[A-Z]/', $password) &&
               preg_match('/[a-z]/', $password) &&
               preg_match('/[0-9]/', $password) &&
               preg_match('/[!@#$%^&*()_+]/', $password);
    }

    if (isset($_POST['generate'])) {
        $password = generatePassword((int)$_POST['length']);
        $strength = isStrongPassword($password) ? "Міцний" : "Слабкий";
        echo "<h3>Згенерований пароль: $password</h3>";
        echo "<p>Оцінка: $strength</p>";
    }
    ?>
</body>
</html>