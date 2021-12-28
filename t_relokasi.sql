-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2021 at 10:37 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

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
-- Table structure for table `t_relokasi`
--

CREATE TABLE `t_relokasi` (
  `relokasi_id` bigint(20) UNSIGNED NOT NULL,
  `relokasi_tanggal` date NOT NULL,
  `relokasi_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_asal` int(11) NOT NULL,
  `kelurahan_asal` int(11) NOT NULL,
  `relokasi_asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relokasi_luas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relokasi_jumlah_jiwa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relokasi_status_tanah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relokasi_sarana_prasarana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_relokasi` int(11) NOT NULL,
  `kelurahan_relokasi` int(11) NOT NULL,
  `lokasi_relokasi` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relokasi_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_relokasi`
--

INSERT INTO `t_relokasi` (`relokasi_id`, `relokasi_tanggal`, `relokasi_name`, `kecamatan_asal`, `kelurahan_asal`, `relokasi_asal`, `relokasi_luas`, `relokasi_jumlah_jiwa`, `relokasi_status_tanah`, `relokasi_sarana_prasarana`, `kecamatan_relokasi`, `kelurahan_relokasi`, `lokasi_relokasi`, `relokasi_keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2021-12-31', 'Harto Rajata', 0, 0, 'Dk. Pasteur No. 113, Cirebon 14724, DIY', '1118', '6', 'Baru', 'Ada', 0, 0, '', 'Lorem ipsum', '2021-12-17 17:00:00', '2021-12-21 19:27:46', NULL),
(2, '2021-12-28', 'Karimah Hartati', 0, 0, 'Ki. Abdul. Muis No. 704, Surabaya 71846, Papua', '742', '4', '', '', 0, 0, '', '', '2021-12-17 17:00:00', NULL, NULL),
(3, '2021-12-23', 'Elma Pertiwi', 0, 0, 'Psr. Tambun No. 334, Administrasi Jakarta Selatan 62882, Kalbar', '1387', '10', '', '', 0, 0, '', '', '2021-12-17 17:00:00', NULL, NULL),
(4, '2021-12-19', 'Indah Umi Suryatmi', 0, 0, 'Jln. W.R. Supratman No. 759, Tasikmalaya 76191, Malut', '696', '7', '', '', 0, 0, '', '', '2021-12-17 17:00:00', NULL, NULL),
(5, '2021-12-22', 'Pia Uyainah', 0, 0, 'Psr. Jaksa No. 665, Pangkal Pinang 72785, Sulsel', '619', '9', '', '', 0, 0, '', '', '2021-12-17 17:00:00', NULL, NULL),
(6, '2021-12-25', 'Kezia Mila Yolanda M.TI.', 0, 0, 'Kpg. Rajawali Timur No. 104, Bima 33274, Aceh', '1103', '3', '', '', 0, 0, '', '', '2021-12-17 17:00:00', NULL, NULL),
(7, '2021-12-21', 'Jamalia Mulyani', 0, 0, 'Ds. K.H. Maskur No. 40, Bandung 96600, Sumbar', '1403', '6', '', '', 0, 0, '', '', '2021-12-17 17:00:00', NULL, NULL),
(8, '2021-12-29', 'Natalia Zelaya Mayasari', 0, 0, 'Gg. Banceng Pondok No. 848, Binjai 21300, Bengkulu', '1094', '4', '', '', 0, 0, '', '', '2021-12-17 17:00:00', NULL, NULL),
(9, '2021-12-30', 'Wulan Ellis Astuti S.I.Kom', 0, 0, 'Ds. Pacuan Kuda No. 59, Madiun 66387, Jateng', '896', '10', '', '', 0, 0, '', '', '2021-12-17 17:00:00', NULL, NULL),
(10, '2021-12-27', 'Diah Puspasari', 0, 0, 'Psr. Bakau Griya Utama No. 754, Cilegon 17479, Kepri', '622', '3', '', '', 0, 0, '', '', '2021-12-17 17:00:00', NULL, NULL),
(11, '2021-10-30', 'sd', 0, 0, 'asd', 'ads', 'asd', 'asd', 'asd', 0, 0, '', 'ad', '2021-12-21 18:59:59', '2021-12-21 19:08:07', '2021-12-21 19:08:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_relokasi`
--
ALTER TABLE `t_relokasi`
  ADD PRIMARY KEY (`relokasi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_relokasi`
--
ALTER TABLE `t_relokasi`
  MODIFY `relokasi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
