-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 12, 2018 at 05:00 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialedu`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_general_mysql500_ci NOT NULL,
  `creator` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `statusID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `category_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('fljn3nbcnac4obr6a8ff4qda7dldklhe', '127.0.0.1', 1520357696, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303335373639363b),
('shuarfal3oohd62gera7ecggss2743h3', '127.0.0.1', 1520357897, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303335373639363b),
('c3m9k4jlc3q2cbqjq84ebvgkoeprpch6', '127.0.0.1', 1520451779, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303435313737393b),
('mp5r7ourr05qesckio2qrnv3ufdq9lfi', '127.0.0.1', 1520451897, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303435313737393b),
('lu1thns4o13hink6ovrquhtoemsrcgia', '127.0.0.1', 1520591562, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303539313536323b),
('2kgba1alsuupc5djen64v0oa5jlct5ct', '127.0.0.1', 1520870409, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303837303430393b);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `content` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `thread_id` int(11) NOT NULL,
  `user_account_id` int(11) NOT NULL,
  `postStatus` int(11) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prtGroups`
--

CREATE TABLE `prtGroups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `categoryID` int(11) NOT NULL,
  `userGroupID` int(11) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prtStatus`
--

CREATE TABLE `prtStatus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prtUserGroup`
--

CREATE TABLE `prtUserGroup` (
  `userID` int(11) NOT NULL,
  `groupsID` int(11) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prtUserStatus`
--

CREATE TABLE `prtUserStatus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userAccountID` int(11) NOT NULL,
  `threadStatus` int(11) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userAccount`
--

CREATE TABLE `userAccount` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `hashed_password` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_general_mysql500_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `picture` blob NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_moderator` tinyint(1) NOT NULL,
  `status` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `user_status` int(11) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_account_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `up_count` int(11) NOT NULL,
  `down_count` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `category_ibfk_1` (`statusID`),
  ADD KEY `creator` (`creator`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`postStatus`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `user_account_id` (`user_account_id`);

--
-- Indexes for table `prtGroups`
--
ALTER TABLE `prtGroups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `prtStatus`
--
ALTER TABLE `prtStatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prtUserGroup`
--
ALTER TABLE `prtUserGroup`
  ADD PRIMARY KEY (`userID`,`groupsID`),
  ADD KEY `groupsID` (`groupsID`);

--
-- Indexes for table `prtUserStatus`
--
ALTER TABLE `prtUserStatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`threadStatus`),
  ADD KEY `userAccountID` (`userAccountID`);

--
-- Indexes for table `userAccount`
--
ALTER TABLE `userAccount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_status` (`user_status`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `thread_id` (`thread_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
