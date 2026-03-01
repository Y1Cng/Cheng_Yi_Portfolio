-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 10, 2025 at 06:38 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `y1cng118_portfolio`
--
ALTER DATABASE `y1cng118_portfolio` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(54, 'admin', '123456'),
(80, '123@123.com', '333');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `created`, `message`, `phone`) VALUES
(1, '123', '549818746@qq.com', '2025-12-06 06:47', '123123123123', '1231231231'),
(2, '1', 'kljgfajl@fa.com', '2025-12-09 19:34:42', 'lafijaf', '124135253'),
(3, 'afgsafds', 'LJHF@lkjafs.com', '2025-12-09 19:52:49', 'afgsafds', 'afgsafds'),
(4, 'fadsklankfld;na;flknkljnaf', 'aflnk@lhjkf.com', '2025-12-10 16:49:56', 'kalfdj', 'afjkn123'),
(5, '1231', 'ga@afag.com', '2025-12-10 17:00:30', 'aoifaf', '2398054423'),
(6, 'klfsm', 'klMDFS@gkflsz.com', '2025-12-10 17:29:01', 'afdafgsafg', '12341452');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int UNSIGNED NOT NULL,
  `project` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Add soft delete column to project table
ALTER TABLE `project` ADD COLUMN `is_deleted` TINYINT(1) NOT NULL DEFAULT 0 AFTER `flag`;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project`, `flag`) VALUES
(1, 'Flowsonic Earbuds Promo Page', 'UI & UX'),
(2, 'Sports Intro Project', 'Motion Graphics'),
(3, 'Quatro 80s Beverage Rebranding', 'Rebrand'),
(4, 'Portfolio Contact Form', 'Backend'),
(5, 'Project 5', 'UI & UX'),
(6, 'Project 6', 'Backend');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
