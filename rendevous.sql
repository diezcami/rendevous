-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2016 at 06:41 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rendevous`
--

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
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `job_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` enum('dev','client') NOT NULL,
  `status` enum('accepted','not accepted') NOT NULL DEFAULT 'not accepted',
  `post_id` int(10) unsigned DEFAULT NULL,
  `poster_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned DEFAULT NULL,
  `developer_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`job_id`),
  UNIQUE KEY `post_id` (`post_id`),
  KEY `client_id` (`client_id`),
  KEY `developer_id` (`developer_id`),
  KEY `poster_id` (`poster_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `title`, `type`, `status`, `post_id`, `poster_id`, `client_id`, `developer_id`) VALUES
(1, 'Rendevou', 'client', 'not accepted', 6, 1, 1, NULL),
(2, 'Test', 'client', 'accepted', 11, 1, 1, 1),
(3, 'Looking for work', 'dev', 'not accepted', 12, 5, NULL, 5),
(5, 'New Job', 'client', 'not accepted', 15, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `job_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `description`, `timestamp`, `job_id`) VALUES
(6, 1, 'Hi guys, my team is looking to make a new site named "rendevous" where Cients can find Developers to make their system. Anyone willing to take the job?', '2016-05-17 17:48:53', 1),
(8, 1, 'Bump!', '2016-05-17 17:53:34', 1),
(9, 1, 'BUm Again!', '2016-05-17 17:55:27', 1),
(10, 5, 'hi, i''d like to make it', '2016-05-17 17:56:09', 1),
(11, 5, 'test me lorem ipsumtest me lorem ipsumtest me lorem ipsumtest me lorem ipsumtest me lorem ipsum', '2016-05-17 18:50:51', 2),
(12, 5, 'Hi! I''m  a fresh CS Grad looking for work. I know CI, PHP, HTML, JS, CSS. Please hire me. Thanks!', '2016-05-17 18:55:24', 3),
(15, 1, 'This is new job listing', '2016-05-19 16:47:26', 5);

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
  KEY `developer_id` (`developer_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `location` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `skills` text NOT NULL,
  `work_exp` text NOT NULL,
  `projects` text NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `sex`, `location`, `birthdate`, `skills`, `work_exp`, `projects`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '', '', NULL, NULL, NULL, 1268889823, 1463714902, 1, 'Admin', 'istrator', 'Male', 'Paranaque', '01 July 1995', '', '', '', 'ADMIN', '0'),
(5, '::1', NULL, '$2y$08$6aBPNPLBGwYE0K0soCt.3ufra4ee4RJWL201URbBnK6SvVhrxgr9.', NULL, 'basil@compsat.org', NULL, NULL, NULL, NULL, 1463488067, 1463507755, 1, 'Basil', 'Begonia', 'Male', '', '0000-00-00', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(3, 1, 1),
(4, 1, 2),
(8, 5, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD CONSTRAINT `blacklist_ibfk_1` FOREIGN KEY (`user_id_blocker`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `blacklist_ibfk_2` FOREIGN KEY (`user_id_blockee`) REFERENCES `users` (`id`);

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `jobs_ibfk_2` FOREIGN KEY (`developer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `jobs_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `jobs_ibfk_4` FOREIGN KEY (`poster_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`),
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`developer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
