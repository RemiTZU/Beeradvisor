-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 17 oct. 2022 à 11:33
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `beerdata`
--

-- --------------------------------------------------------

--
-- Structure de la table `beerinfo`
--

CREATE TABLE `beerinfo` (
  `Id` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Degree` float NOT NULL,
  `Type` text NOT NULL,
  `Taste` text NOT NULL,
  `Bitterness` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `beerinfo`
--

INSERT INTO `beerinfo` (`Id`, `Name`, `Degree`, `Type`, `Taste`, `Bitterness`) VALUES
(1, 'Leffe', 5, 'pale Ale', 'Honey, fruity, plummy, bready, banana and clove yeast', '3/5'),
(2, 'goudale', 7.2, 'lager', 'Sweet and fruity flavours, notes of yeast, sharp bitterness', '2/5'),
(3, 'Chouffe', 8, 'Pale Ale', '	\r\nHoppy, fruity plum and citrus, spicy Belgian yeast', '3/5'),
(4, 'Mont Blanc', 5.8, 'Pale Ale', 'Flavours of fruit and hops, light bitterness', '2/5'),
(6, 'Heineken', 5, 'Lager Pale', 'light and simple', '2.5/5');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` text NOT NULL,
  `f_name` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `birthdate` date NOT NULL,
  `password` text NOT NULL,
  `datecreation` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table information utilisateur';

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`iduser`, `username`, `f_name`, `name`, `email`, `birthdate`, `password`, `datecreation`) VALUES
(1, 'j', 'j', 'j', 'remi.bonnet@utbm.fr', '2003-11-18', '$argon2id$v=19$m=65536,t=4,p=1$TGxiSzlpeVJJbjd0WU9JQg$XfI4ZLD6NMJZ9W+NG0xdjQALc0uL0XkqUxRsvDjUZ5U', '2022-10-16'),
(3, 'a', 'a', 'a', 'bonnetremi74@gmail.com', '2003-11-18', 'dd', '2022-10-16');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `beerinfo`
--
ALTER TABLE `beerinfo`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `beerinfo`
--
ALTER TABLE `beerinfo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
