-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 12:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `wilayah_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `wilayah_id`, `nama`) VALUES
(46, 6, 'DxP Yangambi'),
(47, 6, 'DxP Langkat'),
(48, 6, 'DxP 540 NG'),
(49, 6, 'DxP PPKS 540'),
(50, 6, 'DxP Simalungun'),
(51, 6, 'DxP AVROS'),
(52, 6, 'DxP PPKS 239'),
(53, 6, 'DxP PPKS 718'),
(54, 6, 'DxP Sriwijaya'),
(55, 6, 'Dxp Marehat'),
(56, 6, 'DyxP Sungai Pancur 1'),
(57, 6, 'DP SAIN 1'),
(58, 6, 'DxP Dami Mas'),
(59, 6, 'DxP TN 1'),
(60, 6, 'DxP Supreme'),
(61, 6, 'DXP Topaz 1'),
(62, 6, 'DxP Socfindo MT Gano'),
(63, 6, 'DxP Bah Lias 1'),
(64, 6, 'DxP La Me'),
(65, 6, 'DxP FR 1'),
(66, 6, 'DxP FR 2'),
(67, 6, 'DxP Themba'),
(71, 6, 'DP SAIN 2');

-- --------------------------------------------------------

--
-- Table structure for table `alternatif_bobot`
--

CREATE TABLE `alternatif_bobot` (
  `id` int(11) NOT NULL,
  `alternatif_id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `sub_kriteria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif_bobot`
--

INSERT INTO `alternatif_bobot` (`id`, `alternatif_id`, `kriteria_id`, `sub_kriteria_id`) VALUES
(282, 46, 28, 68),
(283, 46, 29, 73),
(284, 46, 30, 77),
(285, 46, 31, 81),
(286, 46, 32, 88),
(287, 47, 28, 68),
(288, 47, 29, 73),
(289, 47, 30, 77),
(290, 47, 31, 81),
(291, 47, 32, 88),
(292, 48, 28, 67),
(293, 48, 29, 73),
(294, 48, 30, 79),
(295, 48, 31, 81),
(296, 48, 32, 88),
(297, 49, 28, 69),
(298, 49, 29, 73),
(299, 49, 30, 76),
(300, 49, 31, 81),
(301, 49, 32, 89),
(302, 50, 28, 68),
(303, 50, 29, 73),
(304, 50, 30, 76),
(305, 50, 31, 81),
(306, 50, 32, 89),
(307, 51, 28, 67),
(308, 51, 29, 72),
(309, 51, 30, 76),
(310, 51, 31, 81),
(311, 51, 32, 89),
(312, 52, 28, 69),
(313, 52, 29, 72),
(314, 52, 30, 76),
(315, 52, 31, 81),
(316, 52, 32, 88),
(317, 53, 28, 68),
(318, 53, 29, 72),
(319, 53, 30, 75),
(320, 53, 31, 81),
(321, 53, 32, 88),
(322, 54, 28, 66),
(323, 54, 29, 72),
(324, 54, 30, 76),
(325, 54, 31, 80),
(326, 54, 32, 89),
(327, 55, 28, 69),
(328, 55, 29, 71),
(329, 55, 30, 76),
(330, 55, 31, 83),
(331, 55, 32, 88),
(332, 56, 28, 68),
(333, 56, 29, 72),
(334, 56, 30, 76),
(335, 56, 31, 83),
(336, 56, 32, 88),
(337, 57, 28, 68),
(338, 57, 29, 73),
(339, 57, 30, 76),
(340, 57, 31, 81),
(341, 57, 32, 88),
(342, 58, 28, 68),
(343, 58, 29, 73),
(344, 58, 30, 75),
(345, 58, 31, 80),
(346, 58, 32, 88),
(357, 59, 28, 69),
(358, 59, 29, 71),
(359, 59, 30, 76),
(360, 59, 31, 80),
(361, 59, 32, 88),
(362, 61, 28, 66),
(363, 61, 29, 73),
(364, 61, 30, 75),
(365, 61, 31, 83),
(366, 61, 32, 88),
(367, 60, 28, 67),
(368, 60, 29, 72),
(369, 60, 30, 77),
(370, 60, 31, 80),
(371, 60, 32, 89),
(372, 62, 28, 67),
(373, 62, 29, 72),
(374, 62, 30, 76),
(375, 62, 31, 80),
(376, 62, 32, 88),
(382, 63, 28, 66),
(383, 63, 29, 72),
(384, 63, 30, 76),
(385, 63, 31, 80),
(386, 63, 32, 88),
(387, 64, 28, 67),
(388, 64, 29, 72),
(389, 64, 30, 76),
(390, 64, 31, 80),
(391, 64, 32, 88),
(392, 65, 28, 67),
(393, 65, 29, 73),
(394, 65, 30, 77),
(395, 65, 31, 80),
(396, 65, 32, 88),
(397, 66, 28, 66),
(398, 66, 29, 73),
(399, 66, 30, 77),
(400, 66, 31, 80),
(401, 66, 32, 88),
(412, 67, 28, 69),
(413, 67, 29, 72),
(414, 67, 30, 75),
(415, 67, 31, 80),
(416, 67, 32, 88),
(427, 71, 28, 67),
(428, 71, 29, 73),
(429, 71, 30, 76),
(430, 71, 31, 81),
(431, 71, 32, 88);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `alternatif_id` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `nilai` text NOT NULL,
  `wilayah_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `alternatif_id`, `no`, `nilai`, `wilayah_id`) VALUES
(790, 49, 1, '{\"nilai_akhir\":\"0.830\"}', 6),
(791, 48, 2, '{\"nilai_akhir\":\"0.790\"}', 6),
(792, 46, 3, '{\"nilai_akhir\":\"0.770\"}', 6),
(793, 47, 4, '{\"nilai_akhir\":\"0.770\"}', 6),
(794, 50, 5, '{\"nilai_akhir\":\"0.770\"}', 6),
(795, 65, 6, '{\"nilai_akhir\":\"0.760\"}', 6),
(796, 60, 7, '{\"nilai_akhir\":\"0.750\"}', 6),
(797, 67, 8, '{\"nilai_akhir\":\"0.750\"}', 6),
(798, 59, 9, '{\"nilai_akhir\":\"0.740\"}', 6),
(799, 52, 10, '{\"nilai_akhir\":\"0.740\"}', 6),
(800, 58, 11, '{\"nilai_akhir\":\"0.740\"}', 6),
(801, 57, 12, '{\"nilai_akhir\":\"0.730\"}', 6),
(802, 66, 13, '{\"nilai_akhir\":\"0.700\"}', 6),
(803, 62, 14, '{\"nilai_akhir\":\"0.670\"}', 6),
(804, 64, 15, '{\"nilai_akhir\":\"0.670\"}', 6),
(805, 71, 16, '{\"nilai_akhir\":\"0.670\"}', 6),
(806, 55, 17, '{\"nilai_akhir\":\"0.665\"}', 6),
(807, 51, 18, '{\"nilai_akhir\":\"0.660\"}', 6),
(808, 56, 19, '{\"nilai_akhir\":\"0.655\"}', 6),
(809, 54, 20, '{\"nilai_akhir\":\"0.650\"}', 6),
(810, 53, 21, '{\"nilai_akhir\":\"0.640\"}', 6),
(811, 63, 22, '{\"nilai_akhir\":\"0.610\"}', 6),
(812, 61, 23, '{\"nilai_akhir\":\"0.545\"}', 6);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bobot` float(8,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `status_sub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`, `bobot`, `status`, `status_sub`) VALUES
(28, 'Potensi TBS', 0.30, 'benefit', 1),
(29, 'Potensi CPO', 0.20, 'benefit', 1),
(30, 'Rendemen Minyak', 0.20, 'benefit', 1),
(31, 'Umur Mulai Panen', 0.10, 'cost', 1),
(32, 'Adaptasi Pada daerah Marjinal', 0.20, 'benefit', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id`, `kriteria_id`, `nama`, `bobot`) VALUES
(65, 28, '&lt; 28 ton/ha/tahun', 1),
(66, 28, '28,00 – 29,99 ton/ha/tahun', 2),
(67, 28, '30,00 – 31,99 ton/ha/tahun', 3),
(68, 28, '32,00 – 33,99 ton/ha/tahun', 4),
(69, 28, '&gt; 34 ton/ha/tahun', 5),
(70, 29, '&lt; 6 ton/ha/tahun', 1),
(71, 29, '6,00 – 7,49 ton/ha/tahun', 2),
(72, 29, '7,50 – 8,49 ton/ha/tahun', 3),
(73, 29, '8,50 – 9,99 ton/ha/tahun', 4),
(74, 29, '&gt; 10 ton/ha/tahun', 5),
(75, 30, '&lt; 26 %', 1),
(76, 30, '26,00 – 27,99 %', 2),
(77, 30, '28,00 – 29,99 %', 3),
(78, 30, '30,00 – 31,99 %', 4),
(79, 30, '&gt; 32 %', 5),
(80, 31, '&lt; 28 Bulan', 1),
(81, 31, '28 Bulan', 2),
(82, 31, '29 Bulan', 3),
(83, 31, '30 Bulan', 4),
(84, 31, '&gt; 30 Bulan', 5),
(85, 32, 'Sangat Kurang', 1),
(86, 32, 'Kurang', 2),
(87, 32, 'Cukup', 3),
(88, 32, 'Baik', 4),
(89, 32, 'Sangat Baik', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telpon` varchar(14) NOT NULL,
  `level` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `alamat`, `telpon`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'jl.KH. harun Nafshi', '082254982931', 1),
(4, 'adrian', '8c4205ec33d8f6caeaaaa0c10a14138c', 'Adriansyah', 'Jl.KH. Harun Nafshi', '085115988685', 0),
(11, 'Anton', '784742a66a3a0c271feced5b149ff8db', 'Anton', 'jl. samarinda', '081234567890', 0),
(13, 'Agus', 'fdf169558242ee051cca1479770ebac3', 'Muh. Agus Rifai', 'Ampen Medang', '085399142105', 0),
(14, 'Yohanes', '493331a7321bf622460493a8cda5e4c4', 'Yohanes Wua', 'Ampen Medang', '085332889836', 0),
(15, 'Yano', '075a2fff503d518209f891ffe5326160', 'Alviano', 'Ampen Medang', '085388970663', 0),
(16, 'Amir', '63eefbd45d89e8c91f24b609f7539942', 'Amiruddin', 'Ampen Medang', '085345300070', 0),
(17, 'Adi', 'c46335eb267e2e1cde5b017acb4cd799', 'Adi Saputra', 'Ampen Medang', '082291645408', 0),
(18, 'Ari', '385973365073f5806adbfe8e20e32af9', 'Juari', 'Tanjung Perepat', '081387605972', 0),
(19, 'Bahar', '4ae47e149782b7133b0c41b92717846f', 'Baharuddin', 'Ampen Medang', '081249598331', 0),
(20, 'Tono', '14d2d4119982cd6c68a566e523cb16ae', 'Suhartono', 'Pantai Harapan', '085247646383', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id`, `nama`, `kabupaten`, `provinsi`) VALUES
(6, 'Batu Putih', 'Berau', 'Kalimantan Timur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelurahan_id` (`wilayah_id`);

--
-- Indexes for table `alternatif_bobot`
--
ALTER TABLE `alternatif_bobot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alternatif_bobot_ibfk_1` (`alternatif_id`),
  ADD KEY `alternatif_bobot_ibfk_2` (`kriteria_id`),
  ADD KEY `alternatif_bobot_ibfk_3` (`sub_kriteria_id`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelurahan_id` (`wilayah_id`),
  ADD KEY `hasil_ibfk_1` (`alternatif_id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_id` (`kriteria_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `telpon` (`telpon`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `alternatif_bobot`
--
ALTER TABLE `alternatif_bobot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=432;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=813;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`wilayah_id`) REFERENCES `wilayah` (`id`);

--
-- Constraints for table `alternatif_bobot`
--
ALTER TABLE `alternatif_bobot`
  ADD CONSTRAINT `alternatif_bobot_ibfk_1` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id`),
  ADD CONSTRAINT `alternatif_bobot_ibfk_2` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`),
  ADD CONSTRAINT `alternatif_bobot_ibfk_3` FOREIGN KEY (`sub_kriteria_id`) REFERENCES `sub_kriteria` (`id`);

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id`),
  ADD CONSTRAINT `hasil_ibfk_2` FOREIGN KEY (`wilayah_id`) REFERENCES `wilayah` (`id`);

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
