-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2015 at 11:40 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `micropayment`
--

-- --------------------------------------------------------

--
-- Table structure for table `industries`
--

CREATE TABLE IF NOT EXISTS `industries` (
`IndustryID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Phone` int(11) NOT NULL,
  `RegistrationNo` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `industryaccount`
--

CREATE TABLE IF NOT EXISTS `industryaccount` (
`AccountID` int(11) NOT NULL,
  `CreditCardNo` varchar(40) NOT NULL,
  `ExpiryDate` date NOT NULL,
  `CSC` varchar(40) NOT NULL,
  `Balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`MenuID` int(11) NOT NULL,
  `MenuName` varchar(20) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=163 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`MenuID`, `MenuName`, `UserID`) VALUES
(1, 'Personal_Info', 1),
(2, 'Account', 1),
(3, 'Personal_Info', 2),
(4, 'Account', 2),
(53, 'Personal_Info', 17),
(54, 'Account', 17),
(55, 'Personal_Info', 18),
(56, 'Account', 18),
(57, 'Personal_Info', 19),
(58, 'Account', 19),
(59, 'Personal_Info', 20),
(60, 'Account', 20),
(61, 'Personal_Info', 21),
(62, 'Account', 21),
(63, 'Personal_Info', 22),
(64, 'Account', 22),
(65, 'Personal_Info', 23),
(66, 'Account', 23),
(67, 'Personal_Info', 24),
(68, 'Account', 24),
(69, 'Personal_Info', 20),
(70, 'Account', 20),
(71, 'Personal_Info', 21),
(72, 'Account', 21),
(73, 'Personal_Info', 22),
(74, 'Account', 22),
(75, 'Personal_Info', 1),
(76, 'Account', 1),
(77, 'Personal_Info', 1),
(78, 'Account', 1),
(79, 'Personal_Info', 2),
(80, 'Account', 2),
(81, 'Personal_Info', 3),
(82, 'Account', 3),
(83, 'Personal_Info', 4),
(84, 'Account', 4),
(85, 'Personal_Info', 5),
(86, 'Account', 5),
(87, 'Personal_Info', 6),
(88, 'Account', 6),
(89, 'Personal_Info', 7),
(90, 'Account', 7),
(91, 'Personal_Info', 9),
(92, 'Account', 9),
(93, 'Personal_Info', 10),
(94, 'Account', 10),
(95, 'Personal_Info', 11),
(96, 'Account', 11),
(97, 'Personal_Info', 12),
(98, 'Account', 12),
(99, 'Personal_Info', 13),
(100, 'Account', 13),
(101, 'Personal_Info', 14),
(102, 'Account', 14),
(103, 'Personal_Info', 15),
(104, 'Account', 15),
(105, 'Personal_Info', 16),
(106, 'Account', 16),
(107, 'Personal_Info', 17),
(108, 'Account', 17),
(109, 'Personal_Info', 18),
(110, 'Account', 18),
(111, 'Personal_Info', 19),
(112, 'Account', 19),
(113, 'Personal_Info', 20),
(114, 'Account', 20),
(115, 'Personal_Info', 21),
(116, 'Account', 21),
(117, 'Personal_Info', 22),
(118, 'Account', 22),
(119, 'Personal_Info', 23),
(120, 'Account', 23),
(121, 'Personal_Info', 24),
(122, 'Account', 24),
(123, 'Personal_Info', 25),
(124, 'Account', 25),
(125, 'Personal_Info', 26),
(126, 'Account', 26),
(127, 'Personal_Info', 27),
(128, 'Account', 27),
(129, 'Personal_Info', 28),
(130, 'Account', 28),
(131, 'Personal_Info', 29),
(132, 'Account', 29),
(133, 'Personal_Info', 30),
(134, 'Account', 30),
(135, 'Personal_Info', 31),
(136, 'Account', 31),
(137, 'Personal_Info', 32),
(138, 'Account', 32),
(139, 'Personal_Info', 33),
(140, 'Account', 33),
(141, 'Personal_Info', 34),
(142, 'Account', 34),
(143, 'Personal_Info', 35),
(144, 'Account', 35),
(145, 'Personal_Info', 36),
(146, 'Account', 36),
(147, 'Personal_Info', 37),
(148, 'Account', 37),
(149, 'Personal_Info', 38),
(150, 'Account', 38),
(151, 'Personal_Info', 39),
(152, 'Account', 39),
(153, 'Personal_Info', 40),
(154, 'Account', 40),
(155, 'Personal_Info', 41),
(156, 'Account', 41),
(157, 'Personal_Info', 42),
(158, 'Account', 42),
(159, 'Personal_Info', 43),
(160, 'Account', 43),
(161, 'Personal_Info', 44),
(162, 'Account', 44);

-- --------------------------------------------------------

--
-- Table structure for table `pays`
--

CREATE TABLE IF NOT EXISTS `pays` (
`PaymentID` int(11) NOT NULL,
  `SystemID` int(11) NOT NULL,
  `IndustryID` int(11) NOT NULL,
  `Amount` float NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reader`
--

CREATE TABLE IF NOT EXISTS `reader` (
`ReaderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PersonName` varchar(40) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Phone` varchar(40) NOT NULL,
  `Verification` int(6) NOT NULL,
  `AddressOne` varchar(40) NOT NULL,
  `AddressTwo` varchar(40) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Province` varchar(20) NOT NULL,
  `PostalCode` int(6) NOT NULL,
  `Nationality` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `reader`
--

INSERT INTO `reader` (`ReaderID`, `UserID`, `PersonName`, `Email`, `DateOfBirth`, `Password`, `Phone`, `Verification`, `AddressOne`, `AddressTwo`, `City`, `Province`, `PostalCode`, `Nationality`) VALUES
(42, 44, '', 'jffasna@gmail.com', '0000-00-00', 'e0c9035898dd52fc65c41454cec9c4d2611bfb37', '', 0, '', '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `readeraccount`
--

CREATE TABLE IF NOT EXISTS `readeraccount` (
`AccountID` int(11) NOT NULL,
  `CreditCardNo` varchar(40) NOT NULL,
  `ExpiryDate` date NOT NULL,
  `CSC` varchar(40) NOT NULL,
  `Balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `recharge`
--

CREATE TABLE IF NOT EXISTS `recharge` (
`RechargeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Amount` float NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SystemID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE IF NOT EXISTS `system` (
`SystemID` int(11) NOT NULL,
  `CreditCardNo` varchar(40) NOT NULL,
  `ExpiryDate` date NOT NULL,
  `CSC` varchar(40) NOT NULL,
  `Balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tempuser`
--

CREATE TABLE IF NOT EXISTS `tempuser` (
`TempID` int(10) NOT NULL,
  `VerifyCode` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
`TransactionID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `IndustryID` int(11) NOT NULL,
  `Amount` float NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`UserID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Flag` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Email`, `Password`, `Flag`) VALUES
(44, 'jffasna@gmail.com', 'e0c9035898dd52fc65c41454cec9c4d2611bfb37', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `industries`
--
ALTER TABLE `industries`
 ADD PRIMARY KEY (`IndustryID`);

--
-- Indexes for table `industryaccount`
--
ALTER TABLE `industryaccount`
 ADD PRIMARY KEY (`AccountID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`MenuID`);

--
-- Indexes for table `pays`
--
ALTER TABLE `pays`
 ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `reader`
--
ALTER TABLE `reader`
 ADD PRIMARY KEY (`ReaderID`);

--
-- Indexes for table `readeraccount`
--
ALTER TABLE `readeraccount`
 ADD PRIMARY KEY (`AccountID`);

--
-- Indexes for table `recharge`
--
ALTER TABLE `recharge`
 ADD PRIMARY KEY (`RechargeID`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
 ADD PRIMARY KEY (`SystemID`);

--
-- Indexes for table `tempuser`
--
ALTER TABLE `tempuser`
 ADD PRIMARY KEY (`TempID`), ADD UNIQUE KEY `VerifyCode` (`VerifyCode`), ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
 ADD PRIMARY KEY (`TransactionID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `industries`
--
ALTER TABLE `industries`
MODIFY `IndustryID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `industryaccount`
--
ALTER TABLE `industryaccount`
MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT for table `pays`
--
ALTER TABLE `pays`
MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reader`
--
ALTER TABLE `reader`
MODIFY `ReaderID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `readeraccount`
--
ALTER TABLE `readeraccount`
MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recharge`
--
ALTER TABLE `recharge`
MODIFY `RechargeID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
MODIFY `SystemID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tempuser`
--
ALTER TABLE `tempuser`
MODIFY `TempID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
