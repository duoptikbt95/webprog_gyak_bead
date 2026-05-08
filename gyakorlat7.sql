-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Máj 06. 11:57
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `gyakorlat7`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `csaladi_nev` varchar(100) NOT NULL,
  `uto_nev` varchar(100) NOT NULL,
  `bejelentkezes` varchar(100) NOT NULL,
  `jelszo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `csaladi_nev`, `uto_nev`, `bejelentkezes`, `jelszo`) VALUES
(1, 'Teszt', 'User', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(2, 'Kiss', 'József', 'kissj', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(3, 'Kiss', 'Béla', 'kissb', 'c3eb36042284e2ab94dfda65f7075f46d9ad48a9');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `helyszin`
--

CREATE TABLE `helyszin` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `megyeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `helyszin`
--

INSERT INTO `helyszin` (`id`, `nev`, `megyeid`) VALUES
(1, 'Várpalota', 14),
(2, 'Kulcs', 13),
(3, 'Mosonszolnok', 15),
(4, 'Mosonmagyaróvár', 15),
(5, 'Bükkaranyos', 1),
(6, 'Erk', 2),
(7, 'Újrónafő', 15),
(8, 'Szápár', 14),
(9, 'Vép', 16),
(11, 'Mezőtúr', 5),
(12, 'Törökszentmiklós', 5),
(14, 'Felsőzsolca', 1),
(15, 'Csetény', 14),
(16, 'Ostffyasszonyfa', 16),
(17, 'Levél', 15),
(19, 'Csorna', 15),
(20, 'Mecsér', 15),
(21, 'Bakonycsernye', 13),
(22, 'Sopronkövesd', 15),
(23, 'Nagylózs', 15),
(25, 'Jánossomorja', 15),
(26, 'Ács', 12),
(27, 'Pápakovácsi', 14),
(28, 'Vönöck', 16),
(29, 'Kisigmánd', 12),
(30, 'Bőny', 15),
(31, 'Csém', 12),
(32, 'Nagyigmánd', 12),
(35, 'Bábolna', 12),
(37, 'Ikervár', 16),
(38, 'Lövő', 15);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `megye`
--

CREATE TABLE `megye` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `regio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `megye`
--

INSERT INTO `megye` (`id`, `nev`, `regio`) VALUES
(1, 'Borsod-Abaúj-Zemplén', 'Észak-Magyarország'),
(2, 'Heves', 'Észak-Magyarország'),
(3, 'Nógrád', 'Észak-Magyarország'),
(4, 'Hajdú-Bihar', 'Észak-Alföld'),
(5, 'Jász-Nagykun-Szolnok', 'Észak-Alföld'),
(6, 'Szabolcs-Szatmár-Bereg', 'Észak-Alföld'),
(7, 'Bács-Kiskun', 'Dél-Alföld'),
(8, 'Békés', 'Dél-Alföld'),
(9, 'Csongrád', 'Dél-Alföld'),
(10, 'Pest', 'Közép-Magyarország'),
(11, 'Budapest', 'Közép-Magyarország'),
(12, 'Komárom-Esztergom', 'Közép-Dunántúl'),
(13, 'Fejér', 'Közép-Dunántúl'),
(14, 'Veszprém', 'Közép-Dunántúl'),
(15, 'Győr-Moson-Sopron', 'Nyugat-Dunántúl'),
(16, 'Vas', 'Nyugat-Dunántúl'),
(17, 'Zala', 'Nyugat-Dunántúl'),
(18, 'Baranya', 'Dél-Dunántúl'),
(19, 'Somogy', 'Dél-Dunántúl'),
(20, 'Tolna', 'Dél-Dunántúl');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `torony`
--

CREATE TABLE `torony` (
  `id` int(11) NOT NULL,
  `darab` int(11) NOT NULL,
  `teljesitmeny` int(11) NOT NULL,
  `kezdev` int(11) NOT NULL,
  `helyszinid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `torony`
--

INSERT INTO `torony` (`id`, `darab`, `teljesitmeny`, `kezdev`, `helyszinid`) VALUES
(1, 2, 290, 1910, 28),
(2, 1, 250, 2000, 1),
(3, 1, 600, 2001, 2),
(4, 2, 600, 2002, 3),
(5, 2, 600, 2003, 4),
(6, 1, 225, 2005, 5),
(7, 1, 800, 2005, 6),
(8, 1, 800, 2005, 7),
(9, 1, 1800, 2005, 8),
(10, 1, 600, 2005, 9),
(11, 5, 2000, 2005, 4),
(12, 1, 1500, 2006, 11),
(13, 1, 1500, 2006, 12),
(14, 5, 2000, 2006, 4),
(15, 1, 1800, 2006, 14),
(16, 2, 2000, 2006, 15),
(17, 1, 600, 2006, 16),
(18, 12, 2000, 2006, 17),
(19, 1, 800, 2007, 3),
(20, 1, 800, 2007, 19),
(21, 1, 800, 2007, 20),
(22, 1, 2000, 2007, 21),
(23, 4, 3000, 2008, 22),
(24, 3, 3000, 2008, 23),
(25, 1, 2000, 2008, 23),
(26, 12, 2000, 2008, 17),
(27, 4, 2000, 2008, 25),
(28, 1, 1800, 2008, 25),
(29, 1, 2000, 2008, 26),
(30, 1, 2000, 2008, 27),
(31, 1, 850, 2008, 28),
(32, 19, 2000, 2009, 29),
(33, 8, 2000, 2009, 30),
(34, 4, 1800, 2010, 30),
(35, 1, 1800, 2010, 30),
(36, 6, 2000, 2010, 31),
(37, 7, 2000, 2010, 32),
(38, 6, 2000, 2010, 26),
(39, 2, 2000, 2010, 32),
(40, 6, 2000, 2010, 35),
(41, 1, 3000, 2010, 35),
(42, 1, 2000, 2010, 25),
(43, 4, 2000, 2011, 37),
(44, 13, 2000, 2011, 37),
(45, 1, 2000, 2010, 38),
(46, 1, 120, 2026, 23),
(47, 2, 120, 2026, 26);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `uzenetek`
--

CREATE TABLE `uzenetek` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `uzenet` text NOT NULL,
  `felhasznalo_id` int(11) DEFAULT NULL,
  `kuldes_ideje` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `uzenetek`
--

INSERT INTO `uzenetek` (`id`, `nev`, `email`, `uzenet`, `felhasznalo_id`, `kuldes_ideje`) VALUES
(1, 'dsfsa', 'asdfsa@adsfd.com', 'dsfsadf', NULL, '2026-05-04 17:43:37'),
(2, 'dsfsa', 'asdfsa@adsfd.com', 'dsfsadf', NULL, '2026-05-04 17:49:42'),
(3, 'asd', 'asd@asdd.hu', 'dsfasdf', NULL, '2026-05-04 21:57:41'),
(4, 'Kiss József', 'kiss@jozsef.hu', 'asdfasdfsdfsadfsafdfa', 2, '2026-05-05 20:54:23'),
(5, 'sdfsd', 'dsfsdf@dsfsd.com', 'sfdasdfs', NULL, '2026-05-05 21:14:09');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bejelentkezes` (`bejelentkezes`);

--
-- A tábla indexei `helyszin`
--
ALTER TABLE `helyszin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `megyeid` (`megyeid`);

--
-- A tábla indexei `megye`
--
ALTER TABLE `megye`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `torony`
--
ALTER TABLE `torony`
  ADD PRIMARY KEY (`id`),
  ADD KEY `helyszinid` (`helyszinid`);

--
-- A tábla indexei `uzenetek`
--
ALTER TABLE `uzenetek`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `torony`
--
ALTER TABLE `torony`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT a táblához `uzenetek`
--
ALTER TABLE `uzenetek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `helyszin`
--
ALTER TABLE `helyszin`
  ADD CONSTRAINT `helyszin_ibfk_1` FOREIGN KEY (`megyeid`) REFERENCES `megye` (`id`);

--
-- Megkötések a táblához `torony`
--
ALTER TABLE `torony`
  ADD CONSTRAINT `torony_ibfk_1` FOREIGN KEY (`helyszinid`) REFERENCES `helyszin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
