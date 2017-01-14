-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2017 at 01:51 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metro`
--

-- --------------------------------------------------------

--
-- Table structure for table `detil_transaksi`
--

CREATE TABLE `detil_transaksi` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `tipe_barang` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_total` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_transaksi`
--

INSERT INTO `detil_transaksi` (`id_transaksi`, `tipe_barang`, `jumlah`, `harga_modal`, `harga`, `harga_total`, `keterangan`) VALUES
(5016, 'ABC-123', 1, 1000000, 1500000, 1500000, 'minta bracket + kabel'),
(5016, 'DEF-456', 2, 1200000, 1750000, 3500000, 'minta kabel dan pipa ac'),
(5017, 'PNC-1234', 69, 1300000, 1500000, 103500000, 'beli banyak'),
(5018, 'GHI-789', 12, 1400000, 1800000, 1800000, ''),
(5019, 'GHI-789', 1, 1400000, 1800000, 1800000, '150000'),
(1233, 'ABC-123', 5, 0, 50000, 0, '31'),
(1233, 'PNC-1234', 0, 0, 0, 0, ''),
(1233, 'PNC1212', 0, 0, 0, 0, ''),
(5019, 'DEF-456', 0, 0, 0, 0, ''),
(5019, 'DEF-456', 0, 0, 0, 0, ''),
(5019, 'DEF-456', 0, 0, 0, 0, ''),
(5019, 'DEF-456', 0, 0, 0, 0, ''),
(5019, 'DEF-456', 0, 0, 0, 0, ''),
(5019, 'ABC-123', 0, 0, 0, 0, ''),
(5019, 'PNC1212', 0, 0, 0, 0, ''),
(5019, 'ABC-123', 5, 0, 50000, 0, '31'),
(5019, 'ABC-123', 5, 0, 50000, 0, '31'),
(5016, 'ABC-123', 0, 0, 0, 0, ''),
(5016, '', 0, 0, 0, 0, ''),
(5016, '', 0, 0, 0, 0, ''),
(5016, '', 13, 0, 13000, 0, 'GA ADA'),
(5016, '', 13, 0, 13000, 0, 'GA ADA'),
(5016, '', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'ABC-123', 3, 0, 4, 0, '5'),
(5016, 'ABC-123', 5, 0, 13000, 0, '-'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'ABC-123', 3, 0, 4, 0, '5'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'ABC-123', 3, 0, 4, 0, '5'),
(5016, 'DEF-456', 7, 0, 15000, 0, '-'),
(1337, 'ABC-123', 5, 0, 13000, 0, '-'),
(5016, 'PNC1212', 13, 0, 13000, 0, 'GA ADA'),
(5016, 'DEF-456', 3, 0, 4, 0, '5'),
(5016, 'DEF-456', 7, 0, 15000, 0, '-'),
(5016, 'PNC-1234', 7, 0, 8, 0, '9'),
(5016, 'DEF-456', 7, 0, 15000, 0, '-'),
(5016, 'GHI-789', 123, 0, 123, 0, '123'),
(5016, 'ABC-123', 33, 0, 44, 0, '55'),
(5020, 'PNC-1234', 3, 0, 10000, 0, '-'),
(5020, 'PNC-1234', 3, 0, 10000, 0, '-'),
(1188990, 'ABC-123', 9, 100000, 110000, 990000, 'HEHE'),
(1188991, 'ABC-123', 20, 0, 1000, 0, '-'),
(1188992, 'ABC-123', 10, 0, 10000, 0, '-'),
(1188993, 'ABC-123', 15, 0, 10000, 0, '-'),
(1188994, 'ABC-123', 15, 0, 100000, 0, '-'),
(1188995, 'ABC-123', 10, 0, 120000, 0, '-');

-- --------------------------------------------------------

--
-- Table structure for table `gaji_karyawan`
--

CREATE TABLE `gaji_karyawan` (
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `bonus` int(11) NOT NULL,
  `gaji` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `uang_makan` int(11) NOT NULL,
  `jumlah_gaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gaji_karyawan`
--

INSERT INTO `gaji_karyawan` (`id_karyawan`, `bonus`, `gaji`, `denda`, `uang_makan`, `jumlah_gaji`) VALUES
(1, 250000, 1450000, 125000, 600000, 2175000),
(2, 150000, 450000, 25000, 600000, 1750000),
(3, 350000, 2500000, 200000, 60000, 3250000),
(10, 500000, 500000, 75000, 1600000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hutang_karyawan`
--

CREATE TABLE `hutang_karyawan` (
  `id_hutang` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `hutang` int(11) NOT NULL,
  `jangka_waktu` date NOT NULL,
  `keterangan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hutang_karyawan`
--

INSERT INTO `hutang_karyawan` (`id_hutang`, `id_karyawan`, `hutang`, `jangka_waktu`, `keterangan`, `status`) VALUES
(1, 1, 15000000, '2017-03-05', 'Cicilan Motor', 1),
(3, 2, 150000, '2017-01-31', '789', 0),
(4, 1, 21321321, '2017-01-04', '/*-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventori`
--

CREATE TABLE `inventori` (
  `tipe_brg` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_merk` int(10) UNSIGNED NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventori`
--

INSERT INTO `inventori` (`tipe_brg`, `id_merk`, `id_kategori`, `harga_barang`, `jumlah`) VALUES
('787858', 2, 1, 10, 0),
('9999', 1, 3, 100, 0),
('aaa', 2, 2, 17, 0),
('ABC-123', 1, 1, 1500000, 50),
('ABC-341', 1, 2, 125, 0),
('ABC-3412', 1, 1, 11, 0),
('asd', 1, 2, 100000, 0),
('ASD-890', 3, 1, 1500, 50),
('asddasads', 2, 3, 176, 0),
('asddsadas', 6, 4, 22, 0),
('bbb', 1, 1, 164, 0),
('DEF-456', 1, 2, 1500000, 25),
('dgfh', 2, 2, 120, 0),
('GHI-789', 2, 3, 1500000, 20),
('ini', 1, 1, 100, 0),
('PNC-1234', 3, 3, 2250000, 12),
('PNC1212', 3, 3, 1250000, 12),
('poi', 1, 1, 1, 0),
('qaz', 1, 3, 1, 0),
('qwe', 1, 1, 1, 0),
('qwe123432', 2, 2, 100909, 0),
('qwep', 2, 2, 120000, 0),
('wahab123', 2, 2, 150, 0),
('weha', 2, 4, 1000, 1020),
('yu', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id_jenis_transaksi` int(10) UNSIGNED NOT NULL,
  `jenis_transaksi` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`id_jenis_transaksi`, `jenis_transaksi`) VALUES
(1, 'Penjualan'),
(2, 'Pembelian'),
(3, 'Retur');

-- --------------------------------------------------------

--
-- Table structure for table `jns_kelamin`
--

CREATE TABLE `jns_kelamin` (
  `id_jns_kelamin` int(10) UNSIGNED NOT NULL,
  `jns_kelamin` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jns_kelamin`
--

INSERT INTO `jns_kelamin` (`id_jns_kelamin`, `jns_kelamin`) VALUES
(1, 'Laki-Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `id_toko` int(10) UNSIGNED NOT NULL,
  `id_jns_kelamin` int(10) UNSIGNED NOT NULL,
  `nama_karyawan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tempat_lhr` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_lhr` datetime NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_telp` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_toko`, `id_jns_kelamin`, `nama_karyawan`, `tempat_lhr`, `tgl_lhr`, `alamat`, `nomor_telp`) VALUES
(1, 1, 1, 'Billy', 'Palembang', '2016-11-21 00:00:00', 'jl. asd no 123', '123321321132'),
(2, 1, 1, 'John', 'Jakarta', '1979-09-09 00:00:00', 'jl. def no 456', '0'),
(3, 2, 2, 'Alice', 'Medan', '1975-11-11 00:00:00', 'jl. ghi no 789', '0'),
(6, 2, 1, 'wahab', 'palembang', '2016-11-23 00:00:00', 'jljl', '0891291234123'),
(9, 3, 1, 'hahaahihi', 'Weha', '2016-12-15 13:26:50', 'weha', '2142142'),
(10, 3, 2, 'Piki', 'piki', '2016-11-11 00:00:00', 'ga ada', '7687856765');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(10) UNSIGNED NOT NULL,
  `nama` varchar(25) NOT NULL,
  `nama_perusahaan` varchar(75) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id_kontak`, `nama`, `nama_perusahaan`, `alamat`, `no_telp`) VALUES
(1, 'Davin', 'PT. Pete', 'jl. segaran lr gedeng pembayun no 60', '08999998065'),
(2, 'panyak', 'PT. Choi pan', 'Ruko Taman Buaya Blok B No 1\r\nJl. Bandengan Utara\r\nJakarta Barat', '021-6908242'),
(3, 'asd', 'asd', 'asd', '412123312');

-- --------------------------------------------------------

--
-- Table structure for table `master_kategori`
--

CREATE TABLE `master_kategori` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `kategori` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_kategori`
--

INSERT INTO `master_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Televisi'),
(2, 'AC'),
(3, 'Mesin Cuci'),
(4, 'Kompor'),
(5, 'Lapar');

-- --------------------------------------------------------

--
-- Table structure for table `master_merk`
--

CREATE TABLE `master_merk` (
  `id_merk` int(10) UNSIGNED NOT NULL,
  `merk` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_merk`
--

INSERT INTO `master_merk` (`id_merk`, `merk`) VALUES
(1, 'Samsung'),
(2, 'Toshiba'),
(3, 'Panasonic'),
(4, 'Sony'),
(6, 'Sanyo');

-- --------------------------------------------------------

--
-- Table structure for table `master_toko`
--

CREATE TABLE `master_toko` (
  `id_toko` int(10) UNSIGNED NOT NULL,
  `nama_toko` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supervisor` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_toko`
--

INSERT INTO `master_toko` (`id_toko`, `nama_toko`, `alamat`, `supervisor`) VALUES
(1, 'Metro', 'Jl. Brigjen Pol Abdullah Kadir, 15 Ilir, Ilir Tim. I, Kota Palembang, Sumatera Selatan 30111, Indonesia', 2),
(2, 'Metro Jaya', 'Jl. Brigjen Pol Abdullah Kadir, 15 Ilir, Ilir Tim. I, Kota Palembang, Sumatera Selatan 30111, Indonesia', 0),
(3, 'Rajawali', 'Jl. Brigjen Pol Abdullah Kadir, 15 Ilir, Ilir Tim. I, Kota Palembang, Sumatera Selatan 30111, Indonesia', 0),
(4, 'New Metro', 'Jl. Brigjen Pol Abdullah Kadir, 15 Ilir, Ilir Tim. I, Kota Palembang, Sumatera Selatan 30111, Indonesia', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_10_03_084020_create_inventori_table', 1),
('2016_10_03_091652_create_karyawan_table', 1),
('2016_10_03_092843_create_transaksi_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `nama_pengaturan` varchar(255) NOT NULL,
  `nilai_pengaturan` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama_pengaturan`, `nilai_pengaturan`) VALUES
(1, 'Sanksi Presensi', '5000'),
(2, 'Multiplier Gaji', '1');

-- --------------------------------------------------------

--
-- Table structure for table `presensi_karyawan`
--

CREATE TABLE `presensi_karyawan` (
  `id_presensi` int(11) NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `tgl_presensi` date NOT NULL,
  `jam_hadir` time NOT NULL,
  `status_hadir` tinyint(1) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `presensi_karyawan`
--

INSERT INTO `presensi_karyawan` (`id_presensi`, `id_karyawan`, `tgl_presensi`, `jam_hadir`, `status_hadir`, `keterangan`) VALUES
(32, 1, '2017-01-13', '18:31:36', 0, '-'),
(33, 2, '2017-01-13', '18:38:43', 1, '-'),
(34, 3, '2017-01-13', '18:31:36', 0, '-'),
(35, 6, '2017-01-13', '18:31:36', 1, '-'),
(36, 9, '2017-01-13', '18:38:07', 1, '-'),
(37, 10, '2017-01-13', '18:47:19', 1, '-');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `id_jenis_transaksi` int(10) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_telp` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `status_bayar` tinyint(1) NOT NULL,
  `status_kirim` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_jenis_transaksi`, `nama_pelanggan`, `alamat`, `nomor_telp`, `tanggal_transaksi`, `id_karyawan`, `status_bayar`, `status_kirim`) VALUES
(0, 1, 'habs', 'jl asd asddasasd', '123312312132', '2016-11-11', 1, 1, 1),
(1233, 1, 'habs', 'jl asd asddasasd', '123312312132', '2016-11-11', 1, 1, 1),
(1337, 1, '', 'ha ada', '1230912309132', '2016-12-12', 1, 0, 0),
(5016, 1, 'wahab', 'alpukat 3 no 37', '0899912912', '2016-11-11', 1, 1, 1),
(5017, 2, 'wahyudi', 'lingkaran 1', '08137888911', '2016-11-15', 9, 1, 0),
(5018, 1, 'Nico', 'jl. candi angkoso', '0812345678', '2016-11-26', 3, 1, 1),
(5019, 2, 'pan', 'pan', '124903431', '2016-11-16', 6, 0, 0),
(5020, 1, 'pelanggan1', 'jl asassafasas', '01291291212', '2016-12-13', 1, 0, 0),
(12230, 1, '', 'jl asd asddasasd', '12332123112', '2016-11-11', 1, 1, 1),
(12232, 1, '', 'jl asd asddasasd', '12332123112', '2016-11-11', 1, 1, 1),
(12238, 1, '', 'jl asd asddasasd', '12332123112', '2016-11-11', 1, 1, 1),
(13333, 1, '', 'jl asd asddasasd', '12332123112', '2016-11-11', 1, 1, 1),
(1188990, 1, 'asdwh', 'weha weha', '08999998065', '2016-12-18', 2, 0, 0),
(1188991, 1, 'weha', 'jalan2', '123', '2016-12-19', 1, 0, 0),
(1188992, 1, 'weha', 'weha 123', '123321312', '2016-12-19', 1, 0, 0),
(1188993, 1, 'William', 'Grand Gardern 123', '08912921912912', '2016-12-19', 1, 0, 0),
(1188994, 1, 'William', 'Grand Gardern 123', '08912921912912', '2016-12-19', 1, 0, 0),
(1188995, 1, 'William', 'Grand Gardern 123', '08912921912912', '2016-12-19', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'lalala', 'lalala', '$2y$10$HR.DpVEnIzET3v7VRcoRSeR5T3SVG2yyDVQDFcd/7c7aHDp7oSXwa', NULL, '2016-10-05 03:26:05', '2016-10-05 03:26:05'),
(2, 'weha', 'weha', '$2y$10$xknVlPrZraqP739mYzA7C.W3XEyJho6Gz1UptqmI0kr4UYiJXIKD2', NULL, '2016-12-27 17:47:40', '2016-12-27 17:47:40'),
(3, 'admin', 'admin', '$2y$10$23o35DUsyyNdfgUsAQlgvui4P/5zTIy0wV2k7jJ79EEQSI8JNE4fS', NULL, '2016-12-29 20:29:11', '2016-12-29 20:29:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detil_transaksi`
--
ALTER TABLE `detil_transaksi`
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `tipe_brg` (`tipe_barang`);

--
-- Indexes for table `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  ADD KEY `gaji_karyawan_id_karyawan_foreign` (`id_karyawan`);

--
-- Indexes for table `hutang_karyawan`
--
ALTER TABLE `hutang_karyawan`
  ADD PRIMARY KEY (`id_hutang`),
  ADD KEY `hutang_karyawan_id_karyawan_foreign` (`id_karyawan`);

--
-- Indexes for table `inventori`
--
ALTER TABLE `inventori`
  ADD PRIMARY KEY (`tipe_brg`),
  ADD KEY `inventori_id_kategori_foreign` (`id_kategori`),
  ADD KEY `inventori_id_merk_foreign` (`id_merk`);

--
-- Indexes for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`id_jenis_transaksi`);

--
-- Indexes for table `jns_kelamin`
--
ALTER TABLE `jns_kelamin`
  ADD PRIMARY KEY (`id_jns_kelamin`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `karyawan_id_toko_foreign` (`id_toko`),
  ADD KEY `karyawan_id_jns_kelamin_foreign` (`id_jns_kelamin`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `master_kategori`
--
ALTER TABLE `master_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `master_merk`
--
ALTER TABLE `master_merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `master_toko`
--
ALTER TABLE `master_toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `presensi_karyawan`
--
ALTER TABLE `presensi_karyawan`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `presensi_karyawan_id_karyawan_foreign` (`id_karyawan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_jenis_transaksi` (`id_jenis_transaksi`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hutang_karyawan`
--
ALTER TABLE `hutang_karyawan`
  MODIFY `id_hutang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `id_jenis_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jns_kelamin`
--
ALTER TABLE `jns_kelamin`
  MODIFY `id_jns_kelamin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `master_kategori`
--
ALTER TABLE `master_kategori`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `master_merk`
--
ALTER TABLE `master_merk`
  MODIFY `id_merk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `master_toko`
--
ALTER TABLE `master_toko`
  MODIFY `id_toko` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `presensi_karyawan`
--
ALTER TABLE `presensi_karyawan`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detil_transaksi`
--
ALTER TABLE `detil_transaksi`
  ADD CONSTRAINT `detil_transaksi_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON UPDATE CASCADE;

--
-- Constraints for table `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  ADD CONSTRAINT `gaji_karyawan_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON UPDATE CASCADE;

--
-- Constraints for table `hutang_karyawan`
--
ALTER TABLE `hutang_karyawan`
  ADD CONSTRAINT `hutang_karyawan_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON UPDATE CASCADE;

--
-- Constraints for table `inventori`
--
ALTER TABLE `inventori`
  ADD CONSTRAINT `inventori_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `master_kategori` (`id_kategori`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inventori_id_merk_foreign` FOREIGN KEY (`id_merk`) REFERENCES `master_merk` (`id_merk`) ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_id_jns_kelamin_foreign` FOREIGN KEY (`id_jns_kelamin`) REFERENCES `jns_kelamin` (`id_jns_kelamin`) ON UPDATE CASCADE,
  ADD CONSTRAINT `karyawan_id_toko_foreign` FOREIGN KEY (`id_toko`) REFERENCES `master_toko` (`id_toko`) ON UPDATE CASCADE;

--
-- Constraints for table `presensi_karyawan`
--
ALTER TABLE `presensi_karyawan`
  ADD CONSTRAINT `presensi_karyawan_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_jenis_transaksi_foreign` FOREIGN KEY (`id_jenis_transaksi`) REFERENCES `jenis_transaksi` (`id_jenis_transaksi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
