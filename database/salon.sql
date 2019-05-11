-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2019 at 05:14 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

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
  `customerName` varchar(50) NOT NULL,
  `customerPhone` varchar(11) NOT NULL,
  `appointmentService` int(11) NOT NULL,
  `appointmentDate` date NOT NULL,
  `appointmentTime` varchar(10) NOT NULL,
  `staffID` int(11) NOT NULL,
  `appointmentNotes` varchar(50) DEFAULT NULL,
  `appointmentStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentID`, `customerID`, `customerName`, `customerPhone`, `appointmentService`, `appointmentDate`, `appointmentTime`, `staffID`, `appointmentNotes`, `appointmentStatus`) VALUES
(1, 2001, 'Emma Lee', '111111111', 2, '2019-05-07', '10:30', 1001, '', '');

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
(2001, 'Regular', 'Emma Lee', '1999-03-13', 'F', '111111111', ''),
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
  `itemID` int(11) NOT NULL,
  `qtyPurchased` int(11) NOT NULL,
  `datePurchased` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_sales`
--

INSERT INTO `item_sales` (`salesID`, `itemID`, `qtyPurchased`, `datePurchased`) VALUES
(1, 1, 2, '2019-05-01'),
(2, 1, 1, '2019-05-02'),
(3, 2, 1, '2019-05-01'),
(4, 2, 2, '2019-05-08'),
(5, 1, 1, '2019-01-03'),
(6, 1, 2, '2019-02-12'),
(7, 1, 1, '2019-03-09'),
(8, 1, 1, '2019-04-26'),
(9, 2, 2, '2019-01-03'),
(10, 2, 1, '2019-01-25'),
(11, 2, 1, '2019-02-15'),
(12, 2, 1, '2019-03-05'),
(13, 2, 1, '2019-04-13'),
(14, 2, 1, '2019-04-19');

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
  `staffID` int(11) NOT NULL,
  `MonthYear` varchar(8) NOT NULL,
  `DaysWorked` int(11) NOT NULL,
  `CustServed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_performance`
--

INSERT INTO `staff_performance` (`performanceID`, `staffID`, `MonthYear`, `DaysWorked`, `CustServed`) VALUES
(1, 1003, '2019-05', 28, 1),
(2, 1003, '2019-04', 25, 20),
(3, 1003, '2019-01', 27, 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `secQuestion` varchar(250) DEFAULT NULL,
  `secAnswer` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userPass`, `secQuestion`, `secAnswer`) VALUES
(1001, '$2y$10$/U204V24KclGpv1xVnR7aeN5z1RIloYSpFCBBK1zT8GYCsHUh2IEO', 'First Pet\'s Name', 'Bobby'),
(1002, '$2y$10$r9aFJ.eq00.zKfxQ2YwQBeP5E52FlP0iPYjS6RcQus35P5rjCewo.', NULL, NULL),
(1003, '$2y$10$fvRJRI/SxMTNeqR4mBD.2.1SB0XC7V8sdfpbMeHOv26DTkPlsU6d2', 'Who is the MVP', 'an');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentID`),
  ADD KEY `appointmentService` (`appointmentService`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `staffID` (`staffID`);

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
  MODIFY `appointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `item_sales`
--
ALTER TABLE `item_sales`
  MODIFY `salesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `staff_performance`
--
ALTER TABLE `staff_performance`
  MODIFY `performanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`appointmentService`) REFERENCES `service` (`serviceID`),
  ADD CONSTRAINT `appointment_ibfk_5` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`);

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
