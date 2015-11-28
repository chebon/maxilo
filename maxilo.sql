-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2015 at 02:02 PM
-- Server version: 5.6.25-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `maxilo`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'staff', '{"view":1,"add":1,"delete":1}', '2015-11-23 10:00:57', '2015-11-23 10:00:57'),
(2, 'members', '{"view":1,"add":1}', '2015-11-23 10:00:58', '2015-11-23 10:00:58'),
(3, 'Managers', '{"view":1,"add":1,"edit":1,"delete":1}', '2015-11-23 10:02:08', '2015-11-23 10:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE IF NOT EXISTS `loans` (
`id` int(6) unsigned NOT NULL,
  `user_id` int(6) unsigned NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `rate` varchar(30) NOT NULL,
  `period` varchar(20) NOT NULL,
  `interest` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `user_status` varchar(30) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `loan_status` varchar(6) NOT NULL,
  `loan_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `amount`, `rate`, `period`, `interest`, `total`, `user_status`, `date`, `loan_status`, `loan_date`) VALUES
(1, 7, 100.00, '0.33', '', 0.00, 133.00, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(2, 7, 100.00, '0.33', '', 0.00, 133.00, '', '2015-11-28 13:25:37', '', '0000-00-00 00:00:00'),
(3, 7, 100.00, '0.33', '', 0.00, 133.00, '', '2015-11-28 13:29:17', '', '0000-00-00 00:00:00'),
(4, 7, 100.00, '0.33', '', 0.00, 133.00, '', '2015-11-28 13:29:25', '', '0000-00-00 00:00:00'),
(5, 7, 100.00, '0.33', '', 0.00, 133.00, '', '2015-11-28 13:30:04', '', '0000-00-00 00:00:00'),
(6, 7, 124.00, '0.33', '', 0.00, 164.92, '', '2015-11-28 13:32:11', '', '0000-00-00 00:00:00'),
(7, 7, 124.00, '0.33', '', 0.00, 164.92, '', '2015-11-28 13:32:26', '', '0000-00-00 00:00:00'),
(8, 7, 124.00, '0.33', '', 0.00, 164.92, '', '2015-11-28 13:32:49', '', '0000-00-00 00:00:00'),
(9, 7, 100.00, '0.33', '', 0.00, 133.00, '', '2015-11-28 13:41:49', '', '0000-00-00 00:00:00'),
(10, 7, 100.00, '0.33', '', 0.00, 133.00, '', '2015-11-28 13:43:08', '', '0000-00-00 00:00:00'),
(11, 7, 100.00, '0.33', '', 0.00, 133.00, '', '2015-11-28 13:43:22', '', '0000-00-00 00:00:00'),
(12, 7, 125.00, '0.33', '', 0.00, 166.25, '', '2015-11-28 13:45:15', '', '0000-00-00 00:00:00'),
(13, 7, 125.00, '0.33', '', 0.00, 166.25, '', '2015-11-28 13:45:22', '', '0000-00-00 00:00:00'),
(14, 7, 125.00, '0.33', '', 0.00, 166.25, '', '2015-11-28 13:45:29', '', '0000-00-00 00:00:00'),
(15, 7, 125.00, '0.33', '', 0.00, 166.25, '', '2015-11-28 13:48:58', '', '0000-00-00 00:00:00'),
(16, 7, 125.00, '0.33', '', 0.00, 166.25, '', '2015-11-28 13:49:16', '', '0000-00-00 00:00:00'),
(17, 7, 125.00, '0.33', '', 0.00, 166.25, '', '2015-11-28 13:49:23', '', '0000-00-00 00:00:00'),
(18, 7, 125.00, '0.33', '', 0.00, 166.25, '', '2015-11-28 13:51:20', '', '0000-00-00 00:00:00'),
(19, 7, 125.00, '0.33', '', 0.00, 166.25, '', '2015-11-28 13:51:35', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE IF NOT EXISTS `rates` (
`id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `rate` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `name`, `rate`) VALUES
(1, 'rate_one', 33.1);

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(4) NOT NULL DEFAULT '0',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 1, '0.0.0.0', 0, 0, 0, '2015-11-23 08:49:30', NULL, NULL),
(2, 7, '0.0.0.0', 0, 0, 0, NULL, NULL, NULL),
(3, 2, NULL, 0, 0, 0, NULL, NULL, NULL),
(4, 8, NULL, 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` int(30) NOT NULL,
  `id_number` int(30) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(4) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `phone_number`, `id_number`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
(1, 'vikram@example.com', 0, 0, '$2y$10$c4SEYHwA5SKCdWSnAsG0w.9yxY8SxnoKJND65cWe6UWtLKTLOlju.', NULL, 1, NULL, NULL, '2015-11-23 13:36:35', '$2y$10$niyrEbZVx4Qks3Ux74WdAu7GdRiAciqoNujaljy6FJGvApSGBZ1MW', NULL, 'Example', 'User', '2013-09-12 08:28:31', '2015-11-23 10:36:35'),
(2, 'kendric@lamar.com', 0, 0, '$2y$10$bvkEdR54Fu4sjjWvJ4q6R.U4rsxOfzm51EoFF.gF0Dj4BG5VFGyVW', NULL, 1, 'D2GZUb3dY1A7jiC964fUhkK2noixVjFu3Xkvw2MqDF', NULL, '2015-11-24 10:16:29', '$2y$10$KHauvLvtPQjt56Wnp6ty8ene59fDxZe/DCRLrdAyhA2Veygr/GewG', NULL, 'kendric', 'lamar', '2015-11-23 09:19:11', '2015-11-24 07:16:29'),
(4, 'where@ami.com', 0, 0, '$2y$10$8iTdi7msZovQQE3gpDxl3uXeN7U4r9FvGAMSKomfbVx2CyydaIRTK', NULL, 0, 'VSAOlUgpmjZa59oPmf11fVcIevERq7U1HPV0T2yXyh', NULL, NULL, NULL, NULL, 'naq', '', '2015-11-23 09:35:04', '2015-11-23 09:37:29'),
(5, 'wema@mawe.com', 0, 0, '$2y$10$qvhwNazZqz8wRuc4sDOluO1s56Jr/9SU.rHN7x27tTVgZXN1FPfdS', NULL, 1, NULL, '2015-11-23 12:44:28', NULL, NULL, NULL, 'drm', 'drm', '2015-11-23 09:39:17', '2015-11-23 09:44:28'),
(6, 'hjaksdk@jkasd.com', 0, 0, '$2y$10$hHoZscF39cVnEzfUpw/RAedQQBxcCyXnD8J.UxKTT34SVZP9KzPB2', NULL, 1, 'rNA5i7kMGi8oINRfzFLudfCI7IRe6MoaOQtuRQNo0L', NULL, NULL, NULL, NULL, 'drompa', 'drupa', '2015-11-23 09:45:47', '2015-11-23 09:45:47'),
(7, 'dr@fasd.com', 0, 0, '$2y$10$232LMTF/OgOuC/3hDQl5J.oZ.Q7bJhJGAuypYorWcv7cJaMrWLDIa', NULL, 1, 'huVZGb6uVefPdXfYid6OVHY4BqiVidJcu4XjxpWs5F', NULL, '2015-11-28 12:57:22', '$2y$10$XLriGvhsDXHD4NA6yv16QOE66gH119qr4ElVu0VIef6qyccUMsDyi', NULL, 'fire', 'works', '2015-11-23 10:12:43', '2015-11-28 09:57:22'),
(8, 'max@max.com', 0, 0, '$2y$10$oixA9OGHjdGuE/VSwwU95Oc7kI1xkghjE0XVOCwzrx/sDFbNbv8EC', NULL, 1, 'J1MubwqlQbIYL6tl1W1wqmiFy1jHTFTJo4A5N1aAxK', NULL, '2015-11-24 10:21:33', '$2y$10$CkdBN4iL1FDvEDv0.wzgq.GiOgA5loVpVBlZl86TddalE.h9zenUu', NULL, 'bonche', 'bonche', '2015-11-24 07:20:50', '2015-11-24 07:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 7, 2),
(2, 8, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `throttle`
--
ALTER TABLE `throttle`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD KEY `users_activation_code_index` (`activation_code`), ADD KEY `users_reset_password_code_index` (`reset_password_code`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `throttle`
--
ALTER TABLE `throttle`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
