-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 05 Mars 2017 à 14:36
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `anime`
--

-- --------------------------------------------------------

--
-- Structure de la table `anime`
--

CREATE TABLE `anime` (
  `id` int(11) NOT NULL,
  `editeur_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `genre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `release_date` datetime NOT NULL,
  `is_release` tinyint(1) NOT NULL,
  `consulted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `anime`
--

INSERT INTO `anime` (`id`, `editeur_id`, `name`, `genre`, `description`, `release_date`, `is_release`, `consulted`) VALUES
(1, 1, 'Sword Art Online', 'Action, romance, fantasy, science-fiction', 'Cette série raconte les aventures de Kirito qui se retrouve piégé dans un jeu massivement multi-joueurs, Sword Art Online.\r\n\r\nEn 2022, l’humanité a réussi à créer une réalité virtuelle. Grâce à un casque, les humains peuvent se plonger entièrement dans le monde virtuel en étant comme déconnectés de la réalité, et Sword Art Online est le premier MMORPG a utiliser ce système. Mais voila que le premier jour de jeu, 10 000 personnes se retrouvent piégées dans cette réalité virtuelle par son créateur : Akihiko Kayaba. Le seul moyen d’en sortir est de finir le jeu. Mais ce ne sera pas facile de sortir de ce monde virtuel puisque si un joueur perd la partie, il meurt également dans la vraie vie.\r\n\r\nKirito décide alors de partir à la conquête du jeu en solo, avec pour avantage le fait de faire partie des 1 000 ex-bêta-testeurs, mais arrivera-t-il à terminer les 99 donjons et leurs boss ?', '2012-07-07 00:00:00', 1, 18),
(2, 2, 'Blood Blockade Battlefront', 'Action, surnaturel, fantasy', 'Il y a trois ans, une brèche séparant la planète Terre du monde des morts s\'est ouverte en plein milieu de la ville de New York, piégeant ainsi ses habitants et par la même occasion des créatures venant d\'autres dimensions dans une bulle impénétrable. Après avoir été détruite et reconstruit la ville de New York est rebaptisée Jerusalem’s Lot, où l\'ordinaire côtoie l\'extraordinaire, et où certains humains peu scrupuleux exploite ces nouvelles capacités pour leur profit. Alors que les humains et démons cohabitent depuis des années dans un monde en proie au chaos et à la folie, un groupe menace de percer la bulle et déverser le chaos du nouveau Jérusalem sur la terre entière. Pour empêcher un tel désastre de se produire, un groupe de surhommes, les mystérieux supers agents de Libra (Klaus Rineberts, la femme loup-garou Frau Jane et le majordome momie Gilbert), sera envoyé pour arrêter cette menace.', '2017-02-20 00:00:00', 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `anime_studio`
--

CREATE TABLE `anime_studio` (
  `anime_id` int(11) NOT NULL,
  `studio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `anime_studio`
--

INSERT INTO `anime_studio` (`anime_id`, `studio_id`) VALUES
(1, 1),
(1, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE `editeur` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `editeur`
--

INSERT INTO `editeur` (`id`, `name`) VALUES
(1, 'ASCII Media Works'),
(2, 'Kōdansha');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `anime_id` int(11) DEFAULT NULL,
  `dateMaj` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `anime_id`, `dateMaj`, `title`, `content`) VALUES
(1, 1, '2017-02-19 00:00:00', 'Premières infos sur le film animation Sword Art Online : Ordinal Scale LOL', 'L’histoire se déroule après les événements de la Saison 2 de l’anime (SAO Phantom Bullet).\r\nOrdinal Scale est le nouveau jeu à la mode. Il utilise un tout nouvel appareil de réalité augmentée du nom de Augma.\r\nAinsi les joueurs font des quêtes dans le monde réel grâce aux éléments virtuels qui apparaissent à divers endroits de la ville, augmentent leur niveau en se battant contre des monstres et utilisent divers items pour progresser dans leur quête.\r\nNous suivons Kirito, Asuna, et leurs amis, dans ce nouveau système où les batailles de PvP (joueur vs joueur) sont monnaie courante.'),
(2, 1, '2017-02-16 00:00:00', 'Premières infos sur le film animation Sword Art Online : Ordinal Scale', 'L’histoire se déroule après les événements de la Saison 2 de l’anime (SAO Phantom Bullet).\r\nOrdinal Scale est le nouveau jeu à la mode. Il utilise un tout nouvel appareil de réalité augmentée du nom de Augma.\r\nAinsi les joueurs font des quêtes dans le monde réel grâce aux éléments virtuels qui apparaissent à divers endroits de la ville, augmentent leur niveau en se battant contre des monstres et utilisent divers items pour progresser dans leur quête.\r\nNous suivons Kirito, Asuna, et leurs amis, dans ce nouveau système où les batailles de PvP (joueur vs joueur) sont monnaie courante.'),
(3, 2, '2017-02-15 00:00:00', 'L’anime Blood Blockade Battlefront Saison 2 (Kekkai Sensen Saison 2), annoncé', 'Intitulée Blood Blockade Battlefront & Beyond (Kekkai Sensen & BEYOND), la série animée est prévue pour 2017, au Japon & en France (animedigitalnetwork.fr puis en bluray aux éditions Kazé).\r\nA noter que le Staff Animation a changé.'),
(4, 2, '2017-02-15 00:00:00', 'L’anime Blood Blockade Battlefront Saison 2 (Kekkai Sensen Saison 2), annoncé', 'Intitulée Blood Blockade Battlefront & Beyond (Kekkai Sensen & BEYOND), la série animée est prévue pour 2017, au Japon & en France (animedigitalnetwork.fr puis en bluray aux éditions Kazé).\r\nA noter que le Staff Animation a changé.'),
(5, 1, '2017-02-16 00:00:00', 'Premières infos sur le film animation Sword Art Online : Ordinal Scale', 'L’histoire se déroule après les événements de la Saison 2 de l’anime (SAO Phantom Bullet).\r\nOrdinal Scale est le nouveau jeu à la mode. Il utilise un tout nouvel appareil de réalité augmentée du nom de Augma.\r\nAinsi les joueurs font des quêtes dans le monde réel grâce aux éléments virtuels qui apparaissent à divers endroits de la ville, augmentent leur niveau en se battant contre des monstres et utilisent divers items pour progresser dans leur quête.\r\nNous suivons Kirito, Asuna, et leurs amis, dans ce nouveau système où les batailles de PvP (joueur vs joueur) sont monnaie courante.'),
(6, 1, '2017-02-16 00:00:00', 'Premières infos sur le film animation Sword Art Online : Ordinal Scale', 'L’histoire se déroule après les événements de la Saison 2 de l’anime (SAO Phantom Bullet).\r\nOrdinal Scale est le nouveau jeu à la mode. Il utilise un tout nouvel appareil de réalité augmentée du nom de Augma.\r\nAinsi les joueurs font des quêtes dans le monde réel grâce aux éléments virtuels qui apparaissent à divers endroits de la ville, augmentent leur niveau en se battant contre des monstres et utilisent divers items pour progresser dans leur quête.\r\nNous suivons Kirito, Asuna, et leurs amis, dans ce nouveau système où les batailles de PvP (joueur vs joueur) sont monnaie courante.'),
(7, 1, '2017-02-16 00:00:00', 'Premières infos sur le film animation Sword Art Online : Ordinal Scale', 'L’histoire se déroule après les événements de la Saison 2 de l’anime (SAO Phantom Bullet).\r\nOrdinal Scale est le nouveau jeu à la mode. Il utilise un tout nouvel appareil de réalité augmentée du nom de Augma.\r\nAinsi les joueurs font des quêtes dans le monde réel grâce aux éléments virtuels qui apparaissent à divers endroits de la ville, augmentent leur niveau en se battant contre des monstres et utilisent divers items pour progresser dans leur quête.\r\nNous suivons Kirito, Asuna, et leurs amis, dans ce nouveau système où les batailles de PvP (joueur vs joueur) sont monnaie courante.'),
(8, 1, '2017-02-16 00:00:00', 'Premières infos sur le film animation Sword Art Online : Ordinal Scale', 'L’histoire se déroule après les événements de la Saison 2 de l’anime (SAO Phantom Bullet).\r\nOrdinal Scale est le nouveau jeu à la mode. Il utilise un tout nouvel appareil de réalité augmentée du nom de Augma.\r\nAinsi les joueurs font des quêtes dans le monde réel grâce aux éléments virtuels qui apparaissent à divers endroits de la ville, augmentent leur niveau en se battant contre des monstres et utilisent divers items pour progresser dans leur quête.\r\nNous suivons Kirito, Asuna, et leurs amis, dans ce nouveau système où les batailles de PvP (joueur vs joueur) sont monnaie courante.'),
(9, 1, '2017-02-16 00:00:00', 'Premières infos sur le film animation Sword Art Online : Ordinal Scale', 'L’histoire se déroule après les événements de la Saison 2 de l’anime (SAO Phantom Bullet).\r\nOrdinal Scale est le nouveau jeu à la mode. Il utilise un tout nouvel appareil de réalité augmentée du nom de Augma.\r\nAinsi les joueurs font des quêtes dans le monde réel grâce aux éléments virtuels qui apparaissent à divers endroits de la ville, augmentent leur niveau en se battant contre des monstres et utilisent divers items pour progresser dans leur quête.\r\nNous suivons Kirito, Asuna, et leurs amis, dans ce nouveau système où les batailles de PvP (joueur vs joueur) sont monnaie courante.'),
(10, 1, '2017-02-16 00:00:00', 'Premières infos sur le film animation Sword Art Online : Ordinal Scale', 'L’histoire se déroule après les événements de la Saison 2 de l’anime (SAO Phantom Bullet).\r\nOrdinal Scale est le nouveau jeu à la mode. Il utilise un tout nouvel appareil de réalité augmentée du nom de Augma.\r\nAinsi les joueurs font des quêtes dans le monde réel grâce aux éléments virtuels qui apparaissent à divers endroits de la ville, augmentent leur niveau en se battant contre des monstres et utilisent divers items pour progresser dans leur quête.\r\nNous suivons Kirito, Asuna, et leurs amis, dans ce nouveau système où les batailles de PvP (joueur vs joueur) sont monnaie courante.'),
(11, 1, '2017-02-16 00:00:00', 'TEST Premières infos sur le film animation Sword Art Online : Ordinal Scale', 'L’histoire se déroule après les événements de la Saison 2 de l’anime (SAO Phantom Bullet).\r\nOrdinal Scale est le nouveau jeu à la mode. Il utilise un tout nouvel appareil de réalité augmentée du nom de Augma.\r\nAinsi les joueurs font des quêtes dans le monde réel grâce aux éléments virtuels qui apparaissent à divers endroits de la ville, augmentent leur niveau en se battant contre des monstres et utilisent divers items pour progresser dans leur quête.\r\nNous suivons Kirito, Asuna, et leurs amis, dans ce nouveau système où les batailles de PvP (joueur vs joueur) sont monnaie courante.');

-- --------------------------------------------------------

--
-- Structure de la table `studio`
--

CREATE TABLE `studio` (
  `id` int(11) NOT NULL,
  `editeur_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `released_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `studio`
--

INSERT INTO `studio` (`id`, `editeur_id`, `name`, `released_date`) VALUES
(1, 1, 'A-1 Pictures', '2012-05-09'),
(2, 1, 'Kyoto Animation', '2017-02-01'),
(3, 2, 'Bones', '2017-02-21');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_130459423375BD21` (`editeur_id`);

--
-- Index pour la table `anime_studio`
--
ALTER TABLE `anime_studio`
  ADD PRIMARY KEY (`anime_id`,`studio_id`),
  ADD KEY `IDX_FC2183EB794BBE89` (`anime_id`),
  ADD KEY `IDX_FC2183EB446F285F` (`studio_id`);

--
-- Index pour la table `editeur`
--
ALTER TABLE `editeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1DD39950794BBE89` (`anime_id`);

--
-- Index pour la table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4A2B07B63375BD21` (`editeur_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `anime`
--
ALTER TABLE `anime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `editeur`
--
ALTER TABLE `editeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `studio`
--
ALTER TABLE `studio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `anime`
--
ALTER TABLE `anime`
  ADD CONSTRAINT `FK_130459423375BD21` FOREIGN KEY (`editeur_id`) REFERENCES `editeur` (`id`);

--
-- Contraintes pour la table `anime_studio`
--
ALTER TABLE `anime_studio`
  ADD CONSTRAINT `FK_FC2183EB446F285F` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`id`),
  ADD CONSTRAINT `FK_FC2183EB794BBE89` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`);

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `FK_1DD39950794BBE89` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`);

--
-- Contraintes pour la table `studio`
--
ALTER TABLE `studio`
  ADD CONSTRAINT `FK_4A2B07B63375BD21` FOREIGN KEY (`editeur_id`) REFERENCES `editeur` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
