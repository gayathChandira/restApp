-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2019 at 07:14 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `dish_id` int(11) NOT NULL,
  `dish_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `dish_id`, `dish_name`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chicken Fried Rice', 1, 350, '2019-01-04 13:07:18', '2019-01-04 13:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `bill_paids`
--

CREATE TABLE `bill_paids` (
  `id` int(10) UNSIGNED NOT NULL,
  `dish_id` int(11) NOT NULL,
  `dish_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_paids`
--

INSERT INTO `bill_paids` (`id`, `dish_id`, `dish_name`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, 'Vege Rice', 1, 200, '2018-12-14 01:05:07', '2018-12-23 01:05:07'),
(2, 1, 'Chicken Fried Rice', 1, 350, '2018-11-23 01:05:08', '2018-12-23 01:05:08'),
(3, 1, 'Chicken Fried Rice', 5, 1750, '2018-12-23 06:13:10', '2018-12-23 06:13:10'),
(4, 2, 'Vege Rice', 1, 200, '2018-12-27 22:09:50', '2018-12-27 22:09:50'),
(5, 1, 'Chicken Fried Rice', 1, 350, '2018-12-27 23:36:46', '2018-12-27 23:36:46'),
(6, 2, 'Vege Rice', 1, 200, '2018-12-27 23:36:46', '2018-12-27 23:36:46'),
(7, 1, 'Chicken Fried Rice', 2, 700, '2018-12-27 23:44:02', '2018-12-27 23:44:02');

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `id` int(10) UNSIGNED NOT NULL,
  `dish_id` int(11) NOT NULL,
  `dish_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`id`, `dish_id`, `dish_name`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chicken Fried Rice', 350, '2018-12-22 09:21:57', '2018-12-22 09:21:57'),
(2, 2, 'Vege Rice', 200, '2018-12-22 09:22:25', '2018-12-22 09:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `lname`, `age`, `email`, `contact`, `created_at`, `updated_at`) VALUES
(22, 'Luella', 'Bogisich', 60, 'prutherford@example.org', '763335030', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(23, 'Rosendo', 'Lind', 41, 'robel.cathryn@example.com', '715401784', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(24, 'Manuel', 'Rath', 57, 'lwitting@example.org', '783080022', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(25, 'Reta', 'Rohan', 63, 'leffler.holly@example.com', '744295796', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(26, 'Fernando', 'Powlowski', 50, 'scole@example.org', '719230376', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(27, 'Onie', 'Rice', 20, 'kole71@example.org', '771779160', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(28, 'Katherine', 'Stiedemann', 28, 'johan.fisher@example.com', '0770766183', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(29, 'Enola', 'Becker', 36, 'fern00@example.org', '736022783', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(30, 'Pauline', 'Jakubowski', 64, 'stracke.lenny@example.com', '749900241', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(31, 'Bernadine', 'D\'Amore', 30, 'hand.rafaela@example.com', '726646193', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(32, 'Darien', 'Berge', 63, 'hayden80@example.net', '777009970', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(33, 'Sidney', 'Dietrich', 51, 'freda.dietrich@example.com', '710159765', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(34, 'Diamond', 'Wilkinson', 26, 'bethel.bartoletti@example.net', '762446597', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(35, 'Vance', 'Huels', 45, 'jbergnaum@example.com', '712299842', '2018-12-21 20:54:36', '2018-12-21 20:54:36'),
(36, 'Martin', 'Hintz', 54, 'rigoberto.dicki@example.com', '754720402', '2018-12-21 20:54:37', '2018-12-21 20:54:37'),
(37, 'Loraine', 'Conn', 45, 'nyasia64@example.net', '762558110', '2018-12-21 20:54:37', '2018-12-21 20:54:37'),
(38, 'Eileen', 'Torp', 31, 'prohaska.jonas@example.org', '725802493', '2018-12-21 20:54:37', '2018-12-21 20:54:37'),
(39, 'Victor', 'Hill', 22, 'wjohnson@example.com', '771470822', '2018-12-21 20:54:37', '2018-12-21 20:54:37'),
(40, 'Hunter', 'Wiegand', 46, 'schmidt.madelynn@example.net', '725591306', '2018-12-21 20:54:37', '2018-12-21 20:54:37');

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `itemName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` int(11) DEFAULT NULL,
  `limit` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `vendor_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `itemName`, `quantity`, `unit`, `unit_price`, `limit`, `Total`, `vendor_id`, `created_at`, `updated_at`) VALUES
(1, 'Rice Basmathi', 4870, 'kg', 125, 500, 0, ' 1 2', '2018-11-26 09:00:27', '2019-01-08 11:00:20'),
(2, 'Soya meat', -6361, 'kg', 34, 100, 0, ' 1 2', '2018-11-26 09:03:26', '2019-01-08 11:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `food_item_quantities`
--

CREATE TABLE `food_item_quantities` (
  `id` int(10) UNSIGNED NOT NULL,
  `itemName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_item_quantities`
--

INSERT INTO `food_item_quantities` (`id`, `itemName`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'Rice Basmathi', 1000, '2018-11-26 09:08:09', '2018-11-26 09:08:09'),
(2, 'soya meat', 340, '2018-10-26 09:08:45', '2018-11-26 09:08:45'),
(3, 'Rice Basmathi', 500, '2018-11-26 09:16:56', '2018-11-26 09:16:56'),
(4, 'Rice Basmathi', 400, '2018-11-26 09:18:07', '2018-11-26 09:18:07'),
(5, 'Rice Basmathi', 378, '2018-11-26 09:26:38', '2018-11-26 09:26:38'),
(6, 'soya meat', -2993, '2018-11-01 11:25:24', '2018-11-26 11:25:24'),
(7, 'soya meat', -6326, '2018-11-08 11:29:57', '2018-11-26 11:29:57'),
(8, 'soya meat', -6359, '2018-11-26 11:29:57', '2018-11-26 11:29:57'),
(9, 'Rice Basmathi', 4878, '2018-11-27 09:05:51', '2018-11-27 09:05:51'),
(10, 'Soya meat', -6360, '2019-01-08 11:00:14', '2019-01-08 11:00:14'),
(11, 'Rice Basmathi', 4874, '2019-01-08 11:00:14', '2019-01-08 11:00:14'),
(12, 'Soya meat', -6361, '2019-01-08 11:00:20', '2019-01-08 11:00:20'),
(13, 'Rice Basmathi', 4870, '2019-01-08 11:00:21', '2019-01-08 11:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `food_item_update`
--

CREATE TABLE `food_item_update` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `vendor_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_item_update`
--

INSERT INTO `food_item_update` (`id`, `item_id`, `quantity`, `vendor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1000, 'dfdfd', '2018-11-26 09:08:09', '2018-11-26 09:08:09'),
(2, 2, 340, 'bbb', '2018-11-26 09:08:45', '2018-11-26 09:08:45'),
(3, 1, 4500, 'dfadf', '2018-11-27 09:05:51', '2018-11-27 09:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `issue_fd_temps`
--

CREATE TABLE `issue_fd_temps` (
  `id` int(10) UNSIGNED NOT NULL,
  `food_item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_fd_temps`
--

INSERT INTO `issue_fd_temps` (`id`, `food_item`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'Soya meat', 1, '2019-01-08 11:00:02', '2019-01-08 11:00:02'),
(2, 'Rice Basmathi', 4, '2019-01-08 11:00:10', '2019-01-08 11:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `issue_food_items`
--

CREATE TABLE `issue_food_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `food_item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_food_items`
--

INSERT INTO `issue_food_items` (`id`, `food_item`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'Rice Basmathi', 500, '2018-11-26 09:16:56', '2018-11-26 09:16:56'),
(2, 'Rice Basmathi', 100, '2018-11-26 09:18:07', '2018-11-26 09:18:07'),
(3, 'Rice Basmathi', 22, '2018-11-26 09:26:38', '2018-11-26 09:26:38'),
(4, 'soya meat', 3333, '2018-11-26 11:25:24', '2018-11-26 11:25:24'),
(5, 'soya meat', 3333, '2018-11-26 11:29:57', '2018-11-26 11:29:57'),
(6, 'soya meat', 33, '2018-12-30 11:29:57', '2018-11-26 11:29:57'),
(7, 'Soya meat', 1, '2019-01-08 11:00:13', '2019-01-08 11:00:13'),
(8, 'Rice Basmathi', 4, '2019-01-08 11:00:14', '2019-01-08 11:00:14'),
(9, 'Soya meat', 1, '2019-01-08 11:00:20', '2019-01-08 11:00:20'),
(10, 'Rice Basmathi', 4, '2019-01-08 11:00:20', '2019-01-08 11:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_09_18_075916_create_roles_table', 1),
(4, '2018_09_18_080917_create_user_roles_table', 1),
(5, '2018_09_24_172038_create_vendors_table', 1),
(6, '2018_10_28_122857_create_employees_table', 1),
(7, '2018_11_01_120847_create_dishes_table', 1),
(8, '2018_11_01_145939_create_bills_table', 1),
(9, '2018_11_03_062758_create_bill_paids_table', 1),
(10, '2018_11_20_031712_create_issue_food_items_table', 1),
(11, '2018_11_20_032805_create_issue_fd_temps_table', 1),
(12, '2018_11_20_104249_create_food_item_quantities_table', 1),
(13, '2018_11_22_032429_create_food_items_table', 1),
(14, '2018_11_26_135002_create_notifications_table', 1),
(15, '2018_11_26_135543_food_item_update', 1),
(16, '2018_11_26_142011_recipes', 1),
(17, '2019_01_01_162907_create_pay_vendors_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `to`, `from`, `data`, `read`, `created_at`, `updated_at`) VALUES
(1, 'Accountant', 'Inventory Manager', 'Rice Basmathi has fall behind its limit', 1, '2018-11-26 09:18:07', '2018-11-30 11:19:08'),
(2, 'Accountant', 'Inventory Manager', 'Rice Basmathi has fall behind its limit', 1, '2018-11-26 09:26:38', '2018-12-31 22:19:34'),
(3, 'Accountant', 'Inventory Manager', 'soya meat has fall behind its limit', 1, '2018-11-26 11:25:24', '2018-11-30 11:18:58'),
(4, 'Accountant', 'Inventory Manager', 'soya meat has fall behind its limit', 1, '2018-11-26 11:29:57', '2018-12-31 22:19:55'),
(5, 'Accountant', 'Inventory Manager', 'soya meat has fall behind its limit', 1, '2018-11-26 11:29:57', '2018-11-30 11:19:15'),
(6, 'Inventory Manager', 'Accountant', 'Update Rice Basmathi to the Inventory', 1, '2019-01-01 20:57:19', '2019-01-08 23:24:20'),
(7, 'Inventory Manager', 'Accountant', 'Update Rice Basmathi to the Inventory', 0, '2019-01-01 23:48:38', '2019-01-01 23:48:38'),
(8, 'Inventory Manager', 'Accountant', 'Update soya meat to the Inventory', 0, '2019-01-01 23:48:38', '2019-01-01 23:48:38'),
(9, 'Inventory Manager', 'Accountant', 'Update Rice Basmathi to the Inventory', 1, '2019-01-06 11:45:48', '2019-01-08 23:24:49'),
(10, 'Admin', 'Accountant', 'Update Rice Basmathi to the Inventory', 0, '2019-01-06 11:45:48', '2019-01-06 11:45:48'),
(11, 'Inventory Manager', 'Accountant', 'Update Rice Basmathi to the Inventory', 0, '2019-01-06 11:45:59', '2019-01-06 11:45:59'),
(12, 'Admin', 'Accountant', 'Update Rice Basmathi to the Inventory', 0, '2019-01-06 11:45:59', '2019-01-06 11:45:59'),
(13, 'Inventory Manager', 'Accountant', 'Update Rice Basmathi to the Inventory', 0, '2019-01-06 11:46:03', '2019-01-06 11:46:03'),
(14, 'Admin', 'Accountant', 'Update Rice Basmathi to the Inventory', 0, '2019-01-06 11:46:03', '2019-01-06 11:46:03'),
(15, 'Accountant', 'Inventory Manager', 'Soya meat has fallen behind its limit', 0, '2019-01-08 11:00:14', '2019-01-08 11:00:14'),
(16, 'Admin', 'Inventory Manager', 'Soya meat has fallen behind its limit', 0, '2019-01-08 11:00:14', '2019-01-08 11:00:14'),
(17, 'Accountant', 'Inventory Manager', 'Soya meat has fallen behind its limit', 0, '2019-01-08 11:00:20', '2019-01-08 11:00:20'),
(18, 'Admin', 'Inventory Manager', 'Soya meat has fallen behind its limit', 0, '2019-01-08 11:00:20', '2019-01-08 11:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_vendors`
--

CREATE TABLE `pay_vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foodItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pay_vendors`
--

INSERT INTO `pay_vendors` (`id`, `vendor_id`, `vendor_name`, `foodItem`, `data`, `created_at`, `updated_at`) VALUES
(1, 1, 'kamal', 'Rice Basmathi', '[\"300\",\"8\",\"2400\"]', '2019-01-01 11:08:27', '2019-01-01 11:08:27'),
(2, 1, 'kamal', 'soya meat', '[\"120\",\"4\",\"480\"]', '2019-01-01 11:08:27', '2019-01-01 11:08:27'),
(3, 3, 'Lois', 'Rice Basmathi', '[\"4\",\"5\",\"20\"]', '2019-01-01 11:28:47', '2019-01-01 11:28:47'),
(4, 2, 'Kumara', 'soya meat', '[\"45\",\"3\",\"135\"]', '2019-01-01 11:30:19', '2019-01-01 11:30:19'),
(5, 10, 'Emily', 'Rice Basmathi', '[\"35\",\"6\",\"210\"]', '2019-01-01 11:32:39', '2019-01-01 11:32:39'),
(6, 10, 'Emily', 'Rice Basmathi', '[\"43\",\"5\",\"215\"]', '2019-01-01 11:38:19', '2019-01-01 11:38:19'),
(7, 5, 'Millie', 'Rice Basmathi', '[\"135\",\"2\",\"270\"]', '2019-01-01 20:57:19', '2019-01-01 20:57:19'),
(8, 8, 'Cooper', 'Rice Basmathi', '[\"120\",\"1\",\"120\"]', '2019-01-01 23:48:38', '2019-01-01 23:48:38'),
(9, 8, 'Cooper', 'soya meat', '[\"120\",\"10\",\"1200\"]', '2019-01-01 23:48:38', '2019-01-01 23:48:38'),
(10, 10, 'Emily', 'Rice Basmathi', '[\"50\",\"3\",\"150\"]', '2019-01-06 11:45:47', '2019-01-06 11:45:47'),
(11, 10, 'Emily', 'Rice Basmathi', '[\"50\",\"3\",\"150\"]', '2019-01-06 11:45:59', '2019-01-06 11:45:59'),
(12, 10, 'Emily', 'Rice Basmathi', '[\"50\",\"3\",\"150\"]', '2019-01-06 11:46:03', '2019-01-06 11:46:03');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(10) UNSIGNED NOT NULL,
  `dish_id` int(11) NOT NULL DEFAULT '0',
  `dish_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dish_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `dish_id`, `dish_name`, `dish_type`, `ingredients`, `amount`, `created_at`, `updated_at`) VALUES
(3, 2, 'Vege Rice', 'rice', 'Rice Basmathi', '40', '2018-12-22 09:11:14', '2018-12-22 09:11:14'),
(4, 2, 'Vege Rice', 'rice', 'soya meat', '20', '2018-12-22 09:11:25', '2018-12-22 09:11:25'),
(5, 1, 'Chicken Fried Rice', 'rice', 'Rice Basmathi', '50', '2018-12-22 10:03:57', '2018-12-22 10:03:57'),
(6, 2, 'Chicken Fried Rice', 'rice', 'soya meat', '30', '2018-12-22 10:04:05', '2018-12-22 10:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `type`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 'Binuri', 'Manorathne', 'Mgr', 'binuri@gmail.com', '$2y$10$ckLWPHKfj2lfb0McOOJWeug2AKiIk21Wx.st2YMRXawcAZYts9iqG', 'OJMNJFwMatFUBeadHkgSZOdxG099i2YSvgKW09c01yzJozAgAIfW9xVG0PMQ', '2018-09-18 01:57:00', '2018-09-18 01:57:00'),
(10, 'Admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$akr5P0K.6pk0yq5b0/7gy.WB4OuNqk.bpzaDTC/pqoy1LINNP/Seq', 'v4G8AP4yGnE0d0IqkUfniBJV19qG5JabLMjkR1ftNt4flsxiUAiBKRiExB8i', '2018-09-18 03:56:26', '2018-09-18 03:56:26'),
(11, 'Cashier', 'cashier', 'cashier', 'cashier@gmail.com', '$2y$10$5goCVKmAlaUWhDNwVxEw7.S.rNcrX4zKV4axZP05foeLJ1oxSxzcO', 'fuBPPvA8W1zVbfvFHresZjteIdYgtQ6VVBOogkYsIvNlFc4BsNdACL95ZiTN', '2018-09-18 13:47:27', '2018-09-18 13:47:27'),
(12, 'Accountant', 'acc', 'accountant', 'accountant@gmail.com', '$2y$10$grIXvfBPcv/.FE2eqHbbBODrD2uNyvwV3EIpIi8WqKaf1xMbiwgrK', 'qCzzrjVEewEaJnJyL68aPZbNLXAaRj5c5Rnd2bOJR6wzmJ51rip4zGW9vtlI', '2018-09-18 13:54:58', '2018-09-18 13:54:58'),
(13, 'saman', 'kumara', 'cashier', 'saman@gmail.com', '$2y$10$8.GGW9O1GTeZ2VCtaJVjn.f0BXM2c3xIlKRr0CXeNDnFkIpZ6oLpW', 'WXZC09ssxgi0Xn7AMjLSsVMwZvVRSYsBLck9Amfun3uy1v4Cn0HTea0F4Cav', '2018-09-19 04:04:09', '2018-09-19 04:04:09'),
(14, 'Oshadhi', 'Munasinghe', 'accountant', 'oshadhi@gmail.com', '$2y$10$t46aTnDnlf.VhnaKfHBeGu3RCApcqRM8B/lHOtz/aw.0vYQ3e6qDu', 'bYOYDvyFJocooPRcGtklzDqxPMhFQvNSS4tgCw9ygmXbRze3MagtqqK9bnCA', '2018-09-19 15:30:24', '2018-09-19 15:30:24'),
(15, 'nipuna', 'Nagoda', 'Mgr', 'nipuna@gmail.com', '$2y$10$AjdKI9CvRsKjBwWhUs8hNOUSzdekJwlRt2ny.LlOCIIF.qHnFuYba', 'Iidjb8zU7PSL5lRNSBhUMwYue4o3wdqvv2MuEpq5rGpn9ZdvRwPC7X7zq3RN', '2018-09-19 15:50:27', '2018-09-19 15:50:27'),
(16, 'Nagoda', 'Nipuna', 'cashier', 'sunil@gmail.com', '$2y$10$G2.zrsC48shEYOtCyEvsZeLR3d96hNm1XhX5TgVijUOlCFWopx7xa', 'fufpqhvNCpEBq8AmnYYySTAmDsFQbod3ZlzoMugscAMNIVseVodiHnimp64S', '2018-09-19 18:02:50', '2018-09-19 18:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `fname`, `lname`, `email`, `contact`, `created_at`, `updated_at`) VALUES
(1, 'kamal', 'Enterprise', 'kamal@gmail.com', '0733282678', '2018-11-27 09:16:53', '2018-11-27 09:16:53'),
(2, 'Kumara', 'Grocery', 'kumara@gmail.com', '073219937', '2018-11-27 09:33:13', '2018-11-27 09:33:13'),
(3, 'Lois', 'Farm house', 'tglover@example.org', '773124069', '2018-12-22 05:38:21', '2018-12-22 05:38:21'),
(4, 'Braulio', 'Grocery', 'kemmer.camren@example.com', '753399583', '2018-12-22 05:38:21', '2018-12-22 05:38:21'),
(5, 'Millie', 'Enterprice', 'qmann@example.net', '781079086', '2018-12-22 05:38:21', '2018-12-22 05:38:21'),
(6, 'Stan', 'Enterprice', 'koelpin.kamron@example.com', '749913295', '2018-12-22 05:38:21', '2018-12-22 05:38:21'),
(7, 'Sheila', 'Farm house', 'zhamill@example.com', '745278645', '2018-12-22 05:38:21', '2018-12-22 05:38:21'),
(8, 'Cooper', 'Enterprice', 'vena88@example.net', '741020601', '2018-12-22 05:38:21', '2018-12-22 05:38:21'),
(9, 'Katlynn', 'Farm house', 'harber.jovan@example.com', '743515908', '2018-12-22 05:38:21', '2018-12-22 05:38:21'),
(10, 'Emily', 'Farm house', 'renee80@example.org', '789160882', '2018-12-22 05:38:21', '2018-12-22 05:38:21'),
(11, 'Thaddeus', 'Stores', 'grady.pouros@example.com', '728885571', '2018-12-22 05:38:21', '2018-12-22 05:38:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_paids`
--
ALTER TABLE `bill_paids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_item_quantities`
--
ALTER TABLE `food_item_quantities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_item_update`
--
ALTER TABLE `food_item_update`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_fd_temps`
--
ALTER TABLE `issue_fd_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_food_items`
--
ALTER TABLE `issue_food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pay_vendors`
--
ALTER TABLE `pay_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill_paids`
--
ALTER TABLE `bill_paids`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `food_item_quantities`
--
ALTER TABLE `food_item_quantities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `food_item_update`
--
ALTER TABLE `food_item_update`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `issue_fd_temps`
--
ALTER TABLE `issue_fd_temps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `issue_food_items`
--
ALTER TABLE `issue_food_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pay_vendors`
--
ALTER TABLE `pay_vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
