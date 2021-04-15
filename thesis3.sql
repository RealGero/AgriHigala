-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2021 at 11:35 AM
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
(1, 'Balulang', '2021-04-08 12:59:48', '2021-04-08 15:25:22'),
(2, 'Carmen', '2021-04-08 12:59:48', '2021-04-08 12:59:48'),
(3, 'Lumbia', '2021-04-08 12:59:48', '2021-04-08 12:59:48');

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
  `verified_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cod`
--

CREATE TABLE `cod` (
  `cod_id` int(10) UNSIGNED NOT NULL,
  `payment_id` bigint(20) NOT NULL,
  `brgy_id` bigint(20) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gcash`
--

CREATE TABLE `gcash` (
  `gcash_id` int(10) UNSIGNED NOT NULL,
  `payment_id` bigint(20) NOT NULL,
  `acc_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_expire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(10, '2021_02_22_081907_create_cod_table', 1),
(11, '2021_02_22_082100_create_gcash_table', 1),
(12, '2021_02_22_082225_create_orders_table', 1),
(13, '2021_02_22_082433_create_messages_table', 1),
(14, '2021_02_22_082851_create_product_types_table', 1),
(15, '2021_02_22_082959_create_products_table', 1),
(16, '2021_02_22_083127_create_stocks_table', 1),
(17, '2021_02_22_083309_create_orderlines_table', 1),
(18, '2021_02_22_083554_create_ratings_table', 1),
(19, '2021_02_22_083750_create_reasons_table', 1),
(20, '2021_02_22_083852_create_return_orders_table', 1),
(21, '2021_02_22_084011_create_srp_table', 1),
(22, '2021_02_22_084156_create_prices_table', 1),
(23, '2021_02_22_084330_create_feedbacks_table', 1),
(24, '2021_03_24_034143_create_units_table', 1),
(25, '2021_03_24_034403_create_brgys_table', 1),
(26, '2021_03_24_034441_create_orgs_table', 1),
(27, '2021_04_11_134718_add_deleted_at_column_to_products', 1),
(28, '2021_04_11_134801_add_deleted_at_column_to_stocks', 1),
(29, '2021_04_11_134816_add_deleted_at_column_to_units', 1),
(30, '2021_04_11_134827_add_deleted_at_column_to_users', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `payment_id` bigint(20) NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `rider_id` bigint(20) NOT NULL,
  `packed_at` date NOT NULL,
  `received_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 1, 'Nakuku', 'skemberdo', '2021-04-08 13:16:20', '2021-04-08 13:16:20'),
(2, 2, 'Nakaka', 'bombarde', '2021-04-08 13:16:20', '2021-04-08 13:16:20'),
(3, 1, 'lalala', 'bombard', '2021-04-08 13:16:20', '2021-04-08 13:16:20');

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
  `payment_method` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `price_id` int(10) UNSIGNED NOT NULL,
  `stock_id` bigint(20) NOT NULL,
  `unit_id` bigint(20) NOT NULL,
  `stock_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`price_id`, `stock_id`, `unit_id`, `stock_price`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 123.00, '2021-04-09 05:00:07', '2021-04-09 05:00:07'),
(2, 4, 2, 1234.00, '2021-04-09 07:11:49', '2021-04-09 07:11:49'),
(3, 5, 4, 123456.00, '2021-04-09 07:12:43', '2021-04-09 07:12:43'),
(4, 3, 1, 12345.00, '2021-04-10 04:45:10', '2021-04-10 04:45:10'),
(5, 4, 2, 13456.00, '2021-04-10 06:53:34', '2021-04-10 06:53:34'),
(6, 5, 1, 123.00, '2021-04-10 17:52:31', '2021-04-10 17:52:31'),
(7, 6, 2, 213123.00, '2021-04-10 21:19:01', '2021-04-10 21:19:01'),
(8, 7, 1, 200.00, '2021-04-10 21:22:12', '2021-04-12 22:54:37'),
(9, 8, 1, 1995.00, '2021-04-10 22:21:12', '2021-04-10 22:21:12'),
(10, 9, 1, 1997.00, '2021-04-12 04:46:56', '2021-04-12 04:46:56'),
(11, 10, 1, 333.00, '2021-04-14 01:05:25', '2021-04-14 01:05:25'),
(12, 12, 1, 12345.00, '2021-04-14 18:03:46', '2021-04-14 18:03:46'),
(13, 15, 1, 123.00, '2021-04-14 18:25:29', '2021-04-14 18:25:29'),
(14, 16, 3, 666.00, '2021-04-14 19:29:40', '2021-04-14 19:29:40'),
(15, 17, 1, 888.00, '2021-04-14 19:36:27', '2021-04-14 19:36:27'),
(16, 18, 1, 666.00, '2021-04-14 19:37:49', '2021-04-14 19:37:49'),
(17, 19, 2, 777.00, '2021-04-14 19:49:57', '2021-04-14 19:49:57'),
(18, 20, 5, 111.00, '2021-04-14 19:57:30', '2021-04-14 19:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_type_id` bigint(20) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `best_before_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_type_id`, `product_name`, `product_description`, `best_before_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 'Galongong', 'Good Galongong', '2015-12-17', '2021-04-08 23:55:20', '2021-04-11 06:10:47', '2021-04-11 06:10:47'),
(3, 1, 'Karpa', 'Good Karpa', '2015-12-17', '2021-04-08 23:55:20', '2021-04-14 17:56:31', '2021-04-14 17:56:31'),
(4, 2, 'Chicken', 'Good Chicken', '2015-12-17', '2021-04-08 23:55:20', '2021-04-11 06:15:20', '2021-04-11 06:15:20'),
(5, 2, 'Pork', 'Good pork', '2015-12-17', '2021-04-08 23:55:20', '2021-04-08 23:55:20', NULL),
(6, 2, 'Beef', 'Good Beef', '2015-12-17', '2021-04-08 23:55:20', '2021-04-08 23:55:20', NULL),
(7, 3, 'Kalamunggay', 'Good Kalamunggay', '2015-12-17', '2021-04-08 23:55:20', '2021-04-08 23:55:20', NULL),
(8, 3, 'Pechay', 'Good Pechay', '2015-12-17', '2021-04-08 23:55:20', '2021-04-08 23:55:20', NULL),
(9, 3, 'Sitaw', 'Good Sitaw', '2015-12-17', '2021-04-08 23:55:20', '2021-04-11 15:34:01', '2021-04-11 15:34:01'),
(10, 4, 'Apple', 'Good Apple', '2015-12-17', '2021-04-08 23:55:20', '2021-04-08 23:55:20', NULL),
(11, 4, 'Orange', 'Good Orange', '2015-12-17', '2021-04-08 23:55:20', '2021-04-08 23:55:20', NULL),
(12, 4, 'Mango', 'Good Mango', '2015-12-17', '2021-04-08 23:55:20', '2021-04-11 15:35:33', '2021-04-11 15:35:33'),
(13, 2, 'Kabaw', 'Good Kabaw', '0000-00-00', '2021-04-08 23:55:20', '2021-04-08 23:55:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `product_type_id` int(10) UNSIGNED NOT NULL,
  `product_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_type_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_product_image.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`product_type_id`, `product_type_name`, `product_type_description`, `product_image`, `created_at`, `updated_at`) VALUES
(1, 'fish', 'fresh fish', 'default_product_image.jpg', '2021-04-08 23:36:52', '2021-04-08 23:36:52'),
(2, 'meat', 'fresh meat', 'default_product_image.jpg', '2021-04-08 23:36:52', '2021-04-08 23:36:52'),
(3, 'vegetable', 'fresh vegetable', 'default_product_image.jpg', '2021-04-08 23:36:52', '2021-04-08 23:36:52'),
(4, 'fruit', 'fresh fruit', 'default_product_image.jpg', '2021-04-08 23:36:52', '2021-04-08 23:36:52');

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

-- --------------------------------------------------------

--
-- Table structure for table `return_orders`
--

CREATE TABLE `return_orders` (
  `return_id` int(10) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `reason_id` bigint(20) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `rider_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `rider_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`rider_id`, `user_id`, `seller_id`, `rider_description`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 8, 1, NULL, NULL, '2021-04-10 05:14:27', '2021-04-10 05:14:27'),
(2, 10, 1, NULL, NULL, '2021-04-10 05:32:24', '2021-04-10 05:32:24'),
(3, 11, 1, NULL, NULL, '2021-04-10 06:10:13', '2021-04-10 06:10:13');

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
  `verified_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`seller_id`, `user_id`, `org_id`, `schedule_online_time`, `seller_description`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'everyday asdasd', 'asdasdasdasdasdasd', NULL, '2021-04-08 15:16:53', '2021-04-08 15:16:53'),
(2, 4, 2, 'everyday asdasd', 'asdasdasdasdasdasd', NULL, '2021-04-08 15:18:11', '2021-04-08 15:18:11');

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
(1, 1, 1, 360.00, '2021-04-09 10:15:23', '2021-04-09 10:15:23'),
(2, 2, 1, 350.00, '2021-04-09 10:15:23', '2021-04-09 10:15:23'),
(3, 3, 2, 100.00, '2021-04-09 10:15:23', '2021-04-09 10:15:23'),
(4, 9, 1, 120.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  `expiration_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `product_id`, `seller_id`, `stock_description`, `qty_added`, `stock_image`, `expiration_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'sdasdasd', 2, 'lansones.1618058610.jpg', '2021-04-23', '2021-04-10 04:43:30', '2021-04-10 04:43:30', NULL),
(2, 1, 1, 'sdasdasd', 2, 'lansones.1618058658.jpg', '2021-04-23', '2021-04-10 04:44:19', '2021-04-10 04:44:19', NULL),
(3, 1, 1, 'sdasdasd', 2, 'lansones.1618058710.jpg', '2021-04-23', '2021-04-10 04:45:10', '2021-04-10 04:45:10', NULL),
(4, 2, 4, NULL, 3, NULL, '2021-04-17', '2021-04-10 06:53:33', '2021-04-10 06:53:33', NULL),
(5, 9, 4, NULL, 3, 'sitaw.1618105951.jpg', '2021-04-22', '2021-04-10 17:52:31', '2021-04-10 17:52:31', NULL),
(6, 1, 2, NULL, 4, NULL, '2021-04-15', '2021-04-10 21:19:01', '2021-04-10 21:19:01', NULL),
(7, 3, 2, 'Good Karpa', 4, 'sitaw.1618296504.jpg', '2021-04-15', '2021-04-10 21:22:12', '2021-04-12 22:48:24', NULL),
(8, 2, 2, NULL, 3, 'sitaw.1618475807.jpg', '2021-04-29', '2021-04-10 22:21:12', '2021-04-15 00:36:47', NULL),
(9, 3, 1, 'Good Karpa', 3, NULL, '2021-04-15', '2021-04-12 04:46:56', '2021-04-12 04:46:56', NULL),
(10, 2, 2, 'afasfasd', 3, NULL, '2021-04-23', '2021-04-14 01:05:24', '2021-04-14 01:05:24', NULL),
(11, 2, 2, 'asdafasd', 4, NULL, '2021-05-06', '2021-04-14 17:58:48', '2021-04-14 17:58:48', NULL),
(12, 2, 2, 'asdasd', 2, NULL, '2021-04-22', '2021-04-14 18:03:46', '2021-04-14 18:03:46', NULL),
(13, 2, 2, 'ggasdasdasd', 2, NULL, '2021-04-29', '2021-04-14 18:10:28', '2021-04-14 18:10:28', NULL),
(14, 2, 2, 'ggasdasdasd', 2, NULL, '2021-04-29', '2021-04-14 18:17:08', '2021-04-14 18:17:08', NULL),
(15, 2, 2, 'fasdasdasdasd', 3, NULL, '2021-04-20', '2021-04-14 18:25:29', '2021-04-14 18:25:29', NULL),
(16, 9, 2, 'sadsd', 1, NULL, '2021-04-30', '2021-04-14 19:29:39', '2021-04-14 19:29:39', NULL),
(17, 2, 2, 'gero', 2, NULL, '2021-04-21', '2021-04-14 19:36:26', '2021-04-14 19:36:26', NULL),
(18, 3, 2, 'gero', 2, NULL, '2021-04-23', '2021-04-14 19:37:49', '2021-04-14 19:37:49', NULL),
(19, 3, 2, 'gero', 1, NULL, '2021-04-23', '2021-04-14 19:49:57', '2021-04-14 19:49:57', NULL),
(20, 2, 2, 'baang', 1, NULL, '2021-04-29', '2021-04-14 19:57:30', '2021-04-14 19:57:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(10) UNSIGNED NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_decription` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_decription`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'kl', 'kilogram', '2021-04-09 05:43:27', '2021-04-09 05:43:27', NULL),
(2, 'pc', 'pieces', '2021-04-09 05:43:27', '2021-04-09 05:43:27', NULL),
(3, 'tray', 'tray', '2021-04-09 05:43:27', '2021-04-09 05:43:27', NULL),
(4, 'doz', 'dozen', '2021-04-09 05:43:27', '2021-04-09 05:43:27', NULL),
(5, 'g', 'grams', '2021-04-09 05:43:27', '2021-04-09 05:43:27', NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_type`, `password`, `f_name`, `l_name`, `m_name`, `mobile_number`, `email`, `user_image`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'gero123', 2, '$2y$10$GvQS6aJEPpOcr/NPOGb3H.L9olx1NFADbqcz8drMMdxtfRPISioKa', 'asdasd', 'asdasds', 'asdasdd', '12345678911', 'gero123@gmail.com', 'user_image.png', NULL, '2021-04-08 15:16:53', '2021-04-08 15:16:53', NULL),
(4, 'gero12345', 2, '$2y$10$z9ArFNnPWz2h7jGxzOl2V.flfvkM8sLszKBVQNTMTODyU.CsTRBJS', 'asdasd', 'asdasds', 'asdasdd', '12345678900', 'gero12345@gmail.com', 'user_image.png', NULL, '2021-04-08 15:18:10', '2021-04-08 15:18:10', NULL),
(6, 'japhetduapa', 3, '$2y$10$ZDtGvMIs2pvxq6vNO6N8rewy/9AgnSSqba3JYF7VyF2mDCq7Fu/Z6', 'japhet', 'duapa', 'rico', '12345678912', NULL, 'user_image.png', NULL, '2021-04-10 05:12:29', '2021-04-10 05:12:29', NULL),
(8, 'duaparico', 3, '$2y$10$exjhguAai4JupLInDFo8YOhsba1FuWnbRaHrAL.WSUmRiBIFrBE8.', 'duapa', 'rico', 'japhet', '12354678913', NULL, 'user_image.png', NULL, '2021-04-10 05:14:27', '2021-04-10 05:14:27', NULL),
(10, 'roromsroroms', 3, '$2y$10$GkCopGqjtRqkfjzMZrVTE./7IMyCXbHHRu8BY1UsGeNzPUGmr/me6', 'roroms', 'roroms', 'roroms', '12345678914', NULL, 'user_image.png', NULL, '2021-04-10 05:32:24', '2021-04-10 05:32:24', NULL),
(11, 'Gerald YvanCabarrubias', 3, '$2y$10$BYihS0nUPXj.bBzbzUnT4.tuGVP2d4WLEKTW9dn3fEdPeSXI907Uu', 'Gerald Yvan', 'Cabarrubias', 'Domo', '12345678921', NULL, 'user_image.png', NULL, '2021-04-10 06:10:13', '2021-04-10 06:10:13', NULL);

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
-- Indexes for table `cod`
--
ALTER TABLE `cod`
  ADD PRIMARY KEY (`cod_id`);

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
-- Indexes for table `gcash`
--
ALTER TABLE `gcash`
  ADD PRIMARY KEY (`gcash_id`);

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
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_types`
--
ALTER TABLE `admin_types`
  MODIFY `admin_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brgys`
--
ALTER TABLE `brgys`
  MODIFY `brgy_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `buyer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cod`
--
ALTER TABLE `cod`
  MODIFY `cod_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gcash`
--
ALTER TABLE `gcash`
  MODIFY `gcash_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orderlines`
--
ALTER TABLE `orderlines`
  MODIFY `orderline_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orgs`
--
ALTER TABLE `orgs`
  MODIFY `org_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `price_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `reason_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_orders`
--
ALTER TABLE `return_orders`
  MODIFY `return_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `rider_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `srp`
--
ALTER TABLE `srp`
  MODIFY `srp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
