-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 09:23 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `podroze`
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

--
-- Dumping data for table `lista_podrozy`
--

INSERT INTO `lista_podrozy` (`id_podrozy`, `data_podrozy`, `organizator`, `cena`, `destynacja`, `opis`) VALUES
(33, '12/03/0312', 'zs1mmz', 1233, 'Mazury', 'Super wycieczka zapraszamy!'),
(39, '23/04/0042', 'fdafdasf', 423423, 'fdsa', 'fdassssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recenzje`
--

CREATE TABLE `recenzje` (
  `id_recenzji` int(11) NOT NULL,
  `id_podrozy` int(11) NOT NULL,
  `user_login` text NOT NULL,
  `ocena` text NOT NULL,
  `data_recenzji` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recenzje`
--

INSERT INTO `recenzje` (`id_recenzji`, `id_podrozy`, `user_login`, `ocena`, `data_recenzji`) VALUES
(126, 39, 'uzytkownik', 'good', '07/04/2024'),
(127, 33, 'uzytkownik', 'bad', '07/04/2024');

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

--
-- Dumping data for table `ulubione_podroze`
--

INSERT INTO `ulubione_podroze` (`id_polubienia`, `id_podrozy`, `user_login`, `data_polubienia`) VALUES
(55, 39, 'uzytkownik', '07/04/2024');

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`login`, `pass`, `upr`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('pracownik', '491910ff69cf9f888d5bed54630ffbaa', 'pracownik'),
('uzytkownik', 'c9455fc6943ad37378261ca60f7a68a2', 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zaplanowane_podroze`
--

CREATE TABLE `zaplanowane_podroze` (
  `id` int(11) NOT NULL,
  `data_dodania` int(11) NOT NULL,
  `id_podrozy` int(11) NOT NULL,
  `user_login` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zaplanowane_podroze`
--

INSERT INTO `zaplanowane_podroze` (`id`, `data_dodania`, `id_podrozy`, `user_login`) VALUES
(51, 7, 33, 'uzytkownik');

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
-- Indeksy dla tabeli `zaplanowane_podroze`
--
ALTER TABLE `zaplanowane_podroze`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lista_podrozy`
--
ALTER TABLE `lista_podrozy`
  MODIFY `id_podrozy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `recenzje`
--
ALTER TABLE `recenzje`
  MODIFY `id_recenzji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `ulubione_podroze`
--
ALTER TABLE `ulubione_podroze`
  MODIFY `id_polubienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `zaplanowane_podroze`
--
ALTER TABLE `zaplanowane_podroze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
