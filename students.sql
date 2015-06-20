-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 19, 2015 at 03:52 PM
-- Server version: 5.5.41-log
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `students`
--

-- --------------------------------------------------------

--
-- Table structure for table `myprefix_students`
--

CREATE TABLE IF NOT EXISTS `myprefix_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `surname` varchar(250) NOT NULL,
  `sexual-identity` varchar(250) NOT NULL,
  `age` int(11) unsigned NOT NULL,
  `group` varchar(250) NOT NULL,
  `faculty` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `myprefix_students`
--

INSERT INTO `myprefix_students` (`id`, `name`, `surname`, `sexual-identity`, `age`, `group`, `faculty`) VALUES
(1, 'Александр', 'Стрелец', 'М', 25, 'ИН-99', 'Факультет вычислительной математики и кибернетики'),
(2, 'Ирина', 'Иванова', 'Ж', 23, '723 ', 'Философский факультет'),
(3, 'Мария', 'Плавко', 'Ж', 22, 'БС-11', 'Биологический факультет'),
(4, 'Григорий', 'Артюх', 'М', 19, 'ЕП-12', 'Электронные приборы'),
(5, 'Виктория', 'Иващенко', 'Ж', 24, '581', 'Факультет искусств');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
