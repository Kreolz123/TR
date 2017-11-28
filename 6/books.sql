-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 28 2017 г., 21:38
-- Версия сервера: 5.6.37
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `books`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books_author`
--

CREATE TABLE `books_author` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books_author`
--

INSERT INTO `books_author` (`id`, `name`) VALUES
(1, 'Автор1'),
(2, 'Автор2'),
(3, 'Автор3'),
(4, 'Автор4'),
(5, 'Автор6'),
(6, 'Автор5');

-- --------------------------------------------------------

--
-- Структура таблицы `books_book`
--

CREATE TABLE `books_book` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books_book`
--

INSERT INTO `books_book` (`id`, `title`) VALUES
(1, 'Книга1'),
(2, 'Книга2'),
(3, 'Книга3'),
(4, 'Книга4'),
(5, 'Книга5'),
(6, 'Книга6');

-- --------------------------------------------------------

--
-- Структура таблицы `books_book_nm_author`
--

CREATE TABLE `books_book_nm_author` (
  `id_book` int(10) UNSIGNED NOT NULL,
  `id_author` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books_book_nm_author`
--

INSERT INTO `books_book_nm_author` (`id_book`, `id_author`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(3, 2),
(4, 3),
(5, 4),
(1, 4),
(6, 6),
(6, 4),
(5, 5);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books_author`
--
ALTER TABLE `books_author`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books_book`
--
ALTER TABLE `books_book`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books_book_nm_author`
--
ALTER TABLE `books_book_nm_author`
  ADD KEY `books_book` (`id_book`),
  ADD KEY `books_author` (`id_author`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books_author`
--
ALTER TABLE `books_author`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `books_book`
--
ALTER TABLE `books_book`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books_book_nm_author`
--
ALTER TABLE `books_book_nm_author`
  ADD CONSTRAINT `books_authors` FOREIGN KEY (`id_author`) REFERENCES `books_author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_book` FOREIGN KEY (`id_book`) REFERENCES `books_book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
