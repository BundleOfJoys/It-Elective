-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2025 at 02:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Table structure for table `action_figures`
--

CREATE TABLE `action_figures` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `action_figures`
--

INSERT INTO `action_figures` (`id`, `name`, `description`, `stock`, `price`, `image`) VALUES
(3, '12', '12', 12, 12.00, 'f4.webp'),
(4, '12', '12', 11, 12.00, 'f2.webp'),
(5, '12', '12', 12, 12.00, 'f5.webp'),
(6, '12', '12', 12, 12.00, 'f6.webp'),
(7, '121', '2', 7, 12.00, 'f10.webp'),
(8, '12', '12', 12, 12.00, 'f3.webp');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `username`, `password`) VALUES
(1001, 'Monkey D. Luffy', 'admin1', '123'),
(1002, 'Roronoa Zoro', 'admin2', '123'),
(1003, 'Vinsmoke Sanji', 'admin3', '123'),
(1004, 'God Ussop', 'admin4', '123'),
(1005, 'Niko Rubin', 'admin5', '123'),
(1006, 'Cyborg Franky', 'admin6', '123');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `name`, `description`, `stock`, `price`, `image`) VALUES
(1, '12', '12', 6, 50.00, 'c6.webp'),
(5, '12', '12', 12, 12.00, 'c4.webp'),
(7, '12', '12', 12, 12.00, 'c2.webp'),
(8, '12', '12', 12, 12.00, 'c1.webp'),
(9, '12', '12', 12, 12.00, 'c3.webp'),
(11, '12', '12', 12, 12.00, 'c5.webp');

-- --------------------------------------------------------

--
-- Table structure for table `ordinary_users`
--

CREATE TABLE `ordinary_users` (
  `id` int(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordinary_users`
--

INSERT INTO `ordinary_users` (`id`, `fullname`, `username`, `password`) VALUES
(1007, 'Nami Duroboniko', 'ordinary1', '123'),
(1008, 'Jenbie Fishman', 'ordinary2', '123'),
(1009, 'Tonytony Chooper', 'ordinary2', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_figures`
--
ALTER TABLE `action_figures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordinary_users`
--
ALTER TABLE `ordinary_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_figures`
--
ALTER TABLE `action_figures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
