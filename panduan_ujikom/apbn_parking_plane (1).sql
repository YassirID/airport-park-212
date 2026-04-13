-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2026 at 10:42 PM
-- Server version: 8.0.43
-- PHP Version: 8.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apbn_parking_plane`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_sessions_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_01_01_000001_create_tb_user_table', 1),
(5, '2024_01_01_000002_create_tb_area_parkir_table', 1),
(6, '2024_01_01_000003_create_tb_kendaraan_table', 1),
(7, '2024_01_01_000004_create_tb_tarif_table', 1),
(8, '2024_01_01_000005_create_tb_transaksi_table', 1),
(9, '2024_01_01_000006_create_tb_log_aktivitas_table', 1),
(10, '2024_01_01_000007_add_tarif_inap_to_tb_tarif', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8Ht6jl1afrQMZpx3nOCjSCiHQbofqHM7AohCZRHH', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMHhkeGVlNnRvTGNEazE0RXIxNDFDT05ndkRLTlljQWVRdFk1UDd4RCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1775780135),
('k7DbEoCM13tS90mHQeUrkCNDkuhk0bLcEdF7aYSi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNlJsT2JZcmRIN2tDTHZobThEVG1zQUlHclpaZGhBNUNmcFNUQ29ObCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1775799856),
('l53f2g5YIyVJed1CylICkn4EFedJIws8kYRGKZTd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNG5wSTVsME1yYWozZ3RIeEd5UlliaFpqdXNvSWt3QjdkNUtLeFlxRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO319', 1775783775),
('UUNraEnnqvRRiCI4RbmZ4i6u8KfoETPcpkUAcQEl', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia1Q5ajlHN1dMNHZTZEpnNXZ4a1pjbk9NNTQ1ZmZUOTlScUdQbkJPUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1775784528);

-- --------------------------------------------------------

--
-- Table structure for table `tb_area_parkir`
--

CREATE TABLE `tb_area_parkir` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` int NOT NULL,
  `terisi` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_area_parkir`
--

INSERT INTO `tb_area_parkir` (`id`, `nama_area`, `kapasitas`, `terisi`, `created_at`, `updated_at`) VALUES
(1, 'Parkir Terminal A', 50, 1, '2026-02-10 15:58:17', '2026-03-10 18:03:44'),
(2, 'Parkir Terminal B', 40, 2, '2026-02-10 15:58:17', '2026-04-09 17:32:27'),
(3, 'Parkir VIP', 20, 1, '2026-02-10 15:58:17', '2026-04-08 19:27:03'),
(4, 'Parkir Inap', 30, 0, '2026-02-10 15:58:17', '2026-02-10 20:51:05'),
(6, 'terminal a', 8, 1, '2026-03-10 17:21:45', '2026-04-08 19:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id` bigint UNSIGNED NOT NULL,
  `plat_nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kendaraan` enum('motor','mobil','bus') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemilik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id`, `plat_nomor`, `jenis_kendaraan`, `pemilik`, `created_at`, `updated_at`) VALUES
(1, 'B BBC 232', 'motor', 'kuya uya', '2026-02-10 17:35:26', '2026-02-10 17:35:26'),
(2, 'E 121211', 'motor', 'kuya uya', '2026-02-10 20:50:47', '2026-02-10 20:50:47'),
(3, '122', 'motor', 'hanaananan', '2026-02-10 20:51:44', '2026-02-10 20:51:44'),
(4, 'B BBC 2565', 'bus', 'haji', '2026-02-10 20:52:40', '2026-02-10 20:52:40'),
(5, '81716262', 'motor', 'kuya uya', '2026-03-10 17:48:46', '2026-03-10 17:48:46'),
(6, '123', 'motor', 'hanaananan', '2026-03-10 18:03:37', '2026-03-10 18:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_aktivitas`
--

CREATE TABLE `tb_log_aktivitas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `aktivitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_log_aktivitas`
--

INSERT INTO `tb_log_aktivitas` (`id`, `user_id`, `aktivitas`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Login', 'User Administrator berhasil login.', '2026-02-10 16:59:07', '2026-02-10 16:59:07'),
(2, 1, 'Tambah Area Parkir', 'Menambahkan area: terminal a', '2026-02-10 16:59:58', '2026-02-10 16:59:58'),
(3, 1, 'Login', 'User Administrator berhasil login.', '2026-02-10 17:33:44', '2026-02-10 17:33:44'),
(4, 1, 'Logout', 'User Administrator telah logout.', '2026-02-10 17:34:28', '2026-02-10 17:34:28'),
(5, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-02-10 17:34:40', '2026-02-10 17:34:40'),
(6, 2, 'Kendaraan Masuk', 'Kendaraan B BBC 232 masuk ke terminal a', '2026-02-10 17:35:26', '2026-02-10 17:35:26'),
(7, 2, 'Kendaraan Keluar', 'Kendaraan B BBC 232 keluar. Biaya: Rp 3.000', '2026-02-10 17:36:00', '2026-02-10 17:36:00'),
(8, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-02-10 17:45:28', '2026-02-10 17:45:28'),
(9, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-02-10 17:45:48', '2026-02-10 17:45:48'),
(10, 3, 'Logout', 'User Owner Bandara telah logout.', '2026-02-10 17:46:24', '2026-02-10 17:46:24'),
(11, 1, 'Login', 'User Administrator berhasil login.', '2026-02-10 20:46:40', '2026-02-10 20:46:40'),
(12, 1, 'Logout', 'User Administrator telah logout.', '2026-02-10 20:49:56', '2026-02-10 20:49:56'),
(13, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-02-10 20:50:06', '2026-02-10 20:50:06'),
(14, 2, 'Kendaraan Masuk', 'Kendaraan E 121211 masuk ke Parkir Inap', '2026-02-10 20:50:47', '2026-02-10 20:50:47'),
(15, 2, 'Kendaraan Keluar', 'Kendaraan E 121211 keluar. Biaya: Rp 3.000', '2026-02-10 20:51:05', '2026-02-10 20:51:05'),
(16, 2, 'Kendaraan Masuk', 'Kendaraan 122 masuk ke Parkir Terminal A', '2026-02-10 20:51:44', '2026-02-10 20:51:44'),
(17, 2, 'Kendaraan Masuk', 'Kendaraan B BBC 2565 masuk ke Parkir Terminal B', '2026-02-10 20:52:40', '2026-02-10 20:52:40'),
(18, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-02-10 20:53:14', '2026-02-10 20:53:14'),
(19, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-02-10 20:53:32', '2026-02-10 20:53:32'),
(20, 3, 'Logout', 'User Owner Bandara telah logout.', '2026-02-10 20:54:45', '2026-02-10 20:54:45'),
(21, 1, 'Login', 'User Administrator berhasil login.', '2026-02-10 20:54:54', '2026-02-10 20:54:54'),
(22, 1, 'Logout', 'User Administrator telah logout.', '2026-02-10 21:04:17', '2026-02-10 21:04:17'),
(23, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-02-10 21:04:32', '2026-02-10 21:04:32'),
(24, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-02-10 21:24:26', '2026-02-10 21:24:26'),
(25, 1, 'Login', 'User Administrator berhasil login.', '2026-02-10 21:24:37', '2026-02-10 21:24:37'),
(26, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-02-11 18:04:34', '2026-02-11 18:04:34'),
(27, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-02-11 18:10:39', '2026-02-11 18:10:39'),
(28, 1, 'Login', 'User Administrator berhasil login.', '2026-02-11 18:10:49', '2026-02-11 18:10:49'),
(29, 1, 'Logout', 'User Administrator telah logout.', '2026-02-11 18:16:17', '2026-02-11 18:16:17'),
(30, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-02-11 18:16:26', '2026-02-11 18:16:26'),
(31, 1, 'Login', 'User Administrator berhasil login.', '2026-02-11 22:39:53', '2026-02-11 22:39:53'),
(32, 1, 'Login', 'User Administrator berhasil login.', '2026-02-22 17:22:58', '2026-02-22 17:22:58'),
(33, 1, 'Edit User', 'Mengedit user: petugas', '2026-02-22 17:24:21', '2026-02-22 17:24:21'),
(34, 1, 'Logout', 'User Administrator telah logout.', '2026-02-22 17:37:45', '2026-02-22 17:37:45'),
(35, 1, 'Login', 'User Administrator berhasil login.', '2026-03-10 16:51:57', '2026-03-10 16:51:57'),
(36, 1, 'Tambah Area Parkir', 'Menambahkan area: terminal a', '2026-03-10 17:21:45', '2026-03-10 17:21:45'),
(37, 1, 'Hapus Area Parkir', 'Menghapus area: terminal a', '2026-03-10 17:21:59', '2026-03-10 17:21:59'),
(38, 1, 'Logout', 'User Administrator telah logout.', '2026-03-10 17:40:58', '2026-03-10 17:40:58'),
(39, 1, 'Login', 'User Administrator berhasil login.', '2026-03-10 17:41:44', '2026-03-10 17:41:44'),
(40, 1, 'Edit User', 'Mengedit user: petugas', '2026-03-10 17:42:06', '2026-03-10 17:42:06'),
(41, 1, 'Logout', 'User Administrator telah logout.', '2026-03-10 17:42:16', '2026-03-10 17:42:16'),
(42, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-03-10 17:42:25', '2026-03-10 17:42:25'),
(43, 2, 'Kendaraan Masuk', 'Kendaraan 81716262 masuk ke Parkir Terminal A', '2026-03-10 17:48:46', '2026-03-10 17:48:46'),
(44, 2, 'Kendaraan Keluar', 'Kendaraan 81716262 keluar. Biaya: Rp 3.000', '2026-03-10 17:49:02', '2026-03-10 17:49:02'),
(45, 2, 'Kendaraan Masuk', 'Kendaraan 123 masuk ke Parkir Terminal A', '2026-03-10 18:03:37', '2026-03-10 18:03:37'),
(46, 2, 'Kendaraan Keluar', 'Kendaraan 123 keluar. Biaya: Rp 3.000', '2026-03-10 18:03:44', '2026-03-10 18:03:44'),
(47, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-03-10 18:28:01', '2026-03-10 18:28:01'),
(48, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-03-10 18:28:09', '2026-03-10 18:28:09'),
(49, 1, 'Login', 'User Administrator berhasil login.', '2026-03-11 05:22:24', '2026-03-11 05:22:24'),
(50, 1, 'Login', 'User Administrator berhasil login.', '2026-03-11 05:49:45', '2026-03-11 05:49:45'),
(51, 1, 'Logout', 'User Administrator telah logout.', '2026-03-11 05:52:17', '2026-03-11 05:52:17'),
(52, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-03-11 05:52:34', '2026-03-11 05:52:34'),
(53, 1, 'Edit User', 'Mengedit user: admin', '2026-03-11 05:58:44', '2026-03-11 05:58:44'),
(54, 1, 'Edit User', 'Mengedit user: endmin', '2026-03-11 05:59:04', '2026-03-11 05:59:04'),
(55, 1, 'Logout', 'User Endministrator telah logout.', '2026-03-11 06:13:12', '2026-03-11 06:13:12'),
(56, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-03-11 06:13:21', '2026-03-11 06:13:21'),
(57, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-03-11 07:04:02', '2026-03-11 07:04:02'),
(58, 1, 'Login', 'User Endministrator berhasil login.', '2026-03-11 07:15:22', '2026-03-11 07:15:22'),
(59, 1, 'Logout', 'User Endministrator telah logout.', '2026-03-11 08:25:56', '2026-03-11 08:25:56'),
(60, 1, 'Login', 'User Endministrator berhasil login.', '2026-03-11 08:32:52', '2026-03-11 08:32:52'),
(61, 1, 'Logout', 'User Endministrator telah logout.', '2026-03-11 08:35:51', '2026-03-11 08:35:51'),
(62, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-03-11 08:36:04', '2026-03-11 08:36:04'),
(63, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-03-11 08:39:46', '2026-03-11 08:39:46'),
(64, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-03-11 08:39:55', '2026-03-11 08:39:55'),
(65, 1, 'Login', 'User Endministrator berhasil login.', '2026-03-13 05:01:52', '2026-03-13 05:01:52'),
(66, 1, 'Logout', 'User Endministrator telah logout.', '2026-03-13 05:10:01', '2026-03-13 05:10:01'),
(67, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-03-13 05:10:15', '2026-03-13 05:10:15'),
(68, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-03-13 05:11:47', '2026-03-13 05:11:47'),
(69, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-03-13 05:12:01', '2026-03-13 05:12:01'),
(70, 1, 'Login', 'User Endministrator berhasil login.', '2026-03-31 03:45:58', '2026-03-31 03:45:58'),
(71, 1, 'Edit Tarif', 'Mengedit tarif: motor', '2026-03-31 03:46:40', '2026-03-31 03:46:40'),
(72, 1, 'Logout', 'User Endministrator telah logout.', '2026-03-31 03:48:52', '2026-03-31 03:48:52'),
(73, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-03-31 03:49:06', '2026-03-31 03:49:06'),
(74, 1, 'Login', 'User Endministrator berhasil login.', '2026-04-07 18:32:18', '2026-04-07 18:32:18'),
(75, 1, 'Tambah User', 'Menambahkan user baru: suki', '2026-04-07 18:50:22', '2026-04-07 18:50:22'),
(76, 1, 'Logout', 'User Endministrator telah logout.', '2026-04-07 21:30:50', '2026-04-07 21:30:50'),
(77, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-04-07 21:31:00', '2026-04-07 21:31:00'),
(78, 2, 'Kendaraan Keluar', 'Kendaraan B BBC 2565 keluar (1345 jam). Biaya: Rp 10.000', '2026-04-07 21:31:18', '2026-04-07 21:31:18'),
(79, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-04-07 22:48:36', '2026-04-07 22:48:36'),
(80, 1, 'Login', 'User Endministrator berhasil login.', '2026-04-07 22:48:50', '2026-04-07 22:48:50'),
(81, 1, 'Tambah Kendaraan', 'Menambahkan kendaraan: A 1965 KAF', '2026-04-07 22:49:51', '2026-04-07 22:49:51'),
(82, 1, 'Logout', 'User Endministrator telah logout.', '2026-04-07 23:40:23', '2026-04-07 23:40:23'),
(83, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-04-07 23:40:33', '2026-04-07 23:40:33'),
(84, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-04-08 05:54:58', '2026-04-08 05:54:58'),
(85, 3, 'Logout', 'User Owner Bandara telah logout.', '2026-04-08 05:55:20', '2026-04-08 05:55:20'),
(86, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-04-08 15:23:11', '2026-04-08 15:23:11'),
(87, 3, 'Logout', 'User Owner Bandara telah logout.', '2026-04-08 15:24:42', '2026-04-08 15:24:42'),
(88, 1, 'Login', 'User Endministrator berhasil login.', '2026-04-08 15:25:00', '2026-04-08 15:25:00'),
(89, 1, 'Login', 'User Endministrator berhasil login.', '2026-04-08 19:19:22', '2026-04-08 19:19:22'),
(90, 1, 'Hapus Kendaraan', 'Menghapus kendaraan: A 1965 KAF', '2026-04-08 19:21:58', '2026-04-08 19:21:58'),
(91, 1, 'Logout', 'User Endministrator telah logout.', '2026-04-08 19:23:51', '2026-04-08 19:23:51'),
(92, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-04-08 19:24:07', '2026-04-08 19:24:07'),
(93, 2, 'Kendaraan Masuk', 'Kendaraan 123 masuk ke terminal a', '2026-04-08 19:26:23', '2026-04-08 19:26:23'),
(94, 2, 'Kendaraan Masuk', 'Kendaraan 81716262 masuk ke Parkir VIP', '2026-04-08 19:27:03', '2026-04-08 19:27:03'),
(95, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-04-08 19:28:35', '2026-04-08 19:28:35'),
(96, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-04-08 19:28:54', '2026-04-08 19:28:54'),
(97, 3, 'Logout', 'User Owner Bandara telah logout.', '2026-04-08 19:31:36', '2026-04-08 19:31:36'),
(98, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-04-09 17:15:34', '2026-04-09 17:15:34'),
(99, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-04-09 17:15:54', '2026-04-09 17:15:54'),
(100, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-04-09 17:16:32', '2026-04-09 17:16:32'),
(101, 1, 'Login', 'User Endministrator berhasil login.', '2026-04-09 17:17:01', '2026-04-09 17:17:01'),
(102, 1, 'Logout', 'User Endministrator telah logout.', '2026-04-09 17:17:24', '2026-04-09 17:17:24'),
(103, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-04-09 17:17:36', '2026-04-09 17:17:36'),
(104, 3, 'Logout', 'User Owner Bandara telah logout.', '2026-04-09 17:27:16', '2026-04-09 17:27:16'),
(105, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-04-09 17:27:29', '2026-04-09 17:27:29'),
(106, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-04-09 17:29:39', '2026-04-09 17:29:39'),
(107, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-04-09 17:29:59', '2026-04-09 17:29:59'),
(108, 3, 'Logout', 'User Owner Bandara telah logout.', '2026-04-09 17:30:47', '2026-04-09 17:30:47'),
(109, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-04-09 17:30:58', '2026-04-09 17:30:58'),
(110, 2, 'Kendaraan Masuk', 'Kendaraan B BBC 232 masuk ke Parkir Terminal B', '2026-04-09 17:32:04', '2026-04-09 17:32:04'),
(111, 2, 'Kendaraan Masuk', 'Kendaraan B BBC 2565 masuk ke Parkir Terminal B', '2026-04-09 17:32:27', '2026-04-09 17:32:27'),
(112, 2, 'Logout', 'User Petugas Parkir telah logout.', '2026-04-09 17:47:28', '2026-04-09 17:47:28'),
(113, 3, 'Login', 'User Owner Bandara berhasil login.', '2026-04-09 17:47:49', '2026-04-09 17:47:49'),
(114, 3, 'Logout', 'User Owner Bandara telah logout.', '2026-04-09 18:28:13', '2026-04-09 18:28:13'),
(115, 2, 'Login', 'User Petugas Parkir berhasil login.', '2026-04-09 18:28:31', '2026-04-09 18:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis_kendaraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif_per_jam` decimal(10,2) NOT NULL,
  `tarif_tambahan_per_jam` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tarif_inap_per_hari` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_tarif`
--

INSERT INTO `tb_tarif` (`id`, `jenis_kendaraan`, `tarif_per_jam`, `tarif_tambahan_per_jam`, `tarif_inap_per_hari`, `created_at`, `updated_at`) VALUES
(1, 'motor', '3000.00', '1000.00', '20000.00', '2026-02-10 15:58:17', '2026-03-31 03:46:40'),
(2, 'mobil', '5000.00', '0.00', '0.00', '2026-02-10 15:58:17', '2026-02-10 15:58:17'),
(3, 'bus', '10000.00', '0.00', '0.00', '2026-02-10 15:58:17', '2026-02-10 15:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` bigint UNSIGNED NOT NULL,
  `kendaraan_id` bigint UNSIGNED NOT NULL,
  `area_parkir_id` bigint UNSIGNED NOT NULL,
  `waktu_masuk` datetime NOT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `durasi_jam` decimal(8,2) DEFAULT NULL,
  `biaya_total` decimal(12,2) DEFAULT NULL,
  `status` enum('masuk','keluar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'masuk',
  `petugas_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `kendaraan_id`, `area_parkir_id`, `waktu_masuk`, `waktu_keluar`, `durasi_jam`, `biaya_total`, `status`, `petugas_id`, `created_at`, `updated_at`) VALUES
(2, 2, 4, '2026-02-11 03:50:47', '2026-02-11 03:51:05', '1.00', '3000.00', 'keluar', 2, '2026-02-10 20:50:47', '2026-02-10 20:51:05'),
(3, 3, 1, '2026-02-11 03:51:44', NULL, NULL, NULL, 'masuk', 2, '2026-02-10 20:51:44', '2026-02-10 20:51:44'),
(4, 4, 2, '2026-02-11 03:52:40', '2026-04-08 04:31:17', '1345.00', '10000.00', 'keluar', 2, '2026-02-10 20:52:40', '2026-04-07 21:31:17'),
(5, 5, 1, '2026-03-11 00:48:46', '2026-03-11 00:49:02', '1.00', '3000.00', 'keluar', 2, '2026-03-10 17:48:46', '2026-03-10 17:49:02'),
(6, 6, 1, '2026-03-11 01:03:37', '2026-03-11 01:03:44', '1.00', '3000.00', 'keluar', 2, '2026-03-10 18:03:37', '2026-03-10 18:03:44'),
(7, 6, 6, '2026-04-09 02:26:23', NULL, NULL, NULL, 'masuk', 2, '2026-04-08 19:26:23', '2026-04-08 19:26:23'),
(8, 5, 3, '2026-04-09 02:27:03', NULL, NULL, NULL, 'masuk', 2, '2026-04-08 19:27:03', '2026-04-08 19:27:03'),
(9, 1, 2, '2026-04-10 00:32:04', NULL, NULL, NULL, 'masuk', 2, '2026-04-09 17:32:04', '2026-04-09 17:32:04'),
(10, 4, 2, '2026-04-10 00:32:27', NULL, NULL, NULL, 'masuk', 2, '2026-04-09 17:32:27', '2026-04-09 17:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','petugas','owner') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'petugas',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama_lengkap`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Endministrator', 'endmin', '$2y$12$v59RzTkfoJyhsWfwqkIB0.KXApY.VhV50vSSZPCzO4WctDjlAPsb.', 'admin', '2026-02-10 15:58:17', '2026-03-11 05:59:04'),
(2, 'Petugas Parkir', 'petugas', '$2y$12$f5zjm/6Kg/suE62igfIjauWx9pz40YOplu0x/fsc9B8TUrybvTngC', 'petugas', '2026-02-10 15:58:17', '2026-03-10 17:42:06'),
(3, 'Owner Bandara', 'owner', '$2y$12$f1cifnNnBVct4tXbEnJqauFh3hArB7jpuJkpo59IeERQ4hj7ZLxg6', 'owner', '2026-02-10 15:58:17', '2026-02-10 15:58:17'),
(4, 'suki', 'suki', '$2y$12$VSdxg0A00njA3wcX6G4b0eDedNBKRY2w3j6dBhs/7iFs7v7ggNcK.', 'admin', '2026-04-07 18:50:22', '2026-04-07 18:50:22');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_kendaraan_plat_nomor_unique` (`plat_nomor`);

--
-- Indexes for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_log_aktivitas_user_id_foreign` (`user_id`);

--
-- Indexes for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_tarif_jenis_kendaraan_unique` (`jenis_kendaraan`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_transaksi_kendaraan_id_foreign` (`kendaraan_id`),
  ADD KEY `tb_transaksi_area_parkir_id_foreign` (`area_parkir_id`),
  ADD KEY `tb_transaksi_petugas_id_foreign` (`petugas_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_user_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD CONSTRAINT `tb_log_aktivitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_area_parkir_id_foreign` FOREIGN KEY (`area_parkir_id`) REFERENCES `tb_area_parkir` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_transaksi_kendaraan_id_foreign` FOREIGN KEY (`kendaraan_id`) REFERENCES `tb_kendaraan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_transaksi_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
