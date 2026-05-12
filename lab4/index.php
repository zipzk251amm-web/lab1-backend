<?php
/**
 * Головний файл лабораторної роботи №4
 * 
 * Перевірка всіх класів та методів
 */

// Підключення автозавантаження
require_once 'autoload.php';

echo "<!DOCTYPE html>";
echo "<html lang='uk'>";
echo "<head><meta charset='UTF-8'><title>Лабораторна робота №4 - ООП в PHP</title>";
echo "<style>
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 1200px; margin: 20px auto; padding: 20px; background: #f0f2f5; }
    .task { background: white; border-radius: 10px; padding: 20px; margin-bottom: 25px; border-left: 5px solid #3498db; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .task h2 { margin-top: 0; color: #2c3e50; }
    .output { background: #f8f9fa; padding: 15px; border-radius: 5px; font-family: monospace; }
    .success { color: green; font-weight: bold; }
    hr { margin: 20px 0; }
</style>";
echo "</head><body>";

echo "<h1>🧪 Лабораторна робота №4</h1>";
echo "<p><strong>Тема:</strong> Об'єктно-орієнтоване програмування в PHP</p>";
echo "<p><strong>Виконав:</strong> Андросович Максим</p>";
echo "<p><strong>Група:</strong> ЗІПЗк-25-1</p>";

// ==================== ЗАВДАННЯ 1-4 ====================
echo "<div class='task'>";
echo "<h2>📁 Завдання 1-4: Організація класів, автопідключення, неймспейси</h2>";
echo "<div class='output'>";

use Models\UserModel;
use Controllers\UserController;
use Views\UserView;

$userModel = new UserModel("Максим Андросович", "max@example.com");
$userController = new UserController($userModel);
$userView = new UserView();

echo "<strong>Результат роботи UserController:</strong><br>";
echo $userController->greet() . "<br><br>";

echo "<strong>Результат роботи UserView:</strong><br>";
$userView->render($userController->getUserData());

echo "</div></div>";

// ==================== ЗАВДАННЯ 5-6 ====================
echo "<div class='task'>";
echo "<h2>⚪ Завдання 5-6: Клас Circle (Get/Set, __toString, перетин кіл)</h2>";
echo "<div class='output'>";

$circle1 = new Circle(0, 0, 5);
$circle2 = new Circle(3, 4, 3);
$circle3 = new Circle(10, 10, 2);

echo "<strong>Об'єкт circle1:</strong> " . $circle1->__toString() . "<br>";
echo "<strong>Об'єкт circle2:</strong> " . $circle2->__toString() . "<br>";
echo "<strong>Об'єкт circle3:</strong> " . $circle3->__toString() . "<br><br>";

echo "<strong>Перевірка GET методів:</strong><br>";
echo "circle1: x={$circle1->getX()}, y={$circle1->getY()}, radius={$circle1->getRadius()}<br><br>";

echo "<strong>Перевірка SET методів:</strong><br>";
$circle1->setX(5);
$circle1->setY(5);
echo "Після зміни: " . $circle1->__toString() . "<br><br>";

echo "<strong>Перевірка перетину кіл:</strong><br>";
echo "circle1 та circle2 перетинаються? " . ($circle1->intersects($circle2) ? "✅ Так" : "❌ Ні") . "<br>";
echo "circle1 та circle3 перетинаються? " . ($circle1->intersects($circle3) ? "✅ Так" : "❌ Ні") . "<br>";

echo "</div></div>";

// ==================== ЗАВДАННЯ 7 ====================
echo "<div class='task'>";
echo "<h2>📄 Завдання 7: Статичні методи (читання/запис/очищення файлів)</h2>";
echo "<div class='output'>";

// Перевірка існування папки text
if (!is_dir('text')) {
    mkdir('text', 0777, true);
}

echo "<strong>Список файлів в директорії 'text/':</strong><br>";
echo implode(", ", FileManager::listFiles()) . "<br><br>";

echo "<strong>Запис в файл file1.txt:</strong><br>";
FileManager::writeToFile('file1.txt', "Новий запис: " . date('Y-m-d H:i:s'));
echo "✅ Дані дописано<br><br>";

echo "<strong>Читання файлу file1.txt:</strong><br>";
echo "<pre>" . FileManager::readFromFile('file1.txt') . "</pre>";

echo "<strong>Очищення файлу file2.txt:</strong><br>";
FileManager::clearFile('file2.txt');
echo "✅ Вміст файлу file2.txt очищено<br><br>";

echo "<strong>Читання файлу file2.txt після очищення:</strong><br>";
echo "<pre>" . (FileManager::readFromFile('file2.txt') ?: "(порожньо)") . "</pre>";

echo "</div></div>";

// ==================== ЗАВДАННЯ 8-10 ====================
echo "<div class='task'>";
echo "<h2>👨‍🎓 Завдання 8-10: Наслідування, абстрактний клас, інтерфейси</h2>";
echo "<div class='output'>";

// Створення об'єктів Student та Programmer
$student = new Student(175, 65, 20, "Житомирська Політехніка", 2);
$programmer = new Programmer(180, 75, 25, ["PHP", "JavaScript", "Python"], 3);

echo "<strong>=== СТУДЕНТ ===</strong><br>";
echo "ВНЗ: " . $student->getUniversity() . "<br>";
echo "Курс: " . $student->getCourse() . "<br>";
$student->nextCourse();
echo "Переведено на курс: " . $student->getCourse() . "<br>";
echo "Зріст: " . $student->getHeight() . " см<br>";
echo "Вага: " . $student->getWeight() . " кг<br>";
echo "Вік: " . $student->getAge() . " років<br>";
echo "Прибирання: " . $student->cleanRoom() . "<br>";
echo "Прибирання: " . $student->cleanKitchen() . "<br>";
echo "Народження дитини: " . $student->giveBirth() . "<br><br>";

echo "<strong>=== ПРОГРАМІСТ ===</strong><br>";
echo "Мови програмування: " . implode(", ", $programmer->getLanguages()) . "<br>";
$programmer->addLanguage("C++");
echo "Після додавання: " . implode(", ", $programmer->getLanguages()) . "<br>";
echo "Досвід: " . $programmer->getExperience() . " роки<br>";
echo "Зріст: " . $programmer->getHeight() . " см<br>";
echo "Вага: " . $programmer->getWeight() . " кг<br>";
echo "Вік: " . $programmer->getAge() . " років<br>";
echo "Прибирання: " . $programmer->cleanRoom() . "<br>";
echo "Прибирання: " . $programmer->cleanKitchen() . "<br>";
echo "Народження дитини: " . $programmer->giveBirth() . "<br>";

echo "</div></div>";

echo "<hr>";
echo "<p style='text-align: center;'>✅ Лабораторну роботу №4 виконано</p>";
echo "<p style='text-align: center;'><a href='../'>← Повернутися до головної сторінки</a></p>";

echo "</body></html>";