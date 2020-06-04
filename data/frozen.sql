-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2020 pada 07.28
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `frozen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_barang`
--

CREATE TABLE `tabel_barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(500) NOT NULL,
  `harga_barang` varchar(10) NOT NULL,
  `jenis_barang` varchar(15) NOT NULL,
  `stock_barang` varchar(200) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_barang`
--

INSERT INTO `tabel_barang` (`id`, `nama_barang`, `harga_barang`, `jenis_barang`, `stock_barang`, `gambar`) VALUES
(10, 'okey nugget bola', '20000', '2', '17', '5ed082f395b84.jpg'),
(11, 'cham burger', '18000', '4', '16', '5ed1b71ac38b6.jpg'),
(12, 'champ sosis sapi', '33000', '1', '23', '5ed1b79885ee2.jpg'),
(13, 'champ sosis ayam 1 kg', '35000', '1', '6', '5ed1b9163631c.jpg'),
(14, 'champ chicken nugget ABC 500g', '35000', '2', '8', '5ed1b9abed7f9.jpg'),
(15, 'champ chicken nugget ', '45000', '2', '19', '5ed1bb1b45956.jpg'),
(16, 'vitalia burger 250g', '15000', '4', '8', '5ed39c88920db.jpg'),
(17, 'minaku kaki naga', '20000', '2', '6', '5ed5c615207c3.jpg'),
(18, 'belfoods chicken stick', '15000', '2', '24', '5ed5c86dcb4c3.jpg'),
(19, 'so eco ayam nugget', '22000', '2', '33', '5ed5c8aa63db7.jpg'),
(20, 'fiesta chicken nugget', '25000', '2', '4', '5ed64e9239b12.jpg'),
(21, 'nugget 808 angka', '15000', '2', '4', '5ed64f465b790.jpg'),
(22, 'nugget ngetop 500g', '20000', '2', '6', '5ed64f9d48a66.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_jenis_barang`
--

CREATE TABLE `tabel_jenis_barang` (
  `id` int(11) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_jenis_barang`
--

INSERT INTO `tabel_jenis_barang` (`id`, `jenis_barang`) VALUES
(1, 'sosis'),
(2, 'nugget'),
(3, 'glaze'),
(4, 'burger'),
(5, 'kentang'),
(6, 'mayones'),
(7, 'saus'),
(8, 'keju');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tabel_barang`
--
ALTER TABLE `tabel_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tabel_jenis_barang`
--
ALTER TABLE `tabel_jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tabel_barang`
--
ALTER TABLE `tabel_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tabel_jenis_barang`
--
ALTER TABLE `tabel_jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
