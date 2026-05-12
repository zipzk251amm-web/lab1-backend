<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['form_data'] = [
        'login' => $_POST['login'] ?? '',
        'gender' => $_POST['gender'] ?? '',
        'city' => $_POST['city'] ?? '',
        'games' => $_POST['games'] ?? [],
        'about' => $_POST['about'] ?? ''
    ];
    echo "<h2>Дані форми</h2>";
    echo "Логін: {$_POST['login']}<br>";
    echo "Пароль: " . (strlen($_POST['password']??'') . " символів") . "<br>";
    echo "Стать: {$_POST['gender']}<br>";
    echo "Місто: {$_POST['city']}<br>";
    echo "Ігри: " . implode(', ', $_POST['games']??[]) . "<br>";
    echo "Про себе: " . nl2br(htmlspecialchars($_POST['about']??'')) . "<br>";
    if ($_FILES['photo']['error'] === 0) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir);
        $filename = time() . '_' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $filename);
        echo "Фото: <img src='$uploadDir$filename' width='200'><br>";
    }
    echo '<a href="index.php">Повернутися на головну</a>';
} else {
    header('Location: index.php');
}
?>