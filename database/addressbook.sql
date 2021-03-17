-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 17, 2021 at 04:54 PM
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
-- Database: `addressbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
CREATE TABLE IF NOT EXISTS `organization` (
  `organization_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_name` varchar(50) NOT NULL,
  `organization_email` varchar(20) NOT NULL,
  `organization_phone_number` varchar(50) NOT NULL,
  `organization_location` text NOT NULL,
  PRIMARY KEY (`organization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`organization_id`, `organization_name`, `organization_email`, `organization_phone_number`, `organization_location`) VALUES
(16, 'qwewqedsfdsfs', 'sads@wsd', '21321', 'beirut'),
(17, 'jixoo44ihgjh', 'jojooo@hotmail.com', '232', '434'),
(20, 'jixoo44', 'dknkjfd@hotmail.com', '+961-76093832', 'Beirut,Rue 3'),
(21, 'qwewqedsfdsfs', 'safn@hotmail.com', '+971-23223123', 'gfyykgfdgfdg'),
(22, 'jassouna', 'jasson@hotmail.com', '+961-76093832', 'SAUDI ARABIA');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `person_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_fk_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` text,
  PRIMARY KEY (`person_id`),
  KEY `fk_organization_id` (`organization_fk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `organization_fk_id`, `first_name`, `last_name`, `phone_number`, `date_of_birth`, `email`, `address`) VALUES
(3, NULL, 'Jason', 'Saad', '+961-76093832', '2021-03-09', 'aaaaa@hotmail.com', 'LEBANON'),
(4, NULL, 'Jasonsd', 'Saad', '2313', '2021-03-06', 'aa@hotmail.com', 'Beirut'),
(5, NULL, 'Jasonsd', 'Saad', '2313', '2021-03-06', 'aa@hotmail.com', 'Beirut'),
(6, 16, 'dasd', 'adsds', 'sads', '2021-03-04', 'aa@hotmail.com', 'Beirut'),
(7, NULL, 'Jason', 'Saad', '213', '2021-03-04', 'aaaaa@hotmail.com', 'Beirut'),
(8, NULL, 'Jason', 'Saad', '231321', '2021-03-03', 'aa@hotmail.com', 'Beirut'),
(9, 22, 'Jason', 'Saad', '+961-76094832', '2021-03-05', 'aa@hotmail.com', 'Beirut'),
(10, 22, 'nosaj', 'Saad21', '+961-76012312', '2021-03-06', 'aaaaa@hotmail.com', 'dadsada');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `fk_organization_id` FOREIGN KEY (`organization_fk_id`) REFERENCES `organization` (`organization_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
