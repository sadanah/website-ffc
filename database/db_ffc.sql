-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 07:15 AM
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
-- Database: `db_ffc`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `conID` int(10) NOT NULL,
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`conID`, `fName`, `lName`, `email`, `message`) VALUES
(23, 'Sadana', 'Herath', 'sadana.herath@gmail.com', 'hiiii'),
(24, 'Sadana', 'Herath', 'sadana.herath@gmail.com', 'hiiii'),
(25, 'Sadana', 'Herath', 'correct@email.com', 'This is my message.'),
(26, 'Sadana', 'Herath', 'sadana.herath@gmail.com', 'OR 1=1'),
(27, 'OR 1=1', 'OR 1=1', 'sadana.herath@gmail.com', 'OR 1=1');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `regID` int(10) NOT NULL,
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNo` varchar(12) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `program` varchar(20) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `role` enum('admin','customer','staff') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`regID`, `fName`, `lName`, `email`, `phoneNo`, `username`, `password`, `program`, `duration`, `role`) VALUES
(5, 'Sadana', 'Herath', 'sadana.herath@gmail.com', '2147483647', 'newuser', '$2y$10$gB027QOXXC3UpJuSctXK6.JLgWGt6p2v96vqfdvolzzkay12.stSe', '', '', 'admin'),
(6, 'John', 'Doe', 'johnd@gmail.com', '2147483647', 'staffAccount', '$2y$10$peXaPEYvklInSNM.4IMXhuPgazfm9XmOqw8736OzRI3lLmdthwJm6', 'functional-training', '6-months', 'staff'),
(7, 'Meghan', 'North', 'megann@gmail.com', '2147483647', 'meghann', '$2y$10$YNs2JT/Qpg..9jhOJLrdPe65w3oRPMtnl7N1BkSa72fGSC03wtlb6', 'general-access', '1-year', 'customer'),
(8, 'Max', 'Verstappen', 'maxv@gmail.com', '2147483647', 'max_v', '$2y$10$AmP2z28u9xPa//g1nuOWC.ioO4vNyuJHZZbih7V6P1wYAQXASRP5q', '', '', 'staff'),
(9, 'Lily', 'Sabertooth', 'lilystooth@gmail.com', '2147483647', 'saber_lily_tooth', '$2y$10$c1Rg9AUS5o27FwgmyEAhkeZm2u9jbcSihk9KouRKLqsx6JbGrGwoi', 'group-training', '1-month', 'customer'),
(10, 'Yesua', 'Yousuf', 'yyousuf@gmail.com', '2147483647', 'holy_cow', '$2y$10$/KuefbhwGqTMCY.xnw350OGf2n/cgvw97mqIGKYGWUy6lG8hRO37S', 'functional-training', '3-months', 'customer'),
(12, 'Julia', 'Roberts', 'juliar@ffc.com', '2147483647', 'juliar', '$2y$10$K1/A.Sgd3H96fe3ncgNFt.bQkAhaFWt74WBWLwKuWIBQc2IsADHey', 'program error', 'duration error', 'staff'),
(13, 'Kevin', 'Dassanayake', 'kevind@gmail.com', '2147483647', 'kevind', '$2y$10$4iQqq65bmK5udW3xw6dfZ.np09KcvbnitHPu1B4yA6vRQaLnVVp8W', 'personal-training', '3-months', 'customer'),
(14, 'Sadana', 'Herath', 'wrongemail@mail', '2147483647', 'username', '$2y$10$NZ7LSytAsAD6GYNieDZtH.P.UuUObqxT/pYvxvJtb9CnFHpcptTMi', 'personal-training', '3-months', 'customer'),
(15, 'Sadana', 'Herath', 'sadana.herath@gmail.com', '0', 'newusername', '$2y$10$TRh0TtPI14i12AymakmAC.zMXYjTWemudFVYZW9Tzd61CueDA1oPC', 'personal-training', '1-month', 'customer'),
(16, 'Sadana', 'Herath', 'sadana.herath@gmail.com', '0', 'newuserr', '$2y$10$SbBbmQGiRzIRizKgrAwibuDp3B0Pka3YiVVL745tvYXid2f3GHM62', 'functional-training', '6-months', 'customer'),
(17, 'Sadana', 'Herath', 'sadana.herath@gmail.com', '+94702101466', '+', '$2y$10$1xGW2Oep4C50QCsVi4NBVuxm04mO6GPOjcoRTNjCjuwZUUSO7Ulb.', 'personal-training', '1-month', 'customer'),
(18, 'Modified', 'User Record', 'modified@mail.com', '+94702101466', 'modUsername', '$2y$10$do4LbvFqN1FoYDeZsI01r.xqcdKockB0nH8Ub3Honsaft1edO..Dy', 'group-training', '1-month', 'staff'),
(19, 'Sadana', 'Herath', 'sadana.herath@gmail.com', '+94702101466', 'newStaff', '$2y$10$w45ihmu5ZeGhj6RjfF89suFSQ7frvD68soeL6GlsbLwSMKGOEr7eK', 'personal-training', '1-month', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleID` int(10) NOT NULL,
  `program` enum('personal-training','group-training','functional-training','general-access') NOT NULL DEFAULT 'general-access',
  `date` date NOT NULL,
  `time` time NOT NULL,
  `trainer` varchar(20) NOT NULL,
  `info` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleID`, `program`, `date`, `time`, `trainer`, `info`) VALUES
(5, 'functional-training', '2025-04-12', '13:00:00', 'Max Verstappen', 'Mobility focused upper body training.'),
(6, 'functional-training', '2025-04-15', '13:00:00', 'Max Verstappen', 'Strength training for quads and glutes with cooldown session.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`conID`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`regID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleID`),
  ADD UNIQUE KEY `unique_schedule` (`program`,`date`,`time`,`trainer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `conID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `regID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
