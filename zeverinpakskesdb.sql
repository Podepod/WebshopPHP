-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 dec 2021 om 13:36
-- Serverversie: 10.4.22-MariaDB
-- PHP-versie: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zeverinpakskesdb`
--
CREATE DATABASE IF NOT EXISTS `zeverinpakskesdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `zeverinpakskesdb`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `adressen`
--

CREATE TABLE `adressen` (
  `adresID` int(11) NOT NULL,
  `straatnaam` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `dorpsnaam` varchar(255) NOT NULL,
  `straatnummer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `adressen`
--

INSERT INTO `adressen` (`adresID`, `straatnaam`, `postcode`, `dorpsnaam`, `straatnummer`) VALUES
(1, 'Jan Pieter de Nayerlaan', '2860', 'Sint-Katelijne-Waver', '5'),
(2, 'Verhaegenstraat', '3220', 'Holsbeek', '20'),
(3, '', '', '', ''),
(4, 'Teststraat', '1234', 'Test-stad', '1A');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `bestellingID` int(11) NOT NULL,
  `klantID` int(11) NOT NULL,
  `bestellingTijd` timestamp NOT NULL DEFAULT current_timestamp(),
  `betaald` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`bestellingID`, `klantID`, `bestellingTijd`, `betaald`) VALUES
(1, 2, '2021-12-26 10:05:04', 1),
(2, 2, '2021-12-26 10:19:06', 1),
(3, 2, '2021-12-26 10:22:13', 1),
(4, 2, '2021-12-26 10:31:46', 1),
(5, 2, '2021-12-26 10:33:26', 1),
(6, 2, '2021-12-26 10:36:25', 1),
(7, 2, '2021-12-26 10:38:03', 1),
(8, 2, '2021-12-26 10:42:33', 1),
(9, 2, '2021-12-26 14:19:29', 1),
(10, 2, '2021-12-29 11:49:49', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingproducten`
--

CREATE TABLE `bestellingproducten` (
  `bestelProductID` int(11) NOT NULL,
  `bestellingID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `hoeveelheid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingproducten`
--

INSERT INTO `bestellingproducten` (`bestelProductID`, `bestellingID`, `productID`, `hoeveelheid`) VALUES
(1, 1, 8, 4),
(2, 1, 7, 8),
(3, 1, 5, 1),
(4, 1, 2, 5),
(5, 2, 7, 4),
(6, 2, 8, 3),
(7, 2, 2, 3),
(8, 3, 7, 11),
(9, 3, 8, 4),
(10, 3, 2, 4),
(11, 4, 8, 15),
(12, 4, 7, 7),
(13, 4, 2, 16),
(14, 5, 7, 26),
(15, 5, 5, 6),
(16, 6, 5, 1),
(17, 7, 5, 5),
(18, 7, 2, 6),
(19, 8, 7, 8),
(20, 8, 8, 14),
(21, 9, 7, 10),
(22, 9, 4, 11),
(23, 10, 2, 3),
(24, 10, 8, 3),
(25, 10, 7, 5),
(26, 10, 5, 1),
(27, 10, 4, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klantID` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `familieNaam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `geboorteDatum` date NOT NULL,
  `registratieTijd` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `verwijderd` tinyint(1) NOT NULL DEFAULT 0,
  `adresID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`klantID`, `naam`, `familieNaam`, `email`, `password`, `geboorteDatum`, `registratieTijd`, `admin`, `verwijderd`, `adresID`) VALUES
(1, 'Web', 'User', 'webuser@zeverinpakskes.be', '$2y$10$Sw1k0yMW99YDE/IxlOq3..jKMe/CBInwN7.XTbvL2NlSr6akvt4li', '2021-12-06', '2021-12-15 18:17:57', 1, 0, 1),
(2, 'Lode', 'Gilis', 'lode.gilis@gmail.com', '$2y$10$wZgh5BTBoQbOeZn2c8mumuwLHg5bzlg8A.4ysDiQWVQGgO6cvN7Sq', '2002-07-12', '2021-12-26 10:03:12', 1, 0, 2),
(3, '', '', '', '$2y$10$sH0HL1cmdjOjt11nN5pkYe53xFvTxxm0meKgyPt7BhhtYeCnAhFWO', '0000-00-00', '2021-12-26 11:24:51', 0, 1, 3),
(4, 'Test', 'Persoon', 'test.test@test.be', '$2y$10$EIjrOayzUECevBsoLNHajuXjcNgrGJzXu4wjQRTYWB22pcDhUBkdS', '2021-12-06', '2021-12-29 12:09:25', 0, 0, 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `productID` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `beschrijving` varchar(1024) NOT NULL,
  `voorraad` int(11) NOT NULL,
  `prijs` decimal(10,2) NOT NULL DEFAULT 0.00,
  `afbeeldingNaam` varchar(255) NOT NULL DEFAULT 'placeholder.jpg',
  `verwijderd` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`productID`, `naam`, `beschrijving`, `voorraad`, `prijs`, `afbeeldingNaam`, `verwijderd`) VALUES
(1, 'Politieke Zever', 'Dit is een ware Belgische Bestseller!', 0, '2.50', 'politiekeZever.png', 0),
(2, 'Corona Zever', 'De afgelopen tijd is dit zeer hard van toepassing', 7, '5.00', 'covidZever.png', 0),
(3, 'Economische Zever', 'Allemaal zever over geld en toestanden', 6, '30.00', 'economischeZever.png', 0),
(4, 'Culturele Zever', 'Deze zever kan een beetje controversieel zijn', 24, '5.25', 'cultureleZever.png', 0),
(5, 'Lokale Zever', 'Met deze zever kunt u niet missen! Zever van om de hoek, direct aan uw deur geleverd!', 22, '3.30', 'lokaleZever.png', 0),
(6, 'Persoonlijke Zever', 'Zever van uw verleden. Die zever kunnen wij voor een kleine prijs terug boven halen!', 20, '7.50', 'persoonlijkeZever.png', 1),
(7, 'Speelclub Zever', 'Ooit al leiding geweest van de jongste groep in een jeugdbeweging? Zo ja, dan weet je dat er extreem veel zever uit die kinderen komt, letterlijk en figuurlijk. Bij deze verkopen wij ook deze figuurlijke zever voor een zeer scherpe prijs!', 19, '2.99', 'speelclubZever.png', 0),
(8, 'Letterlijke Zever', 'Dit is een pakske letterlijke zever. Spreekt voor zichzelf.', 67, '10.00', 'letterlijkeZever.png', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `adressen`
--
ALTER TABLE `adressen`
  ADD PRIMARY KEY (`adresID`);

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`bestellingID`);

--
-- Indexen voor tabel `bestellingproducten`
--
ALTER TABLE `bestellingproducten`
  ADD PRIMARY KEY (`bestelProductID`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantID`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `adressen`
--
ALTER TABLE `adressen`
  MODIFY `adresID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `bestellingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `bestellingproducten`
--
ALTER TABLE `bestellingproducten`
  MODIFY `bestelProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
