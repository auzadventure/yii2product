-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2017 at 04:46 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sandbox_yii2`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contactNo` varchar(25) NOT NULL,
  `pass` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `email`, `contactNo`, `pass`) VALUES
(1, 'My Name John', 'Address 316', 'email', '5551111', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `foodorder`
--

CREATE TABLE `foodorder` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contactNo` varchar(20) NOT NULL,
  `address` varchar(80) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `itemTotal` decimal(10,2) NOT NULL,
  `deliveryFee` decimal(10,2) DEFAULT NULL,
  `gst` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `datetimeCreate` datetime NOT NULL,
  `datetimeClose` datetime DEFAULT NULL,
  `paypalTxn` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foodorderitem`
--

CREATE TABLE `foodorderitem` (
  `id` int(11) NOT NULL,
  `foodOrderID` int(11) NOT NULL,
  `menuItemID` int(11) NOT NULL,
  `qty` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menucat`
--

CREATE TABLE `menucat` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `sortOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menucat`
--

INSERT INTO `menucat` (`id`, `name`, `sortOrder`) VALUES
(1, 'Rice', 1),
(2, 'naan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `menuitem`
--

CREATE TABLE `menuitem` (
  `id` int(11) NOT NULL,
  `menuCatID` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `des` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuitem`
--

INSERT INTO `menuitem` (`id`, `menuCatID`, `name`, `des`, `price`, `image`, `status`) VALUES
(1, 1, 'Garlic Rice', 'Really Tasty Garlic Rice', '45.50', 'nil', 1),
(2, 2, 'Spicey Naan', 'Very tastey', '45.00', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foodorder`
--
ALTER TABLE `foodorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foodorderitem`
--
ALTER TABLE `foodorderitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menucat`
--
ALTER TABLE `menucat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menuitem`
--
ALTER TABLE `menuitem`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `foodorder`
--
ALTER TABLE `foodorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `foodorderitem`
--
ALTER TABLE `foodorderitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menucat`
--
ALTER TABLE `menucat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menuitem`
--
ALTER TABLE `menuitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
