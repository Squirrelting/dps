-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 03:17 PM
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
-- Database: `dps`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` enum('Male','Female','','') NOT NULL,
  `birthdate` date NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `status` enum('Single','Married','Widowed','Separated','Divorced','') NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `parents_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`id`, `firstname`, `middlename`, `lastname`, `email`, `age`, `sex`, `birthdate`, `height`, `weight`, `status`, `citizenship`, `barangay`, `municipality`, `province`, `country`, `parents_id`, `created_at`, `updated_at`) VALUES
(1, 'Warren', 'Elizabeth Grimes', 'Sexton', 'gyvu@mailinator.com', 60, 'Female', '1992-06-09', 33, 16, 'Separated', 'Culpa aliquid possi', 'Velit sunt temporib', 'Doloribus id vel ve', 'Delectus assumenda ', 'Repudiandae dolorem ', 6, '2024-10-25 13:16:18', '2024-10-25 13:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `status` enum('PENDING','ACCEPTED','REJECTED') NOT NULL,
  `interview_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `applicant_id`, `status`, `interview_date`) VALUES
(4, 1, 'PENDING', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parents_background`
--

CREATE TABLE `parents_background` (
  `id` int(11) NOT NULL,
  `mother_firstname` varchar(255) DEFAULT NULL,
  `mother_middlename` varchar(255) DEFAULT NULL,
  `mother_lastname` varchar(255) DEFAULT NULL,
  `mother_occupation` varchar(255) DEFAULT NULL,
  `father_firstname` varchar(255) DEFAULT NULL,
  `father_middlename` varchar(255) DEFAULT NULL,
  `father_lastname` varchar(255) DEFAULT NULL,
  `father_occupation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents_background`
--

INSERT INTO `parents_background` (`id`, `mother_firstname`, `mother_middlename`, `mother_lastname`, `mother_occupation`, `father_firstname`, `father_middlename`, `father_lastname`, `father_occupation`) VALUES
(1, 'Price', 'Emily Stanley', 'Duke', 'In aute aut molestia', 'Malik', 'Orla Nunez', 'Myers', 'Illo dignissimos qui'),
(2, 'Price', 'Emily Stanley', 'Duke', 'In aute aut molestia', 'Malik', 'Orla Nunez', 'Myers', 'Illo dignissimos qui'),
(3, 'Price', 'Emily Stanley', 'Duke', 'In aute aut molestia', 'Malik', 'Orla Nunez', 'Myers', 'Illo dignissimos qui'),
(4, 'Price', 'Emily Stanley', 'Duke', 'In aute aut molestia', 'Malik', 'Orla Nunez', 'Myers', 'Illo dignissimos qui'),
(5, 'Price', 'Emily Stanley', 'Duke', 'In aute aut molestia', 'Malik', 'Orla Nunez', 'Myers', 'Illo dignissimos qui'),
(6, 'Price', 'Emily Stanley', 'Duke', 'In aute aut molestia', 'Malik', 'Orla Nunez', 'Myers', 'Illo dignissimos qui');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `verification` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parents_id` (`parents_id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_applicant_id` (`applicant_id`);

--
-- Indexes for table `parents_background`
--
ALTER TABLE `parents_background`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parents_background`
--
ALTER TABLE `parents_background`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant`
--
ALTER TABLE `applicant`
  ADD CONSTRAINT `fk_parents_id` FOREIGN KEY (`parents_id`) REFERENCES `parents_background` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `fk_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `applicant` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
