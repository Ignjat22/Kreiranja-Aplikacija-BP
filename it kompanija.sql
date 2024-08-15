-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 14, 2024 at 10:23 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it_kompanija`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(50) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `datum_kreiranja` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `korisnicko_ime`, `lozinka`, `email`, `datum_kreiranja`) VALUES
(2, 'admin', '$2y$10$2mnqMsbAZRYz3fEH3dfMze9f1CRvu8L8T.KFpPBJAC/tEXORr06h6', 'admin@admin.com', '2024-08-14 10:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `poruke`
--

CREATE TABLE `poruke` (
  `id` int(11) NOT NULL,
  `korisnik` varchar(255) NOT NULL,
  `kartica_id` int(11) NOT NULL,
  `poruka` text NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poruke`
--

INSERT INTO `poruke` (`id`, `korisnik`, `kartica_id`, `poruka`, `datum`) VALUES
(2, 'admin', 1, 'asdasd', '2024-08-14 10:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `projekti`
--

CREATE TABLE `projekti` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `datum_pocetka` date DEFAULT NULL,
  `datum_zavrsetka` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projekti`
--

INSERT INTO `projekti` (`id`, `naziv`, `opis`, `datum_pocetka`, `datum_zavrsetka`) VALUES
(1, 'Web Aplikacija', 'Web Aplikacija za fitnes i treniranje.', '2024-08-18', '2024-09-29'),
(2, 'Mobile App Development', 'Izrada mobilne aplikacije za Android i iOS platforme.\r\n', '2024-08-30', '2024-09-19'),
(3, 'Web Development Project', ' Razvoj modernog web sajta za klijenta.', '2024-08-11', '2024-10-24');

-- --------------------------------------------------------

--
-- Table structure for table `tehnologije`
--

CREATE TABLE `tehnologije` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tehnologije`
--

INSERT INTO `tehnologije` (`id`, `naziv`, `opis`) VALUES
(1, 'React', ' React je JavaScript biblioteka za izgradnju korisničkih interfejsa. Razvijen je od strane Facebook-a i koristi se za izgradnju jednostraničnih aplikacija.'),
(2, 'Node.js', 'Node.js je JavaScript runtime okruženje koje omogućava izvršavanje JavaScript koda van web pretraživača. Koristi se za izgradnju server-side aplikacija.'),
(3, 'Docker', 'Docker je platforma za kontejnerizaciju koja omogućava kreiranje, implementaciju i pokretanje aplikacija u kontejnerima. Pomaže u izolaciji aplikacija i njihovih zavisnosti.');

-- --------------------------------------------------------

--
-- Table structure for table `zaposleni`
--

CREATE TABLE `zaposleni` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `pozicija` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zaposleni`
--

INSERT INTO `zaposleni` (`id`, `ime`, `prezime`, `pozicija`, `email`) VALUES
(1, 'Novak', 'Djokovic', 'Direktor', 'novak@gmail.com'),
(2, 'Marko', 'Marković', 'Frontend Developer', 'marko.markovic@example.com'),
(3, 'Ana', 'Anić', 'Backend Developer', 'ana.anic@example.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `poruke`
--
ALTER TABLE `poruke`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projekti`
--
ALTER TABLE `projekti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tehnologije`
--
ALTER TABLE `tehnologije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zaposleni`
--
ALTER TABLE `zaposleni`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `poruke`
--
ALTER TABLE `poruke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projekti`
--
ALTER TABLE `projekti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tehnologije`
--
ALTER TABLE `tehnologije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zaposleni`
--
ALTER TABLE `zaposleni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
