-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 04, 2023 at 07:14 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TMOLA`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_master`
--

CREATE TABLE `admin_master` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(50) NOT NULL,
  `adminPassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `orderQuantity` varchar(100) NOT NULL,
  `orderTotalpayment` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `categoryId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  `productQuantity` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `discountId` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productPrice` decimal(10,0) NOT NULL,
  `productQuality` varchar(10) NOT NULL,
  `productQuantity` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_payment`
--

CREATE TABLE `product_payment` (
  `paymentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `paymentType` varchar(50) NOT NULL,
  `paymentAccountno` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPassword` varchar(20) NOT NULL,
  `userFname` varchar(100) NOT NULL,
  `userLname` varchar(100) NOT NULL,
  `userTelephone` decimal(11,0) NOT NULL,
  `userAddress` varchar(100) NOT NULL,
  `userCity` varchar(100) NOT NULL,
  `userPostalcode` varchar(7) NOT NULL,
  `userCountry` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_payment`
--

CREATE TABLE `user_payment` (
  `paymentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `paymentAmount` int(11) NOT NULL,
  `paymentStatus` varchar(50) NOT NULL,
  `addedOn` datetime NOT NULL,
  `paymentAccountno` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_master`
--
ALTER TABLE `admin_master`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `p_id` (`productId`),
  ADD KEY `us_id` (`userId`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `po_id` (`productId`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `cat_id` (`categoryId`);

--
-- Indexes for table `product_payment`
--
ALTER TABLE `product_payment`
  ADD PRIMARY KEY (`paymentId`),
  ADD KEY `prod_id` (`productId`),
  ADD KEY `user_id` (`userId`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD PRIMARY KEY (`paymentId`),
  ADD KEY `userid` (`userId`),
  ADD KEY `pro_id` (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_master`
--
ALTER TABLE `admin_master`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_payment`
--
ALTER TABLE `product_payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_payment`
--
ALTER TABLE `user_payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `p_id` FOREIGN KEY (`productId`) REFERENCES `product_master` (`productId`) ON DELETE CASCADE,
  ADD CONSTRAINT `us_id` FOREIGN KEY (`userId`) REFERENCES `user_master` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `po_id` FOREIGN KEY (`productId`) REFERENCES `product_master` (`productId`) ON DELETE CASCADE;

--
-- Constraints for table `product_master`
--
ALTER TABLE `product_master`
  ADD CONSTRAINT `cat_id` FOREIGN KEY (`categoryId`) REFERENCES `product_category` (`categoryId`) ON DELETE CASCADE;

--
-- Constraints for table `product_payment`
--
ALTER TABLE `product_payment`
  ADD CONSTRAINT `prod_id` FOREIGN KEY (`productId`) REFERENCES `product_master` (`productId`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`userId`) REFERENCES `user_master` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD CONSTRAINT `pay_id` FOREIGN KEY (`paymentId`) REFERENCES `product_payment` (`paymentId`) ON DELETE CASCADE,
  ADD CONSTRAINT `pro_id` FOREIGN KEY (`productId`) REFERENCES `product_master` (`productId`) ON DELETE CASCADE,
  ADD CONSTRAINT `userid` FOREIGN KEY (`userId`) REFERENCES `user_master` (`userId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
