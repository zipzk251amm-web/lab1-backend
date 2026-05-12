<?php
// ============================================
// ЛАБОРАТОРНА РОБОТА №1
// Тема: Базові конструкції мови PHP
// ============================================
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторна робота №1 - Backend розробка</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f0f2f5;
        }
        .task {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 5px solid #3498db;
        }
        .task h2 {
            margin-top: 0;
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .output {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 16px;
        }
        table {
            border-collapse: collapse;
            margin: 10px 0;
        }
        td {
            width: 60px;
            height: 60px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #333;
        }
        .square-container {
            background-color: black;
            min-height: 500px;
            position: relative;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
        }
        .random-square {
            position: absolute;
            background-color: red;
        }
        .code-note {
            background: #e8f4fd;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 14px;
            color: #0066cc;
        }
    </style>
</head>
<body>
    <h1>🧪 Лабораторна робота №1</h1>
    <p><strong>Тема:</strong> Базові конструкції мови PHP</p>
    <p><strong>Студент(ка):</strong> ______________________</p>

    <!-- ==================== ЗАВДАННЯ 2 ==================== -->
    <div class="task">
        <h2>📝 Завдання 2: Виведення вірша</h2>
        <div class="output">
            <?php
                echo "Полину в мріях в купель океану,<br>";
                echo "Відчую шовковистість глибини,<br>";
                echo "Чарівні мушлі з дна собі дістану,<br>";
                echo "&nbsp;&nbsp;Щоб взимку<br>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;тішили<br>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;мене<br>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;вони…<br>";
            ?>
        </div>
        <div class="code-note">
            💡 Використано: echo для виведення тексту, HTML-тег br для переносу рядків.
        </div>
    </div>

    <!-- ==================== ЗАВДАННЯ 3 ==================== -->
    <div class="task">
        <h2>💰 Завдання 3: Конвертація гривень у долари</h2>
        <div class="output">
            <?php
                $grn = 1500;           // сума в гривнях (задаємо програмно)
                $rate = 41.5;          // курс долара (можна змінити)
                $usd = floor($grn / $rate);  // округлюємо до цілих
                
                echo "<strong>$grn грн.</strong> можна обміняти на <strong>$usd долар</strong> (курс: $rate грн/долар)";
            ?>
        </div>
        <div class="code-note">
            💡 Використано: змінні ($grn, $rate, $usd), математична операція (/), функція floor().
        </div>
    </div>

    <!-- ==================== ЗАВДАННЯ 4 ==================== -->
    <div class="task">
        <h2>🌤️ Завдання 4: Визначення сезону за номером місяця (if-else)</h2>
        <div class="output">
            <?php
                $month = 11;  // задаємо номер місяця (1-12)
                
                if ($month >= 3 && $month <= 5) {
                    $season = "🌱 Весна";
                } elseif ($month >= 6 && $month <= 8) {
                    $season = "☀️ Літо";
                } elseif ($month >= 9 && $month <= 11) {
                    $season = "🍂 Осінь";
                } else {
                    $season = "❄️ Зима";
                }
                
                echo "Місяць № <strong>$month</strong> — це <strong>$season</strong>";
            ?>
        </div>
        <div class="code-note">
            💡 Використано: конструкція if-else, логічні оператори (&&).
        </div>
    </div>

    <!-- ==================== ЗАВДАННЯ 5 ==================== -->
    <div class="task">
        <h2>🔤 Завдання 5: Голосна чи приголосна (switch)</h2>
        <div class="output">
            <?php
                $letter = 'a';  // задаємо літеру (a, b, c, ...)
                $vowels = ['a', 'e', 'i', 'o', 'u', 'y', 'а', 'е', 'є', 'и', 'і', 'ї', 'о', 'у', 'ю', 'я'];
                
                // Перевіряємо, чи є буква голосною
                $isVowel = false;
                foreach ($vowels as $vowel) {
                    if (strtolower($letter) == $vowel) {
                        $isVowel = true;
                        break;
                    }
                }
                
                switch ($isVowel) {
                    case true:
                        $result = "літера '<strong>$letter</strong>' — це <span style='color:green'>ГОЛОСНА</span>";
                        break;
                    case false:
                        $result = "літера '<strong>$letter</strong>' — це <span style='color:blue'>ПРИГОЛОСНА</span>";
                        break;
                }
                
                echo $result;
            ?>
        </div>
        <div class="code-note">
            💡 Використано: конструкція switch, масив, цикл foreach.
        </div>
    </div>

    <!-- ==================== ЗАВДАННЯ 6 ==================== -->
    <div class="task">
        <h2>🔢 Завдання 6: Робота з тризначним числом</h2>
        <div class="output">
            <?php
                // Генеруємо випадкове тризначне число від 100 до 999
                $number = mt_rand(100, 999);
                
                // Отримуємо цифри числа
                $digits = str_split($number);
                $hundreds = $digits[0];  // сотні
                $tens = $digits[1];       // десятки
                $units = $digits[2];      // одиниці
                
                // 1. Сума цифр
                $sum = $hundreds + $tens + $units;
                
                // 2. Число в зворотному порядку
                $reversed = $units . $tens . $hundreds;
                
                // 3. Найбільше можливе число (сортуємо цифри за спаданням)
                $sortedDigits = [$hundreds, $tens, $units];
                rsort($sortedDigits);
                $maxNumber = implode('', $sortedDigits);
                
                echo "<strong>Початкове число:</strong> $number<br>";
                echo "<strong>📌 1. Сума цифр:</strong> $hundreds + $tens + $units = $sum<br>";
                echo "<strong>🔄 2. Число у зворотному порядку:</strong> $reversed<br>";
                echo "<strong>📈 3. Найбільше можливе число:</strong> $maxNumber<br>";
            ?>
        </div>
        <div class="code-note">
            💡 Використано: mt_rand(), str_split(), rsort(), implode().
        </div>
    </div>

    <!-- ==================== ЗАВДАННЯ 7 (перша частина) ==================== -->
    <div class="task">
        <h2>🎨 Завдання 7.1: Таблиця різнокольорових комірок</h2>
        <div class="output">
            <?php
                function drawColorTable($rows, $cols) {
                    echo "<table>\n";
                    for ($i = 0; $i < $rows; $i++) {
                        echo "<tr>\n";
                        for ($j = 0; $j < $cols; $j++) {
                            // Генеруємо випадковий колір
                            $r = mt_rand(0, 255);
                            $g = mt_rand(0, 255);
                            $b = mt_rand(0, 255);
                            $color = "rgb($r, $g, $b)";
                            echo "<td style='background-color: $color;'></td>\n";
                        }
                        echo "</tr>\n";
                    }
                    echo "</table>\n";
                }
                
                // Викликаємо функцію з параметрами
                $rows = 5;
                $cols = 6;
                echo "<p>Таблиця розміром <strong>{$rows}x{$cols}</strong> з випадковими кольорами:</p>";
                drawColorTable($rows, $cols);
            ?>
        </div>
        <div class="code-note">
            💡 Використано: функція (function), вкладені цикли (for), mt_rand() для кольорів.
        </div>
    </div>

    <!-- ==================== ЗАВДАННЯ 7 (друга частина) ==================== -->
    <div class="task">
        <h2>🟥 Завдання 7.2: Червоні квадрати на чорному тлі</h2>
        <div class="output">
            <?php
                function drawRandomSquares($n) {
                    echo '<div class="square-container" style="position: relative; height: 500px; background-color: black;">';
                    
                    for ($i = 0; $i < $n; $i++) {
                        // Випадковий розмір квадрата (від 20 до 100 пікселів)
                        $size = mt_rand(30, 100);
                        
                        // Випадкова позиція (від 0 до 95% щоб не виходив за межі)
                        $top = mt_rand(0, 90);
                        $left = mt_rand(0, 90);
                        
                        echo "<div style='
                            position: absolute;
                            top: {$top}%;
                            left: {$left}%;
                            width: {$size}px;
                            height: {$size}px;
                            background-color: red;
                            margin-top: -" . ($size/2) . "px;
                            margin-left: -" . ($size/2) . "px;
                        '></div>";
                    }
                    
                    echo '</div>';
                }
                
                $numberOfSquares = 8;
                echo "<p>Виведено <strong>$numberOfSquares</strong> червоних квадратів випадкового розміру та положення:</p>";
                drawRandomSquares($numberOfSquares);
            ?>
        </div>
        <div class="code-note">
            💡 Використано: CSS позиціонування (absolute), mt_rand() для розміру та позиції.
        </div>
    </div>
</body>
</html>