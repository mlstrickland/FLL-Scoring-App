-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2015 at 03:27 PM
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
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `TeamNumber` int(11) NOT NULL,
  `Score1` int(11) NOT NULL,
  `Score2` int(11) NOT NULL,
  `Score3` int(11) NOT NULL,
  `Score4` int(11) NOT NULL,
  `Score5` int(11) NOT NULL,
  `HighScore` int(11) NOT NULL,
  `TieBreak1` int(11) NOT NULL,
  `TieBreak2` int(11) NOT NULL,
  `Rank` int(11) NOT NULL,
  `TeamName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`TeamNumber`, `Score1`, `Score2`, `Score3`, `Score4`, `Score5`, `HighScore`, `TieBreak1`, `TieBreak2`, `Rank`, `TeamName`) VALUES
(1100, 1, 2, 3, 4, 5, 5, 0, 0, 6, 'The Thawks'),
(1735, 240, 135, 3, 2, 1, 240, 0, 0, 7, 'The Green Reapers'),
(181, 5, 1, 1, 1, 1, 5, 1, 0, 0, 'The Birds of Prey'),
(190, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Gompei and the HERD'),
(228, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'GUS'),
(195, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'The Cyber Knights'),
(157, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'AZTECHS'),
(20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'The Rocketeers'),
(254, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'The Cheezy Poofs'),
(1058, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'The PVC Pirates'),
(1114, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Simbotics'),
(2079, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ALARM robotics');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
