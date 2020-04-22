-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2020 at 02:50 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mailodie`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `content` varchar(20000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `author`, `create_date`, `content`) VALUES
(1, 'Suite d\'accords jazzy', 7, '2020-04-22 00:00:00', 'Salut à tous ! J\'ai trouvé une suite d\'accords pas mal au piano, un peu jazzy, je voulais vous la partager, et me dire ce que vous en pensez.\r\n\r\nCm - Am6 - Eb - Ab7\r\nDb - Ab - Ebmaj7 - Fmaj7\r\n\r\nVoilà, je pense qu\'il y a un moyen de faire un truc sympa, d\'autant plus que la modulation est plutôt smooth.\r\nA plus !!'),
(3, 'Petite boucle majeure tranquille', 7, '2020-04-22 12:26:46', 'Bonjour.\r\n\r\nJ\'ai noté ça, c\'est plutôt classique, mais ça marche très bien :\r\n\r\nD - Mmin7 - G\r\n\r\nEn gros, c\'est un I - IImin - IV\r\n\r\nJe voudrais savoir si quelqu\'un connaitrait un moyen de faire une variation de ceci en mineur. La progression peut être complètement différente, du moment que ça s\'enchaîne bien.\r\n\r\nMerci à vous ! :)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` char(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `admin` int(11) NOT NULL,
  `register_date` datetime NOT NULL,
  `activated` int(11) NOT NULL,
  `register_token` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `admin`, `register_date`, `activated`, `register_token`) VALUES
(1, 'kevindu71@gmail.com', '$2y$10$BzaN8qWaePr/i4B5FNulUOlb77MrNWfP48AjNQhdCguMBxqO9Fuc6', 'Kevin', 'DE LA TOURTE A LA VIANDE', 0, '2020-04-21 11:51:03', 0, '0'),
(6, 'alice.durand@orange.fr', '$2y$10$Xj9rD2gKwFiiE3Vygw/SGulOBQuuJAIcSONABaHGgyFYr8CJjlaTa', 'Alice', 'DURAND', 0, '2020-04-21 14:43:00', 0, '0'),
(7, 'marceaugerard1610@gmail.com', '$2y$10$fN6x.zVuvgaEklBpRt10eeKa1Al3yUEn073U9fWZlzeCcENOPrgWe', 'Marceau', 'GERARD', 1, '2020-04-22 11:13:02', 0, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
