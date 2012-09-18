-- phpMyAdmin SQL Dump
-- version 3.5.2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2012 at 08:09 AM
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
-- Table structure for table `checkins`
--

CREATE TABLE IF NOT EXISTS `checkins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `public` tinyint(4) DEFAULT '1',
  `reason_id` int(11) unsigned DEFAULT NULL,
  `killed` tinyint(4) DEFAULT NULL,
  `count` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `reason_id` (`reason_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `checkins`
--

INSERT INTO `checkins` (`id`, `user_id`, `created_at`, `updated_at`, `public`, `reason_id`, `killed`, `count`) VALUES
(14, 2, '2012-09-06 19:05:23', '2012-09-06 19:19:37', 1, 1, 1, 1),
(15, 1, '2012-09-06 19:17:21', '2012-09-06 19:17:21', 1, 1, 0, 1),
(16, 2, '2012-09-06 19:19:19', '2012-09-06 19:19:19', 1, 1, 0, 1),
(17, 1, '2012-09-13 19:03:50', '2012-09-13 19:03:50', 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`) VALUES
(8, 'DoYouBuzz'),
(9, 'DoYouYou'),
(10, 'Atlantic 2.0'),
(11, 'Pouet');

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE IF NOT EXISTS `reasons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `sentence` varchar(100) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `name`, `sentence`, `order`) VALUES
(1, 'Coworking', 'est venu coworker', 1),
(2, 'De passage pour un événement', 'est passé pour un événement', 2),
(3, 'Réunion avec l''équipe', 'est venu pour une réunion avec l''équipe', 3),
(4, 'Autre', 'est venu pour autre chose !', 4);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`) VALUES
(1, 'PHP'),
(2, 'Product management'),
(3, 'UX Design'),
(4, 'Fireworks'),
(5, 'Java'),
(6, 'Photoshop');

-- --------------------------------------------------------

--
-- Table structure for table `skills_users`
--

CREATE TABLE IF NOT EXISTS `skills_users` (
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  KEY `skill_id` (`skill_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `last_login` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_fields` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
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
