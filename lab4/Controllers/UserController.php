<?php
/**
 * Клас UserController - контролер користувача
 * 
 * Обробляє запити та взаємодіє між моделлю та представленням
 * 
 * @package Controllers
 */
namespace Controllers;

use Models\UserModel;

class UserController {
    /**
     * @var UserModel $model Модель користувача
     */
    private UserModel $model;
    
    /**
     * Конструктор класу UserController
     * 
     * @param UserModel $model Модель користувача
     */
    public function __construct(UserModel $model) {
        $this->model = $model;
    }
    
    /**
     * Отримати дані користувача
     * 
     * @return array
     */
    public function getUserData(): array {
        return $this->model->getUserData();
    }
    
    /**
     * Вивести привітання
     * 
     * @return string
     */
    public function greet(): string {
        return "Вітаю, " . $this->model->getName() . "!";
    }
}