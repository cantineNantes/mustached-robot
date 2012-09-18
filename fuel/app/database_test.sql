-- phpMyAdmin SQL Dump
-- version 3.5.2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2012 at 08:03 AM
-- Server version: 5.5.27
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mustached_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `group` int(11) NOT NULL DEFAULT '1',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `biography` text,
  `company_id` int(10) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `last_login` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `profile_fields` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`),
  KEY `company_id` (`company_id`),
  KEY `company_id_2` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=183 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `group`, `email`, `firstname`, `lastname`, `biography`, `company_id`, `twitter`, `last_login`, `login_hash`, `profile_fields`, `created_at`) VALUES
(1, 'jeremie.pottier@gmail.com', '3B/I3Cg46PpAeyv74s3RCxS0lLhj/iXMFqGn4sMmapI=', 100, 'jeremie.pottier@gmail.com', 'Jérémie', 'Pottier', '', 9, '', '1347865354', 'c2b02fb3c59844f0596c851a588d17c981c8980e', 'a:0:{}', 1346965176),
(2, 'florent.gosselin@gmail.com', '3B/I3Cg46PpAeyv74s3RCxS0lLhj/iXMFqGn4sMmapI=', 1, 'florent.gosselin@gmail.com', 'Florent', 'Gosselin', '', 10, 'fgosselin', '', '', 'a:0:{}', 1346966294);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
