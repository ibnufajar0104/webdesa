-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 8.4.3 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk webdesa
-- CREATE DATABASE IF NOT EXISTS `webdesa` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
-- USE `webdesa`;

-- membuang struktur untuk table webdesa.aduan
CREATE TABLE IF NOT EXISTS `aduan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `wa` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `status` enum('pending','diproses','selesai','spam') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.aduan: ~2 rows (lebih kurang)
INSERT INTO `aduan` (`id`, `nama`, `email`, `wa`, `pesan`, `ip_address`, `user_agent`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'a', 'a@a.com', '08', 'ahur ahur ahur ahur', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'pending', '2026-01-31 16:38:39', '2026-01-31 16:43:50', '2026-01-31 16:43:50'),
	(2, 'tes', 'tes@gmail.com', '085245', 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nWhere does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'pending', '2026-01-31 16:44:55', '2026-01-31 16:44:55', NULL);

-- membuang struktur untuk table webdesa.banners
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
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
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.banners: ~3 rows (lebih kurang)
INSERT INTO `banners` (`id`, `title`, `subtitle`, `description`, `button_text`, `button_url`, `image`, `position`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'asd', 'asdasd', 'asdasd', '', '', '1763567776_df97308f120abedba650.png', 1, 'active', '2025-11-19 15:56:16', '2025-11-19 15:57:00', '2025-11-19 15:57:00'),
	(2, 'Website Resmi Desa Batilai', 'Transparan • Informatif • Melayani', 'Sumber informasi resmi tentang pemerintahan desa, layanan masyarakat, dan kegiatan pembangunan Desa Batilai', 'Jelajahi', '', '1769678874_8cf93f190fef54cb50a9.jpg', 1, 'active', '2025-12-21 16:23:41', '2026-01-31 11:37:43', NULL),
	(3, 'Melayani Masyarakat dengan Sepenuh Hati', 'Pemerintah Desa Batilai', 'Informasi, layanan, dan kegiatan desa dalam satu platform.', '', '', '1769678961_da7056d98a5f8464b7a6.jpg', 1, 'active', '2026-01-29 09:29:21', '2026-01-29 09:29:21', NULL);

-- membuang struktur untuk table webdesa.bpd
CREATE TABLE IF NOT EXISTS `bpd` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan_id` int unsigned DEFAULT NULL,
  `pendidikan_id` int unsigned DEFAULT NULL,
  `tmt_jabatan` date DEFAULT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `no_hp` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `foto_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.bpd: ~1 rows (lebih kurang)
INSERT INTO `bpd` (`id`, `nama`, `nik`, `jenis_kelamin`, `jabatan_id`, `pendidikan_id`, `tmt_jabatan`, `status_aktif`, `no_hp`, `email`, `alamat`, `foto_file`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Abdul Iman', '6301030108980001', 'L', 10, 4, NULL, 1, '085245065921', 'abdul@gmail.com', 'Jl. Takisung', 'bpd/1769775485_88e2c6f82575b92943bd.jpg', '2026-01-30 12:18:05', '2026-01-30 13:32:26', NULL);

-- membuang struktur untuk table webdesa.bpd_jabatan_history
CREATE TABLE IF NOT EXISTS `bpd_jabatan_history` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `perangkat_id` int unsigned NOT NULL,
  `jabatan_id` int unsigned DEFAULT NULL,
  `nama_unit` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sk_nomor` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sk_tanggal` date DEFAULT NULL,
  `tmt_mulai` date DEFAULT NULL,
  `tmt_selesai` date DEFAULT NULL,
  `sk_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perangkat_id` (`perangkat_id`),
  KEY `jabatan_id` (`jabatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.bpd_jabatan_history: ~2 rows (lebih kurang)
INSERT INTO `bpd_jabatan_history` (`id`, `perangkat_id`, `jabatan_id`, `nama_unit`, `sk_nomor`, `sk_tanggal`, `tmt_mulai`, `tmt_selesai`, `sk_file`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 10, 'Pemerintah Desa', '-', NULL, '2024-01-30', NULL, NULL, 'Auto-generated from BPD profile update', '2026-01-30 13:14:37', '2026-01-30 13:16:43', '2026-01-30 13:16:43'),
	(2, 1, 10, NULL, '-', NULL, NULL, NULL, NULL, '', '2026-01-30 13:17:00', '2026-01-30 13:17:00', NULL);

-- membuang struktur untuk table webdesa.bpd_pendidikan_history
CREATE TABLE IF NOT EXISTS `bpd_pendidikan_history` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `perangkat_id` int unsigned NOT NULL,
  `pendidikan_id` int unsigned DEFAULT NULL,
  `nama_lembaga` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jurusan` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_masuk` smallint DEFAULT NULL,
  `tahun_lulus` smallint DEFAULT NULL,
  `ijazah_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perangkat_id` (`perangkat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.bpd_pendidikan_history: ~4 rows (lebih kurang)
INSERT INTO `bpd_pendidikan_history` (`id`, `perangkat_id`, `pendidikan_id`, `nama_lembaga`, `jurusan`, `tahun_masuk`, `tahun_lulus`, `ijazah_file`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 2, 'MIN Pelaihari', '', 2010, 2016, 'ijazah/1769775544_a122db2b475bcc916770.pdf', '2026-01-30 12:19:04', '2026-01-30 13:14:22', '2026-01-30 13:14:22'),
	(2, 1, 8, '-', '-', NULL, NULL, NULL, '2026-01-30 13:14:37', '2026-01-30 13:16:51', '2026-01-30 13:16:51'),
	(3, 1, 4, 'UNLAM', 'Komputer', 2020, 2025, 'ijazah/1769779780_6af7311e197ba1a4bcea.pdf', '2026-01-30 13:17:00', '2026-01-30 13:31:24', NULL),
	(4, 1, 6, 'Politeknik', 'Teknik Informatika', 2025, 2026, NULL, '2026-01-30 13:32:07', '2026-01-30 13:32:26', '2026-01-30 13:32:26');

-- membuang struktur untuk table webdesa.demografi
CREATE TABLE IF NOT EXISTS `demografi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `jarak_ke_kabupaten` decimal(10,2) DEFAULT NULL,
  `luas_wilayah` decimal(10,2) DEFAULT NULL,
  `kepadatan` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.demografi: ~1 rows (lebih kurang)
INSERT INTO `demografi` (`id`, `jarak_ke_kabupaten`, `luas_wilayah`, `kepadatan`, `created_at`, `updated_at`) VALUES
	(1, 10.00, 10.00, 10.00, '2026-01-30 14:15:17', '2026-01-30 14:15:17');

-- membuang struktur untuk table webdesa.dokumen
CREATE TABLE IF NOT EXISTS `dokumen` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint unsigned NOT NULL,
  `judul` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` smallint DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `ringkasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL DEFAULT '0',
  `views` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_dokumen_slug` (`slug`),
  KEY `idx_dokumen_kategori` (`kategori_id`),
  KEY `idx_dokumen_tahun` (`tahun`),
  KEY `idx_dokumen_active_tanggal` (`is_active`,`tanggal`),
  CONSTRAINT `fk_dokumen_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `dokumen_kategori` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel webdesa.dokumen: ~4 rows (lebih kurang)
INSERT INTO `dokumen` (`id`, `kategori_id`, `judul`, `slug`, `nomor`, `tahun`, `tanggal`, `ringkasan`, `file_path`, `file_name`, `mime`, `size`, `views`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'Peraturan Tentang Desa nomor 100 tahun 2025', 'peraturan-tentang-desa-nomor-100-tahun-2025', '100', 2025, '2025-12-23', 'asdasd', '1766476431_208da2e405b64b0fbccc.pdf', 'IMG-SKP M. SYAFRIANDI NOOR 2024_0001.pdf', 'application/pdf', 2564560, 0, 1, '2025-12-23 07:53:51', '2026-01-30 07:47:57', '2026-01-30 07:47:57'),
	(2, 1, 'Peraturan Desa', 'peraturan-desa', '100', 2025, '2026-01-31', '', '1769833305_12af3f4b0cc4555029a7.pdf', 'Peraturan desa.pdf', 'application/pdf', 185452, 0, 1, '2026-01-31 04:21:45', '2026-01-31 04:21:45', NULL),
	(3, 3, 'Surar Edaran', 'surar-edaran', '', NULL, NULL, '', '1769833330_77ed9bc23e195819ddef.pdf', 'Surat edaran.pdf', 'application/pdf', 184527, 0, 1, '2026-01-31 04:22:10', '2026-01-31 04:22:10', NULL),
	(4, 5, 'APBdes Tahun 2025', 'apbdes-tahun-2025', '', NULL, '2026-01-31', '', '1769833354_0fdcd08c1bc373f6fd24.pdf', 'APBdes.pdf', 'application/pdf', 183682, 0, 1, '2026-01-31 04:22:34', '2026-01-31 04:22:34', NULL);

-- membuang struktur untuk table webdesa.dokumen_kategori
CREATE TABLE IF NOT EXISTS `dokumen_kategori` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `urutan` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_dokumen_kategori_slug` (`slug`),
  KEY `idx_dokumen_kategori_active_urutan` (`is_active`,`urutan`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel webdesa.dokumen_kategori: ~13 rows (lebih kurang)
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

-- membuang struktur untuk table webdesa.dusun
CREATE TABLE IF NOT EXISTS `dusun` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_dusun` varchar(100) NOT NULL,
  `kode_dusun` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.dusun: ~4 rows (lebih kurang)
INSERT INTO `dusun` (`id`, `nama_dusun`, `kode_dusun`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Dusun I', 'D001', 1, NULL, NULL, NULL),
	(2, 'Dusun II', 'D002', 1, NULL, NULL, NULL),
	(3, 'Dusun III', 'D003', 1, NULL, NULL, NULL),
	(4, '123', '123', 1, '2025-12-16 15:03:17', '2025-12-16 15:09:02', '2025-12-16 15:09:02');

-- membuang struktur untuk table webdesa.galery
CREATE TABLE IF NOT EXISTS `galery` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) DEFAULT NULL,
  `caption` text,
  `file_path` varchar(255) NOT NULL,
  `mime` varchar(80) DEFAULT NULL,
  `ukuran` bigint unsigned DEFAULT NULL,
  `urut` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_galery_active` (`is_active`),
  KEY `idx_galery_urut` (`urut`),
  KEY `idx_galery_created` (`created_at`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel webdesa.galery: 5 rows
/*!40000 ALTER TABLE `galery` DISABLE KEYS */;
INSERT INTO `galery` (`id`, `judul`, `caption`, `file_path`, `mime`, `ukuran`, `urut`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '4234', '2432', 'galery/1765962700_6477ba0f2f10806449fb.jpeg', 'image/jpeg', 445195, 1, 1, '2025-12-17 09:11:40', '2025-12-17 09:17:13', '2025-12-17 09:17:13'),
	(2, 'Gotong Royong Pembersihan Lingkungan', 'Kegiatan gotong royong bersama perangkat desa dan masyarakat dalam rangka menjaga kebersihan lingkungan serta mempererat kebersamaan warga. Dilaksanakan secara rutin sebagai bentuk kepedulian terhadap lingkungan desa.', 'galery/1769682035_3a679c4258bcf35c783c.jpg', 'image/jpeg', 40436, 0, 1, '2025-12-23 07:42:05', '2026-01-29 10:20:35', NULL),
	(3, 'Pelayanan Administrasi Kependudukan', 'Pelayanan administrasi kependudukan kepada masyarakat berjalan dengan tertib dan lancar. Pemerintah desa berkomitmen memberikan pelayanan yang cepat, transparan, dan mudah diakses oleh seluruh warga.', 'galery/1769682046_f156b33d27ed25c1199a.jpg', 'image/jpeg', 71226, 0, 1, '2025-12-23 07:42:27', '2026-01-29 10:20:46', NULL),
	(4, 'Rapat Koordinasi Lembaga Desa', 'Rapat koordinasi bersama lembaga desa membahas program kerja dan evaluasi kegiatan yang telah dilaksanakan. Diharapkan melalui koordinasi ini, seluruh program dapat berjalan lebih efektif dan tepat sasaran.', 'galery/1769682061_43db844037c0079b569f.jpg', 'image/jpeg', 52246, 0, 1, '2025-12-23 07:43:10', '2026-01-29 10:21:01', NULL),
	(5, 'Kegiatan Posyandu Balita', 'Pelaksanaan kegiatan Posyandu balita sebagai upaya pemantauan tumbuh kembang anak dan peningkatan kesehatan ibu dan anak. Kegiatan ini didukung oleh kader posyandu dan tenaga kesehatan setempat.', 'galery/1769682073_112e92d41e2dae456567.jpg', 'image/jpeg', 36795, 0, 1, '2025-12-23 07:43:31', '2026-01-29 10:21:13', NULL);
/*!40000 ALTER TABLE `galery` ENABLE KEYS */;

-- membuang struktur untuk table webdesa.jam_pelayanan
CREATE TABLE IF NOT EXISTS `jam_pelayanan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `hari` varchar(150) NOT NULL,
  `jam_mulai` varchar(20) DEFAULT NULL,
  `jam_selesai` varchar(20) DEFAULT NULL,
  `keterangan` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.jam_pelayanan: ~3 rows (lebih kurang)
INSERT INTO `jam_pelayanan` (`id`, `hari`, `jam_mulai`, `jam_selesai`, `keterangan`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Senin - Kamis', '08:00 WITA', '15:00 WITA', '', 1, '2025-11-19 15:18:19', '2026-01-29 12:21:07'),
	(2, 'Jumat', '08:00 WITA', '11:30 WITA', '', 1, '2026-01-29 12:21:37', '2026-01-29 12:21:37'),
	(3, 'Sabu - Minggu', '', '', '', 1, '2026-01-29 12:22:15', '2026-01-29 12:22:15');

-- membuang struktur untuk table webdesa.kontak_desa
CREATE TABLE IF NOT EXISTS `kontak_desa` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `alamat` text,
  `telepon` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL COMMENT 'Nomor WA format internasional, contoh: 628xxxxxxxxxx',
  `email` varchar(120) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `link_maps` text COMMENT 'URL Google Maps / embed link',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.kontak_desa: ~1 rows (lebih kurang)
INSERT INTO `kontak_desa` (`id`, `alamat`, `telepon`, `whatsapp`, `email`, `website`, `link_maps`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Batilai, Kecamatan Takisung, Kabupaten Tanah Laut, Kalimantan Selatan 70815', '085245065999', '085245065000', 'desabatilai@gmail.com', 'https://desabatilai.id', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.8999852530806!2d114.7044375!3d-3.8316329!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de6efe644643173%3A0xa4d9f3a90f2827db!2sKantor%20desa%20batilai!5e0!3m2!1sen!2sid!4v1769688064389!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 1, '2025-11-19 15:28:58', '2026-01-31 16:22:52');

-- membuang struktur untuk table webdesa.master_agama
CREATE TABLE IF NOT EXISTS `master_agama` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_agama` varchar(100) NOT NULL,
  `kode_agama` varchar(20) DEFAULT NULL,
  `urut` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=aktif,0=nonaktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.master_agama: ~6 rows (lebih kurang)
INSERT INTO `master_agama` (`id`, `nama_agama`, `kode_agama`, `urut`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Islam', '01', 1, 1, NULL, NULL, NULL),
	(2, 'Kristen', '02', 2, 1, NULL, NULL, NULL),
	(3, 'Katolik', '03', 3, 1, NULL, NULL, NULL),
	(4, 'Hindu', '04', 4, 1, NULL, NULL, NULL),
	(5, 'Buddha', '05', 5, 1, NULL, NULL, NULL),
	(6, 'Konghucu', '06', 6, 1, NULL, NULL, NULL);

-- membuang struktur untuk table webdesa.master_bantuan
CREATE TABLE IF NOT EXISTS `master_bantuan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_bantuan` varchar(150) NOT NULL,
  `kode_bantuan` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `urut` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_master_bantuan_nama` (`nama_bantuan`),
  KEY `idx_master_bantuan_active` (`is_active`),
  KEY `idx_master_bantuan_urut` (`urut`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel webdesa.master_bantuan: 3 rows
/*!40000 ALTER TABLE `master_bantuan` DISABLE KEYS */;
INSERT INTO `master_bantuan` (`id`, `nama_bantuan`, `kode_bantuan`, `is_active`, `urut`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'BLT', '01', 1, 1, NULL, NULL, NULL),
	(2, 'BPNT', '02', 1, 2, NULL, NULL, NULL),
	(3, 'PKH', '03', 1, 3, NULL, NULL, NULL);
/*!40000 ALTER TABLE `master_bantuan` ENABLE KEYS */;

-- membuang struktur untuk table webdesa.master_jabatan
CREATE TABLE IF NOT EXISTS `master_jabatan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(100) NOT NULL,
  `kode_jabatan` varchar(20) DEFAULT NULL,
  `urut` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.master_jabatan: ~10 rows (lebih kurang)
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

-- membuang struktur untuk table webdesa.master_pekerjaan
CREATE TABLE IF NOT EXISTS `master_pekerjaan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_pekerjaan` varchar(100) NOT NULL,
  `kode_pekerjaan` varchar(20) DEFAULT NULL,
  `urut` tinyint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.master_pekerjaan: ~11 rows (lebih kurang)
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

-- membuang struktur untuk table webdesa.master_pendidikan
CREATE TABLE IF NOT EXISTS `master_pendidikan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_pendidikan` varchar(100) NOT NULL,
  `kode_pendidikan` varchar(20) DEFAULT NULL,
  `urut` tinyint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.master_pendidikan: ~10 rows (lebih kurang)
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

-- membuang struktur untuk table webdesa.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int unsigned DEFAULT NULL,
  `label` varchar(150) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `target` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.menus: ~12 rows (lebih kurang)
INSERT INTO `menus` (`id`, `parent_id`, `label`, `url`, `sort_order`, `is_active`, `target`, `created_at`, `updated_at`) VALUES
	(3, NULL, 'Beranda', 'beranda', 1, 1, '_self', '2025-12-21 03:09:03', '2026-01-31 04:12:31'),
	(4, NULL, 'Statistik', '', 5, 1, '_blank', '2025-12-21 03:09:37', '2026-01-30 15:35:11'),
	(6, NULL, 'Profil Desa', '', 2, 1, '_self', '2026-01-30 15:29:31', '2026-01-30 15:35:11'),
	(7, 6, 'Tentang Desa', 'halaman/tentang-desa', 1, 1, '_self', '2026-01-30 15:29:50', '2026-01-30 15:35:11'),
	(8, 6, 'Visi Misi', 'halaman/visi-dan-misi-desa', 2, 1, '_self', '2026-01-30 15:30:17', '2026-01-30 15:35:11'),
	(9, 6, 'Sejarah Desa', 'halaman/sejarah-desa', 3, 1, '_self', '2026-01-30 15:31:21', '2026-01-30 15:35:11'),
	(10, 4, 'Penduduk', 'statistik/penduduk', 1, 1, '_self', '2026-01-30 15:33:21', '2026-01-30 15:35:11'),
	(11, 4, 'Penerima Bantuan', 'statistik/penerima-bantuan', 2, 1, '_self', '2026-01-30 15:33:55', '2026-01-30 15:35:11'),
	(12, NULL, 'Dokumen', 'dokumen', 4, 1, '_self', '2026-01-30 15:34:47', '2026-01-30 15:35:11'),
	(13, NULL, 'Berita', 'berita', 3, 1, '_self', '2026-01-30 15:35:03', '2026-01-30 15:35:31'),
	(14, NULL, 'Galeri', 'galeri', 6, 1, '_self', '2026-01-30 15:35:24', '2026-01-30 15:35:24'),
	(15, NULL, 'Kontak', 'kontak', 7, 1, '_self', '2026-01-31 19:27:37', '2026-01-31 19:27:37');

-- membuang struktur untuk table webdesa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.migrations: ~24 rows (lebih kurang)
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
	(20, '2025-12-23-011153', 'App\\Database\\Migrations\\CreateDokumenTables', 'default', 'App', 1766452407, 18),
	(21, '2026-01-30-161000', 'App\\Database\\Migrations\\AddNamaKadesToSambutan', 'default', 'App', 1769760502, 19),
	(22, '2026-01-30-162000', 'App\\Database\\Migrations\\CreateDemografi', 'default', 'App', 1769760956, 20),
	(24, '2026-01-30-201500', 'App\\Database\\Migrations\\CreateBpdTables', 'default', 'App', 1769775171, 21),
	(25, '2026-02-01-000000', 'App\\Database\\Migrations\\CreateAduanTable', 'default', 'App', 1769851040, 22);

-- membuang struktur untuk table webdesa.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) NOT NULL,
  `title` varchar(191) NOT NULL,
  `content` longtext,
  `status` enum('published','draft') NOT NULL DEFAULT 'published',
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.news: ~7 rows (lebih kurang)
INSERT INTO `news` (`id`, `slug`, `title`, `content`, `status`, `cover_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'sdfsdf', 'sdfsdf', '<p>tes <img src="http://localhost:8080/file/pages/img_691968dca87440.55551503.jpg" alt=""></p>', 'published', '1763272937_23feade193696f344af6.png', '2025-11-16 06:02:17', '2025-11-19 14:25:39', '2025-11-19 14:25:39'),
	(2, 'sss', 'sss', '<p>fff</p>', 'published', 'cover_69196ceb7c07f4.88195075.jpg', '2025-11-16 06:19:23', '2025-11-19 14:25:35', '2025-11-19 14:25:35'),
	(3, 'aaa', 'aaa', '<p>aaa</p>', 'published', NULL, '2025-11-19 14:29:28', '2025-11-19 14:29:41', '2025-11-19 14:29:41'),
	(4, 'aaaa', 'aaaa', '<p>aa</p>', 'published', '1763562646_5751ce4a0656df8444d4.png', '2025-11-19 14:30:46', '2025-11-19 14:31:04', '2025-11-19 14:31:04'),
	(5, 'musyawarah-pembangunan-desa-2025', 'Musyawarah Pembangunan Desa 2025', '<p><span>Kegiatan musyawarah pembangunan desa melibatkan warga untuk menentukan program prioritas...</span></p>', 'published', '1769681507_bfb7ca99a64b32cd9417.jpg', '2025-11-19 14:32:17', '2026-01-29 10:11:47', NULL),
	(6, 'gotong-royong-membersihkan-lingkungan', 'Gotong Royong Membersihkan Lingkungan', '<p><span>Warga desa bergotong royong menjaga kebersihan lingkungan untuk hidup lebih sehat...</span></p>', 'published', '1769681544_5d3bc446cff94fd9ef78.jpg', '2026-01-29 10:12:24', '2026-01-29 10:12:24', NULL),
	(7, 'pelatihan-umkm-untuk-warga-desa', 'Pelatihan UMKM untuk Warga Desa', '<p><span>Pelatihan untuk meningkatkan keterampilan dan ekonomi warga melalui UMKM...</span></p>', 'published', '1769681590_27db84072e5e2c214a00.jpg', '2026-01-29 10:12:51', '2026-01-29 10:13:10', NULL);

-- membuang struktur untuk table webdesa.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(150) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text,
  `status` varchar(20) NOT NULL DEFAULT 'published',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.pages: ~10 rows (lebih kurang)
INSERT INTO `pages` (`id`, `slug`, `title`, `content`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'res', 'tes', 'tes', 'published', '2025-11-15 03:51:37', '2025-11-15 04:55:44', '2025-11-15 04:55:44'),
	(2, 'fdgdf-dfgdfgdfg', 'fdgdf dfgdfgdfg', '<p>testign aja</p>', 'published', '2025-11-15 04:09:02', '2025-11-15 04:55:49', '2025-11-15 04:55:49'),
	(3, 'tes', 'tes', '<p>asasdasd</p>\n<p><img src="../../file/pages/1763257863_84d03fcaef312e547512.png" alt="" width="1463" height="2605"></p>', 'published', '2025-11-16 01:51:17', '2025-11-16 03:02:59', '2025-11-16 03:02:59'),
	(4, 'testing-again', 'testing again', '<p>testinggg<br><img src="http://localhost:8080/file/pages/1763260484_521e38813a2ebadc5400.png" alt=""></p>', 'published', '2025-11-16 02:31:47', '2025-11-16 03:03:05', '2025-11-16 03:03:05'),
	(5, 'hai', 'hai', '<p><img src="http://localhost:8080/file/pages/1763263318_1fdfec68e0bd3c9d0c68.png" alt=""></p>\r\n<p></p>', 'published', '2025-11-16 03:06:52', '2025-11-16 05:35:14', '2025-11-16 05:35:14'),
	(6, '23dasdasdasd', '23dasdasdasd', '<p>aaaa</p>\r\n<p><img src="http://localhost:8080/file/pages/img_69194765161645.37549608.jpg" alt=""></p>', 'draft', '2025-11-16 03:33:07', '2025-11-16 05:35:10', '2025-11-16 05:35:10'),
	(7, 'asdas', 'asdas', '<p>asdasdasdas</p>\r\n<p>&nbsp;<img src="http://localhost:8080/file/pages/img_69196609c67529.86719948.jpg" alt=""></p>', 'published', '2025-11-16 05:50:20', '2025-11-16 05:50:45', '2025-11-16 05:50:45'),
	(8, 'tentang-desa', 'Tentang Desa', '<p data-start="180" data-end="338">Desa ini merupakan wilayah administratif yang berada dalam satuan pemerintahan desa dan menjadi pusat aktivitas sosial, ekonomi, serta pelayanan masyarakat.</p>\r\n<p data-start="180" data-end="338"></p>\r\n<p data-start="180" data-end="338"><img src="http://webdesa.test/file/pages/img_697d86b8201b65.76967161.jpg" alt=""></p>\r\n<p data-start="345" data-end="512">Dengan potensi sumber daya alam dan sumber daya manusia yang dimiliki, desa terus berupaya melakukan pembangunan berkelanjutan demi meningkatkan kesejahteraan warga.</p>\r\n<p data-start="519" data-end="698">Pemerintah desa berkomitmen memberikan pelayanan yang transparan, akuntabel, dan berorientasi pada kebutuhan masyarakat, sejalan dengan prinsip tata kelola pemerintahan yang baik.</p>', 'published', '2025-12-23 06:58:55', '2026-01-31 11:36:12', NULL),
	(9, 'visi-dan-misi-desa', 'Visi dan Misi Desa', '<p><strong>Visi Desa</strong></p>\r\n<p>Terwujudnya Desa yang Maju, Mandiri, Sejahtera, dan Berdaya Saing.</p>\r\n<p data-start="832" data-end="845"><strong>Misi Desa</strong></p>\r\n<ol data-start="846" data-end="1125">\r\n<li data-start="846" data-end="924">\r\n<p data-start="849" data-end="924">Meningkatkan kualitas pelayanan publik yang cepat, tepat, dan transparan.</p>\r\n</li>\r\n<li data-start="925" data-end="992">\r\n<p data-start="928" data-end="992">Mendorong partisipasi aktif masyarakat dalam pembangunan desa.</p>\r\n</li>\r\n<li data-start="993" data-end="1054">\r\n<p data-start="996" data-end="1054">Mengelola potensi desa secara optimal dan berkelanjutan.</p>\r\n</li>\r\n<li data-start="1055" data-end="1125">\r\n<p data-start="1058" data-end="1125">Mewujudkan tata kelola pemerintahan desa yang bersih dan akuntabel</p>\r\n</li>\r\n</ol>', 'published', '2025-12-23 06:59:47', '2025-12-23 06:59:47', NULL),
	(10, 'sejarah-desa', 'Sejarah Desa', '<p data-start="189" data-end="498">Desa ini berdiri sebagai bagian dari proses perkembangan wilayah dan pemukiman masyarakat yang berlangsung secara turun-temurun. Pada awalnya, wilayah desa merupakan kawasan tempat bermukimnya beberapa keluarga yang menggantungkan hidup pada sektor pertanian, perkebunan, dan sumber daya alam di sekitarnya.</p>\r\n<p data-start="505" data-end="850">Seiring dengan bertambahnya jumlah penduduk, masyarakat mulai membentuk tata kehidupan bersama yang terorganisir, ditandai dengan adanya tokoh masyarakat, adat, serta kesepakatan bersama dalam mengelola wilayah dan kehidupan sosial. Dari proses inilah kemudian terbentuk pemerintahan desa sebagai satuan administratif yang diakui secara resmi.</p>\r\n<p data-start="505" data-end="850"></p>\r\n<p data-start="505" data-end="850"><img src="http://webdesa.test/file/pages/img_697d85fcaaa8c2.36273047.jpg" alt=""></p>\r\n<p data-start="857" data-end="1244">Dalam perkembangannya, desa terus mengalami perubahan dan kemajuan, baik dari sisi pemerintahan, pembangunan, maupun pelayanan kepada masyarakat. Dengan tetap menjunjung nilai-nilai kebersamaan, gotong royong, dan kearifan lokal, desa berkomitmen untuk terus berkembang menuju masa depan yang lebih baik tanpa meninggalkan sejarah dan jati diri yang telah diwariskan oleh para pendahulu.</p>', 'published', '2025-12-23 07:01:35', '2026-01-31 11:35:26', NULL);

-- membuang struktur untuk table webdesa.penduduk
CREATE TABLE IF NOT EXISTS `penduduk` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nik` char(16) NOT NULL,
  `no_kk` char(16) DEFAULT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL DEFAULT 'L',
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `golongan_darah` enum('A','B','AB','O','-') DEFAULT NULL,
  `agama_id` int DEFAULT NULL,
  `status_perkawinan` enum('Belum Kawin','Kawin','Cerai Hidup','Cerai Mati') NOT NULL DEFAULT 'Belum Kawin',
  `pendidikan_id` int unsigned DEFAULT NULL,
  `pekerjaan_id` int unsigned DEFAULT NULL,
  `kewarganegaraan` varchar(50) NOT NULL DEFAULT 'WNI',
  `status_penduduk` enum('Tetap','Pendatang') NOT NULL DEFAULT 'Tetap',
  `status_dasar` enum('Hidup','Meninggal','Pindah','Hilang') NOT NULL DEFAULT 'Hidup',
  `rt_id` int unsigned DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `desa` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `ktp_file` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik` (`nik`),
  KEY `penduduk_rt_id_foreign` (`rt_id`),
  KEY `penduduk_pendidikan_id_foreign` (`pendidikan_id`),
  KEY `penduduk_pekerjaan_id_foreign` (`pekerjaan_id`),
  KEY `no_kk` (`no_kk`),
  KEY `nama_lengkap` (`nama_lengkap`),
  KEY `status_penduduk` (`status_penduduk`),
  KEY `status_dasar` (`status_dasar`),
  CONSTRAINT `penduduk_pekerjaan_id_foreign` FOREIGN KEY (`pekerjaan_id`) REFERENCES `master_pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `penduduk_pendidikan_id_foreign` FOREIGN KEY (`pendidikan_id`) REFERENCES `master_pendidikan` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `penduduk_rt_id_foreign` FOREIGN KEY (`rt_id`) REFERENCES `rt` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.penduduk: ~62 rows (lebih kurang)
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
	(54, '2423454745745745', '2342423454745745', 'sfd', 'L', '4234', '2025-12-16', 'A', 1, 'Belum Kawin', NULL, NULL, 'WNI', 'Tetap', 'Hidup', NULL, '', 'Batilai', 'Pelaihari', '', '', NULL, 1, '2025-12-16 15:44:26', '2025-12-16 15:48:32', '2025-12-16 15:48:32'),
	(55, '7414070307129679', '3520652402021130', 'Dipa Siregar M.TI.', 'L', 'Gorontalo', '1973-02-10', 'O', 5, 'Belum Kawin', 3, 7, 'WNI', 'Tetap', 'Hidup', 2, 'Kpg. Ahmad Dahlan No. 597, Bau-Bau 84099, Jabar', 'Batilai', 'Takisung', '0798 4047 442', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(56, '9203272103079035', '1701314412113232', 'Bagas Gunarto', 'L', 'Sorong', '2005-08-22', '-', 2, 'Kawin', 3, 6, 'WNI', 'Tetap', 'Hidup', 1, 'Jr. Camar No. 195, Surakarta 14091, Bengkulu', 'Batilai', 'Takisung', '(+62) 815 7621 851', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(57, '3514080609109483', '1408134507230513', 'Bakijan Cayadi Firgantoro M.Farm', 'L', 'Administrasi Jakarta Barat', '1981-09-10', '-', 1, 'Kawin', 8, 3, 'WNI', 'Tetap', 'Hidup', 7, 'Psr. Wahid No. 654, Batu 24222, Riau', 'Batilai', 'Takisung', '0495 7766 3393', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(58, '1803577001200550', '9101652910060568', 'Cornelia Febi Laksmiwati', 'P', 'Tual', '2002-12-25', 'B', 2, 'Belum Kawin', 7, 5, 'WNI', 'Tetap', 'Hidup', 3, 'Ds. Monginsidi No. 436, Padangpanjang 61523, Sulbar', 'Batilai', 'Takisung', '0625 2086 5928', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(59, '7104495303984774', '3310420905073572', 'Lili Winarsih', 'P', 'Bontang', '1990-10-27', 'B', 6, 'Cerai Hidup', 10, 4, 'WNI', 'Tetap', 'Hidup', 2, 'Jln. Banceng Pondok No. 489, Yogyakarta 12368, Pabar', 'Batilai', 'Takisung', '(+62) 693 9888 5080', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(60, '3403050202977438', '9211982411162793', 'Darmanto Hardiansyah', 'L', 'Kediri', '1997-04-24', '-', 5, 'Belum Kawin', 8, 2, 'WNI', 'Tetap', 'Hidup', 1, 'Kpg. Aceh No. 438, Bandar Lampung 42905, Riau', 'Batilai', 'Takisung', '(+62) 486 7320 9577', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(61, '5105841610138921', '7471201708048879', 'Rizki Prayoga S.I.Kom', 'L', 'Pariaman', '2007-06-24', 'A', 1, 'Cerai Mati', 9, 9, 'WNI', 'Tetap', 'Hidup', 1, 'Gg. Yap Tjwan Bing No. 325, Tasikmalaya 54084, Papua', 'Batilai', 'Takisung', '(+62) 465 1735 130', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(62, '3673901606024349', '9205906603146809', 'Vinsen Saptono', 'L', 'Padang', '1990-07-24', 'O', 5, 'Cerai Mati', 3, 9, 'WNI', 'Tetap', 'Hidup', 3, 'Gg. Barasak No. 226, Gunungsitoli 58569, Malut', 'Batilai', 'Takisung', '0934 3978 748', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(63, '3307124402205314', '3578586110110566', 'Irsad Arsipatra Haryanto', 'L', 'Administrasi Jakarta Utara', '2007-12-22', 'AB', 1, 'Belum Kawin', 2, 5, 'WNI', 'Tetap', 'Hidup', 2, 'Gg. Moch. Yamin No. 844, Palopo 81680, Pabar', 'Batilai', 'Takisung', '0336 5012 983', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(64, '3519011312237094', '5308312405960330', 'Rahmi Putri Susanti M.M.', 'P', 'Surakarta', '1996-11-06', 'A', 2, 'Cerai Hidup', 4, 10, 'WNI', 'Tetap', 'Hidup', 7, 'Psr. Gajah No. 142, Tanjungbalai 20444, Kalteng', 'Batilai', 'Takisung', '(+62) 294 8651 0101', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(65, '1572471012123444', '7209410511186251', 'Candra Gunarto S.E.', 'L', 'Magelang', '1971-12-28', '-', 6, 'Cerai Hidup', 8, 9, 'WNI', 'Tetap', 'Hidup', 3, 'Ki. Ters. Pasir Koja No. 532, Ambon 69598, Sumbar', 'Batilai', 'Takisung', '(+62) 867 3692 310', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(66, '5108545302240179', '1811784102244944', 'Ade Nurdiyanti S.E.', 'P', 'Bontang', '1985-11-11', '-', 5, 'Cerai Hidup', 4, 9, 'WNI', 'Tetap', 'Hidup', 2, 'Kpg. Ronggowarsito No. 299, Lubuklinggau 93832, Gorontalo', 'Batilai', 'Takisung', '0936 0645 502', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(67, '6271582607004591', '3579834312178110', 'Ganjaran Napitupulu M.TI.', 'L', 'Batu', '1994-04-03', 'B', 3, 'Kawin', 6, 5, 'WNI', 'Tetap', 'Hidup', 7, 'Jr. Umalas No. 107, Pekanbaru 83511, Malut', 'Batilai', 'Takisung', '(+62) 462 5696 476', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(68, '7271830707176188', '3315516607150994', 'Asmuni Marsito Pradana M.Farm', 'L', 'Administrasi Jakarta Timur', '1990-05-21', 'AB', 5, 'Kawin', 5, 6, 'WNI', 'Tetap', 'Hidup', 7, 'Ds. Kyai Gede No. 299, Bandar Lampung 42490, Sulteng', 'Batilai', 'Takisung', '0646 4495 3295', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(69, '3303783103973867', '3328853009154687', 'Maida Yani Nuraini S.I.Kom', 'P', 'Tomohon', '1974-10-19', 'AB', 1, 'Cerai Mati', 1, 4, 'WNI', 'Tetap', 'Hidup', 2, 'Jln. Bagis Utama No. 815, Bitung 23000, Jambi', 'Batilai', 'Takisung', '0671 4975 4783', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(70, '7322151410072833', '9102741505116853', 'Ikhsan Bala Budiyanto', 'L', 'Padang', '1976-03-18', 'AB', 1, 'Belum Kawin', 7, 9, 'WNI', 'Tetap', 'Hidup', 2, 'Psr. Baung No. 558, Banjarbaru 61128, Bengkulu', 'Batilai', 'Takisung', '0784 9042 672', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(71, '3601060606024507', '7313905607226314', 'Ulva Hartati S.Kom', 'P', 'Padang', '1974-01-25', 'O', 4, 'Cerai Hidup', 6, 3, 'WNI', 'Tetap', 'Hidup', 1, 'Jr. Cemara No. 310, Serang 17970, Kepri', 'Batilai', 'Takisung', '(+62) 508 1170 6690', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(72, '1805962807045194', '7606086411137740', 'Cakrajiya Tamba', 'L', 'Lhokseumawe', '1971-04-28', 'AB', 2, 'Kawin', 7, 1, 'WNI', 'Tetap', 'Hidup', 7, 'Dk. Laswi No. 191, Malang 95715, NTT', 'Batilai', 'Takisung', '(+62) 943 2296 0107', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(73, '6171414603006627', '7210201812115365', 'Janet Winarsih', 'P', 'Serang', '2004-06-01', 'AB', 5, 'Cerai Mati', 3, 9, 'WNI', 'Tetap', 'Hidup', 7, 'Dk. Babah No. 996, Sawahlunto 18607, Jabar', 'Batilai', 'Takisung', '0830 7082 8504', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(74, '5303501908188842', '1303060403143519', 'Gina Anggraini S.Psi', 'P', 'Metro', '1997-04-04', 'A', 2, 'Belum Kawin', 3, 1, 'WNI', 'Tetap', 'Hidup', 2, 'Psr. Adisucipto No. 271, Tomohon 52504, Jatim', 'Batilai', 'Takisung', '(+62) 894 072 805', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(75, '3527946506108817', '6103121212013582', 'Zulfa Puspasari', 'P', 'Ternate', '1973-04-07', 'O', 6, 'Cerai Mati', 6, 9, 'WNI', 'Tetap', 'Hidup', 3, 'Jln. Daan No. 335, Depok 74634, Sumbar', 'Batilai', 'Takisung', '0335 6811 6237', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(76, '3505992307222733', '3576786008033870', 'Kania Pratiwi', 'P', 'Bandung', '1973-09-02', 'O', 2, 'Cerai Hidup', 1, 4, 'WNI', 'Tetap', 'Hidup', 3, 'Ds. Ketandan No. 179, Bandung 65892, Papua', 'Batilai', 'Takisung', '0277 2667 120', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(77, '1111870607024340', '6213884412159333', 'Kanda Hutapea', 'L', 'Bandar Lampung', '1987-01-13', 'O', 1, 'Belum Kawin', 3, 2, 'WNI', 'Tetap', 'Hidup', 1, 'Jr. Otto No. 721, Surabaya 97082, Malut', 'Batilai', 'Takisung', '(+62) 551 1595 3234', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(78, '1702796912100822', '5312204811020538', 'Respati Siregar', 'L', 'Manado', '1972-12-17', 'B', 3, 'Cerai Mati', 4, 4, 'WNI', 'Tetap', 'Hidup', 3, 'Gg. Moch. Ramdan No. 544, Pasuruan 23097, Bengkulu', 'Batilai', 'Takisung', '(+62) 27 3175 4475', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(79, '9205516103073182', '9112392705038000', 'Cornelia Salimah Puspasari', 'P', 'Kupang', '1995-10-11', 'AB', 1, 'Belum Kawin', 6, 2, 'WNI', 'Tetap', 'Hidup', 7, 'Psr. Siliwangi No. 381, Manado 80608, Bengkulu', 'Batilai', 'Takisung', '028 4500 787', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(80, '1375805808126725', '1116000306245521', 'Gawati Puspita', 'P', 'Subulussalam', '1997-01-10', 'B', 6, 'Cerai Hidup', 5, 1, 'WNI', 'Tetap', 'Hidup', 3, 'Kpg. Cokroaminoto No. 528, Makassar 47162, Papua', 'Batilai', 'Takisung', '(+62) 368 7847 710', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(81, '1410685309167512', '9212711008153293', 'Johan Jailani', 'L', 'Tegal', '1993-06-06', '-', 1, 'Belum Kawin', 6, 6, 'WNI', 'Tetap', 'Hidup', 2, 'Ki. Dahlia No. 173, Makassar 48587, Jateng', 'Batilai', 'Takisung', '0852 276 472', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(82, '3577221810134886', '1608076008060626', 'Gara Rajata', 'L', 'Kotamobagu', '1986-12-01', 'O', 5, 'Belum Kawin', 8, 10, 'WNI', 'Tetap', 'Hidup', 3, 'Jln. Elang No. 352, Sungai Penuh 45770, Sulut', 'Batilai', 'Takisung', '0447 2175 896', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(83, '9102684111029509', '5302867006988009', 'Paramita Ifa Zulaika M.M.', 'P', 'Pematangsiantar', '2003-04-09', '-', 5, 'Cerai Hidup', 10, 3, 'WNI', 'Tetap', 'Hidup', 1, 'Kpg. Jayawijaya No. 287, Jayapura 74915, Kalteng', 'Batilai', 'Takisung', '0375 0216 364', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(84, '6203774311123160', '1805272512994777', 'Bambang Taufik Nainggolan', 'L', 'Langsa', '1984-12-10', '-', 6, 'Cerai Hidup', 6, 2, 'WNI', 'Tetap', 'Hidup', 7, 'Gg. Ters. Kiaracondong No. 399, Sukabumi 37035, Banten', 'Batilai', 'Takisung', '(+62) 567 3246 5747', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(85, '6108140801192572', '7171456701198187', 'Mustika Natsir M.TI.', 'L', 'Tarakan', '1982-02-01', 'O', 1, 'Belum Kawin', 5, 7, 'WNI', 'Tetap', 'Hidup', 2, 'Kpg. Bambu No. 122, Administrasi Jakarta Pusat 26640, Kaltim', 'Batilai', 'Takisung', '0958 0595 678', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(86, '8171160905175802', '7308943008967042', 'Aslijan Sinaga', 'L', 'Tegal', '1972-03-29', 'B', 6, 'Belum Kawin', 4, 8, 'WNI', 'Tetap', 'Hidup', 7, 'Dk. Lembong No. 346, Makassar 16525, Pabar', 'Batilai', 'Takisung', '0455 2467 8352', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(87, '1606052701048962', '1208206310980927', 'Tantri Mulyani', 'P', 'Mataram', '1979-02-10', 'O', 5, 'Kawin', 6, 6, 'WNI', 'Tetap', 'Hidup', 2, 'Psr. Lembong No. 583, Pekalongan 75283, Jambi', 'Batilai', 'Takisung', '(+62) 546 9126 7766', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(88, '1309716412145681', '3309664305197318', 'Bajragin Simanjuntak', 'L', 'Langsa', '1971-03-14', 'AB', 3, 'Belum Kawin', 7, 5, 'WNI', 'Tetap', 'Hidup', 1, 'Ki. Warga No. 390, Magelang 69950, Sulbar', 'Batilai', 'Takisung', '(+62) 666 7835 648', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(89, '3204942504125989', '3216472810193023', 'Tami Utami', 'P', 'Gorontalo', '1979-08-11', 'AB', 4, 'Cerai Mati', 1, 2, 'WNI', 'Tetap', 'Hidup', 7, 'Jln. Abang No. 868, Langsa 77483, Sumut', 'Batilai', 'Takisung', '0323 7443 089', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(90, '8107651307980474', '1204215711041569', 'Pia Pertiwi', 'P', 'Palangka Raya', '1980-08-20', 'B', 1, 'Cerai Hidup', 1, 9, 'WNI', 'Tetap', 'Hidup', 1, 'Dk. Urip Sumoharjo No. 390, Bukittinggi 34465, Kaltara', 'Batilai', 'Takisung', '0585 2350 462', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(91, '3328671410102936', '5271981703997258', 'Melinda Utami', 'P', 'Tegal', '1989-11-27', 'O', 4, 'Cerai Hidup', 4, 6, 'WNI', 'Tetap', 'Hidup', 1, 'Ds. B.Agam Dlm No. 952, Administrasi Jakarta Pusat 66355, Sumsel', 'Batilai', 'Takisung', '(+62) 446 3239 659', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(92, '1215161402140528', '6171936905207942', 'Aurora Yuliana Astuti S.Gz', 'P', 'Jayapura', '2005-09-19', '-', 6, 'Cerai Hidup', 9, 7, 'WNI', 'Tetap', 'Hidup', 2, 'Kpg. Badak No. 208, Tidore Kepulauan 91193, Aceh', 'Batilai', 'Takisung', '(+62) 986 2962 792', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(93, '3572236304021740', '1219820110157115', 'Catur Prakasa', 'L', 'Tangerang', '2003-01-07', 'AB', 2, 'Belum Kawin', 6, 3, 'WNI', 'Tetap', 'Hidup', 1, 'Ds. Banda No. 400, Sawahlunto 33965, Sumsel', 'Batilai', 'Takisung', '(+62) 288 0558 295', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(94, '1813386104976186', '1704725205143300', 'Restu Fathonah Hariyah M.Pd', 'P', 'Solok', '1998-01-08', 'AB', 6, 'Cerai Hidup', 8, 5, 'WNI', 'Tetap', 'Hidup', 7, 'Jln. Bawal No. 225, Manado 27497, Jatim', 'Batilai', 'Takisung', '(+62) 25 1215 3661', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(95, '1210656003197789', '3673886805116888', 'Bakianto Manullang', 'L', 'Kediri', '1974-01-19', '-', 4, 'Cerai Mati', 6, 6, 'WNI', 'Tetap', 'Hidup', 2, 'Jln. Ujung No. 967, Tegal 17871, Papua', 'Batilai', 'Takisung', '(+62) 334 2198 461', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(96, '7210281908017039', '7408357103209937', 'Rendy Uwais', 'L', 'Magelang', '2009-01-10', '-', 1, 'Belum Kawin', 3, 10, 'WNI', 'Tetap', 'Hidup', 1, 'Ds. HOS. Cjokroaminoto (Pasirkaliki) No. 69, Bandung 22017, Jambi', 'Batilai', 'Takisung', '027 2608 074', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(97, '6305120402203470', '6172876110173601', 'Tira Rahayu Laksita S.Kom', 'P', 'Pekalongan', '1990-07-27', 'A', 5, 'Belum Kawin', 8, 2, 'WNI', 'Tetap', 'Hidup', 7, 'Ds. HOS. Cjokroaminoto (Pasirkaliki) No. 641, Tegal 23340, Bengkulu', 'Batilai', 'Takisung', '(+62) 889 454 276', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(98, '7412735402128235', '1377645701972112', 'Sakura Hilda Mayasari', 'P', 'Pontianak', '1982-11-26', 'AB', 5, 'Cerai Mati', 1, 8, 'WNI', 'Tetap', 'Hidup', 3, 'Ds. Barasak No. 558, Parepare 21101, Jatim', 'Batilai', 'Takisung', '(+62) 784 9822 4607', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(99, '3201282306210373', '9210754102006147', 'Saiful Kalim Budiyanto S.IP', 'L', 'Banda Aceh', '1994-06-24', 'A', 2, 'Cerai Hidup', 10, 8, 'WNI', 'Tetap', 'Hidup', 7, 'Kpg. Teuku Umar No. 831, Metro 78952, Babel', 'Batilai', 'Takisung', '(+62) 443 0793 087', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(100, '6212371506056372', '1171642212080256', 'Fathonah Prastuti S.Farm', 'P', 'Pekanbaru', '1975-10-11', '-', 4, 'Cerai Hidup', 3, 8, 'WNI', 'Tetap', 'Hidup', 2, 'Kpg. Yohanes No. 346, Banjarmasin 28549, Sulteng', 'Batilai', 'Takisung', '0880 8853 8299', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(101, '3305282409152451', '6203831405028221', 'Hafshah Haryanti', 'P', 'Tarakan', '1979-05-10', 'B', 2, 'Belum Kawin', 8, 5, 'WNI', 'Tetap', 'Hidup', 7, 'Kpg. Casablanca No. 70, Bogor 57769, Aceh', 'Batilai', 'Takisung', '(+62) 685 9351 849', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(102, '7209114704070859', '8201216705010515', 'Shakila Ratih Namaga', 'P', 'Banjarbaru', '2006-01-31', '-', 4, 'Kawin', 2, 7, 'WNI', 'Tetap', 'Hidup', 2, 'Ki. Basuki No. 43, Tual 92513, DKI', 'Batilai', 'Takisung', '(+62) 663 8143 538', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(103, '1701766010034872', '9171832312106197', 'Ganda Anggriawan', 'L', 'Batu', '1981-10-15', 'A', 1, 'Kawin', 3, 4, 'WNI', 'Tetap', 'Hidup', 2, 'Gg. Jakarta No. 520, Palopo 49632, Sumsel', 'Batilai', 'Takisung', '(+62) 804 2304 438', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL),
	(104, '1209302501129367', '1204894809965089', 'Kenari Warji Siregar S.E.I', 'L', 'Kendari', '2001-09-11', 'B', 5, 'Cerai Mati', 9, 6, 'WNI', 'Tetap', 'Hidup', 2, 'Kpg. Baranang Siang Indah No. 526, Bogor 20888, NTT', 'Batilai', 'Takisung', '0789 7737 754', NULL, NULL, 1, '2026-02-01 13:19:26', '2026-02-01 13:19:26', NULL);

-- membuang struktur untuk table webdesa.penerima_bantuan
CREATE TABLE IF NOT EXISTS `penerima_bantuan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `penduduk_id` bigint unsigned NOT NULL,
  `bantuan_id` bigint unsigned NOT NULL,
  `tahun` smallint unsigned NOT NULL,
  `periode` varchar(30) DEFAULT NULL,
  `tanggal_terima` date DEFAULT NULL,
  `nominal` decimal(14,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `keterangan` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_pb_unique` (`penduduk_id`,`bantuan_id`,`tahun`,`periode`),
  KEY `idx_pb_penduduk` (`penduduk_id`),
  KEY `idx_pb_bantuan` (`bantuan_id`),
  KEY `idx_pb_tahun` (`tahun`),
  KEY `idx_pb_status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel webdesa.penerima_bantuan: 50 rows
/*!40000 ALTER TABLE `penerima_bantuan` DISABLE KEYS */;
INSERT INTO `penerima_bantuan` (`id`, `penduduk_id`, `bantuan_id`, `tahun`, `periode`, `tanggal_terima`, `nominal`, `status`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 57, 3, 2025, 'Tahap 2', '2025-12-31', 300000.00, 1, 'Et ut sit nemo ea.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(2, 81, 2, 2026, 'Februari', '2026-12-31', 300000.00, 1, 'Vel debitis dolore eius.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(3, 95, 3, 2026, 'Triwulan 1', '2026-12-31', 600000.00, 1, 'Nulla nihil ratione nobis.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(4, 73, 1, 2025, 'Februari', '2025-12-31', 1200000.00, 1, 'Maxime asperiores accusantium saepe et.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(5, 66, 1, 2025, 'Januari', '2025-12-31', 900000.00, 1, 'Voluptatem ipsam est.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(6, 86, 3, 2025, 'Februari', '2025-12-31', 1200000.00, 1, 'Perspiciatis cumque.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(7, 48, 2, 2025, 'Triwulan 1', '2025-12-31', 300000.00, 1, 'Optio voluptas voluptatem vitae.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(8, 42, 3, 2025, 'Februari', '2025-12-31', 600000.00, 1, 'Aut voluptatum voluptatibus.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(9, 53, 1, 2025, 'Februari', '2025-12-31', 600000.00, 1, 'Reiciendis quaerat qui.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(10, 42, 2, 2026, 'Februari', '2026-12-31', 900000.00, 1, 'Porro sapiente dolore laboriosam.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(11, 95, 3, 2025, 'Tahap 1', '2025-12-31', 1200000.00, 1, 'Eligendi odit.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(12, 81, 1, 2025, 'Tahap 2', '2025-12-31', 300000.00, 1, 'Nihil praesentium officiis.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(13, 94, 1, 2025, 'Februari', '2025-12-31', 600000.00, 1, 'Aspernatur cupiditate recusandae architecto.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(14, 88, 2, 2025, 'Tahap 1', '2025-12-31', 300000.00, 1, 'Qui rerum qui.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(15, 57, 1, 2025, 'Tahap 1', '2025-12-31', 1200000.00, 1, 'Animi maiores.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(16, 96, 2, 2025, 'Tahap 2', '2025-12-31', 600000.00, 1, 'Repudiandae nam illo hic.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(17, 56, 1, 2026, 'Triwulan 1', '2026-12-31', 900000.00, 1, 'Velit inventore dolores.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(18, 75, 3, 2025, 'Januari', '2025-12-31', 600000.00, 1, 'Nostrum maxime est.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(19, 94, 2, 2026, 'Tahap 1', '2026-12-31', 600000.00, 1, 'Quis alias odit iusto nostrum.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(20, 83, 1, 2026, 'Tahap 2', '2026-12-31', 300000.00, 1, 'Rerum est consequatur consequatur.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(21, 65, 2, 2025, 'Januari', '2025-12-31', 600000.00, 1, 'Et odit neque.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(22, 61, 2, 2025, 'Tahap 2', '2025-12-31', 900000.00, 1, 'Quidem id ex.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(23, 72, 3, 2025, 'Februari', '2025-12-31', 1200000.00, 1, 'Et molestiae qui.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(24, 67, 1, 2025, 'Tahap 1', '2025-12-31', 900000.00, 1, 'Quas officia reprehenderit ut.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(25, 82, 2, 2025, 'Januari', '2025-12-31', 600000.00, 1, 'Omnis perspiciatis nobis aliquam.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(26, 69, 2, 2025, 'Triwulan 1', '2025-12-31', 300000.00, 1, 'Dolores distinctio et vel.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(27, 48, 1, 2025, 'Februari', '2025-12-31', 600000.00, 1, 'Aut non laudantium.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(28, 84, 3, 2026, 'Tahap 1', '2026-12-31', 900000.00, 1, 'Reprehenderit aut.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(29, 76, 2, 2026, 'Februari', '2026-12-31', 600000.00, 1, 'Deserunt harum sapiente.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(30, 67, 1, 2025, 'Tahap 2', '2025-12-31', 900000.00, 1, 'Quia asperiores aliquam in.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(31, 69, 1, 2026, 'Tahap 2', '2026-12-31', 1200000.00, 1, 'Maxime consequuntur iure facilis sed.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(32, 93, 3, 2026, 'Tahap 1', '2026-12-31', 1200000.00, 1, 'Quia esse voluptatum.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(33, 91, 3, 2026, 'Februari', '2026-12-31', 600000.00, 1, 'Rem qui mollitia deserunt.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(34, 90, 1, 2025, 'Maret', '2025-12-31', 1200000.00, 1, 'Nemo ipsa vel sapiente.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(35, 60, 3, 2025, 'Tahap 1', '2025-12-31', 300000.00, 1, 'Ut voluptas.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(36, 61, 2, 2025, 'Maret', '2025-12-31', 600000.00, 1, 'Culpa et qui delectus.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(37, 90, 1, 2026, 'Tahap 2', '2026-12-31', 900000.00, 1, 'Quia magnam deleniti et.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(38, 63, 1, 2025, 'Februari', '2025-12-31', 300000.00, 1, 'Nihil nisi quia.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(39, 48, 3, 2025, 'Tahap 2', '2025-12-31', 900000.00, 1, 'In earum dolor.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(40, 49, 3, 2026, 'Februari', '2026-12-31', 900000.00, 1, 'Distinctio rem qui et.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(41, 77, 2, 2025, 'Februari', '2025-12-31', 300000.00, 1, 'Et modi unde.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(42, 88, 2, 2026, 'Februari', '2026-12-31', 300000.00, 1, 'Quis esse maxime.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(43, 62, 1, 2026, 'Maret', '2026-12-31', 300000.00, 1, 'Corrupti quia itaque aut.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(44, 81, 2, 2025, 'Tahap 1', '2025-12-31', 300000.00, 1, 'Pariatur praesentium et qui.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(45, 34, 1, 2025, 'Februari', '2025-12-31', 600000.00, 1, 'Praesentium dolores voluptatem molestiae a.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(46, 53, 3, 2026, 'Maret', '2026-12-31', 900000.00, 1, 'Reiciendis deleniti architecto expedita.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(47, 96, 2, 2025, 'Maret', '2025-12-31', 300000.00, 1, 'Tenetur commodi adipisci nisi.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(48, 3, 3, 2025, 'Tahap 1', '2025-12-31', 300000.00, 1, 'Distinctio voluptas maxime sit.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(49, 73, 1, 2025, 'Tahap 2', '2025-12-31', 600000.00, 1, 'Soluta atque quibusdam.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL),
	(50, 85, 1, 2026, 'Triwulan 1', '2026-12-31', 900000.00, 1, 'In saepe quis distinctio illum.', '2026-02-01 13:47:19', '2026-02-01 13:47:19', NULL);
/*!40000 ALTER TABLE `penerima_bantuan` ENABLE KEYS */;

-- membuang struktur untuk table webdesa.perangkat_desa
CREATE TABLE IF NOT EXISTS `perangkat_desa` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `jabatan_id` int unsigned DEFAULT NULL,
  `pendidikan_id` int unsigned DEFAULT NULL,
  `tmt_jabatan` date DEFAULT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `no_hp` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text,
  `foto_file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.perangkat_desa: ~22 rows (lebih kurang)
INSERT INTO `perangkat_desa` (`id`, `nama`, `nip`, `nik`, `jenis_kelamin`, `jabatan_id`, `pendidikan_id`, `tmt_jabatan`, `status_aktif`, `no_hp`, `email`, `alamat`, `foto_file`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Perangkat Desa 1', '1980010100000001', '6371010000000001', 'L', 1, 7, '2019-01-01', 1, '08220000001', 'perangkat1@batilai.desa.id', 'Jl. Contoh No. 1, Batilai', 'perangkat/1769681083_1b369a67524c24b26340.jpg', '2025-11-20 15:42:29', '2026-01-30 13:56:02', NULL),
	(2, 'Perangkat Desa 2', '1980010100000002', '6371010000000002', 'P', 2, 2, '2020-01-01', 1, '08220000002', 'perangkat2@batilai.desa.id', 'Jl. Contoh No. 2, Batilai', 'perangkat/1769681098_054da23cf478b482afae.jpg', '2025-11-20 15:42:29', '2026-01-29 10:07:18', '2026-01-29 10:07:18'),
	(3, 'Perangkat Desa 3', '1980010100000003', '6371010000000003', 'L', 3, 3, '2021-01-01', 1, '08220000003', 'perangkat3@batilai.desa.id', 'Jl. Contoh No. 3, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:06:37', '2026-01-29 10:06:37'),
	(4, 'Perangkat Desa 4', '1980010100000004', '6371010000000004', 'P', 4, 4, '2022-01-01', 1, '08220000004', 'perangkat4@batilai.desa.id', 'Jl. Contoh No. 4, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:06:40', '2026-01-29 10:06:40'),
	(5, 'Perangkat Desa 5', '1980010100000005', '6371010000000005', 'L', 5, 5, '2018-01-01', 1, '08220000005', 'perangkat5@batilai.desa.id', 'Jl. Contoh No. 5, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:07:15', '2026-01-29 10:07:15'),
	(6, 'Perangkat Desa 6', '1980010100000006', '6371010000000006', 'P', 6, 6, '2019-01-01', 1, '08220000006', 'perangkat6@batilai.desa.id', 'Jl. Contoh No. 6, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:06:44', '2026-01-29 10:06:44'),
	(7, 'Perangkat Desa 7', '1980010100000007', '6371010000000007', 'L', 7, 7, '2020-01-01', 1, '08220000007', 'perangkat7@batilai.desa.id', 'Jl. Contoh No. 7, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:06:47', '2026-01-29 10:06:47'),
	(8, 'Perangkat Desa 8', '1980010100000008', '6371010000000008', 'P', 8, 8, '2021-01-01', 1, '08220000008', 'perangkat8@batilai.desa.id', 'Jl. Contoh No. 8, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:06:49', '2026-01-29 10:06:49'),
	(9, 'Perangkat Desa 9', '1980010100000009', '6371010000000009', 'L', 9, 9, '2022-01-01', 1, '08220000009', 'perangkat9@batilai.desa.id', 'Jl. Contoh No. 9, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:06:51', '2026-01-29 10:06:51'),
	(10, 'Perangkat Desa 10', '1980010100000010', '6371010000000010', 'P', 10, 1, '2018-01-01', 1, '08220000010', 'perangkat10@batilai.desa.id', 'Jl. Contoh No. 10, Batilai', 'perangkat/1769681028_0aeb20b0ed38c3df6806.jpg', '2025-11-20 15:42:29', '2026-01-29 10:04:17', '2026-01-29 10:04:17'),
	(11, 'Perangkat Desa 11', '1980010100000011', '6371010000000011', 'L', 1, 2, '2019-01-01', 1, '08220000011', 'perangkat11@batilai.desa.id', 'Jl. Contoh No. 11, Batilai', 'perangkat/1769681044_a63da637131c7199783a.jpg', '2025-11-20 15:42:29', '2026-01-29 10:04:14', '2026-01-29 10:04:14'),
	(12, 'Perangkat Desa 12', '1980010100000012', '6371010000000012', 'P', 2, 3, '2020-01-01', 1, '08220000012', 'perangkat12@batilai.desa.id', 'Jl. Contoh No. 12, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:04:20', '2026-01-29 10:04:20'),
	(13, 'Perangkat Desa 13', '1980010100000013', '6371010000000013', 'L', 3, 4, '2021-01-01', 1, '08220000013', 'perangkat13@batilai.desa.id', 'Jl. Contoh No. 13, Batilai', 'perangkat/1769681152_9370e99eb02bcdba12f0.jpg', '2025-11-20 15:42:29', '2026-01-29 10:05:52', NULL),
	(14, 'Perangkat Desa 14', '1980010100000014', '6371010000000014', 'P', 4, 5, '2022-01-01', 1, '08220000014', 'perangkat14@batilai.desa.id', 'Jl. Contoh No. 14, Batilai', 'perangkat/1769681171_c43b25571804b5fe368c.jpg', '2025-11-20 15:42:29', '2026-01-29 10:06:11', NULL),
	(15, 'Perangkat Desa 15', '1980010100000015', '6371010000000015', 'L', 5, 6, '2018-01-01', 1, '08220000015', 'perangkat15@batilai.desa.id', 'Jl. Contoh No. 15, Batilai', 'perangkat/1769681282_99e9e50dce7de495b605.jpg', '2025-11-20 15:42:29', '2026-01-29 10:08:02', NULL),
	(16, 'Perangkat Desa 16', '1980010100000016', '6371010000000016', 'P', 6, 7, '2019-01-01', 1, '08220000016', 'perangkat16@batilai.desa.id', 'Jl. Contoh No. 16, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:07:29', '2026-01-29 10:07:29'),
	(17, 'Perangkat Desa 17', '1980010100000017', '6371010000000017', 'L', 7, 8, '2020-01-01', 1, '08220000017', 'perangkat17@batilai.desa.id', 'Jl. Contoh No. 17, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:07:26', '2026-01-29 10:07:26'),
	(18, 'Perangkat Desa 18', '1980010100000018', '6371010000000018', 'P', 8, 9, '2021-01-01', 1, '08220000018', 'perangkat18@batilai.desa.id', 'Jl. Contoh No. 18, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:07:24', '2026-01-29 10:07:24'),
	(19, 'Perangkat Desa 19', '1980010100000019', '6371010000000019', 'L', 9, 1, '2022-01-01', 1, '08220000019', 'perangkat19@batilai.desa.id', 'Jl. Contoh No. 19, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:07:21', '2026-01-29 10:07:21'),
	(20, 'Perangkat Desa 20', '1980010100000020', '6371010000000020', 'P', 10, 2, '2018-01-01', 1, '08220000020', 'perangkat20@batilai.desa.id', 'Jl. Contoh No. 20, Batilai', NULL, '2025-11-20 15:42:29', '2026-01-29 10:06:32', '2026-01-29 10:06:32'),
	(21, 'Ibnu Fajar', '', '6301030108980001', 'L', 6, 6, '2024-01-30', 1, '085245066921', 'ibnufajar@gmail.com', 'Jl. Perintis 1 Pelaihari', 'perangkat/1769781816_44b2632fe386416cf084.jpg', '2026-01-30 14:01:46', '2026-01-30 14:03:36', NULL),
	(22, 'Muhammad Maulana', '', '6301030108980008', 'L', 7, 7, '2022-01-30', 1, '085245065999', '', '', 'perangkat/1769781907_c32937fb82db598140ff.jpg', '2026-01-30 14:05:07', '2026-01-30 14:05:23', NULL);

-- membuang struktur untuk table webdesa.perangkat_jabatan_history
CREATE TABLE IF NOT EXISTS `perangkat_jabatan_history` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `perangkat_id` int unsigned NOT NULL,
  `jabatan_id` int unsigned DEFAULT NULL,
  `nama_unit` varchar(150) DEFAULT NULL,
  `sk_nomor` varchar(100) DEFAULT NULL,
  `sk_tanggal` date DEFAULT NULL,
  `tmt_mulai` date DEFAULT NULL,
  `tmt_selesai` date DEFAULT NULL,
  `sk_file` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perangkat_id` (`perangkat_id`),
  KEY `jabatan_id` (`jabatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.perangkat_jabatan_history: ~44 rows (lebih kurang)
INSERT INTO `perangkat_jabatan_history` (`id`, `perangkat_id`, `jabatan_id`, `nama_unit`, `sk_nomor`, `sk_tanggal`, `tmt_mulai`, `tmt_selesai`, `sk_file`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 2, 'Pemerintah Desa Batilai', 'SK-LAMA-1', '2016-01-01', '2016-01-01', '2018-12-31', 'sk/1769781328_f1610c0e03a6ab3edad9.pdf', 'Jabatan sebelumnya', '2025-11-20 15:42:29', '2026-01-30 13:55:45', '2026-01-30 13:55:45'),
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
	(41, 12, 8, '123', '123', '3123-12-01', '0000-00-00', '0012-02-01', 'sk/1763653451_1694b9f6599c8a949076.pdf', 'aaa', '2025-11-20 15:44:11', '2025-11-20 15:44:21', '2025-11-20 15:44:21'),
	(42, 21, 6, 'Pemerintah Desa', NULL, NULL, '2024-01-30', NULL, NULL, 'Auto-generated from profile update', '2026-01-30 14:01:46', '2026-01-30 14:03:08', '2026-01-30 14:03:08'),
	(43, 21, 6, '', NULL, NULL, NULL, NULL, NULL, '', '2026-01-30 14:03:37', '2026-01-30 14:03:37', NULL),
	(44, 22, 7, '', NULL, NULL, NULL, NULL, NULL, '', '2026-01-30 14:05:08', '2026-01-30 14:05:08', NULL);

-- membuang struktur untuk table webdesa.perangkat_pendidikan_history
CREATE TABLE IF NOT EXISTS `perangkat_pendidikan_history` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `perangkat_id` int unsigned NOT NULL,
  `pendidikan_id` int unsigned DEFAULT NULL,
  `nama_lembaga` varchar(150) DEFAULT NULL,
  `jurusan` varchar(150) DEFAULT NULL,
  `tahun_masuk` smallint DEFAULT NULL,
  `tahun_lulus` smallint DEFAULT NULL,
  `ijazah_file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perangkat_id` (`perangkat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.perangkat_pendidikan_history: ~45 rows (lebih kurang)
INSERT INTO `perangkat_pendidikan_history` (`id`, `perangkat_id`, `pendidikan_id`, `nama_lembaga`, `jurusan`, `tahun_masuk`, `tahun_lulus`, `ijazah_file`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 2, 'SMA Negeri Contoh 2', 'IPA', 2006, 2009, NULL, '2025-11-20 15:42:29', '2026-01-30 13:55:51', '2026-01-30 13:55:51'),
	(2, 1, 7, 'Universitas Negeri Contoh 2', 'Ilmu Pemerintahan', 2009, 2013, 'ijazah/1769781317_5361e97c339977968c8e.pdf', '2025-11-20 15:42:29', '2026-01-30 13:56:02', NULL),
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
	(41, 12, 2, 'ddd', 'dd', 2000, 2000, NULL, '2025-11-20 15:43:23', '2025-11-20 15:43:30', '2025-11-20 15:43:30'),
	(42, 1, 8, 'tes', '1', 2010, 2025, 'ijazah/1769778428_534d8e28f1b1a884a1ec.pdf', '2026-01-30 13:07:08', '2026-01-30 13:54:53', '2026-01-30 13:54:53'),
	(43, 21, 6, '-', NULL, NULL, NULL, NULL, '2026-01-30 14:01:46', '2026-01-30 14:03:11', '2026-01-30 14:03:11'),
	(44, 21, 6, '-', NULL, NULL, NULL, NULL, '2026-01-30 14:03:37', '2026-01-30 14:03:37', NULL),
	(45, 22, 7, '-', NULL, NULL, NULL, NULL, '2026-01-30 14:05:23', '2026-01-30 14:05:23', NULL);

-- membuang struktur untuk table webdesa.rt
CREATE TABLE IF NOT EXISTS `rt` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_dusun` int DEFAULT NULL,
  `rw_id` int unsigned NOT NULL,
  `no_rt` varchar(5) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rt_rw_id_foreign` (`rw_id`),
  CONSTRAINT `rt_rw_id_foreign` FOREIGN KEY (`rw_id`) REFERENCES `rw` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.rt: ~4 rows (lebih kurang)
INSERT INTO `rt` (`id`, `id_dusun`, `rw_id`, `no_rt`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, '9', 1, NULL, '2025-12-16 14:51:50', NULL),
	(2, 1, 1, '17', 1, NULL, '2025-12-16 14:52:09', NULL),
	(3, 1, 1, '3', 1, NULL, NULL, NULL),
	(7, 2, 3, '02', 1, NULL, '2025-12-16 14:53:14', NULL);

-- membuang struktur untuk table webdesa.rt_identitas
CREATE TABLE IF NOT EXISTS `rt_identitas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rt_id` bigint unsigned NOT NULL,
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
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel webdesa.rt_identitas: 1 rows
/*!40000 ALTER TABLE `rt_identitas` DISABLE KEYS */;
INSERT INTO `rt_identitas` (`id`, `rt_id`, `nama_ketua`, `nik_ketua`, `no_hp_ketua`, `email_ketua`, `alamat_sekretariat`, `sk_nomor`, `sk_tanggal`, `tmt_mulai`, `tmt_selesai`, `keterangan`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 7, 'ssdf', '123123123123123123', '123123123', '123123@gmail.com', '12sdfsd', 'f213', '2025-12-17', '2025-12-17', '2025-12-17', 'sdf', 1, '2025-12-17 09:00:56', '2025-12-17 09:01:36', '2025-12-17 09:01:36');
/*!40000 ALTER TABLE `rt_identitas` ENABLE KEYS */;

-- membuang struktur untuk table webdesa.rw
CREATE TABLE IF NOT EXISTS `rw` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `dusun_id` int unsigned NOT NULL,
  `no_rw` tinyint unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rw_dusun_id_foreign` (`dusun_id`),
  CONSTRAINT `rw_dusun_id_foreign` FOREIGN KEY (`dusun_id`) REFERENCES `dusun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.rw: ~5 rows (lebih kurang)
INSERT INTO `rw` (`id`, `dusun_id`, `no_rw`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 1, NULL, NULL, NULL),
	(2, 1, 2, 1, NULL, NULL, NULL),
	(3, 2, 1, 1, NULL, NULL, NULL),
	(4, 2, 2, 1, NULL, NULL, NULL),
	(5, 3, 1, 1, NULL, NULL, NULL);

-- membuang struktur untuk table webdesa.sambutan_kades
CREATE TABLE IF NOT EXISTS `sambutan_kades` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) NOT NULL,
  `nama_kades` varchar(150) DEFAULT NULL,
  `isi` text,
  `foto_kades` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel webdesa.sambutan_kades: ~1 rows (lebih kurang)
INSERT INTO `sambutan_kades` (`id`, `judul`, `nama_kades`, `isi`, `foto_kades`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Sambutan Kepala Desa Batilai', 'Budi Santoso', 'Assalamualaikum warahmatullahi wabarakatuh,\r\n\r\nSelamat datang di website resmi Desa Batilai. Melalui media ini kami berharap informasi terkait pemerintahan desa, pelayanan, dan kegiatan masyarakat dapat tersampaikan dengan baik kepada seluruh warga.\r\n\r\nMari bersama-sama kita bangun Desa Batilai menjadi desa yang maju, mandiri, dan sejahtera.\r\n\r\nWassalamualaikum warahmatullahi wabarakatuh.', 'kades_1769680310.jpg', 1, '2025-11-19 15:12:42', '2026-01-30 08:09:23');

-- membuang struktur untuk table webdesa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_users_username` (`username`),
  UNIQUE KEY `uq_users_email` (`email`),
  KEY `idx_users_role` (`role`),
  KEY `idx_users_active` (`is_active`),
  KEY `idx_users_deleted` (`deleted_at`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel webdesa.users: 2 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nama`, `username`, `email`, `no_hp`, `password_hash`, `role`, `is_active`, `last_login_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Administrator', 'admin@admin.com', 'admin@admin.com', '085245065929', '$2y$10$IB0FbQFRiyvlhW3oLXGCMejPSesHH3MHE9ItUYNTNX7dRWwr7jUum', 'superadmin', 1, '2026-02-01 20:13:35', '2025-12-18 03:18:20', '2026-02-01 20:13:35', NULL),
	(2, 'Ibnu Fajar', 'ibnufajar', 'ibnufajar0104@gmail.com', '085245065929', '$2y$10$cTIB98bnxrxQAK5kosJfIeHaZxHUyFmuKPC.NtnDxDZXOrsz3NPu2', 'admin', 1, '2025-12-21 02:42:46', '2025-12-21 01:37:24', '2025-12-21 02:42:46', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
