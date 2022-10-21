-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2022 at 04:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentalmobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_peminjaman`
--

CREATE TABLE `transaksi_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `nama_mobil` varchar(50) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `status_peminjaman` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_peminjaman`
--

INSERT INTO `transaksi_peminjaman` (`id_peminjaman`, `nama_mobil`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status_peminjaman`) VALUES
(1, 'Agya', '2022-10-20', '2022-10-21', 'Dipakai'),
(2, 'Avanza', '2022-10-20', '2022-10-22', 'Dipakai'),
(3, 'Avanza 2', '2022-10-20', '2022-10-22', 'Dipakai'),
(4, 'Avanza', '2022-10-19', '0000-00-00', 'Dipakai'),
(5, 'Avanza', '2022-10-17', NULL, 'Dipakai'),
(6, 'Avanza', '2022-10-16', NULL, 'Dipakai'),
(9, 'Avanza 3', '2022-10-10', NULL, 'Dipakai'),
(10, 'Avanza 5', '2022-10-10', NULL, 'Dipakai'),
(11, 'Avanza 6', '2022-10-10', NULL, 'Dipakai'),
(12, 'Avanza 8', '2022-10-10', NULL, 'Dipakai'),
(13, 'Avanza 9', '2022-10-10', NULL, 'Dipakai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
