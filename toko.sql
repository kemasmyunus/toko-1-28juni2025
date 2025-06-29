-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 29, 2025 at 03:42 AM
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
(1, 'Elvina Nurdiyanti', 'Jalan M.H Thamrin No. 4, Jayapura, Nusa Tenggara Timur 03791', '08(048)755-4257'),
(2, 'drg. Rahmi Sitompul, S.T.', 'Jl. Jakarta No. 632, Magelang, BT 78495', '0821034508'),
(3, 'Dr. Endah Wacana, M.Kom.', 'Jalan Gardujati No. 388, Padang, DI Yogyakarta 12323', '08(061)6095190'),
(4, 'Kania Prasetya, S.Gz', 'Jl. Ronggowarsito No. 62, Prabumulih, JB 48780', '08(34)7586451'),
(5, 'Mahfud Yuniar', 'Jalan M.H Thamrin No. 85, Bandung, LA 86409', '08(0510)3665862'),
(6, 'Qori Hidayanto', 'Jalan Jakarta No. 4, Cilegon, Sumatera Utara 60468', '0886317419'),
(7, 'Drs. Zalindra Simanjuntak', 'Gg. Pelajar Pejuang No. 920, Banda Aceh, Aceh 82307', '08(46)011-8197'),
(8, 'Najwa Kusumo', 'Gang Jayawijaya No. 20, Sukabumi, Riau 62600', '08-33-547-6389'),
(9, 'Dr. Paiman Nasyiah, S.Gz', 'Jalan Rawamangun No. 8, Bukittinggi, Sumatera Utara 17442', '08(59)3642596'),
(10, 'Cayadi Anggriawan', 'Gg. Monginsidi No. 183, Balikpapan, Jawa Tengah 30184', '08-006-188-4659'),
(11, 'Fitriani Saputro', 'Jalan Ahmad Yani No. 12, Semarang, Jawa Tengah 50123', '081234567801'),
(12, 'Teguh Prasetyo', 'Jl. Pemuda No. 77, Yogyakarta, DIY 55231', '082145678902'),
(13, 'Siti Nurhaliza', 'Jalan Merdeka No. 99, Bandung, Jawa Barat 40123', '083156789013'),
(14, 'Bambang Pamungkas', 'Jl. Sudirman No. 8, Jakarta, DKI Jakarta 10110', '084167890124'),
(15, 'Rina Marlina', 'Jl. Gajah Mada No. 25, Medan, Sumatera Utara 20115', '085178901235'),
(16, 'Agus Santoso', 'Jl. Imam Bonjol No. 5, Surabaya, Jawa Timur 60285', '086189012346'),
(17, 'Lestari Wulandari', 'Jl. RA Kartini No. 3, Malang, Jawa Timur 65111', '087190123457'),
(18, 'Dian Sastro', 'Jl. Cihampelas No. 33, Bandung, Jawa Barat 40171', '088201234568'),
(19, 'Yusuf Mansur', 'Jl. Taman Siswa No. 10, Yogyakarta, DIY 55161', '089212345679'),
(20, 'Andi Wijaya', 'Jl. Veteran No. 88, Makassar, Sulawesi Selatan 90134', '081323456780');

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

--
-- Dumping data for table `imei_sn`
--

INSERT INTO `imei_sn` (`id`, `inventory_batch_id`, `uniqe_id`, `imei`, `sn`, `status`) VALUES
(1, 10, 'b55e0104-ef46-428a-b515-7d4171fbb20d', '446825998732317', 'SN25651003', 'sold'),
(2, 10, 'a8d2f0dc-5ce7-4c45-aba1-6ece6ccb7dfb', '996101655080406', 'SN41081357', 'available'),
(3, 2, 'dafe5d1d-533d-432f-9525-60377756dcfb', '344785339377880', 'SN08776136', 'available'),
(4, 4, '6e784310-14e4-4eb5-8680-52a42ca4e257', '572887510546380', 'SN51333389', 'sold'),
(5, 2, 'd726f4cc-39b9-4347-b74b-fb303fa4aa0d', '549564127831130', 'SN11692017', 'available'),
(6, 2, 'f3d1bfc3-d1f5-41d6-8179-19fe13204338', '536380868664938', 'SN67081146', 'sold'),
(7, 5, '4bde37f5-8af8-4969-8ad2-81eedcca3bc6', '606845039529362', 'SN79146554', 'sold'),
(8, 6, '58dce70c-ad72-41d7-a6cc-e14e90f50cfc', '339313944133255', 'SN89386016', 'available'),
(9, 6, '715f7173-5fd8-45ee-8244-58afcf857cbe', '305341349138115', 'SN42711727', 'sold'),
(10, 4, '350cd085-21e5-4e62-8218-83fc365836fa', '437765325319366', 'SN32217474', 'reserved'),
(11, 11, '29c85c69-8b78-4704-9b38-fa467716f183', '737347524658306', 'SN32060279', 'available'),
(12, 12, '90023e88-25cc-40c8-bc15-cc29e28f3345', '621242001436267', 'SN73937883', 'sold'),
(13, 13, '8ff845d1-b8f4-4749-a8cd-476ed2abcb7e', '174951687042516', 'SN45870504', 'available'),
(14, 14, 'fcc6a804-84dc-4577-be7e-82f894d09000', '728009247566437', 'SN36440034', 'reserved'),
(15, 15, '63c95d44-f216-4090-b80e-b5f44c1a200e', '664246738440036', 'SN94127148', 'sold'),
(16, 16, '3a6962f8-c14e-45ef-ae1f-7000b31edeb2', '569843925436883', 'SN72711136', 'available'),
(17, 17, 'caeceaf3-9560-46df-99b4-80acd452f40e', '818885653237367', 'SN17115888', 'sold'),
(18, 18, '3f0e6b00-b495-4163-b08a-fe9065e9bff8', '461672308487128', 'SN59192200', 'available'),
(19, 19, 'e5ff0e75-42ee-4e26-85ff-6fee89c7c05b', '294829523765030', 'SN61629694', 'sold'),
(20, 20, '5e393f29-895c-4cd2-9593-1f7957048878', '870847918432599', 'SN38474720', 'reserved');

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
(1, 1, 11, 1200000.00, 1500000.00, '2024-03-14', 'Perum Winarno (Persero) Tbk', 'PB-97928'),
(2, 9, 12, 1200000.00, 1500000.00, '2024-01-01', 'Perum Pertiwi Yuniar Tbk', 'PB-78652'),
(3, 8, 13, 1200000.00, 1500000.00, '2024-03-28', 'CV Yuliarti Ardianto', 'PB-83447'),
(4, 1, 18, 1200000.00, 1500000.00, '2023-08-21', 'Perum Andriani', 'PB-88216'),
(5, 6, 9, 1200000.00, 1500000.00, '2023-10-21', 'PT Sitorus Widodo', 'PB-87480'),
(6, 4, 8, 1200000.00, 1500000.00, '2023-11-20', 'Perum Halim Wibowo', 'PB-86041'),
(7, 2, 8, 1200000.00, 1500000.00, '2023-12-12', 'PT Suryatmi Yulianti', 'PB-7738'),
(8, 6, 13, 1200000.00, 1500000.00, '2023-11-24', 'Perum Rajasa Tbk', 'PB-84896'),
(9, 1, 8, 1200000.00, 1500000.00, '2024-01-22', 'CV Saptono', 'PB-35143'),
(10, 7, 14, 1200000.00, 1500000.00, '2023-07-11', 'PD Mahendra Uyainah Tbk', 'PB-47637'),
(11, 11, 15, 1100000.00, 1400000.00, '2024-04-01', 'PT Nusantara Jaya', 'PB-10001'),
(12, 12, 20, 1200000.00, 1500000.00, '2024-04-02', 'PT Sentosa Makmur', 'PB-10002'),
(13, 13, 18, 1000000.00, 1300000.00, '2024-04-03', 'CV Abadi Sejahtera', 'PB-10003'),
(14, 14, 10, 1050000.00, 1350000.00, '2024-04-04', 'PD Jaya Bersama', 'PB-10004'),
(15, 15, 25, 950000.00, 1250000.00, '2024-04-05', 'PT Sumber Rejeki', 'PB-10005'),
(16, 16, 30, 1150000.00, 1450000.00, '2024-04-06', 'CV Teknologi Indo', 'PB-10006'),
(17, 17, 12, 1250000.00, 1550000.00, '2024-04-07', 'PD Mega Elektronik', 'PB-10007'),
(18, 18, 14, 980000.00, 1280000.00, '2024-04-08', 'PT Digital Pratama', 'PB-10008'),
(19, 19, 16, 1000000.00, 1300000.00, '2024-04-09', 'CV Harapan Baru', 'PB-10009'),
(20, 20, 22, 1300000.00, 1600000.00, '2024-04-10', 'PD Sukses Selalu', 'PB-10010');

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

--
-- Dumping data for table `pos_sales`
--

INSERT INTO `pos_sales` (`id`, `kode_transaksi`, `tanggal`, `customer_id`, `total`, `potongan_total`, `total_bayar`, `metode_pembayaran1`, `metode_pembayaran2`, `kasir`, `sales`, `toko`, `alamat`) VALUES
(1, 'TRX-614834', '2024-11-07 00:00:00', 9, 3000000.00, 500000.00, 2500000.00, 'Tunai', 'Transfer', 'Alika', 'Baktiadi', 'Toko Tual', 'Gang Pasir Koja No. 1, Solok, Jawa Timur 01292'),
(2, 'TRX-872652', '2024-03-19 00:00:00', 4, 3000000.00, 500000.00, 2500000.00, 'Tunai', 'Transfer', 'Lantar', 'Limar', 'Toko Batu', 'Jl. Abdul Muis No. 8, Surakarta, Bali 64431'),
(3, 'TRX-451575', '2024-03-23 00:00:00', 6, 3000000.00, 500000.00, 2500000.00, 'Tunai', 'Transfer', 'Bakti', 'Azalea', 'Toko Prabumulih', 'Gang Pelajar Pejuang No. 1, Pematangsiantar, ST 05551'),
(4, 'TRX-898643', '2024-09-28 00:00:00', 9, 3000000.00, 500000.00, 2500000.00, 'Tunai', 'Transfer', 'Hasta', 'Edi', 'Toko Blitar', 'Gang W.R. Supratman No. 993, Tegal, RI 08529'),
(5, 'TRX-197601', '2024-11-02 00:00:00', 1, 3000000.00, 500000.00, 2500000.00, 'Tunai', 'Transfer', 'Victoria', 'Rizki', 'Toko Tangerang', 'Jalan Ahmad Yani No. 822, Pangkalpinang, JB 03606'),
(6, 'TRX-600149', '2024-09-07 00:00:00', 6, 3000000.00, 500000.00, 2500000.00, 'Tunai', 'Transfer', 'Bakidin', 'Hani', 'Toko Kupang', 'Jalan Laswi No. 36, Malang, DKI Jakarta 73040'),
(7, 'TRX-164920', '2024-02-27 00:00:00', 1, 3000000.00, 500000.00, 2500000.00, 'Tunai', 'Transfer', 'Diana', 'Gangsar', 'Toko Tegal', 'Gg. Raya Ujungberung No. 690, Manado, SU 42628'),
(8, 'TRX-834961', '2024-06-06 00:00:00', 6, 3000000.00, 500000.00, 2500000.00, 'Tunai', 'Transfer', 'Jefri', 'Unjani', 'Toko Surakarta', 'Jalan KH Amin Jasuta No. 07, Palopo, KB 94532'),
(9, 'TRX-212938', '2024-01-30 00:00:00', 4, 3000000.00, 500000.00, 2500000.00, 'Tunai', 'Transfer', 'Abyasa', 'Tirta', 'Toko Kota Administrasi Jakarta Timur', 'Gg. Dipatiukur No. 99, Palembang, JK 65248'),
(10, 'TRX-232561', '2024-10-17 00:00:00', 4, 3000000.00, 500000.00, 2500000.00, 'Tunai', 'Transfer', 'Enteng', 'Eman', 'Toko Bogor', 'Jalan Yos Sudarso No. 44, Banjarbaru, JK 85017'),
(11, 'TRX-100001', '2025-01-01 00:00:00', 11, 1500000.00, 250000.00, 1250000.00, 'Tunai', 'Transfer', 'Kasir1', 'Sales1', 'Toko A', 'Jl. Mawar No. 1'),
(12, 'TRX-100002', '2025-01-02 00:00:00', 12, 1400000.00, 200000.00, 1200000.00, 'Tunai', 'Transfer', 'Kasir2', 'Sales2', 'Toko B', 'Jl. Melati No. 2'),
(13, 'TRX-100003', '2025-01-03 00:00:00', 13, 1300000.00, 300000.00, 1000000.00, 'Tunai', 'Transfer', 'Kasir3', 'Sales3', 'Toko C', 'Jl. Kenanga No. 3'),
(14, 'TRX-100004', '2025-01-04 00:00:00', 14, 1600000.00, 100000.00, 1500000.00, 'Tunai', 'Transfer', 'Kasir4', 'Sales4', 'Toko D', 'Jl. Anggrek No. 4'),
(15, 'TRX-100005', '2025-01-05 00:00:00', 15, 1700000.00, 200000.00, 1500000.00, 'Tunai', 'Transfer', 'Kasir5', 'Sales5', 'Toko E', 'Jl. Dahlia No. 5'),
(16, 'TRX-100006', '2025-01-06 00:00:00', 16, 1800000.00, 300000.00, 1500000.00, 'Tunai', 'Transfer', 'Kasir6', 'Sales6', 'Toko F', 'Jl. Teratai No. 6'),
(17, 'TRX-100007', '2025-01-07 00:00:00', 17, 1400000.00, 400000.00, 1000000.00, 'Tunai', 'Transfer', 'Kasir7', 'Sales7', 'Toko G', 'Jl. Kamboja No. 7'),
(18, 'TRX-100008', '2025-01-08 00:00:00', 18, 1600000.00, 100000.00, 1500000.00, 'Tunai', 'Transfer', 'Kasir8', 'Sales8', 'Toko H', 'Jl. Flamboyan No. 8'),
(19, 'TRX-100009', '2025-01-09 00:00:00', 19, 1550000.00, 50000.00, 1500000.00, 'Tunai', 'Transfer', 'Kasir9', 'Sales9', 'Toko I', 'Jl. Bougenville No. 9'),
(20, 'TRX-100010', '2025-01-10 00:00:00', 20, 1450000.00, 150000.00, 1300000.00, 'Tunai', 'Transfer', 'Kasir10', 'Sales10', 'Toko J', 'Jl. Kembang No. 10');

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

--
-- Dumping data for table `pos_sale_details`
--

INSERT INTO `pos_sale_details` (`id`, `pos_sale_id`, `product_id`, `imei_sn_id`, `quantity`, `harga_jual`, `potongan1`, `potongan2`, `potongan3`, `total_setelah_potongan`) VALUES
(1, 1, 2, 2, 1, 1500000.00, 100000.00, 50000.00, 25000.00, 1325000.00),
(2, 2, 8, 2, 1, 1500000.00, 100000.00, 50000.00, 25000.00, 1325000.00),
(3, 3, 9, 3, 1, 1500000.00, 100000.00, 50000.00, 25000.00, 1325000.00),
(4, 4, 3, 8, 1, 1500000.00, 100000.00, 50000.00, 25000.00, 1325000.00),
(5, 5, 9, 3, 1, 1500000.00, 100000.00, 50000.00, 25000.00, 1325000.00),
(6, 6, 5, 9, 1, 1500000.00, 100000.00, 50000.00, 25000.00, 1325000.00),
(7, 7, 10, 7, 1, 1500000.00, 100000.00, 50000.00, 25000.00, 1325000.00),
(8, 8, 4, 9, 1, 1500000.00, 100000.00, 50000.00, 25000.00, 1325000.00),
(9, 9, 4, 5, 1, 1500000.00, 100000.00, 50000.00, 25000.00, 1325000.00),
(10, 10, 7, 6, 1, 1500000.00, 100000.00, 50000.00, 25000.00, 1325000.00),
(11, 11, 11, 11, 1, 1400000.00, 50000.00, 50000.00, 50000.00, 1250000.00),
(12, 12, 12, 12, 1, 1500000.00, 200000.00, 100000.00, 0.00, 1200000.00),
(13, 13, 13, 13, 1, 1300000.00, 200000.00, 0.00, 0.00, 1100000.00),
(14, 14, 14, 14, 1, 1350000.00, 0.00, 0.00, 0.00, 1350000.00),
(15, 15, 15, 15, 1, 1250000.00, 0.00, 0.00, 0.00, 1250000.00),
(16, 16, 16, 16, 1, 1450000.00, 0.00, 0.00, 0.00, 1450000.00),
(17, 17, 17, 17, 1, 1550000.00, 0.00, 0.00, 0.00, 1550000.00),
(18, 18, 18, 18, 1, 1280000.00, 0.00, 0.00, 0.00, 1280000.00),
(19, 19, 19, 19, 1, 1300000.00, 0.00, 0.00, 0.00, 1300000.00),
(20, 20, 20, 20, 1, 1600000.00, 300000.00, 0.00, 0.00, 1300000.00);

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
(1, 'IC-9526', 'SKU-9241', 'Molestias Phone', '256GB', 'Samsung', 'Smartphone'),
(2, 'IC-1312', 'SKU-9200', 'Velit Phone', '64GB', 'Oppo', 'Smartphone'),
(3, 'IC-6026', 'SKU-8509', 'Temporibus Phone', '64GB', 'Xiaomi', 'Smartphone'),
(4, 'IC-2390', 'SKU-2909', 'Odit Phone', '64GB', 'Samsung', 'Smartphone'),
(5, 'IC-7851', 'SKU-5477', 'Facilis Phone', '256GB', 'Vivo', 'Smartphone'),
(6, 'IC-1854', 'SKU-7688', 'Reiciendis Phone', '64GB', 'Vivo', 'Smartphone'),
(7, 'IC-0273', 'SKU-7342', 'Dicta Phone', '128GB', 'Samsung', 'Smartphone'),
(8, 'IC-1719', 'SKU-3433', 'In Phone', '64GB', 'Samsung', 'Smartphone'),
(9, 'IC-2603', 'SKU-3420', 'Magnam Phone', '64GB', 'Xiaomi', 'Smartphone'),
(10, 'IC-8439', 'SKU-9535', 'Suscipit Phone', '256GB', 'Vivo', 'Smartphone'),
(11, 'IC-9991', 'SKU-1001', 'Nova Phone', '128GB', 'Realme', 'Smartphone'),
(12, 'IC-9992', 'SKU-1002', 'Zeta Phone', '256GB', 'Samsung', 'Smartphone'),
(13, 'IC-9993', 'SKU-1003', 'Alpha Phone', '64GB', 'Oppo', 'Smartphone'),
(14, 'IC-9994', 'SKU-1004', 'Beta Phone', '128GB', 'Xiaomi', 'Smartphone'),
(15, 'IC-9995', 'SKU-1005', 'Gamma Phone', '64GB', 'Vivo', 'Smartphone'),
(16, 'IC-9996', 'SKU-1006', 'Delta Phone', '128GB', 'Realme', 'Smartphone'),
(17, 'IC-9997', 'SKU-1007', 'Epsilon Phone', '256GB', 'Samsung', 'Smartphone'),
(18, 'IC-9998', 'SKU-1008', 'Theta Phone', '64GB', 'Oppo', 'Smartphone'),
(19, 'IC-9999', 'SKU-1009', 'Sigma Phone', '128GB', 'Xiaomi', 'Smartphone'),
(20, 'IC-10000', 'SKU-1010', 'Omega Phone', '256GB', 'Vivo', 'Smartphone');

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

--
-- Dumping data for table `reconcile`
--

INSERT INTO `reconcile` (`id`, `metode_pembayaran`, `kode_transaksi`, `tanggal_transaksi`, `status_pembayaran`, `nominal`) VALUES
(1, 'Transfer', 'TRX-614834', '2024-08-12 00:00:00', 'failed', 2500000.00),
(2, 'Transfer', 'TRX-872652', '2024-08-19 00:00:00', 'paid', 2500000.00),
(3, 'Transfer', 'TRX-451575', '2024-05-06 00:00:00', 'paid', 2500000.00),
(4, 'Transfer', 'TRX-898643', '2024-02-02 00:00:00', 'pending', 2500000.00),
(5, 'Transfer', 'TRX-197601', '2024-01-11 00:00:00', 'failed', 2500000.00),
(6, 'Transfer', 'TRX-600149', '2024-10-10 00:00:00', 'paid', 2500000.00),
(7, 'Transfer', 'TRX-164920', '2024-10-28 00:00:00', 'paid', 2500000.00),
(8, 'Transfer', 'TRX-834961', '2024-01-04 00:00:00', 'paid', 2500000.00),
(9, 'Transfer', 'TRX-212938', '2024-12-28 00:00:00', 'failed', 2500000.00),
(10, 'Transfer', 'TRX-232561', '2024-01-31 00:00:00', 'paid', 2500000.00),
(11, 'Transfer', 'TRX-100001', '2025-01-01 00:00:00', 'paid', 1250000.00),
(12, 'Transfer', 'TRX-100002', '2025-01-02 00:00:00', 'paid', 1200000.00),
(13, 'Transfer', 'TRX-100003', '2025-01-03 00:00:00', 'pending', 1000000.00),
(14, 'Transfer', 'TRX-100004', '2025-01-04 00:00:00', 'failed', 1500000.00),
(15, 'Transfer', 'TRX-100005', '2025-01-05 00:00:00', 'paid', 1500000.00),
(16, 'Transfer', 'TRX-100006', '2025-01-06 00:00:00', 'paid', 1500000.00),
(17, 'Transfer', 'TRX-100007', '2025-01-07 00:00:00', 'pending', 1000000.00),
(18, 'Transfer', 'TRX-100008', '2025-01-08 00:00:00', 'paid', 1500000.00),
(19, 'Transfer', 'TRX-100009', '2025-01-09 00:00:00', 'paid', 1500000.00),
(20, 'Transfer', 'TRX-100010', '2025-01-10 00:00:00', 'failed', 1300000.00);

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
(1, 5, 2, 48),
(2, 3, 9, 25),
(3, 3, 8, 34),
(4, 5, 9, 24),
(5, 6, 1, 24),
(6, 1, 6, 35),
(7, 5, 2, 23),
(8, 10, 6, 23),
(9, 8, 7, 39),
(10, 3, 5, 18),
(11, 11, 11, 20),
(12, 12, 12, 25),
(13, 13, 13, 18),
(14, 14, 14, 22),
(15, 15, 15, 19),
(16, 16, 16, 30),
(17, 17, 17, 17),
(18, 18, 18, 21),
(19, 19, 19, 23),
(20, 20, 20, 24);

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
(1, 4, 9, 44, 44, 0, '2024-10-26', 'Autem cupiditate amet quam nisi error id.'),
(2, 7, 10, 35, 35, 0, '2024-04-22', 'Necessitatibus perspiciatis ipsa maxime ducimus dolorem dolorum.'),
(3, 3, 9, 41, 39, -2, '2024-01-25', 'Ut iure quasi sequi magni neque.'),
(4, 2, 3, 50, 49, -1, '2024-12-14', 'Ipsa praesentium sit ipsum amet qui.'),
(5, 7, 10, 14, 15, 1, '2024-07-14', 'Alias magni voluptatem saepe sequi unde.'),
(6, 10, 8, 43, 43, 0, '2024-10-10', 'Est quis non minima blanditiis.'),
(7, 1, 2, 44, 44, 0, '2024-11-24', 'Explicabo quis quos saepe.'),
(8, 6, 2, 28, 29, 1, '2024-03-21', 'Tempora earum alias rerum.'),
(9, 8, 1, 26, 28, 2, '2024-04-01', 'Molestiae libero illo architecto ducimus.'),
(10, 9, 2, 50, 50, 0, '2024-11-23', 'Odit dolorem ex omnis.'),
(11, 11, 11, 20, 20, 0, '2025-01-01', 'Stok sesuai'),
(12, 12, 12, 25, 24, -1, '2025-01-02', 'Selisih minus'),
(13, 13, 13, 18, 18, 0, '2025-01-03', 'Stok sesuai'),
(14, 14, 14, 22, 21, -1, '2025-01-04', 'Pengurangan fisik'),
(15, 15, 15, 19, 20, 1, '2025-01-05', 'Penambahan fisik'),
(16, 16, 16, 30, 30, 0, '2025-01-06', 'Stok sesuai'),
(17, 17, 17, 17, 16, -1, '2025-01-07', 'Selisih minus'),
(18, 18, 18, 21, 21, 0, '2025-01-08', 'Stok sesuai'),
(19, 19, 19, 23, 23, 0, '2025-01-09', 'Stok sesuai'),
(20, 20, 20, 24, 24, 0, '2025-01-10', 'Stok sesuai');

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
(1, 'Gudang Salatiga', 'Gg. Suryakencana No. 182, Magelang, Banten 11463'),
(2, 'Gudang Lubuklinggau', 'Jalan Surapati No. 1, Pekalongan, RI 85445'),
(3, 'Gudang Mojokerto', 'Jalan W.R. Supratman No. 3, Bandung, Kepulauan Riau 48328'),
(4, 'Gudang Surakarta', 'Jalan Erlangga No. 5, Ambon, BE 91906'),
(5, 'Gudang Sungai Penuh', 'Gang Ciumbuleuit No. 128, Padang Sidempuan, AC 57544'),
(6, 'Gudang Mojokerto', 'Gang Pasirkoja No. 993, Madiun, SS 92508'),
(7, 'Gudang Gorontalo', 'Jl. Abdul Muis No. 4, Cilegon, Jambi 44334'),
(8, 'Gudang Batam', 'Gang Rajawali Barat No. 5, Padang, Sumatera Barat 90443'),
(9, 'Gudang Parepare', 'Gang Pasirkoja No. 673, Tual, Jawa Barat 52734'),
(10, 'Gudang Binjai', 'Gg. Waringin No. 79, Bau-Bau, SB 06806'),
(11, 'Gudang Semarang', 'Jl. Sisingamangaraja No. 10, Semarang, Jateng 50242'),
(12, 'Gudang Jakarta', 'Jl. Daan Mogot No. 22, Jakarta Barat, DKI 11510'),
(13, 'Gudang Palembang', 'Jl. Basuki Rahmat No. 100, Palembang, Sumsel 30126'),
(14, 'Gudang Medan', 'Jl. Gatot Subroto No. 55, Medan, Sumut 20212'),
(15, 'Gudang Surabaya', 'Jl. Diponegoro No. 77, Surabaya, Jatim 60234'),
(16, 'Gudang Bandung', 'Jl. Setiabudi No. 29, Bandung, Jabar 40154'),
(17, 'Gudang Yogyakarta', 'Jl. Kaliurang No. 5, Sleman, DIY 55281'),
(18, 'Gudang Balikpapan', 'Jl. Jenderal Sudirman No. 90, Balikpapan, Kaltim 76112'),
(19, 'Gudang Manado', 'Jl. Sam Ratulangi No. 2, Manado, Sulut 95113'),
(20, 'Gudang Denpasar', 'Jl. Imam Bonjol No. 60, Denpasar, Bali 80119');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `imei_sn`
--
ALTER TABLE `imei_sn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `inventory_batches`
--
ALTER TABLE `inventory_batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pos_sales`
--
ALTER TABLE `pos_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pos_sale_details`
--
ALTER TABLE `pos_sale_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reconcile`
--
ALTER TABLE `reconcile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stock_balances`
--
ALTER TABLE `stock_balances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stock_opname`
--
ALTER TABLE `stock_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
