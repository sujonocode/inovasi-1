-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 07:12 AM
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
  `catatan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontrak`
--

INSERT INTO `kontrak` (`id`, `tanggal`, `nomor`, `uraian`, `catatan`) VALUES
(1, '2023-12-29', '12.29.01/DUKMAN/2886.EBA/PL.210/18020/2023', 'Surat Pesanan Tenaga Jasa Kebersihan (Outsourcing) kepada Penyedia PT. PKSS', 'Pelaksanaan kontrak 1 Jan s.d 31 Des 2024'),
(2, '2023-12-29', '12.29.02/DUKMAN/2886.EBA/PL.210/18020/2023', 'Surat Pesanan Tenaga Jasa Keamanan (Outsourcing) kepada Penyedia PT. PKSS', 'Pelaksanaan kontrak 1 Jan s.d 31 Des 2024'),
(3, '2024-01-02', '001/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Sucipto'),
(4, '2024-01-02', '002/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Ruslan'),
(5, '2024-01-02', '003/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Suci'),
(6, '2024-01-02', '004/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Sulaiman'),
(7, '2024-01-02', '005/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Mukid Sanjaya'),
(8, '2024-01-02', '006/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Endro'),
(9, '2024-01-02', '007/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Yenli'),
(10, '2024-01-02', '008/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Syahrizal'),
(11, '2024-01-02', '009/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Umi Azizah'),
(12, '2024-01-02', '010/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Murdiono'),
(13, '2024-01-02', '011/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Islam'),
(14, '2024-01-02', '012/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Oop Supardi'),
(15, '2024-01-02', '013/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Margaret'),
(16, '2024-01-02', '014/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Vitri Anggraeni'),
(17, '2024-01-02', '015/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Triyanto'),
(18, '2024-01-02', '016/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Zaenab'),
(19, '2024-01-02', '017/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Sarbini'),
(20, '2024-01-02', '018/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Peti Suharsono'),
(21, '2024-01-02', '019/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Sazli'),
(22, '2024-01-02', '020/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Bandi'),
(23, '2024-01-02', '021/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Armas'),
(24, '2024-01-02', '022/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Rahmad Setiaji'),
(25, '2024-01-02', '023/KONTRAK-MITRA/VS.330/01/2024', 'Kontrak Petugas Bulan Januari', 'Rama Ardiansyah');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
