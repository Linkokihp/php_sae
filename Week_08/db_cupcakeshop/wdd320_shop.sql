-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 04. Mai 2021 um 17:24
-- Server-Version: 10.4.13-MariaDB
-- PHP-Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `wdd320_shop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse`
--

CREATE TABLE `adresse` (
  `IDadresse` int(11) NOT NULL,
  `adresse_adresse` varchar(255) DEFAULT NULL,
  `adresse_adresse2` varchar(255) DEFAULT NULL,
  `adresse_plz` varchar(8) DEFAULT NULL,
  `adresse_ort` varchar(255) DEFAULT NULL,
  `adresse_land` varchar(255) DEFAULT NULL,
  `adresse_default` tinyint(1) DEFAULT NULL,
  `kunde_IDkunde` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `adresse`
--

INSERT INTO `adresse` (`IDadresse`, `adresse_adresse`, `adresse_adresse2`, `adresse_plz`, `adresse_ort`, `adresse_land`, `adresse_default`, `kunde_IDkunde`) VALUES
(1, 'Musterstrasse 1', NULL, '1999', 'Musterhausen', 'Schweiz', 1, 1),
(2, 'Bahnhofsstrasse 10', NULL, '1222', 'Beispieldorf', 'Schweiz', 1, 2),
(3, 'Büroweg 3', 'c/o. F.Meier', '1222', 'Beispieldorf', 'Schweiz', 0, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE `bestellung` (
  `IDbestellung` int(11) NOT NULL,
  `bestellung_datum` timestamp NULL DEFAULT NULL,
  `bestellung_lieferdatum` date DEFAULT NULL,
  `bestellung_lieferzeit` time DEFAULT NULL,
  `kunde_IDkunde` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung_has_produkt`
--

CREATE TABLE `bestellung_has_produkt` (
  `bestellung_IDbestellung` int(11) NOT NULL,
  `produkt_IDprodukt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunde`
--

CREATE TABLE `kunde` (
  `IDkunde` int(11) NOT NULL,
  `kunde_name` varchar(45) DEFAULT NULL,
  `kunde_vorname` varchar(45) DEFAULT NULL,
  `kunde_email` varchar(255) DEFAULT NULL,
  `kunde_telefon` varchar(45) DEFAULT NULL,
  `kunde_passwort` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `kunde`
--

INSERT INTO `kunde` (`IDkunde`, `kunde_name`, `kunde_vorname`, `kunde_email`, `kunde_telefon`, `kunde_passwort`) VALUES
(1, 'Mustermann', 'Maria', 'maria@mustermann-ag.ch', '+41 44 555 66 77', '$2y$10$o6WWqsXGnD.UCtRbuUgpPu/9qE4rsD8eEKictKT29gfgFm4TYDs46'),
(2, 'Meier', 'Fritzli', 'fritzlim@gmail.com', '+41 79 222 11 33', '$2y$10$D4Il3h6YS56wICi9lWSgc.QirhtfT0PtLaMNR7oZw9CgnfEtWXp5q');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkt`
--

CREATE TABLE `produkt` (
  `IDprodukt` int(11) NOT NULL,
  `produkt_name` varchar(45) DEFAULT NULL,
  `produkt_bild` varchar(45) DEFAULT NULL,
  `produkt_preis` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `produkt`
--

INSERT INTO `produkt` (`IDprodukt`, `produkt_name`, `produkt_bild`, `produkt_preis`) VALUES
(1, 'Erdbeer', 'cupcake-erdbeer.png', '6.50'),
(2, 'Himbeere', 'cupcake-himbeer.png', '5.50'),
(3, 'Mokka Tiramisu', 'cupcake-mokka.png', '5.90'),
(4, 'White Chocolate', 'cupcake-white-choco.png', '5.90'),
(5, 'Rainbow Vanilla', 'cupcake-rainbow-vanille.png', '4.50'),
(6, 'Rhabarber', 'cupcake-rhabarber.png', '5.50');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `warenkorb`
--

CREATE TABLE `warenkorb` (
  `kunde_IDkunde` int(11) NOT NULL,
  `produkt_IDprodukt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`IDadresse`),
  ADD KEY `fk_adresse_kunde1_idx` (`kunde_IDkunde`);

--
-- Indizes für die Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`IDbestellung`),
  ADD KEY `fk_bestellung_kunde1_idx` (`kunde_IDkunde`);

--
-- Indizes für die Tabelle `bestellung_has_produkt`
--
ALTER TABLE `bestellung_has_produkt`
  ADD PRIMARY KEY (`bestellung_IDbestellung`,`produkt_IDprodukt`),
  ADD KEY `fk_bestellung_has_produkt_produkt1_idx` (`produkt_IDprodukt`),
  ADD KEY `fk_bestellung_has_produkt_bestellung1_idx` (`bestellung_IDbestellung`);

--
-- Indizes für die Tabelle `kunde`
--
ALTER TABLE `kunde`
  ADD PRIMARY KEY (`IDkunde`);

--
-- Indizes für die Tabelle `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`IDprodukt`);

--
-- Indizes für die Tabelle `warenkorb`
--
ALTER TABLE `warenkorb`
  ADD PRIMARY KEY (`kunde_IDkunde`,`produkt_IDprodukt`),
  ADD KEY `fk_kunde_has_produkt_produkt1_idx` (`produkt_IDprodukt`),
  ADD KEY `fk_kunde_has_produkt_kunde1_idx` (`kunde_IDkunde`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `adresse`
--
ALTER TABLE `adresse`
  MODIFY `IDadresse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  MODIFY `IDbestellung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kunde`
--
ALTER TABLE `kunde`
  MODIFY `IDkunde` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `produkt`
--
ALTER TABLE `produkt`
  MODIFY `IDprodukt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
