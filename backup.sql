-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: webdesa
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `button_text` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'file gambar utama banner',
  `position` int NOT NULL DEFAULT '1' COMMENT 'urutan tampil',
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'asd','asdasd','asdasd','','','1763567776_df97308f120abedba650.png',1,'active','2025-11-19 15:56:16','2025-11-19 15:57:00','2025-11-19 15:57:00');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dusun`
--

DROP TABLE IF EXISTS `dusun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dusun` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_dusun` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_dusun` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dusun`
--

LOCK TABLES `dusun` WRITE;
/*!40000 ALTER TABLE `dusun` DISABLE KEYS */;
INSERT INTO `dusun` VALUES (1,'Dusun I','D001',1,NULL,NULL,NULL),(2,'Dusun II','D002',1,NULL,NULL,NULL),(3,'Dusun III','D003',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `dusun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jam_pelayanan`
--

DROP TABLE IF EXISTS `jam_pelayanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jam_pelayanan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `hari` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `jam_mulai` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jam_selesai` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jam_pelayanan`
--

LOCK TABLES `jam_pelayanan` WRITE;
/*!40000 ALTER TABLE `jam_pelayanan` DISABLE KEYS */;
INSERT INTO `jam_pelayanan` VALUES (1,'Senin - Jumat','08:00 WITA','15:00 WITA','Istirahat pukul 12:00 - 13:00 WITA',1,'2025-11-19 15:18:19','2025-11-19 15:32:59');
/*!40000 ALTER TABLE `jam_pelayanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontak_desa`
--

DROP TABLE IF EXISTS `kontak_desa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kontak_desa` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `alamat` text COLLATE utf8mb4_general_ci,
  `telepon` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `whatsapp` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Nomor WA format internasional, contoh: 628xxxxxxxxxx',
  `email` varchar(120) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `website` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link_maps` text COLLATE utf8mb4_general_ci COMMENT 'URL Google Maps / embed link',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontak_desa`
--

LOCK TABLES `kontak_desa` WRITE;
/*!40000 ALTER TABLE `kontak_desa` DISABLE KEYS */;
INSERT INTO `kontak_desa` VALUES (1,'Kantor Desa Batilai\r\nKecamatan Batulicin\r\nKabupaten Tanah Laut, Kalimantan Selatan','0512-123456','6281234567890','desabatilai@example.com','https://desabatilai.go.id','https://maps.google.com/?q=Desa+Batilai',1,'2025-11-19 15:28:58','2025-11-19 15:32:49');
/*!40000 ALTER TABLE `kontak_desa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_agama`
--

DROP TABLE IF EXISTS `master_agama`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_agama` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_agama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_agama` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urut` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=aktif,0=nonaktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_agama`
--

LOCK TABLES `master_agama` WRITE;
/*!40000 ALTER TABLE `master_agama` DISABLE KEYS */;
INSERT INTO `master_agama` VALUES (1,'Islam','01',1,1,NULL,NULL,NULL),(2,'Kristen','02',2,1,NULL,NULL,NULL),(3,'Katolik','03',3,1,NULL,NULL,NULL),(4,'Hindu','04',4,1,NULL,NULL,NULL),(5,'Buddha','05',5,1,NULL,NULL,NULL),(6,'Konghucu','06',6,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `master_agama` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_jabatan`
--

DROP TABLE IF EXISTS `master_jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_jabatan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_jabatan` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urut` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_jabatan`
--

LOCK TABLES `master_jabatan` WRITE;
/*!40000 ALTER TABLE `master_jabatan` DISABLE KEYS */;
INSERT INTO `master_jabatan` VALUES (1,'Kepala Desa','KADES',1,1,NULL,'2025-11-19 14:47:58',NULL),(2,'Sekretaris Desa','SEKDES',2,1,NULL,NULL,NULL),(3,'Kaur Umum dan Perencanaan','KAUR_UMUM',3,1,NULL,NULL,NULL),(4,'Kaur Keuangan','KAUR_KEU',4,1,NULL,NULL,NULL),(5,'Kasi Pemerintahan','KASI_PEM',5,1,NULL,NULL,NULL),(6,'Kasi Kesejahteraan','KASI_KESRA',6,1,NULL,NULL,NULL),(7,'Kasi Pelayanan','KASI_PEL',7,1,NULL,NULL,NULL),(8,'Kepala Dusun I','KADUS_1',8,1,NULL,NULL,NULL),(9,'Kepala Dusun II','KADUS_2',9,1,NULL,NULL,NULL),(10,'Staf Desa','STAF',10,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `master_jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_pekerjaan`
--

DROP TABLE IF EXISTS `master_pekerjaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_pekerjaan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_pekerjaan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_pekerjaan` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urut` tinyint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_pekerjaan`
--

LOCK TABLES `master_pekerjaan` WRITE;
/*!40000 ALTER TABLE `master_pekerjaan` DISABLE KEYS */;
INSERT INTO `master_pekerjaan` VALUES (1,'Belum/Tidak Bekerja','001',1,1,NULL,NULL,NULL),(2,'Pelajar/Mahasiswa','002',2,1,NULL,NULL,NULL),(3,'Ibu Rumah Tangga','003',3,1,NULL,NULL,NULL),(4,'Petani/Pekebun','004',4,1,NULL,NULL,NULL),(5,'Buruh Tani/Buruh Harian','005',5,1,NULL,NULL,NULL),(6,'Pedagang/Wiraswasta','006',6,1,NULL,NULL,NULL),(7,'PNS/ASN','007',7,1,NULL,NULL,NULL),(8,'TNI/Polri','008',8,1,NULL,NULL,NULL),(9,'Pensiunan','009',9,1,NULL,NULL,NULL),(10,'Lainnya','999',99,1,NULL,'2025-11-16 14:36:41',NULL),(11,'111111','123123',55,1,'2025-11-16 14:36:17','2025-11-16 14:37:00','2025-11-16 14:37:00');
/*!40000 ALTER TABLE `master_pekerjaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_pendidikan`
--

DROP TABLE IF EXISTS `master_pendidikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_pendidikan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_pendidikan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_pendidikan` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urut` tinyint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_pendidikan`
--

LOCK TABLES `master_pendidikan` WRITE;
/*!40000 ALTER TABLE `master_pendidikan` DISABLE KEYS */;
INSERT INTO `master_pendidikan` VALUES (1,'Tidak/Belum Sekolah','00',1,1,NULL,NULL,NULL),(2,'SD/Sederajat','01',2,1,NULL,NULL,NULL),(3,'SMP/Sederajat','02',3,1,NULL,NULL,NULL),(4,'SMA/Sederajat','03',4,1,NULL,NULL,NULL),(5,'Diploma I/II','04',5,1,NULL,NULL,NULL),(6,'Diploma III','05',6,1,NULL,NULL,NULL),(7,'Diploma IV/S1','06',7,1,NULL,NULL,NULL),(8,'S2','07',8,1,NULL,NULL,NULL),(9,'S3','08',9,1,NULL,'2025-11-16 14:28:35',NULL),(10,'aaa','11',12,1,'2025-11-16 14:28:18','2025-11-16 14:28:30','2025-11-16 14:28:30');
/*!40000 ALTER TABLE `master_pendidikan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025-01-01-000000','App\\Database\\Migrations\\CreatePagesTable','default','App',1763178327,1),(2,'2025-01-02-000000','App\\Database\\Migrations\\AddDeletedAtToPages','default','App',1763178608,2),(3,'2025-11-16-000001','App\\Database\\Migrations\\CreateNewsTable','default','App',1763272691,3),(4,'2025-11-16-000000','App\\Database\\Migrations\\CreatePendudukAndMasters','default','App',1763273607,4),(5,'2025-11-16-000002','App\\Database\\Migrations\\CreateMasterAgama','default','App',1763304656,5),(6,'2025-11-17-074512','App\\Database\\Migrations\\MasterAgama','default','App',1763305045,6),(7,'2025-11-16-000004','App\\Database\\Migrations\\SeedPendudukDummy20','default','App',1763307530,7),(8,'2025-11-19-000000','App\\Database\\Migrations\\CreateMasterJabatan','default','App',1763563403,8),(9,'2025-11-19-000001','App\\Database\\Migrations\\CreateSambutanKades','default','App',1763565162,9),(10,'2025-11-19-000002','App\\Database\\Migrations\\CreateJamPelayanan','default','App',1763565499,10),(11,'2025-11-19-000003','App\\Database\\Migrations\\CreateKontakDesa','default','App',1763566138,11),(12,'2025-11-19-000000','App\\Database\\Migrations\\CreateBannersTable','default','App',1763567737,12);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_general_ci,
  `status` enum('published','draft') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'published',
  `cover_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'sdfsdf','sdfsdf','<p>tes <img src=\"http://localhost:8080/file/pages/img_691968dca87440.55551503.jpg\" alt=\"\"></p>','published','1763272937_23feade193696f344af6.png','2025-11-16 06:02:17','2025-11-19 14:25:39','2025-11-19 14:25:39'),(2,'sss','sss','<p>fff</p>','published','cover_69196ceb7c07f4.88195075.jpg','2025-11-16 06:19:23','2025-11-19 14:25:35','2025-11-19 14:25:35'),(3,'aaa','aaa','<p>aaa</p>','published',NULL,'2025-11-19 14:29:28','2025-11-19 14:29:41','2025-11-19 14:29:41'),(4,'aaaa','aaaa','<p>aa</p>','published','1763562646_5751ce4a0656df8444d4.png','2025-11-19 14:30:46','2025-11-19 14:31:04','2025-11-19 14:31:04'),(5,'asd','asd','<p>asd<br><img src=\"http://localhost:8080/file/pages/img_691de3616685b8.30555406.jpg\" alt=\"\"></p>','published','cover_691de3d8c61228.64353158.jpg','2025-11-19 14:32:17','2025-11-19 15:35:52',NULL);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci,
  `status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'published',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'res','tes','tes','published','2025-11-15 03:51:37','2025-11-15 04:55:44','2025-11-15 04:55:44'),(2,'fdgdf-dfgdfgdfg','fdgdf dfgdfgdfg','<p>testign aja</p>','published','2025-11-15 04:09:02','2025-11-15 04:55:49','2025-11-15 04:55:49'),(3,'tes','tes','<p>asasdasd</p>\n<p><img src=\"../../file/pages/1763257863_84d03fcaef312e547512.png\" alt=\"\" width=\"1463\" height=\"2605\"></p>','published','2025-11-16 01:51:17','2025-11-16 03:02:59','2025-11-16 03:02:59'),(4,'testing-again','testing again','<p>testinggg<br><img src=\"http://localhost:8080/file/pages/1763260484_521e38813a2ebadc5400.png\" alt=\"\"></p>','published','2025-11-16 02:31:47','2025-11-16 03:03:05','2025-11-16 03:03:05'),(5,'hai','hai','<p><img src=\"http://localhost:8080/file/pages/1763263318_1fdfec68e0bd3c9d0c68.png\" alt=\"\"></p>\r\n<p></p>','published','2025-11-16 03:06:52','2025-11-16 05:35:14','2025-11-16 05:35:14'),(6,'23dasdasdasd','23dasdasdasd','<p>aaaa</p>\r\n<p><img src=\"http://localhost:8080/file/pages/img_69194765161645.37549608.jpg\" alt=\"\"></p>','draft','2025-11-16 03:33:07','2025-11-16 05:35:10','2025-11-16 05:35:10'),(7,'asdas','asdas','<p>asdasdasdas</p>\r\n<p>&nbsp;<img src=\"http://localhost:8080/file/pages/img_69196609c67529.86719948.jpg\" alt=\"\"></p>','published','2025-11-16 05:50:20','2025-11-16 05:50:45','2025-11-16 05:50:45');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penduduk`
--

DROP TABLE IF EXISTS `penduduk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penduduk` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nik` char(16) COLLATE utf8mb4_general_ci NOT NULL,
  `no_kk` char(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_lengkap` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'L',
  `tempat_lahir` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `golongan_darah` enum('A','B','AB','O','-') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agama_id` int DEFAULT NULL,
  `status_perkawinan` enum('Belum Kawin','Kawin','Cerai Hidup','Cerai Mati') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Belum Kawin',
  `pendidikan_id` int unsigned DEFAULT NULL,
  `pekerjaan_id` int unsigned DEFAULT NULL,
  `kewarganegaraan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'WNI',
  `status_penduduk` enum('Tetap','Pendatang') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Tetap',
  `status_dasar` enum('Hidup','Meninggal','Pindah','Hilang') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Hidup',
  `rt_id` int unsigned DEFAULT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `desa` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ktp_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penduduk`
--

LOCK TABLES `penduduk` WRITE;
/*!40000 ALTER TABLE `penduduk` DISABLE KEYS */;
INSERT INTO `penduduk` VALUES (3,'6301030108980003','6301030108980003','Ibnu Fajar','L','Pelaihari','1998-08-01',NULL,1,'Kawin',6,7,'WNI','Tetap','Hidup',1,'','Batilai','Takisung','','','ktp/1763300886_7e74350d5c07736fe522.pdf',1,'2025-11-16 13:47:24','2025-11-16 15:25:10',NULL),(34,'6372021001000034','6372025001000034','Ahmad Rifandi','L','','1992-04-11',NULL,1,'Belum Kawin',6,6,'WNI','Tetap','Hidup',1,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(35,'6372021002000035','6372025002000035','Siti Rohani','P','','1989-08-01',NULL,1,'Belum Kawin',4,4,'WNI','Tetap','Hidup',2,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(36,'6372021003000036','6372025003000036','Budi Hartono','L','','2000-10-22',NULL,1,'Belum Kawin',3,1,'WNI','Pendatang','Hidup',3,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(37,'6372021004000037','6372025004000037','Maria Elisabeth','P','','1996-02-14',NULL,2,'Belum Kawin',7,5,'WNI','Tetap','Hidup',4,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(38,'6372021005000038','6372025005000038','Ketut Aryana','L','','1978-06-07',NULL,4,'Belum Kawin',2,3,'WNI','Tetap','Hidup',4,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(39,'6372021006000039','6372025006000039','Yohanes Gamaliel','L','','1983-09-19',NULL,3,'Belum Kawin',6,5,'WNI','Tetap','Hidup',5,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(40,'6372021007000040','6372025007000040','Dewi Lestari','P','','1994-11-03',NULL,1,'Belum Kawin',5,2,'WNI','Pendatang','Hidup',6,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(41,'6372021008000041','6372025008000041','Gusti Ayu Pratiwi','P','','1999-01-28',NULL,4,'Belum Kawin',4,6,'WNI','Pendatang','Hidup',2,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(42,'6372021009000042','6372025009000042','Slamet Riyadi','L','','1985-12-12',NULL,1,'Belum Kawin',6,6,'WNI','Tetap','Hidup',3,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(43,'6372021010000043','6372025010000043','Paulus Andika','L','','1974-07-30',NULL,3,'Belum Kawin',4,4,'WNI','Tetap','Hidup',6,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(44,'6372021011000044','6372025011000044','Nur Aisyah','P','','2002-03-21',NULL,1,'Belum Kawin',4,2,'WNI','Pendatang','Hidup',5,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(45,'6372021012000045','6372025012000045','Adi Prasetyo','L','','1981-10-02',NULL,1,'Belum Kawin',2,3,'WNI','Tetap','Hidup',4,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(46,'6372021013000046','6372025013000046','Kartini Sari','P','','1997-09-14',NULL,1,'Belum Kawin',6,5,'WNI','Tetap','Hidup',5,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(47,'6372021014000047','6372025014000047','Luh Putu Ayuni','P','','1993-01-16',NULL,4,'Belum Kawin',4,6,'WNI','Pendatang','Hidup',2,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(48,'6372021015000048','6372025015000048','Novita Anggreani','P','','2001-12-09',NULL,1,'Belum Kawin',3,2,'WNI','Tetap','Hidup',3,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:56:52','2025-11-16 15:56:52'),(49,'6372021016000049','6372025016000049','Herman Gunawan','L','','1980-05-05',NULL,2,'Belum Kawin',4,6,'WNI','Tetap','Hidup',1,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(50,'6372021017000050','6372025017000050','Nanda Oktaviani','P','','1998-04-27',NULL,1,'Belum Kawin',7,6,'WNI','Pendatang','Hidup',6,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(51,'6372021018000051','6372025018000051','Rama Wijaya','L','','1979-02-10',NULL,1,'Belum Kawin',5,3,'WNI','Tetap','Hidup',4,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL),(52,'6372021019000052','6372025019000052','Agus Maulana','L','','1991-09-17',NULL,1,'Belum Kawin',6,6,'WNI','Pendatang','Hidup',1,'','Batilai','Takisung','','',NULL,1,'2025-11-16 15:38:50','2025-11-16 15:39:26',NULL),(53,'6372021020000053','6372025020000053','Mega Aprilia','P','','2003-07-18',NULL,1,'Belum Kawin',4,2,'WNI','Tetap','Hidup',2,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-11-16 15:38:50','2025-11-16 15:38:50',NULL);
/*!40000 ALTER TABLE `penduduk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rt`
--

DROP TABLE IF EXISTS `rt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rt` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `rw_id` int unsigned NOT NULL,
  `no_rt` tinyint unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rt_rw_id_foreign` (`rw_id`),
  CONSTRAINT `rt_rw_id_foreign` FOREIGN KEY (`rw_id`) REFERENCES `rw` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rt`
--

LOCK TABLES `rt` WRITE;
/*!40000 ALTER TABLE `rt` DISABLE KEYS */;
INSERT INTO `rt` VALUES (1,1,1,1,NULL,NULL,NULL),(2,1,2,1,NULL,NULL,NULL),(3,1,3,1,NULL,NULL,NULL),(4,2,1,1,NULL,NULL,NULL),(5,2,2,1,NULL,NULL,NULL),(6,3,1,1,NULL,NULL,NULL),(7,3,2,1,NULL,NULL,NULL),(8,4,1,1,NULL,NULL,NULL),(9,5,1,1,NULL,NULL,NULL),(10,5,2,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `rt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rw`
--

DROP TABLE IF EXISTS `rw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rw` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rw`
--

LOCK TABLES `rw` WRITE;
/*!40000 ALTER TABLE `rw` DISABLE KEYS */;
INSERT INTO `rw` VALUES (1,1,1,1,NULL,NULL,NULL),(2,1,2,1,NULL,NULL,NULL),(3,2,1,1,NULL,NULL,NULL),(4,2,2,1,NULL,NULL,NULL),(5,3,1,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `rw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sambutan_kades`
--

DROP TABLE IF EXISTS `sambutan_kades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sambutan_kades` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `isi` text COLLATE utf8mb4_general_ci,
  `foto_kades` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sambutan_kades`
--

LOCK TABLES `sambutan_kades` WRITE;
/*!40000 ALTER TABLE `sambutan_kades` DISABLE KEYS */;
INSERT INTO `sambutan_kades` VALUES (1,'Sambutan Kepala Desa Batilai','Assalamualaikum warahmatullahi wabarakatuh,\r\n\r\nSelamat datang di website resmi Desa Batilai. Melalui media ini kami berharap informasi terkait pemerintahan desa, pelayanan, dan kegiatan masyarakat dapat tersampaikan dengan baik kepada seluruh warga.\r\n\r\nMari bersama-sama kita bangun Desa Batilai menjadi desa yang maju, mandiri, dan sejahtera.\r\n\r\nWassalamualaikum warahmatullahi wabarakatuh.','kades_1763565523.png',1,'2025-11-19 15:12:42','2025-11-19 15:18:43');
/*!40000 ALTER TABLE `sambutan_kades` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-20  0:09:13
