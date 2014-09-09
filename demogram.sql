-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2014 at 06:35 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demogram`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_parent_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `category_name` varchar(255) NOT NULL,
  UNIQUE KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category_photos`
--

CREATE TABLE IF NOT EXISTS `category_photos` (
  `category_id` bigint(20) unsigned NOT NULL,
  `photo_id` bigint(20) unsigned NOT NULL,
  UNIQUE KEY `category_photo_id_idx` (`category_id`,`photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment` varchar(225) CHARACTER SET utf8mb4 NOT NULL,
  `comment_writer` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment`, `comment_writer`) VALUES
('LOL', 'romrick4'),
('LOL', 'romrick4'),
('LOL', 'romrick4'),
('yes', 'romrick4');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `user_id` bigint(20) unsigned NOT NULL,
  `user_friend_id` bigint(20) unsigned NOT NULL,
  `friend_added_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `friend_status` tinyint(4) NOT NULL DEFAULT '1',
  UNIQUE KEY `user_and_friend_id_idx` (`user_id`,`user_friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `photo_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `like_type` tinyint(4) NOT NULL,
  `like_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `photo_user_id_idx` (`photo_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`photo_id`, `user_id`, `like_type`, `like_date`) VALUES
(4, 2, 1, '2014-07-30 11:38:37'),
(5, 2, 1, '2014-07-29 11:04:18'),
(7, 2, 1, '2014-07-29 11:29:25'),
(8, 2, 1, '2014-08-04 16:27:13'),
(10, 2, 1, '2014-08-10 12:32:38'),
(11, 2, -1, '2014-08-11 13:52:15'),
(11, 3, 1, '2014-08-10 12:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo_name` varchar(255) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `photo_filename` varchar(255) NOT NULL,
  `photo_filetype` varchar(255) NOT NULL,
  `photo_added_on_date` datetime NOT NULL,
  `photo_caption` varchar(225) NOT NULL,
  UNIQUE KEY `photo_id` (`photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `photo_name`, `photo_path`, `photo_filename`, `photo_filetype`, `photo_added_on_date`, `photo_caption`) VALUES
(1, '1488722_661595867230392_887231720_n.jpg', 'uploads/1/', '1488722_661595867230392_887231720_n', 'jpg', '2014-07-15 23:29:46', ''),
(2, 'umfsbfc.jpg', 'uploads/u/', 'umfsbfc', 'jpg', '2014-07-15 23:30:32', ''),
(3, '14494_10151664819397393_1242279205_n.jpg', 'uploads/1/', '14494_10151664819397393_1242279205_n', 'jpg', '2014-07-16 16:45:01', ''),
(4, '1389251286924.jpg', 'uploads/1/', '1389251286924', 'jpg', '2014-07-16 17:01:19', ''),
(5, 'bdrx7an.jpg', 'uploads/b/', 'bdrx7an', 'jpg', '2014-07-16 17:57:05', ''),
(6, 'dota2.png', 'uploads/d/', 'dota2', 'png', '2014-07-16 18:02:39', ''),
(7, 'asdfasd.png', 'uploads/a/', 'asdfasd', 'png', '2014-07-16 18:05:17', ''),
(8, '1399147756529.jpg', 'uploads/1/', '1399147756529', 'jpg', '2014-07-30 22:25:22', ''),
(9, '1399021556517.jpg', 'uploads/1/', '1399021556517', 'jpg', '2014-07-30 22:32:42', ''),
(10, '0wstv3q.jpg', 'uploads/0/', '0wstv3q', 'jpg', '2014-08-08 18:40:45', ''),
(11, '1522133_590412184360253_2035460032_n.jpg', 'uploads/1/', '1522133_590412184360253_2035460032_n', 'jpg', '2014-08-09 15:48:43', 'Breathes Heavily'),
(12, 'islirv7.gif', 'uploads/i/', 'islirv7', 'gif', '2014-08-11 01:43:43', 'Super Strength');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_first_name` varchar(255) NOT NULL,
  `user_last_name` varchar(255) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_creation_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_status` tinyint(4) NOT NULL DEFAULT '0',
  `user_password` varchar(255) NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first_name`, `user_last_name`, `user_username`, `user_email`, `user_creation_date`, `user_updated_date`, `user_status`, `user_password`) VALUES
(2, 'Richard', 'Romero', 'romrick4', 'romrick4@gmail.com', '2014-07-15 23:29:10', '0000-00-00 00:00:00', 0, '$2y$10$lfqnN2NzWrqNIPV195urf.WNmEi7cLfekWviyrMYs0dlVZEmgsG6O'),
(3, 'Timmy', 'Turner', 'TimmyT', 'asdf@gmail.com', '2014-08-03 16:15:14', '0000-00-00 00:00:00', 0, '$2y$10$u99qcSjZEduQ0Ikobe4sHemK9GJt4Xic.Fj0uXb74G8bkmAwStZwi');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
