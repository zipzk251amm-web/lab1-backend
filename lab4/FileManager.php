<?php
/**
 * Клас FileManager - робота з файлами
 * 
 * Статичні методи для читання, запису та видалення вмісту файлів
 * 
 * @package Lab4
 */
class FileManager {
    /**
     * @var string $dir Директорія для роботи з файлами
     */
    public static string $dir = "text";
    
    /**
     * Запис рядка в файл (дописування в кінець)
     * 
     * @param string $filename Ім'я файлу
     * @param string $content Рядок для запису
     * @return bool true успішно, false помилка
     */
    public static function writeToFile(string $filename, string $content): bool {
        $fullPath = self::$dir . '/' . $filename;
        return file_put_contents($fullPath, $content . PHP_EOL, FILE_APPEND | LOCK_EX) !== false;
    }
    
    /**
     * Читання вмісту файлу
     * 
     * @param string $filename Ім'я файлу
     * @return string Вміст файлу або повідомлення про помилку
     */
    public static function readFromFile(string $filename): string {
        $fullPath = self::$dir . '/' . $filename;
        if (file_exists($fullPath)) {
            return file_get_contents($fullPath);
        }
        return "Файл не знайдено: " . $filename;
    }
    
    /**
     * Очищення вмісту файлу
     * 
     * @param string $filename Ім'я файлу
     * @return bool true успішно, false помилка
     */
    public static function clearFile(string $filename): bool {
        $fullPath = self::$dir . '/' . $filename;
        if (file_exists($fullPath)) {
            return file_put_contents($fullPath, '') !== false;
        }
        return false;
    }
    
    /**
     * Отримати список всіх файлів в директорії
     * 
     * @return array
     */
    public static function listFiles(): array {
        $fullPath = self::$dir;
        return array_diff(scandir($fullPath), ['..', '.']);
    }
}