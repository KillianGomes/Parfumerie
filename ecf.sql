-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 13 mars 2022 à 15:39
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecf`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(11) NOT NULL,
  `nom_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `nom_cat`) VALUES
(1, 'Deodorant'),
(2, 'Eau de toilette'),
(3, 'Eau de parfum');

-- --------------------------------------------------------

--
-- Structure de la table `grade`
--

CREATE TABLE `grade` (
  `id_g` int(11) NOT NULL,
  `nom_g` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `grade`
--

INSERT INTO `grade` (`id_g`, `nom_g`) VALUES
(1, 'Super admin'),
(2, 'Admin'),
(3, 'Simple user');

-- --------------------------------------------------------

--
-- Structure de la table `parfum`
--

CREATE TABLE `parfum` (
  `id_p` int(11) NOT NULL,
  `marque` varchar(50) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `prix` float NOT NULL,
  `contenance` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `quantite` int(11) NOT NULL,
  `id_cat_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `parfum`
--

INSERT INTO `parfum` (`id_p`, `marque`, `modele`, `prix`, `contenance`, `description`, `image`, `quantite`, `id_cat_categorie`) VALUES
(2, 'Dolce&amp;Gabbana', 'K', 102, '100ml', 'K by Dolce&amp;Gabbana est un parfum qui c&eacute;l&egrave;bre une nouvelle &egrave;re de masculinit&eacute;. Il &eacute;voque la campagne italienne et le soleil m&eacute;diterran&eacute;en du midi gr&acirc;ce &agrave; un m&eacute;lange de fra&icirc;cheur d\\\'agrumes, d\\\'orange sanguine et de citron sicilien.', 'k.jpg', 6, 2),
(3, 'Axe', 'Axe Black', 5, '150ml', 'Ne pas vaporise &amp; aggrave; moins de 15 cm. Eviter d\\\\\\\'inhaler intentionnellement. Produit par de pressions sans pulsation prolonge. Utiliser seulement dans des zones bien ventiler.', 'black.jpg', 26, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_u` int(11) NOT NULL,
  `nom_u` varchar(50) NOT NULL,
  `prenom_u` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `statut` int(11) NOT NULL,
  `id_g_grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_u`, `nom_u`, `prenom_u`, `login`, `pass`, `email`, `statut`, `id_g_grade`) VALUES
(2, 'admin1', 'admin1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 1, 2),
(3, 'user1', 'user1', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@user.com', 1, 3),
(4, 'kiki1', 'kiki1', 'kiki', '9b6ee95ea2c3d741052d0d41ed71d1c4', 'killiang94@outlook.fr', 1, 1),
(8, 'oceane1', 'oceane1', 'oceane', 'cfc5adef048746dac83216290dcead5b', 'oceane@oceane.com', 1, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id_g`);

--
-- Index pour la table `parfum`
--
ALTER TABLE `parfum`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `parfum_categorie_FK` (`id_cat_categorie`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_u`),
  ADD KEY `user_grade_FK` (`id_g_grade`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `grade`
--
ALTER TABLE `grade`
  MODIFY `id_g` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `parfum`
--
ALTER TABLE `parfum`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `parfum`
--
ALTER TABLE `parfum`
  ADD CONSTRAINT `parfum_categorie_FK` FOREIGN KEY (`id_cat_categorie`) REFERENCES `categorie` (`id_cat`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_grade_FK` FOREIGN KEY (`id_g_grade`) REFERENCES `grade` (`id_g`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
