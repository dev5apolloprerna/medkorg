-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2011 at 03:27 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `surveyapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `advt_tbl`
--

CREATE TABLE IF NOT EXISTS `advt_tbl` (
  `advt_id` int(11) NOT NULL AUTO_INCREMENT,
  `advt_title` varchar(255) NOT NULL,
  `advt_img` varchar(255) NOT NULL,
  `advt_height` float NOT NULL,
  `advt_link` varchar(255) NOT NULL,
  `advt_pgnum` int(11) NOT NULL,
  PRIMARY KEY (`advt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `advt_tbl`
--

INSERT INTO `advt_tbl` (`advt_id`, `advt_title`, `advt_img`, `advt_height`, `advt_link`, `advt_pgnum`) VALUES
(3, 'asdas', '13842.jpg', 120, 'asdasd', 1),
(5, 'advt2', '27462.jpg', 100, 'www.yahoo.co.in', 2),
(6, 'asdas', '19075.jpg', 100, 'asdasd', 2);
