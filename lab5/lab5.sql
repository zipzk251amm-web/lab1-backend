-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Трв 12 2026 р., 11:42
-- Версія сервера: 8.4.7
-- Версія PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `lab5`
--

-- --------------------------------------------------------

--
-- Структура таблиці `tov`
--

DROP TABLE IF EXISTS `tov`;
CREATE TABLE IF NOT EXISTS `tov` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `date_added` date NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `tov`
--

INSERT INTO `tov` (`id`, `name`, `cost`, `quantity`, `date_added`, `description`) VALUES
(1, 'Хліб столовий', 24.00, 100, '2024-03-25', 'Білий хліб з пшеничного борошна'),
(2, 'Хліб житній', 20.00, 50, '2024-03-27', 'Житній хліб'),
(3, 'Батон нарізний', 18.00, 80, '2024-03-28', 'Класичний батон'),
(4, 'Круасан', 15.00, 120, '2024-03-29', 'Французька випічка'),
(5, 'Торт Наполеон', 250.00, 10, '2024-03-30', 'Шаровий торт'),
(6, 'Печиво вівсяне', 12.00, 200, '2024-03-31', 'Корисне печиво'),
(7, 'Кекс шоколадний', 35.00, 45, '2024-04-01', 'З шоколадною начинкою'),
(8, 'Пряники медові', 8.00, 300, '2024-04-02', 'Медові пряники'),
(9, 'Сирна паличка', 10.00, 150, '2024-04-03', 'Сирна випічка'),
(10, 'Піца міні', 45.00, 30, '2024-04-04', 'Міні-піца з сиром');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `city` varchar(50) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT 'other',
  `reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
