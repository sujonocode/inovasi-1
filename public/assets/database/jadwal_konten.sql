-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 06:13 AM
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
-- Table structure for table `jadwal_konten`
--

CREATE TABLE `jadwal_konten` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `kontak` varchar(150) NOT NULL,
  `pengingat` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `catatan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_konten`
--

INSERT INTO `jadwal_konten` (`id`, `nama`, `tanggal`, `waktu`, `kategori`, `kontak`, `pengingat`, `catatan`) VALUES
(1, 'Rapat Monev Bulan Desember', '2025-01-31', '08:00:00', 'Kegiatan Rutin', '082228769126, 085334813264, 082123456789, 088111222333', '["Hari H","H-3","H-7"]', '-'),
(2, 'Rilis Inkesra', '2025-01-31', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["H-3"]', '-'),
(3, 'Rilis Statda', '2025-01-31', '08:00:00', 'Publikasi', '082228769126', '["Hari H","H-3","H-7"]', '-'),
(4, 'Rapat Kinerja Bulanan', '2025-01-31', '08:00:00', 'Kegiatan Rutin', '082228769126, 085334813264', '["Hari H","H-3","H-7"]', '-'),
(5, 'One Week BPS Kab. Tanggamus', '2025-01-30', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["Hari H","H-3","H-7"]', '-'),
(6, 'Hari Natal', '2025-01-25', '08:00:00', 'Publikasi', '082228769126', '["Hari H","H-3","H-7"]', '-'),
(7, 'Hari Ibu', '2025-01-22', '08:00:00', 'Lainnya', '082228769126, 085334813264', '["H-3"]', '-'),
(8, 'Hari Kesetiakawanan', '2025-01-20', '08:00:00', 'Kegiatan Rutin', '082228769126', '["Hari H","H-3"]', '-'),
(9, 'Juragan', '2025-01-20', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["Hari H","H-3"]', '-'),
(10, 'Morning Briefing', '2025-01-19', '08:00:00', 'Publikasi', '082228769126, 085334813264, 082123456789, 088111222333', '["Hari H","H-3"]', 'Lorem ipsum sir dolor amet'),
(11, 'Hari Statistik', '2025-01-16', '08:00:00', 'Publikasi', '082228769126', '["Hari H"]', '-'),
(12, 'Diskusi Internal', '2025-01-14', '08:00:00', 'Lainnya', '082228769126, 085334813264', '["Hari H","H-7"]', 'Meeting preparation'),
(13, 'Bintek Statistik', '2025-01-14', '08:00:00', 'Kegiatan Rutin', '082228769126, 085334813264', '["Hari H","H-3"]', '-'),
(14, 'Pemaparan Statistika', '2025-01-12', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["Hari H","H-3"]', '-'),
(15, 'Rilis Sosial', '2025-01-10', '08:00:00', 'Publikasi', '082228769126', '["Hari H"]', '-'),
(16, 'Rilis Pertanian', '2025-01-09', '08:00:00', 'Kegiatan Rutin', '082228769126', '["Hari H"]', '-'),
(17, 'Pelatihan Statistik', '2025-01-08', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["Hari H"]', '-'),
(18, 'Koordinasi Data', '2025-01-07', '08:00:00', 'Publikasi', '082228769126', '["Hari H"]', '-'),
(19, 'Rilis Inflasi', '2025-01-05', '08:00:00', 'Kegiatan Rutin', '082228769126', '["Hari H","H-3","H-7"]', '-'),
(20, 'New Year Briefing', '2025-01-01', '08:00:00', 'Publikasi', '082228769126, 085334813264, 082123456789', '["Hari H"]', '-'),
(21, 'Rilis Statistik Daerah', '2024-12-30', '08:00:00', 'Publikasi', '082228769126', '["Hari H","H-3"]', '-'),
(22, 'Diskusi Statistika', '2024-12-28', '08:00:00', 'Lainnya', '082228769126', '["H-7"]', '-'),
(23, 'Publikasi Statistik Sosial', '2024-12-26', '08:00:00', 'Publikasi', '082228769126', '["Hari H","H-3"]', '-'),
(24, 'Hari Natal', '2024-12-25', '08:00:00', 'Lainnya', '082228769126', '["Hari H"]', '-'),
(25, 'Persiapan Monev', '2024-12-20', '08:00:00', 'Kegiatan Rutin', '082228769126', '["H-7"]', '-'),
(26, 'Koordinasi Statistik Nasional', '2024-12-18', '08:00:00', 'Lainnya', '082228769126, 085334813264', '["H-3"]', '-'),
(27, 'Rilis Inflasi', '2024-12-15', '08:00:00', 'Publikasi', '082228769126', '["Hari H"]', '-'),
(28, 'Rapat Akhir Tahun', '2024-12-10', '08:00:00', 'Kegiatan Rutin', '082228769126, 085334813264', '["Hari H","H-3","H-7"]', '-'),
(29, 'Publikasi Statistik Ekonomi', '2024-12-09', '08:00:00', 'Publikasi', '082228769126', '["Hari H"]', '-'),
(30, 'Statistik Lapangan', '2024-12-07', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["Hari H"]', '-'),
(31, 'Rilis Statistik', '2024-12-05', '08:00:00', 'Publikasi', '082228769126', '["Hari H","H-3"]', '-'),
(32, 'Koordinasi Statistik Nasional', '2024-12-03', '08:00:00', 'Lainnya', '082228769126', '["Hari H"]', '-'),
(33, 'Rilis Statistika Daerah', '2024-12-01', '08:00:00', 'Kegiatan Rutin', '082228769126', '["Hari H","H-3","H-7"]', '-'),
(34, 'Pemetaan Statistik', '2024-11-29', '08:00:00', 'Publikasi', '082228769126', '["H-7"]', '-'),
(35, 'Workshop Statistik', '2024-11-28', '08:00:00', 'Lainnya', '082228769126', '["H-7","Hari H"]', '-'),
(36, 'Rapat Evaluasi', '2024-11-27', '08:00:00', 'Kegiatan Rutin', '082228769126', '["H-3","Hari H"]', '-'),
(37, 'Sensus Penduduk', '2024-11-25', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["H-7","Hari H"]', '-'),
(38, 'Penyuluhan Statistik', '2024-11-23', '08:00:00', 'Publikasi', '082228769126', '["Hari H"]', '-'),
(39, 'Pelatihan Data', '2024-11-22', '08:00:00', 'Lainnya', '082228769126', '["H-7","H-3","Hari H"]', '-'),
(40, 'Monitoring Lapangan', '2024-11-20', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["Hari H"]', '-'),
(41, 'Rapat Persiapan Rutin', '2024-11-18', '08:00:00', 'Kegiatan Rutin', '082228769126', '["H-7","H-3"]', '-'),
(42, 'Diskusi Pengolahan Data', '2024-11-15', '08:00:00', 'Publikasi', '082228769126', '["Hari H"]', '-'),
(43, 'Rilis Statistik Tahunan', '2024-11-12', '08:00:00', 'Publikasi', '082228769126', '["H-7","Hari H"]', '-'),
(44, 'Survei Lapangan', '2024-11-10', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["Hari H","H-3"]', '-'),
(45, 'Rapat Koordinasi', '2024-11-08', '08:00:00', 'Kegiatan Rutin', '082228769126', '["H-7","Hari H"]', '-'),
(46, 'Pelatihan Analisis Data', '2024-11-06', '08:00:00', 'Lainnya', '082228769126', '["H-3"]', '-'),
(47, 'Publikasi Sosial Tahunan', '2024-11-05', '08:00:00', 'Publikasi', '082228769126', '["Hari H"]', '-'),
(48, 'Analisis Data Statistik', '2024-11-03', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["H-3","Hari H"]', '-'),
(49, 'Diskusi Tahunan Statistik', '2024-11-01', '08:00:00', 'Publikasi', '082228769126', '["H-3","Hari H"]', '-'),
(50, 'Rapat Monitoring Statistik', '2024-10-30', '08:00:00', 'Kegiatan Rutin', '082228769126', '["Hari H"]', '-'),
(51, 'Workshop Internasional', '2024-10-28', '08:00:00', 'Lainnya', '082228769126', '["H-7","H-3","Hari H"]', '-'),
(52, 'Persiapan Akhir Tahun', '2024-10-25', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["Hari H"]', '-'),
(53, 'Penyuluhan Statistik Nasional', '2024-10-23', '08:00:00', 'Publikasi', '082228769126', '["H-3","Hari H"]', '-'),
(54, 'Publikasi Statistik Regional', '2024-10-20', '08:00:00', 'Publikasi', '082228769126', '["Hari H"]', '-'),
(55, 'Koordinasi Statistik Wilayah', '2024-10-18', '08:00:00', 'Lainnya', '082228769126', '["H-7"]', '-'),
(56, 'Pemetaan Data Statistik', '2024-10-15', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["Hari H"]', '-'),
(57, 'Rilis Data Perkotaan', '2024-10-12', '08:00:00', 'Publikasi', '082228769126', '["Hari H"]', '-'),
(58, 'Sensus Regional', '2024-10-10', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '["H-7","Hari H"]', '-'),
(59, 'Rapat Statistik Bulanan', '2024-10-08', '08:00:00', 'Kegiatan Rutin', '082228769126', '["H-3","Hari H"]', '-'),
(60, 'Rilis Statda', '2024-12-01', '08:00:00', 'Kegiatan Rutin', '082228769126', '["Hari H","H-3","H-7"]', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal_konten`
--
ALTER TABLE `jadwal_konten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_konten`
--
ALTER TABLE `jadwal_konten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
