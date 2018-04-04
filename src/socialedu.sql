-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Nis 2018, 17:26:47
-- Sunucu sürümü: 10.1.21-MariaDB
-- PHP Sürümü: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `socialedu`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_general_mysql500_ci NOT NULL,
  `creator` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `statusID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `category_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `creator`, `created`, `statusID`, `categoryID`, `insert_date`, `update_date`, `category_status`) VALUES
(1, 'programming', 'all about programming', 12346, '2018-03-17 13:33:55', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('fljn3nbcnac4obr6a8ff4qda7dldklhe', '127.0.0.1', 1520357696, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303335373639363b),
('shuarfal3oohd62gera7ecggss2743h3', '127.0.0.1', 1520357897, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303335373639363b),
('c3m9k4jlc3q2cbqjq84ebvgkoeprpch6', '127.0.0.1', 1520451779, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303435313737393b),
('mp5r7ourr05qesckio2qrnv3ufdq9lfi', '127.0.0.1', 1520451897, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303435313737393b),
('lu1thns4o13hink6ovrquhtoemsrcgia', '127.0.0.1', 1520591562, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303539313536323b),
('2kgba1alsuupc5djen64v0oa5jlct5ct', '127.0.0.1', 1520870409, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303837303430393b),
('r8bb2f87vnk49o1sjak7rja4jgmse2ih', '127.0.0.1', 1521104331, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532313130343333313b),
('2b0bbn9fpq8e7ai4o3sjpuss9dm75pl5', '127.0.0.1', 1521847684, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532313834373531333b);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `content` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `thread_id` int(11) NOT NULL,
  `user_account_id` int(11) NOT NULL,
  `postStatus` int(11) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Tablo döküm verisi `post`
--

INSERT INTO `post` (`id`, `subject`, `content`, `created`, `thread_id`, `user_account_id`, `postStatus`, `insert_date`, `update_date`, `status`, `category_id`) VALUES
(1, 'boşboşboş', 'bu bir deneme postudur.', '2018-03-17 13:34:52', 1, 12346, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `prtgroups`
--

CREATE TABLE `prtgroups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `categoryID` int(11) NOT NULL,
  `userGroupID` int(11) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Tablo döküm verisi `prtgroups`
--

INSERT INTO `prtgroups` (`id`, `name`, `categoryID`, `userGroupID`, `insert_date`, `update_date`, `status`) VALUES
(1, 'Banlananlar', 1, 1, '2018-03-17 13:30:34', '0000-00-00 00:00:00', 1),
(2, 'Moderatör', 1, 2, '2018-03-17 13:30:34', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `prtstatus`
--

CREATE TABLE `prtstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Tablo döküm verisi `prtstatus`
--

INSERT INTO `prtstatus` (`id`, `name`, `insert_date`, `update_date`, `status`) VALUES
(1, 'approved', '2018-03-17 13:31:13', '0000-00-00 00:00:00', 1),
(2, 'banned', '2018-03-17 13:31:13', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `prtusergroup`
--

CREATE TABLE `prtusergroup` (
  `userID` int(11) NOT NULL,
  `groupsID` int(11) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Tablo döküm verisi `prtusergroup`
--

INSERT INTO `prtusergroup` (`userID`, `groupsID`, `insert_date`, `update_date`, `status`) VALUES
(12345, 1, '2018-03-17 13:31:52', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `prtuserstatus`
--

CREATE TABLE `prtuserstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Tablo döküm verisi `prtuserstatus`
--

INSERT INTO `prtuserstatus` (`id`, `name`, `insert_date`, `update_date`, `status`) VALUES
(12, 'approved', '2018-03-17 13:29:28', '0000-00-00 00:00:00', 1),
(13, 'banned', '2018-03-17 13:29:28', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `thread`
--

CREATE TABLE `thread` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userAccountID` int(11) NOT NULL,
  `threadStatus` int(11) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Tablo döküm verisi `thread`
--

INSERT INTO `thread` (`id`, `subject`, `created`, `userAccountID`, `threadStatus`, `insert_date`, `update_date`, `status`, `category_id`) VALUES
(123456789, 'learnpython', '2018-03-17 13:33:09', 12346, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `useraccount`
--

CREATE TABLE `useraccount` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `hashed_password` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_general_mysql500_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `picture` blob NOT NULL,
  `last_activity` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_moderator` tinyint(1) NOT NULL,
  `status` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `user_status` int(11) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_account_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Tablo döküm verisi `useraccount`
--

INSERT INTO `useraccount` (`id`, `username`, `hashed_password`, `first_name`, `last_name`, `email`, `created`, `picture`, `last_activity`, `is_moderator`, `status`, `user_status`, `insert_date`, `update_date`, `user_account_status`) VALUES
(12345, 'deneme1', 'deneme1deneme', 'recdeneme', 'cadeneme', 'deneme@deneme.edu.tr', '2018-03-17 13:28:38', '', '0000-00-00 00:00:00', 1, 'approved', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(12346, 'deneme2', 'deneme2deneme', 'recdeneme', 'candeneme', 'deneme2@deneme.edu.tr', '2018-03-17 13:28:38', '', '0000-00-00 00:00:00', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `up_count` int(11) NOT NULL,
  `down_count` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `category_ibfk_1` (`statusID`),
  ADD KEY `creator` (`creator`);

--
-- Tablo için indeksler `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`postStatus`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `user_account_id` (`user_account_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Tablo için indeksler `prtgroups`
--
ALTER TABLE `prtgroups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Tablo için indeksler `prtstatus`
--
ALTER TABLE `prtstatus`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `prtusergroup`
--
ALTER TABLE `prtusergroup`
  ADD PRIMARY KEY (`userID`,`groupsID`),
  ADD KEY `groupsID` (`groupsID`);

--
-- Tablo için indeksler `prtuserstatus`
--
ALTER TABLE `prtuserstatus`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`threadStatus`),
  ADD KEY `userAccountID` (`userAccountID`);

--
-- Tablo için indeksler `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_status` (`user_status`);

--
-- Tablo için indeksler `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `thread_id` (`thread_id`);

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
