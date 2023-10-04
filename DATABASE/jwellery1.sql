-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2023 at 06:46 PM
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
(5, 8, 378.00, 5.67, 5.67, 11.34, 389.34),
(6, 9, 215.00, 3.23, 3.23, 6.45, 221.45);

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
(8, 'Gadge Nagar, Amravati', '123Rushi', '2023-09-13', 'Rushi Shirke', 'Gopal nagar', 'MH'),
(9, 'Gadge Nagar, Amravati', 'PS123', '2023-09-13', 'Prajwal B', 'Dighi', 'Maharashtra');

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
  `gross_weight` decimal(10,2) DEFAULT NULL,
  `net_weight` decimal(10,2) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `labour_charge` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`product_id`, `customer_id`, `description`, `karet`, `hsncode`, `gross_weight`, `net_weight`, `rate`, `labour_charge`, `total_amount`) VALUES
(11, 8, 'Gold', '24', '234', 12.00, 10.00, 10.00, 10.00, 110.00),
(12, 8, 'Silver', '24', '234', 10.00, 8.00, 10.00, 10.00, 90.00),
(13, 8, 'Ring', '18', '234', 15.00, 14.00, 12.00, 10.00, 178.00),
(14, 9, 'Ring', '23', '11234', 12.00, 11.00, 11.00, 1.00, 122.00),
(15, 9, 'Chain', '23', '11234', 12.00, 9.00, 10.00, 3.00, 93.00);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `final_bill`
--
ALTER TABLE `final_bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `new_customer_details`
--
ALTER TABLE `new_customer_details`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
