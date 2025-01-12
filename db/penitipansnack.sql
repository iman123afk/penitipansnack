-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jan 2025 pada 07.28
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
-- Database: `penitipansnack`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `id` int(11) NOT NULL,
  `pembayaran_id` int(11) NOT NULL,
  `snack_id` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `harga_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`id`, `pembayaran_id`, `snack_id`, `kuantitas`, `harga_satuan`, `harga_total`) VALUES
(1, 6, 22, 5, 3000.00, 15000.00),
(2, 7, 27, 5, 2000.00, 10000.00),
(3, 8, 32, 8, 1500.00, 12000.00),
(4, 9, 22, 10, 3000.00, 30000.00),
(5, 10, 23, 1, 2000.00, 2000.00),
(6, 11, 30, 8, 10000.00, 80000.00),
(7, 12, 25, 12, 3000.00, 36000.00),
(8, 12, 21, 5, 4000.00, 20000.00),
(9, 13, 23, 1, 2000.00, 2000.00),
(10, 15, 32, 1, 1500.00, 1500.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `snack_id` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `snack_id`, `kuantitas`) VALUES
(88, 32, 11),
(89, 26, 10),
(90, 22, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mimin`
--

CREATE TABLE `mimin` (
  `id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mimin`
--

INSERT INTO `mimin` (`id`, `Username`, `Password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `status_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `user_id`, `tanggal_pembayaran`, `subtotal`, `status_pembayaran`) VALUES
(6, 1, '2025-01-11 00:49:03', 15000.00, 'Pending'),
(7, 1, '2025-01-11 00:50:26', 10000.00, 'Pending'),
(8, 1, '2025-01-11 01:46:48', 12000.00, 'Pending'),
(9, 1, '2025-01-11 11:23:15', 30000.00, 'Pending'),
(10, 1, '2025-01-11 11:23:53', 2000.00, 'Pending'),
(11, 1, '2025-01-11 11:43:45', 80000.00, 'Pending'),
(12, 1, '2025-01-11 12:09:08', 56000.00, 'Pending'),
(13, 1, '2025-01-11 12:10:12', 2000.00, 'Pending'),
(15, 1, '2025-01-11 12:12:22', 1500.00, 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `snack`
--

CREATE TABLE `snack` (
  `ID` int(11) NOT NULL,
  `nama_snack` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `snack`
--

INSERT INTO `snack` (`ID`, `nama_snack`, `kategori`, `harga`, `stok`, `gambar`) VALUES
(21, 'Doritos', 'Makanan', '4000', '30', '677f31f4e6618.jpg'),
(22, 'Oreo', 'Makanan', '3000', '5', '677f3829261b6.jpg'),
(23, 'Nabati', 'Makanan', '2000', '23', '677f3cc8bf836.jpg'),
(25, 'Teh Pucuk', 'Minuman', '3000', '26', '677f3e0bed993.jpg'),
(26, 'Teh Rio', 'Makanan', '1000', '23', '677f40e7d064b.jpg'),
(27, 'Better', 'Makanan', '2000', '20', '677f4197aae24.jpg'),
(29, 'Kurma', 'Makanan', '5000', '19', '677f420befd7e.jpg'),
(30, 'Cimory', 'Minuman', '10000', '30', '677f4248a07fd.jpg'),
(32, 'Taro', 'Makanan', '1500', '80', '677fafc84be73.jpg'),
(33, 'PowerF', 'Minuman', '1000', '29', '677fc185c71b3.jpg'),
(34, 'Sagu Keju', 'Makanan', '1000', '45', '6781dc81a3475.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_telephon` varchar(15) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `users_id`, `username`, `password`, `email`, `nomor_telephon`, `jenis_kelamin`, `tanggal_lahir`, `alamat`) VALUES
(8, 8, 'admin', '$2y$10$NQcTqp6sJ1drGss7JKA/ceCUoxlz1DOVxyJx4HtQ3/J5vztBOyQ/y', 'admin123@gmail.com', NULL, NULL, NULL, NULL),
(9, 9, 'reza', '$2y$10$yW9QznwxV1u1svc9TbQ4suSeo2mDIlNZ.QAC5W5zg3zqH6v06sSVm', 'reza12@gmail.com', NULL, NULL, NULL, NULL),
(10, 10, 'user123', '$2y$10$6CT5rFrWylchrdmW/u036u1860H27wwsDKxDbtz4WKqFSxKYz8.li', 'user123@gmail.com', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(8, 'admin', '$2y$10$NQcTqp6sJ1drGss7JKA/ceCUoxlz1DOVxyJx4HtQ3/J5vztBOyQ/y', 'admin123@gmail.com'),
(9, 'reza', '$2y$10$yW9QznwxV1u1svc9TbQ4suSeo2mDIlNZ.QAC5W5zg3zqH6v06sSVm', 'reza12@gmail.com'),
(10, 'user123', '$2y$10$6CT5rFrWylchrdmW/u036u1860H27wwsDKxDbtz4WKqFSxKYz8.li', 'user123@gmail.com');

--
-- Trigger `users`
--
DELIMITER $$
CREATE TRIGGER `after_users_insert` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    INSERT INTO user (users_id, username, password, email)
    VALUES (NEW.id, NEW.username, NEW.password, NEW.email);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_id` (`pembayaran_id`),
  ADD KEY `snack_id` (`snack_id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `snack_id` (`snack_id`);

--
-- Indeks untuk tabel `mimin`
--
ALTER TABLE `mimin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indeks untuk tabel `snack`
--
ALTER TABLE `snack`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT untuk tabel `mimin`
--
ALTER TABLE `mimin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `snack`
--
ALTER TABLE `snack`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD CONSTRAINT `detail_pembayaran_ibfk_1` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pembayaran_ibfk_2` FOREIGN KEY (`snack_id`) REFERENCES `snack` (`ID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`snack_id`) REFERENCES `snack` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
