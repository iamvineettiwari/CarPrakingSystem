-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2020 at 12:00 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id10725584_carparkingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `user_id` int(9) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_occupation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_profile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_record`
--

CREATE TABLE `booking_record` (
  `booking_id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `booking_time` datetime NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(255) NOT NULL,
  `book_date` varchar(255) NOT NULL,
  `book_time_in` time NOT NULL,
  `book_time_out` time NOT NULL,
  `slot_table` varchar(255) NOT NULL,
  `ammount` varchar(255) NOT NULL,
  `slot_no` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `status` int(9) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cancel_refund`
--

CREATE TABLE `cancel_refund` (
  `refund_id` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `refund_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `refund_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `refunded_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parking_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cancel_date` datetime NOT NULL,
  `book_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parking_slot_detail`
--

CREATE TABLE `parking_slot_detail` (
  `slot_id` int(9) NOT NULL,
  `slot_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slot_capacity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slot_charge` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slot_manager_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slot_manager_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slot_manager_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slot_longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slot_latitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slot_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slot_table` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `payment_id` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `transacted_id` varchar(255) NOT NULL,
  `payment_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `ammount_paid` varchar(255) NOT NULL,
  `user_id` int(9) NOT NULL,
  `status` int(9) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(9) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_first_name` varchar(255) NOT NULL,
  `user_last_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_contact` varchar(13) NOT NULL,
  `user_occupation` varchar(255) NOT NULL,
  `user_address` mediumtext NOT NULL,
  `user_profile` varchar(255) DEFAULT NULL,
  `user_account_status` int(11) NOT NULL DEFAULT 0,
  `user_reg_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `validate_user_reg`
--

CREATE TABLE `validate_user_reg` (
  `user_id` int(9) NOT NULL,
  `reg_token` varchar(255) NOT NULL,
  `reg_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `booking_record`
--
ALTER TABLE `booking_record`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `cancel_refund`
--
ALTER TABLE `cancel_refund`
  ADD PRIMARY KEY (`refund_id`);

--
-- Indexes for table `parking_slot_detail`
--
ALTER TABLE `parking_slot_detail`
  ADD PRIMARY KEY (`slot_id`);

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_record`
--
ALTER TABLE `booking_record`
  MODIFY `booking_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cancel_refund`
--
ALTER TABLE `cancel_refund`
  MODIFY `refund_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parking_slot_detail`
--
ALTER TABLE `parking_slot_detail`
  MODIFY `slot_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
