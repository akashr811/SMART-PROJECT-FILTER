-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2021 at 04:07 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spf`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`) VALUES
(1, 'CSE'),
(2, 'ECE'),
(3, 'EEE'),
(4, 'ISE');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_group_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `desc` varchar(2000) NOT NULL,
  `doc` varchar(200) DEFAULT NULL,
  `is_approve` int(1) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_group_id`, `title`, `desc`, `doc`, `is_approve`, `date`) VALUES
(1, 3, 'Hindu Portal (VedVakya, Vedvaani, hinduworld, everythingindian, unitedhindu).com', 'The Hindu portal will be a single window into everything about Hindu philosophy, religion, practices, rituals, and science of the vedas. Each section of the portal will have in-depth information on all of the below segments. The portal will be an on-line membership portal where every Hindu in the world can become and member and get benefits on products and programs run by collection of its members.', 'project_1.docx', 0, '2018-05-23'),
(2, 3, 'Goods Transport Portal', 'An application to maintain track of goods to be shifted along with the charges for it.\r\nIt also helps to maintain the inventory.', 'project_2.docx', 0, '2018-05-23'),
(3, 3, 'Desi Cow Products Re-Seller', 'An application to provide the by products of desi cow like milk, ghee, butter e.t.c to the needy customers.\r\nThe application is the interface between the manufacturers and end customers like amazon.', 'project_3.docx', 0, '2018-05-23'),
(11, 6, 'Smart Project Filter', 'This project is about developing an web application for collecting project details and save it in  repository or database.\r\n \r\nEvery authorized user can find any project by filtering it using keyword or tags and title.\r\n\r\nIt will reduce manual work of any user by 90%.', 'project_11.pptx', 0, '2018-05-23'),
(12, 11, 'Smart Project filter New', 'Smart Project filter New', 'project_12.png', 0, '2021-01-13'),
(13, 11, 'Smart Project filter New1', 'Smart Project filter New1', 'project_13.jpg', 0, '2021-01-13'),
(14, 12, 'abc', 'wertyuioasdfghjkzxcvbnm', 'project_14.jpg', 0, '2021-01-14'),
(15, 15, 'Smart Project filter', 'Smart Project filterSmart Project filterSmart Project filterSmart Project filterSmart Project filterSmart Project filterSmart Project filterSmart Project filterSmart Project filterSmart Project filterSmart Project filterSmart Project filterSmart Project filterSmart Project filterSmart Project filterSmart Project filter', 'project_15.jpg', 0, '2021-01-14'),
(16, 17, 'Smart Project filter', 'qwertyuiopsdfghjkxcvbnm234567894567dfghjc34567856786789yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', 'project_16.jpg', 0, '2021-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `projects_tags_map`
--

DROP TABLE IF EXISTS `projects_tags_map`;
CREATE TABLE IF NOT EXISTS `projects_tags_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects_tags_map`
--

INSERT INTO `projects_tags_map` (`id`, `project_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 11),
(10, 3, 1),
(11, 3, 2),
(12, 3, 3),
(13, 3, 4),
(14, 2, 5),
(15, 2, 6),
(16, 2, 8),
(17, 2, 9),
(45, 11, 1),
(46, 11, 2),
(47, 11, 3),
(48, 11, 4),
(49, 11, 5),
(63, 12, 1),
(64, 12, 5),
(66, 13, 2),
(67, 13, 15),
(68, 14, 2),
(69, 14, 7),
(70, 15, 2),
(71, 15, 4),
(74, 16, 2),
(75, 16, 3);

-- --------------------------------------------------------

--
-- Table structure for table `project_groups`
--

DROP TABLE IF EXISTS `project_groups`;
CREATE TABLE IF NOT EXISTS `project_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `guide_id` int(11) NOT NULL DEFAULT '0',
  `group_number` varchar(100) DEFAULT NULL,
  `member_1` varchar(200) NOT NULL,
  `member_2` varchar(200) NOT NULL,
  `member_3` varchar(200) NOT NULL,
  `member_4` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_groups`
--

INSERT INTO `project_groups` (`id`, `branch_id`, `email_id`, `user_role_id`, `guide_id`, `group_number`, `member_1`, `member_2`, `member_3`, `member_4`, `phone`, `date`, `password`) VALUES
(1, 1, 'admin@spf.com', 1, 0, 'admin', '', '', '', '', '999999999', '2018-05-23', 'password'),
(16, 2, 'sri@gmail.com', 2, 0, 'ECEGUIDE16', '', '', '', '', '1234567899', '2021-01-14', 'guide1'),
(17, 2, 'maheshbellad@gmail.com', 3, 16, 'ECEGROUP17', 'a', 'b', 'c', 'd', '8317319661', '2021-01-14', '123'),
(18, 1, 'guide1@gmail.com', 2, 0, 'CSEGUIDE18', '', '', '', '', '34567892', '2021-01-15', '9999'),
(19, 1, 'sri@gmail.com', 3, 18, 'CSEGROUP19', '1', '2', '3', '4', '34569876', '2021-01-15', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'php'),
(2, 'Jquery'),
(3, 'HTML'),
(4, 'CSS'),
(5, 'dbms'),
(6, 'Oracle'),
(7, 'C'),
(8, 'C#'),
(9, '.net'),
(10, 'python'),
(11, 'web'),
(12, 'pascal'),
(13, 'PHP Project'),
(14, 'Tag'),
(15, 'Android'),
(16, 'ios');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Guide'),
(3, 'Project Group');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
