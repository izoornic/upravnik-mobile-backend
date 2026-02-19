-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: s683.loopia.se
-- Generation Time: Feb 09, 2026 at 08:59 PM
-- Server version: 10.11.14-MariaDB-log
-- PHP Version: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skyvortex_com_db_6`
--

-- --------------------------------------------------------

--
-- Table structure for table `fond`
--

CREATE TABLE `fond` (
  `fid` int(11) NOT NULL,
  `naziv` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `garaza`
--

CREATE TABLE `garaza` (
  `gid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `snid` int(11) NOT NULL,
  `gpovrsina` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `izvodi_error_mail_log`
--

CREATE TABLE `izvodi_error_mail_log` (
  `iemlid` int(11) NOT NULL,
  `err_type` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `zid` int(11) NOT NULL,
  `izvod_br` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `izvodi_mail_log`
--

CREATE TABLE `izvodi_mail_log` (
  `imlid` int(11) NOT NULL,
  `last_eml` bigint(20) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `izvodi_nalozi_za_knjizenje`
--

CREATE TABLE `izvodi_nalozi_za_knjizenje` (
  `nid` bigint(20) NOT NULL,
  `iid` int(11) NOT NULL,
  `uplata_isplata` int(11) NOT NULL COMMENT '1-uplata, 0-isplata',
  `broj_naloga` varchar(32) NOT NULL,
  `naziv_nal` varchar(128) NOT NULL,
  `mesto_nal` varchar(64) NOT NULL,
  `opis` varchar(256) NOT NULL,
  `racun_nal` varchar(32) NOT NULL,
  `osnov` int(11) NOT NULL,
  `iznos` decimal(13,2) NOT NULL,
  `model` varchar(4) NOT NULL,
  `poziv` varchar(16) NOT NULL,
  `rasknjizen` int(11) NOT NULL COMMENT '0-ne 1-da'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `izvodi_za_knjizenje`
--

CREATE TABLE `izvodi_za_knjizenje` (
  `iid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `file_name` varchar(64) NOT NULL,
  `racun` varchar(32) NOT NULL,
  `izvod_br` int(11) NOT NULL,
  `datum` date NOT NULL,
  `naziv_ucesnika` varchar(256) NOT NULL,
  `stanje_predhodno` decimal(13,2) NOT NULL,
  `dug_promet` decimal(13,2) NOT NULL,
  `potraznja_promet` decimal(13,2) NOT NULL,
  `stanja_novo` decimal(13,2) NOT NULL,
  `broj_naloga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mesec`
--

CREATE TABLE `mesec` (
  `mid` int(11) NOT NULL,
  `mnid` int(11) NOT NULL,
  `y_no` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mesec_naziv`
--

CREATE TABLE `mesec_naziv` (
  `mnid` int(11) NOT NULL,
  `naziv` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mesec_zgrada_zaduzenje`
--

CREATE TABLE `mesec_zgrada_zaduzenje` (
  `mzzid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `vzid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `mzio` int(11) NOT NULL,
  `naplata_po` int(11) NOT NULL COMMENT 'm2=1 fix=2',
  `iznos` decimal(13,2) NOT NULL,
  `zaduzenje_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `racun_email_send`
--

CREATE TABLE `racun_email_send` (
  `resid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `error` text DEFAULT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `racun_komentar`
--

CREATE TABLE `racun_komentar` (
  `rkid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `dug_related` int(11) NOT NULL COMMENT '0-ne, 1-da',
  `ktext` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `stan`
--

CREATE TABLE `stan` (
  `sid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `spb` int(11) NOT NULL,
  `stanbr` varchar(16) NOT NULL,
  `snid` int(11) NOT NULL DEFAULT 1,
  `vlasnistvo` tinyint(4) NOT NULL DEFAULT 100,
  `sprat` int(11) NOT NULL,
  `tel_stan` varchar(16) NOT NULL,
  `povrsina` decimal(7,2) NOT NULL,
  `grz` int(11) NOT NULL DEFAULT 0,
  `dodatno` text NOT NULL,
  `newkey` bigint(8) UNSIGNED ZEROFILL NOT NULL,
  `stan_df1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `stanar`
--

CREATE TABLE `stanar` (
  `stid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `sssid` int(11) NOT NULL DEFAULT 1,
  `sactive` int(11) NOT NULL DEFAULT 1,
  `sime` varchar(32) NOT NULL,
  `sprezime` varchar(32) NOT NULL,
  `stel` varchar(16) NOT NULL,
  `sukucana_br` tinyint(4) NOT NULL,
  `sosnov` varchar(32) NOT NULL,
  `sadresa` varchar(256) NOT NULL,
  `szip` varchar(8) NOT NULL,
  `ssediste` varchar(32) NOT NULL,
  `smb` varchar(16) NOT NULL,
  `spib` varchar(16) NOT NULL,
  `str` varchar(32) NOT NULL,
  `skomentar` text NOT NULL,
  `spocetak` date NOT NULL,
  `skraj` date DEFAULT NULL,
  `sdf1` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `stanar_status`
--

CREATE TABLE `stanar_status` (
  `ssid` int(11) NOT NULL,
  `opis` varchar(64) NOT NULL,
  `display` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `stan_mesec_zaduzenje`
--

CREATE TABLE `stan_mesec_zaduzenje` (
  `smzid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `vzid` int(11) NOT NULL,
  `gid` int(11) NOT NULL DEFAULT 0,
  `iznos` decimal(13,2) NOT NULL,
  `r_date` date DEFAULT NULL,
  `r_iznos` decimal(13,2) NOT NULL DEFAULT 0.00,
  `stari_dug` int(1) NOT NULL DEFAULT 0,
  `preknjizen` int(11) NOT NULL DEFAULT 0,
  `hash` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `stan_mesec_zaduzenje_preknjizen`
--

CREATE TABLE `stan_mesec_zaduzenje_preknjizen` (
  `smzpid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `r_date` date DEFAULT NULL,
  `r_iznos` decimal(13,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `stan_namena`
--

CREATE TABLE `stan_namena` (
  `snid` int(11) NOT NULL,
  `naziv` varchar(32) NOT NULL,
  `naziv_display` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `upravnik`
--

CREATE TABLE `upravnik` (
  `uid` int(11) NOT NULL,
  `wpid` int(11) NOT NULL,
  `ussname` varchar(32) NOT NULL,
  `role` varchar(16) NOT NULL DEFAULT 'contributor',
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `email` varchar(128) NOT NULL,
  `adresa` varchar(128) NOT NULL,
  `zip` varchar(16) NOT NULL,
  `mesto` varchar(64) NOT NULL,
  `tel` varchar(64) NOT NULL,
  `prof` tinyint(4) NOT NULL,
  `licence` varchar(16) NOT NULL,
  `registration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `upravnik_direktor`
--

CREATE TABLE `upravnik_direktor` (
  `udid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `vlasnik`
--

CREATE TABLE `vlasnik` (
  `vid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `ssid` int(11) NOT NULL DEFAULT 1,
  `active` int(11) NOT NULL DEFAULT 1,
  `ime` varchar(64) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `tel` varchar(16) NOT NULL,
  `ukucana_br` tinyint(4) NOT NULL DEFAULT 1,
  `email` varchar(128) NOT NULL,
  `rac_na_email` int(11) NOT NULL DEFAULT 0 COMMENT '0 - ne salje 1 - salje',
  `rac_se_stampa` int(11) NOT NULL DEFAULT 1,
  `rac_na_viber` int(11) NOT NULL DEFAULT 0,
  `adresa` varchar(256) NOT NULL,
  `zip` varchar(8) NOT NULL,
  `sediste` varchar(32) NOT NULL,
  `mb` varchar(16) NOT NULL,
  `pib` varchar(16) NOT NULL,
  `tr` varchar(32) NOT NULL,
  `komentar` text NOT NULL,
  `pocetak` date NOT NULL,
  `kraj` date DEFAULT NULL,
  `df1` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `vrsta_zaduzenja`
--

CREATE TABLE `vrsta_zaduzenja` (
  `vzid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `io` int(11) NOT NULL DEFAULT 0 COMMENT 'stavka na koju se uplcuje visak',
  `naziv` varchar(128) NOT NULL,
  `naplata_po` int(11) NOT NULL COMMENT 'm2=1 fix=2',
  `zad_za` int(11) NOT NULL DEFAULT 1 COMMENT '1-stan, 2-lokal, 3-garaza, 4-ostava',
  `rate` int(11) NOT NULL DEFAULT 1,
  `rate_text` varchar(64) NOT NULL,
  `osnov` varchar(256) NOT NULL,
  `aktivan` int(11) NOT NULL DEFAULT 1,
  `iznos` decimal(13,2) NOT NULL,
  `obrisan` int(11) NOT NULL DEFAULT 1 COMMENT '0=obrsan, 1=aktivan, 3=ne moze da se brise'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `zgrada`
--

CREATE TABLE `zgrada` (
  `zid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `naziv` varchar(128) NOT NULL,
  `adresa` varchar(265) NOT NULL,
  `zip` varchar(8) NOT NULL,
  `sediste` varchar(32) NOT NULL,
  `mb` varchar(16) NOT NULL,
  `pib` varchar(16) NOT NULL,
  `tr` varchar(32) NOT NULL,
  `banka` varchar(128) NOT NULL,
  `stanje` enum('analitika','zgrada','poslovanje','') NOT NULL DEFAULT 'analitika',
  `prikazuje_opomene` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Prikazuje opomene u app Stanje',
  `komentar` text NOT NULL,
  `df1` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `df2` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `zgrada_dobavljac`
--

CREATE TABLE `zgrada_dobavljac` (
  `zdid` int(11) NOT NULL,
  `pravno_lice` int(11) NOT NULL DEFAULT 1 COMMENT '1-pravno 0-fizicko',
  `naziv` varchar(256) NOT NULL,
  `adresa` varchar(265) NOT NULL,
  `zip` varchar(8) NOT NULL,
  `sediste` varchar(32) NOT NULL,
  `mb` varchar(16) NOT NULL,
  `pib` varchar(16) NOT NULL,
  `tr` varchar(32) NOT NULL,
  `komentar` text NOT NULL,
  `aktivan` int(11) NOT NULL DEFAULT 1,
  `df1` mediumtext NOT NULL,
  `df2` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `zgrada_opomena`
--

CREATE TABLE `zgrada_opomena` (
  `zoid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `vrsta` int(11) NOT NULL COMMENT '0-novcana. 1-vremenska',
  `rbr` int(11) NOT NULL COMMENT 'redni broj opomene',
  `op_iznos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `zgrada_opomena_text`
--

CREATE TABLE `zgrada_opomena_text` (
  `zotid` int(11) NOT NULL,
  `vrsta` int(11) NOT NULL DEFAULT 0,
  `rbr` int(11) NOT NULL DEFAULT 1,
  `naslov` varchar(128) NOT NULL,
  `text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `zgrada_racun`
--

CREATE TABLE `zgrada_racun` (
  `zrid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `uplata` decimal(13,2) DEFAULT NULL,
  `isplata` decimal(13,2) DEFAULT NULL,
  `datum` date NOT NULL,
  `zdid` int(11) DEFAULT NULL,
  `opis` varchar(128) NOT NULL,
  `opis_l` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Table structure for table `zgrada_racun_pravno_lice_index`
--

CREATE TABLE `zgrada_racun_pravno_lice_index` (
  `zrplid` int(11) NOT NULL,
  `zdid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `brza_lista` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fond`
--
ALTER TABLE `fond`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `garaza`
--
ALTER TABLE `garaza`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `izvodi_error_mail_log`
--
ALTER TABLE `izvodi_error_mail_log`
  ADD PRIMARY KEY (`iemlid`);

--
-- Indexes for table `izvodi_mail_log`
--
ALTER TABLE `izvodi_mail_log`
  ADD PRIMARY KEY (`imlid`);

--
-- Indexes for table `izvodi_nalozi_za_knjizenje`
--
ALTER TABLE `izvodi_nalozi_za_knjizenje`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `izvodi_za_knjizenje`
--
ALTER TABLE `izvodi_za_knjizenje`
  ADD PRIMARY KEY (`iid`);

--
-- Indexes for table `mesec`
--
ALTER TABLE `mesec`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `mesec_naziv`
--
ALTER TABLE `mesec_naziv`
  ADD PRIMARY KEY (`mnid`);

--
-- Indexes for table `mesec_zgrada_zaduzenje`
--
ALTER TABLE `mesec_zgrada_zaduzenje`
  ADD PRIMARY KEY (`mzzid`),
  ADD UNIQUE KEY `mid` (`mid`,`vzid`,`zid`);

--
-- Indexes for table `racun_email_send`
--
ALTER TABLE `racun_email_send`
  ADD UNIQUE KEY `resid` (`resid`);

--
-- Indexes for table `racun_komentar`
--
ALTER TABLE `racun_komentar`
  ADD PRIMARY KEY (`rkid`);

--
-- Indexes for table `stan`
--
ALTER TABLE `stan`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `zid` (`zid`),
  ADD KEY `spb` (`spb`);

--
-- Indexes for table `stanar`
--
ALTER TABLE `stanar`
  ADD PRIMARY KEY (`stid`);

--
-- Indexes for table `stanar_status`
--
ALTER TABLE `stanar_status`
  ADD PRIMARY KEY (`ssid`);

--
-- Indexes for table `stan_mesec_zaduzenje`
--
ALTER TABLE `stan_mesec_zaduzenje`
  ADD PRIMARY KEY (`smzid`);

--
-- Indexes for table `stan_mesec_zaduzenje_preknjizen`
--
ALTER TABLE `stan_mesec_zaduzenje_preknjizen`
  ADD PRIMARY KEY (`smzpid`);

--
-- Indexes for table `stan_namena`
--
ALTER TABLE `stan_namena`
  ADD PRIMARY KEY (`snid`);

--
-- Indexes for table `upravnik`
--
ALTER TABLE `upravnik`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `wpid` (`wpid`);

--
-- Indexes for table `upravnik_direktor`
--
ALTER TABLE `upravnik_direktor`
  ADD UNIQUE KEY `id` (`udid`,`uid`);

--
-- Indexes for table `vlasnik`
--
ALTER TABLE `vlasnik`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `vrsta_zaduzenja`
--
ALTER TABLE `vrsta_zaduzenja`
  ADD PRIMARY KEY (`vzid`);

--
-- Indexes for table `zgrada`
--
ALTER TABLE `zgrada`
  ADD PRIMARY KEY (`zid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `zgrada_dobavljac`
--
ALTER TABLE `zgrada_dobavljac`
  ADD PRIMARY KEY (`zdid`);

--
-- Indexes for table `zgrada_opomena`
--
ALTER TABLE `zgrada_opomena`
  ADD PRIMARY KEY (`zoid`);

--
-- Indexes for table `zgrada_opomena_text`
--
ALTER TABLE `zgrada_opomena_text`
  ADD PRIMARY KEY (`zotid`);

--
-- Indexes for table `zgrada_racun`
--
ALTER TABLE `zgrada_racun`
  ADD PRIMARY KEY (`zrid`);

--
-- Indexes for table `zgrada_racun_pravno_lice_index`
--
ALTER TABLE `zgrada_racun_pravno_lice_index`
  ADD PRIMARY KEY (`zrplid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fond`
--
ALTER TABLE `fond`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `garaza`
--
ALTER TABLE `garaza`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `izvodi_error_mail_log`
--
ALTER TABLE `izvodi_error_mail_log`
  MODIFY `iemlid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `izvodi_mail_log`
--
ALTER TABLE `izvodi_mail_log`
  MODIFY `imlid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `izvodi_nalozi_za_knjizenje`
--
ALTER TABLE `izvodi_nalozi_za_knjizenje`
  MODIFY `nid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `izvodi_za_knjizenje`
--
ALTER TABLE `izvodi_za_knjizenje`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mesec`
--
ALTER TABLE `mesec`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mesec_naziv`
--
ALTER TABLE `mesec_naziv`
  MODIFY `mnid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mesec_zgrada_zaduzenje`
--
ALTER TABLE `mesec_zgrada_zaduzenje`
  MODIFY `mzzid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `racun_email_send`
--
ALTER TABLE `racun_email_send`
  MODIFY `resid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `racun_komentar`
--
ALTER TABLE `racun_komentar`
  MODIFY `rkid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stan`
--
ALTER TABLE `stan`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stanar`
--
ALTER TABLE `stanar`
  MODIFY `stid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stanar_status`
--
ALTER TABLE `stanar_status`
  MODIFY `ssid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stan_mesec_zaduzenje`
--
ALTER TABLE `stan_mesec_zaduzenje`
  MODIFY `smzid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stan_mesec_zaduzenje_preknjizen`
--
ALTER TABLE `stan_mesec_zaduzenje_preknjizen`
  MODIFY `smzpid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stan_namena`
--
ALTER TABLE `stan_namena`
  MODIFY `snid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upravnik`
--
ALTER TABLE `upravnik`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vlasnik`
--
ALTER TABLE `vlasnik`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vrsta_zaduzenja`
--
ALTER TABLE `vrsta_zaduzenja`
  MODIFY `vzid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zgrada`
--
ALTER TABLE `zgrada`
  MODIFY `zid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zgrada_dobavljac`
--
ALTER TABLE `zgrada_dobavljac`
  MODIFY `zdid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zgrada_opomena`
--
ALTER TABLE `zgrada_opomena`
  MODIFY `zoid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zgrada_opomena_text`
--
ALTER TABLE `zgrada_opomena_text`
  MODIFY `zotid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zgrada_racun`
--
ALTER TABLE `zgrada_racun`
  MODIFY `zrid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zgrada_racun_pravno_lice_index`
--
ALTER TABLE `zgrada_racun_pravno_lice_index`
  MODIFY `zrplid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
