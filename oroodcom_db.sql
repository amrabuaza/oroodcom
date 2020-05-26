-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2020 at 06:08 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oroodcom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `shop_id`) VALUES
(106, 'Hot Drinks', 3),
(107, 'Hot Drinks', 3),
(123, 'drinks', 1),
(124, 'Cold Drinks', 1),
(125, 'MilkShake', 1),
(126, 'Hot Drinks', 1),
(127, 'Hookah', 1),
(128, 'Cold Drinks', 8),
(129, 'MilkShake', 8),
(130, 'Hookah', 8),
(132, 'drinks', 2),
(133, 'مشروبات مثلجة', 2);

-- --------------------------------------------------------

--
-- Table structure for table `category_language`
--

CREATE TABLE `category_language` (
  `id` int(11) NOT NULL,
  `language` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_language`
--

INSERT INTO `category_language` (`id`, `language`, `name`, `category_id`) VALUES
(1, 'ar', 'مشروبات ساخنة', 106),
(2, 'ar', 'مشروبات ساخنة', 107),
(3, 'ar', 'مشروبات ساخنة', 126),
(4, 'ar', 'مشروبات', 123),
(5, 'ar', 'مشروبات مثلجة', 124),
(6, 'ar', 'اللبن المخفوق', 125),
(7, 'ar', 'الشيشة', 127),
(8, 'ar', 'مشروبات مثلجة', 128),
(9, 'ar', 'اللبن المخفوق', 129),
(10, 'ar', 'الشيشة', 130),
(11, 'ar', 'مشروبات', 132),
(12, 'en', 'مشروبات مثلجة', 133);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `old_price` double NOT NULL,
  `description` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `price`, `old_price`, `description`, `picture`, `category_id`) VALUES
(35, 'turkish coffee', 2, 10, 'sads', '2019-12/category3_106_turkish-coffee-recipe-2355497-36-5b3fd0e646e0fb003765c774.jpg', 106),
(36, 'Coffee', 1.9, 15, 'sdad', '2019-12/category3_106_turkish-coffee-recipe-2355497-36-5b3fd0e646e0fb003765c774.jpg', 106),
(37, 'American coffee', 5, 10, 'sads', '2019-12/category4_107_sweatshopFB2.0.jpg', 107),
(38, 'Ice coffee', 2, 2.5, 'ice coffee', '2019-12/Cold Drinks_128_how-to-make-iced-coffee-31-735x1015.jpg', 128),
(40, 'Vanilla', 2.25, 2.75, 'Vanilla', '2019-12/MilkShake_129_vanilla-milkshake-1521645092.jpg', 129),
(41, 'Chocolate', 2.25, 2.75, 'Chocolate', '2019-12/MilkShake_129_Chocolate-Milkshakes-square.jpg', 129),
(42, 'Ice tea', 1.25, 1.5, 'ice tea', '2019-12/Cold Drinks_128_ice-tea (1).png', 128),
(43, 'Two Apples Nkhla', 3, 3.5, 'Two Apples Nkhla', '2019-12/Hookah_33d1c859-eb5e-4bd5-ac6e-33daab647572_AK47-HOOKAH-6-1-1200x1200.jpg', 130),
(44, 'Alhakawati Shesha', 3.5, 4, 'Alhakawati Shesha', '2019-12/Alhakawati Shesha_fbfc5978-7fdf-453a-820d-4712e88cdc77_mob-tommy-gun-shisha.jpg', 130),
(45, 'Dishes', 0.75, 1, 'sda', '2019-12/97on_ff92c12d-4aad-47c9-9f76-f8e2cf4fd818_home-2.png', 132),
(48, 'Women\'s Sports Hoodie Long Sleeve Quick-drying Slim Hoodie', 5, 12, 'sad', '2020-05/d8hvR2eF4la0zT81uy4AHev2ZNaPOMWu.jpg', 106);

-- --------------------------------------------------------

--
-- Table structure for table `item_language`
--

CREATE TABLE `item_language` (
  `id` int(11) NOT NULL,
  `language` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_language`
--

INSERT INTO `item_language` (`id`, `language`, `name`, `description`, `item_id`) VALUES
(1, 'ar', 'قهوة تركية', 'قهوة تركية', 35),
(2, 'ar', 'قهوة', 'قهوة', 36),
(3, 'ar', 'القهوة الأمريكية', 'القهوة الأمريكية', 37),
(4, 'ar', 'قهوة مثلجة', 'قهوة مثلجة', 38),
(5, 'ar', 'فانيلا', 'فانيلا', 40),
(6, 'ar', 'شوكولاتة', 'شوكولاتة', 41),
(7, 'ar', 'شاي مثلج', 'شاي مثلج', 42),
(8, 'ar', 'تفاحتين نخله', 'تفاحتين نخله', 43),
(9, 'ar', 'الحكواتي شيشة', 'الحكواتي شيشة', 44),
(10, 'ar', 'صحون', 'صحون', 45),
(14, 'ar', 'قطعه 2', 'يسبيسبسي', 48);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1573310127),
('m130524_201442_init', 1573310129),
('m190124_110200_add_verification_token_column_to_user_table', 1573310129);

-- --------------------------------------------------------

--
-- Table structure for table `pending_default_category_name`
--

CREATE TABLE `pending_default_category_name` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pending_default_category_name`
--

INSERT INTO `pending_default_category_name` (`id`, `name`, `name_ar`, `status`, `user_id`) VALUES
(1, 'testPeCat', '', 'active', 12);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `open_at` varchar(255) NOT NULL,
  `close_at` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `name`, `phone_number`, `description`, `latitude`, `longitude`, `open_at`, `close_at`, `rate`, `picture`, `status`, `owner_id`) VALUES
(1, 'default-shop', 0, '', '', '', '', '', 0, '', '', 1),
(2, 'Starbucks', 123456, 'dsfsdg', '32.55199366686754', '35.84893919264414', '3', '4', 5, '2019-12/Starbucks_2_download.jfif', 'inactive', 2),
(3, 'Coffee lab', 123456, 'sadad', '32.02990970407737', '35.87394181249783', '8', '10', 5, '2019-12/Coffee lab_3_download (1).jfif', 'active', 2),
(5, 'test shop', 123456, 'fdgdgfd', '32.55758924932194', '35.86407585170264', '8', '10', 5, '2019-12/shlter__54278425_256507915298888_584660690980044800_n.png', 'inactive', 12),
(6, 'Shlter', 123456, 'fd', '32.533571934057676', '35.875210762023926', '12', '12', 5, '2019-12/shlter__54278425_256507915298888_584660690980044800_n.png', 'active', 2),
(8, 'Alhakawati Cafe', 2147483647, 'Cafe', '31.958021739743216', '35.8619049936533', '12AM', '2PM', 5, '2019-12/Alhakawati Cage__download (3).jfif', 'active', 13),
(10, 'shop2', 123456, 'dfdsf4ds', '32.553072802452746', '35.84823889151001', '05:45 PM', '12:15 AM', 5, '2020-05/uRQVKQb2z_CmEw174OMkd9tEpJkn0ren.png', 'inactive', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shop_language`
--

CREATE TABLE `shop_language` (
  `id` int(11) NOT NULL,
  `language` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_language`
--

INSERT INTO `shop_language` (`id`, `language`, `name`, `description`, `shop_id`) VALUES
(5, 'ar', 'شلتر', 'شلتر', 6),
(6, 'ar', 'ستاربكس', 'ستاربكس', 2),
(7, 'ar', 'معمل القهوة', 'معمل القهوة', 3),
(8, 'ar', 'متجر اختبار', 'متجر اختبار', 5),
(9, 'ar', 'مقهى الحكواتي', 'مقهى الحكواتي', 8),
(11, 'ar', 'تيست', 'يسبيس', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('admin','seller','user') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'seller',
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `access_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `type`, `first_name`, `last_name`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `access_token`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'root', 'admin', '', '', 'iJcVSdoyj1jhOHIyTG6WwNJfnfTEr4uk', '$2y$13$W3s1Ta9.PEgQhMdF2S/eE.g.bYZt0YoKRG0tbwlHD6hAn0nlKPp/W', NULL, 'root@hotmail.com', 10, '', '0000-00-00 00:00:00', '2019-11-09 17:40:07', '06gu9czRUg2RU9Xi2ZPQ1DvvBzxMPrt3_1573310978'),
(2, 'qussai', 'seller', '', '', 'a4FM0AOC7cYhxQBix0iRNOhLtjtQqqM1', '$2y$13$q1FzTBtMQ3g.jTSUFBI/6OfyqrCVtCbpL/RIQ3OvWyOMdQnBTagNq', NULL, 'qussai@hotmail.com', 10, '', '0000-00-00 00:00:00', '2019-11-09 17:37:45', '8bFs946BzWTunpp97Crxak7kbf6Bw_YN_1573313690'),
(5, 'test', 'seller', '', '', 'aIbx_THX_5-COwP9wtbv8HiLbHrOpd9i', '$2y$13$crlXITWHjM0pZ8.NzAXJ4eOBlAeTpxxSRYzl9nDb9r32YYB.m4m4O', NULL, 'test@hotmail.com', 10, '', '2019-11-09 20:09:13', '0000-00-00 00:00:00', NULL),
(12, 'ammar', 'user', '', '', '6uz4y4TBCoEqb57NeUDYh4p_fjE6-H1Z', '$2y$13$i/TyT.fXAVNQCiVm2Spla.3FVGTas.Dru0MKDXyu/A0SS7jssKQhC', NULL, 'c.r925@hotmail.com', 10, 'a4218a87b7a15316b615fb94862228bd0d11e47eae940481c0f98a2152659179', '2019-11-09 20:38:54', '2020-03-08 18:35:25', '0zE7Mijf0aGWu_MYncx5FP2I81InC_b8_1573328334'),
(13, 'rama.almomni', 'seller', '', '', '7Zqzf-h6KicypKm6HB9FxPOtPHSGHIue', '$2y$13$zqW0E2hk2MHckHLEeC/78.lg6pcIP2twGM23wPANa0U0Y/wVvYKqa', NULL, 'rama_almomni@hotmail.com', 10, '', '2020-01-18 13:01:25', '2020-01-18 13:23:26', 'XGE1taqGVX-lcFoBqUib_3lgHmkDqWjn_1579348885'),
(15, 'test user', 'user', 'userx', '12', '', '$2y$13$ErKx8edv8l1bQhtcJ/p9Ie/JnB8jUE7MNCM9zOu/yT5Z6SzNHgJAW', NULL, 'testuser@hotmail.com', 10, '717b96d7c3b49fd23fbbcb2d10fda7ec6f12aacd86d48164a30f0fbff9bee6d2', '2020-03-08 18:38:33', '2020-03-08 18:54:37', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `con2` (`shop_id`);

--
-- Indexes for table `category_language`
--
ALTER TABLE `category_language`
  ADD PRIMARY KEY (`id`),
  ADD KEY `con_category_language_category_id` (`category_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `con3` (`category_id`);

--
-- Indexes for table `item_language`
--
ALTER TABLE `item_language`
  ADD PRIMARY KEY (`id`),
  ADD KEY `con_item_language_item_id` (`item_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `pending_default_category_name`
--
ALTER TABLE `pending_default_category_name`
  ADD PRIMARY KEY (`id`),
  ADD KEY `con4` (`user_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `con1` (`owner_id`);

--
-- Indexes for table `shop_language`
--
ALTER TABLE `shop_language`
  ADD PRIMARY KEY (`id`),
  ADD KEY `con_shop_language_shop_id` (`shop_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `category_language`
--
ALTER TABLE `category_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `item_language`
--
ALTER TABLE `item_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pending_default_category_name`
--
ALTER TABLE `pending_default_category_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shop_language`
--
ALTER TABLE `shop_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `con2` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_language`
--
ALTER TABLE `category_language`
  ADD CONSTRAINT `con_category_language_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `con3` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_language`
--
ALTER TABLE `item_language`
  ADD CONSTRAINT `con_item_language_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pending_default_category_name`
--
ALTER TABLE `pending_default_category_name`
  ADD CONSTRAINT `con4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `con1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop_language`
--
ALTER TABLE `shop_language`
  ADD CONSTRAINT `con_shop_language_shop_id` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
