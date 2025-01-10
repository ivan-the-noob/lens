-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 03:54 AM
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
  `view_type` enum('grid','carousel') NOT NULL DEFAULT 'grid',
  `price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_me`
--

INSERT INTO `about_me` (`id`, `profile_image`, `profession`, `about_me`, `age`, `latitude`, `longitude`, `created_at`, `email`, `location_text`, `view_type`, `price`) VALUES
(1, '../../../../assets/img/profile/gallery-6.jpg', 'photographer', 'dasasdsa', 12, 14.2838325, 120.8668772, '2024-09-17 08:36:54', '', NULL, 'grid', 0.00),
(2, '../../../../assets/img/profile/gallery-6.jpg', 'photographer,videographer', 'dasasdsa', 12, 14.2838325, 120.8668772, '2024-09-17 08:37:24', '', NULL, 'grid', 0.00),
(3, 'default_image.jpg', 'photographer', 'hello real', 13, 14.2813281, 120.8703823, '2024-09-17 08:40:36', '1@gmail.com', 'Trece Martires City Hall, Governor\'s Drive, Trece Martires, Cavite, Philippines', 'carousel', 0.00),
(4, 'default_image.jpg', 'photographer,videographer', 'Hey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good heheHey Please hire me, I\'m good hehe', 12, 14.2838325, 120.8668772, '2024-09-26 20:22:51', 'test@gmail.com', '', 'carousel', 10.00),
(5, '../../../../assets/img/profile/Rectangle 6.png', 'photographer,videographer', 'Hello Diana', 12, 14.3274718, 120.9505047, '2024-10-23 00:57:47', 'supplier@gmail.com', '', 'grid', 0.00);

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
  `email` varchar(255) NOT NULL,
  `status` enum('Pending','Accepted','Completed','Decline','Cancelled') NOT NULL DEFAULT 'Pending',
  `cancel_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `name`, `latitude`, `longitude`, `event`, `time`, `selected_date`, `email_uploader`, `email`, `status`, `cancel_reason`) VALUES
(7, 'Diana', 14.283833, 120.866877, 'photography', '00:30:00', '2024-11-08', '1@gmail.com', 'client@gmail.com', 'Accepted', 'hey'),
(8, 'Diana', 14.283833, 120.866877, 'photography', '01:43:00', '2024-11-02', 'supplier@gmail.com', 'clients@gmail.com', 'Accepted', NULL),
(9, 'Diana', 14.283833, 120.866877, 'videography', '11:54:00', '2024-11-02', 'kate@gmail.com', 'clients@gmail.com', 'Completed', NULL),
(10, 'Diana', 14.283833, 120.866877, 'photography', '22:52:00', '2025-01-11', 'supplier@gmail.com', 'client@gmail.com', 'Accepted', 'help'),
(11, 'Diana', 14.283833, 120.866877, 'photography', '22:52:00', '2025-01-11', 'supplier@gmail.com', 'client@gmail.com', 'Accepted', 'dasdas');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `uploader_email` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `role` enum('customer','supplier') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `click_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `email`, `uploader_email`, `text`, `role`, `created_at`, `click_email`) VALUES
(1, 'client@gmail.com', 'supplier@gmail.com', 'dasdas', '', '2025-01-08 17:09:37', ''),
(2, 'client@gmail.com', 'supplier@gmail.com', 'hey', '', '2025-01-08 17:13:12', ''),
(3, 'test1@gmail.com', 'supplier@gmail.com', 'test1', 'customer', '2025-01-08 17:13:54', ''),
(4, 'client@gmail.com', 'supplier@gmail.com', 'Hi hello.', 'customer', '2025-01-08 17:25:26', ''),
(5, 'client@gmail.com', 'supplier@gmail.com', 'dsadas', 'customer', '2025-01-08 17:25:52', ''),
(7, 'supplier@gmail.com', 'test@gmail.com', 'eom', 'supplier', '2025-01-08 18:21:25', ''),
(8, 'supplier@gmail.com', 'test@gmail.com', 'hey', 'supplier', '2025-01-08 20:01:31', ''),
(9, 'supplier@gmail.com', 'test@gmail.com', 'hey', 'supplier', '2025-01-08 20:21:04', ''),
(10, 'supplier@gmail.com', 'test@gmail.com', 'hey', 'supplier', '2025-01-08 20:25:06', ''),
(11, 'supplier@gmail.com', 'test@gmail.com', 'dsadsadsa', 'supplier', '2025-01-08 20:25:32', ''),
(12, 'supplier@gmail.com', 'test@gmail.com', '12', 'supplier', '2025-01-08 20:36:58', ''),
(13, 'supplier@gmail.com', 'test@gmail.com', 'a', 'supplier', '2025-01-08 20:38:17', ''),
(14, 'supplier@gmail.com', 'test@gmail.com', 'a', 'supplier', '2025-01-08 20:41:01', ''),
(15, 'supplier@gmail.com', 'test@gmail.com', 'a', 'supplier', '2025-01-08 20:41:19', ''),
(16, 'supplier@gmail.com', 'test@gmail.com', 'a', 'supplier', '2025-01-08 20:41:48', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `card_img` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `session_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `card_img`, `email`, `comments`, `created_at`, `session_email`) VALUES
(2, 'Rectangle 53.png', 'supplier@gmail.com', 'dasdsa', '2025-01-08 05:37:14', 'client@gmail.com'),
(3, 'silver.png', 'test@gmail.com', 'hey', '2025-01-08 05:37:43', 'client@gmail.com');

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
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_uploader` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('pending','completed','cancelled','update','Accepted','declined') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `email`, `email_uploader`, `message`, `status`, `created_at`) VALUES
(1, 'client@gmail.com', 'supplier@gmail.com', 'Your appointment is pending approval.', 'pending', '2025-01-08 02:50:41'),
(2, 'client@gmail.com', 'supplier@gmail.com', 'Your appointment is pending approval.', 'pending', '2025-01-08 02:51:23'),
(3, 'client@gmail.com', '', 'Profile has been updated.', 'update', '2025-01-08 03:05:29'),
(4, 'client@gmail.com', '', 'Password has been changed.', 'update', '2025-01-08 03:06:00'),
(7, 'client@gmail.com', 'supplier@gmail.com', 'Appointment has been cancelled.', 'cancelled', '2025-01-08 03:28:09'),
(14, 'client@gmail.com', 'supplier@gmail.com', 'Your appointment has been accepted.', 'Accepted', '2025-01-08 04:12:40'),
(15, 'client@gmail.com', 'supplier@gmail.com', 'Your appointment has been accepted.', 'Accepted', '2025-01-08 05:02:07'),
(16, 'client@gmail.com', '', 'Profile has been updated.', 'update', '2025-01-10 01:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_email`, `supplier_email`, `rating`, `review`, `created_at`, `name`) VALUES
(5, 'client@gmail.com', '1@gmail.com', 3, 'dsadas', '2025-01-07 05:56:59', 'client'),
(6, 'client1@gmail.com', '1@gmail.com', 4, 'Great service!', '2025-01-06 20:00:00', 'Client 1'),
(7, 'client2@gmail.com', 'supplier@gmail.com', 6, 'Excellent quality!', '2025-01-06 20:05:00', 'Client 2'),
(8, 'client3@gmail.com', 'test@gmail.com', 5, 'Satisfactory experience.', '2025-01-06 20:10:00', 'Client 3'),
(9, 'client4@gmail.com', 'supplier3@gmail.com', 2, 'Could be better.', '2025-01-06 20:15:00', 'Client 4'),
(10, 'client5@gmail.com', 'supplier5@gmail.com', 4, 'Good value for money.', '2025-01-06 20:20:00', 'Client 5'),
(11, 'client6@gmail.com', 'supplier6@gmail.com', 5, 'Absolutely perfect!', '2025-01-06 20:25:00', 'Client 6'),
(12, 'client7@gmail.com', 'supplier7@gmail.com', 3, 'Average quality, could improve.', '2025-01-06 20:30:00', 'Client 7'),
(13, 'client8@gmail.com', 'test@gmail.com', 4, 'Good customer service.', '2025-01-06 20:35:00', 'Client 8'),
(14, 'client9@gmail.com', 'supplier8@gmail.com', 2, 'Not satisfied with the product.', '2025-01-06 20:40:00', 'Client 9'),
(15, 'client10@gmail.com', 'supplier10@gmail.com', 5, 'Highly recommend! Excellent service.', '2025-01-06 20:45:00', 'Client 10');

-- --------------------------------------------------------

--
-- Table structure for table `recovery_requests`
--

CREATE TABLE `recovery_requests` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `recovery_reason` text NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('disabled','active') DEFAULT 'disabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recovery_requests`
--

INSERT INTO `recovery_requests` (`id`, `email`, `recovery_reason`, `request_date`, `status`) VALUES
(2, 'supplier@gmail.com', 'I want to unban', '2025-01-07 09:32:07', 'active');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `disable_status` int(11) DEFAULT 1,
  `warning_reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `reporter_name`, `reporter_email`, `reported_name`, `reported_email`, `role`, `reason`, `created_at`, `disable_status`, `warning_reason`) VALUES
(1, 'Alice Johnson', 'alice.johnson@example.com', 'Tom Smith', 'tom.smith@example.com', 'customer', 'Inappropriate behavior.', '2024-11-30 23:28:49', 1, ''),
(2, 'Bob Brown', 'bob.brown@example.com', 'Susan White', 'susan.white@example.com', 'customer', 'Fraudulent activity.', '2024-11-30 23:28:49', 1, ''),
(3, 'Carol Davis', 'carol.davis@example.com', 'Mark Taylor', 'mark.taylor@example.com', 'customer', 'Unreliable payment.', '2024-11-30 23:28:49', 1, ''),
(4, 'David Evans', 'david.evans@example.com', 'Emily Clark', 'emily.clark@example.com', 'customer', 'Breach of agreement.', '2024-11-30 23:28:49', 1, ''),
(5, 'Eve Miller', 'eve.miller@example.com', 'Jake Wilson', 'jake.wilson@example.com', 'customer', 'Unprofessional conduct.', '2024-11-30 23:28:49', 1, ''),
(6, 'Frank Moore', 'frank.moore@example.com', 'Nancy Green', 'nancy.green@example.com', 'customer', 'Delayed deliveries.', '2024-11-30 23:28:49', 2, ''),
(7, 'Grace Taylor', 'grace.taylor@example.com', 'Henry Adams', 'henry.adams@example.com', 'supplier', 'Product quality issues.', '2024-11-30 23:28:49', 1, ''),
(8, 'Hank Harris', 'hank.harris@example.com', 'Olivia Baker', 'olivia.baker@example.com', 'supplier', 'Lack of communication.', '2024-11-30 23:28:49', 1, ''),
(9, 'Isabel King', 'isabel.king@example.com', 'Peter Wright', 'peter.wright@example.com', 'supplier', 'Overcharging for services.', '2024-11-30 23:28:49', 1, ''),
(10, 'Jack Lee', 'jack.lee@example.com', 'Laura Martin', 'laura.martin@example.com', 'supplier', 'Unethical practices.', '2024-11-30 23:28:49', 1, ''),
(14, 'Diana Client', 'client@gmail.com', 'racels', 'test@gmail.com', 'customer', '', '2025-01-10 02:08:12', 1, ''),
(15, 'Diana Client', 'client@gmail.com', 'racels', 'test@gmail.com', 'customer', 'dasdas', '2025-01-10 02:09:29', 1, '');

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
(15, 'gallery-2.jpg', '121321', '2024-09-16 01:08:05', 'BABAE NA PICTURE', '1@gmail.com', 0, NULL),
(16, 'gallery-4.jpg', 'dasdsa', '2024-09-16 01:08:12', 'dsadsa', '1@gmail.com', 0, NULL),
(17, 'gallery-3.jpg', 'dasdsa', '2024-09-16 01:11:59', 'dsadsa', '1@gmail.com', 0, NULL),
(18, 'gallery-1.jpg', '123', '2024-09-16 01:14:21', '123', '1@gmail.com', 0, NULL),
(19, 'gallery-5.jpg', '1', '2024-09-16 01:14:39', '1', '1@gmail.com', 0, NULL),
(20, 'gallery-6.jpg', '1', '2024-09-16 01:14:46', '1', '1@gmail.com', 0, NULL),
(21, 'gallery-7.jpg', '1', '2024-09-16 01:14:52', '1', '1@gmail.com', 0, NULL),
(25, 'gallery-12.jpg', '1', '2024-09-16 01:15:25', '1', '1@gmail.com', 0, NULL),
(26, 'gallery-2.jpg', 'ganda', '2024-09-16 01:47:22', 'Hey', '1@gmail.com', 0, NULL),
(27, 'gallery-14.jpg', 'test', '2024-09-24 03:51:58', 'test', '1@gmail.com', 0, NULL),
(29, 'gallery-16.jpg', 'test1', '2024-09-24 05:45:50', 'test1', 'test@gmail.com', 0, '\"TEST 1\", \"TEST2\", \"DASDSA\", \"hey\"'),
(30, 'camera.png', 'TEST', '2024-10-31 07:29:19', 'TEST', 'supplier@gmail.com', 0, '\"dasdas\"'),
(32, 'MSI_MEG_ACE.jpg', 'test lorem ipsum', '2024-12-01 04:52:49', 'try', 'kate@gmail.com', 0, NULL),
(33, 'silver.png', 'dasdas', '2025-01-07 10:27:54', 'dasdas', 'test@gmail.com', 0, NULL),
(35, 'Rectangle 53.png', '321312', '2025-01-07 10:36:07', 'dasdasda', 'test@gmail.com', 2, NULL),
(36, 'Rectangle 53.png', 'Hello', '2025-01-08 02:42:02', 'Resort', 'supplier@gmail.com', 15, '\"wonderful!\"');

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
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `disable_status` tinyint(4) NOT NULL DEFAULT 1,
  `address` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `social_link` varchar(255) NOT NULL,
  `years_in_profession` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `test_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `created_at`, `updated_at`, `profile_img`, `about_me`, `profession`, `location`, `age`, `day_available`, `is_active`, `last_login`, `disable_status`, `address`, `birthday`, `social_link`, `years_in_profession`, `username`, `test_password`) VALUES
(16, 'supplier', 'Kate', '1@gmail.com', '$2y$10$SXsGg/5MaeD3S.fdoldfgu5YYTZ/RpGLwEMocNmhwA/Pnq8909uHG', '2024-09-15 10:14:40', '2025-01-09 18:49:45', 'profile.jpg', NULL, NULL, NULL, NULL, ',2024-11-09,2024-11-08,2024-11-07', 1, '2025-01-09 18:49:45', 1, '', NULL, '', NULL, '', ''),
(17, 'supplier', 'Diana Supplier', 'supplier@gmail.com', '$2y$10$Nbgr8CZoIfG.DwKmzHQWn.53PiFMxsA1f0wGZgXDkTqMRRJokoZIK', '2024-09-15 10:57:46', '2025-01-10 01:19:29', 'profile.jpg', NULL, NULL, NULL, NULL, ',2024-11-02,2024-11-01,2024-11-08,2024-11-09,2024-11-16,2024-11-15,2025-01-04,2025-01-03,2025-01-02,2025-01-01,2025-01-05,2025-01-06,2025-01-08,2025-01-09,2025-01-10,2025-01-07,2025-01-11', 0, '2025-01-10 01:19:29', 1, '', NULL, '', NULL, '', ''),
(20, 'supplier', 'racels', 'test@gmail.com', '$2y$10$hlBfashINKF7BGvZ2f/0SendLQMe/UYOUvGEgEv26wd.YGKsasp1G', '2024-09-15 19:53:50', '2025-01-10 02:53:20', 'silver.png', NULL, NULL, NULL, NULL, NULL, 1, '2025-01-10 02:53:20', 1, '', NULL, '', NULL, '', ''),
(22, 'customer', 'Diana Client', 'client@gmail.com', '$2y$10$pvkJfihudzcDOvsyD3BquO.2PBPdTW.jqp40LRdN4Moxp58w.CNcG', '2024-09-24 02:57:18', '2025-01-10 01:29:09', 'profile_6780753aed6f28.89438446.png', NULL, NULL, 'Blk 4 Lot 23', 5, ',2024-10-03,2024-10-05,2024-10-12', 0, '2025-01-10 01:29:09', 1, 'Blk 4 Lot 23', '2025-01-16', 'https://www.facebook.com/', NULL, '', ''),
(23, 'supplier', 'Test Updated', 'ejivancablanida@gmail.com', 'ivan', '2024-09-24 03:48:59', '2025-01-09 18:49:51', 'profile.jpg', NULL, NULL, NULL, NULL, ',2024-10-03,2024-10-05,2024-10-12', 0, '2025-01-09 18:49:51', 1, '', NULL, '', NULL, '', 'ivan'),
(26, 'admin', 'admin', 'admin@gmail.com', '$2y$10$opUH24g9VfMnpi1qYe634u2OSYi7auE9AP2kFb1maZVZrx8ex5gMy', '2024-11-30 21:26:12', '2025-01-10 01:41:09', 'profile.jpg', NULL, NULL, NULL, NULL, NULL, 0, '2025-01-10 01:41:09', 1, '', NULL, '', NULL, '', ''),
(30, 'customer', 'Ivan ablanida', 'ejivan23@gmail.com', '$2y$10$BtgegI4nre0M//3df3se.ett/.WAiuQbWfb0fyWuXvLR0AnTx6nJq', '2025-01-09 10:18:50', '2025-01-09 18:49:49', 'profile.jpg', NULL, NULL, NULL, NULL, NULL, 0, '2025-01-09 18:49:49', 1, 'dsadas', '2025-01-01', 'https://www.facebook.com/', NULL, '', '');

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
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recovery_requests`
--
ALTER TABLE `recovery_requests`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `recovery_requests`
--
ALTER TABLE `recovery_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `snapfeed`
--
ALTER TABLE `snapfeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sub_news`
--
ALTER TABLE `sub_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
