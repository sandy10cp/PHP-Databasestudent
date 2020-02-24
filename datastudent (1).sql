-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2017 at 11:10 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `datastudent`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `kode_jadwal` varchar(255) NOT NULL,
  `kode_pelajaran` varchar(255) NOT NULL,
  `nama_pelajaran` varchar(255) NOT NULL,
  `id_guru` varchar(255) NOT NULL,
  `hari` varchar(255) NOT NULL,
  `jam` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `kode_jadwal`, `kode_pelajaran`, `nama_pelajaran`, `id_guru`, `hari`, `jam`) VALUES
(1, 'JDW01', 'MAT01', 'MATEMATIKA', '001', 'SENIN-RABU-JUMAAT', '14:00-15:00'),
(2, 'JDW02', 'ENG01', 'ENGLISH', '001', 'SENIN-RABU-JUMAAT', '15:00-16:00');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_student`
--

CREATE TABLE IF NOT EXISTS `jadwal_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jadwal` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jadwal_student`
--

INSERT INTO `jadwal_student` (`id`, `kode_jadwal`, `nim`) VALUES
(1, 'JDW01', 'H1A008051');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` text NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` varchar(30) NOT NULL,
  `alamat_asal` varchar(80) NOT NULL,
  `alamat_sekarang` varchar(80) NOT NULL,
  `no_telepon` varchar(10) NOT NULL,
  `jadwal_1` varchar(255) NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat_asal`, `alamat_sekarang`, `no_telepon`, `jadwal_1`) VALUES
('H1A008050', 'Vio', 'Perempuan', 'Timika', '28-03-2017', 'Timika', 'Timika', '0852034309', 'JDW01'),
('H1A008051', 'Gaelle', 'Perempuan', 'Jakarta', '29-03-2017', 'Jakarta', 'Timika', '45454', 'JDW02'),
('H1A008052', 'Sandy Wajongkere', 'Laki-Laki', 'Manado', '10-10-1990', 'Manado', 'Pondok Amor', '0852428909', 'JDW01'),
('H1A008053', 'Firman Dwi Jayanto', 'Laki-Laki', 'Banyumas', '15-04-2016', 'Alamat Asal RT RW', 'Alamat Sekarang RT RW', '08567890', 'JDW01'),
('H1A008054', 'Fred Degei', 'Perempuan', 'Manado', '9-9-1990', 'Timika', 'Timika', '0853464646', 'JDW02'),
('H1A008055', 'Alfrianus', 'Laki-Laki', 'Timika', '9-9-1990', 'Timika', 'Timika', '5343434334', 'JDW02');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nis` varchar(255) NOT NULL,
  `kode_pelajaran` varchar(255) DEFAULT NULL,
  `nilai` varchar(255) DEFAULT NULL,
  `tgl_input` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `nis`, `kode_pelajaran`, `nilai`, `tgl_input`) VALUES
(1, 'H1A008053', 'English', '99', '2017-03-02'),
(2, 'H1A008053', 'Matematika', '100', '2017-03-03'),
(3, 'H1A008053', 'Matematika', '99', '2017-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE IF NOT EXISTS `pelajaran` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `kode_pelajaran` varchar(255) NOT NULL,
  `nama_pelajaran` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`id`, `kode_pelajaran`, `nama_pelajaran`) VALUES
(1, 'MAT01', 'MATEMATIKA'),
(2, 'ENG01', 'ENGLISH');

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE IF NOT EXISTS `spp` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `kode_nis` varchar(255) NOT NULL,
  `tgl_input` date NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id`, `kode_nis`, `tgl_input`, `jumlah`) VALUES
(1, 'H1A008053', '2017-08-22', '200000'),
(2, 'H1A008053', '2017-08-23', '300000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama_users` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `akses` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_users`, `username`, `password`, `akses`) VALUES
(1, 'Sandy', 'swajongk@fmi.com', 'sandy', 'Teacher'),
(2, 'Gaelle', 'gaelle@gmail.com', 'gaelle', 'Kepalasekolah');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
