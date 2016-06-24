-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 24, 2016 at 04:55 PM
-- Server version: 5.7.12-0ubuntu1.1
-- PHP Version: 5.6.22-4+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `discuss`
--

-- --------------------------------------------------------

--
-- Table structure for table `Answers`
--

CREATE TABLE `Answers` (
  `answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `answer_content` text NOT NULL,
  `appropriate` tinyint(1) DEFAULT '1',
  `last_modified_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `comment_id` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `appropriate` tinyint(1) DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment_on` enum('QUESTION','ANSWER') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Questions`
--

CREATE TABLE `Questions` (
  `question_id` int(11) NOT NULL,
  `question_content` text NOT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `answer_count` int(5) NOT NULL DEFAULT '0',
  `appropriate` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tags`
--

CREATE TABLE `Tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(32) NOT NULL,
  `question_count` int(11) DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tags_Questions`
--

CREATE TABLE `Tags_Questions` (
  `question_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `phone_num` int(11) NOT NULL,
  `email_id` varchar(256) NOT NULL,
  `profile_pic` varchar(512) NOT NULL,
  `reset_link` varchar(2048) DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(200) DEFAULT NULL,
  `appropriate` tinyint(1) DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `firstname`, `lastname`, `phone_num`, `email_id`, `profile_pic`, `reset_link`, `activated`, `password`, `appropriate`, `created_on`, `last_modified_on`) VALUES
(40, 'anshul', 'garg', 2147483647, 'anshulgarg5278@gmail.com', '1', NULL, 1, '1f8ac10f23c5b5bc1167bda84b833e5c057a77d2', 1, '2016-06-24 16:47:41', '2016-06-24 16:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `Users_Questions`
--

CREATE TABLE `Users_Questions` (
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `type` enum('POST','FOLLOW') DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users_Tags`
--

CREATE TABLE `Users_Tags` (
  `user_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Answers`
--
ALTER TABLE `Answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `u_id` (`user_id`),
  ADD KEY `q_id` (`question_id`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `u_id` (`user_id`);

--
-- Indexes for table `Questions`
--
ALTER TABLE `Questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `Tags`
--
ALTER TABLE `Tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Indexes for table `Tags_Questions`
--
ALTER TABLE `Tags_Questions`
  ADD KEY `q_id` (`question_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone_num` (`phone_num`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- Indexes for table `Users_Questions`
--
ALTER TABLE `Users_Questions`
  ADD KEY `u_id` (`user_id`),
  ADD KEY `q_id` (`question_id`);

--
-- Indexes for table `Users_Tags`
--
ALTER TABLE `Users_Tags`
  ADD KEY `u_id` (`user_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Answers`
--
ALTER TABLE `Answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Questions`
--
ALTER TABLE `Questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Tags`
--
ALTER TABLE `Tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Answers`
--
ALTER TABLE `Answers`
  ADD CONSTRAINT `Answers_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Answers_ibfk_4` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`question_id`) ON DELETE CASCADE;

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `Tags_Questions`
--
ALTER TABLE `Tags_Questions`
  ADD CONSTRAINT `Tags_Questions_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`question_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Tags_Questions_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `Tags` (`tag_id`) ON DELETE CASCADE;

--
-- Constraints for table `Users_Questions`
--
ALTER TABLE `Users_Questions`
  ADD CONSTRAINT `Users_Questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Users_Questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`question_id`) ON DELETE CASCADE;

--
-- Constraints for table `Users_Tags`
--
ALTER TABLE `Users_Tags`
  ADD CONSTRAINT `Users_Tags_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Users_Tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `Tags` (`tag_id`) ON DELETE CASCADE;


ALTER TABLE `Users` CHANGE `phone_num` `phone_num` VARCHAR(15) NOT NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
