-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2023 at 03:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualanimk`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventoribarang`
--

CREATE TABLE `inventoribarang` (
  `idbarang` varchar(12) NOT NULL,
  `namabarang` varchar(30) DEFAULT NULL,
  `stok` int(12) DEFAULT NULL,
  `harga` int(30) DEFAULT NULL,
  `idpegawai` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventoribarang`
--

INSERT INTO `inventoribarang` (`idbarang`, `namabarang`, `stok`, `harga`, `idpegawai`) VALUES
('B004', 'Beras Ketan', 14, 30000, 'tes'),
('G001', 'Garam', 81, 18000, 'tes'),
('R001', 'Rinso', 8, 9000, 'ari'),
('T005', 'Telur 5KG', 75, 9000, 'ari');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `idkonsumen` int(12) NOT NULL,
  `namakonsumen` varchar(30) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`idkonsumen`, `namakonsumen`, `nohp`) VALUES
(1, 'Ujang Asep', '000000'),
(2, 'Yeni Indriani', '0432828'),
(3, 'Tessia Eralith', '098777'),
(4, 'Reni Sugwerni', '08777'),
(7, 'Ari Syafri', '098383');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idpegawai` varchar(12) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `namapegawai` varchar(30) DEFAULT NULL,
  `role` enum('admin','owner','kasir','pegawai','spv') DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idpegawai`, `pass`, `namapegawai`, `role`, `alamat`, `nohp`) VALUES
('12345', '$2y$10$84uhRTw1X/E2A6MzGN4fye72.SM.v8epvBhJs4bxLta.QQvyPUSNG', 'Suryanti Yantii', 'kasir', '12345', '12345'),
('admin', '$2a$12$7HyR8oUo9wW/z1Vj3L2iLOtInSgd2r7hfjMB2nQ6LT/O73qCPBVSe', 'admin', 'owner', 'admin', 'admin'),
('ari', '$2y$10$hWkcX0sxe0nJZApV8oAOkuTQVqk9snxAI1F0It9j09xpW9Asq3wQ.', 'ari', 'pegawai', 'ari', '098777'),
('kasir05', '$2y$10$ESRTTR7RhU2Pkpw2GhyUW.ZUgTkHC3tjP7BCOlMLMBbmIAWw6bUKG', 'Ujang', 'spv', 'Jl Suka Rasa', '08777'),
('tes', '$2y$10$nrWFISNtER2rqFKteNtvXOCSTs5g7EJo0bY6Bhs0QPJgOYTeyGnvW', 'tes', 'pegawai', 'tes', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `idpembelian` int(8) NOT NULL,
  `waktu` timestamp NULL DEFAULT current_timestamp(),
  `jumlahbeli` int(12) DEFAULT NULL,
  `idbarang` varchar(12) DEFAULT NULL,
  `idkonsumen` int(12) DEFAULT NULL,
  `status` enum('dibayar','belum dibayar') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`idpembelian`, `waktu`, `jumlahbeli`, `idbarang`, `idkonsumen`, `status`) VALUES
(2, '2022-12-29 14:08:18', 2, 'R001', 1, 'dibayar'),
(5, '2022-12-29 14:08:39', 4, 'R001', 2, 'dibayar'),
(8, '2023-01-05 16:00:26', 3, 'T005', 3, 'dibayar'),
(9, '2023-01-05 16:03:23', 4, 'G001', 3, 'dibayar'),
(11, '2023-01-05 17:19:33', 3, 'R001', 7, 'dibayar'),
(12, '2023-01-06 01:38:40', 2, 'B004', 7, 'dibayar'),
(13, '2023-01-06 01:38:52', 2, 'R001', 7, 'dibayar'),
(14, '2023-01-06 10:13:27', 2, 'R001', 7, 'dibayar'),
(15, '2023-01-07 01:10:05', 2, 'B004', 2, 'dibayar'),
(16, '2023-01-07 01:14:27', 3, 'R001', 2, 'dibayar'),
(17, '2023-01-07 01:16:03', 3, 'R001', 2, 'dibayar'),
(18, '2023-01-07 01:16:36', 5, 'T005', 1, 'dibayar'),
(19, '2023-01-07 02:16:54', 2, 'R001', 4, 'belum dibayar'),
(20, '2023-01-07 02:17:35', 2, 'G001', 4, 'belum dibayar'),
(21, '2023-01-07 10:17:00', 3, 'G001', 1, 'dibayar'),
(22, '2023-01-07 10:17:59', 3, 'G001', 1, 'dibayar'),
(23, '2023-01-07 10:18:31', 4, 'R001', 1, 'dibayar'),
(24, '2023-01-07 10:18:55', 3, 'B004', 2, 'dibayar'),
(25, '2023-01-07 10:19:38', 3, 'B004', 2, 'dibayar'),
(26, '2023-01-07 10:30:51', 15, 'R001', 1, 'dibayar'),
(27, '2023-01-07 10:31:20', 2, 'R001', 1, 'dibayar'),
(28, '2023-01-07 10:31:46', 4, 'R001', 1, 'dibayar'),
(29, '2023-01-07 10:32:29', 4, 'R001', 1, 'dibayar'),
(30, '2023-01-07 10:34:02', 15, 'R001', 1, 'dibayar'),
(31, '2023-01-07 10:35:52', 15, 'R001', 2, 'belum dibayar'),
(32, '2023-01-07 10:38:26', 11, 'R001', 3, 'belum dibayar'),
(33, '2023-01-07 10:39:13', 15, 'R001', 7, 'dibayar'),
(34, '2023-01-07 10:48:45', 2, 'R001', 1, 'belum dibayar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventoribarang`
--
ALTER TABLE `inventoribarang`
  ADD PRIMARY KEY (`idbarang`),
  ADD KEY `idpegawai` (`idpegawai`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`idkonsumen`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idpegawai`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`idpembelian`),
  ADD KEY `idkonsumen` (`idkonsumen`),
  ADD KEY `idbarang` (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `idkonsumen` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `idpembelian` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventoribarang`
--
ALTER TABLE `inventoribarang`
  ADD CONSTRAINT `inventoribarang_ibfk_1` FOREIGN KEY (`idpegawai`) REFERENCES `pegawai` (`idpegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`idkonsumen`) REFERENCES `konsumen` (`idkonsumen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`idbarang`) REFERENCES `inventoribarang` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
