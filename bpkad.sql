-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Sep 2023 pada 07.09
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpkad`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang`
--

CREATE TABLE `bidang` (
  `no` int(11) NOT NULL,
  `nama_bidang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bidang`
--

INSERT INTO `bidang` (`no`, `nama_bidang`) VALUES
(10, 'Admin'),
(11, 'Sekretariat'),
(12, 'Kepala BPKAD'),
(13, 'Umum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `no` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`no`, `nama_jabatan`) VALUES
(9, 'Admin'),
(10, 'Sekretaris'),
(15, 'Kepala BPKAD'),
(17, 'Kasubag/Kasi'),
(18, 'Kabid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prihal`
--

CREATE TABLE `prihal` (
  `no` int(11) NOT NULL,
  `prihal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_disposisinya`
--

CREATE TABLE `tb_disposisinya` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `st` int(11) NOT NULL,
  `cek` int(11) NOT NULL,
  `nama_surat` varchar(255) DEFAULT NULL,
  `instansi` varchar(255) DEFAULT NULL,
  `no_agenda` varchar(50) DEFAULT NULL,
  `tanggal_surat` text DEFAULT NULL,
  `tanggal_diterima` text DEFAULT NULL,
  `prihal` varchar(50) DEFAULT NULL,
  `lampiran` int(11) DEFAULT NULL,
  `sifat` varchar(50) DEFAULT NULL,
  `berkas` varchar(2000) DEFAULT NULL,
  `tindak_lanjut` varchar(255) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `bidang` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_ajuan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kepala`
--

CREATE TABLE `tb_kepala` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(255) DEFAULT NULL,
  `nama_surat` varchar(255) DEFAULT NULL,
  `instansi` varchar(255) DEFAULT NULL,
  `no_agenda` varchar(255) DEFAULT NULL,
  `tanggal_surat` text DEFAULT NULL,
  `tanggal_diterima` text DEFAULT NULL,
  `prihal` varchar(255) DEFAULT NULL,
  `bidang` varchar(50) NOT NULL,
  `tindak_lanjut` varchar(50) NOT NULL,
  `lampiran` int(11) DEFAULT NULL,
  `sifat` varchar(255) DEFAULT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_ajuan` text DEFAULT NULL,
  `tindakan` varchar(255) DEFAULT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_konfirmasi`
--

CREATE TABLE `tb_konfirmasi` (
  `id` int(11) NOT NULL,
  `no_agenda` varchar(50) DEFAULT NULL,
  `sifat` varchar(50) DEFAULT NULL,
  `tanggal_diterima` text DEFAULT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `instansi` varchar(100) DEFAULT NULL,
  `prihal` varchar(50) DEFAULT NULL,
  `tanggal_surat` text DEFAULT NULL,
  `lampiran` int(11) DEFAULT NULL,
  `bidang` varchar(50) NOT NULL,
  `tindak_lanjut` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `berkas` varchar(100) DEFAULT NULL,
  `tanggal_ajuan` text DEFAULT NULL,
  `tindakan` varchar(50) DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lampiran`
--

CREATE TABLE `tb_lampiran` (
  `no` int(11) NOT NULL,
  `lampiran` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_lampiran`
--

INSERT INTO `tb_lampiran` (`no`, `lampiran`) VALUES
(53, 1),
(56, 2),
(57, 3),
(58, 4),
(59, 5),
(60, 6),
(61, 7),
(62, 8),
(63, 9),
(64, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_serketaris`
--

CREATE TABLE `tb_serketaris` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(255) DEFAULT NULL,
  `nama_surat` varchar(255) DEFAULT NULL,
  `instansi` varchar(255) DEFAULT NULL,
  `no_agenda` varchar(50) DEFAULT NULL,
  `tanggal_surat` text DEFAULT NULL,
  `tanggal_diterima` text DEFAULT NULL,
  `prihal` varchar(50) DEFAULT NULL,
  `lampiran` int(11) DEFAULT NULL,
  `sifat` varchar(50) DEFAULT NULL,
  `berkas` varchar(2000) DEFAULT NULL,
  `tindak_lanjut` varchar(255) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `bidang` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_ajuan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sifat`
--

CREATE TABLE `tb_sifat` (
  `no` int(11) NOT NULL,
  `sifat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_sifat`
--

INSERT INTO `tb_sifat` (`no`, `sifat`) VALUES
(2, 'Biasa'),
(3, 'Penting'),
(4, 'Istimewa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tsk`
--

CREATE TABLE `tb_tsk` (
  `id_tsk` int(11) NOT NULL,
  `no_surat` varchar(25) NOT NULL,
  `nama_surat` varchar(250) NOT NULL,
  `no_agenda` varchar(50) NOT NULL,
  `instansi` varchar(225) NOT NULL,
  `tanggal_surat` text NOT NULL,
  `tanggal_keluar` text NOT NULL,
  `prihal` varchar(50) NOT NULL,
  `lampiran` int(11) NOT NULL,
  `sifat` varchar(50) NOT NULL,
  `title` varchar(250) NOT NULL,
  `size` int(11) NOT NULL,
  `ekstensi` varchar(25) NOT NULL,
  `berkas` varchar(2000) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tsm`
--

CREATE TABLE `tb_tsm` (
  `id_tsm` int(11) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `nama_surat` varchar(250) NOT NULL,
  `no_agenda` varchar(50) NOT NULL,
  `prihal` varchar(50) NOT NULL,
  `sifat` varchar(50) NOT NULL,
  `instansi` varchar(225) NOT NULL,
  `lampiran` int(11) NOT NULL,
  `tanggal_surat` text NOT NULL,
  `tanggal_diterima` text NOT NULL,
  `title` varchar(250) NOT NULL,
  `size` int(11) NOT NULL,
  `ekstensi` varchar(25) NOT NULL,
  `berkas` varchar(2000) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `pass` text NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `bidang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`idUser`, `nip`, `nama`, `pass`, `no_tlp`, `email`, `jabatan`, `bidang`) VALUES
(5, '123', 'Ertansyah rizal ', '$2y$10$zqCjwHTx1BkBqREDhhw9F.bn3TKwxKYWozZvOjVCq0dcfLVqv1Efm', '083102066000', '2006008@itg.ac.id', 'Kabid', 'Umum'),
(1, '2006008', 'Ertansyah rizal ', '$2y$10$1aU9MiW6ZjNO2YBVs4LBAOClXeQ4vQYNuchCWjlXjiMlvG4tp3HOq', '083102066000', '2006008@itg.ac.id', 'Admin', 'Admin'),
(2, '2006017', 'Yari ardiyansyah', '$2y$10$OVLBtETCEW19/4F85LXoMuwjZQtUAJ7xsS055/tCX6rpQ5JUaqASG', '083102066000', '2006008@itg.ac.id', 'Sekretaris', 'Sekretariat'),
(3, '2006028', 'Asri Nurjati R', '$2y$10$pcIBS6wPA440NtzAZH1weOQvhFuqdi6oD2EpwLOuZC8VF0RGvFm3C', '083102066000', '2006008@itg.ac.id', 'Kasubag/Kasi', 'Umum'),
(4, '2006149', 'Nabila Aprilia Ramdhani', '$2y$10$vEqf/Qc/1xxQCj7.FR3aI.W8BfdpPW9/j5zWdAfvr/CCv3nLt0j0O', '083102066000', '2006008@itg.ac.id', 'Kepala BPKAD', 'Kepala BPKAD');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `prihal`
--
ALTER TABLE `prihal`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tb_disposisinya`
--
ALTER TABLE `tb_disposisinya`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kepala`
--
ALTER TABLE `tb_kepala`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_lampiran`
--
ALTER TABLE `tb_lampiran`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tb_serketaris`
--
ALTER TABLE `tb_serketaris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_sifat`
--
ALTER TABLE `tb_sifat`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tb_tsk`
--
ALTER TABLE `tb_tsk`
  ADD PRIMARY KEY (`id_tsk`);

--
-- Indeks untuk tabel `tb_tsm`
--
ALTER TABLE `tb_tsm`
  ADD PRIMARY KEY (`id_tsm`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `xID` (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bidang`
--
ALTER TABLE `bidang`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `prihal`
--
ALTER TABLE `prihal`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_disposisinya`
--
ALTER TABLE `tb_disposisinya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `tb_kepala`
--
ALTER TABLE `tb_kepala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `tb_lampiran`
--
ALTER TABLE `tb_lampiran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `tb_serketaris`
--
ALTER TABLE `tb_serketaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_sifat`
--
ALTER TABLE `tb_sifat`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_tsk`
--
ALTER TABLE `tb_tsk`
  MODIFY `id_tsk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_tsm`
--
ALTER TABLE `tb_tsm`
  MODIFY `id_tsm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
