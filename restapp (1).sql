-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2018 at 08:20 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 5, 'noodles', 70, '2018-11-01 09:02:46', '2018-11-01 09:02:46'),
(2, 6, 'buriani', 300, '2018-11-01 09:03:25', '2018-11-01 09:03:25'),
(3, 7, 'kothhtu', 200, '2018-11-01 09:03:35', '2018-11-01 09:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `lname`, `age`, `email`, `contact`, `created_at`, `updated_at`) VALUES
(4, 'Saman', 'Kumara', 45, 'saman@gmail.com', '34343', '2018-10-28 08:56:17', '2018-10-28 08:56:17'),
(5, 'nipuna', 'nagoda', 25, 'emp@gmail.com', '97299917', '2018-10-30 23:38:15', '2018-10-30 23:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(10) NOT NULL,
  `itemName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT '0',
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` int(10) DEFAULT NULL,
  `vendor_id` varchar(6000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `itemName`, `quantity`, `unit`, `unit_price`, `vendor_id`, `created_at`, `updated_at`) VALUES
(1, 'Rice Basmathi', 470, 'Kg', 120, '1 15', '2018-09-26 01:29:14', '2018-10-31 05:03:29'),
(2, 'Dhal', 0, 'Kg', NULL, NULL, '2018-09-26 01:29:46', '2018-09-26 01:29:46'),
(3, 'Leeks', 0, 'Kg', NULL, '1', '2018-09-26 01:29:59', '2018-09-26 01:31:21'),
(4, 'potatos', 0, 'kg', NULL, NULL, '2018-09-27 07:41:58', '2018-09-27 07:41:58'),
(5, NULL, 0, NULL, NULL, NULL, '2018-10-13 06:08:15', '2018-10-13 06:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `food_item_update`
--

CREATE TABLE `food_item_update` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `vendor_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_item_update`
--

INSERT INTO `food_item_update` (`id`, `item_id`, `quantity`, `vendor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 470, 'kapila', '2018-10-31 05:03:29', '2018-10-31 05:03:29');

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
(3, '2018_09_10_143407_create_food_items_table', 1),
(4, '2018_09_10_161059_change_table_name', 2),
(5, '2018_09_11_132442_create_food_items_table', 3),
(6, '2018_09_11_133034_add_column_to_food_item_update', 4),
(7, '2018_09_11_134601_add_foreign_key', 5),
(8, '2018_09_11_134601_add_foreign_keyy', 6),
(9, '2018_09_11_145138_make_food_item_update_table', 7),
(10, '2018_09_18_075916_create_roles_table', 8),
(11, '2018_09_18_080917_create_user_roles_table', 8),
(12, '2018_09_24_172038_create_vendors_table', 9),
(13, '2018_10_28_122857_create_employees_table', 10),
(14, '2018_11_01_081116_create_bills_table', 11),
(15, '2018_11_01_120847_create_dishes_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('gayath.chandira94@gmail.com', '$2y$10$6.ndvnzcX.dMc49tZElc/OJTXJ/s0C1YXDOKihG0b5G/5gsqrwy9u', '2018-09-13 05:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(10) NOT NULL,
  `dish_id` int(11) DEFAULT '0',
  `dish_name` varchar(20) NOT NULL,
  `ingredients` varchar(400) DEFAULT NULL,
  `amount` varchar(60000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `dish_id`, `dish_name`, `ingredients`, `amount`, `created_at`, `updated_at`) VALUES
(47, 1, 'hgh', '', NULL, '2018-09-28 05:12:03', '2018-09-28 05:12:03'),
(48, 2, 'rer', '', NULL, '2018-09-28 05:39:07', '2018-09-28 05:39:07'),
(49, 3, 'hg', '', NULL, '2018-09-28 05:43:57', '2018-09-28 05:43:57'),
(50, 4, 'gg', 'aa,bb,cc', '11,22,33', '2018-09-28 05:50:47', '2018-09-28 05:50:47'),
(51, 5, 'noodles', 'Rice Basmathi', '500', '2018-10-27 03:06:26', '2018-10-27 03:06:26'),
(52, 5, 'noodles', 'Dhal', '300', '2018-10-27 03:06:50', '2018-10-27 03:06:50'),
(53, 6, 'buriani', 'Rice Basmathi', '344', '2018-10-27 06:30:05', '2018-10-27 06:30:05'),
(55, 6, 'buriani', 'Dhal', '678', '2018-10-27 06:30:55', '2018-10-27 06:30:55'),
(56, 7, 'kothhtu', 'Leeks', '45', '2018-10-27 06:35:02', '2018-10-27 06:35:02'),
(57, 8, 'mallum', 'potatos', '34', '2018-10-31 00:09:14', '2018-10-31 00:09:14'),
(58, 8, 'mallum', 'Rice Basmathi', '23', '2018-10-31 00:09:21', '2018-10-31 00:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', '2018-09-18 04:13:35', '2018-09-18 04:13:35'),
(2, 'InvMgr', 'Inventory Manager', '2018-09-18 04:13:35', '2018-09-18 04:13:35'),
(3, 'Cashier', 'Cashier', '2018-09-18 04:13:35', '2018-09-18 04:13:35'),
(4, 'Accnt', 'Accountant', '2018-09-18 04:13:35', '2018-09-18 04:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
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
(9, 'Binuri', 'Manorathne', 'Mgr', 'binuri@gmail.com', '$2y$10$ckLWPHKfj2lfb0McOOJWeug2AKiIk21Wx.st2YMRXawcAZYts9iqG', '57c8I4tDkAnjkniuOkaWWRJ8zlYwYvF3EslTgquurhhGSG0PxClDdBfiDdqJ', '2018-09-18 07:27:00', '2018-09-18 07:27:00'),
(10, 'Admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$akr5P0K.6pk0yq5b0/7gy.WB4OuNqk.bpzaDTC/pqoy1LINNP/Seq', 'v4G8AP4yGnE0d0IqkUfniBJV19qG5JabLMjkR1ftNt4flsxiUAiBKRiExB8i', '2018-09-18 09:26:26', '2018-09-18 09:26:26'),
(11, 'Cashier', 'cashier', 'cashier', 'cashier@gmail.com', '$2y$10$5goCVKmAlaUWhDNwVxEw7.S.rNcrX4zKV4axZP05foeLJ1oxSxzcO', 'fuBPPvA8W1zVbfvFHresZjteIdYgtQ6VVBOogkYsIvNlFc4BsNdACL95ZiTN', '2018-09-18 19:17:27', '2018-09-18 19:17:27'),
(12, 'Accountant', 'acc', 'accountant', 'accountant@gmail.com', '$2y$10$grIXvfBPcv/.FE2eqHbbBODrD2uNyvwV3EIpIi8WqKaf1xMbiwgrK', '5BrXRkmLsZPDIAz2wrNp9Tk9w0pxqra90axIiHBUBNG1qPDS4RhsNhFrcG8E', '2018-09-18 19:24:58', '2018-09-18 19:24:58'),
(13, 'saman', 'kumara', 'cashier', 'saman@gmail.com', '$2y$10$8.GGW9O1GTeZ2VCtaJVjn.f0BXM2c3xIlKRr0CXeNDnFkIpZ6oLpW', 'WXZC09ssxgi0Xn7AMjLSsVMwZvVRSYsBLck9Amfun3uy1v4Cn0HTea0F4Cav', '2018-09-19 09:34:09', '2018-09-19 09:34:09'),
(14, 'Oshadhi', 'Munasinghe', 'accountant', 'oshadhi@gmail.com', '$2y$10$t46aTnDnlf.VhnaKfHBeGu3RCApcqRM8B/lHOtz/aw.0vYQ3e6qDu', 'bYOYDvyFJocooPRcGtklzDqxPMhFQvNSS4tgCw9ygmXbRze3MagtqqK9bnCA', '2018-09-19 21:00:24', '2018-09-19 21:00:24'),
(15, 'nipuna', 'Nagoda', 'Mgr', 'nipuna@gmail.com', '$2y$10$AjdKI9CvRsKjBwWhUs8hNOUSzdekJwlRt2ny.LlOCIIF.qHnFuYba', 'Iidjb8zU7PSL5lRNSBhUMwYue4o3wdqvv2MuEpq5rGpn9ZdvRwPC7X7zq3RN', '2018-09-19 21:20:27', '2018-09-19 21:20:27'),
(16, 'Nagoda', 'Nipuna', 'cashier', 'sunil@gmail.com', '$2y$10$G2.zrsC48shEYOtCyEvsZeLR3d96hNm1XhX5TgVijUOlCFWopx7xa', 'fufpqhvNCpEBq8AmnYYySTAmDsFQbod3ZlzoMugscAMNIVseVodiHnimp64S', '2018-09-19 23:32:50', '2018-09-19 23:32:50');

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

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(1, NULL, NULL, 4, 1),
(2, NULL, NULL, 5, 2),
(3, NULL, NULL, 6, 3),
(4, NULL, NULL, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(10) NOT NULL,
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
(2, 'fds', 'dfd', 'dfad@gmail.com', '545', '2018-09-26 10:18:15', '2018-09-26 10:18:15'),
(3, 'ttr', 'hthe', 'df@gmail.com', '425', '2018-09-26 10:18:44', '2018-09-26 10:18:44'),
(4, 'fd', 'df', 'dfchanged@gmail.com', '43', '2018-09-26 10:19:37', '2018-09-26 10:19:37'),
(6, 'hd', 'gsf', 'ga@gmail.com', '354', '2018-09-26 10:25:52', '2018-09-26 10:25:52'),
(7, 'hg', 'gd', 'asd@gmail.com', '345', '2018-09-26 10:26:50', '2018-09-26 10:26:50'),
(8, 'h', 'he', 'hgdf@gmail.com', '56', '2018-09-26 10:27:11', '2018-09-26 10:27:11'),
(9, 'hth', 'jr', 'f@gmail.com', '52', '2018-09-26 10:29:15', '2018-09-26 10:29:15'),
(11, 'hs', 'hdg', 'gs@gmail.com', '34', '2018-09-26 10:59:58', '2018-09-26 10:59:58'),
(12, 'dhd', 'hfg', 'gss@gmail.com', '5422', '2018-09-26 11:17:24', '2018-09-26 11:17:24'),
(13, 'jjhfj', 'gjm', 'a@gmail.com', '636', '2018-09-26 11:28:48', '2018-09-26 11:28:48'),
(14, 'dfh', 'mfh', 'vsdf@gmail.com', '563', '2018-09-26 11:30:34', '2018-09-26 11:30:34'),
(15, 'jkut', 'yrurtu', 'eg@gmail.com', '4657', '2018-09-26 11:35:04', '2018-09-26 11:35:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreignKeyVendor` (`vendor_id`(191));

--
-- Indexes for table `food_item_update`
--
ALTER TABLE `food_item_update`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkFoodItemID` (`item_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food_item_update`
--
ALTER TABLE `food_item_update`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_item_update`
--
ALTER TABLE `food_item_update`
  ADD CONSTRAINT `fkFoodItemID` FOREIGN KEY (`item_id`) REFERENCES `food_items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
