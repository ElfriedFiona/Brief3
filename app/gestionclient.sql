-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 24 mars 2025 à 14:31
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionclient`
--

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'client');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `login_time`, `logout_time`) VALUES
(1, 1, '2025-03-21 07:21:58', '2025-03-21 07:22:29'),
(2, 1, '2025-03-21 07:23:23', '2025-03-21 10:17:48'),
(3, 2, '2025-03-21 10:19:36', '2025-03-21 12:10:42'),
(4, 2, '2025-03-21 12:10:59', '2025-03-21 12:11:14'),
(5, 1, '2025-03-21 12:11:29', '2025-03-21 12:14:19'),
(6, 2, '2025-03-21 12:14:35', '2025-03-21 12:15:13'),
(7, 1, '2025-03-21 12:15:28', '2025-03-21 12:24:33'),
(8, 3, '2025-03-21 12:26:16', '2025-03-21 12:27:37'),
(10, 1, '2025-03-21 12:30:22', '2025-03-21 12:42:57'),
(11, 2, '2025-03-21 12:43:09', '2025-03-21 14:41:22'),
(12, 1, '2025-03-22 05:49:35', NULL),
(13, 1, '2025-03-22 05:53:32', NULL),
(14, 5, '2025-03-22 06:29:06', NULL),
(15, 5, '2025-03-22 06:56:00', '2025-03-24 06:07:26'),
(16, 1, '2025-03-24 06:09:47', '2025-03-24 06:41:31'),
(17, 1, '2025-03-24 06:42:00', '2025-03-24 06:42:37'),
(18, 6, '2025-03-24 06:43:06', '2025-03-24 08:54:30'),
(19, 1, '2025-03-24 08:54:54', '2025-03-24 12:34:10'),
(20, 6, '2025-03-24 12:35:29', '2025-03-24 12:43:58'),
(21, 1, '2025-03-24 12:44:10', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `status`, `created_at`) VALUES
(1, 'administrateur', 'elfriedfiona@gmail.com', '$2y$10$emaq1T8jU/3mJMCs1csfsev6MMspR.KaYBF0vqOTnpDoXT.CSXymW', 1, 'active', '2025-03-21 07:19:48'),
(2, 'wendy', 'wendy@gmail.com', '$2y$10$MpCSiuak3158Xrgg5w9/k.Ilw.LgqytUp6c7qVFhx7KtDmOvnEV9K', 2, 'active', '2025-03-21 10:17:24'),
(3, 'FIONA', 'elfried0207@gmail.com', '$2y$10$ab7/CgdagmtcKspkQT9Zm.xEnKGzlomEXSo5Q/mbZIBVJCbjjbApK', 1, 'active', '2025-03-21 12:24:20'),
(5, 'pierre', 'pierre@gmail.com', '$2y$10$dlovG/qq9Mskbc5eomh1Kedk8RoZfa/QJscjdwtOS7mEceftwkrGW', 2, 'active', '2025-03-22 05:58:29'),
(6, 'bonjour', 'bonjour@gmail.com', '$2y$10$iIYEkNuM1.ayN5pu.w1MxOSO.QAl.pSb3fF.FVzs4a5CrKUV6ljTm', 2, 'active', '2025-03-24 06:15:54');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
