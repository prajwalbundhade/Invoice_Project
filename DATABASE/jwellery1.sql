-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2023 at 03:24 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
