-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2013 at 08:04 AM
-- Server version: 5.1.67-andiunpam
-- PHP Version: 5.4.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `whiskeyman_tipsy`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
`articleid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id статьи',
`title` char(50) NOT NULL COMMENT 'название статьи',
`fulltext` longtext NOT NULL COMMENT 'содержание статьи',
`created` date NOT NULL COMMENT 'дата создания',
`created_by` char(50) NOT NULL COMMENT 'кем создана',
PRIMARY KEY (`articleid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Таблица статей' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`articleid`, `title`, `fulltext`, `created`, `created_by`) VALUES
(1, 'Описание', 'Tipsy cms находится в начальной стадии разработки. Так как она пишется практически вся на коленках в метро, параллельно изучению php, mySQL, html и css, сроки ее завершения совершенно не определены :)\n\nСайт создан для отлаживания исходников, когда я их пишу, например, в метро, когда другой возможности протестить работоспособность нет. А исходя из того, что, в основном, написание происходит в дороге с мобильного девайса, сиё творение будет чаще не работать, чем работать. ;)\n\nДля работы Tipsy CMS требуется php версии не ниже 5.4, html5 и css3<p>\n<b>Ведутся работы по переписанию кода, переход на использование простаранста имен.</b>', '2012-11-08', 'whiskeyman'),
(2, 'заголовок', 'какой-то текст', '2012-11-04', 'whiskeyman');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
`id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' id позиции щаблона',
`name` char(10) NOT NULL COMMENT 'Название позиции',
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Позиции шаблона' AUTO_INCREMENT=739 ;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(174, 'Autorize');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `usertype`, `registerDate`, `lastvisitDate`) VALUES
(0, NULL, 'Whiskeyman', NULL, NULL, NULL, NULL, NULL);