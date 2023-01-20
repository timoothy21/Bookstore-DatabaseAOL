-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 20, 2023 at 02:59 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id_buku` int(11) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `halaman` int(11) NOT NULL,
  `price` double NOT NULL,
  `tahun_terbit` date NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id_buku`, `isbn`, `judul`, `name`, `penerbit`, `genre`, `address`, `halaman`, `price`, `tahun_terbit`, `stok`) VALUES
(13, '9786020648712', 'Kita Pernah Saling Mencinta', 'Felix K. Nesi', 'Gramedia Pustaka Utama', 'Love', 'Jl Bandung Adem', 116, 63000, '2021-03-01', 10),
(14, '9786020523316', 'Melangkah', 'Js. Khairen', 'Gramedia Widiasarana Indonesia', 'Love', 'Jl Garuda 1', 368, 93000, '2020-03-22', 7),
(15, '9786024246952', 'Laut Bercerita', 'Leila S. Chudori', 'Kepustakaan Populer Gramedia', 'Love', 'jalan cibadak', 394, 125000, '2017-10-25', 12),
(17, '9786020333519', 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', 'Gramedia Pustaka Utama', 'Self Improvement', 'Jalan Pasir Kaliki', 256, 68000, '2016-07-31', 20),
(18, '9786020633176', 'Atomic Habits: Perubahan Kecil yang Memberikan Hasil Luar Biasa', 'James Clear', 'Gramedia Pustaka Utama', 'Self Improvement', 'Jl Indonesia No. 76', 356, 81000, '2019-09-19', 8),
(26, '9786239726324', 'Dear My Time', 'Diyan Yulianto', 'Marda Media', 'Self Improvement', 'Jl. Merdeka No. 142', 148, 59000, '2023-01-18', 23),
(27, '9786020521169', 'Lima CM', 'Donny Dhirgantoro', 'Gramedia Widiasarana Indonesia', 'Sastra', 'Jl. Merdeka No. 142', 382, 72000, '2019-07-28', 37),
(28, '9789797946272', 'Skenario Ruang Waktu', 'Ikrom Mustofa', 'Media Kita', 'Sastra', 'Mekarwangi 107', 148, 62000, '2021-04-27', 50),
(29, '9786020655598', 'Good Mining Practice Di Indonesia', 'Irwandy Arif', 'Gramedia Pustaka Utama', 'Science', 'Jl. Kaveleri Utara 10A', 440, 144000, '2021-09-07', 31),
(30, '9786020294285', 'Contemporary Romance: Played by The Billionaire', 'Alexia Adams', 'Elex Media Komputindo', 'Love', 'Kopo Permai 215', 289, 104000, '2016-10-26', 47),
(31, '9786230033742', 'Where The Crawdads Sing', 'Delia Owens', 'Elex Media Komputindo', 'Love', 'Jl. Jakarta Blok F3', 380, 100000, '2022-08-02', 44),
(32, '9786020000000', 'You Do You: Discovering Life through Experiments Self Awareness', 'Fellexandro Ruby', 'Gramedia Widiasarana Indonesia', 'Self Improvement', 'Taman Citra Permai 18', 252, 96000, '2020-12-25', 60),
(33, '9786020454153', 'Salt to the Sea', 'Ruta Sepetys', 'Elex Media Komputindo', 'Fiction', 'Jl. Jakarta Blok F 62', 384, 66000, '2023-01-06', 44),
(34, '9786026931306', 'Setetes Ilmu Regresi Linier', 'Joko Ade Nusriyono', 'Media Nusa Creative', 'Education', 'Taman Kopo Permai C', 267, 66000, '2016-07-26', 52),
(35, '9786230027024', 'Personal Branding Bisa Mengubah Takdir', 'Tom Liwafa', 'Elex Media Komputindo', 'Education', 'Muara Indah 18', 184, 64000, '2021-12-14', 70),
(36, '9786020662602', 'Future Stories: Kisah Masa Depan', 'David Christian', 'Gramedia Widiasarana Indonesia', 'Science', 'Jl. Soekarno Hatta 29H', 336, 103000, '2022-10-02', 55),
(37, '9786237191049', 'Anjana', 'Kedai Horor', 'Moka Media', 'Horor', 'Kasuari Barat 18', 296, 75000, '2019-10-10', 48),
(38, '9786022204077', 'Get On The Gouws', 'Renita Nozaria', 'Bukune', 'Fantasi', 'Terusan Simpang Lima No. 145', 380, 110000, '2021-07-05', 27),
(39, '9786026940148', 'Dear Nathan', 'Erisca Febriani', 'Best Media', 'Love', 'Flora Anggrek 51C', 528, 99000, '2017-11-20', 9),
(40, '9786020333519', 'Rich Dads Increase Your Financial IQ', 'Robert T. Kiyosaki', 'Gramedia Widiasarana Indonesia', 'Education', 'Mulia Fantasi 54', 256, 68000, '2016-07-31', 42),
(41, '9786230021831', 'Wingit', 'Sara Wijayanto', 'Elex Media Komputindo', 'Horor', 'Jl. Ibrahim Adjie 202', 256, 75000, '2020-12-15', 12),
(42, '9786020313825', 'Hidup', 'Yu Hua', 'Gramedia Widiasarana Indonesia', 'Self Improvement', 'Grogol Selatan D', 224, 63000, '2020-04-12', 20),
(43, '9786025921216', 'Apology', 'Malati', 'Aria Media Mandiri', 'Fiction', 'Jl. Teluk Balian 45', 200, 59000, '2019-08-09', 34),
(44, '9786026195401', 'Retrace', 'Ashara', 'Kosa Media Utama', 'Fiction', 'Jl. Teluk Balian 45', 252, 72000, '2017-08-17', 18),
(45, '9789794031605', 'Kamus Jerman Indonesia', 'Adolf Heuken', 'Gramedia Widiasarana Indonesia', 'Education', 'Jl. Kejaksaan 1', 708, 170000, '2006-12-31', 103),
(46, '9786230010071', 'The Paper Magician', 'Charlie N Holmberg', 'Elex Media Komputindo', 'Fantasy', 'Jl. Jend Ahman Yani 221', 236, 70000, '2019-11-24', 75),
(47, '9786024412715', 'Kitalah yang Ada di Sini Sekarang', 'Jostein Gaarder', 'Mizan Publishing', 'Fiction', 'Persada Kajuruan 80', 240, 79000, '2022-04-07', 44),
(48, '9786230045622', 'Jangan Main Main dengan Kemasan', 'Nanang Wahyudi', 'Elex Media Komputindo', 'Self Improvement', 'Pustaka Cempaka 71', 104, 90000, '2023-01-19', 12);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_trx` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `name_customer` varchar(255) DEFAULT NULL,
  `date_trx` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id_trx`, `id_user`, `id_buku`, `jumlah`, `name_customer`, `date_trx`) VALUES
(1, 1, 30, 5, 'Pak Khusni', '2023-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$3D70NqEVWl/DuuPZ2lA30uJpZjD6w9a1Om4VGO8VtSRAKhBSaSQCG', '2023-01-20 20:44:31'),
(2, 'timothy', '$2y$10$0DL94U61qd0pAWBCVGAtDOWDB9iRpQR2wmfLIPbiDvq2jlN2oADxO', '2023-01-20 20:45:02'),
(3, 'dimas', '$2y$10$BhXORTBzJdMpruKXOyAI/O8iWfPocdJCtT7tGcg7L.wFt9I3/FiSi', '2023-01-20 20:45:23'),
(4, 'fakhira', '$2y$10$xNZL5HWLDxyLSUQb.59MjekzWEKei0XyTQD.IYj6mmtEK5SSX9ipq', '2023-01-20 20:45:41'),
(5, 'matthew', '$2y$10$H8SBo83FX4qtYiUxhkI4veFxlDljfmwmwu5iD/JacIh7zv/ynqf/m', '2023-01-20 20:45:53'),
(6, 'novel', '$2y$10$nE2c3Edl9GY6/azO92trT.eWKndBw9NVEQpvnYWpu3VgbkoaSc4.e', '2023-01-20 20:46:04'),
(7, 'syauqi', '$2y$10$oRyqD8vQNFEBvKq6UTViWeLti1uMF2/7CxQXsh4mN0Ivy7QgmLNua', '2023-01-20 20:46:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_trx`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_trx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
