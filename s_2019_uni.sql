/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.10-MariaDB : Database - s_2019_uni
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `angkatan` */

DROP TABLE IF EXISTS `angkatan`;

CREATE TABLE `angkatan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_angkatan` varchar(50) DEFAULT NULL,
  `nama_angkatan` varchar(100) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `angkatan` */

insert  into `angkatan`(`id`,`kode_angkatan`,`nama_angkatan`,`is_active`) values 
(1,'ANG-0001','2020','0'),
(2,'ANG-0002','2021','0');

/*Table structure for table `angkatan_kelas` */

DROP TABLE IF EXISTS `angkatan_kelas`;

CREATE TABLE `angkatan_kelas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `angkatan_id` int(10) DEFAULT NULL,
  `nama_kelas` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `angkatan_kelas` */

insert  into `angkatan_kelas`(`id`,`angkatan_id`,`nama_kelas`) values 
(4,1,'SI42-01'),
(5,1,'SI42-02'),
(6,1,'SI42-03'),
(7,1,'SI42-04');

/*Table structure for table `dosen` */

DROP TABLE IF EXISTS `dosen`;

CREATE TABLE `dosen` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_dosen` varchar(100) DEFAULT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `nama_dosen` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `bid_keahlian` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `dosen` */

insert  into `dosen`(`id`,`kode_dosen`,`nip`,`nama_dosen`,`email`,`no_telp`,`alamat`,`username`,`password`,`bid_keahlian`) values 
(1,'WTJ','11223344','Wader Trisepa Jonson','jhonsonwader@gmail.com','083181826488','jhonsonwader@gmail.com','dosen01','dosen01','Statistika'),
(2,'BLE','22334455','Bellatrix Lestrange','bella@gmail.com','08182223123','Gang PGA No. 96','dosen02','dosen02','Manajemen & Relasi HR'),
(4,'TXI','123456789','Trixi Pahntom',NULL,NULL,NULL,NULL,'dosen03','Probabilitas dan Statistika Lanjutan II');

/*Table structure for table `dosen_recommendation` */

DROP TABLE IF EXISTS `dosen_recommendation`;

CREATE TABLE `dosen_recommendation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(10) DEFAULT NULL,
  `nama_rekomendasi` varchar(200) DEFAULT NULL,
  `is_lock` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `dosen_id` (`dosen_id`),
  CONSTRAINT `dosen_recommendation_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `dosen_recommendation` */

insert  into `dosen_recommendation`(`id`,`dosen_id`,`nama_rekomendasi`,`is_lock`) values 
(2,1,'Penerapan aplikasi machine learning','0');

/*Table structure for table `fakultas` */

DROP TABLE IF EXISTS `fakultas`;

CREATE TABLE `fakultas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_fakultas` varchar(100) DEFAULT NULL,
  `nama_fakultas` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `fakultas` */

insert  into `fakultas`(`id`,`kode_fakultas`,`nama_fakultas`) values 
(5,'FKS-0001','Fakultas Ilmu Terapan');

/*Table structure for table `fakultas_jurusan` */

DROP TABLE IF EXISTS `fakultas_jurusan`;

CREATE TABLE `fakultas_jurusan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fakultas_id` int(10) DEFAULT NULL,
  `jurusan_id` int(10) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fakultas_id` (`fakultas_id`),
  KEY `jurusan_id` (`jurusan_id`),
  CONSTRAINT `fakultas_jurusan_ibfk_1` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fakultas_jurusan_ibfk_2` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `fakultas_jurusan` */

insert  into `fakultas_jurusan`(`id`,`fakultas_id`,`jurusan_id`,`is_active`) values 
(9,5,8,'0');

/*Table structure for table `jurusan` */

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_jurusan` varchar(100) DEFAULT NULL,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jurusan` */

insert  into `jurusan`(`id`,`kode_jurusan`,`nama_jurusan`,`is_active`) values 
(8,'JRS-0001',' D3 Teknologi Telekomunikasi','0');

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(10) DEFAULT NULL,
  `angkatan_id` int(10) DEFAULT NULL,
  `jurusan_id` int(10) DEFAULT NULL,
  `nim` varchar(100) DEFAULT NULL,
  `nama_mahasiswa` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jurusan_id` (`jurusan_id`),
  KEY `angkatan_id` (`angkatan_id`),
  CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`angkatan_id`) REFERENCES `angkatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mahasiswa` */

insert  into `mahasiswa`(`id`,`kelas_id`,`angkatan_id`,`jurusan_id`,`nim`,`nama_mahasiswa`,`email`,`no_telp`,`username`,`password`) values 
(4,4,1,8,'1202181038','Wader Jhonson','','0895373483105',NULL,'12345678'),
(5,4,1,8,'1202181039','Ilham Alumakaram',NULL,NULL,NULL,'12345678');

/*Table structure for table `option` */

DROP TABLE IF EXISTS `option`;

CREATE TABLE `option` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `syarat_terbit_skpa` varchar(200) DEFAULT NULL,
  `info_tambahan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `option` */

insert  into `option`(`id`,`syarat_terbit_skpa`,`info_tambahan`) values 
(1,'syarat_berkas.zip','<p>Lorem Ipsum Test<br>asdas</p><p><b>asdasdasdasdsad</b></p><p>asdasdas</p>');

/*Table structure for table `pengajuan_judul` */

DROP TABLE IF EXISTS `pengajuan_judul`;

CREATE TABLE `pengajuan_judul` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  `ket_tolak` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `skpa_gelombang_daftar_id` (`skpa_gelombang_daftar_id`),
  CONSTRAINT `pengajuan_judul_ibfk_1` FOREIGN KEY (`skpa_gelombang_daftar_id`) REFERENCES `skpa_gelombang_daftar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengajuan_judul` */

insert  into `pengajuan_judul`(`id`,`skpa_gelombang_daftar_id`,`nama_judul`,`file_judul`,`file_seminar`,`file_revisi`,`keterangan`,`waktu_upload`,`waktu_upload_revisi`,`is_revisi`,`is_revisi_acc`,`is_revisi_upload`,`is_acc_1`,`waktu_acc_1`,`is_acc_2`,`waktu_acc_2`,`is_acc_2_1`,`waktu_acc_2_1`,`is_berkas_seminar_upload`,`waktu_upload_berkas_seminar`,`is_acc_3`,`waktu_acc_3`,`is_read`,`ket_tolak`) values 
(19,6,'asdasd','6_judul_1598209515.docx',NULL,NULL,NULL,'2020-08-24 02:05:15',NULL,'-1','-1','0','1',NULL,'0',NULL,'-1',NULL,'0',NULL,'-1',NULL,'1','ini ditolak asdkjasdkjas a');

/*Table structure for table `skpa` */

DROP TABLE IF EXISTS `skpa`;

CREATE TABLE `skpa` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_skpa` varchar(100) DEFAULT NULL,
  `nama_skpa` varchar(100) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `skpa` */

insert  into `skpa`(`id`,`kode_skpa`,`nama_skpa`,`tahun`,`start`,`end`) values 
(2,'PERIODE-0001',NULL,2020,'2020-07-01','2020-07-31');

/*Table structure for table `skpa_gelombang` */

DROP TABLE IF EXISTS `skpa_gelombang`;

CREATE TABLE `skpa_gelombang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  `notif_result_seminar` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `skpa_id` (`skpa_id`),
  CONSTRAINT `skpa_gelombang_ibfk_1` FOREIGN KEY (`skpa_id`) REFERENCES `skpa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `skpa_gelombang` */

insert  into `skpa_gelombang`(`id`,`skpa_id`,`gelombang`,`tanggal_judul_start`,`tanggal_judul_end`,`tanggal_sidang_start`,`tanggal_sidang_end`,`tanggal_hasil_sidang`,`tanggal_seminar_start`,`tanggal_seminar_end`,`tanggal_hasil_seminar`,`tanggal_terbit_skpa`,`is_active`,`notif_to_seminar`,`notif_result_seminar`) values 
(4,2,1,'2020-07-01','2020-07-04','2020-07-05','2020-07-10','2020-07-11','2020-07-12','2020-07-24','2020-07-25','2020-07-31','1','1','1');

/*Table structure for table `skpa_gelombang_daftar` */

DROP TABLE IF EXISTS `skpa_gelombang_daftar`;

CREATE TABLE `skpa_gelombang_daftar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `skpa_gelombang_id` int(10) DEFAULT NULL,
  `mahasiswa_id` int(10) DEFAULT NULL,
  `pembimbing_1_id` int(10) DEFAULT NULL,
  `pembimbing_2_id` int(10) DEFAULT NULL,
  `penguji_id` int(10) DEFAULT NULL,
  `tanggal_seminar` date DEFAULT NULL,
  `jam_seminar` time DEFAULT NULL,
  `ruangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `skpa_gelombang_id` (`skpa_gelombang_id`),
  KEY `mahasiswa_id` (`mahasiswa_id`),
  KEY `pembimbing_1_id` (`pembimbing_1_id`),
  KEY `pembimbing_2_id` (`pembimbing_2_id`),
  KEY `penguji_id` (`penguji_id`),
  CONSTRAINT `skpa_gelombang_daftar_ibfk_1` FOREIGN KEY (`skpa_gelombang_id`) REFERENCES `skpa_gelombang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `skpa_gelombang_daftar_ibfk_2` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `skpa_gelombang_daftar_ibfk_3` FOREIGN KEY (`pembimbing_1_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `skpa_gelombang_daftar_ibfk_4` FOREIGN KEY (`pembimbing_2_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `skpa_gelombang_daftar_ibfk_5` FOREIGN KEY (`penguji_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `skpa_gelombang_daftar` */

insert  into `skpa_gelombang_daftar`(`id`,`skpa_gelombang_id`,`mahasiswa_id`,`pembimbing_1_id`,`pembimbing_2_id`,`penguji_id`,`tanggal_seminar`,`jam_seminar`,`ruangan`) values 
(6,4,4,1,2,4,'2020-08-24','18:51:00','asd'),
(7,4,5,1,2,4,'2020-08-12','01:12:00','asdasd');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_user` varchar(50) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `posisi` varchar(200) DEFAULT NULL,
  `gaji` int(50) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`kode_user`,`nama`,`alamat`,`no_telp`,`username`,`password`,`posisi`,`gaji`) values 
(1,NULL,'Admin',NULL,NULL,'admin','admin','Superadmin',0),
(2,'KRW-0001','Ela','Bojong Malaka','083181824883','-','','Pegawai',0),
(4,NULL,'Bapak Adintis',NULL,NULL,'pemilik','pemilik','Pemilik',0),
(6,'KRW-0003','Neng Siti','Pameungpeuk','085355861900','','','Pegawai',0),
(8,'KRW-0004','Vani Nurlaeli','Banjaran','083227336298','kasir','kasir','Kasir',1000000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
