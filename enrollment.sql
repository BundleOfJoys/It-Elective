-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 10:23 AM
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
-- Database: `onepiece`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `usernamae` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`usernamae`, `password`) VALUES
('admin1', '123'),
('admin2', '123'),
('admin3', '123'),
('admin4', '123'),
('admin5', '123'),
('gavadamin', '123qwe');

-- --------------------------------------------------------

--
-- Table structure for table `ordinary_users`
--

CREATE TABLE `ordinary_users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordinary_users`
--

INSERT INTO `ordinary_users` (`username`, `password`) VALUES
('ordinary1', '123'),
('ordinary2', '123'),
('ordinary3', '123'),
('ordinary4', '123'),
('ordinarygav', '123qwe');

-- --------------------------------------------------------

--
-- Table structure for table `pirates`
--

CREATE TABLE `pirates` (
  `idno` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `bounty` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pirates`
--

INSERT INTO `pirates` (`idno`, `fname`, `bounty`) VALUES
(1000, 'MONKEY D. LUFFY', '2000000000'),
(1001, 'RORONOA ZORO', '900,000,000'),
(1002, 'VINSMOKE SANJE', '800,000,000'),
(1003, 'DURUBU NAMI', '300,000,000'),
(1004, 'GOD USSUP', '500,000,000'),
(1005, 'NEKO RUBIN', '800,000,000'),
(1006, 'CYBORG FRANKY', '880,000,000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pirates`
--
ALTER TABLE `pirates`
  ADD PRIMARY KEY (`idno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

