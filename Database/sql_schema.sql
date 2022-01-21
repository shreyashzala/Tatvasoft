-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 07:26 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql_schema`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL COMMENT 'store id',
  `customer_id` int(11) NOT NULL COMMENT 'foreing key refer to customer',
  `street_address` int(11) NOT NULL COMMENT 'store street address',
  `house_no` int(11) NOT NULL COMMENT 'store house no',
  `postal_code` int(11) NOT NULL COMMENT 'store postal code',
  `telephone_no` int(11) NOT NULL COMMENT 'telephone no of customer',
  `city` varchar(20) NOT NULL COMMENT 'store city'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL COMMENT 'store admin id',
  `admin_name` varchar(50) NOT NULL COMMENT 'store admin name',
  `admin_email` varchar(30) NOT NULL COMMENT 'store admin email',
  `admin_password` varchar(15) NOT NULL COMMENT 'store admin password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `customer_id` int(11) NOT NULL COMMENT 'store customer id',
  `first_name` varchar(100) NOT NULL COMMENT 'store customer first name',
  `last_name` varchar(100) NOT NULL COMMENT 'store customer last name',
  `email` varchar(100) NOT NULL COMMENT 'store customer emails',
  `mobile_no` int(10) NOT NULL COMMENT 'store customer mobile no',
  `password` varchar(15) NOT NULL COMMENT 'store customer password',
  `confirm_password` varchar(15) NOT NULL COMMENT 'check the password '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `favourite_sp`
--

CREATE TABLE `favourite_sp` (
  `id` int(11) NOT NULL COMMENT 'store id',
  `sp_id` int(11) NOT NULL COMMENT 'foreign key with service provider',
  `customer_id` int(11) NOT NULL COMMENT 'foreign key with customer',
  `favourite` varchar(50) NOT NULL COMMENT 'customer favourite',
  `unfavourite` varchar(50) NOT NULL COMMENT 'unfavourite',
  `block_sp` varchar(50) NOT NULL COMMENT 'block service provider',
  `block_customer` varchar(50) NOT NULL COMMENT 'block customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL COMMENT 'store notification id',
  `customer_id` int(11) NOT NULL COMMENT 'foreign key with customer',
  `admin_id` int(11) NOT NULL COMMENT 'foreign key with admin',
  `service_provider_id` int(11) NOT NULL COMMENT 'foreign key with service provider',
  `message` varchar(50) NOT NULL COMMENT 'store message'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rating_sp`
--

CREATE TABLE `rating_sp` (
  `rating_id` int(11) NOT NULL COMMENT 'rating id',
  `customer_id` int(11) NOT NULL COMMENT 'foreign key with customer',
  `service_id` int(11) NOT NULL COMMENT 'foreign key with service',
  `service_provider_id` int(11) NOT NULL COMMENT 'foreign key with sp',
  `ontime_arrival` varchar(10) NOT NULL COMMENT 'time of arrival',
  `quality` varchar(20) NOT NULL COMMENT 'quality of service',
  `feedbak_of_sp` varchar(25) NOT NULL COMMENT 'feedback of sp ',
  `friendly` varchar(25) NOT NULL COMMENT 'how friendly was sp',
  `avg_rating` int(11) NOT NULL COMMENT 'average rating'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_booking`
--

CREATE TABLE `service_booking` (
  `service_id` int(11) NOT NULL COMMENT 'store id for service',
  `service_date` date NOT NULL COMMENT 'service date',
  `start_time` time NOT NULL COMMENT 'start time',
  `end_time` time NOT NULL COMMENT 'end time',
  `amount` int(11) NOT NULL COMMENT 'total amount ',
  `customer_id` int(11) NOT NULL COMMENT 'customer id ',
  `address` int(11) NOT NULL COMMENT 'address of customer',
  `sp_id` int(11) NOT NULL COMMENT 'service provider id',
  `status` int(11) NOT NULL COMMENT 'complete or not',
  `admin_id` int(11) NOT NULL COMMENT 'admin id',
  `comments` varchar(100) NOT NULL COMMENT 'comments'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_details`
--

CREATE TABLE `service_provider_details` (
  `service_provider_id` int(11) NOT NULL COMMENT 'store id',
  `first_name` varchar(50) NOT NULL COMMENT 'store first name',
  `last_name` varchar(50) NOT NULL COMMENT 'store last name',
  `email` varchar(50) NOT NULL COMMENT 'store email address',
  `mobile_no` int(10) NOT NULL COMMENT 'store mobile no',
  `nationality` varchar(30) NOT NULL COMMENT 'store country name',
  `gender` enum('Male','Female','Other','') NOT NULL COMMENT 'store gender',
  `status` varchar(25) NOT NULL COMMENT 'store status',
  `address_tittle` varchar(25) NOT NULL COMMENT 'store address',
  `house_no` varchar(20) NOT NULL COMMENT 'store house no',
  `postal_code` int(10) NOT NULL COMMENT 'store postal code',
  `location` varchar(50) NOT NULL COMMENT 'store location',
  `tax_no` int(11) NOT NULL COMMENT 'store tax no',
  `password` varchar(15) NOT NULL COMMENT 'store password',
  `confirm_password` varchar(15) NOT NULL COMMENT 'confirm the password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `Foreign key` (`customer_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `favourite_sp`
--
ALTER TABLE `favourite_sp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sp_id` (`sp_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `service_provider_id` (`service_provider_id`);

--
-- Indexes for table `rating_sp`
--
ALTER TABLE `rating_sp`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `service_provider_id` (`service_provider_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `service_booking`
--
ALTER TABLE `service_booking`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `address` (`address`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `sp_id` (`sp_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `service_provider_details`
--
ALTER TABLE `service_provider_details`
  ADD PRIMARY KEY (`service_provider_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'store id';

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'store admin id';

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'store customer id';

--
-- AUTO_INCREMENT for table `favourite_sp`
--
ALTER TABLE `favourite_sp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'store id';

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'store notification id';

--
-- AUTO_INCREMENT for table `rating_sp`
--
ALTER TABLE `rating_sp`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'rating id';

--
-- AUTO_INCREMENT for table `service_booking`
--
ALTER TABLE `service_booking`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'store id for service';

--
-- AUTO_INCREMENT for table `service_provider_details`
--
ALTER TABLE `service_provider_details`
  MODIFY `service_provider_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'store id';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `Foreign key` FOREIGN KEY (`customer_id`) REFERENCES `customer_details` (`customer_id`);

--
-- Constraints for table `favourite_sp`
--
ALTER TABLE `favourite_sp`
  ADD CONSTRAINT `favourite_sp_ibfk_1` FOREIGN KEY (`sp_id`) REFERENCES `service_provider_details` (`service_provider_id`),
  ADD CONSTRAINT `favourite_sp_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer_details` (`customer_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer_details` (`customer_id`),
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`service_provider_id`) REFERENCES `service_provider_details` (`service_provider_id`);

--
-- Constraints for table `rating_sp`
--
ALTER TABLE `rating_sp`
  ADD CONSTRAINT `rating_sp_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer_details` (`customer_id`),
  ADD CONSTRAINT `rating_sp_ibfk_2` FOREIGN KEY (`service_provider_id`) REFERENCES `service_provider_details` (`service_provider_id`),
  ADD CONSTRAINT `rating_sp_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `service_booking` (`service_id`);

--
-- Constraints for table `service_booking`
--
ALTER TABLE `service_booking`
  ADD CONSTRAINT `service_booking_ibfk_1` FOREIGN KEY (`address`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `service_booking_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `service_booking_ibfk_3` FOREIGN KEY (`sp_id`) REFERENCES `service_provider_details` (`service_provider_id`),
  ADD CONSTRAINT `service_booking_ibfk_4` FOREIGN KEY (`customer_id`) REFERENCES `customer_details` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
