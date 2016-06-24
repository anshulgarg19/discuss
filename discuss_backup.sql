-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 24, 2016 at 05:38 PM
-- Server version: 5.7.12-0ubuntu1
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
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `a_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `a_content` text NOT NULL,
  `appropriate` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `answer_comment`
--

CREATE TABLE `answer_comment` (
  `a_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `c_id` int(11) NOT NULL,
  `c_content` text NOT NULL,
  `appropriate` tinyint(1) DEFAULT '1',
  `u_id` int(11) NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qstn_comment`
--

CREATE TABLE `qstn_comment` (
  `q_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qstn_tag`
--

CREATE TABLE `qstn_tag` (
  `q_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `q_id` int(11) NOT NULL,
  `q_content` text NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `a_count` int(5) NOT NULL DEFAULT '0',
  `appropriate` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(32) NOT NULL,
  `num_questions` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`, `num_questions`) VALUES
(1, 'education', 0),
(2, 'sports', 0),
(3, 'politics', 0),
(4, 'entertainment', 0),
(5, 'food', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `u_id` int(11) NOT NULL,
  `user_firstname` varchar(32) NOT NULL,
  `user_lastname` varchar(32) NOT NULL,
  `phone_num` varchar(11) NOT NULL,
  `email_id` varchar(256) NOT NULL,
  `profile_pic` varchar(512) NOT NULL,
  `reset_link` varchar(2048) DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(200) DEFAULT NULL,
  `appropriate` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`u_id`, `user_firstname`, `user_lastname`, `phone_num`, `email_id`, `profile_pic`, `reset_link`, `activated`, `password`, `appropriate`) VALUES
(1, 'Avishkar', 'Gupta', '2580565', 'adkljd', 'https://github.com/rootavish/me', NULL, 0, 'ddb6ae0a614871563f393708f1153201cecf16c6', 1),
(2, 'avishkar', 'gupta', '23498', 'avi', '', NULL, 0, 'f10e2821bbbea527ea02200352313bc059445190', 1),
(3, 'new', 'user', '34098', 'red', '', NULL, 0, 'd0be2dc421be4fcd0172e5afceea3970e2f3d940', 1),
(4, 'Avishkar', 'Gupta', '2147483647', 'rootavish@gmail.com', '', 'f6ac6b798f3d8911077a7508b6acd7954884e6dc56c9797b08c603ebec68009c4222d3fcd0e3f26ce0a462e99e31619276f135b231963837ccc0943506e64ff6', 0, '7ab515d12bd2cf431745511ac4ee13fed15ab578', 1),
(7, 'avishkar', 'gupta', '1239809421', 'avishkar.gupta.delhi@gmail.com', '', NULL, 1, 'ad5333beb0b6fda50a0eac3528495b97fc4b9902', 1),
(18, 'sdfkljlk', 'dfsklfjlkj', '9348971237', 'sdfkj@fdklfj.com', '', 'b15bbc216a49ef7917330907017de0d2edb2a333', 0, 'c91e465ca781304b3114a85fe8f4944e57d81c57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_qstn`
--

CREATE TABLE `user_qstn` (
  `u_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `type` enum('POST','FOLLOW') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_tag`
--

CREATE TABLE `user_tag` (
  `u_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tag`
--

INSERT INTO `user_tag` (`u_id`, `tag_id`) VALUES
(3, 1),
(3, 2),
(3, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `q_id` (`q_id`);

--
-- Indexes for table `answer_comment`
--
ALTER TABLE `answer_comment`
  ADD KEY `a_id` (`a_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `qstn_comment`
--
ALTER TABLE `qstn_comment`
  ADD KEY `q_id` (`q_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `qstn_tag`
--
ALTER TABLE `qstn_tag`
  ADD KEY `q_id` (`q_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `phone_num` (`phone_num`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- Indexes for table `user_qstn`
--
ALTER TABLE `user_qstn`
  ADD KEY `u_id` (`u_id`),
  ADD KEY `q_id` (`q_id`);

--
-- Indexes for table `user_tag`
--
ALTER TABLE `user_tag`
  ADD KEY `u_id` (`u_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_3` FOREIGN KEY (`u_id`) REFERENCES `user_profile` (`u_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answer_ibfk_4` FOREIGN KEY (`q_id`) REFERENCES `question` (`q_id`) ON DELETE CASCADE;

--
-- Constraints for table `answer_comment`
--
ALTER TABLE `answer_comment`
  ADD CONSTRAINT `answer_comment_ibfk_1` FOREIGN KEY (`a_id`) REFERENCES `answer` (`a_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answer_comment_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `comment` (`c_id`) ON DELETE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user_profile` (`u_id`) ON DELETE CASCADE;

--
-- Constraints for table `qstn_comment`
--
ALTER TABLE `qstn_comment`
  ADD CONSTRAINT `qstn_comment_ibfk_1` FOREIGN KEY (`q_id`) REFERENCES `question` (`q_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `qstn_comment_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `comment` (`c_id`) ON DELETE CASCADE;

--
-- Constraints for table `qstn_tag`
--
ALTER TABLE `qstn_tag`
  ADD CONSTRAINT `qstn_tag_ibfk_1` FOREIGN KEY (`q_id`) REFERENCES `question` (`q_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `qstn_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_qstn`
--
ALTER TABLE `user_qstn`
  ADD CONSTRAINT `user_qstn_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_profile` (`u_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_qstn_ibfk_2` FOREIGN KEY (`q_id`) REFERENCES `question` (`q_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_tag`
--
ALTER TABLE `user_tag`
  ADD CONSTRAINT `user_tag_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_profile` (`u_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
