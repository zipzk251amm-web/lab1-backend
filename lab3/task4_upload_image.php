<?php
$uploadDir = __DIR__ . '/uploads/';
$message = '';

// Створюємо папку для завантажень, якщо її немає
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Обробка завантаження файлу
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $fileName = basename($file['name']);
    $targetPath = $uploadDir . time() . '_' . $fileName; // Додаємо час, щоб уникнути дублікатів
    
    // Перевірка, чи це дійсно зображення
    $check = getimagesize($file['tmp_name']);
    if ($check !== false) {
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $message = '<p style="color:green;">✅ Файл успішно завантажено!</p>';
        } else {
            $message = '<p style="color:red;">❌ Помилка при збереженні файлу.</p>';
        }
    } else {
        $message = '<p style="color:red;">❌ Файл не є зображенням.</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 4: Завантаження зображень</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; }
        form { background: #f4f4f4; padding: 20px; border-radius: 8px; }
        input, button { margin: 10px 0; }
        .image-gallery { display: flex; flex-wrap: wrap; gap: 15px; margin-top: 20px; }
        .image-item { border: 1px solid #ddd; padding: 10px; border-radius: 5px; text-align: center; }
        img { max-width: 150px; max-height: 150px; }
    </style>
</head>
<body>
    <h1>🖼️ Завантаження зображень</h1>
    <?php echo $message; ?>
    
    <form method="post" enctype="multipart/form-data">
        <label>Оберіть зображення для завантаження:</label>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">📤 Завантажити</button>
    </form>
    
    <h2>📂 Завантажені зображення</h2>
    <div class="image-gallery">
        <?php
        $images = glob($uploadDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        foreach ($images as $image) {
            $imageUrl = 'uploads/' . basename($image);
            echo "<div class='image-item'><img src='{$imageUrl}' alt='image'><br><small>" . basename($image) . "</small></div>";
        }
        if (empty($images)) echo "<p>Ще немає завантажених зображень.</p>";
        ?>
    </div>
    <p><a href="../index.php">← Повернутися до меню лабораторних</a></p>
</body>
</html>