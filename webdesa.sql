-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2025 at 03:51 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdesa`
--

-- --------------------------------------------------------

--
-- Table structure for table `dusun`
--

CREATE TABLE `dusun` (
  `id` int UNSIGNED NOT NULL,
  `nama_dusun` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_dusun` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dusun`
--

INSERT INTO `dusun` (`id`, `nama_dusun`, `kode_dusun`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dusun I', 'D001', 1, NULL, NULL, NULL),
(2, 'Dusun II', 'D002', 1, NULL, NULL, NULL),
(3, 'Dusun III', 'D003', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_agama`
--

CREATE TABLE `master_agama` (
  `id` int UNSIGNED NOT NULL,
  `nama_agama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_agama` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urut` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=aktif,0=nonaktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_agama`
--

INSERT INTO `master_agama` (`id`, `nama_agama`, `kode_agama`, `urut`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Islam', '01', 1, 1, NULL, NULL, NULL),
(2, 'Kristen', '02', 2, 1, NULL, NULL, NULL),
(3, 'Katolik', '03', 3, 1, NULL, NULL, NULL),
(4, 'Hindu', '04', 4, 1, NULL, NULL, NULL),
(5, 'Buddha', '05', 5, 1, NULL, NULL, NULL),
(6, 'Konghucu', '06', 6, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_pekerjaan`
--

CREATE TABLE `master_pekerjaan` (
  `id` int UNSIGNED NOT NULL,
  `nama_pekerjaan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_pekerjaan` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urut` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_pekerjaan`
--

INSERT INTO `master_pekerjaan` (`id`, `nama_pekerjaan`, `kode_pekerjaan`, `urut`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Belum/Tidak Bekerja', '001', 1, 1, NULL, NULL, NULL),
(2, 'Pelajar/Mahasiswa', '002', 2, 1, NULL, NULL, NULL),
(3, 'Ibu Rumah Tangga', '003', 3, 1, NULL, NULL, NULL),
(4, 'Petani/Pekebun', '004', 4, 1, NULL, NULL, NULL),
(5, 'Buruh Tani/Buruh Harian', '005', 5, 1, NULL, NULL, NULL),
(6, 'Pedagang/Wiraswasta', '006', 6, 1, NULL, NULL, NULL),
(7, 'PNS/ASN', '007', 7, 1, NULL, NULL, NULL),
(8, 'TNI/Polri', '008', 8, 1, NULL, NULL, NULL),
(9, 'Pensiunan', '009', 9, 1, NULL, NULL, NULL),
(10, 'Lainnya', '999', 99, 1, NULL, '2025-11-16 14:36:41', NULL),
(11, '111111', '123123', 55, 1, '2025-11-16 14:36:17', '2025-11-16 14:37:00', '2025-11-16 14:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_pendidikan`
--

CREATE TABLE `master_pendidikan` (
  `id` int UNSIGNED NOT NULL,
  `nama_pendidikan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_pendidikan` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urut` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_pendidikan`
--

INSERT INTO `master_pendidikan` (`id`, `nama_pendidikan`, `kode_pendidikan`, `urut`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tidak/Belum Sekolah', '00', 1, 1, NULL, NULL, NULL),
(2, 'SD/Sederajat', '01', 2, 1, NULL, NULL, NULL),
(3, 'SMP/Sederajat', '02', 3, 1, NULL, NULL, NULL),
(4, 'SMA/Sederajat', '03', 4, 1, NULL, NULL, NULL),
(5, 'Diploma I/II', '04', 5, 1, NULL, NULL, NULL),
(6, 'Diploma III', '05', 6, 1, NULL, NULL, NULL),
(7, 'Diploma IV/S1', '06', 7, 1, NULL, NULL, NULL),
(8, 'S2', '07', 8, 1, NULL, NULL, NULL),
(9, 'S3', '08', 9, 1, NULL, '2025-11-16 14:28:35', NULL),
(10, 'aaa', '11', 12, 1, '2025-11-16 14:28:18', '2025-11-16 14:28:30', '2025-11-16 14:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-01-01-000000', 'App\\Database\\Migrations\\CreatePagesTable', 'default', 'App', 1763178327, 1),
(2, '2025-01-02-000000', 'App\\Database\\Migrations\\AddDeletedAtToPages', 'default', 'App', 1763178608, 2),
(3, '2025-11-16-000001', 'App\\Database\\Migrations\\CreateNewsTable', 'default', 'App', 1763272691, 3),
(4, '2025-11-16-000000', 'App\\Database\\Migrations\\CreatePendudukAndMasters', 'default', 'App', 1763273607, 4),
(5, '2025-11-16-000002', 'App\\Database\\Migrations\\CreateMasterAgama', 'default', 'App', 1763304656, 5),
(6, '2025-11-17-074512', 'App\\Database\\Migrations\\MasterAgama', 'default', 'App', 1763305045, 6),
(7, '2025-11-16-000004', 'App\\Database\\Migrations\\SeedPendudukDummy20', 'default', 'App', 1763307530, 7);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_general_ci,
  `status` enum('published','draft') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'published',
  `cover_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `slug`, `title`, `content`, `status`, `cover_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'sdfsdf', 'sdfsdf', '<p>tes <img src=\"http://localhost:8080/file/pages/img_691968dca87440.55551503.jpg\" alt=\"\"></p>', 'published', '1763272937_23feade193696f344af6.png', '2025-11-16 06:02:17', '2025-11-16 06:11:28', NULL),
(2, 'sss', 'sss', '<p>fff</p>', 'published', 'cover_69196ceb7c07f4.88195075.jpg', '2025-11-16 06:19:23', '2025-11-16 06:19:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int UNSIGNED NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci,
  `status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'published',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `title`, `content`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'res', 'tes', 'tes', 'published', '2025-11-15 03:51:37', '2025-11-15 04:55:44', '2025-11-15 04:55:44'),
(2, 'fdgdf-dfgdfgdfg', 'fdgdf dfgdfgdfg', '<p>testign aja</p>', 'published', '2025-11-15 04:09:02', '2025-11-15 04:55:49', '2025-11-15 04:55:49'),
(3, 'tes', 'tes', '<p>asasdasd</p>\n<p><img src=\"../../file/pages/1763257863_84d03fcaef312e547512.png\" alt=\"\" width=\"1463\" height=\"2605\"></p>', 'published', '2025-11-16 01:51:17', '2025-11-16 03:02:59', '2025-11-16 03:02:59'),
(4, 'testing-again', 'testing again', '<p>testinggg<br><img src=\"http://localhost:8080/file/pages/1763260484_521e38813a2ebadc5400.png\" alt=\"\"></p>', 'published', '2025-11-16 02:31:47', '2025-11-16 03:03:05', '2025-11-16 03:03:05'),
(5, 'hai', 'hai', '<p><img src=\"http://localhost:8080/file/pages/1763263318_1fdfec68e0bd3c9d0c68.png\" alt=\"\"></p>\r\n<p></p>', 'published', '2025-11-16 03:06:52', '2025-11-16 05:35:14', '2025-11-16 05:35:14'),
(6, '23dasdasdasd', '23dasdasdasd', '<p>aaaa</p>\r\n<p><img src=\"http://localhost:8080/file/pages/img_69194765161645.37549608.jpg\" alt=\"\"></p>', 'draft', '2025-11-16 03:33:07', '2025-11-16 05:35:10', '2025-11-16 05:35:10'),
(7, 'asdas', 'asdas', '<p>asdasdasdas</p>\r\n<p>&nbsp;<img src=\"http://localhost:8080/file/pages/img_69196609c67529.86719948.jpg\" alt=\"\"></p>', 'published', '2025-11-16 05:50:20', '2025-11-16 05:50:45', '2025-11-16 05:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int UNSIGNED NOT NULL,
  `nik` char(16) COLLATE utf8mb4_general_ci NOT NULL,
  `no_kk` char(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_lengkap` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'L',
  `tempat_lahir` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `golongan_darah` enum('A','B','AB','O','-') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agama_id` int DEFAULT NULL,
  `status_perkawinan` enum('Belum Kawin','Kawin','Cerai Hidup','Cerai Mati') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Belum Kawin',
  `pendidikan_id` int UNSIGNED DEFAULT NULL,
  `pekerjaan_id` int UNSIGNED DEFAULT NULL,
  `kewarganegaraan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'WNI',
  `status_penduduk` enum('Tetap','Pendatang') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Tetap',
  `status_dasar` enum('Hidup','Meninggal','Pindah','Hilang') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Hidup',
  `rt_id` int UNSIGNED DEFAULT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `desa` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ktp_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `nik`, `no_kk`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `golongan_darah`, `agama_id`, `status_perkawinan`, `pendidikan_id`, `pekerjaan_id`, `kewarganegaraan`, `status_penduduk`, `status_dasar`, `rt_id`, `alamat`, `desa`, `kecamatan`, `no_hp`, `email`, `ktp_file`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, '6301030108980003', '6301030108980003', 'Ibnu Fajar', 'L', 'Pelaihari', '1998-08-01', NULL, 1, 'Kawin', 6, 7, 'WNI', 'Tetap', 'Hidup', 1, '', 'Batilai', 'Takisung', '', '', 'ktp/1763300886_7e74350d5c07736fe522.pdf', 1, '2025-11-16 13:47:24', '2025-11-16 15:25:10', NULL),
(34, '6372021001000034', '6372025001000034', 'Ahmad Rifandi', 'L', '', '1992-04-11', NULL, 1, 'Belum Kawin', 6, 6, 'WNI', 'Tetap', 'Hidup', 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(35, '6372021002000035', '6372025002000035', 'Siti Rohani', 'P', '', '1989-08-01', NULL, 1, 'Belum Kawin', 4, 4, 'WNI', 'Tetap', 'Hidup', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(36, '6372021003000036', '6372025003000036', 'Budi Hartono', 'L', '', '2000-10-22', NULL, 1, 'Belum Kawin', 3, 1, 'WNI', 'Pendatang', 'Hidup', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(37, '6372021004000037', '6372025004000037', 'Maria Elisabeth', 'P', '', '1996-02-14', NULL, 2, 'Belum Kawin', 7, 5, 'WNI', 'Tetap', 'Hidup', 4, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(38, '6372021005000038', '6372025005000038', 'Ketut Aryana', 'L', '', '1978-06-07', NULL, 4, 'Belum Kawin', 2, 3, 'WNI', 'Tetap', 'Hidup', 4, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(39, '6372021006000039', '6372025006000039', 'Yohanes Gamaliel', 'L', '', '1983-09-19', NULL, 3, 'Belum Kawin', 6, 5, 'WNI', 'Tetap', 'Hidup', 5, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(40, '6372021007000040', '6372025007000040', 'Dewi Lestari', 'P', '', '1994-11-03', NULL, 1, 'Belum Kawin', 5, 2, 'WNI', 'Pendatang', 'Hidup', 6, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(41, '6372021008000041', '6372025008000041', 'Gusti Ayu Pratiwi', 'P', '', '1999-01-28', NULL, 4, 'Belum Kawin', 4, 6, 'WNI', 'Pendatang', 'Hidup', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(42, '6372021009000042', '6372025009000042', 'Slamet Riyadi', 'L', '', '1985-12-12', NULL, 1, 'Belum Kawin', 6, 6, 'WNI', 'Tetap', 'Hidup', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(43, '6372021010000043', '6372025010000043', 'Paulus Andika', 'L', '', '1974-07-30', NULL, 3, 'Belum Kawin', 4, 4, 'WNI', 'Tetap', 'Hidup', 6, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(44, '6372021011000044', '6372025011000044', 'Nur Aisyah', 'P', '', '2002-03-21', NULL, 1, 'Belum Kawin', 4, 2, 'WNI', 'Pendatang', 'Hidup', 5, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(45, '6372021012000045', '6372025012000045', 'Adi Prasetyo', 'L', '', '1981-10-02', NULL, 1, 'Belum Kawin', 2, 3, 'WNI', 'Tetap', 'Hidup', 4, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(46, '6372021013000046', '6372025013000046', 'Kartini Sari', 'P', '', '1997-09-14', NULL, 1, 'Belum Kawin', 6, 5, 'WNI', 'Tetap', 'Hidup', 5, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(47, '6372021014000047', '6372025014000047', 'Luh Putu Ayuni', 'P', '', '1993-01-16', NULL, 4, 'Belum Kawin', 4, 6, 'WNI', 'Pendatang', 'Hidup', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(48, '6372021015000048', '6372025015000048', 'Novita Anggreani', 'P', '', '2001-12-09', NULL, 1, 'Belum Kawin', 3, 2, 'WNI', 'Tetap', 'Hidup', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(49, '6372021016000049', '6372025016000049', 'Herman Gunawan', 'L', '', '1980-05-05', NULL, 2, 'Belum Kawin', 4, 6, 'WNI', 'Tetap', 'Hidup', 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(50, '6372021017000050', '6372025017000050', 'Nanda Oktaviani', 'P', '', '1998-04-27', NULL, 1, 'Belum Kawin', 7, 6, 'WNI', 'Pendatang', 'Hidup', 6, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(51, '6372021018000051', '6372025018000051', 'Rama Wijaya', 'L', '', '1979-02-10', NULL, 1, 'Belum Kawin', 5, 3, 'WNI', 'Tetap', 'Hidup', 4, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(52, '6372021019000052', '6372025019000052', 'Agus Maulana', 'L', '', '1991-09-17', NULL, 1, 'Belum Kawin', 6, 6, 'WNI', 'Pendatang', 'Hidup', 1, '', 'Batilai', 'Takisung', '', '', NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:39:26', NULL),
(53, '6372021020000053', '6372025020000053', 'Mega Aprilia', 'P', '', '2003-07-18', NULL, 1, 'Belum Kawin', 4, 2, 'WNI', 'Tetap', 'Hidup', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rt`
--

CREATE TABLE `rt` (
  `id` int UNSIGNED NOT NULL,
  `rw_id` int UNSIGNED NOT NULL,
  `no_rt` tinyint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rt`
--

INSERT INTO `rt` (`id`, `rw_id`, `no_rt`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL),
(2, 1, 2, 1, NULL, NULL, NULL),
(3, 1, 3, 1, NULL, NULL, NULL),
(4, 2, 1, 1, NULL, NULL, NULL),
(5, 2, 2, 1, NULL, NULL, NULL),
(6, 3, 1, 1, NULL, NULL, NULL),
(7, 3, 2, 1, NULL, NULL, NULL),
(8, 4, 1, 1, NULL, NULL, NULL),
(9, 5, 1, 1, NULL, NULL, NULL),
(10, 5, 2, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rw`
--

CREATE TABLE `rw` (
  `id` int UNSIGNED NOT NULL,
  `dusun_id` int UNSIGNED NOT NULL,
  `no_rw` tinyint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rw`
--

INSERT INTO `rw` (`id`, `dusun_id`, `no_rw`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL),
(2, 1, 2, 1, NULL, NULL, NULL),
(3, 2, 1, 1, NULL, NULL, NULL),
(4, 2, 2, 1, NULL, NULL, NULL),
(5, 3, 1, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_agama`
--
ALTER TABLE `master_agama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pekerjaan`
--
ALTER TABLE `master_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pendidikan`
--
ALTER TABLE `master_pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `status` (`status`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `penduduk_rt_id_foreign` (`rt_id`),
  ADD KEY `penduduk_pendidikan_id_foreign` (`pendidikan_id`),
  ADD KEY `penduduk_pekerjaan_id_foreign` (`pekerjaan_id`),
  ADD KEY `no_kk` (`no_kk`),
  ADD KEY `nama_lengkap` (`nama_lengkap`),
  ADD KEY `status_penduduk` (`status_penduduk`),
  ADD KEY `status_dasar` (`status_dasar`);

--
-- Indexes for table `rt`
--
ALTER TABLE `rt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rt_rw_id_foreign` (`rw_id`);

--
-- Indexes for table `rw`
--
ALTER TABLE `rw`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rw_dusun_id_foreign` (`dusun_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dusun`
--
ALTER TABLE `dusun`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_agama`
--
ALTER TABLE `master_agama`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_pekerjaan`
--
ALTER TABLE `master_pekerjaan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `master_pendidikan`
--
ALTER TABLE `master_pendidikan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `rt`
--
ALTER TABLE `rt`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rw`
--
ALTER TABLE `rw`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_pekerjaan_id_foreign` FOREIGN KEY (`pekerjaan_id`) REFERENCES `master_pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  ADD CONSTRAINT `penduduk_pendidikan_id_foreign` FOREIGN KEY (`pendidikan_id`) REFERENCES `master_pendidikan` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  ADD CONSTRAINT `penduduk_rt_id_foreign` FOREIGN KEY (`rt_id`) REFERENCES `rt` (`id`) ON DELETE CASCADE ON UPDATE SET NULL;

--
-- Constraints for table `rt`
--
ALTER TABLE `rt`
  ADD CONSTRAINT `rt_rw_id_foreign` FOREIGN KEY (`rw_id`) REFERENCES `rw` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rw`
--
ALTER TABLE `rw`
  ADD CONSTRAINT `rw_dusun_id_foreign` FOREIGN KEY (`dusun_id`) REFERENCES `dusun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
