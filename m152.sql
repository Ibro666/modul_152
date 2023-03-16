-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Erstellungszeit: 16. Mrz 2023 um 20:02
-- Server-Version: 8.0.31
-- PHP-Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `m152`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE `comments` (
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `description` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`post_id`, `user_id`, `description`) VALUES
(49, 9, 'Das ist ein Kommentar'),
(56, 12, 'ddaass');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `likes`
--

CREATE TABLE `likes` (
  `user_id` int NOT NULL,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `likes`
--

INSERT INTO `likes` (`user_id`, `post_id`) VALUES
(9, 50),
(9, 51),
(9, 52),
(9, 53),
(9, 54),
(10, 51),
(10, 52),
(10, 53),
(10, 54);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE `posts` (
  `post_id` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `thumbnail` varchar(1000) NOT NULL,
  `path` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `licence` varchar(20) NOT NULL,
  `autor` varchar(400) NOT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `date` varchar(20) NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `posts`
--

INSERT INTO `posts` (`post_id`, `name`, `thumbnail`, `path`, `licence`, `autor`, `url`, `date`, `user_id`) VALUES
(48, '0.34226700 1678563259', '0.svg', 'resources/uploads/videos/0.34226700 1678563259', 'cc-by', 'BMW', '', '11.03.2023', 0),
(49, '0.59915600 1678575351', '1.svg', 'resources/uploads/audios/0.59915600 1678575351', 'cc-by', 'nimo', '', '11.03.2023', 0),
(50, '0.12282600 1678818001', 'resources/uploads/thumbnails/0.12282600 1678818001', 'resources/uploads/0.12282600 1678818001', 'cc0', '', '', '14.03.2023', 0),
(51, '0.27402900 1678824638', '1.svg', 'resources/uploads/audios/0.27402900 1678824638', 'cc0', 'saa', '', '14.03.2023', 0),
(52, '0.82007000 1678826387', '1.svg', 'resources/uploads/audios/0.82007000 1678826387', 'cc-by', 'sssaa', '', '14.03.2023', 0),
(53, '0.50052200 1678829903', 'resources/uploads/thumbnails/0.50052200 1678829903', 'resources/uploads/0.50052200 1678829903', 'cc0', 'qwe', '', '14.03.2023', 9),
(54, '0.75866400 1678833106', '1.svg', 'resources/uploads/audios/0.75866400 1678833106', 'c', 'nimo', '', '14.03.2023', 10),
(55, '0.34410600 1678937792', '0.svg', 'resources/uploads/videos/0.34410600 1678937792', 'cc0', 'gg', '', '16.03.2023', 12),
(56, '0.49572100 1678937808', 'resources/uploads/thumbnails/0.49572100 1678937808', 'resources/uploads/0.49572100 1678937808', 'cc0', 'gg', '', '16.03.2023', 12);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(400) NOT NULL,
  `password` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `email`, `password`) VALUES
(9, 'ibrohim', 'nasibov', 'ibro', 'ibro@googlemail.com', '$2y$10$1O1Th9xe5E3PmEjW.edqDOWUXIR0uAgQ4NIJYEEPf9qIzWkGirVmi'),
(10, 'max', 'muster', 'max', 'max@muster.ch', '$2y$10$hnDzAuBLLbY2H0VZZ8ZBXu8KMhIFWv6Sr4KpRh1YX0RtLem6CiBWG'),
(11, 'marc', 'Oliver', 'mar6', 'mo@bluewin.ch', '$2y$10$ifUOJGh7jLtz.TcG61yfv.0kfrIjfJazni4gHwSvon4qQwnIqzzni'),
(12, 'ib', 'nb', 'ibro', 'ibro@google.com', '$2y$10$F5sENvujd9Z.Qf32hctGFuhOR0ESke6nIjMhIooHar.Z9x8TgTrCi');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`post_id`,`user_id`);

--
-- Indizes für die Tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`post_id`,`user_id`) USING BTREE,
  ADD KEY `likes_ibfk_2` (`user_id`);

--
-- Indizes für die Tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`,`name`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
