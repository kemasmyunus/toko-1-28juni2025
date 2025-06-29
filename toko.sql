-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 29, 2025 at 03:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `nama`, `alamat`, `no_hp`) VALUES
(1, '321', '321', '321');

-- --------------------------------------------------------

--
-- Table structure for table `imei_sn`
--

CREATE TABLE `imei_sn` (
  `id` int(11) NOT NULL,
  `inventory_batch_id` int(11) DEFAULT NULL,
  `uniqe_id` varchar(100) DEFAULT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `sn` varchar(50) DEFAULT NULL,
  `status` enum('available','sold','reserved') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_batches`
--

CREATE TABLE `inventory_batches` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `harga_beli` decimal(15,2) DEFAULT NULL,
  `harga_jual` decimal(15,2) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `id_pembelian` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_batches`
--

INSERT INTO `inventory_batches` (`id`, `product_id`, `quantity`, `harga_beli`, `harga_jual`, `tanggal_masuk`, `supplier`, `id_pembelian`) VALUES
(1, 3, 1, 123.00, 123.00, '0002-02-22', '222', '222');

-- --------------------------------------------------------

--
-- Table structure for table `pos_sales`
--

CREATE TABLE `pos_sales` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(50) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `potongan_total` decimal(15,2) DEFAULT NULL,
  `total_bayar` decimal(15,2) DEFAULT NULL,
  `metode_pembayaran1` varchar(50) DEFAULT NULL,
  `metode_pembayaran2` varchar(50) DEFAULT NULL,
  `kasir` varchar(50) DEFAULT NULL,
  `sales` varchar(50) DEFAULT NULL,
  `toko` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_sale_details`
--

CREATE TABLE `pos_sale_details` (
  `id` int(11) NOT NULL,
  `pos_sale_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `imei_sn_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `harga_jual` decimal(15,2) DEFAULT NULL,
  `potongan1` decimal(15,2) DEFAULT NULL,
  `potongan2` decimal(15,2) DEFAULT NULL,
  `potongan3` decimal(15,2) DEFAULT NULL,
  `total_setelah_potongan` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `item_code` varchar(50) DEFAULT NULL,
  `sku` varchar(50) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `variant` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `item_code`, `sku`, `nama_produk`, `variant`, `brand`, `category`) VALUES
(2, '123', '123', '123', '123', '123', '123'),
(3, '321', '321', '321', '321', '321', '321');

-- --------------------------------------------------------

--
-- Table structure for table `reconcile`
--

CREATE TABLE `reconcile` (
  `id` int(11) NOT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `kode_transaksi` varchar(50) DEFAULT NULL,
  `tanggal_transaksi` datetime DEFAULT NULL,
  `status_pembayaran` enum('paid','pending','failed') DEFAULT NULL,
  `nominal` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_balances`
--

CREATE TABLE `stock_balances` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_balances`
--

INSERT INTO `stock_balances` (`id`, `product_id`, `warehouse_id`, `quantity`) VALUES
(1, 2, 1, 3),
(2, 3, 1, 123),
(3, 3, 2, 222),
(4, 3, 2, 333);

-- --------------------------------------------------------

--
-- Table structure for table `stock_opname`
--

CREATE TABLE `stock_opname` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `quantity_sistem` int(11) NOT NULL,
  `quantity_fisik` int(11) NOT NULL,
  `selisih` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_opname`
--

INSERT INTO `stock_opname` (`id`, `product_id`, `warehouse_id`, `quantity_sistem`, `quantity_fisik`, `selisih`, `tanggal`, `keterangan`) VALUES
(1, 3, 1, 123, 123, 0, '0022-02-22', '123'),
(2, 3, 2, 222, 11, -211, '0111-11-11', '123');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `nama`, `alamat`) VALUES
(1, 'coba', 'jalan'),
(2, 'toko belitung', 'jalan belitung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imei_sn`
--
ALTER TABLE `imei_sn`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqe_id` (`uniqe_id`),
  ADD KEY `inventory_batch_id` (`inventory_batch_id`);

--
-- Indexes for table `inventory_batches`
--
ALTER TABLE `inventory_batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `pos_sales`
--
ALTER TABLE `pos_sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `pos_sale_details`
--
ALTER TABLE `pos_sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pos_sale_id` (`pos_sale_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `imei_sn_id` (`imei_sn_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_code` (`item_code`);

--
-- Indexes for table `reconcile`
--
ALTER TABLE `reconcile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_transaksi` (`kode_transaksi`);

--
-- Indexes for table `stock_balances`
--
ALTER TABLE `stock_balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `imei_sn`
--
ALTER TABLE `imei_sn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_batches`
--
ALTER TABLE `inventory_batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pos_sales`
--
ALTER TABLE `pos_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_sale_details`
--
ALTER TABLE `pos_sale_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reconcile`
--
ALTER TABLE `reconcile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_balances`
--
ALTER TABLE `stock_balances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_opname`
--
ALTER TABLE `stock_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `imei_sn`
--
ALTER TABLE `imei_sn`
  ADD CONSTRAINT `imei_sn_ibfk_1` FOREIGN KEY (`inventory_batch_id`) REFERENCES `inventory_batches` (`id`);

--
-- Constraints for table `inventory_batches`
--
ALTER TABLE `inventory_batches`
  ADD CONSTRAINT `inventory_batches_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `pos_sales`
--
ALTER TABLE `pos_sales`
  ADD CONSTRAINT `pos_sales_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `pos_sale_details`
--
ALTER TABLE `pos_sale_details`
  ADD CONSTRAINT `pos_sale_details_ibfk_1` FOREIGN KEY (`pos_sale_id`) REFERENCES `pos_sales` (`id`),
  ADD CONSTRAINT `pos_sale_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `pos_sale_details_ibfk_3` FOREIGN KEY (`imei_sn_id`) REFERENCES `imei_sn` (`id`);

--
-- Constraints for table `reconcile`
--
ALTER TABLE `reconcile`
  ADD CONSTRAINT `reconcile_ibfk_1` FOREIGN KEY (`kode_transaksi`) REFERENCES `pos_sales` (`kode_transaksi`);

--
-- Constraints for table `stock_balances`
--
ALTER TABLE `stock_balances`
  ADD CONSTRAINT `stock_balances_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `stock_balances_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`);

--
-- Constraints for table `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD CONSTRAINT `stock_opname_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `stock_opname_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
