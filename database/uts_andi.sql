-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 30, 2021 at 11:35 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uts_andi`
--

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE `gambar` (
  `id` bigint(20) NOT NULL,
  `gambar1` text NOT NULL,
  `gambar2` text NOT NULL,
  `gambar3` text NOT NULL,
  `gambar4` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`id`, `gambar1`, `gambar2`, `gambar3`, `gambar4`) VALUES
(1, 'https://objectstorage.ap-melbourne-1.oraclecloud.com/p/afVGODqE5mrETmRA_NWPwpMAioJmJHaY0LFXpP80mAuWCNHItIvuxG8X8_nw6Ixu/n/axbuzs1ylays/b/testing_bukcet/o/elonelon.jpg', 'https://objectstorage.ap-melbourne-1.oraclecloud.com/p/afVGODqE5mrETmRA_NWPwpMAioJmJHaY0LFXpP80mAuWCNHItIvuxG8X8_nw6Ixu/n/axbuzs1ylays/b/testing_bukcet/o/elonelon2.jpeg', 'https://objectstorage.ap-melbourne-1.oraclecloud.com/p/afVGODqE5mrETmRA_NWPwpMAioJmJHaY0LFXpP80mAuWCNHItIvuxG8X8_nw6Ixu/n/axbuzs1ylays/b/testing_bukcet/o/elonelon3.jpg\r\n', 'https://objectstorage.ap-melbourne-1.oraclecloud.com/p/afVGODqE5mrETmRA_NWPwpMAioJmJHaY0LFXpP80mAuWCNHItIvuxG8X8_nw6Ixu/n/axbuzs1ylays/b/testing_bukcet/o/elonelon4.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
