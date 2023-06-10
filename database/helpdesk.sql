-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2022 at 05:15 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `atm`
--

CREATE TABLE `atm` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_atm` varchar(10) NOT NULL,
  `nama_atm` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `Area` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `atm`
--

INSERT INTO `atm` (`id`, `kode_atm`, `nama_atm`, `alamat`, `Area`, `created_at`, `updated_at`) VALUES
(3, 'ATM-017025', 'BCA CABANG JAKARTA', 'Jakarta Selatan', 'Jakarta Selatan', '2022-06-21 08:41:14', '2022-06-21 08:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_dept` varchar(10) NOT NULL,
  `nama_departemen` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `kode_dept`, `nama_departemen`, `created_at`, `updated_at`) VALUES
(1, 'Dept-23702', 'AUDIT DEPARTEMEN', '2021-05-05 20:14:49', '2021-05-05 20:14:49'),
(2, 'Dept-27914', 'IT CENTER', '2021-05-05 20:14:56', '2021-05-05 20:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_user` varchar(10) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `kode_user`, `nama_lengkap`, `email`, `phone`, `departemen`, `created_at`, `updated_at`) VALUES
(1, 'USR-478346', 'Tugiman Megantara', 'ipanirtiano@gmail.com', '0903 7077 435', 'AUDIT DEPARTEMEN', '2021-05-05 20:06:31', '2021-05-05 20:06:31'),
(2, 'USR-578567', 'Dwi Dzulqhori', 'dwi@gmail.com', '0987094453', 'IT CENTER', '2021-05-07 20:07:28', '2021-05-07 20:07:28'),
(3, 'USR-136679', 'Dede Amelia', 'dede@gmail.com', '09897654', 'AUDIT DEPARTEMEN', '2021-05-07 21:15:05', '2021-05-07 21:15:05'),
(4, 'USR-058345', 'Agusta', 'agus@gmail.com', '089602745844', 'IT CENTER', '2022-06-21 08:47:32', '2022-06-21 08:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kode_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'K-679168', 'HARDWARE', '2021-05-05 20:15:48', '2021-05-05 20:15:48'),
(2, 'K-026235', 'NETWORK', '2021-05-05 20:15:55', '2021-05-05 20:15:55'),
(3, 'K-129125', 'SOFTWARE', '2021-05-05 20:16:01', '2021-05-05 20:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2021-03-27-155129', 'App\\Database\\Migrations\\Users', 'default', 'App', 1620263174, 1),
(2, '2021-03-27-160029', 'App\\Database\\Migrations\\Karyawab', 'default', 'App', 1620263174, 1),
(3, '2021-03-29-150347', 'App\\Database\\Migrations\\Departemen', 'default', 'App', 1620263174, 1),
(4, '2021-04-08-203027', 'App\\Database\\Migrations\\Kategori', 'default', 'App', 1620263174, 1),
(5, '2021-04-08-205538', 'App\\Database\\Migrations\\Ticket', 'default', 'App', 1620263174, 1),
(6, '2021-04-09-222656', 'App\\Database\\Migrations\\Teknisi', 'default', 'App', 1620263175, 1),
(7, '2022-03-12-055928', 'App\\Database\\Migrations\\Atm', 'default', 'App', 1647064869, 2);

-- --------------------------------------------------------

--
-- Table structure for table `teknisi`
--

CREATE TABLE `teknisi` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_tek` varchar(10) NOT NULL,
  `kode_user` varchar(10) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `area_tugas` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teknisi`
--

INSERT INTO `teknisi` (`id`, `kode_tek`, `kode_user`, `kategori`, `area_tugas`, `created_at`, `updated_at`) VALUES
(1, 'TEK-468267', 'USR-578567', 'K-679168', '', '2021-05-07 20:09:33', '2021-05-07 20:09:33'),
(3, 'TEK-178689', 'USR-058345', 'K-679168', 'Jakarta Selatan', '2022-06-21 08:47:46', '2022-06-21 08:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_ticket` varchar(10) NOT NULL,
  `kode_pemesan` varchar(255) NOT NULL,
  `atm` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `tgl_approve_teknisi` varchar(50) NOT NULL,
  `tanggal_proses` varchar(50) NOT NULL,
  `tanggal_solved` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `urgency` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kode_teknisi` varchar(10) NOT NULL,
  `status` varchar(25) NOT NULL,
  `progres` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `kode_ticket`, `kode_pemesan`, `atm`, `tanggal`, `tgl_approve_teknisi`, `tanggal_proses`, `tanggal_solved`, `kategori`, `urgency`, `subject`, `deskripsi`, `kode_teknisi`, `status`, `progres`, `created_at`, `updated_at`) VALUES
(1, 'T-02916724', 'USR-478346', 'BCA CABANG JAKARTA', '2022-06-21 21:17:51', '2022-06-21 21:20:31', '2022-06-21 21:22:28', '2022-06-21 21:22:28', 'HARDWARE', 'mendesak', ' ATM RUSAK', 'bb', 'USR-578567', 'Solved', '100', '2022-06-21 21:18:11', '2022-06-21 21:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_users` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_users`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(1, 'USR-478346', 'ipanirtiano@gmail.com', '$2y$10$eeI0MtCdXJeHAF9HQLnaquzCsUkRPrZLg29glS1CVgno9q4QKw872', 'Admin', '2021-05-05 20:06:32', '2021-05-05 20:06:32'),
(2, 'USR-578567', 'dwi@gmail.com', '$2y$10$Kc3/2oKPRpoDYiKMJ2DCG./Hha98cT/R8aN5iLvuWF6k3tTgHk9dG', 'Teknisi', '2021-05-07 20:07:28', '2021-05-07 20:07:28'),
(3, 'USR-136679', 'dede@gmail.com', '$2y$10$QQdZKHpLgBVEmyBO8GFg5..BUdbjKXrbh7TPfQA5SW2Fxc47/JH9O', 'Respon Handler', '2021-05-07 21:15:06', '2021-05-07 21:15:06'),
(4, 'USR-058345', 'agus@gmail.com', '$2y$10$qocX5jl6Qpbk2ZyZ6RdiMOdXznHC8b49ICnbLO1IlfBwh4uw6c7hu', 'Teknisi', '2022-06-21 08:47:32', '2022-06-21 08:47:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atm`
--
ALTER TABLE `atm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atm`
--
ALTER TABLE `atm`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
