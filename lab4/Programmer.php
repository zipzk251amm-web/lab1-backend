<?php
/**
 * Клас Programmer - програміст
 * 
 * Успадковується від Human, додає властивості програміста
 * 
 * @package Lab4
 */
require_once 'Human.php';

class Programmer extends Human {
    /**
     * @var array $languages Масив мов програмування
     */
    private array $languages;
    
    /**
     * @var int $experience Досвід роботи (років)
     */
    private int $experience;
    
    /**
     * Конструктор класу Programmer
     * 
     * @param float $height Зріст
     * @param float $weight Вага
     * @param int $age Вік
     * @param array $languages Мови програмування
     * @param int $experience Досвід
     */
    public function __construct(float $height, float $weight, int $age, array $languages, int $experience) {
        parent::__construct($height, $weight, $age);
        $this->languages = $languages;
        $this->experience = $experience;
    }
    
    // GET/SET для нових властивостей
    public function getLanguages(): array { return $this->languages; }
    public function setLanguages(array $languages): void { $this->languages = $languages; }
    public function getExperience(): int { return $this->experience; }
    public function setExperience(int $experience): void { $this->experience = $experience; }
    
    /**
     * Додати мову програмування
     * 
     * @param string $language Мова
     * @return void
     */
    public function addLanguage(string $language): void {
        if (!in_array($language, $this->languages)) {
            $this->languages[] = $language;
        }
    }
    
    /**
     * Реалізація абстрактного методу
     * 
     * @return string
     */
    protected function childBirthMessage(): string {
        return "👶 Програміст пише код для новонародженого! Вітання від програміста!";
    }
    
    /**
     * Реалізація методу інтерфейсу HouseCleaning
     * 
     * @return string
     */
    public function cleanRoom(): string {
        return "🧹 Програміст прибирає кімнату";
    }
    
    /**
     * Реалізація методу інтерфейсу HouseCleaning
     * 
     * @return string
     */
    public function cleanKitchen(): string {
        return "🍳 Програміст прибирає кухню";
    }
}