-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 27 nov. 2024 à 15:38
-- Version du serveur : 8.0.39
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `silvano_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `agences`
--

DROP TABLE IF EXISTS `agences`;
CREATE TABLE IF NOT EXISTS `agences` (
  `id_agence` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_agence`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `agences`
--

INSERT INTO `agences` (`id_agence`, `nom`, `email`, `status`) VALUES
(101, 'ANDRY', 'andry@gmail.com', '1'),
(115, 'SOLIRAF', 'premier@gmail.com', '1'),
(116, 'OTIV PORT', 'socobis@gmail.com', '1'),
(119, 'FIAVOTANA', 'fiavotana@gmail.com', '1');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `nom`, `prix`) VALUES
(1, 'Fiche d epargne', 480.00),
(3, 'Fiche de prêt', 554.00),
(5, 'Fiche d admission', 504.00),
(6, 'Fiche grand livre', 480.00);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id_commande` varchar(20) NOT NULL,
  `agence_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `status` enum('1','2','3') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT '1: encours, 2: livré, 3:abandonné',
  PRIMARY KEY (`id_commande`),
  KEY `fkcomagence_idx` (`agence_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id_commande`, `agence_id`, `date`, `status`) VALUES
('241127073230', 119, '2024-11-27', '1'),
('241127134014', 119, '2024-11-20', '2'),
('241127150314', 119, '2024-11-26', '1');

-- --------------------------------------------------------

--
-- Structure de la table `com_articles`
--

DROP TABLE IF EXISTS `com_articles`;
CREATE TABLE IF NOT EXISTS `com_articles` (
  `id_com_article` int NOT NULL AUTO_INCREMENT,
  `commande_id` varchar(20) NOT NULL,
  `article_id` int DEFAULT NULL,
  `qte` int DEFAULT '0',
  `prix` double(15,2) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_com_article`),
  KEY `fkcomarticle_idx` (`commande_id`),
  KEY `fkarticle_idx` (`article_id`),
  KEY `commande_id` (`commande_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `com_articles`
--

INSERT INTO `com_articles` (`id_com_article`, `commande_id`, `article_id`, `qte`, `prix`) VALUES
(4, '241127073230', 1, 10, 480.00),
(5, '241127073230', 3, 20, 554.00),
(6, '241127073230', 5, 40, 504.00),
(7, '241127134014', 1, 15, 480.00),
(8, '241127134014', 6, 30, 480.00),
(10, '241127150314', 1, 100, 480.00),
(11, '241127150314', 3, 50, 554.00),
(12, '241127150314', 5, 30, 504.00);

-- --------------------------------------------------------

--
-- Structure de la table `com_articles_tmp`
--

DROP TABLE IF EXISTS `com_articles_tmp`;
CREATE TABLE IF NOT EXISTS `com_articles_tmp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `agence_id` int NOT NULL,
  `article_id` int DEFAULT NULL,
  `qte` int DEFAULT '0',
  `prix` double(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_agence_article` (`agence_id`,`article_id`),
  KEY `fkarticle_idx` (`article_id`),
  KEY `agene_id` (`agence_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `agence_id` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `agence_id` (`agence_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `agence_id`, `password`, `created_at`) VALUES
(1, 'josue', 119, '1234', '2024-11-03 19:06:17'),
(2, 'vano', 115, 'vano', '2024-11-04 07:30:06');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `fkcomagence` FOREIGN KEY (`agence_id`) REFERENCES `agences` (`id_agence`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `com_articles`
--
ALTER TABLE `com_articles`
  ADD CONSTRAINT `com_articles_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id_commande`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fkarticle` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id_article`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
