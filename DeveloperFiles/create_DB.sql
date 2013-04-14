-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 14 2013 г., 18:44
-- Версия сервера: 5.5.29
-- Версия PHP: 5.4.14-1~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `whiskeyman_tipsy`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id статьи',
  `title` char(50) NOT NULL COMMENT 'название статьи',
  `fulltext` longtext NOT NULL COMMENT 'содержание статьи',
  `created` date NOT NULL COMMENT 'дата создания',
  `created_by` char(50) NOT NULL COMMENT 'кем создана',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Таблица статей' AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `title`, `fulltext`, `created`, `created_by`) VALUES
(1, 'Описание', 'Tipsy cms находится в начальной стадии разработки. Так как она пишется практически вся на коленках в метро, параллельно изучению php, mySQL, html и css, сроки ее завершения совершенно не определены :)\r\n\r\nСайт создан для отлаживания исходников, когда я их пишу, например, в метро, когда другой возможности протестить работоспособность нет. А исходя из того, что, в основном, написание происходит в дороге с мобильного девайса, сиё творение будет чаще не работать, чем работать. ;)\r\n\r\n<b>Для работы Tipsy CMS требуется php версии не ниже 5.4, html5 и css3</b><p>', '2012-11-08', 'whiskeyman'),
(2, 'заголовок', 'какой-то текст', '2012-11-04', 'whiskeyman');

-- --------------------------------------------------------

--
-- Структура таблицы `components`
--

CREATE TABLE IF NOT EXISTS `components` (
  `name` varchar(30) NOT NULL COMMENT 'Имя компонента системы',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок компонента',
  `position_id` int(10) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Компоненты системы';

--
-- Дамп данных таблицы `components`
--

INSERT INTO `components` (`name`, `title`, `position_id`) VALUES
('Article', '', 0),
('User', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' id позиции щаблона',
  `name` char(30) NOT NULL COMMENT 'Название позиции',
  `com` char(30) NOT NULL COMMENT 'Компонент привязанный к позиции шаблона. Определяет какое содержимое будет выведено.',
  `com_id` int(10) NOT NULL COMMENT 'id компонента',
  `title` char(1) NOT NULL COMMENT 'Заголовок позиции',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Позиции шаблона' AUTO_INCREMENT=827 ;

--
-- Дамп данных таблицы `positions`
--

INSERT INTO `positions` (`id`, `name`, `com`, `com_id`, `title`) VALUES
(824, 'footer', '', 0, ''),
(823, 'article', 'Article', 1, ''),
(822, 'nav', '', 0, ''),
(821, 'conteiner', '', 0, ''),
(820, 'menu_horisontal', '', 0, ''),
(819, 'errors', '', 0, ''),
(818, 'autorize', '', 0, ''),
(825, 'control_panel', '', 0, ''),
(826, 'header', '', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL COMMENT 'id пользователя',
  `name` varchar(45) DEFAULT NULL COMMENT 'Имя пользователя',
  `username` varchar(45) DEFAULT NULL COMMENT 'Имя пользователя (логин)',
  `email` varchar(45) DEFAULT NULL COMMENT 'email позьзователя',
  `password` varchar(45) DEFAULT NULL COMMENT 'Пароль пользователя',
  `usertype` varchar(45) DEFAULT NULL COMMENT 'Тип пользователя',
  `registerDate` varchar(45) DEFAULT NULL COMMENT 'Дата регистрации',
  `lastvisitDate` varchar(45) DEFAULT NULL COMMENT 'Дата последнего визита',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Пользователи системы';

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `usertype`, `registerDate`, `lastvisitDate`) VALUES
(0, NULL, 'Whiskeyman', NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;