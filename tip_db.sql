-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 24, 2023 at 03:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tip_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `applicationId` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `jobId` int(11) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `availability` varchar(255) NOT NULL,
  `preferences` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`applicationId`, `memberId`, `jobId`, `cv`, `availability`, `preferences`, `status`) VALUES
(1, 8, 1, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2 ', 'NEW'),
(2, 8, 4, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(3, 8, 10, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(4, 8, 8, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(5, 8, 9, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(6, 8, 6, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(7, 8, 10, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(8, 9, 1, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(9, 9, 2, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(10, 9, 3, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(11, 9, 4, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(12, 9, 5, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(13, 9, 6, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(14, 10, 1, '', 'monday_morning,tuesday_afternoon,friday_evening', 'Class 1, Class 2', 'NEW'),
(15, 9, 9, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2', 'NEW'),
(16, 10, 2, '', 'tuesday_morning,tuesday_afternoon,friday_evening', 'Class 1', 'NEW'),
(17, 10, 6, '', 'monday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2, Class 3', 'NEW'),
(18, 10, 8, '', 'monday_morning,tuesday_afternoon,tuesday_evening', 'Class 2, Class 3', 'NEW'),
(19, 10, 10, '', 'monday_morning,tuesday_afternoon,tuesday_evening', 'Class 3, Class 2', 'NEW'),
(20, 8, 2, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 3', 'NEW'),
(21, 8, 3, '', 'tuesday_morning,tuesday_afternoon', 'Class 3', 'NEW'),
(22, 10, 9, '', 'tuesday_morning,tuesday_afternoon,tuesday_evening', 'Class 1, Class 2, Class 3', 'NEW'),
(23, 10, 1, '', 'monday_morning,tuesday_afternoon,friday_evening', 'Class 1, Class 2', 'NEW'),
(24, 13, 1, '', 'monday_morning,tuesday_afternoon,tuesday_evening, friday_morning, friday_evening', 'Class 1, Class 2', 'NEW'),
(26, 13, 2, '', 'monday_morning,tuesday_afternoon, friday_morning, friday_evening', 'Class 1', 'NEW'),
(27, 13, 3, '', 'tuesday_afternoon,tuesday_evening, friday_morning', 'Class 1, Class 2', 'NEW'),
(29, 13, 6, '', 'monday_morning,tuesday_afternoon,tuesday_evening, friday_morning', 'Class 1, Class 3', 'NEW'),
(36, 11, 1, '', 'monday_morning,tuesday_afternoon,tuesday_evening, friday_morning, friday_evening', 'Class 1, Class 2', 'NEW'),
(37, 11, 2, '', 'monday_morning,tuesday_afternoon, friday_morning, friday_evening', 'Class 1', 'NEW'),
(38, 11, 3, '', 'tuesday_afternoon,tuesday_evening, friday_morning', 'Class 1, Class 2', 'NEW'),
(39, 11, 4, '', 'monday_morning,tuesday_afternoon, friday_morning, friday_evening', 'Class 1', 'NEW'),
(40, 11, 5, '', 'tuesday_afternoon,tuesday_evening, friday_morning', 'Class 1, Class 2', 'NEW'),
(41, 11, 6, '', 'monday_morning,tuesday_afternoon,tuesday_evening, friday_morning', 'Class 1, Class 2', 'NEW'),
(42, 11, 8, '', 'monday_morning,tuesday_afternoon,tuesday_evening, friday_morning', 'Class 1, Class 2', 'NEW'),
(43, 11, 9, '', 'monday_morning,tuesday_afternoon,tuesday_evening, friday_morning', 'Class 1, Class 3', 'NEW'),
(44, 11, 10, '', 'monday_morning,tuesday_afternoon,tuesday_evening, friday_morning, friday_evening', 'Class 1, Class 3', 'NEW'),
(45, 12, 1, '', 'monday_morning,tuesday_afternoon,tuesday_evening, friday_morning, friday_evening', 'Class 1, Class 2', 'NEW'),
(46, 12, 2, '', 'monday_morning,tuesday_afternoon, friday_morning, friday_evening', 'Class 1', 'NEW'),
(47, 12, 3, '', 'tuesday_afternoon,tuesday_evening, friday_morning', 'Class 1, Class 2', 'NEW'),
(48, 12, 4, '', 'monday_morning,tuesday_afternoon, friday_morning, friday_evening', 'Class 1', 'NEW'),
(49, 12, 5, '', 'tuesday_afternoon,tuesday_evening, friday_morning', 'Class 1, Class 2', 'NEW'),
(50, 12, 6, '', 'monday_morning,tuesday_afternoon,tuesday_evening, friday_morning', 'Class 1, Class 2', 'NEW'),
(51, 12, 8, '', 'monday_morning,tuesday_afternoon,tuesday_evening, friday_morning', 'Class 1, Class 2', 'NEW'),
(52, 12, 9, '', 'monday_morning,tuesday_afternoon,tuesday_evening, friday_morning', 'Class 1, Class 3', 'NEW'),
(53, 12, 10, '', 'monday_morning,tuesday_afternoon,tuesday_evening, friday_morning, friday_evening', 'Class 1, Class 3', 'NEW');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `jobId` int(11) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`jobId`, `unit`, `description`, `title`) VALUES
(1, 'COS60004', 'A passion for making a difference in student\'s lives and an encouraging approach.Reliability – we need tutors who will be committed to their students.\r\nBe personable and easy to get along with.', 'Web Dev Tutor'),
(2, 'COS60005', 'A passion for making a difference in student\'s lives and an encouraging approach.Reliability – we need tutors who will be committed to their students.\r\nBe personable and easy to get along with.', 'Database Tutor'),
(3, 'COS60004', 'Are you a qualified teacher or highly experienced tutor who is a self-starter and fully equipped to make a difference?', 'Slides Tutor'),
(4, 'COS60004', 'We are DataOps advocates and use software engineering best practices to build scalable and re-usable data solutions to help clients use their data to gain insights', 'DataSci Tutor'),
(5, 'COS60008', 'We are looking for stellar private tutors to truly inspire a life-long love of learning for all our students.', 'Lecturer '),
(6, 'COS60008', 'We are looking for stellar private tutors to truly inspire a life-long love of learning for all our students.', 'TIP Tutor'),
(8, 'COS60010', 'we are looking for stellar private tutors to truly inspire a life-long love of learning for all our students.', 'Tutor'),
(9, 'COS60010', 'We are looking for stellar private tutors to truly inspire a life-long love of learning for all our students.', 'Tutor'),
(10, 'COS60011', 'We are looking for stellar private tutors to truly inspire a life-long love of learning for all our students.', 'Class Tutor');

-- --------------------------------------------------------

--
-- Table structure for table `manage`
--

CREATE TABLE `manage` (
  `managerId` int(11) NOT NULL,
  `jobId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage`
--

INSERT INTO `manage` (`managerId`, `jobId`) VALUES
(1, 1),
(1, 5),
(1, 6),
(1, 8),
(1, 9),
(1, 10),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `memberLogin`
--

CREATE TABLE `memberLogin` (
  `memberId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberLogin`
--

INSERT INTO `memberLogin` (`memberId`, `name`, `email`, `phone`, `username`, `password`) VALUES
(8, 'A Luan Luong', 'leo.aluong@gmail.com', '0431381949', 'member1', '$2y$10$d.VxeTStVB2qJccMIUvw4.vL7hZ1VxEQtYVHusgaJ.HMcwGgXg7KW'),
(9, 'Hoang Nguyen', 'hoang.nguyen@gmail.com', '01234567890', 'member2', '$2y$10$LJ3kHG3YNippjnoMQjTnse5v6Cp2UdFk2uOgwyXli6BiSsQzCaQrC'),
(10, 'Amer', 'amer@gmail.com', '0123454289', 'member3', '$2y$10$J7TKsWBmCI6i4IiH856wbOaNizzWlhcFEs/AmxgcmG6qwK1FAxDB2'),
(11, 'Luan 2', 'leo.aluo@gmail.com', '2312312123', 'member4', '$2y$10$pcrfHmMi5FLnLdy1Npzno.ZTltPL3f47t6H6vzvSdFTPiiGYNqPwe'),
(12, 'Luan Leo', 'leo.aluong@gmail.com', '0431381949', 'member5', '$2y$10$yZAA3FZAl66FremtfWc8Ru.3Ok3P/isY7XmVvmZ7Cf/phKJPizn6i'),
(13, 'Team 55', 'team@gmail.com', '0123456789', 'member6', '$2y$10$PVhZVtSvixgsIjKGKrJKuev0ZT/IUUHzc1fefhxOXhKivI70ESXhG');

-- --------------------------------------------------------

--
-- Table structure for table `permanentLogin`
--

CREATE TABLE `permanentLogin` (
  `managerId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permanentLogin`
--

INSERT INTO `permanentLogin` (`managerId`, `name`, `email`, `phone`, `username`, `password`) VALUES
(1, 'A Luan ', 'luanprobs456@gmail.com', '0431381949', 'admin', '12345'),
(2, 'Hoang Nguyen', 'Hoang@gmail.com', '01234567435', 'adminH', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`applicationId`),
  ADD KEY `jobID` (`jobId`),
  ADD KEY `memberId` (`memberId`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`jobId`);

--
-- Indexes for table `manage`
--
ALTER TABLE `manage`
  ADD PRIMARY KEY (`managerId`,`jobId`),
  ADD KEY `manage_ibfk_2` (`jobId`);

--
-- Indexes for table `memberLogin`
--
ALTER TABLE `memberLogin`
  ADD PRIMARY KEY (`memberId`);

--
-- Indexes for table `permanentLogin`
--
ALTER TABLE `permanentLogin`
  ADD PRIMARY KEY (`managerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `applicationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `jobId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `memberLogin`
--
ALTER TABLE `memberLogin`
  MODIFY `memberId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permanentLogin`
--
ALTER TABLE `permanentLogin`
  MODIFY `managerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`jobId`) REFERENCES `job` (`jobId`),
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`memberId`) REFERENCES `memberLogin` (`memberId`),
  ADD CONSTRAINT `application_ibfk_3` FOREIGN KEY (`jobId`) REFERENCES `job` (`jobId`);

--
-- Constraints for table `manage`
--
ALTER TABLE `manage`
  ADD CONSTRAINT `manage_ibfk_1` FOREIGN KEY (`managerId`) REFERENCES `permanentLogin` (`managerId`),
  ADD CONSTRAINT `manage_ibfk_2` FOREIGN KEY (`jobId`) REFERENCES `job` (`jobId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
