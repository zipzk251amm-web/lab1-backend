<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Сортування міст</title>
</head>
<body>
    <h2>Введіть назви міст через пробіл</h2>
    <form method="post">
        <input type="text" name="cities" size="50">
        <input type="submit" value="Впорядкувати">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['cities'])) {
        $cities = explode(' ', $_POST['cities']);
        sort($cities);
        echo "<h3>Відсортовані міста:</h3>";
        echo implode(', ', $cities);
    }
    ?>
</body>
</html>