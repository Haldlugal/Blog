-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 17 2016 г., 11:46
-- Версия сервера: 5.5.50
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Yii2Blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bl_comments`
--

CREATE TABLE IF NOT EXISTS `bl_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `moderation` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1853 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bl_comments`
--

INSERT INTO `bl_comments` (`id`, `user_id`, `post_id`, `text`, `date`, `moderation`) VALUES
(1846, 10, 1, '1479362521', '2016-11-17 06:02:01', 0),
(1847, 10, 1, '1479362534', '2016-11-17 06:02:14', 0),
(1848, 10, 1, '1479362547', '2016-11-17 06:02:27', 0),
(1849, 10, 1, '1479362557', '2016-11-17 06:02:37', 0),
(1850, 10, 1, '1479362582', '2016-11-17 06:03:02', 0),
(1851, 10, 1, '1479362591', '2016-11-17 06:03:11', 0),
(1852, 10, 1, '111', '2016-11-17 06:03:50', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `bl_posts`
--

CREATE TABLE IF NOT EXISTS `bl_posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `moderation` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bl_posts`
--

INSERT INTO `bl_posts` (`id`, `user_id`, `title`, `text`, `description`, `date`, `moderation`) VALUES
(1, 1, 'For the Alliance', '1', 'the first post', '2016-11-08 17:00:00', 1),
(2, 1, 'For the Undead', '1', 'For fun and profit!', '2016-11-08 17:00:00', 1),
(11, 1, 'Тест', 'asdfasdfdsa', 'dasfadsf', '0000-00-00 00:00:00', 0),
(12, 10, 'Новичок', '0', '<p>Описалово ура ура ура</p>\r\n', '2016-11-17 06:48:42', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `bl_users`
--

CREATE TABLE IF NOT EXISTS `bl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `second_name` varchar(100) NOT NULL,
  `patronymic_name` varchar(100) NOT NULL,
  `job_place` varchar(255) NOT NULL,
  `job_position` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bl_users`
--

INSERT INTO `bl_users` (`id`, `name`, `second_name`, `patronymic_name`, `job_place`, `job_position`, `photo`, `role`, `active`, `username`, `password`) VALUES
(1, 'Unknown', 'User', '', '', '', '', 'user', 1, '', ''),
(5, 'Sylvana', 'Windrunner', '', '', '', '', 'user', 1, 'Banshee', '11111'),
(6, 'aaaaaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaaa', 'aaaaaaaaaa', 'aaaaaaaaa', '', 'Admin', 1, 'aaaaaaaaaa', 'aaaaaaaa'),
(7, '11111', '1111111', '1111111', '11111', '111111', '', 'Admin', 0, '11111', '1111'),
(8, '11111', '11111111', '1111', '111', '111', '', 'Admin', 0, '111', '1111'),
(9, '11', '1', '1', '1', '1', '', 'Admin', 0, '1', '1'),
(10, 'Variann', 'Rynn', 'Angry', 'Stormgrad', 'The King', '', 'Admin', 1, 'Logosh', '11111'),
(11, 'Variann', 'Rynn', '1111111', 'Stormgrad', 'The King', '', 'Admin', 1, 'Logosh', '11111');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bl_comments`
--
ALTER TABLE `bl_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Индексы таблицы `bl_posts`
--
ALTER TABLE `bl_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_3` (`id`);

--
-- Индексы таблицы `bl_users`
--
ALTER TABLE `bl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bl_comments`
--
ALTER TABLE `bl_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1853;
--
-- AUTO_INCREMENT для таблицы `bl_posts`
--
ALTER TABLE `bl_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `bl_users`
--
ALTER TABLE `bl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bl_comments`
--
ALTER TABLE `bl_comments`
  ADD CONSTRAINT `bl_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bl_users` (`id`),
  ADD CONSTRAINT `bl_comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `bl_posts` (`id`);

--
-- Ограничения внешнего ключа таблицы `bl_posts`
--
ALTER TABLE `bl_posts`
  ADD CONSTRAINT `bl_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bl_users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
