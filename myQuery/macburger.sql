-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2018 at 12:39 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `macburger`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_registration`
--

CREATE TABLE `account_registration` (
  `Fullname` varchar(100) NOT NULL,
  `Age` int(11) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Position` varchar(20) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_registration`
--

INSERT INTO `account_registration` (`Fullname`, `Age`, `Address`, `Position`, `Username`, `Password`) VALUES
('Abby Gayle Celeste', 19, 'Maasin, Southern Leyte', 'USER', 'abbygayle', '123'),
('Jerome Joseph R. Villaruel', 19, 'Bato, Leyte', 'ADMIN', 'jeromevillaruel', 'jerome123'),
('Loraine Claire Gaviola', 19, 'Matalom, Leyte', 'ADMIN', 'lorainegaviola', '111');

-- --------------------------------------------------------

--
-- Table structure for table `stock_ingredients`
--

CREATE TABLE `stock_ingredients` (
  `Id` int(11) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_ingredients`
--

INSERT INTO `stock_ingredients` (`Id`, `ItemName`, `Category`, `Quantity`, `Date`) VALUES
(4, 'Egg', 'Patty', 0, '2018-04-12'),
(5, 'Hotdog', 'Patty', 2, '2018-04-12'),
(6, 'Cabbage', 'Vegetables', 15, '2018-04-12'),
(7, 'Tomato', 'Vegetables', 50, '2018-04-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_registration`
--
ALTER TABLE `account_registration`
  ADD UNIQUE KEY `Fullname` (`Fullname`);

--
-- Indexes for table `stock_ingredients`
--
ALTER TABLE `stock_ingredients`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `ItemName` (`ItemName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stock_ingredients`
--
ALTER TABLE `stock_ingredients`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
