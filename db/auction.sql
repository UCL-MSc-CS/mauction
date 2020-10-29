-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 29, 2020 at 01:35 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

DROP TABLE IF EXISTS `bid`;
CREATE TABLE IF NOT EXISTS `bid` (
  `bidID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `buyerID` int(10) UNSIGNED NOT NULL,
  `bidProcess` varchar(10) NOT NULL,
  `bidAmount` decimal(8,2) UNSIGNED NOT NULL,
  `timeStamp` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`bidID`),
  KEY `buyerID` (`buyerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

DROP TABLE IF EXISTS `buyer`;
CREATE TABLE IF NOT EXISTS `buyer` (
  `buyerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `saleItemID` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`buyerID`),
  KEY `saleItemsID` (`saleItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saleitem`
--

DROP TABLE IF EXISTS `saleitem`;
CREATE TABLE IF NOT EXISTS `saleitem` (
  `saleItemID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sellerID` int(10) UNSIGNED NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` blob,
  `startDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endDate` date NOT NULL,
  `endTime` time NOT NULL,
  `category` varchar(20) NOT NULL,
  `reservePrice` decimal(8,2) UNSIGNED NOT NULL,
  `commission` decimal(8,2) UNSIGNED NOT NULL,
  `finalPrice` decimal(8,2) UNSIGNED NOT NULL,
  `delivery` varchar(10) NOT NULL,
  `outcome` tinyint(1) NOT NULL,
  `saleCondition` varchar(10) NOT NULL,
  `bidID` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`saleItemID`),
  KEY `sellerID` (`sellerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `sellerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `saleItemID` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`sellerID`),
  KEY `saleItemsID` (`saleItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(10) NOT NULL,
  `userEmail` varchar(25) NOT NULL,
  `registrationDate` date NOT NULL,
  `address` varchar(25) NOT NULL,
  `firstName` varchar(10) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `password` char(10) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`buyerID`) REFERENCES `buyer` (`buyerID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
