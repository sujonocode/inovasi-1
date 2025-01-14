-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 08:32 AM
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
-- Database: `inovasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `sk`
--

CREATE TABLE `sk` (
  `id` int(11) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(150) NOT NULL,
  `catatan` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `nomor_urut` varchar(5) NOT NULL,
  `nomor_sisip` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sk`
--

INSERT INTO `sk` (`id`, `nomor`, `tanggal`, `perihal`, `catatan`, `url`, `nomor_urut`, `nomor_sisip`) VALUES
(1, '001/1802/KPA TAHUN 2025', '2025-01-02', 'SK Pembayaran Uang Makan Tahun 2025', '-', '-', '1', '0'),
(2, '002/1802/KPA TAHUN 2025', '2025-01-02', 'SK Pembayaran Tunjangan Kinerja Tahun 2025', '-', '-', '2', '0'),
(3, '003/1802/KPA TAHUN 2025', '2025-01-03', 'SK Pembayaran Honor Pengelola Keuangan Tahun 2025', '-', '-', '3', '0'),
(4, '004/1802/KPA TAHUN 2025', '2025-01-04', 'SK Pembayaran Honor SAI Tahun 2025', '-', '-', '4', '0'),
(5, '005/1802/KPA TAHUN 2025', '2025-01-06', 'SK Tim Lelang 2025', '-', '-', '5', '0'),
(6, '006/1802/KPA TAHUN 2025', '2025-01-08', 'SK Tim Lelang', '-', '-', '6', '0'),
(7, '007/1802/KPA TAHUN 2025', '2025-01-10', 'SK Tim Kerja RB', '-', '-', '7', '0'),
(8, '008/1802/KPA TAHUN 2025', '2025-01-11', 'SK Tim Pembangunan ZI', '-', '-', '8', '0'),
(9, '009/1802/KPA TAHUN 2025', '2025-01-12', 'SK Rate Transport Ke TC Gisting', '-', '-', '9', '0'),
(10, '010/1802/KPA TAHUN 2025', '2025-01-12', 'SK Penetapan Petugas Susenas', '-', '-', '10', '0'),
(11, '011/1802/KPA TAHUN 2025', '2025-01-12', 'SK Penetapan Petugas Pengajar Sakernas', '-', '-', '11', '0'),
(12, '012/1802/KPA TAHUN 2025', '2025-01-13', 'SK Penetapan Petugas Sakernas', '-', '-', '12', '0'),
(13, '013/1802/KPA TAHUN 2025', '2025-01-13', 'SK Penetapan Pengajar Petugas Sakernas', '-', '-', '13', '0'),
(14, '014/1802/KPA TAHUN 2025', '2025-01-13', 'SK Penetapan Pengajar Petugas Susenas', '-', '-', '14', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sk`
--
ALTER TABLE `sk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sk`
--
ALTER TABLE `sk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
