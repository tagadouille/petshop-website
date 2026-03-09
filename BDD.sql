DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Basket;
DROP TABLE IF EXISTS Historic;
DROP TABLE IF EXISTS Score;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Subcategory;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Customer;
DROP TABLE IF EXISTS Seller;
DROP TABLE IF EXISTS Admin;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 13 mai 2024 à 17:30
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `Admin`
--

CREATE TABLE `Admin` (
  `id` int(255) UNSIGNED NOT NULL,
  `surname` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `pseudo` varchar(32) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `sex` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Admin`
--

INSERT INTO `Admin` (`id`, `surname`, `name`, `pseudo`, `psw`, `birthdate`, `sex`) VALUES
(1, 'Sarceault', 'Basile', 'TheAdmin', '$2y$10$UbiOm05kRsqCX2v1IGvt5OXbK0QityOzYa8rz2QFaPI.Mgiun54CS', '0213-03-29', 'homme');

-- --------------------------------------------------------

--
-- Structure de la table `Basket`
--

CREATE TABLE `Basket` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `idProduct` int(255) UNSIGNED NOT NULL,
  `idCustomer` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Category`
--

CREATE TABLE `Category` (
  `name` varchar(60) NOT NULL,
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Category`
--

INSERT INTO `Category` (`name`, `id`) VALUES
('Chat', 1),
('Chien', 2),
('Oiseau', 3);

-- --------------------------------------------------------

--
-- Structure de la table `Comment`
--

CREATE TABLE `Comment` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `idCustomer` int(255) UNSIGNED NOT NULL,
  `idProduct` int(255) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Comment`
--

INSERT INTO `Comment` (`id`, `idCustomer`, `idProduct`, `text`, `image`, `date`) VALUES
(1, 1, 2, 'Mon chat s\'est amusé avec ce jouet mais il ne semble pas l\'apprécié. Dommage', 'NULL', '2024-05-13 15:47:06'),
(3, 1, 10, 'Très pratique pour promener son chien sur des sols qui pourraient le blésser. Je recommande. Mais le prix est assez cher', 'NULL', '2024-05-13 15:49:25'),
(4, 1, 4, 'C\'est une très bonne litière que je recommande beaucoup. Elle absorbe très bien l\'urine', 'NULL', '2024-05-13 15:50:42'),
(5, 2, 2, 'Mon chat adore ce jouet. Je suis satisfait de cet achat', 'NULL', '2024-05-13 16:07:47'),
(6, 2, 23, 'Depuis que j\'ai acheté ces vitamines à mon oiseau, il est plus en forme.', 'NULL', '2024-05-13 16:10:14'),
(7, 2, 6, 'Bol bon marché qui convient bien à mon chien', 'NULL', '2024-05-13 16:11:22'),
(9, 2, 19, 'La cabane que j\'ai reçu ne correspond pas avec l\'image sur le site. À éviter! Ci-joint la cabane que j\'ai reçu', '1715609770_qldqlld.jpeg', '2024-05-13 16:16:10');

-- --------------------------------------------------------

--
-- Structure de la table `Customer`
--

CREATE TABLE `Customer` (
  `id` int(255) UNSIGNED NOT NULL,
  `surname` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `pseudo` varchar(32) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `sex` varchar(32) NOT NULL,
  `country` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Customer`
--

INSERT INTO `Customer` (`id`, `surname`, `name`, `pseudo`, `psw`, `birthdate`, `sex`, `country`, `address`) VALUES
(1, 'Bertault', 'Marie', 'mari', '$2y$10$gz7tF6pCQgYlvAipM9QrResI0zzLUjUu68DsZtwijgJABaNJbUL5m', '1978-09-29', 'femme', 'France', '77 rue Pierre Sars'),
(2, 'Boîte', 'Henry', 'Laboite', '$2y$10$Ix4vkLKT4SvKWJn3IdZ/OuirrMoJzMzcCV7T5FFSMRh3lAFBIBEb.', '2001-09-12', 'intersexe', 'France', '30 Avenue Champ Elysée Paris');

-- --------------------------------------------------------

--
-- Structure de la table `Historic`
--

CREATE TABLE `Historic` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `idProduct` int(255) UNSIGNED NOT NULL,
  `idCustomer` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Historic`
--

INSERT INTO `Historic` (`id`, `date`, `idProduct`, `idCustomer`) VALUES
(1, '2024-05-13', 2, 1),
(2, '2024-05-13', 4, 1),
(3, '2024-05-13', 4, 1),
(4, '2024-05-13', 4, 1),
(5, '2024-05-13', 4, 1),
(6, '2024-05-13', 4, 1),
(7, '2024-05-13', 4, 1),
(8, '2024-05-13', 4, 1),
(9, '2024-05-13', 4, 1),
(10, '2024-05-13', 10, 1),
(11, '2024-05-13', 2, 2),
(12, '2024-05-13', 2, 2),
(13, '2024-05-13', 4, 2),
(14, '2024-05-13', 23, 2),
(15, '2024-05-13', 6, 2),
(16, '2024-05-13', 6, 2),
(17, '2024-05-13', 6, 2),
(18, '2024-05-13', 12, 2),
(19, '2024-05-13', 12, 2),
(20, '2024-05-13', 19, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Product`
--

CREATE TABLE `Product` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `price` double(255,2) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `image` varchar(255) NOT NULL,
  `sellnumber` int(255) NOT NULL DEFAULT 0,
  `category` int(64) UNSIGNED NOT NULL,
  `subcategory` int(64) UNSIGNED NOT NULL,
  `idSeller` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Product`
--

INSERT INTO `Product` (`id`, `name`, `description`, `price`, `date`, `image`, `sellnumber`, `category`, `subcategory`, `idSeller`) VALUES
(1, 'Hill\'s Science Plan Adult Poulet 3 kg ', 'Nourriture pour chat adulte. \r\n\r\n-Avec de la précieuse taurine\r\n-Pour une digestion saine et en douceur\r\n-Avec une teneur équilibrée en minéraux', 29.95, '2024-05-13', '1713950164_Hills.jpg', 0, 1, 1, 1),
(2, ' JR Farm Boule à l’herbe-aux-chats', 'Boule en osier remplie de 3 boules d’herbe-aux-chats\r\nHerbe-à-chat de Bavière pour bien s’amuser\r\n', 6.79, '2024-05-13', '1713950735_JRFarm.jpg', 3, 1, 2, 1),
(3, ' ROYAL CANIN Fit 32 Croquettes Chat 400 g\r\n', 'Croquette pour chat adulte', 3.89, '2024-05-13', '1713950414_royalCanin.jpg', 0, 1, 1, 1),
(4, 'MultiFit Hygiene White 20 l ', 'Ultra-blanche et pure\r\nLitière minérale non agglomérante\r\nParticulièrement absorbante', 13.98, '2024-05-13', '1713951137_Multifit.jpeg', 9, 1, 20, 1),
(5, 'PREMIERE Kit d’équipement de base AniOne pour l’hygiène des chats ', 'Kit idéal pour débuter\r\nAvec litière Premiere Excellent\r\nAvec de supers produits pour l’hygiène des chats', 50.88, '2024-05-13', '1713951354_packlitiere.jpg', 0, 1, 20, 1),
(6, 'AniOne Bol à nourriture en acier inoxydable plate ', 'Antirouille\r\nLavable au lave-vaisselle\r\nPositionnement stable', 0.88, '2024-05-13', '1713951879_gamelleChat.jpg', 3, 1, 4, 2),
(7, 'MORE Sac de transport Duke FOR ', 'Coussin inclus\r\nCourte laisse intégrée\r\nespace pouvant être agrandi', 67.09, '2024-05-13', '1713952142_sacachat.jpg', 0, 1, 13, 2),
(8, 'PRO PLAN Adult Medium Sensitive Skin 3 kg ', 'Sans ajout de colorants\r\nHaute teneur en protéines\r\nFavorise une peau saine et un poil brillant', 15.88, '2024-05-13', '1713952644_croquetteChien.jpg', 0, 2, 8, 1),
(9, 'FIT+FUN Balle en mousse de caoutchouc ', 'idéale pour les séances de lancer et rapporter\r\nDivers designs de sport\r\nbon pour les dents', 2.57, '2024-05-13', '1713953217_ball.jpg', 0, 2, 11, 1),
(10, ' Dogs Creek Protège-pattes Hiker S', 'avec bandes réfléchissantes\r\nmatière du dessus respirante\r\ncouche de polaire imperméable et anti-salissures', 27.77, '2024-05-13', '1713956845_chaussure.jpg', 1, 2, 14, 2),
(11, 'AniOne Bol à nourriture en acier inoxydable plate ', 'Antirouille\r\nLavable au lave-vaisselle\r\nPositionnement stable', 8.67, '2024-05-13', '1713957884_gamelleChien.jpg', 0, 2, 13, 1),
(12, 'PREMIERE Mini Sticks poulet et riz 70 g ', '54 % de viande, séchée à l’air\r\nSans colorants ni arômes artificiels\r\nDéveloppé par des vétérinaires', 4.09, '2024-05-13', '1713961644_StickChien.jpeg', 2, 2, 8, 1),
(13, 'Cage', 'Grande cage pour perroquet, bon état.', 50.00, '2024-05-13', '1714424943_th(7).jpg', 0, 3, 16, 3),
(14, 'Volière ', 'Grand espace qui peut accueillir 10 ara bleu sans encombre.', 200.00, '2024-05-13', '1714424988_th(8).jpg', 0, 3, 16, 3),
(15, 'Petite cage', 'Petite cage pour oiseau à petit gabaris.', 12.99, '2024-05-13', '1714424872_th(2).jpg', 0, 3, 16, 3),
(16, 'Petite maison', 'Petite maison en hauteur en bois pour oiseau à petit gabaries ', 10.00, '2024-05-13', '1714425044_th(10).jpg', 0, 3, 16, 3),
(17, 'Abreuvoir', 'Abreuvoir pour oiseau à petit gabaries', 3.00, '2024-05-13', '1713957780_fait4.jpg', 0, 3, 16, 3),
(18, 'Piscine', 'Votre oiseau à besoin de se beigner ? Prenez lui une petite piscine pour qu\'il se la coule douce !!', 7.00, '2024-05-13', '1714425099_piscine.jpg', 0, 3, 16, 3),
(19, 'Cabane', 'Une cabane pour des oiseaux qui veulent squatter votre jardin !!', 15.99, '2024-05-13', '1713958186_Cabane.jpg', 1, 3, 16, 3),
(20, 'Petite piscine', 'Une piscine pour vos petits oiseaux qui veut profité de l\'été !', 11.99, '2024-05-13', '1714425070_petite_piscine.jpg', 0, 3, 16, 3),
(21, 'Mangeoir', 'Un mangeoire pour plusieurs oiseaux en même temps ?! Un bon article pour que vos oiseaux mange un buffet entre eux !', 20.00, '2024-05-13', '1713959051_buffet.jpg', 0, 3, 16, 3),
(22, 'Mangeoire élevé', 'Un mangeoire en hauteur pour oiseau à petit gabaries, si il souhaite mangé pendant leurs moment en dehors de la cage, ce mangeoire est parfait pour ça! ', 7.78, '2024-05-13', '1714425280_mangeoir_en_hauteur.jpg', 0, 3, 16, 3),
(23, 'Vitamine', 'Pour amélioré l\'état du plumage de votre Oiseau, utilisé ce flacon avec une pipette fournis. Verser 3 gouttes de vitamine dans l\'eau', 19.75, '2024-05-13', '1714219692_Vitamine1.webp', 1, 3, 17, 3);

-- --------------------------------------------------------

--
-- Structure de la table `Score`
--

CREATE TABLE `Score` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `idProduct` int(255) UNSIGNED NOT NULL,
  `idCustomer` int(255) UNSIGNED NOT NULL,
  `score` float UNSIGNED DEFAULT NULL CHECK (`score` between 0 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Score`
--

INSERT INTO `Score` (`id`, `idProduct`, `idCustomer`, `score`) VALUES
(1, 2, 1, 3),
(2, 10, 1, 4),
(3, 4, 1, 5),
(4, 2, 2, 4),
(5, 23, 2, 4),
(6, 12, 2, 2),
(7, 6, 2, 5),
(8, 19, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Seller`
--

CREATE TABLE `Seller` (
  `id` int(255) UNSIGNED NOT NULL,
  `surname` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `pseudo` varchar(32) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `sex` varchar(32) NOT NULL,
  `country` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Seller`
--

INSERT INTO `Seller` (`id`, `surname`, `name`, `pseudo`, `psw`, `birthdate`, `sex`, `country`, `address`) VALUES
(1, 'Pierre', 'Henry', 'Anima', '$2y$10$ebvgaUNj6Zm5vVGTFNCgaONzJl5eLewvybe3eYqXvqXjwIoOhTnMm', '1998-08-27', 'homme', 'France', '68 rue Poivre Paris'),
(2, 'Freitzer', 'Hanz', 'MaxiFood', '$2y$10$yCp0ntUSJ5oGlKNBrzmeDuMaeTuKqM57J7hLZHImN9VmrInDTdyqO', '1978-09-23', 'homme', 'Listembourg', '15 Avenue Alphonse Astabourg'),
(3, 'Mohamed', 'Ibrir', 'FanDesOiseau', '$2y$10$jOc1nOi4W9SvkiYEYfIW1OrU/Lc548uZLisDvuWanh/w14J02i8Ze', '2005-01-20', 'homme', 'France', '15 rue le mur Marseille');

-- --------------------------------------------------------

--
-- Structure de la table `Subcategory`
--

CREATE TABLE `Subcategory` (
  `name` varchar(60) NOT NULL,
  `id` int(64) UNSIGNED NOT NULL,
  `idCat` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Subcategory`
--

INSERT INTO `Subcategory` (`name`, `id`, `idCat`) VALUES
('Nourriture', 1, 1),
('Jouet', 2, 1),
('Couchage', 3, 1),
('Gamelle et accessoire', 4, 1),
('Vêtement', 5, 1),
('Niche', 6, 2),
('Soin et hygiène', 7, 1),
('Nourriture', 8, 2),
('Arbre à chat', 9, 1),
('Panier', 10, 2),
('Jouet', 11, 2),
('Litière', 12, 2),
('Gamelle et accessoire', 13, 2),
('Vêtement', 14, 2),
('Soin et hygiène', 15, 2),
('Cage et accessoire', 16, 3),
('Nourriture', 17, 3),
('Jouet', 18, 3),
('Soin', 19, 3),
('Litière', 20, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Index pour la table `Basket`
--
ALTER TABLE `Basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`),
  ADD KEY `idCustomer` (`idCustomer`);

--
-- Index pour la table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCustomer` (`idCustomer`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Index pour la table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Index pour la table `Historic`
--
ALTER TABLE `Historic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`),
  ADD KEY `idCustomer` (`idCustomer`);

--
-- Index pour la table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSeller` (`idSeller`),
  ADD KEY `category` (`category`),
  ADD KEY `subcategory` (`subcategory`);

--
-- Index pour la table `Score`
--
ALTER TABLE `Score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`),
  ADD KEY `idCustomer` (`idCustomer`);

--
-- Index pour la table `Seller`
--
ALTER TABLE `Seller`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Index pour la table `Subcategory`
--
ALTER TABLE `Subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCat` (`idCat`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Basket`
--
ALTER TABLE `Basket`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Historic`
--
ALTER TABLE `Historic`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `Score`
--
ALTER TABLE `Score`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Seller`
--
ALTER TABLE `Seller`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Subcategory`
--
ALTER TABLE `Subcategory`
  MODIFY `id` int(64) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Basket`
--
ALTER TABLE `Basket`
  ADD CONSTRAINT `Basket_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `Product` (`id`),
  ADD CONSTRAINT `Basket_ibfk_2` FOREIGN KEY (`idCustomer`) REFERENCES `Customer` (`id`);

--
-- Contraintes pour la table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `Customer` (`id`),
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `Product` (`id`);

--
-- Contraintes pour la table `Historic`
--
ALTER TABLE `Historic`
  ADD CONSTRAINT `Historic_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `Product` (`id`),
  ADD CONSTRAINT `Historic_ibfk_2` FOREIGN KEY (`idCustomer`) REFERENCES `Customer` (`id`);

--
-- Contraintes pour la table `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`idSeller`) REFERENCES `Seller` (`id`),
  ADD CONSTRAINT `Product_ibfk_2` FOREIGN KEY (`category`) REFERENCES `Category` (`id`),
  ADD CONSTRAINT `Product_ibfk_3` FOREIGN KEY (`subcategory`) REFERENCES `Subcategory` (`id`);

--
-- Contraintes pour la table `Score`
--
ALTER TABLE `Score`
  ADD CONSTRAINT `Score_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `Product` (`id`),
  ADD CONSTRAINT `Score_ibfk_2` FOREIGN KEY (`idCustomer`) REFERENCES `Customer` (`id`);

--
-- Contraintes pour la table `Subcategory`
--
ALTER TABLE `Subcategory`
  ADD CONSTRAINT `Subcategory_ibfk_1` FOREIGN KEY (`idCat`) REFERENCES `Category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
