-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2025 at 11:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_top_up_game`
--
CREATE DATABASE IF NOT EXISTS `toko_top_up_game` DEFAULT CHARACTER SET utf8mb4 ;
USE `toko_top_up_game`;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE `games` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `developer` varchar(255) NOT NULL,
  `path_foto` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

DROP TABLE IF EXISTS `metode_pembayaran`;
CREATE TABLE `metode_pembayaran` (
  `id` int NOT NULL,
  `kode` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `path_foto` varchar(255) CHARACTER SET utf8mb4  DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `path_foto` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `nama`, `email`, `path_foto`, `status`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$5Wwa51tyK5vW4hXGTgsdq.iY9TM.ax.NO7FJ00DRKF.d/MtvBmqkG', 'Administrator', 'admin@gmail.com', '1749996134_43f9b19f580892a70e3d.jpg', 1, 1, '2025-06-14 07:51:43', '2025-06-15 14:02:14'),
(6, 'azkaraqy', '$2y$12$KUJeuc0qLvbJFfEWx42xDO9Fr3bEsd.By5AhHUL1GwzVbQbY4GlPK', 'Muhammad Azka Raki', 'azkaraqy552@gmail.com', '1749997446_9dd5ad1da3ff00982572.jpg', 1, 0, '2025-06-15 10:16:11', '2025-06-15 14:24:06'),
(25, 'buyer', '$2y$12$AreRIsYwRGrs9fQioGw7X.GPcN7QuYnKCEIdOhC7QvMhcdozWLzou', 'Buyer', 'buyer@gmail.com', '1749997519_8ed4e60b74cb855c9bba.jpeg', 1, 0, '2025-06-15 14:25:19', '2025-06-15 15:39:22'),
(30, 'user2', 'pass2345', 'Budi Santoso', 'budi.santoso@example.com', 'foto/budi.png', 1, 0, '2025-06-16 08:59:02', '2025-06-16 08:59:02'),
(31, 'user3', 'pass3456', 'Citra Lestari', 'citra.lestari@example.com', NULL, 0, 0, '2025-06-16 08:59:02', '2025-06-16 08:59:02'),
(32, 'user4', 'pass4567', 'Dewi Kusuma', 'dewi.kusuma@example.com', 'foto/dewi.jpg', 1, 0, '2025-06-16 08:59:02', '2025-06-16 08:59:02'),
(33, 'user5', 'pass5678', 'Eka Putri', 'eka.putri@example.com', NULL, 1, 0, '2025-06-16 08:59:02', '2025-06-16 08:59:02'),
(34, 'admin1', 'adminpass', 'Admin Satu', 'admin1@example.com', 'foto/admin1.jpg', 1, 1, '2025-06-16 08:59:02', '2025-06-16 08:59:02'),
(35, 'user6', 'pass6789', 'Fajar Nugroho', 'fajar.nugroho@example.com', 'foto/fajar.png', 0, 0, '2025-06-16 08:59:02', '2025-06-16 08:59:02'),
(36, 'user7', 'pass7890', 'Gita Ramadhan', 'gita.ramadhan@example.com', NULL, 1, 0, '2025-06-16 08:59:02', '2025-06-16 08:59:02'),
(37, 'user8', 'pass8901', 'Hendra Wijaya', 'hendra.wijaya@example.com', 'foto/hendra.jpg', 1, 0, '2025-06-16 08:59:02', '2025-06-16 08:59:02'),
(38, 'user9', 'pass9012', 'Intan Permata', 'intan.permata@example.com', NULL, 1, 0, '2025-06-16 08:59:02', '2025-06-16 08:59:02'),
(39, 'ocin', '$2y$12$nLJdPdZ11gIht/WcKDPhAuy3BDeAbo5WZPyx6VMZgtuPRGuq3p8li', 'Hussien', 'ocin@gmail.com', NULL, 1, 0, '2025-06-19 22:12:48', '2025-06-19 22:12:48'),
(40, 'Admin2', '$2y$12$xbhQUB0X5G2otjgN6CNJfO2B3zWpfuZ7qEKsFn386SzxF8EX/r5JW', 'Admin Dua', 'admin2@gmail.com', '1750673153_647c88b9c0bd85d75dbd.png', 1, 1, '2025-06-23 10:05:53', '2025-06-23 10:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `id` int NOT NULL,
  `id_pengguna` int NOT NULL,
  `id_top_up_option` int NOT NULL,
  `id_metode_pembayaran` int NOT NULL,
  `player_id` int NOT NULL,
  `player_server` int NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Table structure for table `top_up_option`
--

DROP TABLE IF EXISTS `top_up_option`;
CREATE TABLE `top_up_option` (
  `id` int NOT NULL,
  `id_game` int NOT NULL,
  `qty` int NOT NULL,
  `price` int NOT NULL,
  `path_foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_up_option`
--
ALTER TABLE `top_up_option`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `top_up_option`
--
ALTER TABLE `top_up_option`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
