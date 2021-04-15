-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Lut 2021, 15:49
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `iab`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adresy`
--

DROP TABLE IF EXISTS `adresy`;
CREATE TABLE `adresy` (
  `adresid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `miasto` varchar(30) NOT NULL,
  `ulicz` varchar(30) NOT NULL,
  `nrdomu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tabela Truncate przed wstawieniem `adresy`
--

TRUNCATE TABLE `adresy`;
-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakty`
--

DROP TABLE IF EXISTS `kontakty`;
CREATE TABLE `kontakty` (
  `kontaktid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `nrtelefonu` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tabela Truncate przed wstawieniem `kontakty`
--

TRUNCATE TABLE `kontakty`;
-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `korepetycje`
--

DROP TABLE IF EXISTS `korepetycje`;
CREATE TABLE `korepetycje` (
  `korepetycjeid` int(11) NOT NULL,
  `przedmiotid` int(11) NOT NULL,
  `nauczycielid` int(11) NOT NULL,
  `uczenid` int(11) NOT NULL,
  `data` date NOT NULL,
  `godzstart` time NOT NULL,
  `godzkoniec` time NOT NULL,
  `opis` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tabela Truncate przed wstawieniem `korepetycje`
--

TRUNCATE TABLE `korepetycje`;
--
-- Zrzut danych tabeli `korepetycje`
--

INSERT INTO `korepetycje` (`korepetycjeid`, `przedmiotid`, `nauczycielid`, `uczenid`, `data`, `godzstart`, `godzkoniec`, `opis`) VALUES
(6, 1, 7, 3, '2021-01-29', '10:00:00', '12:00:00', 'Musze się tego nauczyc'),
(7, 2, 4, 3, '2021-01-28', '09:15:00', '11:15:00', 'Czekam na nową wiedzę'),
(8, 3, 7, 2, '2021-01-22', '12:20:00', '13:40:00', 'Naucz mnie liczyć'),
(9, 1, 7, 3, '2021-01-22', '10:20:00', '15:19:00', 'Wpisz tu coś ');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nauczyciel`
--

DROP TABLE IF EXISTS `nauczyciel`;
CREATE TABLE `nauczyciel` (
  `nauczycielid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tabela Truncate przed wstawieniem `nauczyciel`
--

TRUNCATE TABLE `nauczyciel`;
--
-- Zrzut danych tabeli `nauczyciel`
--

INSERT INTO `nauczyciel` (`nauczycielid`, `userid`) VALUES
(1, 4),
(2, 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmiot`
--

DROP TABLE IF EXISTS `przedmiot`;
CREATE TABLE `przedmiot` (
  `PrzedmiotID` int(11) NOT NULL,
  `Nazwa` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tabela Truncate przed wstawieniem `przedmiot`
--

TRUNCATE TABLE `przedmiot`;
--
-- Zrzut danych tabeli `przedmiot`
--

INSERT INTO `przedmiot` (`PrzedmiotID`, `Nazwa`) VALUES
(1, 'Polski'),
(2, 'Angielski'),
(3, 'Matematyka'),
(4, 'Biologia'),
(5, 'Chemia'),
(6, 'Francuski'),
(7, 'Programowanie'),
(8, 'Informatyka'),
(9, 'Muzyka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmiotyuser`
--

DROP TABLE IF EXISTS `przedmiotyuser`;
CREATE TABLE `przedmiotyuser` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PrzedmiotID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tabela Truncate przed wstawieniem `przedmiotyuser`
--

TRUNCATE TABLE `przedmiotyuser`;
--
-- Zrzut danych tabeli `przedmiotyuser`
--

INSERT INTO `przedmiotyuser` (`ID`, `UserID`, `PrzedmiotID`) VALUES
(3, 2, 3),
(4, 2, 1),
(5, 2, 5),
(7, 6, 3),
(8, 7, 2),
(9, 7, 1),
(10, 7, 4),
(11, 7, 7),
(12, 4, 2),
(13, 4, 9),
(14, 4, 1),
(15, 3, 6),
(16, 3, 5),
(19, 7, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rola`
--

DROP TABLE IF EXISTS `rola`;
CREATE TABLE `rola` (
  `rolaid` int(11) NOT NULL,
  `Nazwa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tabela Truncate przed wstawieniem `rola`
--

TRUNCATE TABLE `rola`;
--
-- Zrzut danych tabeli `rola`
--

INSERT INTO `rola` (`rolaid`, `Nazwa`) VALUES
(1, 'Nauczyciel'),
(2, 'Uczen'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczen`
--

DROP TABLE IF EXISTS `uczen`;
CREATE TABLE `uczen` (
  `uczenid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tabela Truncate przed wstawieniem `uczen`
--

TRUNCATE TABLE `uczen`;
--
-- Zrzut danych tabeli `uczen`
--

INSERT INTO `uczen` (`uczenid`, `userid`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 5),
(5, 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Login` varchar(30) NOT NULL,
  `Haslo` varchar(256) NOT NULL,
  `Imie` varchar(30) NOT NULL,
  `Nazwisko` varchar(30) NOT NULL,
  `Opis` varchar(200) NOT NULL,
  `Dataurodzenia` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `RolaID` int(11) NOT NULL,
  `adresid` int(11) NOT NULL,
  `kontaktid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tabela Truncate przed wstawieniem `user`
--

TRUNCATE TABLE `user`;
--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`UserID`, `Login`, `Haslo`, `Imie`, `Nazwisko`, `Opis`, `Dataurodzenia`, `email`, `RolaID`, `adresid`, `kontaktid`) VALUES
(2, 'seba', '$2y$10$I5uftZk13l2Fgd3FpK462OJZ/Rvrydc7ZGOnIOPQ.i1nqomM9sMHO', 'Sabastian', 'Nowak', 'Uczę się w liceum. Potrzebuje pomocy z przygotowaniem do klasówek.', '2003-06-06', 'seba@gmail.com', 2, 0, 0),
(3, 'dominik', '$2y$10$0gZ31sz8UAN3lXw2U6KM/u8QgOKV.Jza8KJAGrg6G0gShh7Ip3jlK', 'Dominik', 'Snopek', 'siema', '1999-06-08', 'dominik@gmail.com', 2, 0, 0),
(4, 'admin', '$2y$10$cD35jOgrXaQdOQhjkS1KYeTKxw89f3SLhQM/LGnhMXfJW4m8LQ...', 'Andrzej', 'Masno', 'Jestem zawodowym nauczycielem z wieloletnim doswiadczeniem', '1992-06-11', 'admin@gmail.com', 1, 0, 0),
(5, 'alaa', '$2y$10$D7g58A0RYF1bSnUyeVEwb.EoowqfvhI50.xURZCBtrxkg2PkeVwC6', 'Ala', 'Kot', '', '0000-00-00', 'ala@gmail.com', 2, 0, 0),
(6, 'kuba', '$2y$10$u2F7bUwWYsPOqAN5n6qCsuGTC97v3Pg2HAEM1ds7CDMpl4NpzHHZe', 'Kuba', 'Popo', 'Chcę się czegoś nauczyć ', '2006-06-16', 'kuba@gmail.com', 2, 0, 0),
(7, 'miku', '$2y$10$q2ECSKlADFrAxarK0ibL5.YeDUYcwTPCzWx42OtP/V5c3Xr2Pu4QO', 'Mikołaj', 'Duda', 'Potrafię swietnie uczyc', '1993-06-19', 'miku@gmail.com', 1, 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adresy`
--
ALTER TABLE `adresy`
  ADD PRIMARY KEY (`adresid`);

--
-- Indeksy dla tabeli `kontakty`
--
ALTER TABLE `kontakty`
  ADD PRIMARY KEY (`kontaktid`);

--
-- Indeksy dla tabeli `korepetycje`
--
ALTER TABLE `korepetycje`
  ADD PRIMARY KEY (`korepetycjeid`);

--
-- Indeksy dla tabeli `nauczyciel`
--
ALTER TABLE `nauczyciel`
  ADD PRIMARY KEY (`nauczycielid`);

--
-- Indeksy dla tabeli `przedmiot`
--
ALTER TABLE `przedmiot`
  ADD PRIMARY KEY (`PrzedmiotID`);

--
-- Indeksy dla tabeli `przedmiotyuser`
--
ALTER TABLE `przedmiotyuser`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `rola`
--
ALTER TABLE `rola`
  ADD PRIMARY KEY (`rolaid`);

--
-- Indeksy dla tabeli `uczen`
--
ALTER TABLE `uczen`
  ADD PRIMARY KEY (`uczenid`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `adresy`
--
ALTER TABLE `adresy`
  MODIFY `adresid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `kontakty`
--
ALTER TABLE `kontakty`
  MODIFY `kontaktid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `korepetycje`
--
ALTER TABLE `korepetycje`
  MODIFY `korepetycjeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `nauczyciel`
--
ALTER TABLE `nauczyciel`
  MODIFY `nauczycielid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `przedmiot`
--
ALTER TABLE `przedmiot`
  MODIFY `PrzedmiotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `przedmiotyuser`
--
ALTER TABLE `przedmiotyuser`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `rola`
--
ALTER TABLE `rola`
  MODIFY `rolaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `uczen`
--
ALTER TABLE `uczen`
  MODIFY `uczenid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
