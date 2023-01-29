-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for athtech_forum
CREATE DATABASE IF NOT EXISTS `athtech_forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `athtech_forum`;

-- Dumping structure for table athtech_forum.ckarma
CREATE TABLE IF NOT EXISTS `ckarma` (
  `users_id` int(11) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `ckarma_id` int(11) NOT NULL AUTO_INCREMENT,
  `votecap` int(11) DEFAULT NULL,
  PRIMARY KEY (`ckarma_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table athtech_forum.pkarma
CREATE TABLE IF NOT EXISTS `pkarma` (
  `users_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL DEFAULT 0,
  `pkarma_id` varchar(255) NOT NULL,
  `votecap` int(11) NOT NULL,
  PRIMARY KEY (`pkarma_id`),
  UNIQUE KEY `pkarma_id` (`pkarma_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table athtech_forum.post
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `users_id` int(11) NOT NULL,
  `post_upvote` int(11) NOT NULL,
  `post_downvote` int(11) NOT NULL,
  `post_karma` int(11) NOT NULL,
  `postimage` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`post_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
)  ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table athtech_forum.post_comments
CREATE TABLE IF NOT EXISTS `post_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `text` longtext DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `c_upvote` int(11) DEFAULT NULL,
  `c_downvote` int(11) DEFAULT NULL,
  `c_karma` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table athtech_forum.profiles
CREATE TABLE IF NOT EXISTS `profiles` (
  `profiles_id` int(11) NOT NULL AUTO_INCREMENT,
  `profiles_about` text NOT NULL,
  `profiles_title` text NOT NULL,
  `profile_pic` text NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`profiles_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table athtech_forum.survey
CREATE TABLE IF NOT EXISTS `survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `email` varchar(100) NOT NULL,
  `recKlep` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL,
  `comments` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table athtech_forum.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `users_pwd` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
