<?php
/**
 * Клас Student - студент
 * 
 * Успадковується від Human, додає властивості студента
 * 
 * @package Lab4
 */
require_once 'Human.php';

class Student extends Human {
    /**
     * @var string $university Назва ВНЗ
     */
    private string $university;
    
    /**
     * @var int $course Курс (1-6)
     */
    private int $course;
    
    /**
     * Конструктор класу Student
     * 
     * @param float $height Зріст
     * @param float $weight Вага
     * @param int $age Вік
     * @param string $university ВНЗ
     * @param int $course Курс
     */
    public function __construct(float $height, float $weight, int $age, string $university, int $course) {
        parent::__construct($height, $weight, $age);
        $this->university = $university;
        $this->course = $course;
    }
    
    // GET/SET для нових властивостей
    public function getUniversity(): string { return $this->university; }
    public function setUniversity(string $university): void { $this->university = $university; }
    public function getCourse(): int { return $this->course; }
    public function setCourse(int $course): void { $this->course = $course; }
    
    /**
     * Перевести студента на наступний курс
     * 
     * @return void
     */
    public function nextCourse(): void {
        $this->course++;
    }
    
    /**
     * Реалізація абстрактного методу
     * 
     * @return string
     */
    protected function childBirthMessage(): string {
        return "👶 Студент радіє народженню дитини! Вітання від студента!";
    }
    
    /**
     * Реалізація методу інтерфейсу HouseCleaning
     * 
     * @return string
     */
    public function cleanRoom(): string {
        return "🧹 Студент прибирає кімнату";
    }
    
    /**
     * Реалізація методу інтерфейсу HouseCleaning
     * 
     * @return string
     */
    public function cleanKitchen(): string {
        return "🍳 Студент прибирає кухню";
    }
}