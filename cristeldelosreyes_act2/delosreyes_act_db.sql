-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 12:46 AM
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
-- Database: `delosreyes_act_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `attempt` enum('success','failed') NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `user_id`, `email`, `attempt`, `time`) VALUES
(1, NULL, 'admin@gmail.com', 'failed', '2025-04-25 22:34:40'),
(2, NULL, 'let@gmail.com', 'failed', '2025-04-25 22:40:18'),
(3, 1, 'letty@gmail.com', 'success', '2025-04-25 22:41:39'),
(4, 1, 'letty@gmail.com', 'failed', '2025-04-25 22:41:46'),
(5, 1, 'letty@gmail.com', 'failed', '2025-04-25 22:41:50'),
(6, 1, 'letty@gmail.com', 'failed', '2025-04-25 22:41:56'),
(7, 1, 'letty@gmail.com', 'failed', '2025-04-25 22:42:04'),
(8, 1, 'letty@gmail.com', 'failed', '2025-04-25 22:42:08'),
(9, 2, 'let@gmail.com', 'success', '2025-04-25 22:43:52'),
(10, 2, 'let@gmail.com', 'failed', '2025-04-25 22:43:57'),
(11, 2, 'let@gmail.com', 'failed', '2025-04-25 22:44:01'),
(12, 2, 'let@gmail.com', 'failed', '2025-04-25 22:44:06'),
(13, 2, 'let@gmail.com', 'failed', '2025-04-25 22:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `created_at`) VALUES
(1, 'Cristel Delos Reyes', 'letty@gmail.com', '$2y$10$mKh6ZvwHGtf93cHrMa40GuEsOt3Dp/s5EFvdTfFcKjCUQokH2L/yq', '2025-04-25 22:41:26'),
(2, 'Cristel Delos Reyes', 'let@gmail.com', '$2y$10$Cr3/QQfCszC/yTAPhd8GOuYe4G.9r4qZl7GSUMmUc22OewL7UK0r6', '2025-04-25 22:43:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD CONSTRAINT `login_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
