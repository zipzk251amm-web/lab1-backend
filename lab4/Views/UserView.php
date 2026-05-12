<?php
/**
 * Клас UserView - представлення користувача
 * 
 * Відповідає за відображення даних користувача
 * 
 * @package Views
 */
namespace Views;

class UserView {
    /**
     * Вивести дані користувача
     * 
     * @param array $userData Дані користувача
     * @return void
     */
    public function render(array $userData): void {
        echo "<div style='border:1px solid #ccc; padding:15px; margin:10px 0; border-radius:8px;'>";
        echo "<h3>Інформація про користувача</h3>";
        echo "<p><strong>Ім'я:</strong> " . htmlspecialchars($userData['name']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($userData['email']) . "</p>";
        echo "</div>";
    }
}