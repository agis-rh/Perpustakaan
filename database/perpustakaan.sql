-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 02. Juni 2014 jam 08:50
-- Versi Server: 5.1.33
-- Versi PHP: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `id_anggota` int(4) NOT NULL AUTO_INCREMENT,
  `no_anggota` varchar(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jk` enum('L','P') NOT NULL DEFAULT 'L',
  `kelas` varchar(20) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `meminjam` int(5) NOT NULL DEFAULT '0',
  `terlambat` int(5) NOT NULL,
  PRIMARY KEY (`id_anggota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `no_anggota`, `nama`, `jk`, `kelas`, `alamat`, `email`, `telpon`, `meminjam`, `terlambat`) VALUES
(2, 'ALS-02', 'Agis Rahma Herdiana', 'L', '43', 'Godabaya', 'agislaksamana@yahoo.com', '0858765432', 4, 1),
(3, 'ALS-03', 'Devin Kurnia', 'L', '43', 'cisalak', 'devin.kurnia@yahoo.com', '08587654543', 3, 0),
(4, 'ALS-04', 'Deti Kurnia', 'P', '40', 'sadawangi', 'kurniadeti18@yahoo.co.id', '085795201856', 1, 0),
(5, 'ALS-05', 'Susan Sukmawati', 'P', '40', 'Cibulakan', 'susansukmawati.8@yahoo.com', '085722934181', 2, 0),
(6, 'ALS-06', 'Wulan Sari', 'P', '40', 'Sadawangi', 'wullan.zhariie@facebook.com', '085721231869', 1, 1),
(7, 'ALS-07', 'Rinrin Okti Misriani', 'P', '40', 'Cipancur', 'ryn.oktimisria2417@gmail.com', '085722387151', 2, 1),
(8, 'ALS-08', 'Dita Permana', 'L', '34', 'Godabaya', 'noe@yahoo.com', '085759775001', 2, 0),
(9, 'ALS-09', 'Ai Yupitasari', 'P', '43', 'Sukadana', 'aiyupitasari@yahoo.com', '085211234075', 0, 0),
(10, 'ALS-10', 'Ali Akbar', 'L', '43', 'Mananti', 'aliakbar@yahoo.com', '085211234064', 1, 0),
(11, 'ALS-11', 'Asep Saepul Milah', 'L', '43', 'Gunung Larang', 'asep_saepul@yahoo.co.id', '085232704064', 0, 0),
(12, 'ALS-12', 'Awan Hermawan', 'L', '43', 'Cipining', 'hermawana@ymail.com', '085734204081', 0, 0),
(13, 'ALS-13', 'Dede Restu Anggi Jaya', 'P', '43', 'Cigobang', 'restu@gmail.com', '085774204481', 1, 0),
(14, 'ALS-14', 'Dian Andriani', 'P', '43', 'Borogojol', 'Dian_andriani@yahoo.co.id', '085754229080', 0, 0),
(15, 'ALS-15', 'Dede Supriadi', 'L', '40', 'Mananti', 'Desu@gmail.com', '085600434080', 0, 0),
(16, 'ALS-16', 'Rio R', 'L', '40', 'Sukajadi', 'Rio_r@yahoo.com', '085873204581', 1, 0),
(17, 'ALS-17', 'Saepul Mukrom', 'L', '40', 'Lemahputih', 'Saepul@gmail.com', '085244234070', 0, 0),
(18, 'ALS-18', 'Rahmat Hidayat', 'L', '40', 'Cisalak', 'Rahmat.H@ymail.com', '085677034060', 1, 0),
(19, 'ALS-19', 'Azis Muslim', 'L', '40', 'Sadawangi', 'azis_muslim@yahoo.com', '085755234004', 1, 0),
(20, 'ALS-20', 'Ardi Tia Permana', 'L', '42', 'Godabaya', 'arditia@gmail.com', '085762204044', 1, 0),
(21, 'ALS-21', 'Asep M.Y', 'L', '42', 'Cigobang', 'asep_my@yahoo.co.id', '085786590074', 1, 0),
(22, 'ALS-22', 'M.Salis', 'L', '42', 'Cipancur', 'salis@gmail.com', '085272110087', 1, 0),
(23, 'ALS-23', 'Ahkam', 'L', '41', 'Sadawangi', 'ahkam@gmail.com', '085744113208', 0, 0),
(24, 'ALS-24', 'Erik', 'L', '41', 'Gunung Seureuh', 'erik@yahoo.com', '085272722487', 0, 0),
(25, 'ALS-25', 'Herman Nurfalah', 'L', '43', 'Malongpong', 'Herman.nurfalah@gmail.com', '085867893407', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `id_buku` int(5) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(5) NOT NULL,
  `id_penerbit` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isbn` varchar(25) NOT NULL,
  `jumlah_buku` int(5) NOT NULL,
  `deskripsi` text NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `jumlah_tempo` int(5) NOT NULL,
  `tgl_masuk` varchar(10) NOT NULL,
  `tahun_terbit` varchar(4) NOT NULL,
  `dipinjam` int(5) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori`, `id_penerbit`, `judul`, `isbn`, `jumlah_buku`, `deskripsi`, `penulis`, `jumlah_tempo`, `tgl_masuk`, `tahun_terbit`, `dipinjam`, `gambar`) VALUES
(7, 31, 32, '50 Hari Menjadi Ilmuwan', '14067', 3, 'Buku ini berisi tentang tips bagaimana menjadi seorang ilmuan yang terkenal. Berisi faktor-faktor apa saja yang menunjang prose belajar anak kita dan juga disertai dengan sejarah biografi ilmuan-ilmuan terkenal dunia.\r\n\r\nDikemas dalam bentuk buku yang menarik karena full color dan full dengan gambar-gambar animasi sehingga membuat anak kita gemar membaca.', 'Muzi', 3, '12-05-2014', '1993', 2, '36cf.jpg'),
(25, 33, 34, 'Pelangi Dirgantara', '629135', 4, 'Buku ini berisi kisah hidup yang inspirasi dan memberi banyak motivasi pada pembacanya', 'CHAPPY', 3, '15-05-2014', '2008', 2, '3sw.jpg'),
(26, 34, 35, 'Substitusi Komponen Speda Motor', '62929', 7, 'Buku ini berisi tentang berbagai komponen yang ada dalam sebuah speda motor', 'Tim', 7, '15-05-2014', '2010', 1, '48mtr.jpg'),
(27, 32, 36, 'Jangan Sebut Aku Bodoh', '37001', 2, 'Buku ini menceritakan seorang anak yang selalu di ejek oleh teman-temannya,namun ia begitu sabar dan tegar menghadapinya.', 'Al.', 2, '15-05-2014', '2004', 1, '87sd.jpg'),
(28, 35, 33, 'Building Bridges With Your Teenagers', '3714', 1, 'Motivasi Hidup', 'Alice', 1, '15-05-2014', '2006', 4, '96df.jpg'),
(29, 36, 36, 'Sang Kecoak', '813301', 3, 'Buku tentang kisah seekor kecoak yang memberi motivasi dan inspiratif', 'Irene', 3, '15-05-2014', '2009', 2, '90Foto Alam.jpg'),
(32, 31, 33, 'The Last Airbender', '351897', 4, 'Bercerita tentang seorang yang mempunya kemampuan ilmu bela diri yang sangat luar bisa', 'Ahmad Darmawan', 4, '23-05-2014', '2014', 2, '59air.jpg'),
(33, 35, 32, 'Magic Is Geting Some Muscle', '976354', 5, 'Keajaiban dari sebuah kekuatan yang ada pada setiap diri manusia', 'Dominic Christoper', 4, '23-05-2014', '2013', 4, '50fairy.jpg'),
(34, 33, 33, 'Laskar Pelangi', '562405', 3, 'Menceritakan seorang anak pemimpi yang memiliki semangat tinggi', 'Andrea dan Riza', 3, '23-05-2014', '2010', 1, '52pemimpi.jpg'),
(35, 39, 34, 'Ichi', '278901', 2, 'Buku yang menceritakan drama korea tentang seorang gadis yang cantik', 'Nakamura ', 2, '23-05-2014', '2009', 0, '25ichi.jpg'),
(36, 33, 36, 'Spy', '3768900', 5, 'Buku action Jacky Chan yang bertempur melawan musuhnya dengan karakter yang lucu', 'Jacky Chan', 5, '23-05-2014', '2008', 3, '38spy.jpg'),
(37, 32, 32, 'The Lightning Thief', '199642', 2, 'Menceritakan seorang pemuda yang mempunyai kemampuan yang hebat dan beda dari yang lainnya', 'Percy Jackson dan Olympians', 2, '23-05-2014', '2013', 1, '91percy.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `grafik`
--

CREATE TABLE IF NOT EXISTS `grafik` (
  `bulan` int(2) NOT NULL,
  `peminjaman` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bulan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `grafik`
--

INSERT INTO `grafik` (`bulan`, `peminjaman`) VALUES
(1, 10),
(2, 9),
(3, 11),
(4, 8),
(5, 18),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(11, 0),
(12, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=40 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `aktif`) VALUES
(34, 'Otomotif', 'Y'),
(33, 'Novel', 'Y'),
(32, 'Komik', 'Y'),
(31, 'Komputer', 'Y'),
(35, 'English Study', 'Y'),
(36, 'Buku Dongeng', 'Y'),
(39, 'Drama', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_kelas`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=46 ;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `aktif`) VALUES
(32, 'X RPL A', 'Y'),
(33, 'X RPL B', 'Y'),
(34, 'X RPL C', 'Y'),
(35, 'X RPL D', 'Y'),
(36, 'X TKR A', 'Y'),
(37, 'X TKR B', 'Y'),
(38, 'X TKR C', 'Y'),
(39, 'X FARMASI', 'Y'),
(40, 'XI RPL A', 'Y'),
(41, 'XI RPL B', 'Y'),
(42, 'XI RPL C', 'Y'),
(43, 'XI RPL D', 'Y'),
(44, 'XI TKR A', 'Y'),
(45, 'XI TKR B', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(5) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `static_content` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('user','admin') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `link_seo` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=65 ;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `static_content`, `gambar`, `publish`, `status`, `aktif`, `urutan`, `link_seo`) VALUES
(2, 'Manajemen Pegawai', '?module=pegawai', '', '', 'N', 'admin', 'Y', 4, ''),
(37, 'Profil', '?module=profil', '<b>Bukulokomedia.com</b> merupakan website resmi dari penerbit Lokomedia yang bermarkas di Jl. Arwana No.24 Minomartani Yogyakarta 55581. Dirintis pertama kali oleh Lukmanul Hakim pada tanggal 14 Maret 2008.<br><br>Produk unggulan dari penerbit Lokomedia adalah buku-buku serta aksesoris bertema PHP (<span style="font-weight: bold; font-style: italic;">PHP: Hypertext Preprocessor</span>) yang merupakan pemrograman Internet paling handal saat ini.\r\n', 'gedungku.jpg', 'N', 'admin', 'N', 8, 'profil-kami.html'),
(10, 'Manajemen Modul', '?module=modul', '', '', 'N', 'admin', 'Y', 6, ''),
(31, 'Kategori', '?module=kategori', '', '', 'Y', 'admin', 'Y', 2, ''),
(36, 'Manajemen Penerbit', '?module=penerbit', '', '', 'Y', 'admin', 'Y', 3, 'semua-download.html'),
(40, 'Manajemen Anggota', '?module=anggota', '', '', 'Y', 'admin', 'Y', 5, 'hubungi-kami.html'),
(42, 'Manajemen Kelas', '?module=kelas', '', '', 'Y', 'admin', 'Y', 7, ''),
(51, 'Statistik User', '-', '', '', 'Y', 'admin', 'N', 22, ''),
(52, 'Pencarian', '-', '', '', 'Y', 'admin', 'N', 23, ''),
(64, 'Buku', '?module=buku', '', '', 'Y', 'admin', 'Y', 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `id_session`, `aktif`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Kepala Perpustakaan', 'admin@detik.com', '085860803101', 'admin', 'N', '79dc4650fb3d6cef2c320c0dd9976990', 1),
('agis', '10c150b123d042a768fa3188e7bd2e1c', 'Agis Rahma Herdiana', 'agislaksamana@yahoo.com', '085860803101', 'user', 'N', '9a53f5d7606f323d03483cd66d4d5df1', 0),
('pegawai', '047aeeb234644b9e2d4138ed3bc7976a', 'Pegawai', 'official@detik.com', '08522222222', 'user', 'N', 'bce6cf10f94c2a466c2ad26ac82685f2', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE IF NOT EXISTS `penerbit` (
  `id_penerbit` int(5) NOT NULL AUTO_INCREMENT,
  `nama_penerbit` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `alamat` text COLLATE latin1_general_ci NOT NULL,
  `email` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_penerbit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=37 ;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`, `email`, `aktif`) VALUES
(32, 'Penerbit Erlangga', 'Jl. H.Baping Raya No.100\r\nCiracas, Jakarta 13740', 'editor@erlangga.net', 'Y'),
(33, 'Grafika Dua Tujuh', 'Jl. Diponegoro No.27B By Pass, Seyegan Rt 01 Rw 06 Karanganom\r\nKlaten Utara,Klaten Jawa Tengah', 'grafika2772@yahoo.co', 'Y'),
(34, 'Buku Kompas', 'Jawa Tengah', 'bukukompas@yahoo.com', 'Y'),
(35, 'PT DUNIA OTOMOTIFINDO', 'Indonesia', 'otomotifindo@yahoo.c', 'Y'),
(36, 'Elex Media Komputindo', 'Indonesia', 'Komputindo@gmail.com', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pinjam`
--

CREATE TABLE IF NOT EXISTS `transaksi_pinjam` (
  `id_transaksi` int(5) NOT NULL AUTO_INCREMENT,
  `kode_pinjam` varchar(10) NOT NULL,
  `id_buku` int(5) NOT NULL,
  `id_anggota` int(4) NOT NULL,
  `kode_buku` varchar(15) NOT NULL,
  `pegawai` varchar(50) NOT NULL,
  `tgl_pinjam` varchar(20) NOT NULL,
  `tgl_kembali` varchar(20) NOT NULL,
  `dikembalikan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data untuk tabel `transaksi_pinjam`
--

INSERT INTO `transaksi_pinjam` (`id_transaksi`, `kode_pinjam`, `id_buku`, `id_anggota`, `kode_buku`, `pegawai`, `tgl_pinjam`, `tgl_kembali`, `dikembalikan`, `status`) VALUES
(20, 'PM-20', 32, 3, 'FG2/CK-005', 'Pegawai', '23-05-2014', '30-05-2014', '26-05-2014', 'Kembali'),
(19, 'PM-19', 7, 7, 'HGT/09-46A', 'Pegawai', '23-05-2014', '30-05-2014', '28-05-2014', 'Kembali'),
(18, 'PM-18', 29, 6, '351.84/REC/A-07', 'Pegawai', '18-05-2014', '25-05-2014', '28-05-2014', 'Kembali'),
(17, 'PM-17', 28, 5, '351.72/VIC/B-00', 'Pegawai', '18-05-2014', '25-05-2014', '19-05-2014', 'Kembali'),
(16, 'PM-16', 25, 2, 'FPG/02/HS', 'Pegawai', '10-05-2014', '17-05-2014', '28-05-2014', 'Kembali'),
(21, 'PM-21', 32, 8, 'DC08/HT-009', 'Pegawai', '23-05-2014', '30-05-2014', '28-05-2014', 'Kembali'),
(22, 'PM-22', 37, 10, '40BG/2.A-SL', 'Pegawai', '24-05-2014', '31-05-2014', '28-05-2014', 'Kembali'),
(23, 'PM-23', 34, 13, 'TE-05FH', 'Pegawai', '26-05-2014', '02-06-2014', '28-05-2014', 'Kembali'),
(24, 'PM-24', 28, 19, 'ZA-05B', 'Pegawai', '26-05-2014', '02-06-2014', '28-05-2014', 'Kembali'),
(25, 'PM-25', 33, 7, 'AR-054.FA', 'Agis', '18-05-2014', '25-05-2014', '28-05-2014', 'Kembali'),
(26, 'PM-26', 36, 18, 'RA7-56-FV', 'Agis', '26-05-2014', '02-06-2014', '28-05-2014', 'Kembali'),
(27, 'PM-27', 33, 16, 'AD-01FA', 'Kepala Perpustakaan', '28-05-2014', '04-06-2014', '28-05-2014', 'Kembali'),
(28, 'PM-28', 36, 20, 'CT-07b', 'Pegawai', '28-05-2014', '04-06-2014', '28-05-2014', 'Kembali'),
(29, 'PM-29', 7, 3, 'DW-08F', 'Kepala Perpustakaan', '28-05-2014', '04-06-2014', '28-05-2014', 'Kembali'),
(30, 'PM-30', 33, 21, 'FG-09J', 'Pegawai', '29-05-2014', '05-06-2014', '29-05-2014', 'Kembali'),
(31, 'PM-31', 25, 2, 'RAF-14T', 'Pegawai', '21-05-2014', '28-05-2014', '', 'Pinjam'),
(32, 'PM-32', 28, 2, 'TF-07G', 'Pegawai', '29-05-2014', '05-06-2014', '29-05-2014', 'Kembali'),
(33, 'PM-33', 36, 22, 'SW-75H', 'Pegawai', '29-05-2014', '12-06-2014', '29-05-2014', 'Kembali'),
(34, 'PM-34', 33, 8, 'RAF-14T', 'Agis Rahma Herdiana', '30-05-2014', '06-06-2014', '', 'Pinjam');
