-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2014 at 02:22 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii_demoshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `image`, `description`, `parent_id`) VALUES
(1, 'Smartphone', '1_Smartphone.jpg', 'Smart Phone', 0),
(2, 'Nokia', NULL, 'Nokia', 1),
(3, 'Sony', NULL, 'Sony Smartphone', 1),
(4, 'Samsung', NULL, 'Samsung galaxy smartphone', 1),
(5, 'X-PeriaZ', NULL, 'Sony X-Peria', 3),
(6, 'X-Peria Z1', NULL, 'Sony X-Peria Z 1', 5),
(7, 'Dog', '7_Dog.jpg', 'Dog category', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_map`
--

DROP TABLE IF EXISTS `tbl_map`;
CREATE TABLE IF NOT EXISTS `tbl_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`,`category_id`),
  KEY `product_id_2` (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_map`
--

INSERT INTO `tbl_map` (`id`, `product_id`, `category_id`) VALUES
(1, 1, 1),
(4, 1, 1),
(2, 1, 2),
(3, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` double NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `manufacture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `description`, `price`, `image`, `manufacture`, `created_at`, `qty`) VALUES
(1, 'Nokia 1280', 'Nokia stupid phone', 400, '1_Nokia-1280.jpg', 'Nokia', '2014-05-03 01:28:49', 20),
(6, 'Nokia 1280', 'Nokia stupid phone', 400, '6_Nokia-1280.jpg', 'Nokia', '2014-05-03 05:49:37', 20),
(7, 'Sony XPeria', 'Smart Phone', 14000, '7_Sony-XPeria.jpg', 'Sony', '2014-05-03 05:57:57', 200);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `role` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'test1', 'pass1', 'test1@example.com', 0),
(2, 'test2', 'pass2', 'test2@example.com', 0),
(3, 'test3', 'pass3', 'test3@example.com', 0),
(4, 'test4', 'pass4', 'test4@example.com', 0),
(5, 'test5', 'pass5', 'test5@example.com', 0),
(6, 'test6', 'pass6', 'test6@example.com', 0),
(7, 'test7', 'pass7', 'test7@example.com', 0),
(8, 'test8', 'pass8', 'test8@example.com', 0),
(9, 'test9', 'pass9', 'test9@example.com', 0),
(10, 'test10', 'pass10', 'test10@example.com', 0),
(11, 'test11', 'pass11', 'test11@example.com', 0),
(12, 'test12', 'pass12', 'test12@example.com', 0),
(13, 'test13', 'pass13', 'test13@example.com', 0),
(14, 'test14', 'pass14', 'test14@example.com', 0),
(15, 'test15', 'pass15', 'test15@example.com', 0),
(16, 'test16', 'pass16', 'test16@example.com', 0),
(17, 'test17', 'pass17', 'test17@example.com', 0),
(18, 'test18', 'pass18', 'test18@example.com', 0),
(19, 'test19', 'pass19', 'test19@example.com', 0),
(20, 'test20', 'pass20', 'test20@example.com', 0),
(21, 'test21', 'pass21', 'test21@example.com', 0),
(22, 'admin', 'admin', 'admin@example.com', 1),
(23, 'demo', 'demo', 'demo@example.com', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_map`
--
ALTER TABLE `tbl_map`
  ADD CONSTRAINT `tbl_map_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_map_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
