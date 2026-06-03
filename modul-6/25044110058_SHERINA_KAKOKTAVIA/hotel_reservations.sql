-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2026 at 12:20 PM
-- Server version: 8.0.45
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_reservations`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `room_type` enum('Standard','Deluxe','Suite') NOT NULL,
  `check_in` date NOT NULL,
  `duration_nights` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `check_in` date NOT NULL,
  `duration_nights` int NOT NULL,
  `total_price` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `customer_name`, `room_type`, `check_in`, `duration_nights`, `total_price`) VALUES
(36, 82, 'rani', 'Deluxe', '2026-07-07', 1, 500000),
(37, 83, 'ani', 'Deluxe', '2026-04-07', 1, 500000),
(40, 87, 'fara', 'Deluxe', '2026-09-10', 1, 500000),
(41, 2, '', '', '0000-00-00', 0, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'rina', 'rina123', 'admin'),
(82, 'rani', '$2y$10$N1f3SV/wH.I.8pTmZ7MTj.XoWZg/AaImgixJfLNf1u0K9JwMYHK4m', 'user'),
(83, 'ani', '$2y$10$Gnt33NTb/hgCsQcqE6Ps/uMYqNk3mS2WBBRnFjbosqWZ2iHwc2j/S', 'user'),
(84, 'sara', '$2y$10$iWdjwpMyP/9b3QYpHs/DB.E2BSVHGfR9Ds8ZCmTqSUeAH4GjNhtni', 'admin'),
(86, 'risi', '$2y$10$K07.ZDNozsggFnr7h5eJeORp/Ry2wP5TO5xWVk30kWnna6XF299s6', 'admin'),
(87, 'fara', '$2y$10$Bj0G7S8WLB5rZGTJiWvzfu8I9L7V58P7kbZbzEMqSDGHAue39sB8m', 'user'),
(88, 'safa', '$2y$10$rO95hU8RgK7hKatTsesyju5Saiu5l5jyFG.tak1Bwn0ug8TUrAFZy', 'admin'),
(89, 'rima', '$2y$10$H2cgah38UA0KHZTf/hi9Z.S6/5XvXVviFrUhnsXmLEZdDLv25/ROq', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_booking` (`user_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_user_booking` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
