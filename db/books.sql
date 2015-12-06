-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 05 2015 г., 23:25
-- Версия сервера: 5.5.25
-- Версия PHP: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `rgk`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `date_create` int(11) NOT NULL,
  `date_update` int(11) NOT NULL,
  `preview` varchar(256) DEFAULT NULL,
  `date` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`, `date_create`, `date_update`, `preview`, `date`, `author_id`) VALUES
(1, 'Первая книга', 1449010089, 1449356487, NULL, 1198447920, 1),
(2, 'Вторая книга', 1448010089, 1449355542, NULL, 62025120, 2),
(3, 'Просто книга', 1449000089, 1449000089, NULL, 1324253520, 3),
(4, 'Отличная книга', 1449010227, 1449357852, NULL, 914198400, 4),
(5, 'Большя книга', 1449010227, 1449341835, NULL, 1356307680, 2),
(6, 'Тонкая книга', 1449010100, 1449354267, NULL, 1324246320, 4),
(7, 'Моя книга', 1449040089, 1449357858, NULL, 481248000, 2),
(8, 'Лучшая книга', 1449040089, 1449357858, NULL, 481248000, 6),
(9, 'Ужасная книга', 1449040089, 1449357858, NULL, 481248000, 5);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
