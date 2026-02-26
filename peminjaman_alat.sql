-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2026 at 10:17 AM
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
-- Database: `peminjaman_alat`
--

-- --------------------------------------------------------

--
-- Table structure for table `alats`
--

CREATE TABLE `alats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL,
  `kondisi` enum('baik','rusak_ringan','rusak_berat') NOT NULL DEFAULT 'baik',
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `soft_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alats`
--

INSERT INTO `alats` (`id`, `nama_alat`, `kategori_id`, `stok`, `kondisi`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`, `soft_delete`) VALUES
(1, 'Laptop ASUS ROG', 1, 4, 'baik', 'Laptop gaming high performance', '2026-02-25 12:36:50', '2026-02-26 15:52:19', NULL, 0),
(2, 'Printer Epson L3210', 1, 2, 'baik', 'Printer multifungsi', '2026-02-25 12:36:50', '2026-02-26 14:17:20', NULL, 0),
(3, 'Proyektor BenQ', 1, 2, 'baik', 'Proyektor presentasi', '2026-02-25 12:36:50', '2026-02-25 12:36:50', NULL, 0),
(4, 'Meja Kerja', 2, 10, 'baik', 'Meja kerja ergonomis', '2026-02-25 12:36:50', '2026-02-25 12:36:50', NULL, 0),
(5, 'Kursi Kantor', 2, 14, 'baik', 'Kursi kantor dengan sandaran', '2026-02-25 12:36:50', '2026-02-26 14:13:05', NULL, 0),
(6, 'Filing Cabinet', 2, 4, 'rusak_ringan', 'Lemari arsip kantor', '2026-02-25 12:36:50', '2026-02-25 12:36:50', NULL, 0),
(7, 'Bor Listrik', 3, 3, 'baik', 'Bor listrik dengan berbagai mata bor', '2026-02-25 12:36:50', '2026-02-25 12:36:50', NULL, 0),
(8, 'Gerinda Tangan', 3, 2, 'baik', 'Gerinda tangan untuk cutting', '2026-02-25 12:36:50', '2026-02-25 12:36:50', NULL, 0),
(9, 'Palu Godam', 3, 5, 'baik', 'Palu godam untuk konstruksi', '2026-02-25 12:36:50', '2026-02-25 12:36:50', NULL, 0),
(10, 'PC Desktop Core i7', 4, 5, 'baik', 'PC desktop untuk programming', '2026-02-25 12:36:50', '2026-02-26 15:02:50', '2026-02-26 15:02:50', 0),
(11, 'Monitor LG 24\"', 4, 6, 'baik', 'Monitor LED 24 inch', '2026-02-25 12:36:50', '2026-02-26 15:02:57', '2026-02-26 15:02:57', 0),
(12, 'Keyboard Mechanical', 4, 8, 'baik', 'Keyboard mechanical RGB', '2026-02-25 12:36:50', '2026-02-25 12:36:50', NULL, 0),
(13, 'Speaker Bluetooth', 5, 4, 'baik', 'Speaker bluetooth portable', '2026-02-25 12:36:50', '2026-02-25 12:36:50', NULL, 0),
(14, 'Microphone Wireless', 5, 2, 'baik', 'Microphone wireless untuk presentasi', '2026-02-25 12:36:50', '2026-02-25 12:36:50', NULL, 0),
(15, 'Camera DSLR', 5, 1, 'rusak_ringan', 'Kamera DSLR untuk dokumentasi', '2026-02-25 12:36:50', '2026-02-25 12:36:50', NULL, 0),
(16, 'Basket Ball', 6, 10, 'baik', 'Bola basket standar', '2026-02-25 12:36:51', '2026-02-25 12:36:51', NULL, 0),
(17, 'Sepak Bola', 6, 8, 'baik', 'Bola sepak bola', '2026-02-25 12:36:51', '2026-02-25 12:36:51', NULL, 0),
(18, 'Raket Badminton', 6, 6, 'baik', 'Raket badminton professional', '2026-02-25 12:36:51', '2026-02-25 12:36:51', NULL, 0),
(19, 'Laptop ASUS ROG', 1, 5, 'baik', 'Laptop gaming high performance', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(20, 'Printer Epson L3210', 1, 3, 'baik', 'Printer multifungsi', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(21, 'Proyektor BenQ', 1, 2, 'baik', 'Proyektor presentasi', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(22, 'Meja Kerja', 2, 10, 'baik', 'Meja kerja ergonomis', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(23, 'Kursi Kantor', 2, 15, 'baik', 'Kursi kantor dengan sandaran', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(24, 'Filing Cabinet', 2, 4, 'rusak_ringan', 'Lemari arsip kantor', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(25, 'Bor Listrik', 3, 3, 'baik', 'Bor listrik dengan berbagai mata bor', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(26, 'Gerinda Tangan', 3, 2, 'baik', 'Gerinda tangan untuk cutting', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(27, 'Palu Godam', 3, 5, 'baik', 'Palu godam untuk konstruksi', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(28, 'PC Desktop Core i7', 4, 4, 'baik', 'PC desktop untuk programming', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(29, 'Monitor LG 24\"', 4, 6, 'baik', 'Monitor LED 24 inch', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(30, 'Keyboard Mechanical', 4, 8, 'baik', 'Keyboard mechanical RGB', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(31, 'Speaker Bluetooth', 5, 4, 'baik', 'Speaker bluetooth portable', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(32, 'Microphone Wireless', 5, 2, 'baik', 'Microphone wireless untuk presentasi', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(33, 'Camera DSLR', 5, 1, 'rusak_ringan', 'Kamera DSLR untuk dokumentasi', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(34, 'Basket Ball', 6, 10, 'baik', 'Bola basket standar', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(35, 'Sepak Bola', 6, 8, 'baik', 'Bola sepak bola', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(36, 'Raket Badminton', 6, 6, 'baik', 'Raket badminton professional', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(37, 'Laptop ASUS ROG', 1, 5, 'baik', 'Laptop gaming high performance', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(38, 'Printer Epson L3210', 1, 3, 'baik', 'Printer multifungsi', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(39, 'Proyektor BenQ', 1, 2, 'baik', 'Proyektor presentasi', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(40, 'Meja Kerja', 2, 10, 'baik', 'Meja kerja ergonomis', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(41, 'Kursi Kantor', 2, 15, 'baik', 'Kursi kantor dengan sandaran', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(42, 'Filing Cabinet', 2, 4, 'rusak_ringan', 'Lemari arsip kantor', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(43, 'Bor Listrik', 3, 3, 'baik', 'Bor listrik dengan berbagai mata bor', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(44, 'Gerinda Tangan', 3, 2, 'baik', 'Gerinda tangan untuk cutting', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(45, 'Palu Godam', 3, 5, 'baik', 'Palu godam untuk konstruksi', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(46, 'PC Desktop Core i7', 4, 4, 'baik', 'PC desktop untuk programming', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(47, 'Monitor LG 24\"', 4, 6, 'baik', 'Monitor LED 24 inch', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(48, 'Keyboard Mechanical', 4, 8, 'baik', 'Keyboard mechanical RGB', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(49, 'Speaker Bluetooth', 5, 4, 'baik', 'Speaker bluetooth portable', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(50, 'Microphone Wireless', 5, 2, 'baik', 'Microphone wireless untuk presentasi', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(51, 'Camera DSLR', 5, 1, 'rusak_ringan', 'Kamera DSLR untuk dokumentasi', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(52, 'Basket Ball', 6, 10, 'baik', 'Bola basket standar', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(53, 'Sepak Bola', 6, 8, 'baik', 'Bola sepak bola', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(54, 'Raket Badminton', 6, 6, 'baik', 'Raket badminton professional', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `soft_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`, `soft_delete`) VALUES
(1, 'Elektronik', 'Peralatan elektronik dan gadget', '2026-02-25 12:36:22', '2026-02-25 12:36:22', NULL, 0),
(2, 'Peralatan Kantor', 'Peralatan untuk kebutuhan kantor', '2026-02-25 12:36:22', '2026-02-25 12:36:22', NULL, 0),
(3, 'Alat Berat', 'Peralatan konstruksi dan alat berat', '2026-02-25 12:36:22', '2026-02-25 12:36:22', NULL, 0),
(4, 'Komputer & IT', 'Peralatan komputer dan teknologi informasi', '2026-02-25 12:36:22', '2026-02-25 12:36:22', NULL, 0),
(5, 'Audio Visual', 'Peralatan audio dan visual', '2026-02-25 12:36:22', '2026-02-25 12:36:22', NULL, 0),
(6, 'Olahraga', 'Peralatan olahraga dan fitness', '2026-02-25 12:36:22', '2026-02-25 12:36:22', NULL, 0),
(14, 'Peralatan Kantor', 'Peralatan untuk kebutuhan kantor', '2026-02-25 12:37:43', '2026-02-25 12:37:43', NULL, 0),
(15, 'Alat kontruksi', 'Peralatan konstruksi dan alat berat', '2026-02-25 12:37:43', '2026-02-26 15:03:06', '2026-02-26 15:03:06', 0),
(19, 'Elektronik', 'Peralatan elektronik dan gadget', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0),
(21, 'Alat Berat', 'Peralatan konstruksi dan alat berat', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_activities`
--

CREATE TABLE `log_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `aktivitas` varchar(255) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_activities`
--

INSERT INTO `log_activities` (`id`, `user_id`, `aktivitas`, `waktu`, `created_at`, `updated_at`) VALUES
(1, 3, 'Melihat daftar alat tersedia', '2026-02-25 12:39:01', '2026-02-25 12:39:01', '2026-02-25 12:39:01'),
(2, 3, 'Melihat daftar alat tersedia', '2026-02-25 12:41:17', '2026-02-25 12:41:17', '2026-02-25 12:41:17'),
(3, 3, 'Melihat daftar alat tersedia', '2026-02-25 12:53:17', '2026-02-25 12:53:17', '2026-02-25 12:53:17'),
(4, 3, 'Mengajukan peminjaman: Laptop ASUS ROG', '2026-02-25 12:53:34', '2026-02-25 12:53:34', '2026-02-25 12:53:34'),
(5, 3, 'Melihat daftar peminjaman saya', '2026-02-25 12:54:59', '2026-02-25 12:54:59', '2026-02-25 12:54:59'),
(6, 3, 'Melihat daftar peminjaman saya', '2026-02-25 12:59:26', '2026-02-25 12:59:26', '2026-02-25 12:59:26'),
(7, 3, 'Melihat daftar peminjaman saya', '2026-02-25 12:59:46', '2026-02-25 12:59:46', '2026-02-25 12:59:46'),
(8, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:00:05', '2026-02-25 13:00:05', '2026-02-25 13:00:05'),
(9, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:11:27', '2026-02-25 13:11:27', '2026-02-25 13:11:27'),
(10, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:12:09', '2026-02-25 13:12:09', '2026-02-25 13:12:09'),
(11, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:12:26', '2026-02-25 13:12:26', '2026-02-25 13:12:26'),
(12, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:12:47', '2026-02-25 13:12:47', '2026-02-25 13:12:47'),
(13, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:13:37', '2026-02-25 13:13:37', '2026-02-25 13:13:37'),
(14, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:14:09', '2026-02-25 13:14:09', '2026-02-25 13:14:09'),
(15, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:19:10', '2026-02-25 13:19:10', '2026-02-25 13:19:10'),
(16, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:21:46', '2026-02-25 13:21:46', '2026-02-25 13:21:46'),
(17, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:22:13', '2026-02-25 13:22:13', '2026-02-25 13:22:13'),
(18, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:22:24', '2026-02-25 13:22:24', '2026-02-25 13:22:24'),
(19, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:23:26', '2026-02-25 13:23:26', '2026-02-25 13:23:26'),
(20, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:24:38', '2026-02-25 13:24:38', '2026-02-25 13:24:38'),
(21, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:25:45', '2026-02-25 13:25:45', '2026-02-25 13:25:45'),
(22, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:33:23', '2026-02-25 13:33:23', '2026-02-25 13:33:23'),
(23, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:33:44', '2026-02-25 13:33:44', '2026-02-25 13:33:44'),
(24, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:33:57', '2026-02-25 13:33:57', '2026-02-25 13:33:57'),
(25, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:34:21', '2026-02-25 13:34:21', '2026-02-25 13:34:21'),
(26, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:34:54', '2026-02-25 13:34:54', '2026-02-25 13:34:54'),
(27, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:35:22', '2026-02-25 13:35:22', '2026-02-25 13:35:22'),
(28, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:36:31', '2026-02-25 13:36:31', '2026-02-25 13:36:31'),
(29, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:37:40', '2026-02-25 13:37:40', '2026-02-25 13:37:40'),
(30, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:37:54', '2026-02-25 13:37:54', '2026-02-25 13:37:54'),
(31, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:38:25', '2026-02-25 13:38:25', '2026-02-25 13:38:25'),
(32, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:38:42', '2026-02-25 13:38:42', '2026-02-25 13:38:42'),
(33, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:39:21', '2026-02-25 13:39:21', '2026-02-25 13:39:21'),
(34, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:39:44', '2026-02-25 13:39:44', '2026-02-25 13:39:44'),
(35, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:39:53', '2026-02-25 13:39:53', '2026-02-25 13:39:53'),
(36, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:40:12', '2026-02-25 13:40:12', '2026-02-25 13:40:12'),
(37, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:40:28', '2026-02-25 13:40:28', '2026-02-25 13:40:28'),
(38, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:40:51', '2026-02-25 13:40:51', '2026-02-25 13:40:51'),
(39, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:41:04', '2026-02-25 13:41:04', '2026-02-25 13:41:04'),
(40, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:41:19', '2026-02-25 13:41:19', '2026-02-25 13:41:19'),
(41, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:41:30', '2026-02-25 13:41:30', '2026-02-25 13:41:30'),
(42, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:41:43', '2026-02-25 13:41:43', '2026-02-25 13:41:43'),
(43, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:41:56', '2026-02-25 13:41:56', '2026-02-25 13:41:56'),
(44, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:42:13', '2026-02-25 13:42:13', '2026-02-25 13:42:13'),
(45, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:42:29', '2026-02-25 13:42:29', '2026-02-25 13:42:29'),
(46, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:42:45', '2026-02-25 13:42:45', '2026-02-25 13:42:45'),
(47, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:45:21', '2026-02-25 13:45:21', '2026-02-25 13:45:21'),
(48, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:46:12', '2026-02-25 13:46:12', '2026-02-25 13:46:12'),
(49, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:46:38', '2026-02-25 13:46:38', '2026-02-25 13:46:38'),
(50, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:47:06', '2026-02-25 13:47:06', '2026-02-25 13:47:06'),
(51, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:47:24', '2026-02-25 13:47:24', '2026-02-25 13:47:24'),
(52, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:50:24', '2026-02-25 13:50:24', '2026-02-25 13:50:24'),
(53, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:50:41', '2026-02-25 13:50:41', '2026-02-25 13:50:41'),
(54, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:52:22', '2026-02-25 13:52:22', '2026-02-25 13:52:22'),
(55, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:52:27', '2026-02-25 13:52:27', '2026-02-25 13:52:27'),
(56, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:52:34', '2026-02-25 13:52:34', '2026-02-25 13:52:34'),
(57, 3, 'Melihat daftar alat tersedia', '2026-02-25 13:52:47', '2026-02-25 13:52:47', '2026-02-25 13:52:47'),
(58, 3, 'Mengajukan peminjaman: Printer Epson L3210', '2026-02-25 13:54:33', '2026-02-25 13:54:33', '2026-02-25 13:54:33'),
(59, 3, 'Melihat daftar peminjaman saya', '2026-02-25 13:54:34', '2026-02-25 13:54:34', '2026-02-25 13:54:34'),
(60, 1, 'Melihat daftar pengembalian', '2026-02-25 13:55:58', '2026-02-25 13:55:58', '2026-02-25 13:55:58'),
(61, 1, 'Melihat daftar peminjaman', '2026-02-25 13:56:10', '2026-02-25 13:56:10', '2026-02-25 13:56:10'),
(62, 1, 'Menolak peminjaman: Printer Epson L3210 oleh John Doe', '2026-02-25 13:56:28', '2026-02-25 13:56:28', '2026-02-25 13:56:28'),
(63, 1, 'Melihat daftar peminjaman', '2026-02-25 13:56:29', '2026-02-25 13:56:29', '2026-02-25 13:56:29'),
(64, 1, 'Menginput pengembalian: Laptop ASUS ROG oleh User Test', '2026-02-25 13:59:24', '2026-02-25 13:59:24', '2026-02-25 13:59:24'),
(65, 1, 'Melihat daftar pengembalian', '2026-02-25 13:59:25', '2026-02-25 13:59:25', '2026-02-25 13:59:25'),
(66, 1, 'Melihat daftar pengembalian', '2026-02-25 14:00:26', '2026-02-25 14:00:26', '2026-02-25 14:00:26'),
(67, 1, 'Melihat daftar pengembalian', '2026-02-25 14:00:37', '2026-02-25 14:00:37', '2026-02-25 14:00:37'),
(68, 1, 'Melihat daftar pengembalian', '2026-02-25 14:00:48', '2026-02-25 14:00:48', '2026-02-25 14:00:48'),
(69, 1, 'Melihat daftar user', '2026-02-25 14:00:57', '2026-02-25 14:00:57', '2026-02-25 14:00:57'),
(70, 1, 'Melihat daftar peminjaman', '2026-02-25 14:01:03', '2026-02-25 14:01:03', '2026-02-25 14:01:03'),
(71, 1, 'Menginput pengembalian: PC Desktop Core i7 oleh Budi Santoso', '2026-02-25 14:02:35', '2026-02-25 14:02:35', '2026-02-25 14:02:35'),
(72, 1, 'Melihat daftar pengembalian', '2026-02-25 14:02:36', '2026-02-25 14:02:36', '2026-02-25 14:02:36'),
(73, 1, 'Melihat daftar pengembalian', '2026-02-25 14:03:23', '2026-02-25 14:03:23', '2026-02-25 14:03:23'),
(74, 1, 'Melihat daftar pengembalian', '2026-02-25 14:04:29', '2026-02-25 14:04:29', '2026-02-25 14:04:29'),
(75, 1, 'Melihat daftar pengembalian', '2026-02-25 14:06:01', '2026-02-25 14:06:01', '2026-02-25 14:06:01'),
(76, 1, 'Melihat daftar peminjaman', '2026-02-25 14:06:18', '2026-02-25 14:06:18', '2026-02-25 14:06:18'),
(77, 1, 'Melihat daftar pengembalian', '2026-02-25 14:07:08', '2026-02-25 14:07:08', '2026-02-25 14:07:08'),
(78, 1, 'Melihat daftar alat', '2026-02-25 14:07:29', '2026-02-25 14:07:29', '2026-02-25 14:07:29'),
(79, 1, 'Melihat daftar alat', '2026-02-25 14:08:37', '2026-02-25 14:08:37', '2026-02-25 14:08:37'),
(80, 1, 'Melihat daftar alat', '2026-02-25 14:09:56', '2026-02-25 14:09:56', '2026-02-25 14:09:56'),
(81, 1, 'Melihat daftar alat', '2026-02-25 14:11:12', '2026-02-25 14:11:12', '2026-02-25 14:11:12'),
(82, 1, 'Melihat daftar kategori', '2026-02-25 14:11:37', '2026-02-25 14:11:37', '2026-02-25 14:11:37'),
(83, 1, 'Melihat daftar kategori', '2026-02-25 14:13:37', '2026-02-25 14:13:37', '2026-02-25 14:13:37'),
(84, 1, 'Melihat daftar alat', '2026-02-25 14:13:47', '2026-02-25 14:13:47', '2026-02-25 14:13:47'),
(85, 1, 'Melihat daftar kategori', '2026-02-25 14:13:57', '2026-02-25 14:13:57', '2026-02-25 14:13:57'),
(86, 1, 'Melihat daftar kategori', '2026-02-25 14:16:10', '2026-02-25 14:16:10', '2026-02-25 14:16:10'),
(87, 1, 'Melihat daftar kategori', '2026-02-25 14:18:28', '2026-02-25 14:18:28', '2026-02-25 14:18:28'),
(88, 1, 'Melihat daftar kategori', '2026-02-25 14:18:29', '2026-02-25 14:18:29', '2026-02-25 14:18:29'),
(89, 1, 'Melihat daftar alat', '2026-02-25 14:18:38', '2026-02-25 14:18:38', '2026-02-25 14:18:38'),
(90, 1, 'Mengupdate alat: Laptop ASUS ROG', '2026-02-25 14:18:48', '2026-02-25 14:18:48', '2026-02-25 14:18:48'),
(91, 1, 'Melihat daftar alat', '2026-02-25 14:18:49', '2026-02-25 14:18:49', '2026-02-25 14:18:49'),
(92, 1, 'Melihat daftar kategori', '2026-02-25 14:18:52', '2026-02-25 14:18:52', '2026-02-25 14:18:52'),
(93, 1, 'Melihat daftar user', '2026-02-25 14:19:09', '2026-02-25 14:19:09', '2026-02-25 14:19:09'),
(94, 1, 'Mencetak laporan peminjaman', '2026-02-25 14:20:06', '2026-02-25 14:20:06', '2026-02-25 14:20:06'),
(95, 1, 'Mencetak laporan peminjaman', '2026-02-25 14:21:14', '2026-02-25 14:21:14', '2026-02-25 14:21:14'),
(96, 1, 'Mencetak laporan peminjaman', '2026-02-25 14:22:02', '2026-02-25 14:22:02', '2026-02-25 14:22:02'),
(97, 1, 'Melihat daftar pengembalian', '2026-02-26 12:11:04', '2026-02-26 12:11:04', '2026-02-26 12:11:04'),
(98, 1, 'Melihat daftar user', '2026-02-26 12:11:14', '2026-02-26 12:11:14', '2026-02-26 12:11:14'),
(99, 1, 'Melihat daftar kategori', '2026-02-26 12:11:27', '2026-02-26 12:11:27', '2026-02-26 12:11:27'),
(100, 1, 'Melihat daftar alat', '2026-02-26 12:11:33', '2026-02-26 12:11:33', '2026-02-26 12:11:33'),
(101, 1, 'Melihat daftar kategori', '2026-02-26 12:14:48', '2026-02-26 12:14:48', '2026-02-26 12:14:48'),
(102, 1, 'Melihat daftar kategori', '2026-02-26 12:18:06', '2026-02-26 12:18:06', '2026-02-26 12:18:06'),
(103, 1, 'Melihat daftar kategori', '2026-02-26 12:29:59', '2026-02-26 12:29:59', '2026-02-26 12:29:59'),
(104, 1, 'Melihat daftar kategori', '2026-02-26 12:30:06', '2026-02-26 12:30:06', '2026-02-26 12:30:06'),
(105, 1, 'Melihat daftar kategori', '2026-02-26 12:30:11', '2026-02-26 12:30:11', '2026-02-26 12:30:11'),
(106, 1, 'Melihat daftar kategori', '2026-02-26 12:30:14', '2026-02-26 12:30:14', '2026-02-26 12:30:14'),
(107, 1, 'Melihat daftar kategori', '2026-02-26 12:30:20', '2026-02-26 12:30:20', '2026-02-26 12:30:20'),
(108, 1, 'Melihat daftar kategori', '2026-02-26 12:30:26', '2026-02-26 12:30:26', '2026-02-26 12:30:26'),
(109, 1, 'Melihat daftar kategori', '2026-02-26 12:30:49', '2026-02-26 12:30:49', '2026-02-26 12:30:49'),
(110, 1, 'Melihat daftar kategori', '2026-02-26 12:33:07', '2026-02-26 12:33:07', '2026-02-26 12:33:07'),
(111, 1, 'Menghapus kategori: Peralatan Kantor', '2026-02-26 12:33:15', '2026-02-26 12:33:15', '2026-02-26 12:33:15'),
(112, 1, 'Melihat daftar kategori', '2026-02-26 12:33:15', '2026-02-26 12:33:15', '2026-02-26 12:33:15'),
(113, 1, 'Menghapus kategori: Elektronik', '2026-02-26 12:33:21', '2026-02-26 12:33:21', '2026-02-26 12:33:21'),
(114, 1, 'Melihat daftar kategori', '2026-02-26 12:33:22', '2026-02-26 12:33:22', '2026-02-26 12:33:22'),
(115, 1, 'Menghapus kategori: Komputer & IT', '2026-02-26 12:33:30', '2026-02-26 12:33:30', '2026-02-26 12:33:30'),
(116, 1, 'Melihat daftar kategori', '2026-02-26 12:33:30', '2026-02-26 12:33:30', '2026-02-26 12:33:30'),
(117, 1, 'Menghapus kategori: Audio Visual', '2026-02-26 12:33:38', '2026-02-26 12:33:38', '2026-02-26 12:33:38'),
(118, 1, 'Melihat daftar kategori', '2026-02-26 12:33:38', '2026-02-26 12:33:38', '2026-02-26 12:33:38'),
(119, 1, 'Menghapus kategori: Alat Berat', '2026-02-26 12:33:42', '2026-02-26 12:33:42', '2026-02-26 12:33:42'),
(120, 1, 'Melihat daftar kategori', '2026-02-26 12:33:42', '2026-02-26 12:33:42', '2026-02-26 12:33:42'),
(121, 1, 'Menghapus kategori: Olahraga', '2026-02-26 12:33:47', '2026-02-26 12:33:47', '2026-02-26 12:33:47'),
(122, 1, 'Melihat daftar kategori', '2026-02-26 12:33:47', '2026-02-26 12:33:47', '2026-02-26 12:33:47'),
(123, 1, 'Menghapus kategori: Elektronik', '2026-02-26 12:33:55', '2026-02-26 12:33:55', '2026-02-26 12:33:55'),
(124, 1, 'Melihat daftar kategori', '2026-02-26 12:33:55', '2026-02-26 12:33:55', '2026-02-26 12:33:55'),
(125, 1, 'Mengupdate kategori: Alat kontruksi', '2026-02-26 12:34:15', '2026-02-26 12:34:15', '2026-02-26 12:34:15'),
(126, 1, 'Melihat daftar kategori', '2026-02-26 12:34:15', '2026-02-26 12:34:15', '2026-02-26 12:34:15'),
(127, 1, 'Melihat daftar kategori', '2026-02-26 12:35:14', '2026-02-26 12:35:14', '2026-02-26 12:35:14'),
(128, 1, 'Melihat daftar kategori', '2026-02-26 12:38:35', '2026-02-26 12:38:35', '2026-02-26 12:38:35'),
(129, 1, 'Melihat daftar alat', '2026-02-26 12:39:22', '2026-02-26 12:39:22', '2026-02-26 12:39:22'),
(130, 1, 'Melihat daftar kategori', '2026-02-26 12:39:28', '2026-02-26 12:39:28', '2026-02-26 12:39:28'),
(131, 1, 'Melihat daftar user', '2026-02-26 12:39:31', '2026-02-26 12:39:31', '2026-02-26 12:39:31'),
(132, 1, 'Melihat daftar user', '2026-02-26 12:40:43', '2026-02-26 12:40:43', '2026-02-26 12:40:43'),
(133, 1, 'Melihat daftar kategori', '2026-02-26 12:40:56', '2026-02-26 12:40:56', '2026-02-26 12:40:56'),
(134, 1, 'Melihat daftar alat', '2026-02-26 12:41:00', '2026-02-26 12:41:00', '2026-02-26 12:41:00'),
(135, 1, 'Melihat daftar alat', '2026-02-26 12:41:08', '2026-02-26 12:41:08', '2026-02-26 12:41:08'),
(136, 1, 'Melihat daftar alat', '2026-02-26 12:41:15', '2026-02-26 12:41:15', '2026-02-26 12:41:15'),
(137, 1, 'Melihat daftar user', '2026-02-26 12:41:20', '2026-02-26 12:41:20', '2026-02-26 12:41:20'),
(138, 1, 'Melihat daftar peminjaman', '2026-02-26 12:41:25', '2026-02-26 12:41:25', '2026-02-26 12:41:25'),
(139, 1, 'Melihat daftar alat', '2026-02-26 12:41:30', '2026-02-26 12:41:30', '2026-02-26 12:41:30'),
(140, 1, 'Melihat daftar peminjaman', '2026-02-26 12:53:38', '2026-02-26 12:53:38', '2026-02-26 12:53:38'),
(141, 1, 'Melihat daftar kategori', '2026-02-26 12:54:15', '2026-02-26 12:54:15', '2026-02-26 12:54:15'),
(142, 1, 'Melihat daftar kategori', '2026-02-26 12:54:22', '2026-02-26 12:54:22', '2026-02-26 12:54:22'),
(143, 1, 'Melihat daftar kategori', '2026-02-26 12:54:29', '2026-02-26 12:54:29', '2026-02-26 12:54:29'),
(144, 1, 'Melihat daftar alat', '2026-02-26 12:54:33', '2026-02-26 12:54:33', '2026-02-26 12:54:33'),
(145, 1, 'Melihat daftar peminjaman', '2026-02-26 12:54:36', '2026-02-26 12:54:36', '2026-02-26 12:54:36'),
(146, 1, 'Melihat daftar user', '2026-02-26 12:55:08', '2026-02-26 12:55:08', '2026-02-26 12:55:08'),
(147, 1, 'Melihat daftar user', '2026-02-26 12:55:19', '2026-02-26 12:55:19', '2026-02-26 12:55:19'),
(148, 1, 'Melihat daftar user', '2026-02-26 12:58:57', '2026-02-26 12:58:57', '2026-02-26 12:58:57'),
(149, 1, 'Melihat daftar pengembalian', '2026-02-26 12:59:00', '2026-02-26 12:59:00', '2026-02-26 12:59:00'),
(150, 1, 'Melihat daftar pengembalian', '2026-02-26 12:59:26', '2026-02-26 12:59:26', '2026-02-26 12:59:26'),
(151, 4, 'Melihat daftar alat tersedia', '2026-02-26 13:00:54', '2026-02-26 13:00:54', '2026-02-26 13:00:54'),
(152, 4, 'Melihat daftar peminjaman saya', '2026-02-26 13:00:56', '2026-02-26 13:00:56', '2026-02-26 13:00:56'),
(153, 4, 'Melihat daftar alat tersedia', '2026-02-26 13:01:06', '2026-02-26 13:01:06', '2026-02-26 13:01:06'),
(154, 4, 'Melihat daftar alat tersedia', '2026-02-26 13:01:47', '2026-02-26 13:01:47', '2026-02-26 13:01:47'),
(155, 4, 'Melihat daftar alat tersedia', '2026-02-26 13:01:51', '2026-02-26 13:01:51', '2026-02-26 13:01:51'),
(156, 4, 'Melihat daftar alat tersedia', '2026-02-26 13:02:32', '2026-02-26 13:02:32', '2026-02-26 13:02:32'),
(157, 4, 'Mengajukan peminjaman: Laptop ASUS ROG', '2026-02-26 13:05:02', '2026-02-26 13:05:02', '2026-02-26 13:05:02'),
(158, 4, 'Melihat daftar peminjaman saya', '2026-02-26 13:05:03', '2026-02-26 13:05:03', '2026-02-26 13:05:03'),
(159, 1, 'Melihat daftar user', '2026-02-26 13:05:22', '2026-02-26 13:05:22', '2026-02-26 13:05:22'),
(160, 1, 'Melihat daftar peminjaman', '2026-02-26 13:05:23', '2026-02-26 13:05:23', '2026-02-26 13:05:23'),
(161, 1, 'Melihat daftar peminjaman', '2026-02-26 13:06:36', '2026-02-26 13:06:36', '2026-02-26 13:06:36'),
(162, 1, 'Menyetujui peminjaman: Printer Epson L3210 oleh John Doe', '2026-02-26 13:06:41', '2026-02-26 13:06:41', '2026-02-26 13:06:41'),
(163, 4, 'Melihat daftar peminjaman saya', '2026-02-26 13:07:13', '2026-02-26 13:07:13', '2026-02-26 13:07:13'),
(164, 4, 'Melihat daftar peminjaman saya', '2026-02-26 13:16:05', '2026-02-26 13:16:05', '2026-02-26 13:16:05'),
(165, 4, 'Melihat daftar alat tersedia', '2026-02-26 13:28:55', '2026-02-26 13:28:55', '2026-02-26 13:28:55'),
(166, 2, 'Melihat laporan log activity', '2026-02-26 13:29:34', '2026-02-26 13:29:34', '2026-02-26 13:29:34'),
(167, 2, 'Melihat daftar alat', '2026-02-26 13:29:48', '2026-02-26 13:29:48', '2026-02-26 13:29:48'),
(168, 2, 'Melihat daftar pengembalian', '2026-02-26 13:29:56', '2026-02-26 13:29:56', '2026-02-26 13:29:56'),
(169, 2, 'Melihat laporan log activity', '2026-02-26 13:30:02', '2026-02-26 13:30:02', '2026-02-26 13:30:02'),
(170, 2, 'Melihat daftar peminjaman', '2026-02-26 13:30:18', '2026-02-26 13:30:18', '2026-02-26 13:30:18'),
(171, 2, 'Melihat laporan log activity', '2026-02-26 13:30:53', '2026-02-26 13:30:53', '2026-02-26 13:30:53'),
(172, 2, 'Melihat laporan log activity', '2026-02-26 13:35:10', '2026-02-26 13:35:10', '2026-02-26 13:35:10'),
(173, 2, 'Mencetak laporan peminjaman', '2026-02-26 13:35:29', '2026-02-26 13:35:29', '2026-02-26 13:35:29'),
(174, 2, 'Melihat laporan log activity', '2026-02-26 13:35:35', '2026-02-26 13:35:35', '2026-02-26 13:35:35'),
(175, 2, 'Mencetak laporan peminjaman', '2026-02-26 13:35:59', '2026-02-26 13:35:59', '2026-02-26 13:35:59'),
(176, 2, 'Melihat laporan log activity', '2026-02-26 13:36:06', '2026-02-26 13:36:06', '2026-02-26 13:36:06'),
(177, 1, 'Melihat laporan log activity', '2026-02-26 13:36:39', '2026-02-26 13:36:39', '2026-02-26 13:36:39'),
(178, 1, 'Melihat daftar pengembalian', '2026-02-26 13:36:45', '2026-02-26 13:36:45', '2026-02-26 13:36:45'),
(179, 1, 'Mencetak laporan peminjaman', '2026-02-26 13:36:58', '2026-02-26 13:36:58', '2026-02-26 13:36:58'),
(180, 1, 'Mencetak laporan pengembalian', '2026-02-26 13:37:03', '2026-02-26 13:37:03', '2026-02-26 13:37:03'),
(181, 1, 'Melihat daftar user', '2026-02-26 13:37:13', '2026-02-26 13:37:13', '2026-02-26 13:37:13'),
(182, 1, 'Melihat daftar kategori', '2026-02-26 13:37:19', '2026-02-26 13:37:19', '2026-02-26 13:37:19'),
(183, 1, 'Melihat daftar alat', '2026-02-26 13:37:23', '2026-02-26 13:37:23', '2026-02-26 13:37:23'),
(184, 1, 'Melihat daftar alat', '2026-02-26 13:37:45', '2026-02-26 13:37:45', '2026-02-26 13:37:45'),
(185, 1, 'Melihat laporan log activity', '2026-02-26 13:37:55', '2026-02-26 13:37:55', '2026-02-26 13:37:55'),
(186, 1, 'Melihat daftar pengembalian', '2026-02-26 13:38:14', '2026-02-26 13:38:14', '2026-02-26 13:38:14'),
(187, 1, 'Melihat daftar user', '2026-02-26 13:39:05', '2026-02-26 13:39:05', '2026-02-26 13:39:05'),
(188, 1, 'Mencetak laporan peminjaman', '2026-02-26 13:39:11', '2026-02-26 13:39:11', '2026-02-26 13:39:11'),
(189, 1, 'Mencetak laporan pengembalian', '2026-02-26 13:40:35', '2026-02-26 13:40:35', '2026-02-26 13:40:35'),
(190, 1, 'Melihat daftar user', '2026-02-26 13:41:12', '2026-02-26 13:41:12', '2026-02-26 13:41:12'),
(191, 1, 'Melihat daftar alat', '2026-02-26 13:41:22', '2026-02-26 13:41:22', '2026-02-26 13:41:22'),
(192, 1, 'Melihat daftar peminjaman', '2026-02-26 13:41:27', '2026-02-26 13:41:27', '2026-02-26 13:41:27'),
(193, 1, 'Melihat daftar pengembalian', '2026-02-26 13:51:39', '2026-02-26 13:51:39', '2026-02-26 13:51:39'),
(194, 1, 'Melihat daftar pengembalian', '2026-02-26 13:51:46', '2026-02-26 13:51:46', '2026-02-26 13:51:46'),
(195, 1, 'Melihat daftar peminjaman', '2026-02-26 13:51:48', '2026-02-26 13:51:48', '2026-02-26 13:51:48'),
(196, 1, 'Mencetak laporan peminjaman', '2026-02-26 13:52:04', '2026-02-26 13:52:04', '2026-02-26 13:52:04'),
(197, 1, 'Mencetak laporan peminjaman', '2026-02-26 13:52:29', '2026-02-26 13:52:29', '2026-02-26 13:52:29'),
(198, 1, 'Mencetak laporan peminjaman', '2026-02-26 13:52:35', '2026-02-26 13:52:35', '2026-02-26 13:52:35'),
(199, 4, 'Melihat daftar peminjaman saya', '2026-02-26 13:53:58', '2026-02-26 13:53:58', '2026-02-26 13:53:58'),
(200, 4, 'Melihat daftar alat tersedia', '2026-02-26 13:54:01', '2026-02-26 13:54:01', '2026-02-26 13:54:01'),
(201, 4, 'Mengajukan peminjaman: Kursi Kantor', '2026-02-26 13:54:12', '2026-02-26 13:54:12', '2026-02-26 13:54:12'),
(202, 4, 'Melihat daftar peminjaman saya', '2026-02-26 13:54:12', '2026-02-26 13:54:12', '2026-02-26 13:54:12'),
(203, 4, 'Mengajukan pengembalian: Printer Epson L3210', '2026-02-26 13:54:22', '2026-02-26 13:54:22', '2026-02-26 13:54:22'),
(204, 4, 'Melihat daftar peminjaman saya', '2026-02-26 13:54:22', '2026-02-26 13:54:22', '2026-02-26 13:54:22'),
(205, 1, 'Melihat daftar peminjaman', '2026-02-26 13:54:36', '2026-02-26 13:54:36', '2026-02-26 13:54:36'),
(206, 1, 'Melihat daftar pengembalian', '2026-02-26 13:54:44', '2026-02-26 13:54:44', '2026-02-26 13:54:44'),
(207, 1, 'Melihat daftar pengembalian', '2026-02-26 13:55:44', '2026-02-26 13:55:44', '2026-02-26 13:55:44'),
(208, 1, 'Melihat daftar pengembalian', '2026-02-26 13:55:58', '2026-02-26 13:55:58', '2026-02-26 13:55:58'),
(209, 1, 'Melihat daftar peminjaman', '2026-02-26 13:56:31', '2026-02-26 13:56:31', '2026-02-26 13:56:31'),
(210, 1, 'Melihat daftar pengembalian', '2026-02-26 13:56:44', '2026-02-26 13:56:44', '2026-02-26 13:56:44'),
(211, 1, 'Melihat daftar peminjaman', '2026-02-26 13:56:50', '2026-02-26 13:56:50', '2026-02-26 13:56:50'),
(212, 1, 'Melihat daftar pengembalian', '2026-02-26 13:57:13', '2026-02-26 13:57:13', '2026-02-26 13:57:13'),
(213, 1, 'Melihat daftar peminjaman', '2026-02-26 13:57:14', '2026-02-26 13:57:14', '2026-02-26 13:57:14'),
(214, 1, 'Melihat daftar pengembalian', '2026-02-26 13:57:24', '2026-02-26 13:57:24', '2026-02-26 13:57:24'),
(215, 1, 'Melihat daftar peminjaman', '2026-02-26 13:57:25', '2026-02-26 13:57:25', '2026-02-26 13:57:25'),
(216, 1, 'Melihat daftar kategori', '2026-02-26 14:09:20', '2026-02-26 14:09:20', '2026-02-26 14:09:20'),
(217, 1, 'Melihat daftar peminjaman', '2026-02-26 14:13:00', '2026-02-26 14:13:00', '2026-02-26 14:13:00'),
(218, 1, 'Menyetujui peminjaman: Kursi Kantor oleh John Doe', '2026-02-26 14:13:05', '2026-02-26 14:13:05', '2026-02-26 14:13:05'),
(219, 1, 'Melihat daftar peminjaman', '2026-02-26 14:13:05', '2026-02-26 14:13:05', '2026-02-26 14:13:05'),
(220, 1, 'Melihat daftar pengembalian', '2026-02-26 14:13:10', '2026-02-26 14:13:10', '2026-02-26 14:13:10'),
(221, 1, 'Melihat daftar pengembalian', '2026-02-26 14:13:13', '2026-02-26 14:13:13', '2026-02-26 14:13:13'),
(222, 1, 'Melihat daftar pengembalian', '2026-02-26 14:13:16', '2026-02-26 14:13:16', '2026-02-26 14:13:16'),
(223, 1, 'Melihat daftar pengembalian', '2026-02-26 14:13:18', '2026-02-26 14:13:18', '2026-02-26 14:13:18'),
(224, 1, 'Melihat daftar pengembalian', '2026-02-26 14:13:36', '2026-02-26 14:13:36', '2026-02-26 14:13:36'),
(225, 1, 'Melihat daftar pengembalian', '2026-02-26 14:13:48', '2026-02-26 14:13:48', '2026-02-26 14:13:48'),
(226, 1, 'Melihat daftar pengembalian', '2026-02-26 14:14:26', '2026-02-26 14:14:26', '2026-02-26 14:14:26'),
(227, 1, 'Melihat daftar pengembalian', '2026-02-26 14:14:28', '2026-02-26 14:14:28', '2026-02-26 14:14:28'),
(228, 1, 'Melihat daftar pengembalian', '2026-02-26 14:15:27', '2026-02-26 14:15:27', '2026-02-26 14:15:27'),
(229, 1, 'Melihat daftar peminjaman', '2026-02-26 14:16:04', '2026-02-26 14:16:04', '2026-02-26 14:16:04'),
(230, 1, 'Menyetujui peminjaman: Laptop ASUS ROG oleh John Doe', '2026-02-26 14:16:08', '2026-02-26 14:16:08', '2026-02-26 14:16:08'),
(231, 1, 'Melihat daftar peminjaman', '2026-02-26 14:16:08', '2026-02-26 14:16:08', '2026-02-26 14:16:08'),
(232, 1, 'Menyetujui peminjaman: Printer Epson L3210 oleh User Test', '2026-02-26 14:16:11', '2026-02-26 14:16:11', '2026-02-26 14:16:11'),
(233, 1, 'Melihat daftar peminjaman', '2026-02-26 14:16:12', '2026-02-26 14:16:12', '2026-02-26 14:16:12'),
(234, 1, 'Menyetujui peminjaman: Laptop ASUS ROG oleh User Test', '2026-02-26 14:16:14', '2026-02-26 14:16:14', '2026-02-26 14:16:14'),
(235, 1, 'Melihat daftar peminjaman', '2026-02-26 14:16:14', '2026-02-26 14:16:14', '2026-02-26 14:16:14'),
(236, 4, 'Melihat daftar peminjaman saya', '2026-02-26 14:16:40', '2026-02-26 14:16:40', '2026-02-26 14:16:40'),
(237, 4, 'Mengajukan pengembalian: Laptop ASUS ROG', '2026-02-26 14:16:50', '2026-02-26 14:16:50', '2026-02-26 14:16:50'),
(238, 4, 'Melihat daftar peminjaman saya', '2026-02-26 14:16:50', '2026-02-26 14:16:50', '2026-02-26 14:16:50'),
(239, 1, 'Melihat daftar pengembalian', '2026-02-26 14:17:10', '2026-02-26 14:17:10', '2026-02-26 14:17:10'),
(240, 1, 'Memverifikasi pengembalian: Printer Epson L3210 oleh John Doe', '2026-02-26 14:17:20', '2026-02-26 14:17:20', '2026-02-26 14:17:20'),
(241, 1, 'Melihat daftar pengembalian', '2026-02-26 14:17:20', '2026-02-26 14:17:20', '2026-02-26 14:17:20'),
(242, 1, 'Memverifikasi pengembalian: Laptop ASUS ROG oleh John Doe', '2026-02-26 14:17:34', '2026-02-26 14:17:34', '2026-02-26 14:17:34'),
(243, 1, 'Melihat daftar pengembalian', '2026-02-26 14:17:34', '2026-02-26 14:17:34', '2026-02-26 14:17:34'),
(244, 4, 'Melihat daftar peminjaman saya', '2026-02-26 14:17:58', '2026-02-26 14:17:58', '2026-02-26 14:17:58'),
(245, 1, 'Melihat daftar pengembalian', '2026-02-26 14:18:16', '2026-02-26 14:18:16', '2026-02-26 14:18:16'),
(246, 4, 'Melihat daftar peminjaman saya', '2026-02-26 14:18:40', '2026-02-26 14:18:40', '2026-02-26 14:18:40'),
(247, 4, 'Melihat daftar peminjaman saya', '2026-02-26 14:18:46', '2026-02-26 14:18:46', '2026-02-26 14:18:46'),
(248, 4, 'Melihat daftar peminjaman saya', '2026-02-26 14:21:40', '2026-02-26 14:21:40', '2026-02-26 14:21:40'),
(249, 4, 'Melihat daftar peminjaman saya', '2026-02-26 14:34:32', '2026-02-26 14:34:32', '2026-02-26 14:34:32'),
(250, 4, 'Melihat daftar peminjaman saya', '2026-02-26 14:34:50', '2026-02-26 14:34:50', '2026-02-26 14:34:50'),
(251, 4, 'Mengklaim telah membayar denda - menunggu konfirmasi admin', '2026-02-26 14:35:05', '2026-02-26 14:35:05', '2026-02-26 14:35:05'),
(252, 1, 'Melihat daftar pengembalian', '2026-02-26 14:35:18', '2026-02-26 14:35:18', '2026-02-26 14:35:18'),
(253, 1, 'Mengonfirmasi pembayaran denda untuk pengembalian #6', '2026-02-26 14:35:21', '2026-02-26 14:35:21', '2026-02-26 14:35:21'),
(254, 1, 'Melihat daftar pengembalian', '2026-02-26 14:35:21', '2026-02-26 14:35:21', '2026-02-26 14:35:21'),
(255, 1, 'Melihat data terhapus (soft delete)', '2026-02-26 14:35:30', '2026-02-26 14:35:30', '2026-02-26 14:35:30'),
(256, 1, 'Melihat daftar alat', '2026-02-26 14:35:35', '2026-02-26 14:35:35', '2026-02-26 14:35:35'),
(257, 1, 'Melihat daftar kategori', '2026-02-26 14:36:34', '2026-02-26 14:36:34', '2026-02-26 14:36:34'),
(258, 1, 'Melihat daftar alat', '2026-02-26 14:36:39', '2026-02-26 14:36:39', '2026-02-26 14:36:39'),
(259, 1, 'Melihat daftar user', '2026-02-26 14:36:42', '2026-02-26 14:36:42', '2026-02-26 14:36:42'),
(260, 1, 'Melihat daftar pengembalian', '2026-02-26 14:36:46', '2026-02-26 14:36:46', '2026-02-26 14:36:46'),
(261, 1, 'Mencetak laporan peminjaman', '2026-02-26 14:36:52', '2026-02-26 14:36:52', '2026-02-26 14:36:52'),
(262, 1, 'Melihat data terhapus (soft delete)', '2026-02-26 14:46:53', '2026-02-26 14:46:53', '2026-02-26 14:46:53'),
(263, 1, 'Melihat daftar alat', '2026-02-26 14:46:56', '2026-02-26 14:46:56', '2026-02-26 14:46:56'),
(264, 1, 'Melihat daftar alat', '2026-02-26 14:47:01', '2026-02-26 14:47:01', '2026-02-26 14:47:01'),
(265, 1, 'Melihat laporan log activity', '2026-02-26 14:49:16', '2026-02-26 14:49:16', '2026-02-26 14:49:16'),
(266, 1, 'Mencetak laporan peminjaman', '2026-02-26 14:49:23', '2026-02-26 14:49:23', '2026-02-26 14:49:23'),
(267, 1, 'Mencetak laporan peminjaman', '2026-02-26 14:51:50', '2026-02-26 14:51:50', '2026-02-26 14:51:50'),
(268, 1, 'Mencetak laporan peminjaman', '2026-02-26 14:52:58', '2026-02-26 14:52:58', '2026-02-26 14:52:58'),
(269, 1, 'Mencetak laporan peminjaman', '2026-02-26 14:53:31', '2026-02-26 14:53:31', '2026-02-26 14:53:31'),
(270, 1, 'Mencetak laporan peminjaman', '2026-02-26 14:53:52', '2026-02-26 14:53:52', '2026-02-26 14:53:52'),
(271, 1, 'Mencetak laporan peminjaman', '2026-02-26 14:56:20', '2026-02-26 14:56:20', '2026-02-26 14:56:20'),
(272, 1, 'Mencetak laporan peminjaman', '2026-02-26 14:56:37', '2026-02-26 14:56:37', '2026-02-26 14:56:37'),
(273, 1, 'Mencetak laporan peminjaman', '2026-02-26 14:56:49', '2026-02-26 14:56:49', '2026-02-26 14:56:49'),
(274, 1, 'Mencetak laporan peminjaman', '2026-02-26 14:57:00', '2026-02-26 14:57:00', '2026-02-26 14:57:00'),
(275, 1, 'Mencetak laporan peminjaman', '2026-02-26 14:57:15', '2026-02-26 14:57:15', '2026-02-26 14:57:15'),
(276, 1, 'Mencetak laporan peminjaman', '2026-02-26 14:57:26', '2026-02-26 14:57:26', '2026-02-26 14:57:26'),
(277, 1, 'Melihat daftar peminjaman', '2026-02-26 14:57:34', '2026-02-26 14:57:34', '2026-02-26 14:57:34'),
(278, 1, 'Melihat data terhapus (soft delete)', '2026-02-26 14:57:37', '2026-02-26 14:57:37', '2026-02-26 14:57:37'),
(279, 1, 'Melihat daftar alat', '2026-02-26 14:57:40', '2026-02-26 14:57:40', '2026-02-26 14:57:40'),
(280, 1, 'Melihat daftar alat', '2026-02-26 15:02:34', '2026-02-26 15:02:34', '2026-02-26 15:02:34'),
(281, 1, 'Melihat daftar alat', '2026-02-26 15:02:45', '2026-02-26 15:02:45', '2026-02-26 15:02:45'),
(282, 1, 'Menghapus alat: PC Desktop Core i7', '2026-02-26 15:02:50', '2026-02-26 15:02:50', '2026-02-26 15:02:50'),
(283, 1, 'Melihat daftar alat', '2026-02-26 15:02:50', '2026-02-26 15:02:50', '2026-02-26 15:02:50'),
(284, 1, 'Menghapus alat: Monitor LG 24\"', '2026-02-26 15:02:57', '2026-02-26 15:02:57', '2026-02-26 15:02:57'),
(285, 1, 'Melihat daftar alat', '2026-02-26 15:02:58', '2026-02-26 15:02:58', '2026-02-26 15:02:58'),
(286, 1, 'Melihat daftar kategori', '2026-02-26 15:03:01', '2026-02-26 15:03:01', '2026-02-26 15:03:01'),
(287, 1, 'Menghapus kategori: Alat kontruksi', '2026-02-26 15:03:06', '2026-02-26 15:03:06', '2026-02-26 15:03:06'),
(288, 1, 'Melihat daftar kategori', '2026-02-26 15:03:06', '2026-02-26 15:03:06', '2026-02-26 15:03:06'),
(289, 1, 'Melihat daftar kategori', '2026-02-26 15:03:50', '2026-02-26 15:03:50', '2026-02-26 15:03:50'),
(290, 10, 'Melihat daftar peminjaman saya', '2026-02-26 15:06:53', '2026-02-26 15:06:53', '2026-02-26 15:06:53'),
(291, 10, 'Melihat daftar alat tersedia', '2026-02-26 15:06:55', '2026-02-26 15:06:55', '2026-02-26 15:06:55'),
(292, 10, 'Mengajukan peminjaman: Speaker Bluetooth', '2026-02-26 15:07:39', '2026-02-26 15:07:39', '2026-02-26 15:07:39'),
(293, 10, 'Melihat daftar peminjaman saya', '2026-02-26 15:07:40', '2026-02-26 15:07:40', '2026-02-26 15:07:40'),
(294, 1, 'Melihat daftar peminjaman', '2026-02-26 15:08:51', '2026-02-26 15:08:51', '2026-02-26 15:08:51'),
(295, 1, 'Melihat daftar peminjaman', '2026-02-26 15:09:05', '2026-02-26 15:09:05', '2026-02-26 15:09:05'),
(296, 1, 'Melihat daftar peminjaman', '2026-02-26 15:09:31', '2026-02-26 15:09:31', '2026-02-26 15:09:31'),
(297, 1, 'Melihat daftar alat', '2026-02-26 15:10:25', '2026-02-26 15:10:25', '2026-02-26 15:10:25'),
(298, 1, 'Melihat daftar alat', '2026-02-26 15:10:25', '2026-02-26 15:10:25', '2026-02-26 15:10:25'),
(299, 1, 'Melihat daftar peminjaman', '2026-02-26 15:11:23', '2026-02-26 15:11:23', '2026-02-26 15:11:23'),
(300, 1, 'Melihat daftar pengembalian', '2026-02-26 15:11:28', '2026-02-26 15:11:28', '2026-02-26 15:11:28'),
(301, 1, 'Melihat daftar peminjaman', '2026-02-26 15:11:31', '2026-02-26 15:11:31', '2026-02-26 15:11:31'),
(302, 1, 'Mencetak laporan peminjaman', '2026-02-26 15:11:46', '2026-02-26 15:11:46', '2026-02-26 15:11:46'),
(303, 1, 'Melihat daftar pengembalian', '2026-02-26 15:11:50', '2026-02-26 15:11:50', '2026-02-26 15:11:50'),
(304, 1, 'Melihat daftar user', '2026-02-26 15:11:53', '2026-02-26 15:11:53', '2026-02-26 15:11:53'),
(305, 1, 'Melihat daftar peminjaman', '2026-02-26 15:13:49', '2026-02-26 15:13:49', '2026-02-26 15:13:49'),
(306, 1, 'Melihat daftar kategori', '2026-02-26 15:25:06', '2026-02-26 15:25:06', '2026-02-26 15:25:06'),
(307, 1, 'Melihat daftar alat', '2026-02-26 15:25:10', '2026-02-26 15:25:10', '2026-02-26 15:25:10'),
(308, 1, 'Melihat daftar peminjaman', '2026-02-26 15:25:14', '2026-02-26 15:25:14', '2026-02-26 15:25:14'),
(309, 1, 'Melihat daftar peminjaman', '2026-02-26 15:25:25', '2026-02-26 15:25:25', '2026-02-26 15:25:25'),
(310, 1, 'Melihat daftar pengembalian', '2026-02-26 15:25:29', '2026-02-26 15:25:29', '2026-02-26 15:25:29'),
(311, 1, 'Melihat laporan log activity', '2026-02-26 15:25:35', '2026-02-26 15:25:35', '2026-02-26 15:25:35'),
(312, 11, 'Melihat daftar alat tersedia', '2026-02-26 15:28:37', '2026-02-26 15:28:37', '2026-02-26 15:28:37'),
(313, 11, 'Melihat daftar peminjaman saya', '2026-02-26 15:28:43', '2026-02-26 15:28:43', '2026-02-26 15:28:43'),
(314, 1, 'Melihat daftar peminjaman', '2026-02-26 15:33:23', '2026-02-26 15:33:23', '2026-02-26 15:33:23'),
(315, 11, 'Melihat daftar peminjaman', '2026-02-26 15:34:45', '2026-02-26 15:34:45', '2026-02-26 15:34:45'),
(316, 11, 'Melihat daftar pengembalian', '2026-02-26 15:34:51', '2026-02-26 15:34:51', '2026-02-26 15:34:51'),
(317, 11, 'Melihat daftar peminjaman', '2026-02-26 15:34:57', '2026-02-26 15:34:57', '2026-02-26 15:34:57'),
(318, 11, 'Mencetak laporan peminjaman', '2026-02-26 15:35:02', '2026-02-26 15:35:02', '2026-02-26 15:35:02'),
(319, 11, 'Melihat laporan log activity', '2026-02-26 15:35:14', '2026-02-26 15:35:14', '2026-02-26 15:35:14'),
(320, 11, 'Melihat daftar peminjaman', '2026-02-26 15:35:19', '2026-02-26 15:35:19', '2026-02-26 15:35:19'),
(321, 11, 'Melihat daftar peminjaman', '2026-02-26 15:36:23', '2026-02-26 15:36:23', '2026-02-26 15:36:23'),
(322, 11, 'Melihat laporan log activity', '2026-02-26 15:36:30', '2026-02-26 15:36:30', '2026-02-26 15:36:30'),
(323, 11, 'Mencetak laporan peminjaman', '2026-02-26 15:38:36', '2026-02-26 15:38:36', '2026-02-26 15:38:36'),
(324, 11, 'Mencetak laporan peminjaman', '2026-02-26 15:39:21', '2026-02-26 15:39:21', '2026-02-26 15:39:21'),
(325, 1, 'Melihat daftar peminjaman', '2026-02-26 15:39:36', '2026-02-26 15:39:36', '2026-02-26 15:39:36'),
(326, 1, 'Melihat daftar pengembalian', '2026-02-26 15:39:53', '2026-02-26 15:39:53', '2026-02-26 15:39:53'),
(327, 11, 'Melihat daftar pengembalian', '2026-02-26 15:40:09', '2026-02-26 15:40:09', '2026-02-26 15:40:09'),
(328, 11, 'Mencetak laporan peminjaman', '2026-02-26 15:41:14', '2026-02-26 15:41:14', '2026-02-26 15:41:14'),
(329, 11, 'Mencetak laporan peminjaman', '2026-02-26 15:41:27', '2026-02-26 15:41:27', '2026-02-26 15:41:27'),
(330, 11, 'Mencetak laporan peminjaman', '2026-02-26 15:42:08', '2026-02-26 15:42:08', '2026-02-26 15:42:08'),
(331, 11, 'Mencetak laporan peminjaman', '2026-02-26 15:42:18', '2026-02-26 15:42:18', '2026-02-26 15:42:18'),
(332, 11, 'Mencetak laporan peminjaman', '2026-02-26 15:42:25', '2026-02-26 15:42:25', '2026-02-26 15:42:25'),
(333, 11, 'Mencetak laporan pengembalian', '2026-02-26 15:42:34', '2026-02-26 15:42:34', '2026-02-26 15:42:34'),
(334, 1, 'Melihat daftar peminjaman', '2026-02-26 15:43:14', '2026-02-26 15:43:14', '2026-02-26 15:43:14'),
(335, 1, 'Melihat daftar pengembalian', '2026-02-26 15:43:18', '2026-02-26 15:43:18', '2026-02-26 15:43:18'),
(336, 1, 'Melihat daftar peminjaman', '2026-02-26 15:43:21', '2026-02-26 15:43:21', '2026-02-26 15:43:21'),
(337, 1, 'Melihat daftar pengembalian', '2026-02-26 15:43:28', '2026-02-26 15:43:28', '2026-02-26 15:43:28'),
(338, 11, 'Melihat daftar pengembalian', '2026-02-26 15:43:39', '2026-02-26 15:43:39', '2026-02-26 15:43:39'),
(339, 11, 'Melihat daftar peminjaman', '2026-02-26 15:43:41', '2026-02-26 15:43:41', '2026-02-26 15:43:41'),
(340, 11, 'Melihat daftar peminjaman', '2026-02-26 15:47:05', '2026-02-26 15:47:05', '2026-02-26 15:47:05'),
(341, 11, 'Melihat daftar pengembalian', '2026-02-26 15:47:09', '2026-02-26 15:47:09', '2026-02-26 15:47:09'),
(342, 1, 'Melihat daftar peminjaman', '2026-02-26 15:47:21', '2026-02-26 15:47:21', '2026-02-26 15:47:21'),
(343, 1, 'Melihat daftar pengembalian', '2026-02-26 15:47:24', '2026-02-26 15:47:24', '2026-02-26 15:47:24'),
(344, 1, 'Melihat daftar kategori', '2026-02-26 15:47:42', '2026-02-26 15:47:42', '2026-02-26 15:47:42'),
(345, 1, 'Melihat laporan log activity', '2026-02-26 15:47:56', '2026-02-26 15:47:56', '2026-02-26 15:47:56'),
(346, 4, 'Melihat daftar peminjaman saya', '2026-02-26 15:48:43', '2026-02-26 15:48:43', '2026-02-26 15:48:43'),
(347, 4, 'Melihat daftar alat tersedia', '2026-02-26 15:48:44', '2026-02-26 15:48:44', '2026-02-26 15:48:44'),
(348, 4, 'Mengajukan peminjaman: Laptop ASUS ROG (2 unit)', '2026-02-26 15:50:37', '2026-02-26 15:50:37', '2026-02-26 15:50:37'),
(349, 4, 'Melihat daftar peminjaman saya', '2026-02-26 15:50:38', '2026-02-26 15:50:38', '2026-02-26 15:50:38'),
(350, 1, 'Melihat daftar peminjaman', '2026-02-26 15:50:53', '2026-02-26 15:50:53', '2026-02-26 15:50:53'),
(351, 11, 'Melihat daftar peminjaman', '2026-02-26 15:51:05', '2026-02-26 15:51:05', '2026-02-26 15:51:05'),
(352, 11, 'Menyetujui peminjaman: Laptop ASUS ROG (2 unit) oleh John Doe', '2026-02-26 15:51:08', '2026-02-26 15:51:08', '2026-02-26 15:51:08'),
(353, 11, 'Melihat daftar peminjaman', '2026-02-26 15:51:08', '2026-02-26 15:51:08', '2026-02-26 15:51:08'),
(354, 11, 'Melihat daftar pengembalian', '2026-02-26 15:51:17', '2026-02-26 15:51:17', '2026-02-26 15:51:17'),
(355, 11, 'Melihat daftar peminjaman', '2026-02-26 15:51:20', '2026-02-26 15:51:20', '2026-02-26 15:51:20'),
(356, 10, 'Melihat daftar peminjaman saya', '2026-02-26 15:51:35', '2026-02-26 15:51:35', '2026-02-26 15:51:35'),
(357, 4, 'Melihat daftar peminjaman saya', '2026-02-26 15:51:54', '2026-02-26 15:51:54', '2026-02-26 15:51:54'),
(358, 4, 'Mengajukan pengembalian: Laptop ASUS ROG', '2026-02-26 15:51:57', '2026-02-26 15:51:57', '2026-02-26 15:51:57'),
(359, 4, 'Melihat daftar peminjaman saya', '2026-02-26 15:51:57', '2026-02-26 15:51:57', '2026-02-26 15:51:57'),
(360, 11, 'Melihat daftar pengembalian', '2026-02-26 15:52:11', '2026-02-26 15:52:11', '2026-02-26 15:52:11'),
(361, 11, 'Memverifikasi pengembalian: Laptop ASUS ROG oleh John Doe', '2026-02-26 15:52:19', '2026-02-26 15:52:19', '2026-02-26 15:52:19'),
(362, 11, 'Melihat daftar pengembalian', '2026-02-26 15:52:19', '2026-02-26 15:52:19', '2026-02-26 15:52:19'),
(363, 11, 'Melihat daftar peminjaman', '2026-02-26 17:00:56', '2026-02-26 17:00:56', '2026-02-26 17:00:56'),
(364, 11, 'Melihat daftar pengembalian', '2026-02-26 17:01:08', '2026-02-26 17:01:08', '2026-02-26 17:01:08'),
(365, 11, 'Melihat daftar peminjaman', '2026-02-26 17:01:19', '2026-02-26 17:01:19', '2026-02-26 17:01:19'),
(366, 11, 'Melihat daftar pengembalian', '2026-02-26 17:01:22', '2026-02-26 17:01:22', '2026-02-26 17:01:22'),
(367, 11, 'Melihat daftar peminjaman', '2026-02-26 17:01:36', '2026-02-26 17:01:36', '2026-02-26 17:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_25_101432_create_kategoris_table', 1),
(5, '2026_02_25_101434_create_alats_table', 1),
(6, '2026_02_25_101437_create_peminjamen_table', 1),
(7, '2026_02_25_101439_create_pengembalian_table', 1),
(8, '2026_02_25_101441_create_log_activities_table', 1),
(9, '2026_02_26_000000_add_denda_fields_to_pengembalian_table', 2),
(10, '2026_02_26_020000_add_soft_deletes_to_core_tables', 3),
(11, '2026_02_26_000001_add_menunggu_konfirmasi_status_to_peminjamen', 4),
(12, '2026_02_26_000002_add_catatan_to_pengembalian_table', 5),
(13, '2026_02_26_000003_add_menunggu_konfirmasi_to_status_denda', 6),
(14, '2026_02_26_000001_add_soft_deletes_to_alats_and_kategoris', 7),
(15, '2026_02_26_120000_add_soft_delete_column_to_alats_and_kategoris', 8),
(16, '2026_02_26_130000_update_roles_and_add_stok_to_peminjaman', 9),
(17, '2026_02_26_140000_update_users_role_column', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamen`
--

CREATE TABLE `peminjamen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `alat_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0 COMMENT 'Jumlah stok yang dipinjam pada saat peminjaman',
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('pending','disetujui','ditolak','dikembalikan','menunggu_konfirmasi_pengembalian') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamen`
--

INSERT INTO `peminjamen` (`id`, `user_id`, `alat_id`, `stok`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, 3, '2026-02-20', '2026-02-27', 'dikembalikan', '2026-02-25 12:36:51', '2026-02-25 13:59:24', NULL),
(2, 4, 2, 2, '2026-02-22', '2026-03-01', 'ditolak', '2026-02-25 12:36:51', '2026-02-25 13:56:28', NULL),
(3, 5, 3, 1, '2026-02-18', '2026-02-24', 'dikembalikan', '2026-02-25 12:36:51', '2026-02-25 12:36:51', NULL),
(4, 6, 10, 1, '2026-02-23', '2026-03-02', 'disetujui', '2026-02-25 12:36:51', '2026-02-25 12:36:51', NULL),
(5, 7, 13, 1, '2026-02-24', '2026-02-28', 'ditolak', '2026-02-25 12:36:51', '2026-02-25 12:36:51', NULL),
(6, 3, 1, 1, '2026-02-20', '2026-02-27', 'disetujui', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL),
(7, 4, 2, 1, '2026-02-22', '2026-03-01', 'dikembalikan', '2026-02-25 12:37:53', '2026-02-26 14:17:20', NULL),
(8, 5, 3, 1, '2026-02-18', '2026-02-24', 'dikembalikan', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL),
(9, 6, 10, 1, '2026-02-23', '2026-03-02', 'dikembalikan', '2026-02-25 12:37:53', '2026-02-25 14:02:35', NULL),
(10, 7, 13, 1, '2026-02-24', '2026-02-28', 'ditolak', '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL),
(11, 3, 1, 1, '2026-02-26', '2026-02-28', 'disetujui', '2026-02-25 12:53:34', '2026-02-26 14:16:14', NULL),
(12, 3, 2, 1, '2026-02-26', '2026-03-05', 'disetujui', '2026-02-25 13:54:33', '2026-02-26 14:16:11', NULL),
(13, 4, 1, 1, '2026-02-26', '2026-02-28', 'dikembalikan', '2026-02-26 13:05:02', '2026-02-26 14:17:34', NULL),
(14, 4, 5, 1, '2026-02-26', '2026-03-10', 'disetujui', '2026-02-26 13:54:12', '2026-02-26 14:13:05', NULL),
(15, 10, 13, 1, '2026-02-28', '2026-03-08', 'pending', '2026-02-26 15:07:39', '2026-02-26 15:07:39', NULL),
(16, 4, 1, 2, '2026-02-26', '2026-03-07', 'dikembalikan', '2026-02-26 15:50:37', '2026-02-26 15:52:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjaman_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_dikembalikan` date NOT NULL,
  `kondisi_setelah` enum('baik','rusak_ringan','rusak_berat') NOT NULL,
  `denda` decimal(10,2) DEFAULT NULL,
  `denda_keterlambatan` decimal(10,2) DEFAULT NULL,
  `denda_kerusakan` decimal(10,2) DEFAULT NULL,
  `total_denda` decimal(10,2) DEFAULT NULL,
  `status_denda` enum('belum_bayar','menunggu_konfirmasi','sudah_bayar') DEFAULT 'sudah_bayar',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `peminjaman_id`, `tanggal_dikembalikan`, `kondisi_setelah`, `denda`, `denda_keterlambatan`, `denda_kerusakan`, `total_denda`, `status_denda`, `catatan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, '2026-02-24', 'baik', 0.00, NULL, NULL, NULL, 'sudah_bayar', NULL, '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL),
(2, 8, '2026-02-24', 'baik', 0.00, NULL, NULL, NULL, 'sudah_bayar', NULL, '2026-02-25 12:37:53', '2026-02-25 12:37:53', NULL),
(5, 7, '2026-02-26', 'baik', 0.00, 0.00, 0.00, 0.00, 'sudah_bayar', NULL, '2026-02-26 14:17:20', '2026-02-26 14:17:20', NULL),
(6, 13, '2026-02-26', 'rusak_ringan', 20000.00, 0.00, 20000.00, 20000.00, 'sudah_bayar', NULL, '2026-02-26 14:17:34', '2026-02-26 14:35:21', NULL),
(7, 16, '2026-02-26', 'baik', 0.00, 0.00, 0.00, 0.00, 'sudah_bayar', NULL, '2026-02-26 15:52:19', '2026-02-26 15:52:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pI5QgXTuKn5f3Dt2K8iq1cAeykbjjgvEwpPYtoTB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSENZcXZKMzdsRlBLYWswYjlYTHc4VnNQdzBpQXdsZGdTWmxxajVFVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1772096643);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$12$tx4Sd0o5Jqm70pxQxGLTO.FWrB/95o5FT8t56qkvgVjbVfN8JEFRu', 'admin', 'EDN75WJyTZ31WMKl8AtH3nZQ9YR03CYR9QYtK8j1ibRx3b719aLSWvlntHeD', '2026-02-25 12:34:23', '2026-02-25 12:34:23', NULL),
(2, 'Super Admin', 'super@admin.com', NULL, '$2y$12$a28U/836lNKyXQnd5sJLhuThW3adZhPP33ufQTHwYv3cd4QoyhbJu', 'super_admin', 'ojjQCcvzAD2mUNw6zCBWB2kiK8hJIby4da32Ly57TOmUZ3rQnqNd5QWkCVlP', '2026-02-25 12:34:23', '2026-02-25 12:34:23', NULL),
(3, 'User Test', 'user@user.com', NULL, '$2y$12$uz0dEkEsQ4TaGkaBqLK2A.y5Cu2CXLaNVRFvgnMBFBvyd1uWnhti.', 'user', 'WGOCoscGqZW2ZgDju8xGuA636GadS9207Yg8XO4qKVYaRwaN8uSnczp80pQU', '2026-02-25 12:34:24', '2026-02-25 12:34:24', NULL),
(4, 'John Doe', 'john@user.com', NULL, '$2y$12$2f5sLfPZ03eYXeuwFxB77u4bwa.BgV6on9U3sHGN4mqYy301/ireC', 'user', 'kPsyJA09LndawgWQoxrsmYua5E57x9EgdMu83eU4UKBr8WPShLUUuM7yD9W4', '2026-02-25 12:34:25', '2026-02-25 12:34:25', NULL),
(5, 'Jane Smith', 'jane@user.com', NULL, '$2y$12$m5YOtU7qkkP.eRGbRIxyau0iuEVhbRH8aMmwChVJdIi.B3Iva0L3e', 'user', NULL, '2026-02-25 12:34:25', '2026-02-25 12:34:25', NULL),
(6, 'Budi Santoso', 'budi@user.com', NULL, '$2y$12$A1M3xJ.Q4pYODXDaba.nvuYWA3/bRY66KGePHuEtmwh0jDeuhNmSm', 'user', NULL, '2026-02-25 12:34:26', '2026-02-25 12:34:26', NULL),
(7, 'Siti Nurhaliza', 'siti@user.com', NULL, '$2y$12$GzJhNs7tSb4kjeFyYxVJLu5jI9qMijJA76fhgr5lijrudbsAU0LUq', 'user', NULL, '2026-02-25 12:34:26', '2026-02-25 12:34:26', NULL),
(9, 'yuki', 'yumi@gmail.com', NULL, '$2y$12$Zo8UC89jk9UKmx95EKadWOkrzI0pAs5jjK3mTcHFiAiZp9H7CapIO', 'user', NULL, '2026-02-26 14:43:34', '2026-02-26 14:43:34', NULL),
(10, 'NOmu', 'monu@gmail.com', NULL, '$2y$12$p26b2BPOvcLJ96sOMDQCO.tHl7zoD2DRdWdIcy0UJ./Zzv7uL0ciK', 'user', 'XAMMWIHuPohFnPzaWkNXEcZ9RNwURllDWhl3YXnc8dNxInpbu4w7hIOi50D9', '2026-02-26 15:06:46', '2026-02-26 15:06:46', NULL),
(11, 'Petugas', 'petugas@example.com', '2026-02-26 15:27:34', '$2y$12$tBU0KmmiXTIONp1xGr7Uf.lZRq.zeoa.Ln7LvUd/XD7nT8f58AFfa', 'petugas', 'KEuqrkt41xirxvAIMggOBPn0njZkFf0hNFuX3gZFWLPiRjj6vOuOOZgwTWOW', '2026-02-26 15:27:34', '2026-02-26 15:27:34', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alats`
--
ALTER TABLE `alats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alats_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_activities_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjamen`
--
ALTER TABLE `peminjamen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjamen_user_id_foreign` (`user_id`),
  ADD KEY `peminjamen_alat_id_foreign` (`alat_id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alats`
--
ALTER TABLE `alats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `peminjamen`
--
ALTER TABLE `peminjamen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alats`
--
ALTER TABLE `alats`
  ADD CONSTRAINT `alats_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD CONSTRAINT `log_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjamen`
--
ALTER TABLE `peminjamen`
  ADD CONSTRAINT `peminjamen_alat_id_foreign` FOREIGN KEY (`alat_id`) REFERENCES `alats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjamen` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
