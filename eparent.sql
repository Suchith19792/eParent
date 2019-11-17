-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2019 at 09:23 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eparent`
--

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `gr_key` int(11) NOT NULL,
  `stud_key` int(11) NOT NULL,
  `subject_name` varchar(45) NOT NULL,
  `gr_data` longtext NOT NULL,
  PRIMARY KEY (`gr_key`),
  KEY `fkIdx_6` (`stud_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

DROP TABLE IF EXISTS `institutions`;
CREATE TABLE IF NOT EXISTS `institutions` (
  `inst_key` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `inst_name` varchar(45) NOT NULL,
  PRIMARY KEY (`inst_key`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`inst_key`, `login`, `password`, `inst_name`) VALUES
(1, 'Inst_1', '111', 'Institution 1 name '),
(2, 'z', 'z', 'z'),
(3, 'aaa', 'aaa', ''),
(4, 'a', 'a', 'a'),
(5, 'aa', 'aa', 'aa'),
(6, 'as', 'as', 'as');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `stud_key` int(11) NOT NULL AUTO_INCREMENT,
  `inst_key` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `second_name` varchar(45) NOT NULL,
  PRIMARY KEY (`stud_key`),
  KEY `fkIdx_9` (`inst_key`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_key`, `inst_key`, `login`, `password`, `first_name`, `second_name`) VALUES
(1, 1, 'hhh', 'iii', 'm', 'y'),
(2, 1, 'q', 'q', 'q', 'q'),
(12, 1, 'bn', 'bn', 'bn', 'bn'),
(11, 1, '', '', '', ''),
(10, 1, 'x', 'x', 'x', 'x'),
(9, 1, 'z', 'z', 'z', 'z'),
(8, 1, 'b', 'b', 'b', 'b'),
(13, 1, '', '', '', ''),
(14, 2, 'bbb', 'bbb', 'bbb', 'bbb'),
(15, 2, 'asa', 'asa', 'asa', 'asa'),
(16, 2, 'aaaaaaaaa', 'aaaaaaa', 'aaaaaa', 'aaaaa'),
(17, 1, 'aq', 'aq', 'aq', 'aq');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
