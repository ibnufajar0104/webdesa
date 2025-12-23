-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2025 at 08:23 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

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
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text,
  `button_text` varchar(100) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL COMMENT 'file gambar utama banner',
  `position` int NOT NULL DEFAULT '1' COMMENT 'urutan tampil',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `description`, `button_text`, `button_url`, `image`, `position`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'asd', 'asdasd', 'asdasd', '', '', '1763567776_df97308f120abedba650.png', 1, 'active', '2025-11-19 15:56:16', '2025-11-19 15:57:00', '2025-11-19 15:57:00'),
(2, 'Selamat Datang di Website Desa Batilai', 'Kecamatan Pelaihari, Kabupaten Tanah Laut', 'Informasi layanan desa, jam operasional, dan kontak yang jelas dan mudah ditemukan.', 'Jelajahi', 'https://desabatilai.id#statistik', '1766334221_a751587a91c8aa2c16f0.jpg', 1, 'active', '2025-12-21 16:23:41', '2025-12-21 16:23:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` smallint DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `ringkasan` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL DEFAULT '0',
  `views` int UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id`, `kategori_id`, `judul`, `slug`, `nomor`, `tahun`, `tanggal`, `ringkasan`, `file_path`, `file_name`, `mime`, `size`, `views`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'tes', 'tes', '100', 2025, '2025-12-23', 'asdasd', '1766476431_208da2e405b64b0fbccc.pdf', 'IMG-SKP M. SYAFRIANDI NOOR 2024_0001.pdf', 'application/pdf', 2564560, 0, 1, '2025-12-23 07:53:51', '2025-12-23 07:53:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_kategori`
--

CREATE TABLE `dokumen_kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `urutan` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen_kategori`
--

INSERT INTO `dokumen_kategori` (`id`, `nama`, `slug`, `deskripsi`, `urutan`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Peraturan Desa', 'peraturan-desa', 'Peraturan Desa yang ditetapkan oleh Kepala Desa bersama BPD', 1, 1, '2025-12-23 09:14:09', NULL, NULL),
(2, 'Keputusan Kepala Desa', 'keputusan-kepala-desa', 'Keputusan Kepala Desa terkait penyelenggaraan pemerintahan desa', 2, 1, '2025-12-23 09:14:09', NULL, NULL),
(3, 'Surat Edaran', 'surat-edaran', 'Surat edaran resmi yang dikeluarkan oleh Pemerintah Desa', 3, 1, '2025-12-23 09:14:09', NULL, NULL),
(4, 'Laporan Keuangan Desa', 'laporan-keuangan-desa', 'Dokumen laporan keuangan desa (APBDes, Realisasi, dll)', 4, 1, '2025-12-23 09:14:09', NULL, NULL),
(5, 'APBDes', 'apbdes', 'Anggaran Pendapatan dan Belanja Desa', 5, 1, '2025-12-23 09:14:09', NULL, NULL),
(6, 'RPJMDes', 'rpjmdes', 'Rencana Pembangunan Jangka Menengah Desa', 6, 1, '2025-12-23 09:14:09', NULL, NULL),
(7, 'RKPDes', 'rkpdes', 'Rencana Kerja Pemerintah Desa', 7, 1, '2025-12-23 09:14:09', NULL, NULL),
(8, 'Profil Desa', 'profil-desa', 'Dokumen profil dan gambaran umum desa', 8, 1, '2025-12-23 09:14:09', NULL, NULL),
(9, 'Informasi Publik', 'informasi-publik', 'Dokumen informasi publik sesuai keterbukaan informasi', 9, 1, '2025-12-23 09:14:09', NULL, NULL),
(10, 'Dokumen Layanan', 'dokumen-layanan', 'Dokumen pendukung pelayanan administrasi desa', 10, 1, '2025-12-23 09:14:09', NULL, NULL),
(11, 'Data Statistik Desa', 'data-statistik-desa', 'Data statistik kependudukan dan potensi desa', 11, 1, '2025-12-23 09:14:09', NULL, NULL),
(12, 'Dokumen Lainnya', 'dokumen-lainnya', 'Dokumen lain yang tidak termasuk kategori khusus', 99, 1, '2025-12-23 09:14:09', NULL, NULL),
(13, 'dasd', 'dasd', 'sadasd', 0, 1, '2025-12-23 01:42:47', '2025-12-23 01:42:56', '2025-12-23 01:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `dusun`
--

CREATE TABLE `dusun` (
  `id` int UNSIGNED NOT NULL,
  `nama_dusun` varchar(100) NOT NULL,
  `kode_dusun` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `dusun`
--

INSERT INTO `dusun` (`id`, `nama_dusun`, `kode_dusun`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dusun I', 'D001', 1, NULL, NULL, NULL),
(2, 'Dusun II', 'D002', 1, NULL, NULL, NULL),
(3, 'Dusun III', 'D003', 1, NULL, NULL, NULL),
(4, '123', '123', 1, '2025-12-16 15:03:17', '2025-12-16 15:09:02', '2025-12-16 15:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `galery`
--

CREATE TABLE `galery` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `caption` text,
  `file_path` varchar(255) NOT NULL,
  `mime` varchar(80) DEFAULT NULL,
  `ukuran` bigint UNSIGNED DEFAULT NULL,
  `urut` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galery`
--

INSERT INTO `galery` (`id`, `judul`, `caption`, `file_path`, `mime`, `ukuran`, `urut`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '4234', '2432', 'galery/1765962700_6477ba0f2f10806449fb.jpeg', 'image/jpeg', 445195, 1, 1, '2025-12-17 09:11:40', '2025-12-17 09:17:13', '2025-12-17 09:17:13'),
(2, 'Gotong Royong Pembersihan Lingkungan', 'Kegiatan gotong royong bersama perangkat desa dan masyarakat dalam rangka menjaga kebersihan lingkungan serta mempererat kebersamaan warga. Dilaksanakan secara rutin sebagai bentuk kepedulian terhadap lingkungan desa.', 'galery/1766475725_2a8440e2ef091e376690.jpg', 'image/jpeg', 47761, 0, 1, '2025-12-23 07:42:05', '2025-12-23 07:42:05', NULL),
(3, 'Pelayanan Administrasi Kependudukan', 'Pelayanan administrasi kependudukan kepada masyarakat berjalan dengan tertib dan lancar. Pemerintah desa berkomitmen memberikan pelayanan yang cepat, transparan, dan mudah diakses oleh seluruh warga.', 'galery/1766475747_bdbe78237c1702ff37c8.jpg', 'image/jpeg', 41389, 0, 1, '2025-12-23 07:42:27', '2025-12-23 07:42:27', NULL),
(4, 'Rapat Koordinasi Lembaga Desa', 'Rapat koordinasi bersama lembaga desa membahas program kerja dan evaluasi kegiatan yang telah dilaksanakan. Diharapkan melalui koordinasi ini, seluruh program dapat berjalan lebih efektif dan tepat sasaran.', 'galery/1766475790_659e531e97c74ae96e9f.jpg', 'image/jpeg', 45908, 0, 1, '2025-12-23 07:43:10', '2025-12-23 07:43:10', NULL),
(5, 'Kegiatan Posyandu Balita', 'Pelaksanaan kegiatan Posyandu balita sebagai upaya pemantauan tumbuh kembang anak dan peningkatan kesehatan ibu dan anak. Kegiatan ini didukung oleh kader posyandu dan tenaga kesehatan setempat.', 'galery/1766475811_edfd1a25c3258be55555.jpg', 'image/jpeg', 36795, 0, 1, '2025-12-23 07:43:31', '2025-12-23 07:43:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jam_pelayanan`
--

CREATE TABLE `jam_pelayanan` (
  `id` int UNSIGNED NOT NULL,
  `hari` varchar(150) NOT NULL,
  `jam_mulai` varchar(20) DEFAULT NULL,
  `jam_selesai` varchar(20) DEFAULT NULL,
  `keterangan` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `jam_pelayanan`
--

INSERT INTO `jam_pelayanan` (`id`, `hari`, `jam_mulai`, `jam_selesai`, `keterangan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Senin - Jumat', '08:00 WITA', '15:00 WITA', 'Istirahat pukul 12:00 - 13:00 WITA', 1, '2025-11-19 15:18:19', '2025-11-19 15:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `kontak_desa`
--

CREATE TABLE `kontak_desa` (
  `id` int UNSIGNED NOT NULL,
  `alamat` text,
  `telepon` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL COMMENT 'Nomor WA format internasional, contoh: 628xxxxxxxxxx',
  `email` varchar(120) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `link_maps` text COMMENT 'URL Google Maps / embed link',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `kontak_desa`
--

INSERT INTO `kontak_desa` (`id`, `alamat`, `telepon`, `whatsapp`, `email`, `website`, `link_maps`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Kantor Desa Batilai\r\nKecamatan Batulicin\r\nKabupaten Tanah Laut, Kalimantan Selatan', '0512-123456', '6281234567890', 'desabatilai@example.com', 'https://desabatilai.go.id', 'https://maps.google.com/?q=Desa+Batilai', 1, '2025-11-19 15:28:58', '2025-11-19 15:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `master_agama`
--

CREATE TABLE `master_agama` (
  `id` int UNSIGNED NOT NULL,
  `nama_agama` varchar(100) NOT NULL,
  `kode_agama` varchar(20) DEFAULT NULL,
  `urut` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=aktif,0=nonaktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

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
-- Table structure for table `master_bantuan`
--

CREATE TABLE `master_bantuan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_bantuan` varchar(150) NOT NULL,
  `kode_bantuan` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `urut` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_bantuan`
--

INSERT INTO `master_bantuan` (`id`, `nama_bantuan`, `kode_bantuan`, `is_active`, `urut`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BLT', '01', 1, 1, NULL, NULL, NULL),
(2, 'BPNT', '02', 1, 2, NULL, NULL, NULL),
(3, 'PKH', '03', 1, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_jabatan`
--

CREATE TABLE `master_jabatan` (
  `id` int UNSIGNED NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `kode_jabatan` varchar(20) DEFAULT NULL,
  `urut` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `master_jabatan`
--

INSERT INTO `master_jabatan` (`id`, `nama_jabatan`, `kode_jabatan`, `urut`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kepala Desa', 'KADES', 1, 1, NULL, '2025-11-19 14:47:58', NULL),
(2, 'Sekretaris Desa', 'SEKDES', 2, 1, NULL, NULL, NULL),
(3, 'Kaur Umum dan Perencanaan', 'KAUR_UMUM', 3, 1, NULL, NULL, NULL),
(4, 'Kaur Keuangan', 'KAUR_KEU', 4, 1, NULL, NULL, NULL),
(5, 'Kasi Pemerintahan', 'KASI_PEM', 5, 1, NULL, NULL, NULL),
(6, 'Kasi Kesejahteraan', 'KASI_KESRA', 6, 1, NULL, NULL, NULL),
(7, 'Kasi Pelayanan', 'KASI_PEL', 7, 1, NULL, NULL, NULL),
(8, 'Kepala Dusun I', 'KADUS_1', 8, 1, NULL, NULL, NULL),
(9, 'Kepala Dusun II', 'KADUS_2', 9, 1, NULL, NULL, NULL),
(10, 'Staf Desa', 'STAF', 10, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_pekerjaan`
--

CREATE TABLE `master_pekerjaan` (
  `id` int UNSIGNED NOT NULL,
  `nama_pekerjaan` varchar(100) NOT NULL,
  `kode_pekerjaan` varchar(20) DEFAULT NULL,
  `urut` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

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
  `nama_pendidikan` varchar(100) NOT NULL,
  `kode_pendidikan` varchar(20) DEFAULT NULL,
  `urut` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int UNSIGNED NOT NULL,
  `parent_id` int UNSIGNED DEFAULT NULL,
  `label` varchar(150) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `target` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `label`, `url`, `sort_order`, `is_active`, `target`, `created_at`, `updated_at`) VALUES
(3, NULL, 'Berandaa', 'beranda', 1, 1, '_self', '2025-12-21 03:09:03', '2025-12-23 07:38:25'),
(4, NULL, 'Statistik', 'statistik', 3, 1, '_blank', '2025-12-21 03:09:37', '2025-12-23 07:38:25'),
(5, NULL, 'Perangkat Desa', 'perangkatdesa', 2, 1, '_self', '2025-12-21 03:13:48', '2025-12-23 07:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ;

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
(7, '2025-11-16-000004', 'App\\Database\\Migrations\\SeedPendudukDummy20', 'default', 'App', 1763307530, 7),
(8, '2025-11-19-000000', 'App\\Database\\Migrations\\CreateMasterJabatan', 'default', 'App', 1763563403, 8),
(9, '2025-11-19-000001', 'App\\Database\\Migrations\\CreateSambutanKades', 'default', 'App', 1763565162, 9),
(10, '2025-11-19-000002', 'App\\Database\\Migrations\\CreateJamPelayanan', 'default', 'App', 1763565499, 10),
(11, '2025-11-19-000003', 'App\\Database\\Migrations\\CreateKontakDesa', 'default', 'App', 1763566138, 11),
(12, '2025-11-19-000000', 'App\\Database\\Migrations\\CreateBannersTable', 'default', 'App', 1763567737, 12),
(13, '2025-11-20-000001', 'App\\Database\\Migrations\\CreatePerangkatDesa', 'default', 'App', 1763650586, 13),
(14, '2025-11-20-000002', 'App\\Database\\Migrations\\CreatePerangkatPendidikanHistory', 'default', 'App', 1763650586, 13),
(15, '2025-11-20-120000', 'App\\Database\\Migrations\\CreatePerangkatJabatanHistory', 'default', 'App', 1763652207, 14),
(16, '2025-11-20-130000', 'App\\Database\\Migrations\\SeedDummyPerangkatDesa', 'default', 'App', 1763652848, 15),
(17, '2025-11-20-150000', 'App\\Database\\Migrations\\ResetAndSeedPerangkatDesaDummy', 'default', 'App', 1763653349, 16),
(18, '2025-12-18-153809', 'App\\Database\\Migrations\\CreateMenus', 'default', 'App', 1766072367, 17),
(19, '2025-12-23-011106', 'App\\Database\\Migrations\\CreateKategoriDokumen', 'default', 'App', 1766452407, 18),
(20, '2025-12-23-011153', 'App\\Database\\Migrations\\CreateDokumenTables', 'default', 'App', 1766452407, 18);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int UNSIGNED NOT NULL,
  `slug` varchar(191) NOT NULL,
  `title` varchar(191) NOT NULL,
  `content` longtext,
  `status` enum('published','draft') NOT NULL DEFAULT 'published',
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `slug`, `title`, `content`, `status`, `cover_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'sdfsdf', 'sdfsdf', '<p>tes <img src=\"http://localhost:8080/file/pages/img_691968dca87440.55551503.jpg\" alt=\"\"></p>', 'published', '1763272937_23feade193696f344af6.png', '2025-11-16 06:02:17', '2025-11-19 14:25:39', '2025-11-19 14:25:39'),
(2, 'sss', 'sss', '<p>fff</p>', 'published', 'cover_69196ceb7c07f4.88195075.jpg', '2025-11-16 06:19:23', '2025-11-19 14:25:35', '2025-11-19 14:25:35'),
(3, 'aaa', 'aaa', '<p>aaa</p>', 'published', NULL, '2025-11-19 14:29:28', '2025-11-19 14:29:41', '2025-11-19 14:29:41'),
(4, 'aaaa', 'aaaa', '<p>aa</p>', 'published', '1763562646_5751ce4a0656df8444d4.png', '2025-11-19 14:30:46', '2025-11-19 14:31:04', '2025-11-19 14:31:04'),
(5, 'musyawarah-pembangunan-desa-2025', 'Musyawarah Pembangunan Desa 2025', '<p><span>Kegiatan musyawarah pembangunan desa melibatkan warga untuk menentukan program prioritas...</span></p>', 'published', '1766334281_d25a927594c5045d6686.jpg', '2025-11-19 14:32:17', '2025-12-21 16:24:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int UNSIGNED NOT NULL,
  `slug` varchar(150) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text,
  `status` varchar(20) NOT NULL DEFAULT 'published',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

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
(7, 'asdas', 'asdas', '<p>asdasdasdas</p>\r\n<p>&nbsp;<img src=\"http://localhost:8080/file/pages/img_69196609c67529.86719948.jpg\" alt=\"\"></p>', 'published', '2025-11-16 05:50:20', '2025-11-16 05:50:45', '2025-11-16 05:50:45'),
(8, 'tentang-desa', 'Tentang Desa', '<p data-start=\"180\" data-end=\"338\">Desa ini merupakan wilayah administratif yang berada dalam satuan pemerintahan desa dan menjadi pusat aktivitas sosial, ekonomi, serta pelayanan masyarakat.</p>\r\n<p data-start=\"345\" data-end=\"512\">Dengan potensi sumber daya alam dan sumber daya manusia yang dimiliki, desa terus berupaya melakukan pembangunan berkelanjutan demi meningkatkan kesejahteraan warga.</p>\r\n<p data-start=\"519\" data-end=\"698\">Pemerintah desa berkomitmen memberikan pelayanan yang transparan, akuntabel, dan berorientasi pada kebutuhan masyarakat, sejalan dengan prinsip tata kelola pemerintahan yang baik.</p>', 'published', '2025-12-23 06:58:55', '2025-12-23 06:58:55', NULL),
(9, 'visi-dan-misi-desa', 'Visi dan Misi Desa', '<p><strong>Visi Desa</strong></p>\r\n<p>Terwujudnya Desa yang Maju, Mandiri, Sejahtera, dan Berdaya Saing.</p>\r\n<p data-start=\"832\" data-end=\"845\"><strong>Misi Desa</strong></p>\r\n<ol data-start=\"846\" data-end=\"1125\">\r\n<li data-start=\"846\" data-end=\"924\">\r\n<p data-start=\"849\" data-end=\"924\">Meningkatkan kualitas pelayanan publik yang cepat, tepat, dan transparan.</p>\r\n</li>\r\n<li data-start=\"925\" data-end=\"992\">\r\n<p data-start=\"928\" data-end=\"992\">Mendorong partisipasi aktif masyarakat dalam pembangunan desa.</p>\r\n</li>\r\n<li data-start=\"993\" data-end=\"1054\">\r\n<p data-start=\"996\" data-end=\"1054\">Mengelola potensi desa secara optimal dan berkelanjutan.</p>\r\n</li>\r\n<li data-start=\"1055\" data-end=\"1125\">\r\n<p data-start=\"1058\" data-end=\"1125\">Mewujudkan tata kelola pemerintahan desa yang bersih dan akuntabel</p>\r\n</li>\r\n</ol>', 'published', '2025-12-23 06:59:47', '2025-12-23 06:59:47', NULL),
(10, 'sejarah-desa', 'Sejarah Desa', '<p data-start=\"189\" data-end=\"498\">Desa ini berdiri sebagai bagian dari proses perkembangan wilayah dan pemukiman masyarakat yang berlangsung secara turun-temurun. Pada awalnya, wilayah desa merupakan kawasan tempat bermukimnya beberapa keluarga yang menggantungkan hidup pada sektor pertanian, perkebunan, dan sumber daya alam di sekitarnya.</p>\r\n<p data-start=\"505\" data-end=\"850\">Seiring dengan bertambahnya jumlah penduduk, masyarakat mulai membentuk tata kehidupan bersama yang terorganisir, ditandai dengan adanya tokoh masyarakat, adat, serta kesepakatan bersama dalam mengelola wilayah dan kehidupan sosial. Dari proses inilah kemudian terbentuk pemerintahan desa sebagai satuan administratif yang diakui secara resmi.</p>\r\n<p data-start=\"857\" data-end=\"1244\">Dalam perkembangannya, desa terus mengalami perubahan dan kemajuan, baik dari sisi pemerintahan, pembangunan, maupun pelayanan kepada masyarakat. Dengan tetap menjunjung nilai-nilai kebersamaan, gotong royong, dan kearifan lokal, desa berkomitmen untuk terus berkembang menuju masa depan yang lebih baik tanpa meninggalkan sejarah dan jati diri yang telah diwariskan oleh para pendahulu.</p>', 'published', '2025-12-23 07:01:35', '2025-12-23 07:01:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int UNSIGNED NOT NULL,
  `nik` char(16) NOT NULL,
  `no_kk` char(16) DEFAULT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL DEFAULT 'L',
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `golongan_darah` enum('A','B','AB','O','-') DEFAULT NULL,
  `agama_id` int DEFAULT NULL,
  `status_perkawinan` enum('Belum Kawin','Kawin','Cerai Hidup','Cerai Mati') NOT NULL DEFAULT 'Belum Kawin',
  `pendidikan_id` int UNSIGNED DEFAULT NULL,
  `pekerjaan_id` int UNSIGNED DEFAULT NULL,
  `kewarganegaraan` varchar(50) NOT NULL DEFAULT 'WNI',
  `status_penduduk` enum('Tetap','Pendatang') NOT NULL DEFAULT 'Tetap',
  `status_dasar` enum('Hidup','Meninggal','Pindah','Hilang') NOT NULL DEFAULT 'Hidup',
  `rt_id` int UNSIGNED DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `desa` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `ktp_file` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `nik`, `no_kk`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `golongan_darah`, `agama_id`, `status_perkawinan`, `pendidikan_id`, `pekerjaan_id`, `kewarganegaraan`, `status_penduduk`, `status_dasar`, `rt_id`, `alamat`, `desa`, `kecamatan`, `no_hp`, `email`, `ktp_file`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, '6301030108980003', '6301030108980003', 'Ibnu Fajar', 'L', 'Pelaihari', '1998-08-01', NULL, 1, 'Kawin', 6, 7, 'WNI', 'Tetap', 'Hidup', 1, '', 'Batilai', 'Takisung', '', '', 'ktp/1763300886_7e74350d5c07736fe522.pdf', 1, '2025-11-16 13:47:24', '2025-11-16 15:25:10', NULL),
(34, '6372021001000034', '6372025001000034', 'Ahmad Rifandi', 'L', '', '1992-04-11', NULL, 1, 'Belum Kawin', 6, 6, 'WNI', 'Tetap', 'Hidup', 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(35, '6372021002000035', '6372025002000035', 'Siti Rohani', 'P', '', '1989-08-01', NULL, 1, 'Belum Kawin', 4, 4, 'WNI', 'Tetap', 'Hidup', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(36, '6372021003000036', '6372025003000036', 'Budi Hartono', 'L', '', '2000-10-22', NULL, 1, 'Belum Kawin', 3, 1, 'WNI', 'Pendatang', 'Hidup', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(41, '6372021008000041', '6372025008000041', 'Gusti Ayu Pratiwi', 'P', '', '1999-01-28', NULL, 4, 'Belum Kawin', 4, 6, 'WNI', 'Pendatang', 'Hidup', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(42, '6372021009000042', '6372025009000042', 'Slamet Riyadi', 'L', '', '1985-12-12', NULL, 1, 'Belum Kawin', 6, 6, 'WNI', 'Tetap', 'Hidup', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(47, '6372021014000047', '6372025014000047', 'Luh Putu Ayuni', 'P', '', '1993-01-16', NULL, 4, 'Belum Kawin', 4, 6, 'WNI', 'Pendatang', 'Hidup', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(48, '6372021015000048', '6372025015000048', 'Novita Anggreani', 'P', '', '2001-12-09', NULL, 1, 'Belum Kawin', 3, 2, 'WNI', 'Tetap', 'Hidup', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:56:52', '2025-11-16 15:56:52'),
(49, '6372021016000049', '6372025016000049', 'Herman Gunawan', 'L', '', '1980-05-05', NULL, 2, 'Belum Kawin', 4, 6, 'WNI', 'Tetap', 'Hidup', 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:38:50', NULL),
(52, '6372021019000052', '6372025019000052', 'Agus Maulana', 'L', '', '1991-09-17', NULL, 1, 'Belum Kawin', 6, 6, 'WNI', 'Pendatang', 'Hidup', 1, '', 'Batilai', 'Takisung', '', '', NULL, 1, '2025-11-16 15:38:50', '2025-11-16 15:39:26', NULL),
(53, '6372021020000053', '6372025020000053', 'Mega Aprilia', 'P', '', '2003-07-18', NULL, 1, 'Belum Kawin', 4, 2, 'WNI', 'Tetap', 'Hidup', 2, '', 'Batilai', 'Takisung', '', '', NULL, 1, '2025-11-16 15:38:50', '2025-12-16 15:44:36', NULL),
(54, '2423454745745745', '2342423454745745', 'sfd', 'L', '4234', '2025-12-16', 'A', 1, 'Belum Kawin', NULL, NULL, 'WNI', 'Tetap', 'Hidup', NULL, '', 'Batilai', 'Pelaihari', '', '', NULL, 1, '2025-12-16 15:44:26', '2025-12-16 15:48:32', '2025-12-16 15:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `penerima_bantuan`
--

CREATE TABLE `penerima_bantuan` (
  `id` bigint UNSIGNED NOT NULL,
  `penduduk_id` bigint UNSIGNED NOT NULL,
  `bantuan_id` bigint UNSIGNED NOT NULL,
  `tahun` smallint UNSIGNED NOT NULL,
  `periode` varchar(30) DEFAULT NULL,
  `tanggal_terima` date DEFAULT NULL,
  `nominal` decimal(14,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `keterangan` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerima_bantuan`
--

INSERT INTO `penerima_bantuan` (`id`, `penduduk_id`, `bantuan_id`, `tahun`, `periode`, `tanggal_terima`, `nominal`, `status`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 48, 1, 2025, NULL, NULL, NULL, 1, '', '2025-12-18 02:45:58', '2025-12-18 03:02:06', '2025-12-18 03:02:06'),
(2, 52, 1, 2025, 'Tahap 1', '2025-12-18', NULL, 1, '', '2025-12-18 03:03:22', '2025-12-18 03:03:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `perangkat_desa`
--

CREATE TABLE `perangkat_desa` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(150) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `jabatan_id` int UNSIGNED DEFAULT NULL,
  `pendidikan_id` int UNSIGNED DEFAULT NULL,
  `tmt_jabatan` date DEFAULT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `no_hp` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text,
  `foto_file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `perangkat_desa`
--

INSERT INTO `perangkat_desa` (`id`, `nama`, `nip`, `nik`, `jenis_kelamin`, `jabatan_id`, `pendidikan_id`, `tmt_jabatan`, `status_aktif`, `no_hp`, `email`, `alamat`, `foto_file`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Perangkat Desa 1', '1980010100000001', '6371010000000001', 'L', 1, 1, '2019-01-01', 1, '08220000001', 'perangkat1@batilai.desa.id', 'Jl. Contoh No. 1, Batilai', 'perangkat/1766022255_3a43278d6ea3554b3e26.jpeg', '2025-11-20 15:42:29', '2025-12-18 01:44:15', NULL),
(2, 'Perangkat Desa 2', '1980010100000002', '6371010000000002', 'P', 2, 2, '2020-01-01', 1, '08220000002', 'perangkat2@batilai.desa.id', 'Jl. Contoh No. 2, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(3, 'Perangkat Desa 3', '1980010100000003', '6371010000000003', 'L', 3, 3, '2021-01-01', 1, '08220000003', 'perangkat3@batilai.desa.id', 'Jl. Contoh No. 3, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(4, 'Perangkat Desa 4', '1980010100000004', '6371010000000004', 'P', 4, 4, '2022-01-01', 1, '08220000004', 'perangkat4@batilai.desa.id', 'Jl. Contoh No. 4, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(5, 'Perangkat Desa 5', '1980010100000005', '6371010000000005', 'L', 5, 5, '2018-01-01', 1, '08220000005', 'perangkat5@batilai.desa.id', 'Jl. Contoh No. 5, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(6, 'Perangkat Desa 6', '1980010100000006', '6371010000000006', 'P', 6, 6, '2019-01-01', 1, '08220000006', 'perangkat6@batilai.desa.id', 'Jl. Contoh No. 6, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(7, 'Perangkat Desa 7', '1980010100000007', '6371010000000007', 'L', 7, 7, '2020-01-01', 1, '08220000007', 'perangkat7@batilai.desa.id', 'Jl. Contoh No. 7, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(8, 'Perangkat Desa 8', '1980010100000008', '6371010000000008', 'P', 8, 8, '2021-01-01', 1, '08220000008', 'perangkat8@batilai.desa.id', 'Jl. Contoh No. 8, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(9, 'Perangkat Desa 9', '1980010100000009', '6371010000000009', 'L', 9, 9, '2022-01-01', 1, '08220000009', 'perangkat9@batilai.desa.id', 'Jl. Contoh No. 9, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(10, 'Perangkat Desa 10', '1980010100000010', '6371010000000010', 'P', 10, 1, '2018-01-01', 1, '08220000010', 'perangkat10@batilai.desa.id', 'Jl. Contoh No. 10, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(11, 'Perangkat Desa 11', '1980010100000011', '6371010000000011', 'L', 1, 2, '2019-01-01', 1, '08220000011', 'perangkat11@batilai.desa.id', 'Jl. Contoh No. 11, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(12, 'Perangkat Desa 12', '1980010100000012', '6371010000000012', 'P', 2, 3, '2020-01-01', 1, '08220000012', 'perangkat12@batilai.desa.id', 'Jl. Contoh No. 12, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(13, 'Perangkat Desa 13', '1980010100000013', '6371010000000013', 'L', 3, 4, '2021-01-01', 1, '08220000013', 'perangkat13@batilai.desa.id', 'Jl. Contoh No. 13, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(14, 'Perangkat Desa 14', '1980010100000014', '6371010000000014', 'P', 4, 5, '2022-01-01', 1, '08220000014', 'perangkat14@batilai.desa.id', 'Jl. Contoh No. 14, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(15, 'Perangkat Desa 15', '1980010100000015', '6371010000000015', 'L', 5, 6, '2018-01-01', 1, '08220000015', 'perangkat15@batilai.desa.id', 'Jl. Contoh No. 15, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(16, 'Perangkat Desa 16', '1980010100000016', '6371010000000016', 'P', 6, 7, '2019-01-01', 1, '08220000016', 'perangkat16@batilai.desa.id', 'Jl. Contoh No. 16, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(17, 'Perangkat Desa 17', '1980010100000017', '6371010000000017', 'L', 7, 8, '2020-01-01', 1, '08220000017', 'perangkat17@batilai.desa.id', 'Jl. Contoh No. 17, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(18, 'Perangkat Desa 18', '1980010100000018', '6371010000000018', 'P', 8, 9, '2021-01-01', 1, '08220000018', 'perangkat18@batilai.desa.id', 'Jl. Contoh No. 18, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(19, 'Perangkat Desa 19', '1980010100000019', '6371010000000019', 'L', 9, 1, '2022-01-01', 1, '08220000019', 'perangkat19@batilai.desa.id', 'Jl. Contoh No. 19, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(20, 'Perangkat Desa 20', '1980010100000020', '6371010000000020', 'P', 10, 2, '2018-01-01', 1, '08220000020', 'perangkat20@batilai.desa.id', 'Jl. Contoh No. 20, Batilai', NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `perangkat_jabatan_history`
--

CREATE TABLE `perangkat_jabatan_history` (
  `id` int UNSIGNED NOT NULL,
  `perangkat_id` int UNSIGNED NOT NULL,
  `jabatan_id` int UNSIGNED DEFAULT NULL,
  `nama_unit` varchar(150) DEFAULT NULL,
  `sk_nomor` varchar(100) DEFAULT NULL,
  `sk_tanggal` date DEFAULT NULL,
  `tmt_mulai` date DEFAULT NULL,
  `tmt_selesai` date DEFAULT NULL,
  `sk_file` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `perangkat_jabatan_history`
--

INSERT INTO `perangkat_jabatan_history` (`id`, `perangkat_id`, `jabatan_id`, `nama_unit`, `sk_nomor`, `sk_tanggal`, `tmt_mulai`, `tmt_selesai`, `sk_file`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 'Pemerintah Desa Batilai', 'SK-LAMA-1', '2016-01-01', '2016-01-01', '2018-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(2, 1, 1, 'Pemerintah Desa Batilai', 'SK-AKTIF-1', '2019-01-01', '2019-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(3, 2, 3, 'Pemerintah Desa Batilai', 'SK-LAMA-2', '2017-01-01', '2017-01-01', '2019-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(4, 2, 2, 'Pemerintah Desa Batilai', 'SK-AKTIF-2', '2020-01-01', '2020-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(5, 3, 4, 'Pemerintah Desa Batilai', 'SK-LAMA-3', '2015-01-01', '2015-01-01', '2017-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(6, 3, 3, 'Pemerintah Desa Batilai', 'SK-AKTIF-3', '2021-01-01', '2021-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(7, 4, 5, 'Pemerintah Desa Batilai', 'SK-LAMA-4', '2016-01-01', '2016-01-01', '2018-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(8, 4, 4, 'Pemerintah Desa Batilai', 'SK-AKTIF-4', '2018-01-01', '2018-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(9, 5, 6, 'Pemerintah Desa Batilai', 'SK-LAMA-5', '2017-01-01', '2017-01-01', '2019-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(10, 5, 5, 'Pemerintah Desa Batilai', 'SK-AKTIF-5', '2019-01-01', '2019-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(11, 6, 7, 'Pemerintah Desa Batilai', 'SK-LAMA-6', '2015-01-01', '2015-01-01', '2017-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(12, 6, 6, 'Pemerintah Desa Batilai', 'SK-AKTIF-6', '2020-01-01', '2020-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(13, 7, 8, 'Pemerintah Desa Batilai', 'SK-LAMA-7', '2016-01-01', '2016-01-01', '2018-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(14, 7, 7, 'Pemerintah Desa Batilai', 'SK-AKTIF-7', '2021-01-01', '2021-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(15, 8, 9, 'Pemerintah Desa Batilai', 'SK-LAMA-8', '2017-01-01', '2017-01-01', '2019-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(16, 8, 8, 'Pemerintah Desa Batilai', 'SK-AKTIF-8', '2018-01-01', '2018-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(17, 9, 10, 'Pemerintah Desa Batilai', 'SK-LAMA-9', '2015-01-01', '2015-01-01', '2017-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(18, 9, 9, 'Pemerintah Desa Batilai', 'SK-AKTIF-9', '2019-01-01', '2019-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(19, 10, 1, 'Pemerintah Desa Batilai', 'SK-LAMA-10', '2016-01-01', '2016-01-01', '2018-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(20, 10, 10, 'Pemerintah Desa Batilai', 'SK-AKTIF-10', '2020-01-01', '2020-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(21, 11, 2, 'Pemerintah Desa Batilai', 'SK-LAMA-11', '2017-01-01', '2017-01-01', '2019-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(22, 11, 1, 'Pemerintah Desa Batilai', 'SK-AKTIF-11', '2021-01-01', '2021-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(23, 12, 3, 'Pemerintah Desa Batilai', 'SK-LAMA-12', '2015-01-01', '2015-01-01', '2017-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(24, 12, 2, 'Pemerintah Desa Batilai', 'SK-AKTIF-12', '2018-01-01', '2018-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(25, 13, 4, 'Pemerintah Desa Batilai', 'SK-LAMA-13', '2016-01-01', '2016-01-01', '2018-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(26, 13, 3, 'Pemerintah Desa Batilai', 'SK-AKTIF-13', '2019-01-01', '2019-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(27, 14, 5, 'Pemerintah Desa Batilai', 'SK-LAMA-14', '2017-01-01', '2017-01-01', '2019-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(28, 14, 4, 'Pemerintah Desa Batilai', 'SK-AKTIF-14', '2020-01-01', '2020-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(29, 15, 6, 'Pemerintah Desa Batilai', 'SK-LAMA-15', '2015-01-01', '2015-01-01', '2017-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(30, 15, 5, 'Pemerintah Desa Batilai', 'SK-AKTIF-15', '2021-01-01', '2021-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(31, 16, 7, 'Pemerintah Desa Batilai', 'SK-LAMA-16', '2016-01-01', '2016-01-01', '2018-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(32, 16, 6, 'Pemerintah Desa Batilai', 'SK-AKTIF-16', '2018-01-01', '2018-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(33, 17, 8, 'Pemerintah Desa Batilai', 'SK-LAMA-17', '2017-01-01', '2017-01-01', '2019-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(34, 17, 7, 'Pemerintah Desa Batilai', 'SK-AKTIF-17', '2019-01-01', '2019-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(35, 18, 9, 'Pemerintah Desa Batilai', 'SK-LAMA-18', '2015-01-01', '2015-01-01', '2017-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(36, 18, 8, 'Pemerintah Desa Batilai', 'SK-AKTIF-18', '2020-01-01', '2020-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(37, 19, 10, 'Pemerintah Desa Batilai', 'SK-LAMA-19', '2016-01-01', '2016-01-01', '2018-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(38, 19, 9, 'Pemerintah Desa Batilai', 'SK-AKTIF-19', '2021-01-01', '2021-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(39, 20, 1, 'Pemerintah Desa Batilai', 'SK-LAMA-20', '2017-01-01', '2017-01-01', '2019-12-31', NULL, 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(40, 20, 10, 'Pemerintah Desa Batilai', 'SK-AKTIF-20', '2018-01-01', '2018-01-01', NULL, NULL, 'Jabatan aktif', '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(41, 12, 8, '123', '123', '3123-12-01', '0000-00-00', '0012-02-01', 'sk/1763653451_1694b9f6599c8a949076.pdf', 'aaa', '2025-11-20 15:44:11', '2025-11-20 15:44:21', '2025-11-20 15:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `perangkat_pendidikan_history`
--

CREATE TABLE `perangkat_pendidikan_history` (
  `id` int UNSIGNED NOT NULL,
  `perangkat_id` int UNSIGNED NOT NULL,
  `pendidikan_id` int UNSIGNED DEFAULT NULL,
  `nama_lembaga` varchar(150) DEFAULT NULL,
  `jurusan` varchar(150) DEFAULT NULL,
  `tahun_masuk` smallint DEFAULT NULL,
  `tahun_lulus` smallint DEFAULT NULL,
  `ijazah_file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `perangkat_pendidikan_history`
--

INSERT INTO `perangkat_pendidikan_history` (`id`, `perangkat_id`, `pendidikan_id`, `nama_lembaga`, `jurusan`, `tahun_masuk`, `tahun_lulus`, `ijazah_file`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 'SMA Negeri Contoh 2', 'IPA', 2006, 2009, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(2, 1, 1, 'Universitas Negeri Contoh 2', 'Ilmu Pemerintahan', 2009, 2013, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(3, 2, 3, 'SMA Negeri Contoh 3', 'IPA', 2007, 2010, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(4, 2, 2, 'Universitas Negeri Contoh 3', 'Ilmu Pemerintahan', 2010, 2014, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(5, 3, 4, 'SMA Negeri Contoh 1', 'IPA', 2008, 2011, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(6, 3, 3, 'Universitas Negeri Contoh 4', 'Ilmu Pemerintahan', 2011, 2015, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(7, 4, 5, 'SMA Negeri Contoh 2', 'IPA', 2009, 2012, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(8, 4, 4, 'Universitas Negeri Contoh 1', 'Ilmu Pemerintahan', 2012, 2016, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(9, 5, 6, 'SMA Negeri Contoh 3', 'IPA', 2005, 2008, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(10, 5, 5, 'Universitas Negeri Contoh 2', 'Ilmu Pemerintahan', 2008, 2012, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(11, 6, 7, 'SMA Negeri Contoh 1', 'IPA', 2006, 2009, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(12, 6, 6, 'Universitas Negeri Contoh 3', 'Ilmu Pemerintahan', 2009, 2013, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(13, 7, 8, 'SMA Negeri Contoh 2', 'IPA', 2007, 2010, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(14, 7, 7, 'Universitas Negeri Contoh 4', 'Ilmu Pemerintahan', 2010, 2014, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(15, 8, 9, 'SMA Negeri Contoh 3', 'IPA', 2008, 2011, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(16, 8, 8, 'Universitas Negeri Contoh 1', 'Ilmu Pemerintahan', 2011, 2015, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(17, 9, 1, 'SMA Negeri Contoh 1', 'IPA', 2009, 2012, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(18, 9, 9, 'Universitas Negeri Contoh 2', 'Ilmu Pemerintahan', 2012, 2016, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(19, 10, 2, 'SMA Negeri Contoh 2', 'IPA', 2005, 2008, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(20, 10, 1, 'Universitas Negeri Contoh 3', 'Ilmu Pemerintahan', 2008, 2012, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(21, 11, 3, 'SMA Negeri Contoh 3', 'IPA', 2006, 2009, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(22, 11, 2, 'Universitas Negeri Contoh 4', 'Ilmu Pemerintahan', 2009, 2013, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(23, 12, 4, 'SMA Negeri Contoh 1', 'IPA', 2007, 2010, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(24, 12, 3, 'Universitas Negeri Contoh 1', 'Ilmu Pemerintahan', 2010, 2014, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(25, 13, 5, 'SMA Negeri Contoh 2', 'IPA', 2008, 2011, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(26, 13, 4, 'Universitas Negeri Contoh 2', 'Ilmu Pemerintahan', 2011, 2015, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(27, 14, 6, 'SMA Negeri Contoh 3', 'IPA', 2009, 2012, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(28, 14, 5, 'Universitas Negeri Contoh 3', 'Ilmu Pemerintahan', 2012, 2016, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(29, 15, 7, 'SMA Negeri Contoh 1', 'IPA', 2005, 2008, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(30, 15, 6, 'Universitas Negeri Contoh 4', 'Ilmu Pemerintahan', 2008, 2012, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(31, 16, 8, 'SMA Negeri Contoh 2', 'IPA', 2006, 2009, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(32, 16, 7, 'Universitas Negeri Contoh 1', 'Ilmu Pemerintahan', 2009, 2013, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(33, 17, 9, 'SMA Negeri Contoh 3', 'IPA', 2007, 2010, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(34, 17, 8, 'Universitas Negeri Contoh 2', 'Ilmu Pemerintahan', 2010, 2014, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(35, 18, 1, 'SMA Negeri Contoh 1', 'IPA', 2008, 2011, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(36, 18, 9, 'Universitas Negeri Contoh 3', 'Ilmu Pemerintahan', 2011, 2015, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(37, 19, 2, 'SMA Negeri Contoh 2', 'IPA', 2009, 2012, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(38, 19, 1, 'Universitas Negeri Contoh 4', 'Ilmu Pemerintahan', 2012, 2016, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(39, 20, 3, 'SMA Negeri Contoh 3', 'IPA', 2005, 2008, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(40, 20, 2, 'Universitas Negeri Contoh 1', 'Ilmu Pemerintahan', 2008, 2012, NULL, '2025-11-20 15:42:29', '2025-11-20 15:42:29', NULL),
(41, 12, 2, 'ddd', 'dd', 2000, 2000, NULL, '2025-11-20 15:43:23', '2025-11-20 15:43:30', '2025-11-20 15:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `rt`
--

CREATE TABLE `rt` (
  `id` int UNSIGNED NOT NULL,
  `id_dusun` int DEFAULT NULL,
  `rw_id` int UNSIGNED NOT NULL,
  `no_rt` varchar(5) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `rt`
--

INSERT INTO `rt` (`id`, `id_dusun`, `rw_id`, `no_rt`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '9', 1, NULL, '2025-12-16 14:51:50', NULL),
(2, 1, 1, '17', 1, NULL, '2025-12-16 14:52:09', NULL),
(3, 1, 1, '3', 1, NULL, NULL, NULL),
(7, 2, 3, '02', 1, NULL, '2025-12-16 14:53:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rt_identitas`
--

CREATE TABLE `rt_identitas` (
  `id` bigint UNSIGNED NOT NULL,
  `rt_id` bigint UNSIGNED NOT NULL,
  `nama_ketua` varchar(150) DEFAULT NULL,
  `nik_ketua` varchar(30) DEFAULT NULL,
  `no_hp_ketua` varchar(30) DEFAULT NULL,
  `email_ketua` varchar(150) DEFAULT NULL,
  `alamat_sekretariat` text,
  `sk_nomor` varchar(100) DEFAULT NULL,
  `sk_tanggal` date DEFAULT NULL,
  `tmt_mulai` date DEFAULT NULL,
  `tmt_selesai` date DEFAULT NULL,
  `keterangan` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_identitas`
--

INSERT INTO `rt_identitas` (`id`, `rt_id`, `nama_ketua`, `nik_ketua`, `no_hp_ketua`, `email_ketua`, `alamat_sekretariat`, `sk_nomor`, `sk_tanggal`, `tmt_mulai`, `tmt_selesai`, `keterangan`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 'ssdf', '123123123123123123', '123123123', '123123@gmail.com', '12sdfsd', 'f213', '2025-12-17', '2025-12-17', '2025-12-17', 'sdf', 1, '2025-12-17 09:00:56', '2025-12-17 09:01:36', '2025-12-17 09:01:36');

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
) ;

--
-- Dumping data for table `rw`
--

INSERT INTO `rw` (`id`, `dusun_id`, `no_rw`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL),
(2, 1, 2, 1, NULL, NULL, NULL),
(3, 2, 1, 1, NULL, NULL, NULL),
(4, 2, 2, 1, NULL, NULL, NULL),
(5, 3, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sambutan_kades`
--

CREATE TABLE `sambutan_kades` (
  `id` int UNSIGNED NOT NULL,
  `judul` varchar(150) NOT NULL,
  `isi` text,
  `foto_kades` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `sambutan_kades`
--

INSERT INTO `sambutan_kades` (`id`, `judul`, `isi`, `foto_kades`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Sambutan Kepala Desa Batilai', 'Assalamualaikum warahmatullahi wabarakatuh,\r\n\r\nSelamat datang di website resmi Desa Batilai. Melalui media ini kami berharap informasi terkait pemerintahan desa, pelayanan, dan kegiatan masyarakat dapat tersampaikan dengan baik kepada seluruh warga.\r\n\r\nMari bersama-sama kita bangun Desa Batilai menjadi desa yang maju, mandiri, dan sejahtera.\r\n\r\nWassalamualaikum warahmatullahi wabarakatuh.', 'kades_1763565523.png', 1, '2025-11-19 15:12:42', '2025-11-19 15:18:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(150) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `no_hp` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'admin',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `no_hp`, `password_hash`, `role`, `is_active`, `last_login_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', 'admin@admin.com', 'admin@admin.com', '085245065929', '$2y$10$IB0FbQFRiyvlhW3oLXGCMejPSesHH3MHE9ItUYNTNX7dRWwr7jUum', 'superadmin', 1, '2025-12-23 06:56:47', '2025-12-18 03:18:20', '2025-12-23 06:56:47', NULL),
(2, 'Ibnu Fajar', 'ibnufajar', 'ibnufajar0104@gmail.com', '085245065929', '$2y$10$cTIB98bnxrxQAK5kosJfIeHaZxHUyFmuKPC.NtnDxDZXOrsz3NPu2', 'admin', 1, '2025-12-21 02:42:46', '2025-12-21 01:37:24', '2025-12-21 02:42:46', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_dokumen_slug` (`slug`),
  ADD KEY `idx_dokumen_kategori` (`kategori_id`),
  ADD KEY `idx_dokumen_tahun` (`tahun`),
  ADD KEY `idx_dokumen_active_tanggal` (`is_active`,`tanggal`);

--
-- Indexes for table `dokumen_kategori`
--
ALTER TABLE `dokumen_kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_dokumen_kategori_slug` (`slug`),
  ADD KEY `idx_dokumen_kategori_active_urutan` (`is_active`,`urutan`);

--
-- Indexes for table `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_galery_active` (`is_active`),
  ADD KEY `idx_galery_urut` (`urut`),
  ADD KEY `idx_galery_created` (`created_at`);

--
-- Indexes for table `jam_pelayanan`
--
ALTER TABLE `jam_pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak_desa`
--
ALTER TABLE `kontak_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_agama`
--
ALTER TABLE `master_agama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_bantuan`
--
ALTER TABLE `master_bantuan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_master_bantuan_nama` (`nama_bantuan`),
  ADD KEY `idx_master_bantuan_active` (`is_active`),
  ADD KEY `idx_master_bantuan_urut` (`urut`);

--
-- Indexes for table `master_jabatan`
--
ALTER TABLE `master_jabatan`
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
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

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
-- Indexes for table `penerima_bantuan`
--
ALTER TABLE `penerima_bantuan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_pb_unique` (`penduduk_id`,`bantuan_id`,`tahun`,`periode`),
  ADD KEY `idx_pb_penduduk` (`penduduk_id`),
  ADD KEY `idx_pb_bantuan` (`bantuan_id`),
  ADD KEY `idx_pb_tahun` (`tahun`),
  ADD KEY `idx_pb_status` (`status`);

--
-- Indexes for table `perangkat_desa`
--
ALTER TABLE `perangkat_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perangkat_jabatan_history`
--
ALTER TABLE `perangkat_jabatan_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perangkat_id` (`perangkat_id`),
  ADD KEY `jabatan_id` (`jabatan_id`);

--
-- Indexes for table `perangkat_pendidikan_history`
--
ALTER TABLE `perangkat_pendidikan_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perangkat_id` (`perangkat_id`);

--
-- Indexes for table `rt`
--
ALTER TABLE `rt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rt_rw_id_foreign` (`rw_id`);

--
-- Indexes for table `rt_identitas`
--
ALTER TABLE `rt_identitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rw`
--
ALTER TABLE `rw`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rw_dusun_id_foreign` (`dusun_id`);

--
-- Indexes for table `sambutan_kades`
--
ALTER TABLE `sambutan_kades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_users_username` (`username`),
  ADD UNIQUE KEY `uq_users_email` (`email`),
  ADD KEY `idx_users_role` (`role`),
  ADD KEY `idx_users_active` (`is_active`),
  ADD KEY `idx_users_deleted` (`deleted_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dokumen_kategori`
--
ALTER TABLE `dokumen_kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dusun`
--
ALTER TABLE `dusun`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `galery`
--
ALTER TABLE `galery`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jam_pelayanan`
--
ALTER TABLE `jam_pelayanan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kontak_desa`
--
ALTER TABLE `kontak_desa`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_agama`
--
ALTER TABLE `master_agama`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_bantuan`
--
ALTER TABLE `master_bantuan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_jabatan`
--
ALTER TABLE `master_jabatan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `penerima_bantuan`
--
ALTER TABLE `penerima_bantuan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `perangkat_desa`
--
ALTER TABLE `perangkat_desa`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `perangkat_jabatan_history`
--
ALTER TABLE `perangkat_jabatan_history`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `perangkat_pendidikan_history`
--
ALTER TABLE `perangkat_pendidikan_history`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `rt`
--
ALTER TABLE `rt`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rt_identitas`
--
ALTER TABLE `rt_identitas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rw`
--
ALTER TABLE `rw`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sambutan_kades`
--
ALTER TABLE `sambutan_kades`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `fk_dokumen_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `dokumen_kategori` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

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
