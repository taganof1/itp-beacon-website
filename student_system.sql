-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 02:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `subject` enum('Test1','Test2','Test3','Test4') DEFAULT NULL,
  `logintime` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `password`, `firstname`, `lastname`, `course`, `student_id`, `subject`, `logintime`) VALUES
(1, 'Sof8452024', '12345', 'Michelle', 'Chaunkaria', 'Software Engineering ', 'Sof8452024', NULL, 'No data received.'),
(2, 'com9282024', '123123', 'ozair', 'ali', 'computer science', 'com9282024', NULL, '2024-03-01 20:35:11'),
(3, 'ITP8722024', '123123', 'Hisham', 'H', 'ITP', 'ITP8722024', NULL, '2024-03-01 20:26:43'),
(4, 'Dat2632024', '12345', 'Vikas', 'N', 'Data', 'Dat2632024', NULL, '2024-03-01 20:24:26'),
(5, 'Shi9662024', '12345', 'Cut our', ' Loses', 'Shit', 'Shi9662024', NULL, '2024-03-01 20:17:52'),
(6, 'shi4762024', '12345', 'm', 'c', 'shit', 'shi4762024', NULL, '2024-03-01 20:35:59'),
(7, 'Idk4072024', '12345', 'Vikas', 'Boss', 'Idk', 'Idk4072024', NULL, '2024-03-01 20:39:27'),
(8, 'may6702024', '12345', 'yes', 'no', 'maybe', 'may6702024', NULL, '2024-03-01 19:42:24'),
(9, 'idk9632024', '12345', 'idk', 'idk', 'idk', 'idk9632024', NULL, '2024-03-06 17:42:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
