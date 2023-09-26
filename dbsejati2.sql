-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2023 at 09:39 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsejati2`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id_absen`, `nama`, `status`, `tanggal`) VALUES
(3, 'Tedy ', 'Izin', '2023-09-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_pasang`
--

CREATE TABLE `bahan_pasang` (
  `id_pasang` int(5) UNSIGNED NOT NULL,
  `nama_pasang` varchar(100) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `alamat` varchar(100) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bahan_pasang`
--

INSERT INTO `bahan_pasang` (`id_pasang`, `nama_pasang`, `tanggal`, `alamat`, `tanggal_input`, `tanggal_ubah`) VALUES
(6, 'Ustad Aulia', '2023-07-20 00:00:00', 'Jl Lambung Gg 09', '2023-07-20 05:30:28', '2023-07-20 05:30:28'),
(7, 'Mebel Yoga (H. Agus)', '2023-07-20 00:00:00', 'Garden Hill', '2023-07-20 06:04:57', '2023-07-20 06:04:57'),
(8, 'Pemasangan atau Perbaikan Gudang ', '2023-07-20 00:00:00', 'Pelita 4', '2023-07-20 06:07:01', '2023-07-20 06:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `bayarhbk`
--

CREATE TABLE `bayarhbk` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_hbk` int(5) NOT NULL,
  `id_pasang` int(5) NOT NULL,
  `kwitansi` varchar(200) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `bayar` int(5) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bayarhbk`
--

INSERT INTO `bayarhbk` (`id`, `id_hbk`, `id_pasang`, `kwitansi`, `tanggal`, `bayar`, `keterangan`, `tanggal_input`, `tanggal_ubah`) VALUES
(29, 33, 51, '01/HBK-ASN/IX/2023', '2023-09-10 00:00:00', 537000, 'Lunas', '2023-09-10 10:29:53', '2023-09-10 10:29:53'),
(34, 39, 57, '02/HBK-ASN/IX/2023', '2023-09-23 00:00:00', 2000000, '-', '2023-09-23 06:49:14', '2023-09-23 06:49:14'),
(35, 36, 54, '03/HBK-ASN/IX/2023', '2023-09-23 00:00:00', 1150000, '-', '2023-09-23 06:49:33', '2023-09-23 06:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `bayarpasang`
--

CREATE TABLE `bayarpasang` (
  `id` int(5) UNSIGNED NOT NULL,
  `kwitansi` varchar(100) NOT NULL,
  `id_pasang` int(5) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `bayar` int(5) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bayarpasang`
--

INSERT INTO `bayarpasang` (`id`, `kwitansi`, `id_pasang`, `tanggal`, `bayar`, `keterangan`, `tanggal_input`, `tanggal_ubah`) VALUES
(68, '01/KWI-ASN/IX/2023', 51, '2023-09-10 00:00:00', 1028000, 'Pelunasan', '2023-09-10 10:29:00', '2023-09-10 10:29:00'),
(70, '02/KWI-ASN/IX/2023', 57, '2023-09-23 00:00:00', 4000000, '-', '2023-09-23 07:20:19', '2023-09-23 07:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `bulanan`
--

CREATE TABLE `bulanan` (
  `id_bulanan` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor` int(100) NOT NULL,
  `tempo` int(5) NOT NULL,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bulanan`
--

INSERT INTO `bulanan` (`id_bulanan`, `nama`, `nomor`, `tempo`, `keterangan`) VALUES
(3, 'Air Sejati', 555555, 10, '-');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id_deposit` int(5) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `nilai` int(15) NOT NULL,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id_deposit`, `tanggal`, `nama`, `nilai`, `keterangan`) VALUES
(3, '2023-09-18', 'tesla', 100000, '-');

-- --------------------------------------------------------

--
-- Table structure for table `detail_bahan`
--

CREATE TABLE `detail_bahan` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_pasang` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `detail_bahan`
--

INSERT INTO `detail_bahan` (`id`, `id_pasang`, `id_produk`, `keterangan`, `jumlah`, `tanggal`, `tanggal_input`, `tanggal_ubah`) VALUES
(12, 6, 277, '-', 1, '2023-07-20 00:00:00', NULL, NULL),
(13, 6, 554, '-', 1, '2023-07-20 00:00:00', NULL, NULL),
(14, 6, 129, '-', 60, '2023-07-20 00:00:00', NULL, NULL),
(15, 6, 122, '-', 2, '2023-07-20 00:00:00', NULL, NULL),
(16, 6, 46, '-', 21, '2023-07-20 00:00:00', NULL, NULL),
(17, 6, 267, '-', 4, '2023-07-20 00:00:00', NULL, NULL),
(18, 6, 544, '-', 4, '2023-07-20 00:00:00', NULL, NULL),
(19, 6, 41, '-', 16, '2023-07-20 00:00:00', NULL, NULL),
(20, 6, 131, '1/2 bungkus es', 1, '2023-07-20 00:00:00', NULL, NULL),
(21, 6, 52, '-', 21, '2023-07-20 00:00:00', NULL, NULL),
(22, 6, 137, '-', 2, '2023-07-20 00:00:00', NULL, NULL),
(23, 6, 47, '-', 2, '2023-07-20 00:00:00', NULL, NULL),
(25, 7, 137, '-', 2, '2023-07-20 00:00:00', NULL, NULL),
(26, 8, 80, '-', 1, '2023-07-20 00:00:00', NULL, NULL),
(27, 8, 122, '-', 1, '2023-07-20 00:00:00', NULL, NULL),
(28, 8, 92, '-', 7, '2023-07-20 00:00:00', NULL, NULL),
(29, 8, 137, '-', 1, '2023-07-20 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_bulanan`
--

CREATE TABLE `detail_bulanan` (
  `id` int(5) NOT NULL,
  `id_bulanan` int(5) NOT NULL,
  `bayar` int(15) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_bulanan`
--

INSERT INTO `detail_bulanan` (`id`, `id_bulanan`, `bayar`, `tanggal`, `keterangan`) VALUES
(1, 3, 50000, '2023-09-20', '-');

-- --------------------------------------------------------

--
-- Table structure for table `detail_hbk`
--

CREATE TABLE `detail_hbk` (
  `id` int(5) NOT NULL,
  `id_hbk` int(5) NOT NULL,
  `uraian` varchar(200) NOT NULL,
  `ukuran` varchar(50) NOT NULL,
  `volume` decimal(10,2) NOT NULL,
  `harga` int(10) NOT NULL,
  `biaya` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_hbk`
--

INSERT INTO `detail_hbk` (`id`, `id_hbk`, `uraian`, `ukuran`, `volume`, `harga`, `biaya`) VALUES
(6, 1, 'Pasang Plafon Ruang Tamu ( Trap 1 )', 'M2', '11.00', 55000, 590150),
(9, 1, 'Pasang Lampu Downled 6w ( Lampu )', 'Titik', '4.00', 15000, 60000),
(10, 1, 'Pasang LED Strip ( Lampu )', 'Titik', '3.00', 30000, 90000),
(11, 13, 'Pengerjaan Plafon Ruang Keluarga ( Trap 1 )', 'M2', '20.00', 55000, 1100000),
(12, 13, 'Pasang Lampu Downled 6w ( Lampu )', 'Titik', '4.00', 15000, 60000),
(13, 19, 'Plafon PVC ( Trap 1 )', 'M2', '20.00', 20000, 400000),
(14, 20, 'Plafon PVC ( Trap 1 )', 'M2', '20.00', 500000, 10000000),
(16, 25, 'Plafon PVC ( Trap 1 )', 'M2', '10.73', 50000, 536500),
(26, 32, 'Plafon PVC ( Lurusan )', 'M2', '10.73', 50000, 536500),
(27, 33, 'Plafon PVC ( Lurusan )', 'M2', '10.73', 50000, 536500),
(28, 34, 'Plafon PVC ( Lurusan )', 'M2', '20.00', 50000, 1000000),
(29, 35, 'Plafon PVC ( Lurusan )', 'M2', '20.00', 500000, 10000000),
(30, 36, 'Plafon PVC ( Trap 2 )', 'M2', '20.00', 50000, 1000000),
(31, 36, 'Aksesoris ( Lampu )', 'Pcs', '10.00', 15000, 150000),
(39, 39, 'Plafon PVC ( Trap 1 )', 'Titik', '20.00', 50000, 1000000),
(40, 39, 'Aksesoris ( Lampu )', 'Pcs', '20.00', 50000, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_hutang`
--

CREATE TABLE `detail_hutang` (
  `id` int(5) NOT NULL,
  `id_hutang` int(5) NOT NULL,
  `tanggal` text DEFAULT NULL,
  `sumber` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `bayar` int(15) NOT NULL,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_hutang`
--

INSERT INTO `detail_hutang` (`id`, `id_hutang`, `tanggal`, `sumber`, `tujuan`, `bayar`, `keterangan`) VALUES
(4, 2, '2023-09-19', 'PettyCash ( PC )', 'PT Rusdianto ( 5666717 )', 500000, '-'),
(5, 2, '2023-09-19', 'PettyCash ( PC )', 'PT Rusdianto ( 5666717 )', 4500000, '-');

-- --------------------------------------------------------

--
-- Table structure for table `detail_order`
--

CREATE TABLE `detail_order` (
  `id` int(5) NOT NULL,
  `id_order` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `spek` varchar(500) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_order`
--

INSERT INTO `detail_order` (`id`, `id_order`, `nama`, `spek`, `jumlah`) VALUES
(1, 3, 'Kabel', 'Panjang Roll 30m ', 1),
(2, 3, 'lampu Downled', '6 watt', 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemasangan`
--

CREATE TABLE `detail_pemasangan` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_survei` int(5) NOT NULL,
  `uraian` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `biaya` int(15) NOT NULL,
  `id_sub` int(5) NOT NULL,
  `volume` decimal(10,2) NOT NULL,
  `ukuran` varchar(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `detail_pemasangan`
--

INSERT INTO `detail_pemasangan` (`id`, `id_survei`, `uraian`, `keterangan`, `biaya`, `id_sub`, `volume`, `ukuran`, `harga`, `tanggal_input`, `tanggal_ubah`) VALUES
(27, 17, 'Pasang Plafon Ruang Tamu', '', 2750000, 8, '11.00', 'M2', 250000, NULL, NULL),
(28, 17, 'Pasang Lampu Downled 6w', '', 600000, 9, '4.00', 'Pcs', 150000, NULL, NULL),
(29, 17, 'Pasang LED Strip', '', 300000, 9, '3.00', 'Pcs', 100000, NULL, NULL),
(30, 26, 'Pengerjaan Plafon Ruang Keluarga', '', 4600000, 8, '20.00', 'M2', 230000, NULL, NULL),
(31, 26, 'Pasang Lampu Downled 6w', '', 400000, 9, '4.00', 'Pcs', 100000, NULL, NULL),
(32, 27, 'Pengerjaan Plafon PVC', '', 50000000, 8, '20.00', 'M2', 2500000, NULL, NULL),
(33, 28, 'Pengerjaan Kitchen set ', '', 50000000, 12, '20.00', 'M2', 2500000, NULL, NULL),
(35, 29, 'Plafon PVC', '', 10000000, 8, '20.00', 'M2', 500000, NULL, NULL),
(51, 21, 'Pengerjaan Plafon PVC', '', 536500, 7, '10.73', 'M2', 50000, NULL, NULL),
(60, 36, '', '', 107300, 12, '10.73', 'Titik', 10000, NULL, NULL),
(62, 41, '', '', 3000000, 12, '20.00', 'M2', 150000, NULL, NULL),
(63, 41, '', '', 5365000, 12, '10.73', 'M2', 500000, NULL, NULL),
(68, 12, '', '', 5250000, 12, '10.50', 'M2', 500000, NULL, NULL),
(73, 13, '', '', 4000000, 9, '20.00', 'Titik', 200000, NULL, NULL),
(74, 13, '', '', 4600000, 8, '20.00', 'M2', 230000, NULL, NULL),
(77, 15, '', '', 8807500, 8, '35.23', 'M2', 250000, NULL, NULL),
(78, 16, '', '', 4140000, 10, '18.00', 'M2', 230000, NULL, NULL),
(79, 18, '', '', 1028000, 10, '20.56', 'M2', 50000, NULL, NULL),
(80, 19, '', '', 4600000, 10, '20.00', 'M2', 230000, NULL, NULL),
(81, 20, '', '', 5000000, 7, '20.00', 'M2', 250000, NULL, NULL),
(82, 20, '', '', 12500000, 12, '5.00', 'M', 2500000, NULL, NULL),
(83, 20, '', '', 1500000, 9, '10.00', 'Pcs', 150000, NULL, NULL),
(84, 20, '', '', 10000000, 8, '20.00', 'M2', 500000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bayar` int(10) UNSIGNED NOT NULL,
  `status` int(2) NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `total` int(10) NOT NULL,
  `sisa` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`id`, `id_bayar`, `status`, `tanggal`, `keterangan`, `total`, `sisa`) VALUES
(13, 28, 0, '2023-08-03 00:00:00', '-', 50000, 0),
(16, 24, 0, '2023-08-06 00:00:00', 'DP', 500000, 240250),
(18, 24, 0, '2023-08-06 00:00:00', '-', 200000, 40250),
(19, 24, 0, '2023-08-06 00:00:00', '-', 40250, 0),
(22, 29, 0, '2023-08-07 00:00:00', '-', 160000, 0),
(23, 57, 0, '2023-08-08 00:00:00', 'Bayar tunai', 2850000, 0),
(24, 27, 1, '2023-08-23 00:00:00', 'Pelunasan', 924000, 0),
(85, 101, 1, '2023-08-25 00:00:00', '-', 200000, 50000),
(86, 101, 0, '2023-08-25 00:00:00', '-', 50000, 0),
(118, 126, 1, '2023-09-22 00:00:00', '-', 625000, 0),
(123, 133, 0, '2023-09-23 00:00:00', '-', 1100000, 30000),
(124, 134, 0, '2023-09-23 00:00:00', '-', 837500, 0),
(125, 136, 0, '2023-09-23 00:00:00', '-', 320760, 0),
(126, 133, 0, '2023-09-23 00:00:00', '-', 1130000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_piutang`
--

CREATE TABLE `detail_piutang` (
  `id` int(5) NOT NULL,
  `id_piutang` int(5) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `debet` int(15) NOT NULL,
  `kredit` int(15) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_piutang`
--

INSERT INTO `detail_piutang` (`id`, `id_piutang`, `keterangan`, `debet`, `kredit`, `tanggal`) VALUES
(20, 2, '-', 0, 5000, '2023-09-19'),
(21, 2, 'DP', 5000, 0, '2023-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `detail_sumber`
--

CREATE TABLE `detail_sumber` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sumber` int(2) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `keterangan` tinytext NOT NULL,
  `saldo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `detail_sumber`
--

INSERT INTO `detail_sumber` (`id`, `id_sumber`, `kode`, `keterangan`, `saldo`) VALUES
(1, 8, 'BRI', 'Penerimaan Penjualan', 1270000),
(2, 7, 'PC', 'PettyCash', 2500000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(5) UNSIGNED NOT NULL,
  `id_trans` varchar(100) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `jumlah_produk` int(5) NOT NULL,
  `subtotal` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_trans`, `id_produk`, `jumlah_produk`, `subtotal`) VALUES
(121, '02/NOTA-ASN/VII/2023', 316, 1, 990000),
(122, '02/NOTA-ASN/VII/2023', 315, 11, 792000),
(123, '03/NOTA-ASN/VII/2023', 52, 12, 600000),
(124, '04/NOTA-ASN/VII/2023', 235, 2, 1980000),
(125, '04/NOTA-ASN/VII/2023', 129, 7, 154000),
(126, '04/NOTA-ASN/VII/2023', 122, 1, 55000),
(127, '05/NOTA-ASN/VII/2023', 235, 1, 990000),
(128, '05/NOTA-ASN/VII/2023', 315, 7, 504000),
(129, '05/NOTA-ASN/VII/2023', 39, 5, 330000),
(131, '06/NOTA-ASN/VII/2023', 42, 3, 198000),
(132, '06/NOTA-ASN/VII/2023', 47, 1, 50000),
(133, '06/NOTA-ASN/VII/2023', 52, 5, 250000),
(134, '06/NOTA-ASN/VII/2023', 263, 1, 1050000),
(165, '07/NOTA-ASN/VII/2023', 53, 3, 195000),
(166, '08/NOTA-ASN/VII/2023', 315, 1, 72000),
(167, '08/NOTA-ASN/VII/2023', 42, 1, 66000),
(168, '09/NOTA-ASN/VII/2023', 192, 14, 13860000),
(169, '09/NOTA-ASN/VII/2023', 227, 1, 742500),
(170, '10/NOTA-ASN/VII/2023', 264, 3, 3150000),
(171, '10/NOTA-ASN/VII/2023', 43, 22, 1100000),
(172, '12/NOTA-ASN/VII/2023', 50, 9, 594000),
(173, '12/NOTA-ASN/VII/2023', 122, 1, 55000),
(176, '13/NOTA-ASN/VII/2023', 46, 6, 300000),
(177, '13/NOTA-ASN/VII/2023', 160, 1, 990000),
(178, '13/NOTA-ASN/VII/2023', 122, 1, 55000),
(179, '13/NOTA-ASN/VII/2023', 181, 1, 990000),
(180, '14/NOTA-ASN/VII/2023', 315, 11, 792000),
(201, '15/NOTA-ASN/VII/2023', 43, 3, 150000),
(202, '16/NOTA-ASN/VII/2023', 144, 1, 990000),
(203, '17/NOTA-ASN/VII/2023', 315, 5, 360000),
(204, '18/NOTA-ASN/VII/2023', 238, 1, 990000),
(205, '18/NOTA-ASN/VII/2023', 167, 2, 1980000),
(206, '18/NOTA-ASN/VII/2023', 317, 9, 594000),
(207, '18/NOTA-ASN/VII/2023', 46, 6, 300000),
(208, '18/NOTA-ASN/VII/2023', 44, 6, 300000),
(209, '18/NOTA-ASN/VII/2023', 122, 1, 55000),
(210, '19/NOTA-ASN/VII/2023', 235, 3, 2970000),
(211, '19/NOTA-ASN/VII/2023', 234, 2, 1485000),
(212, '19/NOTA-ASN/VII/2023', 314, 9, 486000),
(213, '19/NOTA-ASN/VII/2023', 315, 5, 360000),
(214, '19/NOTA-ASN/VII/2023', 50, 13, 858000),
(215, '19/NOTA-ASN/VII/2023', 47, 2, 100000),
(229, '20/NOTA-ASN/VII/2023', 178, 1, 990000),
(230, '20/NOTA-ASN/VII/2023', 315, 35, 2520000),
(231, '20/NOTA-ASN/VII/2023', 257, 2, 1980000),
(232, '20/NOTA-ASN/VII/2023', 245, 1, 990000),
(233, '20/NOTA-ASN/VII/2023', 42, 31, 2046000),
(234, '20/NOTA-ASN/VII/2023', 46, 16, 800000),
(235, '20/NOTA-ASN/VII/2023', 47, 2, 100000),
(236, '20/NOTA-ASN/VII/2023', 71, 4, 180000),
(237, '20/NOTA-ASN/VII/2023', 72, 3, 135000),
(238, '20/NOTA-ASN/VII/2023', 64, 10, 250000),
(239, '20/NOTA-ASN/VII/2023', 80, 1, 25000),
(240, '20/NOTA-ASN/VII/2023', 93, 2, 450000),
(241, '20/NOTA-ASN/VII/2023', 102, 1, 225000),
(242, '20/NOTA-ASN/VII/2023', 178, 1, 990000),
(243, '20/NOTA-ASN/VII/2023', 315, 35, 2520000),
(244, '20/NOTA-ASN/VII/2023', 257, 2, 1980000),
(245, '20/NOTA-ASN/VII/2023', 245, 1, 990000),
(246, '20/NOTA-ASN/VII/2023', 42, 31, 2046000),
(247, '20/NOTA-ASN/VII/2023', 46, 16, 800000),
(248, '20/NOTA-ASN/VII/2023', 47, 2, 100000),
(249, '20/NOTA-ASN/VII/2023', 71, 4, 180000),
(250, '20/NOTA-ASN/VII/2023', 72, 3, 135000),
(251, '20/NOTA-ASN/VII/2023', 64, 10, 250000),
(252, '20/NOTA-ASN/VII/2023', 80, 1, 25000),
(253, '20/NOTA-ASN/VII/2023', 93, 2, 450000),
(254, '20/NOTA-ASN/VII/2023', 102, 1, 225000),
(255, '21/NOTA-ASN/VII/2023', 178, 1, 990000),
(256, '21/NOTA-ASN/VII/2023', 315, 16, 1152000),
(257, '21/NOTA-ASN/VII/2023', 314, 11, 594000),
(258, '21/NOTA-ASN/VII/2023', 46, 8, 400000),
(259, '21/NOTA-ASN/VII/2023', 52, 8, 400000),
(260, '21/NOTA-ASN/VII/2023', 44, 9, 450000),
(261, '21/NOTA-ASN/VII/2023', 122, 1, 55000),
(262, '21/NOTA-ASN/VII/2023', 234, 1, 742500),
(263, '22/NOTA-ASN/VII/2023', 45, 10, 500000),
(264, '22/NOTA-ASN/VII/2023', 48, 1, 50000),
(265, '23/NOTA-ASN/VII/2023', 227, 2, 1485000),
(266, '23/NOTA-ASN/VII/2023', 250, 2, 1485000),
(267, '24/NOTA-ASN/VII/2023', 129, 30, 660000),
(268, '24/NOTA-ASN/VII/2023', 37, 8, 528000),
(269, '24/NOTA-ASN/VII/2023', 42, 8, 528000),
(270, '25/NOTA-ASN/VII/2023', 235, 1, 990000),
(271, '25/NOTA-ASN/VII/2023', 47, 1, 50000),
(272, '25/NOTA-ASN/VII/2023', 50, 9, 594000),
(273, '26/NOTA-ASN/VII/2023', 315, 13, 936000),
(274, '26/NOTA-ASN/VII/2023', 178, 1, 990000),
(275, '26/NOTA-ASN/VII/2023', 41, 8, 528000),
(276, '26/NOTA-ASN/VII/2023', 122, 1, 55000),
(277, '26/NOTA-ASN/VII/2023', 129, 30, 660000),
(278, '27/NOTA-ASN/VII/2023', 50, 40, 2640000),
(279, '27/NOTA-ASN/VII/2023', 52, 35, 1750000),
(280, '27/NOTA-ASN/VII/2023', 45, 35, 1750000),
(281, '27/NOTA-ASN/VII/2023', 273, 2, 2100000),
(282, '28/NOTA-ASN/VII/2023', 315, 5, 360000),
(283, '29/NOTA-ASN/VII/2023', 122, 1, 55000),
(285, '30/NOTA-ASN/VII/2023', 265, 1, 1050000),
(286, '30/NOTA-ASN/VII/2023', 267, 2, 2100000),
(287, '30/NOTA-ASN/VII/2023', 315, 7, 504000),
(288, '30/NOTA-ASN/VII/2023', 46, 11, 550000),
(289, '30/NOTA-ASN/VII/2023', 52, 17, 850000),
(290, '30/NOTA-ASN/VII/2023', 129, 40, 880000),
(291, '30/NOTA-ASN/VII/2023', 122, 1, 55000),
(292, '31/NOTA-ASN/VII/2023', 46, 2, 100000),
(293, '31/NOTA-ASN/VII/2023', 52, 6, 300000),
(297, '32/NOTA-ASN/VII/2023', 44, 4, 200000),
(298, '32/NOTA-ASN/VII/2023', 137, 1, 10000),
(303, '33/NOTA-ASN/VII/2023', 505, 2, 144000),
(304, '33/NOTA-ASN/VII/2023', 51, 8, 400000),
(305, '33/NOTA-ASN/VII/2023', 217, 1, 990000),
(306, '33/NOTA-ASN/VII/2023', 45, 1, 50000),
(312, '34/NOTA-ASN/VII/2023', 92, 6, 570000),
(313, '34/NOTA-ASN/VII/2023', 52, 3, 150000),
(314, '35/NOTA-ASN/VII/2023', 46, 1, 50000),
(315, '35/NOTA-ASN/VII/2023', 76, 1, 65000),
(316, '36/NOTA-ASN/VII/2023', 144, 2, 1980000),
(317, '36/NOTA-ASN/VII/2023', 155, 2, 1980000),
(318, '36/NOTA-ASN/VII/2023', 39, 5, 330000),
(319, '36/NOTA-ASN/VII/2023', 52, 10, 500000),
(320, '36/NOTA-ASN/VII/2023', 46, 10, 500000),
(321, '36/NOTA-ASN/VII/2023', 122, 3, 165000),
(322, '36/NOTA-ASN/VII/2023', 73, 1, 65000),
(323, '36/NOTA-ASN/VII/2023', 66, 25, 625000),
(324, '36/NOTA-ASN/VII/2023', 80, 5, 125000),
(325, '36/NOTA-ASN/VII/2023', 129, 50, 1100000),
(326, '36/NOTA-ASN/VII/2023', 72, 4, 180000),
(327, '37/NOTA-ASN/VII/2023', 264, 1, 1050000),
(328, '37/NOTA-ASN/VII/2023', 42, 4, 264000),
(329, '38/NOTA-ASN/VII/2023', 264, 1, 1050000),
(330, '39/NOTA-ASN/VII/2023', 99, 2, 450000),
(346, '41/NOTA-ASN/VII/2023', 49, 15, 990000),
(347, '41/NOTA-ASN/VII/2023', 51, 4, 200000),
(348, '41/NOTA-ASN/VII/2023', 45, 4, 200000),
(349, '41/NOTA-ASN/VII/2023', 464, 2, 108000),
(352, '42/NOTA-ASN/VII/2023', 277, 2, 2100000),
(353, '42/NOTA-ASN/VII/2023', 44, 14, 700000),
(355, '43/NOTA-ASN/VII/2023', 556, 1, 1500000),
(356, '44/NOTA-ASN/VII/2023', 86, 1, 25000),
(357, '45/NOTA-ASN/VII/2023', 50, 2, 132000),
(364, '47/NOTA-ASN/VII/2023', 39, 2, 132000),
(365, '47/NOTA-ASN/VII/2023', 79, 1, 90000),
(377, '40/NOTA-ASN/VII/2023', 280, 1, 250000),
(378, '40/NOTA-ASN/VII/2023', 80, 1, 25000),
(379, '01/NOTA-ASN/VII/2023', 80, 10, 250000),
(409, '01/NOTA-ASN/VIII/2023', 281, 1, 160000),
(410, '02/NOTA-ASN/VIII/2023', 131, 1, 50000),
(411, '03/NOTA-ASN/VIII/2023', 277, 1, 1050000),
(412, '04/NOTA-ASN/VIII/2023', 271, 1, 787500),
(413, '05/NOTA-ASN/VIII/2023', 131, 1, 50000),
(414, '06/NOTA-ASN/VIII/2023', 280, 1, 250000),
(416, '02/NOTA-ASN/IX/2023', 300, 5, 625000),
(417, '03/NOTA-ASN/IX/2023', 262, 1, 787500),
(418, '04/NOTA-ASN/IX/2023', 294, 8, 1080000),
(419, '05/NOTA-ASN/IX/2023', 342, 6, 324000);

-- --------------------------------------------------------

--
-- Table structure for table `drafter`
--

CREATE TABLE `drafter` (
  `id_drafter` int(5) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drafter`
--

INSERT INTO `drafter` (`id_drafter`, `nama`) VALUES
(1, 'Ali Yusni'),
(2, 'Tedy');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gapok` int(10) NOT NULL,
  `bonus` int(10) NOT NULL,
  `potongan` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `rek` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `nama`, `gapok`, `bonus`, `potongan`, `total`, `rek`, `bank`, `keterangan`, `tanggal`) VALUES
(3, 'Tedy ', 5000, 5000, 2000, 8000, '08888561', 'BCA', '-', '2023-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `gatuk`
--

CREATE TABLE `gatuk` (
  `id_gatuk` int(5) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `invoice` varchar(100) NOT NULL,
  `nilai` int(15) NOT NULL,
  `rek` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `AN` varchar(100) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `sisa_hbk` int(10) NOT NULL,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gatuk`
--

INSERT INTO `gatuk` (`id_gatuk`, `tanggal`, `invoice`, `nilai`, `rek`, `bank`, `AN`, `penerima`, `sisa_hbk`, `keterangan`) VALUES
(1, '2023-09-18', '08/INV-ASN/IX/2023', 500000, '52525252', 'BRI', 'Riyanto', 'Riyanto', 8489600, '-');

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `id_harga` int(5) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `nominal` int(12) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`id_harga`, `nama`, `nominal`, `keterangan`) VALUES
(2, 'Plafon PVC', 200000, 'Promo');

-- --------------------------------------------------------

--
-- Table structure for table `hbk`
--

CREATE TABLE `hbk` (
  `id_hbk` int(5) UNSIGNED NOT NULL,
  `id_pasang` int(5) NOT NULL,
  `no_hbk` varchar(200) NOT NULL,
  `kerja` varchar(50) NOT NULL,
  `tukang` varchar(20) NOT NULL,
  `pengawas` varchar(20) NOT NULL,
  `drafter` varchar(20) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `total_hbk` int(15) NOT NULL,
  `sisa_hbk` int(15) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `hbk`
--

INSERT INTO `hbk` (`id_hbk`, `id_pasang`, `no_hbk`, `kerja`, `tukang`, `pengawas`, `drafter`, `gambar`, `keterangan`, `total_hbk`, `sisa_hbk`, `tanggal_input`, `tanggal_ubah`) VALUES
(32, 50, '03/HBK-ASN/IX/2023', 'Plafon PVC', 'Muklis', 'Asfian', 'Ali Yusni', '1694307492_8881a1fdc9622101adc2.png', 'Pengerjaan setiap hari minggu saja', 536500, 536500, '2023-09-10 08:58:12', '2023-09-23 06:47:10'),
(33, 51, '04/HBK-ASN/IX/2023', 'Plafon PVC', 'Riyanto', 'Rahman', 'Ali Yusni', '1694311595_67008827351f0028c2eb.png', '-', 537000, 0, '2023-09-10 10:06:35', '2023-09-23 06:46:59'),
(34, 52, '05/HBK-ASN/IX/2023', 'Plafon PVC', 'Muklis', 'Anto', 'Ali Yusni', '1694325431_c0a9a1f60d1b0d7efeb7.png', '-', 1000000, 1000000, '2023-09-10 13:57:11', '2023-09-23 06:46:45'),
(35, 53, '06/HBK-ASN/IX/2023', 'Plafon PVC', 'Muklis', 'Anto', 'Ali Yusni', '1694325721_739d02ce2ba2e4fa3f48.png', '-', 10000000, 10000000, '2023-09-10 14:02:01', '2023-09-23 06:46:15'),
(36, 54, '07/HBK-ASN/IX/2023', 'Plafon PVC', 'Riyanto', 'Rahman', 'Ali Yusni', '1694326188_c00c693aaad0f0128b21.png', 'Pekerjaan 1', 1150000, 0, '2023-09-10 14:09:48', '2023-09-23 06:49:33'),
(39, 57, '09/HBK-ASN/IX/2023', 'Plafon PVC', 'Muklis', 'Rahman', 'Ali Yusni', '1695399409_afa900d4ccbaf1f90582.png', '-', 2000000, 0, '2023-09-23 00:16:50', '2023-09-23 06:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `id_hutang` int(5) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_rekening` varchar(100) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `total` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`id_hutang`, `tanggal`, `id_rekening`, `alamat`, `keterangan`, `total`) VALUES
(2, '2023-09-19', '2', 'JL. M. Said', 'tes\r\n', 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `insentif`
--

CREATE TABLE `insentif` (
  `id_ins` int(5) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `op` int(10) NOT NULL,
  `um` int(10) NOT NULL,
  `potongan` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `rek` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insentif`
--

INSERT INTO `insentif` (`id_ins`, `tanggal`, `nama`, `op`, `um`, `potongan`, `total`, `rek`, `bank`, `keterangan`) VALUES
(2, '2023-09-17', 'Tedy ', 50000, 10000, 20000, 40000, '08888561', 'BCA', '-');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(5) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `ktp` text NOT NULL,
  `rekening` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `posisi` varchar(100) NOT NULL,
  `alamat` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `tanggal`, `nama`, `ktp`, `rekening`, `bank`, `posisi`, `alamat`) VALUES
(2, '2023-09-17 00:00:00', 'Tedy ', '6472005001233', '08888561', 'BCA', 'IT', 'JL. Revolusi');

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id_kas` int(11) UNSIGNED NOT NULL,
  `id_sumber` int(5) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_katekas` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `uraian` text DEFAULT NULL,
  `debet` int(10) NOT NULL DEFAULT 0,
  `kredit` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`id_kas`, `id_sumber`, `tanggal`, `id_katekas`, `nama`, `uraian`, `debet`, `kredit`) VALUES
(27, 8, '2023-08-01 00:00:00', 3, 'ajeng', 'Pengerjaan Plafon PVC', 1000000, 0),
(31, 4, '2023-08-01 00:00:00', 2, 'fahmi', 'Beli Hollow', 0, 1000000),
(32, 4, '2023-08-01 00:00:00', 2, 'ajeng', 'Aksesoris', 0, 100000),
(34, 8, '2023-08-06 00:00:00', 3, 'assie', 'Pengerjaan Plafon PVC', 10000, 0),
(35, 8, '2023-08-11 00:00:00', 3, 'fahmi', 'Plafon PVC', 100000, 0),
(37, 4, '2023-08-11 00:00:00', 2, 'Agus', 'Aksesoris', 0, 100000),
(38, 8, '2023-08-11 00:00:00', 3, 'ajeng', 'Aksesoris', 10000, 0),
(39, 8, '2023-08-12 00:00:00', 3, 'fahmi', 'Aksesoris', 50000, 0),
(43, 4, '2023-08-12 00:00:00', 2, 'ajeng', 'Iklan', 0, 100000),
(45, 7, '2023-08-12 00:00:00', 4, 'fahmi', 'Iklan', 0, 100000),
(46, 7, '2023-08-01 00:00:00', 4, 'Rumah Agus', 'Aksesoris', 100000, 0),
(47, 7, '2023-08-11 00:00:00', 4, 'fahmi', 'Pengerjaan Plafon PVC', 100000, 0),
(48, 7, '2023-08-09 00:00:00', 4, 'assie', 'Pengerjaan Plafon PVC', 1000000, 0),
(49, 7, '2023-08-10 00:00:00', 4, 'Rumah Agus', 'Pengerjaan Plafon PVC', 1000000, 0),
(50, 7, '2023-08-12 00:00:00', 4, 'ajeng', 'Plafon PVC', 0, 100000),
(51, 8, '2023-08-02 00:00:00', 3, 'fahmi', 'Aksesoris', 50000, 0),
(55, 9, '2023-09-01 00:00:00', 2, 'fahmi', 'Pengerjaan Plafon', 40000, 0),
(56, 9, '2023-09-01 00:00:00', 3, 'assie', 'Iklan', 100000, 0),
(57, 9, '2023-09-01 00:00:00', 3, 'Rumah Agus', 'Aksesoris', 0, 10000),
(58, 9, '2023-09-01 00:00:00', 2, 'fahmi', 'Iklan', 1000, 0),
(62, 7, '2023-09-07 00:00:00', 4, 'fahmi', 'Pengerjaan Plafon PVC', 100000, 0),
(63, 10, '2023-09-07 00:00:00', 5, 'fahmi', 'Iklan', 1000, 0),
(64, 11, '2023-09-19 00:00:00', 2, 'fahmi', 'Pengerjaan Plafon PVC', 5000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kasbon`
--

CREATE TABLE `kasbon` (
  `id_kasbon` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `tempo` date DEFAULT NULL,
  `potongan` int(10) NOT NULL,
  `sisa` int(10) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kasbon`
--

INSERT INTO `kasbon` (`id_kasbon`, `nama`, `jumlah`, `tempo`, `potongan`, `sisa`, `keterangan`, `tanggal`) VALUES
(2, 'Tedy ', 500000, '2023-09-30', 10000, 490000, '-', '2023-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori` int(5) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `slug_kategori` varchar(100) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `nama_kategori`, `slug_kategori`, `tanggal_input`, `tanggal_ubah`) VALUES
(1, 'Plafon PVC', 'plafon-pvc', '2023-06-10 12:26:38', '2023-06-10 12:26:38'),
(2, 'Aksesoris', 'aksesoris', '2023-06-10 12:26:46', '2023-06-10 12:26:46'),
(3, 'Alat Pendukung', 'alat-pendukung', '2023-07-11 02:01:58', '2023-07-11 02:01:58'),
(4, 'Walpaper', 'walpaper', '2023-07-11 06:35:52', '2023-07-11 06:35:52'),
(6, 'List PVC', 'list-pvc', '2023-07-11 09:00:48', '2023-07-11 09:00:48'),
(7, 'Partisi', 'partisi', '2023-07-12 05:48:07', '2023-07-12 05:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `katekas`
--

CREATE TABLE `katekas` (
  `id_katekas` int(11) UNSIGNED NOT NULL,
  `kode` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `katekas`
--

INSERT INTO `katekas` (`id_katekas`, `kode`, `keterangan`) VALUES
(2, 'BOK', 'Biaya Oprasional'),
(3, 'PPJ', 'Penerimaan Penjualan'),
(4, 'KAS', 'kas harian'),
(5, 'PC', '-');

-- --------------------------------------------------------

--
-- Table structure for table `katepel`
--

CREATE TABLE `katepel` (
  `id_katepel` int(5) UNSIGNED NOT NULL,
  `nama_katepel` varchar(100) NOT NULL,
  `diskon_khusus` int(10) NOT NULL,
  `slug_katepel` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `katepel`
--

INSERT INTO `katepel` (`id_katepel`, `nama_katepel`, `diskon_khusus`, `slug_katepel`, `keterangan`, `tanggal_input`, `tanggal_ubah`) VALUES
(2, 'agen', 12, 'agen', 'Khusus Agen (Pembelian diatas 20 dus)', '2023-06-10 14:34:53', '2023-07-22 23:45:56'),
(4, 'aplikator', 6, 'aplikator', 'Khusus Aplikator (Pembelian diatas 10 Dus)', '2023-06-10 14:53:47', '2023-07-22 23:46:11'),
(6, 'umum', 0, 'umum', '-', '2023-06-18 03:01:21', '2023-07-22 23:44:04'),
(10, 'Langganan', 1, 'langganan', 'Khusus Umum (Pembelian diatas 5 Dus)', '2023-07-22 23:43:51', '2023-07-22 23:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `kerja`
--

CREATE TABLE `kerja` (
  `id_kerja` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kerja`
--

INSERT INTO `kerja` (`id_kerja`, `nama`, `keterangan`) VALUES
(2, 'Plafon PVC', 'Lurusan, Trap 1 &amp; Trap 2'),
(3, 'Aksesoris', 'Lampu dan Ornamen'),
(4, 'Kitchen set', '-');

-- --------------------------------------------------------

--
-- Table structure for table `labarugi`
--

CREATE TABLE `labarugi` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `id_katekas` int(5) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `subtotal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `labarugi`
--

INSERT INTO `labarugi` (`id`, `jenis`, `id_katekas`, `keterangan`, `subtotal`) VALUES
(11, '2', 2, 'Biaya Oprasional', 1300000),
(12, '1', 3, 'Penjualan', 1220000),
(13, '1', 4, 'kas harian', 2000000);

-- --------------------------------------------------------

--
-- Table structure for table `memo`
--

CREATE TABLE `memo` (
  `id_memo` int(5) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `telpon` varchar(100) NOT NULL,
  `barang` varchar(500) NOT NULL,
  `alamat` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memo`
--

INSERT INTO `memo` (`id_memo`, `tanggal`, `nama`, `nomor`, `telpon`, `barang`, `alamat`) VALUES
(1, '2023-09-22', 'Anto', 'KT1157MM', '08554488661', 'PVC', 'M. Yamin');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(3, '2023-06-03-123321', 'App\\Database\\Migrations\\Users', 'default', 'App', 1685839535, 1),
(4, '2023-06-03-144343', 'App\\Database\\Migrations\\Produk', 'default', 'App', 1685839535, 1),
(5, '2023-06-04-132702', 'App\\Database\\Migrations\\KategoriProduk', 'default', 'App', 1685885309, 2),
(34, '2023-06-05-135318', 'App\\Database\\Migrations\\SatuanProduk', 'default', 'App', 1686399802, 3),
(35, '2023-06-06-140754', 'App\\Database\\Migrations\\Subkategori', 'default', 'App', 1686399802, 3),
(36, '2023-06-10-073900', 'App\\Database\\Migrations\\Katepel', 'default', 'App', 1686399802, 3),
(37, '2023-06-10-122414', 'App\\Database\\Migrations\\KategoriProduk', 'default', 'App', 1686399920, 4),
(38, '2023-06-10-150433', 'App\\Database\\Migrations\\Pelanggan', 'default', 'App', 1686410161, 5),
(39, '2023-06-11-034929', 'App\\Database\\Migrations\\Transaksi', 'default', 'App', 1686462629, 6),
(40, '2023-06-11-035031', 'App\\Database\\Migrations\\DetailTransaksi', 'default', 'App', 1686462629, 6),
(41, '2023-06-16-123532', 'App\\Database\\Migrations\\Ongkir', 'default', 'App', 1686919184, 7),
(42, '2023-06-23-035035', 'App\\Database\\Migrations\\ProdukKembali', 'default', 'App', 1687492540, 8),
(43, '2023-06-27-133206', 'App\\Database\\Migrations\\Page', 'default', 'App', 1687915792, 9),
(44, '2023-06-27-133206', 'App\\Database\\Migrations\\Partner', 'default', 'App', 1687915792, 9),
(45, '2023-06-27-133206', 'App\\Database\\Migrations\\Projects', 'default', 'App', 1687915792, 9),
(46, '2023-06-27-133206', 'App\\Database\\Migrations\\Testimoni', 'default', 'App', 1687915792, 9),
(47, '2023-07-08-154847', 'App\\Database\\Migrations\\Pemasangan', 'default', 'App', 1688906176, 10),
(48, '2023-07-08-154901', 'App\\Database\\Migrations\\BayarPasang', 'default', 'App', 1688906176, 10),
(49, '2023-07-08-155003', 'App\\Database\\Migrations\\Hbk', 'default', 'App', 1688906176, 10),
(50, '2023-07-08-155016', 'App\\Database\\Migrations\\BayarHbk', 'default', 'App', 1688906176, 10),
(51, '2023-07-12-135935', 'App\\Database\\Migrations\\DetailPemasangan', 'default', 'App', 1689170697, 11),
(52, '2023-07-19-002201', 'App\\Database\\Migrations\\BahanPasang', 'default', 'App', 1689726336, 12),
(53, '2023-07-19-022715', 'App\\Database\\Migrations\\DetailBahan', 'default', 'App', 1689733776, 13),
(54, '2023-07-23-082204', 'App\\Database\\Migrations\\CreateKasTable', 'default', 'App', 1690100557, 14),
(55, '2023-07-23-084249', 'App\\Database\\Migrations\\CreateKatekasTable', 'default', 'App', 1690102049, 15),
(56, '2023-07-24-144209', 'App\\Database\\Migrations\\CreateUangKasTable', 'default', 'App', 1690210484, 16),
(57, '2023-07-27-050649', 'App\\Database\\Migrations\\CreateLabarugiTable', 'default', 'App', 1690434552, 17),
(58, '2023-07-28-063403', 'App\\Database\\Migrations\\CreateSumberKasTable', 'default', 'App', 1690526127, 18),
(59, '2023-07-30-043514', 'App\\Database\\Migrations\\CreatePembayaranTable', 'default', 'App', 1690691925, 19),
(60, '2023-08-04-130552', 'App\\Database\\Migrations\\CreateDetailPemasanganTable', 'default', 'App', 1691154526, 20),
(61, '2023-08-09-135752', 'App\\Database\\Migrations\\CreateDetailSumberTable', 'default', 'App', 1691591024, 21),
(62, '2023-08-26-153832', 'App\\Database\\Migrations\\CreateSurveiTable', 'default', 'App', 1693065034, 22);

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) UNSIGNED NOT NULL,
  `nama_wilayah` varchar(100) NOT NULL,
  `biaya` varchar(100) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_wilayah`, `biaya`, `tanggal_input`, `tanggal_ubah`) VALUES
(4, 'Ambil Sendiri', '0', '2023-06-22 23:45:56', '2023-06-22 23:45:56'),
(6, 'Berau', '1500000', '2023-07-13 02:57:05', '2023-07-13 02:57:05'),
(7, 'Bengalon', '1500000', '2023-07-13 02:57:22', '2023-07-13 02:57:22'),
(8, 'Sangatta', '1000000', '2023-07-13 02:57:37', '2023-07-13 02:57:37'),
(9, 'Balikpapan', '500000', '2023-07-13 02:57:54', '2023-07-13 02:57:54'),
(10, 'Kota Bangun', '400000', '2023-07-13 02:58:32', '2023-07-13 02:58:32'),
(11, 'Muara Badak', '200000', '2023-07-13 02:59:01', '2023-07-13 02:59:01'),
(12, 'Separi ', '200000', '2023-07-13 02:59:16', '2023-07-13 02:59:16'),
(13, 'L1, L2, L3', '150000', '2023-07-13 02:59:39', '2023-07-13 02:59:39'),
(14, 'Handil A,B,C', '150000', '2023-07-13 03:00:09', '2023-07-13 03:00:09'),
(15, 'Handil 1,2,3', '200000', '2023-07-13 03:00:36', '2023-07-13 03:00:36'),
(16, 'Sanga-Sanga', '150000', '2023-07-13 03:01:10', '2023-07-13 03:01:10'),
(17, 'Tenggarong', '150000', '2023-07-13 03:01:28', '2023-07-13 03:01:28'),
(18, 'Samarinda ', '50000', '2023-07-13 03:01:51', '2023-07-13 03:01:51'),
(19, 'Pembelian Diatas 5jt Area Samarinda', '0', '2023-07-13 03:02:10', '2023-07-13 03:02:10'),
(20, 'Anggana', '50000', '2023-07-13 03:03:27', '2023-07-13 03:03:27'),
(21, 'Palaran', '50000', '2023-07-13 08:49:33', '2023-07-13 08:49:33'),
(22, 'Samarinda Sebrang', '50000', '2023-07-13 08:52:40', '2023-07-13 08:52:40'),
(23, 'Ongkir Bagi 2 Lokasi Jauh', '0', '2023-07-14 06:12:29', '2023-07-14 06:12:29'),
(24, 'Kukar', '100000', '2023-07-18 00:42:15', '2023-07-18 00:42:15'),
(25, 'Free Ongkir', '0', '2023-07-18 01:45:11', '2023-07-18 01:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` int(5) NOT NULL,
  `tanggal` datetime NOT NULL,
  `pemesan` varchar(100) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `kerja` varchar(500) NOT NULL,
  `toko` varchar(100) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `tanggal_acc` datetime NOT NULL,
  `nota` varchar(100) NOT NULL,
  `bukti` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_order`, `tanggal`, `pemesan`, `penerima`, `kerja`, `toko`, `keterangan`, `tanggal_acc`, `nota`, `bukti`, `status`) VALUES
(3, '2023-09-15 00:00:00', 'Fahmi', 'tesla', 'Tatako', 'TB Arjuna', 'dinding', '2023-09-15 00:00:00', '1694919608_70d15e0477b2bb92dce7.png', '1694920244_d8c61b2e3fd8eac8a738.png', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(5) UNSIGNED NOT NULL,
  `home_titel` varchar(100) NOT NULL,
  `home_judul` varchar(500) NOT NULL,
  `home_text` varchar(500) NOT NULL,
  `home_gambar` varchar(100) NOT NULL,
  `about_titel` varchar(100) NOT NULL,
  `about_judul` varchar(500) NOT NULL,
  `about_text` varchar(500) NOT NULL,
  `about_list` varchar(500) NOT NULL,
  `about_gambar` varchar(100) NOT NULL,
  `about_nomor` varchar(500) NOT NULL,
  `about_text3` varchar(500) NOT NULL,
  `project_titel` varchar(100) NOT NULL,
  `project_judul` varchar(500) NOT NULL,
  `projects_gambar` varchar(100) NOT NULL,
  `partner_titel` varchar(100) NOT NULL,
  `partner_judul` varchar(500) NOT NULL,
  `testimoni_titel` varchar(100) NOT NULL,
  `testimoni_judul` varchar(500) NOT NULL,
  `contact_titel` varchar(100) NOT NULL,
  `contact_judul` varchar(500) NOT NULL,
  `google_map` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `telpon` varchar(500) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `nama_usaha` varchar(500) NOT NULL,
  `slogan` varchar(500) NOT NULL,
  `link_fb` varchar(500) NOT NULL,
  `link_ig` varchar(500) NOT NULL,
  `link_yt` varchar(500) NOT NULL,
  `link_wa` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `home_titel`, `home_judul`, `home_text`, `home_gambar`, `about_titel`, `about_judul`, `about_text`, `about_list`, `about_gambar`, `about_nomor`, `about_text3`, `project_titel`, `project_judul`, `projects_gambar`, `partner_titel`, `partner_judul`, `testimoni_titel`, `testimoni_judul`, `contact_titel`, `contact_judul`, `google_map`, `email`, `telpon`, `alamat`, `logo`, `nama_usaha`, `slogan`, `link_fb`, `link_ig`, `link_yt`, `link_wa`) VALUES
(1, 'Home', '&lt;p&gt;&lt;span style=&quot;font-size:24px&quot;&gt;Selamat Datang di &lt;/span&gt;&lt;span style=&quot;color:#f1c40f&quot;&gt;&lt;span style=&quot;font-size:36px&quot;&gt;&lt;strong&gt;Sejati Plafon PVC&lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;h1&gt;&lt;span style=&quot;color:#f39c12&quot;&gt;&lt;span style=&quot;font-size:72px&quot;&gt;&lt;strong&gt;Minimalis&amp;nbsp;&lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;color:#ffffff&quot;&gt;&lt;span style=&quot;font-size:48px&quot;&gt;&lt;strong&gt;Plafon Urang Samarinda&lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;&lt;/h1&gt;\r\n', '1688091717_c80f8bcee4f48a3de7bd.png', 'About', '&lt;p&gt;&lt;span style=&quot;font-size:36px&quot;&gt;&lt;span style=&quot;color:#f39c12&quot;&gt;Sejati &lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;font-size:28px&quot;&gt;Store&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;p&gt;&lt;span style=&quot;font-size:26px&quot;&gt;Melayani Penjualan dan Jasa Pemasangan&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;ul&gt;\r\n	&lt;li&gt;Plafon PVC&lt;/li&gt;\r\n	&lt;li&gt;Kitchen Set&lt;/li&gt;\r\n	&lt;li&gt;Wallpaper Dinding&lt;/li&gt;\r\n	&lt;li&gt;Lemari Kabinet&lt;/li&gt;\r\n	&lt;li&gt;Backdrop&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '1687921493_fdfbb3316af08d527467.jpg', '&lt;p&gt;&lt;span style=&quot;font-size:48px&quot;&gt;&lt;span style=&quot;color:#f39c12&quot;&gt;90&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;font-size:36px&quot;&gt;&lt;span style=&quot;color:#f39c12&quot;&gt;%&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;p&gt;&lt;span style=&quot;font-size:20px&quot;&gt;&lt;span style=&quot;color:#f39c12&quot;&gt;Terjamin&amp;nbsp;&lt;/span&gt;Kualitasnya&lt;/span&gt;&lt;/p&gt;\r\n', 'Project', '&lt;p&gt;&lt;span style=&quot;font-size:48px&quot;&gt;Hasil Pemasangan &lt;span style=&quot;color:#f1c40f&quot;&gt;Tim Sejati&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n', '1688116903_0e2556fa2abbb548509d.png', 'Partners', '&lt;p&gt;&lt;span style=&quot;font-size:48px&quot;&gt;Kami Memiliki &lt;span style=&quot;color:#f1c40f&quot;&gt;Berkerjasama&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n', 'Testimoni', '&lt;p&gt;&lt;span style=&quot;color:#e67e22&quot;&gt;Sudah &lt;/span&gt;banyak orang yang puas akan kerja tim sejati&lt;/p&gt;\r\n', 'Contact', '&lt;p&gt;Kontak kami&lt;/p&gt;\r\n', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.660302548037!2d117.1810850147533!3d-0.5099357996279603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df5d56f8f66207f%3A0xa2af8a78a260fb8e!2sSejati%20Plafon!5e0!3m2!1sid!2sid!4v1688227714969!5m2!1sid!2sid', '&lt;strong&gt;Anugerahsejatinusantara@gmail.com&lt;/strong&gt;', '&lt;strong&gt;0811 - 556 - 717 (WhatsApp)&lt;/strong&gt;', '&lt;strong&gt;Jl. Sultan Sulaiman Depan Pelita 4 Sambutan, Samarinda Kalimantan Timur&lt;/strong&gt;', '1688226359_b797d77d927d78d86995.png', 'SEJATI STORE', '&lt;span style=&quot;color:#f1c40f&quot;&gt;&lt;strong&gt;Plafonnya Orang Samarinda&lt;/strong&gt;&lt;/span&gt;', 'https://id-id.facebook.com/', 'https://www.instagram.com/?hl=id', 'https://www.youtube.com/', 'https://wa.me/6281355538777');

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE `partner` (
  `id` int(5) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`id`, `nama`, `logo`) VALUES
(1, '&lt;p&gt;assie 1&lt;/p&gt;\r\n', '1688123922_ab7b9888c9fce666ddbb.png'),
(3, '&lt;p&gt;fahmi&lt;/p&gt;\r\n', '1688123941_69f52ace5f541a606029.png');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pel` int(5) UNSIGNED NOT NULL,
  `nama_pel` varchar(100) NOT NULL,
  `slug_pel` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `id_katepel` int(5) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pel`, `nama_pel`, `slug_pel`, `telepon`, `alamat`, `kota`, `id_katepel`, `tanggal_input`, `tanggal_ubah`) VALUES
(6, 'Bapak Didi', 'bapak-didi', '-', 'Handil D', 'Samarinda', 6, '2023-07-04 01:31:08', '2023-07-07 00:55:04'),
(8, 'Bapak Ari Granit', 'bapak-ari-granit', '081347919813', 'Jl Gunung Lingai', 'Samarinda', 2, '2023-07-07 00:47:51', '2023-07-07 00:56:00'),
(9, 'Bapak Kohar', 'bapak-kohar', '-', '-', 'Samarinda', 6, '2023-07-07 00:52:20', '2023-07-07 00:56:08'),
(10, 'Ibu Santi', 'ibu-santi', '081345355400', 'Jl Aw Syahrani Tembusan Ringroad', 'Samarinda', 6, '2023-07-07 00:53:13', '2023-07-07 00:56:16'),
(11, 'Bapak Kustoyo', 'bapak-kustoyo', '082151796654', '-', 'Samarinda', 4, '2023-07-07 00:54:35', '2023-07-07 00:56:24'),
(12, 'No Name', 'no-name', '-', '-', 'Samarinda', 6, '2023-07-07 00:55:52', '2023-07-13 14:42:23'),
(13, 'Om Riyanto TK', 'om-riyanto-tk', '081250001878', 'Palaran', 'Samarinda', 4, '2023-07-07 00:57:20', '2023-07-07 00:57:20'),
(14, 'PT Muara Kembang ', 'pt-muara-kembang', '085348600636', 'Muara Kembang', 'Samarinda', 6, '2023-07-07 00:58:15', '2023-07-07 00:58:15'),
(15, 'Bapak Beta Markus', 'bapak-beta-markus', '081346686060', 'Jl Gotong Royong Gg 2 Palaran Gereja Kibad', 'Samarinda', 6, '2023-07-07 00:59:09', '2023-07-07 00:59:09'),
(16, 'Bapak Usup', 'bapak-usup', '085347475923', 'Jl Datu Iba Sungai Kledang', 'Samarinda', 6, '2023-07-07 00:59:49', '2023-07-07 00:59:49'),
(17, 'Bapak Koko', 'bapak-koko', '0882021923338', '-', 'Samarinda', 6, '2023-07-07 01:00:54', '2023-07-07 01:00:54'),
(18, 'Bapak Edi', 'bapak-edi', '082135135888', 'Jl Sungai Lais', 'Samarinda', 6, '2023-07-07 01:01:44', '2023-07-07 01:01:44'),
(19, 'Bapak Ridwan', 'bapak-ridwan', '082153981320', 'Jl Kemakmuran Komp. Pelita 3 No.43', 'Samarinda', 6, '2023-07-07 01:02:38', '2023-07-07 01:02:38'),
(20, 'Bapak H Aswan', 'bapak-h-aswan', '085246854482 / 082158124444', 'Jl. Poros Samarinda Sungai Purun G Kuburan Muslim Sungai Mariam', 'Samarinda', 6, '2023-07-13 02:55:21', '2023-07-13 02:55:21'),
(21, 'Toko Genius', 'toko-genius', '08117282213', '-', 'Samarinda', 4, '2023-07-14 01:18:33', '2023-07-14 01:18:33'),
(22, 'Bapak Marno', 'bapak-marno', '085250199119', 'Jl Basuki Rahmad Jl Angsoka No.07', 'Samarinda', 6, '2023-07-14 01:35:31', '2023-07-14 01:35:31'),
(23, 'Bapak Maharudin', 'bapak-maharudin', '082121216711 / 082148577859', 'Jl Kembang Kuning Gg Abadi Palaran Jembatan Bungkuk ', 'Samarinda', 6, '2023-07-14 01:41:39', '2023-07-14 01:41:39'),
(24, 'Ibu Fitri', 'ibu-fitri', '082151599591', 'Jl M Said Gg Kita Blok A Masuk Paling Ujung Rumah Kosong Warna Putih', 'Samarinda', 6, '2023-07-14 03:20:59', '2023-07-14 03:20:59'),
(25, 'Bapak Sugianto', 'bapak-sugianto', '085316000961', 'L3 Blok A Rt 7 Gang Bongi', 'Tenggarong', 4, '2023-07-14 03:30:39', '2023-07-14 03:30:39'),
(26, 'Bapak Suyitno', 'bapak-suyitno', '082221434692', 'Jl Wonosari Gg Iman 1 Rt.24 Makroman', 'Samarinda', 6, '2023-07-14 03:47:10', '2023-07-14 03:47:10'),
(27, 'Bapak Asnur', 'bapak-asnur', '085845227715', 'Jl Batuah Kilo 30', 'Balikpapan', 6, '2023-07-14 03:55:58', '2023-07-14 03:55:58'),
(28, 'Geraja GPDI Parakletos', 'geraja-gpdi-parakletos', '0822-5245-3347', 'Melak', 'Kutai Timur', 6, '2023-07-14 07:30:30', '2023-07-14 07:37:33'),
(29, 'Bapak Rahmad', 'bapak-rahmad', '081349458889', 'Jl Sultan Alimudin Padat Karya Gg Halidi 1 No.70 Rt.04', 'Samarinda', 6, '2023-07-15 02:31:45', '2023-07-15 02:31:45'),
(30, 'Bapak Hadi', 'bapak-hadi', '085246856477', 'Damanhuri', 'Samarinda', 6, '2023-07-17 00:52:35', '2023-07-17 00:52:35'),
(31, 'Bapak Hanafi', 'bapak-hanafi', '-', '-', 'Samarinda', 6, '2023-07-18 00:29:25', '2023-07-18 00:29:25'),
(32, 'Bapak Herman', 'bapak-herman', '081347341775', 'Kutai Lama', 'Kutai Kartanegara', 6, '2023-07-18 00:41:04', '2023-07-18 00:41:04'),
(33, 'Bapak Hari', 'bapak-hari', '081347787855', 'Jl Sukses 1 Blok.L No.34 ', 'Samarinda', 6, '2023-07-18 01:43:22', '2023-07-18 01:44:21'),
(34, 'Ibu Iriyana', 'ibu-iriyana', '0822-5303-5498', 'Jl H Suwandi Blok E No 142', 'Samarinda', 6, '2023-07-18 03:19:56', '2023-07-18 03:19:56'),
(35, 'Bapak Baharudin', 'bapak-baharudin', '081347336336', '-', 'Samarinda', 6, '2023-07-18 05:47:54', '2023-07-18 05:47:54'),
(36, 'Bapak Supiansyah', 'bapak-supiansyah', '081346522117', 'Resak', 'Kutai Barat', 0, '2023-07-20 01:00:57', '2023-07-20 01:00:57'),
(37, 'Bapak Asnur', 'bapak-asnur', '081354440008', '-', 'Samarinda', 6, '2023-07-20 03:37:58', '2023-07-20 03:37:58'),
(38, 'Bapak Nawi', 'bapak-nawi', '081255355479', '-', 'Samarinda', 6, '2023-07-20 07:21:12', '2023-07-20 07:21:12'),
(39, 'Bapak M Ahmadin', 'bapak-m-ahmadin', '082214209999', 'Pm. Noor Toko Abadi Jaya', 'Samarinda', 4, '2023-07-21 09:53:45', '2023-07-21 09:53:45'),
(40, 'Bapak Pur', 'bapak-pur', '081253067675', 'Jl Sultan Alimudin Gg Lamtoro No. 95', 'Samarinda', 6, '2023-07-21 14:15:04', '2023-07-21 14:15:04'),
(41, 'tesla', 'tesla', '0852520252', 'JL. Revolusi', 'Samarinda', 10, '2023-07-22 23:47:54', '2023-07-22 23:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `pemasangan`
--

CREATE TABLE `pemasangan` (
  `id_pasang` int(5) UNSIGNED NOT NULL,
  `id_survei` int(5) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `no_rbp` varchar(100) NOT NULL,
  `no_rhb` varchar(100) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `biaya` int(5) NOT NULL,
  `sisa` int(5) NOT NULL,
  `kerja` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `volume` decimal(10,2) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pemasangan`
--

INSERT INTO `pemasangan` (`id_pasang`, `id_survei`, `invoice`, `no_rbp`, `no_rhb`, `tanggal`, `nama`, `alamat`, `biaya`, `sisa`, `kerja`, `gambar`, `volume`, `keterangan`, `tanggal_input`, `tanggal_ubah`) VALUES
(48, 15, '01/INV-ASN/IX/2023', '01/RBP-ASN/IX/2023', '01/HBK-ASN/IX/2023', '2023-09-10 00:00:00', 'Pak bambang', 'JL. M. Said', 8800000, 8800000, 'Plafon PVC', '1694306458_729cf4c47a70db40c3a3.png', '35.23', 'Pengejaan Baru bisa dikerjakan tgl 15 sepetmber 2023', '2023-09-10 08:40:58', '2023-09-10 08:40:58'),
(49, 16, '02/INV-ASN/IX/2023', '02/RBP-ASN/IX/2023', '02/HBK-ASN/IX/2023', '2023-09-10 00:00:00', 'toto', 'JL. Revolusi', 4000000, 4000000, 'Plafon PVC', '1694307076_1c187a0fc7494387ea9d.png', '18.00', 'Pengerjaan tgl 25 september 2023', '2023-09-10 08:51:16', '2023-09-10 08:51:16'),
(50, 16, '03/INV-ASN/IX/2023', '03/RBP-ASN/IX/2023', '03/HBK-ASN/IX/2023', '2023-09-10 00:00:00', 'toto', 'JL. Revolusi', 4000000, 4000000, 'Plafon PVC', '1694307110_db8fb48f3dad3cd87b5c.png', '18.00', 'Pengerjaan tgl 25 september 2023', '2023-09-10 08:51:50', '2023-09-10 08:51:50'),
(51, 18, '04/INV-ASN/IX/2023', '04/RBP-ASN/IX/2023', '04/HBK-ASN/IX/2023', '2023-09-10 00:00:00', 'Pak bambang', 'JL. M. Said', 1028000, 0, 'Plafon PVC', '1694311501_e4f7fa4d6bd99039e5c1.png', '20.56', '-', '2023-09-10 10:05:01', '2023-09-10 10:29:00'),
(52, 19, '05/INV-ASN/IX/2023', '05/RBP-ASN/IX/2023', '05/HBK-ASN/IX/2023', '2023-09-10 00:00:00', 'totok', 'jl. sejati', 4600000, 4600000, 'Plafon PVC', '1694325402_3ccf03a0906395533087.png', '20.00', '-', '2023-09-10 13:56:42', '2023-09-10 13:56:42'),
(53, 19, '06/INV-ASN/IX/2023', '06/RBP-ASN/IX/2023', '06/HBK-ASN/IX/2023', '2023-09-10 00:00:00', 'totok', 'jl. sejati', 4600000, 4600000, 'Plafon PVC', '1694325562_5433e8dde389156f1b72.png', '20.00', '-', '2023-09-10 13:59:22', '2023-09-10 13:59:22'),
(54, 20, '07/INV-ASN/IX/2023', '07/RBP-ASN/IX/2023', '07/HBK-ASN/IX/2023', '2023-09-10 00:00:00', 'Pak Rely', 'jl. sejati', 19000000, 19000000, 'Plafon PVC', '1694326088_66c28f373f4458e912e1.png', '20.00', '-', '2023-09-10 14:08:08', '2023-09-10 14:08:08'),
(56, 17, '08/INV-ASN/IX/2023', '08/RBP-ASN/IX/2023', '08/HBK-ASN/IX/2023', '2023-09-10 00:00:00', 'Darmawan', 'JL. Revolusi', 4000000, 4000000, 'Plafon PVC', '1695396927_ff91fc0dfd3fabcd9fb2.pdf', '20.00', '-', '2023-09-22 23:35:27', '2023-09-22 23:35:27'),
(57, 17, '09/INV-ASN/IX/2023', '09/RBP-ASN/IX/2023', '09/HBK-ASN/IX/2023', '2023-09-10 00:00:00', 'Darmawan', 'JL. Revolusi', 4000000, 0, 'Plafon PVC', '1695399402_8139c33efbd96235ad8e.png', '20.00', '-', '2023-09-23 00:16:42', '2023-09-23 07:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_bayar` int(5) UNSIGNED NOT NULL,
  `id_trans` varchar(100) NOT NULL,
  `total` int(10) NOT NULL,
  `sisa` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_bayar`, `id_trans`, `total`, `sisa`) VALUES
(24, '04/NOTA-ASN/VIII/2023', 740250, 0),
(27, '03/NOTA-ASN/VIII/2023', 924000, 0),
(28, '02/NOTA-ASN/VIII/2023', 50000, 0),
(29, '01/NOTA-ASN/VIII/2023', 160000, 0),
(30, '02/NOTA-ASN/VII/2023', 1782000, 1782000),
(31, '03/NOTA-ASN/VII/2023', 600000, 600000),
(32, '05/NOTA-ASN/VII/2023', 1714560, 1714560),
(33, '06/NOTA-ASN/VII/2023', 1452000, 1452000),
(34, '08/NOTA-ASN/VII/2023', 138000, 138000),
(35, '09/NOTA-ASN/VII/2023', 13860000, 13860000),
(36, '12/NOTA-ASN/VII/2023', 649000, 649000),
(37, '13/NOTA-ASN/VII/2023', 2335000, 2335000),
(38, '15/NOTA-ASN/VII/2023', 141000, 141000),
(39, '17/NOTA-ASN/VII/2023', 360000, 360000),
(40, '22/NOTA-ASN/VII/2023', 517000, 517000),
(41, '24/NOTA-ASN/VII/2023', 1613040, 1613040),
(42, '27/NOTA-ASN/VII/2023', 8240000, 8240000),
(43, '29/NOTA-ASN/VII/2023', 55000, 55000),
(44, '32/NOTA-ASN/VII/2023', 210000, 210000),
(45, '34/NOTA-ASN/VII/2023', 720000, 720000),
(46, '35/NOTA-ASN/VII/2023', 115000, 115000),
(47, '38/NOTA-ASN/VII/2023', 1050000, 1050000),
(48, '39/NOTA-ASN/VII/2023', 450000, 450000),
(49, '41/NOTA-ASN/VII/2023', 1498000, 1498000),
(50, '43/NOTA-ASN/VII/2023', 1400000, 1400000),
(51, '45/NOTA-ASN/VII/2023', 132000, 132000),
(52, '23/NOTA-ASN/VII/2023', 2941800, 2941800),
(53, '04/NOTA-ASN/VII/2023', 2239000, 2239000),
(54, '14/NOTA-ASN/VII/2023', 842000, 842000),
(55, '25/NOTA-ASN/VII/2023', 1684000, 1684000),
(56, '33/NOTA-ASN/VII/2023', 1634000, 1634000),
(57, '42/NOTA-ASN/VII/2023', 2850000, 0),
(58, '01/NOTA-ASN/VII/2023', 220000, 220000),
(59, '19/NOTA-ASN/VII/2023', 6259000, 6259000),
(60, '21/NOTA-ASN/VII/2023', 4783500, 4783500),
(61, '30/NOTA-ASN/VII/2023', 5989000, 5989000),
(62, '18/NOTA-ASN/VII/2023', 4269000, 4269000),
(63, '26/NOTA-ASN/VII/2023', 3219000, 3219000),
(64, '28/NOTA-ASN/VII/2023', 410000, 410000),
(65, '10/NOTA-ASN/VII/2023', 4300000, 4300000),
(66, '20/NOTA-ASN/VII/2023', 10516000, 10516000),
(67, '07/NOTA-ASN/VII/2023', 245000, 245000),
(69, '16/NOTA-ASN/VII/2023', 1040000, 1040000),
(70, '31/NOTA-ASN/VII/2023', 400000, 400000),
(71, '36/NOTA-ASN/VII/2023', 7625000, 7625000),
(72, '37/NOTA-ASN/VII/2023', 1314000, 1314000),
(73, '44/NOTA-ASN/VII/2023', 25000, 25000),
(101, '06/NOTA-ASN/VIII/2023', 250000, 0),
(102, '01/NOTA-ASN/IX/2023', 550000, 550000),
(126, '02/NOTA-ASN/IX/2023', 625000, 0),
(129, '05/NOTA-ASN/VIII/2023', 0, 50000),
(133, '04/NOTA-ASN/IX/2023', 1130000, 0),
(134, '03/NOTA-ASN/IX/2023', 837500, 0),
(136, '05/NOTA-ASN/IX/2023', 320760, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `rek` varchar(100) NOT NULL,
  `nilai` int(15) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengukur`
--

CREATE TABLE `pengukur` (
  `id_pengukur` int(5) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengukur`
--

INSERT INTO `pengukur` (`id_pengukur`, `nama`) VALUES
(1, 'Rahman'),
(2, 'Asfian'),
(3, 'Anto'),
(4, 'M Ali');

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE `piutang` (
  `id_piutang` int(5) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `saldo` int(15) NOT NULL,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `piutang`
--

INSERT INTO `piutang` (`id_piutang`, `tanggal`, `nama`, `alamat`, `saldo`, `keterangan`) VALUES
(2, '2023-09-18', 'fahmi', 'JL. Revolusi', 0, 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(5) UNSIGNED NOT NULL,
  `slug_produk` varchar(100) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_subkate` int(5) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `id_satuan` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar_produk` varchar(100) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL,
  `stok` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `slug_produk`, `id_kategori`, `id_subkate`, `nama_produk`, `deskripsi`, `id_satuan`, `harga`, `gambar_produk`, `tanggal_input`, `tanggal_ubah`, `stok`) VALUES
(33, 'lm-008', 6, 24, 'LM-008', '1 Dus 16 Batang', '11', 66000, '1689229185_aa86a1eae0272f02c5ef.jpg', '2023-07-11 06:27:51', '2023-07-13 06:19:45', 272),
(34, 'lm-007', 6, 24, 'LM-007', 'Coklat, 1 Dus 16 Batang', '11', 66000, '1689229150_6efc30f925e923390b40.jpg', '2023-07-11 06:27:51', '2023-07-13 06:19:10', 192),
(35, 'lm-010', 6, 24, 'LM-010', '1 Dus 16 Batang', '11', 66000, '1689229235_d0fbde9e508a976ec28b.jpg', '2023-07-11 06:27:51', '2023-07-13 06:20:35', 264),
(36, 'lm-011', 6, 24, 'LM-011', '1 Dus 16 Batang', '11', 66000, '1689229246_63c0f1726c247dcdc832.jpg', '2023-07-11 06:27:51', '2023-07-13 06:20:46', 200),
(37, 'lm-012', 6, 24, 'LM-012', '1 Dus 16 Batang', '11', 66000, '1689229261_f0814a30c9bcba1e2774.jpg', '2023-07-11 06:27:51', '2023-08-01 23:19:11', 367),
(38, 'lm-013', 6, 24, 'LM-013', '1 Dus 16 Batang', '11', 66000, '1689229272_3dda6d62de65c3d681d8.jpg', '2023-07-11 06:27:51', '2023-07-13 06:21:12', 58),
(39, 'lm-014', 6, 24, 'LM-014', '1 Dus 16 Batang', '11', 66000, '1689229284_0b248ee6231de552475a.jpg', '2023-07-11 06:27:51', '2023-08-01 23:31:11', 280),
(40, 'lm-015', 6, 24, 'LM-015', '1 Dus 16 Batang', '11', 66000, '1689229297_82698c152e280a7095fa.jpg', '2023-07-11 06:27:51', '2023-07-13 06:21:37', 268),
(41, 'lm-016', 6, 24, 'LM-016', '1 Dus 16 Batang', '11', 66000, '1689229308_7c448907857c7a93ebe2.jpg', '2023-07-11 06:27:51', '2023-07-20 05:35:52', 181),
(42, 'lm-018', 6, 24, 'LM-018', '1 Dus 16 Batang', '11', 66000, '1689229326_a0eadb485ab8bd80aa1d.jpg', '2023-07-11 06:27:51', '2023-07-18 01:46:47', 208),
(43, 'list-sudut-coklat', 6, 23, 'LIST SUDUT COKLAT', 'Coklat, 1 Dus = 36 Batang', '11', 50000, '1689228821_d814588736e3b34419bd.jpg', '2023-07-11 06:27:51', '2023-07-15 02:49:52', 384),
(44, 'list-sudut-putih', 6, 23, 'LIST SUDUT PUTIH', 'Putih, 1 Dus isi 36 Batang', '11', 50000, '1689228881_9381d35d1a7d4148c50f.jpg', '2023-07-11 06:27:51', '2023-08-02 07:02:10', 754),
(45, 'list-siku-coklat', 6, 23, 'LIST SIKU COKLAT', '1', '11', 50000, '1689228568_08f184d38251a4845e2f.jpg', '2023-07-11 06:27:51', '2023-08-01 23:19:11', 421),
(46, 'list-siku-putih', 6, 23, 'LIST SIKU PUTIH', 'Putih', '11', 50000, '1689228598_be4e42b55299b4c47cfc.jpg', '2023-07-11 06:27:51', '2023-08-02 07:02:10', 891),
(47, 'list-sambung-putih', 6, 23, 'LIST SAMBUNG PUTIH', '1', '11', 50000, '1689228457_f322b580c2c7252d28f7.jpg', '2023-07-11 06:27:51', '2023-07-20 05:38:06', 2291),
(48, 'list-sambung-coklat', 6, 23, 'LIST SAMBUNG COKLAT', '1', '11', 50000, '1689228542_051f79de40d898e36d1c.jpg', '2023-07-11 06:27:51', '2023-07-15 02:49:28', 1578),
(49, 'list-tutup-coklat-6cm', 6, 23, 'LIST TUTUP COKLAT 6CM ', 'Coklat, 1 Dus 36 Batang', '11', 66000, '1689228967_de9d6d933e2a5b191743.jpg', '2023-07-11 06:27:51', '2023-07-20 04:44:10', 232),
(50, 'list-tutup-putih-6cm', 6, 24, 'LIST TUTUP PUTIH 6CM', 'Putih, 1 Dus 36 Batang', '11', 66000, '1689229003_1f2bb89ad1adf3eb866b.jpg', '2023-07-11 06:27:51', '2023-07-20 07:22:35', 199),
(51, 'list-tutup-coklat', 6, 23, 'LIST TUTUP COKLAT ', 'Coklat, 1 Dus 112 Batang', '11', 50000, '1689229042_1bcc9f554c1a687b1f74.jpg', '2023-07-11 06:27:51', '2023-08-01 23:19:11', 346),
(52, 'list-tutup-putih', 6, 23, 'LIST TUTUP PUTIH', 'Coklat, 1 Dus 112 Batang', '11', 50000, '1689229116_939cfcf120274a2a8593.jpg', '2023-07-11 06:27:51', '2023-08-01 23:31:11', 2676),
(53, 'sjo-011', 2, 9, 'SJO - 011', 'Segi 8 Hijau', '28', 65000, '1689226846_8994b8ee6f8bd60e0325.png', '2023-07-11 06:27:51', '2023-07-13 14:43:12', 8),
(54, 'sjo-015', 2, 9, 'SJO - 015', 'Segi Bintang Coklat Hitam', '28', 65000, '1689226900_6aee81cff00e880517e3.png', '2023-07-11 06:27:51', '2023-07-13 05:41:40', 1),
(55, 'downlight-bulat-6-watt', 2, 5, 'Downlight Bulat 6 Watt', '1', '17', 45000, '1689297983_aa746f633219c6cf580d.jpg', '2023-07-11 06:27:51', '2023-07-14 01:26:23', 66),
(56, 'downlight-bulat-6-watt', 2, 5, 'Downlight Bulat 6 Watt', '1', '18', 45000, '1689298004_622ab7973f8ef8fe34a2.jpg', '2023-07-11 06:27:51', '2023-07-18 06:30:15', 231),
(57, 'downlight-kotak-6-watt', 2, 5, 'Downlight Kotak 6 Watt', '1', '17', 45000, '1689298423_b35d54b4f990091b0817.jpg', '2023-07-11 06:27:51', '2023-07-14 01:33:43', 144),
(58, 'downlight-kotak-6-watt', 2, 5, 'Downlight Kotak 6 Watt', '1', '18', 45000, '1689298436_359dbc815752ecb16973.jpg', '2023-07-11 06:27:51', '2023-07-14 01:33:56', 330),
(59, 'downlight-kotak-3-watt', 2, 5, 'Downlight Kotak 3 Watt', '1', '17', 30000, '1689298372_543516cc58ff967ac71a.jpg', '2023-07-11 06:27:51', '2023-07-14 01:32:52', 172),
(60, 'downlight-kotak-3-watt', 2, 5, 'Downlight Kotak 3 Watt', '1', '18', 30000, '1689298385_b08aaa4859c34555f614.jpg', '2023-07-11 06:27:51', '2023-07-14 01:33:05', 197),
(61, 'downlight-kotak-9-watt', 2, 5, 'Downlight Kotak 9 Watt', '1', '18', 50000, '1689298610_49a77cdb8326ecb46c61.png', '2023-07-11 06:27:51', '2023-07-14 01:36:50', 94),
(62, 'downlight-bulat-3-watt', 2, 5, 'Downlight Bulat 3 Watt', '1', '17', 30000, '1689297940_329eb81d39b5c4aedb98.jpg', '2023-07-11 06:27:51', '2023-07-14 01:25:40', 59),
(63, 'downlight-bulat-3-watt', 2, 5, 'Downlight Bulat 3 Watt', '1', '18', 30000, '1689297957_c8aea9c3ce8a633e3bd3.jpg', '2023-07-11 06:27:51', '2023-07-14 01:25:57', 48),
(64, 'line-strip-led-biru', 2, 7, 'Line Strip LED Biru', '', '12', 25000, '1689297364_b458bc3339acf167684c.jpg', '2023-07-11 06:27:51', '2023-07-14 03:17:06', 588),
(65, 'line-strip-led-hijau', 2, 7, 'Line Strip LED Hijau', '', '12', 25000, '1689297398_cd3d3519c171fc389f72.png', '2023-07-11 06:27:51', '2023-07-14 01:16:38', 661),
(66, 'line-strip-led-kuning', 2, 7, 'Line Strip LED Kuning', '', '12', 25000, '1689297421_e39a0512c2f1fce14b10.jpg', '2023-07-11 06:27:51', '2023-07-18 06:34:27', 136),
(67, 'line-strip-led-pink', 2, 7, 'Line Strip LED Pink', '', '12', 25000, '1689297433_910fb5ae3dbe3b013e26.jpg', '2023-07-11 06:27:51', '2023-07-14 01:17:13', 152),
(68, 'line-strip-led-putih', 2, 7, 'Line Strip LED Putih', '', '12', 25000, '1689297462_aedad112f35f2c027a07.webp', '2023-07-11 06:27:51', '2023-07-14 01:17:42', 1118),
(69, 'downlight-6w-kotak', 2, 5, 'Downlight 6W Kotak', 'Emico', '48', 70000, '1689299131_92d415be081ba1cc19fa.jpg', '2023-07-11 06:27:51', '2023-07-14 02:14:31', 160),
(70, 'downlight-6w-kotak', 2, 5, 'Downlight 6W Kotak', 'Emico', '47', 70000, '1689299147_b34d90aeee97a5bb9f0d.jpg', '2023-07-11 06:27:51', '2023-07-14 02:14:53', 125),
(71, 'downlight-3w-bulat', 2, 5, 'Downlight 3w Bulat', '1', '19', 45000, '1689220982_10334cb99cfb569df948.png', '2023-07-11 06:27:51', '2023-07-14 03:17:06', 172),
(72, 'downlight-3w-bulat', 2, 5, 'Downlight 3w Bulat', '1', '20', 45000, '1689220991_e5d6d764b3f383611170.png', '2023-07-11 06:27:51', '2023-07-18 00:50:35', 90),
(73, 'downlight-6w-bulat', 2, 5, 'Downlight 6W Bulat', 'Emico', '48', 65000, '1689301708_3e525733121fac861bcc.jpg', '2023-07-11 06:27:51', '2023-07-18 00:50:35', 122),
(74, 'downlight-6w-bulat', 2, 5, 'Downlight 6W Bulat', 'Emico', '47', 65000, '1689299113_6ae1ff045bb5a9ecd306.jpg', '2023-07-11 06:27:51', '2023-07-14 02:14:04', 56),
(75, 'downlight-bulat-9-watt', 2, 5, 'Downlight Bulat 9 Watt', 'valescom', '18', 50000, '1689298117_2168efcf8461fffd4393.jpg', '2023-07-11 06:27:51', '2023-07-14 01:28:37', 123),
(76, 'downlight-bulat-12-watt', 2, 5, 'Downlight Bulat 12 Watt', '1', '18', 65000, '1689219915_23b7564f591b5f538610.png', '2023-07-11 06:27:51', '2023-07-18 06:39:28', 59),
(77, 'downlight-kotak-12-watt', 2, 5, 'Downlight Kotak 12 Watt', 'LED Panel Light', '18', 70000, '1689298200_1abdf2d6f3e674aa5f01.jpg', '2023-07-11 06:27:51', '2023-07-14 01:30:00', 146),
(78, 'downlight-bulat-18-watt', 2, 5, 'Downlight bulat 18 Watt', 'Valescom', '18', 75000, '1689297670_2f4d51fa8fa28a88a970.jpg', '2023-07-11 06:27:51', '2023-07-14 01:21:10', 120),
(79, 'downlight-kotak-18-watt', 2, 5, 'Downlight Kotak 18 Watt', 'Rocia', '18', 90000, '1689298343_66a35c9cd0f69fa8e137.jpg', '2023-07-11 06:27:51', '2023-07-21 14:20:25', 68),
(80, 'adaptor-line-strip', 2, 7, 'Adaptor Line Strip', '', '46', 25000, '1689296707_7d0e8334a0e4e185c080.png', '2023-07-11 06:27:51', '2023-08-02 19:53:32', 1017),
(81, 'downlight-6w-kotak', 2, 5, 'Downlight 6W Kotak', 'Putih, Biru, Kuning', '21', 35000, '1689299485_820e938a7ad5c19197f2.png', '2023-07-11 06:27:51', '2023-07-14 02:15:10', 1),
(82, 'downlight-6w-kotak', 2, 5, 'Downlight 6w Kotak', '1', '20', 45000, '1689221000_347a4a0ec9c8e25eadee.png', '2023-07-11 06:27:51', '2023-07-18 00:48:20', 80),
(83, 'downlight-6w-kotak', 2, 5, 'Downlight 6w Kotak', '1', '19', 45000, '1689221008_68afce983d1e34b91fcc.png', '2023-07-11 06:27:51', '2023-07-18 00:48:34', 100),
(84, 'sjf-002', 2, 11, 'SJF 002', '1', '31', 25000, '1689302524_4683541da02ccc5200b7.png', '2023-07-11 06:27:51', '2023-07-14 02:42:04', 91),
(85, 'sjf-019', 2, 11, 'SJF 019', '1', '32', 25000, '1689228234_0e399d63a291a5af22b5.png', '2023-07-11 06:27:51', '2023-07-13 06:03:54', 36),
(86, 'sjf-053', 1, 1, 'SJF 053', '1', '31', 25000, '1689301202_8ff03fc17ec90de94e6b.png', '2023-07-11 06:27:51', '2023-07-20 05:58:45', 36),
(87, 'sjf-006', 1, 1, 'SJF 006', '', '32', 25000, '1689301163_c1674e7e2220a6fef493.png', '2023-07-11 06:27:51', '2023-07-14 02:19:23', 23),
(88, 'sjk-005', 2, 6, 'SJK- 005', '1', '45', 750000, '1689224727_ce3874beecf610fd8d95.png', '2023-07-11 06:27:51', '2023-07-13 05:05:27', 137),
(89, 'sjk-001', 2, 6, 'SJK - 001', 'Kerawangan Putih Motif Bintang', '33', 95000, '1689224397_da158329e5cb44958333.png', '2023-07-11 06:27:51', '2023-07-13 04:59:57', 61),
(90, 'sjk-002', 2, 6, 'SJK - 002', 'Kerawangan Putih Motif Abstrak', '34', 95000, '1689224436_97e1254f22bd5942cb21.png', '2023-07-11 06:27:51', '2023-07-13 05:00:36', 120),
(91, 'sjk-003', 2, 6, 'SJK - 003', 'Kerawangan Putih Motif Batik', '35', 95000, '1689224469_a7c3abf7fb504f13b10e.png', '2023-07-11 06:27:51', '2023-07-13 05:01:09', 101),
(92, 'sjk-004', 2, 6, 'SJK - 004', 'Kerawangan Putih Motif Bunga', '36', 95000, '1689224515_9f899233a835f2c90589.png', '2023-07-11 06:27:51', '2023-07-20 06:08:02', 80),
(93, 'sb-004', 2, 9, 'SB - 004', 'Putih Gold', '14', 225000, '1689225011_b58c59ae89bd3d36b19e.png', '2023-07-11 06:27:51', '2023-07-14 03:17:06', 19),
(94, 'sb-005', 2, 9, 'SB - 005', 'Merah Muda + Gold', '14', 225000, '1689225065_41bcfe13465af8c743fa.png', '2023-07-11 06:27:51', '2023-07-13 05:11:05', 1),
(95, 'sb-010', 2, 9, 'SB - 010', 'Hijau + Silver', '14', 225000, '1689225094_eae8031ffd9b8a88fd90.png', '2023-07-11 06:27:51', '2023-07-13 05:11:34', 1),
(96, 'sd-001', 2, 9, 'SD - 001', 'Cream + Gold', '14', 225000, '1689225154_15dd800b2bce51859b3b.png', '2023-07-11 06:27:51', '2023-07-13 05:12:34', 18),
(97, 'sd-004', 2, 9, 'SD - 004', 'Segi 8 Putih + Gold', '14', 225000, '1689225220_fdb18c6d171f72c1684f.png', '2023-07-11 06:27:51', '2023-07-13 05:13:40', 63),
(98, 'sd-005', 2, 9, 'SD - 005', 'Segi 8 Merah muda + Gold', '14', 225000, '1689225267_cf7bb57aa8a399d9d075.png', '2023-07-11 06:27:51', '2023-07-13 05:14:27', 3),
(99, 'sd-006', 2, 9, 'SD - 006', 'Segi 8 Silver Putih', '14', 225000, '1689225307_14dc9fdf5ac8873c8ed9.png', '2023-07-11 06:27:51', '2023-07-18 05:49:20', 1),
(100, 'sd-007', 2, 9, 'SD - 007', 'Segi 8 Merah Muda + Silver', '14', 225000, '1689225337_ef4c7546c7b5fdd888ec.png', '2023-07-11 06:27:51', '2023-07-13 05:15:37', 4),
(101, 'sd-010', 2, 9, 'SD - 010', 'Segi 8 Hijau + Silver', '14', 225000, '1689225373_2c60bad7f6db26ee33cf.png', '2023-07-11 06:27:51', '2023-07-13 05:16:13', 2),
(102, 'sd-011', 2, 9, 'SD - 011', 'Segi 8 Hitam Silver', '14', 225000, '1689226097_701dd2e15a6eb141f8e1.png', '2023-07-11 06:27:51', '2023-07-14 03:17:06', 5),
(103, 'se-008', 2, 9, 'SE - 008', 'Segi 4 Merah Muda', '14', 225000, '1689226253_a7671936ddcc38bd6ead.png', '2023-07-11 06:27:51', '2023-07-14 02:46:51', 1),
(104, 'se-001', 2, 9, 'SE - 001', 'Segi 4 Cream Gold\r\n', '14', 225000, '1689226132_470d4962cbe2fca62a63.png', '2023-07-11 06:27:51', '2023-07-13 05:28:52', 21),
(105, 'se-004', 2, 9, 'SE - 004', 'segi 4 putih gold', '14', 225000, '1689226167_891ce1f802340d3a368e.png', '2023-07-11 06:27:51', '2023-07-13 05:29:27', 6),
(106, 'se-005', 2, 9, 'SE - 005', 'segi 4 Merah Muda Gold', '14', 225000, '1689226210_040450a782ae816c052d.png', '2023-07-11 06:27:51', '2023-07-13 05:30:10', 3),
(107, 'se-005', 2, 9, 'SE - 005', 'Segi 4 Silver Merah muda', '14', 225000, '1689301031_4ef7f600fbdfc72f9d67.png', '2023-07-11 06:27:51', '2023-07-14 02:17:11', 7),
(108, 'se-009', 2, 9, 'SE - 009', 'Segi 4 Biru Silver', '14', 225000, '1689226275_a71a2a668dc1dc7af3e3.png', '2023-07-11 06:27:51', '2023-07-13 05:31:15', 1),
(109, 'se-010', 2, 9, 'SE - 010', 'Segi 4 Hijau Silver', '14', 225000, '1689226302_1efe80c8590a0692d466.png', '2023-07-11 06:27:51', '2023-07-13 05:31:42', 3),
(110, 'se-011', 2, 9, 'SE - 011', 'Segi 4 Hitam Silver', '14', 225000, '1689302126_ff391ab0e370193319d5.png', '2023-07-11 06:27:51', '2023-07-14 02:35:26', 3),
(111, 'se-007', 2, 9, 'SE - 007', 'Ornamen Segi Kotak', '14', 225000, '1689224875_1537e3b0b11b9f667d11.png', '2023-07-11 06:27:51', '2023-07-13 05:07:55', 2),
(112, 'sd-kaligrafi', 2, 9, 'SD - KALIGRAFI', 'Ornamen Kaligrafi Segi 8', '14', 225000, '1689224331_63154ccc14ccd75352c1.png', '2023-07-11 06:27:51', '2023-07-13 04:58:51', 1),
(113, 'se-kaligrafi', 2, 9, 'SE - KALIGRAFI', 'Ornamen Kaligrafi Segi Kotak', '14', 225000, '1689224289_ee02cfa81df66d02cfda.png', '2023-07-11 06:27:51', '2023-07-13 04:58:09', 20),
(114, 'sjo-001', 2, 9, 'SJO - 001', 'Segi 4 Gold', '29', 275000, '1689227057_2836be91ab561c643af1.jpg', '2023-07-11 06:27:51', '2023-07-13 05:44:17', 20),
(115, 'sjo-001', 2, 9, 'SJO - 001', 'Segi 4 Coklat', '29', 275000, '1689226757_23ec6a19f382e73ca984.jpg', '2023-07-11 06:27:51', '2023-07-13 05:39:17', 10),
(116, 'sjo-001', 2, 9, 'SJO - 001', 'Segi 4 Silver', '29', 275000, '1689226784_fc55e1fd2afb17ccd0f0.jpg', '2023-07-11 06:27:51', '2023-07-13 05:39:44', 30),
(117, 'sjo-002', 2, 9, 'SJO - 002', 'Gold', '29', 275000, '1689224114_9ff20526b3da91c88ad0.png', '2023-07-11 06:27:51', '2023-07-13 04:55:14', 7),
(118, 'sjo-002', 2, 9, 'SJO - 002', 'PUTIH', '29', 275000, '1689224141_9c8e50229118392b875b.png', '2023-07-11 06:27:51', '2023-07-13 04:55:41', 27),
(119, 'm07', 2, 25, 'M07', 'Gold', '27', 500000, '1689227010_e403a06d5c44790a34e6.png', '2023-07-11 06:27:51', '2023-07-13 05:43:30', 50),
(120, 'sp-002', 7, 26, 'SP-002', '1 Dus = 15 Lembar', '5', 120000, '1689301569_a11e2832eec8879167d3.jpeg', '2023-07-11 06:27:51', '2023-07-15 03:54:48', 15),
(121, 'sp-008', 2, 26, 'SP-008', '1 Dus = 15 Lembar', '5', 120000, '1689301582_e1e244da7de2752764e3.jpeg', '2023-07-11 06:27:51', '2023-07-14 02:26:22', 30),
(122, 'skrup-so', 3, 16, 'Skrup SO', '1 kotak Isi 1kg', '7', 55000, '1689301354_a33088c84be5b8e5bf6b.png', '2023-07-11 06:27:51', '2023-07-20 06:07:38', 281),
(123, 'skrup-mmi', 3, 16, 'SKRUP MMI', '1', '10', 70000, '1689297168_def64402159ccce0ff51.png', '2023-07-11 06:27:51', '2023-07-14 01:12:48', 133),
(124, 'skrup-mmi', 2, 16, 'SKRUP MMI', '1', '7', 50000, '1689297178_793736116ab7463a52f0.png', '2023-07-11 06:27:51', '2023-07-14 01:12:58', 100),
(125, 'skrup-w', 3, 16, 'SKRUP W', '1 kotak = 1KG', '7', 50000, '1689301488_71958c5e83c12c9d1b42.png', '2023-07-11 06:27:51', '2023-07-14 02:24:48', 9),
(126, 'skrup-w', 3, 16, 'SKRUP W', '1 kotak = 1kg', '10', 100000, '1689301513_4790f6ef7536e4d2d9a6.png', '2023-07-11 06:27:51', '2023-08-02 19:28:38', 33),
(127, 'malibu', 3, 16, 'MALIBU', '1', '10', 70000, '1689223776_c30ecd65e18d2af193f6.png', '2023-07-11 06:27:51', '2023-07-13 04:49:36', 19),
(128, 'silikon', 3, 14, 'Silikon', '1', '15', 50000, '1689220892_9cee5c1cb526460f27df.png', '2023-07-11 06:27:51', '2023-07-18 06:41:03', 67),
(129, 'hollow', 3, 22, 'Hollow', 'Tebal 0.25 Uk. 2x4', '11', 22000, '1689298830_b288c7896b08425f5f0f.png', '2023-07-11 06:27:51', '2023-08-02 07:02:10', 1049),
(130, 'kabel-listrik', 3, 20, 'Kabel Listrik', '1', '26', 410000, '1689223753_b7e809ef809cbf0046d3.png', '2023-07-11 06:27:51', '2023-07-18 06:37:01', 7),
(131, 'batraja-15in', 3, 16, 'Batraja 1.5in', '0', '10', 50000, '1689059602_7dd3abf432da7ace7c67.png', '2023-07-11 06:27:51', '2023-09-22 22:38:46', 112),
(135, 'isolasi', 3, 15, 'Isolasi', 'Isolasi Bening Besar', '24', 10000, '1689299019_6ec8aaa99e772d860df9.png', '2023-07-11 06:27:51', '2023-07-14 01:43:39', 215),
(136, 'isolasi-pust-on', 3, 15, 'Isolasi Pust-on', 'Isolasi Listrik', '25', 8000, '1689298889_2e9eaa109cfc494b9cd6.png', '2023-07-11 06:27:51', '2023-07-18 06:32:05', 77),
(137, 'lem-korea', 3, 13, 'Lem Korea', '1', '23', 10000, '1689220864_98be5d512a9b64dab452.png', '2023-07-11 06:27:51', '2023-07-20 06:08:13', 750),
(138, 'sj-2008a', 1, 3, 'SJ-2008A', '1', '6', 742500, '1689168055_bbd6bd3aa51e168ad109.jpg', '2023-07-11 06:27:51', '2023-07-12 13:20:55', 2),
(139, 'sj-2006', 1, 3, 'SJ-2006', '1', '5', 990000, '1689218063_066e62e0ff19bfc18cd7.jpg', '2023-07-11 06:27:51', '2023-07-23 12:48:13', 3),
(140, 'sj-2022', 1, 3, 'SJ-2022', '1', '5', 990000, '1689220211_6457f7037fe77f34b542.jpg', '2023-07-11 06:27:51', '2023-07-19 15:02:48', 8),
(141, 'sj-2028', 1, 3, 'SJ-2028', '1', '5', 990000, '1689225337_18d22b221c1686ac5813.jpg', '2023-07-11 06:27:51', '2023-07-13 05:15:37', 14),
(142, 'sj-2030', 1, 3, 'SJ-2030', '1', '5', 990000, '1689226232_9063a9114dd6efb0d1c8.jpg', '2023-07-11 06:27:51', '2023-07-15 07:28:09', 14),
(143, 'sj-2031', 1, 3, 'SJ-2031', '1', '5', 990000, '1689226300_a123dac791305e8aba01.jpg', '2023-07-11 06:27:51', '2023-07-13 05:31:40', 20),
(144, 'sj-2036', 1, 3, 'SJ-2036', '1', '5', 990000, '1689226434_f70af56595af654c4ef3.jpg', '2023-07-11 06:27:51', '2023-07-18 00:50:35', 19),
(145, 'sj-2037', 1, 3, 'SJ-2037', '1', '5', 990000, '1689226459_1f6a4ec911186f33ea1e.jpg', '2023-07-11 06:27:51', '2023-07-13 05:34:19', 2),
(146, 'sj-2039', 1, 3, 'SJ-2039', '1', '5', 990000, '1689226697_de357596f0ae2ac86324.jpg', '2023-07-11 06:27:51', '2023-07-13 05:38:17', 10),
(147, 'sj-2045', 1, 3, 'SJ-2045', '1', '5', 990000, '1689226780_14c410161076419c3587.jpg', '2023-07-11 06:27:51', '2023-07-13 05:39:40', 12),
(149, 'sj-2053', 1, 3, 'SJ-2053', '1', '5', 990000, '1689226979_a6d118dd30619cb7d773.jpg', '2023-07-11 06:27:51', '2023-07-13 05:42:59', 5),
(150, 'sj-2054', 1, 3, 'SJ-2054', '1', '6', 742500, '1689227010_9fa34ca5b5f1685853db.jpg', '2023-07-11 06:27:51', '2023-07-15 09:00:34', 2),
(151, 'sj-2054', 1, 3, 'SJ-2054', '1', '5', 990000, '1689227161_8c14c7107c725f742f75.jpg', '2023-07-11 06:27:51', '2023-07-15 08:50:45', 10),
(152, 'sj-2062', 1, 3, 'SJ-2062', '1', '6', 742500, '1689227420_e98b5267b9c5de85b4cf.jpg', '2023-07-11 06:27:51', '2023-07-13 05:50:20', 4),
(153, 'sj-2062', 1, 3, 'SJ-2062', '1', '5', 990000, '1689228806_fb606a934bcbd283d9d4.jpg', '2023-07-11 06:27:51', '2023-07-13 06:13:26', 15),
(154, 'sj-2069', 1, 3, 'SJ-2069', '1', '5', 990000, '1689229203_039621c31c60e59480b9.jpg', '2023-07-11 06:27:51', '2023-08-02 07:02:10', 5),
(155, 'sj-2070', 1, 3, 'SJ-2070', '1', '5', 990000, '1689229237_b34b756e921a8318edcc.jpg', '2023-07-11 06:27:51', '2023-07-18 00:50:35', 8),
(156, 'sj-2071', 1, 3, 'SJ-2071', '1', '5', 990000, '1689229266_679c3576d241b4cd6956.jpg', '2023-07-11 06:27:51', '2023-07-13 06:21:06', 12),
(157, 'sj-2073', 1, 3, 'SJ-2073', '1', '5', 990000, '1689229315_9d795c9e1344ca2c2568.jpg', '2023-07-11 06:27:51', '2023-07-13 06:21:55', 7),
(159, 'sj-2077', 1, 3, 'SJ-2077', '1', '6', 990000, '1689229556_17d9133b844aff7f2823.jpg', '2023-07-11 06:27:51', '2023-07-13 06:25:56', 5),
(160, 'sj-2077', 1, 3, 'SJ-2077', '1', '5', 990000, '1689229579_1dd0bf25be1301030f01.jpg', '2023-07-11 06:27:51', '2023-07-13 22:14:07', 6),
(162, 'sj-2080', 1, 3, 'SJ-2080', '1', '6', 742500, '1689229684_2e07e59265af9f01fda3.jpg', '2023-07-11 06:27:51', '2023-08-02 07:02:10', 10),
(163, 'sj-2080', 1, 3, 'SJ-2080', '1', '5', 990000, '1689229709_3992924469ba95495a29.jpg', '2023-07-11 06:27:51', '2023-07-13 06:28:29', 2),
(164, 'sj-2085', 1, 3, 'SJ-2085', '1', '5', 990000, '1689229730_341b052d19ea83a833cc.jpg', '2023-07-11 06:27:51', '2023-07-13 06:28:50', 13),
(165, 'sj-2086', 1, 3, 'SJ-2086', '1', '5', 990000, '1689302151_0242c449f4338bc00fde.jpg', '2023-07-11 06:27:51', '2023-07-14 02:35:51', 17),
(166, 'sj-2087', 1, 3, 'SJ-2087', '', '5', 990000, '1689229458_f65af8ff7c7a44d5d7ca.jpg', '2023-07-11 06:27:51', '2023-07-13 06:24:18', 24),
(167, 'sj-2088', 1, 3, 'SJ-2088', '', '5', 990000, '1689229471_c36841fe697987013b73.jpg', '2023-07-11 06:27:51', '2023-07-14 01:32:28', 10),
(168, 'sj-2008b', 1, 3, 'SJ-2008B', '1', '6', 742500, '1689218094_99c75f1d3a1079b36a8e.jpg', '2023-07-11 06:27:51', '2023-07-13 03:14:54', 3),
(169, 'sj-2008b', 1, 3, 'SJ-2008B', '1', '5', 990000, '1689168072_f377047c24736d381201.jpg', '2023-07-11 06:27:51', '2023-07-12 13:21:12', 19),
(171, 'sj-2029', 1, 3, 'SJ-2029', '1', '5', 990000, '1689225351_fe0c2ee1e4d7ade3256b.jpg', '2023-07-11 06:27:51', '2023-07-13 05:15:51', 17),
(172, 'sj-2032', 1, 3, 'SJ-2032', '1', '6', 742500, '1689226322_b23b8a3e9777db93a046.jpg', '2023-07-11 06:27:51', '2023-07-13 05:32:02', 1),
(173, 'sj-2034', 1, 3, 'SJ-2034', '1', '5', 990000, '1689226350_af8b112856596f8a038a.jpg', '2023-07-11 06:27:51', '2023-07-13 05:32:30', 12),
(174, 'sj-2043', 1, 3, 'SJ-2043', '1', '5', 990000, '1689226757_06456ecbf93d5aa17113.jpg', '2023-07-11 06:27:51', '2023-07-13 05:39:17', 4),
(175, 'sj-2048', 1, 3, 'SJ-2048', '1', '5', 990000, '1689226854_1c08cd2a92ccaf5aa4e6.jpg', '2023-07-11 06:27:51', '2023-08-02 07:02:10', 23),
(176, 'sj-2050', 1, 3, 'SJ-2050', '1', '6', 742500, '1689226873_e07a4fa4b2b388eaa7ec.jpg', '2023-07-11 06:27:51', '2023-07-13 05:41:13', 5),
(177, 'sj-2050', 1, 3, 'SJ-2050', '1', '5', 990000, '1689226901_cb68ddc0e841fc520e21.jpg', '2023-07-11 06:27:51', '2023-07-15 07:41:16', 7),
(178, 'sj-2072', 1, 3, 'SJ-2072', '1', '5', 990000, '1689229293_3e60798a1dd26b8e91a7.jpg', '2023-07-11 06:27:51', '2023-07-14 03:53:51', 25),
(179, 'sj-2021', 1, 3, 'SJ-2021', '1', '5', 990000, '1689220183_72ca58f285dc8d9599f9.png', '2023-07-11 06:27:51', '2023-07-15 07:26:39', 11),
(180, 'sj-2035', 1, 3, 'SJ-2035', '1', '6', 742500, '1689226378_31dc5fba54656f7ff603.jpg', '2023-07-11 06:27:51', '2023-07-13 05:32:58', 1),
(181, 'sj-2035', 1, 3, 'SJ-2035', '1', '5', 990000, '1689226405_87c9408933c206e5edf8.jpg', '2023-07-11 06:27:51', '2023-07-13 22:14:07', 8),
(182, 'sj-2089', 1, 3, 'SJ-2089', '', '5', 990000, '1689229490_80cbdd1d6337fa9d25b8.jpg', '2023-07-11 06:27:51', '2023-07-13 06:24:50', 11),
(183, 'sj-2090', 1, 3, 'SJ-2090', '', '6', 742500, '1689302164_491f9e05eba981734a34.jpg', '2023-07-11 06:27:51', '2023-07-14 02:36:04', 3),
(184, 'sj-2090', 1, 3, 'SJ-2090', '', '5', 990000, '1689229526_6f36a14ffbde0fab1f5b.jpg', '2023-07-11 06:27:51', '2023-07-13 06:25:26', 14),
(185, 'sj-2097', 1, 3, 'SJ-2097', '1 Dus = 15 Lembar', '6', 742500, '1689229622_d6cd50a69fc9818a7b63.jpg', '2023-07-11 06:27:51', '2023-07-13 06:27:02', 2),
(186, 'sj-2097', 1, 3, 'SJ-2097', '1 Dus = 15 Lembar', '5', 990000, '1689229664_9497ba608a28be5fb760.jpg', '2023-07-11 06:27:51', '2023-07-13 06:27:44', 15),
(187, 'sj-2004', 1, 3, 'SJ-2004', '1', '5', 990000, '1689218002_9b0f9eea799de7da3c66.jpg', '2023-07-11 06:27:51', '2023-07-13 03:13:22', 1),
(188, 'sj-2005', 1, 3, 'SJ-2005', '1', '6', 742500, '1689218029_99aab2b6661febf034c5.jpg', '2023-07-11 06:27:51', '2023-07-13 03:13:49', 4),
(189, 'sj-2009', 1, 3, 'SJ-2009', '1', '5', 990000, '1689168088_bcf67cbddb75acf5b1c6.jpg', '2023-07-11 06:27:51', '2023-07-12 13:21:28', 9),
(190, 'sj-2010', 1, 3, 'SJ-2010', '1', '5', 990000, '1689168104_3a1571d01351a14b2234.jpg', '2023-07-11 06:27:51', '2023-07-12 13:21:44', 1),
(191, 'sj-2011', 1, 3, 'SJ-2011', '1', '5', 990000, '1689218185_625e8aa134b03a211767.jpg', '2023-07-11 06:27:51', '2023-07-13 03:16:25', 2),
(192, 'sj-2012', 1, 3, 'SJ-2012', '1', '5', 990000, '1689220013_35f2b4209b1a02b3d032.jpg', '2023-07-11 06:27:51', '2023-07-13 14:48:11', 2),
(193, 'sj-2019', 1, 3, 'SJ-2019', '1', '6', 742500, '1689220089_8adc76f260b346a51602.jpg', '2023-07-11 06:27:51', '2023-07-15 07:24:33', 3),
(194, 'sj-2019', 1, 3, 'SJ-2019', '1', '5', 990000, '1689220113_8c046bc2e76fdf5a19a1.jpg', '2023-07-11 06:27:51', '2023-07-13 03:48:33', 0),
(195, 'sj-2020', 1, 3, 'SJ-2020', '1', '5', 990000, '1689220145_90a897cf48895a145497.jpg', '2023-07-11 06:27:51', '2023-07-13 03:49:05', 19),
(196, 'sj-2024', 1, 3, 'SJ-2024', '1', '5', 990000, '1689220233_3261e7a670e355916190.jpg', '2023-07-11 06:27:51', '2023-07-13 03:50:33', 6),
(197, 'sj-2025', 1, 3, 'SJ-2025', '1', '6', 742500, '1689220260_632dcc8c236a6377f87c.jpg', '2023-07-11 06:27:51', '2023-07-13 03:51:00', 0),
(198, 'sj-2025', 1, 3, 'SJ-2025', '1', '5', 990000, '1689220291_ab8a92907da6c067f76d.jpg', '2023-07-11 06:27:51', '2023-08-01 23:19:11', 6),
(199, 'sj-2026', 1, 3, 'SJ-2026', '1', '5', 990000, '1689225214_ea108f63002c5513f7a9.jpg', '2023-07-11 06:27:51', '2023-07-13 05:13:34', 13),
(200, 'sj-2052', 1, 3, 'SJ-2052', '1', '5', 990000, '1689226953_72ce3def1b97ef4f10b1.jpg', '2023-07-11 06:27:51', '2023-07-13 05:42:33', 8),
(201, 'sj-2055', 1, 3, 'SJ-2055', '1', '5', 990000, '1689227202_eea22a78044486065ef5.jpg', '2023-07-11 06:27:51', '2023-07-13 05:46:42', 5),
(202, 'sj-2058', 1, 3, 'SJ-2058', '1', '6', 742500, '1689227228_f00fa31a7af7545a8c5c.jpg', '2023-07-11 06:27:51', '2023-07-13 05:47:08', 5),
(203, 'sj-2058', 1, 3, 'SJ-2058', '1', '5', 990000, '1689227252_f20aa7242ba03c1bbb33.jpg', '2023-07-11 06:27:51', '2023-07-13 05:47:32', 18),
(204, 'sj-2060', 1, 3, 'SJ-2060', '1', '6', 742500, '1689227294_3b6885330a5c110b1d19.jpg', '2023-07-11 06:27:51', '2023-07-13 05:48:14', 4),
(205, 'sj-2060', 1, 3, 'SJ-2060', '1', '5', 990000, '1689227345_8acb53c9559342085d04.jpg', '2023-07-11 06:27:51', '2023-07-13 05:49:05', 10),
(206, 'sj-2061', 1, 3, 'SJ-2061', '1', '6', 742500, '1689227372_264c82d3f426902a0b4f.jpg', '2023-07-11 06:27:51', '2023-07-13 05:49:32', 4),
(207, 'sj-2061', 1, 3, 'SJ-2061', '1', '5', 990000, '1689227397_9e2b4dc6ba1d5a1f254a.jpg', '2023-07-11 06:27:51', '2023-07-13 05:49:57', 12),
(208, 'sj-2065', 1, 3, 'SJ-2065', '1', '5', 990000, '', '2023-07-11 06:27:51', '2023-07-12 06:09:33', 15),
(209, 'sj-2066', 1, 3, 'SJ-2066', '1', '6', 742500, '1689228975_2e381d9ce57da976d875.jpg', '2023-07-11 06:27:51', '2023-07-13 06:16:15', 2),
(210, 'sj-2066', 1, 3, 'SJ-2066', '1', '5', 990000, '1689229072_7c65402e764ee3cb9392.jpg', '2023-07-11 06:27:51', '2023-07-13 06:17:52', 3),
(211, 'sj-2068', 1, 3, 'SJ-2068', '1', '5', 990000, '1689229110_ab9a5c70d76b1a3b6063.jpg', '2023-07-11 06:27:51', '2023-07-13 06:18:30', 1),
(212, 'sj-2076', 1, 3, 'SJ-2076', '1', '6', 990000, '1689229492_9ed8f71d1e62732e2a57.jpg', '2023-07-11 06:27:51', '2023-07-13 06:24:52', 4),
(213, 'sj-2076', 1, 3, 'SJ-2076', '1', '5', 990000, '1689229521_95b1ee1c0335a7b64693.jpg', '2023-07-11 06:27:51', '2023-07-13 06:25:21', 7),
(214, 'sj-2078', 1, 3, 'SJ-2078', '1', '6', 742500, '1689229613_c9aab8b88e77a8a62736.jpg', '2023-07-11 06:27:51', '2023-07-13 06:26:53', 2),
(215, 'sj-2078', 1, 3, 'SJ-2078', '1', '5', 990000, '1689229637_ba172942574d734d9608.jpg', '2023-07-11 06:27:51', '2023-07-13 06:27:17', 15),
(216, 'sj-2099', 1, 3, 'SJ-2099', '1 Dus = 15 Lembar', '6', 742500, '1689229681_9cf84aeb34359ef3e81a.jpg', '2023-07-11 06:27:51', '2023-07-13 06:28:01', 3),
(217, 'sj-2099', 1, 3, 'SJ-2099', '1 Dus = 15 Lembar', '5', 990000, '1689229697_5a98639ad5ae9862f26f.jpg', '2023-07-11 06:27:51', '2023-07-17 01:18:37', 5),
(218, 'sj-2095', 1, 3, 'SJ-2095', '', '6', 742500, '1689229541_f4ebc401221456dd6555.jpg', '2023-07-11 06:27:51', '2023-07-13 06:25:41', 6),
(219, 'sj-2095', 1, 3, 'SJ-2095', '1', '5', 990000, '1689229554_10f1c519b2f0268eb52d.jpg', '2023-07-11 06:27:51', '2023-07-13 06:25:54', 9),
(220, 'sj-2096', 1, 3, 'SJ-2096', '', '6', 742500, '1689229570_53f54edc4ef8a13fd874.jpg', '2023-07-11 06:27:51', '2023-07-13 06:26:10', 6),
(221, 'sj-2096', 1, 3, 'SJ-2096', '1 Dus = 15 Lembar', '5', 990000, '1689229607_ecdc75e41bcd4a902a38.jpg', '2023-07-11 06:27:51', '2023-07-13 06:26:47', 9),
(222, 'sj-2105', 1, 3, 'SJ-2105', '1 Dus = 15 Lembar', '6', 742500, '1689229711_87bffe350aed805a67d7.jpg', '2023-07-11 06:27:51', '2023-07-13 06:28:31', 0),
(223, 'sj-2105', 1, 3, 'SJ-2105', '1 Dus = 15 Lembar', '5', 990000, '1689229741_00e5340a734580cf53d5.jpg', '2023-07-11 06:27:51', '2023-07-13 06:29:01', 4),
(224, 'sj-2125', 1, 3, 'SJ-2125', '1', '5', 990000, '1689229889_5e92a5d360a6539a80c3.jpg', '2023-07-11 06:27:51', '2023-07-13 06:31:29', 18),
(225, 'sj-2126', 1, 3, 'SJ-2126', '1', '5', 990000, '1689229921_3ba58649b1241190ac07.jpg', '2023-07-11 06:27:51', '2023-07-13 06:32:01', 7),
(226, 'sj-2109', 1, 3, 'SJ-2109', '1 Dus = 15 Lembar', '5', 990000, '1689229863_68c209d42024b99e88e7.jpeg', '2023-07-11 06:27:51', '2023-07-13 06:31:03', 3),
(227, 'sj-2111', 1, 3, 'SJ-2111', '1 Dus = 15 Lembar', '6', 742500, '1689229882_0e296fb1cc243f7165ec.jpg', '2023-07-11 06:27:51', '2023-07-14 03:33:51', 4),
(228, 'sj-2111', 1, 3, 'SJ-2111', '1 Dus = 15 Lembar', '5', 990000, '1689229899_1b64e2d8d2386e394b2b.jpg', '2023-07-11 06:27:51', '2023-07-13 06:31:39', 32),
(229, 'sj-2111-n', 1, 3, 'SJ-2111 N', '1 Dus = 15 Lembar', '5', 990000, '1689229919_9e4ba43ff779c7c210b4.jpg', '2023-07-11 06:27:51', '2023-07-13 06:31:59', 17),
(230, 'sj-2120', 1, 3, 'SJ-2120', '1', '5', 990000, '1689229866_dad71b7c8990c61f5d99.jpg', '2023-07-11 06:27:51', '2023-07-13 06:31:06', 1),
(231, 'sj-2107', 1, 3, 'SJ-2107', '1 Dus = 15 Lembar', '5', 990000, '1689229840_72e0f29025fdecb0462f.jpg', '2023-07-11 06:27:51', '2023-07-13 06:30:40', 7),
(232, 'sj-2116', 1, 3, 'SJ-2116', '1', '5', 990000, '1689229840_90fd2e08ea2104fead5a.jpg', '2023-07-11 06:27:51', '2023-07-13 06:30:40', 15),
(233, 'sj-2001', 1, 3, 'SJ-2001', '1', '5', 990000, '1689217945_3d1f55bba05c01070d25.jpg', '2023-07-11 06:27:51', '2023-07-14 06:09:19', 2),
(234, 'sjp-019', 1, 1, 'SJP-019', '1', '6', 742500, '1689220742_eb2b04c90213d5d030f6.jpg', '2023-07-11 06:27:51', '2023-07-14 03:27:24', 4),
(235, 'sjp-019', 1, 1, 'SJP-019', '1', '5', 990000, '1689220753_123f7717f6b8106739ec.jpg', '2023-07-11 06:27:51', '2023-07-15 08:32:36', 2),
(236, 'sjp-018', 1, 1, 'SJP-018', '1', '6', 742500, '1689220713_4fd2ab30e27cf46e6076.jpg', '2023-07-11 06:27:51', '2023-07-13 03:58:33', 1),
(237, 'sjp-018', 1, 1, 'SJP-018', '1', '5', 990000, '1689220727_879fdfc1c489c6d834bb.jpg', '2023-07-11 06:27:51', '2023-07-13 03:58:47', 2),
(238, 'sjp-014', 1, 1, 'SJP-014', '1', '5', 990000, '1689220698_0b3a82fdd9b7de403745.jpg', '2023-07-11 06:27:51', '2023-07-15 08:30:44', 8),
(239, 'sjp-013-n', 1, 1, 'SJP-013 N', '1', '6', 742500, '1689220667_d8993866ef7858c1861e.jpg', '2023-07-11 06:27:51', '2023-07-13 03:57:47', 2),
(240, 'sjp-013-n', 1, 1, 'SJP-013 N', '1', '5', 990000, '1689220679_c9fe0a023e601c391a8e.jpg', '2023-07-11 06:27:51', '2023-07-13 03:57:59', 23),
(241, 'sjp-013', 1, 1, 'SJP-013', '1', '6', 742500, '1689220628_9e56e400aa16b9317a63.jpg', '2023-07-11 06:27:51', '2023-07-13 03:57:08', 1),
(242, 'sjp-013', 1, 1, 'SJP-013', '1', '5', 990000, '1689220654_2721d1d3ebf453fa41e6.jpg', '2023-07-11 06:27:51', '2023-07-13 03:57:34', 8),
(243, 'sjp-012-n', 1, 1, 'SJP-012 N', '1', '6', 742500, '1689220614_6c6300d85e2d0a956102.jpg', '2023-07-11 06:27:51', '2023-07-13 03:56:54', 1),
(244, 'sjp-012', 1, 1, 'SJP-012', '1', '5', 990000, '1689220602_b40c469c951f58415e1d.jpg', '2023-07-11 06:27:51', '2023-07-13 03:56:42', 2),
(245, 'sjp-011-n', 1, 1, 'SJP-011 N', '1', '5', 990000, '1689220588_b67ce0f72c73e9588bc5.jpg', '2023-07-11 06:27:51', '2023-07-14 03:17:06', 17),
(246, 'sjp-011', 1, 1, 'SJP-011', '1', '6', 742500, '1689220559_25d6448fdf6d86fb24b8.jpg', '2023-07-11 06:27:51', '2023-07-13 03:55:59', 4),
(247, 'sjp-011', 1, 1, 'SJP-011', '1', '5', 990000, '1689220571_3dca8497357df03d653e.jpg', '2023-07-11 06:27:51', '2023-07-13 03:56:11', 7),
(248, 'sjp-010-n', 1, 1, 'SJP-010 N', '1', '6', 742500, '1689220527_a18e9387885848a932e3.jpg', '2023-07-11 06:27:51', '2023-07-13 03:55:27', 4),
(249, 'sjp-010-n', 1, 1, 'SJP-010 N', '1', '5', 990000, '1689220541_d8e9132a1d73d339fe9f.jpg', '2023-07-11 06:27:51', '2023-07-13 03:55:41', 7),
(250, 'sjp-010', 1, 1, 'SJP-010', '1', '6', 742500, '1689220503_3bff8ab0be218777f0aa.jpg', '2023-07-11 06:27:51', '2023-07-14 03:33:51', 5),
(251, 'sjp-010', 1, 1, 'SJP-010', '1', '5', 990000, '1689220516_d4046cf9e6b4867c29ef.jpg', '2023-07-11 06:27:51', '2023-07-13 03:55:16', 10),
(252, 'sjp-009n', 1, 1, 'SJP-009N', '1', '5', 990000, '1689220472_8db54e8095c65cc5c847.jpg', '2023-07-11 06:27:51', '2023-07-13 03:54:32', 0),
(253, 'sjp-009', 1, 1, 'SJP-009', '1', '5', 990000, '1689220349_c78c8325aad733ee4260.jpg', '2023-07-11 06:27:51', '2023-07-13 03:52:29', 5),
(254, 'sjp-008-n', 1, 1, 'SJP-008 N', '1', '5', 990000, '1689220158_eb4c817b118da14b1ca0.jpg', '2023-07-11 06:27:51', '2023-07-15 08:26:59', 2),
(255, 'sjp-008', 1, 1, 'SJP-008', '1', '6', 742500, '1689220141_4b1aa3c6945c5a7fcf1b.jpg', '2023-07-11 06:27:51', '2023-07-13 03:49:01', 3),
(256, 'sjp-006-n', 1, 1, 'SJP-006 N', '1', '6', 742500, '1689220098_4c26ec8036c6f11ffd4e.jpg', '2023-07-11 06:27:51', '2023-07-13 03:48:18', 1),
(257, 'sjp-006-n', 1, 1, 'SJP-006 N', '1', '5', 990000, '1689220110_aa12fe243db3e7b9bffa.jpg', '2023-07-11 06:27:51', '2023-07-15 08:20:46', 0),
(258, 'sjp-006', 1, 1, 'SJP-006', '1', '5', 990000, '1689220088_aca686331284d18a2f26.jpg', '2023-07-11 06:27:51', '2023-07-13 03:48:08', 3),
(259, 'sjp-002-n', 1, 1, 'SJP-002 N', '1', '6', 742500, '1689220045_e0902ef3f912bf952371.jpg', '2023-07-11 06:27:51', '2023-07-13 03:47:25', 1),
(260, 'sjp-002-n', 1, 1, 'SJP-002 N', '1', '5', 990000, '1689220075_e812e4c39a475bedaf77.jpg', '2023-07-11 06:27:51', '2023-07-15 08:17:26', 2),
(261, 'sjp-002', 1, 1, 'SJP-002', '1', '5', 990000, '1689220035_64de1c4154d959fd8a48.jpg', '2023-07-11 06:27:51', '2023-07-13 03:47:15', 2),
(262, 'bk-001', 1, 4, 'BK-001', '', '6', 787500, '1689059622_0817688e88c4274f6cc6.jpeg', '2023-07-11 06:27:51', '2023-09-22 22:39:52', 0),
(263, 'bk-001', 1, 4, 'BK-001', '1', '5', 1050000, '1689146459_8d5606f135a444dad30a.jpeg', '2023-07-11 06:27:51', '2023-07-18 06:25:56', 9),
(264, 'bk-001-n', 1, 4, 'BK-001 N', '', '5', 1050000, '1689167482_5d60c28302b71ccc8794.jpg', '2023-07-11 06:27:51', '2023-07-24 10:12:22', 10),
(265, 'bk-002-n', 1, 4, 'BK-002 N', '1', '5', 1050000, '1689167493_13198663c58d1bec2a76.jpg', '2023-07-11 06:27:51', '2023-07-14 07:46:14', 4),
(266, 'bk-003', 1, 4, 'BK-003', '1', '5', 1050000, '1689167511_4a7038e85d64d832972e.jpg', '2023-07-11 06:27:51', '2023-07-12 13:11:51', 11),
(267, 'bk-003-n', 1, 4, 'BK-003 N', '1', '5', 1050000, '1689167546_df7ddde9d5ce216ea2f7.jpg', '2023-07-11 06:27:51', '2023-07-20 05:35:00', 20),
(268, 'bk-005', 1, 4, 'BK-005', '1', '6', 787500, '1689167607_9b965b6cf28a69ab3ed9.jpg', '2023-07-11 06:27:51', '2023-07-12 13:13:27', 1),
(269, 'bk-005-n', 1, 4, 'BK-005 N', '1', '5', 1050000, '1689167621_7ee67ba467db791898ab.jpg', '2023-07-11 06:27:51', '2023-07-12 13:13:41', 11),
(270, 'bk-007', 1, 4, 'BK-007', '1', '5', 1050000, '1689167641_ad706f86609e8e57b021.jpg', '2023-07-11 06:27:51', '2023-07-12 13:14:01', 12),
(271, 'bk-008-n', 1, 4, 'BK-008 N', '1', '6', 787500, '1689167694_6c8454c1a8d56ca069b9.jpg', '2023-07-11 06:27:51', '2023-08-03 21:37:11', 6),
(272, 'bk-008-n', 1, 4, 'BK-008 N', '1', '5', 1050000, '1689167712_6d711db26a780de4972c.jpg', '2023-07-11 06:27:51', '2023-07-12 13:15:12', 26),
(273, 'bk-007-n', 1, 4, 'BK-007 N', '1', '5', 1050000, '1689167656_d3da1393ca7877ebd0a7.jpg', '2023-07-11 06:27:51', '2023-07-15 08:41:23', 7),
(274, 'bk-008', 1, 4, 'BK-008', '1', '5', 1050000, '1689167673_fe32cfe799f9054055c2.jpg', '2023-07-11 06:27:51', '2023-07-12 13:14:33', 7),
(275, 'bk-004', 1, 4, 'BK-004', '1', '5', 1050000, '1689167564_c99ede0f1a25797d80dc.jpg', '2023-07-11 06:27:51', '2023-08-02 20:10:03', 18),
(276, 'bk-004-n', 1, 4, 'BK-004 N', '1', '5', 1050000, '1689167593_69aa18770cd2f58fc4c7.jpg', '2023-07-11 06:27:51', '2023-07-12 13:13:13', 4),
(277, 'bk-016-n', 1, 4, 'BK-016 N', '1', '5', 1050000, '1689167746_3b2b00b410b2b3978be5.jpg', '2023-07-11 06:27:51', '2023-08-03 21:29:55', 29),
(278, 'bk-017-n', 1, 4, 'BK-017 N', '1', '5', 1050000, '1689167769_041539ec2dda7ac0c725.jpg', '2023-07-11 06:27:51', '2023-07-12 13:16:09', 3),
(279, 'a-8', 4, 17, 'A-8', '0', '26', 250000, '1689059310_b726f5e132648f577c0a.png', '2023-07-11 06:27:51', '2023-08-02 19:41:52', 1),
(280, 'aa-03', 4, 17, 'AA-03', '0', '26', 250000, '1689059452_cb7428901973b6c3b193.png', '2023-07-11 06:27:51', '2023-08-23 19:53:41', 9),
(281, 'b-05', 4, 18, 'B-05', '0', '26', 160000, '1689059515_3f80e58d08058ed5d59f.png', '2023-07-11 06:27:51', '2023-08-02 21:46:58', 8),
(282, 'c-127', 4, 19, 'C-127', '1', '26', 125000, '1689217090_0ec3084c4633e0def966.png', '2023-07-11 06:27:51', '2023-07-13 02:58:10', 19),
(283, 'c-130', 4, 19, 'C-130', '1', '26', 125000, '1689217122_08aa53f95fe55e4eb6a0.png', '2023-07-11 06:27:51', '2023-07-13 02:58:42', 6),
(284, 'c-134', 4, 19, 'C-134', '1', '26', 125000, '1689217152_c38bfda1dec2656b98c3.png', '2023-07-11 06:27:51', '2023-07-15 03:53:47', 13),
(285, 'c-145', 4, 19, 'C-145', '1', '26', 125000, '1689217299_fc3ce9dd7671b9debfd5.png', '2023-07-11 06:27:51', '2023-07-13 03:01:39', 6),
(286, 'c-148', 4, 19, 'C-148', '1', '26', 125000, '1689217376_c56d8251ccc4d6cd4fdf.png', '2023-07-11 06:27:51', '2023-07-13 03:02:56', 32),
(287, 'c-192', 4, 19, 'C-192', '1', '26', 125000, '1689217578_624b10dd652878e7018d.png', '2023-07-11 06:27:51', '2023-07-13 03:06:18', 8),
(288, 'c-196', 4, 19, 'C-196', '1', '26', 125000, '1689217745_da4a96ab48e053fbacb4.png', '2023-07-11 06:27:51', '2023-07-13 03:09:05', 8),
(289, 'c-198', 4, 19, 'C-198', '1', '26', 125000, '1689217928_06454ea0a6947c96d0f4.png', '2023-07-11 06:27:51', '2023-07-13 03:12:08', 8),
(290, 'c-264', 4, 19, 'C-264', '1', '26', 125000, '1689218113_3fcfad82a3136489bc63.png', '2023-07-11 06:27:51', '2023-07-13 03:15:13', 13),
(291, 'c-265', 4, 19, 'C-265', '1', '26', 125000, '1689218361_aed3c9f9bf6286e8c979.png', '2023-07-11 06:27:51', '2023-07-13 03:19:21', 16),
(292, 'c-289', 4, 19, 'C-289', '1', '26', 125000, '1689218753_37fa76a609883670b188.png', '2023-07-11 06:27:51', '2023-07-13 03:25:53', 16),
(293, 'c-304', 4, 19, 'C-304', '1', '26', 135000, '1689219019_5765d923a927c358d077.png', '2023-07-11 06:27:51', '2023-07-13 03:30:19', 4),
(294, 'c-342', 4, 19, 'C-342', '1', '26', 135000, '1689219146_b569e5b4edad6c5a1b1d.png', '2023-07-11 06:27:51', '2023-09-23 07:10:50', 0),
(295, 'c-361', 4, 19, 'C-361', '1', '26', 135000, '1689219179_feba02f8805036407bf8.png', '2023-07-11 06:27:51', '2023-07-13 03:32:59', 1),
(296, 'c-365', 4, 19, 'C-365', '1', '26', 135000, '1689219328_ccb889f0c548fcf32305.png', '2023-07-11 06:27:51', '2023-07-13 03:35:28', 1),
(297, 'c-52', 4, 19, 'C-52', '1', '26', 125000, '1689219763_c55d9280f242123d3e1c.png', '2023-07-11 06:27:51', '2023-07-13 03:42:43', 16),
(298, 'c-86', 4, 19, 'C-86', '1', '26', 125000, '1689219857_5a95bc238ab541debc9f.png', '2023-07-11 06:27:51', '2023-07-13 03:44:17', 3),
(299, 'c-146', 4, 19, 'C-146', '1', '26', 125000, '1689217342_87539b0fbfc94a33e25d.png', '2023-07-11 06:27:51', '2023-07-13 03:02:22', 16),
(300, 'c-167', 4, 19, 'C-167', '1', '26', 125000, '1689217410_a67eda42db5f59179ae2.png', '2023-07-11 06:27:51', '2023-09-22 06:24:44', 0),
(301, 'c-181', 4, 19, 'C-181', '1', '26', 125000, '1689217447_23c3b383317ba4315c97.png', '2023-07-11 06:27:51', '2023-07-13 03:04:07', 6),
(302, 'c-249', 4, 19, 'C-249', '1', '26', 125000, '1689217999_a6c8459b3ec9771a95a6.png', '2023-07-11 06:27:51', '2023-07-13 03:13:19', 28),
(303, 'c-250', 4, 19, 'C-250', '1', '26', 125000, '1689218039_6fb86d440a52a6393571.png', '2023-07-11 06:27:51', '2023-07-13 03:13:59', 12),
(304, 'c-253', 4, 19, 'C-253', '1', '26', 125000, '1689218074_49def2aa7034281f2232.png', '2023-07-11 06:27:51', '2023-07-13 03:14:34', 5),
(305, 'c-266', 4, 19, 'C-266', '1', '26', 125000, '1689218400_000165b24838bc93d47d.png', '2023-07-11 06:27:51', '2023-07-13 03:20:00', 3),
(306, 'c-269', 4, 19, 'C-269', '1', '26', 125000, '1689218473_2b1419d0ea6e008c6acc.png', '2023-07-11 06:27:51', '2023-07-13 03:21:13', 6),
(307, 'c-336', 4, 19, 'C-336', '1', '26', 135000, '1689219105_8c483527d6087c53750d.png', '2023-07-11 06:27:51', '2023-07-13 03:31:45', 8),
(308, 'c-362', 4, 19, 'C-362', '1', '26', 135000, '1689219229_39da1ea7e7e56cad0191.png', '2023-07-11 06:27:51', '2023-07-13 03:33:49', 16),
(309, 'c-368', 4, 19, 'C-368', '1', '26', 135000, '1689219405_5e289a0e1da955931656.png', '2023-07-11 06:27:51', '2023-07-13 03:36:45', 6),
(310, 'c-369', 4, 19, 'C-369', '1', '26', 135000, '1689219691_faf2efc6cfe4ef33d928.png', '2023-07-11 06:27:51', '2023-07-13 03:41:31', 16),
(311, 'c-229', 4, 19, 'c-229', '1', '26', 125000, '1689217957_94835bc8508ded3bec38.png', '2023-07-11 06:27:51', '2023-07-13 03:12:37', 32),
(312, 'c-279', 4, 19, 'C-279', '1', '26', 125000, '1689218707_7553f416535f6ee78170.png', '2023-07-11 06:27:51', '2023-07-13 03:25:07', 3),
(314, 'papan-ketengan-sj-2001', 1, 3, 'Papan Ketengan SJ-2001', '', '9', 54000, '1689302349_dd2a8771073775dcbc5a.png', '2023-07-12 07:18:35', '2023-07-15 07:19:15', 5),
(315, 'papan-ketengan-sj-2001', 1, 3, 'Papan Ketengan SJ-2001', '', '8', 72000, '1689302358_d055cbced1ae23309bba.png', '2023-07-12 07:19:47', '2023-08-02 07:02:10', 18),
(316, 'sj-2106', 1, 3, 'SJ-2106', '1 Dus = 15 Lembar', '5', 990000, '1689230998_fe6e5615b5da35e38256.jpg', '2023-07-13 06:49:58', '2023-07-13 08:18:28', 0),
(317, 'lm-017', 6, 24, 'LM-017', '1 Dus = 16 btg', '11', 66000, '1689232835_ae5d3a7dd92849f122ae.jpg', '2023-07-13 07:20:35', '2023-07-14 01:32:28', 0),
(318, 'papan-ketengan-sj-2003', 1, 3, 'Papan Ketengan SJ-2003', '', '8', 72000, '1689381476_234d0b52bb6a68751d50.png', '2023-07-15 00:37:56', '2023-07-15 03:06:30', 3),
(319, 'papan-ketengan-sj-2004', 1, 3, 'Papan Ketengan SJ-2004', '', '8', 72000, '1689381569_3d5cf00370fd267c935b.png', '2023-07-15 00:39:29', '2023-07-15 03:06:36', 0),
(320, 'papan-ketengan-sj-2005', 1, 3, 'Papan Ketengan SJ-2005', '', '8', 72000, '1689381615_cab66faded6e767a12aa.png', '2023-07-15 00:40:15', '2023-07-15 03:06:42', 25),
(321, 'papan-ketengan-sj-2006', 1, 3, 'Papan Ketengan SJ-2006', '', '8', 72000, '1689381659_da054d5c26f56e4a60c7.png', '2023-07-15 00:40:59', '2023-07-15 07:20:35', 12),
(322, 'papan-ketengan-sj-2007', 1, 3, 'Papan Ketengan SJ-2007', '', '8', 72000, '1689381702_5dcec7956eee8c3ae7ef.png', '2023-07-15 00:41:42', '2023-07-15 03:06:55', 31),
(323, 'papan-ketengan-sj-2008a', 1, 3, 'Papan Ketengan SJ-2008A', '', '8', 72000, '1689381758_cd622f2d7cdca40995a1.png', '2023-07-15 00:42:38', '2023-07-15 03:08:01', 7),
(324, 'papan-ketengan-sj-2008b', 1, 3, 'Papan Ketengan SJ-2008B', '', '8', 72000, '1689381796_853dea4a3c5f2b697275.png', '2023-07-15 00:43:16', '2023-07-15 07:22:17', 8),
(325, 'papan-ketengan-sj-2009', 1, 3, 'Papan Ketengan SJ-2009', '', '8', 72000, '1689381841_3060837f892148f879e8.png', '2023-07-15 00:44:01', '2023-07-15 03:08:11', 0),
(326, 'papan-ketengan-sj-2010', 1, 3, 'Papan Ketengan SJ-2010', '', '8', 72000, '1689381970_d6b9c08681d1a1b057d0.png', '2023-07-15 00:46:10', '2023-07-15 03:08:18', 2),
(327, 'papan-ketengan-sj-2011', 1, 3, 'Papan Ketengan SJ-2011', '', '8', 72000, '1689382151_e4c81ad116d72b490037.png', '2023-07-15 00:49:11', '2023-07-15 03:08:23', 12),
(328, 'papan-ketengan-sj-2012', 1, 3, 'Papan Ketengan SJ-2012', '', '8', 72000, '1689382213_6b73cfb58ebccd49dea9.png', '2023-07-15 00:50:13', '2023-07-15 07:23:08', 16),
(329, 'papan-ketengan-sj-2015', 1, 3, 'Papan Ketengan SJ-2015', '', '8', 72000, '1689382257_f50abf2fe97c7f4159fa.png', '2023-07-15 00:50:57', '2023-07-15 03:08:35', 8),
(330, 'papan-ketengan-sj-2016', 1, 3, 'Papan Ketengan SJ-2016', '', '8', 72000, '1689382301_8dfb7023e599d64c34ad.png', '2023-07-15 00:51:41', '2023-07-15 03:08:40', 9),
(331, 'papan-ketengan-sj-2019', 1, 3, 'Papan Ketengan SJ-2019', '', '8', 72000, '1689382344_2e0847476d2896c5c8f7.png', '2023-07-15 00:52:24', '2023-07-15 07:24:41', 22),
(332, 'papan-ketengan-sj-2020', 1, 3, 'Papan Ketengan SJ-2020', '', '8', 72000, '1689382489_fcfaba32404684b0bd5b.png', '2023-07-15 00:54:49', '2023-07-15 03:08:52', 16),
(333, 'papan-ketengan-sj-2021', 1, 3, 'Papan Ketengan SJ-2021', '', '8', 72000, '1689382529_568f02a4089c95a5f124.png', '2023-07-15 00:55:29', '2023-07-15 07:26:14', 8),
(334, 'papan-ketengan-sj-2022', 1, 3, 'Papan Ketengan SJ-2022', '', '8', 72000, '1689382569_02537269bc572ae85512.png', '2023-07-15 00:56:09', '2023-07-15 07:25:28', 15),
(335, 'papan-ketengan-sj-2024', 1, 3, 'Papan Ketengan SJ-2024', '', '8', 72000, '1689382608_216368400a92703ba6c3.png', '2023-07-15 00:56:48', '2023-07-15 03:10:01', 20),
(336, 'papan-ketengan-sj-2025', 1, 3, 'Papan Ketengan SJ-2025', '', '8', 72000, '1689382646_52d8a10f8a444501a5e6.png', '2023-07-15 00:57:26', '2023-07-15 03:10:07', 27),
(337, 'papan-ketengan-sj-2026', 1, 3, 'Papan Ketengan SJ-2026', '', '8', 72500, '1689382684_42962efcebbf96ef14ea.png', '2023-07-15 00:58:04', '2023-07-15 03:10:13', 5),
(338, 'papan-ketengan-sj-2028', 1, 3, 'Papan Ketengan SJ-2028', '', '8', 72000, '1689382721_c68b091d9d3215f7c858.png', '2023-07-15 00:58:41', '2023-07-15 03:10:20', 1),
(339, 'papan-ketengan-sj-2003', 1, 3, 'Papan Ketengan SJ 2003', '', '9', 54000, '1689382803_3fc767d628118a87b9d6.png', '2023-07-15 00:58:58', '2023-07-15 01:02:08', 0),
(340, 'papan-ketengan-sj-2004', 1, 3, 'Papan Ketengan SJ 2004', '', '9', 54000, '1689382849_d74c3e9008586fa57d20.png', '2023-07-15 00:58:58', '2023-07-15 01:02:15', 0),
(341, 'papan-ketengan-sj-2005', 1, 3, 'Papan Ketengan SJ 2005', '', '9', 54000, '1689382865_9ccca9bd8b0034c78784.png', '2023-07-15 00:58:58', '2023-07-15 01:02:24', 0),
(342, 'papan-ketengan-sj-2006', 1, 3, 'Papan Ketengan SJ 2006', '', '9', 54000, '1689382894_340b13e82d49bf7c78f9.png', '2023-07-15 00:58:58', '2023-09-23 07:18:38', 0),
(343, 'papan-ketengan-sj-2029', 1, 3, 'Papan Ketengan SJ-2029', '', '8', 72000, '1689382763_5830b605e187fd705c70.png', '2023-07-15 00:59:23', '2023-07-15 03:10:26', 14),
(344, 'papan-ketengan-sj-2030', 1, 3, 'Papan Ketengan SJ-2030', '', '8', 72000, '1689382806_cdc86c3a363ea03d4569.png', '2023-07-15 01:00:06', '2023-07-15 03:10:33', 5),
(345, 'papan-ketengan-sj-2031', 1, 3, 'Papan Ketengan SJ-2031', '', '8', 72000, '1689382847_2cba5395f69715fab6f8.png', '2023-07-15 01:00:47', '2023-07-15 03:10:37', 14),
(346, 'papan-ketengan-sj-2032', 1, 3, 'Papan Ketengan SJ-2032', '', '8', 72000, '1689382933_30130cb174e76fe589a6.png', '2023-07-15 01:02:13', '2023-07-15 03:10:42', 7),
(347, 'papan-ketengan-sj-2034', 1, 3, 'Papan Ketengan SJ-2034', '', '8', 72000, '1689383163_d5cd51aa11ad19d4c46c.png', '2023-07-15 01:06:03', '2023-07-15 07:33:04', 0),
(349, 'papan-ketengan-sj-2035', 1, 3, 'Papan Ketengan SJ-2035', '', '8', 72000, '1689383428_a4812326c826f556eab9.png', '2023-07-15 01:10:28', '2023-07-15 07:34:10', 3),
(350, 'papan-ketengan-sj-2036', 1, 3, 'Papan Ketengan SJ-2036', '', '8', 72000, '1689383470_64e3ec0a7bb179af4991.png', '2023-07-15 01:11:10', '2023-07-15 07:30:36', 11),
(351, 'papan-ketengan-sj-2037', 1, 3, 'Papan Ketengan SJ-2037', '', '8', 72000, '1689383521_d0a3d027c03890519bf0.png', '2023-07-15 01:12:01', '2023-07-15 07:34:41', 0),
(352, 'papan-ketengan-sj-2039', 1, 3, 'Papan Ketengan SJ-2039', '', '8', 72000, '1689383567_43e4473c48a77c2f0218.png', '2023-07-15 01:12:47', '2023-07-15 07:35:20', 16),
(353, 'papan-ketengan-sj-2007', 1, 3, 'Papan Ketengan SJ 2007', '', '9', 54000, '1689384039_405fa3a7c5ac71109734.png', '2023-07-15 01:13:21', '2023-07-15 01:20:39', 5),
(354, 'papan-ketengan-sj-2008-a', 1, 3, 'Papan Ketengan SJ 2008 A', '', '9', 54000, '1689384064_987b6e5b1393148b8175.png', '2023-07-15 01:13:21', '2023-07-15 01:21:04', 3),
(355, 'papan-ketengan-sj-2008-b', 1, 3, 'Papan Ketengan SJ 2008 B', '', '9', 54000, '1689384085_cd772edb9b807b2e95a4.png', '2023-07-15 01:13:21', '2023-07-15 01:21:25', 48),
(356, 'papan-ketengan-sj-2009', 1, 3, 'Papan Ketengan SJ 2009', '', '9', 54000, '1689384121_c2e2f43685067289e72a.png', '2023-07-15 01:13:21', '2023-07-15 01:22:01', 0),
(357, 'papan-ketengan-sj-2010', 1, 3, 'Papan Ketengan SJ 2010', '', '9', 54000, '1689384142_01c80f56874eafff898a.png', '2023-07-15 01:13:21', '2023-07-15 01:22:22', 0),
(358, 'papan-ketengan-sj-2011', 1, 3, 'Papan Ketengan SJ 2011', '', '9', 54000, '1689384170_60e99901a2619ca2299a.png', '2023-07-15 01:13:21', '2023-07-15 01:22:50', 0),
(359, 'papan-ketengan-sj-2012', 1, 3, 'Papan Ketengan SJ 2012', '', '9', 54000, '1689384184_8a60fff864e8ed72b616.png', '2023-07-15 01:13:21', '2023-07-15 01:23:04', 4),
(360, 'papan-ketengan-sj-2015', 1, 3, 'Papan Ketengan SJ 2015', '', '9', 54000, '1689384208_7b3be67bf76af6c3b0e2.png', '2023-07-15 01:13:21', '2023-07-15 01:23:28', 0),
(361, 'papan-ketengan-sj-2016', 1, 3, 'Papan Ketengan SJ 2016', '', '9', 54000, '1689384222_6d61b81fcf8caf1f743a.png', '2023-07-15 01:13:21', '2023-07-15 01:23:42', 13),
(362, 'papan-ketengan-sj-2019', 1, 3, 'Papan Ketengan SJ 2019', '', '9', 54000, '1689384242_72744b80f823f9cd5ba1.png', '2023-07-15 01:13:21', '2023-07-15 01:24:02', 0),
(363, 'papan-ketengan-sj-2020', 1, 3, 'Papan Ketengan SJ 2020', '', '9', 54000, '1689384267_e58cc5324e84f92950c0.png', '2023-07-15 01:13:21', '2023-07-15 01:24:27', 5),
(364, 'papan-ketengan-sj-2021', 1, 3, 'Papan Ketengan SJ 2021', '', '9', 54000, '1689384286_64e559b3714a4f1b96c5.png', '2023-07-15 01:13:21', '2023-07-15 01:24:46', 0),
(365, 'papan-ketengan-sj-2022', 1, 3, 'Papan Ketengan SJ 2022', '', '9', 54000, '1689384304_512be435341961011056.png', '2023-07-15 01:13:21', '2023-07-15 01:25:04', 0),
(366, 'papan-ketengan-sj-2024', 1, 3, 'Papan Ketengan SJ 2024', '', '9', 54000, '1689384345_6fcd5591b1aba8c2901b.png', '2023-07-15 01:13:21', '2023-07-15 01:25:45', 0),
(367, 'papan-ketengan-sj-2025', 1, 3, 'Papan Ketengan SJ 2025', '', '9', 54000, '1689384366_076243b50a2f7d06aca4.png', '2023-07-15 01:13:21', '2023-07-15 01:26:06', 0),
(368, 'papan-ketengan-sj-2026', 1, 3, 'Papan Ketengan SJ 2026', '', '9', 54000, '1689384387_b4db671d10d81f6d37c2.png', '2023-07-15 01:13:21', '2023-07-15 01:26:27', 0),
(369, 'papan-ketengan-sj-2028', 1, 3, 'Papan Ketengan SJ 2028', '', '9', 54000, '1689384402_d92299ad732541c4fc52.png', '2023-07-15 01:13:21', '2023-07-15 01:26:42', 2),
(370, 'papan-ketengan-sj-2029', 1, 3, 'Papan Ketengan SJ 2029', '', '9', 54000, '1689384419_8ebe0c0cea2d279c20f1.png', '2023-07-15 01:13:21', '2023-07-15 01:26:59', 0);
INSERT INTO `produk` (`id_produk`, `slug_produk`, `id_kategori`, `id_subkate`, `nama_produk`, `deskripsi`, `id_satuan`, `harga`, `gambar_produk`, `tanggal_input`, `tanggal_ubah`, `stok`) VALUES
(371, 'papan-ketengan-sj-2030', 1, 3, 'Papan Ketengan SJ 2030', '', '9', 54000, '1689384437_121abefdeddb8f2df3c5.png', '2023-07-15 01:13:21', '2023-07-15 01:27:17', 0),
(372, 'papan-ketengan-sj-2031', 1, 3, 'Papan Ketengan SJ 2031', '', '9', 54000, '1689384469_21941907a5c9d6c1b043.png', '2023-07-15 01:13:21', '2023-07-15 01:27:49', 5),
(373, 'papan-ketengan-sj-2032', 1, 3, 'Papan Ketengan SJ 2032', '', '9', 54000, '1689384490_c08f5f8d1b7c2e5a58a6.png', '2023-07-15 01:13:21', '2023-07-15 01:28:10', 0),
(374, 'papan-ketengan-sj-2034', 1, 3, 'Papan Ketengan SJ 2034', '', '9', 54000, '1689384529_c8b9938d9c41c681af62.png', '2023-07-15 01:13:21', '2023-07-15 01:28:49', 0),
(375, 'papan-ketengan-sj-2035', 1, 3, 'Papan Ketengan SJ 2035', '', '9', 54000, '1689384547_c0ac448d1766a3047547.png', '2023-07-15 01:13:21', '2023-07-15 01:29:07', 16),
(376, 'papan-ketengan-sj-2036', 1, 3, 'Papan Ketengan SJ 2036', '', '9', 54000, '1689384587_dfb187f4e0dbb8dda7de.png', '2023-07-15 01:13:21', '2023-07-15 01:29:47', 0),
(377, 'papan-ketengan-sj-2037', 1, 3, 'Papan Ketengan SJ 2037', '', '9', 54000, '1689384620_e4bbba48e736a14cf956.png', '2023-07-15 01:13:21', '2023-07-15 01:30:20', 0),
(378, 'papan-ketengan-sj-2039', 1, 3, 'Papan Ketengan SJ 2039', '', '9', 54000, '1689384636_624c59eb65c3f05e3c3a.png', '2023-07-15 01:13:21', '2023-07-15 01:30:36', 5),
(379, 'papan-ketengan-sj-2042', 1, 3, 'Papan Ketengan SJ 2042', '', '9', 54000, '1689384659_c3a30f49d5c77e2b460e.png', '2023-07-15 01:13:21', '2023-07-15 01:30:59', 0),
(380, 'papan-ketengan-sj-2043', 1, 3, 'Papan Ketengan SJ 2043', '', '9', 54000, '1689384673_ba79f00f768283c8391e.png', '2023-07-15 01:13:21', '2023-07-15 01:31:13', 0),
(381, 'papan-ketengan-sj-2045', 1, 3, 'Papan Ketengan SJ 2045', '', '9', 54000, '1689384687_01b726d69d51d4cab329.png', '2023-07-15 01:13:21', '2023-07-15 01:31:27', 5),
(382, 'papan-ketengan-sj-2048', 1, 3, 'Papan Ketengan SJ 2048', '', '9', 54000, '1689384708_6db965e988595ee61080.png', '2023-07-15 01:13:21', '2023-07-15 01:31:48', 0),
(383, 'papan-ketengan-sj-2049', 1, 3, 'Papan Ketengan SJ 2049', '', '9', 54000, '1689384727_de122a9114375e6a0d8d.png', '2023-07-15 01:13:21', '2023-07-15 01:32:07', 3),
(384, 'papan-ketengan-sj-2050', 1, 3, 'Papan Ketengan SJ 2050', '', '9', 54000, '1689384748_897f96fbbfdb9a9857a5.png', '2023-07-15 01:13:21', '2023-07-15 01:32:28', 4),
(385, 'papan-ketengan-sj-2052', 1, 3, 'Papan Ketengan SJ 2052', '', '9', 54000, '1689384763_65fab49167635631e443.png', '2023-07-15 01:13:21', '2023-07-15 01:32:43', 0),
(386, 'papan-ketengan-sj-2053', 1, 3, 'Papan Ketengan SJ 2053', '', '9', 54000, '1689384798_dd730bd4a467e533f5cc.png', '2023-07-15 01:13:21', '2023-07-15 01:33:18', 0),
(387, 'papan-ketengan-sj-2054', 1, 3, 'Papan Ketengan SJ 2054', '', '9', 54000, '1689384817_ac10a95f85b4fb8f84d8.png', '2023-07-15 01:13:21', '2023-07-15 01:33:37', 7),
(388, 'papan-ketengan-sj-2055', 1, 3, 'Papan Ketengan SJ 2055', '', '9', 54000, '1689384834_7c5509170821fb071f70.png', '2023-07-15 01:13:21', '2023-07-15 01:33:54', 0),
(389, 'papan-ketengan-sj-2058', 1, 3, 'Papan Ketengan SJ 2058', '', '9', 54000, '1689384850_41286ee2758249a81f05.png', '2023-07-15 01:13:21', '2023-07-15 01:34:10', 17),
(390, 'papan-ketengan-sj-2060', 1, 3, 'Papan Ketengan SJ 2060', '', '9', 54000, '1689384870_66a8edf240cc2966ca7a.png', '2023-07-15 01:13:21', '2023-07-15 01:34:30', 8),
(391, 'papan-ketengan-sj-2061', 1, 3, 'Papan Ketengan SJ 2061', '', '9', 54000, '1689384887_adfb2254bd080eb2ef85.png', '2023-07-15 01:13:21', '2023-07-15 01:34:47', 26),
(392, 'papan-ketengan-sj-2062', 1, 3, 'Papan Ketengan SJ 2062', '', '9', 54000, '1689384903_55e1beef74125f7d4ee1.png', '2023-07-15 01:13:21', '2023-07-15 01:35:03', 0),
(393, 'papan-ketengan-sj-2063', 1, 3, 'Papan Ketengan SJ 2063', '', '9', 54000, '1689384918_21e57b086a68a18c7602.png', '2023-07-15 01:13:21', '2023-07-15 01:35:18', 0),
(394, 'papan-ketengan-sj-2064', 1, 3, 'Papan Ketengan SJ 2064', '', '8', 54000, '1689384930_8fa421cd3e93ecb761e0.png', '2023-07-15 01:13:21', '2023-07-15 01:35:30', 0),
(395, 'papan-ketengan-sj-2065', 1, 3, 'Papan Ketengan SJ 2065', '', '9', 54000, '1689384946_d023b52d29915bf90eb8.png', '2023-07-15 01:13:21', '2023-07-15 01:35:46', 0),
(396, 'papan-ketengan-sj-2066', 1, 3, 'Papan Ketengan SJ 2066', '', '9', 54000, '1689385007_0fb89f401351bf26d550.png', '2023-07-15 01:13:21', '2023-07-15 01:36:47', 12),
(397, 'papan-ketengan-sj-2069', 1, 3, 'Papan Ketengan SJ 2069', '', '9', 54000, '1689385024_24a2f7862cc3f4f0cf31.png', '2023-07-15 01:13:21', '2023-07-15 01:37:04', 0),
(398, 'papan-ketengan-sj-2070', 1, 3, 'Papan Ketengan SJ 2070', '', '9', 54000, '1689385049_5836b94b18d595f7aaad.png', '2023-07-15 01:13:21', '2023-07-15 01:37:29', 4),
(399, 'papan-ketengan-sj-2071', 1, 3, 'Papan Ketengan SJ 2071', '', '9', 54000, '1689385064_5938e7211df9f92f1d15.png', '2023-07-15 01:13:21', '2023-07-15 01:37:44', 0),
(400, 'papan-ketengan-sj-2072', 1, 3, 'Papan Ketengan SJ 2072', '', '9', 54000, '1689385078_227e0cbd1468c07b6b77.png', '2023-07-15 01:13:21', '2023-07-15 01:37:58', 18),
(401, 'papan-ketengan-sj-2073', 1, 3, 'Papan Ketengan SJ 2073', '', '9', 54000, '1689385098_20114901ab2790687fd7.png', '2023-07-15 01:13:21', '2023-07-15 01:38:18', 7),
(402, 'papan-ketengan-sj-2074', 1, 3, 'Papan Ketengan SJ 2074', '', '9', 54000, '1689385116_51c2c9473df173372c42.png', '2023-07-15 01:13:21', '2023-07-15 01:38:36', 0),
(403, 'papan-ketengan-sj-2075', 1, 3, 'Papan Ketengan SJ 2075', '', '9', 54000, '1689385130_556698f567916dae99ae.png', '2023-07-15 01:13:21', '2023-07-15 01:38:50', 0),
(404, 'papan-ketengan-sj-2076', 1, 3, 'Papan Ketengan SJ 2076', '', '9', 54000, '1689385164_d506dd45c0f1b3dbad18.png', '2023-07-15 01:13:21', '2023-07-15 01:39:24', 0),
(405, 'papan-ketengan-sj-2077', 1, 3, 'Papan Ketengan SJ 2077', '', '9', 54000, '1689385180_3802c462703c77c57f27.png', '2023-07-15 01:13:21', '2023-07-15 01:39:40', 0),
(406, 'papan-ketengan-sj-2078', 1, 3, 'Papan Ketengan SJ 2078', '', '9', 54000, '1689385214_73975722c6e6f7f2fba7.png', '2023-07-15 01:13:21', '2023-07-15 01:40:14', 2),
(407, 'papan-ketengan-sj-2079', 1, 3, 'Papan Ketengan SJ 2079', '', '9', 54000, '1689385229_44e5e05b15e0d7de6d98.png', '2023-07-15 01:13:21', '2023-07-15 01:40:29', 6),
(408, 'papan-ketengan-sj-2080', 1, 3, 'Papan Ketengan SJ 2080', '', '9', 54000, '1689385244_c8db5dbc53d9b86b70b0.png', '2023-07-15 01:13:21', '2023-07-15 08:07:47', 4),
(409, 'papan-ketengan-sj-2085', 1, 3, 'Papan Ketengan SJ 2085', '', '9', 54000, '1689385257_64894a0ad646bd38f758.png', '2023-07-15 01:13:21', '2023-07-15 01:40:57', 0),
(410, 'papan-ketengan-sj-2086', 1, 3, 'Papan Ketengan SJ 2086', '', '9', 54000, '1689385273_8d01a7a9037f2a5dd9e8.png', '2023-07-15 01:13:21', '2023-07-15 01:41:13', 5),
(411, 'papan-ketengan-sj-2087', 1, 3, 'Papan Ketengan SJ 2087', '', '9', 54000, '1689385287_a251e97c3909746fee3e.png', '2023-07-15 01:13:21', '2023-07-15 01:41:27', 7),
(412, 'papan-ketengan-sj-2088', 1, 3, 'Papan Ketengan SJ 2088', '', '9', 54000, '1689385307_b8bd727471f56d2b6613.png', '2023-07-15 01:13:21', '2023-07-15 01:41:47', 0),
(413, 'papan-ketengan-sj-2089', 1, 3, 'Papan Ketengan SJ 2089', '', '9', 54000, '1689385332_201b23f8b9cac94da8e6.png', '2023-07-15 01:13:21', '2023-07-15 01:42:12', 0),
(414, 'papan-ketengan-sj-2090', 1, 3, 'Papan Ketengan SJ 2090', '', '9', 54000, '1689385344_6aadb045eca7e0d9681a.png', '2023-07-15 01:13:21', '2023-07-15 01:42:24', 10),
(415, 'papan-ketengan-sj-2095', 1, 3, 'Papan Ketengan SJ 2095', '', '9', 54000, '1689385366_ae8801968d8e22fe3dda.png', '2023-07-15 01:13:21', '2023-07-15 01:42:46', 0),
(416, 'papan-ketengan-sj-2096', 1, 3, 'Papan Ketengan SJ 2096', '', '9', 54000, '1689385397_44ecfceccb67792fa2d5.png', '2023-07-15 01:13:21', '2023-07-15 01:43:17', 0),
(417, 'papan-ketengan-sj-2097', 1, 3, 'Papan Ketengan SJ 2097', '', '9', 54000, '1689385416_504e98c0ae8f56eb325d.png', '2023-07-15 01:13:21', '2023-07-15 01:43:36', 0),
(418, 'papan-ketengan-sj-2099', 1, 3, 'Papan Ketengan SJ 2099', '', '9', 54000, '1689385430_1c7e8566edc98879ee4f.png', '2023-07-15 01:13:21', '2023-07-15 01:43:50', 0),
(419, 'papan-ketengan-sj-2100', 1, 3, 'Papan Ketengan SJ 2100', '', '9', 54000, '1689385450_3a437fe0baa12fdd674c.png', '2023-07-15 01:13:21', '2023-07-15 01:44:10', 0),
(420, 'papan-ketengan-sj-2104', 1, 3, 'Papan Ketengan SJ 2104', '', '9', 54000, '1689385478_c83e71568ef1e3f87ffa.png', '2023-07-15 01:13:21', '2023-07-15 01:44:38', 0),
(421, 'papan-ketengan-sj-2105', 1, 3, 'Papan Ketengan SJ 2105', '', '9', 54000, '1689385495_d845059b57c936839a0b.png', '2023-07-15 01:13:21', '2023-07-15 08:13:09', 13),
(422, 'papan-ketengan-sj-2106', 1, 3, 'Papan Ketengan SJ 2106', '', '9', 54000, '1689385512_a53002b6f99f445b1ffa.png', '2023-07-15 01:13:21', '2023-07-15 01:45:12', 5),
(423, 'papan-ketengan-sj-2107', 1, 3, 'Papan Ketengan SJ 2107', '', '9', 54000, '1689385531_4996363630afcbcc005d.png', '2023-07-15 01:13:21', '2023-07-15 01:45:31', 7),
(424, 'papan-ketengan-sj-2108', 1, 3, 'Papan Ketengan SJ 2108', '', '9', 54000, '1689385547_6d074476478d1a03cde5.png', '2023-07-15 01:13:21', '2023-07-15 01:45:47', 6),
(425, 'papan-ketengan-sj-2109', 1, 3, 'Papan Ketengan SJ 2109', '', '9', 54000, '1689385562_34b840b702f47d9c379a.png', '2023-07-15 01:13:21', '2023-07-15 01:46:02', 0),
(426, 'papan-ketengan-sj-2111', 1, 3, 'Papan Ketengan SJ 2111', '', '9', 54000, '1689385685_4bf5e43a649be0b19064.png', '2023-07-15 01:13:21', '2023-07-15 01:48:05', 4),
(427, 'papan-ketengan-sj-2111-n', 1, 3, 'Papan Ketengan SJ 2111 N', '', '9', 54000, '1689385667_7068a41d83029f21d8cf.png', '2023-07-15 01:13:21', '2023-07-15 01:47:47', 0),
(428, 'papan-ketengan-sj-2116', 1, 3, 'Papan Ketengan SJ 2116', '', '9', 54000, '1689385715_a11276e5ddc6517adfcd.png', '2023-07-15 01:13:21', '2023-07-15 01:48:35', 12),
(429, 'papan-ketengan-sj-2120', 1, 3, 'Papan Ketengan SJ 2120', '', '9', 54000, '1689385749_16762a7b5d544e56e2ce.png', '2023-07-15 01:13:21', '2023-07-15 01:49:09', 0),
(430, 'papan-ketengan-sj-2122', 1, 3, 'Papan Ketengan SJ 2122', '', '9', 54000, '1689385770_0110b30d703bab3b142c.png', '2023-07-15 01:13:21', '2023-07-15 01:49:30', 0),
(431, 'papan-ketengan-sj-2125', 1, 3, 'Papan Ketengan SJ 2125', '', '9', 54000, '1689385796_8824e80ec00f58eda748.png', '2023-07-15 01:13:21', '2023-07-15 01:49:56', 5),
(432, 'papan-ketengan-sjp-002', 1, 1, 'Papan Ketengan SJP 002', '', '9', 54000, '1689385888_34cdee2b36906e643704.png', '2023-07-15 01:13:21', '2023-07-15 01:51:28', 0),
(433, 'papan-ketengan-sjp-002-n', 1, 1, 'Papan Ketengan SJP 002 N', '', '9', 54000, '1689385869_9372bccd80b2770eacec.png', '2023-07-15 01:13:21', '2023-07-15 01:51:09', 0),
(434, 'papan-ketengan-sjp-005', 1, 1, 'Papan Ketengan SJP 005', '', '9', 54000, '1689385904_bf44ae7254918667ba0f.png', '2023-07-15 01:13:21', '2023-07-15 02:02:54', 0),
(435, 'papan-ketengan-sjp-006', 1, 1, 'Papan Ketengan SJP 006', '', '9', 54000, '1689385941_9ae7f4546036a6d41a8f.png', '2023-07-15 01:13:21', '2023-07-15 01:52:21', 5),
(436, 'papan-ketengan-sjp-006-n', 1, 1, 'Papan Ketengan SJP 006 N', '', '9', 54000, '1689385918_22d6fd54dfcda63f3e56.png', '2023-07-15 01:13:21', '2023-07-15 02:03:01', 0),
(437, 'papan-ketengan-sjp-008', 1, 1, 'Papan Ketengan SJP 008', '', '9', 54000, '1689385978_dfbdce43aae743160da8.png', '2023-07-15 01:13:21', '2023-07-15 01:52:58', 0),
(438, 'papan-ketengan-sjp-008-n', 1, 1, 'Papan Ketengan SJP 008 N', '', '9', 54000, '1689385956_0dfc92df0a536a43a034.png', '2023-07-15 01:13:21', '2023-07-15 01:52:36', 2),
(439, 'papan-ketengan-sjp-009', 1, 1, 'Papan Ketengan SJP 009', '', '9', 54000, '1689386011_af49f30755c245e369ec.png', '2023-07-15 01:13:21', '2023-07-15 01:53:31', 4),
(440, 'papan-ketengan-sjp-009-n', 1, 1, 'Papan Ketengan SJP 009 N', '', '9', 54000, '1689385996_9cbd8a82e363e9789b06.png', '2023-07-15 01:13:21', '2023-07-15 01:53:16', 0),
(441, 'papan-ketengan-sjp-010', 1, 1, 'Papan Ketengan SJP 010', '', '9', 54000, '1689386069_78fbae562efb353d575b.png', '2023-07-15 01:13:21', '2023-07-15 01:54:29', 0),
(442, 'papan-ketengan-sjp-010-n', 1, 1, 'Papan Ketengan SJP 010 N', '', '9', 54000, '1689386030_1ca2e9e4b231bf1ec2a8.png', '2023-07-15 01:13:21', '2023-07-15 01:53:50', 0),
(443, 'papan-ketengan-sjp-011', 1, 1, 'Papan Ketengan SJP 011', '', '9', 54000, '1689386111_f255d37308a0895aa2af.png', '2023-07-15 01:13:21', '2023-07-15 01:55:11', 10),
(444, 'papan-ketengan-sjp-011-n', 1, 1, 'Papan Ketengan SJP 011 N', '', '9', 54000, '1689386091_c27a6d4df02912aebcce.png', '2023-07-15 01:13:21', '2023-07-15 01:54:51', 5),
(445, 'papan-ketengan-sjp-012', 1, 1, 'Papan Ketengan SJP 012', '', '9', 54000, '1689386133_eb3f21b0b61f76c814a4.png', '2023-07-15 01:13:21', '2023-07-15 01:55:33', 5),
(446, 'papan-ketengan-sjp-013', 1, 1, 'Papan Ketengan SJP 013', '', '9', 54000, '1689386178_c6d3081591dcbdd8540d.png', '2023-07-15 01:13:21', '2023-07-15 01:56:18', 10),
(447, 'papan-ketengan-sjp-013-n', 1, 1, 'Papan Ketengan SJP 013 N', '', '9', 54000, '1689386153_88c7de24cb436c5596fc.png', '2023-07-15 01:13:21', '2023-07-15 01:55:53', 0),
(448, 'papan-ketengan-sjp-014', 1, 1, 'Papan Ketengan SJP 014', '', '9', 54000, '1689386198_8c064217cb6f768aba9d.png', '2023-07-15 01:13:21', '2023-07-15 01:56:38', 0),
(449, 'papan-ketengan-sjp-015', 1, 1, 'Papan Ketengan SJP 015', '', '9', 54000, '1689386216_1baf092dd52657c86e7e.png', '2023-07-15 01:13:21', '2023-07-15 01:56:56', 0),
(450, 'papan-ketengan-sjp-017', 1, 1, 'Papan Ketengan SJP 017', '', '9', 54000, '1689386237_d53760431e76b83c19c8.png', '2023-07-15 01:13:21', '2023-07-15 01:57:17', 0),
(451, 'papan-ketengan-sjp-018', 1, 1, 'Papan Ketengan SJP 018', '', '9', 54000, '1689386259_3adc390b09ccb9fe916f.png', '2023-07-15 01:13:21', '2023-07-15 01:57:39', 14),
(452, 'papan-ketengan-sjp-019', 1, 1, 'Papan Ketengan SJP-019', '', '9', 54000, '1689386285_ed799c5410ff73e18a93.png', '2023-07-15 01:13:21', '2023-07-15 08:34:19', 10),
(453, 'papan-ketengan-bk-001', 1, 4, 'Papan Ketengan BK 001', '', '9', 54000, '1689383725_116ec817b2fd3c3d1542.png', '2023-07-15 01:13:21', '2023-07-15 01:15:25', 0),
(454, 'papan-ketengan-bk-001-n', 1, 4, 'Papan Ketengan BK 001 N', '', '9', 54000, '1689383675_bee10f490cd60984e5a6.png', '2023-07-15 01:13:21', '2023-07-15 01:14:35', 10),
(455, 'papan-ketengan-bk-002', 1, 4, 'Papan Ketengan BK 002', '', '9', 54000, '1689383775_61dca5c01272ea11ff68.png', '2023-07-15 01:13:21', '2023-07-15 01:16:15', 0),
(456, 'papan-ketengan-bk-002-n', 1, 4, 'Papan Ketengan BK 002 N', '', '9', 54000, '1689383747_591ca8984ffa95651bb0.png', '2023-07-15 01:13:21', '2023-07-15 01:15:47', 0),
(457, 'papan-ketengan-bk-003', 1, 4, 'Papan Ketengan BK 003', '', '9', 54000, '1689383820_b6d2fcec03c6c3491f7d.png', '2023-07-15 01:13:21', '2023-07-15 01:17:00', 0),
(458, 'papan-ketengan-bk-003-n', 1, 4, 'Papan Ketengan BK 003 N', '', '9', 54000, '1689383801_88be1ee3028e1d98326a.png', '2023-07-15 01:13:21', '2023-07-15 01:16:41', 0),
(459, 'papan-ketengan-bk-004', 1, 4, 'Papan Ketengan BK 004', '', '9', 54000, '1689383870_1ca947c0bc466b09f556.png', '2023-07-15 01:13:21', '2023-07-15 01:17:50', 0),
(460, 'papan-ketengan-bk-004-n', 1, 4, 'Papan Ketengan BK 004 N', '', '9', 54000, '1689383844_439280722762f9195639.png', '2023-07-15 01:13:21', '2023-07-15 01:17:24', 0),
(461, 'papan-ketengan-bk-005', 1, 4, 'Papan Ketengan BK 005', '', '9', 54000, '1689383902_f841356dfe96e613531c.png', '2023-07-15 01:13:21', '2023-07-15 01:18:22', 0),
(462, 'papan-ketengan-bk-005-n', 1, 4, 'Papan Ketengan BK 005 N', '', '9', 54000, '1689383882_4d36836d4d0b1ee25a24.png', '2023-07-15 01:13:21', '2023-07-15 01:18:02', 0),
(463, 'papan-ketengan-bk-007', 1, 4, 'Papan Ketengan BK 007', '', '9', 54000, '1689383970_ec7e6a17b65735eb0707.png', '2023-07-15 01:13:21', '2023-07-15 01:19:30', 0),
(464, 'papan-ketengan-bk-007-n', 1, 4, 'Papan Ketengan BK 007 N', '', '9', 54000, '1689383928_e7881532d0bc650a4a9e.png', '2023-07-15 01:13:21', '2023-07-20 04:02:24', 13),
(465, 'papan-ketengan-bk-008', 1, 4, 'Papan Ketengan BK 008', '', '9', 54000, '1689384009_780fcd073dddad682d8a.png', '2023-07-15 01:13:21', '2023-07-15 01:20:09', 0),
(466, 'papan-ketengan-bk-008-n', 1, 4, 'Papan Ketengan BK 008 N', '', '9', 54000, '1689383987_7c4877cba214577d5ff7.png', '2023-07-15 01:13:21', '2023-07-15 01:19:47', 0),
(467, 'papan-ketengan-sp-002', 1, 1, 'Papan Ketengan SP 002', '', '9', 54000, '1689386305_67842c97305223201db3.png', '2023-07-15 01:13:21', '2023-07-15 01:58:25', 0),
(468, 'papan-ketengan-sp-008', 1, 1, 'Papan Ketengan SP 008', '', '9', 54000, '1689386322_d7bdc273cd88605c1f6a.png', '2023-07-15 01:13:21', '2023-07-15 01:58:42', 0),
(469, 'papan-ketengan-sj-2043', 1, 3, 'Papan Ketengan SJ-2043', '', '8', 72000, '1689383628_757e7898addc68c32a35.png', '2023-07-15 01:13:48', '2023-07-15 07:36:59', 3),
(470, 'papan-ketengan-sj-2045', 1, 3, 'Papan Ketengan SJ-2045', '', '8', 72000, '1689383669_a46bdddf5580cd2486cc.png', '2023-07-15 01:14:29', '2023-07-15 07:37:42', 7),
(471, 'papan-ketengan-sj-2048', 1, 3, 'Papan Ketengan SJ-2048', '', '8', 72000, '1689383713_e8443a89e0613a8c81fc.png', '2023-07-15 01:15:13', '2023-07-15 07:38:15', 13),
(472, 'papan-ketengan-sj-2049', 1, 3, 'Papan Ketengan SJ-2049', '', '8', 72000, '1689383797_38079dc18aa96922f263.png', '2023-07-15 01:16:37', '2023-07-15 07:38:55', 0),
(473, 'papan-ketengan-sj-2050', 1, 3, 'Papan Ketengan SJ-2050', '', '8', 72000, '1689383839_272125db0ddb64bf0b0f.png', '2023-07-15 01:17:19', '2023-07-15 03:13:18', 28),
(474, 'papan-ketengan-sj-2052', 1, 3, 'Papan Ketengan SJ-2052', '', '8', 72000, '1689383894_07bac5b759e2f098f021.png', '2023-07-15 01:18:14', '2023-07-15 07:41:58', 1),
(475, 'papan-ketengan-sj-2053', 1, 3, 'Papan Ketengan SJ-2053', '', '8', 72000, '1689383934_c785b816dfb280866c07.png', '2023-07-15 01:18:54', '2023-07-15 03:13:31', 0),
(476, 'papan-ketengan-sj-2054', 1, 3, 'Papan Ketengan SJ-2054', '', '8', 72000, '1689383990_27080cac37e329d9ae91.png', '2023-07-15 01:19:50', '2023-07-15 03:13:38', 4),
(477, 'papan-ketengan-sj-2055', 1, 3, 'Papan Ketengan SJ-2055', '', '8', 72000, '1689384041_ecd25e6908f6ba9cff59.png', '2023-07-15 01:20:41', '2023-07-15 03:13:43', 18),
(478, 'papan-ketengan-sj-2058', 1, 3, 'Papan Ketengan SJ-2058', '', '8', 72000, '1689384075_e2988aa1a96711e5bb91.png', '2023-07-15 01:21:15', '2023-07-15 03:13:48', 13),
(479, 'papan-ketengan-sj-2060', 1, 3, 'Papan Ketengan SJ-2060', '', '8', 72000, '1689384113_8474c0e0aa395df872a0.png', '2023-07-15 01:21:53', '2023-07-15 07:46:19', 42),
(480, 'papan-ketengan-sj-2061', 1, 3, 'Papan Ketengan SJ-2061', '', '8', 72000, '1689384143_2f516e94132b7e6cd809.png', '2023-07-15 01:22:23', '2023-07-15 07:47:45', 43),
(481, 'papan-ketengan-sj-2062', 1, 3, 'Papan Ketengan SJ-2062', '', '8', 72000, '1689384178_a20f2556bcc2e50d9eaa.png', '2023-07-15 01:22:58', '2023-07-15 03:14:03', 37),
(482, 'papan-ketengan-sj-2063', 1, 3, 'Papan Ketengan SJ-2063', '', '8', 72000, '1689384210_b8274aa433e6db55d355.png', '2023-07-15 01:23:30', '2023-07-15 03:14:09', 3),
(483, 'papan-ketengan-sj-2064', 1, 3, 'Papan Ketengan SJ-2064', '', '8', 72000, '1689384317_fc68c2f81761dec8543f.png', '2023-07-15 01:25:17', '2023-07-15 03:14:53', 0),
(484, 'papan-ketengan-sj-2065', 1, 3, 'Papan Ketengan SJ-2065', '', '8', 72000, '1689384363_fc844d40bb0acc48c7c4.png', '2023-07-15 01:26:03', '2023-07-15 03:14:59', 25),
(485, 'papan-ketengan-sj-2066', 1, 3, 'Papan Ketengan SJ-2066', '', '8', 72000, '1689384401_c3b9036740c73a62405d.png', '2023-07-15 01:26:41', '2023-07-15 03:15:04', 20),
(486, 'papan-ketengan-sj-2069', 1, 3, 'Papan Ketengan SJ-2069', '', '8', 72000, '1689384436_ab216d88f81993da2be7.png', '2023-07-15 01:27:16', '2023-07-15 07:49:11', 12),
(487, 'papan-ketengan-sj-2070', 1, 3, 'Papan Ketengan SJ-2070', '', '8', 72000, '1689384477_49577ac3c2cdb6acc475.png', '2023-07-15 01:27:57', '2023-07-15 03:15:17', 36),
(488, 'papan-ketengan-sj-2071', 1, 3, 'Papan Ketengan SJ-2071', '', '8', 72000, '1689384514_291bd005e4006ae6edb3.png', '2023-07-15 01:28:34', '2023-07-15 03:15:22', 17),
(489, 'papan-ketengan-sj-2072', 1, 3, 'Papan Ketengan SJ-2072', '', '8', 72000, '1689384572_717aaa37fa31c54d9b04.png', '2023-07-15 01:29:32', '2023-07-15 07:50:13', 4),
(490, 'papan-ketengan-sj-2073', 1, 3, 'Papan Ketengan SJ-2073', '', '8', 72000, '1689384600_59d2ad8e5a674f39fcc3.png', '2023-07-15 01:30:00', '2023-07-15 03:15:36', 4),
(491, 'papan-ketengan-sj-2074', 1, 3, 'Papan Ketengan SJ-2074', '', '8', 72000, '1689384633_a7fd85f2855ebc60a772.png', '2023-07-15 01:30:33', '2023-07-15 03:15:52', 8),
(492, 'papan-ketengan-sj-2076', 1, 3, 'Papan Ketengan SJ-2076', '', '8', 72000, '1689384669_0c662adcfe9581d0deb3.png', '2023-07-15 01:31:09', '2023-07-15 03:15:58', 14),
(493, 'papan-ketengan-sj-2077', 1, 27, 'Papan Ketengan SJ-2077', '', '8', 72000, '1689384701_e8a1fbb79fdfee15ee17.png', '2023-07-15 01:31:41', '2023-07-15 01:31:41', 0),
(494, 'papan-ketengan-sj-2078', 1, 27, 'Papan Ketengan SJ-2078', '', '8', 72000, '1689384735_ecb64de1100a2863b36a.png', '2023-07-15 01:32:15', '2023-07-15 01:32:15', 7),
(495, 'papan-ketengan-sj-2085', 1, 27, 'Papan Ketengan SJ-2085', '', '8', 72000, '1689384784_4ece9faaf4dba15bea08.png', '2023-07-15 01:33:04', '2023-07-15 01:33:04', 6),
(496, 'papan-ketengan-sj-2085', 1, 27, 'Papan Ketengan SJ-2085', '', '8', 72000, '1689384786_afdb0ed66c23f65a25ae.png', '2023-07-15 01:33:06', '2023-07-15 08:08:17', 16),
(497, 'papan-ketengan-sj-2086', 1, 27, 'Papan Ketengan SJ-2086', '', '8', 72000, '1689384818_395d869ad5831bbf47ab.png', '2023-07-15 01:33:38', '2023-07-15 08:09:03', 11),
(498, 'papan-ketengan-sj-2087', 1, 27, 'Papan Ketengan SJ-2087', '', '8', 72000, '1689384855_16bd1d78b792bb25fa6a.png', '2023-07-15 01:34:15', '2023-07-15 08:09:58', 1),
(499, 'papan-ketengan-sj-2088', 1, 27, 'Papan Ketengan SJ-2088', '', '8', 72000, '1689384887_f2e14f8cc008a0153fe6.png', '2023-07-15 01:34:47', '2023-07-15 01:34:47', 4),
(500, 'papan-ketengan-sj-2089', 1, 27, 'Papan Ketengan SJ-2089', '', '8', 72000, '1689384919_ee1a1c58720fe22a5f0c.png', '2023-07-15 01:35:19', '2023-07-15 08:10:42', 24),
(501, 'papan-ketengan-sj-2090', 1, 27, 'Papan Ketengan SJ-2090', '', '8', 72000, '1689384943_dc5f8963d219ad9c83fd.png', '2023-07-15 01:35:43', '2023-07-15 01:35:43', 12),
(502, 'papan-ketengan-sj-2095', 1, 27, 'Papan Ketengan SJ-2095', '', '8', 72000, '1689385029_a8da8548912f541b692e.png', '2023-07-15 01:37:09', '2023-07-15 01:37:09', 12),
(503, 'papan-ketengan-sj-2096', 1, 3, 'Papan Ketengan SJ-2096', '', '8', 72000, '1689385116_ac659d6f8436d60f88b1.png', '2023-07-15 01:38:36', '2023-07-15 03:16:48', 20),
(504, 'papan-ketengan-sj-2097', 1, 3, 'Papan Ketengan SJ-2097', '', '8', 72000, '1689385149_01e9756343e4a0ff0e06.png', '2023-07-15 01:39:09', '2023-07-15 03:16:55', 0),
(505, 'papan-ketengan-sj-2099', 1, 3, 'Papan Ketengan SJ-2099', '', '8', 72000, '1689385214_e6fb68e5748443961d6d.png', '2023-07-15 01:40:14', '2023-07-17 01:18:43', 14),
(506, 'papan-ketengan-sj-2100', 1, 3, 'Papan Ketengan SJ-2100', '', '8', 72000, '1689385255_f7a8abb5b055f462e1db.png', '2023-07-15 01:40:55', '2023-07-15 03:17:05', 8),
(507, 'papan-ketengan-sj-2105', 1, 3, 'Papan Ketengan SJ-2105', '', '8', 72000, '1689385337_aee516d6e44efda607d5.png', '2023-07-15 01:42:17', '2023-07-15 03:17:10', 3),
(508, 'papan-ketengan-sj-2106', 1, 3, 'Papan Ketengan SJ-2106', '', '8', 72000, '1689385368_4b9ec97352e19a88f567.png', '2023-07-15 01:42:48', '2023-07-15 08:13:55', 0),
(509, 'papan-ketengan-sj-2107', 1, 3, 'Papan Ketengan SJ-2107', '', '8', 72000, '1689385399_96b485c10d3b5843742d.png', '2023-07-15 01:43:19', '2023-07-15 03:17:20', 6),
(510, 'papan-ketengan-sj-2108', 1, 3, 'Papan Ketengan SJ-2108', '', '8', 72000, '1689385426_c310483c1415037c3208.png', '2023-07-15 01:43:46', '2023-07-15 03:17:25', 0),
(511, 'papan-ketengan-sj-2109', 1, 3, 'Papan Ketengan SJ-2109', '', '8', 72000, '1689385452_ee6a5f0ccd3d33da7300.png', '2023-07-15 01:44:12', '2023-07-15 03:17:30', 0),
(512, 'papan-ketengan-sj-2111', 1, 3, 'Papan Ketengan SJ-2111', '', '8', 72000, '1689385479_2f01a95662016022a3fb.png', '2023-07-15 01:44:39', '2023-07-15 03:17:34', 1),
(513, 'papan-ketengan-sj-2111n', 1, 3, 'Papan Ketengan SJ-2111N', '', '8', 72000, '1689385509_0a8b731f6360332f5513.png', '2023-07-15 01:45:09', '2023-07-15 03:18:15', 24),
(514, 'papan-ketengan-sj-2116', 1, 3, 'Papan Ketengan SJ-2116', '', '8', 72000, '1689385536_1b144af418a017bc6dbf.png', '2023-07-15 01:45:36', '2023-07-15 03:18:20', 8),
(515, 'papan-ketengan-sj-2120', 1, 3, 'Papan Ketengan SJ-2120', '', '8', 72000, '1689385569_57c98935568ea6afd11f.png', '2023-07-15 01:46:09', '2023-07-15 03:18:26', 0),
(516, 'papan-ketengan-sj-2122', 1, 3, 'Papan Ketengan SJ-2122', '', '8', 72000, '1689385596_d2365054404d19c6f398.png', '2023-07-15 01:46:36', '2023-07-15 03:18:32', 4),
(517, 'papan-ketengan-sj-2125', 1, 3, 'Papan Ketengan SJ-2125', '', '8', 72000, '1689385641_b8a33388cb24905e026a.png', '2023-07-15 01:47:21', '2023-07-15 03:18:37', 0),
(518, 'papan-ketengan-sjp-002', 1, 1, 'Papan Ketengan SJP-002', '', '8', 72000, '1689385704_9a0fdee7bfce0ebf28a2.png', '2023-07-15 01:48:24', '2023-07-15 01:48:24', 4),
(519, 'papan-ketengan-sjp-002n', 1, 1, 'Papan Ketengan SJP-002N', '', '8', 72000, '1689385787_332e1472a042bc370817.png', '2023-07-15 01:49:47', '2023-07-15 08:17:21', 7),
(520, 'papan-ketengan-sjp-005', 1, 1, 'Papan Ketengan SJP-005', '', '8', 72000, '1689385836_685e2a7efae54bd13d08.png', '2023-07-15 01:50:36', '2023-07-15 01:50:36', 10),
(521, 'papan-ketengan-sjp-006', 1, 1, 'Papan Ketengan SJP-006', '', '8', 72000, '1689385919_b42bb629d9a34e185936.png', '2023-07-15 01:51:59', '2023-07-15 01:51:59', 0),
(522, 'papan-ketengan-sjp-006n', 1, 1, 'Papan Ketengan SJP-006N', '', '8', 72000, '1689385956_1d04d38a7cae05c19fa9.png', '2023-07-15 01:52:36', '2023-07-15 08:19:25', 33),
(523, 'papan-ketengan-sjp-008', 1, 27, 'Papan Ketengan SJP-008', '', '8', 72000, '1689385991_5778b22f95ae2e5a42b2.png', '2023-07-15 01:53:11', '2023-07-15 01:53:11', 33),
(524, 'papan-ketengan-sjp-008n', 1, 1, 'Papan Ketengan SJP-008N', '', '8', 72000, '1689386030_90ad6e1f1dcef21bd368.png', '2023-07-15 01:53:50', '2023-07-15 01:53:50', 0),
(525, 'papan-ketengan-sjp-009', 1, 27, 'Papan Ketengan SJP-009', '', '8', 72000, '1689386102_59e618d7dd18bb14223a.png', '2023-07-15 01:55:02', '2023-07-15 01:55:02', 4),
(526, 'papan-ketengan-sjp-009n', 1, 1, 'Papan Ketengan SJP-009N', '', '8', 72000, '1689386138_ca5c284d88d9bef0410d.png', '2023-07-15 01:55:38', '2023-07-15 01:55:38', 16),
(527, 'papan-ketengan-sjp-010', 1, 1, 'Papan Ketengan SJP-010', '', '8', 72000, '1689386176_42a651e2103608a90180.png', '2023-07-15 01:56:16', '2023-07-15 01:56:16', 12),
(528, 'papan-ketengan-sjp-010n', 1, 1, 'Papan Ketengan SJP-010N', '', '8', 72000, '1689386215_05055f9c19c2979e01b3.png', '2023-07-15 01:56:55', '2023-07-15 01:56:55', 9),
(529, 'papan-ketengan-sjp-011', 1, 1, 'Papan Ketengan SJP-011', '', '8', 72000, '1689386261_79cb986f2132eafff209.png', '2023-07-15 01:57:41', '2023-07-15 01:57:41', 5),
(530, 'papan-ketengan-sjp-011n', 1, 1, 'Papan Ketengan SJP-011N', '', '8', 72000, '1689386333_483104a886ccdb69bb0a.png', '2023-07-15 01:58:53', '2023-07-15 08:29:04', 9),
(531, 'papan-ketengan-sjp-012', 1, 1, 'Papan Ketengan SJP-012', '', '8', 72000, '1689386382_a4d33ed220172f4afee9.png', '2023-07-15 01:59:42', '2023-07-15 01:59:42', 13),
(532, 'papan-ketengan-sjp-013', 1, 1, 'Papan Ketengan SJP-013', '', '8', 72000, '1689386467_892da166fef403b13fe7.png', '2023-07-15 02:01:07', '2023-07-15 02:01:07', 8),
(533, 'papan-ketengan-sjp-014', 1, 1, 'Papan Ketengan SJP-014', '', '8', 72000, '1689386562_c0dde9662fcd40731f04.png', '2023-07-15 02:02:42', '2023-07-15 08:30:26', 11),
(534, 'papan-ketengan-sjp-013n', 1, 1, 'Papan Ketengan SJP-013N', '', '8', 72000, '1689386671_37f8960fdd47968766ae.png', '2023-07-15 02:04:31', '2023-07-15 02:04:31', 8),
(535, 'papan-ketengan-sjp-015', 1, 1, 'Papan Ketengan SJP-015', '', '8', 72000, '1689386886_0cd3acfff48123b86580.png', '2023-07-15 02:08:06', '2023-07-20 03:42:09', 23),
(536, 'papan-ketengan-sjp-017', 1, 1, 'Papan Ketengan SJP-017', '', '8', 72000, '1689386930_b839d571e702523bc53a.png', '2023-07-15 02:08:50', '2023-07-15 02:08:50', 4),
(537, 'papan-ketengan-sjp-018', 1, 1, 'Papan Ketengan SJP-018', '', '8', 72000, '1689386979_9a6feec4b9548e441361.png', '2023-07-15 02:09:39', '2023-07-15 02:09:39', 6),
(538, 'papan-ketengan-sjp-019', 1, 1, 'Papan Ketengan SJP-019', '', '8', 72000, '1689387032_22eb44644e22a1f6da7d.png', '2023-07-15 02:10:32', '2023-07-15 08:32:15', 16),
(539, 'papan-ketengan-bk-001', 1, 4, 'Papan Ketengan BK-001', '', '8', 72000, '1689387073_541067c16f4d0e89919c.png', '2023-07-15 02:11:13', '2023-07-15 08:35:42', 21),
(540, 'papan-ketengan-bk-001n', 1, 4, 'Papan Ketengan BK-001N', '', '8', 72000, '1689387119_f2c52fc780296306c864.png', '2023-07-15 02:11:59', '2023-07-15 08:35:59', 9),
(541, 'papan-ketengan-bk-002', 1, 4, 'Papan Ketengan BK-002', '', '8', 72000, '1689387157_764b9043675561f14876.png', '2023-07-15 02:12:37', '2023-07-15 02:12:37', 13),
(542, 'papan-ketengan-bk-002n', 1, 4, 'Papan Ketengan (BK-002N)', '', '8', 72000, '1689387190_820d4be4151a4e74c1e4.png', '2023-07-15 02:13:10', '2023-07-15 08:36:53', 26),
(543, 'papan-ketengan-bk-003', 1, 4, 'Papan Ketengan (BK-003)', '', '8', 72000, '1689387247_feaad8dbad9e07b13cdf.png', '2023-07-15 02:14:07', '2023-07-15 02:14:07', 14),
(544, 'papan-ketengan-bk-003n', 1, 4, 'Papan Ketengan (BK-003N)', '', '8', 72000, '1689387277_381ac9f29d997ed50eba.png', '2023-07-15 02:14:37', '2023-07-20 05:35:26', 19),
(545, 'papan-ketengan-bk-004', 1, 4, 'Papan Ketengan (BK-004)', '', '8', 72000, '1689387320_7cf6289dc2d079f510d8.png', '2023-07-15 02:15:20', '2023-07-15 08:40:02', 33),
(546, 'papan-ketengan-bk-004n', 1, 4, 'Papan Ketengan (BK-004N)', '', '8', 72000, '1689387355_59458f51733900a207c8.png', '2023-07-15 02:15:55', '2023-07-15 02:15:55', 10),
(547, 'papan-ketengan-bk-005', 1, 4, 'Papan Ketengan (BK-005)', '', '8', 72000, '1689387398_4b4585f31f947a482665.png', '2023-07-15 02:16:38', '2023-07-15 02:16:38', 21),
(548, 'papan-ketengan-bk-005n', 1, 4, 'Papan Ketengan (BK-005N)', '', '8', 72000, '1689387438_1cd9fc0ed99579667e7b.png', '2023-07-15 02:17:18', '2023-07-15 02:17:18', 8),
(549, 'papan-ketengan-bk-007', 1, 4, 'Papan Ketengan (BK-007)', '', '8', 72000, '1689387485_fd5da4b44d83e0b015c9.png', '2023-07-15 02:18:05', '2023-07-15 02:18:05', 17),
(550, 'papan-ketengan-bk-007n', 1, 4, 'Papan Ketengan BK-007N', '', '8', 72000, '1689387526_b30a57a78da0d1a205d7.png', '2023-07-15 02:18:46', '2023-07-20 04:44:10', 15),
(552, 'papan-ketengan-bk-008', 1, 4, 'Papan Ketengan (BK-008)', '', '8', 72000, '1689387602_2bd24d3e4961ca2aae3a.png', '2023-07-15 02:20:02', '2023-07-15 08:43:47', 7),
(553, 'papan-ketengan-bk-008n', 1, 4, 'Papan Ketengan (BK-008N)', '', '8', 72000, '1689387651_1add1fe1df2ebda72428.png', '2023-07-15 02:20:51', '2023-07-15 02:20:51', 30),
(554, 'papan-ketengan-bk-016n', 1, 4, 'Papan Ketengan (BK-016N)', '', '8', 72000, '1689387702_51c480c8c21f5a546bb1.png', '2023-07-15 02:21:42', '2023-07-20 05:32:27', 35),
(555, 'papan-ketengan-bk-017n', 1, 4, 'Papan Ketengan BK-017N', '', '8', 72000, '1689387749_98014ac47ae8837cb077.png', '2023-07-15 02:22:29', '2023-07-20 03:43:30', 11),
(556, 'ornamen-120x90', 2, 9, 'Ornamen 120x90', '', '46', 1500000, '1689828758_41754438f627e5973fa4.png', '2023-07-20 04:52:38', '2023-07-20 05:53:26', 4);

-- --------------------------------------------------------

--
-- Table structure for table `produk_kembali`
--

CREATE TABLE `produk_kembali` (
  `id_kembali` int(5) UNSIGNED NOT NULL,
  `id_detail` int(5) NOT NULL,
  `jumlah_kembali` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(5) UNSIGNED NOT NULL,
  `nama_project` varchar(500) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `pelanggan` varchar(500) NOT NULL,
  `pengerjaan` varchar(500) NOT NULL,
  `tanggal` varchar(500) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `nama_project`, `deskripsi`, `pelanggan`, `pengerjaan`, `tanggal`, `gambar`) VALUES
(2, '&lt;p&gt;&lt;span style=&quot;font-size:28px&quot;&gt;Uji Coba Dulu&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;p&gt;&lt;span style=&quot;font-size:18px&quot;&gt;tes&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;p&gt;&lt;span style=&quot;font-size:18px&quot;&gt;coba&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;p&gt;&lt;span style=&quot;font-size:18px&quot;&gt;tesss&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;p&gt;&lt;span style=&quot;font-size:18px&quot;&gt;1 januari 2022&lt;/span&gt;&lt;/p&gt;\r\n', '1688117997_670bfa8e68e798205b11.jpg'),
(3, '&lt;p&gt;&lt;span style=&quot;font-size:28px&quot;&gt;Uji coba 2&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;p&gt;&lt;span style=&quot;font-size:18px&quot;&gt;tesssss&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;p&gt;&lt;span style=&quot;font-size:18px&quot;&gt;coba 2&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;p&gt;&lt;span style=&quot;font-size:18px&quot;&gt;meja&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;p&gt;&lt;span style=&quot;font-size:18px&quot;&gt;1 januari 2024&lt;/span&gt;&lt;/p&gt;\r\n', '1688118029_88bf034466bbcacb0c88.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rab`
--

CREATE TABLE `rab` (
  `id_rab` int(5) NOT NULL,
  `id_survei` int(5) NOT NULL,
  `id_sub` int(5) NOT NULL,
  `harga` int(15) NOT NULL,
  `volume` decimal(10,2) NOT NULL,
  `ukuran` varchar(15) NOT NULL,
  `biaya` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(5) NOT NULL,
  `usaha` varchar(100) NOT NULL,
  `AN` varchar(100) NOT NULL,
  `rek` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `usaha`, `AN`, `rek`, `bank`) VALUES
(1, 'PT Jaya', 'Riyanto', '52525252', 'BRI'),
(2, 'PT Rusdianto', 'Coco', '5666717', 'Mandiri');

-- --------------------------------------------------------

--
-- Table structure for table `rpt`
--

CREATE TABLE `rpt` (
  `id_rpt` int(5) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `tukang` varchar(100) NOT NULL,
  `sisa_hbk` int(10) NOT NULL,
  `bayar` int(10) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rpt`
--

INSERT INTO `rpt` (`id_rpt`, `invoice`, `nama`, `alamat`, `tukang`, `sisa_hbk`, `bayar`, `keterangan`, `tanggal`) VALUES
(4, '08/INV-ASN/IX/2023', 'Pak Rely', 'jl. sejati', 'Riyanto', 8489600, 500000, '-', '2023-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `satuan_produk`
--

CREATE TABLE `satuan_produk` (
  `id_satuan` int(5) UNSIGNED NOT NULL,
  `nama_satuan` varchar(100) NOT NULL,
  `singkatan` varchar(100) NOT NULL,
  `slug_satuan` varchar(100) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `satuan_produk`
--

INSERT INTO `satuan_produk` (`id_satuan`, `nama_satuan`, `singkatan`, `slug_satuan`, `tanggal_input`, `tanggal_ubah`) VALUES
(5, 'Dos', '4 Meter', 'lembar', '2023-07-11 05:46:57', '2023-07-11 06:22:41'),
(6, 'Dos', '3 Meter', 'lembar', '2023-07-11 05:47:11', '2023-07-11 06:22:23'),
(7, 'Ktk', '1 Inc', 'kotak', '2023-07-11 05:48:11', '2023-07-13 07:08:40'),
(8, 'Lbr', '4 Meter', '4-meter', '2023-07-11 05:55:39', '2023-07-13 07:08:27'),
(9, 'Lbr', '3 Meter', '3-meter', '2023-07-11 05:55:47', '2023-07-13 07:08:12'),
(10, 'Ktk', '1 1/5 Inch', 'kotak', '2023-07-11 06:20:42', '2023-07-13 07:07:47'),
(11, 'Btg', '4 Meter', 'batang', '2023-07-11 06:23:28', '2023-07-13 07:03:32'),
(12, 'M', '1 Roll (100m)', 'meter', '2023-07-11 06:25:15', '2023-07-13 07:03:53'),
(14, 'Pcs', 'Ornamen 55x55', 'pcs', '2023-07-11 06:26:10', '2023-07-12 03:41:09'),
(15, 'Btl', 'Putih', 'botol', '2023-07-11 06:26:52', '2023-07-13 07:07:33'),
(16, 'Btl', 'Coklat', 'botol', '2023-07-11 06:27:45', '2023-07-13 07:06:59'),
(17, 'Pcs', 'Kuning', 'kuning', '2023-07-11 06:28:50', '2023-07-12 03:05:49'),
(18, 'Pcs', 'Putih', 'putih', '2023-07-11 06:30:13', '2023-07-12 03:05:41'),
(19, 'Pcs', 'Putih - Biru (3+3)', 'putih-biru', '2023-07-11 06:31:13', '2023-07-14 02:06:56'),
(20, 'Pcs', 'Putih -  Kuning (3+3)', 'putih-kuning', '2023-07-11 06:31:28', '2023-07-14 02:07:59'),
(21, 'Pcs', '3 Warna', '3-warna', '2023-07-11 06:31:56', '2023-07-13 07:04:49'),
(23, 'Btl', '10 ml', '10-ml', '2023-07-11 06:32:43', '2023-07-13 07:06:21'),
(24, 'Pcs', 'Isolasi Bening', 'isolasi-bening', '2023-07-11 06:33:15', '2023-07-13 07:06:05'),
(25, 'Pcs', 'Isolasi Hitam', 'isolasi-hitam', '2023-07-11 06:33:51', '2023-07-13 07:05:10'),
(26, 'Roll', '50 Meter', 'roll', '2023-07-11 06:34:29', '2023-07-12 03:05:05'),
(27, 'Pcs', 'Ornamen Pintu Kabah', 'pcs', '2023-07-12 03:32:06', '2023-07-12 03:32:06'),
(28, 'Pcs', 'Ornamen 30x30', 'pcs', '2023-07-12 03:41:24', '2023-07-12 03:41:24'),
(29, 'Pcs', 'Ornamen 60x60', 'pcs', '2023-07-12 03:43:49', '2023-07-12 03:43:49'),
(30, 'Pcs', 'Ornamen 70x90', 'pcs', '2023-07-12 03:45:06', '2023-07-12 03:45:06'),
(31, 'Pcs', 'GOLD', 'pcs', '2023-07-12 05:00:45', '2023-07-12 05:00:45'),
(32, 'Pcs', 'SILVER', 'pcs', '2023-07-12 05:06:22', '2023-07-12 05:06:22'),
(33, 'Pcs', 'BINTANG', 'pcs', '2023-07-12 05:09:31', '2023-07-12 05:09:31'),
(34, 'Pcs', 'ABSTRAK', 'pcs', '2023-07-12 05:12:37', '2023-07-12 05:12:37'),
(35, 'Pcs', 'BATIK', 'pcs', '2023-07-12 05:13:10', '2023-07-12 05:13:10'),
(36, 'Pcs', 'BUNGA', 'pcs', '2023-07-12 05:13:18', '2023-07-12 05:13:18'),
(37, 'Pcs', 'PUTIH EMAS', 'pcs', '2023-07-12 05:13:42', '2023-07-12 05:13:42'),
(38, 'Pcs', 'SILVER MERAH', 'pcs', '2023-07-12 05:13:51', '2023-07-12 05:13:51'),
(39, 'Pcs', 'SILVER HIJAU', 'pcs', '2023-07-12 05:14:07', '2023-07-12 05:14:07'),
(40, 'Pcs', 'EMAS CRIM', 'pcs', '2023-07-12 05:14:25', '2023-07-12 05:14:25'),
(41, 'Pcs', 'PUTIH SILVER', 'pcs', '2023-07-12 05:15:15', '2023-07-12 05:15:15'),
(42, 'Pcs', 'SILVER PINK', 'pcs', '2023-07-12 05:15:28', '2023-07-12 05:15:28'),
(43, 'Pcs', 'PUTIH HIJAU', 'pcs', '2023-07-12 05:15:46', '2023-07-12 05:15:46'),
(44, 'Pcs', 'SILVER HITAM', 'pcs', '2023-07-12 05:15:57', '2023-07-12 05:15:57'),
(45, 'Pcs', 'Mozaik', 'pcs', '2023-07-12 05:21:12', '2023-07-12 05:21:12'),
(46, 'Pcs', '-', 'pcs', '2023-07-13 05:46:22', '2023-07-13 05:46:22'),
(47, 'Pcs', 'Putih - Kuning (6+3)', 'pcs', '2023-07-14 02:08:46', '2023-07-14 02:08:46'),
(48, 'Pcs', 'Putih - Biru (6+3)', 'pcs', '2023-07-14 02:09:17', '2023-07-14 02:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `subkategori`
--

CREATE TABLE `subkategori` (
  `id_subkate` int(5) UNSIGNED NOT NULL,
  `nama_subkate` varchar(100) NOT NULL,
  `slug_subkate` varchar(100) NOT NULL,
  `id_kategori` int(5) DEFAULT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subkategori`
--

INSERT INTO `subkategori` (`id_subkate`, `nama_subkate`, `slug_subkate`, `id_kategori`, `tanggal_input`, `tanggal_ubah`) VALUES
(1, 'Printing', 'printing', 1, '2023-06-10 12:31:16', '2023-06-22 22:53:22'),
(3, 'Laminating', 'laminating', 1, '2023-06-22 22:52:52', '2023-06-22 22:52:52'),
(4, 'Tekstur', 'tekstur', 1, '2023-06-22 22:53:10', '2023-06-22 22:53:10'),
(5, 'Downlight', 'downlight', 2, '2023-07-11 01:59:24', '2023-07-11 01:59:24'),
(6, 'Krawangan', 'krawangan', 2, '2023-07-11 01:59:35', '2023-07-11 01:59:35'),
(7, 'Line Strip ', 'line-strip', 2, '2023-07-11 01:59:58', '2023-07-11 01:59:58'),
(8, 'Adaptor', 'adaptor', 2, '2023-07-11 02:00:11', '2023-07-11 02:00:11'),
(9, 'Ornamen', 'ornamen', 2, '2023-07-11 02:00:31', '2023-07-12 03:45:42'),
(11, 'Fittingan', 'fittingan', 2, '2023-07-11 02:00:57', '2023-07-11 02:00:57'),
(13, 'Lem Korea', 'lem-korea', 3, '2023-07-11 02:02:14', '2023-07-11 02:02:14'),
(14, 'Silikon', 'silikon', 3, '2023-07-11 02:02:23', '2023-07-11 02:02:23'),
(15, 'Lakban', 'lakban', 3, '2023-07-11 05:39:32', '2023-07-11 05:39:32'),
(16, 'Skrup', 'skrup', 3, '2023-07-11 05:44:01', '2023-07-11 05:44:01'),
(17, 'Type A', 'type-a', 4, '2023-07-11 06:36:13', '2023-07-11 06:36:13'),
(18, 'Type B', 'type-b', 4, '2023-07-11 06:36:27', '2023-07-11 06:36:27'),
(19, 'Type C', 'type-c', 4, '2023-07-11 06:36:44', '2023-07-11 06:36:44'),
(20, 'Kabel NYM', 'kabel-nym', 3, '2023-07-11 08:36:30', '2023-07-11 08:36:30'),
(22, 'Hollow', 'hollow', 3, '2023-07-11 08:47:53', '2023-07-11 08:47:53'),
(23, 'List 4cm', 'list-4cm', 6, '2023-07-11 09:01:13', '2023-07-11 09:01:13'),
(24, 'List 6cm', 'list-6cm', 6, '2023-07-11 09:01:24', '2023-07-11 09:01:24'),
(25, 'Ornamen Kaligrafi', 'ornamen-kaligrafi', 2, '2023-07-12 03:30:37', '2023-07-12 03:30:37'),
(26, 'Tekstur', 'tekstur', 7, '2023-07-12 05:48:30', '2023-07-12 05:48:30'),
(27, 'Campuran', 'campuran', 1, '2023-07-12 07:17:15', '2023-07-12 07:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `subkerja`
--

CREATE TABLE `subkerja` (
  `id` int(5) NOT NULL,
  `id_kerja` int(5) NOT NULL,
  `nama_sub` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subkerja`
--

INSERT INTO `subkerja` (`id`, `id_kerja`, `nama_sub`, `keterangan`) VALUES
(7, 2, 'Trap 2', '-'),
(8, 2, 'Trap 1', '-'),
(9, 3, 'Lampu', '-'),
(10, 2, 'Lurusan', '-'),
(12, 4, 'Dapur', '-');

-- --------------------------------------------------------

--
-- Table structure for table `sumber_kas`
--

CREATE TABLE `sumber_kas` (
  `id_sumber` int(5) UNSIGNED NOT NULL,
  `kode` varchar(50) NOT NULL,
  `cash` int(5) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `saldo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sumber_kas`
--

INSERT INTO `sumber_kas` (`id_sumber`, `kode`, `cash`, `keterangan`, `saldo`) VALUES
(4, 'MND', 2, 'Mandiri', -1300000),
(7, 'PC', 1, 'PettyCash', 2100000),
(8, 'BRI', 2, 'Penerimaan Penjualan', 1220000),
(9, 'tes', 2, 'DP', 131000),
(10, 'MND2', 2, '-', 1000),
(11, 'tes', 2, '-', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `survei`
--

CREATE TABLE `survei` (
  `id_survei` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `pelanggan` varchar(100) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `sketsa` varchar(100) NOT NULL,
  `pengukur` varchar(100) NOT NULL,
  `keterangan` varchar(1000) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal_update` date DEFAULT NULL,
  `volume` decimal(10,2) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `drafter` varchar(100) NOT NULL,
  `biaya` int(15) NOT NULL,
  `tukang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `survei`
--

INSERT INTO `survei` (`id_survei`, `tanggal`, `pelanggan`, `alamat`, `sketsa`, `pengukur`, `keterangan`, `status`, `tanggal_update`, `volume`, `telepon`, `drafter`, `biaya`, `tukang`) VALUES
(15, '2023-09-10', 'Pak bambang', 'JL. M. Said', '1694306225_a17298be079a38cfcec7.png', 'Anto', 'BK 001 n &amp; BK 004', '1', '2023-09-10', '0.00', '0852520252', 'Ali Yusni', 8800000, 'Riyanto'),
(16, '2023-09-10', 'toto', 'JL. Revolusi', '1694306873_6af4bdf00c2d1026d0f1.png', 'Asfian', 'SJ 2001 Lurusan ', '1', '2023-09-10', '0.00', '0852520252', 'Ali Yusni', 4000000, 'Muklis'),
(17, '2023-09-10', 'Darmawan', 'JL. Revolusi', '1694309666_958df48ab099751edb7c.png', 'Rahman', '-', '1', '2023-09-10', '0.00', '0852520252', 'Ali Yusni', 4000000, 'Muklis'),
(18, '2023-09-10', 'Pak bambang', 'JL. M. Said', '1694311316_5812bf645087114b46d8.png', 'Rahman', 'tes', '1', '2023-09-10', '0.00', '0852520252', 'Ali Yusni', 1028000, 'Riyanto'),
(19, '2023-09-10', 'totok', 'jl. sejati', '1694325254_f3202d37d8cea236a807.png', 'Anto', '-', '1', '2023-09-10', '0.00', '0852520252', 'Ali Yusni', 4600000, 'Muklis'),
(20, '2023-09-10', 'Pak Rely', 'jl. sejati', '1694325814_5af82cac5be29d2e6c4a.jpg', 'Rahman', '-', '1', '2023-09-10', '0.00', '0852520252', 'Ali Yusni', 19000000, 'Riyanto');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(5) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(500) NOT NULL,
  `project` varchar(500) NOT NULL,
  `ucapan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id`, `nama_pelanggan`, `project`, `ucapan`) VALUES
(2, '&lt;p&gt;&lt;span style=&quot;color:#e67e22&quot;&gt;Fahmi&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;p&gt;Plafon Teras Rumah&lt;/p&gt;\r\n', '&lt;p&gt;&lt;span style=&quot;font-size:18px&quot;&gt;&amp;quot; Rumah saya sekarang terlihat begitu Mewah dan Elegan &amp;quot;&lt;/span&gt;&lt;/p&gt;\r\n'),
(3, '&lt;p&gt;&lt;span style=&quot;color:#e67e22&quot;&gt;tees&lt;/span&gt;&lt;/p&gt;\r\n', '&lt;p&gt;toko&lt;/p&gt;\r\n', '&lt;p&gt;&lt;span style=&quot;font-size:18px&quot;&gt;&amp;quot; Sangat Bagus saya sangat bangga menggunakan Plafon PVC &amp;quot;&lt;/span&gt;&lt;/p&gt;\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(5) NOT NULL,
  `id_trans` text NOT NULL,
  `id_pel` int(5) NOT NULL,
  `id_katepel` int(5) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_ongkir` int(9) NOT NULL,
  `potongan` int(10) NOT NULL,
  `total` int(9) NOT NULL,
  `bayar` int(10) NOT NULL,
  `kembalian` int(10) NOT NULL,
  `status` int(5) NOT NULL,
  `tanggal_input` datetime DEFAULT NULL,
  `tanggal_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_trans`, `id_pel`, `id_katepel`, `penerima`, `telepon`, `alamat`, `id_ongkir`, `potongan`, `total`, `bayar`, `kembalian`, `status`, `tanggal_input`, `tanggal_ubah`) VALUES
(57, '01/NOTA-ASN/VII/2023', 8, 2, 'Bapak Ari Granit', '081347919813', 'Jl Gunung Lingai', 19, 0, 220000, 220000, 0, 0, '2023-07-13 00:00:00', '2023-08-02 00:00:00'),
(58, '02/NOTA-ASN/VII/2023', 6, 6, 'Bapak Didi', '-', 'Handil D', 4, 0, 1782000, 1782000, 0, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(59, '03/NOTA-ASN/VII/2023', 9, 6, 'Bapak Kohar', '-', '-', 4, 0, 600000, 600000, 0, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(61, '04/NOTA-ASN/VII/2023', 10, 6, 'Ibu Santi', '081345355400', 'Jl Aw Syahrani Tembusan Ringroad', 18, 0, 2239000, 2239000, 0, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(62, '05/NOTA-ASN/VII/2023', 11, 4, 'Bapak Kustoyo', '082151796654', '-', 4, 0, 1714560, 1744000, 29440, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(64, '06/NOTA-ASN/VII/2023', 13, 4, 'Om Riyanto TK', '081250001878', 'Palaran', 4, 3120, 1452000, 1452000, 0, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(83, '07/NOTA-ASN/VII/2023', 12, 6, 'No Name', '-', '-', 22, 0, 245000, 245000, 0, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(84, '08/NOTA-ASN/VII/2023', 6, 6, 'Bapak Didi', '-', 'Handil D', 4, 0, 138000, 138000, 0, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(85, '09/NOTA-ASN/VII/2023', 14, 6, 'PT Muara Kembang ', '085348600636', 'Muara Kembang', 4, 742500, 13860000, 13860000, 0, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(86, '10/NOTA-ASN/VII/2023', 15, 6, 'Bapak Beta Markus', '081346686060', 'Jl Gotong Royong Gg 2 Palaran Gereja Kibad', 21, 0, 4300000, 4300000, 0, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(87, '11/NOTA-ASN/VII/2023', 16, 6, 'Bapak Usup', '085347475923', 'Jl Datu Iba Sungai Kledang', 22, 0, 0, 0, 0, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(89, '12/NOTA-ASN/VII/2023', 17, 6, 'Bapak Koko', '0882021923338', '-', 4, 0, 649000, 649000, 0, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(93, '13/NOTA-ASN/VII/2023', 18, 6, 'Bapak Edi', '082135135888', 'Jl Sungai Lais', 4, 0, 2335000, 2335000, 0, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(94, '14/NOTA-ASN/VII/2023', 19, 6, 'Bapak Ridwan', '082153981320', 'Jl Kemakmuran Komp. Pelita 3 No.43', 18, 0, 842000, 842000, 0, 0, '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(109, '15/NOTA-ASN/VII/2023', 21, 4, 'Toko Genius', '08117282213', '-', 4, 0, 141000, 138000, -3000, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(110, '16/NOTA-ASN/VII/2023', 16, 6, 'Bapak Usup', '085347475923', 'Jl Datu Iba Sungai Kledang', 22, 0, 1040000, 1040000, 0, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(111, '17/NOTA-ASN/VII/2023', 18, 6, 'Bapak Edi', '082135135888', 'Jl Sungai Lais', 4, 0, 360000, 360000, 0, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(112, '18/NOTA-ASN/VII/2023', 20, 6, 'Bapak H Aswan', '085246854482 / 082158124444', 'Jl. Poros Samarinda Sungai Purun G Kuburan Muslim Sungai Mariam', 20, 0, 4269000, 4269000, 0, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(113, '19/NOTA-ASN/VII/2023', 22, 6, 'Bapak Marno', '085250199119', 'Jl Basuki Rahmad Jl Angsoka No.07', 19, 0, 6259000, 6259000, 0, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(114, '20/NOTA-ASN/VII/2023', 23, 6, 'Bapak Maharudin', '082121216711 / 082148577859', 'Jl Kembang Kuning Gg Abadi Palaran Jembatan Bungkuk ', 21, 225000, 10516000, 10516000, 0, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(115, '21/NOTA-ASN/VII/2023', 24, 6, 'Ibu Fitri', '082151599591', 'Jl M Said Gg Kita Blok A Masuk Paling Ujung Rumah Kosong Warna Putih', 19, 0, 4783500, 4783500, 0, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(116, '22/NOTA-ASN/VII/2023', 21, 4, 'Toko Genius', '08117282213', '-', 4, 0, 517000, 506000, -11000, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(118, '23/NOTA-ASN/VII/2023', 25, 4, 'Bapak Sugianto', '085316000961', 'L3 Blok A Rt 7 Gang Bongi', 13, 0, 2941800, 2940000, -1800, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(119, '24/NOTA-ASN/VII/2023', 25, 4, 'Bapak Sugianto', '085316000961', 'L3 Blok A Rt 7 Gang Bongi', 4, 0, 1613040, 1652000, 38960, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(120, '25/NOTA-ASN/VII/2023', 22, 6, 'Bapak Marno', '085250199119', 'Jl Basuki Rahmad Jl Angsoka No.07', 18, 0, 1684000, 1684000, 0, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(121, '26/NOTA-ASN/VII/2023', 26, 6, 'Bapak Suyitno', '082221434692', 'Jl Wonosari Gg Iman 1 Rt.24 Makroman', 20, 0, 3219000, 3219000, 0, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(122, '27/NOTA-ASN/VII/2023', 27, 6, 'Bapak Asnur', '085845227715', 'Jl Batuah Kilo 30', 4, 0, 8240000, 8240000, 0, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(123, '28/NOTA-ASN/VII/2023', 20, 6, 'Bapak H Aswan', '085246854482 / 082158124444', 'Jl. Poros Samarinda Sungai Purun G Kuburan Muslim Sungai Mariam', 20, 0, 410000, 0, -410000, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(124, '29/NOTA-ASN/VII/2023', 12, 6, 'No Name', '-', '-', 4, 0, 55000, 55000, 0, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(127, '30/NOTA-ASN/VII/2023', 28, 6, 'Geraja GPDI Parakletos', '0822-5245-3347', 'Melak', 19, 0, 5989000, 5989000, 0, 0, '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(128, '31/NOTA-ASN/VII/2023', 29, 6, 'Bapak Rahmad', '081349458889', 'Jl Sultan Alimudin Padat Karya Gg Halidi 1 No.70 Rt.04', 23, 0, 400000, 400000, 0, 0, '2023-07-15 00:00:00', '2023-07-15 00:00:00'),
(129, '32/NOTA-ASN/VII/2023', 29, 6, 'Bapak Rahmad', '081349458889', 'Jl Sultan Alimudin Padat Karya Gg Halidi 1 No.70 Rt.04', 4, 0, 210000, 210000, 0, 0, '2023-07-15 00:00:00', '2023-07-15 00:00:00'),
(130, '33/NOTA-ASN/VII/2023', 30, 6, 'Bapak Hadi', '085246856477', 'Damanhuri', 18, 0, 1634000, 1634000, 0, 0, '2023-07-17 00:00:00', '2023-07-17 00:00:00'),
(138, '34/NOTA-ASN/VII/2023', 31, 6, 'Bapak Hanafi', '-', '-', 4, 0, 720000, 720000, 0, 0, '2023-07-18 00:00:00', '2023-07-18 00:00:00'),
(139, '35/NOTA-ASN/VII/2023', 29, 6, 'Bapak Rahmad', '081349458889', 'Jl Sultan Alimudin Padat Karya Gg Halidi 1 No.70 Rt.04', 4, 0, 115000, 115000, 0, 0, '2023-07-18 00:00:00', '2023-07-18 00:00:00'),
(140, '36/NOTA-ASN/VII/2023', 32, 6, 'Bapak Herman', '081347341775', 'Kutai Lama', 24, 25000, 7625000, 7625000, 0, 0, '2023-07-18 00:00:00', '2023-07-18 00:00:00'),
(142, '37/NOTA-ASN/VII/2023', 33, 6, 'Bapak Hari', '081347787855', 'Jl Sukses 1 Blok.L No.34 ', 25, 0, 1314000, 1314000, 0, 0, '2023-07-18 00:00:00', '2023-07-18 00:00:00'),
(143, '38/NOTA-ASN/VII/2023', 34, 6, 'Ibu Iriyana', '0822-5303-5498', 'Jl H Suwandi Blok E No 142', 4, 0, 1050000, 1050000, 0, 0, '2023-07-18 00:00:00', '2023-07-18 00:00:00'),
(144, '39/NOTA-ASN/VII/2023', 35, 6, 'Bapak Baharudin', '081347336336', '-', 4, 0, 450000, 450000, 0, 0, '2023-07-18 00:00:00', '2023-07-18 00:00:00'),
(145, '40/NOTA-ASN/VII/2023', 36, 0, 'Bapak Supiansyah', '081346522117', 'Resak', 4, 0, 275000, 275000, 0, 0, '2023-07-20 00:00:00', '2023-08-02 00:00:00'),
(148, '41/NOTA-ASN/VII/2023', 37, 6, 'Bapak Asnur', '081354440008', '-', 4, 0, 1498000, 1498000, 0, 0, '2023-07-20 00:00:00', '2023-07-20 00:00:00'),
(149, '42/NOTA-ASN/VII/2023', 34, 6, 'Ibu Iriyana', '0822-5303-5498', 'Jl H Suwandi Blok E No 142', 18, 0, 2850000, 2850000, 0, 0, '2023-07-20 00:00:00', '2023-07-20 00:00:00'),
(151, '43/NOTA-ASN/VII/2023', 16, 6, 'Bapak Usup', '085347475923', 'Jl Datu Iba Sungai Kledang', 4, 100000, 1400000, 1400000, 0, 0, '2023-07-20 00:00:00', '2023-07-20 00:00:00'),
(152, '44/NOTA-ASN/VII/2023', 16, 6, 'Bapak Usup', '085347475923', 'Jl Datu Iba Sungai Kledang', 25, 0, 25000, 25000, 0, 0, '2023-07-20 00:00:00', '2023-07-20 00:00:00'),
(153, '45/NOTA-ASN/VII/2023', 38, 6, 'Bapak Nawi', '081255355479', '-', 4, 0, 132000, 150000, 18000, 0, '2023-07-20 00:00:00', '2023-07-20 00:00:00'),
(190, '01/NOTA-ASN/VIII/2023', 6, 6, 'Bapak Didi', '-', 'Handil D', 25, 0, 160000, 0, -160000, 1, '2023-08-02 21:46:48', '2023-08-02 21:46:56'),
(191, '02/NOTA-ASN/VIII/2023', 6, 6, 'Bapak Didi', '-', 'Handil D', 25, 0, 50000, 50000, 0, 1, '2023-08-03 12:46:34', '2023-08-03 12:46:45'),
(192, '03/NOTA-ASN/VIII/2023', 8, 2, 'Bapak Ari Granit', '081347919813', 'Jl Gunung Lingai', 25, 0, 924000, 924000, 0, 1, '2023-08-03 21:29:35', '2023-08-03 21:29:52'),
(193, '04/NOTA-ASN/VIII/2023', 11, 4, 'Bapak Kustoyo', '082151796654', '-', 25, 0, 740250, 740250, 0, 1, '2023-08-03 21:32:54', '2023-08-03 21:37:08'),
(194, '05/NOTA-ASN/VIII/2023', 9, 6, 'Bapak Kohar', '-', '-', 25, 0, 50000, 50000, 0, 1, '2023-08-06 10:51:27', '2023-08-06 10:51:39'),
(195, '06/NOTA-ASN/VIII/2023', 6, 6, 'Bapak Didi', '-', 'Handil D', 22, 0, 300000, 300000, 0, 1, '2023-08-23 19:53:18', '2023-08-23 19:53:39'),
(197, '02/NOTA-ASN/IX/2023', 15, 6, 'Bapak Beta Markus', '081346686060', 'Jl Gotong Royong Gg 2 Palaran Gereja Kibad', 21, 0, 675000, 675000, 0, 1, '2023-09-22 06:24:20', '2023-09-22 06:24:43'),
(198, '03/NOTA-ASN/IX/2023', 16, 6, 'Bapak Usup', '085347475923', 'Jl Datu Iba Sungai Kledang', 21, 0, 837500, 837500, 0, 1, '2023-09-22 22:39:06', '2023-09-22 22:39:50'),
(199, '04/NOTA-ASN/IX/2023', 14, 6, 'PT Muara Kembang ', '085348600636', 'Muara Kembang', 18, 0, 1130000, 1130000, 0, 1, '2023-09-23 07:10:28', '2023-09-23 07:10:46'),
(200, '05/NOTA-ASN/IX/2023', 41, 10, 'tesla', '0852520252', 'JL. Revolusi', 25, 0, 320760, 320760, 0, 1, '2023-09-23 07:18:12', '2023-09-23 07:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `tukang`
--

CREATE TABLE `tukang` (
  `id_tukang` int(5) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tukang`
--

INSERT INTO `tukang` (`id_tukang`, `nama`) VALUES
(1, 'Riyanto'),
(2, 'Muklis');

-- --------------------------------------------------------

--
-- Table structure for table `uang_kas`
--

CREATE TABLE `uang_kas` (
  `id_uang` int(5) UNSIGNED NOT NULL,
  `nilai` int(11) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `id_sumber` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `uang_kas`
--

INSERT INTO `uang_kas` (`id_uang`, `nilai`, `jumlah`, `subtotal`, `jenis`, `id_sumber`) VALUES
(14, 5000, 5, 25000, 'Kertas', 4),
(15, 10000, 5, 50000, 'Kertas', 4),
(16, 1000, 25, 25000, 'Kertas', 4),
(19, 5000, 10, 50000, 'Kertas', 7),
(20, 50000, 9, 450000, 'Kertas', 7);

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

CREATE TABLE `ukuran` (
  `id_ukuran` int(5) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`id_ukuran`, `nama`, `keterangan`) VALUES
(1, 'M2', 'Volume Plafon'),
(2, 'M', 'Kitchenset dan Pagar'),
(3, 'Pcs', 'Lampu '),
(5, 'Titik', 'Pemasangan Lampu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `level`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@sejatistore.com', '$2y$10$tjg9dNPi8/8byH0T.1aP4.pM7.xJgXBNBpx6USCW1Y38J4c1metFO', 2, 0, NULL, NULL),
(5, 'kasir', 'kasir@sejatistore.com', '$2y$10$0kkaHOBUPRL93pDcP1ssvuihBr5pvyugoRtG4wXxIcbz4g1oxj26O', 1, 0, NULL, NULL),
(7, 'Fahmi', 'fahmi@gmail.com', '$2y$10$n5ha0blsEb5gpSXNBqHbeOWEzZ.zclAhru0aDHZ7BpFv8L/lPEdSS', 2, 0, NULL, NULL),
(8, 'Kasir2', 'kasir2@sejatistore.com', '$2y$10$p9wTqYxWq0fKbHsi9N49oeniaB8k859gge17iaHeJ.NqmR3XJHu3q', 1, 0, NULL, NULL),
(9, 'drafter', 'drafter@sejatistore.com', '$2y$10$YnAO6Re2pc57o20wApLlYOojVVdhHqsjrG5ik0PlvZkkR/oUVJNK2', 3, 1, NULL, NULL),
(10, 'surveyor', 'surveyor@sejatistore.com', '$2y$10$PwtLbX2kEX3wSMAOkInOs.mbxba6sas55L3yhbEPfN0QLhKNTYzbi', 4, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `bahan_pasang`
--
ALTER TABLE `bahan_pasang`
  ADD PRIMARY KEY (`id_pasang`);

--
-- Indexes for table `bayarhbk`
--
ALTER TABLE `bayarhbk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bayarpasang`
--
ALTER TABLE `bayarpasang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulanan`
--
ALTER TABLE `bulanan`
  ADD PRIMARY KEY (`id_bulanan`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id_deposit`);

--
-- Indexes for table `detail_bahan`
--
ALTER TABLE `detail_bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_bulanan`
--
ALTER TABLE `detail_bulanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_hbk`
--
ALTER TABLE `detail_hbk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_hutang`
--
ALTER TABLE `detail_hutang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pemasangan`
--
ALTER TABLE `detail_pemasangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_piutang`
--
ALTER TABLE `detail_piutang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_sumber`
--
ALTER TABLE `detail_sumber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `drafter`
--
ALTER TABLE `drafter`
  ADD PRIMARY KEY (`id_drafter`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indexes for table `gatuk`
--
ALTER TABLE `gatuk`
  ADD PRIMARY KEY (`id_gatuk`);

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `hbk`
--
ALTER TABLE `hbk`
  ADD PRIMARY KEY (`id_hbk`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id_hutang`);

--
-- Indexes for table `insentif`
--
ALTER TABLE `insentif`
  ADD PRIMARY KEY (`id_ins`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indexes for table `kasbon`
--
ALTER TABLE `kasbon`
  ADD PRIMARY KEY (`id_kasbon`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `katekas`
--
ALTER TABLE `katekas`
  ADD PRIMARY KEY (`id_katekas`);

--
-- Indexes for table `katepel`
--
ALTER TABLE `katepel`
  ADD PRIMARY KEY (`id_katepel`);

--
-- Indexes for table `kerja`
--
ALTER TABLE `kerja`
  ADD PRIMARY KEY (`id_kerja`);

--
-- Indexes for table `labarugi`
--
ALTER TABLE `labarugi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memo`
--
ALTER TABLE `memo`
  ADD PRIMARY KEY (`id_memo`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pel`);

--
-- Indexes for table `pemasangan`
--
ALTER TABLE `pemasangan`
  ADD PRIMARY KEY (`id_pasang`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indexes for table `pengukur`
--
ALTER TABLE `pengukur`
  ADD PRIMARY KEY (`id_pengukur`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`id_piutang`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_kembali`
--
ALTER TABLE `produk_kembali`
  ADD PRIMARY KEY (`id_kembali`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rab`
--
ALTER TABLE `rab`
  ADD PRIMARY KEY (`id_rab`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `rpt`
--
ALTER TABLE `rpt`
  ADD PRIMARY KEY (`id_rpt`);

--
-- Indexes for table `satuan_produk`
--
ALTER TABLE `satuan_produk`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `subkategori`
--
ALTER TABLE `subkategori`
  ADD PRIMARY KEY (`id_subkate`);

--
-- Indexes for table `subkerja`
--
ALTER TABLE `subkerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sumber_kas`
--
ALTER TABLE `sumber_kas`
  ADD PRIMARY KEY (`id_sumber`);

--
-- Indexes for table `survei`
--
ALTER TABLE `survei`
  ADD PRIMARY KEY (`id_survei`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tukang`
--
ALTER TABLE `tukang`
  ADD PRIMARY KEY (`id_tukang`);

--
-- Indexes for table `uang_kas`
--
ALTER TABLE `uang_kas`
  ADD PRIMARY KEY (`id_uang`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`id_ukuran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bahan_pasang`
--
ALTER TABLE `bahan_pasang`
  MODIFY `id_pasang` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bayarhbk`
--
ALTER TABLE `bayarhbk`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `bayarpasang`
--
ALTER TABLE `bayarpasang`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `bulanan`
--
ALTER TABLE `bulanan`
  MODIFY `id_bulanan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id_deposit` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_bahan`
--
ALTER TABLE `detail_bahan`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `detail_bulanan`
--
ALTER TABLE `detail_bulanan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_hbk`
--
ALTER TABLE `detail_hbk`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `detail_hutang`
--
ALTER TABLE `detail_hutang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_pemasangan`
--
ALTER TABLE `detail_pemasangan`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `detail_piutang`
--
ALTER TABLE `detail_piutang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `detail_sumber`
--
ALTER TABLE `detail_sumber`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;

--
-- AUTO_INCREMENT for table `drafter`
--
ALTER TABLE `drafter`
  MODIFY `id_drafter` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gatuk`
--
ALTER TABLE `gatuk`
  MODIFY `id_gatuk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hbk`
--
ALTER TABLE `hbk`
  MODIFY `id_hbk` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id_hutang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `insentif`
--
ALTER TABLE `insentif`
  MODIFY `id_ins` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id_kas` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `kasbon`
--
ALTER TABLE `kasbon`
  MODIFY `id_kasbon` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `katekas`
--
ALTER TABLE `katekas`
  MODIFY `id_katekas` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `katepel`
--
ALTER TABLE `katepel`
  MODIFY `id_katepel` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kerja`
--
ALTER TABLE `kerja`
  MODIFY `id_kerja` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `labarugi`
--
ALTER TABLE `labarugi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `memo`
--
ALTER TABLE `memo`
  MODIFY `id_memo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pel` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pemasangan`
--
ALTER TABLE `pemasangan`
  MODIFY `id_pasang` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_bayar` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengukur`
--
ALTER TABLE `pengukur`
  MODIFY `id_pengukur` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `id_piutang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=557;

--
-- AUTO_INCREMENT for table `produk_kembali`
--
ALTER TABLE `produk_kembali`
  MODIFY `id_kembali` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rab`
--
ALTER TABLE `rab`
  MODIFY `id_rab` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rpt`
--
ALTER TABLE `rpt`
  MODIFY `id_rpt` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `satuan_produk`
--
ALTER TABLE `satuan_produk`
  MODIFY `id_satuan` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `subkategori`
--
ALTER TABLE `subkategori`
  MODIFY `id_subkate` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `subkerja`
--
ALTER TABLE `subkerja`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sumber_kas`
--
ALTER TABLE `sumber_kas`
  MODIFY `id_sumber` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `survei`
--
ALTER TABLE `survei`
  MODIFY `id_survei` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `tukang`
--
ALTER TABLE `tukang`
  MODIFY `id_tukang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uang_kas`
--
ALTER TABLE `uang_kas`
  MODIFY `id_uang` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ukuran`
--
ALTER TABLE `ukuran`
  MODIFY `id_ukuran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
