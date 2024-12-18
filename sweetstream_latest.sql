-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 09:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `cart_table`
--

CREATE TABLE `cart_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_table`
--

INSERT INTO `cart_table` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(29, 16, 58, 3),
(30, 16, 59, 4);

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
  `deliveryperson_id` varchar(100) NOT NULL,
  `delivery_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL,
  `payment_details` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `delivery_dispacted_time` datetime DEFAULT NULL,
  `delivery_delivered_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_table`
--

INSERT INTO `delivery_table` (`did`, `product_id`, `user_id`, `product_quantity`, `price`, `address`, `phone_no`, `deliveryperson_id`, `delivery_date_time`, `status`, `payment_details`, `payment_status`, `delivery_dispacted_time`, `delivery_delivered_time`) VALUES
(23, 62, '11', '1', '123', 'njallikkatt', '7994506507', '11', '2024-11-02 12:04:39', 'Order Dispatched', 'Cash on Delivery.', 'paid', '2024-11-06 18:51:50', NULL),
(24, 63, '11', '1', '133', 'njallikkatt', '7994506507', '11', '2024-11-02 12:04:39', 'Order Dispatched', 'Cash on Delivery.', '', '2024-11-06 18:51:50', NULL),
(25, 64, '11', '1', '234', 'njallikkatt', '7994506507', '11', '2024-11-02 12:04:39', 'Order Dispatched', 'Cash on Delivery.', '', '2024-11-06 18:51:50', NULL),
(26, 63, '11', '1', '133', 'njallikkatt', '7994506507', '11', '2024-11-06 10:28:58', 'Order Dispatched', 'Cash on Delivery.', '', '2024-11-07 00:28:53', NULL),
(27, 62, '11', '2', '123', 'njallikkatt', '7994506507', '11', '2024-11-06 10:28:58', 'Order Dispatched', 'Cash on Delivery.', '', '2024-11-07 00:28:53', NULL),
(28, 63, '11', '1', '133', 'njallikkatt', '7994506507', '11', '2024-11-07 12:33:07', 'Order Dispatched', 'Paid using Net Banking.', '', '2024-11-07 00:33:19', NULL),
(29, 64, '11', '1', '234', 'njallikkatt', '7994506507', '11', '2024-11-07 12:39:24', 'Order Dispatched', 'Cash on Delivery.', '', '2024-11-07 00:39:55', NULL),
(30, 64, '11', '1', '234', 'njallikkatt', '7994506507', '11', '2024-11-07 12:46:35', 'Order Dispatched', 'Cash on Delivery.', '', '2024-11-07 00:46:43', NULL),
(31, 63, '11', '1', '133', 'njallikkatt', '7994506507', '11', '2024-11-07 12:48:30', 'Order Dispatched', 'Cash on Delivery.', '', '2024-11-07 00:48:40', NULL),
(32, 64, '11', '1', '234', 'njallikkatt', '7994506507', '11', '2024-11-07 12:50:13', 'Order Dispatched', 'Paid using UPI.', '', '2024-11-07 00:50:20', NULL),
(33, 63, '18', '1', '133', 'njallikkatile', '7994506507', '7', '2024-11-07 10:45:02', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 00:40:00', '2024-11-12 00:40:00'),
(34, 64, '18', '1', '234', 'njallikkatile', '7994506507', '7', '2024-11-07 11:17:29', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 01:51:01', '2024-11-12 01:51:01'),
(35, 62, '18', '2', '123', 'njallikkatile', '7994506507', '7', '2024-11-07 11:34:53', 'Delivered', 'Paid using Net Banking.', 'paid', '2024-11-11 23:05:58', '2024-11-11 23:05:58'),
(36, 63, '18', '2', '133', 'njallikkatile', '7994506507', '7', '2024-11-07 11:34:53', 'Delivered', 'Paid using Net Banking.', '', '2024-11-11 23:06:06', '2024-11-11 23:06:06'),
(37, 63, '19', '1', '133', 'njallikkatile', '7994506507', '7', '2024-11-07 11:47:51', 'Delivered', 'Cash on Delivery.', 'not paid', '2024-11-11 23:05:41', '2024-11-11 23:05:41'),
(38, 63, '11', '1', '133', 'njallikkatt', '7994506507', '7', '2024-11-12 12:01:46', 'Delivered', 'Paid using Net Banking.', '', '2024-11-12 01:04:07', '2024-11-12 01:04:07'),
(39, 64, '11', '12', '234', 'njallikkatt', '7994506507', '7', '2024-11-12 01:10:25', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 01:12:25', '2024-11-12 01:12:25'),
(40, 63, '11', '20', '133', 'njallikkatt', '7994506507', '7', '2024-11-12 01:14:26', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 01:15:01', '2024-11-12 01:15:01'),
(41, 63, '11', '12', '133', 'njallikkatt', '7994506507', '7', '2024-11-12 01:16:00', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 01:22:43', '2024-11-12 01:22:43'),
(42, 62, '11', '20', '123', 'njallikkatt', '7994506507', '7', '2024-11-12 01:16:00', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 01:22:43', '2024-11-12 01:22:43'),
(43, 63, '11', '1', '133', 'njallikkatt', '7994506507', '7', '2024-11-12 01:34:18', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 01:34:49', '2024-11-12 01:34:49'),
(44, 62, '11', '1', '123', 'njallikkatt', '7994506507', '7', '2024-11-12 01:34:18', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 01:34:49', '2024-11-12 01:34:49'),
(45, 64, '18', '1', '234', 'njallikkatile', '7994506507', '7', '2024-11-12 01:46:05', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 01:53:49', '2024-11-12 01:53:49'),
(46, 63, '18', '1', '133', 'njallikkatile', '7994506507', '7', '2024-11-12 01:54:09', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 01:55:05', '2024-11-12 01:55:05'),
(47, 64, '18', '1', '234', 'njallikkatile', '7994506507', '7', '2024-11-12 02:05:43', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 02:16:32', '2024-11-12 02:16:32'),
(48, 63, '18', '1', '133', 'njallikkatile', '7994506507', '7', '2024-11-12 02:28:42', 'Delivered', 'Paid using UPI.', '', '2024-11-12 02:30:36', '2024-11-12 02:30:36'),
(49, 63, '18', '2', '133', 'njallikkatile', '7994506507', '20', '2024-11-12 02:40:01', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 02:41:04', '2024-11-12 02:41:04'),
(50, 62, '18', '4', '123', 'njallikkatile', '7994506507', '20', '2024-11-12 02:40:01', 'Delivered', 'Cash on Delivery.', '', '2024-11-12 02:41:04', '2024-11-12 02:41:04'),
(51, 63, '11', '1', '133', 'njallikkatt', '7994506507', '7', '2024-11-13 02:07:35', 'Delivered', 'Cash on Delivery.', '', '2024-11-13 02:08:31', '2024-11-13 02:08:31'),
(52, 66, '11', '1', '240', 'njallikkatt', '7994506507', '7', '2024-11-13 01:58:26', 'Delivered', 'Paid using UPI.', '', '2024-11-13 13:59:08', '2024-11-13 13:59:08'),
(53, 66, '21', '4', '240', 'kakkanaad', '7894561230', '7', '2024-11-13 02:14:20', 'Delivered', 'Paid using Net Banking.', '', '2024-11-13 14:16:39', '2024-11-13 14:16:39');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`pid`, `pname`, `pphoto`, `pdescription`, `pprice`, `current_stock`) VALUES
(65, 'palada', '/SweetStream/product/img_67344591e28b03.33040936.jpg', 'Palada Payasam is a rich and creamy traditional Indian dessert that’s a favorite during festivals an', '240', ''),
(66, 'parippu', '/SweetStream/product/img_673446289b5ff9.10663818.jpg', 'Parippu Payasam is a comforting and delicious sweet dish made with moong dal (yellow lentils), jagge', '240', ''),
(67, 'gothambu payasam', '/SweetStream/product/img_673447a943e294.74967029.png', 'Gothambu Payasam is a delicious and nutritious Kerala dessert made from cracked wheat (gothambu), ja', '250', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `phone_no`, `email`, `password`, `address`, `privilege`) VALUES
(3, 'Gokul krishna jayan', '121221', 'gokuljayan508@gmail.com', '$2y$10$n4sp3Cm9YvWZ4CxKrzyfuu6IY3.FdqrV1mgdr4zfB8FZyJB9Uaxyu', 'njallikkattile house', 'admin'),
(7, 'ginse', '0', 'ginse@gmail.com', '$2y$10$Cj4bKj1ZgYhooryg3i1LFu1jn3JnVxkKfUGlbbXtzNxxWYB2BAYUe', 'swdf', 'delivery'),
(11, 'tony', '7994506507', 'tony@gmail.com', '$2y$10$IRkosU.9PC9MjqO9XQGIh.kaB.MAGumR4Ov2o6paJkCW6C8NJ0h42', 'njallikkatt', 'user'),
(18, 'blesson', '7994506507', 'blesson@gmail.com', '$2y$10$v3qsYjC0gGx5l/XloHJHJ.JIMrk4MIhvDZoZawer8295hVeswG0x6', 'njallikkatile', 'user'),
(19, 'dragon', '7994506507', 'dragon@gmail.com', '$2y$10$NC1po2YZl0dx07n6An.BFu1W2/xO4GSfhy1D7JBjhPz.ED/hsFcnu', 'njallikkatile', 'user'),
(21, 'jacob', '7894561230', 'jacob@gmail.com', '$2y$10$UgTeNM/P4wWr4r7nTe/4..sgUBCfuz5NpewefX/xkyhwJKjFR0lZe', 'kakkanaad', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_table`
--
ALTER TABLE `cart_table`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cart_table`
--
ALTER TABLE `cart_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `delivery_table`
--
ALTER TABLE `delivery_table`
  MODIFY `did` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `pid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
