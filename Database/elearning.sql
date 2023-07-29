-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2023 at 10:06 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin1', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `Attempt_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Course_ID` int(11) NOT NULL,
  `Attempt_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`Attempt_ID`, `User_ID`, `Course_ID`, `Attempt_Date`) VALUES
(1, 1, 3, '2023-07-28'),
(2, 1, 3, '2023-07-28'),
(3, 1, 1, '2023-07-28'),
(4, 1, 1, '2023-07-28'),
(5, 1, 3, '2023-07-28'),
(6, 1, 1, '2023-07-28'),
(7, 1, 3, '2023-07-28'),
(8, 1, 1, '2023-07-28'),
(9, 1, 3, '2023-07-28'),
(10, 1, 2, '2023-07-28'),
(11, 1, 1, '2023-07-28'),
(12, 1, 3, '2023-07-28'),
(13, 1, 3, '2023-07-28'),
(14, 1, 3, '2023-07-28'),
(15, 1, 1, '2023-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comment_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Course_ID` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Admin_Reply` text DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comment_ID`, `User_ID`, `Course_ID`, `Comment`, `Admin_Reply`, `Timestamp`) VALUES
(3, 1, 3, 'Hy', 'g', '2023-07-29 07:15:38'),
(4, 1, 3, 'What are you doing', 'Why?', '2023-07-29 07:27:35');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `Coupon_ID` int(11) NOT NULL,
  `Course_ID` int(11) NOT NULL,
  `Coupon_Code` varchar(50) NOT NULL,
  `Discount` decimal(10,2) NOT NULL,
  `Expiry_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`Coupon_ID`, `Course_ID`, `Coupon_Code`, `Discount`, `Expiry_Date`) VALUES
(1, 1, 'ABC100', '10.00', '2023-08-27'),
(2, 3, 'NASIR827', '10.00', '2023-07-28'),
(3, 1, 'bbbdaa21', '20.00', '2023-07-29'),
(4, 1, '123afa12', '12.00', '2023-07-29'),
(5, 1, 'saif12', '12.00', '2023-07-29'),
(6, 1, 'naeir', '12.00', '2023-07-29'),
(7, 1, 'bbbdaa2111', '30.00', '2023-07-29'),
(8, 1, '123afa12kk', '20.00', '2023-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `Course_ID` int(11) NOT NULL,
  `Course_Title` varchar(255) NOT NULL,
  `Course_Instructor` varchar(255) NOT NULL,
  `Course_Content` text NOT NULL,
  `Course_Outline` text NOT NULL,
  `Course_Price` decimal(10,2) NOT NULL,
  `Start_Date` date DEFAULT NULL,
  `End_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`Course_ID`, `Course_Title`, `Course_Instructor`, `Course_Content`, `Course_Outline`, `Course_Price`, `Start_Date`, `End_Date`) VALUES
(1, 'CS201', 'NASIR ABBAS', 'fdxzsdf', 'dfas', '700.00', '2023-07-27', '2023-07-27'),
(2, 'CS101', 'NASIR ABBAS', 'dfs', 'adasf', '0.00', '2023-07-28', '2023-08-03'),
(3, 'CS301', 'NASIR', 'sfdfs', 'fdsa', '200.00', '2023-07-28', '2023-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `Enrollment_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Course_ID` int(11) NOT NULL,
  `Enrollment_Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`Enrollment_ID`, `User_ID`, `Course_ID`, `Enrollment_Date`) VALUES
(17, 1, 3, '2023-07-28 15:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `Quiz_ID` int(11) NOT NULL,
  `Course_ID` int(11) NOT NULL,
  `Quiz_Title` varchar(255) NOT NULL,
  `Quiz_Question` text NOT NULL,
  `Quiz_Options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`Quiz_ID`, `Course_ID`, `Quiz_Title`, `Quiz_Question`, `Quiz_Options`, `Quiz_Correct_Answer`) VALUES
(1, 1, 'first lesson quizes', 'sdz', '[\"Nasir\",\"Nasir\",\"Nasir\",\"Nasir\"]', 1),
(3, 1, 'second quiz', 'What is the course name', '[\"Nasir\",\"abbas\",\"None\",\"CS201\"]', 4);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `Attempt_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Quiz_ID` int(11) NOT NULL,
  `Selected_Option` int(11) NOT NULL,
  `Is_Correct` tinyint(1) NOT NULL,
  `Attempt_Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_attempts`
--

INSERT INTO `quiz_attempts` (`Attempt_ID`, `User_ID`, `Quiz_ID`, `Selected_Option`, `Is_Correct`, `Attempt_Date`) VALUES
(15, 1, 1, 1, 1, '2023-07-28 09:07:13'),
(16, 1, 3, 4, 1, '2023-07-28 09:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `Balance` decimal(10,2) NOT NULL DEFAULT 10000.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `status`, `Balance`) VALUES
(1, 'NASIR', '$2y$10$iuInCu39nLRLbbyAveHkUex2YZ0vO06cPhfvi4jThbTORjUcLwy6y', 'nasiryt.827@gmail.com', '3176526827', 'approved', '9640.00'),
(2, 'saif', '$2y$10$B8pyUjvU/4vuXGp4KAmNnez5YyP998CCKuT/MYr5AcvhHssMSwr5C', 'saifx280@gmail.com', '33233', 'approved', '10000.00');

-- --------------------------------------------------------

--
-- Table structure for table `user_video_completion`
--

CREATE TABLE `user_video_completion` (
  `Completion_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Video_ID` int(11) NOT NULL,
  `Watch_Time` int(11) NOT NULL,
  `Completed` tinyint(1) DEFAULT 0,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_video_completion`
--

INSERT INTO `user_video_completion` (`Completion_ID`, `User_ID`, `Video_ID`, `Watch_Time`, `Completed`, `Timestamp`) VALUES
(9, 1, 12, 0, 1, '2023-07-28 16:06:11'),
(10, 1, 13, 0, 1, '2023-07-28 16:06:51'),
(11, 1, 14, 0, 1, '2023-07-29 06:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `Video_ID` int(11) NOT NULL,
  `Course_ID` int(11) NOT NULL,
  `Video_Title` varchar(255) NOT NULL,
  `Video_URL` varchar(255) NOT NULL,
  `Duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`Video_ID`, `Course_ID`, `Video_Title`, `Video_URL`, `Duration`) VALUES
(12, 1, 'first video', 'uploads/10 SECONDS VIDEO CLIP.mp4', 1),
(13, 1, 'first video', 'uploads/10 SECONDS VIDEO CLIP.mp4', 1),
(14, 1, 'vv', 'uploads/10 SECONDS VIDEO CLIP.mp4', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`Attempt_ID`),
  ADD KEY `fk_attempt_user` (`User_ID`),
  ADD KEY `fk_attempt_course` (`Course_ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comment_ID`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`Coupon_ID`),
  ADD KEY `Course_ID` (`Course_ID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`Course_ID`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`Enrollment_ID`);

--
-- Indexes for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`Attempt_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Quiz_ID` (`Quiz_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_video_completion`
--
ALTER TABLE `user_video_completion`
  ADD PRIMARY KEY (`Completion_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Video_ID` (`Video_ID`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`Video_ID`),
  ADD KEY `Course_ID` (`Course_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `Attempt_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `Coupon_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `Course_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `Enrollment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `Quiz_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `Attempt_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_video_completion`
--
ALTER TABLE `user_video_completion`
  MODIFY `Completion_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `Video_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `fk_attempt_course` FOREIGN KEY (`Course_ID`) REFERENCES `courses` (`Course_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_attempt_user` FOREIGN KEY (`User_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_ibfk_1` FOREIGN KEY (`Course_ID`) REFERENCES `courses` (`Course_ID`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD CONSTRAINT `quiz_attempts_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quiz_attempts_ibfk_2` FOREIGN KEY (`Quiz_ID`) REFERENCES `quizzes` (`Quiz_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_video_completion`
--
ALTER TABLE `user_video_completion`
  ADD CONSTRAINT `user_video_completion_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_video_completion_ibfk_2` FOREIGN KEY (`Video_ID`) REFERENCES `videos` (`Video_ID`) ON DELETE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`Course_ID`) REFERENCES `courses` (`Course_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
