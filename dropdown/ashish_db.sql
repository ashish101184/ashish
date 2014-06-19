-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2014 at 10:35 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ashish_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `table1`
--

CREATE TABLE IF NOT EXISTS `table1` (
  `Column1` varchar(20) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(110) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table1`
--

INSERT INTO `table1` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('1.1', 'Book 1.1', 'Author 1.1', 'Year 1.1'),
('1.2', 'Book 1.2', 'Author 1.2', 'Year 1.2'),
('1.3', 'Book 1.3', 'Author 1.3', 'Year 1.3'),
('1.1', 'Book 1.1', 'Author 1.1', 'Year 1.1'),
('1.2', 'Book 1.2', 'Author 1.2', 'Year 1.2'),
('1.3', 'Book 1.3', 'Author 1.3', 'Year 1.3');

-- --------------------------------------------------------

--
-- Table structure for table `table2`
--

CREATE TABLE IF NOT EXISTS `table2` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table2`
--

INSERT INTO `table2` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('2.1', 'Book 2.1', 'Author 2.1', 'Year 2.1'),
('2.2', 'Book 2.2', 'Author 2.2', 'Year 2.2'),
('2.3', 'Book 2.3', 'Author 2.3', 'Year 2.3');

-- --------------------------------------------------------

--
-- Table structure for table `table3`
--

CREATE TABLE IF NOT EXISTS `table3` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table3`
--

INSERT INTO `table3` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('3.1', 'Book 3.1', 'Author 3.1', 'Year 3.1'),
('3.2', 'Book 3.2', 'Author 3.2', 'Year 3.2'),
('3.3', 'Book 3.3', 'Author 3.3', 'Year 3.3');

-- --------------------------------------------------------

--
-- Table structure for table `table4`
--

CREATE TABLE IF NOT EXISTS `table4` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table4`
--

INSERT INTO `table4` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('4.1', 'Book 4.1', 'Author 4.1', 'Year 4.1'),
('4.2', 'Book 4.2', 'Author 4.2', 'Year 4.2'),
('4.3', 'Book 4.3', 'Author 4.3', 'Year 4.3');

-- --------------------------------------------------------

--
-- Table structure for table `table5`
--

CREATE TABLE IF NOT EXISTS `table5` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table5`
--

INSERT INTO `table5` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('5.1', 'Book 5.1', 'Author 5.1', 'Year 5.1'),
('5.2', 'Book 5.2', 'Author 5.2', 'Year 5.2'),
('5.3', 'Book 5.3', 'Author 5.3', 'Year 5.3');

-- --------------------------------------------------------

--
-- Table structure for table `table6`
--

CREATE TABLE IF NOT EXISTS `table6` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table6`
--

INSERT INTO `table6` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('6.1', 'Book 6.1', 'Author 6.1', 'Year 6.1'),
('6.2', 'Book 6.2', 'Author 6.2', 'Year 6.2');

-- --------------------------------------------------------

--
-- Table structure for table `table7`
--

CREATE TABLE IF NOT EXISTS `table7` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table7`
--

INSERT INTO `table7` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('7.1', 'Book 7.1', 'Author 7.1', 'Year 7.1'),
('7.2', 'Book 7.2', 'Author 7.2', 'Year 7.2');

-- --------------------------------------------------------

--
-- Table structure for table `table8`
--

CREATE TABLE IF NOT EXISTS `table8` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table8`
--

INSERT INTO `table8` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('8.1', 'Book 8.1', 'Author 8.1', 'Year 8.1'),
('8.2', 'Book 8.2', 'Author 8.2', 'Year 8.2');

-- --------------------------------------------------------

--
-- Table structure for table `table9`
--

CREATE TABLE IF NOT EXISTS `table9` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table9`
--

INSERT INTO `table9` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('9.1', 'Book 9.1', 'Author 9.1', 'Year 9.1'),
('9.2', 'Book 9.2', 'Author 9.2', 'Year 9.2');

-- --------------------------------------------------------

--
-- Table structure for table `table10`
--

CREATE TABLE IF NOT EXISTS `table10` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table10`
--

INSERT INTO `table10` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('10.1', 'Book 10.1', 'Author 10.1', 'Year 10.1'),
('10.2', 'Book 10.2', 'Author 10.2', 'Year 10.2');

-- --------------------------------------------------------

--
-- Table structure for table `table11`
--

CREATE TABLE IF NOT EXISTS `table11` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table11`
--

INSERT INTO `table11` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('11.1', 'Book 11.1', 'Author 11.1', 'Year 11.1'),
('11.2', 'Book 11.2', 'Author 11.2', 'Year 11.2');

-- --------------------------------------------------------

--
-- Table structure for table `table12`
--

CREATE TABLE IF NOT EXISTS `table12` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table12`
--

INSERT INTO `table12` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('12.1', 'Book 12.1', 'Author 12.1', 'Year 12.1'),
('12.2', 'Book 12.2', 'Author 12.2', 'Year 12.2');

-- --------------------------------------------------------

--
-- Table structure for table `table13`
--

CREATE TABLE IF NOT EXISTS `table13` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table13`
--

INSERT INTO `table13` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('13.1', 'Book 13.1', 'Author 13.1', 'Year 13.1'),
('13.2', 'Book 13.2', 'Author 13.2', 'Year 13.2');

-- --------------------------------------------------------

--
-- Table structure for table `table14`
--

CREATE TABLE IF NOT EXISTS `table14` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table14`
--

INSERT INTO `table14` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('14.1', 'Book 14.1', 'Author 14.1', 'Year 14.1'),
('14.2', 'Book 14.2', 'Author 14.2', 'Year 14.2');

-- --------------------------------------------------------

--
-- Table structure for table `table15`
--

CREATE TABLE IF NOT EXISTS `table15` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table15`
--

INSERT INTO `table15` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('15.1', 'Book 15.1', 'Author 15.1', 'Year 15.1'),
('15.2', 'Book 15.2', 'Author 15.2', 'Year 15.2');

-- --------------------------------------------------------

--
-- Table structure for table `table16`
--

CREATE TABLE IF NOT EXISTS `table16` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table16`
--

INSERT INTO `table16` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('16.1', 'Book 16.1', 'Author 16.1', 'Year 16.1'),
('16.2', 'Book 16.2', 'Author 16.2', 'Year 16.2');

-- --------------------------------------------------------

--
-- Table structure for table `table17`
--

CREATE TABLE IF NOT EXISTS `table17` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table17`
--

INSERT INTO `table17` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('17.1', 'Book 17.1', 'Author 17.1', 'Year 17.1'),
('17.2', 'Book 17.2', 'Author 17.2', 'Year 17.2');

-- --------------------------------------------------------

--
-- Table structure for table `table18`
--

CREATE TABLE IF NOT EXISTS `table18` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table18`
--

INSERT INTO `table18` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('18.1', 'Book 18.1', 'Author 18.1', 'Year 18.1'),
('18.2', 'Book 18.2', 'Author 18.2', 'Year 18.2');

-- --------------------------------------------------------

--
-- Table structure for table `table19`
--

CREATE TABLE IF NOT EXISTS `table19` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table19`
--

INSERT INTO `table19` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('19.1', 'Book 19.1', 'Author 19.1', 'Year 19.1'),
('19.2', 'Book 19.2', 'Author 19.2', 'Year 19.2');

-- --------------------------------------------------------

--
-- Table structure for table `table20`
--

CREATE TABLE IF NOT EXISTS `table20` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table20`
--

INSERT INTO `table20` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('20.1', 'Book 20.1', 'Author 20.1', 'Year 20.1'),
('20.2', 'Book 20.2', 'Author 20.2', 'Year 20.2');

-- --------------------------------------------------------

--
-- Table structure for table `table21`
--

CREATE TABLE IF NOT EXISTS `table21` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table21`
--

INSERT INTO `table21` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('21.1', 'Book 21.1', 'Author 21.1', 'Year 21.1'),
('21.2', 'Book 21.2', 'Author 21.2', 'Year 21.2');

-- --------------------------------------------------------

--
-- Table structure for table `table22`
--

CREATE TABLE IF NOT EXISTS `table22` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table22`
--

INSERT INTO `table22` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('22.1', 'Book 22.1', 'Author 22.1', 'Year 22.1'),
('22.2', 'Book 22.2', 'Author 22.2', 'Year 22.2');

-- --------------------------------------------------------

--
-- Table structure for table `table23`
--

CREATE TABLE IF NOT EXISTS `table23` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table23`
--

INSERT INTO `table23` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('23.1', 'Book 23.1', 'Author 23.1', 'Year 23.1'),
('23.2', 'Book 23.2', 'Author 23.2', 'Year 23.2');

-- --------------------------------------------------------

--
-- Table structure for table `table24`
--

CREATE TABLE IF NOT EXISTS `table24` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table24`
--

INSERT INTO `table24` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('24.1', 'Book 24.1', 'Author 24.1', 'Year 24.1'),
('24.2', 'Book 24.2', 'Author 24.2', 'Year 24.2');

-- --------------------------------------------------------

--
-- Table structure for table `table25`
--

CREATE TABLE IF NOT EXISTS `table25` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table25`
--

INSERT INTO `table25` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('25.1', 'Book 25.1', 'Author 25.1', 'Year 25.1'),
('25.2', 'Book 25.2', 'Author 25.2', 'Year 25.2');

-- --------------------------------------------------------

--
-- Table structure for table `table26`
--

CREATE TABLE IF NOT EXISTS `table26` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table26`
--

INSERT INTO `table26` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('26.1', 'Book 26.1', 'Author 26.1', 'Year 26.1'),
('26.2', 'Book 26.2', 'Author 26.2', 'Year 26.2');

-- --------------------------------------------------------

--
-- Table structure for table `table27`
--

CREATE TABLE IF NOT EXISTS `table27` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table27`
--

INSERT INTO `table27` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('27.1', 'Book 27.1', 'Author 27.1', 'Year 27.1'),
('27.2', 'Book 27.2', 'Author 27.2', 'Year 27.2');

-- --------------------------------------------------------

--
-- Table structure for table `table28`
--

CREATE TABLE IF NOT EXISTS `table28` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table28`
--

INSERT INTO `table28` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('28.1', 'Book 28.1', 'Author 28.1', 'Year 28.1'),
('28.2', 'Book 28.2', 'Author 28.2', 'Year 28.2');

-- --------------------------------------------------------

--
-- Table structure for table `table29`
--

CREATE TABLE IF NOT EXISTS `table29` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table29`
--

INSERT INTO `table29` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('29.1', 'Book 29.1', 'Author 29.1', 'Year 29.1'),
('29.2', 'Book 29.2', 'Author 29.2', 'Year 29.2');

-- --------------------------------------------------------

--
-- Table structure for table `table30`
--

CREATE TABLE IF NOT EXISTS `table30` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table30`
--

INSERT INTO `table30` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('30.1', 'Book 30.1', 'Author 30.1', 'Year 30.1'),
('30.2', 'Book 30.2', 'Author 30.2', 'Year 30.2');

-- --------------------------------------------------------

--
-- Table structure for table `table31`
--

CREATE TABLE IF NOT EXISTS `table31` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table31`
--

INSERT INTO `table31` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('31.1', 'Book 31.1', 'Author 31.1', 'Year 31.1'),
('31.2', 'Book 31.2', 'Author 31.2', 'Year 31.2');

-- --------------------------------------------------------

--
-- Table structure for table `table32`
--

CREATE TABLE IF NOT EXISTS `table32` (
  `Column1` varchar(10) NOT NULL,
  `Column2` varchar(100) NOT NULL,
  `Column3` varchar(100) NOT NULL,
  `Column4` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table32`
--

INSERT INTO `table32` (`Column1`, `Column2`, `Column3`, `Column4`) VALUES
('32.1', 'Book 32.1', 'Author 32.1', 'Year 32.1'),
('32.2', 'Book 32.2', 'Author 32.2', 'Year 32.2');
