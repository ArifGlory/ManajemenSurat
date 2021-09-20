/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.11-MariaDB : Database - qrcodelp_new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`qrcodelp_new` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `qrcodelp_new`;

/*Table structure for table `detail_surat_masuk` */

DROP TABLE IF EXISTS `detail_surat_masuk`;

CREATE TABLE `detail_surat_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sm_fk` int(11) DEFAULT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `kepada` varchar(100) DEFAULT NULL,
  `catatan_disposisi` varchar(250) DEFAULT NULL,
  `status` enum('diteruskan','dihimpun','tindak lanjut') DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sm_fk` (`id_sm_fk`),
  CONSTRAINT `detail_surat_masuk_ibfk_1` FOREIGN KEY (`id_sm_fk`) REFERENCES `tbl_surat_masuk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

/*Data for the table `detail_surat_masuk` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `log_Id` int(11) NOT NULL AUTO_INCREMENT,
  `log_Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `log_IdUser` int(11) unsigned NOT NULL,
  `log_Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`log_Id`),
  KEY `log_id_user` (`log_IdUser`)
) ENGINE=InnoDB AUTO_INCREMENT=439 DEFAULT CHARSET=latin1;

/*Data for the table `logs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `setting_Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting_Label` varchar(100) DEFAULT NULL,
  `setting_Key` varchar(50) DEFAULT NULL,
  `setting_Value` text DEFAULT NULL,
  `setting_Type` varchar(50) DEFAULT NULL,
  `setting_Updated` datetime DEFAULT NULL,
  PRIMARY KEY (`setting_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `settings` */

insert  into `settings`(`setting_Id`,`setting_Label`,`setting_Key`,`setting_Value`,`setting_Type`,`setting_Updated`) values 
(1,'LOGO','logo','1628148232917.png','gambar','2021-08-05 14:23:52'),
(2,'JUDUL','judul','Aplikasi Kode QR pada berkas Biro Administrasi Pimpinan Setda Provinsi Lampung','textfield','2021-08-05 13:29:17'),
(3,'DESKRIPSI','deskripsi','sistem dirancang untuk pengarsipan digital dan penambahan QRCode pada surat agar terdapat akses langsung untuk melihat berkas','textarea','2021-08-05 13:24:17'),
(4,'KEYWORD','keyword','qrcode, digital, pemprov, lampung','textfield','2021-08-05 13:24:17'),
(5,'EMAIL','email','pemerintahprovinsilampung@gmail.com','email','2021-08-05 13:24:17'),
(6,'NO TELP','notelepon','081930087002','number','2021-08-05 13:24:17'),
(7,'NAMA APP','nama_app','QRCode Digital','textfield','2021-08-05 13:24:17'),
(8,'ALAMAT','alamat','Jalan Wolter Monginsidi No. 69, Teluk Betung Utara (Komplek Pemprov. Lampung)','textarea','2021-08-05 13:24:17'),
(9,'AUTHOR','author','TIM IT Pemprov. Lampung','textfield','2021-08-05 13:24:17'),
(10,'AREA','area','Pemerintah Provinsi Lampung','textfield','2021-08-05 13:24:17'),
(11,'FAVICON','favicon','1628144706201.ico','favicon','2021-08-05 13:25:06'),
(16,'PERNYATAAN VERIFIKASI','pernyataan_verifikasi','Dokumen Telah Diverifikasi','textfield','2021-08-05 13:31:28'),
(18,'BANNER LOGIN','banner_login','1628148627347.jpg','gambar','2021-08-05 14:30:27');

/*Table structure for table `tbl_jenis_ttd` */

DROP TABLE IF EXISTS `tbl_jenis_ttd`;

CREATE TABLE `tbl_jenis_ttd` (
  `id_jenis_ttd` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_ttd` varchar(255) NOT NULL,
  `cert` varchar(250) DEFAULT NULL,
  `priv_key` varchar(250) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id_jenis_ttd`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jenis_ttd` */

insert  into `tbl_jenis_ttd`(`id_jenis_ttd`,`jenis_ttd`,`cert`,`priv_key`,`active`,`created_at`,`created_by`,`updated_at`,`updated_by`) values 
(7,'Gubernur',NULL,NULL,1,'2021-08-06 13:36:44',1,'2021-08-06 13:36:44',1),
(8,'Wakil Gubernur',NULL,NULL,1,'2019-10-07 14:32:08',1,'2019-10-07 14:32:08',1),
(9,'Sekretaris Daerah',NULL,NULL,1,'2019-10-07 14:31:57',1,'2019-10-07 14:31:57',1),
(11,'Asisten Pemerintahan dan Kesra',NULL,NULL,1,'2019-10-07 14:32:38',1,'2019-10-07 14:32:38',1),
(12,'Asisten Perekonomian dan Pembangunan',NULL,NULL,1,'2019-10-07 14:32:55',1,'2019-10-07 14:32:55',1),
(13,'Asisten Administrasi Umum',NULL,NULL,1,'2021-09-10 14:46:24',1,'2021-08-24 10:14:03',1);

/*Table structure for table `tbl_opd` */

DROP TABLE IF EXISTS `tbl_opd`;

CREATE TABLE `tbl_opd` (
  `id_opd` int(11) NOT NULL AUTO_INCREMENT,
  `nama_opd` varchar(255) NOT NULL,
  `alias_opd` varchar(100) NOT NULL,
  `alamat_opd` varchar(255) DEFAULT NULL,
  `email_opd` varchar(255) DEFAULT NULL,
  `notelepon_opd` varchar(20) DEFAULT NULL,
  `active` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_opd`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_opd` */

insert  into `tbl_opd`(`id_opd`,`nama_opd`,`alias_opd`,`alamat_opd`,`email_opd`,`notelepon_opd`,`active`,`created_at`,`created_by`,`updated_at`,`updated_by`) values 
(1,'Inspektorat','Inspektorat',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(2,'Sekretariat DPRD','SetWan',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(3,'Badan Perencanaan Pembangunan Daerah','bappeda','alan Robert Wolter Monginsidi No. 223, Tanjungkarang Pusat, Pengajaran, Kec. Tlk. Betung Utara, Kota Bandar Lampung, Lampung ','bappedalampung@gmail.com','(0721) 485458',1,'2019-10-11 08:00:27',1,'2019-10-11 08:00:27',7),
(4,'Badan Pengelola Keuangan dan Aset  Daerah','bakuda','JL. WR. Monginsidi, No. 69, Teluk Betung, Talang, Kec. Telukbetung Selatan','bakuda@lampungprov.go.id','(0721) 481546',1,'2020-01-09 11:27:54',1,'2020-01-09 11:27:54',7),
(5,'Badan Pendapatan Daerah','bapenda',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(6,'Badan Kepegawaian Daerah','BKD',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(7,'Badan Pengembangan SDM Daerah','bpsdm',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(8,'Badan Penelitian dan Pengembangan','balitbangda',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(9,'Badan Penanggulangan Bencana Daerah','bpbd',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(10,'Badan Penghubung Provinsi Lampung di Jakarta','bppl',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(11,'Badan Kesatuan Bangsa dan Politik Daerah','kesbangpol','Jl. Basuki Rahmat No.21 Gedong Pakuon Teluk Betung Selatan','kesbangpol@lampungprov.go.id','0721481544',1,'2020-01-09 11:21:59',1,'2020-01-09 11:21:59',7),
(13,'Biro Pengadaan Barang dan Jasa','blpbj','Jl. Beringin II, Talang, Kec. Telukbetung Selatan','lpse_lampung@yahoo.co.id','0721 488078',1,'2020-01-09 11:37:47',1,'2020-01-09 11:37:47',7),
(14,'Dinas Pendidikan dan Kebudayaan','disdikbud',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(15,'Dinas Kesehatan','dinkes',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(16,'Dinas Bina Marga dan Bina Kontruksi','BM','Jl. Zainal Abidin Pagar Alam KM. 11, Rajabasa, Bandar Lampung','dinaspupr.lampungprov@gmail.com','(0721) 702684',1,'2020-01-24 15:05:32',1,'2020-01-24 15:05:32',7),
(17,'Dinas Perumahan, Kawasan Permukiman dan Cipta Karya','Dinas PP & CK','Jl. Gatot Subroto No.50 Pecoh Raya Kec. Telukbetung Selatan','admin@pengairanlampung.com','+62 721 482402',1,'2020-01-09 11:57:25',1,'2020-01-09 11:57:25',7),
(18,'Dinas Pengelolaan Sumber Daya Air','PSDA','Jl. Gatot Subroto No.50, Garuntang, Kec. Telukbetung Selatan, Kota Bandar Lampung, Lampung','info@lampungprov.go.id','08117905000',1,'2020-01-24 14:59:22',1,'2020-01-24 14:59:22',7),
(19,'Satuan Polisi Pamong Praja','satpolpp',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(20,'Dinas Sosial','dinsos',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(21,'Dinas Tenaga Kerja ','disnakertrans','Jalan Gatot Subroto Nomor 28 Pahoman Kota Bandar Lampung, Lampung','disnakertrans@lampungprov.go.id','(0721) 252605',1,'2020-01-24 15:06:54',1,'2020-01-24 15:06:54',7),
(22,'Dinas Pemberdayaan Perempuan dan Perlindungan Anak','dinaspppa',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(23,'Dinas Ketahanan Pangan, Tanaman Pangan dan Hortikultura','Kadis Ketahanan Pangan & TPH','Jl. ZA. Pagar Alam No.1, Rajabasa, Kec. Rajabasa, Kota Bandar Lampung, Lampung 35144, Indonesia','dinastphprovinsilampung@gmail.com','0721 703775',1,'2020-01-13 08:45:07',1,'2020-01-13 08:45:07',7),
(24,'Dinas Lingkungan Hidup','dlh',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(25,'Dinas Kependudukan dan Pencatatan Sipil','disdukcapil',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(26,'Dinas Pemberdayaan Masyarakat, Desa dan Transmigrasi','dpmd','Jl. Beringin II, Talang, Kec. Telukbetung Selatan, Kota Bandar Lampung, Lampung 35221','dpmd@lampungprov.go.id','(0721) 481107',1,'2020-01-24 14:43:22',1,'2020-01-24 14:43:22',7),
(27,'Dinas Perhubungan','dishub',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(28,'Dinas Komunikasi Informatika dan Statistik','diskominfotik',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(29,'Dinas Koperasi dan UMKM','koperasiumkm',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(30,'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu','',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(31,'Dinas Pemuda dan Olahraga','dispora',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(32,'Dinas Perpustakaan dan Kearsiapan','',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(33,'Dinas Kelautan dan Perikanan','dkp',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(34,'Dinas Pariwisata dan Ekonomi Kreatif ','dispar','Jl. Jend. Sudirman No.29, Rw. Laut, Engal, Kota Bandar Lampung, Lampung 35118','disparekraflampung@gmail.com',' (0721) 261430',1,'2020-01-24 14:41:20',1,'2020-01-24 14:41:20',7),
(36,'Dinas Perkebunan','disbuntak','Jl. Basuki Rahmat No.08, Talang, Kec. Tlk. Betung Utara, Kota Bandar Lampung, Lampung 35211','disbun@lampungprov.go.id','(0721) 487865',1,'2020-01-24 14:48:19',1,'2020-01-24 14:48:19',7),
(37,'Dinas Kehutanan','dishut',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(38,'Dinas Energi dan Sumber Daya Mineral','esdm',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(39,'Dinas Perindustrian dan Perdagangan','disdag','Jalan Cut Meutia No.44, Gulak Galik, Kec. Tlk. Betung Utara, Kota Bandar Lampung, Lampung 35124','disperindag@lampungprov.go.id','(0721) 481107',1,'2020-01-24 14:45:55',1,'2020-01-24 14:45:55',7),
(41,'Biro Pemerintahan dan Otonomi Daerah','birootda','jl rw monginsidi','birootda@gmai.com','0721',1,'2019-10-11 08:02:00',1,'2019-10-11 08:02:00',7),
(42,'Biro Hukum','',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(43,'Biro Kesejahteraan Rakyat','KESRAK','Jl. WR. Monginsidi No.69 Teluk Betung Bandar Lampung','info@lampungprov.go.id','(0721) 481107',1,'2020-01-09 11:47:48',1,'2020-01-09 11:47:48',7),
(44,'Biro Perekonomian','',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(45,'Biro Administrasi Pembangunan','',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(46,'Biro Umum','',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(48,'Biro Administrasi Pimpinan','ADPIM','Jln. Robert Wolter Monginsidi No. 69 Telukbetung,','humasdanprotokollampung@gmail.com',' (0721) 481166',1,'2020-01-09 11:43:34',1,'2020-01-09 11:43:34',7),
(49,'Biro Organisasi','',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(50,'RSUD dr Abdoel Moeloek','rsudam',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(51,'RS Jiwa Daerah Provinsi Lampung','rsj',NULL,'',NULL,1,'2019-10-05 22:19:51',1,'2019-10-05 08:27:24',1),
(52,'Dinas Peternakan dan Kesehatan Hewan','Disnak','Jl. Sultan H. Jl. ZA. Pagar Alam No.52, Labuhan Ratu, Kec. Kedaton, Kota Bandar Lampung, Lampung 35144','info@lampungprov.go.id','(0721) 702189',1,'2020-01-24 14:51:15',7,'2020-01-24 14:51:15',7),
(53,'Rumah Sakit Umum Daerah Bandar Negara Husada','RSUD BNH','Komplek Pemerintahan Provinsi Lampung, Kota Baru, Jati Agung, Margorejo, Kec. Jati Agung, Kabupaten Lampung Selatan','info@lampungprov.go.id','(0721) 5617711',1,'2020-01-24 15:09:37',7,'2020-01-24 15:09:37',7),
(54,'Staf Ahli Gubernur Bidang Pemerintah , Hukum dan Politik','STAF AHLI GUB',' JL. WR. MONGONSIDI NO. 69 TELUK BETUNG, BANDAR LAMPUNG','nfo@lampungprov.go.id','08117905000',1,'2020-01-30 13:03:22',7,'2020-01-30 13:03:22',7),
(55,'Staf Ahli Gubernur Bidang Ekonomi, keuangan dan Pembangunan','STAF AHLI GUB EKOBANG','Jl. WR. Monginsidi No.69 Teluk Betung Bandar Lampung','info@lampungprov.go.id',' 08117905000',1,'2020-01-30 13:23:41',7,'2020-01-30 13:23:41',7),
(56,'Staf Ahli Gubernur Bidang Kemasyarakatan dan SDM','STAF AHLI GUB SDM','Jl. WR. Monginsidi No.69 Teluk Betung Bandar Lampung','info@lampungprov.go.id',' 08117905000',1,'2020-01-30 13:24:42',7,'2020-01-30 13:24:42',7),
(57,'Gugus tugas penanganan covid 19','Gugus Tugas ','jl rw monginsidi no 69','dionvanpersie@gmail.com','0721470508',1,'2020-08-06 10:02:53',7,'2020-08-06 10:02:53',7),
(58,'Esse non id autem vxx','Tempore quisquam vox','Nisi sed sint incidx','holxy@mailinator.com','111',1,'2021-08-09 09:41:01',1,'2021-08-09 09:41:01',1),
(59,'Sekretariat Daerah','Sekda',NULL,NULL,NULL,1,'2021-09-09 09:26:38',1,'2021-09-09 09:26:38',1),
(60,'Asisten Pemerintahan dan Kesejahteraan Rakyat','asisten 1',NULL,NULL,NULL,1,'2021-09-10 11:13:59',1,'2021-09-10 11:13:59',1),
(61,'Asisten Perekonomian dan Pembangunan','asisten 2',NULL,NULL,NULL,1,'2021-09-10 11:14:29',1,'2021-09-10 11:14:29',1),
(62,'Asisten Administrasi Umum','asisten 3',NULL,NULL,NULL,1,'2021-09-10 11:14:14',1,'2021-09-10 11:14:14',1),
(63,'Gubernur','gubernur',NULL,NULL,NULL,1,'2021-09-09 09:30:40',1,'2021-09-09 09:30:40',1),
(64,'Wakil Gubernur','wagub',NULL,NULL,NULL,1,'2021-09-09 09:30:32',1,'2021-09-09 09:30:32',1);

/*Table structure for table `tbl_qrcode` */

DROP TABLE IF EXISTS `tbl_qrcode`;

CREATE TABLE `tbl_qrcode` (
  `id_qr` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(50) NOT NULL,
  `tgl_surat` date DEFAULT NULL,
  `id_opd_fk` int(11) DEFAULT NULL,
  `kepada` varchar(255) DEFAULT NULL,
  `lampiran` int(11) DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `id_jenis_ttd_fk` int(11) DEFAULT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `qrcode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_qr`),
  KEY `id_opd_fk` (`id_opd_fk`),
  KEY `id_jenis_ttd_fk` (`id_jenis_ttd_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=6281 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_qrcode` */

/*Table structure for table `tbl_qrsignature` */

DROP TABLE IF EXISTS `tbl_qrsignature`;

CREATE TABLE `tbl_qrsignature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `qrcode` varchar(255) DEFAULT NULL,
  `id_opd_fk` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1112 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_qrsignature` */

/*Table structure for table `tbl_surat_masuk` */

DROP TABLE IF EXISTS `tbl_surat_masuk`;

CREATE TABLE `tbl_surat_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengirim` varchar(200) DEFAULT NULL,
  `no_surat` varchar(50) NOT NULL,
  `tgl_surat` date DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `qrcode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opd_fk` (`pengirim`)
) ENGINE=InnoDB AUTO_INCREMENT=6292 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_surat_masuk` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `id_opd_fk` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 0,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `id_opd_fk` (`id_opd_fk`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_opd_fk`) REFERENCES `tbl_opd` (`id_opd`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`name`,`avatar`,`level`,`id_opd_fk`,`active`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'admin','Admin Diskominfotik','1629259362491.png','superadmin',NULL,1,'hideyorixcode@gmail.com',NULL,'$2y$10$fUMq5.pHzgtS.GjIIP62ZOBRlfX1JKPnP4mX8etCmQ3VQTAIagXxy','mcNnD8oy0BbIAufi4OMBMNgpR57ssV4RU576ERCPZxh60ddIQgVJrBDJDNtR','2021-05-05 02:41:44','2021-08-18 11:02:42'),
(34,'umum','Theodore Santos',NULL,'umum',46,1,'rinyq@mailinator.com',NULL,'$2y$10$SelJhRFwaFm.6ChrCWUpdOHTwM8eJU76jozHznHaobW3D6rYJ4D4O',NULL,'2021-08-26 11:32:57','2021-08-26 11:32:57'),
(35,'adpim','Knox Harrell',NULL,'admin',48,1,'vykum@mailinator.com',NULL,'$2y$10$BmILgKdaXRV9HuzCy1pNE.ATPUcRBJeCO0xwZR9R90egDbhOcd7im',NULL,'2021-08-26 11:34:54','2021-08-26 11:34:54'),
(36,'disposekda','Endra',NULL,'disposisi',59,1,'endra@gmail.com',NULL,'$2y$10$dUvxVbiSpNu5rxE1szXfEOB1djjfMWA.qo/ZCcs/tIeEwX7oe1fYW',NULL,'2021-09-10 10:25:53','2021-09-10 10:30:41');

/*Table structure for table `v_bar_opd_tahunan` */

DROP TABLE IF EXISTS `v_bar_opd_tahunan`;

/*!50001 DROP VIEW IF EXISTS `v_bar_opd_tahunan` */;
/*!50001 DROP TABLE IF EXISTS `v_bar_opd_tahunan` */;

/*!50001 CREATE TABLE  `v_bar_opd_tahunan`(
 `jumlah` bigint(21) ,
 `id_opd_fk` int(11) ,
 `nama_opd` varchar(255) ,
 `alias_opd` varchar(100) ,
 `periode` varchar(4) 
)*/;

/*Table structure for table `v_bar_penandatangan` */

DROP TABLE IF EXISTS `v_bar_penandatangan`;

/*!50001 DROP VIEW IF EXISTS `v_bar_penandatangan` */;
/*!50001 DROP TABLE IF EXISTS `v_bar_penandatangan` */;

/*!50001 CREATE TABLE  `v_bar_penandatangan`(
 `jumlah` bigint(21) ,
 `id_jenis_ttd_fk` int(11) ,
 `jenis_ttd` varchar(255) ,
 `periode` varchar(7) 
)*/;

/*Table structure for table `v_bar_perangkat_daerah` */

DROP TABLE IF EXISTS `v_bar_perangkat_daerah`;

/*!50001 DROP VIEW IF EXISTS `v_bar_perangkat_daerah` */;
/*!50001 DROP TABLE IF EXISTS `v_bar_perangkat_daerah` */;

/*!50001 CREATE TABLE  `v_bar_perangkat_daerah`(
 `jumlah` bigint(21) ,
 `id_opd_fk` int(11) ,
 `nama_opd` varchar(255) ,
 `alias_opd` varchar(100) ,
 `periode` varchar(7) 
)*/;

/*Table structure for table `v_bar_signature` */

DROP TABLE IF EXISTS `v_bar_signature`;

/*!50001 DROP VIEW IF EXISTS `v_bar_signature` */;
/*!50001 DROP TABLE IF EXISTS `v_bar_signature` */;

/*!50001 CREATE TABLE  `v_bar_signature`(
 `jumlah` bigint(21) ,
 `id_opd_fk` int(11) ,
 `nama_opd` varchar(255) ,
 `alias_opd` varchar(100) ,
 `periode` varchar(7) 
)*/;

/*Table structure for table `v_bar_signature_tahunan` */

DROP TABLE IF EXISTS `v_bar_signature_tahunan`;

/*!50001 DROP VIEW IF EXISTS `v_bar_signature_tahunan` */;
/*!50001 DROP TABLE IF EXISTS `v_bar_signature_tahunan` */;

/*!50001 CREATE TABLE  `v_bar_signature_tahunan`(
 `jumlah` bigint(21) ,
 `id_opd_fk` int(11) ,
 `nama_opd` varchar(255) ,
 `alias_opd` varchar(100) ,
 `periode` varchar(4) 
)*/;

/*Table structure for table `v_bar_ttd_tahunan` */

DROP TABLE IF EXISTS `v_bar_ttd_tahunan`;

/*!50001 DROP VIEW IF EXISTS `v_bar_ttd_tahunan` */;
/*!50001 DROP TABLE IF EXISTS `v_bar_ttd_tahunan` */;

/*!50001 CREATE TABLE  `v_bar_ttd_tahunan`(
 `jumlah` bigint(21) ,
 `id_jenis_ttd_fk` int(11) ,
 `jenis_ttd` varchar(255) ,
 `periode` varchar(4) 
)*/;

/*View structure for view v_bar_opd_tahunan */

/*!50001 DROP TABLE IF EXISTS `v_bar_opd_tahunan` */;
/*!50001 DROP VIEW IF EXISTS `v_bar_opd_tahunan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bar_opd_tahunan` AS select count(0) AS `jumlah`,`tbl_qrcode`.`id_opd_fk` AS `id_opd_fk`,`tbl_opd`.`nama_opd` AS `nama_opd`,`tbl_opd`.`alias_opd` AS `alias_opd`,date_format(`tbl_qrcode`.`tgl_surat`,'%Y') AS `periode` from (`tbl_qrcode` join `tbl_opd`) where `tbl_qrcode`.`id_opd_fk` = `tbl_opd`.`id_opd` group by `tbl_opd`.`id_opd`,date_format(`tbl_qrcode`.`tgl_surat`,'%Y') */;

/*View structure for view v_bar_penandatangan */

/*!50001 DROP TABLE IF EXISTS `v_bar_penandatangan` */;
/*!50001 DROP VIEW IF EXISTS `v_bar_penandatangan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bar_penandatangan` AS select count(0) AS `jumlah`,`tbl_qrcode`.`id_jenis_ttd_fk` AS `id_jenis_ttd_fk`,`tbl_jenis_ttd`.`jenis_ttd` AS `jenis_ttd`,date_format(`tbl_qrcode`.`tgl_surat`,'%m-%Y') AS `periode` from (`tbl_qrcode` join `tbl_jenis_ttd`) where `tbl_qrcode`.`id_jenis_ttd_fk` = `tbl_jenis_ttd`.`id_jenis_ttd` group by `tbl_qrcode`.`id_jenis_ttd_fk`,date_format(`tbl_qrcode`.`tgl_surat`,'%m-%Y') */;

/*View structure for view v_bar_perangkat_daerah */

/*!50001 DROP TABLE IF EXISTS `v_bar_perangkat_daerah` */;
/*!50001 DROP VIEW IF EXISTS `v_bar_perangkat_daerah` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bar_perangkat_daerah` AS select count(0) AS `jumlah`,`tbl_qrcode`.`id_opd_fk` AS `id_opd_fk`,`tbl_opd`.`nama_opd` AS `nama_opd`,`tbl_opd`.`alias_opd` AS `alias_opd`,date_format(`tbl_qrcode`.`tgl_surat`,'%m-%Y') AS `periode` from (`tbl_qrcode` join `tbl_opd`) where `tbl_qrcode`.`id_opd_fk` = `tbl_opd`.`id_opd` group by `tbl_opd`.`id_opd`,date_format(`tbl_qrcode`.`tgl_surat`,'%m-%Y') */;

/*View structure for view v_bar_signature */

/*!50001 DROP TABLE IF EXISTS `v_bar_signature` */;
/*!50001 DROP VIEW IF EXISTS `v_bar_signature` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bar_signature` AS select count(0) AS `jumlah`,`tbl_qrsignature`.`id_opd_fk` AS `id_opd_fk`,`tbl_opd`.`nama_opd` AS `nama_opd`,`tbl_opd`.`alias_opd` AS `alias_opd`,date_format(`tbl_qrsignature`.`tgl`,'%m-%Y') AS `periode` from (`tbl_qrsignature` join `tbl_opd`) where `tbl_qrsignature`.`id_opd_fk` = `tbl_opd`.`id_opd` group by `tbl_opd`.`id_opd`,date_format(`tbl_qrsignature`.`tgl`,'%m-%Y') */;

/*View structure for view v_bar_signature_tahunan */

/*!50001 DROP TABLE IF EXISTS `v_bar_signature_tahunan` */;
/*!50001 DROP VIEW IF EXISTS `v_bar_signature_tahunan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bar_signature_tahunan` AS select count(0) AS `jumlah`,`tbl_qrsignature`.`id_opd_fk` AS `id_opd_fk`,`tbl_opd`.`nama_opd` AS `nama_opd`,`tbl_opd`.`alias_opd` AS `alias_opd`,date_format(`tbl_qrsignature`.`tgl`,'%Y') AS `periode` from (`tbl_qrsignature` join `tbl_opd`) where `tbl_qrsignature`.`id_opd_fk` = `tbl_opd`.`id_opd` group by `tbl_opd`.`id_opd`,date_format(`tbl_qrsignature`.`tgl`,'%Y') */;

/*View structure for view v_bar_ttd_tahunan */

/*!50001 DROP TABLE IF EXISTS `v_bar_ttd_tahunan` */;
/*!50001 DROP VIEW IF EXISTS `v_bar_ttd_tahunan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bar_ttd_tahunan` AS select count(0) AS `jumlah`,`tbl_qrcode`.`id_jenis_ttd_fk` AS `id_jenis_ttd_fk`,`tbl_jenis_ttd`.`jenis_ttd` AS `jenis_ttd`,date_format(`tbl_qrcode`.`tgl_surat`,'%Y') AS `periode` from (`tbl_qrcode` join `tbl_jenis_ttd`) where `tbl_qrcode`.`id_jenis_ttd_fk` = `tbl_jenis_ttd`.`id_jenis_ttd` group by `tbl_qrcode`.`id_jenis_ttd_fk`,date_format(`tbl_qrcode`.`tgl_surat`,'%Y') */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
