-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2016 at 05:12 PM
-- Server version: 5.6.23-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `communityauth`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_sessions`
--

CREATE TABLE IF NOT EXISTS `auth_sessions` (
  `id` varchar(40) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_sessions`
--

INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES
('1ceef67e9ebb9ad5d406d28f82099c34406c0d71', 605775796, '2016-04-24 21:11:24', '2016-04-24 19:11:24', '::1', 'Chrome 49.0.2623.112 on Windows 8.1'),
('a17f67ce91884dce2a2c3c860b5116a068fd5da6', 605775796, '2016-05-01 12:35:35', '2016-05-01 10:35:35', '::1', 'Chrome 49.0.2623.112 on Windows 8.1'),
('3b37deaf29d06771d2e3e7c0f676525cc99c213f', 605775796, '2016-04-25 15:45:38', '2016-04-25 15:04:29', '::1', 'Chrome 49.0.2623.112 on Windows 8.1'),
('c6531b191cc358c1546323858ecc11de52b68071', 605775796, '2016-05-01 14:59:30', '2016-05-01 12:59:30', '::1', 'Chrome 49.0.2623.112 on Windows 8.1'),
('1788edf0cf3e9d718248989d35267d5dda0d2c8f', 605775796, '2016-05-01 15:40:40', '2016-05-01 13:40:40', '::1', 'Chrome 49.0.2623.112 on Windows 8.1'),
('73119ab9e487fec2ef38dc8c698756b860c1061c', 605775796, '2016-05-01 15:50:54', '2016-05-01 13:50:54', '::1', 'Chrome 49.0.2623.112 on Windows 8.1'),
('6a5ca018b578fa38fef9a4eccaf6eb21be4d702f', 605775796, '2016-05-01 15:54:08', '2016-05-01 13:54:08', '::1', 'Chrome 49.0.2623.112 on Windows 8.1'),
('074ff8e1e4ac88b0ddf30b0c6cd7dd1a43cde2bf', 605775796, '2016-05-01 15:55:52', '2016-05-01 13:55:52', '::1', 'Chrome 49.0.2623.112 on Windows 8.1'),
('b95f41b5419d47e17d43fb5bf9f4bba7febb04a1', 605775796, '2016-05-01 15:57:27', '2016-05-01 13:57:27', '::1', 'Chrome 49.0.2623.112 on Windows 8.1'),
('cbd596e42831d7012109f405d6efc393c4cfe465', 605775796, '2016-05-01 16:04:18', '2016-05-01 14:04:18', '::1', 'Chrome 49.0.2623.112 on Windows 8.1'),
('08ad0af56c3baeaaa7bab8d89314ed118fa9b6bb', 605775796, '2016-05-01 16:04:36', '2016-05-01 14:04:36', '::1', 'Chrome 49.0.2623.112 on Windows 8.1');

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE IF NOT EXISTS `blacklist` (
  `user_id_blocker` int(10) unsigned NOT NULL,
  `user_id_blockee` int(10) unsigned NOT NULL,
  KEY `user_id_blocker` (`user_id_blocker`),
  KEY `user_id_blockee` (`user_id_blockee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `denied_access`
--

CREATE TABLE IF NOT EXISTS `denied_access` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  `reason_code` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ips_on_hold`
--

CREATE TABLE IF NOT EXISTS `ips_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_errors`
--

CREATE TABLE IF NOT EXISTS `login_errors` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `login_errors`
--

INSERT INTO `login_errors` (`ai`, `username_or_email`, `ip_address`, `time`) VALUES
(18, 'admin', '::1', '2016-05-01 16:57:57'),
(17, 'admin', '::1', '2016-05-01 16:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `mail_notif_settings`
--

CREATE TABLE IF NOT EXISTS `mail_notif_settings` (
  `user_id` int(10) unsigned NOT NULL,
  `messages` text CHARACTER SET latin1 NOT NULL,
  `interested_in_idea` tinyint(1) NOT NULL,
  `rates` tinyint(1) NOT NULL COMMENT 'people rating you',
  `fares` tinyint(1) NOT NULL,
  `posts_with_tags` tinyint(1) NOT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `type` enum('dev','client') CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`tag_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` int(10) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `developer_id` int(10) unsigned NOT NULL,
  `specs` text NOT NULL,
  `status` enum('hiring','not hiring') NOT NULL,
  PRIMARY KEY (`transaction_id`),
  UNIQUE KEY `transaction_id` (`transaction_id`),
  KEY `client_id` (`client_id`),
  KEY `developer_id` (`developer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `username_or_email_on_hold`
--

CREATE TABLE IF NOT EXISTS `username_or_email_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL,
  `username` varchar(12) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL,
  `auth_level` tinyint(3) unsigned NOT NULL,
  `banned` enum('0','1') NOT NULL DEFAULT '0',
  `passwd` varchar(60) NOT NULL,
  `passwd_recovery_code` varchar(60) DEFAULT NULL,
  `passwd_recovery_date` datetime DEFAULT NULL,
  `passwd_modified_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `location` varchar(40) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `sex` tinyint(1) NOT NULL COMMENT 'true = male, false = female',
  `skills` varchar(255) NOT NULL,
  `work_exp` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`, `location`, `birthdate`, `first_name`, `last_name`, `sex`, `skills`, `work_exp`, `project`) VALUES
(605775796, 'user', 'user@example.com', 1, '0', '$2y$11$ofnVCQBDldzPrOhjUSK7purf4GM6zImj/XzC1PBCcpUVrvR56nSI2', NULL, NULL, NULL, '2016-05-01 16:04:36', '2016-04-19 11:21:53', '2016-05-01 14:04:36', NULL, '0000-00-00', '', '', 0, '', '', '');

--
-- Triggers `users`
--
DROP TRIGGER IF EXISTS `ca_passwd_trigger`;
DELIMITER //
CREATE TRIGGER `ca_passwd_trigger` BEFORE UPDATE ON `users`
 FOR EACH ROW BEGIN
    IF ((NEW.passwd <=> OLD.passwd) = 0) THEN
        SET NEW.passwd_modified_at = NOW();
    END IF;
END
//
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD CONSTRAINT `blacklist_ibfk_1` FOREIGN KEY (`user_id_blocker`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `blacklist_ibfk_2` FOREIGN KEY (`user_id_blockee`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `mail_notif_settings`
--
ALTER TABLE `mail_notif_settings`
  ADD CONSTRAINT `mail_notif_settings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`developer_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
