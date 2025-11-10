-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2025 at 09:08 AM
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
-- Database: `global_logistic_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `shipment_details`
--

CREATE TABLE `shipment_details` (
  `ID` int(11) NOT NULL,
  `Full_Name` varchar(100) NOT NULL,
  `Company_Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `Shipment_Type` enum('import','export') NOT NULL,
  `Transport_Mode` enum('Sea Freight','Air Freight','Road Transport') NOT NULL,
  `Origin_Country` varchar(100) NOT NULL,
  `Origin_Port` varchar(100) NOT NULL,
  `Dest_Country` varchar(100) NOT NULL,
  `Dest_Port` varchar(100) NOT NULL,
  `Product_Description` varchar(255) NOT NULL,
  `HS_Code` varchar(20) DEFAULT NULL,
  `Weight` decimal(10,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Dimensions` varchar(50) DEFAULT NULL,
  `Instructions` text DEFAULT NULL,
  `Shipment_Charge` decimal(10,2) DEFAULT 0.00,
  `Shipment_Time` date DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipment_details`
--

INSERT INTO `shipment_details` (`ID`, `Full_Name`, `Company_Name`, `Email`, `Phone`, `Shipment_Type`, `Transport_Mode`, `Origin_Country`, `Origin_Port`, `Dest_Country`, `Dest_Port`, `Product_Description`, `HS_Code`, `Weight`, `Quantity`, `Dimensions`, `Instructions`, `Shipment_Charge`, `Shipment_Time`, `User_ID`) VALUES
(1, 'pritesh godavariya', 'fdfd', 'phrjapatiprtesh@gmail.com', '2323232323', 'import', 'Sea Freight', 'India', 'Canada-Vancouver', 'India', 'Japan-Tokyo', 'fdfd', '566565', 333.00, 33, '33', 'fdfsfdsfddfgfg', 25.50, '2025-11-12', 1),
(2, 'pritesh godavariya', 'ff', 'phrjapatiprtesh@gmail.com', '2323232323', 'import', 'Sea Freight', 'India', 'Uk-Felixstowe', 'India', 'China-Shanghai', '222', '11', 11.00, 11, '11', '11111111111111111111111111111111111', 25.50, '2025-11-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`ID`, `Username`, `Email`, `Password`) VALUES
(1, 'pritesh godavariya', 'p@p.com', '$2y$10$iN.AhPtUrA0F6MlLjuEaf.F6ckM/hsl0Qx/gR6afhUk8MZOL.02WO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shipment_details`
--
ALTER TABLE `shipment_details`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shipment_details`
--
ALTER TABLE `shipment_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shipment_details`
--
ALTER TABLE `shipment_details`
  ADD CONSTRAINT `shipment_details_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user_details` (`ID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
