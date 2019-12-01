-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Gru 2019, 18:49
-- Wersja serwera: 10.1.38-MariaDB
-- Wersja PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `tester`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text COLLATE utf8_polish_ci NOT NULL,
  `answer` varchar(1) COLLATE utf8_polish_ci NOT NULL,
  `a` text COLLATE utf8_polish_ci NOT NULL,
  `b` text COLLATE utf8_polish_ci NOT NULL,
  `c` text COLLATE utf8_polish_ci NOT NULL,
  `d` text COLLATE utf8_polish_ci NOT NULL,
  `good` int(200) NOT NULL,
  `bad` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer`, `a`, `b`, `c`, `d`, `good`, `bad`) VALUES
(1, 'pytanie1a', 'a', 'odpowiedz a', 'odps b', 'odps c', 'odpe d', 16, 0),
(2, 'pytanie 2c', 'c', 'odpe a', 'odpa b', 'odps c', 'odpc d', 2, 8),
(3, 'pyt3c', 'c', 'odp a', 'odp b', 'odp c', 'odp d', 0, 17),
(4, 'pyt4d', 'd', 'odp a', 'odp b', 'odp c', 'odp d', 1, 17),
(5, 'pyt5a', 'a', 'odp a', 'odp b', 'odp c', 'odp d', 8, 5),
(6, 'pyt6b', 'b', 'odp a', 'odp b', 'odp c', 'odp d', 1, 11),
(7, 'pyt7c', 'c', 'odp a', 'odp b', 'odp c', 'odp d', 2, 11),
(8, 'pyt8d', 'd', 'odp a', 'odp b', 'odp c', 'odp d', 1, 17),
(9, 'pyt9a', 'a', 'odp a', 'odp b', 'odp c', 'odp d', 14, 0),
(10, 'pyt10b', 'b', 'odp a', 'odp b', 'odp c', 'odp d', 1, 13),
(11, 'pyt11c', 'c', 'odp a', 'odp b', 'odp c', 'odp d', 5, 14),
(12, 'pyt12d', 'd', 'odp a', 'odp b', 'odp c', 'odp d', 1, 14),
(13, 'pyt13a', 'a', 'odpa', 'odpb', 'odpc', 'odpd', 3, 0),
(14, 'pytanie 14b', 'b', 'odp a', 'odp b', 'odp c', 'odp d', 0, 3),
(15, 'pytanie 15c', 'c', 'odp a', 'odp b', 'odp c', 'odp d', 0, 4),
(16, 'pytanie 16d', 'd', 'odp a', 'odp b', 'odp c', 'odp d', 0, 4),
(17, 'pytanie 17a', 'a', 'odp a', 'odp b', 'odp c', 'odp d', 4, 0),
(18, 'pytanie 18b', 'b', 'odp a', 'odp b', 'odp c', 'odp d', 0, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `name` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `good` int(11) NOT NULL,
  `bad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`name`, `pass`, `good`, `bad`) VALUES
('admin', 'e3bc38a4faa625d074664d572d810c1e', 0, 0),
('asd', 'a8f5f167f44f4964e6c998dee827110c', 30, 50),
('login', '84ac961896000a4a8e2cd5fd4b1cb4ce', 3, 7),
('qwe', 'efe6398127928f1b2e9ef3207fb82663', 21, 69),
('zxc', 'ecb97ffafc1798cd2f67fcbc37226761', 3, 7);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
