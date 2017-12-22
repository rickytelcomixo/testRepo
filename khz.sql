-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2017 at 06:22 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khz`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `METHOD` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PARAMS` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `POSITION` int(11) NOT NULL DEFAULT '1',
  `ICON` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fa fa-tasks',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`ID`, `TITLE`, `METHOD`, `PARAMS`, `POSITION`, `ICON`) VALUES
(1, 'Menu', 'menu', '', 2, 'fa fa-tasks'),
(2, 'Menu Access', 'menuAccess', '', 3, 'fa fa-tasks'),
(3, 'Pengguna', 'user', '', 4, 'fa fa-tasks'),
(4, 'Dashboard', 'dashboard', '', 1, 'fa fa-dashboard'),
(5, 'Profile', 'profile', '', 6, 'fa fa-user'),
(6, 'Jenis Pengguna', 'userType', '', 5, ' fa fa-tasks');

-- --------------------------------------------------------

--
-- Table structure for table `menu_access`
--

DROP TABLE IF EXISTS `menu_access`;
CREATE TABLE IF NOT EXISTS `menu_access` (
  `USERID` int(11) NOT NULL,
  `ENTITLEMENT` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MENUID` int(11) NOT NULL,
  KEY `USERID` (`USERID`),
  KEY `MENUID` (`MENUID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_access`
--

INSERT INTO `menu_access` (`USERID`, `ENTITLEMENT`, `MENUID`) VALUES
(1, 'add,edit,view,delete', 6),
(1, 'add,edit,view,delete', 3),
(1, 'add,edit,view,delete', 2),
(1, 'add,edit,view,delete', 1),
(1, 'add,edit,view,delete', 4),
(2, 'view', 6),
(2, 'view', 3),
(1, 'add,edit,view,delete', 5),
(2, 'view', 4),
(2, 'add,edit,view,delete', 5),
(3, 'add,edit,view,delete', 5),
(3, 'add,edit,view,delete', 3),
(3, 'view', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userTypeId` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locked` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userTypeId`, `username`, `password`, `fullname`, `email`, `phone`, `address`, `locked`) VALUES
(1, 1, 'admin', '12345', 'Admin', 'admin@khz.com', '0123456789', 'test address', 0),
(2, 3, 'staff', 'staff', 'Staff1', NULL, NULL, NULL, 0),
(3, 2, 'manager', '12345', 'Manager1', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `RANK` int(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`ID`, `TITLE`, `RANK`) VALUES
(1, 'Administrator', 1),
(2, 'Manager', 2),
(3, 'Staff', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
