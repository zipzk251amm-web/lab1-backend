<?php
/**
 * Абстрактний клас Human - людина
 * 
 * Базовий клас для всіх людей
 * 
 * @package Lab4
 */
require_once 'interfaces/HouseCleaning.php';

abstract class Human implements HouseCleaning {
    /**
     * @var float $height Зріст (см)
     */
    private float $height;
    
    /**
     * @var float $weight Вага (кг)
     */
    private float $weight;
    
    /**
     * @var int $age Вік
     */
    private int $age;
    
    /**
     * Конструктор класу Human
     * 
     * @param float $height Зріст
     * @param float $weight Вага
     * @param int $age Вік
     */
    public function __construct(float $height, float $weight, int $age) {
        $this->height = $height;
        $this->weight = $weight;
        $this->age = $age;
    }
    
    // GET методи
    public function getHeight(): float { return $this->height; }
    public function getWeight(): float { return $this->weight; }
    public function getAge(): int { return $this->age; }
    
    // SET методи
    public function setHeight(float $height): void { $this->height = $height; }
    public function setWeight(float $weight): void { $this->weight = $weight; }
    public function setAge(int $age): void { $this->age = $age; }
    
    /**
     * Метод народження дитини
     * 
     * @return string
     */
    public function giveBirth(): string {
        return $this->childBirthMessage();
    }
    
    /**
     * Абстрактний метод повідомлення при народженні дитини
     * 
     * @return string
     */
    protected abstract function childBirthMessage(): string;
}