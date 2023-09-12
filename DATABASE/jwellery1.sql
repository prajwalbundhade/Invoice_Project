-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 01:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jwellery1`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `customer_id` int(222) NOT NULL,
  `number` int(11) NOT NULL,
  `name` varchar(222) NOT NULL,
  `date` date NOT NULL,
  `gstin` varchar(222) NOT NULL,
  `address` varchar(222) NOT NULL,
  `state` varchar(222) NOT NULL,
  `shop_address` varchar(222) NOT NULL,
  `description` varchar(222) NOT NULL,
  `karet` varchar(222) NOT NULL,
  `hsncode` varchar(222) NOT NULL,
  `gross_weight1` decimal(10,3) NOT NULL,
  `net_weight` decimal(10,3) NOT NULL,
  `rate` decimal(10,3) NOT NULL,
  `labour_charge` decimal(10,3) NOT NULL,
  `total_amount` decimal(10,3) NOT NULL,
  `sgst_amount` decimal(10,3) NOT NULL,
  `cgst_amount` decimal(10,3) NOT NULL,
  `gst_total` decimal(10,3) NOT NULL,
  `total_amount_after_taxes` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`customer_id`, `number`, `name`, `date`, `gstin`, `address`, `state`, `shop_address`, `description`, `karet`, `hsncode`, `gross_weight1`, `net_weight`, `rate`, `labour_charge`, `total_amount`, `sgst_amount`, `cgst_amount`, `gst_total`, `total_amount_after_taxes`) VALUES
(1, 0, 'Prajwal Bundhade', '2023-09-04', 'PS123', 'Dighi', 'Maharashtra', 'Gadge Nagar, Amravati', 'Gold', '23', '2345', 12.000, 1211.000, 11.000, 11.000, 13332.000, 199.980, 199.980, 399.960, 13731.960);

-- --------------------------------------------------------

--
-- Table structure for table `final_bill`
--

CREATE TABLE `final_bill` (
  `bill_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `sgst_amount` decimal(10,2) DEFAULT NULL,
  `cgst_amount` decimal(10,2) DEFAULT NULL,
  `gst_total` decimal(10,2) DEFAULT NULL,
  `total_amount_after_taxes` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `final_bill`
--

INSERT INTO `final_bill` (`bill_id`, `customer_id`, `total_amount`, `sgst_amount`, `cgst_amount`, `gst_total`, `total_amount_after_taxes`) VALUES
(1, 4, 140.00, 2.10, 2.10, 4.20, 144.20),
(2, 5, 330.00, 4.95, 4.95, 9.90, 339.90),
(3, 6, 110.00, 1.65, 1.65, 3.30, 113.30);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(222) NOT NULL,
  `user_id` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_id`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `new_customer_details`
--

CREATE TABLE `new_customer_details` (
  `customer_id` int(11) NOT NULL,
  `shop_address` varchar(255) DEFAULT NULL,
  `gstin` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_customer_details`
--

INSERT INTO `new_customer_details` (`customer_id`, `shop_address`, `gstin`, `date`, `name`, `address`, `state`) VALUES
(4, 'Gadge Nagar, Amravati', 'PS123', '2023-09-11', 'Prajwal Bundhade', 'Hollywood colony', 'MAHARASHTRA'),
(5, 'Gadge Nagar, Amravati', '45678', '2023-09-06', 'Prasad Bhau', 'Dighi', 'Maharashtra'),
(6, 'Gadge Nagar, Amravati', 'PS123', '0000-00-00', 'Rushikesh Shirke', 'Gopal Nagar', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `karet` varchar(255) DEFAULT NULL,
  `hsncode` varchar(255) DEFAULT NULL,
  `gross_weight` decimal(10,8) DEFAULT NULL,
  `net_weight` decimal(10,6) DEFAULT NULL,
  `rate` decimal(10,6) DEFAULT NULL,
  `labour_charge` decimal(10,7) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`product_id`, `customer_id`, `description`, `karet`, `hsncode`, `gross_weight`, `net_weight`, `rate`, `labour_charge`, `total_amount`) VALUES
(1, 4, 'gold', '23', '234', 12.00000000, 10.000000, 10.000000, 10.0000000, 110.00),
(2, 4, 'silver', '23', '234', 10.00000000, 5.000000, 5.000000, 5.0000000, 30.00),
(3, 5, 'gold', '23', '234', 12.00000000, 10.000000, 10.000000, 10.0000000, 110.00),
(4, 5, 'gold', '23', 'r', 12.00000000, 10.000000, 10.000000, 10.0000000, 110.00),
(5, 5, 'gold', '23', 'r', 12.00000000, 10.000000, 10.000000, 10.0000000, 110.00),
(6, 6, 'gold', '23', '234', 12.00000000, 10.000000, 10.000000, 10.0000000, 110.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `final_bill`
--
ALTER TABLE `final_bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `new_customer_details`
--
ALTER TABLE `new_customer_details`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `final_bill`
--
ALTER TABLE `final_bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `new_customer_details`
--
ALTER TABLE `new_customer_details`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `final_bill`
--
ALTER TABLE `final_bill`
  ADD CONSTRAINT `final_bill_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `new_customer_details` (`customer_id`);

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `new_customer_details` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
