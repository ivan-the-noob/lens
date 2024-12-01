-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 07:09 AM
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
  `selected_date` date NOT NULL,
  `email_uploader` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `name`, `latitude`, `longitude`, `event`, `time`, `selected_date`, `email_uploader`, `email`) VALUES
(7, '312312 312312', 14.283833, 120.866877, 'photography', '00:30:00', '2024-11-08', '1@gmail.com', 'client@gmail.com'),
(8, 'Ej Ivan Ablanida', 14.283833, 120.866877, 'photography', '01:43:00', '2024-11-02', 'supplier@gmail.com', 'client@gmail.com'),
(9, 'Kate', 14.283833, 120.866877, 'videography', '11:54:00', '2024-11-02', 'kate@gmail.com', 'client@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `uploader` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `context` text DEFAULT NULL,
  `date_to_show` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `image`, `uploader`, `date`, `heading`, `context`, `date_to_show`) VALUES
(1, 'news.jpg', 'John Doe', '2024-11-29', 'Breaking News: Something Big Happened', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia.', '2024-12-01'),
(2, 'image2.jpg', 'Jane Smith', '2024-11-29', 'New Developments in Tech', 'Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas odio, vitae scelerisque enim ligula venenatis dolor.', '2024-12-02'),
(3, 'image3.jpg', 'Alice Johnson', '2024-11-28', 'Health Update: Tips for Staying Fit', 'Vestibulum auctor dapibus neque. Vivamus sit amet semper lacus, in mollis libero.', '2024-12-03'),
(4, 'image4.jpg', 'Bob Brown', '2024-11-27', 'New Policy Changes Announced', 'Sed sed orci sit amet lectus hendrerit consectetur et in magna. Cras sed nulla ac urna venenatis.', '2024-12-04'),
(5, 'sneaker.jpg', 'DIANA', '2024-11-30', 'Breaking News: Something Big Happened', 'LOREM IPSUM LOREM IPSUMLOREM IPSUM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `reporter_name` varchar(255) NOT NULL,
  `reporter_email` varchar(255) NOT NULL,
  `reported_name` varchar(255) NOT NULL,
  `reported_email` varchar(255) NOT NULL,
  `role` enum('customer','supplier') NOT NULL,
  `reason` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `reporter_name`, `reporter_email`, `reported_name`, `reported_email`, `role`, `reason`, `created_at`) VALUES
(1, 'Alice Johnson', 'alice.johnson@example.com', 'Tom Smith', 'tom.smith@example.com', 'customer', 'Inappropriate behavior.', '2024-11-30 23:28:49'),
(2, 'Bob Brown', 'bob.brown@example.com', 'Susan White', 'susan.white@example.com', 'customer', 'Fraudulent activity.', '2024-11-30 23:28:49'),
(3, 'Carol Davis', 'carol.davis@example.com', 'Mark Taylor', 'mark.taylor@example.com', 'customer', 'Unreliable payment.', '2024-11-30 23:28:49'),
(4, 'David Evans', 'david.evans@example.com', 'Emily Clark', 'emily.clark@example.com', 'customer', 'Breach of agreement.', '2024-11-30 23:28:49'),
(5, 'Eve Miller', 'eve.miller@example.com', 'Jake Wilson', 'jake.wilson@example.com', 'customer', 'Unprofessional conduct.', '2024-11-30 23:28:49'),
(6, 'Frank Moore', 'frank.moore@example.com', 'Nancy Green', 'nancy.green@example.com', 'supplier', 'Delayed deliveries.', '2024-11-30 23:28:49'),
(7, 'Grace Taylor', 'grace.taylor@example.com', 'Henry Adams', 'henry.adams@example.com', 'supplier', 'Product quality issues.', '2024-11-30 23:28:49'),
(8, 'Hank Harris', 'hank.harris@example.com', 'Olivia Baker', 'olivia.baker@example.com', 'supplier', 'Lack of communication.', '2024-11-30 23:28:49'),
(9, 'Isabel King', 'isabel.king@example.com', 'Peter Wright', 'peter.wright@example.com', 'supplier', 'Overcharging for services.', '2024-11-30 23:28:49'),
(10, 'Jack Lee', 'jack.lee@example.com', 'Laura Martin', 'laura.martin@example.com', 'supplier', 'Unethical practices.', '2024-11-30 23:28:49');

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
(18, 'gallery-1.jpg', '123', '2024-09-16 01:14:21', '123', '1@gmail.com', 0, NULL),
(19, '../../../../assets/img/snapfeed/gallery-5.jpg', '1', '2024-09-16 01:14:39', '1', '1@gmail.com', 0, NULL),
(20, '../../../../assets/img/snapfeed/gallery-6.jpg', '1', '2024-09-16 01:14:46', '1', '1@gmail.com', 0, NULL),
(21, '../../../../assets/img/snapfeed/gallery-7.jpg', '1', '2024-09-16 01:14:52', '1', '1@gmail.com', 0, NULL),
(25, '../../../../assets/img/snapfeed/gallery-12.jpg', '1', '2024-09-16 01:15:25', '1', '1@gmail.com', 0, NULL),
(26, '../../../../assets/img/snapfeed/gallery-2.jpg', 'ganda', '2024-09-16 01:47:22', 'Hey', '1@gmail.com', 0, NULL),
(27, 'gallery-14.jpg', 'test', '2024-09-24 03:51:58', 'test', '1@gmail.com', 0, NULL),
(29, '../../../../assets/img/snapfeed/gallery-16.jpg', 'test1', '2024-09-24 05:45:50', 'test1', 'test@gmail.com', 0, '\"TEST 1\", \"TEST2\", \"DASDSA\", \"hey\"'),
(30, 'camera.png', 'TEST', '2024-10-31 07:29:19', 'TEST', 'supplier@gmail.com', 0, NULL),
(32, 'MSI_MEG_ACE.jpg', 'test lorem ipsum', '2024-12-01 04:52:49', 'try', 'kate@gmail.com', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_news`
--

CREATE TABLE `sub_news` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_news`
--

INSERT INTO `sub_news` (`id`, `img`, `title`, `date`) VALUES
(1, 'news1.jpg', 'Breaking Sub-News 1', '2024-11-01'),
(2, 'news2.jpg', 'Breaking Sub-News 2', '2024-11-15'),
(3, 'news3.jfif', 'Breaking Sub-News 3', '2024-11-29'),
(4, 'MSI_MPG.jpg', 'msi woa', '2024-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('customer','supplier','admin') NOT NULL,
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
  `day_available` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `created_at`, `updated_at`, `profile_img`, `about_me`, `profession`, `location`, `age`, `day_available`, `is_active`, `last_login`) VALUES
(16, 'supplier', 'Ivan Ablanida', '1@gmail.com', '$2y$10$SXsGg/5MaeD3S.fdoldfgu5YYTZ/RpGLwEMocNmhwA/Pnq8909uHG', '2024-09-15 10:14:40', '2024-12-01 04:18:49', 'profile.jpg', NULL, NULL, NULL, NULL, ',2024-11-09,2024-11-08,2024-11-07', 1, '2024-12-01 04:18:49'),
(17, 'supplier', 'Ivan Ablanida', 'supplier@gmail.com', '$2y$10$Nbgr8CZoIfG.DwKmzHQWn.53PiFMxsA1f0wGZgXDkTqMRRJokoZIK', '2024-09-15 10:57:46', '2024-12-01 04:43:03', 'profile.jpg', NULL, NULL, NULL, NULL, ',2024-11-02,2024-11-01,2024-11-08,2024-11-09,2024-11-16,2024-11-15', 1, '2024-12-01 04:43:03'),
(18, 'supplier', 'Ivan', 'ivan@gmail.com', '$2y$10$UipF31UcmWtkvLLi/4pJv.q2swSPUpWGK.EqjJRPH17oqR8N7FS/S', '2024-09-15 12:01:03', '2024-09-15 12:01:03', 'profile.jpg', NULL, NULL, NULL, NULL, NULL, 0, '2024-11-30 22:36:31'),
(19, 'customer', 'racel', 'racel@gmail.com', '$2y$10$YbfIIErUgASt3W0y6HpIi.y5667ofbX2bHYzWGYNRtWi8CAPopo0a', '2024-09-15 19:48:08', '2024-11-30 23:13:54', 'profile.jpg', NULL, NULL, NULL, NULL, NULL, 0, '2024-11-30 23:13:54'),
(20, 'supplier', 'racels', '1ra@gmail.com', '$2y$10$hlBfashINKF7BGvZ2f/0SendLQMe/UYOUvGEgEv26wd.YGKsasp1G', '2024-09-15 19:53:50', '2024-12-01 04:48:38', 'profile.jpg', NULL, NULL, NULL, NULL, NULL, 1, '2024-12-01 04:48:38'),
(22, 'customer', 'client', 'client@gmail.com', '$2y$10$TCR1OMGZyQ7c2CaObgVq3.XI8FDOhtct4fOfQiqekIPspMGouboui', '2024-09-24 02:57:18', '2024-12-01 04:04:26', 'profile.jpg', NULL, NULL, NULL, NULL, ',2024-10-03,2024-10-05,2024-10-12', 0, '2024-12-01 04:04:26'),
(23, 'supplier', 'Test Updated', 'test@gmail.com', '$2y$10$E.NRidcwuXwIpmwfonL04.7HSPGq69xeA.8r3JF9IR2nanR7yv22y', '2024-09-24 03:48:59', '2024-10-31 05:44:12', 'profile.jpg', NULL, NULL, NULL, NULL, ',2024-10-03,2024-10-05,2024-10-12', 0, '2024-11-30 22:36:31'),
(25, 'supplier', 'Ivan', 'kate@gmail.com', '$2y$10$ri6n0lqMhglZcELaRgPpPOmzmKR.gg242J7JXcwo0dLTtiLl0cSau', '2024-11-30 21:07:32', '2024-12-01 04:53:01', 'profile.jpg', NULL, NULL, NULL, NULL, ',2024-11-02,2024-11-01,2024-11-08,2024-11-09,2024-11-16,2024-11-15,2024-11-14,2024-11-07', 1, '2024-12-01 04:53:01'),
(26, 'admin', 'admin', 'admin@gmail.com', '$2y$10$opUH24g9VfMnpi1qYe634u2OSYi7auE9AP2kFb1maZVZrx8ex5gMy', '2024-11-30 21:26:12', '2024-12-01 06:06:14', 'profile.jpg', NULL, NULL, NULL, NULL, NULL, 0, '2024-12-01 06:06:14'),
(27, 'supplier', 'kate', 'kates@gmail.com', '$2y$10$IFxQruNE7x2sseGfxn4shuRrB/vtKWZZ5QuCuB1zvAeElGFPkdExi', '2024-12-01 04:49:15', '2024-12-01 04:51:41', 'profile.jpg', NULL, NULL, NULL, NULL, NULL, 1, '2024-12-01 04:51:41');

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
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snapfeed`
--
ALTER TABLE `snapfeed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_news`
--
ALTER TABLE `sub_news`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `snapfeed`
--
ALTER TABLE `snapfeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sub_news`
--
ALTER TABLE `sub_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
