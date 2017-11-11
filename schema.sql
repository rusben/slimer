-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2017 at 12:43 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.25-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slim.local`
--

-- --------------------------------------------------------

--
-- Table structure for table `example`
--

CREATE TABLE `example` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `example`
--

INSERT INTO `example` (`id`, `name`) VALUES
(1, 'Michael'),
(2, 'Joseph');

-- --------------------------------------------------------

--
-- Table structure for table `prestudent`
--

CREATE TABLE `prestudent` (
  `id` int(11) NOT NULL,
  `dni_nie` text COLLATE utf32_unicode_ci NOT NULL,
  `name` text COLLATE utf32_unicode_ci NOT NULL,
  `surnames` text COLLATE utf32_unicode_ci NOT NULL,
  `address` text COLLATE utf32_unicode_ci NOT NULL,
  `studies` text COLLATE utf32_unicode_ci NOT NULL,
  `born` date NOT NULL,
  `nim` text COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `prestudent`
--

INSERT INTO `prestudent` (`id`, `dni_nie`, `name`, `surnames`, `address`, `studies`, `born`, `nim`) VALUES
(1, '14413444', 'adsfasdf', 'asdfasdf', 'adsfadsf', 'adfadsf', '2017-11-01', ''),
(2, '252355', 'xdfssdfg', 'sdfgsdfg', 'sdfgsdfgfsdgsdfg', 'sdfgsdfg', '2017-11-01', ''),
(3, '0123456789F', 'John', 'Doe', 'Mountain View 17', 'ESO', '1999-11-01', '0123456789F20171112001145'),
(4, '0123456789F', 'John', 'Doe', 'Mountain View 17', 'ESO', '2017-11-01', '0123456789F20171112001109'),
(5, '0123456789F', 'John', 'Doe', 'Mountain View 17', 'ESO', '2017-11-01', '0123456789F20171112001107');

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(10) UNSIGNED NOT NULL,
  `order` int(10) UNSIGNED DEFAULT NULL,
  `uid` varchar(16) COLLATE utf32_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `completed` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `example`
--
ALTER TABLE `example`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prestudent`
--
ALTER TABLE `prestudent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `todos_uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `example`
--
ALTER TABLE `example`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `prestudent`
--
ALTER TABLE `prestudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
