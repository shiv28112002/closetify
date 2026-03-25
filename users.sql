-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 25, 2026 at 07:00 AM
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
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `cloth`
--

CREATE TABLE `cloth` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` longblob DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `occasion` varchar(50) DEFAULT NULL,
  `season` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(50) NOT NULL,
  `occasion` varchar(50) NOT NULL,
  `season` varchar(50) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_id`, `name`, `color`, `occasion`, `season`, `image_path`, `created_at`) VALUES
(3, 7, 'tshirt', 'red', 'Casual', 'Autumn', 'uploads/682aec2a1a842_Screenshot 2025-05-19 114311.png', '2025-05-19 08:30:34'),
(4, 7, 'skirt', 'blue', 'Party', 'Winter', 'uploads/682aed93e4470_Screenshot 2025-05-19 140411.png', '2025-05-19 08:36:35'),
(5, 7, 'dress', 'blue', 'Casual', 'Spring', 'uploads/682c124e76e7f_Screenshot 2025-05-20 104846.png', '2025-05-20 05:25:34'),
(6, 7, 'shirt', 'black', 'Casual', 'Winter', 'uploads/682c56a6e0111_Screenshot 2025-05-20 104456.png', '2025-05-20 10:17:10'),
(7, 7, 'pant', 'gray', 'Casual', 'Summer', 'uploads/6832ef4325f21_Screenshot 2025-05-20 104725.png', '2025-05-25 10:21:55'),
(8, 7, 'Trouser', 'black', 'Formal', 'Winter', 'uploads/6834094e4fd2a_Screenshot 2025-05-20 104806.png', '2025-05-26 06:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `outfits`
--

CREATE TABLE `outfits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `outfit_name` varchar(255) NOT NULL,
  `items` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outfits`
--

INSERT INTO `outfits` (`id`, `user_id`, `name`, `created_at`, `outfit_name`, `items`) VALUES
(4, 7, '', '2025-05-20 06:07:10', 'picnic', '[4,5]'),
(6, 7, '', '2025-05-20 10:17:44', 'party', '[4,6]'),
(8, 7, '', '2025-05-25 10:22:25', 'college', '[3,7]'),
(9, 7, '', '2026-02-27 07:18:51', 'cool', '[3,4]');

-- --------------------------------------------------------

--
-- Table structure for table `outfit_items`
--

CREATE TABLE `outfit_items` (
  `outfit_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(260) NOT NULL,
  `reset_token` varchar(64) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `username`, `email`, `password`, `reset_token`, `token_expiry`, `otp`, `otp_expiry`) VALUES
(5, 'shivangi rathore', 'shivangirathore@gmail.com', '$2y$10$4U9FR.dHvLuB7BeS4yWOQ.4HmjWuHD2jNeN5XIsnr4LKoLKeaVqOu', NULL, NULL, NULL, NULL),
(6, 'yogesh', 'rishabhyadav969@gmail.com', '$2y$10$PRRZpJMyIn7J5WomX0oEsucB7pWjk73dPYBLLTA/wc6RozAUNAEgO', NULL, NULL, NULL, NULL),
(7, 'Shivangi', 'shivangirathore1428@gmail.com', '$2y$10$QKdhL9d0TTbGvR1wgWnuM.yqZuZ3Asoe5ijbH7137yDoCacubWkNa', '1345dc956a9ba0a7010a34981f413322196f72197e3be005a7871a93cc79f1dd', '2026-03-24 22:45:22', NULL, NULL),
(8, 'shivani', 'sp2881219@gmail.com', '$2y$10$uFKwdqiuVmzB8hw1hnHRm.Fob6bYs/0MmG/16fA87PXzw3djoNw.K', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_photos`
--

CREATE TABLE `user_photos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cloth`
--
ALTER TABLE `cloth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `outfits`
--
ALTER TABLE `outfits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `outfit_items`
--
ALTER TABLE `outfit_items`
  ADD KEY `outfit_id` (`outfit_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`email`) USING BTREE;

--
-- Indexes for table `user_photos`
--
ALTER TABLE `user_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cloth`
--
ALTER TABLE `cloth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `outfits`
--
ALTER TABLE `outfits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_photos`
--
ALTER TABLE `user_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cloth`
--
ALTER TABLE `cloth`
  ADD CONSTRAINT `cloth_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userdata` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userdata` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `outfits`
--
ALTER TABLE `outfits`
  ADD CONSTRAINT `outfits_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userdata` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `outfit_items`
--
ALTER TABLE `outfit_items`
  ADD CONSTRAINT `outfit_items_ibfk_1` FOREIGN KEY (`outfit_id`) REFERENCES `outfits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `outfit_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_photos`
--
ALTER TABLE `user_photos`
  ADD CONSTRAINT `user_photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userdata` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
