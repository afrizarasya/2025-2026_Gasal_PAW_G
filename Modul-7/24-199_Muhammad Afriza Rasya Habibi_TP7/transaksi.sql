-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2025 at 02:26 PM
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
-- Database: `transaksi`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `nama_pelanggan`, `keterangan`, `total`) VALUES
(1, '2025-11-01', 'Andi', 'Self Pickup', 150000.00),
(2, '2025-11-01', 'Budi', 'Delivery Order', 220000.00),
(3, '2025-11-02', 'Citra', 'Self Pickup', 175000.00),
(4, '2025-11-02', 'Dina', 'Delivery Order', 260000.00),
(5, '2025-11-03', 'Eko', 'Self Pickup', 310000.00),
(6, '2025-11-03', 'Farhan', 'Delivery Order', 185000.00),
(7, '2025-11-04', 'Gita', 'Self Pickup', 295000.00),
(8, '2025-11-04', 'Hadi', 'Delivery Order', 205000.00),
(9, '2025-11-05', 'Indra', 'Self Pickup', 160000.00),
(10, '2025-11-05', 'Joko', 'Delivery Order', 240000.00),
(11, '2025-11-06', 'Kania', 'Self Pickup', 275000.00),
(12, '2025-11-06', 'Lia', 'Delivery Order', 180000.00),
(13, '2025-11-07', 'Miko', 'Self Pickup', 330000.00),
(14, '2025-11-07', 'Nina', 'Delivery Order', 210000.00),
(15, '2025-11-08', 'Omar', 'Self Pickup', 350000.00),
(16, '2025-11-08', 'Putri', 'Delivery Order', 195000.00),
(17, '2025-11-09', 'Qori', 'Self Pickup', 270000.00),
(18, '2025-11-09', 'Rafi', 'Delivery Order', 250000.00),
(19, '2025-11-10', 'Santi', 'Self Pickup', 300000.00),
(20, '2025-11-10', 'Tono', 'Delivery Order', 220000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
