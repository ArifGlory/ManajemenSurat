-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2021 at 05:36 PM
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
(603, '2021-09-21 15:12:40', 1, 'superadmin menghapus data Wakil Gubernur pada fitur perangkat daerah');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis_ttd`
--

INSERT INTO `tbl_jenis_ttd` (`id_jenis_ttd`, `jenis_ttd`, `nama_pejabat`, `nip_pejabat`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(8, 'Wakil Gubernur', NULL, NULL, 1, '2019-10-07 07:32:08', 1, '2019-10-07 07:32:08', 1, NULL),
(9, 'Sekretaris Daerah', NULL, NULL, 1, '2019-10-07 07:31:57', 1, '2019-10-07 07:31:57', 1, NULL),
(12, 'Asisten Perekonomian dan Pembangunan', NULL, NULL, 1, '2021-09-21 14:22:31', 1, '2021-09-21 14:22:31', 1, '2021-09-21 21:22:31');

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
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_qrcode`
--

INSERT INTO `tbl_qrcode` (`id_qr`, `no_surat`, `tgl_surat`, `id_opd_fk`, `kepada`, `lampiran`, `perihal`, `id_jenis_ttd_fk`, `berkas`, `qrcode`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6281, '1111', '2021-09-17', 2, 'Kabupaten Lampung Tengah', 2, 'coba2', 7, '1631869510683.pdf', '1631869510688.svg', '2021-09-17 09:05:10', NULL, '2021-09-17 09:05:10', NULL);

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
  `level` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'user' COMMENT 'superadmin,admin,umum,subkoor,kabag,seketaris,direktur',
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
(1, 'superadmin', 'Admin Utama', '1629259362491.png', 'superadmin', NULL, 1, 'tapisdev@gmail.com', NULL, '$2y$10$fUMq5.pHzgtS.GjIIP62ZOBRlfX1JKPnP4mX8etCmQ3VQTAIagXxy', 'wrpLkzy4c5YL13fsHFNOTguqK1tvI2c1mmk2eAgosGzYGLHsi6d9duJ3MegD', '2021-05-04 19:41:44', '2021-08-18 04:02:42'),
(34, 'subkoor', 'Theodore Santos', NULL, 'subkoor', 46, 1, 'rinyq@mailinator.com', NULL, '$2y$10$fUMq5.pHzgtS.GjIIP62ZOBRlfX1JKPnP4mX8etCmQ3VQTAIagXxy', NULL, '2021-08-26 04:32:57', '2021-09-17 03:22:27'),
(35, 'admin', 'Knox Harrell', NULL, 'admin', 46, 1, 'vykum@mailinator.com', NULL, '$2y$10$fUMq5.pHzgtS.GjIIP62ZOBRlfX1JKPnP4mX8etCmQ3VQTAIagXxy', NULL, '2021-08-26 04:34:54', '2021-09-17 03:22:49');

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
  MODIFY `log_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=604;

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
  MODIFY `id_jenis_ttd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_opd`
--
ALTER TABLE `tbl_opd`
  MODIFY `id_opd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_qrcode`
--
ALTER TABLE `tbl_qrcode`
  MODIFY `id_qr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6282;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
