-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: ictstu-db1.cc.swin.edu.au
-- Generation Time: Sep 07, 2017 at 04:57 PM
-- Server version: 5.5.52-MariaDB
-- PHP Version: 7.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s101148176_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `emailAddress` varchar(100) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `isAdmin` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`emailAddress`, `customerName`, `password`, `phoneNumber`, `isAdmin`) VALUES
('admin@admin.com', 'admin', 'admin', '000-000-000', b'1'),
('ali.memon@mailinator.com', 'Ali Memon', '123456', '412-685-756', b'0'),
('john.cena@mailinator.com', 'John Cena', 'johnjohn', '415-650-8520', b'0'),
('phil.smith@mailinator.com', 'Phil smith', 'phil1234', '415-850-8585', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`emailAddress`);
  
--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingNumber` int(11) NOT NULL,
  `customerEmail` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `pickupDate` date NOT NULL,
  `pickupTime` time NOT NULL,
  `unitNumber` varchar(5) NOT NULL,
  `streetNumber` varchar(5) NOT NULL,
  `streetName` varchar(60) NOT NULL,
  `suburb` varchar(60) NOT NULL,
  `assignStatus` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingNumber`, `customerEmail`, `name`, `phone`, `destination`, `pickupDate`, `pickupTime`, `unitNumber`, `streetNumber`, `streetName`, `suburb`, `assignStatus`) VALUES
(1, 'phil.smith@mailinator.com', 'Zohaib Ali', '410-200-2050', 'Mitcham', '2017-09-07', '20:30:00', '5', '1220', 'Heatherton Road', 'Noble Park', b'0'),
(2, 'phil.smith@mailinator.com', 'Zohaib Ali', '410-500-800', 'Mitcham', '2017-09-07', '17:30:00', '3', '1224', 'Heatherton Road', 'Noble Park', b'1'),
(3, 'phil.smith@mailinator.com', 'Zohaib Ali', '410-500-650', 'Mitcham', '2017-09-07', '18:00:00', '1', '1228', 'Heatherton Road', 'Noble Park', b'0'),
(7, 'phil.smith@mailinator.com', 'Ali Memon', '412-685-985', 'Clayton South', '2017-09-07', '19:30:00', '', '89', 'Ellendale Road', 'Noble Park', b'0'),
(9, 'phil.smith@mailinator.com', 'Sanjay Kumar', '412-222-555', 'Clayton North', '2017-09-07', '20:30:00', '', '89', 'Ellendale Road', 'Noble Park', b'1'),
(11, 'ali.memon@mailinator.com', 'Narain Kumar', '418-856-965', 'Noble Park', '2017-09-07', '21:00:00', '1', '3', 'Third Street', 'Clayton South', b'0'),
(12, 'ali.memon@mailinator.com', 'Zohaib Ali', '412-550-5560', 'Clayton', '2017-09-08', '19:30:00', '5', '1222', 'Heatherton Road', 'Noble Park', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingNumber`),
  ADD KEY `fk_customer_booking` (`customerEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_customer_booking` FOREIGN KEY (`customerEmail`) REFERENCES `customer` (`emailAddress`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
