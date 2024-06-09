-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2024 at 10:40 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `entak_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `created_at`, `updated_at`) VALUES
(2, 1, 'Plant Deleted', 'Plant with Address  23 Ifite Road Abia Nigeria is deleted', '2024-04-06 12:10:35', '2024-04-06 12:10:35'),
(3, 1, 'Plant Deleted', 'Plant with Address  23 Ifite Road Abia Nigeria is deleted', '2024-04-06 12:36:40', '2024-04-06 12:36:40'),
(4, 1, 'Plant Created', 'Plant with Address  25 Ifite Road Centre Cameroon is deleted', '2024-04-06 12:40:45', '2024-04-06 12:40:45'),
(5, 1, 'Tenant Failed', 'Tenant With email jude@bell.com failed to create', '2024-04-06 13:27:03', '2024-04-06 13:27:03'),
(6, 1, 'Tenant Failed', 'Tenant With email elexispd28@gmail.com failed to create', '2024-04-06 13:28:21', '2024-04-06 13:28:21'),
(7, 1, 'Tenant Failed', 'Tenant With email admin@admin.com failed to create', '2024-04-06 13:29:53', '2024-04-06 13:29:53'),
(8, 1, 'Tenant Created', 'Tenant With email jude@bell.com is created', '2024-04-06 13:32:28', '2024-04-06 13:32:28'),
(9, 1, 'Tenant Created', 'Tenant With email ander@herrera.com is created', '2024-04-06 13:36:35', '2024-04-06 13:36:35'),
(10, 1, 'Tenant Created', 'Tenant With email api@premiumesowp.com is created', '2024-04-06 13:53:37', '2024-04-06 13:53:37'),
(11, 1, 'Tenant Created', 'Tenant With email jude@bell.com is created', '2024-04-06 13:57:27', '2024-04-06 13:57:27'),
(12, 1, 'User Updated', 'Tenant with name Jude Bell is updated', '2024-04-07 15:46:59', '2024-04-07 15:46:59'),
(13, 1, 'User Failed', 'User With Meter-Number 1234-567-89AC failed to create', '2024-04-07 19:09:55', '2024-04-07 19:09:55'),
(14, 1, 'User Failed', 'User With Meter-Number 1234-567-89AC failed to create', '2024-04-07 19:10:30', '2024-04-07 19:10:30'),
(15, 1, 'Plant Deleted', 'Plant with Address  25 Ifite Road East Cameroon is deleted', '2024-04-07 19:13:03', '2024-04-07 19:13:03'),
(16, 1, 'Plant Created', 'Plant with Address  23 Ifite Road Jigawa Nigeria is created', '2024-04-07 19:13:27', '2024-04-07 19:13:27'),
(17, 1, 'User Failed', 'User With Meter-Number 1234-567-89AC failed to create', '2024-04-07 19:36:03', '2024-04-07 19:36:03'),
(18, 1, 'User Created', 'User With Meter-Number 1234-567-89AC is created', '2024-04-07 19:37:17', '2024-04-07 19:37:17'),
(19, 1, 'Price Created', ' Price for amount 520 faild to create', '2024-04-08 08:55:07', '2024-04-08 08:55:07'),
(20, 1, 'Price Created', ' Price for amount 520 faild to create', '2024-04-08 08:56:14', '2024-04-08 08:56:14'),
(21, 1, 'Price Created', ' Price for amount 520 is created', '2024-04-08 08:57:28', '2024-04-08 08:57:28'),
(22, 1, 'Price Created', 'Price for amount 100 is created', '2024-04-08 09:01:08', '2024-04-08 09:01:08'),
(23, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-08 12:33:12', '2024-04-08 12:33:12'),
(24, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-08 12:35:58', '2024-04-08 12:35:58'),
(25, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 120 amount  is created', '2024-04-08 13:54:26', '2024-04-08 13:54:26'),
(26, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 150 amount  is created', '2024-04-08 13:55:53', '2024-04-08 13:55:53'),
(27, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 210 amount  is created', '2024-04-08 14:15:01', '2024-04-08 14:15:01'),
(28, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-08 14:23:41', '2024-04-08 14:23:41'),
(29, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-08 14:24:11', '2024-04-08 14:24:11'),
(30, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-08 14:24:30', '2024-04-08 14:24:30'),
(31, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-08 14:25:43', '2024-04-08 14:25:43'),
(32, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-08 14:26:19', '2024-04-08 14:26:19'),
(33, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-08 14:27:49', '2024-04-08 14:27:49'),
(34, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-08 14:28:37', '2024-04-08 14:28:37'),
(35, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-08 14:31:01', '2024-04-08 14:31:01'),
(36, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-08 14:33:47', '2024-04-08 14:33:47'),
(37, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-08 14:56:30', '2024-04-08 14:56:30'),
(38, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-08 14:57:22', '2024-04-08 14:57:22'),
(39, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-08 15:00:18', '2024-04-08 15:00:18'),
(40, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 210 amount  is created', '2024-04-08 15:06:12', '2024-04-08 15:06:12'),
(41, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 210 amount  is created', '2024-04-08 15:08:44', '2024-04-08 15:08:44'),
(42, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 4 amount  is created', '2024-04-08 15:10:11', '2024-04-08 15:10:11'),
(43, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-08 15:12:23', '2024-04-08 15:12:23'),
(44, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 6 amount  is created', '2024-04-08 15:13:08', '2024-04-08 15:13:08'),
(45, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-08 15:13:47', '2024-04-08 15:13:47'),
(46, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-08 15:14:24', '2024-04-08 15:14:24'),
(47, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-08 15:14:49', '2024-04-08 15:14:49'),
(48, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-08 15:15:39', '2024-04-08 15:15:39'),
(49, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-08 15:16:31', '2024-04-08 15:16:31'),
(50, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-08 15:25:58', '2024-04-08 15:25:58'),
(51, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-08 15:28:18', '2024-04-08 15:28:18'),
(52, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-08 15:29:29', '2024-04-08 15:29:29'),
(53, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-08 15:29:46', '2024-04-08 15:29:46'),
(54, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-08 15:30:11', '2024-04-08 15:30:11'),
(55, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 7 amount  is created', '2024-04-08 15:31:37', '2024-04-08 15:31:37'),
(56, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 6 amount  is created', '2024-04-08 15:32:20', '2024-04-08 15:32:20'),
(57, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 5 amount  is created', '2024-04-08 15:33:37', '2024-04-08 15:33:37'),
(58, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 210 amount  is created', '2024-04-08 15:34:41', '2024-04-08 15:34:41'),
(59, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 120 amount  is created', '2024-04-08 15:35:11', '2024-04-08 15:35:11'),
(60, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712594949 is successful', '2024-04-08 17:26:21', '2024-04-08 17:26:21'),
(61, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712594949 is successful', '2024-04-08 17:28:50', '2024-04-08 17:28:50'),
(62, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 8 amount  is created', '2024-04-08 17:28:57', '2024-04-08 17:28:57'),
(63, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712601775 is successful', '2024-04-08 17:29:24', '2024-04-08 17:29:24'),
(64, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712594949 is successful', '2024-04-08 17:29:27', '2024-04-08 17:29:27'),
(65, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-08 17:29:43', '2024-04-08 17:29:43'),
(66, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712601401 is canceled', '2024-04-08 17:34:05', '2024-04-08 17:34:05'),
(67, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 120 amount  is created', '2024-04-08 17:43:45', '2024-04-08 17:43:45'),
(68, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 150 amount  is created', '2024-04-10 09:21:49', '2024-04-10 09:21:49'),
(69, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-10 09:23:08', '2024-04-10 09:23:08'),
(70, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712744853 is successful', '2024-04-10 09:27:42', '2024-04-10 09:27:42'),
(71, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-10 09:40:16', '2024-04-10 09:40:16'),
(72, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712745829 is successful', '2024-04-10 09:40:59', '2024-04-10 09:40:59'),
(73, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 210 amount  is created', '2024-04-10 09:41:40', '2024-04-10 09:41:40'),
(74, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 1200 amount  is created', '2024-04-10 09:47:54', '2024-04-10 09:47:54'),
(75, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712746684 is canceled', '2024-04-10 09:48:00', '2024-04-10 09:48:00'),
(76, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-10 14:11:01', '2024-04-10 14:11:01'),
(77, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712762332 is successful', '2024-04-10 14:13:41', '2024-04-10 14:13:41'),
(78, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-10 17:04:09', '2024-04-10 17:04:09'),
(79, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712772389 is successful', '2024-04-10 17:04:22', '2024-04-10 17:04:22'),
(80, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-10 17:05:39', '2024-04-10 17:05:39'),
(81, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 6 amount  is created', '2024-04-10 17:06:36', '2024-04-10 17:06:36'),
(82, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 6 amount  is created', '2024-04-10 17:07:16', '2024-04-10 17:07:16'),
(83, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 6 amount  is created', '2024-04-10 17:21:56', '2024-04-10 17:21:56'),
(84, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712773990 is successful', '2024-04-10 17:22:10', '2024-04-10 17:22:10'),
(85, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 150 amount  is created', '2024-04-10 17:22:18', '2024-04-10 17:22:18'),
(86, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 7 amount  is created', '2024-04-10 17:22:34', '2024-04-10 17:22:34'),
(87, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 7 amount  is created', '2024-04-10 17:22:46', '2024-04-10 17:22:46'),
(88, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 7 amount  is created', '2024-04-10 17:22:55', '2024-04-10 17:22:55'),
(89, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712774173 is successful', '2024-04-10 17:23:05', '2024-04-10 17:23:05'),
(90, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 210 amount  is created', '2024-04-10 17:23:32', '2024-04-10 17:23:32'),
(91, 1, 'Purchase Updated', 'Purchase for gas with order ID 1712773819 is successful', '2024-04-10 17:23:45', '2024-04-10 17:23:45'),
(92, 1, 'Purchase Created', 'Purchase for gas initiated. Quantity 150 amount  is created', '2024-04-10 17:23:55', '2024-04-10 17:23:55'),
(93, 1, 'Admin 2 Created', 'Admin With email elexispd4@gmail.com is created', '2024-04-11 13:29:18', '2024-04-11 13:29:18'),
(94, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 4 amount  is created', '2024-04-12 19:21:56', '2024-04-12 19:21:56'),
(95, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-12 19:24:51', '2024-04-12 19:24:51'),
(96, 1, 'Price Created', 'Price for amount 520 is created', '2024-04-12 19:28:14', '2024-04-12 19:28:14'),
(97, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 150 amount  is created', '2024-04-12 20:24:02', '2024-04-12 20:24:02'),
(98, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712957361 is successful', '2024-04-12 20:24:14', '2024-04-12 20:24:14'),
(99, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-12 20:26:27', '2024-04-12 20:26:27'),
(100, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712957697 is successful', '2024-04-12 20:26:37', '2024-04-12 20:26:37'),
(101, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-12 20:27:47', '2024-04-12 20:27:47'),
(102, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712958122 is successful', '2024-04-12 20:28:01', '2024-04-12 20:28:01'),
(103, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-12 20:30:37', '2024-04-12 20:30:37'),
(104, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712957886 is successful', '2024-04-12 20:30:46', '2024-04-12 20:30:46'),
(105, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-12 20:33:08', '2024-04-12 20:33:08'),
(106, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712958465 is successful', '2024-04-12 20:33:24', '2024-04-12 20:33:24'),
(107, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 120 amount  is created', '2024-04-12 20:36:54', '2024-04-12 20:36:54'),
(108, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712957923 is successful', '2024-04-12 20:37:03', '2024-04-12 20:37:03'),
(109, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 120 amount  is created', '2024-04-12 20:38:17', '2024-04-12 20:38:17'),
(110, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712958724 is successful', '2024-04-12 20:38:28', '2024-04-12 20:38:28'),
(111, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-12 20:40:01', '2024-04-12 20:40:01'),
(112, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712958763 is successful', '2024-04-12 20:40:12', '2024-04-12 20:40:12'),
(113, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-12 20:40:56', '2024-04-12 20:40:56'),
(114, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712958449 is successful', '2024-04-12 20:41:16', '2024-04-12 20:41:16'),
(115, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 4 amount  is created', '2024-04-12 20:42:44', '2024-04-12 20:42:44'),
(116, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712959016 is successful', '2024-04-12 20:42:54', '2024-04-12 20:42:54'),
(117, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-12 20:44:49', '2024-04-12 20:44:49'),
(118, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712958879 is successful', '2024-04-12 20:45:01', '2024-04-12 20:45:01'),
(119, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 4 amount  is created', '2024-04-12 20:54:35', '2024-04-12 20:54:35'),
(120, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712958999 is successful', '2024-04-12 20:54:48', '2024-04-12 20:54:48'),
(121, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-12 20:57:09', '2024-04-12 20:57:09'),
(122, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712959804 is successful', '2024-04-12 20:57:18', '2024-04-12 20:57:18'),
(123, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-12 20:58:30', '2024-04-12 20:58:30'),
(124, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712959700 is successful', '2024-04-12 20:58:41', '2024-04-12 20:58:41'),
(125, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 4 amount  is created', '2024-04-12 21:01:25', '2024-04-12 21:01:25'),
(126, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1712959639 is successful', '2024-04-12 21:01:35', '2024-04-12 21:01:35'),
(127, 1, 'User Password Change', 'User  Elex Promise changed password', '2024-04-13 10:28:24', '2024-04-13 10:28:24'),
(128, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 21 amount  is created', '2024-04-13 10:56:49', '2024-04-13 10:56:49'),
(129, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 5 amount  is created', '2024-04-14 06:37:00', '2024-04-14 06:37:00'),
(130, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1713080762 is successful', '2024-04-14 06:37:09', '2024-04-14 06:37:09'),
(131, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 4 amount  is created', '2024-04-14 06:37:56', '2024-04-14 06:37:56'),
(132, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 121 amount  is created', '2024-04-14 06:38:31', '2024-04-14 06:38:31'),
(133, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1713080750 is successful', '2024-04-14 06:38:38', '2024-04-14 06:38:38'),
(134, 1, 'Tenant Created', 'Tenant With email elexispdd@gmail.com is created', '2024-04-14 07:01:58', '2024-04-14 07:01:58'),
(135, 1, 'User Created', 'User With Meter-Number 1234-567-89ABC is created', '2024-04-14 08:05:51', '2024-04-14 08:05:51'),
(136, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 4 amount  is created', '2024-04-14 08:06:50', '2024-04-14 08:06:50'),
(137, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1713086310 is successful', '2024-04-14 08:07:08', '2024-04-14 08:07:08'),
(138, 1, 'Admin 2 Created', 'Admin With email admin2312@admin.com is created', '2024-04-14 18:16:33', '2024-04-14 18:16:33'),
(139, 1, 'Price Created', 'Price for amount 1000 is created', '2024-04-14 18:21:55', '2024-04-14 18:21:55'),
(140, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-14 18:41:19', '2024-04-14 18:41:19'),
(141, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1713124113 is successful', '2024-04-14 18:41:44', '2024-04-14 18:41:44'),
(142, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-14 18:42:15', '2024-04-14 18:42:15'),
(143, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1713124697 is successful', '2024-04-14 18:42:30', '2024-04-14 18:42:30'),
(144, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-16 11:28:34', '2024-04-16 11:28:34'),
(145, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1713270774 is successful', '2024-04-16 11:36:32', '2024-04-16 11:36:32'),
(146, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-16 11:37:50', '2024-04-16 11:37:50'),
(147, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1713271972 is successful', '2024-04-16 11:38:01', '2024-04-16 11:38:01'),
(148, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 4 amount  is created', '2024-04-16 11:53:46', '2024-04-16 11:53:46'),
(149, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1713272617 is successful', '2024-04-16 11:53:55', '2024-04-16 11:53:55'),
(150, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-16 12:07:52', '2024-04-16 12:07:52'),
(151, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1713273246 is successful', '2024-04-16 12:08:00', '2024-04-16 12:08:00'),
(152, 1, 'Tenant Created', 'Tenant With email tenant@gmail.com is created', '2024-04-16 13:10:59', '2024-04-16 13:10:59'),
(153, 1, 'Tenant Failed', 'Tenant With email ye@gmail.com failed to create', '2024-04-16 13:22:02', '2024-04-16 13:22:02'),
(154, 1, 'Tenant Failed', 'Tenant With email elexispd278@gmail.com failed to create', '2024-04-16 13:22:57', '2024-04-16 13:22:57'),
(155, 1, 'Tenant Failed', 'Tenant With email admink@gmail.com failed to create', '2024-04-16 13:25:07', '2024-04-16 13:25:07'),
(156, 1, 'Tenant Created', 'Tenant With email ten@admin.com is created', '2024-04-16 13:26:19', '2024-04-16 13:26:19'),
(157, 1, 'Tenant Created', 'Tenant With email tadmin@gmail.com is created', '2024-04-16 13:27:08', '2024-04-16 13:27:08'),
(158, 1, 'Tenant Created', 'Tenant With email telexispd28@gmail.com is created', '2024-04-16 13:36:16', '2024-04-16 13:36:16'),
(159, 1, 'Tenant Created', 'Tenant With email elexispd28d@gmail.com is created', '2024-04-17 08:51:06', '2024-04-17 08:51:06'),
(160, 1, 'Tenant Created', 'Tenant With email shdsg@sds.com is created', '2024-04-17 09:10:45', '2024-04-17 09:10:45'),
(161, 1, 'Tenant Created', 'Tenant With email elexispd28sA@gmail.com is created', '2024-04-17 09:15:32', '2024-04-17 09:15:32'),
(162, 1, 'Tenant Created', 'Tenant With email promisedeco2S4@gmail.com is created', '2024-04-17 09:16:40', '2024-04-17 09:16:40'),
(163, 1, 'Tenant Created', 'Tenant With email elexispd8@gmail.com is created', '2024-04-17 09:18:06', '2024-04-17 09:18:06'),
(164, 1, 'User Created', 'User With Meter-Number 1234-567-89ABCD is created', '2024-04-17 09:20:38', '2024-04-17 09:20:38'),
(165, 1, 'User Created', 'User With Meter-Number 1234-567-89AC is created', '2024-04-17 09:23:11', '2024-04-17 09:23:11'),
(166, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-21 18:09:10', '2024-04-21 18:09:10'),
(167, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1713727369 is successful', '2024-04-21 18:09:26', '2024-04-21 18:09:26'),
(168, NULL, 'User Password Change', 'User  Wayne Rooney changed password', '2024-04-21 18:14:43', '2024-04-21 18:14:43'),
(169, 1, 'Tenant Created', 'Tenant With email tenant2@gmail.com is created', '2024-04-21 18:20:31', '2024-04-21 18:20:31'),
(170, 1, 'Plant Created', 'Plant with Address  23 Ifite Road Jigawa Nigeria is created', '2024-04-21 18:22:05', '2024-04-21 18:22:05'),
(171, 1, 'User Created', 'User With Meter-Number 47500167482 is created', '2024-04-21 18:41:07', '2024-04-21 18:41:07'),
(172, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 12 amount  is created', '2024-04-21 18:43:47', '2024-04-21 18:43:47'),
(173, 45, 'Purchase Updated', 'Purchase for gas with order ID 1713729546 is successful', '2024-04-21 18:43:55', '2024-04-21 18:43:55'),
(174, 1, 'Price Created', 'Price for amount 1090 is created', '2024-04-21 19:03:57', '2024-04-21 19:03:57'),
(175, 1, 'Price Created', 'Price for amount 1095 is created', '2024-04-21 19:05:56', '2024-04-21 19:05:56'),
(176, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-21 20:16:42', '2024-04-21 20:16:42'),
(177, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-21 20:16:45', '2024-04-21 20:16:45'),
(178, 45, 'Purchase Updated', 'Purchase for gas with order ID 1713734935 is successful', '2024-04-21 20:17:00', '2024-04-21 20:17:00'),
(179, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 5 amount  is created', '2024-04-21 20:21:38', '2024-04-21 20:21:38'),
(180, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1713734799 is successful', '2024-04-21 20:21:59', '2024-04-21 20:21:59'),
(181, NULL, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-21 20:39:20', '2024-04-21 20:39:20'),
(182, NULL, 'Purchase Updated', 'Purchase for gas with order ID 1713736128 is successful', '2024-04-21 20:39:51', '2024-04-21 20:39:51'),
(183, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-21 20:40:54', '2024-04-21 20:40:54'),
(184, 45, 'Purchase Updated', 'Purchase for gas with order ID 1713736306 is successful', '2024-04-21 20:41:21', '2024-04-21 20:41:21'),
(185, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 4 amount  is created', '2024-04-21 20:45:35', '2024-04-21 20:45:35'),
(186, 45, 'Purchase Updated', 'Purchase for gas with order ID 1713736612 is successful', '2024-04-21 20:46:41', '2024-04-21 20:46:41'),
(187, 1, 'Price Failed', 'Price for amount 109 failed to create', '2024-04-23 09:55:37', '2024-04-23 09:55:37'),
(188, 1, 'Price Failed', 'Price for amount 520 failed to create', '2024-04-23 09:57:11', '2024-04-23 09:57:11'),
(189, 1, 'Price Created', 'Price for amount 520 is created', '2024-04-23 09:58:51', '2024-04-23 09:58:51'),
(190, 1, 'Price Created', 'Price for amount 140 is created', '2024-04-23 09:59:21', '2024-04-23 09:59:21'),
(191, 1, 'Price Created', 'Price for amount 200 is created', '2024-04-23 10:00:18', '2024-04-23 10:00:18'),
(192, 1, 'Price Created', 'Price for amount 1090 is created', '2024-04-23 10:00:38', '2024-04-23 10:00:38'),
(193, 1, 'Price Created', 'Price for amount 10 is created', '2024-04-23 10:03:31', '2024-04-23 10:03:31'),
(194, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-23 11:42:02', '2024-04-23 11:42:02'),
(195, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:22:31', '2024-04-24 14:22:31'),
(196, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:22:36', '2024-04-24 14:22:36'),
(197, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:22:42', '2024-04-24 14:22:42'),
(198, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:22:47', '2024-04-24 14:22:47'),
(199, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:22:54', '2024-04-24 14:22:54'),
(200, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:23:00', '2024-04-24 14:23:00'),
(201, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:23:04', '2024-04-24 14:23:04'),
(202, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:23:14', '2024-04-24 14:23:14'),
(203, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:23:21', '2024-04-24 14:23:21'),
(204, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:23:26', '2024-04-24 14:23:26'),
(205, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:23:31', '2024-04-24 14:23:31'),
(206, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:23:37', '2024-04-24 14:23:37'),
(207, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:23:42', '2024-04-24 14:23:42'),
(208, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:23:47', '2024-04-24 14:23:47'),
(209, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:23:53', '2024-04-24 14:23:53'),
(210, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:23:58', '2024-04-24 14:23:58'),
(211, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:24:05', '2024-04-24 14:24:05'),
(212, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:24:10', '2024-04-24 14:24:10'),
(213, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:24:16', '2024-04-24 14:24:16'),
(214, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:24:45', '2024-04-24 14:24:45'),
(215, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:24:51', '2024-04-24 14:24:51'),
(216, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:24:57', '2024-04-24 14:24:57'),
(217, 1, 'Admin 2 Created', 'Admin With email entak_admin@gmail.com is created', '2024-04-24 14:26:12', '2024-04-24 14:26:12'),
(218, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:26:25', '2024-04-24 14:26:25'),
(219, 1, 'User Deleted', 'Plant with Address     is created', '2024-04-24 14:26:30', '2024-04-24 14:26:30'),
(220, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-04-24 14:26:38', '2024-04-24 14:26:38'),
(221, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-04-24 14:46:11', '2024-04-24 14:46:11'),
(222, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-04-24 14:51:46', '2024-04-24 14:51:46'),
(223, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-04-24 14:52:19', '2024-04-24 14:52:19'),
(224, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-04-24 14:53:41', '2024-04-24 14:53:41'),
(225, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-04-24 14:56:14', '2024-04-24 14:56:14'),
(226, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-04-24 14:56:25', '2024-04-24 14:56:25'),
(227, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-04-24 14:59:02', '2024-04-24 14:59:02'),
(228, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-04-24 14:59:26', '2024-04-24 14:59:26'),
(229, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-04-24 17:34:18', '2024-04-24 17:34:18'),
(230, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-04-24 17:34:34', '2024-04-24 17:34:34'),
(231, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 5 amount  is created', '2024-04-24 17:41:55', '2024-04-24 17:41:55'),
(232, 45, 'Purchase Updated', 'Purchase for gas with order ID 1713984593 is successful', '2024-04-24 17:42:07', '2024-04-24 17:42:07'),
(233, 1, 'User Created', 'User With Meter-Number 1234-567-89ABd is created', '2024-04-28 01:43:49', '2024-04-28 01:43:49'),
(234, 1, 'User Updated', 'User With Meter-Number 1234-567-89ABd is updated', '2024-04-28 01:52:39', '2024-04-28 01:52:39'),
(235, 1, 'User Updated', 'User With Meter-Number 1234-567-89ABd is updated', '2024-04-28 01:54:44', '2024-04-28 01:54:44'),
(236, 1, 'User Updated', 'User With Meter-Number 47500167482 is updated', '2024-04-28 01:55:15', '2024-04-28 01:55:15'),
(237, 1, 'User Updated', 'User With Meter-Number 47500167482 is updated', '2024-04-28 02:02:39', '2024-04-28 02:02:39'),
(238, 1, 'User Updated', 'User With Meter-Number 47500167482 is updated', '2024-04-28 03:14:40', '2024-04-28 03:14:40'),
(239, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-04-28 03:18:51', '2024-04-28 03:18:51'),
(240, 45, 'Purchase Updated', 'Purchase for gas with order ID 1714278832 is successful', '2024-04-28 03:19:05', '2024-04-28 03:19:05'),
(241, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-28 03:29:19', '2024-04-28 03:29:19'),
(242, 45, 'Purchase Updated', 'Purchase for gas with order ID 1714279160 is successful', '2024-04-28 03:29:31', '2024-04-28 03:29:31'),
(243, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-04-28 03:36:09', '2024-04-28 03:36:09'),
(244, 45, 'Purchase Updated', 'Purchase for gas with order ID 1714279815 is successful', '2024-04-28 03:36:17', '2024-04-28 03:36:17'),
(245, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 120 amount  is created', '2024-04-28 03:38:52', '2024-04-28 03:38:52'),
(246, 45, 'Purchase Updated', 'Purchase for gas with order ID 1714279903 is successful', '2024-04-28 03:39:00', '2024-04-28 03:39:00'),
(247, 1, 'User Updated', 'User With Meter-Number 47500167482 is updated', '2024-04-28 03:40:57', '2024-04-28 03:40:57'),
(248, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 150 amount  is created', '2024-04-28 03:45:33', '2024-04-28 03:45:33'),
(249, 45, 'Purchase Updated', 'Purchase for gas with order ID 1714280421 is successful', '2024-04-28 03:45:57', '2024-04-28 03:45:57'),
(250, 1, 'User Updated', 'User With Meter-Number 47500167482 is updated', '2024-04-28 17:54:49', '2024-04-28 17:54:49'),
(251, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-04-28 17:55:19', '2024-04-28 17:55:19'),
(252, 45, 'Purchase Updated', 'Purchase for gas with order ID 1714331234 is successful', '2024-04-28 17:55:29', '2024-04-28 17:55:29'),
(253, 1, 'User Updated', 'User With Meter-Number 47500167482 is updated', '2024-05-01 13:31:46', '2024-05-01 13:31:46'),
(254, 1, 'User Updated', 'Tenant with name Elexis Promise is updated', '2024-05-01 13:33:41', '2024-05-01 13:33:41'),
(255, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-05-01 17:12:14', '2024-05-01 17:12:14'),
(256, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-05-01 17:12:19', '2024-05-01 17:12:19'),
(257, 1, 'Plant Created', 'Plant with Address  23 Ifite Road Brong-Ahafo Ghana is created', '2024-05-01 17:37:30', '2024-05-01 17:37:30'),
(258, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-05-01 18:06:35', '2024-05-01 18:06:35'),
(259, 1, 'User Updated', 'Tenant with name Entak Admin is updated', '2024-05-01 18:06:50', '2024-05-01 18:06:50'),
(260, 1, 'Plant Created', 'Plant with Address  23 Ifite Road Centre Cameroon is created', '2024-05-01 18:09:57', '2024-05-01 18:09:57'),
(261, 1, 'User Created', 'User With Meter-Number 1234567890 is created', '2024-05-01 18:20:46', '2024-05-01 18:20:46'),
(262, 48, 'Purchase Created', 'Purchase for gas initiated. Quantity 120 amount  is created', '2024-05-01 18:22:13', '2024-05-01 18:22:13'),
(263, 1, 'User Updated', 'User With Meter-Number 1234567890 is updated', '2024-05-01 18:24:39', '2024-05-01 18:24:39'),
(264, 48, 'Purchase Created', 'Purchase for gas initiated. Quantity 120 amount  is created', '2024-05-01 18:26:02', '2024-05-01 18:26:02'),
(265, 48, 'Purchase Updated', 'Purchase for gas with order ID 1714592268 is successful', '2024-05-01 18:26:14', '2024-05-01 18:26:14'),
(266, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-05-05 07:14:46', '2024-05-05 07:14:46'),
(267, 45, 'Purchase Updated', 'Purchase for gas with order ID 1714897471 is successful', '2024-05-05 07:14:55', '2024-05-05 07:14:55'),
(268, 48, 'Purchase Created', 'Purchase for gas initiated. Quantity 4 amount  is created', '2024-05-05 08:26:59', '2024-05-05 08:26:59'),
(269, 48, 'Purchase Updated', 'Purchase for gas with order ID 1714902168 is successful', '2024-05-05 08:27:08', '2024-05-05 08:27:08'),
(270, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 3 amount  is created', '2024-05-05 18:43:11', '2024-05-05 18:43:11'),
(271, 45, 'Purchase Updated', 'Purchase for gas with order ID 1714938375 is successful', '2024-05-05 18:43:20', '2024-05-05 18:43:20'),
(272, 48, 'Purchase Created', 'Purchase for gas initiated. Quantity 2 amount  is created', '2024-05-05 18:44:35', '2024-05-05 18:44:35'),
(273, 48, 'Purchase Updated', 'Purchase for gas with order ID 1714938868 is successful', '2024-05-05 18:44:43', '2024-05-05 18:44:43'),
(274, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 1 amount  is created', '2024-05-07 20:34:52', '2024-05-07 20:34:52'),
(275, 45, 'Purchase Updated', 'Purchase for gas with order ID 1715117891 is successful', '2024-05-07 20:35:05', '2024-05-07 20:35:05'),
(276, 45, 'Purchase Created', 'Purchase for gas initiated. Quantity 120 amount  is created', '2024-06-03 08:54:28', '2024-06-03 08:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(4, 'emails', '{\"uuid\":\"be9bb383-fa54-4554-94c5-470f931335e4\",\"displayName\":\"App\\\\Jobs\\\\SendRegisterEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendRegisterEmail\",\"command\":\"O:26:\\\"App\\\\Jobs\\\\SendRegisterEmail\\\":4:{s:32:\\\"\\u0000App\\\\Jobs\\\\SendRegisterEmail\\u0000name\\\";s:6:\\\"Elexis\\\";s:36:\\\"\\u0000App\\\\Jobs\\\\SendRegisterEmail\\u0000username\\\";s:24:\\\"promisedeco2S4@gmail.com\\\";s:36:\\\"\\u0000App\\\\Jobs\\\\SendRegisterEmail\\u0000password\\\";s:11:\\\"tenant12345\\\";s:5:\\\"queue\\\";s:6:\\\"emails\\\";}\"}}', 0, NULL, 1713349000, 1713349000),
(5, 'emails', '{\"uuid\":\"ccfdd1f9-1630-4a6f-b92c-7ee140cbfa6d\",\"displayName\":\"App\\\\Jobs\\\\SendTokenEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendTokenEmail\",\"command\":\"O:23:\\\"App\\\\Jobs\\\\SendTokenEmail\\\":4:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"\\u0000*\\u0000details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Purchase\\\";s:2:\\\"id\\\";i:40;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"\\u0000*\\u0000token\\\";s:24:\\\"7265 3676 3080 5901 0967\\\";s:5:\\\"queue\\\";s:6:\\\"emails\\\";}\"}}', 0, NULL, 1713726569, 1713726569),
(6, 'emails', '{\"uuid\":\"08a88267-76e4-44e2-9eb9-8366001cb7c4\",\"displayName\":\"App\\\\Jobs\\\\SendTokenEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendTokenEmail\",\"command\":\"O:23:\\\"App\\\\Jobs\\\\SendTokenEmail\\\":4:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:45;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:10:\\\"\\u0000*\\u0000details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Purchase\\\";s:2:\\\"id\\\";i:41;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"\\u0000*\\u0000token\\\";s:24:\\\"7192 3828 2194 6703 3691\\\";s:5:\\\"queue\\\";s:6:\\\"emails\\\";}\"}}', 0, NULL, 1713728638, 1713728638);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(18, '2014_10_12_000000_create_users_table', 1),
(19, '2014_10_12_100000_create_password_resets_table', 1),
(20, '2019_08_19_000000_create_failed_jobs_table', 1),
(21, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(22, '2024_04_04_001127_create_plants_table', 1),
(24, '2024_04_04_223534_create_plant_user_table', 2),
(25, '2024_04_05_113617_create_activity_logs_table', 3),
(27, '2024_04_08_092315_create_prices_table', 4),
(28, '2024_04_08_111114_create_purchases_table', 5),
(29, '2024_04_17_093920_create_jobs_table', 6),
(30, '2024_04_23_105319_add_country_to_prices_table', 7),
(31, '2024_04_28_021718_add_phone_number_to_users_table', 8),
(32, '2024_05_24_140019_add_currency_to_purchases_table', 9),
(33, '2024_05_24_141001_add_channel_to_purchases_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` bigint UNSIGNED NOT NULL,
  `tenant_id` bigint UNSIGNED NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `tenant_id`, `country`, `state`, `address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(7, 44, 'Nigeria', 'Jigawa', '23 Ifite Road', NULL, '2024-04-21 18:22:05', '2024-04-21 18:22:05'),
(9, 44, 'Cameroon', 'Centre', '23 Ifite Road', NULL, '2024-05-01 18:09:57', '2024-05-01 18:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `plant_user`
--

CREATE TABLE `plant_user` (
  `id` bigint UNSIGNED NOT NULL,
  `plant_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plant_user`
--

INSERT INTO `plant_user` (`id`, `plant_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(8, 7, 45, 1, '2024-04-21 18:41:07', NULL),
(10, 9, 48, 1, '2024-05-01 18:20:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` bigint UNSIGNED NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `quantity`, `price`, `country`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 520.00, 'Nigeria', 0, '2024-04-23 09:58:51', '2024-04-23 10:00:38'),
(2, '1', 140.00, 'Cameroon', 1, '2024-04-23 09:59:21', '2024-04-23 09:59:21'),
(3, '1', 200.00, 'Ghana', 0, '2024-04-23 10:00:18', '2024-04-23 10:03:31'),
(4, '1', 1090.00, 'Nigeria', 1, '2024-04-23 10:00:38', '2024-04-23 10:00:38'),
(5, '1', 10.00, 'Ghana', 1, '2024-04-23 10:03:31', '2024-04-23 10:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` double(8,2) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `quantity`, `amount`, `order_id`, `status`, `created_at`, `updated_at`, `currency`, `channel`) VALUES
(1, 1, 3.00, 300.00, '1712772389', 1, '2024-04-10 17:04:09', '2024-04-10 17:04:22', NULL, NULL),
(2, 1, 2.00, 200.00, '1712772878', 0, '2024-04-10 17:05:39', '2024-04-10 17:05:39', NULL, NULL),
(3, 1, 6.00, 600.00, '1712772915', 0, '2024-04-10 17:06:36', '2024-04-10 17:06:36', NULL, NULL),
(4, 1, 6.00, 600.00, '1712772831', 0, '2024-04-10 17:07:16', '2024-04-10 17:07:16', NULL, NULL),
(5, 1, 6.00, 600.00, '1712773990', 1, '2024-04-10 17:21:56', '2024-04-10 17:22:10', NULL, NULL),
(6, 1, 150.00, 15000.00, '1712773743', 0, '2024-04-10 17:22:18', '2024-04-10 17:22:18', NULL, NULL),
(7, 1, 7.00, 700.00, '1712773820', 0, '2024-04-10 17:22:34', '2024-04-10 17:22:34', NULL, NULL),
(8, 1, 7.00, 700.00, '1712773784', 0, '2024-04-10 17:22:46', '2024-04-10 17:22:46', NULL, NULL),
(9, 1, 7.00, 700.00, '1712774173', 1, '2024-04-10 17:22:55', '2024-04-10 17:23:05', NULL, NULL),
(10, 1, 210.00, 21000.00, '1712773819', 1, '2024-04-10 17:23:32', '2024-04-10 17:23:45', NULL, NULL),
(11, 1, 150.00, 15000.00, '1712773957', 0, '2024-04-10 17:23:55', '2024-04-10 17:23:55', NULL, NULL),
(12, NULL, 4.00, 400.00, '1712954004', 0, '2024-04-12 19:21:56', '2024-04-12 19:21:56', NULL, NULL),
(13, NULL, 2.00, 200.00, '1712954144', 0, '2024-04-12 19:24:51', '2024-04-12 19:24:51', NULL, NULL),
(14, NULL, 150.00, 78000.00, '1712957361', 1, '2024-04-12 20:24:02', '2024-04-12 20:24:14', NULL, NULL),
(15, NULL, 3.00, 1560.00, '1712957697', 1, '2024-04-12 20:26:27', '2024-04-12 20:26:37', NULL, NULL),
(16, NULL, 3.00, 1560.00, '1712958122', 1, '2024-04-12 20:27:47', '2024-04-12 20:28:01', NULL, NULL),
(17, NULL, 2.00, 1040.00, '1712957886', 1, '2024-04-12 20:30:37', '2024-04-12 20:30:46', NULL, NULL),
(18, NULL, 1.00, 520.00, '1712958465', 1, '2024-04-12 20:33:08', '2024-04-12 20:33:24', NULL, NULL),
(19, NULL, 120.00, 62400.00, '1712957923', 1, '2024-04-12 20:36:54', '2024-04-12 20:37:03', NULL, NULL),
(20, NULL, 120.00, 62400.00, '1712958724', 1, '2024-04-12 20:38:17', '2024-04-12 20:38:28', NULL, NULL),
(21, NULL, 1.00, 520.00, '1712958763', 1, '2024-04-12 20:40:01', '2024-04-12 20:40:12', NULL, NULL),
(22, NULL, 3.00, 1560.00, '1712958449', 1, '2024-04-12 20:40:56', '2024-04-12 20:41:16', NULL, NULL),
(23, NULL, 4.00, 2080.00, '1712959016', 1, '2024-04-12 20:42:44', '2024-04-12 20:42:54', NULL, NULL),
(24, NULL, 3.00, 1560.00, '1712958879', 1, '2024-04-12 20:44:49', '2024-04-12 20:45:01', NULL, NULL),
(25, NULL, 4.00, 2080.00, '1712958999', 1, '2024-04-12 20:54:35', '2024-04-12 20:54:48', NULL, NULL),
(26, NULL, 2.00, 1040.00, '1712959804', 1, '2024-04-12 20:57:09', '2024-04-12 20:57:18', NULL, NULL),
(27, NULL, 3.00, 1560.00, '1712959700', 1, '2024-04-12 20:58:30', '2024-04-12 20:58:41', NULL, NULL),
(28, NULL, 4.00, 2080.00, '1712959639', 1, '2024-04-12 21:01:25', '2024-04-12 21:01:35', NULL, NULL),
(29, NULL, 21.00, 10920.00, '1713010111', 0, '2024-04-13 10:56:49', '2024-04-13 10:56:49', NULL, NULL),
(30, NULL, 5.00, 2600.00, '1713080762', 1, '2024-04-14 06:37:00', '2024-04-14 06:37:09', NULL, NULL),
(31, NULL, 4.00, 2080.00, '1713080832', 0, '2024-04-14 06:37:56', '2024-04-14 06:37:56', NULL, NULL),
(32, NULL, 121.00, 62920.00, '1713080750', 1, '2024-04-14 06:38:31', '2024-04-14 06:38:38', NULL, NULL),
(33, NULL, 4.00, 2080.00, '1713086310', 1, '2024-04-14 08:06:50', '2024-04-14 08:07:08', NULL, NULL),
(34, NULL, 3.00, 3000.00, '1713124113', 1, '2024-04-14 18:41:19', '2024-04-14 18:41:44', NULL, NULL),
(35, NULL, 2.00, 2000.00, '1713124697', 1, '2024-04-14 18:42:15', '2024-04-14 18:42:30', NULL, NULL),
(36, NULL, 3.00, 3000.00, '1713270774', 1, '2024-04-16 11:28:34', '2024-04-16 11:36:32', NULL, NULL),
(37, NULL, 3.00, 3000.00, '1713271972', 1, '2024-04-16 11:37:50', '2024-04-16 11:38:01', NULL, NULL),
(38, NULL, 4.00, 4000.00, '1713272617', 1, '2024-04-16 11:53:46', '2024-04-16 11:53:55', NULL, NULL),
(39, NULL, 1.00, 1000.00, '1713273246', 1, '2024-04-16 12:07:52', '2024-04-16 12:08:00', NULL, NULL),
(40, NULL, 3.00, 3000.00, '1713727369', 1, '2024-04-21 18:09:10', '2024-04-21 18:09:26', NULL, NULL),
(41, 45, 12.00, 12000.00, '1713729546', 1, '2024-04-21 18:43:47', '2024-04-21 18:43:55', NULL, NULL),
(42, 45, 2.00, 2190.00, '1713734861', 0, '2024-04-21 20:16:42', '2024-04-21 20:16:42', NULL, NULL),
(43, 45, 2.00, 2190.00, '1713734935', 1, '2024-04-21 20:16:45', '2024-04-21 20:17:00', NULL, NULL),
(44, NULL, 5.00, 5475.00, '1713734799', 1, '2024-04-21 20:21:38', '2024-04-21 20:21:59', NULL, NULL),
(45, NULL, 2.00, 2190.00, '1713736128', 1, '2024-04-21 20:39:20', '2024-04-21 20:39:51', NULL, NULL),
(46, 45, 3.00, 3285.00, '1713736306', 1, '2024-04-21 20:40:54', '2024-04-21 20:41:21', NULL, NULL),
(47, 45, 4.00, 4380.00, '1713736612', 1, '2024-04-21 20:45:35', '2024-04-21 20:46:41', NULL, NULL),
(48, 45, 1.00, 1090.00, '1713877038', 0, '2024-04-23 11:42:02', '2024-04-23 11:42:02', NULL, NULL),
(49, 45, 5.00, 5450.00, '1713984593', 1, '2024-04-24 17:41:55', '2024-04-24 17:42:06', NULL, NULL),
(50, 45, 3.00, 3270.00, '1714278832', 1, '2024-04-28 03:18:51', '2024-04-28 03:19:05', NULL, NULL),
(51, 45, 2.00, 2180.00, '1714279160', 1, '2024-04-28 03:29:19', '2024-04-28 03:29:31', NULL, NULL),
(52, 45, 1.00, 1090.00, '1714279815', 1, '2024-04-28 03:36:09', '2024-04-28 03:36:17', NULL, NULL),
(53, 45, 120.00, 130800.00, '1714279903', 1, '2024-04-28 03:38:52', '2024-04-28 03:39:00', NULL, NULL),
(54, 45, 150.00, 163500.00, '1714280421', 1, '2024-04-28 03:45:33', '2024-04-28 03:45:57', NULL, NULL),
(55, 45, 2.00, 2180.00, '1714331234', 1, '2024-04-28 17:55:19', '2024-04-28 17:55:29', NULL, NULL),
(56, 48, 120.00, 16800.00, '1714592046', 0, '2024-05-01 18:22:13', '2024-05-01 18:22:13', NULL, NULL),
(57, 48, 120.00, 16800.00, '1714592268', 1, '2024-05-01 18:26:02', '2024-05-01 18:26:14', NULL, NULL),
(60, 45, 3.00, 3270.00, '1714938375', 1, '2024-05-05 18:43:11', '2024-05-05 18:43:20', NULL, NULL),
(61, 48, 2.00, 280.00, '1714938868', 1, '2024-05-05 18:44:34', '2024-05-05 18:44:43', NULL, NULL),
(62, 45, 1.00, 1090.00, '1715117891', 1, '2024-05-07 20:34:52', '2024-05-07 20:35:05', NULL, NULL),
(63, 45, 120.00, 130800.00, '1717409354', 0, '2024-06-03 08:54:28', '2024-06-03 08:54:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meter_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_super_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_tenant` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `country`, `state`, `address`, `meter_number`, `is_admin`, `is_super_admin`, `is_tenant`, `email`, `phone_number`, `email_verified_at`, `password`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Elex', 'Promise', NULL, NULL, NULL, NULL, 0, 1, 0, 'promisedeco24@gmail.com', '2347088911803', '2024-04-04 00:11:21', '$2y$10$X5fsFKlEqnAYrbSsoNnzI.fnwuyEYwhKGkev.qRHmh8XHIsCdU.EK', NULL, 'FxdTGAXG7Is1O5ZaP38MAaqwETXoVo5SYvDR4Mge6kXaGTchHuoAFTf7WeGb', '2024-04-04 00:11:21', '2024-04-21 18:17:08'),
(44, 'Elexis', 'Promise', 'Nigeria', 'Jigawa', '23 Ifite Road', NULL, 0, 0, 1, 'tenant2@gmail.com', '2348181346797', NULL, '$2y$10$OM/xhuFaNHfUW0EO3FJ4j.MBq/ckINVhWugq8hPUPHP2aWYYyA1ti', NULL, NULL, '2024-04-21 18:20:27', '2024-05-01 13:33:41'),
(45, 'Elexis', 'Promise', 'Nigeria', 'Jigawa', NULL, '47500167482', 0, 0, 0, 'entak@gmail.com', '2348181346797', NULL, '$2y$10$8/bgU0ZuqIlsUBlQOqlAiepyvUZvBjor717HX.nU47Z61h4Pi0Mim', NULL, NULL, '2024-04-21 18:41:02', '2024-04-28 17:54:49'),
(46, 'Entak', 'Admin', 'Cameroon', 'Centre', '23 Ifite Road', NULL, 1, 0, 0, 'entak_admin@gmail.com', '2348181346576', NULL, '$2y$10$v.m97/A8qw7yxz5DeI28nu3k.5ALA6cdhm2/HUQnEw3RsAirSdK8q', NULL, NULL, '2024-04-24 14:26:12', '2024-05-01 18:06:50'),
(48, 'User', 'Test', 'Cameroon', 'Centre', NULL, '1234567890', 0, 0, 0, 'enowdaniel@gmail.com', '2348167555345', NULL, '$2y$10$gMRO1lNudkgRrtaYqA6kLOzpT1wb1QZ5bPatdVP0o7B6psS4bLy/W', NULL, NULL, '2024-05-01 18:20:42', '2024-05-01 18:24:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plants_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `plant_user`
--
ALTER TABLE `plant_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plant_user_plant_id_foreign` (`plant_id`),
  ADD KEY `plant_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `plant_user`
--
ALTER TABLE `plant_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `plants_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plant_user`
--
ALTER TABLE `plant_user`
  ADD CONSTRAINT `plant_user_plant_id_foreign` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plant_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
