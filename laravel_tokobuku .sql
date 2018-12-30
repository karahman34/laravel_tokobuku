-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 29, 2018 at 07:45 PM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_tokobuku`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `id_buku` int(10) UNSIGNED NOT NULL,
  `cover` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noisbn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(10) UNSIGNED NOT NULL,
  `harga_pokok` int(10) UNSIGNED NOT NULL,
  `harga_jual` int(10) UNSIGNED NOT NULL,
  `ppn` float UNSIGNED NOT NULL,
  `diskon` float UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`id_buku`, `cover`, `judul`, `noisbn`, `penulis`, `penerbit`, `tahun`, `stok`, `harga_pokok`, `harga_jual`, `ppn`, `diskon`, `created_at`, `updated_at`) VALUES
(2, '1685682546-Laravel.png', 'Laravel', '1234567890123', 'Adaw Kuro', 'Headset Studio', '2017', 17, 95000, 150000, 10, 10, '2018-12-26 01:11:15', '2018-12-29 12:40:44'),
(3, '1618017912-VueJS.png', 'VueJS', '1234567890124', 'Amer Sec', 'Headset Studio', '2017', 15, 95000, 150000, 10, 10, '2018-12-26 01:12:22', '2018-12-29 07:50:16'),
(4, '480185458-Code Igniter.jpg', 'Code Igniter', '1234567890125', 'Jawir Sec', 'Jenni', '2015', 0, 85000, 100000, 10, 0, '2018-12-26 01:13:50', '2018-12-26 19:18:22'),
(5, '45803599-Bootsrap 4.png', 'Bootsrap 4', '1234567890126', 'Oikawa', 'Aoba Johsai', '2018', 31, 150000, 200000, 10, 5, '2018-12-26 01:15:10', '2018-12-29 12:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id_cart` int(10) UNSIGNED NOT NULL,
  `id_kasir` int(10) UNSIGNED NOT NULL,
  `id_buku` int(10) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `harga_total` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id_cart`, `id_kasir`, `id_buku`, `jumlah`, `harga_total`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 3, 445500, '2018-12-29 12:40:44', '2018-12-29 12:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `id_distributor` int(10) UNSIGNED NOT NULL,
  `nama_distributor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`id_distributor`, `nama_distributor`, `alamat`, `telepon`, `created_at`, `updated_at`) VALUES
(1, 'Adaw Grosir', 'Jl.Cikabaya Nomer 20', '083921312931', '2018-12-26 01:16:03', '2018-12-26 01:16:03');

-- --------------------------------------------------------

--
-- Table structure for table `kasirs`
--

CREATE TABLE `kasirs` (
  `id_kasir` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `akses` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kasirs`
--

INSERT INTO `kasirs` (`id_kasir`, `email`, `email_verified_at`, `password`, `nama`, `alamat`, `telepon`, `akses`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'zack@gmail.com', '2018-12-26 00:33:10', '$2y$10$16AnCP36e0P93bvnRLtjm.oCic3/rB5q9XsDgA/v3aucKH1v5k3ZO', 'zack', 'jalan mana saja yang deket', '082902133212', 'kasir', '1744411257.jpg', 'uNSQqjtAaPENlPWOEruJzC6ozoZTOda7xGYXv2CNBUjafHhOXr7RXOOkJaHh', '2018-12-26 00:32:56', '2018-12-29 12:32:28'),
(2, 'super@admin.com', '2018-12-26 00:33:10', '$2y$10$UdiTnIER1l/9J9oBluOOte7RUXsLVQ/Itpjctcu/lUE3xggeeYy5K', 'Administrator', 'Jl.Tank baja No 195', '0894732921321', 'admin', '1169562599.jpg', '7aq5M1dggLuIEurWg4PzRXTW0tep9YYNivDJW4YpXDWciygN1InXKQstG33O', '2018-12-26 00:59:23', '2018-12-29 00:26:25'),
(4, 'jakarahman007@gmail.com', '2018-12-29 12:00:01', '$2y$10$jhQudK9dJCGz/XYRXKNouuCXy53seqG5pcP.xaYQ6cbwMicorBzOS', 'Jack', 'Jl.Infhotank No 23/12', '0856291321319', 'kasir', '696378262.jpg', 'Ec58rJue3zVsD57CwHF4rWyPLzKjpcMHBzr9Q3TQv5GbLx9JeLQSSz3prxjL', '2018-12-29 11:59:28', '2018-12-29 12:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2018_12_17_103113_create_distributors_table', 1),
(10, '2018_12_17_103114_create_bukus_table', 1),
(11, '2018_12_17_103134_create_pasoks_table', 1),
(12, '2018_12_17_103219_create_kasirs_table', 1),
(13, '2018_12_17_103220_create_penjualans_table', 1),
(14, '2018_12_25_042747_create_carts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pasoks`
--

CREATE TABLE `pasoks` (
  `id_pasok` int(10) UNSIGNED NOT NULL,
  `id_distributor` int(10) UNSIGNED NOT NULL,
  `id_buku` int(10) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pasoks`
--

INSERT INTO `pasoks` (`id_pasok`, `id_distributor`, `id_buku`, `jumlah`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 21, '2018-12-26 01:17:16', '2018-12-26 01:17:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjualans`
--

CREATE TABLE `penjualans` (
  `id_penjualan` int(10) UNSIGNED NOT NULL,
  `id_buku` int(10) UNSIGNED NOT NULL,
  `id_kasir` int(10) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `total` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualans`
--

INSERT INTO `penjualans` (`id_penjualan`, `id_buku`, `id_kasir`, `jumlah`, `total`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, 297000, '2018-12-26 04:03:28', '2018-12-26 04:03:28'),
(2, 3, 1, 2, 297000, '2018-12-26 04:03:28', '2018-12-26 04:03:28'),
(3, 2, 1, 2, 297000, '2018-12-26 04:06:41', '2018-12-26 04:06:41'),
(4, 5, 1, 4, 836000, '2018-12-26 18:52:15', '2018-12-26 18:52:15'),
(5, 4, 1, 5, 550000, '2018-12-26 19:18:22', '2018-12-26 19:18:22'),
(6, 5, 1, 5, 1045000, '2018-12-26 19:18:22', '2018-12-26 19:18:22'),
(7, 3, 1, 2, 297000, '2018-12-29 07:50:16', '2018-12-29 07:50:16'),
(8, 2, 4, 4, 594000, '2018-12-29 12:38:39', '2018-12-29 12:38:39'),
(9, 5, 4, 5, 1045000, '2018-12-29 12:38:39', '2018-12-29 12:38:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `carts_id_kasir_foreign` (`id_kasir`),
  ADD KEY `carts_id_buku_foreign` (`id_buku`);

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`id_distributor`);

--
-- Indexes for table `kasirs`
--
ALTER TABLE `kasirs`
  ADD PRIMARY KEY (`id_kasir`),
  ADD UNIQUE KEY `kasirs_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasoks`
--
ALTER TABLE `pasoks`
  ADD PRIMARY KEY (`id_pasok`),
  ADD KEY `pasoks_id_distributor_foreign` (`id_distributor`),
  ADD KEY `pasoks_id_buku_foreign` (`id_buku`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penjualans`
--
ALTER TABLE `penjualans`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `penjualans_id_buku_foreign` (`id_buku`),
  ADD KEY `penjualans_id_kasir_foreign` (`id_kasir`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id_buku` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id_cart` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id_distributor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kasirs`
--
ALTER TABLE `kasirs`
  MODIFY `id_kasir` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pasoks`
--
ALTER TABLE `pasoks`
  MODIFY `id_pasok` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `penjualans`
--
ALTER TABLE `penjualans`
  MODIFY `id_penjualan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_id_buku_foreign` FOREIGN KEY (`id_buku`) REFERENCES `bukus` (`id_buku`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_id_kasir_foreign` FOREIGN KEY (`id_kasir`) REFERENCES `kasirs` (`id_kasir`) ON DELETE CASCADE;

--
-- Constraints for table `pasoks`
--
ALTER TABLE `pasoks`
  ADD CONSTRAINT `pasoks_id_buku_foreign` FOREIGN KEY (`id_buku`) REFERENCES `bukus` (`id_buku`) ON DELETE CASCADE,
  ADD CONSTRAINT `pasoks_id_distributor_foreign` FOREIGN KEY (`id_distributor`) REFERENCES `distributors` (`id_distributor`) ON DELETE CASCADE;

--
-- Constraints for table `penjualans`
--
ALTER TABLE `penjualans`
  ADD CONSTRAINT `penjualans_id_buku_foreign` FOREIGN KEY (`id_buku`) REFERENCES `bukus` (`id_buku`) ON DELETE CASCADE,
  ADD CONSTRAINT `penjualans_id_kasir_foreign` FOREIGN KEY (`id_kasir`) REFERENCES `kasirs` (`id_kasir`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
