-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 07:02 AM
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
-- Database: `ice`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Name`, `Address`) VALUES
(1, 'Siwakorn', 'bankkok'),
(2, 'Tanwa', 'sea');

-- --------------------------------------------------------

--
-- Table structure for table `flavor`
--

CREATE TABLE `flavor` (
  `FlavorID` int(11) NOT NULL,
  `FlavorName` varchar(255) DEFAULT NULL,
  `Flavorimage` varchar(255) DEFAULT NULL,
  `Flavorprice` int(11) DEFAULT NULL,
  `MenuID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flavor`
--

INSERT INTO `flavor` (`FlavorID`, `FlavorName`, `Flavorimage`, `Flavorprice`, `MenuID`) VALUES
(1, 'สตอเบอรรี่', NULL, 20, 1),
(3, 'ช็อคโกแลต', 'chok.jpg', 20, 2),
(4, 'บูลเบอรี่', 'download.jpg', 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `MenuID` int(11) NOT NULL,
  `MenuName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`MenuID`, `MenuName`) VALUES
(1, 'ถ้วย'),
(2, 'โคน');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `OrderID` int(11) NOT NULL,
  `FlavorID` int(11) DEFAULT NULL,
  `Orderquantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`OrderID`, `FlavorID`, `Orderquantity`) VALUES
(1, 3, 2),
(2, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_ice`
--

CREATE TABLE `order_ice` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `Orderdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_ice`
--

INSERT INTO `order_ice` (`OrderID`, `CustomerID`, `Orderdate`) VALUES
(1, 1, '2024-02-22'),
(2, 2, '2024-02-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `flavor`
--
ALTER TABLE `flavor`
  ADD PRIMARY KEY (`FlavorID`),
  ADD KEY `MenuID` (`MenuID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`MenuID`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FlavorID` (`FlavorID`);

--
-- Indexes for table `order_ice`
--
ALTER TABLE `order_ice`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `flavor`
--
ALTER TABLE `flavor`
  MODIFY `FlavorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_ice`
--
ALTER TABLE `order_ice`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flavor`
--
ALTER TABLE `flavor`
  ADD CONSTRAINT `flavor_ibfk_1` FOREIGN KEY (`MenuID`) REFERENCES `menu` (`MenuID`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `order_ice` (`OrderID`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`FlavorID`) REFERENCES `flavor` (`FlavorID`) ON DELETE CASCADE;

--
-- Constraints for table `order_ice`
--
ALTER TABLE `order_ice`
  ADD CONSTRAINT `order_ice_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
