-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Dec 01. 15:12
-- Kiszolgáló verziója: 10.1.34-MariaDB
-- PHP verzió: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `doggo`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ertekelesek`
--

CREATE TABLE `ertekelesek` (
  `felhasznalo_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `ertekeles` int(5) NOT NULL,
  `helyszin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `ertekelesek`
--

INSERT INTO `ertekelesek` (`felhasznalo_id`, `id`, `ertekeles`, `helyszin_id`) VALUES
(1, 1, 5, 1),
(2, 2, 5, 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jelszo` text COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` text COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jogosultsag` tinyint(4) NOT NULL,
  `kitiltva` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `felhasznalonev`, `jelszo`, `email`, `jogosultsag`, `kitiltva`) VALUES
(1, 'test_felh', 'test_jelszo', 'test_email', 0, 0),
(2, 'test_felh_2', 'test_jelszo_2', 'test_email_2', 0, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `helyszinek`
--

CREATE TABLE `helyszinek` (
  `id` int(11) NOT NULL,
  `nev` text COLLATE utf8mb4_hungarian_ci NOT NULL,
  `koordinata` text COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `helyszinek`
--

INSERT INTO `helyszinek` (`id`, `nev`, `koordinata`) VALUES
(1, 'test_hely', 'test_koordinata'),
(2, 'test_hely_2', 'test_koordinata_2');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kommentek`
--

CREATE TABLE `kommentek` (
  `felhasznalo_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `komment` text COLLATE utf8mb4_hungarian_ci NOT NULL,
  `helyszin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `kommentek`
--

INSERT INTO `kommentek` (`felhasznalo_id`, `id`, `komment`, `helyszin_id`) VALUES
(1, 1, 'test_komment', 1),
(2, 2, 'test_komment_2', 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `ertekelesek`
--
ALTER TABLE `ertekelesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`,`helyszin_id`),
  ADD KEY `helyszin_id` (`helyszin_id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `helyszinek`
--
ALTER TABLE `helyszinek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kommentek`
--
ALTER TABLE `kommentek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`,`helyszin_id`),
  ADD KEY `helyszin_id` (`helyszin_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `ertekelesek`
--
ALTER TABLE `ertekelesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `helyszinek`
--
ALTER TABLE `helyszinek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `kommentek`
--
ALTER TABLE `kommentek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `ertekelesek`
--
ALTER TABLE `ertekelesek`
  ADD CONSTRAINT `ertekelesek_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`),
  ADD CONSTRAINT `ertekelesek_ibfk_2` FOREIGN KEY (`helyszin_id`) REFERENCES `helyszinek` (`id`);

--
-- Megkötések a táblához `kommentek`
--
ALTER TABLE `kommentek`
  ADD CONSTRAINT `kommentek_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`),
  ADD CONSTRAINT `kommentek_ibfk_2` FOREIGN KEY (`helyszin_id`) REFERENCES `helyszinek` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
