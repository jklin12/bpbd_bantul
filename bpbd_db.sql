-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2021 at 08:42 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpbd_db`
--

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
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2021_09_06_133519_create_m_bencanas_table', 1),
(11, '2021_09_09_112308_kecamatan', 1),
(12, '2021_09_09_112412_kelurahan', 1),
(13, '2021_09_20_143344_jenis', 2),
(14, '2021_12_09_000023_prebaikan', 3),
(16, '2021_12_15_110758_t_relokasi', 4);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_bencana`
--

CREATE TABLE `t_bencana` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kecamatan` int(11) NOT NULL,
  `kelurahan` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('Mitigasi','Rehabilitasi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) DEFAULT NULL,
  `panjang` int(11) NOT NULL,
  `lebar` int(11) NOT NULL,
  `tinggi` int(11) NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Baru','Proses','Selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Baru',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_bencana`
--

INSERT INTO `t_bencana` (`id`, `kecamatan`, `kelurahan`, `deskripsi`, `kategori`, `type`, `panjang`, `lebar`, `tinggi`, `alamat`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 'kerusakan akibat banjir 2017, 2019', 'Mitigasi', 1, 10, 7, 1, 'Jembatan kajor Wetan (Kali Kilan)', '-7.8991077', '110.2981573', 'Baru', '2021-09-17 13:54:59', '2021-12-02 04:03:49', '2021-12-02 04:03:49'),
(2, 1, 2, 'Test Input', 'Mitigasi', 2, 10, 10, 10, 'Jl abcd', '-7.9077734', '110.3421461', 'Baru', '2021-12-01 12:32:16', '2021-12-01 12:32:16', NULL),
(9, 2, 6, 'Edit data', 'Mitigasi', 1, 10, 101, 1, 'Jembatan kajor Wetan (Kali Kilan)', '-7.8991077', '110.2981573', 'Baru', '2021-12-01 13:04:22', '2021-12-02 04:27:29', NULL),
(10, 2, 6, 'ajdskd', 'Mitigasi', 2, 10, 10, 10, 'Jl jagalan 1', '-7.911678', '110.399558', 'Baru', '2021-12-14 07:24:53', '2021-12-14 07:24:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_data_foto`
--

CREATE TABLE `t_data_foto` (
  `foto_id` int(11) NOT NULL,
  `bencana_id` int(11) NOT NULL,
  `foto_name` varchar(255) NOT NULL,
  `type` enum('bencana','perbaikan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_data_foto`
--

INSERT INTO `t_data_foto` (`foto_id`, `bencana_id`, `foto_name`, `type`) VALUES
(1, 9, 'GKAT1705 (2).JPG1638363007.JPG', 'bencana'),
(2, 9, 'Screenshot_20210710-143138.png1638418851.png', 'bencana'),
(3, 3, 'Screenshot_20210710-144754.png1638987142.png', 'perbaikan'),
(4, 3, 'Screenshot_20210710-144754.png1638987142.png', 'perbaikan'),
(5, 10, 'Screenshot_20210710-144754.png1639466691.png', 'bencana'),
(6, 4, 'Screenshot_20210710-144053.png1639467413.png', 'perbaikan'),
(7, 5, 'Screenshot_20210710-150842.png1639468496.png', 'perbaikan');

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis`
--

CREATE TABLE `t_jenis` (
  `jenis_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_jenis`
--

INSERT INTO `t_jenis` (`jenis_id`, `name`) VALUES
(1, 'railing'),
(2, 'abudment'),
(3, 'talud sungai '),
(4, 'Talud pengaman jalan');

-- --------------------------------------------------------

--
-- Table structure for table `t_kecamatan`
--

CREATE TABLE `t_kecamatan` (
  `kecamatan_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_kecamatan`
--

INSERT INTO `t_kecamatan` (`kecamatan_id`, `name`) VALUES
(1, 'kecmatan baru edit'),
(2, 'Banguntapan'),
(3, 'Bantul'),
(4, 'kecmatan baru edit');

-- --------------------------------------------------------

--
-- Table structure for table `t_kelurahan`
--

CREATE TABLE `t_kelurahan` (
  `kelurahan_id` bigint(20) UNSIGNED NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_kelurahan`
--

INSERT INTO `t_kelurahan` (`kelurahan_id`, `kecamatan_id`, `name`) VALUES
(1, 1, 'Mulyodadi'),
(2, 1, 'Sidomulyo'),
(3, 1, 'Sumbermulyo'),
(4, 2, 'Banguntapan'),
(5, 2, 'Baturetno'),
(6, 2, 'Jagalan'),
(7, 2, 'Ringinharjo'),
(8, 2, 'Sabdodadi'),
(9, 2, 'Trirenggo edit');

-- --------------------------------------------------------

--
-- Table structure for table `t_perbaikan`
--

CREATE TABLE `t_perbaikan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bencana_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_perbaikan`
--

INSERT INTO `t_perbaikan` (`id`, `bencana_id`, `status`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 0, 'Dalama Proses Pengajuan', '2021-12-08 17:54:50', '2021-12-08 17:54:50', NULL),
(2, 2, 1, 'Proses', '2021-12-08 18:10:52', '2021-12-08 18:10:52', NULL),
(3, 2, 1, 'asdhjdash', '2021-12-08 18:12:24', '2021-12-08 18:12:24', NULL),
(4, 10, 0, 'asdjkjasd', '2021-12-14 07:36:54', '2021-12-14 07:36:54', NULL),
(5, 10, 1, 'asdasd', '2021-12-14 07:54:57', '2021-12-14 07:54:57', NULL),
(6, 10, 2, 'asdasd', '2021-12-14 07:55:54', '2021-12-14 07:55:54', NULL),
(7, 10, 0, 'saddas', '2021-12-14 07:56:42', '2021-12-14 07:56:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_relokasi`
--

CREATE TABLE `t_relokasi` (
  `relokasi_id` bigint(20) UNSIGNED NOT NULL,
  `relokasi_tanggal` date NOT NULL,
  `relokasi_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relokasi_asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relokasi_luas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relokasi_jumlah_jiwa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relokasi_status_tanah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relokasi_sarana_prasarana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relokasi_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relokasi_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_relokasi`
--

INSERT INTO `t_relokasi` (`relokasi_id`, `relokasi_tanggal`, `relokasi_name`, `relokasi_asal`, `relokasi_luas`, `relokasi_jumlah_jiwa`, `relokasi_status_tanah`, `relokasi_sarana_prasarana`, `relokasi_lokasi`, `relokasi_keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2021-12-31', 'Harto Rajata', 'Dk. Pasteur No. 113, Cirebon 14724, DIY', '1118', '6', 'Baru', 'Ada', 'Bantul', 'Lorem ipsum', '2021-12-17 17:00:00', '2021-12-21 19:27:46', NULL),
(2, '2021-12-28', 'Karimah Hartati', 'Ki. Abdul. Muis No. 704, Surabaya 71846, Papua', '742', '4', '', '', '', '', '2021-12-17 17:00:00', NULL, NULL),
(3, '2021-12-23', 'Elma Pertiwi', 'Psr. Tambun No. 334, Administrasi Jakarta Selatan 62882, Kalbar', '1387', '10', '', '', '', '', '2021-12-17 17:00:00', NULL, NULL),
(4, '2021-12-19', 'Indah Umi Suryatmi', 'Jln. W.R. Supratman No. 759, Tasikmalaya 76191, Malut', '696', '7', '', '', '', '', '2021-12-17 17:00:00', NULL, NULL),
(5, '2021-12-22', 'Pia Uyainah', 'Psr. Jaksa No. 665, Pangkal Pinang 72785, Sulsel', '619', '9', '', '', '', '', '2021-12-17 17:00:00', NULL, NULL),
(6, '2021-12-25', 'Kezia Mila Yolanda M.TI.', 'Kpg. Rajawali Timur No. 104, Bima 33274, Aceh', '1103', '3', '', '', '', '', '2021-12-17 17:00:00', NULL, NULL),
(7, '2021-12-21', 'Jamalia Mulyani', 'Ds. K.H. Maskur No. 40, Bandung 96600, Sumbar', '1403', '6', '', '', '', '', '2021-12-17 17:00:00', NULL, NULL),
(8, '2021-12-29', 'Natalia Zelaya Mayasari', 'Gg. Banceng Pondok No. 848, Binjai 21300, Bengkulu', '1094', '4', '', '', '', '', '2021-12-17 17:00:00', NULL, NULL),
(9, '2021-12-30', 'Wulan Ellis Astuti S.I.Kom', 'Ds. Pacuan Kuda No. 59, Madiun 66387, Jateng', '896', '10', '', '', '', '', '2021-12-17 17:00:00', NULL, NULL),
(10, '2021-12-27', 'Diah Puspasari', 'Psr. Bakau Griya Utama No. 754, Cilegon 17479, Kepri', '622', '3', '', '', '', '', '2021-12-17 17:00:00', NULL, NULL),
(11, '2021-10-30', 'sd', 'asd', 'ads', 'asd', 'asd', 'asd', 'asd', 'ad', '2021-12-21 18:59:59', '2021-12-21 19:08:07', '2021-12-21 19:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Luwes Dongoran', 'mandasari.damar@example.com', '2021-09-17 13:53:03', '$2y$10$6PSWXsTyI7viBJmcpHeg/.VAiEKbbhg4F26CGKdj9/9y5BleHVCYu', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `t_bencana`
--
ALTER TABLE `t_bencana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_data_foto`
--
ALTER TABLE `t_data_foto`
  ADD PRIMARY KEY (`foto_id`);

--
-- Indexes for table `t_jenis`
--
ALTER TABLE `t_jenis`
  ADD PRIMARY KEY (`jenis_id`);

--
-- Indexes for table `t_kecamatan`
--
ALTER TABLE `t_kecamatan`
  ADD PRIMARY KEY (`kecamatan_id`);

--
-- Indexes for table `t_kelurahan`
--
ALTER TABLE `t_kelurahan`
  ADD PRIMARY KEY (`kelurahan_id`);

--
-- Indexes for table `t_perbaikan`
--
ALTER TABLE `t_perbaikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_relokasi`
--
ALTER TABLE `t_relokasi`
  ADD PRIMARY KEY (`relokasi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_bencana`
--
ALTER TABLE `t_bencana`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_data_foto`
--
ALTER TABLE `t_data_foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_jenis`
--
ALTER TABLE `t_jenis`
  MODIFY `jenis_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_kecamatan`
--
ALTER TABLE `t_kecamatan`
  MODIFY `kecamatan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_kelurahan`
--
ALTER TABLE `t_kelurahan`
  MODIFY `kelurahan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_perbaikan`
--
ALTER TABLE `t_perbaikan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_relokasi`
--
ALTER TABLE `t_relokasi`
  MODIFY `relokasi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
