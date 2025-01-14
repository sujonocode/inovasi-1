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
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `ringkasan` varchar(150) NOT NULL,
  `pert_dahulu` varchar(50) NOT NULL,
  `pert_berikut` varchar(50) NOT NULL,
  `catatan` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `nomor_urut` varchar(5) NOT NULL,
  `nomor_sisip` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id`, `tanggal`, `alamat`, `ringkasan`, `pert_dahulu`, `pert_berikut`, `catatan`, `url`, `nomor_urut`, `nomor_sisip`) VALUES
(1, '2025-01-02', 'BAST BMN', 'Pemegang Kendaraan', 'B-001/18020/PL.610/2025', '-', '-', '-', '1', '0'),
(2, '2025-01-02', 'BAST BMN', 'Pemegang Kendaraan', 'B-002/18020/PL.610/2025', '-', '-', '-', '2', '0'),
(3, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-003/18020/PL.610/2025', '-', '-', '-', '3', '0'),
(4, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-004/18020/PL.610/2025', '-', '-', '-', '4', '0'),
(5, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-005/18020/PL.610/2025', '-', '-', '-', '5', '0'),
(6, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-006/18020/PL.610/2025', '-', '-', '-', '6', '0'),
(7, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-007/18020/PL.610/2025', '-', '-', '-', '7', '0'),
(8, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-008/18020/PL.610/2025', '-', '-', '-', '8', '0'),
(9, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-009/18020/PL.610/2025', '-', '-', '-', '9', '0'),
(10, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-010/18020/PL.610/2025', '-', '-', '-', '10', '0'),
(11, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-011/18020/PL.610/2025', '-', '-', '-', '11', '0'),
(12, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-012/18020/PL.610/2025', '-', '-', '-', '12', '0'),
(13, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-013/18020/PL.610/2025', '-', '-', '-', '13', '0'),
(14, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-014/18020/PL.610/2025', '-', '-', '-', '14', '0'),
(15, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-015/18020/PL.610/2025', '-', '-', '-', '15', '0'),
(16, '2025-01-02', 'BAST BMN', 'Pemegang Laptop', 'B-016/18020/PL.610/2025', '-', '-', '-', '16', '0'),
(17, '2025-01-02', 'Seluruh Pegawai', 'Surat Pakaian Kerja', 'B-017/18020/KP.371/2025', '-', '-', '-', '17', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
