-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 10:35 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rival_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_08_17_073152_create_permission_tables', 1),
(5, '2020_08_18_062807_create_settings_table', 1),
(6, '2020_08_19_072946_create_produk_table', 1),
(7, '2020_08_19_073627_create_kategori_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manajemen users', 'web', '2021-02-06 08:05:59', '2021-02-06 08:05:59'),
(2, 'manajemen roles', 'web', '2021-02-06 08:05:59', '2021-02-06 08:05:59'),
(3, 'manajemen produk', 'web', '2021-02-06 08:05:59', '2021-02-06 08:05:59'),
(4, 'manajemen kategori', 'web', '2021-02-06 08:05:59', '2021-02-06 08:05:59'),
(5, 'manajemen master', 'web', '2021-02-05 23:14:14', '2021-02-06 08:05:59'),
(6, 'manajemen pendakian', 'web', '2021-02-09 22:12:14', '2021-02-09 22:12:14'),
(7, 'manajemen laporan', 'web', '2021-02-06 08:05:59', '2021-02-06 08:05:59'),
(8, 'manajemen data pendaki', 'web', '2021-02-06 08:05:59', '2021-02-06 08:05:59'),
(9, 'manajemen setting', 'web', '2021-02-06 08:05:59', '2021-02-06 08:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2021-02-06 08:05:59', '2021-02-06 08:05:59'),
(2, 'kasir', 'web', '2021-02-06 08:05:59', '2021-02-06 08:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_right` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_left` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `favicon`, `logo`, `app_name`, `footer_right`, `footer_left`, `created_at`, `updated_at`) VALUES
(1, 'favicon_default.ico', 'logo_default.png', 'Hikey!', 'Ver 1.0', 'Hikey! App v.1.0', '2021-02-06 08:06:00', '2021-02-07 19:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` bigint(20) NOT NULL,
  `id_pendaki` bigint(20) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `id_pendaki`, `nama_anggota`, `no_identitas`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Andika Mahesa', '327201222131', 1, '2021-02-18 06:17:00', NULL),
(2, 1, 'Hibatul Wafi', '212211', 1, '2021-02-18 06:17:00', NULL),
(4, 1, 'Aam', '123321', 1, '2021-02-19 04:09:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id_detail` bigint(20) NOT NULL,
  `id_transaksi` bigint(20) NOT NULL,
  `id_fasilitas` bigint(20) NOT NULL,
  `harga_sewa` varchar(255) NOT NULL,
  `qty` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id_detail`, `id_transaksi`, `id_fasilitas`, `harga_sewa`, `qty`, `created_at`) VALUES
(1, 1, 6, '1050000', 21, '2021-02-19 03:41:24'),
(2, 1, 2, '20000', 2, '2021-02-19 03:47:12'),
(3, 1, 2, '0', NULL, '2021-03-30 06:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fasilitas`
--

CREATE TABLE `tb_fasilitas` (
  `id_fasilitas` bigint(20) NOT NULL,
  `id_gunung` bigint(20) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 1,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_fasilitas`
--

INSERT INTO `tb_fasilitas` (`id_fasilitas`, `id_gunung`, `gambar`, `nama_fasilitas`, `harga`, `stok`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'tent.jpg', 'Tenda Kapasitas 2', '120000', 134, 1, '2021-02-07 03:31:41', NULL),
(2, 1, 'tent.jpg', 'Tali Pasak', '10000', 118, 1, '2021-02-07 04:16:11', '2021-02-07 01:25:57'),
(5, 1, '-602682672133a.jpeg', 'Tenda Kapasitas 4', '140000', 0, 1, '2021-02-12 13:28:07', NULL),
(6, 1, 'fasilitas1-6026838c96cc5.jpeg', 'Kompor', '50000', 0, 1, '2021-02-12 13:33:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gunung`
--

CREATE TABLE `tb_gunung` (
  `id_gunung` bigint(20) NOT NULL,
  `nama_gunung` varchar(255) NOT NULL,
  `keterangan_gunung` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_gunung`
--

INSERT INTO `tb_gunung` (`id_gunung`, `nama_gunung`, `keterangan_gunung`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gunung Gede Pangrango', 'Gunung Gede merupakan sebuah gunung api bertipe stratovolcano yang berada di Pulau Jawa, Indonesia. Gunung Gede berada dalam ruang lingkup Taman Nasional Gede Pangrango, yang merupakan salah satu dari lima taman nasional yang pertama kali diumumkan di Indonesia pada tahun 1980', 1, '2021-01-27 14:18:14', '2021-01-27 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jalur`
--

CREATE TABLE `tb_jalur` (
  `id_jalur` bigint(20) NOT NULL,
  `id_gunung` bigint(20) NOT NULL,
  `peta` text DEFAULT 'peta.pdf',
  `nama_jalur` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jalur`
--

INSERT INTO `tb_jalur` (`id_jalur`, `id_gunung`, `peta`, `nama_jalur`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'peta.pdf', 'Jalur Selabintana Sukabumi', 1, 'Jalur pendakian resmi yang terakhir yaitu jalur Selabintana di Sukabumi. Jalur ini merupakan jalur terpanjang menuju puncak Gunung Gede Pangrango.Namun, bagi kamu yang belum paham, pemula dan belum mengetahui informasi seputar jalur ini, disarankan untuk tidak melaluinya karena medan yang menantang. Pendaki akan menemui pacet, sejenis lintah yang bisa mengisap darah dari tubuhmu. Biasanya kaki para pendaki akan dipenuhi pacet ketika mendaki di jalur ini. Menyusuri sungai dan hutan juga menjadi makanan selama pendakian di jalur Selabintana. Bagi kamu penyuka tantangan, jalur ini bisa menjadi pilihan yang tepat. Adapun, estimasi waktunya untuk sampai puncak sekitar 9-12 jam.', '2021-02-06 13:57:47', '2021-02-11 08:39:01'),
(2, 1, 'peta.pdf', 'Jalur Cibodas', 1, 'Jalur pendakian Gunung Gede Pangrango via Cibodas merupakan jalur yang paling sering dilalui para pendaki.Terdapat beberapa pos peristirahatan di jalur pendakian via Cibodas. Pos-pos tersebut juga beratap dan bermanfaat untuk tempat berteduh para pendaki. Awal pendakian, kamu akan menyusuri jalan setapak berbatu. Kawasan hutan tropis yang lebat juga akan menjadi pemandanganmu sepanjang awal perjalanan. Pemandangan alam yang eksotis dan indah ini menjadi daya tarik tersendiri bagi pendaki yang memilih jalur ini.\r\nMulai dari telaga biru, rawa gayonggong, hingga air terjun Panca Weuleuh, semua akan tersaji ketika kamu melewati Pos Kandang Batu. Pendaki yang melalui jalur Cibodas biasanya akan mendirikan tenda di Kandang Badak sebelum lanjut summit atau menuju puncak sekitar pukul 03.00 WIB. Sampai di puncak, kamu akan dimanjakan dengan pemandangan indah empat kawah yang masih aktif yaitu Kawah Ratu, Kawah Wadon, Kawah Lanang, dan Kawah Baru. Jalur pendakian via Cibodas memakan waktu sekitar 7-10 jam untuk sampai puncak.\r\n', '2021-02-08 15:00:15', NULL),
(3, 1, 'peta.pdf', 'Jalur Gunung Putri', 1, 'Jalur berikutnya yang biasa dipilih pendaki adalah jalur Gunung Putri. Trek yang akan dilalui pendaki di sini lebih sulit daripada Cibodas.Medan terjal dan trek curam akan menjadi makanan para pendaki di jalur ini. Kamu akan merasakannya ketika melalui kawasan hutan tropis, sekitar Tanah Merah dan sekitar Lawang Seketeng.Pos Jaga Gunung merupakan titik awal pendakian. Setelah itu, pendaki akan lanjut menuju trek melewati hutan pinus yang dikelola KPH Perhutani Cianjur. Jalur Gunung Putri memiliki estimasi waktu lebih cepat untuk sampai puncak yaitu 6-8 jam.', '2021-02-08 15:00:15', '2021-02-11 08:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendaki`
--

CREATE TABLE `tb_pendaki` (
  `id_pendaki` bigint(20) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'profile.png',
  `nama_pendaki` varchar(255) NOT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `keterangan` text DEFAULT NULL,
  `jk` varchar(10) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pendaki`
--

INSERT INTO `tb_pendaki` (`id_pendaki`, `foto`, `nama_pendaki`, `no_identitas`, `alamat`, `keterangan`, `jk`, `status`, `created_at`, `updated_at`) VALUES
(1, 'profile.png', 'Rival Zulkarnaen', '320123301210001', 'Sukabumi', 'KTP', 'L', 1, '2021-02-07 08:31:46', NULL),
(2, 'profile.png', 'Hibatul Wafi', '320123301210001', 'Sukabumi', 'sim', 'L', 1, '2021-02-11 14:20:14', NULL),
(3, 'profile.png', 'aam', '21201020', 'sukabmi', 'KTP', 'L', 1, '2021-04-16 08:32:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendakian`
--

CREATE TABLE `tb_pendakian` (
  `id_pendakian` bigint(20) NOT NULL,
  `id_pendaki` bigint(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pendakian` date NOT NULL,
  `status_naik` int(2) NOT NULL DEFAULT 0,
  `status_turun` int(2) NOT NULL DEFAULT 0,
  `status_izin` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pendakian`
--

INSERT INTO `tb_pendakian` (`id_pendakian`, `id_pendaki`, `jumlah`, `tanggal_pendakian`, `status_naik`, `status_turun`, `status_izin`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2021-02-25', 2, 1, 1, '2021-02-18 16:25:57', '2021-04-16 01:10:13'),
(2, 1, 4, '2021-02-27', 0, 0, 2, '2021-02-19 04:09:36', NULL),
(3, 1, 4, '2021-03-19', 2, 1, 1, '2021-03-30 06:55:53', '2021-04-16 01:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendaki_login`
--

CREATE TABLE `tb_pendaki_login` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_pendaki` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pendaki_login`
--

INSERT INTO `tb_pendaki_login` (`id`, `username`, `password`, `remember_token`, `created_at`, `updated_at`, `id_pendaki`) VALUES
(1, 'rival@gmail.com', '$2y$10$BUGrpYoVEp4UJ7KNyUyT8ulDA.yrNg8UE6EyklqIM6WLmWy7MKW9C', '', '2021-02-11 07:45:04', '2021-02-11 07:45:04', 1),
(2, 'wafi@gmail.com', '$2y$10$BUGrpYoVEp4UJ7KNyUyT8ulDA.yrNg8UE6EyklqIM6WLmWy7MKW9C', '', '2021-02-11 14:18:57', '2021-02-11 14:18:57', 2),
(3, 'aam@gmail.com', '$2y$10$gc69Z2R6CSuzHPSGc5dJsu6qwtlfgosr6B.aTOE/GHLUnycKOWrbC', NULL, '2021-04-16 01:32:40', '2021-04-16 08:32:40', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pos`
--

CREATE TABLE `tb_pos` (
  `id_pos` bigint(20) NOT NULL,
  `id_gunung` bigint(20) NOT NULL,
  `id_jalur` bigint(20) NOT NULL,
  `nama_pos` text NOT NULL,
  `mdpl` varchar(50) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pos`
--

INSERT INTO `tb_pos` (`id_pos`, `id_gunung`, `id_jalur`, `nama_pos`, `mdpl`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Pos 1 Selabintana', '1341', 1, '2021-02-08 16:11:27', NULL),
(2, 1, 1, 'Pos 2 Selabintana', '2141', 1, '2021-02-08 16:13:33', NULL),
(3, 1, 2, 'Pos 1 Cibodas', '1102', 1, '2021-02-08 16:13:33', NULL),
(4, 1, 2, 'Pos 2 Cibodas', '1602', 1, '2021-02-08 16:13:54', NULL),
(5, 1, 3, 'Pos 1 Gunung Putri', '1440', 1, '2021-02-08 16:13:54', NULL),
(6, 1, 3, 'Pos 2 Gunung Putri', '1902', 1, '2021-02-08 16:14:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` bigint(20) NOT NULL,
  `id_pendakian` bigint(20) NOT NULL,
  `total_bayar` varchar(255) NOT NULL,
  `status_transaksi` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_pendakian`, `total_bayar`, `status_transaksi`, `created_at`) VALUES
(1, 1, '87000', 1, '2021-02-18 16:25:57'),
(2, 2, '136000', 3, '2021-02-19 04:09:36'),
(3, 3, '116000', 1, '2021-03-30 06:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rival Admin', 'admin@admin.com', 1, NULL, '$2y$10$BUGrpYoVEp4UJ7KNyUyT8ulDA.yrNg8UE6EyklqIM6WLmWy7MKW9C', NULL, '2021-02-06 08:05:59', '2021-02-06 08:05:59'),
(2, 'Tomiko Van', 'user1@example.com', 1, NULL, '$2y$10$9TIxpn/v6KaLE8k8H75BQO1VxkYA5U5fW4os7tgU1B4S/DYulE/h6', NULL, '2021-02-06 08:05:59', '2021-02-06 08:05:59'),
(3, 'Elder Titan', 'user2@example.com', 1, NULL, '$2y$10$2bBv2c8BEZcH.WZdqQxYleVki9e986FtkJA5XzcOOCjWznIpB5Ne2', NULL, '2021-02-06 08:06:00', '2021-02-06 08:06:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_pendaki` (`id_pendaki`);

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_fasilitas` (`id_fasilitas`);

--
-- Indexes for table `tb_fasilitas`
--
ALTER TABLE `tb_fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD KEY `id_gunung` (`id_gunung`);

--
-- Indexes for table `tb_gunung`
--
ALTER TABLE `tb_gunung`
  ADD PRIMARY KEY (`id_gunung`);

--
-- Indexes for table `tb_jalur`
--
ALTER TABLE `tb_jalur`
  ADD PRIMARY KEY (`id_jalur`),
  ADD KEY `id_gunung` (`id_gunung`);

--
-- Indexes for table `tb_pendaki`
--
ALTER TABLE `tb_pendaki`
  ADD PRIMARY KEY (`id_pendaki`);

--
-- Indexes for table `tb_pendakian`
--
ALTER TABLE `tb_pendakian`
  ADD PRIMARY KEY (`id_pendakian`),
  ADD KEY `id_pendaki` (`id_pendaki`);

--
-- Indexes for table `tb_pendaki_login`
--
ALTER TABLE `tb_pendaki_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pendaki` (`id_pendaki`);

--
-- Indexes for table `tb_pos`
--
ALTER TABLE `tb_pos`
  ADD PRIMARY KEY (`id_pos`),
  ADD KEY `id_jalur` (`id_jalur`),
  ADD KEY `id_gunung` (`id_gunung`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pendaki` (`id_pendakian`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id_anggota` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id_detail` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_fasilitas`
--
ALTER TABLE `tb_fasilitas`
  MODIFY `id_fasilitas` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_gunung`
--
ALTER TABLE `tb_gunung`
  MODIFY `id_gunung` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_jalur`
--
ALTER TABLE `tb_jalur`
  MODIFY `id_jalur` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pendaki`
--
ALTER TABLE `tb_pendaki`
  MODIFY `id_pendaki` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_pendakian`
--
ALTER TABLE `tb_pendakian`
  MODIFY `id_pendakian` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pendaki_login`
--
ALTER TABLE `tb_pendaki_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pos`
--
ALTER TABLE `tb_pos`
  MODIFY `id_pos` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
