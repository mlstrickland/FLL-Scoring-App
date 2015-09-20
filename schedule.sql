-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2015 at 03:29 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `teamlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `Round` int(11) NOT NULL,
  `Table1` int(11) NOT NULL,
  `Table2` int(11) NOT NULL,
  `Table3` int(11) NOT NULL,
  `Table4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`Round`, `Table1`, `Table2`, `Table3`, `Table4`) VALUES
(1, 1, 2, 3, 4),
(2, 1, 2, 3, 4),
(3, 1, 2, 3, 4),
(4, 1, 2, 3, 4),
(5, 1, 2, 3, 4),
(6, 1, 2, 3, 4),
(7, 1, 2, 3, 4),
(8, 1, 2, 3, 4),
(9, 1, 2, 3, 4),
(10, 1, 2, 3, 4),
(11, 1, 2, 3, 4),
(12, 1, 2, 3, 4),
(13, 5, 3, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
