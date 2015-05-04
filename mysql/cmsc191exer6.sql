-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2015 at 10:17 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cmsc191exer6`
--

-- --------------------------------------------------------

--
-- Table structure for table `fruit`
--

CREATE TABLE IF NOT EXISTS `fruit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `distributor` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `fruit`
--

INSERT INTO `fruit` (`id`, `name`, `quantity`, `distributor`) VALUES
(1, 'Apple', 10, 'Del Monte'),
(2, 'Banana', 9, 'Del Monte'),
(3, 'Grapes', 8, 'Savemore'),
(4, 'Guyabano', 7, 'Fruits pa More'),
(5, 'Kiwi', 6, 'Savemore'),
(6, 'Mango', 15, 'SM'),
(22, 'Star Apple', 15, 'Tindahan sa Grove'),
(23, 'Dalandan', 7, 'Nesfruta'),
(24, 'Orange', 6, 'Mandarin');

-- --------------------------------------------------------

--
-- Table structure for table `fruitprice`
--

CREATE TABLE IF NOT EXISTS `fruitprice` (
  `id` int(11) NOT NULL,
  `price` float NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fruitprice`
--

INSERT INTO `fruitprice` (`id`, `price`, `date`) VALUES
(1, 25, '0000-00-00'),
(1, 20, '2015-04-21'),
(1, 15, '2015-04-22'),
(1, 50, '2015-04-23'),
(1, 22, '2015-04-24'),
(1, 23, '2015-04-25'),
(1, 24, '2015-04-26'),
(1, 25, '2015-04-27'),
(1, 20, '2015-04-28'),
(1, 25, '2015-04-29'),
(1, 20, '2015-04-30'),
(1, 25, '2015-05-01'),
(1, 12, '2015-05-02'),
(1, 20, '2015-05-03'),
(2, 50, '2015-04-21'),
(2, 21, '2015-04-22'),
(2, 30, '2015-04-23'),
(2, 51, '2015-04-24'),
(2, 52, '2015-04-25'),
(2, 53, '2015-04-26'),
(2, 54, '2015-04-27'),
(2, 55, '2015-04-28'),
(2, 45, '2015-05-03'),
(3, 100, '2015-04-21'),
(3, 30, '2015-04-22'),
(3, 31, '2015-04-23'),
(3, 60, '2015-04-24'),
(3, 61, '2015-04-25'),
(3, 62, '2015-04-26'),
(3, 63, '2015-04-27'),
(3, 64, '2015-04-28'),
(3, 100, '2015-05-03'),
(4, 70, '2015-04-21'),
(4, 40, '2015-04-22'),
(4, 32, '2015-04-23'),
(4, 33, '2015-04-24'),
(4, 34, '2015-04-25'),
(4, 35, '2015-04-26'),
(4, 36, '2015-04-27'),
(4, 37, '2015-04-28'),
(5, 50, '2015-04-21'),
(5, 50, '2015-04-22'),
(5, 52, '2015-04-23'),
(5, 53, '2015-04-24'),
(5, 54, '2015-04-25'),
(5, 55, '2015-04-26'),
(5, 56, '2015-04-27'),
(5, 57, '2015-04-28'),
(6, 20, '2015-04-21'),
(6, 71, '2015-04-22'),
(6, 72, '2015-04-23'),
(6, 73, '2015-04-24'),
(6, 74, '2015-04-25'),
(6, 75, '2015-04-26'),
(6, 76, '2015-04-27'),
(6, 80, '2015-04-28'),
(22, 30, '2015-05-03'),
(24, 15, '2015-05-03');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fruitprice`
--
ALTER TABLE `fruitprice`
  ADD CONSTRAINT `fruitprice_ibfk_1` FOREIGN KEY (`id`) REFERENCES `fruit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
