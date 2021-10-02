-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2021 at 01:29 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_surat_keluar`
--

CREATE TABLE `detail_surat_keluar` (
  `id` int(11) NOT NULL,
  `id_surat_keluar` int(11) DEFAULT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `kepada` varchar(100) DEFAULT NULL,
  `catatan_disposisi` varchar(250) DEFAULT NULL,
  `status_disposisi` enum('DITERUSKAN','DIKEMBALIKAN','TINDAK LANJUT') DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_surat_keluar`
--

INSERT INTO `detail_surat_keluar` (`id`, `id_surat_keluar`, `tgl_masuk`, `kepada`, `catatan_disposisi`, `status_disposisi`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 6288, '2021-10-02 13:23:00', 'subkoor_kepegawaian', 'mohon dilihat', 'DITERUSKAN', 35, 35, '2021-10-02 13:23:23', '2021-10-02 13:26:32'),
(6, 6288, '2021-10-02 14:06:00', 'umum', 'Tolong diperbaiki bagian isi suratnya', 'DIKEMBALIKAN', 39, 39, '2021-10-02 14:07:37', '2021-10-02 14:07:37'),
(7, 6288, '2021-10-02 14:10:00', 'subkoor_kepegawaian', 'Mohon di cek kembali', 'DITERUSKAN', 35, 35, '2021-10-02 14:10:46', '2021-10-02 14:10:46'),
(8, 6288, '2021-10-02 14:17:00', 'kabag', 'Mohon di cek Pak Kabag', 'DITERUSKAN', 39, 39, '2021-10-02 14:18:18', '2021-10-02 14:18:18'),
(9, 6288, '2021-10-02 14:26:00', 'seketaris', 'mohon di cek pak seketaris', 'DITERUSKAN', 40, 40, '2021-10-02 14:30:05', '2021-10-02 14:30:05'),
(10, 6288, '2021-10-02 18:27:24', '-', 'Ditandatangani oleh  Fahrizal Darminto', 'TINDAK LANJUT', 41, 41, '2021-10-02 18:27:24', '2021-10-02 18:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `detail_surat_masuk`
--

CREATE TABLE `detail_surat_masuk` (
  `id` int(11) NOT NULL,
  `id_sm_fk` int(11) DEFAULT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `kepada` varchar(100) DEFAULT NULL,
  `catatan_disposisi` varchar(250) DEFAULT NULL,
  `status` enum('diteruskan','dihimpun','tindak lanjut') DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_surat_masuk`
--

INSERT INTO `detail_surat_masuk` (`id`, `id_sm_fk`, `tgl_masuk`, `penerima`, `kepada`, `catatan_disposisi`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(34, 6293, '2021-09-17 08:29:00', 'Biro Umum', 'Biro Administrasi Pimpinan', '-', 'diteruskan', 34, 34, '2021-09-17 10:31:39', '2021-09-17 10:31:39'),
(35, 6293, '2021-09-17 10:45:00', 'Biro Administrasi Pimpinan', 'Asisten Pemerintahan dan Kesejahteraan Rakyat', NULL, 'diteruskan', 35, 35, '2021-09-17 10:52:26', '2021-09-17 10:52:26'),
(36, 6293, '2021-09-17 10:56:00', 'Asisten Pemerintahan dan Kesejahteraan Rakyat', 'Sekretariat Daerah', 'Yth. Pak Sekda bersama ini kami lampirkan surat dari KEMENKOMINFO.', 'diteruskan', 37, 37, '2021-09-17 10:57:58', '2021-09-17 10:57:58'),
(37, 6294, '2021-09-17 15:50:00', 'Biro Umum', 'Biro Administrasi Pembangunan', 'Untuk Asisten 2', 'diteruskan', 1, 1, '2021-09-17 15:50:20', '2021-09-17 15:55:34'),
(38, 6294, '2021-09-17 15:59:00', 'Biro Administrasi Pimpinan', 'Asisten Perekonomian dan Pembangunan', 'yth, bacalah', 'diteruskan', 35, 35, '2021-09-17 15:59:43', '2021-09-17 15:59:43'),
(39, 6294, '2021-09-17 16:02:00', 'Asisten Perekonomian dan Pembangunan', 'Sekretariat Daerah', 'yth, ini om', 'diteruskan', 38, 38, '2021-09-17 16:02:24', '2021-09-17 16:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_Id` int(11) NOT NULL,
  `log_Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `log_IdUser` int(11) UNSIGNED NOT NULL,
  `log_Description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_Id`, `log_Time`, `log_IdUser`, `log_Description`) VALUES
(439, '2021-09-10 08:10:14', 1, 'admin login aplikasi'),
(440, '2021-09-10 08:10:29', 1, 'admin menambahkan data pada fitur signature qr'),
(441, '2021-09-10 08:11:31', 1, 'admin login aplikasi'),
(442, '2021-09-10 08:12:24', 1, 'admin menambahkan data 808 pada fitur surat masuk'),
(443, '2021-09-10 08:15:19', 1, 'admin menambahkan data pada fitur disposisi'),
(444, '2021-09-10 08:15:19', 1, 'admin menambahkan data pada fitur disposisi'),
(445, '2021-09-10 08:15:28', 1, 'admin menghapus data  pada fitur disposisi'),
(446, '2021-09-10 08:15:36', 1, 'admin logout aplikasi'),
(447, '2021-09-10 08:16:00', 36, 'disposekda login aplikasi'),
(448, '2021-09-10 08:16:10', 1, 'admin menambahkan data pada fitur disposisi'),
(449, '2021-09-10 08:16:22', 1, 'admin menghapus data  pada fitur disposisi'),
(450, '2021-09-10 08:18:04', 36, 'disposekda menambahkan data pada fitur disposisi'),
(451, '2021-09-10 08:27:41', 36, 'disposekda logout aplikasi'),
(452, '2021-09-13 07:19:52', 1, 'admin login aplikasi'),
(453, '2021-09-13 07:29:40', 1, 'admin login aplikasi'),
(454, '2021-09-13 07:30:50', 1, 'admin logout aplikasi'),
(455, '2021-09-13 07:31:05', 36, 'disposekda login aplikasi'),
(456, '2021-09-13 07:31:16', 36, 'disposekda logout aplikasi'),
(457, '2021-09-13 07:31:23', 1, 'admin login aplikasi'),
(458, '2021-09-13 07:32:27', 1, 'admin logout aplikasi'),
(459, '2021-09-13 07:32:40', 1, 'admin login aplikasi'),
(460, '2021-09-13 07:36:27', 1, 'admin logout aplikasi'),
(461, '2021-09-13 07:36:36', 36, 'disposekda login aplikasi'),
(462, '2021-09-13 07:38:37', 36, 'disposekda logout aplikasi'),
(463, '2021-09-13 07:38:43', 1, 'admin login aplikasi'),
(464, '2021-09-13 07:39:04', 1, 'admin logout aplikasi'),
(465, '2021-09-13 07:55:39', 1, 'admin login aplikasi'),
(466, '2021-09-13 08:00:09', 1, 'admin logout aplikasi'),
(467, '2021-09-16 06:12:06', 1, 'admin login aplikasi'),
(468, '2021-09-16 06:12:12', 1, 'admin login aplikasi'),
(469, '2021-09-16 07:50:24', 1, 'admin login aplikasi'),
(470, '2021-09-17 01:25:46', 1, 'admin login aplikasi'),
(471, '2021-09-17 01:26:00', 1, 'admin menghapus data 1631261429746.png pada fitur Signature QR'),
(472, '2021-09-17 02:43:12', 1, 'admin menambahkan data pada fitur signature qr'),
(473, '2021-09-17 03:22:01', 1, 'admin login aplikasi'),
(474, '2021-09-17 03:22:27', 1, 'admin memperbarui data Theodore Santos pada fitur pengguna'),
(475, '2021-09-17 03:22:49', 1, 'admin memperbarui data Knox Harrell pada fitur pengguna'),
(476, '2021-09-17 03:27:30', 1, 'admin logout aplikasi'),
(477, '2021-09-17 03:29:21', 34, 'umum login aplikasi'),
(478, '2021-09-17 03:31:39', 34, 'umum menambahkan data ST001/98 pada fitur surat masuk'),
(479, '2021-09-17 03:31:46', 34, 'umum menghapus data 808 pada fitur Surat Masuk'),
(480, '2021-09-17 03:44:49', 34, 'umum logout aplikasi'),
(481, '2021-09-17 03:45:00', 35, 'adpim login aplikasi'),
(482, '2021-09-17 03:52:26', 35, 'adpim menambahkan data pada fitur disposisi'),
(483, '2021-09-17 03:53:34', 34, 'umum login aplikasi'),
(484, '2021-09-17 03:54:58', 35, 'adpim login aplikasi'),
(485, '2021-09-17 03:56:40', 35, 'adpim menambahkan data staff asisten pemerintahan pada fitur pengguna'),
(486, '2021-09-17 03:56:43', 35, 'adpim logout aplikasi'),
(487, '2021-09-17 03:56:49', 37, 'asisten1 login aplikasi'),
(488, '2021-09-17 03:57:58', 37, 'asisten1 menambahkan data pada fitur disposisi'),
(489, '2021-09-17 04:25:47', 37, 'asisten1 logout aplikasi'),
(490, '2021-09-17 04:25:52', 35, 'adpim login aplikasi'),
(491, '2021-09-17 08:49:38', 1, 'admin login aplikasi'),
(492, '2021-09-17 08:50:20', 1, 'admin menambahkan data 00123 pada fitur surat masuk'),
(493, '2021-09-17 08:55:34', 1, 'admin mengubah data pada fitur disposisi'),
(494, '2021-09-17 08:56:29', 1, 'admin logout aplikasi'),
(495, '2021-09-17 08:56:44', 35, 'adpim login aplikasi'),
(496, '2021-09-17 08:58:53', 35, 'adpim login aplikasi'),
(497, '2021-09-17 08:59:43', 35, 'adpim menambahkan data pada fitur disposisi'),
(498, '2021-09-17 08:59:49', 35, 'adpim logout aplikasi'),
(499, '2021-09-17 09:00:13', 1, 'admin login aplikasi'),
(500, '2021-09-17 09:01:01', 1, 'admin menambahkan data Sespri Ass 2 pada fitur pengguna'),
(501, '2021-09-17 09:01:05', 1, 'admin logout aplikasi'),
(502, '2021-09-17 09:01:14', 38, 'asisten2 login aplikasi'),
(503, '2021-09-17 09:02:24', 38, 'asisten2 menambahkan data pada fitur disposisi'),
(504, '2021-09-17 09:02:28', 38, 'asisten2 logout aplikasi'),
(505, '2021-09-17 09:03:08', 1, 'admin login aplikasi'),
(506, '2021-09-17 09:05:10', 1, 'admin menambahkan data 1111 pada fitur surat keluar'),
(507, '2021-09-20 02:19:37', 1, 'admin login aplikasi'),
(508, '2021-09-20 02:48:56', 1, 'admin login aplikasi'),
(509, '2021-09-20 02:49:26', 1, 'admin memperbarui data Sekretaris Daerah pada fitur perangkat daerah'),
(510, '2021-09-20 02:49:36', 1, 'admin menghapus data Esse non id autem vxx pada fitur perangkat daerah'),
(511, '2021-09-20 05:05:34', 35, 'adpim login aplikasi'),
(512, '2021-09-20 05:09:07', 35, 'adpim menambahkan data pada fitur signature qr'),
(513, '2021-09-20 07:00:12', 1, 'admin login aplikasi'),
(514, '2021-09-20 07:10:55', 1, 'admin login aplikasi'),
(515, '2021-09-20 08:48:39', 1, 'admin logout aplikasi'),
(516, '2021-09-20 13:16:05', 1, 'admin login aplikasi'),
(517, '2021-09-20 13:16:18', 1, 'admin logout aplikasi'),
(518, '2021-09-20 13:26:25', 1, 'admin login aplikasi'),
(519, '2021-09-20 13:29:09', 1, 'admin berhasil ubah konfigurasi pada fitur setting aplikasi'),
(520, '2021-09-20 13:30:27', 1, 'admin berhasil ubah konfigurasi pada fitur setting aplikasi'),
(521, '2021-09-20 13:30:42', 1, 'admin berhasil ubah konfigurasi pada fitur setting aplikasi'),
(522, '2021-09-20 13:31:55', 1, 'admin berhasil ubah konfigurasi pada fitur setting aplikasi'),
(523, '2021-09-20 13:36:36', 1, 'admin menghapus data Gubernur pada fitur jenis penandatangan'),
(524, '2021-09-20 13:38:21', 1, 'admin menghapus data Asisten Pemerintahan dan Kesra pada fitur jenis penandatangan'),
(525, '2021-09-20 13:38:59', 1, 'admin menghapus data Sespri Ass 2 pada fitur pengguna'),
(526, '2021-09-20 13:38:59', 1, 'admin menghapus data staff asisten pemerintahan pada fitur pengguna'),
(527, '2021-09-20 13:38:59', 1, 'admin menghapus data Sespri Ass 2 pada fitur pengguna'),
(528, '2021-09-20 13:38:59', 1, 'admin logout aplikasi'),
(529, '2021-09-20 13:50:59', 1, 'admin login aplikasi'),
(530, '2021-09-20 13:51:19', 1, 'admin menghapus data Asisten Pemerintahan dan Kesejahteraan Rakyat pada fitur perangkat daerah'),
(531, '2021-09-20 13:51:19', 1, 'admin menghapus data Asisten Perekonomian dan Pembangunan pada fitur perangkat daerah'),
(532, '2021-09-20 13:52:10', 1, 'admin menghapus data Asisten Administrasi Umum pada fitur jenis penandatangan'),
(533, '2021-09-21 14:21:56', 1, 'admin login aplikasi'),
(535, '2021-09-21 14:33:42', 1, 'admin logout aplikasi'),
(536, '2021-09-21 14:33:50', 1, 'admin login aplikasi'),
(537, '2021-09-21 14:33:58', 1, 'admin logout aplikasi'),
(538, '2021-09-21 14:34:16', 1, 'admin login aplikasi'),
(539, '2021-09-21 14:54:30', 1, 'admin logout aplikasi'),
(540, '2021-09-21 14:54:39', 34, 'umum login aplikasi'),
(541, '2021-09-21 14:54:56', 34, 'umum logout aplikasi'),
(542, '2021-09-21 14:55:12', 35, 'adpim login aplikasi'),
(543, '2021-09-21 15:04:59', 35, 'admin logout aplikasi'),
(544, '2021-09-21 15:05:04', 35, 'admin login aplikasi'),
(545, '2021-09-21 15:05:10', 35, 'admin logout aplikasi'),
(546, '2021-09-21 15:05:19', 1, 'superadmin login aplikasi'),
(547, '2021-09-21 15:11:12', 1, 'superadmin memperbarui data Bagian Kepegawaian dan Umum pada fitur perangkat daerah'),
(548, '2021-09-21 15:12:11', 1, 'superadmin menghapus data Asisten Administrasi Umum pada fitur perangkat daerah'),
(549, '2021-09-21 15:12:11', 1, 'superadmin menghapus data Badan Kepegawaian Daerah pada fitur perangkat daerah'),
(550, '2021-09-21 15:12:11', 1, 'superadmin menghapus data Badan Kesatuan Bangsa dan Politik Daerah pada fitur perangkat daerah'),
(551, '2021-09-21 15:12:11', 1, 'superadmin menghapus data Badan Penanggulangan Bencana Daerah pada fitur perangkat daerah'),
(552, '2021-09-21 15:12:11', 1, 'superadmin menghapus data Badan Pendapatan Daerah pada fitur perangkat daerah'),
(553, '2021-09-21 15:12:11', 1, 'superadmin menghapus data Badan Penelitian dan Pengembangan pada fitur perangkat daerah'),
(554, '2021-09-21 15:12:12', 1, 'superadmin menghapus data Badan Pengelola Keuangan dan Aset  Daerah pada fitur perangkat daerah'),
(555, '2021-09-21 15:12:12', 1, 'superadmin menghapus data Badan Pengembangan SDM Daerah pada fitur perangkat daerah'),
(556, '2021-09-21 15:12:12', 1, 'superadmin menghapus data Badan Penghubung Provinsi Lampung di Jakarta pada fitur perangkat daerah'),
(557, '2021-09-21 15:12:12', 1, 'superadmin menghapus data Badan Perencanaan Pembangunan Daerah pada fitur perangkat daerah'),
(558, '2021-09-21 15:12:22', 1, 'superadmin menghapus data Biro Administrasi Pembangunan pada fitur perangkat daerah'),
(559, '2021-09-21 15:12:22', 1, 'superadmin menghapus data Biro Administrasi Pimpinan pada fitur perangkat daerah'),
(560, '2021-09-21 15:12:22', 1, 'superadmin menghapus data Biro Hukum pada fitur perangkat daerah'),
(561, '2021-09-21 15:12:22', 1, 'superadmin menghapus data Biro Kesejahteraan Rakyat pada fitur perangkat daerah'),
(562, '2021-09-21 15:12:23', 1, 'superadmin menghapus data Biro Organisasi pada fitur perangkat daerah'),
(563, '2021-09-21 15:12:23', 1, 'superadmin menghapus data Biro Pemerintahan dan Otonomi Daerah pada fitur perangkat daerah'),
(564, '2021-09-21 15:12:23', 1, 'superadmin menghapus data Biro Pengadaan Barang dan Jasa pada fitur perangkat daerah'),
(565, '2021-09-21 15:12:23', 1, 'superadmin menghapus data Biro Perekonomian pada fitur perangkat daerah'),
(566, '2021-09-21 15:12:23', 1, 'superadmin menghapus data Dinas Bina Marga dan Bina Kontruksi pada fitur perangkat daerah'),
(567, '2021-09-21 15:12:23', 1, 'superadmin menghapus data Dinas Energi dan Sumber Daya Mineral pada fitur perangkat daerah'),
(568, '2021-09-21 15:12:23', 1, 'superadmin menghapus data Dinas Kehutanan pada fitur perangkat daerah'),
(569, '2021-09-21 15:12:23', 1, 'superadmin menghapus data Dinas Kelautan dan Perikanan pada fitur perangkat daerah'),
(570, '2021-09-21 15:12:23', 1, 'superadmin menghapus data Dinas Kependudukan dan Pencatatan Sipil pada fitur perangkat daerah'),
(571, '2021-09-21 15:12:24', 1, 'superadmin menghapus data Dinas Kesehatan pada fitur perangkat daerah'),
(572, '2021-09-21 15:12:24', 1, 'superadmin menghapus data Dinas Ketahanan Pangan, Tanaman Pangan dan Hortikultura pada fitur perangkat daerah'),
(573, '2021-09-21 15:12:24', 1, 'superadmin menghapus data Dinas Komunikasi Informatika dan Statistik pada fitur perangkat daerah'),
(574, '2021-09-21 15:12:24', 1, 'superadmin menghapus data Dinas Koperasi dan UMKM pada fitur perangkat daerah'),
(575, '2021-09-21 15:12:24', 1, 'superadmin menghapus data Dinas Lingkungan Hidup pada fitur perangkat daerah'),
(576, '2021-09-21 15:12:24', 1, 'superadmin menghapus data Dinas Pariwisata dan Ekonomi Kreatif  pada fitur perangkat daerah'),
(577, '2021-09-21 15:12:24', 1, 'superadmin menghapus data Dinas Pemberdayaan Masyarakat, Desa dan Transmigrasi pada fitur perangkat daerah'),
(578, '2021-09-21 15:12:24', 1, 'superadmin menghapus data Dinas Pemberdayaan Perempuan dan Perlindungan Anak pada fitur perangkat daerah'),
(579, '2021-09-21 15:12:24', 1, 'superadmin menghapus data Dinas Pemuda dan Olahraga pada fitur perangkat daerah'),
(580, '2021-09-21 15:12:24', 1, 'superadmin menghapus data Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu pada fitur perangkat daerah'),
(581, '2021-09-21 15:12:24', 1, 'superadmin menghapus data Dinas Pendidikan dan Kebudayaan pada fitur perangkat daerah'),
(582, '2021-09-21 15:12:39', 1, 'superadmin menghapus data Dinas Pengelolaan Sumber Daya Air pada fitur perangkat daerah'),
(583, '2021-09-21 15:12:39', 1, 'superadmin menghapus data Dinas Perhubungan pada fitur perangkat daerah'),
(584, '2021-09-21 15:12:39', 1, 'superadmin menghapus data Dinas Perindustrian dan Perdagangan pada fitur perangkat daerah'),
(585, '2021-09-21 15:12:39', 1, 'superadmin menghapus data Dinas Perkebunan pada fitur perangkat daerah'),
(586, '2021-09-21 15:12:39', 1, 'superadmin menghapus data Dinas Perpustakaan dan Kearsiapan pada fitur perangkat daerah'),
(587, '2021-09-21 15:12:39', 1, 'superadmin menghapus data Dinas Perumahan, Kawasan Permukiman dan Cipta Karya pada fitur perangkat daerah'),
(588, '2021-09-21 15:12:39', 1, 'superadmin menghapus data Dinas Peternakan dan Kesehatan Hewan pada fitur perangkat daerah'),
(589, '2021-09-21 15:12:39', 1, 'superadmin menghapus data Dinas Sosial pada fitur perangkat daerah'),
(590, '2021-09-21 15:12:39', 1, 'superadmin menghapus data Dinas Tenaga Kerja  pada fitur perangkat daerah'),
(591, '2021-09-21 15:12:39', 1, 'superadmin menghapus data Gubernur pada fitur perangkat daerah'),
(592, '2021-09-21 15:12:39', 1, 'superadmin menghapus data Gugus tugas penanganan covid 19 pada fitur perangkat daerah'),
(593, '2021-09-21 15:12:40', 1, 'superadmin menghapus data Inspektorat pada fitur perangkat daerah'),
(594, '2021-09-21 15:12:40', 1, 'superadmin menghapus data RS Jiwa Daerah Provinsi Lampung pada fitur perangkat daerah'),
(595, '2021-09-21 15:12:40', 1, 'superadmin menghapus data RSUD dr Abdoel Moeloek pada fitur perangkat daerah'),
(596, '2021-09-21 15:12:40', 1, 'superadmin menghapus data Rumah Sakit Umum Daerah Bandar Negara Husada pada fitur perangkat daerah'),
(597, '2021-09-21 15:12:40', 1, 'superadmin menghapus data Satuan Polisi Pamong Praja pada fitur perangkat daerah'),
(598, '2021-09-21 15:12:40', 1, 'superadmin menghapus data Sekretariat DPRD pada fitur perangkat daerah'),
(599, '2021-09-21 15:12:40', 1, 'superadmin menghapus data Sekretaris Daerah pada fitur perangkat daerah'),
(600, '2021-09-21 15:12:40', 1, 'superadmin menghapus data Staf Ahli Gubernur Bidang Ekonomi, keuangan dan Pembangunan pada fitur perangkat daerah'),
(601, '2021-09-21 15:12:40', 1, 'superadmin menghapus data Staf Ahli Gubernur Bidang Kemasyarakatan dan SDM pada fitur perangkat daerah'),
(602, '2021-09-21 15:12:40', 1, 'superadmin menghapus data Staf Ahli Gubernur Bidang Pemerintah , Hukum dan Politik pada fitur perangkat daerah'),
(603, '2021-09-21 15:12:40', 1, 'superadmin menghapus data Wakil Gubernur pada fitur perangkat daerah'),
(604, '2021-09-22 12:03:45', 35, 'admin login aplikasi'),
(605, '2021-09-22 12:03:54', 35, 'admin logout aplikasi'),
(606, '2021-09-22 12:04:05', 1, 'superadmin login aplikasi'),
(607, '2021-09-22 12:15:32', 1, 'superadmin menghapus data Wakil Gubernur pada fitur jenis penandatangan'),
(608, '2021-09-22 12:40:10', 1, 'superadmin mengubah data Sekretaris Dirjen pada fitur kategori'),
(609, '2021-09-22 12:40:16', 1, 'superadmin mengubah data Sekretaris Dirjen pada fitur kategori'),
(610, '2021-09-22 12:45:24', 1, 'superadmin menambahkan data Direktur Jenderal Bina Marga pada fitur kategori'),
(611, '2021-09-22 12:46:38', 1, 'superadmin logout aplikasi'),
(612, '2021-09-22 12:49:04', 1, 'superadmin login aplikasi'),
(613, '2021-09-26 01:23:40', 1, 'superadmin login aplikasi'),
(614, '2021-09-26 01:40:15', 1, 'superadmin memperbarui data Theodore Santos pada fitur pengguna'),
(615, '2021-09-26 01:40:30', 1, 'superadmin memperbarui data Theodore Santos pada fitur pengguna'),
(616, '2021-09-26 01:57:47', 1, 'superadmin menambahkan data Kepala Bagian Tata Kepegawaian dan Umum pada fitur kategori'),
(617, '2021-09-26 02:04:54', 1, 'superadmin menambahkan data  pada fitur surat keluar'),
(618, '2021-09-26 03:13:01', 1, 'superadmin memperbarui data  pada fitur surat keluar'),
(619, '2021-09-26 03:19:31', 1, 'superadmin menghapus data  pada fitur Surat Keluar'),
(620, '2021-09-26 03:19:54', 1, 'superadmin menghapus data 1111 pada fitur Surat Keluar'),
(621, '2021-09-26 03:25:10', 1, 'superadmin menambahkan data Ohtno ntnaa pada fitur surat keluar'),
(622, '2021-09-26 03:27:54', 1, 'superadmin memperbarui data 11111 pada fitur surat keluar'),
(623, '2021-09-26 03:28:59', 1, 'superadmin menghapus data 11111 pada fitur Surat Keluar'),
(624, '2021-09-26 03:29:28', 1, 'superadmin menambahkan data  pada fitur surat keluar'),
(625, '2021-09-26 03:33:40', 1, 'superadmin menghapus data  pada fitur Surat Keluar'),
(626, '2021-09-26 03:33:50', 1, 'superadmin menambahkan data  pada fitur surat keluar'),
(627, '2021-09-26 03:36:01', 1, 'superadmin menghapus data  pada fitur Surat Keluar'),
(628, '2021-09-26 03:36:07', 1, 'superadmin menambahkan data awd pada fitur kategori'),
(629, '2021-09-26 03:36:22', 1, 'superadmin menghapus data awd pada fitur jenis penandatangan'),
(630, '2021-09-26 03:36:22', 1, 'superadmin menghapus data awd pada fitur jenis penandatangan'),
(631, '2021-09-26 03:41:58', 1, 'superadmin menambahkan data awdawd pada fitur kategori'),
(632, '2021-09-26 03:44:46', 1, 'superadmin menghapus data awdawd pada fitur jenis penandatangan'),
(633, '2021-09-26 03:45:15', 1, 'superadmin menambahkan data  pada fitur surat keluar'),
(634, '2021-09-26 03:45:21', 1, 'superadmin menghapus data  pada fitur Surat Keluar'),
(635, '2021-09-26 03:48:01', 1, 'superadmin memperbarui data Knox Harrell pada fitur pengguna'),
(636, '2021-09-26 03:48:06', 1, 'superadmin logout aplikasi'),
(637, '2021-09-26 03:48:14', 35, 'umum login aplikasi'),
(638, '2021-09-26 03:53:01', 35, 'umum menambahkan data  pada fitur surat keluar'),
(639, '2021-09-26 04:28:21', 35, 'umum menghapus data  pada fitur Surat Keluar'),
(640, '2021-09-26 04:29:17', 35, 'umum menambahkan data  pada fitur surat keluar'),
(641, '2021-09-26 04:37:49', 35, 'umum logout aplikasi'),
(642, '2021-09-26 04:37:54', 1, 'superadmin login aplikasi'),
(643, '2021-09-26 04:38:08', 1, 'superadmin memperbarui password'),
(644, '2021-09-26 04:38:12', 1, 'superadmin logout aplikasi'),
(645, '2021-09-26 04:38:17', 1, 'superadmin login aplikasi'),
(646, '2021-09-26 04:38:28', 1, 'superadmin logout aplikasi'),
(647, '2021-09-26 05:20:18', 35, 'umum login aplikasi'),
(648, '2021-09-26 12:05:20', 35, 'umum login aplikasi'),
(649, '2021-09-26 12:05:27', 35, 'umum menghapus data  pada fitur Surat Keluar'),
(650, '2021-09-26 12:06:52', 35, 'umum logout aplikasi'),
(651, '2021-09-26 12:06:58', 1, 'superadmin login aplikasi'),
(652, '2021-09-26 12:07:17', 1, 'superadmin logout aplikasi'),
(653, '2021-09-26 12:07:22', 35, 'umum login aplikasi'),
(654, '2021-09-26 13:12:42', 35, 'umum menambahkan data pada fitur disposisi surat keluar'),
(655, '2021-09-26 13:14:14', 35, 'umum menghapus data  pada fitur disposisi'),
(656, '2021-09-26 13:14:33', 35, 'umum menambahkan data pada fitur disposisi surat keluar'),
(657, '2021-09-26 13:15:37', 35, 'umum menghapus data  pada fitur disposisi'),
(658, '2021-09-26 13:15:47', 35, 'umum menambahkan data pada fitur disposisi surat keluar'),
(659, '2021-09-26 13:19:05', 35, 'umum menghapus data  pada fitur disposisi'),
(660, '2021-09-26 13:21:49', 35, 'umum menambahkan data pada fitur disposisi surat keluar'),
(661, '2021-09-26 13:28:44', 35, 'umum mengubah data pada fitur disposisi'),
(662, '2021-09-26 13:29:10', 35, 'umum menghapus data  pada fitur disposisi'),
(663, '2021-10-02 06:22:53', 35, 'umum login aplikasi'),
(664, '2021-10-02 06:23:23', 35, 'umum menambahkan data pada fitur disposisi surat keluar'),
(665, '2021-10-02 06:23:34', 35, 'umum mengubah data pada fitur disposisi'),
(666, '2021-10-02 06:23:46', 35, 'umum mengubah data pada fitur disposisi'),
(667, '2021-10-02 06:23:52', 35, 'umum mengubah data pada fitur disposisi'),
(668, '2021-10-02 06:26:32', 35, 'umum mengubah data pada fitur disposisi'),
(669, '2021-10-02 06:28:05', 35, 'umum logout aplikasi'),
(670, '2021-10-02 06:28:14', 1, 'superadmin login aplikasi'),
(671, '2021-10-02 06:29:10', 1, 'superadmin menambahkan data Harun pada fitur pengguna'),
(672, '2021-10-02 06:29:17', 1, 'superadmin logout aplikasi'),
(673, '2021-10-02 06:29:22', 39, 'subkoor_tuk login aplikasi'),
(674, '2021-10-02 06:53:05', 39, 'subkoor_tuk logout aplikasi'),
(675, '2021-10-02 06:54:06', 34, 'subkoor_umum login aplikasi'),
(676, '2021-10-02 06:54:29', 34, 'subkoor_umum logout aplikasi'),
(677, '2021-10-02 06:54:34', 1, 'superadmin login aplikasi'),
(678, '2021-10-02 06:54:59', 1, 'superadmin memperbarui data Theodore Santos pada fitur pengguna'),
(679, '2021-10-02 06:55:07', 1, 'superadmin logout aplikasi'),
(680, '2021-10-02 06:55:43', 34, 'subkoor_umum login aplikasi'),
(681, '2021-10-02 06:56:22', 34, 'subkoor_umum logout aplikasi'),
(682, '2021-10-02 07:03:47', 39, 'subkoor_tuk login aplikasi'),
(683, '2021-10-02 07:07:37', 39, 'subkoor_tuk menambahkan data pada fitur disposisi surat keluar'),
(684, '2021-10-02 07:09:26', 39, 'subkoor_tuk logout aplikasi'),
(685, '2021-10-02 07:09:31', 35, 'umum login aplikasi'),
(686, '2021-10-02 07:10:46', 35, 'umum menambahkan data pada fitur disposisi surat keluar'),
(687, '2021-10-02 07:10:58', 35, 'umum logout aplikasi'),
(688, '2021-10-02 07:11:43', 39, 'subkoor_tuk login aplikasi'),
(689, '2021-10-02 07:18:18', 39, 'subkoor_tuk menambahkan data pada fitur disposisi surat keluar'),
(690, '2021-10-02 07:20:39', 39, 'subkoor_tuk logout aplikasi'),
(691, '2021-10-02 07:20:48', 1, 'superadmin login aplikasi'),
(692, '2021-10-02 07:21:22', 1, 'superadmin menambahkan data Sancaka pada fitur pengguna'),
(693, '2021-10-02 07:21:29', 1, 'superadmin logout aplikasi'),
(694, '2021-10-02 07:21:35', 40, 'kabag login aplikasi'),
(695, '2021-10-02 07:30:05', 40, 'kabag menambahkan data pada fitur disposisi surat keluar'),
(696, '2021-10-02 07:30:16', 40, 'kabag logout aplikasi'),
(697, '2021-10-02 07:30:26', 1, 'superadmin login aplikasi'),
(698, '2021-10-02 07:31:01', 1, 'superadmin menambahkan data Fahrizal Darminto pada fitur pengguna'),
(699, '2021-10-02 07:31:05', 1, 'superadmin logout aplikasi'),
(700, '2021-10-02 07:31:17', 41, 'sekretaris login aplikasi'),
(701, '2021-10-02 07:43:34', 41, 'sekretaris logout aplikasi'),
(702, '2021-10-02 07:43:39', 1, 'superadmin login aplikasi'),
(703, '2021-10-02 07:51:12', 1, 'superadmin mengubah data Sekretaris Dirjen pada fitur kategori'),
(704, '2021-10-02 07:52:55', 1, 'superadmin mengubah data Sekretaris Dirjen pada fitur kategori'),
(705, '2021-10-02 07:57:08', 1, 'superadmin mengubah data Kepala Bagian Tata Kepegawaian dan Umum pada fitur kategori'),
(706, '2021-10-02 08:09:47', 1, 'superadmin menambahkan data Tremenza pada fitur pengguna'),
(707, '2021-10-02 08:10:06', 1, 'superadmin mengubah data Direktur Jenderal Bina Marga pada fitur kategori'),
(708, '2021-10-02 08:10:12', 1, 'superadmin logout aplikasi'),
(709, '2021-10-02 08:10:19', 41, 'sekretaris login aplikasi'),
(710, '2021-10-02 10:56:30', 41, 'sekretaris finish surat Pembangunan Sekolah'),
(711, '2021-10-02 11:05:32', 41, 'sekretaris finish surat Pembangunan Sekolah'),
(712, '2021-10-02 11:09:30', 41, 'sekretaris finish surat Pembangunan Sekolah'),
(713, '2021-10-02 11:11:38', 41, 'sekretaris finish surat Pembangunan Sekolah'),
(714, '2021-10-02 11:16:09', 41, 'sekretaris finish surat Pembangunan Sekolah'),
(715, '2021-10-02 11:17:36', 41, 'sekretaris finish surat Pembangunan Sekolah'),
(716, '2021-10-02 11:18:19', 41, 'sekretaris finish surat Pembangunan Sekolah'),
(717, '2021-10-02 11:22:29', 41, 'sekretaris finish surat Pembangunan Sekolah'),
(718, '2021-10-02 11:27:24', 41, 'sekretaris finish surat Pembangunan Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_Id` int(10) UNSIGNED NOT NULL,
  `setting_Label` varchar(100) DEFAULT NULL,
  `setting_Key` varchar(50) DEFAULT NULL,
  `setting_Value` text DEFAULT NULL,
  `setting_Type` varchar(50) DEFAULT NULL,
  `setting_Updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_Id`, `setting_Label`, `setting_Key`, `setting_Value`, `setting_Type`, `setting_Updated`) VALUES
(1, 'LOGO', 'logo', '1632144627640.png', 'gambar', '2021-09-20 20:30:27'),
(2, 'JUDUL', 'judul', 'Aplikasi Manajemen Surat', 'textfield', '2021-09-20 20:29:09'),
(3, 'DESKRIPSI', 'deskripsi', 'sistem dirancang untuk pengarsipan digital dan monitoring surat keluar pada Bagian Kepegawaian dan Umum, Setditjen Bina Marga', 'textarea', '2021-09-20 20:29:09'),
(4, 'KEYWORD', 'keyword', 'manajemen surat,surat keluar', 'textfield', '2021-09-20 20:29:09'),
(5, 'EMAIL', 'email', 'tapisdev@gmail.com', 'email', '2021-09-20 20:29:09'),
(6, 'NO TELP', 'notelepon', '6281281488337', 'number', '2021-09-20 20:29:09'),
(7, 'NAMA APP', 'nama_app', 'Aplikasi Surat', 'textfield', '2021-09-20 20:30:42'),
(8, 'ALAMAT', 'alamat', 'Jakarta, Indonesia', 'textarea', '2021-09-20 20:29:09'),
(9, 'AUTHOR', 'author', 'Glory', 'textfield', '2021-09-20 20:29:09'),
(10, 'AREA', 'area', 'Jakarta', 'textfield', '2021-09-20 20:29:09'),
(11, 'FAVICON', 'favicon', '1632144715925.ico', 'favicon', '2021-09-20 20:31:55'),
(16, 'PERNYATAAN VERIFIKASI', 'pernyataan_verifikasi', 'Dokumen Telah Diverifikasi', 'textfield', '2021-08-05 13:31:28'),
(18, 'BANNER LOGIN', 'banner_login', '1628148627347.jpg', 'gambar', '2021-08-05 14:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_ttd`
--

CREATE TABLE `tbl_jenis_ttd` (
  `id_jenis_ttd` int(11) NOT NULL,
  `jenis_ttd` varchar(255) NOT NULL,
  `nama_pejabat` varchar(100) DEFAULT NULL,
  `nip_pejabat` varchar(50) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `id_user` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis_ttd`
--

INSERT INTO `tbl_jenis_ttd` (`id_jenis_ttd`, `jenis_ttd`, `nama_pejabat`, `nip_pejabat`, `active`, `id_user`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(8, 'Wakil Gubernur', NULL, NULL, 1, NULL, '2021-09-22 12:15:32', 1, '2021-09-22 12:15:32', 1, '2021-09-22 19:15:32'),
(9, 'Sekretaris Dirjen', 'Ir. Darminto', '199902020', 1, 41, '2021-10-02 07:52:55', 1, '2021-10-02 07:52:55', 1, NULL),
(12, 'Asisten Perekonomian dan Pembangunan', NULL, NULL, 1, NULL, '2021-09-21 14:22:31', 1, '2021-09-21 14:22:31', 1, '2021-09-21 21:22:31'),
(16, 'Direktur Jenderal Bina Marga', 'Tuzalos, S.T, M.T', '000929223', 1, 42, '2021-10-02 08:10:06', 1, '2021-10-02 08:10:06', 1, NULL),
(17, 'Kepala Bagian Tata Kepegawaian dan Umum', 'M. Kadafi S.E, MBA', '0192929292', 1, 40, '2021-10-02 07:57:08', 1, '2021-10-02 07:57:08', 1, NULL),
(18, 'awd', 'awdawdawd', 'qwawd', 1, NULL, '2021-09-26 03:36:22', 1, '2021-09-26 03:36:22', 1, '2021-09-26 10:36:22'),
(19, 'awdawd', 'awdadw', 'awdwadad', 1, NULL, '2021-09-26 03:44:46', 1, '2021-09-26 03:44:46', 1, '2021-09-26 10:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_opd`
--

CREATE TABLE `tbl_opd` (
  `id_opd` int(11) NOT NULL,
  `nama_opd` varchar(255) NOT NULL,
  `alias_opd` varchar(100) NOT NULL,
  `alamat_opd` varchar(255) DEFAULT NULL,
  `email_opd` varchar(255) DEFAULT NULL,
  `notelepon_opd` varchar(20) DEFAULT NULL,
  `active` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_opd`
--

INSERT INTO `tbl_opd` (`id_opd`, `nama_opd`, `alias_opd`, `alamat_opd`, `email_opd`, `notelepon_opd`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(46, 'Bagian Kepegawaian dan Umum', 'bag umum', NULL, NULL, NULL, 1, '2021-09-21 15:11:12', 1, '2021-09-21 15:11:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qrcode`
--

CREATE TABLE `tbl_qrcode` (
  `id_qr` int(11) NOT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `id_opd_fk` int(11) DEFAULT NULL,
  `kepada` varchar(255) DEFAULT NULL,
  `lampiran` int(11) DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `id_jenis_ttd_fk` int(11) DEFAULT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `qrcode` varchar(255) DEFAULT NULL,
  `status_surat` enum('DRAFT','FINAL') NOT NULL DEFAULT 'DRAFT',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_qrcode`
--

INSERT INTO `tbl_qrcode` (`id_qr`, `no_surat`, `tgl_surat`, `id_opd_fk`, `kepada`, `lampiran`, `perihal`, `id_jenis_ttd_fk`, `berkas`, `qrcode`, `status_surat`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6288, NULL, '2021-09-26', NULL, 'Kementrian Pendidikan RI', 2, 'Pembangunan Sekolah', 9, '1632630556977.pdf', '1632630557031.svg', 'FINAL', '2021-09-26 04:29:16', 35, '2021-10-02 11:26:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qrsignature`
--

CREATE TABLE `tbl_qrsignature` (
  `id` int(11) NOT NULL,
  `tgl` date DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `qrcode` varchar(255) DEFAULT NULL,
  `id_opd_fk` int(11) DEFAULT NULL,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_qrsignature`
--

INSERT INTO `tbl_qrsignature` (`id`, `tgl`, `judul`, `qrcode`, `id_opd_fk`, `nomor_surat`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1113, '2021-09-17', 'Dokumen Telah Diverifikasi', '1631846591894.png', 1, 'C21', '2021-09-17 02:43:11', 1, '2021-09-17 02:43:12', 1),
(1114, '2021-09-20', 'Dokumen Telah Diverifikasi', '1632114547792.png', 59, 'stuy', '2021-09-20 05:09:07', 35, '2021-09-20 05:09:07', 35);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_masuk`
--

CREATE TABLE `tbl_surat_masuk` (
  `id` int(11) NOT NULL,
  `pengirim` varchar(200) DEFAULT NULL,
  `no_surat` varchar(50) NOT NULL,
  `tgl_surat` date DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `qrcode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_surat_masuk`
--

INSERT INTO `tbl_surat_masuk` (`id`, `pengirim`, `no_surat`, `tgl_surat`, `perihal`, `berkas`, `qrcode`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6293, 'KEMENTRIAN KOMUNIKASI DAN INFORMATIKA', 'ST001/98', '2021-09-15', 'RAPAT MEMBAHAS TANDA TANGAN ELEKTRONIK', '1631849499156.pdf', '1631849499163.svg', '2021-09-17 03:31:39', NULL, '2021-09-17 03:31:39', NULL),
(6294, 'Tes dari Kementrian Kominfo', '00123', '2021-09-17', 'Percobaan', '1631868620122.pdf', '1631868620124.svg', '2021-09-17 08:50:20', NULL, '2021-09-17 08:50:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'user' COMMENT 'superadmin,admin,umum,subkoor_kepegawaian,subkoor_organisasi,subkoor_pengembangan,subkoor_umum,kabag,seketaris,direktur',
  `id_opd_fk` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 0,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `avatar`, `level`, `id_opd_fk`, `active`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Admin Utama', '1629259362491.png', 'superadmin', NULL, 1, 'tapisdev@gmail.com', NULL, '$2y$10$nhP63bbqnCmo8nabfx6nh.wRKQLbg8L8rgX0YWap0pHvvVORYpuc6', 'cZTez9CYAJq3w42kErrlFkSWemx1PZbUDGgwQl6flEnWdYiYDyE0GbHhHI7x', '2021-05-04 19:41:44', '2021-09-26 04:38:08'),
(34, 'subkoor_umum', 'Theodore Santos', NULL, 'subkoor_umum', 46, 1, 'rinyq@mailinator.com', NULL, '$2y$10$YtdR5MVVNlDmgtTOvZ1dKOU8eXVdUkKyAQ2fYghOYxgVaABlihWeS', NULL, '2021-08-26 04:32:57', '2021-10-02 06:54:59'),
(35, 'umum', 'Knox Harrell', NULL, 'umum', 46, 1, 'vykum@mailinator.com', NULL, '$2y$10$7WVgNXltF7U14id0bQ9mXOG4Y1o.WyDkxD4.er4N1uAvPyGw2t0xG', NULL, '2021-08-26 04:34:54', '2021-09-26 03:48:01'),
(39, 'subkoor_tuk', 'Harun', NULL, 'subkoor_kepegawaian', NULL, 1, 'subkoorkepegawaian@gmail.com', NULL, '$2y$10$OgY4i9BamgYZmsHMmzU52uHqAQl4v2X8b01Sh2isOdMAv1LlhzpZy', NULL, '2021-10-02 06:29:10', '2021-10-02 06:29:10'),
(40, 'kabag', 'Sancaka', NULL, 'kabag', NULL, 1, 'sancaka@gmail.com', NULL, '$2y$10$0A9xiF6qwbj7RDhpv9w0iO/XmOmXydR2Qcx.NrqGBhqqnJhBf2Rsi', NULL, '2021-10-02 07:21:22', '2021-10-02 07:21:22'),
(41, 'sekretaris', 'Fahrizal Darminto', NULL, 'seketaris', NULL, 1, 'fahrizal@gmail.com', NULL, '$2y$10$I15TC5DyC.SK0GJD2e2VfOnF7WzJLldeQtG6xsMI0o7i8puqWA.S2', NULL, '2021-10-02 07:31:01', '2021-10-02 07:31:01'),
(42, 'direktur', 'Tremenza', NULL, 'direktur', NULL, 1, 'direktur@gmail.com', NULL, '$2y$10$Jgyb7q03KoeOMggDa/eyU.KtCEvZ1219KKmHzLraaBSC3VMsepHJG', NULL, '2021-10-02 08:09:47', '2021-10-02 08:09:47');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bar_opd_tahunan`
-- (See below for the actual view)
--
CREATE TABLE `v_bar_opd_tahunan` (
`jumlah` bigint(21)
,`id_opd_fk` int(11)
,`nama_opd` varchar(255)
,`alias_opd` varchar(100)
,`periode` varchar(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bar_penandatangan`
-- (See below for the actual view)
--
CREATE TABLE `v_bar_penandatangan` (
`jumlah` bigint(21)
,`id_jenis_ttd_fk` int(11)
,`jenis_ttd` varchar(255)
,`periode` varchar(7)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bar_perangkat_daerah`
-- (See below for the actual view)
--
CREATE TABLE `v_bar_perangkat_daerah` (
`jumlah` bigint(21)
,`id_opd_fk` int(11)
,`nama_opd` varchar(255)
,`alias_opd` varchar(100)
,`periode` varchar(7)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bar_signature`
-- (See below for the actual view)
--
CREATE TABLE `v_bar_signature` (
`jumlah` bigint(21)
,`id_opd_fk` int(11)
,`nama_opd` varchar(255)
,`alias_opd` varchar(100)
,`periode` varchar(7)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bar_signature_tahunan`
-- (See below for the actual view)
--
CREATE TABLE `v_bar_signature_tahunan` (
`jumlah` bigint(21)
,`id_opd_fk` int(11)
,`nama_opd` varchar(255)
,`alias_opd` varchar(100)
,`periode` varchar(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bar_ttd_tahunan`
-- (See below for the actual view)
--
CREATE TABLE `v_bar_ttd_tahunan` (
`jumlah` bigint(21)
,`id_jenis_ttd_fk` int(11)
,`jenis_ttd` varchar(255)
,`periode` varchar(4)
);

-- --------------------------------------------------------

--
-- Structure for view `v_bar_opd_tahunan`
--
DROP TABLE IF EXISTS `v_bar_opd_tahunan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`qrcodelpg2020`@`localhost` SQL SECURITY DEFINER VIEW `v_bar_opd_tahunan`  AS  select count(0) AS `jumlah`,`tbl_qrcode`.`id_opd_fk` AS `id_opd_fk`,`tbl_opd`.`nama_opd` AS `nama_opd`,`tbl_opd`.`alias_opd` AS `alias_opd`,date_format(`tbl_qrcode`.`tgl_surat`,'%Y') AS `periode` from (`tbl_qrcode` join `tbl_opd`) where `tbl_qrcode`.`id_opd_fk` = `tbl_opd`.`id_opd` group by `tbl_opd`.`id_opd`,date_format(`tbl_qrcode`.`tgl_surat`,'%Y') ;

-- --------------------------------------------------------

--
-- Structure for view `v_bar_penandatangan`
--
DROP TABLE IF EXISTS `v_bar_penandatangan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`qrcodelpg2020`@`localhost` SQL SECURITY DEFINER VIEW `v_bar_penandatangan`  AS  select count(0) AS `jumlah`,`tbl_qrcode`.`id_jenis_ttd_fk` AS `id_jenis_ttd_fk`,`tbl_jenis_ttd`.`jenis_ttd` AS `jenis_ttd`,date_format(`tbl_qrcode`.`tgl_surat`,'%m-%Y') AS `periode` from (`tbl_qrcode` join `tbl_jenis_ttd`) where `tbl_qrcode`.`id_jenis_ttd_fk` = `tbl_jenis_ttd`.`id_jenis_ttd` group by `tbl_qrcode`.`id_jenis_ttd_fk`,date_format(`tbl_qrcode`.`tgl_surat`,'%m-%Y') ;

-- --------------------------------------------------------

--
-- Structure for view `v_bar_perangkat_daerah`
--
DROP TABLE IF EXISTS `v_bar_perangkat_daerah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`qrcodelpg2020`@`localhost` SQL SECURITY DEFINER VIEW `v_bar_perangkat_daerah`  AS  select count(0) AS `jumlah`,`tbl_qrcode`.`id_opd_fk` AS `id_opd_fk`,`tbl_opd`.`nama_opd` AS `nama_opd`,`tbl_opd`.`alias_opd` AS `alias_opd`,date_format(`tbl_qrcode`.`tgl_surat`,'%m-%Y') AS `periode` from (`tbl_qrcode` join `tbl_opd`) where `tbl_qrcode`.`id_opd_fk` = `tbl_opd`.`id_opd` group by `tbl_opd`.`id_opd`,date_format(`tbl_qrcode`.`tgl_surat`,'%m-%Y') ;

-- --------------------------------------------------------

--
-- Structure for view `v_bar_signature`
--
DROP TABLE IF EXISTS `v_bar_signature`;

CREATE ALGORITHM=UNDEFINED DEFINER=`qrcodelpg2020`@`localhost` SQL SECURITY DEFINER VIEW `v_bar_signature`  AS  select count(0) AS `jumlah`,`tbl_qrsignature`.`id_opd_fk` AS `id_opd_fk`,`tbl_opd`.`nama_opd` AS `nama_opd`,`tbl_opd`.`alias_opd` AS `alias_opd`,date_format(`tbl_qrsignature`.`tgl`,'%m-%Y') AS `periode` from (`tbl_qrsignature` join `tbl_opd`) where `tbl_qrsignature`.`id_opd_fk` = `tbl_opd`.`id_opd` group by `tbl_opd`.`id_opd`,date_format(`tbl_qrsignature`.`tgl`,'%m-%Y') ;

-- --------------------------------------------------------

--
-- Structure for view `v_bar_signature_tahunan`
--
DROP TABLE IF EXISTS `v_bar_signature_tahunan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`qrcodelpg2020`@`localhost` SQL SECURITY DEFINER VIEW `v_bar_signature_tahunan`  AS  select count(0) AS `jumlah`,`tbl_qrsignature`.`id_opd_fk` AS `id_opd_fk`,`tbl_opd`.`nama_opd` AS `nama_opd`,`tbl_opd`.`alias_opd` AS `alias_opd`,date_format(`tbl_qrsignature`.`tgl`,'%Y') AS `periode` from (`tbl_qrsignature` join `tbl_opd`) where `tbl_qrsignature`.`id_opd_fk` = `tbl_opd`.`id_opd` group by `tbl_opd`.`id_opd`,date_format(`tbl_qrsignature`.`tgl`,'%Y') ;

-- --------------------------------------------------------

--
-- Structure for view `v_bar_ttd_tahunan`
--
DROP TABLE IF EXISTS `v_bar_ttd_tahunan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`qrcodelpg2020`@`localhost` SQL SECURITY DEFINER VIEW `v_bar_ttd_tahunan`  AS  select count(0) AS `jumlah`,`tbl_qrcode`.`id_jenis_ttd_fk` AS `id_jenis_ttd_fk`,`tbl_jenis_ttd`.`jenis_ttd` AS `jenis_ttd`,date_format(`tbl_qrcode`.`tgl_surat`,'%Y') AS `periode` from (`tbl_qrcode` join `tbl_jenis_ttd`) where `tbl_qrcode`.`id_jenis_ttd_fk` = `tbl_jenis_ttd`.`id_jenis_ttd` group by `tbl_qrcode`.`id_jenis_ttd_fk`,date_format(`tbl_qrcode`.`tgl_surat`,'%Y') ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_surat_keluar`
--
ALTER TABLE `detail_surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_surat_masuk`
--
ALTER TABLE `detail_surat_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sm_fk` (`id_sm_fk`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_Id`),
  ADD KEY `log_id_user` (`log_IdUser`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_Id`);

--
-- Indexes for table `tbl_jenis_ttd`
--
ALTER TABLE `tbl_jenis_ttd`
  ADD PRIMARY KEY (`id_jenis_ttd`);

--
-- Indexes for table `tbl_opd`
--
ALTER TABLE `tbl_opd`
  ADD PRIMARY KEY (`id_opd`);

--
-- Indexes for table `tbl_qrcode`
--
ALTER TABLE `tbl_qrcode`
  ADD PRIMARY KEY (`id_qr`),
  ADD KEY `id_opd_fk` (`id_opd_fk`),
  ADD KEY `id_jenis_ttd_fk` (`id_jenis_ttd_fk`);

--
-- Indexes for table `tbl_qrsignature`
--
ALTER TABLE `tbl_qrsignature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_opd_fk` (`pengirim`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_opd_fk` (`id_opd_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_surat_keluar`
--
ALTER TABLE `detail_surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_surat_masuk`
--
ALTER TABLE `detail_surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=719;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_jenis_ttd`
--
ALTER TABLE `tbl_jenis_ttd`
  MODIFY `id_jenis_ttd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_opd`
--
ALTER TABLE `tbl_opd`
  MODIFY `id_opd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_qrcode`
--
ALTER TABLE `tbl_qrcode`
  MODIFY `id_qr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6290;

--
-- AUTO_INCREMENT for table `tbl_qrsignature`
--
ALTER TABLE `tbl_qrsignature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1115;

--
-- AUTO_INCREMENT for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6295;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_surat_masuk`
--
ALTER TABLE `detail_surat_masuk`
  ADD CONSTRAINT `detail_surat_masuk_ibfk_1` FOREIGN KEY (`id_sm_fk`) REFERENCES `tbl_surat_masuk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_opd_fk`) REFERENCES `tbl_opd` (`id_opd`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
