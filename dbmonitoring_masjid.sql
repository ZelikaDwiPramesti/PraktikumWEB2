-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 02:55 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmonitoring_masjid`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_sholat_fardhu`
--

CREATE TABLE `jadwal_sholat_fardhu` (
  `id` int(11) NOT NULL,
  `nik_imam` varchar(16) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_sholat_fardhu`
--

INSERT INTO `jadwal_sholat_fardhu` (`id`, `nik_imam`, `hari`, `tanggal`) VALUES
(1, '1234567890111111', 'AHAD', '2022-12-18'),
(2, '1234567890111112', 'SENIN', '2022-12-18'),
(3, '1234567890111114', 'AHAD', '2022-12-25'),
(4, '1234567890111115', 'AHAD', '2022-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_sholat_jumat`
--

CREATE TABLE `jadwal_sholat_jumat` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` varchar(15) NOT NULL,
  `nik_khatib` varchar(16) NOT NULL,
  `nik_imam` varchar(16) NOT NULL,
  `nik_muadzin` varchar(16) NOT NULL,
  `nik_bilal` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_sholat_jumat`
--

INSERT INTO `jadwal_sholat_jumat` (`id`, `tanggal`, `waktu`, `nik_khatib`, `nik_imam`, `nik_muadzin`, `nik_bilal`) VALUES
(1, '2022-10-14', '12:30 WITA', '1234567890111111', '1234567890111112', '1234567890111113', '1234567890111114'),
(2, '2022-10-21', '12:30 WITA', '1234567890111116', '1234567890111115', '1234567890111111', '1234567890111112');

-- --------------------------------------------------------

--
-- Table structure for table `pengajian`
--

CREATE TABLE `pengajian` (
  `id` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `nik_ustadz` varchar(16) NOT NULL,
  `tema` varchar(100) DEFAULT NULL,
  `keterangan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajian`
--

INSERT INTO `pengajian` (`id`, `hari`, `tanggal`, `nik_ustadz`, `tema`, `keterangan`) VALUES
(1, 'AHAD', '2022-12-25', '1234567890111111', 'peringatan Maulid Nabi', 'Dilaksanakan setelah'),
(2, 'SENIN', '2022-12-25', '1234567890111115', 'Kuliah Subuh', 'Dilaksanakan setelah');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `nik` varchar(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_llahir` date NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pengajian`
-- (See below for the actual view)
--
CREATE TABLE `view_pengajian` (
`id` int(11)
,`hari` varchar(10)
,`tanggal` date
,`penceramah` varchar(255)
,`tema` varchar(100)
,`keterangan` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sholat_fardhu`
-- (See below for the actual view)
--
CREATE TABLE `view_sholat_fardhu` (
`id` int(11)
,`nama_imam` varchar(255)
,`hari` varchar(10)
,`tanggal` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sholat_jumat`
-- (See below for the actual view)
--
CREATE TABLE `view_sholat_jumat` (
`id` int(11)
,`tanggal` date
,`waktu` varchar(15)
,`nama_khatib` varchar(255)
,`nama_imam` varchar(255)
,`nama_muadzin` varchar(255)
,`nama_bilal` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `view_pengajian`
--
DROP TABLE IF EXISTS `view_pengajian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pengajian`  AS SELECT `pengajian`.`id` AS `id`, `pengajian`.`hari` AS `hari`, `pengajian`.`tanggal` AS `tanggal`, `p`.`nama` AS `penceramah`, `pengajian`.`tema` AS `tema`, `pengajian`.`keterangan` AS `keterangan` FROM (`pengajian` left join `petugas` `p` on(`pengajian`.`nik_ustadz` = `p`.`nik`))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_sholat_fardhu`
--
DROP TABLE IF EXISTS `view_sholat_fardhu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sholat_fardhu`  AS SELECT `jadwal_sholat_fardhu`.`id` AS `id`, `imam`.`nama` AS `nama_imam`, `jadwal_sholat_fardhu`.`hari` AS `hari`, `jadwal_sholat_fardhu`.`tanggal` AS `tanggal` FROM (`jadwal_sholat_fardhu` left join `petugas` `imam` on(`jadwal_sholat_fardhu`.`nik_imam` = `imam`.`nik`))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_sholat_jumat`
--
DROP TABLE IF EXISTS `view_sholat_jumat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sholat_jumat`  AS SELECT `jadwal_sholat_jumat`.`id` AS `id`, `jadwal_sholat_jumat`.`tanggal` AS `tanggal`, `jadwal_sholat_jumat`.`waktu` AS `waktu`, `khatib`.`nama` AS `nama_khatib`, `imam`.`nama` AS `nama_imam`, `muadzin`.`nama` AS `nama_muadzin`, `bilal`.`nama` AS `nama_bilal` FROM ((((`jadwal_sholat_jumat` left join `petugas` `khatib` on(`jadwal_sholat_jumat`.`nik_khatib` = `khatib`.`nik`)) left join `petugas` `imam` on(`jadwal_sholat_jumat`.`nik_imam` = `imam`.`nik`)) left join `petugas` `muadzin` on(`jadwal_sholat_jumat`.`nik_muadzin` = `muadzin`.`nik`)) left join `petugas` `bilal` on(`jadwal_sholat_jumat`.`nik_bilal` = `bilal`.`nik`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal_sholat_fardhu`
--
ALTER TABLE `jadwal_sholat_fardhu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_sholat_jumat`
--
ALTER TABLE `jadwal_sholat_jumat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajian`
--
ALTER TABLE `pengajian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_sholat_fardhu`
--
ALTER TABLE `jadwal_sholat_fardhu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwal_sholat_jumat`
--
ALTER TABLE `jadwal_sholat_jumat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengajian`
--
ALTER TABLE `pengajian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
