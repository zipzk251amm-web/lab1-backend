<?php
/**
 * Клас Circle - коло
 * 
 * Клас для роботи з колом: координати центру, радіус,
 * методи GET/SET, перетин кіл
 * 
 * @package Lab4
 */
class Circle {
    /**
     * @var float $x Координата X центру кола
     */
    private float $x;
    
    /**
     * @var float $y Координата Y центру кола
     */
    private float $y;
    
    /**
     * @var float $radius Радіус кола
     */
    private float $radius;
    
    /**
     * Конструктор класу Circle
     * 
     * @param float $x Координата X
     * @param float $y Координата Y
     * @param float $radius Радіус
     */
    public function __construct(float $x, float $y, float $radius) {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }
    
    // GET методи
    public function getX(): float { return $this->x; }
    public function getY(): float { return $this->y; }
    public function getRadius(): float { return $this->radius; }
    
    // SET методи
    public function setX(float $x): void { $this->x = $x; }
    public function setY(float $y): void { $this->y = $y; }
    public function setRadius(float $radius): void { $this->radius = $radius; }
    
    /**
     * Магічний метод __toString
     * 
     * @return string
     */
    public function __toString(): string {
        return "Коло з центром в ({$this->x}, {$this->y}) і радіусом {$this->radius}";
    }
    
    /**
     * Перевірка перетину з іншим колом
     * 
     * @param Circle $other Інше коло
     * @return bool true якщо кола перетинаються, false якщо ні
     */
    public function intersects(Circle $other): bool {
        $distance = sqrt(pow($this->x - $other->x, 2) + pow($this->y - $other->y, 2));
        $sumRadius = $this->radius + $other->radius;
        return $distance < $sumRadius;
    }
}