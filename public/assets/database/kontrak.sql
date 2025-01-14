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
-- Table structure for table `kontrak`
--

CREATE TABLE `kontrak` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `uraian` varchar(150) NOT NULL,
  `catatan` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `nomor_urut` varchar(5) NOT NULL,
  `nomor_sisip` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontrak`
--

INSERT INTO `kontrak` (`id`, `tanggal`, `nomor`, `uraian`, `catatan`, `url`, `nomor_urut`, `nomor_sisip`) VALUES
(1, '2024-01-17', '025/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Rahma', '-', '25', '0'),
(2, '2024-01-18', '024/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Sandi', '-', '24', '0'),
(3, '2024-01-02', '001/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Sucipto', '-', '1', '0'),
(4, '2024-01-03', '002/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Ruslan', '-', '2', '0'),
(5, '2024-01-04', '003/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Suci', '-', '3', '0'),
(6, '2024-01-04', '004/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Sulaiman', '-', '4', '0'),
(7, '2024-01-05', '005/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Mukid Sanjaya', '-', '5', '0'),
(8, '2024-01-05', '006/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Endro', '-', '6', '0'),
(9, '2024-01-06', '007/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Yenli', '-', '7', '0'),
(10, '2024-01-07', '008/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Syahrizal', '-', '8', '0'),
(11, '2024-01-07', '009/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Umi Azizah', '-', '9', '0'),
(12, '2024-01-07', '010/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Murdiono', '-', '10', '0'),
(13, '2024-01-08', '011/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Islam', '-', '11', '0'),
(14, '2024-01-08', '012/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Oop Supardi', '-', '12', '0'),
(15, '2024-01-09', '013/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Margaret', '-', '13', '0'),
(16, '2024-01-09', '014/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Vitri Anggraeni', '-', '14', '0'),
(17, '2024-01-10', '015/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Triyanto', '-', '15', '0'),
(18, '2024-01-11', '016/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Zaenab', '-', '16', '0'),
(19, '2024-01-12', '017/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Sarbini', '-', '17', '0'),
(20, '2024-01-12', '018/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Peti Suharsono', '-', '18', '0'),
(21, '2024-01-12', '019/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Sazli', '-', '19', '0'),
(22, '2024-01-13', '020/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Bandi', '-', '20', '0'),
(23, '2024-01-14', '021/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Armas', '-', '21', '0'),
(24, '2024-01-15', '022/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Rahmad Setiaji', '-', '22', '0'),
(25, '2024-01-16', '023/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Rama Ardiansyah', '-', '23', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kontrak`
--
ALTER TABLE `kontrak`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontrak`
--
ALTER TABLE `kontrak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
