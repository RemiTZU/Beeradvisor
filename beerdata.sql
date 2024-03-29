-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2022 at 07:29 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beerdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `beerinfo`
--

CREATE TABLE `beerinfo` (
  `Id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `degree` float NOT NULL,
  `type` text NOT NULL,
  `IBU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beerinfo`
--

INSERT INTO `beerinfo` (`Id`, `name`, `degree`, `type`, `IBU`) VALUES
(1, 'Leffe Blonde', 6.6, 'Lager', 38),
(2, 'Goudale Blonde', 7.2, 'Lager', 51),
(3, 'Chouffe Blonde', 8, 'Lager', 67),
(6, 'Heineken', 5, 'Lager', 50),
(7, 'Bête ambrée', 8, 'Lager', 33),
(14, 'Goudale Ambrée', 7.2, 'Brown Ale', 60),
(15, 'Goudale IPA', 7, 'IPA', 0),
(16, 'Goudale IPA', 7.2, 'IPA', 64),
(17, 'Mont Blanc - La Bleue', 5.8, '', 38);

-- --------------------------------------------------------

--
-- Table structure for table `beer_taste`
--

CREATE TABLE `beer_taste` (
  `id_beer` int(11) NOT NULL,
  `id_taste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beer_taste`
--

INSERT INTO `beer_taste` (`id_beer`, `id_taste`) VALUES
(7, 1),
(7, 2),
(1, 4),
(1, 5),
(1, 3),
(14, 6),
(14, 7),
(14, 8),
(14, 1),
(15, 9),
(15, 10),
(17, 11),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `beer_type`
--

CREATE TABLE `beer_type` (
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beer_type`
--

INSERT INTO `beer_type` (`name`, `description`) VALUES
('API', 'Originally, India Pale Ale or IPA was a British pale ale brewed with extra hops. High levels of this bittering agent made the beer stable enough to survive the long boat trip to India without spoiling. The extra dose of hops gives IPA beers their bitter taste. Depending on the style of hops used, IPAs may have fruit-forward citrus flavors or taste of resin and pine.\r\nAmerican brewers have taken the IPA style and run with it, introducing unusual flavors and ingredients to satisfy U.S. beer drinkers\' love for the brew style.'),
('Lager', 'Lagers are a newer style of beer with two key differences from ales. Lagers ferment for a long time at a low temperature, and they rely on bottom-fermenting yeasts, which sink to the bottom of the fermenting tank to do their magic.\r\nLagers are common among European countries, including Czechia, Germany, and the Netherlands, as well as in Canada, where they make up more than half of all beer sales.');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_biere` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `picture` blob DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `id_biere`, `id_user`, `rating`, `picture`, `description`, `date`) VALUES
(1, 1, 1, 3, NULL, 'Très bon', '2022-11-06'),
(2, 2, 1, 2, NULL, 'Pas mal mais trop mousseuse', '2022-11-06'),
(3, 3, 1, 0, NULL, 'On dirait de la pisse', '2022-11-06'),
(4, 4, 1, 5, NULL, 'J\'ai bandé juste en l\'ouvrant', '2022-11-06'),
(5, 6, 1, 3, NULL, 'Je préfere le cidre', '2022-11-06'),
(6, 2, 3, 4, NULL, 'Une des meilleures', '2022-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `idfollower` int(11) NOT NULL,
  `iduserfollow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `idlogins` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `adminstate` tinyint(1) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `f_name` text NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`idlogins`, `username`, `email`, `password`, `adminstate`, `birthdate`, `f_name`, `name`) VALUES
(1, 'ee', 'remi.bonnet@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$TnpqZ2ZDSEd0Q0N0d0Uvaw$Os7oTYjv+n2ZpmLht4UJyikV1QVGLea+Z/bqv1qWKk0', 0, '2003-11-18', 'Zop', 'Bong'),
(3, 'admin', 'bonnetremi74@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bU1wdFJWd09SVmpiQ3dPaQ$ZG0wX8rsgKGZzt0cPWwuXBhTdrChIk7yZbKjGSN56kE', 1, '2000-02-02', 'BONNET', 'Rémi'),
(4, 'tamtam', 'tom.kuntz@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$LjczMXRUSzdxNU1GajdYRg$WD9nriJ5D4L5bWg3TgkhE2dM3e9t3R7iqAR2JFZ5lFA', 0, '2003-04-25', 'tom', 'kuntz');

-- --------------------------------------------------------

--
-- Table structure for table `taste`
--

CREATE TABLE `taste` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taste`
--

INSERT INTO `taste` (`id`, `name`, `description`) VALUES
(1, 'Caramel', NULL),
(2, 'Pain d\'épice', 'Miel, cannelle, moelleux et parfumé'),
(3, 'Fruité', 'abondance de saveur de fruits'),
(4, 'Vanille', NULL),
(5, 'Clou de girofle', NULL),
(6, 'Chocolat', NULL),
(7, 'Café', NULL),
(8, 'Noisette', NULL),
(9, 'Agrume', NULL),
(10, 'Fruits exotiques', NULL),
(11, 'Myrtille', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beerinfo`
--
ALTER TABLE `beerinfo`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `beer_type`
--
ALTER TABLE `beer_type`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`idlogins`);

--
-- Indexes for table `taste`
--
ALTER TABLE `taste`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beerinfo`
--
ALTER TABLE `beerinfo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `idlogins` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taste`
--
ALTER TABLE `taste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
