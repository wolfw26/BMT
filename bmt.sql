-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2023 at 10:08 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_lengkap`, `alamat`, `no_telp`, `email`, `username`, `password`, `pass`) VALUES
(1, 'Mohammad Nur Fawaiq', 'Desa Gajahmati Rt:03 Rw:02 Kec. Pati Kab. Pati Jawa Tengah', '085786447406', 'nurfawaiq@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_ujian`
--

CREATE TABLE `bahan_ujian` (
  `id` int(11) NOT NULL,
  `kode_bahan_ujian` varchar(10) NOT NULL,
  `bahan_ujian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_ujian`
--

INSERT INTO `bahan_ujian` (`id`, `kode_bahan_ujian`, `bahan_ujian`) VALUES
(2, 'A1', 'Tertulis'),
(4, 'A2', 'Wawancara');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_ujian_ajar`
--

CREATE TABLE `bahan_ujian_ajar` (
  `id` int(11) NOT NULL,
  `id_bahan_ujian` int(5) NOT NULL,
  `id_ruang` int(5) NOT NULL,
  `id_penguji` int(5) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id_berkas` int(11) NOT NULL,
  `id_peserta` int(5) NOT NULL,
  `ktp` text NOT NULL,
  `riwayat_hidup` text NOT NULL,
  `vaksin` text NOT NULL,
  `ijazah_terakhir` text NOT NULL,
  `kk` text NOT NULL,
  `status_berkas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id_berkas`, `id_peserta`, `ktp`, `riwayat_hidup`, `vaksin`, `ijazah_terakhir`, `kk`, `status_berkas`) VALUES
(5, 22, '20220522_213714.jpg', 'CV Hatta.jpg', 'SURAT PERMOHONAN INFORMASI.jpeg', 'Ijazah MA.pdf', 'SK PEMBIMBING 18630165-1.jpg', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(6, 25, '20220522_213714.jpg', 'SK PEMBIMBING 18630165-1.jpg', 'lembar persetujuan.pdf', 'Ijazah MA.pdf', 'SK PEMBIMBING 18630165-1.jpg', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(7, 28, '20220522_213714.jpg', 'CV New.jpg', 'Slip Pembayaran.pdf', 'SURAT PERMOHONAN INFORMASI.jpeg', 'Bukti Transfer.pdf', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(8, 26, '20220522_213714.jpg', 'CV New.jpg', 'Surat Pernyataan.pdf', 'Ijazah MA.pdf', 'SURAT PERMOHONAN INFORMASI.jpeg', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(9, 29, '20220522_213714.jpg', 'CV Hatta.jpg', 'Surat Pernyataan.pdf', 'Ijazah MA.pdf', 'SURAT PERMOHONAN INFORMASI.jpeg', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(10, 32, 'KTP.jpg', 'CV New.jpg', 'Bukti Transfer.jfif', 'Ijazah MA.pdf', 'FORMULIR PERMOHONAN INFORMASI.docx', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(11, 31, 'KTP.jpg', 'KTP.jpg', 'KTP.jpg', 'KTP.jpg', 'KTP.jpg', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(12, 27, 'KTP.jpg', 'KTP.jpg', 'KTP.jpg', 'KTP.jpg', 'KTP.jpg', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(13, 30, 'KTP.jpg', 'KTP.jpg', 'KTP.jpg', 'KTP.jpg', 'KTP.jpg', 'Tidak Lulus'),
(14, 33, 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'Tidak Lulus'),
(15, 34, 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'Tidak Lulus'),
(16, 35, 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'Tidak Lulus'),
(17, 36, 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'Tidak Lulus'),
(18, 37, 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'Tidak Lulus'),
(19, 38, 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'Tidak Lulus'),
(20, 39, 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'DRH Baru.jpg', 'Tidak Lulus'),
(21, 59, '20220522_213714.jpg', 'asdasdasd.PNG', '', 'avatar-2 (2).jpg', '', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(22, 58, '1.jpg', '20220522_213714.jpg', '', '20220522_213714.jpg', '', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(23, 57, '20220522_213714.jpg', '20220522_213714.jpg', '', 'CV Hatta.jpg', '', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(24, 53, '20220522_213714.jpg', '20220522_213714.jpg', 'asdasdasd.PNG', '20220522_213714.jpg', '20220522_213714.jpg', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(25, 60, '20220522_213714.jpg', 'asdasdasd.PNG', 'avatar-1.jpg', 'asdasdasd.PNG', '20220522_213714.jpg', 'Pending'),
(26, 61, '20220522_213714.jpg', 'asdasdasd.PNG', 'DRH Baru.jpg', 'KTP.jpg', 'DRH Baru.jpg', 'Lanjut Ke Tes Tertulis dan Wawancara'),
(27, 62, '20220522_213714.jpg', 'asdasdasd.PNG', 'Sertifikat Mubes.jpg', 'lembar persetujuan-1.jpg', 'pic2.jpg', 'Lanjut Ke Tes Tertulis dan Wawancara');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id` int(11) NOT NULL,
  `id_tq` int(4) NOT NULL,
  `id_soal` int(4) NOT NULL,
  `id_peserta` int(4) NOT NULL,
  `jawaban` text NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id`, `id_tq`, `id_soal`, `id_peserta`, `jawaban`, `nilai`) VALUES
(7, 43, 25, 22, 'satu', 10),
(8, 43, 26, 22, 'dua', 20),
(9, 43, 25, 23, 'tiga', 30),
(10, 43, 26, 23, 'empat', 40),
(11, 43, 26, 25, '43524632525', 50),
(12, 43, 25, 25, '536tryertuedh', 50),
(13, 43, 26, 26, 'coba lagi', 50),
(14, 43, 25, 26, 'terus semangat', 40),
(15, 43, 25, 61, '4.000.000', 60),
(16, 43, 26, 61, 'kemampuan saya', 55),
(17, 43, 26, 62, '4.000.000', 75),
(18, 43, 25, 62, 'jiwa raga', 80);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_essay`
--

CREATE TABLE `nilai_essay` (
  `id` int(11) NOT NULL,
  `id_tq` int(5) NOT NULL,
  `id_peserta` int(5) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_essay`
--

INSERT INTO `nilai_essay` (`id`, `id_tq`, `id_peserta`, `nilai`) VALUES
(1, 43, 22, 30),
(2, 43, 23, 70),
(3, 43, 25, 100),
(4, 43, 26, 90),
(5, 43, 61, 115),
(6, 43, 62, 155);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pilgan`
--

CREATE TABLE `nilai_pilgan` (
  `id` int(11) NOT NULL,
  `id_tq` int(4) NOT NULL,
  `id_peserta` int(4) NOT NULL,
  `benar` int(4) NOT NULL,
  `salah` int(4) NOT NULL,
  `tidak_dikerjakan` int(4) NOT NULL,
  `presentase` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelatihan`
--

CREATE TABLE `pelatihan` (
  `id` int(10) NOT NULL,
  `id_peserta` varchar(50) NOT NULL,
  `id_nilai` varchar(50) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelatihan`
--

INSERT INTO `pelatihan` (`id`, `id_peserta`, `id_nilai`, `tgl_mulai`, `tgl_selesai`) VALUES
(1, '20', '10', '2023-08-02', '2023-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `penguji`
--

CREATE TABLE `penguji` (
  `id_penguji` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penguji`
--

INSERT INTO `penguji` (`id_penguji`, `nip`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `no_telp`, `email`, `alamat`, `jabatan`, `foto`, `username`, `password`, `pass`, `status`) VALUES
(8, '873457627467247', 'Nasrullah', 'Paringin', '1994-07-03', 'L', 'Islam', '87857565', 'nasrul23@gmail.com', 'Paringin', 'Penguji', 'foto.png', 'nasrul', '6f76ea47c8facb083934b74117386d47', 'nasrul', 'aktif'),
(16, '1860889602', 'Selvia Annisa', 'Lampihong', '1996-01-03', 'P', 'Islam', '086764762001', 'selvia@gmail.com', 'Jln. A Yani Km. 12 Paringin', 'Staff', 'IMG-20180626-WA0035.jpg', 'selvia', '2c6d8961cb0a1f00677b734462412566', 'selvia', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_nilai` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `n_tertulis` float NOT NULL,
  `n_wawancara` float NOT NULL,
  `n_total` float NOT NULL,
  `grade` varchar(100) NOT NULL,
  `status_nilai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_nilai`, `id_peserta`, `n_tertulis`, `n_wawancara`, `n_total`, `grade`, `status_nilai`) VALUES
(5, 12, 80, 70, 75, 'B', 'Baik - Lolos'),
(6, 14, 80, 70, 75, 'B', 'Baik - Lolos');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `id_ruang` varchar(5) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nik`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `no_telp`, `email`, `alamat`, `id_ruang`, `foto`, `username`, `password`, `pass`, `status`) VALUES
(22, '6311020312970004', 'Hatta Mu min', 'Baruh Panyambaran', '1990-03-12', 'L', 'Islam', '082250203449', 'hattamumin23@gmail.com', 'Jl. Datuk Kandang Haji RT. 01 No .046 Desa Baruh Panyambaran', '6', '', 'hatta', 'bfcd40b6ce329f6192fec1603884ab1d', 'hatta', 'aktif'),
(25, '6311022501550001 ', 'Ahmad Gajali', 'Halong', '1995-11-12', 'L', 'Islam', '085678980990', 'ahmadgajali@gmail.com', 'Jln. Tembok Baru Rt. 01 Halong', '6', '', 'ahmad', '61243c7b9a4022cb3f8dc3106767ed12', 'ahmad', 'aktif'),
(26, '6311020312970005', 'Elly Fitria', 'Binju', '1996-10-02', 'P', 'Islam', '086764762853', 'ellyfitria@gmail.com', 'Jln. Datiuk Kandang Haji Rt.02 Binju', '6', '', 'elly', '53c141d072bef4de5df8cd5c42674883', 'elly', 'aktif'),
(61, '1234567890', 'Mira', 'balangan', '2023-01-30', 'P', 'Islam', '081253301843', 'mira@gmail.com', 'Adhyaksa', '6', '1.jpg', 'mira', 'cf5bdfb40421ac1f30cc4d45b66b5a81', 'mira', 'aktif'),
(62, '1234567890', 'halimah', 'suryakanta', '2023-02-07', 'P', 'Islam', '081253301843', 'halimah@gmail.com', 'Adhyaksa', '9', '1.jpg', 'halimah', 'aebf7e2d1e862f1231903aac4c5331e7', 'halimah', 'aktif'),
(63, '19', 'Fauzi', 'alalak', '0000-00-00', 'L', 'Islam', '081253301843', 'fauzi', 'alalak', '11', '', 'madi', 'madi', 'madi', 'aktif'),
(64, '20', 'Wulan', 'Banjarmasin', '2023-02-01', 'P', 'Islam', '081253301843', 'Wulan@gmail.com', 'Kuin Utara', '8', 'wulan', 'wulan', 'wulan', 'wulan', 'aktif'),
(65, '22', 'Jaya', 'Handil', '2023-02-14', 'L', 'Islam', '081253301843', 'Jaya@gmail.com', 'Liang Anggang', '14', '', 'Jaya', 'jaya', 'jaya', 'aktif'),
(66, '23', 'Kilos', 'Alalak', '0000-00-00', 'P', 'Islam', '081253301843', 'Kilos@gmail.com', 'Alalak', '13', '', 'Kilos', 'kilos', 'kilos', 'aktif'),
(67, '24', 'Nisa', 'Negara', '2023-02-09', 'P', 'Islam', '081253301843', 'Nisa@gmail.com', 'Negara', '12', 'nisa', 'nisa', 'nisa', 'nisa', 'aktif'),
(68, '25', 'Bani', 'Sugara', '2023-02-01', 'P', 'Islam', '083748578637', 'bani@gmail.com', 'sugara', '11', 'sugara', 'bani', 'bani', 'bani', 'aktif'),
(69, '26', 'Julian', 'Banjarmasin', '2023-02-07', 'L', 'Islam', '081253301843', 'Banjarmasin', 'julian@gmail.com', '10', 'julian', 'julian', 'julian', 'julian', 'aktif'),
(70, '27', 'Mulkan', 'Banjarmasin', '0000-00-00', 'L', 'Islam', '08976756788', 'mulkan@gmail.com', 'Alalak', '12', 'mulkan', 'mulkan', 'mulkan', 'mulkan', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(11) NOT NULL,
  `kandidat` varchar(50) NOT NULL,
  `ruangan` varchar(20) NOT NULL,
  `penguji` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `kandidat`, `ruangan`, `penguji`) VALUES
(6, 'HOD', '1', 8),
(8, 'Admin', '2', 16),
(9, 'IT', '3', 17),
(10, 'SPV', '4', 18),
(11, 'Mekanik', '5', 24),
(12, 'Operator', '6', 21),
(13, 'Driver', '7', 19),
(14, 'Fuelman', '8', 22);

-- --------------------------------------------------------

--
-- Table structure for table `ruang_ajar`
--

CREATE TABLE `ruang_ajar` (
  `id` int(11) NOT NULL,
  `id_ruang` int(5) NOT NULL,
  `id_penguji` int(5) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang_ajar`
--

INSERT INTO `ruang_ajar` (`id`, `id_ruang`, `id_penguji`, `keterangan`) VALUES
(6, 6, 8, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `soal_essay`
--

CREATE TABLE `soal_essay` (
  `id_essay` int(11) NOT NULL,
  `id_tq` int(5) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tgl_buat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal_essay`
--

INSERT INTO `soal_essay` (`id_essay`, `id_tq`, `pertanyaan`, `gambar`, `tgl_buat`) VALUES
(23, 38, '123', '', '2022-08-02'),
(25, 43, 'Berapa Gaji Yang kamu inginkan?', '', '2022-08-16'),
(26, 43, 'Apa yang akan kamu berikan kepada perusahaan jika kamu di trima?', '', '2022-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `soal_pilgan`
--

CREATE TABLE `soal_pilgan` (
  `id_pilgan` int(11) NOT NULL,
  `id_tq` int(5) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `pil_a` text NOT NULL,
  `pil_b` text NOT NULL,
  `pil_c` text NOT NULL,
  `pil_d` text NOT NULL,
  `pil_e` text NOT NULL,
  `kunci` varchar(2) NOT NULL,
  `tgl_buat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `topik_ujian`
--

CREATE TABLE `topik_ujian` (
  `id_tq` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `id_ruang` int(5) NOT NULL,
  `id_bahan_ujian` int(5) NOT NULL,
  `tgl_buat` date NOT NULL,
  `pembuat` varchar(10) NOT NULL,
  `waktu_soal` int(8) NOT NULL,
  `info` varchar(250) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topik_ujian`
--

INSERT INTO `topik_ujian` (`id_tq`, `judul`, `id_ruang`, `id_bahan_ujian`, `tgl_buat`, `pembuat`, `waktu_soal`, `info`, `status`) VALUES
(42, '$judul', 0, 0, '0000-00-00', '$pembuat', 0, '$info', ''),
(43, 'Tes Wawancara', 6, 4, '2022-08-16', '8', 3600, 'rtarg', 'aktif'),
(46, 'Tes Tertulis', 8, 0, '2023-01-08', 'admin', 3600, '', 'aktif'),
(48, '1', 9, 2, '2023-02-21', 'admin', 3600, 'sudah/belum', 'aktif'),
(49, 'HOD', 6, 0, '2023-03-08', 'admin', 3600, 'RWWW', 'aktif'),
(50, 'HOD', 9, 2, '2023-08-11', '8', 4200, 'dsdd', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bahan_ujian`
--
ALTER TABLE `bahan_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bahan_ujian_ajar`
--
ALTER TABLE `bahan_ujian_ajar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_essay`
--
ALTER TABLE `nilai_essay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_pilgan`
--
ALTER TABLE `nilai_pilgan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelatihan`
--
ALTER TABLE `pelatihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penguji`
--
ALTER TABLE `penguji`
  ADD PRIMARY KEY (`id_penguji`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `ruang_ajar`
--
ALTER TABLE `ruang_ajar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soal_essay`
--
ALTER TABLE `soal_essay`
  ADD PRIMARY KEY (`id_essay`);

--
-- Indexes for table `soal_pilgan`
--
ALTER TABLE `soal_pilgan`
  ADD PRIMARY KEY (`id_pilgan`);

--
-- Indexes for table `topik_ujian`
--
ALTER TABLE `topik_ujian`
  ADD PRIMARY KEY (`id_tq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bahan_ujian`
--
ALTER TABLE `bahan_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bahan_ujian_ajar`
--
ALTER TABLE `bahan_ujian_ajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `nilai_essay`
--
ALTER TABLE `nilai_essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai_pilgan`
--
ALTER TABLE `nilai_pilgan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelatihan`
--
ALTER TABLE `pelatihan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penguji`
--
ALTER TABLE `penguji`
  MODIFY `id_penguji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ruang_ajar`
--
ALTER TABLE `ruang_ajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `soal_essay`
--
ALTER TABLE `soal_essay`
  MODIFY `id_essay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `soal_pilgan`
--
ALTER TABLE `soal_pilgan`
  MODIFY `id_pilgan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `topik_ujian`
--
ALTER TABLE `topik_ujian`
  MODIFY `id_tq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
