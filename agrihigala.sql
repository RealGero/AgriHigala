-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2021 at 07:35 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `admin_type_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `user_id`, `admin_type_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2021-04-26 14:22:39', '2021-04-26 14:22:39'),
(2, 9, 2, '2021-04-27 00:34:24', '2021-04-27 00:34:24'),
(3, 10, 2, '2021-04-27 00:37:22', '2021-04-27 00:37:22'),
(4, 1, 1, '2021-04-29 01:10:19', '2021-04-29 01:10:19'),
(5, 8, 1, '2021-04-29 01:10:19', '2021-04-29 01:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `admin_types`
--

CREATE TABLE `admin_types` (
  `admin_type_id` int(10) UNSIGNED NOT NULL,
  `admin_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_types`
--

INSERT INTO `admin_types` (`admin_type_id`, `admin_type_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '2021-04-27 13:43:21', '2021-04-27 13:43:21'),
(2, 'admin', '2021-04-27 13:43:21', '2021-04-27 13:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `brgys`
--

CREATE TABLE `brgys` (
  `brgy_id` int(10) UNSIGNED NOT NULL,
  `brgy_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brgys`
--

INSERT INTO `brgys` (`brgy_id`, `brgy_name`, `created_at`, `updated_at`) VALUES
(1, 'Agusan', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(2, 'Baikingon', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(3, 'Balubal', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(4, 'Balulang', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(5, 'Barangay 1', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(6, 'Barangay 2', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(7, 'Barangay 3', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(8, 'Barangay 4', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(9, 'Barangay 5', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(10, 'Barangay 6', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(11, 'Barangay 7', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(12, 'Barangay 8', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(13, 'Barangay 9', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(14, 'Barangay 10', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(15, 'Barangay 11', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(16, 'Barangay 12', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(17, 'Barangay 13', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(18, 'Barangay 14', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(19, 'Barangay 15', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(20, 'Barangay 16', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(21, 'Barangay 17', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(22, 'Barangay 18', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(23, 'Barangay 19', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(24, 'Barangay 20', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(25, 'Barangay 21', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(26, 'Barangay 22', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(27, 'Barangay 23', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(28, 'Barangay 24', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(29, 'Barangay 25', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(30, 'Barangay 26', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(31, 'Barangay 27', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(32, 'Barangay 28', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(33, 'Barangay 29', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(34, 'Barangay 30', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(35, 'Barangay 31', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(36, 'Barangay 32', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(37, 'Barangay 33', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(38, 'Barangay 34', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(39, 'Barangay 35', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(40, 'Barangay 36', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(41, 'Barangay 37', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(42, 'Barangay 38', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(43, 'Barangay 39', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(44, 'Barangay 40', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(45, 'Bayabas', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(46, 'Bayanga', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(47, 'Besigan', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(48, 'Bonbon', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(49, 'Bugo', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(50, 'Bulua', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(51, 'Camaman‑an', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(52, 'Canito‑an', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(53, 'Carmen', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(54, 'Consolacion', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(55, 'Cugman', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(56, 'Dansolihon', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(57, 'F. S. Catanico', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(58, 'Gusa', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(59, 'Indahag', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(60, 'Iponan', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(61, 'Kauswagan', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(62, 'Lapasan', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(63, 'Lumbia', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(64, 'Macabalan', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(65, 'Macasandig', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(66, 'Mambuaya', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(67, 'Nazareth', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(68, 'Pagalungan', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(69, 'Pagatpat', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(70, 'Patag', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(71, 'Pigsag‑an', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(72, 'Puerto', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(73, 'Puntod', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(74, 'San Simon', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(75, 'Tablon', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(76, 'Taglimao', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(77, 'Tagpangi', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(78, 'Tignapoloan', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(79, 'Tuburan', '2021-04-29 10:13:58', '2021-04-29 10:13:58'),
(80, 'Tumpagon', '2021-04-29 10:13:58', '2021-04-29 10:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `buyer_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `brgy_id` bigint(20) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `gender` enum('Male','Female','Prefer not to say') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valid_id_front` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default-id-front.jpg',
  `valid_id_back` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default-id-back.jpg',
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`buyer_id`, `user_id`, `brgy_id`, `address`, `birthdate`, `verified`, `gender`, `valid_id_front`, `valid_id_back`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 22, 4, 'block 9 lot 10 gold city village', '1990-02-02', 0, 'Male', 'default-id-front.jpg', 'default-id-back.jpg', NULL, '2021-04-27 04:52:42', '2021-04-27 04:52:42'),
(2, 23, 63, 'sitio airport lumbia', '1990-04-05', 0, 'Male', 'default-id-front.jpg', 'default-id-back.jpg', NULL, '2021-04-27 04:55:22', '2021-04-27 04:55:22'),
(3, 24, 63, 'airport lumbia', '1991-04-08', 0, 'Male', 'default-id-front.jpg', 'default-id-back.jpg', NULL, '2021-04-27 04:58:48', '2021-04-27 04:58:48'),
(4, 25, 50, 'lyra st. bulua cagayan de oro city', '1992-09-09', 0, 'Female', 'default-id-front.jpg', 'default-id-back.jpg', NULL, '2021-04-27 05:05:30', '2021-04-27 05:05:30'),
(5, 26, 70, 'camp evangelista patag, cdoc', '1985-04-07', 0, 'Male', 'default-id-front.jpg', 'default-id-back.jpg', NULL, '2021-04-27 05:09:54', '2021-04-27 05:09:54'),
(6, 27, 52, 'caaaaaa', '1990-05-05', 0, 'Male', 'default-id-front.jpg', 'default-id-back.jpg', NULL, '2021-04-29 12:33:29', '2021-04-29 12:33:29'),
(7, 28, 1, 'caaaaaa', '1990-05-05', 0, 'Male', 'default-id-front.jpg', 'default-id-back.jpg', NULL, '2021-04-29 12:35:05', '2021-04-29 12:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `buyer_mailing`
--

CREATE TABLE `buyer_mailing` (
  `buyer_mailing_id` int(10) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `brgy_id` bigint(20) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buyer_mailing`
--

INSERT INTO `buyer_mailing` (`buyer_mailing_id`, `buyer_id`, `brgy_id`, `address`, `mobile_number`, `email`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'block 9 lot 10 gold city village', '09454441111', 'joshua43@gmail.com', '2021-04-27 14:26:19', '2021-04-27 14:26:19'),
(2, 2, 63, 'sitio airport lumbia', '09487414000', 'joniel654@gmail.com', '2021-04-27 14:26:19', '2021-04-27 14:26:19'),
(3, 3, 63, 'airport lumbia', '09658736985', 'iandroe78@gmail.com', '2021-04-27 14:26:20', '2021-04-27 14:26:20'),
(4, 4, 50, 'lyra st. bulua cagayan de oro city', '09685221400', 'liam234@gmail.com', '2021-04-27 14:26:20', '2021-04-27 14:26:20'),
(5, 5, 70, 'camp evangelista patag, cdoc', '09884145539', 'rudy98@gmail.com', '2021-04-27 14:26:25', '2021-04-27 14:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `customer_services`
--

CREATE TABLE `customer_services` (
  `customer_service_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `sender` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_services`
--

INSERT INTO `customer_services` (`customer_service_id`, `user_id`, `sender`, `message`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'user', 'can you help me?', NULL, '2021-04-28 09:35:57', '2021-04-28 09:35:57'),
(2, 22, 'user', 'make your service 24/7', NULL, '2021-04-28 09:35:57', '2021-04-28 09:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `email`, `rating`, `comment`, `platform`, `created_at`, `updated_at`) VALUES
(1, 'qwerty123@gmail.com', 0, 'this is a nice', 'web', '2021-04-27 14:36:28', '2021-04-27 14:36:28'),
(2, 'agfa@gmail.com', 0, 'awesome', 'web', '2021-04-27 14:36:28', '2021-04-27 14:36:28'),
(3, 'maenazi@gmail.com', 0, 'good', 'mobile', '2021-04-27 14:36:28', '2021-04-27 14:36:28'),
(4, 'agusan@gmail.com', 0, 'you rock it bro!!!!', 'web', '2021-04-27 14:36:28', '2021-04-27 14:36:28'),
(5, 'lumbia23@gmail.com', 0, 'fantastic', 'mobile', '2021-04-27 14:36:28', '2021-04-27 14:36:28'),
(6, 'haha45@gmail.com', 0, 'i love it', 'web', '2021-04-27 14:36:28', '2021-04-27 14:36:28'),
(7, 'nellypetal@gmail.com', 0, 'this is a nice', 'web', '2021-04-27 14:36:28', '2021-04-27 14:36:28'),
(8, 'shane@gmail.com', 0, 'thanks guys,it really made my day.mwahhhh', 'web', '2021-04-27 14:36:28', '2021-04-27 14:36:28'),
(9, 'rider5@gmail.com', 0, 'it makes me wow', 'mobile', '2021-04-27 14:36:28', '2021-04-27 14:36:28'),
(10, 'johndoe@gmail.com', 0, 'thanks for this', 'web', '2021-04-27 14:36:28', '2021-04-27 14:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `fee_id` int(10) UNSIGNED NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `brgy_id` bigint(20) DEFAULT NULL,
  `fee_delivery` double(8,2) NOT NULL DEFAULT 0.00,
  `fee_other` double(8,2) NOT NULL DEFAULT 0.00,
  `fee_remarks` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`fee_id`, `seller_id`, `brgy_id`, `fee_delivery`, `fee_other`, `fee_remarks`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 0.00, 0.00, '', '2021-04-27 13:06:37', '2021-04-27 13:06:37'),
(2, 2, NULL, 0.00, 0.00, '', '2021-04-27 13:06:37', '2021-04-27 13:06:37'),
(3, 3, NULL, 0.00, 0.00, '', '2021-04-27 13:06:37', '2021-04-27 13:06:37'),
(4, 4, NULL, 0.00, 0.00, '', '2021-04-27 13:06:37', '2021-04-27 13:06:37'),
(5, 5, NULL, 0.00, 0.00, '', '2021-04-27 13:06:37', '2021-04-27 13:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `inbox_id` int(10) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`inbox_id`, `buyer_id`, `seller_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2021-04-27 14:38:28', '2021-04-27 14:38:28'),
(2, 2, 4, '2021-04-27 14:38:28', '2021-04-27 14:38:28'),
(3, 3, 3, '2021-04-27 14:38:28', '2021-04-27 14:38:28'),
(4, 4, 2, '2021-04-27 14:38:28', '2021-04-27 14:38:28'),
(5, 5, 1, '2021-04-27 14:38:28', '2021-04-27 14:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `inbox_id` bigint(20) NOT NULL,
  `sender` enum('buyer','seller') COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `inbox_id`, `sender`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 'buyer', 'hello!!', '2021-04-27 11:07:48', '2021-04-27 11:07:48'),
(2, 1, 'seller', 'how are you?', '2021-04-27 11:07:48', '2021-04-27 11:07:48'),
(3, 2, 'buyer', 'morning!!', '2021-04-27 11:07:48', '2021-04-27 11:07:48'),
(4, 2, 'seller', 'morning too!!', '2021-04-27 11:07:48', '2021-04-27 11:07:48'),
(5, 3, 'buyer', 'nice!!', '2021-04-27 11:07:48', '2021-04-27 11:07:48'),
(6, 3, 'seller', 'LOL', '2021-04-27 11:07:48', '2021-04-27 11:07:48'),
(7, 4, 'buyer', 'thank you!!', '2021-04-27 11:07:48', '2021-04-27 11:07:48'),
(8, 4, 'seller', 'your welcome', '2021-04-27 11:07:48', '2021-04-27 11:07:48'),
(9, 5, 'buyer', 'hihihihi', '2021-04-27 11:07:48', '2021-04-27 11:07:48'),
(10, 5, 'seller', 'huhuhuhuhu', '2021-04-27 11:07:48', '2021-04-27 11:07:48'),
(11, 5, 'buyer', 'hahahaha', '2021-04-28 12:29:12', '2021-04-28 12:29:12'),
(12, 5, 'buyer', 'heheheheh', '2021-04-28 12:30:25', '2021-04-28 12:30:25'),
(13, 5, 'buyer', 'jijiji', '2021-04-28 12:44:57', '2021-04-28 12:44:57'),
(14, 5, 'buyer', 'hahahaha', '2021-04-28 12:47:04', '2021-04-28 12:47:04'),
(15, 5, 'buyer', 'sasasasas', '2021-04-28 12:49:00', '2021-04-28 12:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_02_22_074803_create_admin_types_table', 1),
(5, '2021_02_22_075640_create_admins_table', 1),
(6, '2021_02_22_080543_create_sellers_table', 1),
(7, '2021_02_22_080938_create_buyers_table', 1),
(8, '2021_02_22_081621_create_riders_table', 1),
(9, '2021_02_22_081757_create_payments_table', 1),
(10, '2021_02_22_082225_create_orders_table', 1),
(11, '2021_02_22_082433_create_messages_table', 1),
(12, '2021_02_22_082851_create_product_types_table', 1),
(13, '2021_02_22_082959_create_products_table', 1),
(14, '2021_02_22_083127_create_stocks_table', 1),
(15, '2021_02_22_083309_create_orderlines_table', 1),
(16, '2021_02_22_083554_create_ratings_table', 1),
(17, '2021_02_22_083750_create_reasons_table', 1),
(18, '2021_02_22_083852_create_return_orders_table', 1),
(19, '2021_02_22_084011_create_srp_table', 1),
(20, '2021_02_22_084156_create_prices_table', 1),
(21, '2021_02_22_084330_create_feedbacks_table', 1),
(22, '2021_03_24_034143_create_units_table', 1),
(23, '2021_03_24_034403_create_brgys_table', 1),
(24, '2021_03_24_034441_create_orgs_table', 1),
(25, '2021_04_17_115831_create_fees_table', 1),
(26, '2021_04_19_054951_create_notifications_table', 1),
(27, '2021_04_19_063909_create_seller_banks_table', 1),
(28, '2021_04_19_071603_create_buyer_mailing_table', 1),
(29, '2021_04_22_132732_create_inbox_table', 1),
(30, '2021_04_27_102950_create_customer_services_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderlines`
--

CREATE TABLE `orderlines` (
  `orderline_id` int(10) UNSIGNED NOT NULL,
  `stock_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderlines`
--

INSERT INTO `orderlines` (`orderline_id`, `stock_id`, `order_id`, `order_qty`, `created_at`, `updated_at`) VALUES
(1, 24, 1, 3, '2021-04-28 05:21:59', '2021-04-28 05:21:59'),
(2, 25, 2, 1, '2021-04-28 05:31:44', '2021-04-28 05:31:44'),
(3, 24, 2, 1, '2021-04-28 05:31:44', '2021-04-28 05:31:44'),
(4, 24, 3, 1, '2021-04-28 05:38:57', '2021-04-28 05:38:57'),
(5, 22, 4, 1, '2021-04-28 05:52:47', '2021-04-28 05:52:47'),
(6, 25, 5, 1, '2021-04-28 06:03:43', '2021-04-28 06:03:43'),
(7, 24, 5, 1, '2021-04-28 06:03:43', '2021-04-28 06:03:43'),
(8, 22, 5, 1, '2021-04-28 06:03:43', '2021-04-28 06:03:43'),
(9, 23, 6, 1, '2021-04-28 06:06:12', '2021-04-28 06:06:12'),
(10, 22, 6, 1, '2021-04-28 06:06:12', '2021-04-28 06:06:12'),
(11, 23, 7, 2, '2021-04-28 06:09:02', '2021-04-28 06:09:02'),
(12, 22, 7, 2, '2021-04-28 06:09:02', '2021-04-28 06:09:02'),
(13, 21, 8, 1, '2021-04-28 06:10:25', '2021-04-28 06:10:25'),
(14, 23, 8, 1, '2021-04-28 06:10:25', '2021-04-28 06:10:25'),
(15, 18, 9, 1, '2021-04-28 06:13:23', '2021-04-28 06:13:23'),
(16, 22, 10, 2, '2021-04-28 06:15:35', '2021-04-28 06:15:35'),
(17, 24, 10, 1, '2021-04-28 06:15:35', '2021-04-28 06:15:35'),
(18, 21, 10, 1, '2021-04-28 06:15:35', '2021-04-28 06:15:35'),
(19, 23, 10, 1, '2021-04-28 06:15:35', '2021-04-28 06:15:35'),
(20, 2, 11, 1, '2021-04-28 06:16:20', '2021-04-28 06:16:20'),
(21, 17, 12, 1, '2021-04-28 06:19:32', '2021-04-28 06:19:32'),
(22, 22, 13, 2, '2021-04-28 06:20:04', '2021-04-28 06:20:04'),
(23, 21, 13, 1, '2021-04-28 06:20:04', '2021-04-28 06:20:04'),
(24, 19, 14, 1, '2021-04-28 06:21:58', '2021-04-28 06:21:58'),
(25, 21, 15, 1, '2021-04-28 06:22:20', '2021-04-28 06:22:20'),
(26, 21, 16, 1, '2021-04-28 12:55:52', '2021-04-28 12:55:52'),
(27, 22, 16, 1, '2021-04-28 12:55:53', '2021-04-28 12:55:53'),
(28, 21, 17, 3, '2021-04-28 13:19:36', '2021-04-28 13:19:36'),
(29, 22, 17, 4, '2021-04-28 13:19:36', '2021-04-28 13:19:36'),
(30, 13, 18, 1, '2021-04-28 13:20:31', '2021-04-28 13:20:31'),
(31, 8, 19, 1, '2021-04-28 13:21:20', '2021-04-28 13:21:20'),
(32, 21, 20, 1, '2021-04-28 13:22:52', '2021-04-28 13:22:52'),
(33, 22, 20, 1, '2021-04-28 13:22:52', '2021-04-28 13:22:52'),
(34, 23, 20, 1, '2021-04-28 13:22:52', '2021-04-28 13:22:52'),
(35, 24, 20, 1, '2021-04-28 13:22:52', '2021-04-28 13:22:52'),
(36, 25, 20, 1, '2021-04-28 13:22:52', '2021-04-28 13:22:52'),
(37, 3, 21, 1, '2021-04-29 07:39:50', '2021-04-29 07:39:50'),
(38, 29, 21, 1, '2021-04-29 07:39:50', '2021-04-29 07:39:50'),
(39, 10, 22, 1, '2021-04-29 07:40:11', '2021-04-29 07:40:11'),
(40, 16, 23, 1, '2021-04-29 10:24:41', '2021-04-29 10:24:41'),
(41, 22, 24, 1, '2021-04-30 03:26:15', '2021-04-30 03:26:15'),
(42, 24, 24, 1, '2021-04-30 03:26:16', '2021-04-30 03:26:16'),
(43, 25, 24, 1, '2021-04-30 03:26:16', '2021-04-30 03:26:16'),
(44, 31, 25, 4, '2021-04-30 04:09:03', '2021-04-30 04:09:03'),
(45, 29, 25, 3, '2021-04-30 04:09:03', '2021-04-30 04:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `rider_id` bigint(20) DEFAULT NULL,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `packed_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `buyer_id`, `rider_id`, `accepted_at`, `packed_at`, `delivered_at`, `completed_at`, `created_at`, `updated_at`) VALUES
(5, 1, NULL, NULL, NULL, NULL, '2021-04-28 08:50:36', '2021-04-28 06:03:43', '2021-04-28 08:50:36'),
(6, 1, NULL, NULL, NULL, NULL, '2021-04-28 08:50:59', '2021-04-28 06:06:12', '2021-04-28 08:50:59'),
(7, 2, 9, '2021-04-28 08:51:39', '2021-04-28 08:53:04', '2021-04-28 08:53:54', '2021-04-28 08:54:16', '2021-04-28 06:09:02', '2021-04-28 08:54:16'),
(8, 2, 10, '2021-04-28 08:57:44', '2021-04-28 08:58:18', '2021-04-28 08:58:24', '2021-04-28 09:16:18', '2021-04-28 06:10:25', '2021-04-28 09:16:18'),
(9, 3, NULL, '2021-04-28 08:40:39', NULL, NULL, '2021-04-28 08:44:51', '2021-04-28 06:13:23', '2021-04-28 08:44:51'),
(10, 3, 9, '2021-04-28 08:59:46', '2021-04-28 08:59:57', '2021-04-28 09:00:05', NULL, '2021-04-28 06:15:35', '2021-04-28 09:00:05'),
(12, 4, NULL, '2021-04-28 08:47:33', NULL, NULL, '2021-04-28 08:48:13', '2021-04-28 06:19:31', '2021-04-28 08:48:13'),
(13, 4, 9, '2021-04-28 09:11:45', '2021-04-28 09:11:58', '2021-04-28 09:12:11', '2021-04-28 09:13:47', '2021-04-28 06:20:03', '2021-04-28 09:13:47'),
(14, 5, 7, '2021-04-28 08:49:26', '2021-04-28 08:55:17', '2021-04-28 08:56:54', '2021-04-28 08:57:04', '2021-04-28 06:21:58', '2021-04-28 08:57:04'),
(15, 5, 10, '2021-04-28 09:14:53', '2021-04-28 12:59:45', '2021-04-28 13:01:38', '2021-04-28 09:14:59', '2021-04-28 06:22:20', '2021-04-28 13:01:38'),
(16, 5, 10, '2021-04-28 12:59:24', '2021-04-28 12:59:36', '2021-04-28 13:02:02', NULL, '2021-04-28 12:55:52', '2021-04-28 13:02:02'),
(17, 1, NULL, NULL, NULL, NULL, NULL, '2021-04-28 13:19:36', '2021-04-28 13:19:36'),
(18, 1, NULL, NULL, NULL, NULL, NULL, '2021-04-28 13:20:31', '2021-04-28 13:20:31'),
(19, 1, NULL, NULL, NULL, NULL, NULL, '2021-04-28 13:21:20', '2021-04-28 13:21:20'),
(20, 2, NULL, NULL, NULL, NULL, NULL, '2021-04-28 13:22:51', '2021-04-28 13:22:51'),
(21, 4, NULL, NULL, NULL, NULL, NULL, '2021-04-29 07:39:50', '2021-04-29 07:39:50'),
(22, 4, NULL, NULL, NULL, NULL, NULL, '2021-04-29 07:40:11', '2021-04-29 07:40:11'),
(23, 1, NULL, NULL, NULL, NULL, NULL, '2021-04-29 10:24:41', '2021-04-29 10:24:41'),
(24, 1, NULL, NULL, NULL, NULL, NULL, '2021-04-30 03:26:15', '2021-04-30 03:26:15'),
(25, 1, NULL, NULL, NULL, NULL, NULL, '2021-04-30 04:09:03', '2021-04-30 04:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `orgs`
--

CREATE TABLE `orgs` (
  `org_id` int(10) UNSIGNED NOT NULL,
  `brgy_id` bigint(20) NOT NULL,
  `org_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orgs`
--

INSERT INTO `orgs` (`org_id`, `brgy_id`, `org_name`, `address`, `created_at`, `updated_at`) VALUES
(1, 50, '10TH REGIONAL EQUIPMENT SERVICES-DPWH MPC', 'ZONE 1, BULUA, CAGAYAN DE ORO CITY', '2021-04-27 14:22:55', '2021-04-27 14:22:55'),
(2, 53, '1ST VALLEY CREDIT COOPERATIVE ', 'VAMENTA RD., CORNER LIRIO STREET, CARMEN, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(3, 53, 'ADVOCATES FOR PROGRESSIVE MINDANAO MPC ', 'DILG REG\'L OFFICE, UPPER CARMEN, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(4, 61, 'AFP ENLISTED PERSONNEL RETIREES MULTI -PURPOSE COOPERATIVE', 'BLOCK 3 LOT 6, NHA, KAUSWAGAN, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(5, 61, 'ALLIANCE OF CONCERN PARENTS MULTI PURPOSE COOPERATIVE ', 'ZONE 4, PASIL, BRGY., KAUSWAGAN, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(6, 53, 'ALLIANCE OF TWO HEARTS MEMBERS\' MPC', 'SSVP SERVICE CENTER, MT.CARMEL PARISH, CARMEN, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(7, 49, 'ALLIED SERVICES MULTI-PURPOSE COOPERATIVE OF NORTHERN MINDANAO', 'BUGO, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(8, 64, 'ALTERNATIVE RESOURCES DEVELOPMENT MPC', 'DENR REGION -10 COMPOUND, MACABALAN, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(9, 53, 'Amen Multi-Purpose Cooperative', 'Zone 8, Dagong Carmen, Cagayan de Oro City', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(10, 53, 'Archdiocese of Cagayan de Oro Social Action Service Cooperative (ACDO-SASCO) ', 'Our Lady of Carmel Parish, Carmen, Cagayan de Oro City', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(11, 63, 'BALUARTE DEVELOPMENT COOPERATIVE (BADECO) ', 'SITIO BALUARTE, BARANGAY LUMBIA, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(12, 63, 'BALUARTE MULTI-PURPOSE COOPERATIVE', 'BALUARTE, LUMBIA, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(13, 3, 'BALUBAL ASSOCIATED MULTI-PURPOSE COOPERATIVE (BAMPCO)', 'BRGY. HALL, PUROK 1, BALUBAL, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(14, 4, 'BALULANG COMMUNITY MULTI-PURPOSE COOPERATIVE (BACOMCO)', 'BARANGAY HALL, BRGY. BALULANG, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(15, 31, 'BARANGAY 27 MULTIPURPOSE COOPERATIVE', 'BRGY. 27 BRGY. HALL, ANTONIO LUNA ST., CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(16, 45, 'BAYABAS MPC ', 'ZONE 1, BUARA, BAYABAS, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(17, 63, 'BEST AGRI- PRODUCTS PROCESSING COOPERATIVE', 'LUMBIA, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(18, 4, 'Boholano Fraternal Credit Cooperative', 'B-12, L2, Xavier Heights Subdivision, Cagayan de Oro City', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(19, 49, 'BUGO CENTRAL SCHOOL TEACHERS & EMPLOYEES MPC ', 'BUGO, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57'),
(20, 49, 'BUGO MPC ', 'BUGO, CAGAYAN DE ORO CITY', '2021-04-27 14:22:57', '2021-04-27 14:22:57');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(10) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `fee_id` bigint(20) NOT NULL,
  `payment_order` double(8,2) NOT NULL,
  `payment_total` double(8,2) NOT NULL,
  `payment_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `payment_method` enum('cod','online') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `fee_id`, `payment_order`, `payment_total`, `payment_image`, `paid_at`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 150.00, 150.00, NULL, NULL, 'online', '2021-04-28 05:21:59', '2021-04-28 05:21:59'),
(2, 2, 3, 65.00, 65.00, NULL, NULL, 'online', '2021-04-28 05:31:44', '2021-04-28 05:31:44'),
(3, 3, 3, 50.00, 50.00, NULL, NULL, 'cod', '2021-04-28 05:38:57', '2021-04-28 05:38:57'),
(4, 4, 3, 15.00, 15.00, NULL, NULL, 'online', '2021-04-28 05:52:47', '2021-04-28 05:52:47'),
(5, 5, 3, 80.00, 80.00, NULL, NULL, 'cod', '2021-04-28 06:03:44', '2021-04-28 06:03:44'),
(6, 6, 3, 45.00, 45.00, NULL, NULL, 'online', '2021-04-28 06:06:12', '2021-04-28 06:06:12'),
(7, 7, 3, 90.00, 90.00, NULL, NULL, 'cod', '2021-04-28 06:09:02', '2021-04-28 06:09:02'),
(8, 8, 3, 80.00, 80.00, NULL, NULL, 'online', '2021-04-28 06:10:25', '2021-04-28 06:10:25'),
(9, 9, 1, 170.00, 170.00, NULL, NULL, 'cod', '2021-04-28 06:13:23', '2021-04-28 06:13:23'),
(10, 10, 3, 190.00, 190.00, NULL, NULL, 'cod', '2021-04-28 06:15:35', '2021-04-28 06:15:35'),
(11, 11, 5, 330.00, 330.00, NULL, NULL, 'online', '2021-04-28 06:16:20', '2021-04-28 06:16:20'),
(12, 12, 1, 190.00, 190.00, NULL, NULL, 'cod', '2021-04-28 06:19:32', '2021-04-28 06:19:32'),
(13, 13, 3, 110.00, 110.00, NULL, NULL, 'online', '2021-04-28 06:20:04', '2021-04-28 06:20:04'),
(14, 14, 1, 15.00, 15.00, NULL, NULL, 'cod', '2021-04-28 06:21:58', '2021-04-28 06:21:58'),
(15, 15, 3, 50.00, 50.00, NULL, NULL, 'online', '2021-04-28 06:22:20', '2021-04-28 06:22:20'),
(16, 16, 3, 65.00, 65.00, NULL, NULL, 'cod', '2021-04-28 12:55:53', '2021-04-28 12:55:53'),
(17, 17, 3, 210.00, 210.00, NULL, NULL, 'cod', '2021-04-28 13:19:36', '2021-04-28 13:19:36'),
(18, 18, 2, 280.00, 280.00, NULL, NULL, 'cod', '2021-04-28 13:20:31', '2021-04-28 13:20:31'),
(19, 19, 4, 80.00, 80.00, NULL, NULL, 'online', '2021-04-28 13:21:20', '2021-04-28 13:21:20'),
(20, 20, 3, 160.00, 160.00, NULL, NULL, 'cod', '2021-04-28 13:22:52', '2021-04-28 13:22:52'),
(21, 21, 5, 101.00, 101.00, NULL, NULL, 'cod', '2021-04-29 07:39:50', '2021-04-29 07:39:50'),
(22, 22, 4, 190.00, 190.00, NULL, NULL, 'cod', '2021-04-29 07:40:11', '2021-04-29 07:40:11'),
(23, 23, 1, 280.00, 280.00, NULL, NULL, 'cod', '2021-04-29 10:24:41', '2021-04-29 10:24:41'),
(24, 24, 3, 55.00, 55.00, NULL, NULL, 'cod', '2021-04-30 03:26:16', '2021-04-30 03:26:16'),
(25, 25, 5, 966.00, 966.00, NULL, NULL, 'cod', '2021-04-30 04:09:03', '2021-04-30 04:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `price_id` int(10) UNSIGNED NOT NULL,
  `stock_id` bigint(20) NOT NULL,
  `unit_id` bigint(20) NOT NULL,
  `stock_price` double(8,2) NOT NULL,
  `discount_price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`price_id`, `stock_id`, `unit_id`, `stock_price`, `discount_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 80.00, NULL, '2021-04-27 11:59:56', '2021-04-27 11:59:56'),
(2, 2, 1, 330.00, NULL, '2021-04-27 12:04:46', '2021-04-27 12:04:46'),
(3, 3, 1, 20.00, NULL, '2021-04-27 12:06:12', '2021-04-27 12:06:12'),
(4, 4, 1, 30.00, NULL, '2021-04-27 12:07:16', '2021-04-27 12:07:16'),
(5, 5, 1, 180.00, NULL, '2021-04-27 12:08:12', '2021-04-27 12:08:12'),
(6, 6, 1, 80.00, NULL, '2021-04-27 12:09:25', '2021-04-27 12:09:25'),
(7, 7, 1, 70.00, NULL, '2021-04-27 12:11:45', '2021-04-27 12:11:45'),
(8, 8, 1, 80.00, NULL, '2021-04-27 12:15:38', '2021-04-27 12:15:38'),
(9, 9, 1, 190.00, NULL, '2021-04-27 12:18:25', '2021-04-27 12:18:25'),
(10, 10, 1, 190.00, NULL, '2021-04-27 12:19:20', '2021-04-27 12:19:20'),
(11, 11, 1, 180.00, NULL, '2021-04-27 12:21:49', '2021-04-27 12:21:49'),
(12, 12, 1, 15.00, NULL, '2021-04-27 12:22:27', '2021-04-27 12:22:27'),
(13, 13, 1, 280.00, NULL, '2021-04-27 12:23:43', '2021-04-27 12:23:43'),
(14, 14, 1, 30.00, NULL, '2021-04-27 12:25:06', '2021-04-27 12:25:06'),
(15, 15, 1, 50.00, NULL, '2021-04-27 12:25:50', '2021-04-27 12:25:50'),
(16, 16, 1, 280.00, NULL, '2021-04-27 12:27:01', '2021-04-27 12:27:01'),
(17, 17, 1, 190.00, NULL, '2021-04-27 12:27:37', '2021-04-27 12:27:37'),
(18, 18, 1, 170.00, NULL, '2021-04-27 12:28:42', '2021-04-27 12:28:42'),
(19, 19, 2, 15.00, NULL, '2021-04-27 12:29:17', '2021-04-27 12:29:17'),
(20, 20, 1, 50.00, NULL, '2021-04-27 12:30:20', '2021-04-27 12:30:20'),
(21, 21, 1, 50.00, NULL, '2021-04-27 12:32:21', '2021-04-27 12:32:21'),
(22, 22, 2, 15.00, NULL, '2021-04-27 12:33:05', '2021-04-27 12:33:05'),
(23, 23, 1, 30.00, NULL, '2021-04-27 12:34:18', '2021-04-27 12:34:18'),
(24, 24, 1, 50.00, NULL, '2021-04-27 12:36:37', '2021-04-27 12:36:37'),
(25, 25, 2, 15.00, NULL, '2021-04-27 12:37:45', '2021-04-27 12:37:45'),
(26, 26, 1, 30.00, NULL, '2021-04-29 04:13:32', '2021-04-29 04:13:32'),
(27, 27, 1, 80.00, NULL, '2021-04-29 04:38:12', '2021-04-29 04:38:12'),
(28, 28, 1, 80.00, NULL, '2021-04-29 04:53:25', '2021-04-29 04:53:25'),
(29, 29, 1, 81.00, NULL, '2021-04-29 05:41:38', '2021-04-29 05:41:38'),
(30, 30, 1, 30.00, NULL, '2021-04-29 05:55:53', '2021-04-29 05:55:53'),
(31, 31, 1, 180.00, NULL, '2021-04-29 06:02:25', '2021-04-29 06:02:25'),
(32, 12, 1, 60.00, NULL, '2021-04-29 06:31:29', '2021-04-29 06:31:29'),
(33, 15, 2, 50.00, NULL, '2021-04-29 06:42:12', '2021-04-29 06:42:12'),
(34, 14, 1, 35.00, NULL, '2021-04-29 06:43:52', '2021-04-29 06:43:52'),
(35, 11, 1, 185.00, NULL, '2021-04-29 06:45:38', '2021-04-29 06:45:38'),
(36, 11, 1, 186.00, NULL, '2021-04-29 06:49:45', '2021-04-29 06:49:45'),
(37, 17, 1, 195.00, NULL, '2021-04-29 06:53:34', '2021-04-29 06:53:34'),
(38, 23, 1, 35.00, NULL, '2021-04-29 06:58:50', '2021-04-29 06:58:50'),
(39, 24, 1, 25.00, NULL, '2021-04-29 07:02:18', '2021-04-29 07:02:18'),
(40, 6, 1, 82.00, NULL, '2021-04-29 07:11:11', '2021-04-29 07:11:11'),
(41, 7, 1, 75.00, NULL, '2021-04-29 07:12:13', '2021-04-29 07:12:13'),
(42, 8, 1, 81.00, NULL, '2021-04-29 07:13:45', '2021-04-29 07:13:45'),
(43, 9, 1, 195.00, NULL, '2021-04-29 07:18:58', '2021-04-29 07:18:58'),
(44, 10, 1, 210.00, NULL, '2021-04-29 07:21:57', '2021-04-29 07:21:57'),
(45, 3, 1, 25.00, NULL, '2021-04-29 07:25:12', '2021-04-29 07:25:12'),
(46, 5, 1, 185.00, NULL, '2021-04-29 07:28:12', '2021-04-29 07:28:12'),
(47, 3, 1, 185.00, NULL, '2021-04-29 07:29:37', '2021-04-29 07:29:37'),
(48, 29, 1, 82.00, NULL, '2021-04-29 07:32:09', '2021-04-29 07:32:09'),
(49, 16, 1, 110.00, NULL, '2021-04-29 08:24:24', '2021-04-29 08:24:24'),
(50, 16, 1, 115.00, NULL, '2021-04-29 10:28:46', '2021-04-29 10:28:46'),
(51, 17, 1, 110.00, NULL, '2021-04-29 10:29:21', '2021-04-29 10:29:21'),
(52, 11, 1, 120.00, NULL, '2021-04-29 10:30:41', '2021-04-29 10:30:41'),
(53, 11, 1, 115.00, NULL, '2021-04-29 10:31:48', '2021-04-29 10:31:48'),
(54, 9, 1, 120.00, NULL, '2021-04-29 10:34:47', '2021-04-29 10:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_type_id` bigint(20) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_type_id`, `product_name`, `product_description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'cabbage', NULL, NULL, '2021-04-27 07:40:40', '2021-04-27 07:40:40'),
(2, 3, 'carrots', NULL, NULL, '2021-04-27 07:41:39', '2021-04-27 07:41:39'),
(3, 3, 'pechay', NULL, NULL, '2021-04-27 07:43:26', '2021-04-27 07:43:26'),
(4, 3, 'chayote', NULL, NULL, '2021-04-27 07:45:34', '2021-04-27 07:45:34'),
(5, 3, 'tomato', NULL, NULL, '2021-04-27 07:46:43', '2021-04-27 07:46:43'),
(6, 2, 'calamansi', NULL, NULL, '2021-04-27 07:50:16', '2021-04-27 07:50:16'),
(7, 2, 'banana (lakatan)', NULL, NULL, '2021-04-27 07:51:54', '2021-04-27 07:51:54'),
(8, 2, 'papaya', NULL, NULL, '2021-04-27 07:54:41', '2021-04-27 07:54:41'),
(9, 2, 'mango', NULL, NULL, '2021-04-27 08:04:44', '2021-04-27 08:04:44'),
(10, 2, 'apple', NULL, NULL, '2021-04-27 08:08:49', '2021-04-27 08:08:49'),
(11, 1, 'bangus', NULL, NULL, '2021-04-27 08:11:45', '2021-04-27 08:11:45'),
(12, 1, 'galonggong', NULL, NULL, '2021-04-27 08:12:40', '2021-04-27 08:12:40'),
(13, 1, 'tilapia', NULL, NULL, '2021-04-27 08:13:02', '2021-04-27 08:13:02'),
(14, 1, 'tamban', NULL, NULL, '2021-04-27 08:13:49', '2021-04-27 08:13:49'),
(15, 1, 'malasugi', NULL, NULL, '2021-04-27 08:14:24', '2021-04-27 08:14:24'),
(16, 4, 'beef rump', NULL, NULL, '2021-04-27 08:17:50', '2021-04-27 08:17:50'),
(17, 4, 'beef brisket', NULL, NULL, '2021-04-27 08:18:44', '2021-04-27 08:18:44'),
(18, 4, 'pork kasim', NULL, NULL, '2021-04-27 08:20:27', '2021-04-27 08:20:27'),
(19, 4, 'pork liempo', NULL, NULL, '2021-04-27 08:21:12', '2021-04-27 08:21:12'),
(20, 4, 'whole chicken', NULL, NULL, '2021-04-27 08:23:02', '2021-04-27 08:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `product_type_id` int(10) UNSIGNED NOT NULL,
  `product_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_type_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_product_image.jpg',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`product_type_id`, `product_type_name`, `product_type_description`, `product_image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'fish', 'fresh na fresh', 'default_product_image.jpg', NULL, '2021-04-27 03:46:41', '2021-04-27 03:46:41'),
(2, 'fruits', 'fresh', 'default_product_image.jpg', NULL, '2021-04-27 03:47:30', '2021-04-27 03:47:30'),
(3, 'vegetables', 'fresh', 'default_product_image.jpg', NULL, '2021-04-27 03:47:51', '2021-04-27 03:47:51'),
(4, 'meat', 'fresh', 'default_product_image.jpg', NULL, '2021-04-27 03:48:07', '2021-04-27 03:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(10) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `reason_id` int(10) UNSIGNED NOT NULL,
  `reason_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`reason_id`, `reason_name`, `created_at`, `updated_at`) VALUES
(1, 'defective', '2021-04-27 12:51:11', '2021-04-27 12:51:11'),
(2, 'incomplete', '2021-04-27 12:51:11', '2021-04-27 12:51:11'),
(3, 'wrong order', '2021-04-27 12:51:11', '2021-04-27 12:51:11'),
(4, 'not received', '2021-04-27 12:51:11', '2021-04-27 12:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `return_orders`
--

CREATE TABLE `return_orders` (
  `return_id` int(10) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `reason_id` bigint(20) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `denied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_orders`
--

INSERT INTO `return_orders` (`return_id`, `order_id`, `reason_id`, `description`, `accepted_at`, `denied_at`, `created_at`, `updated_at`) VALUES
(1, 8, 1, NULL, NULL, '2021-04-28 09:16:18', '2021-04-28 08:58:42', '2021-04-28 09:16:18'),
(2, 10, 2, 'omg', NULL, NULL, '2021-04-28 09:00:38', '2021-04-28 09:00:38'),
(3, 13, 1, 'omg', '2021-04-28 09:13:28', NULL, '2021-04-28 09:13:17', '2021-04-28 09:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `rider_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `rider_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`rider_id`, `user_id`, `seller_id`, `rider_description`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 12, 5, NULL, NULL, '2021-04-27 03:53:01', '2021-04-27 03:53:01'),
(2, 13, 5, NULL, NULL, '2021-04-27 03:55:52', '2021-04-27 03:55:52'),
(3, 14, 4, NULL, NULL, '2021-04-27 03:59:27', '2021-04-27 03:59:27'),
(4, 15, 4, NULL, NULL, '2021-04-27 04:02:29', '2021-04-27 04:02:29'),
(5, 16, 6, NULL, NULL, '2021-04-27 04:04:51', '2021-04-27 04:04:51'),
(6, 17, 6, NULL, NULL, '2021-04-27 04:08:00', '2021-04-27 04:08:00'),
(7, 18, 1, NULL, NULL, '2021-04-27 04:32:25', '2021-04-27 04:32:25'),
(8, 19, 1, NULL, NULL, '2021-04-27 04:33:33', '2021-04-27 04:33:33'),
(9, 20, 3, NULL, NULL, '2021-04-27 04:38:54', '2021-04-27 04:38:54'),
(10, 21, 3, NULL, NULL, '2021-04-27 04:40:39', '2021-04-27 04:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `seller_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `org_id` bigint(20) NOT NULL,
  `schedule_online_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`seller_id`, `user_id`, `org_id`, `schedule_online_time`, `seller_description`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 3, 19, '9am-4pm', NULL, NULL, '2021-04-26 16:02:59', '2021-04-27 02:58:30'),
(2, 4, 7, '2pm-7pm', NULL, NULL, '2021-04-26 16:05:12', '2021-04-26 16:05:12'),
(3, 5, 9, 'every tuesday 10am- 4pm', NULL, NULL, '2021-04-26 16:08:05', '2021-04-26 16:08:05'),
(4, 6, 3, 'everyday 6am-2pm', NULL, NULL, '2021-04-26 16:11:19', '2021-04-27 03:00:51'),
(5, 7, 15, '9am-4pm', NULL, NULL, '2021-04-26 16:13:15', '2021-04-27 03:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `seller_banks`
--

CREATE TABLE `seller_banks` (
  `seller_account_id` int(10) UNSIGNED NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_middlename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seller_banks`
--

INSERT INTO `seller_banks` (`seller_account_id`, `seller_id`, `bank_name`, `account_number`, `account_firstname`, `account_middlename`, `account_lastname`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'gcash', '09236587749', 'sheena', 'naldoza', 'delapeña', '2021-04-27 13:33:35', '2021-04-27 13:33:35', NULL),
(2, 2, 'paymaya', '09648598877', 'shane', 'jojo', 'dela cruz', '2021-04-27 13:34:26', '2021-04-27 13:34:26', NULL),
(3, 3, 'gcash', '09898787741', 'zyra', 'borewo', 'santos', '2021-04-27 13:35:03', '2021-04-27 13:35:03', NULL),
(4, 4, 'paymaya', '09365890000', 'mae', 'nazi', 'nacalaban', '2021-04-27 13:35:26', '2021-04-27 13:35:26', NULL),
(5, 5, 'gcash', '09487547744', 'arman', 'melan', 'bagares', '2021-04-27 13:35:53', '2021-04-27 13:35:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `srp`
--

CREATE TABLE `srp` (
  `srp_id` int(10) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `unit_id` bigint(20) NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `srp`
--

INSERT INTO `srp` (`srp_id`, `product_id`, `unit_id`, `product_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 80.00, '2021-04-27 07:40:40', '2021-04-27 07:40:40'),
(2, 2, 1, 70.00, '2021-04-27 07:41:40', '2021-04-27 07:41:40'),
(3, 3, 1, 80.00, '2021-04-27 07:43:26', '2021-04-27 07:43:26'),
(4, 4, 1, 30.00, '2021-04-27 07:45:34', '2021-04-27 07:45:34'),
(5, 5, 1, 60.00, '2021-04-27 07:46:43', '2021-04-27 07:46:43'),
(6, 6, 1, 70.00, '2021-04-27 07:50:16', '2021-04-27 07:50:16'),
(7, 7, 1, 50.00, '2021-04-27 07:51:54', '2021-04-27 07:51:54'),
(8, 8, 1, 30.00, '2021-04-27 07:54:42', '2021-04-27 07:54:42'),
(9, 9, 1, 50.00, '2021-04-27 08:04:44', '2021-04-27 08:04:44'),
(10, 10, 2, 15.00, '2021-04-27 08:08:49', '2021-04-27 08:08:49'),
(11, 11, 1, 180.00, '2021-04-27 08:11:45', '2021-04-27 08:11:45'),
(12, 12, 1, 160.00, '2021-04-27 08:12:40', '2021-04-27 08:12:40'),
(13, 13, 1, 170.00, '2021-04-27 08:13:02', '2021-04-27 08:13:02'),
(14, 14, 1, 20.00, '2021-04-27 08:13:49', '2021-04-27 08:13:49'),
(15, 15, 1, 200.00, '2021-04-27 08:14:24', '2021-04-27 08:14:24'),
(16, 16, 1, 330.00, '2021-04-27 08:17:50', '2021-04-27 08:17:50'),
(17, 17, 1, 225.00, '2021-04-27 08:18:44', '2021-04-27 08:18:44'),
(18, 18, 1, 280.00, '2021-04-27 08:20:27', '2021-04-27 08:20:27'),
(19, 19, 1, 280.00, '2021-04-27 08:21:12', '2021-04-27 08:21:12'),
(20, 20, 1, 190.00, '2021-04-27 08:23:02', '2021-04-27 08:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(10) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `stock_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty_added` int(11) NOT NULL,
  `stock_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `product_id`, `seller_id`, `stock_description`, `qty_added`, `stock_image`, `expiration_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 15, 5, NULL, 10, 'malasugi.1619681377.jpg', '2021-04-29 07:29:37', NULL, '2021-04-27 12:06:12', '2021-04-29 07:29:37'),
(5, 12, 5, NULL, 10, 'Galunggong-1.1619681292.jpg', '2021-04-29 07:28:12', NULL, '2021-04-27 12:08:12', '2021-04-29 07:28:12'),
(6, 1, 4, NULL, 16, 'cabbage.1619680271.jpg', '2021-04-29 07:11:11', NULL, '2021-04-27 12:09:25', '2021-04-29 07:11:11'),
(7, 5, 4, NULL, 16, 'to.1619680333.jpg', '2021-04-29 07:12:13', NULL, '2021-04-27 12:11:45', '2021-04-29 07:12:13'),
(8, 3, 4, NULL, 17, 'pechay.1619680425.jpg', '2021-04-29 07:13:45', NULL, '2021-04-27 12:15:38', '2021-04-29 07:13:45'),
(9, 20, 4, NULL, 16, 'whole_chicken.1619680738.jpg', '2021-04-29 10:34:47', NULL, '2021-04-27 12:18:25', '2021-04-29 10:34:47'),
(10, 17, 4, NULL, 10, 'beef_brisket.1619680917.jpg', '2021-04-29 07:21:57', NULL, '2021-04-27 12:19:20', '2021-04-29 07:21:57'),
(11, 12, 2, NULL, 19, 'bangus.1619678958.jpeg', '2021-04-29 10:31:48', NULL, '2021-04-27 12:21:49', '2021-04-29 10:31:48'),
(12, 9, 2, NULL, 20, 'mango.1619677889.jpg', '2021-04-29 06:31:29', NULL, '2021-04-27 12:22:27', '2021-04-29 06:31:29'),
(13, 20, 2, NULL, 10, 'whole_chicken.1619678793.jpg', '2021-04-29 06:46:42', NULL, '2021-04-27 12:23:43', '2021-04-29 06:46:42'),
(14, 4, 2, NULL, 14, 'chayote.1619678476.jpg', '2021-04-29 06:44:14', NULL, '2021-04-27 12:25:06', '2021-04-29 06:44:14'),
(15, 10, 2, NULL, 19, 'apple.1619678532.jpg', '2021-04-29 06:42:12', NULL, '2021-04-27 12:25:50', '2021-04-29 06:42:12'),
(16, 20, 1, NULL, 16, 'whole_chicken1.1619684664.jpg', '2021-04-29 10:28:46', NULL, '2021-04-27 12:27:01', '2021-04-29 10:28:46'),
(17, 20, 1, NULL, 14, 'whole_chicken.1619677084.jpg', '2021-04-29 10:29:21', NULL, '2021-04-27 12:27:37', '2021-04-29 10:29:21'),
(18, 13, 1, NULL, 14, 'tilapia.1619677132.jpg', '2021-04-29 06:18:53', NULL, '2021-04-27 12:28:42', '2021-04-29 06:18:52'),
(19, 10, 1, NULL, 14, 'apple.1619677173.jpg', '2021-04-29 06:19:42', NULL, '2021-04-27 12:29:17', '2021-04-29 06:19:42'),
(20, 7, 1, NULL, 15, 'banana.1619677232.jpg', '2021-04-30 03:21:38', NULL, '2021-04-27 12:30:20', '2021-04-30 03:21:38'),
(21, 7, 3, NULL, 16, 'banana.1619679328.jpg', '2021-04-29 06:55:28', NULL, '2021-04-27 12:32:21', '2021-04-29 06:55:28'),
(22, 10, 3, NULL, 10, 'apple.1619679375.jpg', '2021-04-29 06:56:15', NULL, '2021-04-27 12:33:05', '2021-04-29 06:56:15'),
(23, 8, 3, NULL, 18, 'papaya.1619679509.jpg', '2021-04-29 06:59:44', NULL, '2021-04-27 12:34:18', '2021-04-29 06:59:44'),
(24, 7, 3, NULL, 20, 'banana1.1619679738.jpg', '2021-04-29 07:02:18', NULL, '2021-04-27 12:36:37', '2021-04-29 07:02:18'),
(25, 10, 3, NULL, 20, 'apple.1619680092.jpg', '2021-04-29 07:08:12', NULL, '2021-04-27 12:37:44', '2021-04-29 07:08:12'),
(29, 1, 5, NULL, 10, 'cabbage1.1619681529.jpg', '2021-04-29 07:32:09', NULL, '2021-04-29 05:41:38', '2021-04-29 07:32:09'),
(30, 5, 5, NULL, 15, 'to.1619675861.jpg', '2021-04-29 05:57:57', NULL, '2021-04-29 05:55:53', '2021-04-29 05:57:57'),
(31, 16, 5, 'steak here', 15, 'steak.1619676359.jpg', '2021-04-29 06:05:59', NULL, '2021-04-29 06:02:25', '2021-04-29 06:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(10) UNSIGNED NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'kg', 'kilogram', NULL, '2021-04-27 14:26:28', '2021-04-27 14:26:28'),
(2, 'pc', 'piece', NULL, '2021-04-27 14:26:28', '2021-04-27 14:26:28'),
(3, 'g', 'gram', NULL, '2021-04-27 14:26:28', '2021-04-27 14:26:28'),
(5, 'sck', 'sack', NULL, '2021-04-27 14:26:28', '2021-04-27 14:26:28'),
(6, 'doz', 'dozen', NULL, '2021-04-27 14:26:28', '2021-04-27 14:26:28'),
(7, 'bdl', 'bundle', NULL, '2021-04-27 14:26:28', '2021-04-27 14:26:28'),
(8, 'tray', 'tray', NULL, '2021-04-27 14:26:28', '2021-04-27 14:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user_image.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_type`, `password`, `f_name`, `l_name`, `m_name`, `mobile_number`, `email`, `user_image`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'superadmin2', 1, '$2y$10$TKX6DEYXVe1fuh22tGJHtOpdyshP/xFyr7gYp9hKG2l1xW1bwuwHW', 'laila', 'mero', 'lasapi', '09215654551', 'mero@gmail.com', 'mero.jpg', NULL, NULL, '2021-04-26 14:16:06', '2021-04-26 14:19:33'),
(2, 'admin1', 1, '$2y$10$A1A87Qg8MaIIlfC4DuPizu0YhAPIBbiKz8oIq6FJD6zQs.v0ID.Oe', 'jojo', 'lala', 'nana', '09121410032', 'admin1@gmail.com', 'user_image.png', NULL, NULL, '2021-04-26 14:22:38', '2021-04-26 14:22:38'),
(3, 'qwerty123', 2, '$2y$10$RZhONWjyO.ZzLww5Dp4lx.5Vs9g5eCH7GbH/zvmzgJP.A7.e3GYpC', 'sheena', 'dela peña', 'naldoza', '09236587749', 'haha45@gmail.com', 'Scarlett-Johansson-Smile-Sexy-Celebrity-ipad-air-wallpaper-ilikewallpaper_com.1619606393.jpg', NULL, NULL, '2021-04-26 16:02:59', '2021-04-28 10:49:18'),
(4, 'asdf456', 2, '$2y$10$q9u7PZ3vVvbgwKu6seODuOkotpdT3sg55dWDCluNecJLdWjVQ55u2', 'shane', 'dela cruz', 'jojo', '09648598877', 'agfa@gmail.com', 'user_image.png', NULL, NULL, '2021-04-26 16:05:11', '2021-04-27 02:57:11'),
(5, 'zxcv789', 2, '$2y$10$lfUSGOgCSZJOad/aJ9gU5OlpQxUpMlLqyXLY9bWc7NKu5yp28lw9W', 'zyra', 'santos', 'merena', '09898787741', 'zxcv9000@gmail.com', 'ca5a838813b0f3a4121cf29f4a4858b1.1619605841.jpg', NULL, NULL, '2021-04-26 16:08:05', '2021-04-28 10:52:12'),
(6, 'android17', 2, '$2y$10$wyUmODii7XsuxXjuTCP.m.Dq6VcyyFgFpDnhqxOv2pSm9gWu16S4G', 'mae', 'nacalaban', 'nazi', '09365890000', 'maenazi@gmail.com', 'Sexiest-Female-Celebrity-Selfies-2019.1619607479.jpg', NULL, NULL, '2021-04-26 16:11:19', '2021-04-28 10:57:59'),
(7, 'lumbia23', 2, '$2y$10$BMGIYTv0JwcgP7qG6Tvm2O2sw3cOGwNyV5DPfAdIJ/1issoKvkAky', 'arman', 'bagares', 'melan', '09487547744', 'lumbia23@gmail.com', 'user_image.png', NULL, NULL, '2021-04-26 16:13:15', '2021-04-27 03:01:45'),
(8, 'superadmin1', 1, '$2y$10$.3AobITzQeS8Wx8oCBEcJeT079I4n6e9jB1IXQV2CUGaLsUUOMXN.', 'nila', 'merena', 'agusan', '09214474551', 'agusan@gmail.com', 'agusan.jpg', NULL, NULL, '2021-04-27 00:27:13', '2021-04-27 00:27:13'),
(9, 'admin2', 1, '$2y$10$figV5Gk1W27fSarG/k6s5e2Qb9glzdW1VlSi9PIaOFsH5qvBILpNe', 'jackie', 'chan', 'gold', '09214574410', 'jackie_chan@gmail.com', 'chan.png', NULL, NULL, '2021-04-27 00:34:23', '2021-04-29 01:01:15'),
(10, 'admin3', 1, '$2y$10$8nVC8AAbWqCdpUj.lKjcQekxxFKCa0mwbXcW/qV0ORX4OeN8og7jO', 'nelly', 'petal', 'roro', '09354548859', 'nellypetal@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 00:37:21', '2021-04-27 00:37:21'),
(12, 'gero123', 3, '$2y$10$UVV7peikFs1vN19Vm6tmNOmSpygqm.LwQVLeqg3M6COqvTERSXXmy', 'gero', 'cabs', 'doms', '09999878451', 'gero@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 03:53:01', '2021-04-27 03:53:01'),
(13, 'harold789', 3, '$2y$10$GgHhuTMzpBYSKnROr30kOu7zc4IueaUnbXhiZzENA4kSY7Tu.WLm2', 'harold', 'salid', 'wera', '09124541111', 'agfaf@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 03:55:52', '2021-04-27 03:55:52'),
(14, 'ginax5', 3, '$2y$10$zLjmEvW.ytdXKCuh0Yg6O.5FS./mCgNJ3xonbZTKeg4t2YfyQ05iK', 'gina', 'nuñez', 'caro', '09124414125', 'gina@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 03:59:26', '2021-04-27 03:59:26'),
(15, 'saitama76', 3, '$2y$10$V/7M0gOcM97.MevMugmNxOf87I.hcrpL9vviPfA7pLrfqohgD3j4a', 'noreen', 'larede', 'rico', '09356585545', 'saitama76@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 04:02:29', '2021-04-27 04:02:29'),
(16, 'rider5', 3, '$2y$10$trbXkb9RejCGaCphwXNo9OGFNtEbUwsdosvyq0Gx3Y4D3LwxUJzAi', 'meca', 'lorong', 'sauda', '09142541111', 'rider5@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 04:04:51', '2021-04-27 04:04:51'),
(17, 'popo452', 3, '$2y$10$xThmS61eQCSWFCl2796fqupbwWPkCuuMq.EQJWdgpScS5poQROPTe', 'allan', 'amper', 'rivera', '09894574511', 'amperpatatas@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 04:08:00', '2021-04-27 04:08:00'),
(18, 'cess32', 3, '$2y$10$.hj/TF5AHdN2TzxndFdMLO4XsUuSNYEQtGVU4QOTUIhNi0V8uUmYi', 'cess', 'toral', 'natil', '09995225555', 'cess32@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 04:32:24', '2021-04-27 04:32:24'),
(19, 'gogo5134', 3, '$2y$10$2S.vXcX2OaSShzpZIGsPo.TV5e41L/jXAsoeL8XhMLKWjvjQ/XOFy', 'gogo', 'listo', 'nanang', '09325474100', 'gogo@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 04:33:33', '2021-04-27 04:33:33'),
(20, 'yoyo432', 3, '$2y$10$KhgLRyyZMpOpD8uZfo9.euNvGMXDOnhJlpho85uRdmwKZSWjzwdN.', 'yoyo', 'neri', 'gumba', '09998747410', 'yoyo@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 04:38:54', '2021-04-27 04:38:54'),
(21, 'bryan89', 3, '$2y$10$yP1XDNQZpu4P16RE8QfNxuvz/k1lH22THGioZCI.PpBfGS3kHS7Om', 'bryan', 'ortiz', 'loro', '09351412200', 'bryan89@gmail.com', 'b.1619615082.jpg', NULL, NULL, '2021-04-27 04:40:38', '2021-04-28 13:04:43'),
(22, 'joshua43', 4, '$2y$10$ZkDrBGDRj0coLRqESu7UGeUjQruqGRR164l7VMsrZUl2aFtovTTaG', 'joshua', 'sabalo', 'halili', '09454441111', 'joshua43@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 04:52:41', '2021-04-27 04:52:41'),
(23, 'joniel654', 4, '$2y$10$HB7pYr1hP5hLatyr/Kav2uw/UygjVcYPNzTexVBPff6pGEG1KIwmq', 'joniel', 'ladders', 'rico', '09487414000', 'joniel654@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 04:55:22', '2021-04-27 04:55:22'),
(24, 'iandroe78', 4, '$2y$10$yzQJWtT3f7lYCQiNeNfnoOv7UngC/EYnD8e7Nz/L23N3kTUOKOb4C', 'iandroe', 'abaday', 'manreal', '09658736985', 'iandroe78@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 04:58:48', '2021-04-27 04:58:48'),
(25, 'liam234', 4, '$2y$10$UVaUPH.SD9YgkxH7B3E0S.CVkWAxujw0hsQNapJQ45yYqc7vJvp5W', 'liam', 'fabelski', 'mondragon', '09685221400', 'liam234@gmail.com', 'user_image.png', NULL, NULL, '2021-04-27 05:05:30', '2021-04-27 05:05:30'),
(26, 'rudy98', 4, '$2y$10$eptgxKwTFXpsfZYju4sX8OiLKJ/mIC8VVHd5T.EEaA72pBxUn7kXa', 'rudy', 'sogano', 'morma', '09884145539', 'rudy98@gmail.com', 'j.1619612389.jpg', NULL, NULL, '2021-04-27 05:09:54', '2021-04-28 12:19:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_types`
--
ALTER TABLE `admin_types`
  ADD PRIMARY KEY (`admin_type_id`);

--
-- Indexes for table `brgys`
--
ALTER TABLE `brgys`
  ADD PRIMARY KEY (`brgy_id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`buyer_id`);

--
-- Indexes for table `buyer_mailing`
--
ALTER TABLE `buyer_mailing`
  ADD PRIMARY KEY (`buyer_mailing_id`);

--
-- Indexes for table `customer_services`
--
ALTER TABLE `customer_services`
  ADD PRIMARY KEY (`customer_service_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`inbox_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orderlines`
--
ALTER TABLE `orderlines`
  ADD PRIMARY KEY (`orderline_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orgs`
--
ALTER TABLE `orgs`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`reason_id`);

--
-- Indexes for table `return_orders`
--
ALTER TABLE `return_orders`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `riders`
--
ALTER TABLE `riders`
  ADD PRIMARY KEY (`rider_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `seller_banks`
--
ALTER TABLE `seller_banks`
  ADD PRIMARY KEY (`seller_account_id`);

--
-- Indexes for table `srp`
--
ALTER TABLE `srp`
  ADD PRIMARY KEY (`srp_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_mobile_number_unique` (`mobile_number`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_types`
--
ALTER TABLE `admin_types`
  MODIFY `admin_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brgys`
--
ALTER TABLE `brgys`
  MODIFY `brgy_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `buyer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `buyer_mailing`
--
ALTER TABLE `buyer_mailing`
  MODIFY `buyer_mailing_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_services`
--
ALTER TABLE `customer_services`
  MODIFY `customer_service_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `fee_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `inbox_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orderlines`
--
ALTER TABLE `orderlines`
  MODIFY `orderline_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orgs`
--
ALTER TABLE `orgs`
  MODIFY `org_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `price_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `product_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `reason_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `return_orders`
--
ALTER TABLE `return_orders`
  MODIFY `return_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `rider_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seller_banks`
--
ALTER TABLE `seller_banks`
  MODIFY `seller_account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `srp`
--
ALTER TABLE `srp`
  MODIFY `srp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
