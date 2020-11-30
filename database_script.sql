-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Nov 2020 um 07:56
-- Server-Version: 10.4.14-MariaDB
-- PHP-Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `sales_power`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `birthday` date DEFAULT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `customers`
--

INSERT INTO `customers` (`id`, `users_id`, `firstname`, `lastname`, `birthday`, `note`) VALUES
(18, 26, 'James', 'Zimmermann', '2534-03-12', 'Herr Zimmermann möchte nächsten Montag um 10:00 angerufen werden, um seine Bestellung zu besprechen'),
(19, 26, 'Timmy', 'Schimmy', '0234-04-23', 'Timmy hat seine Bestellung nicht bekommen, hier nachprüfen wo diese ist'),
(20, 26, 'Bianca', 'Spitz', '0345-05-04', 'Dauerbestellung: 10 Kästen Coca Cola'),
(21, 26, 'Sith', 'Sarb', '3453-04-23', 'hat 5 Kästen Club Mate bestellt'),
(22, 71, 'Mani', 'Maniscalco', '5345-04-23', 'Hat seine Bestellung reklamiert'),
(23, 71, 'Adeb', 'Samib', '0000-00-00', 'Möchte keine Werbung mehr erhalten'),
(24, 78, 'Felix', 'Kübek', '6456-05-04', ''),
(25, 82, 'Thomas', 'Torb', '6456-05-31', ''),
(26, 76, 'Jan', 'Schwere', '1213-02-21', 'Letzte Bestellung erneut aufgeben'),
(27, 79, 'Dani', 'Sahne', '3232-02-23', ''),
(28, 79, 'Max', 'Power', '0000-00-00', ''),
(29, 74, 'Powl', 'Krama', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `permissions`
--

INSERT INTO `permissions` (`id`, `permission`) VALUES
(0, 'Administrator'),
(1, 'Sachbearbeiter');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `permissions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `permissions_id`) VALUES
(26, 'root', 'root', 0),
(71, 'Justinas', 'maniscalco', 1),
(72, 'Tomi', 'mannhard', 1),
(74, 'James', 'Cordon', 1),
(75, 'alexander394', 'coolguy333', 1),
(76, 'drfootball', 'lmao', 1),
(77, 'david', 'gloiath', 1),
(78, 'ethan', 'stephen', 1),
(79, 'tola948', 'yepp', 1),
(80, 'jussi444', 'opsdkfgpe', 1),
(81, 'cheetah123', 'peepa', 1),
(82, 'troy', 'Tray', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `YEP` (`users_id`);

--
-- Indizes für die Tabelle `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Test` (`permissions_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT für Tabelle `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customer_user` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Test` FOREIGN KEY (`permissions_id`) REFERENCES `permissions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
