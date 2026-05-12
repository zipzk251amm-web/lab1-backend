<?php
/**
 * Файл автопідключення класів
 * 
 * Використовує spl_autoload_register для автоматичного завантаження класів
 * з урахуванням неймспейсів та директорій
 */

spl_autoload_register(function ($className) {
    // Мапінг неймспейсів на директорії
    $prefixToDir = [
        'Models\\' => __DIR__ . '/Models/',
        'Controllers\\' => __DIR__ . '/Controllers/',
        'Views\\' => __DIR__ . '/Views/',
    ];
    
    // Прохід по всіх префіксах
    foreach ($prefixToDir as $prefix => $dir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $className, $len) === 0) {
            $relativeClass = substr($className, $len);
            $file = $dir . str_replace('\\', '/', $relativeClass) . '.php';
            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }
    
    // Якщо клас без неймспейсу (для завдань 5-10)
    $directories = [__DIR__, __DIR__ . '/Models', __DIR__ . '/Controllers', __DIR__ . '/Views'];
    foreach ($directories as $dir) {
        $file = $dir . '/' . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});