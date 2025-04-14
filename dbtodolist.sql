-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Apr 2025 pada 15.18
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtodolist`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_list`
--

CREATE TABLE `tb_list` (
  `user_id` int(11) NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `due_date_day` date NOT NULL,
  `due_date_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_list`
--

INSERT INTO `tb_list` (`user_id`, `id`, `task_name`, `category`, `due_date_day`, `due_date_time`, `created_at`) VALUES
(0, 119, 'hiho', 'school', '2025-03-07', '19:26:00', '2025-02-27 12:21:56'),
(0, 120, 'adadsa', 'school', '2025-03-06', '12:23:00', '2025-02-27 12:23:03'),
(0, 121, 'xzcz', 'school', '2025-03-06', '19:28:00', '2025-02-27 12:23:37'),
(25, 126, 'tessatu', 'school', '2025-03-19', '10:42:00', '2025-03-01 23:42:54'),
(25, 127, 'tesdua', 'work', '2025-03-03', '06:45:00', '2025-03-01 23:43:07'),
(25, 128, 'testiga', 'personal', '2025-03-27', '11:43:00', '2025-03-01 23:43:25'),
(24, 130, 'Tugas 2', 'school', '2025-04-02', '01:50:00', '2025-03-02 02:50:43'),
(24, 179, 'Tugas 3', 'school', '2025-03-26', '12:27:00', '2025-03-09 05:25:03'),
(26, 200, 'asdvzdccd', 'school', '2025-03-27', '08:35:00', '2025-03-10 01:33:00'),
(27, 201, 'birthday party', 'personal', '2025-10-03', '08:57:00', '2025-03-10 01:56:16'),
(37, 205, 'demo notifikasi', 'school', '2025-03-20', '19:06:00', '2025-03-20 11:54:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_signup`
--

CREATE TABLE `tb_signup` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_signup`
--

INSERT INTO `tb_signup` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(28, 'akun1', 'tes@gmail.com', '$2y$10$BJvpKOJd3ui1ylACFGAhruYFLUfCL9rD79phrFp0nuwgnn2m8pK/u', '2025-03-11 15:44:44'),
(29, 'akun2', 'tes2@gmail.com', '$2y$10$dCl21IGRmdpt.9oavCA5OO6TaBwXPwlMRrbq03YJLQ.n3E0fqeuVq', '2025-03-11 15:45:06'),
(30, 'akun3', 'tes3@gmail.com', '$2y$10$8/Xn8x2/25hRTtyuSrFcQuCXbYc47XAsZGqd5mnWkoSAheOcKaOd2', '2025-03-11 15:45:20'),
(31, 'akun4', 'tes4@gmail.com', '$2y$10$956U6TvEQTTs48nxc4do5e9i71G0NM9AiVaxCQt.iLM8p7IceaB8.', '2025-03-11 15:45:38'),
(32, 'akun5', 'tes5@gmail.com', '$2y$10$xAY1BZC/QELD0H7fjd6SAu3zH4whgEddlkxTyGZ4.gtf5Z/i/fFQO', '2025-03-11 15:45:52'),
(35, 'tesakun1', 'demo@gmail.com', '$2y$10$JSMEGbQpAqGO02UxGBfuye2WXLq9/iN6eT6hrKC1J/vgt8SAkqEcu', '2025-03-12 09:35:01'),
(36, 'demoakun', 'demo1@gmail.com', '$2y$10$EOg87TKCHCXnjmcrZ/LLA.u/5aPw52oTRV5kBHZ.gHNahEog8.ab6', '2025-03-12 09:36:13'),
(37, 'akundemo1', 'demoakun11@gmail.com', '$2y$10$J.9AHcTWg7DtKvzd4S6Pi.L3mlgVkdpnpPNddV935x6WIeUhUEebq', '2025-03-20 11:44:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_list`
--
ALTER TABLE `tb_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_signup`
--
ALTER TABLE `tb_signup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`(50));

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_list`
--
ALTER TABLE `tb_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT untuk tabel `tb_signup`
--
ALTER TABLE `tb_signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
