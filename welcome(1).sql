-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2015 at 07:29 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `welcome`
--

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED NOT NULL,
  `loan` decimal(8,2) NOT NULL,
  `rate` varchar(30) NOT NULL,
  `period` varchar(20) NOT NULL,
  `interest` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `user_status` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `loan_status` varchar(6) NOT NULL,
  `loan_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(6) UNSIGNED NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `id_no` int(200) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `hashed_password` varchar(200) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `user_status` varchar(30) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `gender`, `id_no`, `email`, `username`, `hashed_password`, `user_type`, `user_status`, `reg_date`) VALUES
(1, 'Admin', 'Admin', 'Male', 1, 'admin@admin.com', 'admin', '$2a$10$bkgSHwHAsIQUtGk2MYq57epADURvPPPnRS09I7gtEJA3r/LiTzpsG', 'Admin', 'Activated', '2015-11-16 06:05:06'),
(2, 'Name', 'Name', 'Female', 2, 'name@name.com', 'name', '$2a$10$eEuszgoHpzaTl5LT.jOk1ei4uzFV.YD.CLClQGI72p3hHYUKIu6Xm', 'Member', 'Activated', '2015-11-16 06:20:36'),
(3, 'Alpha', 'Alpha', 'Female', 3, 'alpha@alpha.com', 'alpha', '$2a$10$uPxKzUXt/xk0xBtmIbMO4e4GHttUbFPPs0Bk9uH593qKmq1rwD4BK', 'Member', 'Activated', '2015-11-16 06:26:16'),
(4, 'Bonche', 'Bonche', 'Male', 4, 'bonche@bonche.com', 'bonche', '$2a$10$3R1SX708ZnNXcdwL3On4lOvUThFtM7XDrII/MSPoSggl/hRKRFBfK', 'Member', 'Activated', '2015-11-16 06:26:56'),
(5, 'Terer', 'Terer', 'Female', 5, 'terer@terer.com', 'terer', '$2a$10$bnv9t0kDqYZkP0b103uTneDtIxRZLa0iaFXYwKIASidU4FztNJcl6', 'Member', 'Activated', '2015-11-16 06:27:38'),
(6, 'Cheptoo', 'Cheptoo', 'Female', 7, 'cheptoo@cheptoo.com', 'cheptoo', '$2a$10$Jaopc3rlSA9qlzbKQBalaune/xjKZfnqe80GumxWna9uQR5fVnqvm', 'Member', 'Activated', '2015-11-16 06:28:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
