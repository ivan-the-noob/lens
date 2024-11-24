-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 04:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lensfoliohub`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_me`
--

CREATE TABLE `about_me` (
  `id` int(11) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `about_me` text DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `location_text` varchar(255) DEFAULT NULL,
  `view_type` enum('grid','carousel') NOT NULL DEFAULT 'grid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_me`
--

INSERT INTO `about_me` (`id`, `profile_image`, `profession`, `about_me`, `age`, `latitude`, `longitude`, `created_at`, `email`, `location_text`, `view_type`) VALUES
(1, '../../../../assets/img/profile/gallery-6.jpg', 'photographer', 'dasasdsa', 12, 14.2838325, 120.8668772, '2024-09-17 08:36:54', '', NULL, 'grid'),
(2, '../../../../assets/img/profile/gallery-6.jpg', 'photographer,videographer', 'dasasdsa', 12, 14.2838325, 120.8668772, '2024-09-17 08:37:24', '', NULL, 'grid'),
(3, 'default_image.jpg', 'photographer', 'hello real', 13, 14.2813281, 120.8703823, '2024-09-17 08:40:36', '1@gmail.com', 'Trece Martires City Hall, Governor\'s Drive, Trece Martires, Cavite, Philippines', 'carousel'),
(4, 'default_image.jpg', 'photographer,videographer', 'Hey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good hehe', 12, 14.2838325, 120.8668772, '2024-09-26 20:22:51', 'test@gmail.com', 'Ej Five Laundry Shop & Dry Cleaning, Market Road, Trece Martires, Cavite, Philippines', 'carousel'),
(5, '../../../../assets/img/profile/MSI_MAG.jpg', '', 'Hello I\'m Ivan', 12, 14.282221499999995, 120.86845810185243, '2024-10-23 00:57:47', 'supplier@gmail.com', 'Trece Martires, Cavite, Philippines', 'grid');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `event` enum('photography','videography') NOT NULL,
  `time` time NOT NULL,
  `selected_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `name`, `latitude`, `longitude`, `event`, `time`, `selected_date`) VALUES
(3, 'Ej Ivan', 14.283833, 120.866877, 'videography', '00:30:00', '2024-10-03'),
(4, 'Ej Ivan', 14.283833, 120.866877, 'videography', '00:30:00', '2024-10-03'),
(5, 'Ivan', 14.283833, 120.866877, 'photography', '12:30:00', '2024-10-04');

-- --------------------------------------------------------

--
-- Table structure for table `snapfeed`
--

CREATE TABLE `snapfeed` (
  `id` int(11) NOT NULL,
  `card_img` varchar(255) DEFAULT NULL,
  `card_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `img_title` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hearts_count` int(11) DEFAULT 0,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `snapfeed`
--

INSERT INTO `snapfeed` (`id`, `card_img`, `card_text`, `created_at`, `img_title`, `email`, `hearts_count`, `comments`) VALUES
(15, '../../../../assets/img/snapfeed/gallery-2.jpg', '121321', '2024-09-16 01:08:05', 'BABAE NA PICTURE', '1@gmail.com', 0, NULL),
(16, '../../../../assets/img/snapfeed/gallery-4.jpg', 'dasdsa', '2024-09-16 01:08:12', 'dsadsa', '1@gmail.com', 0, NULL),
(17, '../../../../assets/img/snapfeed/gallery-3.jpg', 'dasdsa', '2024-09-16 01:11:59', 'dsadsa', '1@gmail.com', 0, NULL),
(18, '../../../../assets/img/snapfeed/gallery-1.jpg', '123', '2024-09-16 01:14:21', '123', '1@gmail.com', 0, NULL),
(19, '../../../../assets/img/snapfeed/gallery-5.jpg', '1', '2024-09-16 01:14:39', '1', '1@gmail.com', 0, NULL),
(20, '../../../../assets/img/snapfeed/gallery-6.jpg', '1', '2024-09-16 01:14:46', '1', '1@gmail.com', 0, NULL),
(21, '../../../../assets/img/snapfeed/gallery-7.jpg', '1', '2024-09-16 01:14:52', '1', '1@gmail.com', 0, NULL),
(25, '../../../../assets/img/snapfeed/gallery-12.jpg', '1', '2024-09-16 01:15:25', '1', '1@gmail.com', 0, NULL),
(26, '../../../../assets/img/snapfeed/gallery-2.jpg', 'ganda', '2024-09-16 01:47:22', 'Hey', '1@gmail.com', 0, NULL),
(27, '../../../../assets/img/snapfeed/gallery-14.jpg', 'test', '2024-09-24 03:51:58', 'test', '1@gmail.com', 0, NULL),
(28, '../../../../assets/img/snapfeed/gallery-14.jpg', 'test', '2024-09-24 03:52:30', 'test', 'test@gmail.com', 0, '\"dsadas\"'),
(29, '../../../../assets/img/snapfeed/gallery-16.jpg', 'test1', '2024-09-24 05:45:50', 'test1', 'test@gmail.com', 0, '\"TEST 1\", \"TEST2\", \"DASDSA\", \"hey\"'),
(30, '../../../../assets/img/snapfeed/camera.png', 'TEST', '2024-10-31 07:29:19', 'TEST', 'supplier@gmail.com', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('customer','supplier') NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_img` varchar(255) DEFAULT 'profile.jpg',
  `about_me` text DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `day_available` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `created_at`, `updated_at`, `profile_img`, `about_me`, `profession`, `location`, `age`, `day_available`) VALUES
(12, 'supplier', 'Ej Ivan Ablanida', 'ejivanca1blanida@gmail.com1', '$2y$10$4uOxq7TnCWPlX6Z4pcY6deOIzxYHHHYd0n5SWch1376IP/b0Xyxxi', '2024-09-15 10:04:03', '2024-09-15 10:04:03', 'profile.jpg', NULL, NULL, NULL, NULL, NULL),
(14, 'customer', 'Ej Ivan Ablanida', 'ejivancdasdasdasdasdasdasa1blanida@gmail.com1', '$2y$10$1CN6Qyb5u4iObEzDVearqe2nEYQUCIFHD7zkTfrYoC/Rau2x01ivq', '2024-09-15 10:06:32', '2024-09-15 10:06:32', 'profile.jpg', NULL, NULL, NULL, NULL, NULL),
(15, 'supplier', 'Ej Ivan Ablanida', 'ejivan1cdasdasdasdasdasdasa1blanida@gmail.com1', '$2y$10$Gean5tLaofRihurc3tptE..iY9D5Yta8ZhIPocUSsXYhi6/H8OMe2', '2024-09-15 10:07:44', '2024-09-15 10:07:44', 'profile.jpg', NULL, NULL, NULL, NULL, NULL),
(16, 'supplier', 'Ivan Ablanida', '1@gmail.com', '$2y$10$SXsGg/5MaeD3S.fdoldfgu5YYTZ/RpGLwEMocNmhwA/Pnq8909uHG', '2024-09-15 10:14:40', '2024-10-31 04:47:02', 'profile.jpg', NULL, NULL, NULL, NULL, NULL),
(17, 'supplier', 'Ivan Ablanida', 'supplier@gmail.com', '$2y$10$Nbgr8CZoIfG.DwKmzHQWn.53PiFMxsA1f0wGZgXDkTqMRRJokoZIK', '2024-09-15 10:57:46', '2024-10-31 18:15:36', 'profile.jpg', NULL, NULL, NULL, NULL, ''),
(18, 'supplier', 'Ivan', 'ivan@gmail.com', '$2y$10$UipF31UcmWtkvLLi/4pJv.q2swSPUpWGK.EqjJRPH17oqR8N7FS/S', '2024-09-15 12:01:03', '2024-09-15 12:01:03', 'profile.jpg', NULL, NULL, NULL, NULL, NULL),
(19, 'supplier', 'racel', 'racel@gmail.com', '$2y$10$YbfIIErUgASt3W0y6HpIi.y5667ofbX2bHYzWGYNRtWi8CAPopo0a', '2024-09-15 19:48:08', '2024-09-15 19:48:08', 'profile.jpg', NULL, NULL, NULL, NULL, NULL),
(20, 'supplier', 'racels', '1ra@gmail.com', '$2y$10$hlBfashINKF7BGvZ2f/0SendLQMe/UYOUvGEgEv26wd.YGKsasp1G', '2024-09-15 19:53:50', '2024-10-31 04:47:07', 'profile.jpg', NULL, NULL, NULL, NULL, NULL),
(21, 'supplier', 'racels', '1ras@gmail.com', '$2y$10$WmFBrCyYyDiLHNPBhi0RqO/BQRKwS9lvfvc3sSiKM5IGngL0QjoEK', '2024-09-15 19:55:49', '2024-10-31 04:47:09', 'profile.jpg', NULL, NULL, NULL, NULL, NULL),
(22, 'customer', 'client', 'client@gmail.com', '$2y$10$TCR1OMGZyQ7c2CaObgVq3.XI8FDOhtct4fOfQiqekIPspMGouboui', '2024-09-24 02:57:18', '2024-10-31 05:34:12', 'profile.jpg', NULL, NULL, NULL, NULL, ',2024-10-03,2024-10-05,2024-10-12'),
(23, 'supplier', 'Test Updated', 'test@gmail.com', '$2y$10$E.NRidcwuXwIpmwfonL04.7HSPGq69xeA.8r3JF9IR2nanR7yv22y', '2024-09-24 03:48:59', '2024-10-31 05:44:12', 'profile.jpg', NULL, NULL, NULL, NULL, ',2024-10-03,2024-10-05,2024-10-12'),
(24, 'supplier', 'diana', 'diana@gmail.com', '$2y$10$//BCs4IgM0BKDVWRHbOK.OYwonPil4IMsXAwwglq378yjA1DKAUyC', '2024-11-08 23:32:22', '2024-11-08 23:32:22', 'profile.jpg', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_me`
--
ALTER TABLE `about_me`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snapfeed`
--
ALTER TABLE `snapfeed`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `about_me`
--
ALTER TABLE `about_me`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `snapfeed`
--
ALTER TABLE `snapfeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
