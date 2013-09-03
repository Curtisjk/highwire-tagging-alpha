-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 03, 2013 at 11:50 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tagging_alpha`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--
-- Creation: Sep 03, 2013 at 09:43 AM
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time` float NOT NULL,
  `session_id` int(7) NOT NULL,
  `comment` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1509 ;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--
-- Creation: Sep 03, 2013 at 09:43 AM
-- Last update: Sep 03, 2013 at 09:43 AM
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `email` varbinary(150) NOT NULL,
  `results` int(1) NOT NULL,
  `news` int(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--
-- Creation: Sep 03, 2013 at 09:43 AM
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `video_id` varchar(11) NOT NULL,
  `expertise` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=353 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
-- Creation: Sep 03, 2013 at 09:43 AM
--

CREATE TABLE `user` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `group` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--
-- Creation: Sep 03, 2013 at 09:43 AM
-- Last update: Sep 03, 2013 at 09:43 AM
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` varchar(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `desc` varchar(1000) NOT NULL,
  `length` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
