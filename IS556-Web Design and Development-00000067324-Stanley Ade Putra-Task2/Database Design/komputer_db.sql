-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2023 at 12:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komputer_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_customer`
--

CREATE TABLE `data_customer` (
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_customer`
--

INSERT INTO `data_customer` (`name`, `email`, `password`) VALUES
('ade', 'ade@gmail.com', '6531401f9a6807306651b87e44c05751'),
('putra', 'putra@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4'),
('stanley', 'stanley@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id_transaction` int(20) NOT NULL,
  `address` varchar(40) NOT NULL,
  `city` varchar(15) NOT NULL,
  `state` varchar(15) NOT NULL,
  `zip` int(5) NOT NULL,
  `credit_card` int(16) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id_transaction`, `address`, `city`, `state`, `zip`, `credit_card`, `month`, `year`) VALUES
(1682332320, 'BSD Blok A', 'Tangerang', 'BSD', 11111, 2147483647, 1, 2026),
(1682332404, 'Pasar Lama Blok D', 'Surabaya', 'Pasar Lama', 22222, 2147483647, 4, 2025),
(1682332518, 'Kalibata Blok C', 'Jakarta', 'Kalibata', 33333, 2147483647, 9, 2023),
(1682332616, 'Gading Serpong Blok Z', 'Pontianak', 'Gading Serpong', 44444, 2147483647, 6, 2024);

-- --------------------------------------------------------

--
-- Table structure for table `list_produk`
--

CREATE TABLE `list_produk` (
  `id_product` int(20) NOT NULL,
  `product` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_produk`
--

INSERT INTO `list_produk` (`id_product`, `product`, `type`, `price`) VALUES
(1, 'Gigabyte GA-H61M-DS2', 'Motherboard', 825000),
(2, 'Polytron PMA 9502', 'Speaker', 840000),
(3, 'AMD Ryzen 5 3600', 'CPU', 3350000),
(4, 'Samsung SSD 850 EVO', 'SSD', 1205000),
(5, 'Corsair Vengeance 8GB DDR4 240', 'RAM', 425000),
(6, 'NVIDIA GeForce RTX 3060 Ti', 'Graphics Card', 6980000),
(7, 'Redragon Water CPU cooler EFFE', 'Cooler Fan', 1008750),
(8, 'NVIDIA GeForce GTX 1050 Ti', 'Grapichs Card', 2500000),
(9, 'Logitech Pro Wireless Gaming M', 'Mouse', 1340000),
(10, 'Armaggeddon Keyboard MKA-3C', 'Keyboard', 300000);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `email` varchar(30) NOT NULL,
  `id_transaction` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`email`, `id_transaction`) VALUES
('ade@gmail.com', 1682332404),
('putra@gmail.com', 1682332518),
('stanley@gmail.com', 1682332320),
('stanley@gmail.com', 1682332616);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id_transaction` int(20) NOT NULL,
  `id_product` int(20) NOT NULL,
  `qty` int(3) NOT NULL,
  `total_price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`id_transaction`, `id_product`, `qty`, `total_price`) VALUES
(1682332320, 1, 3, 2475000),
(1682332320, 2, 2, 1680000),
(1682332320, 8, 3, 7500000),
(1682332404, 4, 2, 2410000),
(1682332404, 5, 2, 850000),
(1682332404, 6, 2, 13960000),
(1682332404, 10, 1, 300000),
(1682332404, 9, 1, 1340000),
(1682332518, 9, 1, 1340000),
(1682332518, 8, 4, 10000000),
(1682332518, 3, 3, 10050000),
(1682332518, 7, 5, 5043750),
(1682332616, 10, 3, 900000),
(1682332616, 2, 3, 2520000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_customer`
--
ALTER TABLE `data_customer`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD KEY `Foreign Key3` (`id_transaction`);

--
-- Indexes for table `list_produk`
--
ALTER TABLE `list_produk`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `Foreign Key` (`email`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD KEY `Foreign Key1` (`id_product`),
  ADD KEY `Foreign Key2` (`id_transaction`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_produk`
--
ALTER TABLE `list_produk`
  MODIFY `id_product` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `destination`
--
ALTER TABLE `destination`
  ADD CONSTRAINT `Foreign Key3` FOREIGN KEY (`id_transaction`) REFERENCES `transaction` (`id_transaction`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `Foreign Key` FOREIGN KEY (`email`) REFERENCES `data_customer` (`email`);

--
-- Constraints for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD CONSTRAINT `Foreign Key1` FOREIGN KEY (`id_product`) REFERENCES `list_produk` (`id_product`),
  ADD CONSTRAINT `Foreign Key2` FOREIGN KEY (`id_transaction`) REFERENCES `transaction` (`id_transaction`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
