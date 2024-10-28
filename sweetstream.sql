-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 07:29 PM
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
  `user_id` varchar(100) NOT NULL,
  `product_quantity` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `deliveryperson_id` int(100) NOT NULL,
  `delivery_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL,
  `payment_details` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_table`
--

INSERT INTO `delivery_table` (`did`, `product_id`, `user_id`, `product_quantity`, `price`, `address`, `phone_no`, `deliveryperson_id`, `delivery_date_time`, `status`, `payment_details`) VALUES
(7, 59, '17', '2', '240', 'njallikkatile', '7994506504', 0, '2024-10-26 20:23:14', 'pending', 'Cash on Delivery selected.'),
(8, 58, '17', '3', '123', 'njallikkatile', '7994506504', 0, '2024-10-26 20:23:14', 'pending', 'Cash on Delivery selected.'),
(9, 59, '17', '5', '240', 'njallikkatile', '7994506504', 0, '2024-10-26 20:24:40', 'pending', 'Paid using Net Banking.'),
(10, 59, '17', '4', '240', 'njallikkatile', '7994506504', 0, '2024-10-26 20:32:41', 'pending', 'Cash on Delivery selected.'),
(11, 59, '17', '10', '240', 'njallikkatile', '7994506504', 0, '2024-10-26 20:40:33', 'pending', 'Cash on Delivery selected.'),
(12, 58, '17', '101', '123', 'njallikkatile', '7994506504', 0, '2024-10-26 22:24:15', 'pending', 'Cash on Delivery selected.'),
(13, 59, '17', '10', '240', 'njallikkatile', '7994506504', 0, '2024-10-26 22:25:10', 'pending', 'Cash on Delivery selected.'),
(14, 59, '11', '2', '240', 'njallikkatile', '7994506504', 0, '2024-10-27 19:21:13', 'pending', 'Cash on Delivery selected.'),
(15, 59, '11', '1', '240', 'njallikkatile', '7994506505', 0, '2024-10-27 19:57:48', 'pending', 'Paid using Net Banking.'),
(16, 59, '11', '1', '240', 'njallikkatile', '7994506505', 0, '2024-10-27 20:09:40', 'pending', 'Cash on Delivery selected.'),
(17, 59, '11', '2', '240', 'njallikkatile', '7994506505', 0, '2024-10-28 19:27:27', 'pending', 'Cash on Delivery selected.');

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `pid` int(100) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `pphoto` varchar(255) NOT NULL,
  `pdescription` varchar(100) NOT NULL,
  `pprice` varchar(100) NOT NULL,
  `current_stock` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`pid`, `pname`, `pphoto`, `pdescription`, `pprice`, `current_stock`) VALUES
(58, 'payasam aluva', '/SweetStream/product/img_671933f12f04f6.74765097.jpg', '123', '123', ''),
(59, 'parippu', '/SweetStream/product/img_671936a3481dd3.10390817.jpg', 'parippu payasam', '240', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `privilege` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `phone_no`, `email`, `password`, `address`, `privilege`) VALUES
(3, 'Gokul krishna jayan', '121221', 'gokuljayan508@gmail.com', '$2y$10$n4sp3Cm9YvWZ4CxKrzyfuu6IY3.FdqrV1mgdr4zfB8FZyJB9Uaxyu', 'njallikkattile house', 'admin'),
(7, 'ginse', '0', 'ginse@gmail.com', '$2y$10$Cj4bKj1ZgYhooryg3i1LFu1jn3JnVxkKfUGlbbXtzNxxWYB2BAYUe', 'swdf', 'delivery'),
(11, 'tony', '7994506505', 'tony@gmail.com', '$2y$10$IRkosU.9PC9MjqO9XQGIh.kaB.MAGumR4Ov2o6paJkCW6C8NJ0h42', 'njallikkatile', 'user'),
(17, 'dragon', '7994506504', 'dragon@gmail.com', '$2y$10$caR95jFsvpYo1gy7j/Vh.uG62mau5RW3pWXmrsFRvQgZ1UVUuFpxK', 'njallikkatile', 'user');

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
  MODIFY `did` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `pid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
