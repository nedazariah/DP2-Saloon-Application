-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2019 at 05:38 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `appointmentService` int(11) NOT NULL,
  `appointmentDate` date NOT NULL,
  `appointmentTime` varchar(10) NOT NULL,
  `appointmentNotes` varchar(50) DEFAULT NULL,
  `appointmentStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `customerType` varchar(50) NOT NULL,
  `customerName` varchar(50) NOT NULL,
  `customerDoB` date DEFAULT NULL,
  `customerGender` char(1) DEFAULT NULL,
  `customerPhone` varchar(11) NOT NULL,
  `customerAddInfo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `customerType`, `customerName`, `customerDoB`, `customerGender`, `customerPhone`, `customerAddInfo`) VALUES
(2001, 'Regular', 'Emma Lee', '1999-03-13', 'F', '111111111', NULL),
(2002, 'Guest', 'Jim Mee', '1988-02-14', 'M', '124578369', 'Prefers male hairdresser'),
(2003, 'Guest', 'Almira Putri Sandy', '2000-01-01', 'F', '12345678', '');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `itemID` int(11) NOT NULL,
  `itemName` varchar(50) NOT NULL,
  `itemDesc` varchar(250) DEFAULT NULL,
  `itemType` varchar(50) DEFAULT NULL,
  `itemBPrice` smallint(6) DEFAULT NULL,
  `itemSPrice` smallint(6) DEFAULT NULL,
  `itemQuantity` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`itemID`, `itemName`, `itemDesc`, `itemType`, `itemBPrice`, `itemSPrice`, `itemQuantity`) VALUES
(1, 'Sunsilk Hair Dye', 'Velvet Red Hair Dye', 'Hair Dye', 20, 25, 10),
(2, 'UBERMAN Hair Gel', 'Superhold gel for short hair', 'Hair Gel', 15, 22, 13);

-- --------------------------------------------------------

--
-- Table structure for table `item_sales`
--

CREATE TABLE `item_sales` (
  `salesID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `serviceID` int(11) NOT NULL,
  `serviceName` varchar(30) NOT NULL,
  `serviceCharge` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`serviceID`, `serviceName`, `serviceCharge`) VALUES
(1, 'Male Haircut', 15),
(2, 'Female Haircut', 20),
(3, 'Hair Dying', 22);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `staffName` varchar(40) NOT NULL,
  `staffDoB` date DEFAULT NULL,
  `staffGender` char(1) DEFAULT NULL,
  `staffPhone` varchar(11) DEFAULT NULL,
  `staffEmail` varchar(40) DEFAULT NULL,
  `staffRole` varchar(20) NOT NULL,
  `staffAddress` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staffName`, `staffDoB`, `staffGender`, `staffPhone`, `staffEmail`, `staffRole`, `staffAddress`) VALUES
(1001, 'John Smith', '1996-04-08', 'M', '123456789', 'jsmith@gmail.com', 'Manager', 'No 08. Highland Drive'),
(1002, 'Jenny Nicole', '1992-01-01', 'F', '1987654321', 'jennynic@yahoo.com', 'Hairdresser', 'Apartment B08'),
(1003, 'Helen Merks', '1994-08-27', 'F', '134567829', 'hmerks@yahoo.com', 'Receptionist', 'Apartment B11');

-- --------------------------------------------------------

--
-- Table structure for table `staff_performance`
--

CREATE TABLE `staff_performance` (
  `performanceID` int(11) NOT NULL,
  `staffID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `userPass` varchar(20) NOT NULL,
  `secQuestion` varchar(250) NOT NULL,
  `secAnswer` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userPass`, `secQuestion`, `secAnswer`) VALUES
(1001, 'jonjon', 'First Pet\'s Name', 'Bobby'),
(1003, 'merks1003', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentID`),
  ADD KEY `appointmentService` (`appointmentService`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `item_sales`
--
ALTER TABLE `item_sales`
  ADD PRIMARY KEY (`salesID`,`itemID`),
  ADD KEY `itemID` (`itemID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`serviceID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`);

--
-- Indexes for table `staff_performance`
--
ALTER TABLE `staff_performance`
  ADD PRIMARY KEY (`performanceID`,`staffID`),
  ADD KEY `staffID` (`staffID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2004;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`appointmentService`) REFERENCES `service` (`serviceID`);

--
-- Constraints for table `item_sales`
--
ALTER TABLE `item_sales`
  ADD CONSTRAINT `item_sales_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `inventory` (`itemID`);

--
-- Constraints for table `staff_performance`
--
ALTER TABLE `staff_performance`
  ADD CONSTRAINT `staff_performance_ibfk_1` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `staff` (`staffID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
