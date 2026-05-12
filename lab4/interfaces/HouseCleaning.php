<?php
/**
 * Інтерфейс HouseCleaning - прибирання будинку
 * 
 * Визначає методи для прибирання кімнати та кухні
 * 
 * @package Lab4\Interfaces
 */
interface HouseCleaning {
    /**
     * Прибирання кімнати
     * 
     * @return string
     */
    public function cleanRoom(): string;
    
    /**
     * Прибирання кухні
     * 
     * @return string
     */
    public function cleanKitchen(): string;
}