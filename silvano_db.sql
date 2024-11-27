-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 27 nov. 2024 à 22:39
-- Version du serveur : 8.0.31
-- Version de PHP : 8.3.11

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

CREATE TABLE `agences` (
  `id_agence` int NOT NULL,
  `nom` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `agences`
--

INSERT INTO `agences` (`id_agence`, `nom`, `email`, `status`) VALUES
(101, 'ANDRY', 'andry@gmail.com', '1'),
(115, 'SOLIRAF', 'premier@gmail.com', '1'),
(116, 'OTIV PORT', 'socobis@gmail.com', '1'),
(118, 'VOHITRA', 'hohitra@otivzl.mg', '1'),
(119, 'FIAVOTANA', 'fiavotana@gmail.com', '1'),
(124, 'TRANAMBO', 'tranambo@gmail.com', '1'),
(127, 'SANDRIFY', 'sandrify@gmail.com', '1');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id_article` int NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `nom`, `prix`) VALUES
(1, 'Fiche d epargne', '480.00'),
(3, 'Fiche de prêt', '554.00'),
(5, 'Fiche d admission', '504.00'),
(6, 'Fiche grand livre', '480.00');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id_commande` varchar(20) NOT NULL,
  `agence_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `status` enum('1','2','3','4') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT '1: encours, 2: livré, 3:abandonné, 4: reçu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id_commande`, `agence_id`, `date`, `status`) VALUES
('241127073230', 119, '2024-11-27', '4'),
('241127134014', 119, '2024-11-20', '4'),
('241127150314', 119, '2024-11-26', '2'),
('241127223243', 119, '2024-11-28', '4'),
('241127223641', 119, '2024-11-28', '4');

-- --------------------------------------------------------

--
-- Structure de la table `com_articles`
--

CREATE TABLE `com_articles` (
  `id_com_article` int NOT NULL,
  `commande_id` varchar(20) NOT NULL,
  `article_id` int DEFAULT NULL,
  `qte` int DEFAULT '0',
  `prix` double(15,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
(12, '241127150314', 5, 30, 504.00),
(13, '241127223243', 3, 30, 554.00),
(14, '241127223243', 6, 25, 480.00),
(16, '241127223641', 1, 60, 480.00),
(17, '241127223641', 5, 65, 504.00);

-- --------------------------------------------------------

--
-- Structure de la table `com_articles_tmp`
--

CREATE TABLE `com_articles_tmp` (
  `id` int NOT NULL,
  `agence_id` int NOT NULL,
  `article_id` int DEFAULT NULL,
  `qte` int DEFAULT '0',
  `prix` double(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `expeditions`
--

CREATE TABLE `expeditions` (
  `id_exp` int NOT NULL,
  `commande_id` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `date_exp` date DEFAULT NULL,
  `type_trans` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_exp` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `expeditions`
--

INSERT INTO `expeditions` (`id_exp`, `commande_id`, `date_exp`, `type_trans`, `ref_exp`) VALUES
(1, '241127073230', '2024-11-27', '1', 'CONTRASU VOITURE 2356AC'),
(2, '241127150314', '2024-11-27', '1', 'FENOSOAVA VOITURE 2878AC'),
(3, '241127223243', '2024-11-28', '1', 'CONTRASU VOITURE 2356AC'),
(4, '241127223641', '2024-11-28', '1', 'CONTRASU VOITURE 2356AC');

-- --------------------------------------------------------

--
-- Structure de la table `stocks`
--

CREATE TABLE `stocks` (
  `id_stock` int NOT NULL,
  `commande_id` varchar(20) NOT NULL,
  `article_id` int DEFAULT NULL,
  `entree` int DEFAULT '0',
  `sortie` int NOT NULL DEFAULT '0',
  `prix` double(15,2) UNSIGNED NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `stocks`
--

INSERT INTO `stocks` (`id_stock`, `commande_id`, `article_id`, `entree`, `sortie`, `prix`) VALUES
(1, '241127073230', 1, 0, 10, 480.00),
(2, '241127073230', 3, 0, 20, 554.00),
(3, '241127073230', 5, 0, 40, 504.00),
(4, '241127134014', 1, 0, 15, 480.00),
(5, '241127134014', 6, 0, 30, 480.00),
(7, '241127073230', 1, 100, 0, 480.00),
(8, '241127073230', 3, 170, 0, 480.00),
(9, '241127073230', 5, 180, 0, 480.00),
(10, '241127073230', 6, 120, 0, 480.00),
(11, '241127223243', 3, 0, 30, 554.00),
(12, '241127223243', 6, 0, 25, 480.00),
(14, '241127223641', 1, 0, 60, 480.00),
(15, '241127223641', 5, 0, 65, 504.00);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `agence_id` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `agence_id`, `password`, `created_at`) VALUES
(1, 'josue', 119, '1234', '2024-11-03 19:06:17'),
(2, 'vano', 115, 'vano', '2024-11-04 07:30:06');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agences`
--
ALTER TABLE `agences`
  ADD PRIMARY KEY (`id_agence`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `fkcomagence_idx` (`agence_id`);

--
-- Index pour la table `com_articles`
--
ALTER TABLE `com_articles`
  ADD PRIMARY KEY (`id_com_article`),
  ADD KEY `fkcomarticle_idx` (`commande_id`),
  ADD KEY `fkarticle_idx` (`article_id`),
  ADD KEY `commande_id` (`commande_id`);

--
-- Index pour la table `com_articles_tmp`
--
ALTER TABLE `com_articles_tmp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `i_agence_article` (`agence_id`,`article_id`),
  ADD KEY `fkarticle_idx` (`article_id`),
  ADD KEY `agene_id` (`agence_id`);

--
-- Index pour la table `expeditions`
--
ALTER TABLE `expeditions`
  ADD PRIMARY KEY (`id_exp`),
  ADD KEY `commande_id` (`commande_id`);

--
-- Index pour la table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `fkcomarticle_idx` (`commande_id`),
  ADD KEY `fkarticle_idx` (`article_id`),
  ADD KEY `commande_id` (`commande_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `agence_id` (`agence_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agences`
--
ALTER TABLE `agences`
  MODIFY `id_agence` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `com_articles`
--
ALTER TABLE `com_articles`
  MODIFY `id_com_article` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `com_articles_tmp`
--
ALTER TABLE `com_articles_tmp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `expeditions`
--
ALTER TABLE `expeditions`
  MODIFY `id_exp` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id_stock` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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

--
-- Contraintes pour la table `expeditions`
--
ALTER TABLE `expeditions`
  ADD CONSTRAINT `expeditions_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id_commande`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id_commande`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
