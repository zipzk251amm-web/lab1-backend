<?php
/**
 * Клас UserModel - модель користувача
 * 
 * Відповідає за роботу з даними користувача
 * 
 * @package Models
 */
namespace Models;

class UserModel {
    /**
     * @var string $name Ім'я користувача
     */
    private string $name;
    
    /**
     * @var string $email Email користувача
     */
    private string $email;
    
    /**
     * Конструктор класу UserModel
     * 
     * @param string $name Ім'я користувача
     * @param string $email Email користувача
     */
    public function __construct(string $name = "Гість", string $email = "guest@example.com") {
        $this->name = $name;
        $this->email = $email;
    }
    
    /**
     * Отримати ім'я користувача
     * 
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }
    
    /**
     * Отримати email користувача
     * 
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }
    
    /**
     * Отримати дані користувача у вигляді масиву
     * 
     * @return array
     */
    public function getUserData(): array {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}