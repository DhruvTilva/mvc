-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2023 at 08:38 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-dhruv-tilva`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin0000@gmail.com', '1234', 1, '2023-03-29 13:51:03', '2023-03-29 10:20:42'),
(2, '12@gmail.com', '1234', 1, '2023-03-30 09:51:22', '2023-03-30 06:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `shipping_amount` int(25) NOT NULL,
  `tax_percentage` int(25) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `shipping_id`, `shipping_amount`, `tax_percentage`, `created_date`) VALUES
(1, 78, 100, 5, '2023-03-14 10:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cost` int(25) NOT NULL,
  `price` int(25) NOT NULL,
  `quantity` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`cart_item_id`, `product_id`, `cost`, `price`, `quantity`) VALUES
(1, 3, 130000, 100000, 12),
(2, 3, 130000, 100000, 0),
(3, 3, 130000, 100000, 12),
(4, 7, 23343, 13000, 343434),
(5, 3, 130000, 100000, 0),
(6, 3, 130000, 100000, 0),
(7, 3, 130000, 100000, 0),
(8, 3, 130000, 100000, 0),
(9, 3, 130000, 100000, 121212),
(10, 3, 130000, 100000, 121212);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `path` varchar(100) NOT NULL,
  `name` varchar(25) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `description` text NOT NULL,
  `inserted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_id`, `path`, `name`, `status`, `description`, `inserted_at`, `updated_at`) VALUES
(2, 6, '', 'electronics', 'active', 'very cheap electronic items', '2023-02-14 12:04:42', '2023-02-14 12:04:42'),
(3, 0, '', 'samsung f23 5g 6gb', 'active', 'budget phone', '2023-02-14 12:04:42', '2023-02-14 12:04:42'),
(5, 0, '', 'hhgh', 'active', 'erer', '2023-03-27 11:24:35', '2023-03-27 11:24:35'),
(6, 0, '', 'ssssss', 'active', 'dddd', '2023-03-31 14:17:24', '2023-03-31 14:17:24'),
(7, 0, '', 'sssss', 'active', '', '2023-03-31 14:48:56', '2023-03-31 14:48:56'),
(8, 0, '', 'eeeeeeeeee', 'active', 'wwwwwwwww', '2023-03-31 14:49:07', '2023-03-31 14:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `mobile` int(10) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `inserted_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `firstname`, `lastname`, `email`, `gender`, `mobile`, `status`, `inserted_at`, `updated_at`) VALUES
(1, 'aaa', 'SND', 'aa@gmail.com', 'M', 121, 1, '2023-03-02 14:06:11', '2023-03-02 04:07:35'),
(2, 'bhide', 'atmara', 'bhide@gmail.com', 'M', 2147483647, 1, '2023-03-02 14:11:40', '2023-03-02 14:11:40'),
(3, 'edcv', 'cdsx', '', NULL, 0, 1, '2023-03-23 22:41:24', '2023-03-23 22:41:24'),
(6, '', '', '', NULL, 0, 1, '2023-03-23 22:49:07', '2023-03-23 22:49:07'),
(79, 'ssws', 'ssss', '', NULL, 0, 1, '2023-03-28 11:22:40', '2023-03-28 11:22:40'),
(101, 'qq', 'www', 'aa@gmail.com', NULL, 0, 1, '2023-03-28 11:25:07', '2023-03-28 11:25:07'),
(124, 'wwwwwwwwwww', 'wwwwwwwwwwwww', 'ww@gmail.com', 'M', 2147483647, 1, '2023-04-02 12:24:15', '2023-04-02 12:24:15'),
(125, 'sw', 'sss', '', 'M', 0, 0, '2023-04-02 12:33:23', '2023-04-02 12:33:23'),
(126, 'frfrf', '', '', NULL, 0, 0, '2023-04-02 12:50:51', '2023-04-02 12:50:51'),
(127, 'sss', 'ssssssssssssssssssss', 's@gmail.com', 'M', 34, 0, '2023-04-02 12:52:00', '2023-04-02 12:52:00'),
(128, 'ff', 'f', 'f@gmail.com', NULL, 0, 0, '2023-04-02 13:14:40', '2023-04-02 13:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `zipcode` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `customer_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES
(2, 2, 'gokuldham socaity, powder gali goregav', 'mumba', 'maharastra', 'india', 0),
(3, 3, '', '', '', '', 0),
(100, 79, 'wwww', '', '', '', 0),
(101, 101, 'ds', '', '', '', 0),
(110, 124, 'ttttttttttt', 'ttttttttt', 'tttttt', 'tttttttt', 44444444),
(111, 125, 'sw', '', '', '', 0),
(112, 127, 'sssssssss', 'sssssssssssssssss', 'ssssssssssssssssssssss', 'sssssssssssssssssssssssss', 2147483647),
(113, 128, 'f', 'f', 'f', 'f', 0);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `small` varchar(60) NOT NULL,
  `base` varchar(60) NOT NULL,
  `thumbnail` varchar(60) NOT NULL,
  `gallary` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `filename`, `name`, `small`, `base`, `thumbnail`, `gallary`, `created_at`) VALUES
(2, 'images.jpeg', 'quote', '', '', '', '', '2023-02-14 06:08:10'),
(7, '1504623.jpg', 'worke harder', 'on', '', '', '', '2023-02-14 06:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `amount` int(15) NOT NULL,
  `inserted_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `name`, `status`, `amount`, `inserted_at`, `updated_at`) VALUES
(2, 'serbia', 1, 233, '0000-00-00 00:00:00', '2023-03-13 11:24:26'),
(3, 'cybercom creation', 1, 450000, '2023-02-14 12:05:48', '2023-03-13 11:39:35'),
(7, 'samsung f23 5g', 1, 1212121, '2023-02-14 12:05:48', '2023-02-14 12:05:48'),
(88, 'foreign client us', 1, 121212, '2023-03-13 23:04:07', '2023-03-13 11:24:37'),
(111, 'qweee', 2, 0, '2023-03-14 10:44:32', '2023-03-14 10:44:32'),
(112, 'as', 1, 909090, '2023-03-28 10:56:58', '2023-03-28 10:56:58'),
(113, 'dd', 1, 200, '2023-03-29 11:53:12', '2023-03-29 11:53:12');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `sku` int(25) NOT NULL,
  `cost` int(25) NOT NULL,
  `price` int(25) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `color` varchar(10) NOT NULL,
  `material` varchar(25) NOT NULL,
  `inserted_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `sku`, `cost`, `price`, `description`, `status`, `color`, `material`, `inserted_at`, `updated_at`) VALUES
(1, 'iphone 13', 12, 20000, 230000, 'good features and high end secured phone \r\n', 0, 'polar whit', 'metal', '2023-03-16 14:55:07', '2023-03-16 14:55:07'),
(2, 'samsung s22', 12, 80000, 75000, 'old and trusted comapny\r\n', 1, 'black', 'plastic', '2023-03-16 14:56:24', '2023-03-16 14:56:24'),
(74, 'My First Programm', 9090909, 909009000, 2147483647, 'hello world 123456\r\n\r\n\r\n\r\n', 0, '', 'plastic', '2023-03-28 10:23:48', '2023-03-28 10:23:48'),
(77, 'india', 0, 0, 0, 'Hindustan', 1, 'Tiranga', '', '2023-03-28 13:50:41', '2023-03-28 13:50:41'),
(78, '123', 0, 0, 0, 'frrrrrrrr', 1, '', '', '2023-03-29 10:24:14', '2023-03-29 10:24:14'),
(79, 'eeeee', 0, 0, 0, 'eeddd', 1, '', '', '2023-03-29 10:37:01', '2023-03-29 10:37:01'),
(81, 'it', 0, 0, 0, 'eded', 1, '', '', '2023-03-30 13:37:11', '2023-03-31 06:44:15'),
(93, 'ppppppppppp', 0, 0, 0, '', 0, '', '', '2023-03-31 15:04:36', '2023-03-31 15:04:36'),
(95, 'gggggggg', 0, 0, 0, 'tttttt', 2, '', '', '2023-03-31 15:06:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `product_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumbnail` tinyint(4) NOT NULL,
  `small` tinyint(4) NOT NULL,
  `base` tinyint(4) NOT NULL,
  `gallery` tinyint(4) NOT NULL,
  `del` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`product_id`, `image_id`, `name`, `image`, `thumbnail`, `small`, `base`, `gallery`, `del`, `created_at`) VALUES
(1, 18, 'iphone', '18.jpeg', 0, 0, 0, 0, '', '2023-03-22 10:31:55'),
(2, 21, 'samsung f23 5g', '21.jpg', 0, 0, 0, 0, '', '2023-03-27 10:50:37'),
(2, 22, 'work harder', '22.jpg', 0, 0, 0, 0, '', '2023-03-27 10:52:18'),
(2, 23, 'Bed', '23.png', 0, 0, 0, 0, '', '2023-03-27 10:53:28'),
(1, 27, 'fffff', '27.png', 0, 0, 0, 0, '', '2023-03-27 10:56:46'),
(1, 28, 'aa', '28.png', 0, 0, 0, 0, '', '2023-03-28 09:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesman_id` int(11) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(15) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `mobile` int(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(35) NOT NULL,
  `inserted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesman_id`, `firstname`, `lastname`, `email`, `gender`, `mobile`, `status`, `company`, `inserted_at`, `updated_at`) VALUES
(4, 'Salesman1', '', '', '', 0, 1, '', '0000-00-00 00:00:00', '2023-03-18 12:50:10'),
(5, 'Salesman2', '', '', '', 0, 1, '', '0000-00-00 00:00:00', '2023-03-18 12:50:22'),
(6, 'Salesman3', '', '', '', 0, 1, '', '2023-03-29 10:57:08', '2023-03-29 10:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `salesman_address`
--

CREATE TABLE `salesman_address` (
  `address_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `zipcode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman_address`
--

INSERT INTO `salesman_address` (`address_id`, `salesman_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES
(4, 4, 'qq', '', '', '', ''),
(5, 5, '', '', '', '', ''),
(6, 6, 'hhihiihih', 'hihih', 'hihih', 'hihi', '909');

-- --------------------------------------------------------

--
-- Table structure for table `salesman_price`
--

CREATE TABLE `salesman_price` (
  `entity_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `salesman_price` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman_price`
--

INSERT INTO `salesman_price` (`entity_id`, `salesman_id`, `product_id`, `salesman_price`) VALUES
(44, 4, 1, 19898989),
(45, 4, 2, 5400),
(48, 5, 1, 12),
(49, 5, 2, 15),
(52, 4, 74, 0),
(54, 4, 77, 1000),
(55, 4, 78, 0),
(56, 4, 79, 0),
(57, 4, 81, 0),
(60, 4, 93, 0),
(62, 4, 95, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `amount` int(25) NOT NULL,
  `status` enum('1','2') NOT NULL,
  `inserted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `name`, `amount`, `status`, `inserted_at`, `updated_at`) VALUES
(5, 'pipavav port rajula', 2000000, '1', '2023-02-14 12:06:52', '2023-02-14 12:06:52'),
(6, 'adani port', 2000000, '1', '2023-02-14 12:06:52', '2023-02-14 12:06:52'),
(78, 'Relience port', 23456, '1', '2023-03-13 23:34:38', '2023-03-13 23:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `tesing_table`
--

CREATE TABLE `tesing_table` (
  `person_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `age` int(11) NOT NULL,
  `tech` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tesing_table`
--

INSERT INTO `tesing_table` (`person_id`, `name`, `age`, `tech`) VALUES
(1, 'dhruv', 21, 'abc'),
(2, 'ccc', 45, 'gtgtgt'),
(3, 'pipavav port', 21, 'hcl');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `mail` varchar(20) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `no` int(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(35) NOT NULL,
  `inserted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `firstname`, `lastname`, `mail`, `gender`, `no`, `status`, `company`, `inserted_at`, `updated_at`) VALUES
(1, 'atmaram', 'bhide', '123de@gmail.com', 'M', 43434343, 1, 'private corporation', '2023-03-18 12:40:57', '2023-03-18 12:40:57'),
(4, 'rtrt', 'qqqqqqqqqqqqqqqqqqqqqqqqq', '', 'M', 0, 1, 'goverment', '2023-03-23 22:53:41', '2023-03-23 22:53:41'),
(5, 'aaaaaaaaaaaaaaa', 'aaaaaaa', '', 'M', 0, 1, '', '2023-03-27 13:52:14', '2023-03-27 13:52:14'),
(6, 'cccccx', 'sss', 'w@gmail.com', 'M', 90, 0, '', '2023-03-27 14:09:25', '2023-03-27 14:09:25'),
(11, 'qqqqqqqqqqqqqqqqqq', 'qqqqqqqqqqqqqqqqqqqqq', 'qww@gmail.com', 'M', 434, 0, 'qqq', '2023-04-02 13:13:20', '2023-04-02 13:13:20'),
(12, 'q', 't', 't@gmail.com', 'M', 0, 0, 't', '2023-04-02 13:14:08', '2023-04-02 13:14:08'),
(13, 'w', 'w', 'w@gmail.com', 'M', 0, 0, 'w', '2023-04-02 13:18:12', '2023-04-02 13:18:12'),
(14, 'w', 'w', 'w@gmail.com', 'M', 0, 0, 'w', '2023-04-02 13:30:51', '2023-04-02 13:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `address_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `zipcode` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`address_id`, `vendor_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES
(1, 1, 'gokuldham', 'mumbai', 'maharastr', 'india', 18990),
(4, 4, 'yytyt', '', '', '', 0),
(13, 5, 'aaaaaaa', 'aaaaaaaaa', '', '', 0),
(14, 6, 'sdsd', 'rrrr', '', '', 0),
(19, 14, 'w', 'w', 'w', 'w', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `shipping_id` (`shipping_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_address_ibfk_1` (`customer_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesman_id`);

--
-- Indexes for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `salesman_address_ibfk_1` (`salesman_id`);

--
-- Indexes for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `tesing_table`
--
ALTER TABLE `tesing_table`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `vendor_address_ibfk_1` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `salesman_address`
--
ALTER TABLE `salesman_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `salesman_price`
--
ALTER TABLE `salesman_price`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tesing_table`
--
ALTER TABLE `tesing_table`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart_item` (`cart_item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`shipping_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD CONSTRAINT `salesman_address_ibfk_1` FOREIGN KEY (`salesman_id`) REFERENCES `salesman` (`salesman_id`) ON DELETE CASCADE;

--
-- Constraints for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD CONSTRAINT `salesman_price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salesman_price_ibfk_2` FOREIGN KEY (`salesman_id`) REFERENCES `salesman` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
