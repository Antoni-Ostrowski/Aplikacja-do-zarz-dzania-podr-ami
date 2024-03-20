-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Mar 2024, 10:29
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `podroze`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lista_podrozy`
--

CREATE TABLE `lista_podrozy` (
  `id_podrozy` int(11) NOT NULL,
  `data_podrozy` text NOT NULL,
  `organizator` text NOT NULL,
  `cena` int(11) NOT NULL,
  `destynacja` text NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recenzje`
--

CREATE TABLE `recenzje` (
  `id_recenzji` int(11) NOT NULL,
  `id_podrozy` int(11) NOT NULL,
  `user_login` text NOT NULL,
  `data_recenzji` text NOT NULL,
  `ocena` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ulubione_podroze`
--

CREATE TABLE `ulubione_podroze` (
  `id_polubienia` int(11) NOT NULL,
  `id_podrozy` int(11) NOT NULL,
  `user_login` text NOT NULL,
  `data_polubienia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `login` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `upr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`login`, `pass`, `upr`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('antek', 'e10adc3949ba59abbe56e057f20f883e', 'user'),
('test', '098f6bcd4621d373cade4e832627b4f6', 'user');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `lista_podrozy`
--
ALTER TABLE `lista_podrozy`
  ADD PRIMARY KEY (`id_podrozy`);

--
-- Indeksy dla tabeli `recenzje`
--
ALTER TABLE `recenzje`
  ADD PRIMARY KEY (`id_recenzji`);

--
-- Indeksy dla tabeli `ulubione_podroze`
--
ALTER TABLE `ulubione_podroze`
  ADD PRIMARY KEY (`id_polubienia`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `lista_podrozy`
--
ALTER TABLE `lista_podrozy`
  MODIFY `id_podrozy` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `recenzje`
--
ALTER TABLE `recenzje`
  MODIFY `id_recenzji` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `ulubione_podroze`
--
ALTER TABLE `ulubione_podroze`
  MODIFY `id_polubienia` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
