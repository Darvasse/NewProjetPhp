-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 22 Juin 2021 à 14:47
-- Version du serveur :  10.1.10-MariaDB
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetphp`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `description`, `name`) VALUES
(1, 'Meurs pas c''est ton seul objectif', 'Survie'),
(2, 'TAPER', 'Action'),
(3, 'Partir loin des fous et vivre une aventure extraordinaire', 'Aventure'),
(4, 'Jeux de course de voiture, moto, cadis, enfin bref tout ce qui peut faire office de véhicule qui vas vite (ou pas)', 'Course');

-- --------------------------------------------------------

--
-- Structure de la table `categoriejeu`
--

CREATE TABLE `categoriejeu` (
  `id` int(11) NOT NULL,
  `idcategorie` int(11) NOT NULL,
  `idjeu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CategorieID` int(11) NOT NULL,
  `DownloadLink` varchar(255) NOT NULL,
  `creatorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `jeu`
--

INSERT INTO `jeu` (`id`, `Name`, `Description`, `CategorieID`, `DownloadLink`, `creatorID`) VALUES
(1, 'Minecraft', 'Rien à dire ça claque', 1, 'https://www.minecraft.net/fr-fr/get-minecraft', 0);

-- --------------------------------------------------------

--
-- Structure de la table `userjeu`
--

CREATE TABLE `userjeu` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idjeu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `userjeu`
--

INSERT INTO `userjeu` (`id`, `iduser`, `idjeu`) VALUES
(1, 8, 1),
(3, 8, 1),
(4, 8, 1),
(5, 8, 1),
(6, 8, 1),
(7, 8, 1),
(8, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(8, 'nico', 'nico@gmail.com', '$2y$10$QYDrcyRgc5EoW7uXzltOUu7WGml5DNNWZUJJntGJH3eJbxkviZgq2'),
(9, 'jean', 'jean@gmail.com', '$2y$10$GVX72snvfrbnaWV7DXc.A.7Q7ucS.bpNvV/9X1K1ZMZSvhJsyCh9K'),
(10, 'meme', 'meme@outlook.com', '$2y$10$eKtL7a2/gJeCZfe3I32o9ucbdbYo3gyYle/cp2A4SQJPPzWPOwtaO');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categoriejeu`
--
ALTER TABLE `categoriejeu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `userjeu`
--
ALTER TABLE `userjeu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `categoriejeu`
--
ALTER TABLE `categoriejeu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `userjeu`
--
ALTER TABLE `userjeu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
