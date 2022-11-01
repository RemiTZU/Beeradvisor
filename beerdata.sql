-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 01 nov. 2022 à 16:04
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
  `IBU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `beerinfo`
--

INSERT INTO `beerinfo` (`Id`, `Name`, `Degree`, `Type`, `IBU`) VALUES
(1, 'Leffe', 5, 'blonde', 3),
(2, 'goudale', 7.2, 'blonde', 5),
(3, 'Chouffe', 8, 'ambrée', 2),
(4, 'Mont Blanc', 5.8, 'brune', 3),
(6, 'Heineken', 5, 'blonde', 4);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `idcomment` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idbeer` int(11) NOT NULL,
  `content` text NOT NULL,
  `note` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `iduser` int(11) NOT NULL,
  `iduserfollow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `logins`
--

CREATE TABLE `logins` (
  `idlogins` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(4, 'z', 'z', 'z', 'bonnetremi74@gmail.com', '2003-11-18', '$argon2id$v=19$m=65536,t=4,p=1$YjU1LnduSWhIUGRyOTJJVA$G1Tw628IlaIDze+cyUezns+M47q5js+zpWE1KIXZ53E', '2022-10-17'),
(5, 'foef', 'eifj', 'epfij', 'jp.dasque@cegetel.net', '2000-05-18', '$argon2id$v=19$m=65536,t=4,p=1$Y0FhbTlURFJnUEdsandVRA$e9kv45ur444aXCS8s39saRppHRKUy8zgiuNZ8PD6B7E', '2022-10-18');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `beerinfo`
--
ALTER TABLE `beerinfo`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idcomment`);

--
-- Index pour la table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`idlogins`);

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
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `idcomment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `logins`
--
ALTER TABLE `logins`
  MODIFY `idlogins` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
