-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2024 at 03:58 PM
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
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `acad_yr_tbl`
--

CREATE TABLE `acad_yr_tbl` (
  `acad_id` int(11) NOT NULL,
  `year_start` year(4) NOT NULL,
  `year_end` year(4) NOT NULL,
  `semester` int(11) NOT NULL,
  `is_default` tinyint(2) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_yr_tbl`
--

INSERT INTO `acad_yr_tbl` (`acad_id`, `year_start`, `year_end`, `semester`, `is_default`, `deleted`) VALUES
(1, '2024', '2025', 1, 1, 0),
(2, '2024', '2025', 2, 0, 0),
(3, '2024', '2025', 3, 0, 0),
(4, '2025', '2026', 1, 0, 0),
(5, '2025', '2026', 2, 0, 0),
(6, '2025', '2026', 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `ext_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `deleted` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `first_name`, `middle_name`, `last_name`, `ext_name`, `email`, `deleted`) VALUES
(1, 'ADMINIS', '', 'TRAITOR', '', 'admin@pcb.edu.ph', 1),
(6, 'ADMIN', 'IS', 'TRAITOR', '', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE `attendance_tbl` (
  `attendance_id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `acad_id` int(11) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `date_time` datetime NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_tbl`
--

INSERT INTO `attendance_tbl` (`attendance_id`, `uid`, `student_id`, `acad_id`, `type`, `date_time`, `deleted`) VALUES
(233, '7B86B812', 6, 1, 1, '2024-04-27 07:52:39', 0),
(234, '7B86B812', 6, 1, 2, '2024-04-27 07:52:42', 0),
(235, '7B86B812', 6, 1, 1, '2024-04-27 07:52:46', 0),
(236, '7B86B812', 6, 1, 2, '2024-04-27 07:52:49', 0),
(237, '62369751', 1, 1, 1, '2024-05-03 20:22:12', 0),
(238, '7B86B812', 6, 1, 1, '2024-05-03 20:22:20', 0),
(239, '6A2F081', 7, 1, 1, '2024-05-03 20:23:54', 0),
(240, '7B86B812', 6, 1, 2, '2024-05-03 20:39:46', 0),
(241, '62369751', 1, 1, 2, '2024-05-03 20:39:49', 0),
(242, '6A2F081', 7, 1, 2, '2024-05-03 20:39:53', 0),
(243, '7B86B812', 6, 1, 1, '2024-08-06 20:23:00', 0),
(244, '7B86B812', 6, 1, 2, '2024-08-06 20:27:55', 0),
(245, '7B86B812', 6, 1, 1, '2024-08-06 21:20:11', 0),
(246, '7B86B812', 6, 1, 2, '2024-08-06 21:26:12', 0),
(247, '7B86B812', 6, 1, 1, '2024-08-06 21:28:47', 0),
(248, '7B86B812', 6, 1, 2, '2024-08-06 21:32:06', 0),
(249, '7B86B812', 6, 1, 1, '2024-08-06 21:32:31', 0),
(250, '7B86B812', 6, 1, 2, '2024-08-06 21:32:56', 0),
(251, '7B86B812', 6, 1, 1, '2024-08-06 21:34:58', 0),
(252, '7B86B812', 6, 1, 2, '2024-08-06 21:35:13', 0),
(253, '7B86B812', 6, 1, 1, '2024-08-06 21:49:06', 0),
(254, '7B86B812', 6, 1, 2, '2024-08-06 21:49:16', 0),
(255, '7B86B812', 6, 1, 1, '2024-08-06 21:58:02', 0),
(256, '7B86B812', 6, 1, 1, '2024-08-08 20:20:01', 0),
(257, '7B86B812', 6, 1, 2, '2024-08-08 20:21:09', 0),
(258, '7B86B812', 6, 1, 1, '2024-08-08 20:22:24', 0),
(259, '7B86B812', 6, 1, 2, '2024-08-08 20:26:29', 0),
(260, '7B86B812', 6, 1, 1, '2024-08-08 20:30:59', 0),
(261, '7B86B812', 6, 1, 2, '2024-08-08 20:31:09', 0),
(265, '7B86B812', 6, 1, 1, '2024-08-08 20:44:03', 0),
(266, '7B86B812', 6, 1, 2, '2024-08-08 20:46:14', 0),
(267, '7B86B812', 6, 1, 1, '2024-08-08 20:46:20', 0),
(268, '7B86B812', 6, 1, 2, '2024-08-08 20:46:28', 0),
(269, '7B86B812', 6, 1, 1, '2024-08-14 21:55:04', 0),
(270, '7B86B812', 6, 1, 2, '2024-08-14 21:55:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_tbl`
--

CREATE TABLE `class_tbl` (
  `class_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `year` int(2) NOT NULL,
  `section` varchar(10) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_tbl`
--

INSERT INTO `class_tbl` (`class_id`, `program_id`, `year`, `section`, `deleted`) VALUES
(1, 4, 3, 'A', 0),
(4, 4, 3, 'B', 0),
(5, 4, 2, 'A', 0),
(6, 4, 2, 'B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department_tbl`
--

CREATE TABLE `department_tbl` (
  `department_id` int(11) NOT NULL,
  `department_code` varchar(50) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_tbl`
--

INSERT INTO `department_tbl` (`department_id`, `department_code`, `department_name`, `deleted`) VALUES
(31, 'IED', 'INSTITUTE OF EDUCATION', 0),
(32, 'ICS', 'INSTITUTE OF COMPUTING STUDIES', 0);

-- --------------------------------------------------------

--
-- Table structure for table `device_tbl`
--

CREATE TABLE `device_tbl` (
  `device_id` int(11) NOT NULL,
  `device_code` varchar(100) NOT NULL,
  `last_active` datetime NOT NULL,
  `deleted` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `device_tbl`
--

INSERT INTO `device_tbl` (`device_id`, `device_code`, `last_active`, `deleted`) VALUES
(2, 'primaria', '2024-05-03 20:36:26', 0),
(3, 'exitus', '2024-05-03 20:46:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program_tbl`
--

CREATE TABLE `program_tbl` (
  `program_id` int(11) NOT NULL,
  `program_code` varchar(50) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_tbl`
--

INSERT INTO `program_tbl` (`program_id`, `program_code`, `program_name`, `department_id`, `deleted`) VALUES
(4, 'BSIT', 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 31, 0),
(5, 'BEED', 'BACHELOR IN ELEMENTARY EDUCATION', 32, 0),
(9, 'BSCS', 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 32, 0),
(10, 'BSIS', 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 32, 0),
(11, 'ACT', 'ASSOCIATE IN COMPUTER TECHNOLOGY', 32, 0),
(12, 'BCAED', 'BACHELOR IN CULTURE AND ARTS EDUCATION', 31, 0),
(13, 'BECED', 'BACHELOR IN EARLY CHILDHOOD EDUCATION', 31, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `ext_name` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `guardian_contact` varchar(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `uid`, `first_name`, `middle_name`, `last_name`, `ext_name`, `class_id`, `email`, `contact`, `guardian_contact`, `deleted`) VALUES
(1, '62369751', 'KAREN', 'USBAL', 'DAGSAAN', '', 1, 'karendagsaan@pcb.edu.ph', '09111111111', '09111111111', 0),
(6, '7B86B812', 'ANGELA', 'LODI', 'DE LEON', '', 4, 'angeladeleon@pcb.edu.ph', '09454866758', '09123456789', 0),
(7, '6A2F081', 'KC', '', 'PETERS', '', 1, 'kcpeters@pcb.edu.ph', '09222222222', '09222222222', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` tinyint(2) NOT NULL,
  `deleted` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `email`, `password`, `usertype`, `deleted`) VALUES
(1, 'karendagsaan@pcb.edu.ph', '$2y$10$Lf3MUJKPBc8joNtdn61MGuODAA1pd9nwNAitbOQoi8c/KMpiMwI6i', 2, 0),
(2, 'admin@pcb.edu.ph', '$2y$10$A1gr88qyhkLMqj19y5mVqOaNo2Vj6qgSVONAs1A1cxDZcriPszxKS', 1, 1),
(10, 'angeladeleon@pcb.edu.ph', '$2y$10$HuNtCGLLJNxA6hlsqq6EGOdAm5er2SpmEf6cLuQJzy8WfKb4s17A.', 2, 0),
(11, 'kcpeters@pcb.edu.ph', '$2y$10$ztIule2qWpFAK4XjVSVdouswZc14A/gVlg4pcX.k6g5MKOhey8NtS', 2, 0),
(13, 'admin', '$2y$10$pJLMjxZels0wBkmn.uhJuuN.lmMcxzU8OCcZn4KELePqyQswb8djS', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acad_yr_tbl`
--
ALTER TABLE `acad_yr_tbl`
  ADD PRIMARY KEY (`acad_id`);

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `class_tbl`
--
ALTER TABLE `class_tbl`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `department_tbl`
--
ALTER TABLE `department_tbl`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `device_tbl`
--
ALTER TABLE `device_tbl`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `program_tbl`
--
ALTER TABLE `program_tbl`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acad_yr_tbl`
--
ALTER TABLE `acad_yr_tbl`
  MODIFY `acad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `class_tbl`
--
ALTER TABLE `class_tbl`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department_tbl`
--
ALTER TABLE `department_tbl`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `device_tbl`
--
ALTER TABLE `device_tbl`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program_tbl`
--
ALTER TABLE `program_tbl`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
