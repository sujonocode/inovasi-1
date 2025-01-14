-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 08:37 AM
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
(1, 'Rapat Monev Bulan Desember', '2025-01-31', '08:00:00', 'Kegiatan Rutin', '082228769126, 085334813264, 082123456789, 088111222333', '[\"Hari H\",\"H-3\",\"H-7\"]', '-'),
(2, 'Rilis Inkesra', '2025-01-31', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"H-7\"]', ' Lorem'),
(3, 'Rilis Statda', '2025-01-31', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\",\"H-3\",\"H-7\"]', '-'),
(4, 'Rapat Kinerja Bulanan', '2025-01-31', '08:00:00', 'Kegiatan Rutin', '082228769126, 085334813264', '[\"Hari H\",\"H-3\",\"H-7\"]', '-'),
(5, 'One Week BPS Kab. Tanggamus', '2025-01-30', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"Hari H\",\"H-3\",\"H-7\"]', '-'),
(6, 'Hari Natal', '2025-01-25', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\",\"H-3\",\"H-7\"]', '-'),
(7, 'Hari Ibu', '2025-01-22', '08:00:00', 'Lainnya', '082228769126, 085334813264', '[\"H-3\"]', '-'),
(8, 'Hari Kesetiakawanan', '2025-01-20', '08:00:00', 'Kegiatan Rutin', '082228769126', '[\"Hari H\",\"H-3\"]', '-'),
(9, 'Juragan', '2025-01-20', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"Hari H\",\"H-3\"]', '-'),
(10, 'Morning Briefing', '2025-01-19', '08:00:00', 'Publikasi', '082228769126, 085334813264, 082123456789, 088111222333', '[\"Hari H\",\"H-3\"]', 'Lorem ipsum sir dolor amet'),
(11, 'Hari Statistik', '2025-01-16', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\"]', ' Lorem'),
(12, 'Diskusi Internal', '2025-01-14', '08:00:00', 'Lainnya', '082228769126, 085334813264', '[\"Hari H\",\"H-7\"]', 'Meeting preparation'),
(13, 'Bintek Statistik', '2025-01-14', '08:00:00', 'Kegiatan Rutin', '082228769126, 085334813264', '[\"Hari H\",\"H-3\"]', '-'),
(14, 'Pemaparan Statistika', '2025-01-12', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"Hari H\",\"H-3\"]', '-'),
(15, 'Rilis Sosial', '2025-01-10', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\"]', '-'),
(16, 'Rilis Pertanian', '2025-01-09', '08:00:00', 'Kegiatan Rutin', '082228769126', '[\"Hari H\"]', '-'),
(17, 'Pelatihan Statistik', '2025-01-08', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"Hari H\"]', '-'),
(18, 'Koordinasi Data', '2025-01-07', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\"]', '-'),
(19, 'Rilis Inflasi', '2025-01-05', '08:00:00', 'Kegiatan Rutin', '082228769126', '[\"Hari H\",\"H-3\",\"H-7\"]', '-'),
(20, 'New Year Briefing', '2025-01-01', '08:00:00', 'Publikasi', '082228769126, 085334813264, 082123456789', '[\"Hari H\"]', '-'),
(21, 'Rilis Statistik Daerah', '2024-12-30', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\",\"H-3\"]', '-'),
(22, 'Diskusi Statistika', '2024-12-28', '08:00:00', 'Lainnya', '082228769126', '[\"H-7\"]', '-'),
(23, 'Publikasi Statistik Sosial', '2024-12-26', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\",\"H-3\"]', '-'),
(24, 'Hari Natal', '2024-12-25', '08:00:00', 'Lainnya', '082228769126', '[\"Hari H\"]', '-'),
(25, 'Persiapan Monev', '2024-12-20', '08:00:00', 'Kegiatan Rutin', '082228769126', '[\"H-7\"]', '-'),
(26, 'Koordinasi Statistik Nasional', '2024-12-18', '08:00:00', 'Lainnya', '082228769126, 085334813264', '[\"H-3\"]', '-'),
(27, 'Rilis Inflasi', '2024-12-15', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\"]', '-'),
(28, 'Rapat Akhir Tahun', '2024-12-10', '08:00:00', 'Kegiatan Rutin', '082228769126, 085334813264', '[\"Hari H\",\"H-3\",\"H-7\"]', '-'),
(29, 'Publikasi Statistik Ekonomi', '2024-12-09', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\"]', '-'),
(30, 'Statistik Lapangan', '2024-12-07', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"Hari H\"]', '-'),
(31, 'Rilis Statistik', '2024-12-05', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\",\"H-3\"]', '-'),
(32, 'Koordinasi Statistik Nasional', '2024-12-03', '08:00:00', 'Lainnya', '082228769126', '[\"Hari H\"]', '-'),
(33, 'Rilis Statistika Daerah', '2024-12-01', '08:00:00', 'Kegiatan Rutin', '082228769126', '[\"Hari H\",\"H-3\",\"H-7\"]', '-'),
(34, 'Pemetaan Statistik', '2024-11-29', '08:00:00', 'Publikasi', '082228769126', '[\"H-7\"]', '-'),
(35, 'Workshop Statistik', '2024-11-28', '08:00:00', 'Lainnya', '082228769126', '[\"H-7\",\"Hari H\"]', '-'),
(36, 'Rapat Evaluasi', '2024-11-27', '08:00:00', 'Kegiatan Rutin', '082228769126', '[\"H-3\",\"Hari H\"]', '-'),
(37, 'Sensus Penduduk', '2024-11-25', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"H-7\",\"Hari H\"]', '-'),
(38, 'Penyuluhan Statistik', '2024-11-23', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\"]', '-'),
(39, 'Pelatihan Data', '2024-11-22', '08:00:00', 'Lainnya', '082228769126', '[\"H-7\",\"H-3\",\"Hari H\"]', '-'),
(40, 'Monitoring Lapangan', '2024-11-20', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"Hari H\"]', '-'),
(41, 'Rapat Persiapan Rutin', '2024-11-18', '08:00:00', 'Kegiatan Rutin', '082228769126', '[\"H-7\",\"H-3\"]', '-'),
(42, 'Diskusi Pengolahan Data', '2024-11-15', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\"]', '-'),
(43, 'Rilis Statistik Tahunan', '2024-11-12', '08:00:00', 'Publikasi', '082228769126', '[\"H-7\",\"Hari H\"]', '-'),
(44, 'Survei Lapangan', '2024-11-10', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"Hari H\",\"H-3\"]', '-'),
(45, 'Rapat Koordinasi', '2024-11-08', '08:00:00', 'Kegiatan Rutin', '082228769126', '[\"H-7\",\"Hari H\"]', '-'),
(46, 'Pelatihan Analisis Data', '2024-11-06', '08:00:00', 'Lainnya', '082228769126', '[\"H-3\"]', '-'),
(47, 'Publikasi Sosial Tahunan', '2024-11-05', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\"]', '-'),
(48, 'Analisis Data Statistik', '2024-11-03', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"H-3\",\"Hari H\"]', '-'),
(49, 'Diskusi Tahunan Statistik', '2024-11-01', '08:00:00', 'Publikasi', '082228769126', '[\"H-3\",\"Hari H\"]', '-'),
(50, 'Rapat Monitoring Statistik', '2024-10-30', '08:00:00', 'Kegiatan Rutin', '082228769126', '[\"Hari H\"]', '-'),
(51, 'Workshop Internasional', '2024-10-28', '08:00:00', 'Lainnya', '082228769126', '[\"H-7\",\"H-3\",\"Hari H\"]', '-'),
(52, 'Persiapan Akhir Tahun', '2024-10-25', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"Hari H\"]', '-'),
(53, 'Penyuluhan Statistik Nasional', '2024-10-23', '08:00:00', 'Publikasi', '082228769126', '[\"H-3\",\"Hari H\"]', '-'),
(54, 'Publikasi Statistik Regional', '2024-10-20', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\"]', '-'),
(55, 'Koordinasi Statistik Wilayah', '2024-10-18', '08:00:00', 'Lainnya', '082228769126', '[\"H-7\"]', '-'),
(56, 'Pemetaan Data Statistik', '2024-10-15', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"Hari H\"]', '-'),
(57, 'Rilis Data Perkotaan', '2024-10-12', '08:00:00', 'Publikasi', '082228769126', '[\"Hari H\"]', '-'),
(58, 'Sensus Regional', '2024-10-10', '08:00:00', 'Dokumentasi Lapangan', '082228769126', '[\"H-7\",\"Hari H\"]', '-'),
(59, 'Rapat Statistik Bulanan', '2024-10-08', '08:00:00', 'Kegiatan Rutin', '082228769126', '[\"H-3\",\"Hari H\"]', '-'),
(60, 'Rilis Statda', '2024-12-01', '08:00:00', 'Kegiatan Rutin', '082228769126', '[\"Hari H\",\"H-3\",\"H-7\"]', '-');

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
-- Indexes for table `jadwal_konten`
--
ALTER TABLE `jadwal_konten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontrak`
--
ALTER TABLE `kontrak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sk`
--
ALTER TABLE `sk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_konten`
--
ALTER TABLE `jadwal_konten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `kontrak`
--
ALTER TABLE `kontrak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sk`
--
ALTER TABLE `sk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
