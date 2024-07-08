-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 08:59 PM
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
-- Database: `jobportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `jobId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `applicantName` varchar(100) DEFAULT NULL,
  `applicantEmail` varchar(100) DEFAULT NULL,
  `introduction` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `jobId`, `userId`, `applicantName`, `applicantEmail`, `introduction`, `resume`, `status`) VALUES
(1, 1, 1, 'John Doe', 'john@example.com', 'My introduction', 'resume.pdf', 'pending'),
(2, 2, 2, 'Jane Smith', 'jane@example.com', 'My introduction', 'resume.pdf', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `salaryMin` int(11) DEFAULT NULL,
  `salaryMax` int(11) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `description`, `details`, `location`, `type`, `salaryMin`, `salaryMax`, `company`) VALUES
(1, 'Software Developer', 'Develop and maintain software applications.', '...', 'Kuala Lumpur', 'Full-time', 5000, 7000, 'Tech Innovators Inc.'),
(2, 'Graphic Designer', 'Create visual concepts to communicate ideas.', '...', 'Penang', 'Part-time', 3000, 4000, 'Creative Studio'),
(3, 'Data Scientist', 'Analyze data and provide insights.', '...', 'Johor Bahru', 'Contract', 8000, 10000, 'Data Analytics Co.');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `jobId` int(11) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `userId`, `jobId`, `company`, `category`, `rating`, `comment`) VALUES
(1, 1, 1, 'Tech Innovators Inc.', 'Salary', 4, 'Good salary package.'),
(2, 2, 1, 'Tech Innovators Inc.', 'Work Environment', 5, 'Excellent work environment.'),
(3, 3, 2, 'Creative Studio', 'Management', 3, 'Average management.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `userType` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `company`, `phoneNumber`) VALUES
(0, 'Nurfazlin', 'fazlinMatTamidi@gmail.com', '$2y$10$mfcCHjveDPW0k1m0nMk8D.6DQFjzpkasVCJI7ZEHN9lqIJOB.BN8i', 'applicant', 'C-1-1, PPR KERINCHI, JLN PANTAI PERMAI', '01161219048'),
(1, 'John Doe', 'john@example.com', 'password123', 'applicant', 'Tech Innovators Inc.', '0'),
(2, 'Jane Smith', 'jane@example.com', 'password123', 'applicant', 'Creative Studio', '0'),
(3, 'Admin User', 'admin@example.com', 'admin123', 'employer', 'Tech Innovators Inc.', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
