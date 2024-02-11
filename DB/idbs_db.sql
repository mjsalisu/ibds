-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 11, 2024 at 11:38 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idbs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `donatedBy` varchar(20) NOT NULL,
  `donatedTo` varchar(20) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `about` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `state` varchar(20) NOT NULL,
  `lga` varchar(50) NOT NULL,
  `regno` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL,
  `cgpa` varchar(5) NOT NULL,
  `disability` varchar(20) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `phone`, `email`, `gender`, `state`, `lga`, `regno`, `level`, `cgpa`, `disability`, `createdAt`, `status`) VALUES
(9, 'Student 1', '1234567890', 'student1@example.com', 'Male', 'Lagos', 'LGA1', 'REG00001', '200', '3.50', 'Healthy', '2024-01-28 16:13:11', 1),
(10, 'Student 2', '1234567890', 'student2@example.com', 'Female', 'Abia', 'LGA2', 'REG00002', '400', '2.80', 'Healthy', '2024-01-28 16:13:10', 0),
(11, 'Student 3', '1234567890', 'student3@example.com', 'Male', 'Kano', 'LGA3', 'REG00003', '300', '4.10', 'Yes', '2024-01-28 16:13:10', 1),
(12, 'Student 4', '1234567890', 'student4@example.com', 'Female', 'Oyo', 'LGA4', 'REG00004', '200', '3.75', 'Healthy', '2024-01-28 16:13:10', 0),
(13, 'Student 5', '1234567890', 'student5@example.com', 'Male', 'Edo', 'LGA5', 'REG00005', '400', '4.25', 'Yes', '2024-01-28 16:13:05', 1),
(14, 'Student 6', '1234567890', 'student6@example.com', 'Female', 'Anambra', 'LGA6', 'REG00006', '500', '3.90', 'Healthy', '2024-01-28 16:13:10', 0),
(15, 'Student 7', '1234567890', 'student7@example.com', 'Male', 'Kaduna', 'LGA7', 'REG00007', '300', '2.60', 'Healthy', '2024-01-28 16:13:10', 1),
(16, 'Student 8', '1234567890', 'student8@example.com', 'Female', 'Delta', 'LGA8', 'REG00008', '500', '4.50', 'Yes', '2024-01-28 16:13:10', 0),
(17, 'Student 9', '1234567890', 'student9@example.com', 'Male', 'Rivers', 'LGA9', 'REG00009', '200', '3.20', 'Healthy', '2024-01-28 16:13:10', 1),
(18, 'Student 10', '1234567890', 'student10@example.com', 'Female', 'Enugu', 'LGA10', 'REG00010', '400', '4.00', 'Healthy', '2024-01-28 16:13:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `regNo` varchar(30) DEFAULT NULL,
  `faculty` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(2) NOT NULL COMMENT '0 = user, 1 = admin',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `regNo`, `faculty`, `department`, `phone`, `password`, `role`, `created_at`) VALUES
(4, 'Administrator', 'admin@email.com', NULL, NULL, NULL, '08011223344', 'admin', 1, '2023-11-17 23:32:20'),
(5, 'User', 'user@email.com', NULL, NULL, NULL, '07066778899', 'user', 0, '2023-11-17 23:41:30'),
(7, 'Jamilu Salisu', 'jamilusalis@gmail.com', NULL, NULL, NULL, '08028752833', 'mjtech', 0, '2023-11-19 12:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `donatedBy` int(20) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Department Wallet';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
