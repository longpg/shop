-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2014 at 07:59 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET FOREIGN_KEY_CHECKS=0;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_map`
--

INSERT INTO `tbl_map` (`id`, `product_id`, `category_id`) VALUES
(21, 1, 2),
(22, 1, 3),
(19, 1, 4),
(20, 1, 7),
(11, 11, 2),
(13, 11, 5),
(14, 11, 6),
(16, 11, 7);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `description`, `price`, `image`, `manufacture`, `created_at`, `qty`) VALUES
(1, 'Nokia 1280', 'Nokia stupid phone', 400, '1_Nokia-1280.jpg', 'Nokia', '2014-05-03 01:28:49', 20),
(6, 'Nokia 1280', 'Nokia stupid phone', 400, '6_Nokia-1280.jpg', 'Nokia', '2014-05-03 05:49:37', 20),
(7, 'Sony XPeria', 'Smart Phone', 14000, '7_Sony-XPeria.jpg', 'Sony', '2014-05-03 05:57:57', 200),
(8, 'Nokia 1202', 'Nokia ném chó ch?t chó', 350, NULL, 'Nokia', '2014-05-06 16:09:10', 500),
(9, 'Nokia 1280', 'Nokia stupid phone', 350, NULL, 'Nokia', '2014-05-06 17:12:27', 200),
(10, 'Nokia 1280', 'Nokia stupid phone', 350, NULL, 'Nokia', '2014-05-06 17:12:43', 200),
(11, 'Nokia 1280', 'Nokia stupid phone', 350, NULL, 'Nokia', '2014-05-06 17:14:28', 200);

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
(1, 'test1', 'a722c63db8ec8625af6cf71cb8c2d939', 'test1@example.com', 0),
(2, 'test2', 'c1572d05424d0ecb2a65ec6a82aeacbf', 'test2@example.com', 0),
(3, 'test3', '3afc79b597f88a72528e864cf81856d2', 'test3@example.com', 0),
(4, 'test4', 'fc2921d9057ac44e549efaf0048b2512', 'test4@example.com', 0),
(5, 'test5', 'd35f6fa9a79434bcd17f8049714ebfcb', 'test5@example.com', 0),
(6, 'test6', 'e9568c9ea43ab05188410a7cf85f9f5e', 'test6@example.com', 0),
(7, 'test7', '8c96c3884a827355aed2c0f744594a52', 'test7@example.com', 0),
(8, 'test8', 'ccd3cd18225730c5edfc69f964b9d7b3', 'test8@example.com', 0),
(9, 'test9', 'c28cce9cbd2daf76f10eb54478bb0454', 'test9@example.com', 0),
(10, 'test10', 'a3224611fd03510682690769d0195d66', 'test10@example.com', 0),
(11, 'test11', '0102812fbd5f73aa18aa0bae2cd8f79f', 'test11@example.com', 0),
(12, 'test12', '0bd0fe6372c64e09c4ae81e056a9dbda', 'test12@example.com', 0),
(13, 'test13', 'c868bff94e54b8eddbdbce22159c0299', 'test13@example.com', 0),
(14, 'test14', 'd1f38b569c772ebb8fa464e1a90c5a00', 'test14@example.com', 0),
(15, 'test15', 'b279786ec5a7ed00dbe4d3fe1516c121', 'test15@example.com', 0),
(16, 'test16', '66c99bf933f5e6bf3bf2052d66577ca8', 'test16@example.com', 0),
(17, 'test17', '6c2a5c9ead1d7d6ba86c8764d5cad395', 'test17@example.com', 0),
(18, 'test18', '64152ab7368fc7ca6b3ef6b71e330b86', 'test18@example.com', 0),
(19, 'test19', '1f61b744f2c9e8f49ae4c4965f39963f', 'test19@example.com', 0),
(20, 'test20', '90bfa11df19a9b9d429ccfa6997104df', 'test20@example.com', 0),
(21, 'test21', '5cddd1f7857fd4ab8095f676fcf88835', 'test21@example.com', 0),
(22, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@example.com', 1),
(23, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_map`
--
ALTER TABLE `tbl_map`
  ADD CONSTRAINT `tbl_map_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_map_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
