-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 08:19 PM
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
-- Database: `3motorinv`
--
CREATE DATABASE IF NOT EXISTS `railway`;
USE `railway`;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `Branch_ID` int(11) NOT NULL,
  `Address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`Branch_ID`, `Address`) VALUES
(3, 'Bansalan Davao Del Sur'),
(1, 'Digos City, Bus Terminal'),
(2, 'Digos City, Davao Cotabato Road');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(11) NOT NULL,
  `Category_Type` varchar(115) NOT NULL,
  `Category_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Category_Type`, `Category_Name`) VALUES
(1, 'Motor Parts', 'Engine Parts'),
(2, 'Motor Parts', 'Suspension'),
(3, 'Motor Parts', 'Brake Components'),
(4, 'Motor Parts', 'Electrical Systems'),
(5, 'Motor Parts', 'Transmission'),
(7, 'Accessories', 'Colored Headlight');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `Inventory_ID` int(11) NOT NULL,
  `Branch_ID` int(11) DEFAULT NULL,
  `Item_ID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`Inventory_ID`, `Branch_ID`, `Item_ID`, `Quantity`) VALUES
(2, 1, 2, 30),
(3, 2, 3, 15),
(4, 3, 4, 8),
(5, 2, 5, 5),
(6, 1, 6, 12),
(7, 1, 7, 31),
(8, 1, 8, 15),
(9, 1, 9, 10),
(10, 1, 10, 100),
(12, 1, 12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `Item_ID` int(11) NOT NULL,
  `Item_Name` varchar(255) NOT NULL,
  `Brand` varchar(115) NOT NULL,
  `Description` text DEFAULT NULL,
  `Unit_Price` decimal(10,2) NOT NULL,
  `Supplier` varchar(115) NOT NULL,
  `Updated_At` datetime DEFAULT current_timestamp(),
  `Category_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`Item_ID`, `Item_Name`, `Brand`, `Description`, `Unit_Price`, `Supplier`, `Updated_At`, `Category_ID`) VALUES
(2, 'Alternator', 'Allison', '120-amp alternator for 12V electrical systems, fits most modern sedans and SUVs.\r\nUnit Price: $120.00', 40000.00, 'Summit Racing Equipment', '2024-11-30 01:36:38', 1),
(3, 'Oil Filter', 'Bosch', 'Efficient oil filtration for extended engine life.', 3500.00, '	EnginePro Supplies', '2024-11-30 01:52:37', 1),
(4, 'Drive Shaft', 'GKN Driveline', 'Robust drive shaft for efficient power transfer.', 7000.00, 'PowerTrans Parts Ltd.', '2024-11-30 01:54:09', 1),
(5, 'Clutch Plate', 'Exedy', 'Double-door refrigerator', 25000.00, 'TransmissionPros Ltd.', '2024-11-30 01:53:30', 5),
(6, 'Brake Rotor', 'TRW Automotive', 'Vented cast-iron brake rotor for front wheels, designed for performance and heat dissipation', 20000.00, 'AutoZone', '2024-11-30 01:37:08', 1),
(7, 'Motor Engine ', 'Mahle', 'V6 Blue', 25000.00, 'JEGS High Performance', '2024-11-30 01:36:51', 1),
(8, 'Engine Cylinder Head', 'Denso', 'High Performance Cylinder Head', 15000.00, 'RockAuto', '2024-11-30 01:37:33', 1),
(9, 'GearBox', 'BorgWarner', '6-speed manual transmission for sport cars', 35000.00, 'Radiator Supply House', '2024-11-30 01:38:10', 4),
(10, 'Disc Brake Pads', 'Akebono', 'Set of front disc brake pads for sedans.', 1800.00, 'EBC Brakes Direct', '2024-11-30 01:38:35', 1),
(12, 'RockShox Yari', 'RockShox', 'Versatile mid-range fork with motion control damping.', 499.99, 'SRAM Corporation', '2024-11-30 01:38:48', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales_data`
--

CREATE TABLE `sales_data` (
  `sale_id` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `quantity_sold` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_data`
--

INSERT INTO `sales_data` (`sale_id`, `sale_date`, `category`, `branch`, `quantity_sold`, `created_at`, `updated_at`) VALUES
(1, '2024-07-18', 'accessories', 'main', 21, '2024-11-29 02:02:04', '2024-11-29 02:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `Transfer_ID` int(11) NOT NULL,
  `Item_ID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Transfer_From` varchar(115) DEFAULT NULL,
  `Transfer_To` varchar(115) DEFAULT NULL,
  `Status` varchar(115) DEFAULT NULL,
  `Deliver_Date` date NOT NULL DEFAULT '2024-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`Transfer_ID`, `Item_ID`, `Quantity`, `Transfer_From`, `Transfer_To`, `Status`, `Deliver_Date`) VALUES
(3, 3, 3, 'Branch 2', 'Branch 1', 'Delivered', '2024-01-01'),
(4, 4, 7, 'Branch 2', 'Branch 1', 'Completed', '2024-01-01'),
(5, 5, 2, 'Branch 3', 'Branch 1', 'Pending', '2024-01-01'),
(10, 5, 12, 'Branch 1', 'Main Branch', 'Delivered', '2024-12-01'),
(12, 5, 15, 'Branch 2', 'Branch 1', 'Pending', '2024-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `Username` varchar(115) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(115) DEFAULT NULL,
  `Role` enum('Admin','Manager','Staff') NOT NULL,
  `Branch` enum('Digos City, Bus Terminal','Digos City, Davao Cotabato Road','Bansalan Davao Del Sur') DEFAULT NULL,
  `Updated_At` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `FName`, `LName`, `Username`, `Password`, `Email`, `Phone`, `Role`, `Branch`, `Updated_At`) VALUES
(10, 'Abaten', 'Abaten', 'abaten123', '$2y$10$WTJNfZh0uWR.zf6JxCJfOOmpGz0aaPNud.HmO6TMb60V71/P27G9W', 'abaten123@gmail.com', '09120969545', 'Staff', 'Digos City, Davao Cotabato Road', '2024-11-24 00:52:10'),
(11, 'jomar', 'jomar', 'kradz120', '$2y$10$79Jgt3OuOGNyuT0wUmkmyuLb9KAqgMICxT4PQbGoesfLaVff/xRvC', 'kradz120@gmail.com', '09970867741', 'Admin', 'Digos City, Davao Cotabato Road', '2024-11-27 03:15:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`Branch_ID`),
  ADD UNIQUE KEY `Address` (`Address`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`Inventory_ID`),
  ADD KEY `Branch_ID` (`Branch_ID`),
  ADD KEY `Item_ID` (`Item_ID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `Category_ID` (`Category_ID`);

--
-- Indexes for table `sales_data`
--
ALTER TABLE `sales_data`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`Transfer_ID`),
  ADD KEY `Item_ID` (`Item_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Email` (`Email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `Branch_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `Inventory_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sales_data`
--
ALTER TABLE `sales_data`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `Transfer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`Branch_ID`) REFERENCES `branch` (`Branch_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`Item_ID`) REFERENCES `item` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `transfer_ibfk_1` FOREIGN KEY (`Item_ID`) REFERENCES `item` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
