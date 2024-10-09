-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 10:02 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sweetstream`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_table`
--

CREATE TABLE `delivery_table` (
  `did` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `product_quantity` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `deliveryperson_id` int(100) NOT NULL,
  `delivery_date_time` date NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `pid` int(100) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `pphoto` mediumblob NOT NULL,
  `pdescription` varchar(100) NOT NULL,
  `pprice` varchar(100) NOT NULL,
  `current_stock` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_no` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `privilege` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `phone_no`, `email`, `password`, `address`, `privilege`) VALUES
(3, 'Gokul krishna jayan', 0, 'gokuljayan508@gmail.com', '$2y$10$n4sp3Cm9YvWZ4CxKrzyfuu6IY3.FdqrV1mgdr4zfB8FZyJB9Uaxyu', NULL, 'admin'),
(7, 'ginse', 0, 'ginse@gmail.com', '$2y$10$Cj4bKj1ZgYhooryg3i1LFu1jn3JnVxkKfUGlbbXtzNxxWYB2BAYUe', NULL, 'delivery'),
(8, 'blesson', 0, 'blesson@gmail.com', '$2y$10$.ITvmHMPBTfKMQeJITK.pePrfcNI7rSKhi3CW10vyPnOeWPm4ASl.', NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_table`
--
ALTER TABLE `delivery_table`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_table`
--
ALTER TABLE `delivery_table`
  MODIFY `did` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `pid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
