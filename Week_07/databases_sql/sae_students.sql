-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Apr 2021 um 17:42
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `sae_students`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kurse`
--

CREATE TABLE `kurse` (
  `ID` int(11) NOT NULL,
  `kursbezeichnung` varchar(8) NOT NULL,
  `kursname` varchar(64) NOT NULL,
  `startdatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `kurse`
--

INSERT INTO `kurse` (`ID`, `kursbezeichnung`, `kursname`, `startdatum`) VALUES
(1, 'WGK321', 'Wugikurs2021', '0000-00-00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `studenten`
--

CREATE TABLE `studenten` (
  `ID` int(11) NOT NULL,
  `kursID` int(11) NOT NULL,
  `vorname` varchar(255) NOT NULL,
  `nachname` varchar(255) NOT NULL,
  `anrede` varchar(8) NOT NULL,
  `email` varchar(255) NOT NULL,
  `geburtsdatum` date NOT NULL,
  `plz` varchar(4) NOT NULL,
  `ort` varchar(64) NOT NULL,
  `land` varchar(3) NOT NULL,
  `telefon` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `studenten`
--

INSERT INTO `studenten` (`ID`, `kursID`, `vorname`, `nachname`, `anrede`, `email`, `geburtsdatum`, `plz`, `ort`, `land`, `telefon`) VALUES
(1, 1, 'Philipp', 'Koch', 'Herr', 'phil.koch@gmx.ch', '1992-01-20', '5400', 'Baden', 'CH', '+123456789'),
(3, 1, 'Louisette', 'Trasler', 'Frau', 'ltrasler0@deliciousdays.com', '0000-00-00', '9315', 'Albacete', 'ES', '96279737934'),
(4, 0, 'Franz', 'M?ller', 'Herr', 'fmul@ycombinator.com', '0000-00-00', '1200', 'Ainaro', 'CH', '13004069273'),
(5, 0, 'Stuart', 'Jackett', 'Herr', 'sjackett4@fc2.com', '0000-00-00', '6518', 'M?nchen', 'DE', '70694747437'),
(6, 1, 'Barbara', 'Grovier', 'Herr', 'bgrovier5@flickr.com', '0000-00-00', '7371', 'Marcos Ju?rez', 'AR', '40005963399'),
(7, 0, 'Deborah', 'Waterhowse', 'Frau', 'dwaterhowse6@sitemeter.com', '0000-00-00', '8047', 'Z?rich', 'CH', '58409648466'),
(8, 0, 'Genny', 'Arundell', 'Herr', 'garundell7@spiegel.de', '0000-00-00', '8599', 'Gore', 'NZ', '5433436678'),
(9, 0, 'Jose', 'Abdon', 'Herr', 'jabdon8@statcounter.com', '0000-00-00', '2775', 'Kassel', 'DE', '31256699291'),
(10, 0, 'Joey', 'Lippitt', 'Frau', 'jlippitta@jimdo.com', '0000-00-00', '3695', 'Nagbacalan', 'DE', '12784323813'),
(11, 0, 'Sylvan', 'Alenichev', 'Herr', 'salenichevb@theatlantic.com', '0000-00-00', '2078', 'Calvaria de Baixo', 'PT', '96436044591'),
(12, 1, 'Brigitte', 'Boyd', 'Herr', 'bboydc@adobe.com', '0000-00-00', '4547', 'Haruman', 'ID', '80917545468'),
(13, 1, 'Lena', 'Waldmann', 'Frau', 'waldmannl@jimdo.com', '0000-00-00', '8005', 'Z?rich', 'CH', '78662800823'),
(14, 0, 'Susanna', 'Castellani', 'Frau', 'scastellanie@fema.gov', '0000-00-00', '8005', 'Z?rich', 'CH', '1962150610'),
(15, 0, 'Mohan', 'Bartolomieu', 'Herr', 'mbartolomieuf@seattletimes.com', '0000-00-00', '1541', 'Basel', 'CH', '6423352505'),
(16, 0, 'Cati', 'Losseljong', 'Frau', 'closseljongg@goodreads.com', '0000-00-00', '5251', 'Cotmon', 'PH', '35911250304'),
(17, 1, 'Marlon', 'Farlane', 'Herr', 'mfarlaneh@imdb.com', '0000-00-00', '6451', 'Sokolo', 'ML', '84765079521'),
(18, 0, 'Joana', 'Slograve', 'Frau', 'jslogravei@dion.ne.jp', '0000-00-00', '3347', 'Church End', 'CH', '28574388766'),
(19, 0, 'Peadar', 'Ferrier', 'Herr', 'pferrierj@zdnet.com', '0000-00-00', '2498', 'Progreso', 'PA', '48258557601'),
(20, 0, 'Marie', 'Ethersey', 'Frau', 'metherseyk@shutterfly.com', '0000-00-00', '9648', '?gios Spyr?don', 'GR', '41335565303'),
(21, 0, 'Moyra', 'Wingeat', 'Frau', 'mwingeatl@webs.com', '0000-00-00', '2091', 'Lausanne', 'CH', '55440689783'),
(22, 0, 'Inga', 'Dunsleve', 'Frau', 'idunslevem@google.de', '0000-00-00', '1000', 'La Uvita', 'CH', '19027923450'),
(23, 0, 'Billy', 'Ghirardi', 'Herr', 'bghirardin@last.fm', '0000-00-00', '8711', 'R?mlang', 'CH', '5433436678'),
(24, 0, 'Daniel', 'Kubal', 'Herr', 'dkubalo@facebook.com', '0000-00-00', '8370', 'Horgen', 'CH', '31256699291'),
(25, 0, 'Lena', 'Di Giacomo', 'Frau', 'digiacomolena@kickstarter.com', '0000-00-00', '5498', 'Bologna', 'IT', '31293605213'),
(26, 0, 'Gasparo', 'Fouch', 'Herr', 'gfouchq@irs.gov', '0000-00-00', '7379', 'Wyszki', 'PL', '12784323813'),
(27, 0, 'Kelcy', 'Climar', 'Frau', 'kclimarr@merriam-webster.com', '0000-00-00', '8120', 'Volketswil', 'CH', '96436044591'),
(28, 0, 'Manuel', 'Chartres', 'Herr', 'mchartress@bloglovin.com', '0000-00-00', '6107', 'Chervonoarmiys?k', 'UA', '80917545468'),
(29, 0, 'Oberon', 'Roddell', 'Herr', 'oroddellt@fc2.com', '0000-00-00', '7400', 'Ennenda', 'CH', '78662800823'),
(30, 0, 'Lena', 'Yushkin', 'Frau', 'lyushkiny@naver.com', '0000-00-00', '5408', 'Abtwil', 'CH', '18229981698'),
(31, 0, 'Lucilia', 'Crowne', 'Frau', 'lcrownez@home.pl', '0000-00-00', '8424', 'B?retswil', 'CH', '44316450651'),
(32, 0, 'Noemi', 'Woofendell', 'Frau', 'nwoofendell10@ow.ly', '0000-00-00', '8420', 'Winterthur', 'CH', '39776933924'),
(33, 0, 'Roxanne', 'Arstall', 'Frau', 'rarstall11@ycombinator.com', '0000-00-00', '8495', 'Stockholm', 'SE', '3648105364'),
(34, 0, 'Anna', 'Lugard', 'Frau', 'alugard12@mayoclinic.com', '0000-00-00', '6474', 'Luzern', 'CH', '58235432176'),
(35, 0, 'Peter', 'Stare', 'Herr', 'pstare13@squarespace.com', '0000-00-00', '3423', 'Sion', 'CH', '71040782118'),
(36, 0, 'Ellen', 'Flanders', 'Frau', 'eflanders14@addtoany.com', '0000-00-00', '6299', 'La Fert?-Bernard', 'CH', '504463380'),
(37, 0, 'Chris', 'Sanches', 'Herr', 'csanches15@yahoo.com', '0000-00-00', '8394', 'Volketswil', 'CH', '53307328921'),
(38, 0, 'Miriam', 'Ossulton', 'Frau', 'mossulton16@cargocollective.com', '0000-00-00', '5387', 'Kappel', 'CH', '74365299408'),
(39, 0, 'Hans', 'Simister', 'Herr', 'hsimister17@toplist.cz', '0000-00-00', '3006', 'Bern', 'CH', '62243364952'),
(40, 0, 'Alan', 'Howlett', 'Herr', 'ahowlett18@tuttocitta.it', '0000-00-00', '8359', 'Annecy', 'FR', '88461229291'),
(41, 0, 'Sandro', 'Del Monte', 'Herr', 'sdelmonte19@tripadvisor.com', '0000-00-00', '6208', 'Balzan', 'CH', '61299590833'),
(42, 0, 'Gina', 'Held', 'Herr', 'gheld1a@un.org', '0000-00-00', '7032', 'Tinizong', 'CH', '25675031086'),
(43, 0, 'Jonas', 'Eardley', 'Herr', 'jeardley1b@google.com.hk', '0000-00-00', '8517', 'Rupperswil', 'CH', '73363120312'),
(44, 0, 'Rolli', 'Bauer', 'Herr', 'rbauer1c@list-manage.com', '0000-00-00', '8400', 'Winterthur', 'CH', '96743428593'),
(45, 0, 'Paola', 'Hatchette', 'Frau', 'phatchette1d@senate.gov', '0000-00-00', '6323', 'Vaduz', 'LI', '52278754137');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `kurse`
--
ALTER TABLE `kurse`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `studenten`
--
ALTER TABLE `studenten`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_kursID` (`kursID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `kurse`
--
ALTER TABLE `kurse`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `studenten`
--
ALTER TABLE `studenten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
