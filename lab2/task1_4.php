<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Різниця між датами</title>
</head>
<body>
    <h2>Кількість днів між датами (формат День-Місяць-Рік)</h2>
    <form method="post">
        Дата 1: <input type="text" name="date1" placeholder="10-02-2015"><br><br>
        Дата 2: <input type="text" name="date2" placeholder="15-03-2015"><br><br>
        <input type="submit" value="Розрахувати">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['date1']) && !empty($_POST['date2'])) {
        $date1 = DateTime::createFromFormat('d-m-Y', $_POST['date1']);
        $date2 = DateTime::createFromFormat('d-m-Y', $_POST['date2']);
        if ($date1 && $date2) {
            $diff = $date1->diff($date2);
            echo "<h3>Різниця: {$diff->days} днів</h3>";
        } else {
            echo "Невірний формат дати. Використовуйте ДД-ММ-РРРР";
        }
    }
    ?>
</body>
</html>