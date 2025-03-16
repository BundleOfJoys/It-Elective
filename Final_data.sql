-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2025 at 05:01 AM
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
(6, 'Robin Action Figure', 'This Nico Robin action figure features stunning detail, capturing her elegance and strength. With a dynamic pose, high-quality PVC sculpting, and vidrant paintwork, its a must-have for Once piece', 12, 5999.00, 'f6.webp'),
(8, 'Zoro Action Figure', 'This Roronoa Zoro action figure showcases his fierce determination and masterful swordsmanship. With a dynamic pose, high-quality PVC sculpting, and detailed paintwork, its a must-have for One piece fans and collectors', 20, 5999.00, 'f3.webp'),
(9, 'Nami Action Figure', 'This Nami action figure captures her charm and confidence with stunning detail. Featuring a dynamic pose, high-quality PVC sculpting, and vibrant paintwork, its a must have for One piece fans and collectors', 30, 6999.00, 'f5.webp'),
(10, 'Sanji Action Figure', 'This Sanji action figure showcases his style and combat prowess with dynamic detail. With high-quality PVC sculpting, vibrant paintwork, and an action-ready pose, its a must-have for One piece fans and collectors', 5, 3999.00, 'f2.webp'),
(11, 'Ussop', 'This Ussop action figure captures his bold spirit and sharpshooter stance with incredible detail. Featuring high-quality PVC sculpting, vibrant paintwork, and a dynamic pose, its a must-have for One piece fans pose, its a must- have for One piece fans and collectors', 32, 4999.00, 'f4.webp'),
(12, 'Law Action Figure', 'This Trafalgar Law action figure showcases his cool demeanor and masterful swordsmanship. With high-quality PVC sculpting, vibrant paintwork, and a dynamic paint work, and a dynamic pose, its a must have for One Piece fans and collectors', 24, 2999.00, 'f10.webp');

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
(1, 'Onami', 'The Onami cards form the One Piece Card Game features Nami, the Straw Hat Pirates skilled navigator, in a captivating design. This cards has been released in various version across different sets', 15, 999.00, 'c6.webp'),
(5, 'Nami', 'The navigator of the Straw Hat Pirates, skilled in weather manipulation and strategy. This card enhances deck consistency by searching for key cards or setting up powerful plays', 11, 599.00, 'c4.webp'),
(7, 'Luffy Gear 5', 'MOnkey D. Luffy,s Ultimate transfomation, unlocking the full power of his awakened Gomu GOmu no mi', 20, 599.00, 'c2.webp'),
(8, 'Uastas Kid', 'Eustass Kid- The Fierce captain of the Kid pirates, known for his powerful magnetism-based abilities. This card excels in aggressive plays', 23, 699.00, 'c1.webp'),
(9, 'Tony Tony Chopper ', 'The beloved doctor of the Straw HAt Pirates, Chopper provides healing and suupport to his crew IN the one piece Game, Chopper cards often serve as defensive blockrs', 14, 799.00, 'c3.webp'),
(11, 'Buggy The Clow', 'Buggy- THe cunning and comoical captain of the Buggy pirates, Buggy is a master of deception and luck. In the One Piece Card his cards often focus on trickery', 28, 999.00, 'c5.webp');

-- --------------------------------------------------------

--
-- Table structure for table `manga`
--

CREATE TABLE `manga` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manga`
--

INSERT INTO `manga` (`id`, `name`, `description`, `stock`, `price`, `image`) VALUES
(1, 'One Piece Volume 1: Romance Dawn ', 'One Piece Volume 1: Romance Dawn follows Luffy as he sets sail to become the Pirate King. With his Gum-Gum Fruit powers, he meets Zoro and Nami, kicking off an epic adventure with action, humor and heart', 12, 299.00, 'm1.webp'),
(4, 'One Piece Volume 7', 'One piece VOlume 7: concludes the epic battle in Arlong Park as Luffy and his crew fight to free Nami form Arlong tyranny', 12, 599.00, 'm4.webp'),
(6, 'One Piece Volume 8', 'Brings the intense battle at Arlong park to its peak.', 35, 699.00, 'm5.webp'),
(7, 'One Piece Volume 6', 'The Oath follows luffy, Zoro, and sanji as they fight to save Nami from the Villainous Arlong', 12, 499.00, 'm6.webp'),
(9, 'One Piece Volume 11', 'The Meanest Man in the East kicks off an new adventure as luffy and his crew set sail fo the GrandLine.', 5, 799.00, 'm3.webp'),
(11, 'One Piece Volume 2', 'Buggy the Clown follows Luffy, Zoro, and Nami as they face the ruthless pirate Buggy the clown.', 15, 699.00, 'm2.webp');

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
-- Indexes for table `manga`
--
ALTER TABLE `manga`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `manga`
--
ALTER TABLE `manga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
