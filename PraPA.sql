-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2020 at 08:00 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s_2019_uni`
--

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `id` int(10) NOT NULL,
  `kode_angkatan` varchar(50) DEFAULT NULL,
  `nama_angkatan` varchar(100) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `angkatan_kelas`
--

CREATE TABLE `angkatan_kelas` (
  `id` int(10) NOT NULL,
  `angkatan_id` int(10) DEFAULT NULL,
  `nama_kelas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(10) NOT NULL,
  `kode_dosen` varchar(100) DEFAULT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `nama_dosen` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `bid_keahlian` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_recommendation`
--

CREATE TABLE `dosen_recommendation` (
  `id` int(10) NOT NULL,
  `dosen_id` int(10) DEFAULT NULL,
  `nama_rekomendasi` varchar(200) DEFAULT NULL,
  `is_lock` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(10) NOT NULL,
  `kode_fakultas` varchar(100) DEFAULT NULL,
  `nama_fakultas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fakultas_jurusan`
--

CREATE TABLE `fakultas_jurusan` (
  `id` int(10) NOT NULL,
  `fakultas_id` int(10) DEFAULT NULL,
  `jurusan_id` int(10) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(10) NOT NULL,
  `kode_jurusan` varchar(100) DEFAULT NULL,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(10) NOT NULL,
  `kelas_id` int(10) DEFAULT NULL,
  `angkatan_id` int(10) DEFAULT NULL,
  `jurusan_id` int(10) DEFAULT NULL,
  `nim` varchar(100) DEFAULT NULL,
  `nama_mahasiswa` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

CREATE TABLE `option` (
  `id` int(10) NOT NULL,
  `syarat_terbit_skpa` varchar(200) DEFAULT NULL,
  `info_tambahan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `option`
--

INSERT INTO `option` (`id`, `syarat_terbit_skpa`, `info_tambahan`) VALUES
(1, 'syarat_berkas.zip', '<p>test 123nn</p>');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_judul`
--

CREATE TABLE `pengajuan_judul` (
  `id` int(10) NOT NULL,
  `skpa_gelombang_daftar_id` int(10) DEFAULT NULL,
  `nama_judul` varchar(200) DEFAULT NULL,
  `file_judul` varchar(200) DEFAULT NULL,
  `file_seminar` varchar(200) DEFAULT NULL,
  `file_revisi` varchar(200) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `waktu_upload` datetime DEFAULT NULL,
  `waktu_upload_revisi` datetime DEFAULT NULL,
  `is_revisi` enum('-1','0','1') DEFAULT '-1',
  `is_revisi_acc` enum('-1','0','1') DEFAULT '-1',
  `is_revisi_upload` enum('0','1') DEFAULT '0',
  `is_acc_1` enum('0','1','-1') DEFAULT '-1',
  `waktu_acc_1` datetime DEFAULT NULL,
  `is_acc_2` enum('0','1','-1') DEFAULT '-1',
  `waktu_acc_2` datetime DEFAULT NULL,
  `is_acc_2_1` enum('0','1','-1') DEFAULT '-1',
  `waktu_acc_2_1` datetime DEFAULT NULL,
  `is_berkas_seminar_upload` enum('0','1') DEFAULT '0',
  `waktu_upload_berkas_seminar` datetime DEFAULT NULL,
  `is_acc_3` enum('0','1','-1') DEFAULT '-1',
  `waktu_acc_3` datetime DEFAULT NULL,
  `is_read` enum('0','1') DEFAULT '0',
  `ket_tolak` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `skpa`
--

CREATE TABLE `skpa` (
  `id` int(10) NOT NULL,
  `kode_skpa` varchar(100) DEFAULT NULL,
  `nama_skpa` varchar(100) DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `skpa_gelombang`
--

CREATE TABLE `skpa_gelombang` (
  `id` int(10) NOT NULL,
  `skpa_id` int(10) DEFAULT NULL,
  `gelombang` int(10) DEFAULT NULL,
  `tanggal_judul_start` date DEFAULT NULL,
  `tanggal_judul_end` date DEFAULT NULL,
  `tanggal_sidang_start` date DEFAULT NULL,
  `tanggal_sidang_end` date DEFAULT NULL,
  `tanggal_hasil_sidang` date DEFAULT NULL,
  `tanggal_seminar_start` date DEFAULT NULL,
  `tanggal_seminar_end` date DEFAULT NULL,
  `tanggal_hasil_seminar` date DEFAULT NULL,
  `tanggal_terbit_skpa` date DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '0',
  `notif_to_seminar` enum('0','1') DEFAULT '0',
  `notif_result_seminar` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `skpa_gelombang_daftar`
--

CREATE TABLE `skpa_gelombang_daftar` (
  `id` int(10) NOT NULL,
  `skpa_gelombang_id` int(10) DEFAULT NULL,
  `mahasiswa_id` int(10) DEFAULT NULL,
  `pembimbing_1_id` int(10) DEFAULT NULL,
  `pembimbing_2_id` int(10) DEFAULT NULL,
  `penguji_id` int(10) DEFAULT NULL,
  `tanggal_seminar` date DEFAULT NULL,
  `jam_seminar` time DEFAULT NULL,
  `ruangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `kode_user` varchar(50) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `posisi` varchar(200) DEFAULT NULL,
  `gaji` int(50) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `kode_user`, `nama`, `alamat`, `no_telp`, `username`, `password`, `posisi`, `gaji`) VALUES
(1, NULL, 'KOORDINATOR PA', 'TELKOM UNIVERSITY', NULL, 'koorpa', 'koorpa', 'Koordinator PA', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `angkatan_kelas`
--
ALTER TABLE `angkatan_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen_recommendation`
--
ALTER TABLE `dosen_recommendation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fakultas_jurusan`
--
ALTER TABLE `fakultas_jurusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakultas_id` (`fakultas_id`),
  ADD KEY `jurusan_id` (`jurusan_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurusan_id` (`jurusan_id`),
  ADD KEY `angkatan_id` (`angkatan_id`);

--
-- Indexes for table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_judul`
--
ALTER TABLE `pengajuan_judul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skpa_gelombang_daftar_id` (`skpa_gelombang_daftar_id`);

--
-- Indexes for table `skpa`
--
ALTER TABLE `skpa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skpa_gelombang`
--
ALTER TABLE `skpa_gelombang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skpa_id` (`skpa_id`);

--
-- Indexes for table `skpa_gelombang_daftar`
--
ALTER TABLE `skpa_gelombang_daftar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skpa_gelombang_id` (`skpa_gelombang_id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `pembimbing_1_id` (`pembimbing_1_id`),
  ADD KEY `pembimbing_2_id` (`pembimbing_2_id`),
  ADD KEY `penguji_id` (`penguji_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angkatan`
--
ALTER TABLE `angkatan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `angkatan_kelas`
--
ALTER TABLE `angkatan_kelas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen_recommendation`
--
ALTER TABLE `dosen_recommendation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fakultas_jurusan`
--
ALTER TABLE `fakultas_jurusan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `option`
--
ALTER TABLE `option`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengajuan_judul`
--
ALTER TABLE `pengajuan_judul`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skpa`
--
ALTER TABLE `skpa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skpa_gelombang`
--
ALTER TABLE `skpa_gelombang`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skpa_gelombang_daftar`
--
ALTER TABLE `skpa_gelombang_daftar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen_recommendation`
--
ALTER TABLE `dosen_recommendation`
  ADD CONSTRAINT `dosen_recommendation_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fakultas_jurusan`
--
ALTER TABLE `fakultas_jurusan`
  ADD CONSTRAINT `fakultas_jurusan_ibfk_1` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fakultas_jurusan_ibfk_2` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`angkatan_id`) REFERENCES `angkatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_judul`
--
ALTER TABLE `pengajuan_judul`
  ADD CONSTRAINT `pengajuan_judul_ibfk_1` FOREIGN KEY (`skpa_gelombang_daftar_id`) REFERENCES `skpa_gelombang_daftar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skpa_gelombang`
--
ALTER TABLE `skpa_gelombang`
  ADD CONSTRAINT `skpa_gelombang_ibfk_1` FOREIGN KEY (`skpa_id`) REFERENCES `skpa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skpa_gelombang_daftar`
--
ALTER TABLE `skpa_gelombang_daftar`
  ADD CONSTRAINT `skpa_gelombang_daftar_ibfk_1` FOREIGN KEY (`skpa_gelombang_id`) REFERENCES `skpa_gelombang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skpa_gelombang_daftar_ibfk_2` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skpa_gelombang_daftar_ibfk_3` FOREIGN KEY (`pembimbing_1_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skpa_gelombang_daftar_ibfk_4` FOREIGN KEY (`pembimbing_2_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skpa_gelombang_daftar_ibfk_5` FOREIGN KEY (`penguji_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
