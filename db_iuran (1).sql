-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Des 2025 pada 23.43
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_iuran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-adibaa2|127.0.0.1', 'i:1;', 1761580557),
('laravel-cache-adibaa2|127.0.0.1:timer', 'i:1761580557;', 1761580557),
('laravel-cache-alvana3|127.0.0.1', 'i:1;', 1762995850),
('laravel-cache-alvana3|127.0.0.1:timer', 'i:1762995850;', 1762995850),
('laravel-cache-alyaaa2866|127.0.0.1', 'i:2;', 1761261547),
('laravel-cache-alyaaa2866|127.0.0.1:timer', 'i:1761261547;', 1761261547),
('laravel-cache-asmab3|127.0.0.1', 'i:1;', 1762995867),
('laravel-cache-asmab3|127.0.0.1:timer', 'i:1762995867;', 1762995867),
('laravel-cache-junaa1|127.0.0.1', 'i:1;', 1761262398),
('laravel-cache-junaa1|127.0.0.1:timer', 'i:1761262398;', 1761262398),
('laravel-cache-mia359|127.0.0.1', 'i:2;', 1761273545),
('laravel-cache-mia359|127.0.0.1:timer', 'i:1761273545;', 1761273545);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_17_160247_create_siswas_table', 1),
(5, '2025_10_17_160456_create_tagihans_table', 1),
(6, '2025_10_17_160540_create_pembayarans_table', 1),
(7, '2025_10_19_095630_add_siswa_id_to_tagihans_table', 1),
(8, '2025_10_19_103741_modify_pembayarans_table', 1),
(9, '2025_12_01_040249_add_ditolak_status_to_tagihans_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tagihan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_transfer` datetime NOT NULL,
  `struk_bukti` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `tagihan_id`, `tanggal_transfer`, `struk_bukti`, `catatan`, `created_at`, `updated_at`) VALUES
(5, 19, '2025-10-28 05:47:40', 'bukti-pembayaran/ywYFChorB6kxjJJxYN772cyXKbzrLVMFU9zZiIsM.jpg', NULL, '2025-10-27 22:47:40', '2025-10-27 22:47:40'),
(6, 14, '2025-10-30 13:48:55', 'bukti-pembayaran/ex8D4oTbDu7b8AQWosmpiZTA9nWndNyHAZiRNvIW.png', NULL, '2025-10-30 06:48:55', '2025-10-30 06:48:55'),
(7, 18, '2025-10-30 14:22:05', 'bukti-pembayaran/zWNPtYtyZLYSJYV58d9vJvtwmlPEHVFjyWajjAao.png', NULL, '2025-10-30 07:22:05', '2025-10-30 07:22:05'),
(8, 13, '2025-10-30 14:38:24', 'bukti-pembayaran/6QGYvkrWmqwBCYSuuXOJPMjzWslzYcxRVzzFMEVV.png', NULL, '2025-10-30 07:38:24', '2025-10-30 07:38:24'),
(9, 12, '2025-10-31 04:29:13', 'bukti-pembayaran/YwwTU5RLvO5ghWgsxxGwAFbmd5sps4bq0pWg2gdt.png', NULL, '2025-10-30 21:29:13', '2025-10-30 21:29:13'),
(10, 39, '2025-11-11 06:38:33', 'bukti-pembayaran/Nfxsdu9rNEPx5fzFrDdt2Yj9EUxVZ6Q0tR7z6uzJ.png', NULL, '2025-11-10 23:38:33', '2025-11-10 23:38:33'),
(11, 32, '2025-12-01 07:41:21', 'bukti-pembayaran/R4TP0XVSPyzgB1ijLHqtPC7cbWqx6afxZnXPe9YO.png', NULL, '2025-11-12 17:58:15', '2025-12-01 00:41:21'),
(12, 32, '2025-11-13 00:58:16', 'bukti-pembayaran/pSn4LRbkBop1uEzSYpIR1s8Lib9F1T9xmC7XvqBz.png', NULL, '2025-11-12 17:58:16', '2025-11-12 17:58:16'),
(13, 30, '2025-11-13 01:12:10', 'bukti-pembayaran/k7xphQIqcwJSSQtC3DUrNhRHfred83NPYSe07Ww0.png', NULL, '2025-11-12 18:12:10', '2025-11-12 18:12:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('qz55J6bJcn1KBPjZbyb9z9lZKxhsBIkjGv1SIHNc', 111, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMUxJRUFqRWRZZ08zVXBHVnhIRWtQRVFQQjJWdGpwMHB5TDNCT2UyNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC93YWxpbXVyaWQvdGFnaWhhbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExMTt9', 1764574885);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `status` enum('aktif','lulus','pindah') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswas`
--

INSERT INTO `siswas` (`id`, `user_id`, `nis`, `nama_siswa`, `kelas`, `status`, `created_at`, `updated_at`) VALUES
(10, 109, '001', 'Abayomi Lutfi Jumanto', 'A1', 'aktif', '2025-10-27 15:29:26', '2025-10-27 15:29:26'),
(11, 110, '002', 'Adhitama Elvan Syahreza', 'A1', 'aktif', '2025-10-27 15:29:48', '2025-10-27 15:29:48'),
(12, 111, '022', 'Afzal Albyzikri', 'A2', 'aktif', '2025-10-27 15:30:52', '2025-10-27 15:30:52'),
(13, 112, '023', 'Alesha Hilya Zulaika', 'A2', 'aktif', '2025-10-27 15:31:21', '2025-10-27 15:31:21'),
(14, 113, '044', 'Abyan Rafif', 'A3', 'aktif', '2025-10-27 15:31:55', '2025-10-27 15:31:55'),
(15, 114, '045', 'Alula Nahda Humaira', 'A3', 'aktif', '2025-10-27 15:32:22', '2025-10-27 15:32:22'),
(16, 115, '065', 'Afnan Fauzi Hananta', 'A4', 'aktif', '2025-10-27 15:32:48', '2025-10-27 15:32:48'),
(17, 116, '066', 'Afsheena Zeina Siwa', 'A4', 'aktif', '2025-10-27 15:33:25', '2025-10-27 15:33:25'),
(18, 117, '086', 'All Ayubi Aryana', 'B1', 'aktif', '2025-10-27 15:34:08', '2025-10-27 15:34:08'),
(19, 118, '092', 'Habieb Al Malik Sholeh', 'B1', 'aktif', '2025-10-27 15:34:49', '2025-10-27 15:34:49'),
(20, 119, '108', 'Abdul Rahman Hafiz', 'B2', 'aktif', '2025-10-27 15:35:25', '2025-10-27 15:35:25'),
(21, 120, '109', 'Adreena Mysha Utomo', 'B2', 'aktif', '2025-10-27 15:35:57', '2025-10-27 15:35:57'),
(22, 121, '130', 'Adiva Yasna Umaiza', 'B3', 'aktif', '2025-10-27 15:36:40', '2025-10-27 15:36:40'),
(23, 122, '131', 'Afraz Rafan Abqori', 'B3', 'aktif', '2025-10-27 15:37:19', '2025-10-27 15:37:19'),
(24, 123, '150', 'Aisyah Nur Afiqah', 'B4', 'aktif', '2025-10-27 15:37:56', '2025-10-27 15:37:56'),
(25, 124, '171', 'Abid Yadzidal Bustomi', 'B5', 'aktif', '2025-10-27 15:39:54', '2025-10-27 15:39:54'),
(26, 125, '172', 'Adelia Maulida', 'B5', 'aktif', '2025-10-27 15:40:20', '2025-10-27 15:40:20'),
(27, 126, '195', 'Adzkiyya Putri Aulia', 'B6', 'aktif', '2025-10-27 15:41:01', '2025-10-27 15:41:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihans`
--

CREATE TABLE `tagihans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `nominal` decimal(10,2) NOT NULL,
  `status` enum('belum_lunas','menunggu_verifikasi','lunas','ditolak') DEFAULT 'belum_lunas',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tagihans`
--

INSERT INTO `tagihans` (`id`, `siswa_id`, `bulan`, `tahun`, `nominal`, `status`, `created_at`, `updated_at`) VALUES
(10, 10, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:41:59', '2025-10-27 15:41:59'),
(11, 11, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:41:59', '2025-10-27 15:41:59'),
(12, 12, '10', '2025', 150000.00, 'lunas', '2025-10-27 15:41:59', '2025-11-30 21:15:55'),
(13, 13, '10', '2025', 150000.00, 'lunas', '2025-10-27 15:41:59', '2025-10-30 07:38:55'),
(14, 14, '10', '2025', 150000.00, 'lunas', '2025-10-27 15:41:59', '2025-10-30 06:49:34'),
(15, 15, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:41:59', '2025-10-27 15:41:59'),
(16, 16, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:41:59', '2025-10-27 15:41:59'),
(17, 17, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:41:59', '2025-10-27 15:41:59'),
(18, 18, '10', '2025', 150000.00, 'lunas', '2025-10-27 15:41:59', '2025-10-30 07:23:03'),
(19, 19, '10', '2025', 150000.00, 'lunas', '2025-10-27 15:41:59', '2025-10-27 22:57:05'),
(20, 20, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:41:59', '2025-10-27 15:41:59'),
(21, 21, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:41:59', '2025-10-27 15:41:59'),
(22, 22, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:41:59', '2025-10-27 15:41:59'),
(23, 23, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:41:59', '2025-10-27 15:41:59'),
(24, 24, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:42:00', '2025-10-27 15:42:00'),
(25, 25, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:42:00', '2025-10-27 15:42:00'),
(26, 26, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:42:00', '2025-10-27 15:42:00'),
(27, 27, '10', '2025', 150000.00, 'belum_lunas', '2025-10-27 15:42:00', '2025-10-27 15:42:00'),
(30, 10, '11', '2025', 150000.00, 'lunas', '2025-11-04 23:57:30', '2025-11-30 20:50:42'),
(31, 11, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(32, 12, '11', '2025', 150000.00, 'menunggu_verifikasi', '2025-11-04 23:57:30', '2025-12-01 00:41:21'),
(33, 13, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(34, 14, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(35, 15, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(36, 16, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(37, 17, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(38, 18, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(39, 19, '11', '2025', 150000.00, 'lunas', '2025-11-04 23:57:30', '2025-11-10 23:42:26'),
(40, 20, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(41, 21, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(42, 22, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(43, 23, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(44, 24, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(45, 25, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(46, 26, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30'),
(47, 27, '11', '2025', 150000.00, 'belum_lunas', '2025-11-04 23:57:30', '2025-11-04 23:57:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','walimurid') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(45, 'Mia Nuur Aini', 'Mia359', 'mia@gmail.com', NULL, '$2y$12$J7fOXsVibNeN2t1BWZMjfuWVbQbAAI8jxNfxGSZVFqkEiwIJl7Fhm', 'admin', NULL, '2025-10-23 16:08:43', '2025-10-23 16:08:43'),
(46, 'Alya Rohali', 'Alya46', 'alya@gmail.com', NULL, '$2y$12$G4MZbOUZq0xBtvcrkDZeJ.ETpsM6fhRdAl.vdCjqwgsp2.HFPbs..', 'admin', '6DOpH6L6h9nFKonU2KSXq6JXh8kLZqsFTlvnzmfanjuoLSIzbU6HO5sO9293', '2025-10-23 16:19:08', '2025-10-23 16:19:08'),
(109, 'Dewi Ariyanti', 'LutfiA1', NULL, NULL, '$2y$12$t5A4f5LWa4kThoFXylrp/O.UypplQsBCdysbTF45SKO3NnjC4muGC', 'walimurid', NULL, '2025-10-27 15:14:10', '2025-10-27 15:14:10'),
(110, 'Dina Simanjuntak', 'ElvanA1', NULL, NULL, '$2y$12$Cu1HREaVs0FkmbjGVcoO9OUTwjVKamNleVc/6d7Wq.gT7okBgZz.K', 'walimurid', NULL, '2025-10-27 15:14:40', '2025-10-27 15:14:40'),
(111, 'Eka Kurnia', 'AfzalA2', NULL, NULL, '$2y$12$9zeG3t0x.jU4j/8wD4w.NOA8.KJUVxmWbDQjEn5YpUQpBo75eOn4O', 'walimurid', NULL, '2025-10-27 15:15:03', '2025-10-27 15:15:03'),
(112, 'Dewi Indriati Septiani', 'AleshaA2', NULL, NULL, '$2y$12$9I2Ej5VPe32zfOQXbNntluyfjFLiC4y./II4J2OyKazeP5pJO67wW', 'walimurid', NULL, '2025-10-27 15:15:30', '2025-10-27 15:15:30'),
(113, 'Ika Kartika', 'ByanA3', NULL, NULL, '$2y$12$Sm3DJ6ZoeC9AI2Mm.6pZcOkUWGOpkf3vyWzwfxY0AK9KsWif0vpmG', 'walimurid', NULL, '2025-10-27 15:16:03', '2025-10-27 15:16:03'),
(114, 'Frida Afriani', 'LulaA3', NULL, NULL, '$2y$12$pg6myGbC0IC0jarY8EndheIklQC1g7J9xa46YtayM/r6ss3OisLMS', 'walimurid', NULL, '2025-10-27 15:16:31', '2025-10-27 15:16:31'),
(115, 'Tri Yuli Patmawati', 'AfnanA4', NULL, NULL, '$2y$12$lPVByj.8OIyRaqGhOItZR.XMbFJZIBAZt5lgi0fu3HVuFhmRhZ9Q.', 'walimurid', NULL, '2025-10-27 15:16:59', '2025-10-27 15:16:59'),
(116, 'Siti Robiatul Adawiyah', 'ZeinaA4', NULL, NULL, '$2y$12$pA80BdYAXetHZ7eGKe4FmOm3d.7UNQoRDCexnL9U7hB/qF34j0fVK', 'walimurid', NULL, '2025-10-27 15:17:27', '2025-10-27 15:17:27'),
(117, 'Ayu Karnengsih', 'AllB1', NULL, NULL, '$2y$12$Ofl2LzLQCJ0/J5eZtqbN4Ohtmf67MUq29FRadTNv75TMurUnyxZ.S', 'walimurid', NULL, '2025-10-27 15:17:59', '2025-10-27 15:17:59'),
(118, 'Nining Darya Ningsih', 'AlmalikB1', NULL, NULL, '$2y$12$ujRiVXSrb.mdPLIrb6zVqOTVYhpTX3zxM151vlsyubf.S9r7zvKUq', 'walimurid', NULL, '2025-10-27 15:18:24', '2025-10-27 15:18:24'),
(119, 'Sartika', 'HafizB2', NULL, NULL, '$2y$12$/CYUVsvW4GqtPDgRgQMmeeC4dIdsVjFdNxaAhNKGuJ7RdSsrp8y6W', 'walimurid', NULL, '2025-10-27 15:18:59', '2025-10-27 15:18:59'),
(120, 'Inna Maydina', 'MyshaB2', NULL, NULL, '$2y$12$FycVRQMSHh6Y5yInhQFCYOeVV5m/4xVORpoX69eP1rd3p7.rKECBK', 'walimurid', NULL, '2025-10-27 15:19:31', '2025-10-27 15:19:31'),
(121, 'Lilis', 'YasnaB3', NULL, NULL, '$2y$12$s4W2Xea0TuUjXjF.qitO3ujVG8xMDh3gTOpcFFYe/4H3QEEMdux5.', 'walimurid', NULL, '2025-10-27 15:20:25', '2025-10-27 15:20:25'),
(122, 'Mariadona', 'AfrazB3', NULL, NULL, '$2y$12$x3ZR/8DgdArq6/x/4ZBxQOLAASQkDiR1WdkGc3LBVpfLOxlufWuT6', 'walimurid', NULL, '2025-10-27 15:20:52', '2025-10-27 15:20:52'),
(123, 'Lu\'lu Qonitati Rahman', 'AisyahB4', NULL, NULL, '$2y$12$nL.p27qz5fwA2.0uDPt5gOp8nmDnp.KVZGIxNXBtskxQEs461jMqC', 'walimurid', NULL, '2025-10-27 15:21:25', '2025-10-27 15:21:25'),
(124, 'Rahayu Sartika', 'AbidB5', NULL, NULL, '$2y$12$RK7SW1UlnCPtcjm/hP9kpe2kZAVZlDlDe1tOFdTedKNs4pxPCbrjq', 'walimurid', NULL, '2025-10-27 15:21:52', '2025-10-27 15:21:52'),
(125, 'Dadah', 'AdeliaB5', NULL, NULL, '$2y$12$v21w.OfnRpwj/jSB5jJ75./56w9tm62DmGDch1FpsyLf995wqL1SG', 'walimurid', NULL, '2025-10-27 15:22:16', '2025-10-27 15:22:16'),
(126, 'Yulia Sukma Widiawati', 'PutriB6', NULL, NULL, '$2y$12$.GoXBE6jN26KjlwSzf7T9uF1zGDBNyLCYn.SS2gXvQOmy5pZgC.Ba', 'walimurid', NULL, '2025-10-27 15:22:48', '2025-10-27 15:22:48'),
(127, 'Epi Wulandari', 'AisyahB6', NULL, NULL, '$2y$12$Rqxf6EKv8LsdkBo3wgQWRumjhvt6UWgYYrCnvi4reOEUAviTLYgwW', 'walimurid', NULL, '2025-10-27 15:23:13', '2025-10-27 15:23:13');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_tagihan_id_foreign` (`tagihan_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswas_nis_unique` (`nis`),
  ADD KEY `siswas_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `tagihans`
--
ALTER TABLE `tagihans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tagihans_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tagihans`
--
ALTER TABLE `tagihans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_tagihan_id_foreign` FOREIGN KEY (`tagihan_id`) REFERENCES `tagihans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tagihans`
--
ALTER TABLE `tagihans`
  ADD CONSTRAINT `tagihans_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
